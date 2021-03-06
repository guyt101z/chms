<?php
	require(__DATAGEN_CLASSES__ . '/ClassifiedCategoryGen.class.php');

	/**
	 * The ClassifiedCategory class defined here contains any
	 * customized code for the ClassifiedCategory class in the
	 * Object Relational Model.  It represents the "classified_category" table 
	 * in the database, and extends from the code generated abstract ClassifiedCategoryGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package ALCF ChMS
	 * @subpackage DataObjects
	 * 
	 */
	class ClassifiedCategory extends ClassifiedCategoryGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objClassifiedCategory->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return $this->strName;
		}

		public function __get($strName) {
			switch ($strName) {
				case 'DescriptionHtml': return nl2br($this->strDescription, true);
				case 'DisclaimerHtml': return nl2br($this->strDisclaimer, true);
				
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		public static function RefreshOrderNumber() {
			$intOrderNumber = 1;
			foreach (ClassifiedCategory::LoadAll(QQ::OrderBy(QQN::ClassifiedCategory()->OrderNumber)) as $objObject) {
				$objObject->OrderNumber = $intOrderNumber;
				$objObject->Save();
				$intOrderNumber++;
			}
		}

		public function MoveUp() {
			$objToSwapWith = null;
			foreach (ClassifiedCategory::LoadAll(QQ::OrderBy(QQN::ClassifiedCategory()->OrderNumber)) as $objObject) {
				if ($objObject->Id == $this->Id)
					break;
				$objToSwapWith = $objObject;
			}

			$this->OrderNumber--;
			$this->Save();

			if ($objToSwapWith) {
				$objToSwapWith->OrderNumber++;
				$objToSwapWith->Save();
			}

			self::RefreshOrderNumber();
		}
		
		public function MoveDown() {
			$blnFound = false;
			foreach (ClassifiedCategory::LoadAll(QQ::OrderBy(QQN::ClassifiedCategory()->OrderNumber)) as $objObject) {
				if ($blnFound) break;
				if ($objObject->Id == $this->Id) $blnFound = true;
			}

			$this->OrderNumber++;
			$this->Save();

			if ($objObject) {
				$objObject->OrderNumber--;
				$objObject->Save();
			}

			self::RefreshOrderNumber();
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of ClassifiedCategory objects
			return ClassifiedCategory::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::ClassifiedCategory()->Param1, $strParam1),
					QQ::GreaterThan(QQN::ClassifiedCategory()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single ClassifiedCategory object
			return ClassifiedCategory::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::ClassifiedCategory()->Param1, $strParam1),
					QQ::GreaterThan(QQN::ClassifiedCategory()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of ClassifiedCategory objects
			return ClassifiedCategory::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::ClassifiedCategory()->Param1, $strParam1),
					QQ::Equal(QQN::ClassifiedCategory()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = ClassifiedCategory::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`classified_category`.*
				FROM
					`classified_category` AS `classified_category`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return ClassifiedCategory::InstantiateDbResult($objDbResult);
		}
*/




		// Override or Create New Properties and Variables
		// For performance reasons, these variables and __set and __get override methods
		// are commented out.  But if you wish to implement or override any
		// of the data generated properties, please feel free to uncomment them.
/*
		protected $strSomeNewProperty;

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