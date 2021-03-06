<?php
	class Vicp_ContactInformation_EditAddress extends Vicp_Base {
		public $mctAddress;
		public $btnDelete;

		public $lstAddressType;
		public $calDateUntilWhen;
		public $chkCurrentFlag;

		public $chkInvalidFlag;
		public $chkInternationalFlag;
		public $txtAddress1;
		public $txtAddress2;
		public $txtAddress3;
		public $txtCity;
		public $lstState;
		public $txtZipCode;
		
		public $txtInternationalState;
		public $txtCountry;
		
		public $dlgMessage;

		protected function SetupPanel() {
			// Get and Validate the Address Object
			$this->mctAddress = AddressMetaControl::Create($this, $this->strUrlHashArgument, QMetaControlCreateType::CreateOnRecordNotFound);

			// Dialog Message
			$this->dlgMessage = new MessageDialog($this);
			$this->dlgMessage_Reset();
			$this->btnSave->RemoveAllActions(QClickEvent::EventName);
			$this->btnSave->AddAction(new QClickEvent(), new QShowDialogBox($this->dlgMessage));
			$this->btnSave->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnSave_Click'));

			if (!$this->mctAddress->EditMode) {
				// Trying to create a NEW address
				$this->mctAddress->Address->Person = $this->objPerson;
				$this->btnSave->Text = 'Create';
			} else {
				// Ensure the Address object belongs to the person
				if ($this->mctAddress->Address->PersonId != $this->objPerson->Id) {
					return $this->ReturnTo('#contact');
				}
				$this->btnSave->Text = 'Update';

				$this->btnDelete = new QLinkButton($this);
				$this->btnDelete->Text = 'Delete';
				$this->btnDelete->CssClass = 'delete';
				$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction('Are you SURE you want to permenantly DELETE this record?'));
				$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
				$this->btnDelete->AddAction(new QClickEvent(), new QTerminateAction());
			}

			// Create Controls
			$this->lstAddressType = $this->mctAddress->lstAddressType_Create();
			$this->calDateUntilWhen = $this->mctAddress->calDateUntilWhen_Create();
			$this->calDateUntilWhen->MinimumYear = 2000;
			$this->calDateUntilWhen->MaximumYear = date('Y') + 10;
			$this->chkCurrentFlag = $this->mctAddress->chkCurrentFlag_Create();

			// Fixup "Address Type"
			$this->lstAddressType->GetItem(0)->Name = 'Previous Home';
			if (!$this->mctAddress->EditMode) $this->lstAddressType->AddSelectOneOption();

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
			$this->chkInternationalFlag->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'chkInternationalFlag_Click'));
			$this->chkInternationalFlag_Click();
			
			// Add Actions
			$this->lstAddressType->AddAction(new QChangeEvent(), new QAjaxControlAction($this, 'lstAddressType_Change'));

			// Setup Controls
			$this->lstAddressType_Change();
		}

		public function Validate() {
			$this->dlgMessage->HideDialogBox();
			return parent::Validate();
		}

		public function dlgMessage_Reset() {
			$this->dlgMessage->RemoveAllButtons(false);
			$this->dlgMessage->HorizontalAlign = QHorizontalAlign::Center;
			$this->dlgMessage->MatteClickable = false;
			$this->dlgMessage->MessageHtml = '<p style="font-weight: bold;">Validating Address with USPS<br/><span style="font-weight: normal; font-size: 13px; color: #999;">Please wait...</span></p><p><img src="/assets/images/spinner_20.gif"/></p>';
			$this->dlgMessage->HideDialogBox();
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
		
		public function lstAddressType_Change() {
			$this->chkCurrentFlag->Visible = false;
			$this->calDateUntilWhen->Visible = false;

			switch ($this->lstAddressType->SelectedValue) {
				case AddressType::Home:
					break;

				case AddressType::Work:
				case AddressType::Other:
					$this->chkCurrentFlag->Visible = true;
					break;

				case AddressType::Temporary:
					$this->calDateUntilWhen->Visible = true;
					break;

				case null:
					break;

				default:
					throw new Exception('Unknown Address Type: ' . $this->lstAddressType->SelectedValue);
			}
		}

		public function btnSave_Click() {
			switch ($this->lstAddressType->SelectedValue) {
				case AddressType::Home:
					$this->chkCurrentFlag->Checked = false;
					$this->calDateUntilWhen->DateTime = null;
					break;

				case AddressType::Work:
				case AddressType::Other:
					$this->calDateUntilWhen->DateTime = null;
					break;

				case AddressType::Temporary:
					if (!$this->calDateUntilWhen->DateTime)
						$this->chkCurrentFlag->Checked = true;
					else if ($this->calDateUntilWhen->DateTime->IsLaterThan(QDateTime::Now()))
						$this->chkCurrentFlag->Checked = true;
					else
						$this->chkCurrentFlag->Checked = false;
					break;

				default:
					throw new Exception('Unknown Address Type: ' . $this->lstAddressType->SelectedValue);
			}

			$this->mctAddress->UpdateFields();

			if ((!$this->chkInvalidFlag->Checked) && (!$this->chkInternationalFlag->Checked)){
				if (!$this->mctAddress->Address->ValidateUsps()) {
					$this->dlgMessage->MessageHtml = '<p style="font-weight: bold;">This address is considered invalid with the USPS.</p><p style="font-size: 13px; color: #999;">Please make corrections or select <strong>"this is an INVALID address"</strong>.</p>';
					$this->dlgMessage->AddButton('Okay', MessageDialog::ButtonPrimary, 'dlgMessage_Reset', $this);
					$this->dlgMessage->ShowDialogBox();
					return;
				}
			} else {
				// Save the object, itself
				$this->mctAddress->Address->Save();
			}

			QApplication::ExecuteJavaScript('document.location="#contact";');
		}

		public function btnCancel_Click() {
			QApplication::ExecuteJavaScript('document.location="#contact";');
		}
	
		public function btnDelete_Click() {
			$this->mctAddress->Address->Delete();
			QApplication::ExecuteJavaScript('document.location="#contact";');
		}
	}
?>