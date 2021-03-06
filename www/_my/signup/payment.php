<?php
	require(dirname(__FILE__) . '/../../../includes/prepend.inc.php');
	QApplication::AuthenticatePublic();

	class PaymentSignupQForm extends ChmsForm {
		protected $strPageTitle = null;
		/**
		 * @var SignupForm
		 */
		protected $objSignupForm;

		/**
		 * @var SignupEntry
		 */
		protected $objSignupEntry;

		protected $objChild;

		protected $dtgProducts;
		protected $lstRequiredWithChoice;

		protected $rblDeposit;
		protected $btnRegister;

		/**
		 * @var PaymentPanel
		 */
		protected $pnlPayment;
		
		protected function Form_Create() {
			// Attempt to load by Token and then by ID
			$this->objSignupForm = SignupForm::LoadByToken(QApplication::PathInfo(0));
			if (!$this->objSignupForm) $this->objSignupForm = SignupForm::Load(QApplication::PathInfo(0));

			// Ensure it is the correct type and it exists
			if (!$this->objSignupForm) {
				$this->strHtmlIncludeFilePath = '_notfound.tpl.php';
				return;
			}

			$this->strPageTitle = $this->objSignupForm->Name . ' - Payment';

			// Ensure it is Active
			if (!$this->objSignupForm->ActiveFlag) {
				$this->strHtmlIncludeFilePath = '_notactive.tpl.php';
				return;
			}

			// Ensure we have Products that require some kind of payment
			if (!$this->objSignupForm->CountFormProducts()) {
				$this->strHtmlIncludeFilePath = '_notfound.tpl.php';
				return;
			}

			// Get the SignupEntry
			$this->objSignupEntry = SignupEntry::Load(QApplication::PathInfo(1));
			
			// Ensure it is correct for the form and the signup person
			if (!$this->objSignupEntry ||
				($this->objSignupEntry->SignupFormId != $this->objSignupForm->Id) ||
				($this->objSignupEntry->SignupByPersonId != QApplication::$PublicLogin->PersonId) ||
				($this->objSignupEntry->SignupEntryStatusTypeId != SignupEntryStatusType::Incomplete)) {
				$this->strHtmlIncludeFilePath = '_notfound.tpl.php';
				return;
			}
			
			switch ($this->objSignupForm->SignupFormTypeId) {
				case SignupFormType::Event:
					$this->objChild = $this->objSignupForm->EventSignupForm;
					break;
				case SignupFormType::Course:
					$this->objChild = $this->objSignupForm->ClassMeeting;
					break;
			}

			$this->dtgProducts = new QDataGrid($this);
			$this->dtgProducts->AddColumn(new QDataGridColumn('Product / Item', '<?= $_FORM->RenderProduct($_ITEM); ?>', 'HtmlEntities=false', 'Width=550px'));
			$this->dtgProducts->AddColumn(new QDataGridColumn('Quantity', '<?= $_FORM->RenderQuantity($_ITEM); ?>', 'HtmlEntities=false', 'Width=100px'));
			$this->dtgProducts->AddColumn(new QDataGridColumn('Cost', '<?= $_FORM->RenderCost($_ITEM); ?>', 'HtmlEntities=false', 'Width=100px'));
			$this->dtgProducts->AddColumn(new QDataGridColumn('Total', '<?= $_FORM->RenderTotal($_ITEM); ?>', 'HtmlEntities=false', 'Width=100px'));
			$this->dtgProducts->SetDataBinder('dtgProducts_Bind');

			// Remove All Product Selections
			$this->objSignupEntry->DeleteAllSignupProducts();

			// Add Required Products
			foreach ($this->objSignupForm->GetFormProductArrayByType(FormProductType::Required, QQ::OrderBy(QQN::FormProduct()->OrderNumber)) as $objProduct) {
				if ($objProduct->IsAvailableRightNow()) {
					$objSignupProduct = SignupProduct::LoadBySignupEntryIdFormProductId($this->objSignupEntry->Id, $objProduct->Id);
					if (!$objSignupProduct) {
						$this->objSignupEntry->AddProduct($objProduct);
					}
				}
			}

			// Deposit vs. Full Amount Choice
			$this->rblDeposit = new QRadioButtonList($this);
			$this->rblDeposit->Name = 'Payment Option';
			$this->rblDeposit->AddItem('Pay in Full', 1);
			$this->rblDeposit->AddItem('Deposit', 2);
			$this->rblDeposit->AddAction(new QClickEvent(), new QAjaxAction('rblDeposit_Click'));
			
			$this->btnRegister = new QButton($this);
			$this->btnRegister->CssClass = 'primary';
			$this->btnRegister->Text = 'Submit Registration';
			$this->btnRegister->AddAction(new QClickEvent(), new QAjaxAction('btnRegister_Click'));
			$this->btnRegister->CausesValidation = true;
			
			// Figure out which address to use
			$objAddress = $this->objSignupEntry->RetrieveAnyValidAddressObject();
			if (!$objAddress) $objAddress = QApplication::$PublicLogin->Person->DeducePrimaryAddress();
			
			// Create the Payment Panel
			$this->pnlPayment = new PaymentPanel($this, null, $objAddress, QApplication::$PublicLogin->Person->FirstName, QApplication::$PublicLogin->Person->LastName);
			$this->pnlPayment->SetButtonText('Submit Payment');
			
			$this->objSignupEntry->RefreshAmounts();
			$this->RefreshForm();
		}

		public function Form_Validate() {
			$blnToReturn = parent::Form_Validate();
			$blnFirst = true;
			foreach ($this->GetErrorControls() as $objControl) {
				$objControl->Blink();
				if ($blnFirst) {
					$this->pnlPayment->btnSubmit_Reset();
					$objControl->Focus();
					$blnFirst = false;
				}
			}

			return $blnToReturn;
		}
		
		public function RenderProduct($objItem) {
			// For Required and Optional Products
			if ($objItem instanceof FormProduct) {
				if ($objItem->Description)
					return QApplication::HtmlEntities($objItem->Name) . '<br/><span class="na">' .
						QApplication::HtmlEntities($objItem->Description) . '</span>';
				else
					return QApplication::HtmlEntities($objItem->Name);

			// For Payment Entries
			} else if ($objItem instanceof SignupPayment) {
				return SignupPaymentType::$NameArray[$objItem->SignupPaymentTypeId] . '<br/><span class="na">' .
					QApplication::HtmlEntities($objItem->TransactionDescription) . 
					(($objItem->TransactionDate) ? (' - ' . $objItem->TransactionDate->ToString('MMM D YYYY')) : null) . 
					'</span>';

			// For "Required with Choice" Products
			} else if ($objItem == -1) {
				if (!$this->lstRequiredWithChoice) {
					$this->lstRequiredWithChoice = new QListBox($this->dtgProducts);
					$this->lstRequiredWithChoice->Required = true;

					$this->lstRequiredWithChoice->AddItem('- Select One -', null, true);
					// Get all the active RequiredWithChoice items and add it
					foreach ($this->objSignupForm->GetFormProductArrayByType(FormProductType::RequiredWithChoice, QQ::OrderBy(QQN::FormProduct()->OrderNumber)) as $objProduct)
						if ($objProduct->IsAvailableRightNow()) $this->lstRequiredWithChoice->AddItem($objProduct->Name, $objProduct->Id);

					$this->lstRequiredWithChoice->AddAction(new QChangeEvent(), new QAjaxAction('lstRequiredWithChoice_Change'));
				}

				$objProduct = FormProduct::Load($this->lstRequiredWithChoice->SelectedValue);
				if ($objProduct && $objProduct->Description) {
					return $this->lstRequiredWithChoice->Render(false) . '<br/><span class="na">' . QApplication::HtmlEntities($objProduct->Description) . '</span>';
				} else {
					return $this->lstRequiredWithChoice->Render(false);
				}

			// For the "Balance Due" at the bottom
			} else if (is_null($objItem)) {
				return '<strong>BALANCE DUE</strong>';
			}
		}

		public function RenderQuantity($objItem) {
			// Required and Optional Products
			if ($objItem instanceof FormProduct) {
				if ($objItem->FormProductTypeId == FormProductType::Required)
					return '1';
				else if ($objItem->FormProductTypeId == FormProductType::Optional) {
					if ($objItem->FormPaymentTypeId == FormPaymentType::Donation) {
						return '1';
					} else {
						$lstQuantity = $this->GetControl('lstQuantity' . $objItem->Id);
						if (!$lstQuantity) {
							$lstQuantity = new QListBox($this->dtgProducts, 'lstQuantity' . $objItem->Id);
							$lstQuantity->ActionParameter = $objItem->Id;
							$lstQuantity->AddItem(0, 0);
							for ($intQuantity = $objItem->MinimumQuantity; $intQuantity <= $objItem->MaximumQuantity; $intQuantity++)
								$lstQuantity->AddItem($intQuantity, $intQuantity);
							$lstQuantity->SelectedIndex = 0;
							$lstQuantity->AddAction(new QChangeEvent(), new QAjaxAction('lstQuantity_Change'));
						}
					}
					
					return $lstQuantity->Render(false);
				}

			// Payment Entries
			} else if ($objItem instanceof SignupPayment) {
				return null;

			// "Required with Choice" Products
			} else if ($objItem == -1) {
				if ($this->lstRequiredWithChoice->SelectedValue) return '1';
				else return null;
			}
		}

		public function RenderCost($objItem) {
			// Required and Optional Products
			if ($objItem instanceof FormProduct) {
				switch ($objItem->FormPaymentTypeId) {
					case FormPaymentType::PayInFull:
					case FormPaymentType::DepositRequired:
						return QApplication::DisplayCurrency($objItem->Cost);
					case FormPaymentType::Donation:
						$txtDonation = $this->GetControl('txtDonation' . $objItem->Id);
						if (!$txtDonation) {
							$txtDonation = new QFloatTextBox($this->dtgProducts, 'txtDonation' . $objItem->Id);
							$txtDonation->ActionParameter = $objItem->Id;
							$txtDonation->Minimum = 0;
							$txtDonation->Width = '60px';
							$txtDonation->MaxLength = 8;
							$txtDonation->Required = ($objItem->FormProductTypeId == FormProductType::Required);
							$txtDonation->AddAction(new QChangeEvent(), new QAjaxAction('txtDonation_Change'));
							$txtDonation->AddAction(new QEnterKeyEvent(), new QAjaxAction('txtDonation_Change'));
							$txtDonation->AddAction(new QEnterKeyEvent(), new QTerminateAction());
						}
						return '$ ' . $txtDonation->Render(false);
				}

			// Payment Entries
			} else if ($objItem instanceof SignupPayment) {
				return null;

			// "Required with Choice" Products
			} else if ($objItem == -1) {
				$objProduct = FormProduct::Load($this->lstRequiredWithChoice->SelectedValue);
				if (!$objProduct) return null;
				switch ($objProduct->FormPaymentTypeId) {
					case FormPaymentType::PayInFull:
					case FormPaymentType::DepositRequired:
						return QApplication::DisplayCurrency($objProduct->Cost);
					case FormPaymentType::Donation:
						$txtDonation = $this->GetControl('txtDonation' . $objProduct->Id);
						if (!$txtDonation) {
							$txtDonation = new QFloatTextBox($this->dtgProducts, 'txtDonation' . $objProduct->Id);
							$txtDonation->ActionParameter = $objProduct->Id;
							$txtDonation->Minimum = 0;
							$txtDonation->Width = '60px';
							$txtDonation->MaxLength = 8;
							$txtDonation->Required = true;
							$txtDonation->AddAction(new QChangeEvent(), new QAjaxAction('txtDonation_Change'));
							$txtDonation->AddAction(new QEnterKeyEvent(), new QAjaxAction('txtDonation_Change'));
							$txtDonation->AddAction(new QEnterKeyEvent(), new QTerminateAction());
						}
						return '$ ' . $txtDonation->Render(false);
				}
			}
		}

		public function RenderTotal($objItem) {
			// Required and Optional Products
			if ($objItem instanceof FormProduct) {
				$objSignupProduct = SignupProduct::LoadBySignupEntryIdFormProductId($this->objSignupEntry->Id, $objItem->Id);

				if ($objSignupProduct) return QApplication::DisplayCurrency($objSignupProduct->TotalAmount);
				return null;
			
			// Payment Entries
			} else if ($objItem instanceof SignupPayment) {
				return QApplication::DisplayCurrency(-1 * $objItem->Amount);
			
			// "Required with Choice" Products
			} else if ($objItem == -1) {
				if ($intFormProductId = $this->lstRequiredWithChoice->SelectedValue) {
					$objSignupProduct = SignupProduct::LoadBySignupEntryIdFormProductId($this->objSignupEntry->Id, $intFormProductId);
					if ($objSignupProduct) {
						return QApplication::DisplayCurrency($objSignupProduct->TotalAmount);
					}
				}
				return null;

			// Balance Entry
			} else if (is_null($objItem)) {
				return '<strong>' . QApplication::DisplayCurrency(-1 * $this->objSignupEntry->AmountBalance) . '</strong>';
			}
		}
		
		public function dtgProducts_Bind() {
			$arrDataSource = array();

			// First add any required products
			foreach ($this->objSignupForm->GetFormProductArrayByType(FormProductType::Required, QQ::OrderBy(QQN::FormProduct()->OrderNumber)) as $objProduct)
				if ($objProduct->IsAvailableRightNow())
					$arrDataSource[] = $objProduct;

			// If there are any valid "Required with Choice" products, add the row for it
			foreach ($this->objSignupForm->GetFormProductArrayByType(FormProductType::RequiredWithChoice, QQ::OrderBy(QQN::FormProduct()->OrderNumber)) as $objProduct)
				if ($objProduct->IsAvailableRightNow()) {
					$arrDataSource[] = -1;
					break;
				}

			// Add any optional products
			foreach ($this->objSignupForm->GetFormProductArrayByType(FormProductType::Optional, QQ::OrderBy(QQN::FormProduct()->OrderNumber)) as $objProduct)
				if ($objProduct->IsAvailableRightNow())
					$arrDataSource[] = $objProduct;

			// Add any payments
			$arrDataSource = array_merge($arrDataSource, $this->objSignupEntry->GetSignupPaymentArray(QQ::OrderBy(QQN::SignupPayment()->TransactionDate)));

			// Add "Balance Due"
			$arrDataSource[] = null;

			$this->dtgProducts->DataSource = $arrDataSource;
		}

		public function txtDonation_Change($strFormId, $strControlId, $strParameter) {
			$txtDonation = $this->GetControl($strControlId);
			$objFormProduct = FormProduct::Load($strParameter);
			
			$txtDonation->Text = str_replace('$', '', $txtDonation->Text);
			$txtDonation->Text = str_replace('-', '', $txtDonation->Text);
			$txtDonation->Text = sprintf('%.2f', (float) $txtDonation->Text);
			
			$objSignupProduct = SignupProduct::LoadBySignupEntryIdFormProductId($this->objSignupEntry->Id, $objFormProduct->Id);
			if (!$objSignupProduct) {
				$this->objSignupEntry->AddProduct($objFormProduct, 1, $txtDonation->Text);
			} else {
				$objSignupProduct->Amount = $txtDonation->Text;
				$objSignupProduct->Save();
				$this->objSignupEntry->RefreshAmounts();
			}
			$this->RefreshForm();
		}

		public function rblDeposit_Click($strFormId, $strControlId, $strParameter) {
			$this->RefreshForm();
		}

		public function btnRegister_Click($strFormId, $strControlId, $strParameter) {
			if ($this->GetAmount() == 0) {
				$this->objSignupEntry->Complete();
				QApplication::Redirect($this->objSignupEntry->ConfirmationUrl);
			} else {
				QApplication::DisplayAlert('You must enter in payment information.');
				$this->RefreshForm();
			}
		}

		public function lstQuantity_Change($strFormId, $strControlId, $strParameter) {
			$lstQuantity = $this->GetControl($strControlId);
			$objFormProduct = FormProduct::Load($strParameter);
			
			$objSignupProduct = SignupProduct::LoadBySignupEntryIdFormProductId($this->objSignupEntry->Id, $objFormProduct->Id);
			if (!$objSignupProduct) {
				if ($lstQuantity->SelectedValue) $this->objSignupEntry->AddProduct($objFormProduct, $lstQuantity->SelectedValue);
			} else {
				if ($lstQuantity->SelectedValue) {
					$objSignupProduct->Quantity = $lstQuantity->SelectedValue;
					$objSignupProduct->Save();
				} else {
					$objSignupProduct->Delete();
				}
				$this->objSignupEntry->RefreshAmounts();
			}
			$this->RefreshForm();
		}

		public function lstRequiredWithChoice_Change() {
			// Erase any old entries
			foreach ($this->objSignupEntry->GetSignupProductArray() as $objSignupProduct) {
				if (($objSignupProduct->FormProduct->FormProductTypeId == FormProductType::RequiredWithChoice) &&
					($objSignupProduct->FormProductId != $this->lstRequiredWithChoice->SelectedValue))
					$objSignupProduct->Delete();
			}
			
			// Create the new entry
			$objFormProduct = FormProduct::Load($this->lstRequiredWithChoice->SelectedValue);
			if ($objFormProduct) $this->objSignupEntry->AddProduct($objFormProduct);
			$this->RefreshForm();
		}

		public function RefreshForm() {
			// Refresh the DataGrid
			$this->dtgProducts->Refresh();

			// Calculate the Amount(s) based on the data object itself
			$fltDeposit = $this->objSignupEntry->CalculateMinimumDeposit();
			$fltAmountOwed = -1 * $this->objSignupEntry->AmountBalance;
			if ($fltAmountOwed <= $fltDeposit) $fltDeposit = null;

			// Refresh RBL Deposit Stuff
			if (!is_null($fltDeposit)) {
				$strText = sprintf('Pay in Full ($%.2f)', $fltAmountOwed);
				if ($this->rblDeposit->GetItem(0)->Name != $strText) {
					$this->rblDeposit->Refresh();
					$this->rblDeposit->GetItem(0)->Name = $strText;
				}

				$strText = sprintf('Deposit ($%.2f)', $fltDeposit);
				if ($this->rblDeposit->GetItem(1)->Name != $strText) {
					$this->rblDeposit->Refresh();
					$this->rblDeposit->GetItem(1)->Name = $strText;
				}

				if (!$this->rblDeposit->Visible) $this->rblDeposit->Visible = true;
				if (!$this->rblDeposit->Required) $this->rblDeposit->Required = true;
			} else {
				if ($this->rblDeposit->Visible) $this->rblDeposit->Visible = false;
				if ($this->rblDeposit->Required) $this->rblDeposit->Required = false;
				if ($this->rblDeposit->SelectedValue) $this->rblDeposit->SelectedValue = null;
			}

			// Figure out if we need to display the Payment Panel
			if ($this->GetAmount()) {
				if (!$this->pnlPayment->Visible) $this->pnlPayment->Visible = true;
				if ($this->btnRegister->Visible) $this->btnRegister->Visible = false;
			} else {
				if ($this->pnlPayment->Visible) $this->pnlPayment->Visible = false;
				if (!$this->btnRegister->Visible) $this->btnRegister->Visible = true;
			}
		}

		/////////////////////////
		// PaymentPanel CallBacks
		/////////////////////////

		/**
		 * Called back from PaymentPanel to actually generate a PaymentObject
		 * or in this case, a SignupPayment entry.
		 * @return SignupPayment
		 */
		public function CreatePaymentObject() {
			// Create the PaymentObject
			$objSignupPayment = new SignupPayment();
			$objSignupPayment->SignupEntry = $this->objSignupEntry;
			$objSignupPayment->SignupPaymentTypeId = SignupPaymentType::CreditCard;
			$objSignupPayment->FundingAccount = $this->objSignupEntry->SignupForm->FundingAccount;
			$objSignupPayment->DonationStewardshipFund = $this->objSignupEntry->SignupForm->DonationStewardshipFund;
			
			return $objSignupPayment;
		}

		/**
		 * Called back from PaymentPanel to perform saves on any children objects
		 * from PaymentObject, or in this case, nothing.
		 */
		public function PaymentObjectSaveChildren(SignupPayment $objPaymentObject) {
			// NO-OP by design
		}

		/**
		 * Called back from PaymentPanel to figure out how much is actually
		 * being charged.
		 * @return float
		 */
		public function GetAmount() {
			$fltDeposit = $this->objSignupEntry->CalculateMinimumDeposit();
			$fltAmountOwed = -1 * $this->objSignupEntry->AmountBalance;
			if ($fltAmountOwed <= $fltDeposit) $fltDeposit = null;

			if ($this->rblDeposit->Visible && !is_null($fltDeposit) &&
				($this->rblDeposit->SelectedValue == 2)) {
				return $fltDeposit;
			} else {
				return $fltAmountOwed;
			}
		}

		/**
		 * Called back from PaymentPanel to perform final tasks after we know
		 * the payment has been submitted successfully.
		 */
		public function PaymentPanel_Success(SignupPayment $objPaymentObject) {
			$this->objSignupEntry->Complete($objPaymentObject);
			QApplication::Redirect($this->objSignupEntry->ConfirmationUrl);
		}

		/**
		 * Called back from PaymentPanel to perform cleanup tasks after we know
		 * the payment has failed.
		 */
		public function PaymentPanel_Failed(SignupPayment $objPaymentObject) {
			// we do not need to do anything
		}
	}

	PaymentSignupQForm::Run('PaymentSignupQForm');
?>