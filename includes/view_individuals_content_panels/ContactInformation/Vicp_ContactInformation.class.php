<?php
	class Vicp_ContactInformation extends Vicp_Base {
		public $dtgPersonalAddresses;
		public $dtgHomeAddresses;
		public $dtgPhones;
		public $dtgEmails;
		public $dtgOthers;
		public $txtCoprimary;
				
		protected $pxySetCurrentHomeAddress;
		protected $pxySetPrimaryPhone;
		protected $pxySetPrimaryEmail;
		
		protected function SetupPanel() {
			$this->dtgPersonalAddresses = new QDataGrid($this);
			$this->dtgPersonalAddresses->AddColumn(new QDataGridColumn('Type', '<?= $_CONTROL->ParentControl->RenderPersonalAddressType($_ITEM); ?>', 'HtmlEntities=false', 'Width=150px'));
			$this->dtgPersonalAddresses->AddColumn(new QDataGridColumn('Address', '<?= $_CONTROL->ParentControl->RenderPersonalAddress($_ITEM); ?>', 'HtmlEntities=false', 'Width=280px'));
			$this->dtgPersonalAddresses->AddColumn(new QDataGridColumn('City, State', '<?= $_ITEM->City . ", " . $_ITEM->State; ?>', 'Width=150px'));
			$this->dtgPersonalAddresses->AddColumn(new QDataGridColumn('Zip', '<?= $_ITEM->ZipCode; ?>', 'Width=80px'));
			$this->dtgPersonalAddresses->AddColumn(new QDataGridColumn('', '<?= $_ITEM->InvalidFlag ? "<img src=\\"/assets/images/marker_invalid.png\\" title=\\"Invalid Address\\"/>" : null; ?>', 'Width=55px', 'HtmlEntities=false'));
			$this->dtgPersonalAddresses->SetDataBinder('dtgPersonalAddresses_Bind', $this);

			$this->dtgHomeAddresses = new QDataGrid($this);
			$this->dtgHomeAddresses->AddColumn(new QDataGridColumn('', '<?= $_CONTROL->ParentControl->RenderHomeAddressType($_ITEM); ?>', 'HtmlEntities=false', 'Width=60px'));
			$this->dtgHomeAddresses->AddColumn(new QDataGridColumn('Address', '<?= $_CONTROL->ParentControl->RenderHomeAddress($_ITEM); ?>', 'HtmlEntities=false', 'Width=235px'));
			$this->dtgHomeAddresses->AddColumn(new QDataGridColumn('City, State', '<?= $_ITEM->City . ", " . $_ITEM->State; ?>', 'Width=160px'));
			$this->dtgHomeAddresses->AddColumn(new QDataGridColumn('Zip', '<?= $_ITEM->ZipCode; ?>', 'Width=90px'));
			$this->dtgHomeAddresses->AddColumn(new QDataGridColumn('Phone', '<?= $_CONTROL->ParentControl->RenderHomePhone($_ITEM); ?>', 'Width=105px'));
			$this->dtgHomeAddresses->AddColumn(new QDataGridColumn('', '<?= $_ITEM->InvalidFlag ? "<img src=\\"/assets/images/marker_invalid.png\\" title=\\"Invalid Address\\"/>" : null; ?>', 'Width=54px', 'HtmlEntities=false'));
			$this->dtgHomeAddresses->SetDataBinder('dtgHomeAddresses_Bind', $this);

			$this->pxySetCurrentHomeAddress = new QControlProxy($this);
			$this->pxySetCurrentHomeAddress->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'pxySetCurrentHomeAddress_Click'));
			$this->pxySetCurrentHomeAddress->AddAction(new QClickEvent(), new QTerminateAction());

			$this->dtgPhones = new QDataGrid($this);
			$this->dtgPhones->AddColumn(new QDataGridColumn('Primary?', '<?= $_CONTROL->ParentControl->RenderPhonePrimary($_ITEM); ?>', 'HtmlEntities=false', 'Width=80px'));
			$this->dtgPhones->AddColumn(new QDataGridColumn('Type', '<?= $_CONTROL->ParentControl->RenderPhoneType($_ITEM); ?>', 'HtmlEntities=false', 'Width=80px'));
			$this->dtgPhones->AddColumn(new QDataGridColumn('Number', '<?= $_CONTROL->ParentControl->RenderPhoneNumber($_ITEM); ?>', 'HtmlEntities=false', 'Width=170px'));
			$this->dtgPhones->SetDataBinder('dtgPhones_Bind', $this);

			$this->pxySetPrimaryPhone = new QControlProxy($this);
			$this->pxySetPrimaryPhone->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'pxySetPrimaryPhone_Click'));
			$this->pxySetPrimaryPhone->AddAction(new QClickEvent(), new QTerminateAction());
			
			$this->dtgEmails = new QDataGrid($this);
			$this->dtgEmails->AddColumn(new QDataGridColumn('Primary?', '<?= $_CONTROL->ParentControl->RenderEmailPrimary($_ITEM); ?>', 'HtmlEntities=false', 'Width=80px'));
			$this->dtgEmails->AddColumn(new QDataGridColumn('Email', '<?= $_CONTROL->ParentControl->RenderEmailAddress($_ITEM); ?>', 'HtmlEntities=false', 'Width=260px'));
			$this->dtgEmails->SetDataBinder('dtgEmails_Bind', $this);

			$this->pxySetPrimaryEmail = new QControlProxy($this);
			$this->pxySetPrimaryEmail->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'pxySetPrimaryEmail_Click'));
			$this->pxySetPrimaryEmail->AddAction(new QClickEvent(), new QTerminateAction());

			$this->dtgOthers = new QDataGrid($this);
			$this->dtgOthers->AddColumn(new QDataGridColumn('Type', '<?= $_CONTROL->ParentControl->RenderOtherType($_ITEM); ?>', 'HtmlEntities=false', 'Width=200px'));
			$this->dtgOthers->AddColumn(new QDataGridColumn('Value', '<?= $_CONTROL->ParentControl->RenderOtherValue($_ITEM); ?>', 'HtmlEntities=false', 'Width=550px'));
			$this->dtgOthers->SetDataBinder('dtgOthers_Bind', $this);
			
			$this->txtCoprimary = new QLabel($this);
			$this->txtCoprimary->HtmlEntities = false;
		
			if($this->objPerson->CoPrimary) {
				$objCoPrimary = Person::Load($this->objPerson->CoPrimary);
				if($objCoPrimary)
					$this->txtCoprimary->Text = sprintf("<a href='/individuals/view.php/%d#general'>%s %s</a>",$objCoPrimary->Id, $objCoPrimary->FirstName,$objCoPrimary->LastName);
				else 
					$this->txtCoprimary->Text = '';
			} else {
				$this->txtCoprimary->Text = '';
			}
		}
		

		public function dtgPhones_Bind() {
			$this->dtgPhones->DataSource = $this->objPerson->GetAllAssociatedPhoneArray($this->objForm->objHousehold);
		}
		
		public function dtgEmails_Bind() {
			$this->dtgEmails->DataSource = $this->objPerson->GetEmailArray();
		}
		
		public function dtgOthers_Bind() {
			$this->dtgOthers->DataSource = $this->objPerson->GetOtherContactInfoArray();
		}
		
		public function RenderEmailPrimary(Email $objEmail) {
			if ($objEmail->Id == $this->objPerson->PrimaryEmailId) {
				return '<img src="/assets/images/marker_primary.png" title="Primary Email"/>';
			} else {
				return sprintf('<a href="" class="set" %s>set</a>', $this->pxySetPrimaryEmail->RenderAsEvents($objEmail->Id, false));
			}
		}

		public function RenderEmailAddress(Email $objEmail) {
			if ($this->objPerson->IsLoginCanEditEmailAddress(QApplication::$Login))
				return sprintf('<a href="#contact/edit_email/%s">%s</a>', $objEmail->Id, QApplication::HtmlEntities($objEmail->Address));
			else
				return QApplication::HtmlEntities($objEmail->Address);
		}

		public function RenderOtherType(OtherContactInfo $objOther) {
			return sprintf('<a href="#contact/edit_other/%s">%s</a>', $objOther->Id, QApplication::HtmlEntities($objOther->OtherContactMethod->Name));
		}

		public function RenderOtherValue(OtherContactInfo $objOther) {
			return sprintf('<a href="#contact/edit_email/%s">%s</a>', $objOther->Id, QApplication::HtmlEntities($objOther->Value));
		}

		public function RenderPhonePrimary(Phone $objPhone) {
			if ($objPhone->Id == $this->objPerson->PrimaryPhoneId) {
				return '<img src="/assets/images/marker_primary.png" title="Primary Phone"/>';
			} else {
				return sprintf('<a href="#" class="set" %s>set</a>', $this->pxySetPrimaryPhone->RenderAsEvents($objPhone->Id, false));
			}
		}

		public function RenderPhoneNumber(Phone $objPhone) {
			if ($objPhone->Address)
				return $objPhone->Number;
			else if ($objPhone->IsSmsEnabled()) {
				return sprintf('<a href="#contact/edit_phone/%s">%s</a><br/><span class="na" style="font-size: 10px;">SMS Enabled: %s</span>', $objPhone->Id, $objPhone->Number, QApplication::HtmlEntities($objPhone->MobileProvider->Name));
			} else {
				return sprintf('<a href="#contact/edit_phone/%s">%s</a>', $objPhone->Id, $objPhone->Number);
			}
		}
		
		public function RenderPhoneType(Phone $objPhone) {
			if ($objPhone->Address)
				return PhoneType::$NameArray[$objPhone->PhoneTypeId];
			else
				return sprintf('<a href="#contact/edit_phone/%s">%s</a>', $objPhone->Id, PhoneType::$NameArray[$objPhone->PhoneTypeId]);
		}

		public function pxySetPrimaryPhone_Click($strFormId, $strControlId, $strParameter) {
			// Get and validate Phone object
			$objPhone = Phone::Load($strParameter);
			$objPhone->SetAsPrimary($this->objPerson);
			$this->dtgPhones->Refresh();
		}
		
		public function pxySetPrimaryEmail_Click($strFormId, $strControlId, $strParameter) {
			// Get and validate Email object
			$objEmail= Email::Load($strParameter);
			$objEmail->SetAsPrimary();
			$this->objPerson->Reload();
			$this->dtgEmails->Refresh();
		}
		
		public function pxySetCurrentHomeAddress_Click($strFormId, $strControlId, $strParameter) {
			// Get and validate Address object
			$objAddress = Address::Load($strParameter);
			if (!$objAddress) return;
			if ($objAddress->HouseholdId != $this->objForm->objHousehold->Id) return;

			$this->objForm->objHousehold->SetAsCurrentAddress($objAddress);
			$this->objForm->objPerson = Person::Load($this->objForm->objPerson->Id);
			$this->objPerson = $this->objForm->objPerson;
			$this->Refresh();
		}

		public function dtgPersonalAddresses_Bind() {
			$this->dtgPersonalAddresses->DataSource = $this->objPerson->GetAddressArray(QQ::OrderBy(QQN::Address()->CurrentFlag, false, QQN::Address()->AddressTypeId));
		}

		public function dtgHomeAddresses_Bind() {
			$this->dtgHomeAddresses->DataSource = $this->objForm->objHousehold->GetAddressArray(QQ::OrderBy(QQN::Address()->CurrentFlag, false, QQN::Address()->AddressTypeId));
		}

		public function RenderHomePhone(Address $objAddress) {
			if ($objAddress->PrimaryPhone) return $objAddress->PrimaryPhone->Number;
		}

		public function RenderHomeAddressType(Address $objAddress) {
			if (!$objAddress->CurrentFlag) {
				$objStyle = new QDataGridRowStyle();
				$objStyle->CssClass = 'previous';
				$this->dtgHomeAddresses->OverrideRowStyle($this->dtgHomeAddresses->CurrentRowIndex, $objStyle);
			} else if ($objAddress->InvalidFlag) {
				$objStyle = new QDataGridRowStyle();
				$objStyle->CssClass = 'invalid';
				$this->dtgHomeAddresses->OverrideRowStyle($this->dtgHomeAddresses->CurrentRowIndex, $objStyle);
			} else {
				$objStyle = new QDataGridRowStyle();
				$objStyle->FontBold = true;
				$this->dtgHomeAddresses->OverrideRowStyle($this->dtgHomeAddresses->CurrentRowIndex, $objStyle);
			}

			if ($objAddress->CurrentFlag) {
				return '<img src="/assets/images/marker_current.png" title="Current Home Address"/>';
			} else if (!$objAddress->InvalidFlag) {
				return sprintf('<a href="#" class="set" %s>set</a>', $this->pxySetCurrentHomeAddress->RenderAsEvents($objAddress->Id, false));
			}
		}

		public function RenderPersonalAddressType(Address $objAddress) {
			if (!$objAddress->CurrentFlag) {
				$objStyle = new QDataGridRowStyle();
				$objStyle->CssClass = 'previous';
				$this->dtgPersonalAddresses->OverrideRowStyle($this->dtgPersonalAddresses->CurrentRowIndex, $objStyle);
			} else if ($objAddress->InvalidFlag) {
				$objStyle = new QDataGridRowStyle();
				$objStyle->CssClass = 'invalid';
				$this->dtgPersonalAddresses->OverrideRowStyle($this->dtgPersonalAddresses->CurrentRowIndex, $objStyle);
			} else {
				$objStyle = new QDataGridRowStyle();
				$objStyle->FontBold = true;
				$this->dtgPersonalAddresses->OverrideRowStyle($this->dtgPersonalAddresses->CurrentRowIndex, $objStyle);
			}

			switch ($objAddress->AddressTypeId) {
				case AddressType::Temporary:
					$strToReturn = AddressType::$NameArray[$objAddress->AddressTypeId];
					break;
				default:
					$strToReturn = ($objAddress->CurrentFlag) ? 'Current ' : 'Previous ';
					$strToReturn .= AddressType::$NameArray[$objAddress->AddressTypeId];
					break;
			}

			if (($objAddress->AddressTypeId == AddressType::Temporary) && ($objAddress->DateUntilWhen)) {
				$strToReturn .= '<br/><span class="subtext">' . 'until ' . $objAddress->DateUntilWhen->__toString('MMM D YYYY') . '</span>';
			}

			return $strToReturn;
		}

		public function RenderHomeAddress(Address $objAddress) {
			$strToReturn = $objAddress->Address1;
			if ($objAddress->Address2) $strToReturn .= ', ' . $objAddress->Address2;
			if ($objAddress->Address3) $strToReturn .= ', ' . $objAddress->Address3;
			return sprintf('<a href="#contact/edit_home_address/%s">%s</a>', $objAddress->Id, QApplication::HtmlEntities($strToReturn));
		}

		public function RenderPersonalAddress(Address $objAddress) {
			$strToReturn = $objAddress->Address1;
			if ($objAddress->Address2) $strToReturn .= ', ' . $objAddress->Address2;
			if ($objAddress->Address3) $strToReturn .= ', ' . $objAddress->Address3;
			return sprintf('<a href="#contact/edit_address/%s">%s</a>', $objAddress->Id, QApplication::HtmlEntities($strToReturn));
		}
	}
?>