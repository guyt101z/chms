<?php
	require(__DATAGEN_CLASSES__ . '/ParentPagerAddressGen.class.php');

	/**
	 * The ParentPagerAddress class defined here contains any
	 * customized code for the ParentPagerAddress class in the
	 * Object Relational Model.  It represents the "parent_pager_address" table 
	 * in the database, and extends from the code generated abstract ParentPagerAddressGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package ALCF ChMS
	 * @subpackage DataObjects
	 * 
	 */
	class ParentPagerAddress extends ParentPagerAddressGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objParentPagerAddress->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('ParentPagerAddress Object %s',  $this->intId);
		}

		/**
		 * This will create a new record or update an existing record given the MS SQL Data Row
		 * @param string[] $objRow the mssql_fetch_assoc row result from MS SQL Server
		 * @return ParentPagerAddress
		 */
		public static function CreateOrUpdateForMsSqlRow($objRow) {
			$intServerIdentifier = $objRow['lngAddressID'];
			$intEntityIdentifier = $objRow['lngEntityID'];
			$strEntityCode = trim(strtolower($objRow['chrEntityTypeCode']));
			$strAddress1 = trim($objRow['strAddress1']);
			$strAddress2 = trim($objRow['strAddress2']);
			$strAddress3 = trim($objRow['strAddress3']);
			$strCity = trim($objRow['strCity']);
			$strState = strtoupper(trim($objRow['strState']));
			if (!$strState) $strState = null;
			$strZip = trim($objRow['strZip']);
									
			$objParentPagerAddress = ParentPagerAddress::LoadByServerIdentifier($intServerIdentifier);
			if (!$objParentPagerAddress) {
				$objParentPagerAddress = new ParentPagerAddress();
				$objParentPagerAddress->ServerIdentifier = $intServerIdentifier;
			}

			switch ($strEntityCode) {
				case 'hse':
					$objParentPagerAddress->ParentPagerHousehold = ParentPagerHousehold::LoadByServerIdentifier($intEntityIdentifier);
					$objParentPagerAddress->ParentPagerIndividual = null;
					break;
				case 'att':
					$objParentPagerAddress->ParentPagerHousehold = null;
					$objParentPagerAddress->ParentPagerIndividual = ParentPagerIndividual::LoadByServerIdentifier($intEntityIdentifier);
					break;
				default:
					throw new Exception('Invalid EntityCode for MSSQL Row ' . $intServerIdentifier);
			}
			
			$objParentPagerAddress->Address1 = $strAddress1;
			$objParentPagerAddress->Address2 = $strAddress2;
			$objParentPagerAddress->Address3 = $strAddress3;
			$objParentPagerAddress->City = $strCity;
			$objParentPagerAddress->State = $strState;
			$objParentPagerAddress->ZipCode = $strZip;
			$objParentPagerAddress->Save();

			return $objParentPagerAddress;
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of ParentPagerAddress objects
			return ParentPagerAddress::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::ParentPagerAddress()->Param1, $strParam1),
					QQ::GreaterThan(QQN::ParentPagerAddress()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single ParentPagerAddress object
			return ParentPagerAddress::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::ParentPagerAddress()->Param1, $strParam1),
					QQ::GreaterThan(QQN::ParentPagerAddress()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of ParentPagerAddress objects
			return ParentPagerAddress::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::ParentPagerAddress()->Param1, $strParam1),
					QQ::Equal(QQN::ParentPagerAddress()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = ParentPagerAddress::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`parent_pager_address`.*
				FROM
					`parent_pager_address` AS `parent_pager_address`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return ParentPagerAddress::InstantiateDbResult($objDbResult);
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