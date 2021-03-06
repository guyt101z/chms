<?php
	require(__DATAGEN_CLASSES__ . '/FormQuestionGen.class.php');

	/**
	 * The FormQuestion class defined here contains any
	 * customized code for the FormQuestion class in the
	 * Object Relational Model.  It represents the "form_question" table 
	 * in the database, and extends from the code generated abstract FormQuestionGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package ALCF ChMS
	 * @subpackage DataObjects
	 * 
	 */
	class FormQuestion extends FormQuestionGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objFormQuestion->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('FormQuestion Object %s',  $this->intId);
		}

		public function __get($strName) {
			switch ($strName) {
				case 'Type': return FormQuestionType::$NameArray[$this->intFormQuestionTypeId];
				case 'ShortDescriptionBoldIfRequiredHtml':
					if ($this->blnRequiredFlag)
						return '<strong>' . QApplication::HtmlEntities($this->strShortDescription) . '</strong>';
					else
						return QApplication::HtmlEntities($this->strShortDescription);

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
		 * Returns an array of strings that indicate the "options" for this selection box
		 * @return string[]
		 */
		public function GetOptionsAsArray() {
			$strArrayToReturn = array();
			foreach (explode("\n", $this->strOptions) as $strOption) {
				$strOption = trim($strOption);
				if (strlen($strOption)) $strArrayToReturn[] = $strOption;
			}
			return $strArrayToReturn;
		}

		public static function RefreshOrderNumber($intSignupFormId) {
			$intOrderNumber = 1;
			foreach (FormQuestion::LoadArrayBySignupFormId($intSignupFormId, QQ::OrderBy(QQN::FormQuestion()->OrderNumber)) as $objFormQuestion) {
				$objFormQuestion->OrderNumber = $intOrderNumber;
				$objFormQuestion->Save();
				$intOrderNumber++;
			}
		}

		public function MoveUp() {
			$objToSwapWith = null;
			foreach (FormQuestion::LoadArrayBySignupFormId($this->intSignupFormId, QQ::OrderBy(QQN::FormQuestion()->OrderNumber)) as $objFormQuestion) {
				if ($objFormQuestion->Id == $this->Id)
					break;
				$objToSwapWith = $objFormQuestion;
			}

			$this->OrderNumber--;
			$this->Save();

			if ($objToSwapWith) {
				$objToSwapWith->OrderNumber++;
				$objToSwapWith->Save();
			}

			self::RefreshOrderNumber($this->intSignupFormId);
		}
		
		public function MoveDown() {
			$blnFound = false;
			foreach (FormQuestion::LoadArrayBySignupFormId($this->intSignupFormId, QQ::OrderBy(QQN::FormQuestion()->OrderNumber)) as $objFormQuestion) {
				if ($blnFound) break;
				if ($objFormQuestion->Id == $this->Id) $blnFound = true;
			}

			$this->OrderNumber++;
			$this->Save();

			if ($objFormQuestion) {
				$objFormQuestion->OrderNumber--;
				$objFormQuestion->Save();
			}

			self::RefreshOrderNumber($this->intSignupFormId);
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of FormQuestion objects
			return FormQuestion::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::FormQuestion()->Param1, $strParam1),
					QQ::GreaterThan(QQN::FormQuestion()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single FormQuestion object
			return FormQuestion::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::FormQuestion()->Param1, $strParam1),
					QQ::GreaterThan(QQN::FormQuestion()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of FormQuestion objects
			return FormQuestion::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::FormQuestion()->Param1, $strParam1),
					QQ::Equal(QQN::FormQuestion()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = FormQuestion::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`form_question`.*
				FROM
					`form_question` AS `form_question`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return FormQuestion::InstantiateDbResult($objDbResult);
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