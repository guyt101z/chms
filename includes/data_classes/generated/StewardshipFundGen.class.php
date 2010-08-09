<?php
	/**
	 * The abstract StewardshipFundGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the StewardshipFund subclass which
	 * extends this StewardshipFundGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the StewardshipFund class.
	 * 
	 * @package ALCF ChMS
	 * @subpackage GeneratedDataObjects
	 * @property integer $Id the value for intId (Read-Only PK)
	 * @property integer $MinistryId the value for intMinistryId 
	 * @property string $Name the value for strName 
	 * @property string $AccountNumber the value for strAccountNumber 
	 * @property Ministry $Ministry the value for the Ministry object referenced by intMinistryId 
	 * @property StewardshipBatch $_StewardshipBatch the value for the private _objStewardshipBatch (Read-Only) if set due to an expansion on the stewardship_batch.stewardship_fund_id reverse relationship
	 * @property StewardshipBatch[] $_StewardshipBatchArray the value for the private _objStewardshipBatchArray (Read-Only) if set due to an ExpandAsArray on the stewardship_batch.stewardship_fund_id reverse relationship
	 * @property StewardshipContribution $_StewardshipContribution the value for the private _objStewardshipContribution (Read-Only) if set due to an expansion on the stewardship_contribution.stewardship_fund_id reverse relationship
	 * @property StewardshipContribution[] $_StewardshipContributionArray the value for the private _objStewardshipContributionArray (Read-Only) if set due to an ExpandAsArray on the stewardship_contribution.stewardship_fund_id reverse relationship
	 * @property boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class StewardshipFundGen extends QBaseClass {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column stewardship_fund.id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column stewardship_fund.ministry_id
		 * @var integer intMinistryId
		 */
		protected $intMinistryId;
		const MinistryIdDefault = null;


		/**
		 * Protected member variable that maps to the database column stewardship_fund.name
		 * @var string strName
		 */
		protected $strName;
		const NameMaxLength = 200;
		const NameDefault = null;


		/**
		 * Protected member variable that maps to the database column stewardship_fund.account_number
		 * @var string strAccountNumber
		 */
		protected $strAccountNumber;
		const AccountNumberMaxLength = 100;
		const AccountNumberDefault = null;


		/**
		 * Private member variable that stores a reference to a single StewardshipBatch object
		 * (of type StewardshipBatch), if this StewardshipFund object was restored with
		 * an expansion on the stewardship_batch association table.
		 * @var StewardshipBatch _objStewardshipBatch;
		 */
		private $_objStewardshipBatch;

		/**
		 * Private member variable that stores a reference to an array of StewardshipBatch objects
		 * (of type StewardshipBatch[]), if this StewardshipFund object was restored with
		 * an ExpandAsArray on the stewardship_batch association table.
		 * @var StewardshipBatch[] _objStewardshipBatchArray;
		 */
		private $_objStewardshipBatchArray = array();

		/**
		 * Private member variable that stores a reference to a single StewardshipContribution object
		 * (of type StewardshipContribution), if this StewardshipFund object was restored with
		 * an expansion on the stewardship_contribution association table.
		 * @var StewardshipContribution _objStewardshipContribution;
		 */
		private $_objStewardshipContribution;

		/**
		 * Private member variable that stores a reference to an array of StewardshipContribution objects
		 * (of type StewardshipContribution[]), if this StewardshipFund object was restored with
		 * an ExpandAsArray on the stewardship_contribution association table.
		 * @var StewardshipContribution[] _objStewardshipContributionArray;
		 */
		private $_objStewardshipContributionArray = array();

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
		 * in the database column stewardship_fund.ministry_id.
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
		 * Load a StewardshipFund from PK Info
		 * @param integer $intId
		 * @return StewardshipFund
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return StewardshipFund::QuerySingle(
				QQ::Equal(QQN::StewardshipFund()->Id, $intId)
			);
		}

		/**
		 * Load all StewardshipFunds
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return StewardshipFund[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call StewardshipFund::QueryArray to perform the LoadAll query
			try {
				return StewardshipFund::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all StewardshipFunds
		 * @return int
		 */
		public static function CountAll() {
			// Call StewardshipFund::QueryCount to perform the CountAll query
			return StewardshipFund::QueryCount(QQ::All());
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
			$objDatabase = StewardshipFund::GetDatabase();

			// Create/Build out the QueryBuilder object with StewardshipFund-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'stewardship_fund');
			StewardshipFund::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('stewardship_fund');

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
		 * Static Qcodo Query method to query for a single StewardshipFund object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return StewardshipFund the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = StewardshipFund::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new StewardshipFund object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return StewardshipFund::InstantiateDbRow($objDbResult->GetNextRow(), null, null, null, $objQueryBuilder->ColumnAliasArray);
		}

		/**
		 * Static Qcodo Query method to query for an array of StewardshipFund objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return StewardshipFund[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = StewardshipFund::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return StewardshipFund::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = StewardshipFund::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcodo Query method to query for a count of StewardshipFund objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = StewardshipFund::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = StewardshipFund::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'stewardship_fund_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with StewardshipFund-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				StewardshipFund::GetSelectFields($objQueryBuilder);
				StewardshipFund::GetFromFields($objQueryBuilder);

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
			return StewardshipFund::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this StewardshipFund
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'stewardship_fund';
				$strAliasPrefix = '';
			}

			$objBuilder->AddSelectItem($strTableName, 'id', $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName, 'ministry_id', $strAliasPrefix . 'ministry_id');
			$objBuilder->AddSelectItem($strTableName, 'name', $strAliasPrefix . 'name');
			$objBuilder->AddSelectItem($strTableName, 'account_number', $strAliasPrefix . 'account_number');
		}




		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a StewardshipFund from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this StewardshipFund::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param QDatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param string $strExpandAsArrayNodes
		 * @param QBaseClass $objPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return StewardshipFund
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
					$strAliasPrefix = 'stewardship_fund__';


				$strAlias = $strAliasPrefix . 'stewardshipbatch__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objStewardshipBatchArray)) {
						$objPreviousChildItem = $objPreviousItem->_objStewardshipBatchArray[$intPreviousChildItemCount - 1];
						$objChildItem = StewardshipBatch::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipbatch__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objStewardshipBatchArray[] = $objChildItem;
					} else
						$objPreviousItem->_objStewardshipBatchArray[] = StewardshipBatch::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipbatch__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}

				$strAlias = $strAliasPrefix . 'stewardshipcontribution__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objStewardshipContributionArray)) {
						$objPreviousChildItem = $objPreviousItem->_objStewardshipContributionArray[$intPreviousChildItemCount - 1];
						$objChildItem = StewardshipContribution::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipcontribution__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objStewardshipContributionArray[] = $objChildItem;
					} else
						$objPreviousItem->_objStewardshipContributionArray[] = StewardshipContribution::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipcontribution__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'stewardship_fund__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the StewardshipFund object
			$objToReturn = new StewardshipFund();
			$objToReturn->__blnRestored = true;

			$strAliasName = array_key_exists($strAliasPrefix . 'id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'id'] : $strAliasPrefix . 'id';
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'ministry_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'ministry_id'] : $strAliasPrefix . 'ministry_id';
			$objToReturn->intMinistryId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'name', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'name'] : $strAliasPrefix . 'name';
			$objToReturn->strName = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAliasName = array_key_exists($strAliasPrefix . 'account_number', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'account_number'] : $strAliasPrefix . 'account_number';
			$objToReturn->strAccountNumber = $objDbRow->GetColumn($strAliasName, 'VarChar');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'stewardship_fund__';

			// Check for Ministry Early Binding
			$strAlias = $strAliasPrefix . 'ministry_id__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName)))
				$objToReturn->objMinistry = Ministry::InstantiateDbRow($objDbRow, $strAliasPrefix . 'ministry_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);




			// Check for StewardshipBatch Virtual Binding
			$strAlias = $strAliasPrefix . 'stewardshipbatch__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objStewardshipBatchArray[] = StewardshipBatch::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipbatch__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objStewardshipBatch = StewardshipBatch::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipbatch__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}

			// Check for StewardshipContribution Virtual Binding
			$strAlias = $strAliasPrefix . 'stewardshipcontribution__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objStewardshipContributionArray[] = StewardshipContribution::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipcontribution__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objStewardshipContribution = StewardshipContribution::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipcontribution__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of StewardshipFunds from a Database Result
		 * @param QDatabaseResultBase $objDbResult
		 * @param string $strExpandAsArrayNodes
		 * @param string[] $strColumnAliasArray
		 * @return StewardshipFund[]
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
					$objItem = StewardshipFund::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = StewardshipFund::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate a single StewardshipFund object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return StewardshipFund next row resulting from the query
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
			return StewardshipFund::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single StewardshipFund object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return StewardshipFund
		*/
		public static function LoadById($intId) {
			return StewardshipFund::QuerySingle(
				QQ::Equal(QQN::StewardshipFund()->Id, $intId)
			);
		}
			
		/**
		 * Load an array of StewardshipFund objects,
		 * by MinistryId Index(es)
		 * @param integer $intMinistryId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return StewardshipFund[]
		*/
		public static function LoadArrayByMinistryId($intMinistryId, $objOptionalClauses = null) {
			// Call StewardshipFund::QueryArray to perform the LoadArrayByMinistryId query
			try {
				return StewardshipFund::QueryArray(
					QQ::Equal(QQN::StewardshipFund()->MinistryId, $intMinistryId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count StewardshipFunds
		 * by MinistryId Index(es)
		 * @param integer $intMinistryId
		 * @return int
		*/
		public static function CountByMinistryId($intMinistryId) {
			// Call StewardshipFund::QueryCount to perform the CountByMinistryId query
			return StewardshipFund::QueryCount(
				QQ::Equal(QQN::StewardshipFund()->MinistryId, $intMinistryId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////




		//////////////////////////
		// SAVE, DELETE AND RELOAD
		//////////////////////////

		/**
		 * Save this StewardshipFund
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		 */
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `stewardship_fund` (
							`ministry_id`,
							`name`,
							`account_number`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intMinistryId) . ',
							' . $objDatabase->SqlVariable($this->strName) . ',
							' . $objDatabase->SqlVariable($this->strAccountNumber) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('stewardship_fund', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`stewardship_fund`
						SET
							`ministry_id` = ' . $objDatabase->SqlVariable($this->intMinistryId) . ',
							`name` = ' . $objDatabase->SqlVariable($this->strName) . ',
							`account_number` = ' . $objDatabase->SqlVariable($this->strAccountNumber) . '
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
		 * Delete this StewardshipFund
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this StewardshipFund with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`stewardship_fund`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all StewardshipFunds
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`stewardship_fund`');
		}

		/**
		 * Truncate stewardship_fund table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `stewardship_fund`');
		}

		/**
		 * Reload this StewardshipFund from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved StewardshipFund object.');

			// Reload the Object
			$objReloaded = StewardshipFund::Load($this->intId);

			// Update $this's local variables to match
			$this->MinistryId = $objReloaded->MinistryId;
			$this->strName = $objReloaded->strName;
			$this->strAccountNumber = $objReloaded->strAccountNumber;
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

				case 'MinistryId':
					// Gets the value for intMinistryId 
					// @return integer
					return $this->intMinistryId;

				case 'Name':
					// Gets the value for strName 
					// @return string
					return $this->strName;

				case 'AccountNumber':
					// Gets the value for strAccountNumber 
					// @return string
					return $this->strAccountNumber;


				///////////////////
				// Member Objects
				///////////////////
				case 'Ministry':
					// Gets the value for the Ministry object referenced by intMinistryId 
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

				case '_StewardshipBatch':
					// Gets the value for the private _objStewardshipBatch (Read-Only)
					// if set due to an expansion on the stewardship_batch.stewardship_fund_id reverse relationship
					// @return StewardshipBatch
					return $this->_objStewardshipBatch;

				case '_StewardshipBatchArray':
					// Gets the value for the private _objStewardshipBatchArray (Read-Only)
					// if set due to an ExpandAsArray on the stewardship_batch.stewardship_fund_id reverse relationship
					// @return StewardshipBatch[]
					return (array) $this->_objStewardshipBatchArray;

				case '_StewardshipContribution':
					// Gets the value for the private _objStewardshipContribution (Read-Only)
					// if set due to an expansion on the stewardship_contribution.stewardship_fund_id reverse relationship
					// @return StewardshipContribution
					return $this->_objStewardshipContribution;

				case '_StewardshipContributionArray':
					// Gets the value for the private _objStewardshipContributionArray (Read-Only)
					// if set due to an ExpandAsArray on the stewardship_contribution.stewardship_fund_id reverse relationship
					// @return StewardshipContribution[]
					return (array) $this->_objStewardshipContributionArray;


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
				case 'MinistryId':
					// Sets the value for intMinistryId 
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

				case 'AccountNumber':
					// Sets the value for strAccountNumber 
					// @param string $mixValue
					// @return string
					try {
						return ($this->strAccountNumber = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'Ministry':
					// Sets the value for the Ministry object referenced by intMinistryId 
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
							throw new QCallerException('Unable to set an unsaved Ministry for this StewardshipFund');

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

			
		
		// Related Objects' Methods for StewardshipBatch
		//-------------------------------------------------------------------

		/**
		 * Gets all associated StewardshipBatches as an array of StewardshipBatch objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return StewardshipBatch[]
		*/ 
		public function GetStewardshipBatchArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return StewardshipBatch::LoadArrayByStewardshipFundId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated StewardshipBatches
		 * @return int
		*/ 
		public function CountStewardshipBatches() {
			if ((is_null($this->intId)))
				return 0;

			return StewardshipBatch::CountByStewardshipFundId($this->intId);
		}

		/**
		 * Associates a StewardshipBatch
		 * @param StewardshipBatch $objStewardshipBatch
		 * @return void
		*/ 
		public function AssociateStewardshipBatch(StewardshipBatch $objStewardshipBatch) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateStewardshipBatch on this unsaved StewardshipFund.');
			if ((is_null($objStewardshipBatch->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateStewardshipBatch on this StewardshipFund with an unsaved StewardshipBatch.');

			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_batch`
				SET
					`stewardship_fund_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipBatch->Id) . '
			');
		}

		/**
		 * Unassociates a StewardshipBatch
		 * @param StewardshipBatch $objStewardshipBatch
		 * @return void
		*/ 
		public function UnassociateStewardshipBatch(StewardshipBatch $objStewardshipBatch) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipBatch on this unsaved StewardshipFund.');
			if ((is_null($objStewardshipBatch->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipBatch on this StewardshipFund with an unsaved StewardshipBatch.');

			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_batch`
				SET
					`stewardship_fund_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipBatch->Id) . ' AND
					`stewardship_fund_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all StewardshipBatches
		 * @return void
		*/ 
		public function UnassociateAllStewardshipBatches() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipBatch on this unsaved StewardshipFund.');

			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_batch`
				SET
					`stewardship_fund_id` = null
				WHERE
					`stewardship_fund_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated StewardshipBatch
		 * @param StewardshipBatch $objStewardshipBatch
		 * @return void
		*/ 
		public function DeleteAssociatedStewardshipBatch(StewardshipBatch $objStewardshipBatch) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipBatch on this unsaved StewardshipFund.');
			if ((is_null($objStewardshipBatch->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipBatch on this StewardshipFund with an unsaved StewardshipBatch.');

			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`stewardship_batch`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipBatch->Id) . ' AND
					`stewardship_fund_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated StewardshipBatches
		 * @return void
		*/ 
		public function DeleteAllStewardshipBatches() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipBatch on this unsaved StewardshipFund.');

			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`stewardship_batch`
				WHERE
					`stewardship_fund_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for StewardshipContribution
		//-------------------------------------------------------------------

		/**
		 * Gets all associated StewardshipContributions as an array of StewardshipContribution objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return StewardshipContribution[]
		*/ 
		public function GetStewardshipContributionArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return StewardshipContribution::LoadArrayByStewardshipFundId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated StewardshipContributions
		 * @return int
		*/ 
		public function CountStewardshipContributions() {
			if ((is_null($this->intId)))
				return 0;

			return StewardshipContribution::CountByStewardshipFundId($this->intId);
		}

		/**
		 * Associates a StewardshipContribution
		 * @param StewardshipContribution $objStewardshipContribution
		 * @return void
		*/ 
		public function AssociateStewardshipContribution(StewardshipContribution $objStewardshipContribution) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateStewardshipContribution on this unsaved StewardshipFund.');
			if ((is_null($objStewardshipContribution->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateStewardshipContribution on this StewardshipFund with an unsaved StewardshipContribution.');

			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_contribution`
				SET
					`stewardship_fund_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipContribution->Id) . '
			');
		}

		/**
		 * Unassociates a StewardshipContribution
		 * @param StewardshipContribution $objStewardshipContribution
		 * @return void
		*/ 
		public function UnassociateStewardshipContribution(StewardshipContribution $objStewardshipContribution) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipContribution on this unsaved StewardshipFund.');
			if ((is_null($objStewardshipContribution->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipContribution on this StewardshipFund with an unsaved StewardshipContribution.');

			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_contribution`
				SET
					`stewardship_fund_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipContribution->Id) . ' AND
					`stewardship_fund_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all StewardshipContributions
		 * @return void
		*/ 
		public function UnassociateAllStewardshipContributions() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipContribution on this unsaved StewardshipFund.');

			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_contribution`
				SET
					`stewardship_fund_id` = null
				WHERE
					`stewardship_fund_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated StewardshipContribution
		 * @param StewardshipContribution $objStewardshipContribution
		 * @return void
		*/ 
		public function DeleteAssociatedStewardshipContribution(StewardshipContribution $objStewardshipContribution) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipContribution on this unsaved StewardshipFund.');
			if ((is_null($objStewardshipContribution->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipContribution on this StewardshipFund with an unsaved StewardshipContribution.');

			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`stewardship_contribution`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipContribution->Id) . ' AND
					`stewardship_fund_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated StewardshipContributions
		 * @return void
		*/ 
		public function DeleteAllStewardshipContributions() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipContribution on this unsaved StewardshipFund.');

			// Get the Database Object for this Class
			$objDatabase = StewardshipFund::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`stewardship_contribution`
				WHERE
					`stewardship_fund_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}





		////////////////////////////////////////
		// METHODS for SOAP-BASED WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="StewardshipFund"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="Ministry" type="xsd1:Ministry"/>';
			$strToReturn .= '<element name="Name" type="xsd:string"/>';
			$strToReturn .= '<element name="AccountNumber" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('StewardshipFund', $strComplexTypeArray)) {
				$strComplexTypeArray['StewardshipFund'] = StewardshipFund::GetSoapComplexTypeXml();
				Ministry::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, StewardshipFund::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new StewardshipFund();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if ((property_exists($objSoapObject, 'Ministry')) &&
				($objSoapObject->Ministry))
				$objToReturn->Ministry = Ministry::GetObjectFromSoapObject($objSoapObject->Ministry);
			if (property_exists($objSoapObject, 'Name'))
				$objToReturn->strName = $objSoapObject->Name;
			if (property_exists($objSoapObject, 'AccountNumber'))
				$objToReturn->strAccountNumber = $objSoapObject->AccountNumber;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, StewardshipFund::GetSoapObjectFromObject($objObject, true));

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

	class QQNodeStewardshipFund extends QQNode {
		protected $strTableName = 'stewardship_fund';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'StewardshipFund';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'Id', 'integer', $this);
				case 'MinistryId':
					return new QQNode('ministry_id', 'MinistryId', 'integer', $this);
				case 'Ministry':
					return new QQNodeMinistry('ministry_id', 'Ministry', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'Name', 'string', $this);
				case 'AccountNumber':
					return new QQNode('account_number', 'AccountNumber', 'string', $this);
				case 'StewardshipBatch':
					return new QQReverseReferenceNodeStewardshipBatch($this, 'stewardshipbatch', 'reverse_reference', 'stewardship_fund_id');
				case 'StewardshipContribution':
					return new QQReverseReferenceNodeStewardshipContribution($this, 'stewardshipcontribution', 'reverse_reference', 'stewardship_fund_id');

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

	class QQReverseReferenceNodeStewardshipFund extends QQReverseReferenceNode {
		protected $strTableName = 'stewardship_fund';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'StewardshipFund';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'Id', 'integer', $this);
				case 'MinistryId':
					return new QQNode('ministry_id', 'MinistryId', 'integer', $this);
				case 'Ministry':
					return new QQNodeMinistry('ministry_id', 'Ministry', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'Name', 'string', $this);
				case 'AccountNumber':
					return new QQNode('account_number', 'AccountNumber', 'string', $this);
				case 'StewardshipBatch':
					return new QQReverseReferenceNodeStewardshipBatch($this, 'stewardshipbatch', 'reverse_reference', 'stewardship_fund_id');
				case 'StewardshipContribution':
					return new QQReverseReferenceNodeStewardshipContribution($this, 'stewardshipcontribution', 'reverse_reference', 'stewardship_fund_id');

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