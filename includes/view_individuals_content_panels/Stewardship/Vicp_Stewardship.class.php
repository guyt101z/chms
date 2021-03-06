<?php
	QApplication::Authenticate(null, array(PermissionType::AccessStewardship));

	class Vicp_Stewardship extends Vicp_Base {
		public $dtgStewardshipContributionAmount;
		public $chkCombined;
		public $lstYear;
		public $lstFund;

		public $pxyPrint;
		
		public $dtgPledges;
		
		public $btnMoveTransactions;
		public $dlgMove;
		public $lstMoveTo;
		public $btnMoveSave;
		public $btnMoveCancel;

		protected function SetupPanel() {
			$this->dtgStewardshipContributionAmount = new StewardshipContributionAmountDataGrid($this);
			$this->dtgStewardshipContributionAmount->MetaAddColumn(QQN::StewardshipContributionAmount()->StewardshipContribution->DateCredited, 'Html=<?= $_CONTROL->ParentControl->RenderDate($_ITEM); ?>', 'Name=Date', 'Width=100px', 'HtmlEntities=false');
			$this->dtgStewardshipContributionAmount->MetaAddColumn(QQN::StewardshipContributionAmount()->StewardshipContribution->Person->LastName, 'Html=<?= $_CONTROL->ParentControl->RenderPerson($_ITEM); ?>', 'Name=Person', 'Width=180px');
			$this->dtgStewardshipContributionAmount->MetaAddColumn(QQN::StewardshipContributionAmount()->StewardshipFund->Name, 'Name=Fund', 'Width=180px');
			$this->dtgStewardshipContributionAmount->MetaAddColumn(QQN::StewardshipContributionAmount()->StewardshipContribution->StewardshipContributionTypeId, 'Html=<?= $_CONTROL->ParentControl->RenderTransaction($_ITEM); ?>', 'Name=Transaction', 'Width=170px');
			$this->dtgStewardshipContributionAmount->MetaAddColumn(QQN::StewardshipContributionAmount()->Amount, 'Html=<?= $_CONTROL->ParentControl->RenderAmount($_ITEM); ?>', 'HtmlEntities=false', 'FontNames=Lucida Console,Courier New,Courier,monospaced', 'Width=90px');
			$this->dtgStewardshipContributionAmount->SetDataBinder('dtgStewardshipContributionAmount_Bind', $this);
			$this->dtgStewardshipContributionAmount->SortColumnIndex = 0;

			$this->dtgStewardshipContributionAmount->NoDataHtml = 'No contribution records given your filtering criteria above.';
			
			if ($this->objForm->objHousehold) {
				$this->chkCombined = new QCheckBox($this);
				$this->chkCombined->Text = 'View contributions by all household members';
				$this->chkCombined->Checked = $this->objForm->objHousehold->CombinedStewardshipFlag;
			}

			$this->lstYear = new QListBox($this);
			$this->lstYear->AddItem('- View All -', null);
			
			$intYearNow = QDateTime::Now()->Year;
			if (array_key_exists('stewardship_view_year', $_SESSION)) $intYearToView = $_SESSION['stewardship_view_year'];
			else $intYearToView = $intYearNow;
			for ($intYear = 2000; $intYear <= ($intYearNow + 1); $intYear++) {
				$this->lstYear->AddItem($intYear, $intYear, $intYear == $intYearToView);
			}

			$this->lstFund = new QListBox($this);
			$this->lstFund->AddItem('- View All -', null, true);
			foreach (StewardshipFund::LoadAll(QQ::OrderBy(QQN::StewardshipFund()->Name)) as $objFund) {
				$this->lstFund->AddItem($objFund->Name, $objFund->Id);
			}

			$this->lstYear->AddAction(new QChangeEvent(), new QAjaxControlAction($this, 'lstYear_Change'));
			$this->lstYear->AddAction(new QEnterKeyEvent(), new QAjaxControlAction($this, 'lstYear_Change'));
			$this->lstYear->AddAction(new QEnterKeyEvent(), new QTerminateAction());

			$this->lstFund->AddAction(new QChangeEvent(), new QAjaxControlAction($this, 'Filter'));
			$this->lstFund->AddAction(new QEnterKeyEvent(), new QAjaxControlAction($this, 'Filter'));
			$this->lstFund->AddAction(new QEnterKeyEvent(), new QTerminateAction());

			if ($this->objForm->objHousehold) {
				$this->chkCombined->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'Filter'));
			}

			$this->pxyPrint = new QControlProxy($this);
			$this->pxyPrint->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'pxyPrint_Click'));
			$this->pxyPrint->AddAction(new QClickEvent(), new QTerminateAction());

			$this->dtgPledges = new StewardshipPledgeDataGrid($this);
			$this->dtgPledges->FontSize = '11px';
			$this->dtgPledges->MetaAddColumn(QQN::StewardshipPledge()->Person->LastName, 'Name=Pledged By', 'HtmlEntities=false', 'Html=<?= $_CONTROL->ParentControl->RenderPledgePerson($_ITEM); ?>', 'Width=180px');
			$this->dtgPledges->MetaAddColumn(QQN::StewardshipPledge()->StewardshipFund->Name, 'Name=Fund', 'Width=150px');
			$this->dtgPledges->MetaAddColumn(QQN::StewardshipPledge()->DateStarted, 'Name=Start Date', 'Width=75px');
			$this->dtgPledges->MetaAddColumn(QQN::StewardshipPledge()->DateEnded, 'Name=End Date', 'Width=75px');
			$this->dtgPledges->MetaAddColumn(QQN::StewardshipPledge()->PledgeAmount, 'Name=Pledged', 'Html=<?= QApplication::DisplayCurrency($_ITEM->PledgeAmount); ?>', 'Width=70px');
			$this->dtgPledges->MetaAddColumn(QQN::StewardshipPledge()->ContributedAmount, 'Name=Contributed', 'Html=<?= QApplication::DisplayCurrency($_ITEM->ContributedAmount); ?>', 'Width=70px');
			$this->dtgPledges->MetaAddColumn(QQN::StewardshipPledge()->RemainingAmount, 'Name=Remaining', 'FontBold=true', 'Html=<?= QApplication::DisplayCurrency($_ITEM->RemainingAmount); ?>', 'Width=75px');
			$this->dtgPledges->SetDataBinder('dtgPledges_Bind', $this);
			
			$this->dtgPledges->NoDataHtml = '<span style="font-size: 14px;">No pledge records given your filtering criteria above.</span>';
			
			if ($this->objPerson->DeceasedFlag && $this->objForm->objHousehold && ($this->objForm->objHousehold->CountHouseholdParticipations() > 1)) {
				$this->btnMoveTransactions = new QButton($this);
				$this->btnMoveTransactions->CssClass = 'alternate';
				$this->btnMoveTransactions->Text = 'Deceased / Move Transactions';
				$this->btnMoveTransactions->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnMoveTransactions_Click'));

				$this->dlgMove = new QDialogBox($this);
				$this->dlgMove->Template = dirname(__FILE__) . '/dlgMove.tpl.php';
				$this->dlgMove->MatteClickable = false;
				$this->dlgMove->HideDialogBox();

				$this->lstMoveTo = new QListBox($this->dlgMove);
				$this->lstMoveTo->AddItem('- Select One -', null);
				$this->lstMoveTo->Name = 'Reassign To';
				$this->lstMoveTo->Required = true;
				foreach ($this->objForm->objHousehold->GetHouseholdParticipationArray() as $objHouseholdParticipation) {
					if ($objHouseholdParticipation->PersonId != $this->objPerson->Id)
						$this->lstMoveTo->AddItem($objHouseholdParticipation->Person->Name, $objHouseholdParticipation->Person->Id);
				}

				$this->btnMoveSave = new QButton($this->dlgMove);
				$this->btnMoveSave->Text = 'Move Transactions';
				$this->btnMoveSave->CssClass = 'primary';
				$this->btnMoveSave->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnMoveSave_Click'));
				$this->btnMoveSave->CausesValidation = QCausesValidation::SiblingsAndChildren;
				
				$this->btnMoveCancel = new QLinkButton($this->dlgMove);
				$this->btnMoveCancel->Text = 'Cancel';
				$this->btnMoveCancel->CssClass = 'cancel';
				$this->btnMoveCancel->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnMoveCancel_Click'));
				$this->btnMoveCancel->AddAction(new QClickEvent(), new QTerminateAction());
			}
		}

		public function btnMoveTransactions_Click() {
			$this->dlgMove->ShowDialogBox();
			$this->lstMoveTo->SelectedIndex = 0;
		}

		public function btnMoveSave_Click() {
			$this->objPerson->MoveStewardshipTransactions($this->lstYear->SelectedValue, Person::Load($this->lstMoveTo->SelectedValue));
			$this->dtgStewardshipContributionAmount->Refresh();
			$this->dlgMove->HideDialogBox();
		}

		public function btnMoveCancel_Click() {
			$this->dlgMove->HideDialogBox();
		}
		
		public function RenderPledgePerson(StewardshipPledge $objPledge) {
			if ($objPledge->ActiveFlag) {
				$objStyle = null;
			} else {
				$objStyle = new QDataGridRowStyle();
				$objStyle->BackColor = '#edd';
			}

			$this->dtgPledges->OverrideRowStyle($this->dtgPledges->CurrentRowIndex, $objStyle);

			if ($objPledge->PersonId == $this->objPerson->Id)
				return sprintf('<a href="#stewardship/edit_pledge/%s">%s</a>', $objPledge->Id, $objPledge->Person->Name);
			else
				return sprintf('<a href="/individuals/view.php/%s/%s#stewardship/edit_pledge/%s">%s</a>', $objPledge->PersonId, $this->objForm->objHousehold->Id, $objPledge->Id, $objPledge->Person->Name);
		}

		public function dtgPledges_Bind() {
			if ($this->chkCombined && $this->chkCombined->Checked) {
				$intPersonIdArray = array();
				foreach ($this->objForm->objHousehold->GetHouseholdParticipationArray() as $objParticipation) {
					$intPersonIdArray[] = $objParticipation->PersonId;
				}
				$objCondition = QQ::In(QQN::StewardshipPledge()->PersonId, $intPersonIdArray);
			} else
				$objCondition = QQ::Equal(QQN::StewardshipPledge()->PersonId, $this->objPerson->Id);

			$this->dtgPledges->MetaDataBinder($objCondition, QQ::Clause(
				QQ::Expand(QQN::StewardshipPledge()->Person->LastName),
				QQ::Expand(QQN::StewardshipPledge()->StewardshipFund->Name)
			));
		}

		public function pxyPrint_Click() {
			if (!$this->lstYear->SelectedValue) {
				QApplication::DisplayAlert('Please specify a year to print');
				return;
			}

			if ($this->objForm->objHousehold && $this->objForm->objHousehold->CombinedStewardshipFlag) {
				$strUrl = sprintf('/stewardship/receipt.php/%s/%s/%s/Statement%s.pdf',
					$this->objPerson->Id, $this->objForm->objHousehold->Id, $this->lstYear->SelectedValue, $this->lstYear->SelectedValue);
			} else {
				$strUrl = sprintf('/stewardship/receipt.php/%s/%s/%s/Statement%s.pdf',
					$this->objPerson->Id, 0, $this->lstYear->SelectedValue, $this->lstYear->SelectedValue);
			}

			QApplication::Redirect($strUrl);
		}

		public function lstYear_Change() {
			$_SESSION['stewardship_view_year'] = $this->lstYear->SelectedValue;
			$this->Filter();
		}
		public function Filter() {
			$this->dtgStewardshipContributionAmount->Refresh();
			$this->dtgPledges->Refresh();
		}

		public function RenderDate(StewardshipContributionAmount $objAmount) {
			if (!$objAmount->Id) return;
			if ($objAmount->StewardshipContribution->NonDeductibleFlag) {
				$objStyle = new QDataGridRowStyle();
				$objStyle->BackColor = '#ddd';
				$this->dtgStewardshipContributionAmount->OverrideRowStyle($this->dtgStewardshipContributionAmount->CurrentRowIndex, $objStyle);
			} else {
				$this->dtgStewardshipContributionAmount->OverrideRowStyle($this->dtgStewardshipContributionAmount->CurrentRowIndex, null);
			}

			return sprintf('<a href="/stewardship/batch.php/%s#%s/view_contribution/%s">%s</a>',
				$objAmount->StewardshipContribution->StewardshipBatchId,
				$objAmount->StewardshipContribution->StewardshipStack->StackNumber,
				$objAmount->StewardshipContributionId,
				$objAmount->StewardshipContribution->DateCredited->ToString('MMM D YYYY'));
		}
		
		public function RenderPerson(StewardshipContributionAmount $objAmount) {
			if (!$objAmount->Id) return;
			return $objAmount->StewardshipContribution->Person->Name;
		}
		
		public function RenderTransaction(StewardshipContributionAmount $objAmount) {
			if (!$objAmount->Id) {
				$objRowStyle = new QDataGridRowStyle();
				$objRowStyle->FontBold = true;
				$objRowStyle->BackColor = '#ccc';
				$this->dtgStewardshipContributionAmount->OverrideRowStyle($this->dtgStewardshipContributionAmount->CurrentRowIndex, $objRowStyle);
				return 'TOTAL AMOUNT';
			} else {
				$this->dtgStewardshipContributionAmount->OverrideRowStyle($this->dtgStewardshipContributionAmount->CurrentRowIndex, null);
			}
			return ($objAmount->StewardshipContribution->Transaction);
		}
		
		protected $fltTotal = 0;
		public function RenderAmount(StewardshipContributionAmount $objAmount) {
			if (!$objAmount->Id) return '<span style="font-weight: normal;">' . QApplication::DisplayCurrency($this->fltTotal, 10) . '</span>';
			$this->fltTotal += $objAmount->Amount;
			$strToReturn = QApplication::DisplayCurrencyHtml($objAmount->Amount, true);
			if ($objAmount->StewardshipContribution->NonDeductibleFlag) {
				$strToReturn .= '<br/><span style="color: #666; font-size: 10px;">Non-Deductible</span>';
			}
			return $strToReturn;
		}
		
		public function dtgStewardshipContributionAmount_Bind() {
			$this->fltTotal = 0;
			if ($this->chkCombined && $this->chkCombined->Checked) {
				$intPersonIdArray = array();
				foreach ($this->objForm->objHousehold->GetHouseholdParticipationArray() as $objParticipation) {
					$intPersonIdArray[] = $objParticipation->PersonId;
				}
				$objCondition = QQ::In(QQN::StewardshipContributionAmount()->StewardshipContribution->PersonId, $intPersonIdArray);
			} else
				$objCondition = QQ::Equal(QQN::StewardshipContributionAmount()->StewardshipContribution->PersonId, $this->objPerson->Id);

			if ($this->lstYear->SelectedValue) {
				$objCondition = QQ::AndCondition(
					$objCondition,
					QQ::GreaterOrEqual(QQN::StewardshipContributionAmount()->StewardshipContribution->DateCredited, new QDateTime($this->lstYear->SelectedValue . '-01-01 00:00:00')),
					QQ::LessOrEqual(QQN::StewardshipContributionAmount()->StewardshipContribution->DateCredited, new QDateTime($this->lstYear->SelectedValue . '-12-31 23:59:59')));
			}

			if ($this->lstFund->SelectedValue) {
				$objCondition = QQ::AndCondition(
					$objCondition,
					QQ::Equal(QQN::StewardshipContributionAmount()->StewardshipFundId, $this->lstFund->SelectedValue));
			}

			$this->dtgStewardshipContributionAmount->MetaDataBinder($objCondition);
			
			// Add 'Totals' Row
			$objDataSource = $this->dtgStewardshipContributionAmount->DataSource;
			$objDataSource[] = new StewardshipContributionAmount();
			$this->dtgStewardshipContributionAmount->DataSource = $objDataSource;
		}
	}
?>