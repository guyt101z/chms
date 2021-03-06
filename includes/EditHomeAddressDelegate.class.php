<?php
	class EditHomeAddressDelegate extends QBaseClass {
		protected $pnlContent;
		protected $strReturnUrl;

		public $mctAddress;
		public $btnDelete;

		public $dtrPhones;
		public $arrPhones;
		public $pxyAddPhone;

		public $chkInvalidFlag;
		public $chkInternationalFlag;
		public $txtAddress1;
		public $txtAddress2;
		public $txtAddress3;
		public $txtCity;
		public $lstState;
		public $txtZipCode;
		
		public $blnDisplayButtons;
		
		public $dlgMessage;
		
		public $txtInternationalState;
		public $txtCountry;

		public function dlgMessage_Reset() {
			$this->dlgMessage->RemoveAllButtons(false);
			$this->dlgMessage->HorizontalAlign = QHorizontalAlign::Center;
			$this->dlgMessage->MatteClickable = false;
			$this->dlgMessage->MessageHtml = '<p style="font-weight: bold;">Validating Address with USPS<br/><span style="font-weight: normal; font-size: 13px; color: #999;">Please wait...</span></p><p><img src="/assets/images/spinner_20.gif"/></p>';
			$this->dlgMessage->HideDialogBox();
		}

		public function __construct(QPanel $pnlContent, $strReturnUrl, $intAddressId, $blnDisplayButtons = true) {
			$this->pnlContent = $pnlContent;
			$this->pnlContent->Template = dirname(__FILE__) . '/EditHomeAddressDelegate.tpl.php';
			$this->strReturnUrl = $strReturnUrl;
			$this->blnDisplayButtons = $blnDisplayButtons;

			$this->dlgMessage = new MessageDialog($pnlContent);
			$this->dlgMessage_Reset();

			// Get and Validate the Address Object
			$this->mctAddress = AddressMetaControl::Create($this->pnlContent, $intAddressId, QMetaControlCreateType::CreateOnRecordNotFound);

			if (!$this->mctAddress->EditMode) {
				$this->mctAddress->Address->AddressTypeId = AddressType::Home;
				$this->mctAddress->Address->CurrentFlag = true;
				$this->pnlContent->btnSave->Text = 'Create';

				// Create Phone Numbers
				$this->arrPhones = array();
				$this->AddPhoneNumberField();
				$this->AddPhoneNumberField();
				$this->AddPhoneNumberField();
			} else {
				// Ensure the Address object belongs to the household
				if ($this->mctAddress->Address->HouseholdId != $this->pnlContent->Form->objHousehold->Id) {
					return $this->pnlContent->ReturnTo($this->strReturnUrl);
				}
				$this->pnlContent->btnSave->Text = 'Update';

				// Create DELETE Button for non-Current
				if (!$this->mctAddress->Address->CurrentFlag) {
					$this->btnDelete = new QLinkButton($this->pnlContent);
					$this->btnDelete->Text = 'Delete';
					$this->btnDelete->CssClass = 'delete';
					$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction('Are you SURE you want to permenantly DELETE this record?'));
					$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this->pnlContent, 'btnDelete_Click'));
					$this->btnDelete->AddAction(new QClickEvent(), new QTerminateAction());
				}

				// Get Phone Numbers
				$this->arrPhones = $this->mctAddress->Address->GetPhoneArray();

				// Add one additional
				if (count($this->arrPhones) < 3) {
					while (count($this->arrPhones) < 3) $this->AddPhoneNumberField();
				} else {
					$this->AddPhoneNumberField();
				}
			}

			// Create Controls
			$this->chkInvalidFlag = $this->mctAddress->chkInvalidFlag_Create();
			$this->txtAddress1 = $this->mctAddress->txtAddress1_Create();
			$this->txtAddress2 = $this->mctAddress->txtAddress2_Create();
			$this->txtAddress3 = $this->mctAddress->txtAddress3_Create();
			$this->txtCity = $this->mctAddress->txtCity_Create();
			$this->lstState = $this->mctAddress->lstState_Create();
			$this->txtZipCode = $this->mctAddress->txtZipCode_Create();
			$this->txtCountry = $this->mctAddress->txtCountry_Create();
			$this->txtInternationalState = $this->mctAddress->txtState_Create();
			$this->txtInternationalState->Visible = false;
			$this->chkInternationalFlag = $this->mctAddress->chkInternationalFlag_Create();
			$this->chkInternationalFlag->AddAction(new QClickEvent(), new QAjaxControlAction($this->pnlContent, 'chkInternationalFlag_Click'));
			$this->chkInternationalFlag_Click();
			

			// PHone Numbers
			$this->dtrPhones = new QDataRepeater($this->pnlContent);
			$this->dtrPhones->Template = dirname(__FILE__) . '/dtrPhones.tpl.php';
			$this->dtrPhones->SetDataBinder('dtrPhones_Bind', $this);
			
			$this->pxyAddPhone = new QControlProxy($this->pnlContent);
			$this->pxyAddPhone->AddAction(new QClickEvent(), new QAjaxControlAction($this->pnlContent, 'pxyAddPhone_Click'));
			$this->pxyAddPhone->AddAction(new QClickEvent(), new QTerminateAction());
		}
		
		public function pxyAddPhone_Click() {
			$this->AddPhoneNumberField();
			$this->dtrPhones->Refresh();
		}

		public function AddPhoneNumberField() {
			$objPhone = new Phone();
			$objPhone->PhoneTypeId = PhoneType::Home;
			$this->arrPhones[] = $objPhone;
		}

		public function dtrPhones_Bind() {
			$this->dtrPhones->DataSource = $this->arrPhones;
		}

		public function chkInternationalFlag_Click() {
			if($this->chkInternationalFlag->Checked) {
				$this->lstState->Visible = false;
				$this->txtInternationalState->Visible = true;
				$this->txtCountry->Visible = true;
			} else {
				$this->lstState->Visible = true;
				$this->txtInternationalState->Visible = false;
				$this->txtCountry->Visible = false;
			}
		}
		
		public function btnSave_Click() {
			// Set the household (if not yet set)
			$this->mctAddress->Address->Household = $this->pnlContent->Form->objHousehold;

			// Update the other fields
			$this->mctAddress->UpdateFields();

			if ((!$this->chkInvalidFlag->Checked) && (!$this->chkInternationalFlag->Checked)) {
				if (!$this->mctAddress->Address->ValidateUsps()) {
					$this->dlgMessage->MessageHtml = '<p style="font-weight: bold;">This address is considered invalid with the USPS.</p><p style="font-size: 13px; color: #999;">Please make corrections or select <strong>"this is an INVALID address"</strong>.</p>';
					$this->dlgMessage->AddButton('Okay', MessageDialog::ButtonPrimary, 'dlgMessage_Reset', $this->pnlContent);
					$this->dlgMessage->ShowDialogBox();
					return;
				}
			} else {
				// Save the object, itself
				$this->mctAddress->Address->Save();
			}


			// Phone Numbers
			for ($intIndex = 0; $intIndex < count($this->arrPhones); $intIndex++) {
				$txtPhone = $this->pnlContent->Form->GetControl('txtPhone' . $intIndex);
				$radPhone = $this->pnlContent->Form->GetControl('radPhone' . $intIndex);
				$objPhone = $this->arrPhones[$intIndex];

				if (trim($txtPhone->Text)) {
					$objPhone->AddressId = $this->mctAddress->Address->Id;
					$objPhone->Number = trim($txtPhone->Text);
					$objPhone->Save();

					if ($radPhone->Checked) $objPhone->SetAsPrimary(null, $this->mctAddress->Address);
				} else if ($objPhone->Id) {
					$objPhone->Delete();
				}
			}

			// If this addrss we are saving is "Current" then
			// let's make sure all the other addresses are PREVIOUS
			if ($this->mctAddress->Address->CurrentFlag && $this->mctAddress->Address->Household)
				$this->mctAddress->Address->Household->SetAsCurrentAddress($this->mctAddress->Address);

			if ($this->strReturnUrl)
				return $this->pnlContent->ReturnTo($this->strReturnUrl);
			else
				return true;
		}

		public function btnCancel_Click() {
			return $this->pnlContent->ReturnTo($this->strReturnUrl);
		}
	
		public function btnDelete_Click() {
			$this->mctAddress->Address->Delete();
			return $this->pnlContent->ReturnTo($this->strReturnUrl);
		}

		public function Validate($blnToReturn) {
			$this->dlgMessage->HideDialogBox();

			// How Many Phone Textboxes?
			$intCount = 0;
			$blnPrimaryContentExists = false;
			$blnAnyContentExists = false;

			while ($txtPhone = $this->pnlContent->Form->GetControl('txtPhone' . $intCount)) {
				$radPhone = $this->pnlContent->Form->GetControl('radPhone' . $intCount);
				$intCount++;

				if ($radPhone->Checked && strlen(trim($txtPhone->Text)))
					$blnPrimaryContentExists = true;
				if (strlen(trim($txtPhone->Text)))
					$blnAnyContentExists = true;

				if ($radPhone->Checked) $txtPrimaryPhone = $txtPhone;
			}

			if ($blnAnyContentExists && !$blnPrimaryContentExists) {
				$txtPrimaryPhone->Warning = 'At least one number must be Primary';
				$blnToReturn = false;
			}

			return $blnToReturn;
		}
	}
?>