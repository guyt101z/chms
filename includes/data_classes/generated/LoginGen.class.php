<?php
	/**
	 * The abstract LoginGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Login subclass which
	 * extends this LoginGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Login class.
	 * 
	 * @package ALCF ChMS
	 * @subpackage GeneratedDataObjects
	 * @property integer $Id the value for intId (Read-Only PK)
	 * @property integer $RoleTypeId the value for intRoleTypeId (Not Null)
	 * @property integer $PermissionBitmap the value for intPermissionBitmap 
	 * @property string $Username the value for strUsername (Unique)
	 * @property string $PasswordCache the value for strPasswordCache 
	 * @property string $PasswordLastSet the value for strPasswordLastSet 
	 * @property QDateTime $DateLastLogin the value for dttDateLastLogin 
	 * @property boolean $DomainActiveFlag the value for blnDomainActiveFlag 
	 * @property boolean $LoginActiveFlag the value for blnLoginActiveFlag 
	 * @property string $Email the value for strEmail (Unique)
	 * @property string $FirstName the value for strFirstName 
	 * @property string $MiddleInitial the value for strMiddleInitial 
	 * @property string $LastName the value for strLastName 
	 * @property ClassInstructor $ClassInstructor the value for the ClassInstructor object that uniquely references this Login
	 * @property Ministry $_Ministry the value for the private _objMinistry (Read-Only) if set due to an expansion on the ministry_login_assn association table
	 * @property Ministry[] $_MinistryArray the value for the private _objMinistryArray (Read-Only) if set due to an ExpandAsArray on the ministry_login_assn association table
	 * @property Comment $_CommentAsPostedBy the value for the private _objCommentAsPostedBy (Read-Only) if set due to an expansion on the comment.posted_by_login_id reverse relationship
	 * @property Comment[] $_CommentAsPostedByArray the value for the private _objCommentAsPostedByArray (Read-Only) if set due to an ExpandAsArray on the comment.posted_by_login_id reverse relationship
	 * @property EmailMessageRoute $_EmailMessageRoute the value for the private _objEmailMessageRoute (Read-Only) if set due to an expansion on the email_message_route.login_id reverse relationship
	 * @property EmailMessageRoute[] $_EmailMessageRouteArray the value for the private _objEmailMessageRouteArray (Read-Only) if set due to an ExpandAsArray on the email_message_route.login_id reverse relationship
	 * @property SmsMessage $_SmsMessage the value for the private _objSmsMessage (Read-Only) if set due to an expansion on the sms_message.login_id reverse relationship
	 * @property SmsMessage[] $_SmsMessageArray the value for the private _objSmsMessageArray (Read-Only) if set due to an ExpandAsArray on the sms_message.login_id reverse relationship
	 * @property StewardshipBatch $_StewardshipBatchAsCreatedBy the value for the private _objStewardshipBatchAsCreatedBy (Read-Only) if set due to an expansion on the stewardship_batch.created_by_login_id reverse relationship
	 * @property StewardshipBatch[] $_StewardshipBatchAsCreatedByArray the value for the private _objStewardshipBatchAsCreatedByArray (Read-Only) if set due to an ExpandAsArray on the stewardship_batch.created_by_login_id reverse relationship
	 * @property StewardshipContribution $_StewardshipContributionAsCreatedBy the value for the private _objStewardshipContributionAsCreatedBy (Read-Only) if set due to an expansion on the stewardship_contribution.created_by_login_id reverse relationship
	 * @property StewardshipContribution[] $_StewardshipContributionAsCreatedByArray the value for the private _objStewardshipContributionAsCreatedByArray (Read-Only) if set due to an ExpandAsArray on the stewardship_contribution.created_by_login_id reverse relationship
	 * @property StewardshipPost $_StewardshipPostAsCreatedBy the value for the private _objStewardshipPostAsCreatedBy (Read-Only) if set due to an expansion on the stewardship_post.created_by_login_id reverse relationship
	 * @property StewardshipPost[] $_StewardshipPostAsCreatedByArray the value for the private _objStewardshipPostAsCreatedByArray (Read-Only) if set due to an ExpandAsArray on the stewardship_post.created_by_login_id reverse relationship
	 * @property boolean $__Restored whether or not this object was restored from the database (as opposed to created new)
	 */
	class LoginGen extends QBaseClass {

		///////////////////////////////////////////////////////////////////////
		// PROTECTED MEMBER VARIABLES and TEXT FIELD MAXLENGTHS (if applicable)
		///////////////////////////////////////////////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column login.id
		 * @var integer intId
		 */
		protected $intId;
		const IdDefault = null;


		/**
		 * Protected member variable that maps to the database column login.role_type_id
		 * @var integer intRoleTypeId
		 */
		protected $intRoleTypeId;
		const RoleTypeIdDefault = null;


		/**
		 * Protected member variable that maps to the database column login.permission_bitmap
		 * @var integer intPermissionBitmap
		 */
		protected $intPermissionBitmap;
		const PermissionBitmapDefault = null;


		/**
		 * Protected member variable that maps to the database column login.username
		 * @var string strUsername
		 */
		protected $strUsername;
		const UsernameMaxLength = 40;
		const UsernameDefault = null;


		/**
		 * Protected member variable that maps to the database column login.password_cache
		 * @var string strPasswordCache
		 */
		protected $strPasswordCache;
		const PasswordCacheMaxLength = 200;
		const PasswordCacheDefault = null;


		/**
		 * Protected member variable that maps to the database column login.password_last_set
		 * @var string strPasswordLastSet
		 */
		protected $strPasswordLastSet;
		const PasswordLastSetMaxLength = 200;
		const PasswordLastSetDefault = null;


		/**
		 * Protected member variable that maps to the database column login.date_last_login
		 * @var QDateTime dttDateLastLogin
		 */
		protected $dttDateLastLogin;
		const DateLastLoginDefault = null;


		/**
		 * Protected member variable that maps to the database column login.domain_active_flag
		 * @var boolean blnDomainActiveFlag
		 */
		protected $blnDomainActiveFlag;
		const DomainActiveFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column login.login_active_flag
		 * @var boolean blnLoginActiveFlag
		 */
		protected $blnLoginActiveFlag;
		const LoginActiveFlagDefault = null;


		/**
		 * Protected member variable that maps to the database column login.email
		 * @var string strEmail
		 */
		protected $strEmail;
		const EmailMaxLength = 200;
		const EmailDefault = null;


		/**
		 * Protected member variable that maps to the database column login.first_name
		 * @var string strFirstName
		 */
		protected $strFirstName;
		const FirstNameMaxLength = 100;
		const FirstNameDefault = null;


		/**
		 * Protected member variable that maps to the database column login.middle_initial
		 * @var string strMiddleInitial
		 */
		protected $strMiddleInitial;
		const MiddleInitialMaxLength = 1;
		const MiddleInitialDefault = null;


		/**
		 * Protected member variable that maps to the database column login.last_name
		 * @var string strLastName
		 */
		protected $strLastName;
		const LastNameMaxLength = 100;
		const LastNameDefault = null;


		/**
		 * Private member variable that stores a reference to a single Ministry object
		 * (of type Ministry), if this Login object was restored with
		 * an expansion on the ministry_login_assn association table.
		 * @var Ministry _objMinistry;
		 */
		private $_objMinistry;

		/**
		 * Private member variable that stores a reference to an array of Ministry objects
		 * (of type Ministry[]), if this Login object was restored with
		 * an ExpandAsArray on the ministry_login_assn association table.
		 * @var Ministry[] _objMinistryArray;
		 */
		private $_objMinistryArray = array();

		/**
		 * Private member variable that stores a reference to a single CommentAsPostedBy object
		 * (of type Comment), if this Login object was restored with
		 * an expansion on the comment association table.
		 * @var Comment _objCommentAsPostedBy;
		 */
		private $_objCommentAsPostedBy;

		/**
		 * Private member variable that stores a reference to an array of CommentAsPostedBy objects
		 * (of type Comment[]), if this Login object was restored with
		 * an ExpandAsArray on the comment association table.
		 * @var Comment[] _objCommentAsPostedByArray;
		 */
		private $_objCommentAsPostedByArray = array();

		/**
		 * Private member variable that stores a reference to a single EmailMessageRoute object
		 * (of type EmailMessageRoute), if this Login object was restored with
		 * an expansion on the email_message_route association table.
		 * @var EmailMessageRoute _objEmailMessageRoute;
		 */
		private $_objEmailMessageRoute;

		/**
		 * Private member variable that stores a reference to an array of EmailMessageRoute objects
		 * (of type EmailMessageRoute[]), if this Login object was restored with
		 * an ExpandAsArray on the email_message_route association table.
		 * @var EmailMessageRoute[] _objEmailMessageRouteArray;
		 */
		private $_objEmailMessageRouteArray = array();

		/**
		 * Private member variable that stores a reference to a single SmsMessage object
		 * (of type SmsMessage), if this Login object was restored with
		 * an expansion on the sms_message association table.
		 * @var SmsMessage _objSmsMessage;
		 */
		private $_objSmsMessage;

		/**
		 * Private member variable that stores a reference to an array of SmsMessage objects
		 * (of type SmsMessage[]), if this Login object was restored with
		 * an ExpandAsArray on the sms_message association table.
		 * @var SmsMessage[] _objSmsMessageArray;
		 */
		private $_objSmsMessageArray = array();

		/**
		 * Private member variable that stores a reference to a single StewardshipBatchAsCreatedBy object
		 * (of type StewardshipBatch), if this Login object was restored with
		 * an expansion on the stewardship_batch association table.
		 * @var StewardshipBatch _objStewardshipBatchAsCreatedBy;
		 */
		private $_objStewardshipBatchAsCreatedBy;

		/**
		 * Private member variable that stores a reference to an array of StewardshipBatchAsCreatedBy objects
		 * (of type StewardshipBatch[]), if this Login object was restored with
		 * an ExpandAsArray on the stewardship_batch association table.
		 * @var StewardshipBatch[] _objStewardshipBatchAsCreatedByArray;
		 */
		private $_objStewardshipBatchAsCreatedByArray = array();

		/**
		 * Private member variable that stores a reference to a single StewardshipContributionAsCreatedBy object
		 * (of type StewardshipContribution), if this Login object was restored with
		 * an expansion on the stewardship_contribution association table.
		 * @var StewardshipContribution _objStewardshipContributionAsCreatedBy;
		 */
		private $_objStewardshipContributionAsCreatedBy;

		/**
		 * Private member variable that stores a reference to an array of StewardshipContributionAsCreatedBy objects
		 * (of type StewardshipContribution[]), if this Login object was restored with
		 * an ExpandAsArray on the stewardship_contribution association table.
		 * @var StewardshipContribution[] _objStewardshipContributionAsCreatedByArray;
		 */
		private $_objStewardshipContributionAsCreatedByArray = array();

		/**
		 * Private member variable that stores a reference to a single StewardshipPostAsCreatedBy object
		 * (of type StewardshipPost), if this Login object was restored with
		 * an expansion on the stewardship_post association table.
		 * @var StewardshipPost _objStewardshipPostAsCreatedBy;
		 */
		private $_objStewardshipPostAsCreatedBy;

		/**
		 * Private member variable that stores a reference to an array of StewardshipPostAsCreatedBy objects
		 * (of type StewardshipPost[]), if this Login object was restored with
		 * an ExpandAsArray on the stewardship_post association table.
		 * @var StewardshipPost[] _objStewardshipPostAsCreatedByArray;
		 */
		private $_objStewardshipPostAsCreatedByArray = array();

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
		 * Protected member variable that contains the object which points to
		 * this object by the reference in the unique database column class_instructor.login_id.
		 *
		 * NOTE: Always use the ClassInstructor property getter to correctly retrieve this ClassInstructor object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var ClassInstructor objClassInstructor
		 */
		protected $objClassInstructor;
		
		/**
		 * Used internally to manage whether the adjoined ClassInstructor object
		 * needs to be updated on save.
		 * 
		 * NOTE: Do not manually update this value 
		 */
		protected $blnDirtyClassInstructor;





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
		 * Load a Login from PK Info
		 * @param integer $intId
		 * @return Login
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return Login::QuerySingle(
				QQ::Equal(QQN::Login()->Id, $intId)
			);
		}

		/**
		 * Load all Logins
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Login[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Login::QueryArray to perform the LoadAll query
			try {
				return Login::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Logins
		 * @return int
		 */
		public static function CountAll() {
			// Call Login::QueryCount to perform the CountAll query
			return Login::QueryCount(QQ::All());
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
			$objDatabase = Login::GetDatabase();

			// Create/Build out the QueryBuilder object with Login-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'login');
			Login::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('login');

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
		 * Static Qcodo Query method to query for a single Login object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Login the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Login::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);

			// Instantiate a new Login object and return it

			// Do we have to expand anything?
			if ($objQueryBuilder->ExpandAsArrayNodes) {
				$objToReturn = array();
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = Login::InstantiateDbRow($objDbRow, null, $objQueryBuilder->ExpandAsArrayNodes, $objToReturn, $objQueryBuilder->ColumnAliasArray);
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
				return Login::InstantiateDbRow($objDbRow, null, null, null, $objQueryBuilder->ColumnAliasArray);
			}
		}

		/**
		 * Static Qcodo Query method to query for an array of Login objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Login[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Login::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Login::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes, $objQueryBuilder->ColumnAliasArray);
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
				$strQuery = Login::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
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
		 * Static Qcodo Query method to query for a count of Login objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Login::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Login::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'login_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Login-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Login::GetSelectFields($objQueryBuilder);
				Login::GetFromFields($objQueryBuilder);

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
			return Login::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Login
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = $strPrefix;
				$strAliasPrefix = $strPrefix . '__';
			} else {
				$strTableName = 'login';
				$strAliasPrefix = '';
			}

			$objBuilder->AddSelectItem($strTableName, 'id', $strAliasPrefix . 'id');
			$objBuilder->AddSelectItem($strTableName, 'role_type_id', $strAliasPrefix . 'role_type_id');
			$objBuilder->AddSelectItem($strTableName, 'permission_bitmap', $strAliasPrefix . 'permission_bitmap');
			$objBuilder->AddSelectItem($strTableName, 'username', $strAliasPrefix . 'username');
			$objBuilder->AddSelectItem($strTableName, 'password_cache', $strAliasPrefix . 'password_cache');
			$objBuilder->AddSelectItem($strTableName, 'password_last_set', $strAliasPrefix . 'password_last_set');
			$objBuilder->AddSelectItem($strTableName, 'date_last_login', $strAliasPrefix . 'date_last_login');
			$objBuilder->AddSelectItem($strTableName, 'domain_active_flag', $strAliasPrefix . 'domain_active_flag');
			$objBuilder->AddSelectItem($strTableName, 'login_active_flag', $strAliasPrefix . 'login_active_flag');
			$objBuilder->AddSelectItem($strTableName, 'email', $strAliasPrefix . 'email');
			$objBuilder->AddSelectItem($strTableName, 'first_name', $strAliasPrefix . 'first_name');
			$objBuilder->AddSelectItem($strTableName, 'middle_initial', $strAliasPrefix . 'middle_initial');
			$objBuilder->AddSelectItem($strTableName, 'last_name', $strAliasPrefix . 'last_name');
		}




		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a Login from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Login::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param QDatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @param string $strExpandAsArrayNodes
		 * @param QBaseClass $objPreviousItem
		 * @param string[] $strColumnAliasArray
		 * @return Login
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
					$strAliasPrefix = 'login__';

				$strAlias = $strAliasPrefix . 'ministry__ministry_id__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objMinistryArray)) {
						$objPreviousChildItem = $objPreviousItem->_objMinistryArray[$intPreviousChildItemCount - 1];
						$objChildItem = Ministry::InstantiateDbRow($objDbRow, $strAliasPrefix . 'ministry__ministry_id__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objMinistryArray[] = $objChildItem;
					} else
						$objPreviousItem->_objMinistryArray[] = Ministry::InstantiateDbRow($objDbRow, $strAliasPrefix . 'ministry__ministry_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}


				$strAlias = $strAliasPrefix . 'commentaspostedby__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objCommentAsPostedByArray)) {
						$objPreviousChildItem = $objPreviousItem->_objCommentAsPostedByArray[$intPreviousChildItemCount - 1];
						$objChildItem = Comment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'commentaspostedby__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objCommentAsPostedByArray[] = $objChildItem;
					} else
						$objPreviousItem->_objCommentAsPostedByArray[] = Comment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'commentaspostedby__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}

				$strAlias = $strAliasPrefix . 'emailmessageroute__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objEmailMessageRouteArray)) {
						$objPreviousChildItem = $objPreviousItem->_objEmailMessageRouteArray[$intPreviousChildItemCount - 1];
						$objChildItem = EmailMessageRoute::InstantiateDbRow($objDbRow, $strAliasPrefix . 'emailmessageroute__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objEmailMessageRouteArray[] = $objChildItem;
					} else
						$objPreviousItem->_objEmailMessageRouteArray[] = EmailMessageRoute::InstantiateDbRow($objDbRow, $strAliasPrefix . 'emailmessageroute__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}

				$strAlias = $strAliasPrefix . 'smsmessage__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objSmsMessageArray)) {
						$objPreviousChildItem = $objPreviousItem->_objSmsMessageArray[$intPreviousChildItemCount - 1];
						$objChildItem = SmsMessage::InstantiateDbRow($objDbRow, $strAliasPrefix . 'smsmessage__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objSmsMessageArray[] = $objChildItem;
					} else
						$objPreviousItem->_objSmsMessageArray[] = SmsMessage::InstantiateDbRow($objDbRow, $strAliasPrefix . 'smsmessage__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}

				$strAlias = $strAliasPrefix . 'stewardshipbatchascreatedby__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objStewardshipBatchAsCreatedByArray)) {
						$objPreviousChildItem = $objPreviousItem->_objStewardshipBatchAsCreatedByArray[$intPreviousChildItemCount - 1];
						$objChildItem = StewardshipBatch::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipbatchascreatedby__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objStewardshipBatchAsCreatedByArray[] = $objChildItem;
					} else
						$objPreviousItem->_objStewardshipBatchAsCreatedByArray[] = StewardshipBatch::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipbatchascreatedby__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}

				$strAlias = $strAliasPrefix . 'stewardshipcontributionascreatedby__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objStewardshipContributionAsCreatedByArray)) {
						$objPreviousChildItem = $objPreviousItem->_objStewardshipContributionAsCreatedByArray[$intPreviousChildItemCount - 1];
						$objChildItem = StewardshipContribution::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipcontributionascreatedby__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objStewardshipContributionAsCreatedByArray[] = $objChildItem;
					} else
						$objPreviousItem->_objStewardshipContributionAsCreatedByArray[] = StewardshipContribution::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipcontributionascreatedby__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}

				$strAlias = $strAliasPrefix . 'stewardshippostascreatedby__id';
				$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
				if ((array_key_exists($strAlias, $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasName)))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objStewardshipPostAsCreatedByArray)) {
						$objPreviousChildItem = $objPreviousItem->_objStewardshipPostAsCreatedByArray[$intPreviousChildItemCount - 1];
						$objChildItem = StewardshipPost::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshippostascreatedby__', $strExpandAsArrayNodes, $objPreviousChildItem, $strColumnAliasArray);
						if ($objChildItem)
							$objPreviousItem->_objStewardshipPostAsCreatedByArray[] = $objChildItem;
					} else
						$objPreviousItem->_objStewardshipPostAsCreatedByArray[] = StewardshipPost::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshippostascreatedby__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'login__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the Login object
			$objToReturn = new Login();
			$objToReturn->__blnRestored = true;

			$strAliasName = array_key_exists($strAliasPrefix . 'id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'id'] : $strAliasPrefix . 'id';
			$objToReturn->intId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'role_type_id', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'role_type_id'] : $strAliasPrefix . 'role_type_id';
			$objToReturn->intRoleTypeId = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'permission_bitmap', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'permission_bitmap'] : $strAliasPrefix . 'permission_bitmap';
			$objToReturn->intPermissionBitmap = $objDbRow->GetColumn($strAliasName, 'Integer');
			$strAliasName = array_key_exists($strAliasPrefix . 'username', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'username'] : $strAliasPrefix . 'username';
			$objToReturn->strUsername = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAliasName = array_key_exists($strAliasPrefix . 'password_cache', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'password_cache'] : $strAliasPrefix . 'password_cache';
			$objToReturn->strPasswordCache = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAliasName = array_key_exists($strAliasPrefix . 'password_last_set', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'password_last_set'] : $strAliasPrefix . 'password_last_set';
			$objToReturn->strPasswordLastSet = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAliasName = array_key_exists($strAliasPrefix . 'date_last_login', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'date_last_login'] : $strAliasPrefix . 'date_last_login';
			$objToReturn->dttDateLastLogin = $objDbRow->GetColumn($strAliasName, 'DateTime');
			$strAliasName = array_key_exists($strAliasPrefix . 'domain_active_flag', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'domain_active_flag'] : $strAliasPrefix . 'domain_active_flag';
			$objToReturn->blnDomainActiveFlag = $objDbRow->GetColumn($strAliasName, 'Bit');
			$strAliasName = array_key_exists($strAliasPrefix . 'login_active_flag', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'login_active_flag'] : $strAliasPrefix . 'login_active_flag';
			$objToReturn->blnLoginActiveFlag = $objDbRow->GetColumn($strAliasName, 'Bit');
			$strAliasName = array_key_exists($strAliasPrefix . 'email', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'email'] : $strAliasPrefix . 'email';
			$objToReturn->strEmail = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAliasName = array_key_exists($strAliasPrefix . 'first_name', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'first_name'] : $strAliasPrefix . 'first_name';
			$objToReturn->strFirstName = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAliasName = array_key_exists($strAliasPrefix . 'middle_initial', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'middle_initial'] : $strAliasPrefix . 'middle_initial';
			$objToReturn->strMiddleInitial = $objDbRow->GetColumn($strAliasName, 'VarChar');
			$strAliasName = array_key_exists($strAliasPrefix . 'last_name', $strColumnAliasArray) ? $strColumnAliasArray[$strAliasPrefix . 'last_name'] : $strAliasPrefix . 'last_name';
			$objToReturn->strLastName = $objDbRow->GetColumn($strAliasName, 'VarChar');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'login__';


			// Check for ClassInstructor Unique ReverseReference Binding
			$strAlias = $strAliasPrefix . 'classinstructor__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if ($objDbRow->ColumnExists($strAliasName)) {
				if (!is_null($objDbRow->GetColumn($strAliasName)))
					$objToReturn->objClassInstructor = ClassInstructor::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classinstructor__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					// We ATTEMPTED to do an Early Bind but the Object Doesn't Exist
					// Let's set to FALSE so that the object knows not to try and re-query again
					$objToReturn->objClassInstructor = false;
			}


			// Check for Ministry Virtual Binding
			$strAlias = $strAliasPrefix . 'ministry__ministry_id__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objMinistryArray[] = Ministry::InstantiateDbRow($objDbRow, $strAliasPrefix . 'ministry__ministry_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objMinistry = Ministry::InstantiateDbRow($objDbRow, $strAliasPrefix . 'ministry__ministry_id__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}


			// Check for CommentAsPostedBy Virtual Binding
			$strAlias = $strAliasPrefix . 'commentaspostedby__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objCommentAsPostedByArray[] = Comment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'commentaspostedby__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objCommentAsPostedBy = Comment::InstantiateDbRow($objDbRow, $strAliasPrefix . 'commentaspostedby__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}

			// Check for EmailMessageRoute Virtual Binding
			$strAlias = $strAliasPrefix . 'emailmessageroute__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objEmailMessageRouteArray[] = EmailMessageRoute::InstantiateDbRow($objDbRow, $strAliasPrefix . 'emailmessageroute__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objEmailMessageRoute = EmailMessageRoute::InstantiateDbRow($objDbRow, $strAliasPrefix . 'emailmessageroute__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}

			// Check for SmsMessage Virtual Binding
			$strAlias = $strAliasPrefix . 'smsmessage__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objSmsMessageArray[] = SmsMessage::InstantiateDbRow($objDbRow, $strAliasPrefix . 'smsmessage__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objSmsMessage = SmsMessage::InstantiateDbRow($objDbRow, $strAliasPrefix . 'smsmessage__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}

			// Check for StewardshipBatchAsCreatedBy Virtual Binding
			$strAlias = $strAliasPrefix . 'stewardshipbatchascreatedby__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objStewardshipBatchAsCreatedByArray[] = StewardshipBatch::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipbatchascreatedby__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objStewardshipBatchAsCreatedBy = StewardshipBatch::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipbatchascreatedby__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}

			// Check for StewardshipContributionAsCreatedBy Virtual Binding
			$strAlias = $strAliasPrefix . 'stewardshipcontributionascreatedby__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objStewardshipContributionAsCreatedByArray[] = StewardshipContribution::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipcontributionascreatedby__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objStewardshipContributionAsCreatedBy = StewardshipContribution::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshipcontributionascreatedby__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}

			// Check for StewardshipPostAsCreatedBy Virtual Binding
			$strAlias = $strAliasPrefix . 'stewardshippostascreatedby__id';
			$strAliasName = array_key_exists($strAlias, $strColumnAliasArray) ? $strColumnAliasArray[$strAlias] : $strAlias;
			if (!is_null($objDbRow->GetColumn($strAliasName))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAlias, $strExpandAsArrayNodes)))
					$objToReturn->_objStewardshipPostAsCreatedByArray[] = StewardshipPost::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshippostascreatedby__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
				else
					$objToReturn->_objStewardshipPostAsCreatedBy = StewardshipPost::InstantiateDbRow($objDbRow, $strAliasPrefix . 'stewardshippostascreatedby__', $strExpandAsArrayNodes, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of Logins from a Database Result
		 * @param QDatabaseResultBase $objDbResult
		 * @param string $strExpandAsArrayNodes
		 * @param string[] $strColumnAliasArray
		 * @return Login[]
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
					$objItem = Login::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem, $strColumnAliasArray);
					if ($objItem) {
						$objToReturn[] = $objItem;
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					$objToReturn[] = Login::InstantiateDbRow($objDbRow, null, null, null, $strColumnAliasArray);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate a single Login object from a query cursor (e.g. a DB ResultSet).
		 * Cursor is automatically moved to the "next row" of the result set.
		 * Will return NULL if no cursor or if the cursor has no more rows in the resultset.
		 * @param QDatabaseResultBase $objDbResult cursor resource
		 * @return Login next row resulting from the query
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
			return Login::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, null, $strColumnAliasArray);
		}




		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Login object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return Login
		*/
		public static function LoadById($intId, $objOptionalClauses = null) {
			return Login::QuerySingle(
				QQ::Equal(QQN::Login()->Id, $intId)
			, $objOptionalClauses
			);
		}
			
		/**
		 * Load a single Login object,
		 * by Username Index(es)
		 * @param string $strUsername
		 * @return Login
		*/
		public static function LoadByUsername($strUsername, $objOptionalClauses = null) {
			return Login::QuerySingle(
				QQ::Equal(QQN::Login()->Username, $strUsername)
			, $objOptionalClauses
			);
		}
			
		/**
		 * Load a single Login object,
		 * by Email Index(es)
		 * @param string $strEmail
		 * @return Login
		*/
		public static function LoadByEmail($strEmail, $objOptionalClauses = null) {
			return Login::QuerySingle(
				QQ::Equal(QQN::Login()->Email, $strEmail)
			, $objOptionalClauses
			);
		}
			
		/**
		 * Load an array of Login objects,
		 * by RoleTypeId Index(es)
		 * @param integer $intRoleTypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Login[]
		*/
		public static function LoadArrayByRoleTypeId($intRoleTypeId, $objOptionalClauses = null) {
			// Call Login::QueryArray to perform the LoadArrayByRoleTypeId query
			try {
				return Login::QueryArray(
					QQ::Equal(QQN::Login()->RoleTypeId, $intRoleTypeId),
					$objOptionalClauses
					);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Logins
		 * by RoleTypeId Index(es)
		 * @param integer $intRoleTypeId
		 * @return int
		*/
		public static function CountByRoleTypeId($intRoleTypeId, $objOptionalClauses = null) {
			// Call Login::QueryCount to perform the CountByRoleTypeId query
			return Login::QueryCount(
				QQ::Equal(QQN::Login()->RoleTypeId, $intRoleTypeId)
			, $objOptionalClauses
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////
			/**
		 * Load an array of Ministry objects for a given Ministry
		 * via the ministry_login_assn table
		 * @param integer $intMinistryId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Login[]
		*/
		public static function LoadArrayByMinistry($intMinistryId, $objOptionalClauses = null) {
			// Call Login::QueryArray to perform the LoadArrayByMinistry query
			try {
				return Login::QueryArray(
					QQ::Equal(QQN::Login()->Ministry->MinistryId, $intMinistryId),
					$objOptionalClauses
				);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Logins for a given Ministry
		 * via the ministry_login_assn table
		 * @param integer $intMinistryId
		 * @return int
		*/
		public static function CountByMinistry($intMinistryId, $objOptionalClauses = null) {
			return Login::QueryCount(
				QQ::Equal(QQN::Login()->Ministry->MinistryId, $intMinistryId),
				$objOptionalClauses
			);
		}




		//////////////////////////////////////
		// SAVE, DELETE, RELOAD and JOURNALING
		//////////////////////////////////////

		/**
		 * Save this Login
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		 */
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `login` (
							`role_type_id`,
							`permission_bitmap`,
							`username`,
							`password_cache`,
							`password_last_set`,
							`date_last_login`,
							`domain_active_flag`,
							`login_active_flag`,
							`email`,
							`first_name`,
							`middle_initial`,
							`last_name`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intRoleTypeId) . ',
							' . $objDatabase->SqlVariable($this->intPermissionBitmap) . ',
							' . $objDatabase->SqlVariable($this->strUsername) . ',
							' . $objDatabase->SqlVariable($this->strPasswordCache) . ',
							' . $objDatabase->SqlVariable($this->strPasswordLastSet) . ',
							' . $objDatabase->SqlVariable($this->dttDateLastLogin) . ',
							' . $objDatabase->SqlVariable($this->blnDomainActiveFlag) . ',
							' . $objDatabase->SqlVariable($this->blnLoginActiveFlag) . ',
							' . $objDatabase->SqlVariable($this->strEmail) . ',
							' . $objDatabase->SqlVariable($this->strFirstName) . ',
							' . $objDatabase->SqlVariable($this->strMiddleInitial) . ',
							' . $objDatabase->SqlVariable($this->strLastName) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('login', 'id');

					// Journaling
					if ($objDatabase->JournalingDatabase) $this->Journal('INSERT');

				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`login`
						SET
							`role_type_id` = ' . $objDatabase->SqlVariable($this->intRoleTypeId) . ',
							`permission_bitmap` = ' . $objDatabase->SqlVariable($this->intPermissionBitmap) . ',
							`username` = ' . $objDatabase->SqlVariable($this->strUsername) . ',
							`password_cache` = ' . $objDatabase->SqlVariable($this->strPasswordCache) . ',
							`password_last_set` = ' . $objDatabase->SqlVariable($this->strPasswordLastSet) . ',
							`date_last_login` = ' . $objDatabase->SqlVariable($this->dttDateLastLogin) . ',
							`domain_active_flag` = ' . $objDatabase->SqlVariable($this->blnDomainActiveFlag) . ',
							`login_active_flag` = ' . $objDatabase->SqlVariable($this->blnLoginActiveFlag) . ',
							`email` = ' . $objDatabase->SqlVariable($this->strEmail) . ',
							`first_name` = ' . $objDatabase->SqlVariable($this->strFirstName) . ',
							`middle_initial` = ' . $objDatabase->SqlVariable($this->strMiddleInitial) . ',
							`last_name` = ' . $objDatabase->SqlVariable($this->strLastName) . '
						WHERE
							`id` = ' . $objDatabase->SqlVariable($this->intId) . '
					');

					// Journaling
					if ($objDatabase->JournalingDatabase) $this->Journal('UPDATE');
				}

		
		
				// Update the adjoined ClassInstructor object (if applicable)
				// TODO: Make this into hard-coded SQL queries
				if ($this->blnDirtyClassInstructor) {
					// Unassociate the old one (if applicable)
					if ($objAssociated = ClassInstructor::LoadByLoginId($this->intId)) {
						$objAssociated->LoginId = null;
						$objAssociated->Save();
					}

					// Associate the new one (if applicable)
					if ($this->objClassInstructor) {
						$this->objClassInstructor->LoginId = $this->intId;
						$this->objClassInstructor->Save();
					}

					// Reset the "Dirty" flag
					$this->blnDirtyClassInstructor = false;
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
		 * Delete this Login
		 * @return void
		 */
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Login with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			
			
			// Update the adjoined ClassInstructor object (if applicable) and perform the unassociation

			// Optional -- if you **KNOW** that you do not want to EVER run any level of business logic on the disassocation,
			// you *could* override Delete() so that this step can be a single hard coded query to optimize performance.
			if ($objAssociated = ClassInstructor::LoadByLoginId($this->intId)) {
				$objAssociated->LoginId = null;
				$objAssociated->Save();
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`login`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');

			// Journaling
			if ($objDatabase->JournalingDatabase) $this->Journal('DELETE');
		}

		/**
		 * Delete all Logins
		 * @return void
		 */
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`login`');
		}

		/**
		 * Truncate login table
		 * @return void
		 */
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `login`');
		}

		/**
		 * Reload this Login from the database.
		 * @return void
		 */
		public function Reload() {
			// Make sure we are actually Restored from the database
			if (!$this->__blnRestored)
				throw new QCallerException('Cannot call Reload() on a new, unsaved Login object.');

			// Reload the Object
			$objReloaded = Login::Load($this->intId);

			// Update $this's local variables to match
			$this->RoleTypeId = $objReloaded->RoleTypeId;
			$this->intPermissionBitmap = $objReloaded->intPermissionBitmap;
			$this->strUsername = $objReloaded->strUsername;
			$this->strPasswordCache = $objReloaded->strPasswordCache;
			$this->strPasswordLastSet = $objReloaded->strPasswordLastSet;
			$this->dttDateLastLogin = $objReloaded->dttDateLastLogin;
			$this->blnDomainActiveFlag = $objReloaded->blnDomainActiveFlag;
			$this->blnLoginActiveFlag = $objReloaded->blnLoginActiveFlag;
			$this->strEmail = $objReloaded->strEmail;
			$this->strFirstName = $objReloaded->strFirstName;
			$this->strMiddleInitial = $objReloaded->strMiddleInitial;
			$this->strLastName = $objReloaded->strLastName;
		}

		/**
		 * Journals the current object into the Log database.
		 * Used internally as a helper method.
		 * @param string $strJournalCommand
		 */
		public function Journal($strJournalCommand) {
			$objDatabase = Login::GetDatabase()->JournalingDatabase;

			$objDatabase->NonQuery('
				INSERT INTO `login` (
					`id`,
					`role_type_id`,
					`permission_bitmap`,
					`username`,
					`password_cache`,
					`password_last_set`,
					`date_last_login`,
					`domain_active_flag`,
					`login_active_flag`,
					`email`,
					`first_name`,
					`middle_initial`,
					`last_name`,
					__sys_login_id,
					__sys_action,
					__sys_date
				) VALUES (
					' . $objDatabase->SqlVariable($this->intId) . ',
					' . $objDatabase->SqlVariable($this->intRoleTypeId) . ',
					' . $objDatabase->SqlVariable($this->intPermissionBitmap) . ',
					' . $objDatabase->SqlVariable($this->strUsername) . ',
					' . $objDatabase->SqlVariable($this->strPasswordCache) . ',
					' . $objDatabase->SqlVariable($this->strPasswordLastSet) . ',
					' . $objDatabase->SqlVariable($this->dttDateLastLogin) . ',
					' . $objDatabase->SqlVariable($this->blnDomainActiveFlag) . ',
					' . $objDatabase->SqlVariable($this->blnLoginActiveFlag) . ',
					' . $objDatabase->SqlVariable($this->strEmail) . ',
					' . $objDatabase->SqlVariable($this->strFirstName) . ',
					' . $objDatabase->SqlVariable($this->strMiddleInitial) . ',
					' . $objDatabase->SqlVariable($this->strLastName) . ',
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
		 * @return Login[]
		 */
		public static function GetJournalForId($intId) {
			$objDatabase = Login::GetDatabase()->JournalingDatabase;

			$objResult = $objDatabase->Query('SELECT * FROM login WHERE id = ' .
				$objDatabase->SqlVariable($intId) . ' ORDER BY __sys_date');

			return Login::InstantiateDbResult($objResult);
		}

		/**
		 * Gets the historical journal for this object from the log database.
		 * Objects will have VirtualAttributes available to lookup login, date, and action information from the journal object.
		 * @return Login[]
		 */
		public function GetJournal() {
			return Login::GetJournalForId($this->intId);
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

				case 'RoleTypeId':
					// Gets the value for intRoleTypeId (Not Null)
					// @return integer
					return $this->intRoleTypeId;

				case 'PermissionBitmap':
					// Gets the value for intPermissionBitmap 
					// @return integer
					return $this->intPermissionBitmap;

				case 'Username':
					// Gets the value for strUsername (Unique)
					// @return string
					return $this->strUsername;

				case 'PasswordCache':
					// Gets the value for strPasswordCache 
					// @return string
					return $this->strPasswordCache;

				case 'PasswordLastSet':
					// Gets the value for strPasswordLastSet 
					// @return string
					return $this->strPasswordLastSet;

				case 'DateLastLogin':
					// Gets the value for dttDateLastLogin 
					// @return QDateTime
					return $this->dttDateLastLogin;

				case 'DomainActiveFlag':
					// Gets the value for blnDomainActiveFlag 
					// @return boolean
					return $this->blnDomainActiveFlag;

				case 'LoginActiveFlag':
					// Gets the value for blnLoginActiveFlag 
					// @return boolean
					return $this->blnLoginActiveFlag;

				case 'Email':
					// Gets the value for strEmail (Unique)
					// @return string
					return $this->strEmail;

				case 'FirstName':
					// Gets the value for strFirstName 
					// @return string
					return $this->strFirstName;

				case 'MiddleInitial':
					// Gets the value for strMiddleInitial 
					// @return string
					return $this->strMiddleInitial;

				case 'LastName':
					// Gets the value for strLastName 
					// @return string
					return $this->strLastName;


				///////////////////
				// Member Objects
				///////////////////
		
		
				case 'ClassInstructor':
					// Gets the value for the ClassInstructor object that uniquely references this Login
					// by objClassInstructor (Unique)
					// @return ClassInstructor
					try {
						if ($this->objClassInstructor === false)
							// We've attempted early binding -- and the reverse reference object does not exist
							return null;
						if (!$this->objClassInstructor)
							$this->objClassInstructor = ClassInstructor::LoadByLoginId($this->intId);
						return $this->objClassInstructor;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_Ministry':
					// Gets the value for the private _objMinistry (Read-Only)
					// if set due to an expansion on the ministry_login_assn association table
					// @return Ministry
					return $this->_objMinistry;

				case '_MinistryArray':
					// Gets the value for the private _objMinistryArray (Read-Only)
					// if set due to an ExpandAsArray on the ministry_login_assn association table
					// @return Ministry[]
					return (array) $this->_objMinistryArray;

				case '_CommentAsPostedBy':
					// Gets the value for the private _objCommentAsPostedBy (Read-Only)
					// if set due to an expansion on the comment.posted_by_login_id reverse relationship
					// @return Comment
					return $this->_objCommentAsPostedBy;

				case '_CommentAsPostedByArray':
					// Gets the value for the private _objCommentAsPostedByArray (Read-Only)
					// if set due to an ExpandAsArray on the comment.posted_by_login_id reverse relationship
					// @return Comment[]
					return (array) $this->_objCommentAsPostedByArray;

				case '_EmailMessageRoute':
					// Gets the value for the private _objEmailMessageRoute (Read-Only)
					// if set due to an expansion on the email_message_route.login_id reverse relationship
					// @return EmailMessageRoute
					return $this->_objEmailMessageRoute;

				case '_EmailMessageRouteArray':
					// Gets the value for the private _objEmailMessageRouteArray (Read-Only)
					// if set due to an ExpandAsArray on the email_message_route.login_id reverse relationship
					// @return EmailMessageRoute[]
					return (array) $this->_objEmailMessageRouteArray;

				case '_SmsMessage':
					// Gets the value for the private _objSmsMessage (Read-Only)
					// if set due to an expansion on the sms_message.login_id reverse relationship
					// @return SmsMessage
					return $this->_objSmsMessage;

				case '_SmsMessageArray':
					// Gets the value for the private _objSmsMessageArray (Read-Only)
					// if set due to an ExpandAsArray on the sms_message.login_id reverse relationship
					// @return SmsMessage[]
					return (array) $this->_objSmsMessageArray;

				case '_StewardshipBatchAsCreatedBy':
					// Gets the value for the private _objStewardshipBatchAsCreatedBy (Read-Only)
					// if set due to an expansion on the stewardship_batch.created_by_login_id reverse relationship
					// @return StewardshipBatch
					return $this->_objStewardshipBatchAsCreatedBy;

				case '_StewardshipBatchAsCreatedByArray':
					// Gets the value for the private _objStewardshipBatchAsCreatedByArray (Read-Only)
					// if set due to an ExpandAsArray on the stewardship_batch.created_by_login_id reverse relationship
					// @return StewardshipBatch[]
					return (array) $this->_objStewardshipBatchAsCreatedByArray;

				case '_StewardshipContributionAsCreatedBy':
					// Gets the value for the private _objStewardshipContributionAsCreatedBy (Read-Only)
					// if set due to an expansion on the stewardship_contribution.created_by_login_id reverse relationship
					// @return StewardshipContribution
					return $this->_objStewardshipContributionAsCreatedBy;

				case '_StewardshipContributionAsCreatedByArray':
					// Gets the value for the private _objStewardshipContributionAsCreatedByArray (Read-Only)
					// if set due to an ExpandAsArray on the stewardship_contribution.created_by_login_id reverse relationship
					// @return StewardshipContribution[]
					return (array) $this->_objStewardshipContributionAsCreatedByArray;

				case '_StewardshipPostAsCreatedBy':
					// Gets the value for the private _objStewardshipPostAsCreatedBy (Read-Only)
					// if set due to an expansion on the stewardship_post.created_by_login_id reverse relationship
					// @return StewardshipPost
					return $this->_objStewardshipPostAsCreatedBy;

				case '_StewardshipPostAsCreatedByArray':
					// Gets the value for the private _objStewardshipPostAsCreatedByArray (Read-Only)
					// if set due to an ExpandAsArray on the stewardship_post.created_by_login_id reverse relationship
					// @return StewardshipPost[]
					return (array) $this->_objStewardshipPostAsCreatedByArray;


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
				case 'RoleTypeId':
					// Sets the value for intRoleTypeId (Not Null)
					// @param integer $mixValue
					// @return integer
					try {
						return ($this->intRoleTypeId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PermissionBitmap':
					// Sets the value for intPermissionBitmap 
					// @param integer $mixValue
					// @return integer
					try {
						return ($this->intPermissionBitmap = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Username':
					// Sets the value for strUsername (Unique)
					// @param string $mixValue
					// @return string
					try {
						return ($this->strUsername = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PasswordCache':
					// Sets the value for strPasswordCache 
					// @param string $mixValue
					// @return string
					try {
						return ($this->strPasswordCache = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'PasswordLastSet':
					// Sets the value for strPasswordLastSet 
					// @param string $mixValue
					// @return string
					try {
						return ($this->strPasswordLastSet = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DateLastLogin':
					// Sets the value for dttDateLastLogin 
					// @param QDateTime $mixValue
					// @return QDateTime
					try {
						return ($this->dttDateLastLogin = QType::Cast($mixValue, QType::DateTime));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DomainActiveFlag':
					// Sets the value for blnDomainActiveFlag 
					// @param boolean $mixValue
					// @return boolean
					try {
						return ($this->blnDomainActiveFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LoginActiveFlag':
					// Sets the value for blnLoginActiveFlag 
					// @param boolean $mixValue
					// @return boolean
					try {
						return ($this->blnLoginActiveFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Email':
					// Sets the value for strEmail (Unique)
					// @param string $mixValue
					// @return string
					try {
						return ($this->strEmail = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FirstName':
					// Sets the value for strFirstName 
					// @param string $mixValue
					// @return string
					try {
						return ($this->strFirstName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'MiddleInitial':
					// Sets the value for strMiddleInitial 
					// @param string $mixValue
					// @return string
					try {
						return ($this->strMiddleInitial = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LastName':
					// Sets the value for strLastName 
					// @param string $mixValue
					// @return string
					try {
						return ($this->strLastName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'ClassInstructor':
					// Sets the value for the ClassInstructor object referenced by objClassInstructor (Unique)
					// @param ClassInstructor $mixValue
					// @return ClassInstructor
					if (is_null($mixValue)) {
						$this->objClassInstructor = null;

						// Make sure we update the adjoined ClassInstructor object the next time we call Save()
						$this->blnDirtyClassInstructor = true;

						return null;
					} else {
						// Make sure $mixValue actually is a ClassInstructor object
						try {
							$mixValue = QType::Cast($mixValue, 'ClassInstructor');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Are we setting objClassInstructor to a DIFFERENT $mixValue?
						if ((!$this->ClassInstructor) || ($this->ClassInstructor->Id != $mixValue->Id)) {
							// Yes -- therefore, set the "Dirty" flag to true
							// to make sure we update the adjoined ClassInstructor object the next time we call Save()
							$this->blnDirtyClassInstructor = true;

							// Update Local Member Variable
							$this->objClassInstructor = $mixValue;
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

			
		
		// Related Objects' Methods for CommentAsPostedBy
		//-------------------------------------------------------------------

		/**
		 * Gets all associated CommentsAsPostedBy as an array of Comment objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Comment[]
		*/ 
		public function GetCommentAsPostedByArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Comment::LoadArrayByPostedByLoginId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated CommentsAsPostedBy
		 * @return int
		*/ 
		public function CountCommentsAsPostedBy() {
			if ((is_null($this->intId)))
				return 0;

			return Comment::CountByPostedByLoginId($this->intId);
		}

		/**
		 * Associates a CommentAsPostedBy
		 * @param Comment $objComment
		 * @return void
		*/ 
		public function AssociateCommentAsPostedBy(Comment $objComment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateCommentAsPostedBy on this unsaved Login.');
			if ((is_null($objComment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateCommentAsPostedBy on this Login with an unsaved Comment.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`comment`
				SET
					`posted_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objComment->Id) . '
			');

			// Journaling (if applicable)
			if ($objDatabase->JournalingDatabase) {
				$objComment->PostedByLoginId = $this->intId;
				$objComment->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates a CommentAsPostedBy
		 * @param Comment $objComment
		 * @return void
		*/ 
		public function UnassociateCommentAsPostedBy(Comment $objComment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCommentAsPostedBy on this unsaved Login.');
			if ((is_null($objComment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCommentAsPostedBy on this Login with an unsaved Comment.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`comment`
				SET
					`posted_by_login_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objComment->Id) . ' AND
					`posted_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objComment->PostedByLoginId = null;
				$objComment->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates all CommentsAsPostedBy
		 * @return void
		*/ 
		public function UnassociateAllCommentsAsPostedBy() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCommentAsPostedBy on this unsaved Login.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (Comment::LoadArrayByPostedByLoginId($this->intId) as $objComment) {
					$objComment->PostedByLoginId = null;
					$objComment->Journal('UPDATE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`comment`
				SET
					`posted_by_login_id` = null
				WHERE
					`posted_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated CommentAsPostedBy
		 * @param Comment $objComment
		 * @return void
		*/ 
		public function DeleteAssociatedCommentAsPostedBy(Comment $objComment) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCommentAsPostedBy on this unsaved Login.');
			if ((is_null($objComment->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCommentAsPostedBy on this Login with an unsaved Comment.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`comment`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objComment->Id) . ' AND
					`posted_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objComment->Journal('DELETE');
			}
		}

		/**
		 * Deletes all associated CommentsAsPostedBy
		 * @return void
		*/ 
		public function DeleteAllCommentsAsPostedBy() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateCommentAsPostedBy on this unsaved Login.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (Comment::LoadArrayByPostedByLoginId($this->intId) as $objComment) {
					$objComment->Journal('DELETE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`comment`
				WHERE
					`posted_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for EmailMessageRoute
		//-------------------------------------------------------------------

		/**
		 * Gets all associated EmailMessageRoutes as an array of EmailMessageRoute objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return EmailMessageRoute[]
		*/ 
		public function GetEmailMessageRouteArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return EmailMessageRoute::LoadArrayByLoginId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated EmailMessageRoutes
		 * @return int
		*/ 
		public function CountEmailMessageRoutes() {
			if ((is_null($this->intId)))
				return 0;

			return EmailMessageRoute::CountByLoginId($this->intId);
		}

		/**
		 * Associates a EmailMessageRoute
		 * @param EmailMessageRoute $objEmailMessageRoute
		 * @return void
		*/ 
		public function AssociateEmailMessageRoute(EmailMessageRoute $objEmailMessageRoute) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEmailMessageRoute on this unsaved Login.');
			if ((is_null($objEmailMessageRoute->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateEmailMessageRoute on this Login with an unsaved EmailMessageRoute.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`email_message_route`
				SET
					`login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objEmailMessageRoute->Id) . '
			');

			// Journaling (if applicable)
			if ($objDatabase->JournalingDatabase) {
				$objEmailMessageRoute->LoginId = $this->intId;
				$objEmailMessageRoute->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates a EmailMessageRoute
		 * @param EmailMessageRoute $objEmailMessageRoute
		 * @return void
		*/ 
		public function UnassociateEmailMessageRoute(EmailMessageRoute $objEmailMessageRoute) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailMessageRoute on this unsaved Login.');
			if ((is_null($objEmailMessageRoute->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailMessageRoute on this Login with an unsaved EmailMessageRoute.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`email_message_route`
				SET
					`login_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objEmailMessageRoute->Id) . ' AND
					`login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objEmailMessageRoute->LoginId = null;
				$objEmailMessageRoute->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates all EmailMessageRoutes
		 * @return void
		*/ 
		public function UnassociateAllEmailMessageRoutes() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailMessageRoute on this unsaved Login.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (EmailMessageRoute::LoadArrayByLoginId($this->intId) as $objEmailMessageRoute) {
					$objEmailMessageRoute->LoginId = null;
					$objEmailMessageRoute->Journal('UPDATE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`email_message_route`
				SET
					`login_id` = null
				WHERE
					`login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated EmailMessageRoute
		 * @param EmailMessageRoute $objEmailMessageRoute
		 * @return void
		*/ 
		public function DeleteAssociatedEmailMessageRoute(EmailMessageRoute $objEmailMessageRoute) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailMessageRoute on this unsaved Login.');
			if ((is_null($objEmailMessageRoute->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailMessageRoute on this Login with an unsaved EmailMessageRoute.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`email_message_route`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objEmailMessageRoute->Id) . ' AND
					`login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objEmailMessageRoute->Journal('DELETE');
			}
		}

		/**
		 * Deletes all associated EmailMessageRoutes
		 * @return void
		*/ 
		public function DeleteAllEmailMessageRoutes() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateEmailMessageRoute on this unsaved Login.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (EmailMessageRoute::LoadArrayByLoginId($this->intId) as $objEmailMessageRoute) {
					$objEmailMessageRoute->Journal('DELETE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`email_message_route`
				WHERE
					`login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for SmsMessage
		//-------------------------------------------------------------------

		/**
		 * Gets all associated SmsMessages as an array of SmsMessage objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return SmsMessage[]
		*/ 
		public function GetSmsMessageArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return SmsMessage::LoadArrayByLoginId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated SmsMessages
		 * @return int
		*/ 
		public function CountSmsMessages() {
			if ((is_null($this->intId)))
				return 0;

			return SmsMessage::CountByLoginId($this->intId);
		}

		/**
		 * Associates a SmsMessage
		 * @param SmsMessage $objSmsMessage
		 * @return void
		*/ 
		public function AssociateSmsMessage(SmsMessage $objSmsMessage) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateSmsMessage on this unsaved Login.');
			if ((is_null($objSmsMessage->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateSmsMessage on this Login with an unsaved SmsMessage.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`sms_message`
				SET
					`login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objSmsMessage->Id) . '
			');

			// Journaling (if applicable)
			if ($objDatabase->JournalingDatabase) {
				$objSmsMessage->LoginId = $this->intId;
				$objSmsMessage->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates a SmsMessage
		 * @param SmsMessage $objSmsMessage
		 * @return void
		*/ 
		public function UnassociateSmsMessage(SmsMessage $objSmsMessage) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSmsMessage on this unsaved Login.');
			if ((is_null($objSmsMessage->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSmsMessage on this Login with an unsaved SmsMessage.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`sms_message`
				SET
					`login_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objSmsMessage->Id) . ' AND
					`login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objSmsMessage->LoginId = null;
				$objSmsMessage->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates all SmsMessages
		 * @return void
		*/ 
		public function UnassociateAllSmsMessages() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSmsMessage on this unsaved Login.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (SmsMessage::LoadArrayByLoginId($this->intId) as $objSmsMessage) {
					$objSmsMessage->LoginId = null;
					$objSmsMessage->Journal('UPDATE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`sms_message`
				SET
					`login_id` = null
				WHERE
					`login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated SmsMessage
		 * @param SmsMessage $objSmsMessage
		 * @return void
		*/ 
		public function DeleteAssociatedSmsMessage(SmsMessage $objSmsMessage) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSmsMessage on this unsaved Login.');
			if ((is_null($objSmsMessage->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSmsMessage on this Login with an unsaved SmsMessage.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`sms_message`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objSmsMessage->Id) . ' AND
					`login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objSmsMessage->Journal('DELETE');
			}
		}

		/**
		 * Deletes all associated SmsMessages
		 * @return void
		*/ 
		public function DeleteAllSmsMessages() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateSmsMessage on this unsaved Login.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (SmsMessage::LoadArrayByLoginId($this->intId) as $objSmsMessage) {
					$objSmsMessage->Journal('DELETE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`sms_message`
				WHERE
					`login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for StewardshipBatchAsCreatedBy
		//-------------------------------------------------------------------

		/**
		 * Gets all associated StewardshipBatchesAsCreatedBy as an array of StewardshipBatch objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return StewardshipBatch[]
		*/ 
		public function GetStewardshipBatchAsCreatedByArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return StewardshipBatch::LoadArrayByCreatedByLoginId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated StewardshipBatchesAsCreatedBy
		 * @return int
		*/ 
		public function CountStewardshipBatchesAsCreatedBy() {
			if ((is_null($this->intId)))
				return 0;

			return StewardshipBatch::CountByCreatedByLoginId($this->intId);
		}

		/**
		 * Associates a StewardshipBatchAsCreatedBy
		 * @param StewardshipBatch $objStewardshipBatch
		 * @return void
		*/ 
		public function AssociateStewardshipBatchAsCreatedBy(StewardshipBatch $objStewardshipBatch) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateStewardshipBatchAsCreatedBy on this unsaved Login.');
			if ((is_null($objStewardshipBatch->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateStewardshipBatchAsCreatedBy on this Login with an unsaved StewardshipBatch.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_batch`
				SET
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipBatch->Id) . '
			');

			// Journaling (if applicable)
			if ($objDatabase->JournalingDatabase) {
				$objStewardshipBatch->CreatedByLoginId = $this->intId;
				$objStewardshipBatch->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates a StewardshipBatchAsCreatedBy
		 * @param StewardshipBatch $objStewardshipBatch
		 * @return void
		*/ 
		public function UnassociateStewardshipBatchAsCreatedBy(StewardshipBatch $objStewardshipBatch) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipBatchAsCreatedBy on this unsaved Login.');
			if ((is_null($objStewardshipBatch->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipBatchAsCreatedBy on this Login with an unsaved StewardshipBatch.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_batch`
				SET
					`created_by_login_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipBatch->Id) . ' AND
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objStewardshipBatch->CreatedByLoginId = null;
				$objStewardshipBatch->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates all StewardshipBatchesAsCreatedBy
		 * @return void
		*/ 
		public function UnassociateAllStewardshipBatchesAsCreatedBy() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipBatchAsCreatedBy on this unsaved Login.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (StewardshipBatch::LoadArrayByCreatedByLoginId($this->intId) as $objStewardshipBatch) {
					$objStewardshipBatch->CreatedByLoginId = null;
					$objStewardshipBatch->Journal('UPDATE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_batch`
				SET
					`created_by_login_id` = null
				WHERE
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated StewardshipBatchAsCreatedBy
		 * @param StewardshipBatch $objStewardshipBatch
		 * @return void
		*/ 
		public function DeleteAssociatedStewardshipBatchAsCreatedBy(StewardshipBatch $objStewardshipBatch) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipBatchAsCreatedBy on this unsaved Login.');
			if ((is_null($objStewardshipBatch->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipBatchAsCreatedBy on this Login with an unsaved StewardshipBatch.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`stewardship_batch`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipBatch->Id) . ' AND
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objStewardshipBatch->Journal('DELETE');
			}
		}

		/**
		 * Deletes all associated StewardshipBatchesAsCreatedBy
		 * @return void
		*/ 
		public function DeleteAllStewardshipBatchesAsCreatedBy() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipBatchAsCreatedBy on this unsaved Login.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (StewardshipBatch::LoadArrayByCreatedByLoginId($this->intId) as $objStewardshipBatch) {
					$objStewardshipBatch->Journal('DELETE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`stewardship_batch`
				WHERE
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for StewardshipContributionAsCreatedBy
		//-------------------------------------------------------------------

		/**
		 * Gets all associated StewardshipContributionsAsCreatedBy as an array of StewardshipContribution objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return StewardshipContribution[]
		*/ 
		public function GetStewardshipContributionAsCreatedByArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return StewardshipContribution::LoadArrayByCreatedByLoginId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated StewardshipContributionsAsCreatedBy
		 * @return int
		*/ 
		public function CountStewardshipContributionsAsCreatedBy() {
			if ((is_null($this->intId)))
				return 0;

			return StewardshipContribution::CountByCreatedByLoginId($this->intId);
		}

		/**
		 * Associates a StewardshipContributionAsCreatedBy
		 * @param StewardshipContribution $objStewardshipContribution
		 * @return void
		*/ 
		public function AssociateStewardshipContributionAsCreatedBy(StewardshipContribution $objStewardshipContribution) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateStewardshipContributionAsCreatedBy on this unsaved Login.');
			if ((is_null($objStewardshipContribution->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateStewardshipContributionAsCreatedBy on this Login with an unsaved StewardshipContribution.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_contribution`
				SET
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipContribution->Id) . '
			');

			// Journaling (if applicable)
			if ($objDatabase->JournalingDatabase) {
				$objStewardshipContribution->CreatedByLoginId = $this->intId;
				$objStewardshipContribution->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates a StewardshipContributionAsCreatedBy
		 * @param StewardshipContribution $objStewardshipContribution
		 * @return void
		*/ 
		public function UnassociateStewardshipContributionAsCreatedBy(StewardshipContribution $objStewardshipContribution) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipContributionAsCreatedBy on this unsaved Login.');
			if ((is_null($objStewardshipContribution->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipContributionAsCreatedBy on this Login with an unsaved StewardshipContribution.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_contribution`
				SET
					`created_by_login_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipContribution->Id) . ' AND
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objStewardshipContribution->CreatedByLoginId = null;
				$objStewardshipContribution->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates all StewardshipContributionsAsCreatedBy
		 * @return void
		*/ 
		public function UnassociateAllStewardshipContributionsAsCreatedBy() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipContributionAsCreatedBy on this unsaved Login.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (StewardshipContribution::LoadArrayByCreatedByLoginId($this->intId) as $objStewardshipContribution) {
					$objStewardshipContribution->CreatedByLoginId = null;
					$objStewardshipContribution->Journal('UPDATE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_contribution`
				SET
					`created_by_login_id` = null
				WHERE
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated StewardshipContributionAsCreatedBy
		 * @param StewardshipContribution $objStewardshipContribution
		 * @return void
		*/ 
		public function DeleteAssociatedStewardshipContributionAsCreatedBy(StewardshipContribution $objStewardshipContribution) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipContributionAsCreatedBy on this unsaved Login.');
			if ((is_null($objStewardshipContribution->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipContributionAsCreatedBy on this Login with an unsaved StewardshipContribution.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`stewardship_contribution`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipContribution->Id) . ' AND
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objStewardshipContribution->Journal('DELETE');
			}
		}

		/**
		 * Deletes all associated StewardshipContributionsAsCreatedBy
		 * @return void
		*/ 
		public function DeleteAllStewardshipContributionsAsCreatedBy() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipContributionAsCreatedBy on this unsaved Login.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (StewardshipContribution::LoadArrayByCreatedByLoginId($this->intId) as $objStewardshipContribution) {
					$objStewardshipContribution->Journal('DELETE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`stewardship_contribution`
				WHERE
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for StewardshipPostAsCreatedBy
		//-------------------------------------------------------------------

		/**
		 * Gets all associated StewardshipPostsAsCreatedBy as an array of StewardshipPost objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return StewardshipPost[]
		*/ 
		public function GetStewardshipPostAsCreatedByArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return StewardshipPost::LoadArrayByCreatedByLoginId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated StewardshipPostsAsCreatedBy
		 * @return int
		*/ 
		public function CountStewardshipPostsAsCreatedBy() {
			if ((is_null($this->intId)))
				return 0;

			return StewardshipPost::CountByCreatedByLoginId($this->intId);
		}

		/**
		 * Associates a StewardshipPostAsCreatedBy
		 * @param StewardshipPost $objStewardshipPost
		 * @return void
		*/ 
		public function AssociateStewardshipPostAsCreatedBy(StewardshipPost $objStewardshipPost) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateStewardshipPostAsCreatedBy on this unsaved Login.');
			if ((is_null($objStewardshipPost->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateStewardshipPostAsCreatedBy on this Login with an unsaved StewardshipPost.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_post`
				SET
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipPost->Id) . '
			');

			// Journaling (if applicable)
			if ($objDatabase->JournalingDatabase) {
				$objStewardshipPost->CreatedByLoginId = $this->intId;
				$objStewardshipPost->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates a StewardshipPostAsCreatedBy
		 * @param StewardshipPost $objStewardshipPost
		 * @return void
		*/ 
		public function UnassociateStewardshipPostAsCreatedBy(StewardshipPost $objStewardshipPost) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipPostAsCreatedBy on this unsaved Login.');
			if ((is_null($objStewardshipPost->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipPostAsCreatedBy on this Login with an unsaved StewardshipPost.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_post`
				SET
					`created_by_login_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipPost->Id) . ' AND
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objStewardshipPost->CreatedByLoginId = null;
				$objStewardshipPost->Journal('UPDATE');
			}
		}

		/**
		 * Unassociates all StewardshipPostsAsCreatedBy
		 * @return void
		*/ 
		public function UnassociateAllStewardshipPostsAsCreatedBy() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipPostAsCreatedBy on this unsaved Login.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (StewardshipPost::LoadArrayByCreatedByLoginId($this->intId) as $objStewardshipPost) {
					$objStewardshipPost->CreatedByLoginId = null;
					$objStewardshipPost->Journal('UPDATE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`stewardship_post`
				SET
					`created_by_login_id` = null
				WHERE
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated StewardshipPostAsCreatedBy
		 * @param StewardshipPost $objStewardshipPost
		 * @return void
		*/ 
		public function DeleteAssociatedStewardshipPostAsCreatedBy(StewardshipPost $objStewardshipPost) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipPostAsCreatedBy on this unsaved Login.');
			if ((is_null($objStewardshipPost->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipPostAsCreatedBy on this Login with an unsaved StewardshipPost.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`stewardship_post`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objStewardshipPost->Id) . ' AND
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				$objStewardshipPost->Journal('DELETE');
			}
		}

		/**
		 * Deletes all associated StewardshipPostsAsCreatedBy
		 * @return void
		*/ 
		public function DeleteAllStewardshipPostsAsCreatedBy() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateStewardshipPostAsCreatedBy on this unsaved Login.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Journaling
			if ($objDatabase->JournalingDatabase) {
				foreach (StewardshipPost::LoadArrayByCreatedByLoginId($this->intId) as $objStewardshipPost) {
					$objStewardshipPost->Journal('DELETE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`stewardship_post`
				WHERE
					`created_by_login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		// Related Many-to-Many Objects' Methods for Ministry
		//-------------------------------------------------------------------

		/**
		 * Gets all many-to-many associated Ministries as an array of Ministry objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Ministry[]
		*/ 
		public function GetMinistryArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Ministry::LoadArrayByLogin($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all many-to-many associated Ministries
		 * @return int
		*/ 
		public function CountMinistries() {
			if ((is_null($this->intId)))
				return 0;

			return Ministry::CountByLogin($this->intId);
		}

		/**
		 * Checks to see if an association exists with a specific Ministry
		 * @param Ministry $objMinistry
		 * @return bool
		*/
		public function IsMinistryAssociated(Ministry $objMinistry) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call IsMinistryAssociated on this unsaved Login.');
			if ((is_null($objMinistry->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call IsMinistryAssociated on this Login with an unsaved Ministry.');

			$intRowCount = Login::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::Login()->Id, $this->intId),
					QQ::Equal(QQN::Login()->Ministry->MinistryId, $objMinistry->Id)
				)
			);

			return ($intRowCount > 0);
		}

		/**
		 * Journals the Ministry relationship into the Log database.
		 * Used internally as a helper method.
		 * @param string $strJournalCommand
		 */
		public function JournalMinistryAssociation($intAssociatedId, $strJournalCommand) {
			$objDatabase = Login::GetDatabase()->JournalingDatabase;

			$objDatabase->NonQuery('
				INSERT INTO `ministry_login_assn` (
					`login_id`,
					`ministry_id`,
					__sys_login_id,
					__sys_action,
					__sys_date
				) VALUES (
					' . $objDatabase->SqlVariable($this->intId) . ',
					' . $objDatabase->SqlVariable($intAssociatedId) . ',
					' . (($objDatabase->JournaledById) ? $objDatabase->JournaledById : 'NULL') . ',
					' . $objDatabase->SqlVariable($strJournalCommand) . ',
					NOW()
				);
			');
		}

		/**
		 * Gets the historical journal for an object's Ministry relationship from the log database.
		 * @param integer intId
		 * @return QDatabaseResult $objResult
		 */
		public static function GetJournalMinistryAssociationForId($intId) {
			$objDatabase = Login::GetDatabase()->JournalingDatabase;

			return $objDatabase->Query('SELECT * FROM ministry_login_assn WHERE login_id = ' .
				$objDatabase->SqlVariable($intId) . ' ORDER BY __sys_date');
		}

		/**
		 * Gets the historical journal for this object's Ministry relationship from the log database.
		 * @return QDatabaseResult $objResult
		 */
		public function GetJournalMinistryAssociation() {
			return Login::GetJournalMinistryAssociationForId($this->intId);
		}

		/**
		 * Associates a Ministry
		 * @param Ministry $objMinistry
		 * @return void
		*/ 
		public function AssociateMinistry(Ministry $objMinistry) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateMinistry on this unsaved Login.');
			if ((is_null($objMinistry->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateMinistry on this Login with an unsaved Ministry.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				INSERT INTO `ministry_login_assn` (
					`login_id`,
					`ministry_id`
				) VALUES (
					' . $objDatabase->SqlVariable($this->intId) . ',
					' . $objDatabase->SqlVariable($objMinistry->Id) . '
				)
			');

			// Journaling (if applicable)
			if ($objDatabase->JournalingDatabase)
				$this->JournalMinistryAssociation($objMinistry->Id, 'INSERT');
		}

		/**
		 * Unassociates a Ministry
		 * @param Ministry $objMinistry
		 * @return void
		*/ 
		public function UnassociateMinistry(Ministry $objMinistry) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateMinistry on this unsaved Login.');
			if ((is_null($objMinistry->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateMinistry on this Login with an unsaved Ministry.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`ministry_login_assn`
				WHERE
					`login_id` = ' . $objDatabase->SqlVariable($this->intId) . ' AND
					`ministry_id` = ' . $objDatabase->SqlVariable($objMinistry->Id) . '
			');

			// Journaling (if applicable)
			if ($objDatabase->JournalingDatabase)
				$this->JournalMinistryAssociation($objMinistry->Id, 'DELETE');
		}

		/**
		 * Unassociates all Ministries
		 * @return void
		*/ 
		public function UnassociateAllMinistries() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateAllMinistryArray on this unsaved Login.');

			// Get the Database Object for this Class
			$objDatabase = Login::GetDatabase();

			// Journaling (if applicable)
			if ($objDatabase->JournalingDatabase) {
				$objResult = $objDatabase->Query('SELECT `ministry_id` AS associated_id FROM `ministry_login_assn` WHERE `login_id` = ' . $objDatabase->SqlVariable($this->intId));
				while ($objRow = $objResult->GetNextRow()) {
					$this->JournalMinistryAssociation($objRow->GetColumn('associated_id'), 'DELETE');
				}
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`ministry_login_assn`
				WHERE
					`login_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}




		////////////////////////////////////////
		// METHODS for SOAP-BASED WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="Login"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="RoleTypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="PermissionBitmap" type="xsd:int"/>';
			$strToReturn .= '<element name="Username" type="xsd:string"/>';
			$strToReturn .= '<element name="PasswordCache" type="xsd:string"/>';
			$strToReturn .= '<element name="PasswordLastSet" type="xsd:string"/>';
			$strToReturn .= '<element name="DateLastLogin" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="DomainActiveFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="LoginActiveFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="Email" type="xsd:string"/>';
			$strToReturn .= '<element name="FirstName" type="xsd:string"/>';
			$strToReturn .= '<element name="MiddleInitial" type="xsd:string"/>';
			$strToReturn .= '<element name="LastName" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Login', $strComplexTypeArray)) {
				$strComplexTypeArray['Login'] = Login::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Login::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Login();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'RoleTypeId'))
				$objToReturn->intRoleTypeId = $objSoapObject->RoleTypeId;
			if (property_exists($objSoapObject, 'PermissionBitmap'))
				$objToReturn->intPermissionBitmap = $objSoapObject->PermissionBitmap;
			if (property_exists($objSoapObject, 'Username'))
				$objToReturn->strUsername = $objSoapObject->Username;
			if (property_exists($objSoapObject, 'PasswordCache'))
				$objToReturn->strPasswordCache = $objSoapObject->PasswordCache;
			if (property_exists($objSoapObject, 'PasswordLastSet'))
				$objToReturn->strPasswordLastSet = $objSoapObject->PasswordLastSet;
			if (property_exists($objSoapObject, 'DateLastLogin'))
				$objToReturn->dttDateLastLogin = new QDateTime($objSoapObject->DateLastLogin);
			if (property_exists($objSoapObject, 'DomainActiveFlag'))
				$objToReturn->blnDomainActiveFlag = $objSoapObject->DomainActiveFlag;
			if (property_exists($objSoapObject, 'LoginActiveFlag'))
				$objToReturn->blnLoginActiveFlag = $objSoapObject->LoginActiveFlag;
			if (property_exists($objSoapObject, 'Email'))
				$objToReturn->strEmail = $objSoapObject->Email;
			if (property_exists($objSoapObject, 'FirstName'))
				$objToReturn->strFirstName = $objSoapObject->FirstName;
			if (property_exists($objSoapObject, 'MiddleInitial'))
				$objToReturn->strMiddleInitial = $objSoapObject->MiddleInitial;
			if (property_exists($objSoapObject, 'LastName'))
				$objToReturn->strLastName = $objSoapObject->LastName;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, Login::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->dttDateLastLogin)
				$objObject->dttDateLastLogin = $objObject->dttDateLastLogin->__toString(QDateTime::FormatSoap);
			return $objObject;
		}




	}



	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	/**
	 * @property-read QQNode $MinistryId
	 * @property-read QQNodeMinistry $Ministry
	 * @property-read QQNodeMinistry $_ChildTableNode
	 */
	class QQNodeLoginMinistry extends QQAssociationNode {
		protected $strType = 'association';
		protected $strName = 'ministry';

		protected $strTableName = 'ministry_login_assn';
		protected $strPrimaryKey = 'login_id';
		protected $strClassName = 'Ministry';

		public function __get($strName) {
			switch ($strName) {
				case 'MinistryId':
					return new QQNode('ministry_id', 'MinistryId', 'integer', $this);
				case 'Ministry':
					return new QQNodeMinistry('ministry_id', 'MinistryId', 'integer', $this);
				case '_ChildTableNode':
					return new QQNodeMinistry('ministry_id', 'MinistryId', 'integer', $this);
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
	 * @property-read QQNode $RoleTypeId
	 * @property-read QQNode $PermissionBitmap
	 * @property-read QQNode $Username
	 * @property-read QQNode $PasswordCache
	 * @property-read QQNode $PasswordLastSet
	 * @property-read QQNode $DateLastLogin
	 * @property-read QQNode $DomainActiveFlag
	 * @property-read QQNode $LoginActiveFlag
	 * @property-read QQNode $Email
	 * @property-read QQNode $FirstName
	 * @property-read QQNode $MiddleInitial
	 * @property-read QQNode $LastName
	 * @property-read QQNodeLoginMinistry $Ministry
	 * @property-read QQReverseReferenceNodeClassInstructor $ClassInstructor
	 * @property-read QQReverseReferenceNodeComment $CommentAsPostedBy
	 * @property-read QQReverseReferenceNodeEmailMessageRoute $EmailMessageRoute
	 * @property-read QQReverseReferenceNodeSmsMessage $SmsMessage
	 * @property-read QQReverseReferenceNodeStewardshipBatch $StewardshipBatchAsCreatedBy
	 * @property-read QQReverseReferenceNodeStewardshipContribution $StewardshipContributionAsCreatedBy
	 * @property-read QQReverseReferenceNodeStewardshipPost $StewardshipPostAsCreatedBy
	 */
	class QQNodeLogin extends QQNode {
		protected $strTableName = 'login';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'Login';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'Id', 'integer', $this);
				case 'RoleTypeId':
					return new QQNode('role_type_id', 'RoleTypeId', 'integer', $this);
				case 'PermissionBitmap':
					return new QQNode('permission_bitmap', 'PermissionBitmap', 'integer', $this);
				case 'Username':
					return new QQNode('username', 'Username', 'string', $this);
				case 'PasswordCache':
					return new QQNode('password_cache', 'PasswordCache', 'string', $this);
				case 'PasswordLastSet':
					return new QQNode('password_last_set', 'PasswordLastSet', 'string', $this);
				case 'DateLastLogin':
					return new QQNode('date_last_login', 'DateLastLogin', 'QDateTime', $this);
				case 'DomainActiveFlag':
					return new QQNode('domain_active_flag', 'DomainActiveFlag', 'boolean', $this);
				case 'LoginActiveFlag':
					return new QQNode('login_active_flag', 'LoginActiveFlag', 'boolean', $this);
				case 'Email':
					return new QQNode('email', 'Email', 'string', $this);
				case 'FirstName':
					return new QQNode('first_name', 'FirstName', 'string', $this);
				case 'MiddleInitial':
					return new QQNode('middle_initial', 'MiddleInitial', 'string', $this);
				case 'LastName':
					return new QQNode('last_name', 'LastName', 'string', $this);
				case 'Ministry':
					return new QQNodeLoginMinistry($this);
				case 'ClassInstructor':
					return new QQReverseReferenceNodeClassInstructor($this, 'classinstructor', 'reverse_reference', 'login_id', 'ClassInstructor');
				case 'CommentAsPostedBy':
					return new QQReverseReferenceNodeComment($this, 'commentaspostedby', 'reverse_reference', 'posted_by_login_id');
				case 'EmailMessageRoute':
					return new QQReverseReferenceNodeEmailMessageRoute($this, 'emailmessageroute', 'reverse_reference', 'login_id');
				case 'SmsMessage':
					return new QQReverseReferenceNodeSmsMessage($this, 'smsmessage', 'reverse_reference', 'login_id');
				case 'StewardshipBatchAsCreatedBy':
					return new QQReverseReferenceNodeStewardshipBatch($this, 'stewardshipbatchascreatedby', 'reverse_reference', 'created_by_login_id');
				case 'StewardshipContributionAsCreatedBy':
					return new QQReverseReferenceNodeStewardshipContribution($this, 'stewardshipcontributionascreatedby', 'reverse_reference', 'created_by_login_id');
				case 'StewardshipPostAsCreatedBy':
					return new QQReverseReferenceNodeStewardshipPost($this, 'stewardshippostascreatedby', 'reverse_reference', 'created_by_login_id');

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
	 * @property-read QQNode $RoleTypeId
	 * @property-read QQNode $PermissionBitmap
	 * @property-read QQNode $Username
	 * @property-read QQNode $PasswordCache
	 * @property-read QQNode $PasswordLastSet
	 * @property-read QQNode $DateLastLogin
	 * @property-read QQNode $DomainActiveFlag
	 * @property-read QQNode $LoginActiveFlag
	 * @property-read QQNode $Email
	 * @property-read QQNode $FirstName
	 * @property-read QQNode $MiddleInitial
	 * @property-read QQNode $LastName
	 * @property-read QQNodeLoginMinistry $Ministry
	 * @property-read QQReverseReferenceNodeClassInstructor $ClassInstructor
	 * @property-read QQReverseReferenceNodeComment $CommentAsPostedBy
	 * @property-read QQReverseReferenceNodeEmailMessageRoute $EmailMessageRoute
	 * @property-read QQReverseReferenceNodeSmsMessage $SmsMessage
	 * @property-read QQReverseReferenceNodeStewardshipBatch $StewardshipBatchAsCreatedBy
	 * @property-read QQReverseReferenceNodeStewardshipContribution $StewardshipContributionAsCreatedBy
	 * @property-read QQReverseReferenceNodeStewardshipPost $StewardshipPostAsCreatedBy
	 * @property-read QQNode $_PrimaryKeyNode
	 */
	class QQReverseReferenceNodeLogin extends QQReverseReferenceNode {
		protected $strTableName = 'login';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'Login';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'Id', 'integer', $this);
				case 'RoleTypeId':
					return new QQNode('role_type_id', 'RoleTypeId', 'integer', $this);
				case 'PermissionBitmap':
					return new QQNode('permission_bitmap', 'PermissionBitmap', 'integer', $this);
				case 'Username':
					return new QQNode('username', 'Username', 'string', $this);
				case 'PasswordCache':
					return new QQNode('password_cache', 'PasswordCache', 'string', $this);
				case 'PasswordLastSet':
					return new QQNode('password_last_set', 'PasswordLastSet', 'string', $this);
				case 'DateLastLogin':
					return new QQNode('date_last_login', 'DateLastLogin', 'QDateTime', $this);
				case 'DomainActiveFlag':
					return new QQNode('domain_active_flag', 'DomainActiveFlag', 'boolean', $this);
				case 'LoginActiveFlag':
					return new QQNode('login_active_flag', 'LoginActiveFlag', 'boolean', $this);
				case 'Email':
					return new QQNode('email', 'Email', 'string', $this);
				case 'FirstName':
					return new QQNode('first_name', 'FirstName', 'string', $this);
				case 'MiddleInitial':
					return new QQNode('middle_initial', 'MiddleInitial', 'string', $this);
				case 'LastName':
					return new QQNode('last_name', 'LastName', 'string', $this);
				case 'Ministry':
					return new QQNodeLoginMinistry($this);
				case 'ClassInstructor':
					return new QQReverseReferenceNodeClassInstructor($this, 'classinstructor', 'reverse_reference', 'login_id', 'ClassInstructor');
				case 'CommentAsPostedBy':
					return new QQReverseReferenceNodeComment($this, 'commentaspostedby', 'reverse_reference', 'posted_by_login_id');
				case 'EmailMessageRoute':
					return new QQReverseReferenceNodeEmailMessageRoute($this, 'emailmessageroute', 'reverse_reference', 'login_id');
				case 'SmsMessage':
					return new QQReverseReferenceNodeSmsMessage($this, 'smsmessage', 'reverse_reference', 'login_id');
				case 'StewardshipBatchAsCreatedBy':
					return new QQReverseReferenceNodeStewardshipBatch($this, 'stewardshipbatchascreatedby', 'reverse_reference', 'created_by_login_id');
				case 'StewardshipContributionAsCreatedBy':
					return new QQReverseReferenceNodeStewardshipContribution($this, 'stewardshipcontributionascreatedby', 'reverse_reference', 'created_by_login_id');
				case 'StewardshipPostAsCreatedBy':
					return new QQReverseReferenceNodeStewardshipPost($this, 'stewardshippostascreatedby', 'reverse_reference', 'created_by_login_id');

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