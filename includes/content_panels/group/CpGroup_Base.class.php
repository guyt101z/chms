<?php
	abstract class CpGroup_Base extends QPanel {
		/**
		 * @var Group
		 */
		public $objGroup;

		/**
		 * @var string
		 */
		public $strUrlHashArgument;

		/**
		 * @var QButton
		 */
		public $btnSave;

		/**
		 * @var QLinkButton
		 */
		public $btnCancel;

		// View-Related Controls

		/**
		 * @var PersonDataGrid
		 */
		public $dtgMembers;

		public $lblMinistry;
		public $lblType;
		public $lblConfidential;
		public $lblCategory;
		public $lblEmail;

		// Edit-Related Controls

		public $mctGroup;
		public $txtName;
		public $lstParentGroup;
		public $chkConfidentialFlag;
		public $lstMinistry;
		public $lstEmailBroadcastType;
		public $txtToken;

		public $objGroupArray;
		public $intGroupIdArray;

		public function __construct($objParentObject, $strControlId = null, Group $objGroup = null, $strUrlHashArgument) {
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			$this->strTemplate = dirname(__FILE__) . '/' . get_class($this) . '.tpl.php';
			$this->objGroup = $objGroup;
			$this->strUrlHashArgument = $strUrlHashArgument;

			$this->btnSave = new QButton($this);
			$this->btnSave->Text = 'Save';
			$this->btnSave->CssClass = 'primary';
			$this->btnSave->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnSave_Click'));
			$this->btnSave->CausesValidation = $this;

			$this->btnCancel = new QLinkButton($this);
			$this->btnCancel->Text = 'Cancel';
			$this->btnCancel->CssClass = 'cancel';
			$this->btnCancel->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCancel_Click'));
			$this->btnCancel->AddAction(new QClickEvent(), new QTerminateAction());

			$this->SetupPanel();
		}

		/**
		 * Basic setup of edit-related QControls for a Group to be used for all group types
		 * @return void
		 */
		protected function SetupEditControls() {
			$this->mctGroup = new GroupMetaControl($this, $this->objGroup);

			$this->txtName = $this->mctGroup->txtName_Create();
			$this->lstParentGroup = $this->mctGroup->lstParentGroup_Create();
			$this->lstEmailBroadcastType = $this->mctGroup->lstEmailBroadcastType_Create();
			$this->txtToken = $this->mctGroup->txtToken_Create();

			$this->chkConfidentialFlag = $this->mctGroup->chkConfidentialFlag_Create();
			$this->chkConfidentialFlag->Name = 'Confidential?';
			$this->chkConfidentialFlag->Text = 'Check if this group is considered a "Confidential" group';

			// Confidentiality not for Group Categories
			if ($this->mctGroup->Group->GroupTypeId == GroupType::GroupCategory) {
				$this->chkConfidentialFlag->Visible = false;
				$this->chkConfidentialFlag->Checked = false;
			}

			// Setup Ministry with Rules			
			if (QApplication::$Login->RoleTypeId == RoleType::ChMSAdministrator) {
				$this->lstMinistry = $this->mctGroup->lstMinistry_Create(null, null, QQ::OrderBy(QQN::Ministry()->Name));
			} else {
				$intMinistryIdArray = array();
				foreach (QApplication::$Login->GetMinistryArray() as $objMinistry) $intMinistryIdArray[] = $objMinistry->Id;

				$this->lstMinistry = $this->mctGroup->lstMinistry_Create(null, QQ::In(QQN::Ministry()->Id, $intMinistryIdArray), QQ::OrderBy(QQN::Ministry()->Name));
			}

			if ($this->mctGroup->EditMode) $this->lstMinistry->Enabled = false;

			// Setup EmailBroadcast-related controls
			$this->lstEmailBroadcastType->GetItem(0)->Name = '- None -';
			$this->lstEmailBroadcastType->AddAction(new QChangeEvent(), new QAjaxControlAction($this, 'txtToken_Refresh'));
			$this->txtToken_Refresh();
		}

		public function txtToken_Refresh() {
			if ($this->lstEmailBroadcastType->SelectedValue) { 
				$this->txtToken->Visible = true;
				$this->txtToken->Required = true;
				$this->txtToken->Text = $this->mctGroup->Group->Token;
			} else {
				$this->txtToken->Visible = false;
				$this->txtToken->Required = false;
				$this->txtToken->Text = null;
			}
		}

		/**
		 * Basic setup of view-related QControls for a Group to be used for all group types
		 * @param boolean $blnDisplayEditParticipantColumn
		 * @param boolean $blnDisplayGroupsColumn
		 * @return void
		 */
		protected function SetupViewControls($blnDisplayEditParticipantColumn, $blnDisplayGroupsColumn) {
			$this->lblMinistry = new QLabel($this);
			$this->lblMinistry->Name = 'Ministry';
			$this->lblMinistry_Refresh();

			$this->lblType = new QLabel($this);
			$this->lblType->Name = 'Group Type';
			$this->lblType_Refresh();

			$this->lblEmail = new QLabel($this);
			$this->lblEmail->Name = 'Email';
			$this->lblEmail_Refresh();
			$this->lblEmail->HtmlEntities = false;

			$this->lblConfidential = new QLabel($this);
			$this->lblConfidential->Name = 'Confidential?';
			$this->lblConfidential->HtmlEntities = false;
			$this->lblConfidential->Text = '<img src="/assets/images/confidential.png"/>';
			$this->lblConfidential_Refresh();

			$this->lblCategory = new QLabel($this);
			$this->lblCategory->Name = 'Parent Category';
			$this->lblCategory->HtmlEntities = false;
			$this->lblCategory_Refresh();

			$this->dtgMembers = new PersonDataGrid($this);
			$this->dtgMembers->Paginator = new QPaginator($this->dtgMembers);
			$this->dtgMembers->ItemsPerPage = 80;
			if ($blnDisplayEditParticipantColumn)
				$this->dtgMembers->AddColumn(new QDataGridColumn('Edit', '<?= $_CONTROL->ParentControl->RenderEdit($_ITEM); ?>', 'HtmlEntities=false', 'Width=40px'));
			$this->dtgMembers->MetaAddColumn('FirstName', 'Html=<?= $_CONTROL->ParentControl->RenderFirstName($_ITEM); ?>', 'HtmlEntities=false', 'Width=120px');
			$this->dtgMembers->MetaAddColumn('LastName', 'Html=<?= $_CONTROL->ParentControl->RenderLastName($_ITEM); ?>', 'HtmlEntities=false', 'Width=120px');
			$this->dtgMembers->MetaAddColumn(QQN::Person()->PrimaryEmail->Address, 'Name=Email', 'Width=180px');
			$this->dtgMembers->MetaAddColumn('MembershipStatusTypeId', 'Name=ALCF Member?', 'Html=<?= $_CONTROL->ParentControl->RenderMember($_ITEM); ?>', 'Width=60px');
			if ($blnDisplayGroupsColumn) {
				$this->dtgMembers->AddColumn(new QDataGridColumn('Group(s)', '<?= $_CONTROL->ParentControl->RenderCurrentGroups($_ITEM); ?>', 'HtmlEntities=false', 'Width=80px'));
				$this->dtgMembers->AddColumn(new QDataGridColumn('Role(s)', '<?= $_CONTROL->ParentControl->RenderCurrentRolesForAllGroups($_ITEM); ?>', 'HtmlEntities=false', 'Width=80px'));
			} else {
				$this->dtgMembers->AddColumn(new QDataGridColumn('Role(s)', '<?= $_CONTROL->ParentControl->RenderCurrentRoles($_ITEM); ?>', 'HtmlEntities=false', 'Width=180px'));
			}
		}

		public function RenderEdit(Person $objPerson) {
			return sprintf('<a href="#%s/edit_participation/%s">Edit</a>', $this->objGroup->Id, $objPerson->Id);
		}

		public function RenderFirstName(Person $objPerson) {
			return sprintf('<a href="/individuals/view.php/%s#general">%s</a>', $objPerson->Id, QApplication::HtmlEntities($objPerson->FirstName));
		}
		
		public function RenderLastName(Person $objPerson) {
			return sprintf('<a href="/individuals/view.php/%s#general">%s</a>', $objPerson->Id, QApplication::HtmlEntities($objPerson->LastName));
		}

		public function RenderMember(Person $objPerson) {
			switch ($objPerson->MembershipStatusTypeId) {
				case MembershipStatusType::Member:
				case MembershipStatusType::ChildOfMember:
					return 'Y';
				default:
					return 'N';
			}
		}

		public function RenderCurrentRoles(Person $objPerson) {
			$objParticipations = GroupParticipation::LoadArrayByPersonIdGroupId($objPerson->Id, $this->objGroup->Id, array(
				QQ::OrderBy(QQN::GroupParticipation()->GroupRole->Name),
				QQ::Expand(QQN::GroupParticipation()->GroupRole->Name)));

			$strArray = array();
			foreach ($objParticipations as $objParticipation)
				if (!$objParticipation->DateEnd) $strArray[] = $objParticipation->GroupRole->Name;

			if (count($strArray))
				return implode(' and ', $strArray);
			else
				return '<span style="font-size: 10px; color: #999;">No current roles</span>';
		}

		protected $objParticipations;
		public function RenderCurrentRolesForAllGroups(Person $objPerson) {
			// Assume we have a cached copy for THIS row already
			$strArray = array();
			foreach ($this->objParticipations as $objParticipation)
				$strArray[] = $objParticipation->GroupRole->Name;

			if (count($strArray))
				return implode(' and ', $strArray);
			else
				return '<span style="font-size: 10px; color: #999;">No current roles</span>';
		}

		public function RenderCurrentGroups(Person $objPerson) {
			$this->objParticipations = GroupParticipation::QueryArray(QQ::AndCondition(
				QQ::Equal(QQN::GroupParticipation()->PersonId, $objPerson->Id),
				QQ::IsNull(QQN::GroupParticipation()->DateEnd),
				QQ::In(QQN::GroupParticipation()->GroupId, $this->intGroupIdArray)
			), QQ::Clause(
				QQ::OrderBy(QQN::GroupParticipation()->Group->Name),
				QQ::Expand(QQN::GroupParticipation()->Group->Name)));

			$strArray = array();
			foreach ($this->objParticipations as $objParticipation)
				$strArray[] = $objParticipation->Group->Name;

			if (count($strArray))
				return implode(' and ', $strArray);
			else
				return '<span style="font-size: 10px; color: #999;">No current groups</span>';
		}

		/**
		 * Make sure the caller of this method is also a "return" call to cease processing within that given method.
		 * This will safely redirect the user back to whatever URL is being requested, even if it's a HASH.
		 * @param string $strUrl
		 * @return null
		 */
		public function ReturnTo($strUrl) {
			$this->strTemplate = null;
			QApplication::ExecuteJavaScript('document.location = "' . $strUrl . '";');
			return null;
		}

		public function lblMinistry_Refresh() {
			$this->lblMinistry->Text = $this->objGroup->Ministry->Name;
		}

		public function lblType_Refresh() {
			$this->lblType->Text = GroupType::$NameArray[$this->objGroup->GroupTypeId];
		}

		public function lblEmail_Refresh() {
			$this->lblEmail->Text = $this->objGroup->EmailTypeHtml;
		}

		public function lblConfidential_Refresh() {
			$this->lblConfidential->Visible = $this->objGroup->ConfidentialFlag;
		}

		public function lblCategory_Refresh() {
			$strAncestryArray = $this->objGroup->GetGroupNameHierarchyArray();

			if (count($strAncestryArray)) {
				$this->lblCategory->Text = QApplication::HtmlEntities(implode(' > ', $strAncestryArray));
			} else {
				$this->lblCategory->Text = '<span style="font-size: 10px; color: #666;">Top Level Group</span>';
			}
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			return $this->ReturnTo('#' . $this->objGroup->Id);
		}

		abstract protected function SetupPanel();

		public function Validate() {
			$blnToReturn = parent::Validate();

			if ($this->txtToken && $this->txtToken->Visible) {
				$strToken = trim(strtolower($this->txtToken->Text));
				if ($strToken && ($objGroup = Group::LoadByToken($strToken)) && ($objGroup->Id != $this->objGroup->Id)) {
					$this->txtToken->Warning = 'Email name is already taken';
					$blnToReturn = false;
				}
			}

			return $blnToReturn;
		}
	}
?>