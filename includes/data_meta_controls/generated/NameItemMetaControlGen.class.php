<?php
	/**
	 * This is a MetaControl class, providing a QForm or QPanel access to event handlers
	 * and QControls to perform the Create, Edit, and Delete functionality
	 * of the NameItem class.  This code-generated class
	 * contains all the basic elements to help a QPanel or QForm display an HTML form that can
	 * manipulate a single NameItem object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QForm or QPanel which instantiates a NameItemMetaControl
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent
	 * code re-generation.
	 * 
	 * @package ALCF ChMS
	 * @subpackage MetaControls
	 * property-read NameItem $NameItem the actual NameItem data class being edited
	 * property QLabel $IdControl
	 * property-read QLabel $IdLabel
	 * property QTextBox $NameControl
	 * property-read QLabel $NameLabel
	 * property QListBox $PersonControl
	 * property-read QLabel $PersonLabel
	 * property-read string $TitleVerb a verb indicating whether or not this is being edited or created
	 * property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
	 */

	class NameItemMetaControlGen extends QBaseClass {
		// General Variables
		/**
		 * @var NameItem objNameItem
		 * @access protected
		 */
		protected $objNameItem;

		/**
		 * @var QForm|QControl objParentObject
		 * @access protected
		 */
		protected $objParentObject;

		/**
		 * @var string  strTitleVerb
		 * @access protected
		 */
		protected $strTitleVerb;

		/**
		 * @var boolean blnEditMode
		 * @access protected
		 */
		protected $blnEditMode;

		// Controls that allow the editing of NameItem's individual data fields
        /**
         * @var QLabel lblId;
         * @access protected
         */
		protected $lblId;

        /**
         * @var QTextBox txtName;
         * @access protected
         */
		protected $txtName;


		// Controls that allow the viewing of NameItem's individual data fields
        /**
         * @var QLabel lblName
         * @access protected
         */
		protected $lblName;


		// QListBox Controls (if applicable) to edit Unique ReverseReferences and ManyToMany References
		protected $lstPeople;


		// QLabel Controls (if applicable) to view Unique ReverseReferences and ManyToMany References
		protected $lblPeople;



		/**
		 * Main constructor.  Constructor OR static create methods are designed to be called in either
		 * a parent QPanel or the main QForm when wanting to create a
		 * NameItemMetaControl to edit a single NameItem object within the
		 * QPanel or QForm.
		 *
		 * This constructor takes in a single NameItem object, while any of the static
		 * create methods below can be used to construct based off of individual PK ID(s).
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this NameItemMetaControl
		 * @param NameItem $objNameItem new or existing NameItem object
		 */
		 public function __construct($objParentObject, NameItem $objNameItem) {
			// Setup Parent Object (e.g. QForm or QPanel which will be using this NameItemMetaControl)
			$this->objParentObject = $objParentObject;

			// Setup linked NameItem object
			$this->objNameItem = $objNameItem;

			// Figure out if we're Editing or Creating New
			if ($this->objNameItem->__Restored) {
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		 }

		/**
		 * Static Helper Method to Create using PK arguments
		 * You must pass in the PK arguments on an object to load, or leave it blank to create a new one.
		 * If you want to load via QueryString or PathInfo, use the CreateFromQueryString or CreateFromPathInfo
		 * static helper methods.  Finally, specify a CreateType to define whether or not we are only allowed to 
		 * edit, or if we are also allowed to create a new one, etc.
		 * 
		 * @param mixed $objParentObject QForm or QPanel which will be using this NameItemMetaControl
		 * @param integer $intId primary key value
		 * @param QMetaControlCreateType $intCreateType rules governing NameItem object creation - defaults to CreateOrEdit
 		 * @return NameItemMetaControl
		 */
		public static function Create($objParentObject, $intId = null, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			// Attempt to Load from PK Arguments
			if (strlen($intId)) {
				$objNameItem = NameItem::Load($intId);

				// NameItem was found -- return it!
				if ($objNameItem)
					return new NameItemMetaControl($objParentObject, $objNameItem);

				// If CreateOnRecordNotFound not specified, throw an exception
				else if ($intCreateType != QMetaControlCreateType::CreateOnRecordNotFound)
					throw new QCallerException('Could not find a NameItem object with PK arguments: ' . $intId);

			// If EditOnly is specified, throw an exception
			} else if ($intCreateType == QMetaControlCreateType::EditOnly)
				throw new QCallerException('No PK arguments specified');

			// If we are here, then we need to create a new record
			return new NameItemMetaControl($objParentObject, new NameItem());
		}

		/**
		 * Static Helper Method to Create using PathInfo arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this NameItemMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing NameItem object creation - defaults to CreateOrEdit
		 * @return NameItemMetaControl
		 */
		public static function CreateFromPathInfo($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::PathInfo(0);
			return NameItemMetaControl::Create($objParentObject, $intId, $intCreateType);
		}

		/**
		 * Static Helper Method to Create using QueryString arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this NameItemMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing NameItem object creation - defaults to CreateOrEdit
		 * @return NameItemMetaControl
		 */
		public static function CreateFromQueryString($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::QueryString('intId');
			return NameItemMetaControl::Create($objParentObject, $intId, $intCreateType);
		}



		///////////////////////////////////////////////
		// PUBLIC CREATE and REFRESH METHODS
		///////////////////////////////////////////////

		/**
		 * Create and setup QLabel lblId
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblId_Create($strControlId = null) {
			$this->lblId = new QLabel($this->objParentObject, $strControlId);
			$this->lblId->Name = QApplication::Translate('Id');
			if ($this->blnEditMode)
				$this->lblId->Text = $this->objNameItem->Id;
			else
				$this->lblId->Text = 'N/A';
			return $this->lblId;
		}

		/**
		 * Create and setup QTextBox txtName
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtName_Create($strControlId = null) {
			$this->txtName = new QTextBox($this->objParentObject, $strControlId);
			$this->txtName->Name = QApplication::Translate('Name');
			$this->txtName->Text = $this->objNameItem->Name;
			$this->txtName->MaxLength = NameItem::NameMaxLength;
			return $this->txtName;
		}

		/**
		 * Create and setup QLabel lblName
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblName_Create($strControlId = null) {
			$this->lblName = new QLabel($this->objParentObject, $strControlId);
			$this->lblName->Name = QApplication::Translate('Name');
			$this->lblName->Text = $this->objNameItem->Name;
			return $this->lblName;
		}

		/**
		 * Create and setup QListBox lstPeople
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objConditions override the default condition of QQ::All() to the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause object or array of QQClause objects for the query
		 * @return QListBox
		 */
		public function lstPeople_Create($strControlId = null, QQCondition $objCondition = null, $objOptionalClauses = null) {
			$this->lstPeople = new QListBox($this->objParentObject, $strControlId);
			$this->lstPeople->Name = QApplication::Translate('People');
			$this->lstPeople->SelectionMode = QSelectionMode::Multiple;

			// We need to know which items to "Pre-Select"
			$objAssociatedArray = $this->objNameItem->GetPersonArray();

			// Setup and perform the Query
			if (is_null($objCondition)) $objCondition = QQ::All();
			$objPersonCursor = Person::QueryCursor($objCondition, $objOptionalClauses);

			// Iterate through the Cursor
			while ($objPerson = Person::InstantiateCursor($objPersonCursor)) {
				$objListItem = new QListItem($objPerson->__toString(), $objPerson->Id);
				foreach ($objAssociatedArray as $objAssociated) {
					if ($objAssociated->Id == $objPerson->Id)
						$objListItem->Selected = true;
				}
				$this->lstPeople->AddItem($objListItem);
			}

			// Return the QListControl
			return $this->lstPeople;
		}

		/**
		 * Create and setup QLabel lblPeople
		 * @param string $strControlId optional ControlId to use
		 * @param string $strGlue glue to display in between each associated object
		 * @return QLabel
		 */
		public function lblPeople_Create($strControlId = null, $strGlue = ', ') {
			$this->lblPeople = new QLabel($this->objParentObject, $strControlId);
			$this->lstPeople->Name = QApplication::Translate('People');
			
			$objAssociatedArray = $this->objNameItem->GetPersonArray();
			$strItems = array();
			foreach ($objAssociatedArray as $objAssociated)
				$strItems[] = $objAssociated->__toString();
			$this->lblPeople->Text = implode($strGlue, $strItems);
			return $this->lblPeople;
		}



		/**
		 * Refresh this MetaControl with Data from the local NameItem object.
		 * @param boolean $blnReload reload NameItem from the database
		 * @return void
		 */
		public function Refresh($blnReload = false) {
			if ($blnReload)
				$this->objNameItem->Reload();

			if ($this->lblId) if ($this->blnEditMode) $this->lblId->Text = $this->objNameItem->Id;

			if ($this->txtName) $this->txtName->Text = $this->objNameItem->Name;
			if ($this->lblName) $this->lblName->Text = $this->objNameItem->Name;

			if ($this->lstPeople) {
				$this->lstPeople->RemoveAllItems();
				$objAssociatedArray = $this->objNameItem->GetPersonArray();
				$objPersonArray = Person::LoadAll();
				if ($objPersonArray) foreach ($objPersonArray as $objPerson) {
					$objListItem = new QListItem($objPerson->__toString(), $objPerson->Id);
					foreach ($objAssociatedArray as $objAssociated) {
						if ($objAssociated->Id == $objPerson->Id)
							$objListItem->Selected = true;
					}
					$this->lstPeople->AddItem($objListItem);
				}
			}
			if ($this->lblPeople) {
				$objAssociatedArray = $this->objNameItem->GetPersonArray();
				$strItems = array();
				foreach ($objAssociatedArray as $objAssociated)
					$strItems[] = $objAssociated->__toString();
				$this->lblPeople->Text = implode($strGlue, $strItems);
			}

		}



		///////////////////////////////////////////////
		// PROTECTED UPDATE METHODS for ManyToManyReferences (if any)
		///////////////////////////////////////////////

		protected function lstPeople_Update() {
			if ($this->lstPeople) {
				$this->objNameItem->UnassociateAllPeople();
				$objSelectedListItems = $this->lstPeople->SelectedItems;
				if ($objSelectedListItems) foreach ($objSelectedListItems as $objListItem) {
					$this->objNameItem->AssociatePerson(Person::Load($objListItem->Value));
				}
			}
		}





		///////////////////////////////////////////////
		// PUBLIC NAMEITEM OBJECT MANIPULATORS
		///////////////////////////////////////////////

		/**
		 * This will save this object's NameItem instance,
		 * updating only the fields which have had a control created for it.
		 */
		public function SaveNameItem() {
			try {
				// Update any fields for controls that have been created
				if ($this->txtName) $this->objNameItem->Name = $this->txtName->Text;

				// Update any UniqueReverseReferences (if any) for controls that have been created for it

				// Save the NameItem object
				$this->objNameItem->Save();

				// Finally, update any ManyToManyReferences (if any)
				$this->lstPeople_Update();
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * This will DELETE this object's NameItem instance from the database.
		 * It will also unassociate itself from any ManyToManyReferences.
		 */
		public function DeleteNameItem() {
			$this->objNameItem->UnassociateAllPeople();
			$this->objNameItem->Delete();
		}		



		///////////////////////////////////////////////
		// PUBLIC GETTERS and SETTERS
		///////////////////////////////////////////////

		/**
		 * Override method to perform a property "Get"
		 * This will get the value of $strName
		 *
		 * @param string $strName Name of the property to get
		 * @return mixed
		 */
		public function __get($strName) {
			switch ($strName) {
				// General MetaControlVariables
				case 'NameItem': return $this->objNameItem;
				case 'TitleVerb': return $this->strTitleVerb;
				case 'EditMode': return $this->blnEditMode;

				// Controls that point to NameItem fields -- will be created dynamically if not yet created
				case 'IdControl':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'IdLabel':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'NameControl':
					if (!$this->txtName) return $this->txtName_Create();
					return $this->txtName;
				case 'NameLabel':
					if (!$this->lblName) return $this->lblName_Create();
					return $this->lblName;
				case 'PersonControl':
					if (!$this->lstPeople) return $this->lstPeople_Create();
					return $this->lstPeople;
				case 'PersonLabel':
					if (!$this->lblPeople) return $this->lblPeople_Create();
					return $this->lblPeople;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		/**
		 * Override method to perform a property "Set"
		 * This will set the property $strName to be $mixValue
		 *
		 * @param string $strName Name of the property to set
		 * @param string $mixValue New value of the property
		 * @return mixed
		 */
		public function __set($strName, $mixValue) {
			try {
				switch ($strName) {
					// Controls that point to NameItem fields
					case 'IdControl':
						return ($this->lblId = QType::Cast($mixValue, 'QControl'));
					case 'NameControl':
						return ($this->txtName = QType::Cast($mixValue, 'QControl'));
					case 'PersonControl':
						return ($this->lstPeople = QType::Cast($mixValue, 'QControl'));
					default:
						return parent::__set($strName, $mixValue);
				}
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
	}
?>