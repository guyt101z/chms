<?php
	require(dirname(__FILE__) . '/../../../includes/prepend.inc.php');
	QApplication::Authenticate(array(RoleType::ChMSAdministrator));

	class AdminUsersForm extends ChmsForm {
		protected $strPageTitle = 'Administration - Manage Users';
		protected $intNavSectionId = ChmsForm::NavSectionAdministration;

		protected $lstMinistry;
		protected $lstActiveFlag;
		protected $dtgStaff;

		protected $strIconArray = array(
			PermissionType::EditData => 'pencil.png',
			PermissionType::AccessConfidentialNotes => 'lock_open.png',
			PermissionType::AccessStewardship => 'money.png',
			PermissionType::MergeIndividuals => 'group_go.png',
			PermissionType::AddNewIndividual => 'user_add.png',
			PermissionType::EditMembershipStatus => 'vcard_edit.png',
			PermissionType::DeleteIndividual => 'user_delete.png',
			PermissionType::ManageClasses => 'book_open.png',
			PermissionType::ManageClassifieds => 'house.png',
			PermissionType::ManageOnlineAccounts => 'world.png',
			PermissionType::ManageSafariKids => 'award_star_gold_2.png'
		);

		protected function Form_Create() {
			$this->dtgStaff = new LoginDataGrid($this);
			$this->dtgStaff->FontSize = 11;
			$this->dtgStaff->AddColumn(new QDataGridColumn('View', '<?= $_FORM->RenderView($_ITEM); ?>', 'HtmlEntities=false', 'Width=30px'));
			$this->dtgStaff->MetaAddColumn(QQN::Login()->Username, 'Width=75px');
			$this->dtgStaff->MetaAddColumn(QQN::Login()->FirstName, 'Name=Name', 'Html=<?= $_ITEM->Name; ?>', 'Width=110px');
			$this->dtgStaff->AddColumn(new QDataGridColumn('Acct Disabled', '<?= (!$_ITEM->DomainActiveFlag || !$_ITEM->LoginActiveFlag) ? "Disabled":""; ?>', 'Width=60px'));
			$this->dtgStaff->MetaAddTypeColumn('RoleTypeId', 'RoleType', 'Name=Role', 'Width=120px');

			foreach (PermissionType::$NameArray as $intId => $strName) {
				$this->dtgStaff->AddColumn(new QDataGridColumn('<span style="font-size: 10px;">' . $strName . '</span>', '<?= $_FORM->RenderPermission(' . $intId . ', $_ITEM); ?>', 'Width=50px', 'HtmlEntities=false'));
			}

			$this->dtgStaff->SetDataBinder('dtgStaff_Bind');
			$this->dtgStaff->SortColumnIndex = 1;
			$this->dtgStaff->SortDirection = 0;
			
			$this->dtgStaff->Paginator = new QPaginator($this->dtgStaff);
			$this->dtgStaff->ItemsPerPage = 100;

			$this->lstActiveFlag = new QListBox($this);
			$this->lstActiveFlag->Name = 'Active';
			$this->lstActiveFlag->AddItem('Active', true, true);
			$this->lstActiveFlag->AddItem('Inactive', false);
			$this->lstActiveFlag->AddAction(new QChangeEvent(), new QAjaxAction('dtgStaff_Refresh'));
			
			$this->lstMinistry = new QListBox($this);
			$this->lstMinistry->Name = 'Ministry';
			$this->lstMinistry->AddItem('- View All -', null);
			foreach (Ministry::LoadAll(QQ::OrderBy(QQN::Ministry()->Name)) as $objMinistry) {
				$this->lstMinistry->AddItem($objMinistry->Name, $objMinistry->Id);
			}
			$this->lstMinistry->AddAction(new QChangeEvent(), new QAjaxAction('dtgStaff_Refresh'));
		}

		public function RenderView(Login $objLogin) {
			if (!$objLogin->DomainActiveFlag || !$objLogin->LoginActiveFlag) {
				$objStyle = new QDataGridRowStyle();
				if ($this->dtgStaff->CurrentRowIndex % 2)
					$objStyle->BackColor = '#fdd';
				else
					$objStyle->BackColor = '#fdd';
				$this->dtgStaff->OverrideRowStyle($this->dtgStaff->CurrentRowIndex, $objStyle);
			} else {
				$this->dtgStaff->OverrideRowStyle($this->dtgStaff->CurrentRowIndex, null);
			}

			return sprintf('<a href="/admin/users/edit.php/%s" title="View Details for %s"><img src="/assets/images/icons/magnifier.png"/></a>',
				$objLogin->Id, $objLogin->Name);
		}
	
		protected function dtgStaff_Refresh() {
			$this->dtgStaff->PageNumber = 1;
			$this->dtgStaff->Refresh();
		}
		
		public function RenderPermission($intPermissionId, Login $objLogin) {
			if ($objLogin->IsPermissionAllowed($intPermissionId)) return '<img src="/assets/images/icons/' . $this->strIconArray[$intPermissionId] .
				'" title="This user can ' . strtolower(PermissionType::$NameArray[$intPermissionId]) . '."/>';
		}
		
		public function dtgStaff_Bind() {
			$objConditions = QQ::All();

			if ($this->lstMinistry->SelectedValue) {
				$objConditions = QQ::AndCondition($objConditions,
					QQ::Equal( QQN::Login()->Ministry->MinistryId, $this->lstMinistry->SelectedValue )
				);
			}
			
			if ($this->lstActiveFlag->SelectedValue) {
				$objConditions = QQ::AndCondition($objConditions,
					QQ::Equal( QQN::Login()->DomainActiveFlag, true ),
					QQ::Equal( QQN::Login()->LoginActiveFlag, true )
				);
			} else {
				$objConditions = QQ::AndCondition($objConditions,
					QQ::OrCondition(
						QQ::Equal( QQN::Login()->DomainActiveFlag, false ),
						QQ::Equal( QQN::Login()->LoginActiveFlag, false )
					)
				);
			}

			$this->dtgStaff->TotalItemCount = Login::QueryCount($objConditions);

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgStaff->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgStaff->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be a Query result from Login, given the clauses above
			$this->dtgStaff->DataSource = Login::QueryArray($objConditions, $objClauses);
		}
	}

	AdminUsersForm::Run('AdminUsersForm');
?>