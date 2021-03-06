<?php
	require(dirname(__FILE__) . '/../../includes/prepend.inc.php');
	QApplication::Authenticate();

	class SearchGroupsForm extends ChmsForm {
		protected $strPageTitle = 'Events and Signups';
		protected $intNavSectionId = ChmsForm::NavSectionEvents;

		protected $lblMinistry;
		protected $pnlMinistries;
		protected $pxyMinistry;
		protected $intMinistryId;

		protected $lstSignupFormType;
		protected $chkViewAll;

		protected $dtgSignupForms;
		protected $lblStartText;

		protected function Form_Create() {
			$this->pnlMinistries = new QPanel($this);
			$this->pnlMinistries->TagName = 'ul';
			$this->pnlMinistries->CssClass = 'subnavSide subnavSideSmall';
			$this->pnlMinistries->AutoRenderChildren = true;

			$this->pxyMinistry = new QControlProxy($this);
			$this->pxyMinistry->AddAction(new QClickEvent(), new QAjaxAction('pxyMinistry_Click'));
			$this->pxyMinistry->AddAction(new QClickEvent(), new QTerminateAction());

			$blnFirst = true;
			foreach (Ministry::LoadArrayByActiveFlag(true, QQ::OrderBy(QQN::Ministry()->Name)) as $objMinistry) {
				if ($objMinistry->IsLoginCanViewMinistry(QApplication::$Login)) {
					$pnlMinistry = new QPanel($this->pnlMinistries, 'pnlMinistry' . $objMinistry->Id);
					$pnlMinistry->TagName = 'li';
					$pnlMinistry->ActionParameter = $objMinistry->Id;
					if ($blnFirst) {
						$blnFirst = false;
						$pnlMinistry->CssClass = 'first';
					}
					$this->pnlMinistry_Refresh($objMinistry);
				}
			}
			// Last
			if ($blnFirst != true) // only set if non-empty panel variable
				$pnlMinistry->CssClass = 'last';

			$this->lstSignupFormType = new QListBox($this);
			$this->lstSignupFormType->AddAction(new QChangeEvent(), new QAjaxAction('lstSignupFormType_Change'));
			$this->lstSignupFormType->Visible = false;

			$this->chkViewAll = new QCheckBox($this);
			$this->chkViewAll->Text = 'View "Inactive" Signup Forms as well';
			$this->chkViewAll->AddAction(new QClickEvent(), new QAjaxAction('chkViewAll_Click'));
			$this->chkViewAll->Visible = false;
			
			$this->lblMinistry = new QLabel($this);
			$this->lblMinistry->TagName = 'h3';
			$this->lblMinistry_Refresh();

			$this->dtgSignupForms = new QDataGrid($this);
			$this->dtgSignupForms->CssClass = 'datagrid';
			$this->dtgSignupForms->AddColumn(new QDataGridColumn('Form Name', '<?= $_FORM->RenderName($_ITEM); ?>', 'HtmlEntities=false', 'Width=440px'));
			$this->dtgSignupForms->AddColumn(new QDataGridColumn('Signups', '<?= SignupEntry::CountBySignupFormIdSignupEntryStatusTypeId($_ITEM->Id, SignupEntryStatusType::Complete); ?>', 'Width=60px'));
			$this->dtgSignupForms->AddColumn(new QDataGridColumn('Type', '<?= $_ITEM->Type; ?>', 'Width=80px'));
			$this->dtgSignupForms->AddColumn(new QDataGridColumn('Date Created', '<?= $_ITEM->DateCreated->ToString("DDD, MMM D, YYYY"); ?>', 'Width=140px'));
			$this->dtgSignupForms->SetDataBinder('dtgSignupForms_Bind');

			$this->lblStartText = new QLabel($this);
			$this->lblStartText->Text = '<h3>Events and Signup Forms</h3><p>Please select a ministry from the list on the right.</p>';
			$this->lblStartText->HtmlEntities = false;
			
			$this->SetUrlHashProcessor('Form_ProcessHash');
		}
		
		public function lstSignupFormType_Change() {
			QApplication::Redirect('/events/edit.php/0/' . $this->lstSignupFormType->SelectedValue);
		}

		public function chkViewAll_Click() {
			$this->dtgSignupForms->Refresh();
		}

		public function dtgSignupForms_Bind() {
			if ($this->intMinistryId) {
				$this->dtgSignupForms->DataSource = SignupForm::LoadOrderedArrayByMinistryIdAndConfidentiality(
					$this->intMinistryId,
					Ministry::Load($this->intMinistryId)->IsLoginCanAdminMinistry(QApplication::$Login),
					!$this->chkViewAll->Checked);
				$this->dtgSignupForms->Visible = true;
			} else {
				$this->dtgSignupForms->DataSource = null;
				$this->dtgSignupForms->Visible = false;
			}

			$this->lblStartText->Visible = !$this->dtgSignupForms->Visible;
		}

		public function lstGroupType_Change($strFormId, $strControlId, $strParameter) {
			QApplication::ExecuteJavaScript(sprintf('document.location = "/groups/group.php#new/%s/%s";',
				strtolower(str_replace(' ', '_', GroupType::$NameArray[$this->lstGroupType->SelectedValue])),
				$this->intMinistryId));
			$this->lstGroupType->SelectedIndex = 0;
		}

		public function RenderName(SignupForm $objSignupForm) {
			if ($objSignupForm->ActiveFlag) {
				$this->dtgSignupForms->OverrideRowStyle($this->dtgSignupForms->CurrentRowIndex, null);
			} else {
				$objStyle = new QDataGridRowStyle();
				$objStyle->BackColor = '#ccc';
				$this->dtgSignupForms->OverrideRowStyle($this->dtgSignupForms->CurrentRowIndex, $objStyle);
			}
			// GJS - Add a link here
			switch ($objSignupForm->SignupFormTypeId) {
				case SignupFormType::Event:
					$strName = sprintf('%s %s<br/><span class="sublinks"><a href="/events/form.php/%s">Form Details</a> | <a href="/events/results.php/%s">Results</a></span>',
						QApplication::HtmlEntities($objSignupForm->Name),
						($objSignupForm->ConfidentialFlag) ? '<img src="/assets/images/confidential.png" title="Confidential Event" style="width: 89px; height: 13px; position: relative; top: 2px;"/>' : null,
						$objSignupForm->Id, $objSignupForm->Id);
					break;
				case SignupFormType::Course:
					$strName = sprintf('%s %s<br/><span class="sublinks"><a href="/events/form.php/%s">Form Details</a> | <a href="/events/results.php/%s">Results</a> | <a href="/events/attendence.php/%s">Attendence</a></span>',
						QApplication::HtmlEntities($objSignupForm->Name),
						($objSignupForm->ConfidentialFlag) ? '<img src="/assets/images/confidential.png" title="Confidential Event" style="width: 89px; height: 13px; position: relative; top: 2px;"/>' : null,
						$objSignupForm->Id, $objSignupForm->Id, $objSignupForm->Id);
					break;
			}
			
			return $strName;
		}

		protected function pnlMinistry_Refresh($mixMinistry) {
			if ($mixMinistry instanceof Ministry) {
				$objMinistry = $mixMinistry;
				$intMinistryId = $objMinistry->Id;
			} else {
				$intMinistryId = $mixMinistry;
				$objMinistry = Ministry::Load($intMinistryId);
			}

			$pnlMinistry = $this->GetControl('pnlMinistry' . $intMinistryId);
			if ($pnlMinistry) {
				$pnlMinistry->Text = sprintf('<a href="" %s %s>%s</a>',
					$this->pxyMinistry->RenderAsEvents($objMinistry->Id, false),
					($intMinistryId == $this->intMinistryId) ? 'class="selected"' : null,
					$objMinistry->Name);
			}
		}
		
		protected function lblMinistry_Refresh() {
			$objMinistry = Ministry::Load($this->intMinistryId);
			if ($objMinistry) {
				$this->lblMinistry->Visible = true;
				$this->lblMinistry->Text = 'Signup Forms in ' . $objMinistry->Name;
			} else {
				$this->lblMinistry->Visible = false;
			}
		}

		protected function pxyMinistry_Click($strFormId, $strControlId, $strParameter) {
			QApplication::Redirect('#' . $strParameter);
		}

		protected function Form_ProcessHash() {
			$strParameter = $this->strUrlHash;
			if ($strParameter != $this->intMinistryId) {
				$intOldMinistryId = $this->intMinistryId;
				$this->intMinistryId = $strParameter;
				$this->pnlMinistry_Refresh($intOldMinistryId);
				$this->pnlMinistry_Refresh($this->intMinistryId);
				$this->lblMinistry_Refresh();
				$this->dtgSignupForms->Refresh();

				$objMinistry = Ministry::Load($this->intMinistryId);
				if ($objMinistry && $objMinistry->IsLoginCanAdminMinistry(QApplication::$Login)) {
					$this->chkViewAll->Visible = true;
					$this->lstSignupFormType->Visible = true;
					$this->lstSignupFormType->RemoveAllItems();
					$this->lstSignupFormType->AddItem('- Create New... -');
					foreach (SignupFormType::$NameArray as $intId => $strName)
						if ($objMinistry->SignupFormTypeBitmap & $intId) $this->lstSignupFormType->AddItem($strName, $intId);
				} else {
					$this->lstSignupFormType->Visible = false;
				}
			}
		}
	}

	SearchGroupsForm::Run('SearchGroupsForm');
?>