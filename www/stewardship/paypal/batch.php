<?php
	require(dirname(__FILE__) . '/../../../includes/prepend.inc.php');
	QApplication::Authenticate(null, array(PermissionType::AccessStewardship));

	class AdminMainForm extends ChmsForm {
		protected $strPageTitle = 'Stewardship - Pay Pal Reconciliation - Batch #';
		protected $intNavSectionId = ChmsForm::NavSectionStewardship;

		protected $dtgTransactions;
		protected $dtgFunding;
		protected $dtgUnaccounted;
		
		/**
		 * @var PaypalBatch
		 */
		protected $objBatch;

		protected $objEditing;
		protected $strEditingCode;
		protected $pxyEditFundDonationLineItem;
		protected $pxyEditFundSignupPayment;

		protected $lblInstructionHtml;
		protected $btnPost;
		protected $btnSplit;
		protected $dtxDateCredited;

		protected $dlgSplit;
		
		protected $btnSplitSave;
		protected $btnSplitCancel;
		protected $lstSplitItem;
		protected $txtSplitNameCurrent;
		protected $txtSplitNameNew;

		protected $dlgEditFund;
		protected $btnDialogSave;
		protected $btnDialogCancel;
		protected $lblDialogFund;
		protected $lstDialogFund;
		protected $txtDialogOther;
		
		protected $rbtnUpdateFundSelection;
		protected $lblDialogSplitFund;
		protected $lblDialogSplitFundTitle;
		protected $lstDialogSplitFund;
		protected $txtDialogSplitOther;
		protected $txtDialogSplitAmount;

		protected function btnPost_Click() {
			if (!$this->dtxDateCredited->DateTime) $this->dtxDateCredited->Warning = 'Invalid Date';
			$this->objBatch->PostBatch(QApplication::$Login, $this->dtxDateCredited->DateTime);
			$this->Transactions_Refresh();
		}

		protected function btnSplit_Click() {
			$this->dlgSplit->ShowDialogBox();
		}

		protected function pxyEditFundDonationLineItem_Click($strFormid, $strControlId, $strParameter) {
			$objOnlineDonationLineItem = OnlineDonationLineItem::Load($strParameter);
			if ($objOnlineDonationLineItem->OnlineDonation->CreditCardPayment->PaypalBatchId == $this->objBatch->Id) {
				$this->objEditing = $objOnlineDonationLineItem;
				if ($this->objEditing->DonationFlag)
					$this->lstDialogFund->SelectedValue = $objOnlineDonationLineItem->StewardshipFundId;
				else
					$this->lstDialogFund->SelectedValue = -1;
				$this->txtDialogOther->Text = $objOnlineDonationLineItem->Other;
				$this->lblDialogSplitFund->Text = 'Please specify the Funding account Details for the two separate line items you wish to split into The amount to be split is: $'.$objOnlineDonationLineItem->Amount;
				$this->dlgEditFund->ShowDialogBox(); //GJS We change this dialog box
				$this->lstDialogFund_Change();
			}
		}

		protected function pxyEditFundSignupPayment_Click($strFormid, $strControlId, $strParameter) {
			$this->strEditingCode = substr($strParameter, 0, 1);
			$objSignupPayment = SignupPayment::Load(substr($strParameter, 1));
			if (($objSignupPayment->CreditCardPayment->PaypalBatchId == $this->objBatch->Id)) {
				$this->objEditing = $objSignupPayment;
				$this->lblDialogSplitFund->Text = 'Please specify the Funding account Details for the two separate line items you wish to split into The amount to be split is: $'.$objSignupPayment->Amount;				
				if ($this->strEditingCode == 'd')
					$this->lstDialogFund->SelectedValue = $objSignupPayment->DonationStewardshipFundId;
				else {
					throw new Exception('Should Not Be Here -- Event Funds No Longer Editable');
				}
				$this->dlgEditFund->ShowDialogBox();
				$this->lstDialogFund_Change();
			}
		}

		protected function Form_Validate() {
			if($this->rbtnUpdateFundSelection->SelectedValue == 2){
				// Validate that the sum amount is equal to the initial amount
				if($this->objEditing->Amount != ($this->txtDialogSplitAmount[0]->Text +$this->txtDialogSplitAmount[1]->Text )) {
					$this->txtDialogSplitAmount[0]->Warning = 'The sum of the individual line item amounts do not match the initial amount specified';
					return false;
				}
			}			
			return true;
		}
		
		protected function btnDialogSave_Click() {
			// GJS Save according to radio button selection
			switch($this->rbtnUpdateFundSelection->SelectedValue) {
				case 1:
					if ($this->objEditing instanceof OnlineDonationLineItem) {
						if ($this->lstDialogFund->SelectedValue == -1) {
							$this->objEditing->DonationFlag = false;
							$this->objEditing->StewardshipFundId = null;
							$this->objEditing->Other = trim($this->txtDialogOther->Text);
						} else {
							$this->objEditing->DonationFlag = true;
							$this->objEditing->StewardshipFundId = $this->lstDialogFund->SelectedValue;
							$this->objEditing->Other = null;
						}
						$this->objEditing->Save();
					} else if ($this->strEditingCode == 'd') {
						$this->objEditing->DonationStewardshipFundId = $this->lstDialogFund->SelectedValue;
						$this->objEditing->Save();
					} else {
						$this->objEditing->StewardshipFundId = $this->lstDialogFund->SelectedValue;
						$this->objEditing->Save();
					}
					break;
				case 2: 
					// Save existing line Item
					if ($this->objEditing instanceof OnlineDonationLineItem) {
						if ($this->lstDialogSplitFund[0]->SelectedValue == -1) {
							$this->objEditing->DonationFlag = false;
							$this->objEditing->StewardshipFundId = null;
							$this->objEditing->Other = trim($this->txtDialogSplitOther[0]->Text);
						} else {
							$this->objEditing->DonationFlag = true;
							$this->objEditing->StewardshipFundId = $this->lstDialogSplitFund[0]->SelectedValue;
							$this->objEditing->Other = null;
						}
						$this->objEditing->Amount = $this->txtDialogSplitAmount[0]->Text;
						$this->objEditing->Save();
					} else if ($this->strEditingCode == 'd') {
						$this->objEditing->DonationStewardshipFundId = $this->lstDialogSplitFund[0]->SelectedValue;
						$this->objEditing->Amount = $this->txtDialogSplitAmount[0]->Text;
						$this->objEditing->Save();
					} else {
						$this->objEditing->StewardshipFundId = $this->lstDialogSplitFund->SelectedValue;
						$this->objEditing->Amount = $this->txtDialogSplitAmount[0]->Text;
						$this->objEditing->Save();
					}
					// Create a new line item - Lets just make it an online donation for now
					$objNewLineItem = new OnlineDonationLineItem();
					$objNewLineItem->Amount = $this->txtDialogSplitAmount[1]->Text;
					if ($this->lstDialogSplitFund[1]->SelectedValue == -1) {
						$objNewLineItem->DonationFlag = false;
						$$objNewLineItem->StewardshipFundId = null;
						$objNewLineItem->Other = trim($this->txtDialogSplitOther[1]->Text);
					} else {
						$objNewLineItem->DonationFlag = true;
						$objNewLineItem->StewardshipFundId = $this->lstDialogSplitFund[1]->SelectedValue;
						$objNewLineItem->Other = null;
					}
					$objNewLineItem->OnlineDonationId = $this->objEditing->OnlineDonationId;
					$objNewLineItem->Save();
					break;
			}

			$this->dlgEditFund->HideDialogBox();
			$this->Transactions_Refresh();
		}

		protected function btnDialogCancel_Click() {
			$this->dlgEditFund->HideDialogBox();
		}
		
		protected function btnSplitSave_Click() {
			if (strtolower(trim($this->txtSplitNameCurrent->Text)) == strtolower(trim($this->txtSplitNameNew->Text))) {
				QApplication::DisplayAlert('PayPal Batch Name/Numbers must be different.');
				return;
			}
			$this->objBatch->SplitBatch(trim($this->txtSplitNameCurrent->Text), trim($this->txtSplitNameNew->Text), CreditCardPayment::Load($this->lstSplitItem->SelectedValue));
			QApplication::Redirect('/stewardship/paypal');
		}

		protected function btnSplitCancel_Click() {
			$this->dlgSplit->HideDialogBox();
		}
		
		/**
		 * Stores the LINKED CC Paymente records for this batch
		 * @var CreditCardPayment[]
		 */
		protected $objPaymentArray;

		protected function Form_Create() {
			$this->objBatch = PaypalBatch::Load(QApplication::PathInfo(0));
			if (!$this->objBatch) QApplication::Redirect('/stewardship/paypal');
			$this->strPageTitle .= $this->objBatch->Number;

			$this->dtgTransactions = new QDataGrid($this);
			$this->dtgTransactions->SetDataBinder('dtgTransactions_Bind');
			$this->dtgTransactions->AddColumn(new QDataGridColumn('Date Captured', '<?= $_ITEM[0]; ?>', 'Width=150px', 'HtmlEntities=false', 'VerticalAlign=top'));
			$this->dtgTransactions->AddColumn(new QDataGridColumn('Total Amount Charged', '<?= $_ITEM[1]; ?>', 'Width=150px', 'VerticalAlign=top'));
			$this->dtgTransactions->AddColumn(new QDataGridColumn('Transaction Code', '<?= $_ITEM[2]; ?>', 'Width=120px', 'VerticalAlign=top'));
			$this->dtgTransactions->AddColumn(new QDataGridColumn('Account Funding', '<?= $_ITEM[3]; ?>', 'Width=330px', 'HtmlEntities=false', 'VerticalAlign=top', 'FontSize=10px'));
			$this->dtgTransactions->AddColumn(new QDataGridColumn('Funding Amount', '<?= $_ITEM[4]; ?>', 'Width=150px', 'HtmlEntities=false', 'VerticalAlign=top', 'FontSize=10px'));
			
			$this->dtgFunding = new QDataGrid($this);
			$this->dtgFunding->SetDataBinder('dtgFunding_Bind');
			$this->dtgFunding->AddColumn(new QDataGridColumn('Fund', '<?= $_ITEM[0]; ?>', 'Width=340px', 'HtmlEntities=false'));
			$this->dtgFunding->AddColumn(new QDataGridColumn('Account Number', '<?= $_ITEM[1]; ?>', 'Width=200px'));
			$this->dtgFunding->AddColumn(new QDataGridColumn('Amount', '<?= $_ITEM[2]; ?>', 'HtmlEntities=false', 'Width=380px', 'HtmlEntities=false'));
			
			$this->dtgUnaccounted = new CreditCardPaymentDataGrid($this);
			$this->dtgUnaccounted->MetaAddColumn('DateCaptured', 'Width=200px');
			$this->dtgUnaccounted->MetaAddColumn('AmountCharged', 'Html=<?= QApplication::DisplayCurrency($_ITEM->AmountCharged); ?>', 'Width=150px');
			$this->dtgUnaccounted->MetaAddColumn('TransactionCode', 'Width=500px');
			$this->dtgUnaccounted->SortColumnIndex = 0;
			$this->dtgUnaccounted->SetDataBinder('dtgUnaccounted_Bind');
			$this->dtgUnaccounted->NoDataHtml = 'Good!  There are no unaccounted-for credit card transaction entries in this PayPal batch.';
			
			$this->pxyEditFundDonationLineItem = new QControlProxy($this);
			$this->pxyEditFundDonationLineItem->AddAction(new QClickEvent(), new QAjaxAction('pxyEditFundDonationLineItem_Click'));
			$this->pxyEditFundDonationLineItem->AddAction(new QClickEvent(), new QTerminateAction());
			
			$this->pxyEditFundSignupPayment = new QControlProxy($this);
			$this->pxyEditFundSignupPayment->AddAction(new QClickEvent(), new QAjaxAction('pxyEditFundSignupPayment_Click'));
			$this->pxyEditFundSignupPayment->AddAction(new QClickEvent(), new QTerminateAction());
			
			$this->lblInstructionHtml = new QLabel($this);
			$this->lblInstructionHtml->TagName = 'p';
			$this->lblInstructionHtml->HtmlEntities = false;
			
			$this->dtxDateCredited = new QDateTimeTextBox($this);
			$this->dtxDateCredited->Name = 'Date to Credit Stewardship Contributions';
			$this->dtxDateCredited->Text = QDateTime::NowToString('MMMM D YYYY');
			$this->dtxDateCredited->Required = true;
			
			$this->btnPost = new QButton($this);
			$this->btnPost->Text = 'Post to NOAH';
			$this->btnPost->CssClass = 'primary';
			$this->btnPost->CausesValidation = $this->dtxDateCredited;

			$this->btnSplit = new QButton($this);
			$this->btnSplit->Text = 'Split This Batch';
			$this->btnSplit->CssClass = 'alternate';
			$this->btnSplit->SetCustomStyle('float', 'right');
			$this->btnSplit->AddAction(new QClickEvent(), new QAjaxAction('btnSplit_Click'));

			$this->dlgEditFund = new QDialogBox($this);
			$this->dlgEditFund->MatteClickable = false;
			$this->dlgEditFund->HideDialogBox();
			$this->dlgEditFund->Template = dirname(__FILE__) . '/dlgEditFund.tpl.php';

			$this->lblDialogFund = new QLabel($this->dlgEditFund);
			$this->lblDialogFund->Text = 'Please specify the appropriate Stewardship Funding Account for this line item.';
			$this->lblDialogFund->Visible = false;
			
			$this->lstDialogFund = new QListBox($this->dlgEditFund);
			$this->lstDialogFund->Name = 'Stewardship Fund';
			$this->lstDialogFund->AddItem('- Select One -', null);
			$this->lstDialogFund->Required = true;
			foreach (StewardshipFund::LoadArrayByActiveFlag(true, QQ::OrderBy(QQN::StewardshipFund()->Name)) as $objFund)
				$this->lstDialogFund->AddItem($objFund->Name, $objFund->Id);
			$this->lstDialogFund->AddItem('- Other (Non-Donation)... -', -1);
			$this->lstDialogFund->AddAction(new QChangeEvent(), new QAjaxAction('lstDialogFund_Change'));
			$this->lstDialogFund->Visible = false;

			$this->txtDialogOther = new QTextBox($this->dlgEditFund);
			$this->txtDialogOther->Name = 'Non-Donation Funding Account';
			$this->txtDialogOther->Visible = false;
			
			$this->lblDialogSplitFund = new QLabel($this->dlgEditFund);
			$this->lblDialogSplitFund->Visible = false;
			$this->lstDialogSplitFund = array();
			$this->txtDialogSplitOther = array();
			$this->txtDialogSplitAmount = array();
			$this->lblDialogSplitFundTitle = array();
			for($i=0; $i<2;$i++) {
				$this->lblDialogSplitFundTitle[$i] = new QLabel($this->dlgEditFund);
				$this->lblDialogSplitFundTitle[$i]->HtmlEntities = false;
				$this->lblDialogSplitFundTitle[$i]->Text = '<h4>Line Item '.($i+1).'</h4>';
				$this->lblDialogSplitFundTitle[$i]->Visible = false;
				$this->lstDialogSplitFund[$i] = new QListBox($this->dlgEditFund);
				$this->lstDialogSplitFund[$i]->Name = 'Stewardship Fund';
				$this->lstDialogSplitFund[$i]->AddItem('- Select One -', null);
				$this->lstDialogSplitFund[$i]->Required = true;
				foreach (StewardshipFund::LoadArrayByActiveFlag(true, QQ::OrderBy(QQN::StewardshipFund()->Name)) as $objFund)
					$this->lstDialogSplitFund[$i]->AddItem($objFund->Name, $objFund->Id);
				$this->lstDialogSplitFund[$i]->AddItem('- Other (Non-Donation)... -', -1);
				$this->lstDialogSplitFund[$i]->ActionParameter = $i;
				$this->lstDialogSplitFund[$i]->AddAction(new QChangeEvent(), new QAjaxAction('lstDialogSplitFund_Change'));
				$this->lstDialogSplitFund[$i]->Visible = false; 
				
				$this->txtDialogSplitOther[$i] = new QTextBox($this->dlgEditFund);
				$this->txtDialogSplitOther[$i]->Name = 'Non-Donation Funding Account';
				$this->txtDialogSplitOther[$i]->Visible = false;
				
				$this->txtDialogSplitAmount[$i] = new QFloatTextBox($this->dlgEditFund); 
				$this->txtDialogSplitAmount[$i]->Name = 'Funding Amount';
				$this->txtDialogSplitAmount[$i]->Visible = false;
			}

			
			$this->rbtnUpdateFundSelection = new QRadioButtonList($this->dlgEditFund);
			$this->rbtnUpdateFundSelection->AddItem('Change Stewardship Funding Account of the Line Item',1);
			$this->rbtnUpdateFundSelection->AddItem('Split this Line Item into two separate Funding Accounts',2);
			$this->rbtnUpdateFundSelection->HtmlBefore = 'Select how you would like to update this Stewardship Fund';
			$this->rbtnUpdateFundSelection->AddAction(new QChangeEvent(), new QAjaxAction('rbtnUpdateFundSelection_Change'));
			
			$this->btnDialogSave = new QButton($this->dlgEditFund);
			$this->btnDialogSave->CssClass = 'primary';
			$this->btnDialogSave->Text = 'Update';
			$this->btnDialogSave->CausesValidation = QCausesValidation::SiblingsAndChildren;
			$this->btnDialogSave->AddAction(new QClickEvent(), new QAjaxAction('btnDialogSave_Click'));
			
			$this->btnDialogCancel = new QLinkButton($this->dlgEditFund);
			$this->btnDialogCancel->CssClass = 'cancel';
			$this->btnDialogCancel->Text = 'Cancel';
			$this->btnDialogCancel->AddAction(new QClickEvent(), new QAjaxAction('btnDialogCancel_Click'));
			$this->btnDialogCancel->AddAction(new QClickEvent(), new QTerminateAction());

			$this->dlgSplit = new QDialogBox($this);
			$this->dlgSplit->MatteClickable = false;
			$this->dlgSplit->HideDialogBox();
			$this->dlgSplit->Template = dirname(__FILE__) . '/dlgSplit.tpl.php';

			$this->lstSplitItem = new QListBox($this->dlgSplit);
			$this->lstSplitItem->Name = 'Transaction Split Point';
			$this->lstSplitItem->AddItem('- Select One -', null);
			$this->lstSplitItem->Required = true;
			foreach ($this->objBatch->GetCreditCardPaymentArray(QQ::OrderBy(QQN::CreditCardPayment()->DateCaptured)) as $objPayment) {
				$this->lstSplitItem->AddItem('After ' . $objPayment->DateCaptured->ToString('MMM D YYYY h:mm z'), $objPayment->Id);
			}

			$this->txtSplitNameCurrent = new QTextBox($this->dlgSplit);
			$this->txtSplitNameCurrent->Name = 'Batch Number/Title for Original Batch';
			$this->txtSplitNameCurrent->Text = $this->objBatch->Number . ' (1)';

			$this->txtSplitNameNew = new QTextBox($this->dlgSplit);
			$this->txtSplitNameNew->Name = 'Batch Number/Title for New Batch';
			$this->txtSplitNameNew->Text = $this->objBatch->Number . ' (2)';

			$this->btnSplitSave = new QButton($this->dlgSplit);
			$this->btnSplitSave->CssClass = 'primary';
			$this->btnSplitSave->Text = 'Split';
			$this->btnSplitSave->CausesValidation = QCausesValidation::SiblingsAndChildren;
			$this->btnSplitSave->AddAction(new QClickEvent(), new QAjaxAction('btnSplitSave_Click'));
			
			$this->btnSplitCancel = new QLinkButton($this->dlgSplit);
			$this->btnSplitCancel->CssClass = 'cancel';
			$this->btnSplitCancel->Text = 'Cancel';
			$this->btnSplitCancel->AddAction(new QClickEvent(), new QAjaxAction('btnSplitCancel_Click'));
			$this->btnSplitCancel->AddAction(new QClickEvent(), new QTerminateAction());
			
			$this->Transactions_Refresh();
		}
		public function rbtnUpdateFundSelection_Change() {
			switch($this->rbtnUpdateFundSelection->SelectedValue) {
				case 1:
					$this->txtDialogOther->Visible = true;
					$this->lstDialogFund->Visible = true;
					$this->lblDialogFund->Visible = true;
					
					$this->lblDialogSplitFund->Visible = false;
					for($i=0; $i<2;$i++) {
						$this->lblDialogSplitFundTitle[$i]->Visible = false;
						$this->lstDialogSplitFund[$i]->Visible = false;
						$this->txtDialogSplitOther[$i]->Visible = false;
						$this->txtDialogSplitAmount[$i]->Visible = false;
					}			
					break;
				case 2:
					$this->txtDialogOther->Visible = false;
					$this->lstDialogFund->Visible = false;
					$this->lblDialogFund->Visible = false;
					
					$this->lblDialogSplitFund->Visible = true;
					for($i=0; $i<2;$i++) {
						$this->lblDialogSplitFundTitle[$i]->Visible = true;
						$this->lstDialogSplitFund[$i]->Visible = true;
						$this->txtDialogSplitOther[$i]->Visible = true;
						$this->txtDialogSplitAmount[$i]->Visible = true;
					}
					// Default the first one to the original value
					if ($this->objEditing->DonationFlag)
						$this->lstDialogSplitFund[0]->SelectedValue = $this->objEditing->StewardshipFundId;
					else
					$this->lstDialogSplitFund[0]->SelectedValue = -1;
					break;
				default:
			}	
		}
		
		public function lstDialogSplitFund_Change($strFormId, $strControlId, $strParameter) {
			$index = $strParameter;
			if ($this->lstDialogSplitFund[$index]->SelectedValue == -1) {
				$this->txtDialogSplitOther[$index]->Visible = true;
				$this->txtDialogSplitOther[$index]->Required = true;
			} else {
				$this->txtDialogSplitOther[$index]->Visible = false;
				$this->txtDialogSplitOther[$index]->Required = false;
			}
		}
		
		public function lstDialogFund_Change(){ 
			if ($this->lstDialogFund->SelectedValue == -1) {
				$this->txtDialogOther->Visible = true;
				$this->txtDialogOther->Required = true;
			} else {
				$this->txtDialogOther->Visible = false;
				$this->txtDialogOther->Required = false;
			}
		}

		protected function Transactions_Refresh() {
			// Cache the Payment Array for actual trackable payments
			$this->objPaymentArray = CreditCardPayment::LoadArrayByPaypalBatchIdUnlinkedFlag($this->objBatch->Id, false, 
				QQ::OrderBy(QQN::CreditCardPayment()->DateCaptured));
			
			if ($this->objBatch->ReconciledFlag) {
				$this->lblInstructionHtml->Text = sprintf('This PayPal Batch was posted to NOAH on <strong>%s</strong>.<br/><strong>No more changes can be made to this PayPal Batch.</strong><br/><br/>' . 
					'Click the following to view the linked <strong><a href="/stewardship/batch.php/%s#1">Stewardship Batch</a></strong>.<br/>' . 
					'Click on any <strong>Date Captured</strong> below on a credit card transaction with a donation record to view its linked Stewardship Entry.', 
					$this->objBatch->DateReconciled->ToString('MMMM D YYYY at h:mm z'), $this->objBatch->StewardshipBatchId);
				$this->btnPost->Visible = false;
				$this->btnSplit->Visible = false;
				$this->dtxDateCredited->Visible = false;
			} else if ($this->objBatch->IsUncategorizedPaymentsExist()) {
				$this->lblInstructionHtml->Text = 'There are currently unspecified funding accounts for one more more credit card payment line item.  Please ensure all items are accounted for before posting to NOAH.';
				$this->btnPost->Visible = false;
				$this->btnSplit->Visible = false;
				$this->dtxDateCredited->Visible = false;
				
				if (CreditCardPayment::CountByPaypalBatchIdUnlinkedFlag($this->objBatch->Id, true)) {
					$this->lblInstructionHtml->Text .= '<br/><br/><strong>WARNING!</strong>  There are unaccountable Credit Card Payment records in this batch!';
				}
			} else {
				$this->lblInstructionHtml->Text = 'This PayPal Batch has not yet been posted to NOAH.  Click on <strong>Post to NOAH</strong> when you are sure that there are no more changes or additions left for this batch.';
				$this->btnPost->Visible = true;
				$this->btnSplit->Visible = true;
				$this->dtxDateCredited->Visible = true;
				$this->btnPost->RemoveAllActions(QClickEvent::EventName);

				if (CreditCardPayment::CountByPaypalBatchIdUnlinkedFlag($this->objBatch->Id, true)) {
					$this->lblInstructionHtml->Text .= '<br/><br/><strong>WARNING!</strong>  There are unaccountable Credit Card Payment records in this batch!';
					$this->btnPost->AddAction(new QClickEvent(), new QConfirmAction('NOTE!  There are unaccountable Credit Card Payment records in this batch!  You are about to PERMANENTLY post this batch to NOAH.  No changes can be made after this point.  Are you SURE you want to proceed?'));
					$this->btnPost->AddAction(new QClickEvent(), new QAjaxAction('btnPost_Click'));
				} else {
					$this->btnPost->AddAction(new QClickEvent(), new QConfirmAction('You are about to PERMANENTLY post this batch to NOAH.  No changes can be made after this point.  Are you SURE you want to proceed?'));
					$this->btnPost->AddAction(new QClickEvent(), new QAjaxAction('btnPost_Click'));
				}
			}
			
			$this->dtgTransactions->Refresh();
			$this->dtgFunding->Refresh();
		}

		public function dtgTransactions_Bind() {
			$objDataSource = array();
			foreach ($this->objPaymentArray as $objPayment) {
				$strDateCapturedHtml = $objPayment->DateCaptured->ToString('MMM D YYYY h:mm z');
				if ($this->objBatch->ReconciledFlag && $objPayment->StewardshipContribution) {
					$strDateCapturedHtml = sprintf('<a href="/stewardship/batch.php/%s#%s/view_contribution/%s">%s</a>',
						$this->objBatch->StewardshipBatchId,
						$objPayment->StewardshipContribution->StewardshipStack->StackNumber,
						$objPayment->StewardshipContributionId,
						$strDateCapturedHtml);
				}

				if ($objPayment->OnlineDonation) {
					$strLineItemNameArray = array();
					$strLineItemAmountArray = array();
					foreach ($objPayment->OnlineDonation->GetOnlineDonationLineItemArray() as $objLineItem) {
						$strLineItemAmountArray[] = QApplication::DisplayCurrency($objLineItem->Amount);
						
						// We display it normally if we have a stewardshipfund
						if ($objLineItem->StewardshipFund)
							$strNameHtml = QApplication::HtmlEntities($objLineItem->StewardshipFund->Name);
						// We display a non-donation fund if applicable
						else if (!$objLineItem->DonationFlag) {
							if (!strlen($strDescription = trim($objLineItem->Other))) $strDescription = '(not specified)';
							$strNameHtml = '<strong>NON-DONATION</strong> - ' . QApplication::HtmlEntities($strDescription);
						// We display it as not-yet-selected
						} else {
							if (!strlen($strDescription = trim($objLineItem->Other))) $strDescription = '(not specified)';
							$strNameHtml = '<strong>OTHER</strong> - ' . QApplication::HtmlEntities($strDescription);
						}
						
						if ($this->objBatch->ReconciledFlag)
							$strLineItemNameArray[] = $strNameHtml;
						else
							$strLineItemNameArray[] = '<a href="#" ' . $this->pxyEditFundDonationLineItem->RenderAsEvents($objLineItem->Id, false) . '>' . $strNameHtml . '</a>';
					}

					$objDataSource[] = array(
						$strDateCapturedHtml,
						QApplication::DisplayCurrency($objPayment->AmountCharged),
						$objPayment->TransactionCode,
						implode('<br/>', $strLineItemNameArray),
						implode('<br/>', $strLineItemAmountArray)
					);
				} else if ($objPayment->SignupPayment) {
					$strLineItemNameArray = array();
					$strLineItemAmountArray = array();

					// Display the Non-Donation amount (if applicable)
					if ($fltAmount = $objPayment->SignupPayment->AmountNonDonation) {
						$strNameHtml = QApplication::HtmlEntities($objPayment->SignupPayment->FundingAccountLabel);

						$strLineItemNameArray[] = $strNameHtml . ' (Non-Donation)';
						$strLineItemAmountArray[] = QApplication::DisplayCurrency($fltAmount);
					}

					// Display the Donation amount (if applicable)
					if ($fltAmount = $objPayment->SignupPayment->AmountDonation) {
						$strNameHtml = QApplication::HtmlEntities($objPayment->SignupPayment->DonationStewardshipFund->Name);
						if ($this->objBatch->ReconciledFlag)
							$strLineItemNameArray[] = $strNameHtml;
						else
							$strLineItemNameArray[] = '<a href="#" ' . $this->pxyEditFundSignupPayment->RenderAsEvents('d' . $objPayment->SignupPayment->Id, false) . '>' . $strNameHtml . '</a>';
						$strLineItemAmountArray[] = QApplication::DisplayCurrency($fltAmount);
					}

					$objDataSource[] = array(
						$strDateCapturedHtml,
						QApplication::DisplayCurrency($objPayment->AmountCharged),
						$objPayment->TransactionCode,
						implode('<br/>', $strLineItemNameArray),
						implode('<br/>', $strLineItemAmountArray)
					);

				} else throw new Exception('Cannot figure out linked record to this credit card payment entry: ' . $objPayment->Id);
			}
			
			$this->dtgTransactions->DataSource = $objDataSource;
		}
		
		public function dtgFunding_Bind() {
			$objDataSource = array();
			$fltTotalDonation = 0;
			$fltTotalNonDonation = 0;
			foreach ($this->objPaymentArray as $objPayment) {
				if ($objPayment->OnlineDonation) {
					foreach ($objPayment->OnlineDonation->GetOnlineDonationLineItemArray() as $objLineItem) {
						// We've explicitly selected a Stewardship / Donation Fund
						if ($objLineItem->StewardshipFundId) {
							if (!array_key_exists($objLineItem->StewardshipFundId, $objDataSource)) {
								$objDataSource[$objLineItem->StewardshipFundId] = array(QApplication::HtmlEntities($objLineItem->StewardshipFund->Name), $objLineItem->StewardshipFund->AccountNumber, 0);
							}
							$objDataSource[$objLineItem->StewardshipFundId][2] += $objLineItem->Amount;
							$fltTotalDonation += $objLineItem->Amount;
							

						// We're explicilty looking at a NON DONATION
						} else if (!$objLineItem->DonationFlag) {
							$strKey = 'Non-Donation: ' . $objLineItem->Other;
							if (!array_key_exists($strKey, $objDataSource)) {
								$objDataSource[$strKey] = array('Non-Donation / Payment', $objLineItem->Other, 0);
							}
							$objDataSource[$strKey][2] += $objLineItem->Amount;
							$fltTotalNonDonation += $objLineItem->Amount;
							

						// We have not yet specified it, but we're assuming this to be a donation of some sort
						} else {
							if (!array_key_exists(0, $objDataSource)) {
								$objDataSource[0] = array('<span style="color: #888;">(Not Yet Specified)</span>', '---', 0);
							}
							$objDataSource[0][2] += $objLineItem->Amount;
							$fltTotalDonation += $objLineItem->Amount;
						}
					}

				} else if ($objPayment->SignupPayment) {
					if ($fltAmount = $objPayment->SignupPayment->AmountNonDonation) {
						if (!array_key_exists($objPayment->SignupPayment->FundingAccountLabel, $objDataSource)) {
							$objDataSource[$objPayment->SignupPayment->FundingAccountLabel] = array(QApplication::HtmlEntities($objPayment->SignupPayment->SignupEntry->SignupForm->Name),
								strlen(trim($objPayment->SignupPayment->FundingAccount)) ? QApplication::HtmlEntities($objPayment->SignupPayment->FundingAccount) : 'Unspecified',
								0);
						}
						$objDataSource[$objPayment->SignupPayment->FundingAccountLabel][2] += $fltAmount;
						$fltTotalNonDonation += $fltAmount;
					}
					if ($fltAmount = $objPayment->SignupPayment->AmountDonation) {
						if (!array_key_exists($objPayment->SignupPayment->DonationStewardshipFundId, $objDataSource)) {
							$objDataSource[$objPayment->SignupPayment->DonationStewardshipFundId] = array(QApplication::HtmlEntities($objPayment->SignupPayment->DonationStewardshipFund->Name), $objPayment->SignupPayment->DonationStewardshipFund->AccountNumber, 0);
						}
						$objDataSource[$objPayment->SignupPayment->DonationStewardshipFundId][2] += $fltAmount;
						$fltTotalDonation += $fltAmount;
					}
				} else throw new Exception('Cannot figure out linked record to this credit card payment entry: ' . $objPayment->Id);
			}

			// Make sure the amount shown is displayed as "currency" for each row
			foreach ($objDataSource as $intId => $arrArray) {
				$objDataSource[$intId][2] = QApplication::DisplayCurrency($objDataSource[$intId][2]);
				if ($intId == 0) $objDataSource[$intId][2] = '<span style="color: #888;">' . $objDataSource[$intId][2] . '</span>';
			}

			usort($objDataSource, array($this, 'dtgFunding_Sort'));
			$objDataSource[99997] = array('<strong style="color: #888;">TOTAL in DONATIONS</strong>', null, '<strong style="color: #888;">' . QApplication::DisplayCurrency($fltTotalDonation) . '</strong>');
			$objDataSource[99998] = array('<strong style="color: #888;">TOTAL in NON-DONATIONS</strong>', null, '<strong style="color: #888;">' . QApplication::DisplayCurrency($fltTotalNonDonation) . '</strong>');
			$objDataSource[99999] = array('<strong>GRAND TOTAL AMOUNT</strong>', null, '<strong>' . QApplication::DisplayCurrency($fltTotalDonation + $fltTotalNonDonation) . '</strong>');
			$this->dtgFunding->DataSource = $objDataSource;
		}
		
		public function dtgFunding_Sort($arrItem1, $arrItem2) {
			return $arrItem1[0] > $arrItem2[0];
		}
		
		public function dtgUnaccounted_Bind() {
			$objCondition = QQ::AndCondition(
				QQ::Equal(QQN::CreditCardPayment()->UnlinkedFlag, true),
				QQ::Equal(QQN::CreditCardPayment()->PaypalBatchId, $this->objBatch->Id)
			);
			$this->dtgUnaccounted->MetaDataBinder($objCondition);
		}
	}

	AdminMainForm::Run('AdminMainForm');
?>