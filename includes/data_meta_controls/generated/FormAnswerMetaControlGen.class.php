<?php
	/**
	 * This is a MetaControl class, providing a QForm or QPanel access to event handlers
	 * and QControls to perform the Create, Edit, and Delete functionality
	 * of the FormAnswer class.  This code-generated class
	 * contains all the basic elements to help a QPanel or QForm display an HTML form that can
	 * manipulate a single FormAnswer object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QForm or QPanel which instantiates a FormAnswerMetaControl
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent
	 * code re-generation.
	 * 
	 * @package ALCF ChMS
	 * @subpackage MetaControls
	 * property-read FormAnswer $FormAnswer the actual FormAnswer data class being edited
	 * property QLabel $IdControl
	 * property-read QLabel $IdLabel
	 * property QListBox $SignupEntryIdControl
	 * property-read QLabel $SignupEntryIdLabel
	 * property QListBox $FormQuestionIdControl
	 * property-read QLabel $FormQuestionIdLabel
	 * property QTextBox $TextValueControl
	 * property-read QLabel $TextValueLabel
	 * property QListBox $AddressIdControl
	 * property-read QLabel $AddressIdLabel
	 * property QListBox $PhoneIdControl
	 * property-read QLabel $PhoneIdLabel
	 * property QListBox $EmailIdControl
	 * property-read QLabel $EmailIdLabel
	 * property QIntegerTextBox $IntegerValueControl
	 * property-read QLabel $IntegerValueLabel
	 * property QCheckBox $BooleanValueControl
	 * property-read QLabel $BooleanValueLabel
	 * property QDateTimePicker $DateValueControl
	 * property-read QLabel $DateValueLabel
	 * property-read string $TitleVerb a verb indicating whether or not this is being edited or created
	 * property-read boolean $EditMode a boolean indicating whether or not this is being edited or created
	 */

	class FormAnswerMetaControlGen extends QBaseClass {
		// General Variables
		/**
		 * @var FormAnswer objFormAnswer
		 * @access protected
		 */
		protected $objFormAnswer;

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

		// Controls that allow the editing of FormAnswer's individual data fields
        /**
         * @var QLabel lblId;
         * @access protected
         */
		protected $lblId;

        /**
         * @var QListBox lstSignupEntry;
         * @access protected
         */
		protected $lstSignupEntry;

        /**
         * @var QListBox lstFormQuestion;
         * @access protected
         */
		protected $lstFormQuestion;

        /**
         * @var QTextBox txtTextValue;
         * @access protected
         */
		protected $txtTextValue;

        /**
         * @var QListBox lstAddress;
         * @access protected
         */
		protected $lstAddress;

        /**
         * @var QListBox lstPhone;
         * @access protected
         */
		protected $lstPhone;

        /**
         * @var QListBox lstEmail;
         * @access protected
         */
		protected $lstEmail;

        /**
         * @var QIntegerTextBox txtIntegerValue;
         * @access protected
         */
		protected $txtIntegerValue;

        /**
         * @var QCheckBox chkBooleanValue;
         * @access protected
         */
		protected $chkBooleanValue;

        /**
         * @var QDateTimePicker calDateValue;
         * @access protected
         */
		protected $calDateValue;


		// Controls that allow the viewing of FormAnswer's individual data fields
        /**
         * @var QLabel lblSignupEntryId
         * @access protected
         */
		protected $lblSignupEntryId;

        /**
         * @var QLabel lblFormQuestionId
         * @access protected
         */
		protected $lblFormQuestionId;

        /**
         * @var QLabel lblTextValue
         * @access protected
         */
		protected $lblTextValue;

        /**
         * @var QLabel lblAddressId
         * @access protected
         */
		protected $lblAddressId;

        /**
         * @var QLabel lblPhoneId
         * @access protected
         */
		protected $lblPhoneId;

        /**
         * @var QLabel lblEmailId
         * @access protected
         */
		protected $lblEmailId;

        /**
         * @var QLabel lblIntegerValue
         * @access protected
         */
		protected $lblIntegerValue;

        /**
         * @var QLabel lblBooleanValue
         * @access protected
         */
		protected $lblBooleanValue;

        /**
         * @var QLabel lblDateValue
         * @access protected
         */
		protected $lblDateValue;


		// QListBox Controls (if applicable) to edit Unique ReverseReferences and ManyToMany References

		// QLabel Controls (if applicable) to view Unique ReverseReferences and ManyToMany References


		/**
		 * Main constructor.  Constructor OR static create methods are designed to be called in either
		 * a parent QPanel or the main QForm when wanting to create a
		 * FormAnswerMetaControl to edit a single FormAnswer object within the
		 * QPanel or QForm.
		 *
		 * This constructor takes in a single FormAnswer object, while any of the static
		 * create methods below can be used to construct based off of individual PK ID(s).
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this FormAnswerMetaControl
		 * @param FormAnswer $objFormAnswer new or existing FormAnswer object
		 */
		 public function __construct($objParentObject, FormAnswer $objFormAnswer) {
			// Setup Parent Object (e.g. QForm or QPanel which will be using this FormAnswerMetaControl)
			$this->objParentObject = $objParentObject;

			// Setup linked FormAnswer object
			$this->objFormAnswer = $objFormAnswer;

			// Figure out if we're Editing or Creating New
			if ($this->objFormAnswer->__Restored) {
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
		 * @param mixed $objParentObject QForm or QPanel which will be using this FormAnswerMetaControl
		 * @param integer $intId primary key value
		 * @param QMetaControlCreateType $intCreateType rules governing FormAnswer object creation - defaults to CreateOrEdit
 		 * @return FormAnswerMetaControl
		 */
		public static function Create($objParentObject, $intId = null, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			// Attempt to Load from PK Arguments
			if (strlen($intId)) {
				$objFormAnswer = FormAnswer::Load($intId);

				// FormAnswer was found -- return it!
				if ($objFormAnswer)
					return new FormAnswerMetaControl($objParentObject, $objFormAnswer);

				// If CreateOnRecordNotFound not specified, throw an exception
				else if ($intCreateType != QMetaControlCreateType::CreateOnRecordNotFound)
					throw new QCallerException('Could not find a FormAnswer object with PK arguments: ' . $intId);

			// If EditOnly is specified, throw an exception
			} else if ($intCreateType == QMetaControlCreateType::EditOnly)
				throw new QCallerException('No PK arguments specified');

			// If we are here, then we need to create a new record
			return new FormAnswerMetaControl($objParentObject, new FormAnswer());
		}

		/**
		 * Static Helper Method to Create using PathInfo arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this FormAnswerMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing FormAnswer object creation - defaults to CreateOrEdit
		 * @return FormAnswerMetaControl
		 */
		public static function CreateFromPathInfo($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::PathInfo(0);
			return FormAnswerMetaControl::Create($objParentObject, $intId, $intCreateType);
		}

		/**
		 * Static Helper Method to Create using QueryString arguments
		 *
		 * @param mixed $objParentObject QForm or QPanel which will be using this FormAnswerMetaControl
		 * @param QMetaControlCreateType $intCreateType rules governing FormAnswer object creation - defaults to CreateOrEdit
		 * @return FormAnswerMetaControl
		 */
		public static function CreateFromQueryString($objParentObject, $intCreateType = QMetaControlCreateType::CreateOrEdit) {
			$intId = QApplication::QueryString('intId');
			return FormAnswerMetaControl::Create($objParentObject, $intId, $intCreateType);
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
				$this->lblId->Text = $this->objFormAnswer->Id;
			else
				$this->lblId->Text = 'N/A';
			return $this->lblId;
		}

		/**
		 * Create and setup QListBox lstSignupEntry
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objConditions override the default condition of QQ::All() to the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause object or array of QQClause objects for the query
		 * @return QListBox
		 */
		public function lstSignupEntry_Create($strControlId = null, QQCondition $objCondition = null, $objOptionalClauses = null) {
			$this->lstSignupEntry = new QListBox($this->objParentObject, $strControlId);
			$this->lstSignupEntry->Name = QApplication::Translate('Signup Entry');
			$this->lstSignupEntry->Required = true;
			if (!$this->blnEditMode)
				$this->lstSignupEntry->AddItem(QApplication::Translate('- Select One -'), null);

			// Setup and perform the Query
			if (is_null($objCondition)) $objCondition = QQ::All();
			$objSignupEntryCursor = SignupEntry::QueryCursor($objCondition, $objOptionalClauses);

			// Iterate through the Cursor
			while ($objSignupEntry = SignupEntry::InstantiateCursor($objSignupEntryCursor)) {
				$objListItem = new QListItem($objSignupEntry->__toString(), $objSignupEntry->Id);
				if (($this->objFormAnswer->SignupEntry) && ($this->objFormAnswer->SignupEntry->Id == $objSignupEntry->Id))
					$objListItem->Selected = true;
				$this->lstSignupEntry->AddItem($objListItem);
			}

			// Return the QListBox
			return $this->lstSignupEntry;
		}

		/**
		 * Create and setup QLabel lblSignupEntryId
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblSignupEntryId_Create($strControlId = null) {
			$this->lblSignupEntryId = new QLabel($this->objParentObject, $strControlId);
			$this->lblSignupEntryId->Name = QApplication::Translate('Signup Entry');
			$this->lblSignupEntryId->Text = ($this->objFormAnswer->SignupEntry) ? $this->objFormAnswer->SignupEntry->__toString() : null;
			$this->lblSignupEntryId->Required = true;
			return $this->lblSignupEntryId;
		}

		/**
		 * Create and setup QListBox lstFormQuestion
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objConditions override the default condition of QQ::All() to the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause object or array of QQClause objects for the query
		 * @return QListBox
		 */
		public function lstFormQuestion_Create($strControlId = null, QQCondition $objCondition = null, $objOptionalClauses = null) {
			$this->lstFormQuestion = new QListBox($this->objParentObject, $strControlId);
			$this->lstFormQuestion->Name = QApplication::Translate('Form Question');
			$this->lstFormQuestion->Required = true;
			if (!$this->blnEditMode)
				$this->lstFormQuestion->AddItem(QApplication::Translate('- Select One -'), null);

			// Setup and perform the Query
			if (is_null($objCondition)) $objCondition = QQ::All();
			$objFormQuestionCursor = FormQuestion::QueryCursor($objCondition, $objOptionalClauses);

			// Iterate through the Cursor
			while ($objFormQuestion = FormQuestion::InstantiateCursor($objFormQuestionCursor)) {
				$objListItem = new QListItem($objFormQuestion->__toString(), $objFormQuestion->Id);
				if (($this->objFormAnswer->FormQuestion) && ($this->objFormAnswer->FormQuestion->Id == $objFormQuestion->Id))
					$objListItem->Selected = true;
				$this->lstFormQuestion->AddItem($objListItem);
			}

			// Return the QListBox
			return $this->lstFormQuestion;
		}

		/**
		 * Create and setup QLabel lblFormQuestionId
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblFormQuestionId_Create($strControlId = null) {
			$this->lblFormQuestionId = new QLabel($this->objParentObject, $strControlId);
			$this->lblFormQuestionId->Name = QApplication::Translate('Form Question');
			$this->lblFormQuestionId->Text = ($this->objFormAnswer->FormQuestion) ? $this->objFormAnswer->FormQuestion->__toString() : null;
			$this->lblFormQuestionId->Required = true;
			return $this->lblFormQuestionId;
		}

		/**
		 * Create and setup QTextBox txtTextValue
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtTextValue_Create($strControlId = null) {
			$this->txtTextValue = new QTextBox($this->objParentObject, $strControlId);
			$this->txtTextValue->Name = QApplication::Translate('Text Value');
			$this->txtTextValue->Text = $this->objFormAnswer->TextValue;
			$this->txtTextValue->TextMode = QTextMode::MultiLine;
			return $this->txtTextValue;
		}

		/**
		 * Create and setup QLabel lblTextValue
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblTextValue_Create($strControlId = null) {
			$this->lblTextValue = new QLabel($this->objParentObject, $strControlId);
			$this->lblTextValue->Name = QApplication::Translate('Text Value');
			$this->lblTextValue->Text = $this->objFormAnswer->TextValue;
			return $this->lblTextValue;
		}

		/**
		 * Create and setup QListBox lstAddress
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objConditions override the default condition of QQ::All() to the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause object or array of QQClause objects for the query
		 * @return QListBox
		 */
		public function lstAddress_Create($strControlId = null, QQCondition $objCondition = null, $objOptionalClauses = null) {
			$this->lstAddress = new QListBox($this->objParentObject, $strControlId);
			$this->lstAddress->Name = QApplication::Translate('Address');
			$this->lstAddress->AddItem(QApplication::Translate('- Select One -'), null);

			// Setup and perform the Query
			if (is_null($objCondition)) $objCondition = QQ::All();
			$objAddressCursor = Address::QueryCursor($objCondition, $objOptionalClauses);

			// Iterate through the Cursor
			while ($objAddress = Address::InstantiateCursor($objAddressCursor)) {
				$objListItem = new QListItem($objAddress->__toString(), $objAddress->Id);
				if (($this->objFormAnswer->Address) && ($this->objFormAnswer->Address->Id == $objAddress->Id))
					$objListItem->Selected = true;
				$this->lstAddress->AddItem($objListItem);
			}

			// Return the QListBox
			return $this->lstAddress;
		}

		/**
		 * Create and setup QLabel lblAddressId
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblAddressId_Create($strControlId = null) {
			$this->lblAddressId = new QLabel($this->objParentObject, $strControlId);
			$this->lblAddressId->Name = QApplication::Translate('Address');
			$this->lblAddressId->Text = ($this->objFormAnswer->Address) ? $this->objFormAnswer->Address->__toString() : null;
			return $this->lblAddressId;
		}

		/**
		 * Create and setup QListBox lstPhone
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objConditions override the default condition of QQ::All() to the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause object or array of QQClause objects for the query
		 * @return QListBox
		 */
		public function lstPhone_Create($strControlId = null, QQCondition $objCondition = null, $objOptionalClauses = null) {
			$this->lstPhone = new QListBox($this->objParentObject, $strControlId);
			$this->lstPhone->Name = QApplication::Translate('Phone');
			$this->lstPhone->AddItem(QApplication::Translate('- Select One -'), null);

			// Setup and perform the Query
			if (is_null($objCondition)) $objCondition = QQ::All();
			$objPhoneCursor = Phone::QueryCursor($objCondition, $objOptionalClauses);

			// Iterate through the Cursor
			while ($objPhone = Phone::InstantiateCursor($objPhoneCursor)) {
				$objListItem = new QListItem($objPhone->__toString(), $objPhone->Id);
				if (($this->objFormAnswer->Phone) && ($this->objFormAnswer->Phone->Id == $objPhone->Id))
					$objListItem->Selected = true;
				$this->lstPhone->AddItem($objListItem);
			}

			// Return the QListBox
			return $this->lstPhone;
		}

		/**
		 * Create and setup QLabel lblPhoneId
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblPhoneId_Create($strControlId = null) {
			$this->lblPhoneId = new QLabel($this->objParentObject, $strControlId);
			$this->lblPhoneId->Name = QApplication::Translate('Phone');
			$this->lblPhoneId->Text = ($this->objFormAnswer->Phone) ? $this->objFormAnswer->Phone->__toString() : null;
			return $this->lblPhoneId;
		}

		/**
		 * Create and setup QListBox lstEmail
		 * @param string $strControlId optional ControlId to use
		 * @param QQCondition $objConditions override the default condition of QQ::All() to the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause object or array of QQClause objects for the query
		 * @return QListBox
		 */
		public function lstEmail_Create($strControlId = null, QQCondition $objCondition = null, $objOptionalClauses = null) {
			$this->lstEmail = new QListBox($this->objParentObject, $strControlId);
			$this->lstEmail->Name = QApplication::Translate('Email');
			$this->lstEmail->AddItem(QApplication::Translate('- Select One -'), null);

			// Setup and perform the Query
			if (is_null($objCondition)) $objCondition = QQ::All();
			$objEmailCursor = Email::QueryCursor($objCondition, $objOptionalClauses);

			// Iterate through the Cursor
			while ($objEmail = Email::InstantiateCursor($objEmailCursor)) {
				$objListItem = new QListItem($objEmail->__toString(), $objEmail->Id);
				if (($this->objFormAnswer->Email) && ($this->objFormAnswer->Email->Id == $objEmail->Id))
					$objListItem->Selected = true;
				$this->lstEmail->AddItem($objListItem);
			}

			// Return the QListBox
			return $this->lstEmail;
		}

		/**
		 * Create and setup QLabel lblEmailId
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblEmailId_Create($strControlId = null) {
			$this->lblEmailId = new QLabel($this->objParentObject, $strControlId);
			$this->lblEmailId->Name = QApplication::Translate('Email');
			$this->lblEmailId->Text = ($this->objFormAnswer->Email) ? $this->objFormAnswer->Email->__toString() : null;
			return $this->lblEmailId;
		}

		/**
		 * Create and setup QIntegerTextBox txtIntegerValue
		 * @param string $strControlId optional ControlId to use
		 * @return QIntegerTextBox
		 */
		public function txtIntegerValue_Create($strControlId = null) {
			$this->txtIntegerValue = new QIntegerTextBox($this->objParentObject, $strControlId);
			$this->txtIntegerValue->Name = QApplication::Translate('Integer Value');
			$this->txtIntegerValue->Text = $this->objFormAnswer->IntegerValue;
			return $this->txtIntegerValue;
		}

		/**
		 * Create and setup QLabel lblIntegerValue
		 * @param string $strControlId optional ControlId to use
		 * @param string $strFormat optional sprintf format to use
		 * @return QLabel
		 */
		public function lblIntegerValue_Create($strControlId = null, $strFormat = null) {
			$this->lblIntegerValue = new QLabel($this->objParentObject, $strControlId);
			$this->lblIntegerValue->Name = QApplication::Translate('Integer Value');
			$this->lblIntegerValue->Text = $this->objFormAnswer->IntegerValue;
			$this->lblIntegerValue->Format = $strFormat;
			return $this->lblIntegerValue;
		}

		/**
		 * Create and setup QCheckBox chkBooleanValue
		 * @param string $strControlId optional ControlId to use
		 * @return QCheckBox
		 */
		public function chkBooleanValue_Create($strControlId = null) {
			$this->chkBooleanValue = new QCheckBox($this->objParentObject, $strControlId);
			$this->chkBooleanValue->Name = QApplication::Translate('Boolean Value');
			$this->chkBooleanValue->Checked = $this->objFormAnswer->BooleanValue;
			return $this->chkBooleanValue;
		}

		/**
		 * Create and setup QLabel lblBooleanValue
		 * @param string $strControlId optional ControlId to use
		 * @return QLabel
		 */
		public function lblBooleanValue_Create($strControlId = null) {
			$this->lblBooleanValue = new QLabel($this->objParentObject, $strControlId);
			$this->lblBooleanValue->Name = QApplication::Translate('Boolean Value');
			$this->lblBooleanValue->Text = ($this->objFormAnswer->BooleanValue) ? QApplication::Translate('Yes') : QApplication::Translate('No');
			return $this->lblBooleanValue;
		}

		/**
		 * Create and setup QDateTimePicker calDateValue
		 * @param string $strControlId optional ControlId to use
		 * @return QDateTimePicker
		 */
		public function calDateValue_Create($strControlId = null) {
			$this->calDateValue = new QDateTimePicker($this->objParentObject, $strControlId);
			$this->calDateValue->Name = QApplication::Translate('Date Value');
			$this->calDateValue->DateTime = $this->objFormAnswer->DateValue;
			$this->calDateValue->DateTimePickerType = QDateTimePickerType::Date;
			return $this->calDateValue;
		}

		/**
		 * Create and setup QLabel lblDateValue
		 * @param string $strControlId optional ControlId to use
		 * @param string $strDateTimeFormat optional DateTimeFormat to use
		 * @return QLabel
		 */
		public function lblDateValue_Create($strControlId = null, $strDateTimeFormat = null) {
			$this->lblDateValue = new QLabel($this->objParentObject, $strControlId);
			$this->lblDateValue->Name = QApplication::Translate('Date Value');
			$this->strDateValueDateTimeFormat = $strDateTimeFormat;
			$this->lblDateValue->Text = sprintf($this->objFormAnswer->DateValue) ? $this->objFormAnswer->DateValue->__toString($this->strDateValueDateTimeFormat) : null;
			return $this->lblDateValue;
		}

		protected $strDateValueDateTimeFormat;



		/**
		 * Refresh this MetaControl with Data from the local FormAnswer object.
		 * @param boolean $blnReload reload FormAnswer from the database
		 * @return void
		 */
		public function Refresh($blnReload = false) {
			if ($blnReload)
				$this->objFormAnswer->Reload();

			if ($this->lblId) if ($this->blnEditMode) $this->lblId->Text = $this->objFormAnswer->Id;

			if ($this->lstSignupEntry) {
					$this->lstSignupEntry->RemoveAllItems();
				if (!$this->blnEditMode)
					$this->lstSignupEntry->AddItem(QApplication::Translate('- Select One -'), null);
				$objSignupEntryArray = SignupEntry::LoadAll();
				if ($objSignupEntryArray) foreach ($objSignupEntryArray as $objSignupEntry) {
					$objListItem = new QListItem($objSignupEntry->__toString(), $objSignupEntry->Id);
					if (($this->objFormAnswer->SignupEntry) && ($this->objFormAnswer->SignupEntry->Id == $objSignupEntry->Id))
						$objListItem->Selected = true;
					$this->lstSignupEntry->AddItem($objListItem);
				}
			}
			if ($this->lblSignupEntryId) $this->lblSignupEntryId->Text = ($this->objFormAnswer->SignupEntry) ? $this->objFormAnswer->SignupEntry->__toString() : null;

			if ($this->lstFormQuestion) {
					$this->lstFormQuestion->RemoveAllItems();
				if (!$this->blnEditMode)
					$this->lstFormQuestion->AddItem(QApplication::Translate('- Select One -'), null);
				$objFormQuestionArray = FormQuestion::LoadAll();
				if ($objFormQuestionArray) foreach ($objFormQuestionArray as $objFormQuestion) {
					$objListItem = new QListItem($objFormQuestion->__toString(), $objFormQuestion->Id);
					if (($this->objFormAnswer->FormQuestion) && ($this->objFormAnswer->FormQuestion->Id == $objFormQuestion->Id))
						$objListItem->Selected = true;
					$this->lstFormQuestion->AddItem($objListItem);
				}
			}
			if ($this->lblFormQuestionId) $this->lblFormQuestionId->Text = ($this->objFormAnswer->FormQuestion) ? $this->objFormAnswer->FormQuestion->__toString() : null;

			if ($this->txtTextValue) $this->txtTextValue->Text = $this->objFormAnswer->TextValue;
			if ($this->lblTextValue) $this->lblTextValue->Text = $this->objFormAnswer->TextValue;

			if ($this->lstAddress) {
					$this->lstAddress->RemoveAllItems();
				$this->lstAddress->AddItem(QApplication::Translate('- Select One -'), null);
				$objAddressArray = Address::LoadAll();
				if ($objAddressArray) foreach ($objAddressArray as $objAddress) {
					$objListItem = new QListItem($objAddress->__toString(), $objAddress->Id);
					if (($this->objFormAnswer->Address) && ($this->objFormAnswer->Address->Id == $objAddress->Id))
						$objListItem->Selected = true;
					$this->lstAddress->AddItem($objListItem);
				}
			}
			if ($this->lblAddressId) $this->lblAddressId->Text = ($this->objFormAnswer->Address) ? $this->objFormAnswer->Address->__toString() : null;

			if ($this->lstPhone) {
					$this->lstPhone->RemoveAllItems();
				$this->lstPhone->AddItem(QApplication::Translate('- Select One -'), null);
				$objPhoneArray = Phone::LoadAll();
				if ($objPhoneArray) foreach ($objPhoneArray as $objPhone) {
					$objListItem = new QListItem($objPhone->__toString(), $objPhone->Id);
					if (($this->objFormAnswer->Phone) && ($this->objFormAnswer->Phone->Id == $objPhone->Id))
						$objListItem->Selected = true;
					$this->lstPhone->AddItem($objListItem);
				}
			}
			if ($this->lblPhoneId) $this->lblPhoneId->Text = ($this->objFormAnswer->Phone) ? $this->objFormAnswer->Phone->__toString() : null;

			if ($this->lstEmail) {
					$this->lstEmail->RemoveAllItems();
				$this->lstEmail->AddItem(QApplication::Translate('- Select One -'), null);
				$objEmailArray = Email::LoadAll();
				if ($objEmailArray) foreach ($objEmailArray as $objEmail) {
					$objListItem = new QListItem($objEmail->__toString(), $objEmail->Id);
					if (($this->objFormAnswer->Email) && ($this->objFormAnswer->Email->Id == $objEmail->Id))
						$objListItem->Selected = true;
					$this->lstEmail->AddItem($objListItem);
				}
			}
			if ($this->lblEmailId) $this->lblEmailId->Text = ($this->objFormAnswer->Email) ? $this->objFormAnswer->Email->__toString() : null;

			if ($this->txtIntegerValue) $this->txtIntegerValue->Text = $this->objFormAnswer->IntegerValue;
			if ($this->lblIntegerValue) $this->lblIntegerValue->Text = $this->objFormAnswer->IntegerValue;

			if ($this->chkBooleanValue) $this->chkBooleanValue->Checked = $this->objFormAnswer->BooleanValue;
			if ($this->lblBooleanValue) $this->lblBooleanValue->Text = ($this->objFormAnswer->BooleanValue) ? QApplication::Translate('Yes') : QApplication::Translate('No');

			if ($this->calDateValue) $this->calDateValue->DateTime = $this->objFormAnswer->DateValue;
			if ($this->lblDateValue) $this->lblDateValue->Text = sprintf($this->objFormAnswer->DateValue) ? $this->objFormAnswer->__toString($this->strDateValueDateTimeFormat) : null;

		}



		///////////////////////////////////////////////
		// PROTECTED UPDATE METHODS for ManyToManyReferences (if any)
		///////////////////////////////////////////////





		///////////////////////////////////////////////
		// PUBLIC FORMANSWER OBJECT MANIPULATORS
		///////////////////////////////////////////////

		/**
		 * This will save this object's FormAnswer instance,
		 * updating only the fields which have had a control created for it.
		 */
		public function SaveFormAnswer() {
			try {
				// Update any fields for controls that have been created
				if ($this->lstSignupEntry) $this->objFormAnswer->SignupEntryId = $this->lstSignupEntry->SelectedValue;
				if ($this->lstFormQuestion) $this->objFormAnswer->FormQuestionId = $this->lstFormQuestion->SelectedValue;
				if ($this->txtTextValue) $this->objFormAnswer->TextValue = $this->txtTextValue->Text;
				if ($this->lstAddress) $this->objFormAnswer->AddressId = $this->lstAddress->SelectedValue;
				if ($this->lstPhone) $this->objFormAnswer->PhoneId = $this->lstPhone->SelectedValue;
				if ($this->lstEmail) $this->objFormAnswer->EmailId = $this->lstEmail->SelectedValue;
				if ($this->txtIntegerValue) $this->objFormAnswer->IntegerValue = $this->txtIntegerValue->Text;
				if ($this->chkBooleanValue) $this->objFormAnswer->BooleanValue = $this->chkBooleanValue->Checked;
				if ($this->calDateValue) $this->objFormAnswer->DateValue = $this->calDateValue->DateTime;

				// Update any UniqueReverseReferences (if any) for controls that have been created for it

				// Save the FormAnswer object
				$this->objFormAnswer->Save();

				// Finally, update any ManyToManyReferences (if any)
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * This will DELETE this object's FormAnswer instance from the database.
		 * It will also unassociate itself from any ManyToManyReferences.
		 */
		public function DeleteFormAnswer() {
			$this->objFormAnswer->Delete();
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
				case 'FormAnswer': return $this->objFormAnswer;
				case 'TitleVerb': return $this->strTitleVerb;
				case 'EditMode': return $this->blnEditMode;

				// Controls that point to FormAnswer fields -- will be created dynamically if not yet created
				case 'IdControl':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'IdLabel':
					if (!$this->lblId) return $this->lblId_Create();
					return $this->lblId;
				case 'SignupEntryIdControl':
					if (!$this->lstSignupEntry) return $this->lstSignupEntry_Create();
					return $this->lstSignupEntry;
				case 'SignupEntryIdLabel':
					if (!$this->lblSignupEntryId) return $this->lblSignupEntryId_Create();
					return $this->lblSignupEntryId;
				case 'FormQuestionIdControl':
					if (!$this->lstFormQuestion) return $this->lstFormQuestion_Create();
					return $this->lstFormQuestion;
				case 'FormQuestionIdLabel':
					if (!$this->lblFormQuestionId) return $this->lblFormQuestionId_Create();
					return $this->lblFormQuestionId;
				case 'TextValueControl':
					if (!$this->txtTextValue) return $this->txtTextValue_Create();
					return $this->txtTextValue;
				case 'TextValueLabel':
					if (!$this->lblTextValue) return $this->lblTextValue_Create();
					return $this->lblTextValue;
				case 'AddressIdControl':
					if (!$this->lstAddress) return $this->lstAddress_Create();
					return $this->lstAddress;
				case 'AddressIdLabel':
					if (!$this->lblAddressId) return $this->lblAddressId_Create();
					return $this->lblAddressId;
				case 'PhoneIdControl':
					if (!$this->lstPhone) return $this->lstPhone_Create();
					return $this->lstPhone;
				case 'PhoneIdLabel':
					if (!$this->lblPhoneId) return $this->lblPhoneId_Create();
					return $this->lblPhoneId;
				case 'EmailIdControl':
					if (!$this->lstEmail) return $this->lstEmail_Create();
					return $this->lstEmail;
				case 'EmailIdLabel':
					if (!$this->lblEmailId) return $this->lblEmailId_Create();
					return $this->lblEmailId;
				case 'IntegerValueControl':
					if (!$this->txtIntegerValue) return $this->txtIntegerValue_Create();
					return $this->txtIntegerValue;
				case 'IntegerValueLabel':
					if (!$this->lblIntegerValue) return $this->lblIntegerValue_Create();
					return $this->lblIntegerValue;
				case 'BooleanValueControl':
					if (!$this->chkBooleanValue) return $this->chkBooleanValue_Create();
					return $this->chkBooleanValue;
				case 'BooleanValueLabel':
					if (!$this->lblBooleanValue) return $this->lblBooleanValue_Create();
					return $this->lblBooleanValue;
				case 'DateValueControl':
					if (!$this->calDateValue) return $this->calDateValue_Create();
					return $this->calDateValue;
				case 'DateValueLabel':
					if (!$this->lblDateValue) return $this->lblDateValue_Create();
					return $this->lblDateValue;
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
					// Controls that point to FormAnswer fields
					case 'IdControl':
						return ($this->lblId = QType::Cast($mixValue, 'QControl'));
					case 'SignupEntryIdControl':
						return ($this->lstSignupEntry = QType::Cast($mixValue, 'QControl'));
					case 'FormQuestionIdControl':
						return ($this->lstFormQuestion = QType::Cast($mixValue, 'QControl'));
					case 'TextValueControl':
						return ($this->txtTextValue = QType::Cast($mixValue, 'QControl'));
					case 'AddressIdControl':
						return ($this->lstAddress = QType::Cast($mixValue, 'QControl'));
					case 'PhoneIdControl':
						return ($this->lstPhone = QType::Cast($mixValue, 'QControl'));
					case 'EmailIdControl':
						return ($this->lstEmail = QType::Cast($mixValue, 'QControl'));
					case 'IntegerValueControl':
						return ($this->txtIntegerValue = QType::Cast($mixValue, 'QControl'));
					case 'BooleanValueControl':
						return ($this->chkBooleanValue = QType::Cast($mixValue, 'QControl'));
					case 'DateValueControl':
						return ($this->calDateValue = QType::Cast($mixValue, 'QControl'));
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