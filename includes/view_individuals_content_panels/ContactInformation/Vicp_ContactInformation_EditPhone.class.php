<?php
	class Vicp_ContactInformation_EditPhone extends Vicp_Base {
		public $mctPhone;
		public $btnDelete;

		public $lstPhoneType;
		public $lstMobileProvider;
		public $txtNumber;

		protected function SetupPanel() {
			// Get and Validate the Phone Object
			$this->mctPhone = PhoneMetaControl::Create($this, $this->strUrlHashArgument, QMetaControlCreateType::CreateOnRecordNotFound);

			if (!$this->mctPhone->EditMode) {
				// Trying to create a NEW phone
				$this->mctPhone->Phone->Person = $this->objPerson;
				$this->btnSave->Text = 'Create';
			} else {
				// Ensure the Phone object belongs to the person
				if ($this->mctPhone->Phone->PersonId != $this->objPerson->Id) {
					return $this->ReturnTo('#contact');
				}
				$this->btnSave->Text = 'Update';

				$this->btnDelete = new QLinkButton($this);
				$this->btnDelete->Text = 'Delete';
				$this->btnDelete->CssClass = 'delete';
				if ($this->objPerson->PrimaryPhoneId == $this->mctPhone->Phone->Id) {
					$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction('You are about to delete the PRIMARY phone nubmer.  Are you SURE you want to permenantly DELETE this record?'));
				} else {
					$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction('Are you SURE you want to permenantly DELETE this record?'));
				}
				$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
				$this->btnDelete->AddAction(new QClickEvent(), new QTerminateAction());
			}

			// Create Controls
			$this->lstPhoneType = $this->mctPhone->lstPhoneType_Create();
			$this->lstPhoneType->AddAction(new QChangeEvent(), new QAjaxControlAction($this, 'lstPhoneType_Change'));
			$this->lstMobileProvider = $this->mctPhone->lstMobileProvider_Create(null, null, QQ::OrderBy(QQN::MobileProvider()->Name));
			$this->lstMobileProvider->HtmlAfter = '<br/><span class="na" style="font-size: 10px;">To allow Group SMS\'s to be sent to this Mobile, please specify the Mobile Provider used.<br/>Also be sure that this Mobile Phone is the person\'s <strong>PRIMARY</strong> phone contact.</span>';
			$this->lstPhoneType_Change();

			// Fixup "Phone Type"
			$this->lstPhoneType->RemoveItem(0);
			if (!$this->mctPhone->EditMode) $this->lstPhoneType->AddSelectOneOption();

			$this->txtNumber = $this->mctPhone->txtNumber_Create();
			$this->txtNumber->Required = true;
			$this->txtNumber->AddAction(new QEnterKeyEvent(), new QAjaxControlAction($this, 'btnSave_Click'));
			$this->txtNumber->AddAction(new QEnterKeyEvent(), new QTerminateAction());
			$this->txtNumber->CausesValidation = $this->btnSave->CausesValidation;
		}

		public function lstPhoneType_Change() {
			if ($this->lstPhoneType->SelectedValue == PhoneType::Mobile) {
				$this->lstMobileProvider->Visible = true;
			} else {
				$this->lstMobileProvider->Visible = false;
				$this->lstMobileProvider->SelectedValue = null;
			}
		}

		public function btnSave_Click() {
			$this->mctPhone->SavePhone();
			$this->objPerson->RefreshPrimaryContactInfo();
			QApplication::ExecuteJavaScript('document.location="#contact";');
		}

		public function btnCancel_Click() {
			QApplication::ExecuteJavaScript('document.location="#contact";');
		}
	
		public function btnDelete_Click() {
			$this->mctPhone->Phone->Delete();
			QApplication::ExecuteJavaScript('document.location="#contact";');
		}
	}
?>