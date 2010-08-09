<?php
	/**
	 * This is a quick-and-dirty draft QPanel object to do Create, Edit, and Delete functionality
	 * of the StewardshipContribution class.  It uses the code-generated
	 * StewardshipContributionMetaControl class, which has meta-methods to help with
	 * easily creating/defining controls to modify the fields of a StewardshipContribution columns.
	 *
	 * Any display customizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 * 
	 * NOTE: This file is overwritten on any code regenerations.  If you want to make
	 * permanent changes, it is STRONGLY RECOMMENDED to move both stewardship_contribution_edit.php AND
	 * stewardship_contribution_edit.tpl.php out of this Form Drafts directory.
	 *
	 * @package ALCF ChMS
	 * @subpackage Drafts
	 */
	class StewardshipContributionEditPanel extends QPanel {
		// Local instance of the StewardshipContributionMetaControl
		protected $mctStewardshipContribution;

		// Controls for StewardshipContribution's Data Fields
		public $lblId;
		public $lstPerson;
		public $lstStewardshipFund;
		public $lstStewardshipContributionTypeObject;
		public $lstStewardshipBatch;
		public $lstCheckingAccountLookup;
		public $txtAmount;
		public $calDateEntered;
		public $calDateCleared;
		public $txtCheckNumber;
		public $txtAuthorizationNumber;
		public $txtAlternateTitle;
		public $txtNote;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Other Controls
		public $btnSave;
		public $btnDelete;
		public $btnCancel;

		// Callback
		protected $strClosePanelMethod;

		public function __construct($objParentObject, $strClosePanelMethod, $intId = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Setup Callback and Template
			$this->strTemplate = 'StewardshipContributionEditPanel.tpl.php';
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Construct the StewardshipContributionMetaControl
			// MAKE SURE we specify "$this" as the MetaControl's (and thus all subsequent controls') parent
			$this->mctStewardshipContribution = StewardshipContributionMetaControl::Create($this, $intId);

			// Call MetaControl's methods to create qcontrols based on StewardshipContribution's data fields
			$this->lblId = $this->mctStewardshipContribution->lblId_Create();
			$this->lstPerson = $this->mctStewardshipContribution->lstPerson_Create();
			$this->lstStewardshipFund = $this->mctStewardshipContribution->lstStewardshipFund_Create();
			$this->lstStewardshipContributionTypeObject = $this->mctStewardshipContribution->lstStewardshipContributionTypeObject_Create();
			$this->lstStewardshipBatch = $this->mctStewardshipContribution->lstStewardshipBatch_Create();
			$this->lstCheckingAccountLookup = $this->mctStewardshipContribution->lstCheckingAccountLookup_Create();
			$this->txtAmount = $this->mctStewardshipContribution->txtAmount_Create();
			$this->calDateEntered = $this->mctStewardshipContribution->calDateEntered_Create();
			$this->calDateCleared = $this->mctStewardshipContribution->calDateCleared_Create();
			$this->txtCheckNumber = $this->mctStewardshipContribution->txtCheckNumber_Create();
			$this->txtAuthorizationNumber = $this->mctStewardshipContribution->txtAuthorizationNumber_Create();
			$this->txtAlternateTitle = $this->mctStewardshipContribution->txtAlternateTitle_Create();
			$this->txtNote = $this->mctStewardshipContribution->txtNote_Create();

			// Create Buttons and Actions on this Form
			$this->btnSave = new QButton($this);
			$this->btnSave->Text = QApplication::Translate('Save');
			$this->btnSave->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnSave_Click'));
			$this->btnSave->CausesValidation = $this;

			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = QApplication::Translate('Cancel');
			$this->btnCancel->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCancel_Click'));

			$this->btnDelete = new QButton($this);
			$this->btnDelete->Text = QApplication::Translate('Delete');
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(QApplication::Translate('Are you SURE you want to DELETE this') . ' ' . QApplication::Translate('StewardshipContribution') . '?'));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->Visible = $this->mctStewardshipContribution->EditMode;
		}

		// Control AjaxAction Event Handlers
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			// Delegate "Save" processing to the StewardshipContributionMetaControl
			$this->mctStewardshipContribution->SaveStewardshipContribution();
			$this->CloseSelf(true);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {
			// Delegate "Delete" processing to the StewardshipContributionMetaControl
			$this->mctStewardshipContribution->DeleteStewardshipContribution();
			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		// Close Myself and Call ClosePanelMethod Callback
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>