<?php
	class EditGroupParticipationDelegate extends QBaseClass {
		protected $pnlContent;
		protected $strReturnUrl;

		public $lblCurrentRoles;
		public $btnAddNewRole;
		public $dtgParticipations;

		public $pxyEdit;

		public $dlgEdit;
		public $lstEditRole;
		public $dtxEditStart;
		public $calEditStart;
		public $dtxEditEnd;
		public $calEditEnd;
		public $btnEditOkay;
		public $btnEditCancel;
		public $btnEditDelete;
		public $chkIsAuthorizedSender;

		public $objParticipationArray;
		protected $intEditParticipationIndex;
		protected $strRole;

		public function __construct(QPanel $pnlContent, $strReturnUrl) {
			$this->pnlContent = $pnlContent;
			$this->pnlContent->Template = dirname(__FILE__) . '/EditGroupParticipationDelegate.tpl.php';

			// Throw Exception if Group Cannot have Explicitly Defined Participants
			if (!$this->pnlContent->objGroup->IsGroupCanHaveExplicitlyDefinedParticipants())
				throw new Exception('Group Cannot have Explicitly Defined Participants');

			$this->strReturnUrl = $strReturnUrl;

			$this->objParticipationArray = GroupParticipation::LoadArrayByPersonIdGroupId(
				$this->pnlContent->objPerson->Id, $this->pnlContent->objGroup->Id,
				QQ::OrderBy(QQN::GroupParticipation()->GroupRole->Name, QQN::GroupParticipation()->DateStart),
				QQ::Clause(QQ::Expand(QQN::GroupParticipation()->GroupRole))
			);
			
			$this->chkIsAuthorizedSender = new QCheckBox($this->pnlContent);
			$this->chkIsAuthorizedSender->Name = '  Is Authorized Sender';

			if (GroupAuthorizedSender::LoadByGroupIdPersonId($this->pnlContent->objGroup->Id, $this->pnlContent->objPerson->Id)) {
				$this->chkIsAuthorizedSender->Checked = true;
			} else {
				$this->chkIsAuthorizedSender->Checked = false;
			}
			
			$this->lblCurrentRoles = new QLabel($this->pnlContent);
			$this->lblCurrentRoles->Name = 'Current Roles';
			$this->lblCurrentRoles->HtmlEntities = false;
			$this->lblCurrentRoles_Refresh();

			$this->dtgParticipations = new QDataGrid($this->pnlContent);
			$this->dtgParticipations->AddColumn(new QDataGridColumn('Role', '<?= $_CONTROL->ParentControl->objDelegate->RenderRole($_ITEM); ?>', 'HtmlEntities=false', 'Width=100px'));
			$this->dtgParticipations->AddColumn(new QDataGridColumn('Participation Started', '<?= $_CONTROL->ParentControl->objDelegate->RenderDateStart($_ITEM); ?>', 'HtmlEntities=false', 'Width=150px'));
			$this->dtgParticipations->AddColumn(new QDataGridColumn('Participation Ended', '<?= $_CONTROL->ParentControl->objDelegate->RenderDateEnd($_ITEM); ?>', 'HtmlEntities=false', 'Width=150px'));
			
			$this->dtgParticipations->SetDataBinder('dtgParticipations_Bind', $this);

			$this->pxyEdit = new QControlProxy($this->pnlContent);
			$this->pxyEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this->pnlContent, 'pxyEdit_Click'));
			$this->pxyEdit->AddAction(new QClickEvent(), new QTerminateAction());
			
			$this->dlgEdit_Setup();
		}
		
		public function dlgEdit_Setup() {
			$this->dlgEdit = new QDialogBox($this->pnlContent);
			$this->dlgEdit->Template = dirname(__FILE__) . '/EditGroupParticipationDialog.tpl.php';
			$this->dlgEdit->CssClass = 'dialogbox';
			$this->dlgEdit->MatteClickable = false;
			$this->dlgEdit->HideDialogBox();

			$this->lstEditRole = new QListBox($this->dlgEdit);
			$this->lstEditRole->Name = 'Role';
			$this->lstEditRole->Required = true;
			$this->lstEditRole->Enabled = true;
						
			$this->lstEditRole->AddItem('- Select One -');
			foreach ($this->pnlContent->objGroup->Ministry->GetGroupRoleArray(QQ::OrderBy(QQN::GroupRole()->Name)) as $objGroupRole){			
					$this->lstEditRole->AddItem($objGroupRole->Name, $objGroupRole->Id);
			}
			$this->dtxEditStart = new QDateTimeTextBox($this->dlgEdit);
			$this->dtxEditStart->Name = 'Started';
			$this->dtxEditStart->Required = true;
			$this->calEditStart = new QCalendar($this->dlgEdit, $this->dtxEditStart);

			$this->dtxEditEnd = new QDateTimeTextBox($this->dlgEdit);
			$this->dtxEditEnd->Name = 'Ended';
			$this->calEditEnd = new QCalendar($this->dlgEdit, $this->dtxEditEnd);
			
			$this->dtxEditStart->RemoveAllActions(QClickEvent::EventName);
			$this->dtxEditEnd->RemoveAllActions(QClickEvent::EventName);

			$this->btnEditOkay = new QButton($this->dlgEdit);
			$this->btnEditOkay->Text = 'Ok';
			$this->btnEditOkay->CausesValidation = QCausesValidation::SiblingsAndChildren;
			$this->btnEditOkay->AddAction(new QClickEvent(), new QAjaxControlAction($this->pnlContent, 'btnEditOkay_Click'));
			$this->btnEditOkay->AddAction(new QClickEvent(), new QTerminateAction());

			$this->btnEditCancel = new QLinkButton($this->dlgEdit);
			$this->btnEditCancel->Text = 'Cancel';
			$this->btnEditCancel->AddAction(new QClickEvent(), new QAjaxControlAction($this->pnlContent, 'btnEditCancel_Click'));
			$this->btnEditCancel->AddAction(new QClickEvent(), new QTerminateAction());

			$this->btnEditDelete = new QLinkButton($this->dlgEdit);
			$this->btnEditDelete->Text = 'Delete';
			$this->btnEditDelete->SetCustomStyle('margin-left', '0');
			$this->btnEditDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this->pnlContent, 'btnEditDelete_Click'));
			$this->btnEditDelete->AddAction(new QClickEvent(), new QTerminateAction());
		}

		public function DisplayGroupName() {
			$objGroup = $this->pnlContent->objGroup;
			$strAncestryArray = $objGroup->GetGroupNameHierarchyArray();

			if (count($strAncestryArray)) {
				return sprintf('%s &gt; <strong>%s</strong>',
					QApplication::HtmlEntities(implode(' > ', $strAncestryArray)),
					QApplication::HtmlEntities($objGroup->Name));
			} else {
				return QApplication::HtmlEntities($objGroup->Name);
			}
		}

		protected function lblCurrentRoles_Refresh() {
			$strRoleArray = array();
			foreach($this->objParticipationArray as $objParticipation)
				if (!$objParticipation->DateEnd) $strRoleArray[] = QApplication::HtmlEntities($objParticipation->GroupRole->Name);
			
			if (count($strRoleArray)) {
				$this->lblCurrentRoles->Text = implode('<br/>', $strRoleArray);
				$this->strRole = $strRoleArray[0];
			} else
				$this->lblCurrentRoles->Text = '<span style="color: #666;">None</span>';
		}
		
		public function RenderRole(GroupParticipation $objParticipation) {
			if($objParticipation->GroupRole != null) {
				if ($this->strRole != $objParticipation->GroupRole->Name) {
					$this->strRole = $objParticipation->GroupRole->Name;
					return $this->strRole;
				} else {
					return null;
				}
			} else 
				return null;
		}

		public function RenderDateStart(GroupParticipation $objParticipation) {
			return sprintf('<a href="" %s>%s</a>',
				$this->pxyEdit->RenderAsEvents($this->dtgParticipations->CurrentRowIndex, false),
				$objParticipation->DateStart->__toString('MMM D, YYYY'));
		}

		public function RenderDateEnd(GroupParticipation $objParticipation) {
			if ($objParticipation->DateEnd)
				$strValue = $objParticipation->DateEnd->__toString('MMM D, YYYY');
			else
				$strValue = 'Enter a Date';
			return sprintf('<a href="" %s>%s</a>', $this->pxyEdit->RenderAsEvents($this->dtgParticipations->CurrentRowIndex . '_', false), $strValue);
		}

		public function dtgParticipations_Bind() {
			$this->strRole = null;
			$this->dtgParticipations->DataSource = $this->objParticipationArray;
		}
				
		public function pxyEdit_Click($strFormId, $strControlId, $strParameter) {
			$this->dlgEdit->ShowDialogBox();
			$this->lstEditRole->ValidationReset();
			$this->dtxEditStart->ValidationReset();
			$this->dtxEditEnd->ValidationReset();
			
			if (strlen($strParameter)) {
				$this->intEditParticipationIndex = intval($strParameter);
				$objParticipation = $this->objParticipationArray[$this->intEditParticipationIndex];

				$this->lstEditRole->SelectedValue = $objParticipation->GroupRoleId;
				$this->dtxEditEnd->Text = ($objParticipation->DateEnd) ? $objParticipation->DateEnd->__toString() : null;
				$this->dtxEditStart->Text = ($objParticipation->DateStart) ? $objParticipation->DateStart->__toString() : null;

				$this->lstEditRole->Enabled = true;
				$this->btnEditCancel->Visible = false;
				$this->btnEditDelete->Visible = true;
				
				if (strpos($strParameter, '_') !== false) {
					$this->dtxEditEnd->Focus();
				} else {
					$this->dtxEditStart->Focus();
				}
			} else {
				$this->intEditParticipationIndex = null;

				$this->lstEditRole->SelectedValue = null;
				$this->dtxEditEnd->Text = null;
				$this->dtxEditStart->Text = null;

				$this->lstEditRole->Enabled = true;
				$this->btnEditCancel->Visible = true;
				$this->btnEditDelete->Visible = false;
				
				$this->lstEditRole->Focus();
			}
		}

		public function btnEditOkay_Click($strFormId, $strControlId, $strParameter) {
			// Validate Date Range
			$dttDateRangeArray = array();
			foreach ($this->objParticipationArray as $intIndex => $objParticipation) {
				if ((!($intIndex === $this->intEditParticipationIndex)) &&
					($objParticipation->GroupRoleId == $this->lstEditRole->SelectedValue)) {
					$dttDateRangeArray[] = array($objParticipation->DateStart, $objParticipation->DateEnd);
				}
			}
			
			$dttDateRangeArray[] = array($this->dtxEditStart->DateTime, $this->dtxEditEnd->DateTime);
			usort($dttDateRangeArray, array($this, 'dttDateRangeArray_Sort'));
			if (!GroupParticipation::IsValidDates($dttDateRangeArray)) {
				$this->dtxEditStart->Warning = 'Invalid Dates';
				return;
			}

			if (!is_null($this->intEditParticipationIndex)) {
				$objParticipation = $this->objParticipationArray[$this->intEditParticipationIndex];
				$objParticipation->GroupRoleId = $this->lstEditRole->SelectedValue;
				$objParticipation->Group = $this->pnlContent->objGroup;
				$objParticipation->DateStart = $this->dtxEditStart->DateTime;
				$objParticipation->DateEnd = $this->dtxEditEnd->DateTime;	
			} else {
				$objParticipation = new GroupParticipation();
				$objParticipation->Person = $this->pnlContent->objPerson;
				$objParticipation->Group = $this->pnlContent->objGroup;
				$objParticipation->GroupRoleId = $this->lstEditRole->SelectedValue;
				$objParticipation->DateStart = $this->dtxEditStart->DateTime;
				$objParticipation->DateEnd = $this->dtxEditEnd->DateTime;

				$this->objParticipationArray[] = $objParticipation;
			}

			usort($this->objParticipationArray, array($this, 'objParticipationArray_Sort'));
			$this->intEditParticipationIndex = null;
			$this->dtgParticipations->Refresh();
			$this->lblCurrentRoles_Refresh();
			$this->dlgEdit->HideDialogBox();
		}

		public function dttDateRangeArray_Sort($dttDate1Array, $dttDate2Array) {
			if ($dttDate1Array[0]->IsEqualTo($dttDate2Array[0])) return 0;
			return ($dttDate1Array[0]->IsEarlierThan($dttDate2Array[0])) ? - 1 : 1;
		}

		public function objParticipationArray_Sort(GroupParticipation $objParticipation1, GroupParticipation $objParticipation2) {
			if ($objParticipation1->GroupRoleId != $objParticipation2->GroupRoleId)
				return ord(QString::FirstCharacter($objParticipation1->GroupRole->Name)) < ord(QString::FirstCharacter($objParticipation2->GroupRole->Name)) ? -1 : 1;
			return $objParticipation1->DateStart->IsEarlierThan($objParticipation2->DateStart) ? -1 : 1;
		}

		public function btnEditCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->dlgEdit->HideDialogBox();
		}

		public function btnEditDelete_Click($strFormId, $strControlId, $strParameter) {
			unset($this->objParticipationArray[$this->intEditParticipationIndex]);

			usort($this->objParticipationArray, array($this, 'objParticipationArray_Sort'));
			$this->intEditParticipationIndex = null;
			$this->dtgParticipations->Refresh();
			$this->lblCurrentRoles_Refresh();
			$this->dlgEdit->HideDialogBox();
		}

		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$objArrayToDelete = array();
			foreach (GroupParticipation::LoadArrayByPersonIdGroupId($this->pnlContent->objPerson->Id, $this->pnlContent->objGroup->Id) as $objParticipation) {
				$objArrayToDelete[$objParticipation->Id] = $objParticipation;
			}

			// Save all the participation records
			foreach ($this->objParticipationArray as $objParticipation) {
				$objParticipation->Save();
				if (array_key_exists($objParticipation->Id, $objArrayToDelete)) {
					unset($objArrayToDelete[$objParticipation->Id]);
				}
			}

			// Delete any that are supposed to be deleted
			foreach ($objArrayToDelete as $objParticipation) $objParticipation->Delete();

			// Update groupAuthorizedSender table
			if (($this->chkIsAuthorizedSender->Checked) &&  !(GroupAuthorizedSender::LoadByGroupIdPersonId($this->pnlContent->objGroup->Id, $this->pnlContent->objPerson->Id))) {
				$objGroupAuthorizedSender = new GroupAuthorizedSender();
				$objGroupAuthorizedSender->GroupId = $this->pnlContent->objGroup->Id;
				$objGroupAuthorizedSender->PersonId = $this->pnlContent->objPerson->Id;
				$objGroupAuthorizedSender->Save();
			}else if (!$this->chkIsAuthorizedSender->Checked) {
				$objGroupAuthorizedSender = GroupAuthorizedSender::LoadByGroupIdPersonId($this->pnlContent->objGroup->Id, $this->pnlContent->objPerson->Id);
				if ($objGroupAuthorizedSender) {
					$objGroupAuthorizedSender->Delete();
				}
			}
			
			$this->pnlContent->ReturnTo($this->strReturnUrl);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->pnlContent->ReturnTo($this->strReturnUrl);
		}
	}
?>