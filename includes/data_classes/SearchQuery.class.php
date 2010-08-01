<?php
	require(__DATAGEN_CLASSES__ . '/SearchQueryGen.class.php');

	/**
	 * The SearchQuery class defined here contains any
	 * customized code for the SearchQuery class in the
	 * Object Relational Model.  It represents the "search_query" table 
	 * in the database, and extends from the code generated abstract SearchQueryGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package ALCF ChMS
	 * @subpackage DataObjects
	 * 
	 */
	class SearchQuery extends SearchQueryGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objSearchQuery->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('SearchQuery Object %s',  $this->intId);
		}

		/**
		 * This will execute the search query object and should in theory
		 * return an array of Person objects
		 * @param QQClause $objOptionalClauses
		 * @return Person[]
		 */
		public function Execute($objOptionalClauses = null) {
			$objCondition = QQ::All();
			if (!$objOptionalClauses) $objOptionalClauses = array();

			foreach ($this->GetQueryConditionArray() as $objQueryCondition) {
				$blnNotFlag = false;

				switch ($objQueryCondition->QueryConditionTypeId) {
					case QueryConditionType::IsEqualTo:
						$strQqClassName = 'QQConditionEqual';
						break;
					case QueryConditionType::IsNotEqualTo:
						$strQqClassName = 'QQConditionEqual';
						$blnNotFlag = true;
						break;
					case QueryConditionType::IsGreaterThan:
						$strQqClassName = 'QQConditionGreaterThan';
						break;
					default: throw new Exception('Unhandled');
				}

				if ($objQueryCondition->QueryNode->QcodoQueryNode) {
					$objQueryNode = QQN::Person();
					foreach (explode('->', $objQueryCondition->QueryNode->QcodoQueryNode) as $strPropertyName)
						$objQueryNode = $objQueryNode->__get($strPropertyName);

					$objConditionToAdd = new $strQqClassName($objQueryNode, $objQueryCondition->Value);
				} else {
					$objConditionToAdd = new $strQqClassName($objQueryNode);
				}

				// Set up "NOT" Condition and Add it to the total Condition
				if ($blnNotFlag) $objConditionToAdd = QQ::Not($objConditionToAdd);
				$objCondition = QQ::AndCondition($objCondition, $objConditionToAdd);
			}

			return Person::QueryArray($objCondition, $objOptionalClauses);
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of SearchQuery objects
			return SearchQuery::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::SearchQuery()->Param1, $strParam1),
					QQ::GreaterThan(QQN::SearchQuery()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single SearchQuery object
			return SearchQuery::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::SearchQuery()->Param1, $strParam1),
					QQ::GreaterThan(QQN::SearchQuery()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of SearchQuery objects
			return SearchQuery::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::SearchQuery()->Param1, $strParam1),
					QQ::Equal(QQN::SearchQuery()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = SearchQuery::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`search_query`.*
				FROM
					`search_query` AS `search_query`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return SearchQuery::InstantiateDbResult($objDbResult);
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