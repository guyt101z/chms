<?php
	require(__DATAGEN_CLASSES__ . '/MinistryGen.class.php');

	/**
	 * The Ministry class defined here contains any
	 * customized code for the Ministry class in the
	 * Object Relational Model.  It represents the "ministry" table 
	 * in the database, and extends from the code generated abstract MinistryGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package ALCF ChMS
	 * @subpackage DataObjects
	 * 
	 */
	class Ministry extends MinistryGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objMinistry->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return $this->strName;
		}

		/**
		 * In short, does this login have privileges to administrate this ministry?
		 * The login does if the login is an overall ChMS Administrator OR if the login is
		 * part of the Ministry.
		 * 
		 * If you can administrate it, you can do things like add/remove groups, alter participation roles for the ministry,
		 * view confidential groups, etc.
		 * 
		 * @param Login $objLogin
		 * @return boolean
		 */
		public function IsLoginCanAdminMinistry(Login $objLogin) {
			// Administrators can always administrate
			if ($objLogin->RoleTypeId == RoleType::ChMSAdministrator) return true;

			// Otherwise, only ministry members can edit
			return $objLogin->IsMinistryAssociated($this);
		}

		/**
		* In short, does this login have privileges to view this ministry?
		* To cater for volunteers, who we want to restrict to just viewing the ministries
		* in which they're assisting 
		*
		* @param Login $objLogin
		* @return boolean
		*/
		public function IsLoginCanViewMinistry(Login $objLogin) {
			if ($objLogin->RoleTypeId == RoleType::Volunteer) {
				return $objLogin->IsMinistryAssociated($this);
			} else {
				return true;
			}
		}
		
		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of Ministry objects
			return Ministry::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::Ministry()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Ministry()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single Ministry object
			return Ministry::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Ministry()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Ministry()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of Ministry objects
			return Ministry::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::Ministry()->Param1, $strParam1),
					QQ::Equal(QQN::Ministry()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = Ministry::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`ministry`.*
				FROM
					`ministry` AS `ministry`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return Ministry::InstantiateDbResult($objDbResult);
		}
*/




		// Override or Create New Properties and Variables
		// For performance reasons, these variables and __set and __get override methods
		// are commented out.  But if you wish to implement or override any
		// of the data generated properties, please feel free to uncomment them.
/*
		protected $strSomeNewProperty;

		public function __get($strName) {
			switch ($strName) {
				case 'SomeNewProperty': return $this->strSomeNewProperty;

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		public function __set($strName, $mixValue) {
			switch ($strName) {
				case 'SomeNewProperty':
					try {
						return ($this->strSomeNewProperty = QType::Cast($mixValue, QType::String));
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				default:
					try {
						return (parent::__set($strName, $mixValue));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
*/
	}
?>