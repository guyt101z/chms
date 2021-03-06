<?php
	require(__DATAGEN_CLASSES__ . '/StewardshipStackGen.class.php');

	/**
	 * The StewardshipStack class defined here contains any
	 * customized code for the StewardshipStack class in the
	 * Object Relational Model.  It represents the "stewardship_stack" table 
	 * in the database, and extends from the code generated abstract StewardshipStackGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package ALCF ChMS
	 * @subpackage DataObjects
	 * 
	 */
	class StewardshipStack extends StewardshipStackGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objStewardshipStack->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('StewardshipStack Object %s',  $this->intId);
		}

		/**
		 * Refreshes the Stack's ActualTotalAmount based on StewardshipContribution records from the database.
		 * @param boolean $blnSave whether or not to save this record (defaults to true)
		 */
		public function RefreshActualTotalAmount($blnSave = true) {
			$fltTotalAmount = 0;

			$objContributionArray = $this->GetStewardshipContributionArray();
			foreach ($objContributionArray as $objContribution)
				$fltTotalAmount += $objContribution->TotalAmount;

			$this->ItemCount = count($objContributionArray);
			$this->ActualTotalAmount = $fltTotalAmount;
			if ($blnSave) $this->Save();
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of StewardshipStack objects
			return StewardshipStack::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::StewardshipStack()->Param1, $strParam1),
					QQ::GreaterThan(QQN::StewardshipStack()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single StewardshipStack object
			return StewardshipStack::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::StewardshipStack()->Param1, $strParam1),
					QQ::GreaterThan(QQN::StewardshipStack()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of StewardshipStack objects
			return StewardshipStack::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::StewardshipStack()->Param1, $strParam1),
					QQ::Equal(QQN::StewardshipStack()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = StewardshipStack::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`stewardship_stack`.*
				FROM
					`stewardship_stack` AS `stewardship_stack`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return StewardshipStack::InstantiateDbResult($objDbResult);
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