<?php
	/**
	 * The abstract SignupEntryGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the SignupEntry subclass which
	 * extends this SignupEntryGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the SignupEntry class.
	 * 
	 * @package ALCF ChMS
	 * @subpackage GeneratedDataObjects
	 * @property integer $Id the value for intId (Read-Only PK)
	 * @property integer $SignupFormId the value for intSignupFormId (Not Null)
	 * @property integer $PersonId the value for intPersonId 
	 * @property integer $SignupByPersonId the value for intSignupByPersonId 
	 * @property integer $SignupEntryStatusTypeId the value for intSignupEntryStatusTypeId (Not Null)
	 * @property QDateTime $DateCreated the value for dttDateCreated (Not Null)
	 * @property QDateTime $DateSubmitted the value for dttDateSubmitted 
	 * @property double $AmountTotal the value for fltAmountTotal 
	 * @property double $AmountPaid the value for fltAmountPaid 
	 * @property double $AmountBalance the value for fltAmountBalance 
	 * @property string $InternalNotes the value for strInternalNotes 
	 * @property integer $CommunicationsEntryId the value for intCommunicationsEntryId 
	 * @property SignupForm $SignupForm the value for the SignupForm object referenced by intSignupFormId (Not Null)
	 * @property Person $Person the value for the Person object referenced by intPersonId 
	 * @property Person $SignupByPerson the value for the Person object referenced by intSignupByPersonId 
	 * @property CommunicationListEntry $CommunicationsEntry the value for the CommunicationListEntry object referenced by intCommunicationsEntryId 
	 * @property ClassRegistration $ClassRegistration the value for the ClassRegistration object that uniquely references this SignupEntry
	 * @property FormAnswer $_FormAnswer the value for the private _objFormAnswer (Read-Only) if set due to an expansion on the form_answer.signup_entry_id reverse relationship
	 * @property FormAnswer[] $_FormAnswerArray the value for the private _objFormAnswerArray (Read-Only) if set due to an ExpandAsArray on the form_answer.signup_entry_id reverse relationship
	 * @property SignupPayment $_SignupPayment the value for the private _objSignupPayment (Read-Only) if set due to an expansion on the signup_payment.signup_entry_id reverse relationship
	 * @property SignupPayment[] $_SignupPaymentArray the value for the private _objSignupPaymentArray (Read-Only) if set due to an ExpandAsArray on the signup_payment.signup_entry_id reverse relationship
	 * @property SignupProduct $_SignupProduct the value for the private _objSignupProduct (Read-Only) if set due to an expansion on the signup_product.signup_entry_id reverse relationship
	 * @property SignupProduct[] $_SignupProductArray the value for the private _objSignupProductArray (Read-Only) if set due to an ExpandAsArray on the signup_product.signup_entry_id reverse relationship
	 * @property boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class SignupEntryGen extends QBaseClass {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column signup_entry.id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column signup_entry.signup_form_id
		 * @var integer intSignupFormId
		 */
		protected $intSignupFormId;
		const SignupFormIdDefault = null;


		/**
		 * Protected member variable that maps to the database column signup_entry.person_id
		 * @var integer intPersonId
		 */
		protected $intPersonId;
		const PersonIdDefault = null;


		/**
		 * Protected member variable that maps to the database column signup_entry.signup_by_person_id
		 * @var integer intSignupByPersonId
		 */
		protected $intSignupByPersonId;
		const SignupByPersonIdDefault = null;


		/**
		 * Protected member variable that maps to the database column signup_entry.signup_entry_status_type_id
		 * @var integer intSignupEntryStatusTypeId
		 */
		protected $intSignupEntryStatusTypeId;
		const SignupEntryStatusTypeIdDefault = null;


		/**
		 * Protected member variable that maps to the database column signup_entry.date_created
		 * @var QDateTime dttDateCreated
		 */
		protected $dttDateCreated;
		const DateCreatedDefault = null;


		/**
		 * Protected member variable that maps to the database column signup_entry.date_submitted
		 * @var QDateTime dttDateSubmitted
		 */
		protected $dttDateSubmitted;
		const DateSubmittedDefault = null;


		/**
		 * Protected member variable that maps to the database column signup_entry.amount_total
		 * @var double fltAmountTotal
		 */
		protected $fltAmountTotal;
		const AmountTotalDefault = null;


		/**
		 * Protected member variable that maps to the database column signup_entry.amount_paid
		 * @var double fltAmountPaid
		 */
		protected $fltAmountPaid;
		const AmountPaidDefault = null;


		/**
		 * Protected member variable that maps to the database column signup_entry.amount_balance
		 * @var double fltAmountBalance
		 */
		protected $fltAmountBalance;
		const AmountBalanceDefault = null;


		/**
		 * Protected member variable that maps to the database column signup_entry.internal_notes
		 * @var string strInternalNotes
		 */
		protected $strInternalNotes;
		const InternalNotesDefault = null;


		/**
		 * Protected member variable that maps to the database column signup_entry.communications_entry_id
		 * @var integer intCommunicationsEntryId
		 */
		protected $intCommunicationsEntryId;
		const CommunicationsEntryIdDefault = null;


		/**
		 * Private member variable that stores a reference to a single FormAnswer object
		 * (of type FormAnswer), if this SignupEntry object was restored with
		 * an expansion on the form_answer association table.
		 * @var FormAnswer _objFormAnswer;
		 */
		private $_objFormAnswer;

		/**
		 * Private member variable that stores a reference to an array of FormAnswer objects
		 * (of type FormAnswer[]), if this SignupEntry object was restored with
		 * an ExpandAsArray on the form_answer association table.
		 * @var FormAnswer[] _objFormAnswerArray;
		 */
		private $_objFormAnswerArray = array();

		/**
		 * Private member variable that stores a reference to a single SignupPayment object
		 * (of type SignupPayment), if this SignupEntry object was restored with
		 * an expansion on the signup_payment association table.
		 * @var SignupPayment _objSignupPayment;
		 */
		private $_objSignupPayment;

		/**
		 * Private member variable that stores a reference to an array of SignupPayment objects
		 * (of type SignupPayment[]), if this SignupEntry object was restored with
		 * an ExpandAsArray on the signup_payment association table.
		 * @var SignupPayment[] _objSignupPaymentArray;
		 */
		private $_objSignupPaymentArray = array();

		/**
		 * Private member variable that stores a reference to a single SignupProduct object
		 * (of type SignupProduct), if this SignupEntry object was restored with
		 * an expansion on the signup_product association table.
		 * @var SignupProduct _objSignupProduct;
		 */
		private $_objSignupProduct;

		/**
		 * Private member variable that stores a reference to an array of SignupProduct objects
		 * (of type SignupProduct[]), if this SignupEntry object was restored with
		 * an ExpandAsArray on the signup_product association table.
		 * @var SignupProduct[] _objSignupProductArray;
		 */
		private $_objSignupProductArray = array();

		/**
		 * Protected array of virtual attributes for this object (e.g. extra/other calculated and/or non-object bound
		 * columns from the run-time database query result for this object).  Used by InstantiateDbRow and
		 * GetVirtualAttribute.
		 * @var string[] $__strVirtualAttributeArray
		 */
		protected $__strVirtualAttributeArray = array();

		/**
		 * Protected internal member variable that specifies whether or not this object is Restored from the database.
		 * Used by Save() to determine if Save() should perform a db UPDATE or INSERT.
		 * @var bool __blnRestored;
		 */
		protected $__blnRestored;




		///////////////////////////////
		// PROTECTED MEMBER OBJECTS
		///////////////////////////////

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column signup_entry.signup_form_id.
		 *
		 * NOTE: Always use the SignupForm property getter to correctly retrieve this SignupForm object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var SignupForm objSignupForm
		 */
		protected $objSignupForm;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column signup_entry.person_id.
		 *
		 * NOTE: Always use the Person property getter to correctly retrieve this Person object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Person objPerson
		 */
		protected $objPerson;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column signup_entry.signup_by_person_id.
		 *
		 * NOTE: Always use the SignupByPerson property getter to correctly retrieve this Person object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Person objSignupByPerson
		 */
		protected $objSignupByPerson;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column signup_entry.communications_entry_id.
		 *
		 * NOTE: Always use the CommunicationsEntry property getter to correctly retrieve this CommunicationListEntry object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var CommunicationListEntry objCommunicationsEntry
		 */
		protected $objCommunicationsEntry;

		/**
		 * Protected member variable that contains the object which points to
		 * this object by the reference in the unique database column class_registration.signup_entry_id.
		 *
		 * NOTE: Always use the ClassRegistration property getter to correctly retrieve this ClassRegistration object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var ClassRegistration objClassRegistration
		 */
		protected $objClassRegistration;
		
		/**
		 * Used internally to manage whether the adjoined ClassRegistration object
		 * needs to be updated on save.
		 * 
		 * NOTE: Do not manually update this value 
		 */
		protected $blnDirtyClassRegistration;





		///////////////////////////////
		// CLASS-WIDE LOAD AND COUNT METHODS
		///////////////////////////////

		/**
		 * Static method to retrieve the Database object that owns this class.
		 * @return QDatabaseBase reference to the Database object that can query this class
		 */
		public static function GetDatabase() {
			return QApplication::$Database[1];
		}

		/**
		 * Load a SignupEntry from PK Info
		 * @param integer $intId
		 * @return SignupEntry
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return SignupEntry::QuerySingle(
				QQ::Equal(QQN::SignupEntry()->Id, $intId)
			);
		}

		/**
		 * Load all SignupEntries
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return SignupEntry[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call SignupEntry::QueryArray to perform the LoadAll query
			try {
				return SignupEntry::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all SignupEntries
		 * @return int
		 */
		public static function CountAll() {
			// Call SignupEntry::QueryCount to perform the CountAll query
			return SignupEntry::QueryCount(QQ::All());
		}




		///////////////////////////////
		// QCODO QUERY-RELATED METHODS
		///////////////////////////////

		/**
		 * Internally called method to assist with calling Qcodo Query for this class
		 * on load methods.
		 * @param QQueryBuilder &$objQueryBuilder the QueryBuilder object that will be created
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause object or array of QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with (sending in null will skip the PrepareStatement step)
		 * @param boolean $blnCountOnly only select a rowcount
		 * @return string the query statement
		 */
		protected static function BuildQueryStatement(&$objQueryBuilder, QQCondition $objConditions, $objOptionalClauses, $mixParameterArray, $blnCountOnly) {
			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Create/Build out the QueryBuilder object with SignupEntry-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'signup_entry');
			SignupEntry::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('signup_entry');

			// Set "CountOnly" option (if applicable)
			if ($blnCountOnly)
				$objQueryBuilder->SetCountOnlyFlag();

			// Apply Any Conditions
			if ($objConditions)
				try {
					$objConditions->UpdateQueryBuilder($objQueryBuilder);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

			// Iterate through all the Optional Clauses (if any) and perform accordingly
			if ($objOptionalClauses) {
				if ($objOptionalClauses instanceof QQClause)
					$objOptionalClauses->UpdateQueryBuilder($objQueryBuilder);
				else if (is_array($objOptionalClauses))
					foreach ($objOptionalClauses as $objClause)
						$objClause->UpdateQueryBuilder($objQueryBuilder);
				else
					throw new QCallerException('Optional Clauses must be a QQClause object or an array of QQClause objects');
			}

			// Get the SQL Statement
			$strQuery = $objQueryBuilder->GetStatement();

			// Prepare the Statement with the Query Parameters (if applicable)
			if ($mixParameterArray) {
				if (is_array($mixParameterArray)) {
					if (count($mixParameterArray))
						$strQuery = $objDatabase->PrepareStatement($strQuery, $mixParameterArray);

					// Ensure that there are no other Unresolved Named Parameters
					if (strpos($strQuery, chr(QQNamedValue::DelimiterCode) . '{') !== false)
						throw new QCallerException('Unresolved named parameters in the query');
				} else
					throw new QCallerException('Parameter Array must be an array of name-value parameter pairs');
			}

			// Return the Objects
			return $strQuery;
		}

		/**
		 * Static Qcodo Query method to query for a single SignupEntry object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return SignupEntry the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = SignupEntry::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Instantiate a new SignupEntry object and return it

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNodes) {
				$objToReturn = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = SignupEntry::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNodes, $objToReturn, $objQueryBuilder->ColumnAliasArray);
					if ($objItem) $objToReturn[] = $objItem;
				}

				if (count($objToReturn)) {
					// Since we only want the object to return, lets return the object and not the array.
					return $objToReturn[0];
				} else {
					return null;
				}
			} else {
				// No expands just return the first row
				$objDbRow = $objDbResult->GetNextRow();
				if (is_null($objDbRow)) return null;
				return SignupEntry::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcodo Query method to query for an array of SignupEntry objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return SignupEntry[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = SignupEntry::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return SignupEntry::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes, $objQueryBuilder->ColumnAliasArray);
		}

		/**
		 * Static Qcodo query method to issue a query and get a cursor to progressively fetch its results.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return QDatabaseResultBase the cursor resource instance
		 */
		public static function QueryCursor(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the query statement
			try {
				$strQuery = SignupEntry::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the query
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
		
			// Return the results cursor
			$objDbResult->QueryBuilder = $objQueryBuilder;
			return $objDbResult;
		}

		/**
		 * Static Qcodo Query method to query for a count of SignupEntry objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = SignupEntry::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and return the row_count
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Figure out if the query is using GroupBy
			$blnGrouped = false;

			if ($objOptionalClauses) foreach ($objOptionalClauses as $objClause) {
				if ($objClause instanceof QQGroupBy) {
					$blnGrouped = true;
					break;
				}
			}

			if ($blnGrouped)
				// Groups in this query - return the count of Groups (which is the count of all rows)
				return $objDbResult->CountRows();
			else {
				// No Groups - return the sql-calculated count(*) value
				$strDbRow = $objDbResult->FetchRow();
				return QType::Cast($strDbRow[0], QType::Integer);
			}
		}

/*		public static function QueryArrayCached($strConditions, $mixParameterArray = null) {
			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'signup_entry_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with SignupEntry-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				SignupEntry::GetSelectFields($objQueryBuilder);
				SignupEntry::GetFromFields($objQueryBuilder);

				// Ensure the Passed-in Conditions is a string
				try {
					$strConditions = QType::Cast($strConditions, QType::String);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				// Create the Conditions object, and apply it
				$objConditions = eval('return ' . $strConditions . ';');

				// Apply Any Conditions
				if ($objConditions)
					$objConditions->UpdateQueryBuilder($objQueryBuilder);

				// Get the SQL Statement
				$strQuery = $objQueryBuilder->GetStatement();

				// Save the SQL Statement in the Cache
				$objCache->SaveData($strQuery);
			}

			// Prepare the Statement with the Parameters
			if ($mixParameterArray)
				$strQuery = $objDatabase->PrepareStatement($strQuery, $mixParameterArray);

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objDatabase->Query($strQuery);
			return SignupEntry::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this SignupEntry
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'signup_entry';
				$strAliasPrefix = '';
			}

			$objBuilder->AddSelectItem($strTableName, 'id', $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName, 'signup_form_id', $strAliasPrefix . 'signup_form_id');
			$objBuilder->AddSelectItem($strTableName, 'person_id', $strAliasPrefix . 'person_id');
			$objBuilder->AddSelectItem($strTableName, 'signup_by_person_id', $strAliasPrefix . 'signup_by_person_id');
			$objBuilder->AddSelectItem($strTableName, 'signup_entry_status_type_id', $strAliasPrefix . 'signup_entry_status_type_id');
			$objBuilder->AddSelectItem($strTableName, 'date_created', $strAliasPrefix . 'date_created');
			$objBuilder->AddSelectItem($strTableName, 'date_submitted', $strAliasPrefix . 'date_submitted');
			$objBuilder->AddSelectItem($strTableName, 'amount_total', $strAliasPrefix . 'amount_total');
			$objBuilder->AddSelectItem($strTableName, 'amount_paid', $strAliasPrefix . 'amount_paid');
			$objBuilder->AddSelectItem($strTableName, 'amount_balance', $strAliasPrefix . 'amount_balance');
			$objBuilder->AddSelectItem($strTableName, 'internal_notes', $strAliasPrefix . 'internal_notes');
			$objBuilder->AddSelectItem($strTableName, 'communications_entry_id', $strAliasPrefix . 'communications_entry_id');
		}




		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a SignupEntry from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this SignupEntry::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param QDatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param string $strExpandAsArrayNodes
		 * @param QBaseClass $objPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return SignupEntry
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null, $strColumnAliasArray = array()) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			$strAlias = $strAliasPrefix . 'id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intId == $objDbRow->GetColumn($strAliasName, 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'signup_entry__';


				$strAlias = $strAliasPrefix . 'formanswer__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objFormAnswerArray)) {
						$objPreviousChildItem = $objPreviousItem->_objFormAnswerArray[$intPreviousChildItemCount - 1];
						$objChildItem = FormAnswer::InstantiateDbRow($objDbRow, $strAliasPrefix . 'formanswer__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objFormAnswerArray[] = $objChildItem;
					} else
						$objPreviousItem->_objFormAnswerArray[] = FormAnswer::InstantiateDbRow($objDbRow, $strAliasPrefix . 'formanswer__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}

				$strAlias = $strAliasPrefix . 'signuppayment__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objSignupPaymentArray)) {
						$objPreviousChildItem = $objPreviousItem->_objSignupPaymentArray[$intPreviousChildItemCount - 1];
						$objChildItem = SignupPayment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'signuppayment__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objSignupPaymentArray[] = $objChildItem;
					} else
						$objPreviousItem->_objSignupPaymentArray[] = SignupPayment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'signuppayment__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}

				$strAlias = $strAliasPrefix . 'signupproduct__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objSignupProductArray)) {
						$objPreviousChildItem = $objPreviousItem->_objSignupProductArray[$intPreviousChildItemCount - 1];
						$objChildItem = SignupProduct::InstantiateDbRow($objDbRow, $strAliasPrefix . 'signupproduct__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objSignupProductArray[] = $objChildItem;
					} else
						$objPreviousItem->_objSignupProductArray[] = SignupProduct::InstantiateDbRow($objDbRow, $strAliasPrefix . 'signupproduct__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'signup_entry__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the SignupEntry object
			$objToReturn = new SignupEntry();
			$objToReturn->__blnRestored = true;

			$strAliasName = array_key_exists($strAliasPrefix . 'id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'id'] : $strAliasPrefix . 'id';
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'signup_form_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'signup_form_id'] : $strAliasPrefix . 'signup_form_id';
			$objToReturn->intSignupFormId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'person_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'person_id'] : $strAliasPrefix . 'person_id';
			$objToReturn->intPersonId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'signup_by_person_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'signup_by_person_id'] : $strAliasPrefix . 'signup_by_person_id';
			$objToReturn->intSignupByPersonId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'signup_entry_status_type_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'signup_entry_status_type_id'] : $strAliasPrefix . 'signup_entry_status_type_id';
			$objToReturn->intSignupEntryStatusTypeId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'date_created', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'date_created'] : $strAliasPrefix . 'date_created';
			$objToReturn->dttDateCreated = $objDbRow->GetColumn($strAliasName, 'DateTime');
			$strAliasName = array_key_exists($strAliasPrefix . 'date_submitted', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'date_submitted'] : $strAliasPrefix . 'date_submitted';
			$objToReturn->dttDateSubmitted = $objDbRow->GetColumn($strAliasName, 'DateTime');
			$strAliasName = array_key_exists($strAliasPrefix . 'amount_total', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'amount_total'] : $strAliasPrefix . 'amount_total';
			$objToReturn->fltAmountTotal = $objDbRow->GetColumn($strAliasName, 'Float');
			$strAliasName = array_key_exists($strAliasPrefix . 'amount_paid', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'amount_paid'] : $strAliasPrefix . 'amount_paid';
			$objToReturn->fltAmountPaid = $objDbRow->GetColumn($strAliasName, 'Float');
			$strAliasName = array_key_exists($strAliasPrefix . 'amount_balance', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'amount_balance'] : $strAliasPrefix . 'amount_balance';
			$objToReturn->fltAmountBalance = $objDbRow->GetColumn($strAliasName, 'Float');
			$strAliasName = array_key_exists($strAliasPrefix . 'internal_notes', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'internal_notes'] : $strAliasPrefix . 'internal_notes';
			$objToReturn->strInternalNotes = $objDbRow->GetColumn($strAliasName, 'Blob');
			$strAliasName = array_key_exists($strAliasPrefix . 'communications_entry_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'communications_entry_id'] : $strAliasPrefix . 'communications_entry_id';
			$objToReturn->intCommunicationsEntryId = $objDbRow->GetColumn($strAliasName, 'Integer');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'signup_entry__';

			// Check for SignupForm Early Binding
			$strAlias = $strAliasPrefix . 'signup_form_id__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName)))
				$objToReturn->objSignupForm = SignupForm::InstantiateDbRow($objDbRow, $strAliasPrefix . 'signup_form_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);

			// Check for Person Early Binding
			$strAlias = $strAliasPrefix . 'person_id__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName)))
				$objToReturn->objPerson = Person::InstantiateDbRow($objDbRow, $strAliasPrefix . 'person_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);

			// Check for SignupByPerson Early Binding
			$strAlias = $strAliasPrefix . 'signup_by_person_id__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName)))
				$objToReturn->objSignupByPerson = Person::InstantiateDbRow($objDbRow, $strAliasPrefix . 'signup_by_person_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);

			// Check for CommunicationsEntry Early Binding
			$strAlias = $strAliasPrefix . 'communications_entry_id__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName)))
				$objToReturn->objCommunicationsEntry = CommunicationListEntry::InstantiateDbRow($objDbRow, $strAliasPrefix . 'communications_entry_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);


			// Check for ClassRegistration Unique ReverseReference Binding
			$strAlias = $strAliasPrefix . 'classregistration__signup_entry_id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if ($objDbRow->ColumnExists($strAliasName)) {
				if (!is_null($objDbRow->GetColumn($strAliasName)))
					$objToReturn->objClassRegistration = ClassRegistration::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classregistration__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					// We ATTEMPTED to do an Early Bind but the Object Doesn't Exist
					// Let's set to FALSE so that the object knows not to try and re-query again
					$objToReturn->objClassRegistration = false;
			}



			// Check for FormAnswer Virtual Binding
			$strAlias = $strAliasPrefix . 'formanswer__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objFormAnswerArray[] = FormAnswer::InstantiateDbRow($objDbRow, $strAliasPrefix . 'formanswer__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objFormAnswer = FormAnswer::InstantiateDbRow($objDbRow, $strAliasPrefix . 'formanswer__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}

			// Check for SignupPayment Virtual Binding
			$strAlias = $strAliasPrefix . 'signuppayment__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objSignupPaymentArray[] = SignupPayment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'signuppayment__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objSignupPayment = SignupPayment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'signuppayment__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}

			// Check for SignupProduct Virtual Binding
			$strAlias = $strAliasPrefix . 'signupproduct__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objSignupProductArray[] = SignupProduct::InstantiateDbRow($objDbRow, $strAliasPrefix . 'signupproduct__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objSignupProduct = SignupProduct::InstantiateDbRow($objDbRow, $strAliasPrefix . 'signupproduct__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of SignupEntries from a Database Result
		 * @param QDatabaseResultBase $objDbResult
		 * @param string $strExpandAsArrayNodes
		 * @param string[] $strColumnAliasArray
		 * @return SignupEntry[]
		 */
		public static function InstantiateDbResult(QDatabaseResultBase $objDbResult, $strExpandAsArrayNodes = null, $strColumnAliasArray = null) {
			$objToReturn = array();
			
			if (!$strColumnAliasArray)
				$strColumnAliasArray = array();

			// If blank resultset, then return empty array
			if (!$objDbResult)
				return $objToReturn;

			// Load up the return array with each row
			if ($strExpandAsArrayNodes) {
				$objLastRowItem = null;
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = SignupEntry::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = SignupEntry::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate a single SignupEntry object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return SignupEntry next row resulting from the query
		 */
		public static function InstantiateCursor(QDatabaseResultBase $objDbResult) {
			// If blank resultset, then return empty result
			if (!$objDbResult) return null;

			// If empty resultset, then return empty result
			$objDbRow = $objDbResult->GetNextRow();
			if (!$objDbRow) return null;

			// We need the Column Aliases
			$strColumnAliasArray = $objDbResult->QueryBuilder->ColumnAliasArray;
			if (!$strColumnAliasArray) $strColumnAliasArray = array();

			// Pull Expansions (if applicable)
			$strExpandAsArrayNodes = $objDbResult->QueryBuilder->ExpandAsArrayNodes;

			// Load up the return result with a row and return it
			return SignupEntry::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single SignupEntry object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return SignupEntry
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return SignupEntry::QuerySingle(
				QQ::Equal(QQN::SignupEntry()->Id, $intId)
			, $objOptionalClauses
			);
		}
			
		/**
		 * Load an array of SignupEntry objects,
		 * by SignupFormId, PersonId, SignupEntryStatusTypeId Index(es)
		 * @param integer $intSignupFormId
		 * @param integer $intPersonId
		 * @param integer $intSignupEntryStatusTypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return SignupEntry[]
		*/
		public static function LoadArrayBySignupFormIdPersonIdSignupEntryStatusTypeId($intSignupFormId, $intPersonId, $intSignupEntryStatusTypeId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryArray to perform the LoadArrayBySignupFormIdPersonIdSignupEntryStatusTypeId query
			try {
				return SignupEntry::QueryArray(
					QQ::AndCondition(
					QQ::Equal(QQN::SignupEntry()->SignupFormId, $intSignupFormId),
					QQ::Equal(QQN::SignupEntry()->PersonId, $intPersonId),
					QQ::Equal(QQN::SignupEntry()->SignupEntryStatusTypeId, $intSignupEntryStatusTypeId)
					),
					$objOptionalClauses
					);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count SignupEntries
		 * by SignupFormId, PersonId, SignupEntryStatusTypeId Index(es)
		 * @param integer $intSignupFormId
		 * @param integer $intPersonId
		 * @param integer $intSignupEntryStatusTypeId
		 * @return int
		*/
		public static function CountBySignupFormIdPersonIdSignupEntryStatusTypeId($intSignupFormId, $intPersonId, $intSignupEntryStatusTypeId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryCount to perform the CountBySignupFormIdPersonIdSignupEntryStatusTypeId query
			return SignupEntry::QueryCount(
				QQ::AndCondition(
				QQ::Equal(QQN::SignupEntry()->SignupFormId, $intSignupFormId),
				QQ::Equal(QQN::SignupEntry()->PersonId, $intPersonId),
				QQ::Equal(QQN::SignupEntry()->SignupEntryStatusTypeId, $intSignupEntryStatusTypeId)
				)
			, $objOptionalClauses
			);
		}
			
		/**
		 * Load an array of SignupEntry objects,
		 * by SignupFormId, SignupEntryStatusTypeId Index(es)
		 * @param integer $intSignupFormId
		 * @param integer $intSignupEntryStatusTypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return SignupEntry[]
		*/
		public static function LoadArrayBySignupFormIdSignupEntryStatusTypeId($intSignupFormId, $intSignupEntryStatusTypeId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryArray to perform the LoadArrayBySignupFormIdSignupEntryStatusTypeId query
			try {
				return SignupEntry::QueryArray(
					QQ::AndCondition(
					QQ::Equal(QQN::SignupEntry()->SignupFormId, $intSignupFormId),
					QQ::Equal(QQN::SignupEntry()->SignupEntryStatusTypeId, $intSignupEntryStatusTypeId)
					),
					$objOptionalClauses
					);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count SignupEntries
		 * by SignupFormId, SignupEntryStatusTypeId Index(es)
		 * @param integer $intSignupFormId
		 * @param integer $intSignupEntryStatusTypeId
		 * @return int
		*/
		public static function CountBySignupFormIdSignupEntryStatusTypeId($intSignupFormId, $intSignupEntryStatusTypeId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryCount to perform the CountBySignupFormIdSignupEntryStatusTypeId query
			return SignupEntry::QueryCount(
				QQ::AndCondition(
				QQ::Equal(QQN::SignupEntry()->SignupFormId, $intSignupFormId),
				QQ::Equal(QQN::SignupEntry()->SignupEntryStatusTypeId, $intSignupEntryStatusTypeId)
				)
			, $objOptionalClauses
			);
		}
			
		/**
		 * Load an array of SignupEntry objects,
		 * by SignupFormId Index(es)
		 * @param integer $intSignupFormId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return SignupEntry[]
		*/
		public static function LoadArrayBySignupFormId($intSignupFormId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryArray to perform the LoadArrayBySignupFormId query
			try {
				return SignupEntry::QueryArray(
					QQ::Equal(QQN::SignupEntry()->SignupFormId, $intSignupFormId),
					$objOptionalClauses
					);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count SignupEntries
		 * by SignupFormId Index(es)
		 * @param integer $intSignupFormId
		 * @return int
		*/
		public static function CountBySignupFormId($intSignupFormId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryCount to perform the CountBySignupFormId query
			return SignupEntry::QueryCount(
				QQ::Equal(QQN::SignupEntry()->SignupFormId, $intSignupFormId)
			, $objOptionalClauses
			);
		}
			
		/**
		 * Load an array of SignupEntry objects,
		 * by PersonId Index(es)
		 * @param integer $intPersonId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return SignupEntry[]
		*/
		public static function LoadArrayByPersonId($intPersonId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryArray to perform the LoadArrayByPersonId query
			try {
				return SignupEntry::QueryArray(
					QQ::Equal(QQN::SignupEntry()->PersonId, $intPersonId),
					$objOptionalClauses
					);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count SignupEntries
		 * by PersonId Index(es)
		 * @param integer $intPersonId
		 * @return int
		*/
		public static function CountByPersonId($intPersonId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryCount to perform the CountByPersonId query
			return SignupEntry::QueryCount(
				QQ::Equal(QQN::SignupEntry()->PersonId, $intPersonId)
			, $objOptionalClauses
			);
		}
			
		/**
		 * Load an array of SignupEntry objects,
		 * by SignupByPersonId Index(es)
		 * @param integer $intSignupByPersonId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return SignupEntry[]
		*/
		public static function LoadArrayBySignupByPersonId($intSignupByPersonId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryArray to perform the LoadArrayBySignupByPersonId query
			try {
				return SignupEntry::QueryArray(
					QQ::Equal(QQN::SignupEntry()->SignupByPersonId, $intSignupByPersonId),
					$objOptionalClauses
					);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count SignupEntries
		 * by SignupByPersonId Index(es)
		 * @param integer $intSignupByPersonId
		 * @return int
		*/
		public static function CountBySignupByPersonId($intSignupByPersonId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryCount to perform the CountBySignupByPersonId query
			return SignupEntry::QueryCount(
				QQ::Equal(QQN::SignupEntry()->SignupByPersonId, $intSignupByPersonId)
			, $objOptionalClauses
			);
		}
			
		/**
		 * Load an array of SignupEntry objects,
		 * by SignupEntryStatusTypeId Index(es)
		 * @param integer $intSignupEntryStatusTypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return SignupEntry[]
		*/
		public static function LoadArrayBySignupEntryStatusTypeId($intSignupEntryStatusTypeId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryArray to perform the LoadArrayBySignupEntryStatusTypeId query
			try {
				return SignupEntry::QueryArray(
					QQ::Equal(QQN::SignupEntry()->SignupEntryStatusTypeId, $intSignupEntryStatusTypeId),
					$objOptionalClauses
					);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count SignupEntries
		 * by SignupEntryStatusTypeId Index(es)
		 * @param integer $intSignupEntryStatusTypeId
		 * @return int
		*/
		public static function CountBySignupEntryStatusTypeId($intSignupEntryStatusTypeId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryCount to perform the CountBySignupEntryStatusTypeId query
			return SignupEntry::QueryCount(
				QQ::Equal(QQN::SignupEntry()->SignupEntryStatusTypeId, $intSignupEntryStatusTypeId)
			, $objOptionalClauses
			);
		}
			
		/**
		 * Load an array of SignupEntry objects,
		 * by CommunicationsEntryId Index(es)
		 * @param integer $intCommunicationsEntryId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return SignupEntry[]
		*/
		public static function LoadArrayByCommunicationsEntryId($intCommunicationsEntryId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryArray to perform the LoadArrayByCommunicationsEntryId query
			try {
				return SignupEntry::QueryArray(
					QQ::Equal(QQN::SignupEntry()->CommunicationsEntryId, $intCommunicationsEntryId),
					$objOptionalClauses
					);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count SignupEntries
		 * by CommunicationsEntryId Index(es)
		 * @param integer $intCommunicationsEntryId
		 * @return int
		*/
		public static function CountByCommunicationsEntryId($intCommunicationsEntryId, $objOptionalClauses = null) {
			// Call SignupEntry::QueryCount to perform the CountByCommunicationsEntryId query
			return SignupEntry::QueryCount(
				QQ::Equal(QQN::SignupEntry()->CommunicationsEntryId, $intCommunicationsEntryId)
			, $objOptionalClauses
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////




		//////////////////////////////////////
		// SAVE, DELETE, RELOAD and JOURNALING
		//////////////////////////////////////

		/**
		 * Save this SignupEntry
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		 */
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `signup_entry` (
							`signup_form_id`,
							`person_id`,
							`signup_by_person_id`,
							`signup_entry_status_type_id`,
							`date_created`,
							`date_submitted`,
							`amount_total`,
							`amount_paid`,
							`amount_balance`,
							`internal_notes`,
							`communications_entry_id`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intSignupFormId) . ',
							' . $objDatabase->SqlVariable($this->intPersonId) . ',
							' . $objDatabase->SqlVariable($this->intSignupByPersonId) . ',
							' . $objDatabase->SqlVariable($this->intSignupEntryStatusTypeId) . ',
							' . $objDatabase->SqlVariable($this->dttDateCreated) . ',
							' . $objDatabase->SqlVariable($this->dttDateSubmitted) . ',
							' . $objDatabase->SqlVariable($this->fltAmountTotal) . ',
							' . $objDatabase->SqlVariable($this->fltAmountPaid) . ',
							' . $objDatabase->SqlVariable($this->fltAmountBalance) . ',
							' . $objDatabase->SqlVariable($this->strInternalNotes) . ',
							' . $objDatabase->SqlVariable($this->intCommunicationsEntryId) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('signup_entry', 'id');

					// Journaling
					if ($objDatabase->JournalingDatabase) $this->Journal('INSERT');

				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`signup_entry`
						SET
							`signup_form_id` = ' . $objDatabase->SqlVariable($this->intSignupFormId) . ',
							`person_id` = ' . $objDatabase->SqlVariable($this->intPersonId) . ',
							`signup_by_person_id` = ' . $objDatabase->SqlVariable($this->intSignupByPersonId) . ',
							`signup_entry_status_type_id` = ' . $objDatabase->SqlVariable($this->intSignupEntryStatusTypeId) . ',
							`date_created` = ' . $objDatabase->SqlVariable($this->dttDateCreated) . ',
							`date_submitted` = ' . $objDatabase->SqlVariable($this->dttDateSubmitted) . ',
							`amount_total` = ' . $objDatabase->SqlVariable($this->fltAmountTotal) . ',
							`amount_paid` = ' . $objDatabase->SqlVariable($this->fltAmountPaid) . ',
							`amount_balance` = ' . $objDatabase->SqlVariable($this->fltAmountBalance) . ',
							`internal_notes` = ' . $objDatabase->SqlVariable($this->strInternalNotes) . ',
							`communications_entry_id` = ' . $objDatabase->SqlVariable($this->intCommunicationsEntryId) . '
						WHERE
							`id` = ' . $objDatabase->SqlVariable($this->intId) . '
					');

					// Journaling
					if ($objDatabase->JournalingDatabase) $this->Journal('UPDATE');
				}

		
		
				// Update the adjoined ClassRegistration object (if applicable)
				// TODO: Make this into hard-coded SQL queries
				if ($this->blnDirtyClassRegistration) {
					// Unassociate the old one (if applicable)
					if ($objAssociated = ClassRegistration::LoadBySignupEntryId($this->intId)) {
						$objAssociated->SignupEntryId = null;
						$objAssociated->Save();
					}

					// Associate the new one (if applicable)
					if ($this->objClassRegistration) {
						$this->objClassRegistration->SignupEntryId = $this->intId;
						$this->objClassRegistration->Save();
					}

					// Reset the "Dirty" flag
					$this->blnDirtyClassRegistration = false;
				}
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Update __blnRestored and any Non-Identity PK Columns (if applicable)
			$this->__blnRestored = true;


			// Return 
			return $mixToReturn;
		}

		/**
		 * Delete this SignupEntry
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this SignupEntry with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			
			
			// Update the adjoined ClassRegistration object (if applicable) and perform a delete

			// Optional -- if you **KNOW** that you do not want to EVER run any level of business logic on the disassocation,
			// you *could* override Delete() so that this step can be a single hard coded query to optimize performance.
			if ($objAssociated = ClassRegistration::LoadBySignupEntryId($this->intId)) {
				$objAssociated->Delete();
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`signup_entry`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			// Journaling
			if ($objDatabase->JournalingDatabase) $this->Journal('DELETE');
		}

		/**
		 * Delete all SignupEntries
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`signup_entry`');
		}

		/**
		 * Truncate signup_entry table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `signup_entry`');
		}

		/**
		 * Reload this SignupEntry from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved SignupEntry object.');

			// Reload the Object
			$objReloaded = SignupEntry::Load($this->intId);

			// Update $this's local variables to match
			$this->SignupFormId = $objReloaded->SignupFormId;
			$this->PersonId = $objReloaded->PersonId;
			$this->SignupByPersonId = $objReloaded->SignupByPersonId;
			$this->SignupEntryStatusTypeId = $objReloaded->SignupEntryStatusTypeId;
			$this->dttDateCreated = $objReloaded->dttDateCreated;
			$this->dttDateSubmitted = $objReloaded->dttDateSubmitted;
			$this->fltAmountTotal = $objReloaded->fltAmountTotal;
			$this->fltAmountPaid = $objReloaded->fltAmountPaid;
			$this->fltAmountBalance = $objReloaded->fltAmountBalance;
			$this->strInternalNotes = $objReloaded->strInternalNotes;
			$this->CommunicationsEntryId = $objReloaded->CommunicationsEntryId;
		}

		/**
		 * Journals the current object into the Log database.
		 * Used internally as a helper method.
		 * @param string $strJournalCommand
		 */
		public function Journal($strJournalCommand) {
			$objDatabase = SignupEntry::GetDatabase()->JournalingDatabase;

			$objDatabase->NonQuery('
				INSERT INTO `signup_entry` (
					`id`,
					`signup_form_id`,
					`person_id`,
					`signup_by_person_id`,
					`signup_entry_status_type_id`,
					`date_created`,
					`date_submitted`,
					`amount_total`,
					`amount_paid`,
					`amount_balance`,
					`internal_notes`,
					`communications_entry_id`,
					__sys_login_id,
					__sys_action,
					__sys_date
				) VALUES (
					' . $objDatabase->SqlVariable($this->intId) . ',
					' . $objDatabase->SqlVariable($this->intSignupFormId) . ',
					' . $objDatabase->SqlVariable($this->intPersonId) . ',
					' . $objDatabase->SqlVariable($this->intSignupByPersonId) . ',
					' . $objDatabase->SqlVariable($this->intSignupEntryStatusTypeId) . ',
					' . $objDatabase->SqlVariable($this->dttDateCreated) . ',
					' . $objDatabase->SqlVariable($this->dttDateSubmitted) . ',
					' . $objDatabase->SqlVariable($this->fltAmountTotal) . ',
					' . $objDatabase->SqlVariable($this->fltAmountPaid) . ',
					' . $objDatabase->SqlVariable($this->fltAmountBalance) . ',
					' . $objDatabase->SqlVariable($this->strInternalNotes) . ',
					' . $objDatabase->SqlVariable($this->intCommunicationsEntryId) . ',
					' . (($objDatabase->JournaledById) ? $objDatabase->JournaledById : 'NULL') . ',
					' . $objDatabase->SqlVariable($strJournalCommand) . ',
					NOW()
				);
			');
		}

		/**
		 * Gets the historical journal for an object from the log database.
		 * Objects will have VirtualAttributes available to lookup login, date, and action information from the journal object.
		 * @param integer intId
		 * @return SignupEntry[]
		 */
		public static function GetJournalForId($intId) {
			$objDatabase = SignupEntry::GetDatabase()->JournalingDatabase;

			$objResult = $objDatabase->Query('SELECT * FROM signup_entry WHERE id = ' .
				$objDatabase->SqlVariable($intId) . ' ORDER BY __sys_date');

			return SignupEntry::InstantiateDbResult($objResult);
		}

		/**
		 * Gets the historical journal for this object from the log database.
		 * Objects will have VirtualAttributes available to lookup login, date, and action information from the journal object.
		 * @return SignupEntry[]
		 */
		public function GetJournal() {
			return SignupEntry::GetJournalForId($this->intId);
		}




		////////////////////
		// PUBLIC OVERRIDERS
		////////////////////

				/**
		 * Override method to perform a property "Get"
		 * This will get the value of $strName
		 *
		 * @param string $strName Name of the property to get
		 * @return mixed
		 */
		public function __get($strName) {
			switch ($strName) {
				///////////////////
				// Member Variables
				///////////////////
				case 'Id':
					// Gets the value for intId (Read-Only PK)
					// @return integer
					return $this->intId;

				case 'SignupFormId':
					// Gets the value for intSignupFormId (Not Null)
					// @return integer
					return $this->intSignupFormId;

				case 'PersonId':
					// Gets the value for intPersonId 
					// @return integer
					return $this->intPersonId;

				case 'SignupByPersonId':
					// Gets the value for intSignupByPersonId 
					// @return integer
					return $this->intSignupByPersonId;

				case 'SignupEntryStatusTypeId':
					// Gets the value for intSignupEntryStatusTypeId (Not Null)
					// @return integer
					return $this->intSignupEntryStatusTypeId;

				case 'DateCreated':
					// Gets the value for dttDateCreated (Not Null)
					// @return QDateTime
					return $this->dttDateCreated;

				case 'DateSubmitted':
					// Gets the value for dttDateSubmitted 
					// @return QDateTime
					return $this->dttDateSubmitted;

				case 'AmountTotal':
					// Gets the value for fltAmountTotal 
					// @return double
					return $this->fltAmountTotal;

				case 'AmountPaid':
					// Gets the value for fltAmountPaid 
					// @return double
					return $this->fltAmountPaid;

				case 'AmountBalance':
					// Gets the value for fltAmountBalance 
					// @return double
					return $this->fltAmountBalance;

				case 'InternalNotes':
					// Gets the value for strInternalNotes 
					// @return string
					return $this->strInternalNotes;

				case 'CommunicationsEntryId':
					// Gets the value for intCommunicationsEntryId 
					// @return integer
					return $this->intCommunicationsEntryId;


				///////////////////
				// Member Objects
				///////////////////
				case 'SignupForm':
					// Gets the value for the SignupForm object referenced by intSignupFormId (Not Null)
					// @return SignupForm
					try {
						if ((!$this->objSignupForm) && (!is_null($this->intSignupFormId)))
							$this->objSignupForm = SignupForm::Load($this->intSignupFormId);
						return $this->objSignupForm;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Person':
					// Gets the value for the Person object referenced by intPersonId 
					// @return Person
					try {
						if ((!$this->objPerson) && (!is_null($this->intPersonId)))
							$this->objPerson = Person::Load($this->intPersonId);
						return $this->objPerson;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'SignupByPerson':
					// Gets the value for the Person object referenced by intSignupByPersonId 
					// @return Person
					try {
						if ((!$this->objSignupByPerson) && (!is_null($this->intSignupByPersonId)))
							$this->objSignupByPerson = Person::Load($this->intSignupByPersonId);
						return $this->objSignupByPerson;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'CommunicationsEntry':
					// Gets the value for the CommunicationListEntry object referenced by intCommunicationsEntryId 
					// @return CommunicationListEntry
					try {
						if ((!$this->objCommunicationsEntry) && (!is_null($this->intCommunicationsEntryId)))
							$this->objCommunicationsEntry = CommunicationListEntry::Load($this->intCommunicationsEntryId);
						return $this->objCommunicationsEntry;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

		
		
				case 'ClassRegistration':
					// Gets the value for the ClassRegistration object that uniquely references this SignupEntry
					// by objClassRegistration (Unique)
					// @return ClassRegistration
					try {
						if ($this->objClassRegistration === false)
							// We've attempted early binding -- and the reverse reference object does not exist
							return null;
						if (!$this->objClassRegistration)
							$this->objClassRegistration = ClassRegistration::LoadBySignupEntryId($this->intId);
						return $this->objClassRegistration;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_FormAnswer':
					// Gets the value for the private _objFormAnswer (Read-Only)
					// if set due to an expansion on the form_answer.signup_entry_id reverse relationship
					// @return FormAnswer
					return $this->_objFormAnswer;

				case '_FormAnswerArray':
					// Gets the value for the private _objFormAnswerArray (Read-Only)
					// if set due to an ExpandAsArray on the form_answer.signup_entry_id reverse relationship
					// @return FormAnswer[]
					return (array) $this->_objFormAnswerArray;

				case '_SignupPayment':
					// Gets the value for the private _objSignupPayment (Read-Only)
					// if set due to an expansion on the signup_payment.signup_entry_id reverse relationship
					// @return SignupPayment
					return $this->_objSignupPayment;

				case '_SignupPaymentArray':
					// Gets the value for the private _objSignupPaymentArray (Read-Only)
					// if set due to an ExpandAsArray on the signup_payment.signup_entry_id reverse relationship
					// @return SignupPayment[]
					return (array) $this->_objSignupPaymentArray;

				case '_SignupProduct':
					// Gets the value for the private _objSignupProduct (Read-Only)
					// if set due to an expansion on the signup_product.signup_entry_id reverse relationship
					// @return SignupProduct
					return $this->_objSignupProduct;

				case '_SignupProductArray':
					// Gets the value for the private _objSignupProductArray (Read-Only)
					// if set due to an ExpandAsArray on the signup_product.signup_entry_id reverse relationship
					// @return SignupProduct[]
					return (array) $this->_objSignupProductArray;


				case '__Restored':
					return $this->__blnRestored;

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
			switch ($strName) {
				///////////////////
				// Member Variables
				///////////////////
				case 'SignupFormId':
					// Sets the value for intSignupFormId (Not Null)
					// @param integer $mixValue
					// @return integer
					try {
						$this->objSignupForm = null;
						return ($this->intSignupFormId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PersonId':
					// Sets the value for intPersonId 
					// @param integer $mixValue
					// @return integer
					try {
						$this->objPerson = null;
						return ($this->intPersonId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'SignupByPersonId':
					// Sets the value for intSignupByPersonId 
					// @param integer $mixValue
					// @return integer
					try {
						$this->objSignupByPerson = null;
						return ($this->intSignupByPersonId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'SignupEntryStatusTypeId':
					// Sets the value for intSignupEntryStatusTypeId (Not Null)
					// @param integer $mixValue
					// @return integer
					try {
						return ($this->intSignupEntryStatusTypeId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DateCreated':
					// Sets the value for dttDateCreated (Not Null)
					// @param QDateTime $mixValue
					// @return QDateTime
					try {
						return ($this->dttDateCreated = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DateSubmitted':
					// Sets the value for dttDateSubmitted 
					// @param QDateTime $mixValue
					// @return QDateTime
					try {
						return ($this->dttDateSubmitted = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AmountTotal':
					// Sets the value for fltAmountTotal 
					// @param double $mixValue
					// @return double
					try {
						return ($this->fltAmountTotal = QType::Cast($mixValue, QType::Float));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AmountPaid':
					// Sets the value for fltAmountPaid 
					// @param double $mixValue
					// @return double
					try {
						return ($this->fltAmountPaid = QType::Cast($mixValue, QType::Float));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AmountBalance':
					// Sets the value for fltAmountBalance 
					// @param double $mixValue
					// @return double
					try {
						return ($this->fltAmountBalance = QType::Cast($mixValue, QType::Float));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'InternalNotes':
					// Sets the value for strInternalNotes 
					// @param string $mixValue
					// @return string
					try {
						return ($this->strInternalNotes = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'CommunicationsEntryId':
					// Sets the value for intCommunicationsEntryId 
					// @param integer $mixValue
					// @return integer
					try {
						$this->objCommunicationsEntry = null;
						return ($this->intCommunicationsEntryId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'SignupForm':
					// Sets the value for the SignupForm object referenced by intSignupFormId (Not Null)
					// @param SignupForm $mixValue
					// @return SignupForm
					if (is_null($mixValue)) {
						$this->intSignupFormId = null;
						$this->objSignupForm = null;
						return null;
					} else {
						// Make sure $mixValue actually is a SignupForm object
						try {
							$mixValue = QType::Cast($mixValue, 'SignupForm');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED SignupForm object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved SignupForm for this SignupEntry');

						// Update Local Member Variables
						$this->objSignupForm = $mixValue;
						$this->intSignupFormId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'Person':
					// Sets the value for the Person object referenced by intPersonId 
					// @param Person $mixValue
					// @return Person
					if (is_null($mixValue)) {
						$this->intPersonId = null;
						$this->objPerson = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Person object
						try {
							$mixValue = QType::Cast($mixValue, 'Person');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Person object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved Person for this SignupEntry');

						// Update Local Member Variables
						$this->objPerson = $mixValue;
						$this->intPersonId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'SignupByPerson':
					// Sets the value for the Person object referenced by intSignupByPersonId 
					// @param Person $mixValue
					// @return Person
					if (is_null($mixValue)) {
						$this->intSignupByPersonId = null;
						$this->objSignupByPerson = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Person object
						try {
							$mixValue = QType::Cast($mixValue, 'Person');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Person object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved SignupByPerson for this SignupEntry');

						// Update Local Member Variables
						$this->objSignupByPerson = $mixValue;
						$this->intSignupByPersonId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'CommunicationsEntry':
					// Sets the value for the CommunicationListEntry object referenced by intCommunicationsEntryId 
					// @param CommunicationListEntry $mixValue
					// @return CommunicationListEntry
					if (is_null($mixValue)) {
						$this->intCommunicationsEntryId = null;
						$this->objCommunicationsEntry = null;
						return null;
					} else {
						// Make sure $mixValue actually is a CommunicationListEntry object
						try {
							$mixValue = QType::Cast($mixValue, 'CommunicationListEntry');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED CommunicationListEntry object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved CommunicationsEntry for this SignupEntry');

						// Update Local Member Variables
						$this->objCommunicationsEntry = $mixValue;
						$this->intCommunicationsEntryId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'ClassRegistration':
					// Sets the value for the ClassRegistration object referenced by objClassRegistration (Unique)
					// @param ClassRegistration $mixValue
					// @return ClassRegistration
					if (is_null($mixValue)) {
						$this->objClassRegistration = null;

						// Make sure we update the adjoined ClassRegistration object the next time we call Save()
						$this->blnDirtyClassRegistration = true;

						return null;
					} else {
						// Make sure $mixValue actually is a ClassRegistration object
						try {
							$mixValue = QType::Cast($mixValue, 'ClassRegistration');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Are we setting objClassRegistration to a DIFFERENT $mixValue?
						if ((!$this->ClassRegistration) || ($this->ClassRegistration->SignupEntryId != $mixValue->SignupEntryId)) {
							// Yes -- therefore, set the "Dirty" flag to true
							// to make sure we update the adjoined ClassRegistration object the next time we call Save()
							$this->blnDirtyClassRegistration = true;

							// Update Local Member Variable
							$this->objClassRegistration = $mixValue;
						} else {
							// Nope -- therefore, make no changes
						}

						// Return $mixValue
						return $mixValue;
					}
					break;

				default:
					try {
						return parent::__set($strName, $mixValue);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		/**
		 * Lookup a VirtualAttribute value (if applicable).  Returns NULL if none found.
		 * @param string $strName
		 * @return string
		 */
		public function GetVirtualAttribute($strName) {
			if (array_key_exists($strName, $this->__strVirtualAttributeArray))
				return $this->__strVirtualAttributeArray[$strName];
			return null;
		}



		///////////////////////////////
		// ASSOCIATED OBJECTS' METHODS
		///////////////////////////////

			
		
		// Related Objects' Methods for FormAnswer
		//-------------------------------------------------------------------

		/**
		 * Gets all associated FormAnswers as an array of FormAnswer objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return FormAnswer[]
		*/ 
		public function GetFormAnswerArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return FormAnswer::LoadArrayBySignupEntryId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated FormAnswers
		 * @return int
		*/ 
		public function CountFormAnswers() {
			if ((is_null($this->intId)))
				return 0;

			return FormAnswer::CountBySignupEntryId($this->intId);
		}

		/**
		 * Associates a FormAnswer
		 * @param FormAnswer $objFormAnswer
		 * @return void
		*/ 
		public function AssociateFormAnswer(FormAnswer $objFormAnswer) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFormAnswer on this unsaved SignupEntry.');
			if ((is_null($objFormAnswer->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFormAnswer on this SignupEntry with an unsaved FormAnswer.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`form_answer`
				SET
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objFormAnswer->Id) . '
			');

			// Journaling (if applicable)
			if ($objDatabase->JournalingDatabase) {
				$objFormAnswer->SignupEntryId = $this->intId;
				$objFormAnswer->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates a FormAnswer
		 * @param FormAnswer $objFormAnswer
		 * @return void
		*/ 
		public function UnassociateFormAnswer(FormAnswer $objFormAnswer) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFormAnswer on this unsaved SignupEntry.');
			if ((is_null($objFormAnswer->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFormAnswer on this SignupEntry with an unsaved FormAnswer.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`form_answer`
				SET
					`signup_entry_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objFormAnswer->Id) . ' AND
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objFormAnswer->SignupEntryId = null;
				$objFormAnswer->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates all FormAnswers
		 * @return void
		*/ 
		public function UnassociateAllFormAnswers() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFormAnswer on this unsaved SignupEntry.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (FormAnswer::LoadArrayBySignupEntryId($this->intId) as $objFormAnswer) {
					$objFormAnswer->SignupEntryId = null;
					$objFormAnswer->Journal('UPDATE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`form_answer`
				SET
					`signup_entry_id` = null
				WHERE
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated FormAnswer
		 * @param FormAnswer $objFormAnswer
		 * @return void
		*/ 
		public function DeleteAssociatedFormAnswer(FormAnswer $objFormAnswer) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFormAnswer on this unsaved SignupEntry.');
			if ((is_null($objFormAnswer->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFormAnswer on this SignupEntry with an unsaved FormAnswer.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`form_answer`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objFormAnswer->Id) . ' AND
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objFormAnswer->Journal('DELETE');
			}
		}

		/**
		 * Deletes all associated FormAnswers
		 * @return void
		*/ 
		public function DeleteAllFormAnswers() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFormAnswer on this unsaved SignupEntry.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (FormAnswer::LoadArrayBySignupEntryId($this->intId) as $objFormAnswer) {
					$objFormAnswer->Journal('DELETE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`form_answer`
				WHERE
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for SignupPayment
		//-------------------------------------------------------------------

		/**
		 * Gets all associated SignupPayments as an array of SignupPayment objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return SignupPayment[]
		*/ 
		public function GetSignupPaymentArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return SignupPayment::LoadArrayBySignupEntryId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated SignupPayments
		 * @return int
		*/ 
		public function CountSignupPayments() {
			if ((is_null($this->intId)))
				return 0;

			return SignupPayment::CountBySignupEntryId($this->intId);
		}

		/**
		 * Associates a SignupPayment
		 * @param SignupPayment $objSignupPayment
		 * @return void
		*/ 
		public function AssociateSignupPayment(SignupPayment $objSignupPayment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateSignupPayment on this unsaved SignupEntry.');
			if ((is_null($objSignupPayment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateSignupPayment on this SignupEntry with an unsaved SignupPayment.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`signup_payment`
				SET
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objSignupPayment->Id) . '
			');

			// Journaling (if applicable)
			if ($objDatabase->JournalingDatabase) {
				$objSignupPayment->SignupEntryId = $this->intId;
				$objSignupPayment->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates a SignupPayment
		 * @param SignupPayment $objSignupPayment
		 * @return void
		*/ 
		public function UnassociateSignupPayment(SignupPayment $objSignupPayment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSignupPayment on this unsaved SignupEntry.');
			if ((is_null($objSignupPayment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSignupPayment on this SignupEntry with an unsaved SignupPayment.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`signup_payment`
				SET
					`signup_entry_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objSignupPayment->Id) . ' AND
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objSignupPayment->SignupEntryId = null;
				$objSignupPayment->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates all SignupPayments
		 * @return void
		*/ 
		public function UnassociateAllSignupPayments() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSignupPayment on this unsaved SignupEntry.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (SignupPayment::LoadArrayBySignupEntryId($this->intId) as $objSignupPayment) {
					$objSignupPayment->SignupEntryId = null;
					$objSignupPayment->Journal('UPDATE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`signup_payment`
				SET
					`signup_entry_id` = null
				WHERE
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated SignupPayment
		 * @param SignupPayment $objSignupPayment
		 * @return void
		*/ 
		public function DeleteAssociatedSignupPayment(SignupPayment $objSignupPayment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSignupPayment on this unsaved SignupEntry.');
			if ((is_null($objSignupPayment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSignupPayment on this SignupEntry with an unsaved SignupPayment.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`signup_payment`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objSignupPayment->Id) . ' AND
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objSignupPayment->Journal('DELETE');
			}
		}

		/**
		 * Deletes all associated SignupPayments
		 * @return void
		*/ 
		public function DeleteAllSignupPayments() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSignupPayment on this unsaved SignupEntry.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (SignupPayment::LoadArrayBySignupEntryId($this->intId) as $objSignupPayment) {
					$objSignupPayment->Journal('DELETE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`signup_payment`
				WHERE
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for SignupProduct
		//-------------------------------------------------------------------

		/**
		 * Gets all associated SignupProducts as an array of SignupProduct objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return SignupProduct[]
		*/ 
		public function GetSignupProductArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return SignupProduct::LoadArrayBySignupEntryId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated SignupProducts
		 * @return int
		*/ 
		public function CountSignupProducts() {
			if ((is_null($this->intId)))
				return 0;

			return SignupProduct::CountBySignupEntryId($this->intId);
		}

		/**
		 * Associates a SignupProduct
		 * @param SignupProduct $objSignupProduct
		 * @return void
		*/ 
		public function AssociateSignupProduct(SignupProduct $objSignupProduct) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateSignupProduct on this unsaved SignupEntry.');
			if ((is_null($objSignupProduct->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateSignupProduct on this SignupEntry with an unsaved SignupProduct.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`signup_product`
				SET
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objSignupProduct->Id) . '
			');

			// Journaling (if applicable)
			if ($objDatabase->JournalingDatabase) {
				$objSignupProduct->SignupEntryId = $this->intId;
				$objSignupProduct->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates a SignupProduct
		 * @param SignupProduct $objSignupProduct
		 * @return void
		*/ 
		public function UnassociateSignupProduct(SignupProduct $objSignupProduct) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSignupProduct on this unsaved SignupEntry.');
			if ((is_null($objSignupProduct->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSignupProduct on this SignupEntry with an unsaved SignupProduct.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`signup_product`
				SET
					`signup_entry_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objSignupProduct->Id) . ' AND
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objSignupProduct->SignupEntryId = null;
				$objSignupProduct->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates all SignupProducts
		 * @return void
		*/ 
		public function UnassociateAllSignupProducts() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSignupProduct on this unsaved SignupEntry.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (SignupProduct::LoadArrayBySignupEntryId($this->intId) as $objSignupProduct) {
					$objSignupProduct->SignupEntryId = null;
					$objSignupProduct->Journal('UPDATE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`signup_product`
				SET
					`signup_entry_id` = null
				WHERE
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated SignupProduct
		 * @param SignupProduct $objSignupProduct
		 * @return void
		*/ 
		public function DeleteAssociatedSignupProduct(SignupProduct $objSignupProduct) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSignupProduct on this unsaved SignupEntry.');
			if ((is_null($objSignupProduct->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSignupProduct on this SignupEntry with an unsaved SignupProduct.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`signup_product`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objSignupProduct->Id) . ' AND
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objSignupProduct->Journal('DELETE');
			}
		}

		/**
		 * Deletes all associated SignupProducts
		 * @return void
		*/ 
		public function DeleteAllSignupProducts() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSignupProduct on this unsaved SignupEntry.');

			// Get the Database Object for this Class
			$objDatabase = SignupEntry::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (SignupProduct::LoadArrayBySignupEntryId($this->intId) as $objSignupProduct) {
					$objSignupProduct->Journal('DELETE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`signup_product`
				WHERE
					`signup_entry_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}





		////////////////////////////////////////
		// METHODS for SOAP-BASED WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="SignupEntry"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="SignupForm" type="xsd1:SignupForm"/>';
			$strToReturn .= '<element name="Person" type="xsd1:Person"/>';
			$strToReturn .= '<element name="SignupByPerson" type="xsd1:Person"/>';
			$strToReturn .= '<element name="SignupEntryStatusTypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="DateCreated" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="DateSubmitted" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="AmountTotal" type="xsd:float"/>';
			$strToReturn .= '<element name="AmountPaid" type="xsd:float"/>';
			$strToReturn .= '<element name="AmountBalance" type="xsd:float"/>';
			$strToReturn .= '<element name="InternalNotes" type="xsd:string"/>';
			$strToReturn .= '<element name="CommunicationsEntry" type="xsd1:CommunicationListEntry"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('SignupEntry', $strComplexTypeArray)) {
				$strComplexTypeArray['SignupEntry'] = SignupEntry::GetSoapComplexTypeXml();
				SignupForm::AlterSoapComplexTypeArray($strComplexTypeArray);
				Person::AlterSoapComplexTypeArray($strComplexTypeArray);
				Person::AlterSoapComplexTypeArray($strComplexTypeArray);
				CommunicationListEntry::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, SignupEntry::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new SignupEntry();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if ((property_exists($objSoapObject, 'SignupForm')) &&
				($objSoapObject->SignupForm))
				$objToReturn->SignupForm = SignupForm::GetObjectFromSoapObject($objSoapObject->SignupForm);
			if ((property_exists($objSoapObject, 'Person')) &&
				($objSoapObject->Person))
				$objToReturn->Person = Person::GetObjectFromSoapObject($objSoapObject->Person);
			if ((property_exists($objSoapObject, 'SignupByPerson')) &&
				($objSoapObject->SignupByPerson))
				$objToReturn->SignupByPerson = Person::GetObjectFromSoapObject($objSoapObject->SignupByPerson);
			if (property_exists($objSoapObject, 'SignupEntryStatusTypeId'))
				$objToReturn->intSignupEntryStatusTypeId = $objSoapObject->SignupEntryStatusTypeId;
			if (property_exists($objSoapObject, 'DateCreated'))
				$objToReturn->dttDateCreated = new QDateTime($objSoapObject->DateCreated);
			if (property_exists($objSoapObject, 'DateSubmitted'))
				$objToReturn->dttDateSubmitted = new QDateTime($objSoapObject->DateSubmitted);
			if (property_exists($objSoapObject, 'AmountTotal'))
				$objToReturn->fltAmountTotal = $objSoapObject->AmountTotal;
			if (property_exists($objSoapObject, 'AmountPaid'))
				$objToReturn->fltAmountPaid = $objSoapObject->AmountPaid;
			if (property_exists($objSoapObject, 'AmountBalance'))
				$objToReturn->fltAmountBalance = $objSoapObject->AmountBalance;
			if (property_exists($objSoapObject, 'InternalNotes'))
				$objToReturn->strInternalNotes = $objSoapObject->InternalNotes;
			if ((property_exists($objSoapObject, 'CommunicationsEntry')) &&
				($objSoapObject->CommunicationsEntry))
				$objToReturn->CommunicationsEntry = CommunicationListEntry::GetObjectFromSoapObject($objSoapObject->CommunicationsEntry);
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, SignupEntry::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objSignupForm)
				$objObject->objSignupForm = SignupForm::GetSoapObjectFromObject($objObject->objSignupForm, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intSignupFormId = null;
			if ($objObject->objPerson)
				$objObject->objPerson = Person::GetSoapObjectFromObject($objObject->objPerson, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intPersonId = null;
			if ($objObject->objSignupByPerson)
				$objObject->objSignupByPerson = Person::GetSoapObjectFromObject($objObject->objSignupByPerson, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intSignupByPersonId = null;
			if ($objObject->dttDateCreated)
				$objObject->dttDateCreated = $objObject->dttDateCreated->__toString(QDateTime::FormatSoap);
			if ($objObject->dttDateSubmitted)
				$objObject->dttDateSubmitted = $objObject->dttDateSubmitted->__toString(QDateTime::FormatSoap);
			if ($objObject->objCommunicationsEntry)
				$objObject->objCommunicationsEntry = CommunicationListEntry::GetSoapObjectFromObject($objObject->objCommunicationsEntry, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intCommunicationsEntryId = null;
			return $objObject;
		}




	}



	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	/**
	 * @property-read QQNode $Id
	 * @property-read QQNode $SignupFormId
	 * @property-read QQNodeSignupForm $SignupForm
	 * @property-read QQNode $PersonId
	 * @property-read QQNodePerson $Person
	 * @property-read QQNode $SignupByPersonId
	 * @property-read QQNodePerson $SignupByPerson
	 * @property-read QQNode $SignupEntryStatusTypeId
	 * @property-read QQNode $DateCreated
	 * @property-read QQNode $DateSubmitted
	 * @property-read QQNode $AmountTotal
	 * @property-read QQNode $AmountPaid
	 * @property-read QQNode $AmountBalance
	 * @property-read QQNode $InternalNotes
	 * @property-read QQNode $CommunicationsEntryId
	 * @property-read QQNodeCommunicationListEntry $CommunicationsEntry
	 * @property-read QQReverseReferenceNodeClassRegistration $ClassRegistration
	 * @property-read QQReverseReferenceNodeFormAnswer $FormAnswer
	 * @property-read QQReverseReferenceNodeSignupPayment $SignupPayment
	 * @property-read QQReverseReferenceNodeSignupProduct $SignupProduct
	 */
	class QQNodeSignupEntry extends QQNode {
		protected $strTableName = 'signup_entry';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'SignupEntry';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'Id', 'integer', $this);
				case 'SignupFormId':
					return new QQNode('signup_form_id', 'SignupFormId', 'integer', $this);
				case 'SignupForm':
					return new QQNodeSignupForm('signup_form_id', 'SignupForm', 'integer', $this);
				case 'PersonId':
					return new QQNode('person_id', 'PersonId', 'integer', $this);
				case 'Person':
					return new QQNodePerson('person_id', 'Person', 'integer', $this);
				case 'SignupByPersonId':
					return new QQNode('signup_by_person_id', 'SignupByPersonId', 'integer', $this);
				case 'SignupByPerson':
					return new QQNodePerson('signup_by_person_id', 'SignupByPerson', 'integer', $this);
				case 'SignupEntryStatusTypeId':
					return new QQNode('signup_entry_status_type_id', 'SignupEntryStatusTypeId', 'integer', $this);
				case 'DateCreated':
					return new QQNode('date_created', 'DateCreated', 'QDateTime', $this);
				case 'DateSubmitted':
					return new QQNode('date_submitted', 'DateSubmitted', 'QDateTime', $this);
				case 'AmountTotal':
					return new QQNode('amount_total', 'AmountTotal', 'double', $this);
				case 'AmountPaid':
					return new QQNode('amount_paid', 'AmountPaid', 'double', $this);
				case 'AmountBalance':
					return new QQNode('amount_balance', 'AmountBalance', 'double', $this);
				case 'InternalNotes':
					return new QQNode('internal_notes', 'InternalNotes', 'string', $this);
				case 'CommunicationsEntryId':
					return new QQNode('communications_entry_id', 'CommunicationsEntryId', 'integer', $this);
				case 'CommunicationsEntry':
					return new QQNodeCommunicationListEntry('communications_entry_id', 'CommunicationsEntry', 'integer', $this);
				case 'ClassRegistration':
					return new QQReverseReferenceNodeClassRegistration($this, 'classregistration', 'reverse_reference', 'signup_entry_id', 'ClassRegistration');
				case 'FormAnswer':
					return new QQReverseReferenceNodeFormAnswer($this, 'formanswer', 'reverse_reference', 'signup_entry_id');
				case 'SignupPayment':
					return new QQReverseReferenceNodeSignupPayment($this, 'signuppayment', 'reverse_reference', 'signup_entry_id');
				case 'SignupProduct':
					return new QQReverseReferenceNodeSignupProduct($this, 'signupproduct', 'reverse_reference', 'signup_entry_id');

				case '_PrimaryKeyNode':
					return new QQNode('id', 'Id', 'integer', $this);
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}
	
	/**
	 * @property-read QQNode $Id
	 * @property-read QQNode $SignupFormId
	 * @property-read QQNodeSignupForm $SignupForm
	 * @property-read QQNode $PersonId
	 * @property-read QQNodePerson $Person
	 * @property-read QQNode $SignupByPersonId
	 * @property-read QQNodePerson $SignupByPerson
	 * @property-read QQNode $SignupEntryStatusTypeId
	 * @property-read QQNode $DateCreated
	 * @property-read QQNode $DateSubmitted
	 * @property-read QQNode $AmountTotal
	 * @property-read QQNode $AmountPaid
	 * @property-read QQNode $AmountBalance
	 * @property-read QQNode $InternalNotes
	 * @property-read QQNode $CommunicationsEntryId
	 * @property-read QQNodeCommunicationListEntry $CommunicationsEntry
	 * @property-read QQReverseReferenceNodeClassRegistration $ClassRegistration
	 * @property-read QQReverseReferenceNodeFormAnswer $FormAnswer
	 * @property-read QQReverseReferenceNodeSignupPayment $SignupPayment
	 * @property-read QQReverseReferenceNodeSignupProduct $SignupProduct
	 * @property-read QQNode $_PrimaryKeyNode
	 */
	class QQReverseReferenceNodeSignupEntry extends QQReverseReferenceNode {
		protected $strTableName = 'signup_entry';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'SignupEntry';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'Id', 'integer', $this);
				case 'SignupFormId':
					return new QQNode('signup_form_id', 'SignupFormId', 'integer', $this);
				case 'SignupForm':
					return new QQNodeSignupForm('signup_form_id', 'SignupForm', 'integer', $this);
				case 'PersonId':
					return new QQNode('person_id', 'PersonId', 'integer', $this);
				case 'Person':
					return new QQNodePerson('person_id', 'Person', 'integer', $this);
				case 'SignupByPersonId':
					return new QQNode('signup_by_person_id', 'SignupByPersonId', 'integer', $this);
				case 'SignupByPerson':
					return new QQNodePerson('signup_by_person_id', 'SignupByPerson', 'integer', $this);
				case 'SignupEntryStatusTypeId':
					return new QQNode('signup_entry_status_type_id', 'SignupEntryStatusTypeId', 'integer', $this);
				case 'DateCreated':
					return new QQNode('date_created', 'DateCreated', 'QDateTime', $this);
				case 'DateSubmitted':
					return new QQNode('date_submitted', 'DateSubmitted', 'QDateTime', $this);
				case 'AmountTotal':
					return new QQNode('amount_total', 'AmountTotal', 'double', $this);
				case 'AmountPaid':
					return new QQNode('amount_paid', 'AmountPaid', 'double', $this);
				case 'AmountBalance':
					return new QQNode('amount_balance', 'AmountBalance', 'double', $this);
				case 'InternalNotes':
					return new QQNode('internal_notes', 'InternalNotes', 'string', $this);
				case 'CommunicationsEntryId':
					return new QQNode('communications_entry_id', 'CommunicationsEntryId', 'integer', $this);
				case 'CommunicationsEntry':
					return new QQNodeCommunicationListEntry('communications_entry_id', 'CommunicationsEntry', 'integer', $this);
				case 'ClassRegistration':
					return new QQReverseReferenceNodeClassRegistration($this, 'classregistration', 'reverse_reference', 'signup_entry_id', 'ClassRegistration');
				case 'FormAnswer':
					return new QQReverseReferenceNodeFormAnswer($this, 'formanswer', 'reverse_reference', 'signup_entry_id');
				case 'SignupPayment':
					return new QQReverseReferenceNodeSignupPayment($this, 'signuppayment', 'reverse_reference', 'signup_entry_id');
				case 'SignupProduct':
					return new QQReverseReferenceNodeSignupProduct($this, 'signupproduct', 'reverse_reference', 'signup_entry_id');

				case '_PrimaryKeyNode':
					return new QQNode('id', 'Id', 'integer', $this);
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}

?>