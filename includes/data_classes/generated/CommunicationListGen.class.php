<?php
	/**
	 * The abstract CommunicationListGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the CommunicationList subclass which
	 * extends this CommunicationListGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the CommunicationList class.
	 * 
	 * @package ALCF ChMS
	 * @subpackage GeneratedDataObjects
	 * @property integer $Id the value for intId (Read-Only PK)
	 * @property integer $EmailBroadcastTypeId the value for intEmailBroadcastTypeId (Not Null)
	 * @property integer $MinistryId the value for intMinistryId (Not Null)
	 * @property string $Name the value for strName 
	 * @property string $Token the value for strToken (Unique)
	 * @property Ministry $Ministry the value for the Ministry object referenced by intMinistryId (Not Null)
	 * @property CommunicationListEntry $_CommunicationListEntryAsEntry the value for the private _objCommunicationListEntryAsEntry (Read-Only) if set due to an expansion on the communicationlist_entry_assn association table
	 * @property CommunicationListEntry[] $_CommunicationListEntryAsEntryArray the value for the private _objCommunicationListEntryAsEntryArray (Read-Only) if set due to an ExpandAsArray on the communicationlist_entry_assn association table
	 * @property Person $_Person the value for the private _objPerson (Read-Only) if set due to an expansion on the communicationlist_person_assn association table
	 * @property Person[] $_PersonArray the value for the private _objPersonArray (Read-Only) if set due to an ExpandAsArray on the communicationlist_person_assn association table
	 * @property boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class CommunicationListGen extends QBaseClass {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column communication_list.id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column communication_list.email_broadcast_type_id
		 * @var integer intEmailBroadcastTypeId
		 */
		protected $intEmailBroadcastTypeId;
		const EmailBroadcastTypeIdDefault = null;


		/**
		 * Protected member variable that maps to the database column communication_list.ministry_id
		 * @var integer intMinistryId
		 */
		protected $intMinistryId;
		const MinistryIdDefault = null;


		/**
		 * Protected member variable that maps to the database column communication_list.name
		 * @var string strName
		 */
		protected $strName;
		const NameMaxLength = 200;
		const NameDefault = null;


		/**
		 * Protected member variable that maps to the database column communication_list.token
		 * @var string strToken
		 */
		protected $strToken;
		const TokenMaxLength = 100;
		const TokenDefault = null;


		/**
		 * Private member variable that stores a reference to a single CommunicationListEntryAsEntry object
		 * (of type CommunicationListEntry), if this CommunicationList object was restored with
		 * an expansion on the communicationlist_entry_assn association table.
		 * @var CommunicationListEntry _objCommunicationListEntryAsEntry;
		 */
		private $_objCommunicationListEntryAsEntry;

		/**
		 * Private member variable that stores a reference to an array of CommunicationListEntryAsEntry objects
		 * (of type CommunicationListEntry[]), if this CommunicationList object was restored with
		 * an ExpandAsArray on the communicationlist_entry_assn association table.
		 * @var CommunicationListEntry[] _objCommunicationListEntryAsEntryArray;
		 */
		private $_objCommunicationListEntryAsEntryArray = array();

		/**
		 * Private member variable that stores a reference to a single Person object
		 * (of type Person), if this CommunicationList object was restored with
		 * an expansion on the communicationlist_person_assn association table.
		 * @var Person _objPerson;
		 */
		private $_objPerson;

		/**
		 * Private member variable that stores a reference to an array of Person objects
		 * (of type Person[]), if this CommunicationList object was restored with
		 * an ExpandAsArray on the communicationlist_person_assn association table.
		 * @var Person[] _objPersonArray;
		 */
		private $_objPersonArray = array();

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
		 * in the database column communication_list.ministry_id.
		 *
		 * NOTE: Always use the Ministry property getter to correctly retrieve this Ministry object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Ministry objMinistry
		 */
		protected $objMinistry;





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
		 * Load a CommunicationList from PK Info
		 * @param integer $intId
		 * @return CommunicationList
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return CommunicationList::QuerySingle(
				QQ::Equal(QQN::CommunicationList()->Id, $intId)
			);
		}

		/**
		 * Load all CommunicationLists
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CommunicationList[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call CommunicationList::QueryArray to perform the LoadAll query
			try {
				return CommunicationList::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all CommunicationLists
		 * @return int
		 */
		public static function CountAll() {
			// Call CommunicationList::QueryCount to perform the CountAll query
			return CommunicationList::QueryCount(QQ::All());
		}




		///////////////////////////////
		// QCODO QUERY-RELATED METHODS
		///////////////////////////////

		/**
		 * Internally called method to assist with calling Qcodo Query for this class
		 * on load methods.
		 * @param QQueryBuilder &$objQueryBuilder the QueryBuilder object that will be created
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause object or array of QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with (sending in null will skip the PrepareStatement step)
		 * @param boolean $blnCountOnly only select a rowcount
		 * @return string the query statement
		 */
		protected static function BuildQueryStatement(&$objQueryBuilder, QQCondition $objConditions, $objOptionalClauses, $mixParameterArray, $blnCountOnly) {
			// Get the Database Object for this Class
			$objDatabase = CommunicationList::GetDatabase();

			// Create/Build out the QueryBuilder object with CommunicationList-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'communication_list');
			CommunicationList::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('communication_list');

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
		 * Static Qcodo Query method to query for a single CommunicationList object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return CommunicationList the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CommunicationList::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new CommunicationList object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return CommunicationList::InstantiateDbRow($objDbResult->GetNextRow(), null, null, null, $objQueryBuilder->ColumnAliasArray);
		}

		/**
		 * Static Qcodo Query method to query for an array of CommunicationList objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return CommunicationList[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CommunicationList::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return CommunicationList::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes, $objQueryBuilder->ColumnAliasArray);
		}

		/**
		 * Static Qcodo Query method to query for a count of CommunicationList objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = CommunicationList::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = CommunicationList::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'communication_list_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with CommunicationList-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				CommunicationList::GetSelectFields($objQueryBuilder);
				CommunicationList::GetFromFields($objQueryBuilder);

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
			return CommunicationList::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this CommunicationList
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'communication_list';
				$strAliasPrefix = '';
			}

			$objBuilder->AddSelectItem($strTableName, 'id', $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName, 'email_broadcast_type_id', $strAliasPrefix . 'email_broadcast_type_id');
			$objBuilder->AddSelectItem($strTableName, 'ministry_id', $strAliasPrefix . 'ministry_id');
			$objBuilder->AddSelectItem($strTableName, 'name', $strAliasPrefix . 'name');
			$objBuilder->AddSelectItem($strTableName, 'token', $strAliasPrefix . 'token');
		}




		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a CommunicationList from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this CommunicationList::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param string $strExpandAsArrayNodes
		 * @param QBaseClass $objPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return CommunicationList
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
					$strAliasPrefix = 'communication_list__';

				$strAlias = $strAliasPrefix . 'communicationlistentryasentry__communication_list_entry_id__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objCommunicationListEntryAsEntryArray)) {
						$objPreviousChildItem = $objPreviousItem->_objCommunicationListEntryAsEntryArray[$intPreviousChildItemCount - 1];
						$objChildItem = CommunicationListEntry::InstantiateDbRow($objDbRow, $strAliasPrefix . 'communicationlistentryasentry__communication_list_entry_id__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objCommunicationListEntryAsEntryArray[] = $objChildItem;
					} else
						$objPreviousItem->_objCommunicationListEntryAsEntryArray[] = CommunicationListEntry::InstantiateDbRow($objDbRow, $strAliasPrefix . 'communicationlistentryasentry__communication_list_entry_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}

				$strAlias = $strAliasPrefix . 'person__person_id__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objPersonArray)) {
						$objPreviousChildItem = $objPreviousItem->_objPersonArray[$intPreviousChildItemCount - 1];
						$objChildItem = Person::InstantiateDbRow($objDbRow, $strAliasPrefix . 'person__person_id__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objPersonArray[] = $objChildItem;
					} else
						$objPreviousItem->_objPersonArray[] = Person::InstantiateDbRow($objDbRow, $strAliasPrefix . 'person__person_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}


				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'communication_list__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the CommunicationList object
			$objToReturn = new CommunicationList();
			$objToReturn->__blnRestored = true;

			$strAliasName = array_key_exists($strAliasPrefix . 'id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'id'] : $strAliasPrefix . 'id';
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'email_broadcast_type_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'email_broadcast_type_id'] : $strAliasPrefix . 'email_broadcast_type_id';
			$objToReturn->intEmailBroadcastTypeId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'ministry_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'ministry_id'] : $strAliasPrefix . 'ministry_id';
			$objToReturn->intMinistryId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'name', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'name'] : $strAliasPrefix . 'name';
			$objToReturn->strName = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAliasName = array_key_exists($strAliasPrefix . 'token', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'token'] : $strAliasPrefix . 'token';
			$objToReturn->strToken = $objDbRow->GetColumn($strAliasName, 'VarChar');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'communication_list__';

			// Check for Ministry Early Binding
			$strAlias = $strAliasPrefix . 'ministry_id__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName)))
				$objToReturn->objMinistry = Ministry::InstantiateDbRow($objDbRow, $strAliasPrefix . 'ministry_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);



			// Check for CommunicationListEntryAsEntry Virtual Binding
			$strAlias = $strAliasPrefix . 'communicationlistentryasentry__communication_list_entry_id__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objCommunicationListEntryAsEntryArray[] = CommunicationListEntry::InstantiateDbRow($objDbRow, $strAliasPrefix . 'communicationlistentryasentry__communication_list_entry_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objCommunicationListEntryAsEntry = CommunicationListEntry::InstantiateDbRow($objDbRow, $strAliasPrefix . 'communicationlistentryasentry__communication_list_entry_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}

			// Check for Person Virtual Binding
			$strAlias = $strAliasPrefix . 'person__person_id__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objPersonArray[] = Person::InstantiateDbRow($objDbRow, $strAliasPrefix . 'person__person_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objPerson = Person::InstantiateDbRow($objDbRow, $strAliasPrefix . 'person__person_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}


			return $objToReturn;
		}

		/**
		 * Instantiate an array of CommunicationLists from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @param string $strExpandAsArrayNodes
		 * @param string[] $strColumnAliasArray
		 * @return CommunicationList[]
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
					$objItem = CommunicationList::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = CommunicationList::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single CommunicationList object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return CommunicationList
		*/
		public static function LoadById($intId) {
			return CommunicationList::QuerySingle(
				QQ::Equal(QQN::CommunicationList()->Id, $intId)
			);
		}
			
		/**
		 * Load a single CommunicationList object,
		 * by Token Index(es)
		 * @param string $strToken
		 * @return CommunicationList
		*/
		public static function LoadByToken($strToken) {
			return CommunicationList::QuerySingle(
				QQ::Equal(QQN::CommunicationList()->Token, $strToken)
			);
		}
			
		/**
		 * Load an array of CommunicationList objects,
		 * by EmailBroadcastTypeId Index(es)
		 * @param integer $intEmailBroadcastTypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CommunicationList[]
		*/
		public static function LoadArrayByEmailBroadcastTypeId($intEmailBroadcastTypeId, $objOptionalClauses = null) {
			// Call CommunicationList::QueryArray to perform the LoadArrayByEmailBroadcastTypeId query
			try {
				return CommunicationList::QueryArray(
					QQ::Equal(QQN::CommunicationList()->EmailBroadcastTypeId, $intEmailBroadcastTypeId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CommunicationLists
		 * by EmailBroadcastTypeId Index(es)
		 * @param integer $intEmailBroadcastTypeId
		 * @return int
		*/
		public static function CountByEmailBroadcastTypeId($intEmailBroadcastTypeId) {
			// Call CommunicationList::QueryCount to perform the CountByEmailBroadcastTypeId query
			return CommunicationList::QueryCount(
				QQ::Equal(QQN::CommunicationList()->EmailBroadcastTypeId, $intEmailBroadcastTypeId)
			);
		}
			
		/**
		 * Load an array of CommunicationList objects,
		 * by MinistryId Index(es)
		 * @param integer $intMinistryId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CommunicationList[]
		*/
		public static function LoadArrayByMinistryId($intMinistryId, $objOptionalClauses = null) {
			// Call CommunicationList::QueryArray to perform the LoadArrayByMinistryId query
			try {
				return CommunicationList::QueryArray(
					QQ::Equal(QQN::CommunicationList()->MinistryId, $intMinistryId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CommunicationLists
		 * by MinistryId Index(es)
		 * @param integer $intMinistryId
		 * @return int
		*/
		public static function CountByMinistryId($intMinistryId) {
			// Call CommunicationList::QueryCount to perform the CountByMinistryId query
			return CommunicationList::QueryCount(
				QQ::Equal(QQN::CommunicationList()->MinistryId, $intMinistryId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////
			/**
		 * Load an array of CommunicationListEntry objects for a given CommunicationListEntryAsEntry
		 * via the communicationlist_entry_assn table
		 * @param integer $intCommunicationListEntryId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CommunicationList[]
		*/
		public static function LoadArrayByCommunicationListEntryAsEntry($intCommunicationListEntryId, $objOptionalClauses = null) {
			// Call CommunicationList::QueryArray to perform the LoadArrayByCommunicationListEntryAsEntry query
			try {
				return CommunicationList::QueryArray(
					QQ::Equal(QQN::CommunicationList()->CommunicationListEntryAsEntry->CommunicationListEntryId, $intCommunicationListEntryId),
					$objOptionalClauses
				);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CommunicationLists for a given CommunicationListEntryAsEntry
		 * via the communicationlist_entry_assn table
		 * @param integer $intCommunicationListEntryId
		 * @return int
		*/
		public static function CountByCommunicationListEntryAsEntry($intCommunicationListEntryId) {
			return CommunicationList::QueryCount(
				QQ::Equal(QQN::CommunicationList()->CommunicationListEntryAsEntry->CommunicationListEntryId, $intCommunicationListEntryId)
			);
		}
			/**
		 * Load an array of Person objects for a given Person
		 * via the communicationlist_person_assn table
		 * @param integer $intPersonId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CommunicationList[]
		*/
		public static function LoadArrayByPerson($intPersonId, $objOptionalClauses = null) {
			// Call CommunicationList::QueryArray to perform the LoadArrayByPerson query
			try {
				return CommunicationList::QueryArray(
					QQ::Equal(QQN::CommunicationList()->Person->PersonId, $intPersonId),
					$objOptionalClauses
				);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count CommunicationLists for a given Person
		 * via the communicationlist_person_assn table
		 * @param integer $intPersonId
		 * @return int
		*/
		public static function CountByPerson($intPersonId) {
			return CommunicationList::QueryCount(
				QQ::Equal(QQN::CommunicationList()->Person->PersonId, $intPersonId)
			);
		}




		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
		 * Save this CommunicationList
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		 */
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = CommunicationList::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `communication_list` (
							`email_broadcast_type_id`,
							`ministry_id`,
							`name`,
							`token`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intEmailBroadcastTypeId) . ',
							' . $objDatabase->SqlVariable($this->intMinistryId) . ',
							' . $objDatabase->SqlVariable($this->strName) . ',
							' . $objDatabase->SqlVariable($this->strToken) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('communication_list', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`communication_list`
						SET
							`email_broadcast_type_id` = ' . $objDatabase->SqlVariable($this->intEmailBroadcastTypeId) . ',
							`ministry_id` = ' . $objDatabase->SqlVariable($this->intMinistryId) . ',
							`name` = ' . $objDatabase->SqlVariable($this->strName) . ',
							`token` = ' . $objDatabase->SqlVariable($this->strToken) . '
						WHERE
							`id` = ' . $objDatabase->SqlVariable($this->intId) . '
					');
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
		 * Delete this CommunicationList
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this CommunicationList with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = CommunicationList::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`communication_list`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all CommunicationLists
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = CommunicationList::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`communication_list`');
		}

		/**
		 * Truncate communication_list table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = CommunicationList::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `communication_list`');
		}

		/**
		 * Reload this CommunicationList from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved CommunicationList object.');

			// Reload the Object
			$objReloaded = CommunicationList::Load($this->intId);

			// Update $this's local variables to match
			$this->EmailBroadcastTypeId = $objReloaded->EmailBroadcastTypeId;
			$this->MinistryId = $objReloaded->MinistryId;
			$this->strName = $objReloaded->strName;
			$this->strToken = $objReloaded->strToken;
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

				case 'EmailBroadcastTypeId':
					// Gets the value for intEmailBroadcastTypeId (Not Null)
					// @return integer
					return $this->intEmailBroadcastTypeId;

				case 'MinistryId':
					// Gets the value for intMinistryId (Not Null)
					// @return integer
					return $this->intMinistryId;

				case 'Name':
					// Gets the value for strName 
					// @return string
					return $this->strName;

				case 'Token':
					// Gets the value for strToken (Unique)
					// @return string
					return $this->strToken;


				///////////////////
				// Member Objects
				///////////////////
				case 'Ministry':
					// Gets the value for the Ministry object referenced by intMinistryId (Not Null)
					// @return Ministry
					try {
						if ((!$this->objMinistry) && (!is_null($this->intMinistryId)))
							$this->objMinistry = Ministry::Load($this->intMinistryId);
						return $this->objMinistry;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_CommunicationListEntryAsEntry':
					// Gets the value for the private _objCommunicationListEntryAsEntry (Read-Only)
					// if set due to an expansion on the communicationlist_entry_assn association table
					// @return CommunicationListEntry
					return $this->_objCommunicationListEntryAsEntry;

				case '_CommunicationListEntryAsEntryArray':
					// Gets the value for the private _objCommunicationListEntryAsEntryArray (Read-Only)
					// if set due to an ExpandAsArray on the communicationlist_entry_assn association table
					// @return CommunicationListEntry[]
					return (array) $this->_objCommunicationListEntryAsEntryArray;

				case '_Person':
					// Gets the value for the private _objPerson (Read-Only)
					// if set due to an expansion on the communicationlist_person_assn association table
					// @return Person
					return $this->_objPerson;

				case '_PersonArray':
					// Gets the value for the private _objPersonArray (Read-Only)
					// if set due to an ExpandAsArray on the communicationlist_person_assn association table
					// @return Person[]
					return (array) $this->_objPersonArray;


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
				case 'EmailBroadcastTypeId':
					// Sets the value for intEmailBroadcastTypeId (Not Null)
					// @param integer $mixValue
					// @return integer
					try {
						return ($this->intEmailBroadcastTypeId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'MinistryId':
					// Sets the value for intMinistryId (Not Null)
					// @param integer $mixValue
					// @return integer
					try {
						$this->objMinistry = null;
						return ($this->intMinistryId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Name':
					// Sets the value for strName 
					// @param string $mixValue
					// @return string
					try {
						return ($this->strName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Token':
					// Sets the value for strToken (Unique)
					// @param string $mixValue
					// @return string
					try {
						return ($this->strToken = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'Ministry':
					// Sets the value for the Ministry object referenced by intMinistryId (Not Null)
					// @param Ministry $mixValue
					// @return Ministry
					if (is_null($mixValue)) {
						$this->intMinistryId = null;
						$this->objMinistry = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Ministry object
						try {
							$mixValue = QType::Cast($mixValue, 'Ministry');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Ministry object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved Ministry for this CommunicationList');

						// Update Local Member Variables
						$this->objMinistry = $mixValue;
						$this->intMinistryId = $mixValue->Id;

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

			
		// Related Many-to-Many Objects' Methods for CommunicationListEntryAsEntry
		//-------------------------------------------------------------------

		/**
		 * Gets all many-to-many associated CommunicationListEntriesAsEntry as an array of CommunicationListEntry objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return CommunicationListEntry[]
		*/ 
		public function GetCommunicationListEntryAsEntryArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return CommunicationListEntry::LoadArrayByCommunicationListAsEntry($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all many-to-many associated CommunicationListEntriesAsEntry
		 * @return int
		*/ 
		public function CountCommunicationListEntriesAsEntry() {
			if ((is_null($this->intId)))
				return 0;

			return CommunicationListEntry::CountByCommunicationListAsEntry($this->intId);
		}

		/**
		 * Checks to see if an association exists with a specific CommunicationListEntryAsEntry
		 * @param CommunicationListEntry $objCommunicationListEntry
		 * @return bool
		*/
		public function IsCommunicationListEntryAsEntryAssociated(CommunicationListEntry $objCommunicationListEntry) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call IsCommunicationListEntryAsEntryAssociated on this unsaved CommunicationList.');
			if ((is_null($objCommunicationListEntry->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call IsCommunicationListEntryAsEntryAssociated on this CommunicationList with an unsaved CommunicationListEntry.');

			$intRowCount = CommunicationList::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::CommunicationList()->Id, $this->intId),
					QQ::Equal(QQN::CommunicationList()->CommunicationListEntryAsEntry->CommunicationListEntryId, $objCommunicationListEntry->Id)
				)
			);

			return ($intRowCount > 0);
		}

		/**
		 * Associates a CommunicationListEntryAsEntry
		 * @param CommunicationListEntry $objCommunicationListEntry
		 * @return void
		*/ 
		public function AssociateCommunicationListEntryAsEntry(CommunicationListEntry $objCommunicationListEntry) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateCommunicationListEntryAsEntry on this unsaved CommunicationList.');
			if ((is_null($objCommunicationListEntry->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateCommunicationListEntryAsEntry on this CommunicationList with an unsaved CommunicationListEntry.');

			// Get the Database Object for this Class
			$objDatabase = CommunicationList::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				INSERT INTO `communicationlist_entry_assn` (
					`communication_list_id`,
					`communication_list_entry_id`
				) VALUES (
					' . $objDatabase->SqlVariable($this->intId) . ',
					' . $objDatabase->SqlVariable($objCommunicationListEntry->Id) . '
				)
			');
		}

		/**
		 * Unassociates a CommunicationListEntryAsEntry
		 * @param CommunicationListEntry $objCommunicationListEntry
		 * @return void
		*/ 
		public function UnassociateCommunicationListEntryAsEntry(CommunicationListEntry $objCommunicationListEntry) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCommunicationListEntryAsEntry on this unsaved CommunicationList.');
			if ((is_null($objCommunicationListEntry->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCommunicationListEntryAsEntry on this CommunicationList with an unsaved CommunicationListEntry.');

			// Get the Database Object for this Class
			$objDatabase = CommunicationList::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`communicationlist_entry_assn`
				WHERE
					`communication_list_id` = ' . $objDatabase->SqlVariable($this->intId) . ' AND
					`communication_list_entry_id` = ' . $objDatabase->SqlVariable($objCommunicationListEntry->Id) . '
			');
		}

		/**
		 * Unassociates all CommunicationListEntriesAsEntry
		 * @return void
		*/ 
		public function UnassociateAllCommunicationListEntriesAsEntry() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAllCommunicationListEntryAsEntryArray on this unsaved CommunicationList.');

			// Get the Database Object for this Class
			$objDatabase = CommunicationList::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`communicationlist_entry_assn`
				WHERE
					`communication_list_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}
			
		// Related Many-to-Many Objects' Methods for Person
		//-------------------------------------------------------------------

		/**
		 * Gets all many-to-many associated People as an array of Person objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Person[]
		*/ 
		public function GetPersonArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Person::LoadArrayByCommunicationList($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all many-to-many associated People
		 * @return int
		*/ 
		public function CountPeople() {
			if ((is_null($this->intId)))
				return 0;

			return Person::CountByCommunicationList($this->intId);
		}

		/**
		 * Checks to see if an association exists with a specific Person
		 * @param Person $objPerson
		 * @return bool
		*/
		public function IsPersonAssociated(Person $objPerson) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call IsPersonAssociated on this unsaved CommunicationList.');
			if ((is_null($objPerson->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call IsPersonAssociated on this CommunicationList with an unsaved Person.');

			$intRowCount = CommunicationList::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::CommunicationList()->Id, $this->intId),
					QQ::Equal(QQN::CommunicationList()->Person->PersonId, $objPerson->Id)
				)
			);

			return ($intRowCount > 0);
		}

		/**
		 * Associates a Person
		 * @param Person $objPerson
		 * @return void
		*/ 
		public function AssociatePerson(Person $objPerson) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePerson on this unsaved CommunicationList.');
			if ((is_null($objPerson->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociatePerson on this CommunicationList with an unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = CommunicationList::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				INSERT INTO `communicationlist_person_assn` (
					`communication_list_id`,
					`person_id`
				) VALUES (
					' . $objDatabase->SqlVariable($this->intId) . ',
					' . $objDatabase->SqlVariable($objPerson->Id) . '
				)
			');
		}

		/**
		 * Unassociates a Person
		 * @param Person $objPerson
		 * @return void
		*/ 
		public function UnassociatePerson(Person $objPerson) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePerson on this unsaved CommunicationList.');
			if ((is_null($objPerson->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociatePerson on this CommunicationList with an unsaved Person.');

			// Get the Database Object for this Class
			$objDatabase = CommunicationList::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`communicationlist_person_assn`
				WHERE
					`communication_list_id` = ' . $objDatabase->SqlVariable($this->intId) . ' AND
					`person_id` = ' . $objDatabase->SqlVariable($objPerson->Id) . '
			');
		}

		/**
		 * Unassociates all People
		 * @return void
		*/ 
		public function UnassociateAllPeople() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAllPersonArray on this unsaved CommunicationList.');

			// Get the Database Object for this Class
			$objDatabase = CommunicationList::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`communicationlist_person_assn`
				WHERE
					`communication_list_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}




		////////////////////////////////////////
		// METHODS for SOAP-BASED WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="CommunicationList"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="EmailBroadcastTypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="Ministry" type="xsd1:Ministry"/>';
			$strToReturn .= '<element name="Name" type="xsd:string"/>';
			$strToReturn .= '<element name="Token" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('CommunicationList', $strComplexTypeArray)) {
				$strComplexTypeArray['CommunicationList'] = CommunicationList::GetSoapComplexTypeXml();
				Ministry::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, CommunicationList::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new CommunicationList();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'EmailBroadcastTypeId'))
				$objToReturn->intEmailBroadcastTypeId = $objSoapObject->EmailBroadcastTypeId;
			if ((property_exists($objSoapObject, 'Ministry')) &&
				($objSoapObject->Ministry))
				$objToReturn->Ministry = Ministry::GetObjectFromSoapObject($objSoapObject->Ministry);
			if (property_exists($objSoapObject, 'Name'))
				$objToReturn->strName = $objSoapObject->Name;
			if (property_exists($objSoapObject, 'Token'))
				$objToReturn->strToken = $objSoapObject->Token;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, CommunicationList::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objMinistry)
				$objObject->objMinistry = Ministry::GetSoapObjectFromObject($objObject->objMinistry, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intMinistryId = null;
			return $objObject;
		}




	}



	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeCommunicationListCommunicationListEntryAsEntry extends QQAssociationNode {
		protected $strType = 'association';
		protected $strName = 'communicationlistentryasentry';

		protected $strTableName = 'communicationlist_entry_assn';
		protected $strPrimaryKey = 'communication_list_id';
		protected $strClassName = 'CommunicationListEntry';

		public function __get($strName) {
			switch ($strName) {
				case 'CommunicationListEntryId':
					return new QQNode('communication_list_entry_id', 'CommunicationListEntryId', 'integer', $this);
				case 'CommunicationListEntry':
					return new QQNodeCommunicationListEntry('communication_list_entry_id', 'CommunicationListEntryId', 'integer', $this);
				case '_ChildTableNode':
					return new QQNodeCommunicationListEntry('communication_list_entry_id', 'CommunicationListEntryId', 'integer', $this);
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

	class QQNodeCommunicationListPerson extends QQAssociationNode {
		protected $strType = 'association';
		protected $strName = 'person';

		protected $strTableName = 'communicationlist_person_assn';
		protected $strPrimaryKey = 'communication_list_id';
		protected $strClassName = 'Person';

		public function __get($strName) {
			switch ($strName) {
				case 'PersonId':
					return new QQNode('person_id', 'PersonId', 'integer', $this);
				case 'Person':
					return new QQNodePerson('person_id', 'PersonId', 'integer', $this);
				case '_ChildTableNode':
					return new QQNodePerson('person_id', 'PersonId', 'integer', $this);
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

	class QQNodeCommunicationList extends QQNode {
		protected $strTableName = 'communication_list';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'CommunicationList';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'Id', 'integer', $this);
				case 'EmailBroadcastTypeId':
					return new QQNode('email_broadcast_type_id', 'EmailBroadcastTypeId', 'integer', $this);
				case 'MinistryId':
					return new QQNode('ministry_id', 'MinistryId', 'integer', $this);
				case 'Ministry':
					return new QQNodeMinistry('ministry_id', 'Ministry', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'Name', 'string', $this);
				case 'Token':
					return new QQNode('token', 'Token', 'string', $this);
				case 'CommunicationListEntryAsEntry':
					return new QQNodeCommunicationListCommunicationListEntryAsEntry($this);
				case 'Person':
					return new QQNodeCommunicationListPerson($this);

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

	class QQReverseReferenceNodeCommunicationList extends QQReverseReferenceNode {
		protected $strTableName = 'communication_list';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'CommunicationList';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'Id', 'integer', $this);
				case 'EmailBroadcastTypeId':
					return new QQNode('email_broadcast_type_id', 'EmailBroadcastTypeId', 'integer', $this);
				case 'MinistryId':
					return new QQNode('ministry_id', 'MinistryId', 'integer', $this);
				case 'Ministry':
					return new QQNodeMinistry('ministry_id', 'Ministry', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'Name', 'string', $this);
				case 'Token':
					return new QQNode('token', 'Token', 'string', $this);
				case 'CommunicationListEntryAsEntry':
					return new QQNodeCommunicationListCommunicationListEntryAsEntry($this);
				case 'Person':
					return new QQNodeCommunicationListPerson($this);

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