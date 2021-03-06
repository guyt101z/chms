<?php
	require(dirname(__FILE__) . '/../../includes/prepend.inc.php');
	QApplication::Authenticate();

	class SearchIndividualsForm extends ChmsForm {
		protected $strPageTitle = 'Search Individuals';
		protected $intNavSectionId = ChmsForm::NavSectionPeople;

		protected $txtName;
		protected $txtFirstName;
		protected $txtLastName;
		protected $lstGender;
		protected $lstMemberStatus;
		protected $txtEmail;
		protected $txtPhone;
		protected $txtCity;

		protected $dtgPeople;

		protected function Form_Create() {
			$this->dtgPeople = new PersonDataGrid($this);
			$this->dtgPeople->Paginator = new QPaginator($this->dtgPeople);
			$this->dtgPeople->MetaAddColumn('FirstName','Html=<?=$_FORM->RenderFirstName($_ITEM); ?>', 'HtmlEntities=false', 'Width=150px');
			$this->dtgPeople->MetaAddColumn('LastName','Html=<?=$_FORM->RenderLastName($_ITEM); ?>', 'HtmlEntities=false', 'Width=150px');
			$this->dtgPeople->MetaAddColumn('Nickname', 'Width=100px', 'FontSize=11px');
			$this->dtgPeople->MetaAddTypeColumn('MembershipStatusTypeId', 'MembershipStatusType', 'Name=Membership', 'Width=110px', 'FontSize=11px');

			$this->dtgPeople->MetaAddColumn('PrimaryAddressText', 'Name=Address', 'Width=170px', 'FontSize=10px');
			$this->dtgPeople->MetaAddColumn('PrimaryCityText', 'Name=City', 'Width=120px', 'FontSize=10px');
			$this->dtgPeople->MetaAddColumn('PrimaryPhoneText', 'Name=Phone', 'Width=85px', 'FontSize=10px');
			$this->dtgPeople->SetDataBinder('dtgPeople_Bind');
			$this->dtgPeople->NoDataHtml = 'No results found.  Please use a less-restrictive filter.';
			
			$this->dtgPeople->SortColumnIndex = 1;
			$this->dtgPeople->ItemsPerPage = 20;

			$this->txtName = new QTextBox($this);
			$this->txtName->Name = 'Person\'s Name (including nicknames, mispellings, etc.)';
			$this->txtName->AddAction(new QChangeEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->txtName->AddAction(new QEnterKeyEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->txtName->AddAction(new QEnterKeyEvent(), new QTerminateAction());
			$this->txtName->Focus();

			$this->txtFirstName = new QTextBox($this);
			$this->txtFirstName->Name = 'First Name (Exact)';
			$this->txtFirstName->AddAction(new QChangeEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->txtFirstName->AddAction(new QEnterKeyEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->txtFirstName->AddAction(new QEnterKeyEvent(), new QTerminateAction());

			$this->txtLastName = new QTextBox($this);
			$this->txtLastName->Name = 'Last Name (Exact)';
			$this->txtLastName->AddAction(new QChangeEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->txtLastName->AddAction(new QEnterKeyEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->txtLastName->AddAction(new QEnterKeyEvent(), new QTerminateAction());

			$this->lstGender = new QListBox($this);
			$this->lstGender->Name = 'Gender';
			$this->lstGender->AddAction(new QChangeEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->lstGender->AddItem('- View All -');
			$this->lstGender->AddItem('Male', 'M');
			$this->lstGender->AddItem('Female', 'F');

			$this->lstMemberStatus = new QListBox($this);
			$this->lstMemberStatus->Name = 'Member Status';
			$this->lstMemberStatus->AddAction(new QChangeEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->lstMemberStatus->AddItem('- View All -');
			foreach (MembershipStatusType::$NameArray as $intId => $strMemberStatus) {
				$this->lstMemberStatus->AddItem($strMemberStatus, $intId);
			}

			$this->txtEmail = new QTextBox($this);
			$this->txtEmail->Name = 'Email';
			$this->txtEmail->AddAction(new QChangeEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->txtEmail->AddAction(new QEnterKeyEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->txtEmail->AddAction(new QEnterKeyEvent(), new QTerminateAction());
						
			$this->txtPhone = new QTextBox($this);
			$this->txtPhone->Name = 'Phone';
			$this->txtPhone->AddAction(new QChangeEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->txtPhone->AddAction(new QEnterKeyEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->txtPhone->AddAction(new QEnterKeyEvent(), new QTerminateAction());
						
			$this->txtCity = new QTextBox($this);
			$this->txtCity->Name = 'City';
			$this->txtCity->AddAction(new QChangeEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->txtCity->AddAction(new QEnterKeyEvent(), new QAjaxAction('dtgPeople_Refresh'));
			$this->txtCity->AddAction(new QEnterKeyEvent(), new QTerminateAction());
		}
		
		public function RenderFirstName(Person $objPerson) {
			if (!strlen(trim($objPerson->FirstName))) return '&nbsp;';
			return sprintf('<a href="%s">%s</a>', $objPerson->LinkUrl, QApplication::HtmlEntities($objPerson->FirstName));
		}
		
		public function RenderLastName(Person $objPerson) {
			if (!strlen(trim($objPerson->LastName))) return '&nbsp;';
			return sprintf('<a href="%s">%s</a>', $objPerson->LinkUrl, QApplication::HtmlEntities($objPerson->LastName));
		}

		protected function dtgPeople_Refresh() {
			$this->dtgPeople->PageNumber = 1;
			$this->dtgPeople->Refresh();
		}

		public function dtgPeople_Bind() {
			$objConditions = QQ::All();
			$objClauses = array();

			if ($strName = trim($this->txtName->Text)) {
				Person::PrepareQqForSearch($strName, $objConditions, $objClauses);
			}

			if ($strName = trim($this->txtFirstName->Text)) {
				$objConditions = QQ::AndCondition($objConditions,
					QQ::Like( QQN::Person()->FirstName, $strName . '%')
				);
			}

			if ($strName = trim($this->txtLastName->Text)) {
				$objConditions = QQ::AndCondition($objConditions,
					QQ::Like( QQN::Person()->LastName, $strName . '%')
				);
			}

			if ($strName = trim($this->txtCity->Text)) {
				$objConditions = QQ::AndCondition($objConditions,
					QQ::Like( QQN::Person()->PrimaryCityText, $strName . '%')
				);
			}
						
			if ($strName = trim($this->txtEmail->Text)) {
				$objConditions = QQ::AndCondition($objConditions,
					QQ::Like( QQN::Person()->PrimaryEmail->Address, $strName . '%')
				);
			}

			if ($strName = trim($this->txtPhone->Text)) {
				$strFormatted = sprintf("%s-%s-%s",substr($strName,0,3), substr($strName,3,3), substr($strName,6));
				$objClauses[] = QQ::Distinct();
				$objConditions = QQ::AndCondition($objConditions,
					QQ::OrCondition(
						QQ::Like( QQN::Person()->Phone->Number, $strName . '%'),
						QQ::Like( QQN::Person()->HouseholdParticipation->Household->Address->Phone->Number, $strName . '%'),
						QQ::Like( QQN::Person()->Phone->Number, $strFormatted . '%'),
						QQ::Like( QQN::Person()->HouseholdParticipation->Household->Address->Phone->Number, $strFormatted . '%')
					)
				);
			}
			
			if (!is_null($strValue = $this->lstGender->SelectedValue)) {
				$objConditions = QQ::AndCondition($objConditions,
					QQ::Equal( QQN::Person()->Gender, $strValue)
				);
			}

			if (!is_null($strValue = $this->lstMemberStatus->SelectedValue)) {
				$objConditions = QQ::AndCondition($objConditions,
					QQ::Equal( QQN::Person()->MembershipStatusTypeId, $strValue)
				);
			}

			$this->dtgPeople->MetaDataBinder($objConditions, $objClauses);
		}
	}

	SearchIndividualsForm::Run('SearchIndividualsForm');
?>