<?php
	class Vicp_ContactInformation_EditAddress extends Vicp_Base {
		public $mctAddress;
		public $btnDelete;

		public $lstAddressType;
		public $txtAddress1;
		public $txtAddress2;
		public $txtAddress3;
		public $txtCity;
		public $lstState;
		public $txtZipCode;

		protected function SetupPanel() {
			// Get and Validate the Address Object
			$this->mctAddress = AddressMetaControl::Create($this, $this->strUrlHashArgument, QMetaControlCreateType::CreateOnRecordNotFound);

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
				$this->btnDelete->ForeColor = '#666666';
				$this->btnDelete->SetCustomStyle('margin-left', '200px');
				$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction('Are you SURE you want to permenantly DELETE this record?'));
				$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
				$this->btnDelete->AddAction(new QClickEvent(), new QTerminateAction());
			}

			// Create Controls
			$this->txtAddress1 = $this->mctAddress->txtAddress1_Create();
			$this->txtAddress2 = $this->mctAddress->txtAddress2_Create();
			$this->txtAddress3 = $this->mctAddress->txtAddress3_Create();
			$this->txtCity = $this->mctAddress->txtCity_Create();
			$this->lstState = $this->mctAddress->lstState_Create();
			$this->txtZipCode = $this->mctAddress->txtZipCode_Create();
		}

		public function btnSave_Click() {
			$this->mctAddress->SaveAddress();
			QApplication::ExecuteJavaScript('document.location="#contact";');
		}

		public function btnCancel_Click() {
			QApplication::ExecuteJavaScript('document.location="#contact";');
		}
	
		public function btnDelete_Click() {
			
		}
	}
?>