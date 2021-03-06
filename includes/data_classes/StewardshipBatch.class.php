<?php
	require(__DATAGEN_CLASSES__ . '/StewardshipBatchGen.class.php');

	/**
	 * The StewardshipBatch class defined here contains any
	 * customized code for the StewardshipBatch class in the
	 * Object Relational Model.  It represents the "stewardship_batch" table 
	 * in the database, and extends from the code generated abstract StewardshipBatchGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package ALCF ChMS
	 * @subpackage DataObjects
	 * 
	 */
	class StewardshipBatch extends StewardshipBatchGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objStewardshipBatch->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('StewardshipBatch Object %s',  $this->intId);
		}

		/**
		 * Creates a new StewardshipBatch with a given description and Batch Date.  Will use Now() if no date is specified.
		 * @param Login $objLogin the login responsible for creating this
		 * @param float $fltReportedTotalAmountArray[] optional
		 * @param string $strDescription optional
		 * @param QDateTime $dttBatchDate optional, or will use Now() if null
		 * @param QDateTime $dttDateCredited optional, or will use $dttBatchDate if null
		 * @return StewardshipBatch
		 */
		public static function Create(Login $objLogin, $fltReportedTotalAmountArray = null, $strDescription = null, QDateTime $dttBatchDate = null, QDateTime $dttDateCredited = null) {
			if (!$dttBatchDate)
				$dttBatchDate = QDateTime::Now();
			else
				$dttBatchDate = new QDateTime($dttBatchDate);
			$dttBatchDate->SetTime(null, null, null);

			if (!$dttDateCredited)
				$dttDateCredited = new QDateTime($dttBatchDate);
			else
				$dttDateCredited = new QDateTime($dttDateCredited);
			$dttDateCredited->SetTime(null, null, null);

			$objBatch = new StewardshipBatch();
			$objBatch->CreatedByLogin = $objLogin;
			$objBatch->StewardshipBatchStatusTypeId = StewardshipBatchStatusType::NewBatch;
			$objBatch->DateEntered = $dttBatchDate;
			$objBatch->DateCredited = $dttDateCredited;

			$objCurrentLastLetter = StewardshipBatch::QuerySingle(QQ::Equal(QQN::StewardshipBatch()->DateEntered, $dttBatchDate), QQ::OrderBy(QQN::StewardshipBatch()->BatchLabel, false));
			if ($objCurrentLastLetter) {
				$objBatch->BatchLabel = chr(ord($objCurrentLastLetter->BatchLabel) + 1);
			} else {
				$objBatch->BatchLabel = 'A';
			}

			if ($fltReportedTotalAmountArray) {
				$objBatch->ReportedTotalAmount = null;
				foreach ($fltReportedTotalAmountArray as $fltReportedTotalAmount)
					$objBatch->ReportedTotalAmount += $fltReportedTotalAmount;
			}
			$objBatch->ActualTotalAmount = 0;
			$objBatch->PostedTotalAmount = 0;
			$objBatch->Description = $strDescription;
			$objBatch->Save();

			// Create Stacks
			if ($fltReportedTotalAmountArray) {
				foreach ($fltReportedTotalAmountArray as $fltReportedTotalAmount) {
					$objBatch->CreateStack($fltReportedTotalAmount);
				}
			}

			return $objBatch;
		}

		/**
		 * Creates a new stack for this batch
		 * @param float $fltReportedTotalAmount optional
		 * @return StewardshipStack
		 */
		public function CreateStack($fltReportedTotalAmount = null) {
			$objStack = new StewardshipStack();
			$objStack->StewardshipBatch = $this;
			$objStack->StackNumber = $this->CountStewardshipStacks() + 1;
			$objStack->ReportedTotalAmount = $fltReportedTotalAmount;
			$objStack->ActualTotalAmount = 0;
			$objStack->Save();
			return $objStack;
		}

		
		/**
		 * This returns a 2d array, where the first index is the TransactionTypeId and second is the count of transactions
		 * in the current batch that goes to that transaction type
		 * @return integer[][]
		 */
		public function GetContributionTypeCountArray() {
			$intArrayToReturn = array();
			$objResult = StewardshipContribution::GetDatabase()->Query('SELECT stewardship_contribution_type_id, count(id) AS row_count ' . 
				'FROM stewardship_contribution WHERE stewardship_batch_id=' . $this->intId . ' GROUP BY stewardship_contribution_type_id;');
			while ($objRow = $objResult->GetNextRow())
				$intArrayToReturn[] = array($objRow->GetColumn('stewardship_contribution_type_id'), $objRow->GetColumn('row_count'));
			return $intArrayToReturn;
		}

		/**
		 * Recalculates ActualTotalAmount based on all linked StewradshipContribution records in the database.
		 * @param boolean $blnSave whether or not to make the call to Save() after ActualTotalAmount has been updated.
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


		/**
		 * Recalculates ReportedTotalAmount based on all linked StewradshipContribution records in the database.
		 * @param boolean $blnSave whether or not to make the call to Save() after ReportedTotalAmount has been updated.
		 */
		public function RefreshReportedTotalAmount($blnSave = true) {
			$fltTotalAmount = 0;

			$objStackArray = $this->GetStewardshipStackArray();
			foreach ($objStackArray as $objStack)
				$fltTotalAmount += $objStack->ReportedTotalAmount;

			$this->ReportedTotalAmount = $fltTotalAmount;
			if ($blnSave) $this->Save();
		}


		/**
		 * Recalculated PostedTotalAmount based on all linked StewardshipPost records in the database.
		 * @param boolean $blnSave whether or not to make the call to Save() after PostedTotalAmount has been updated.
		 */
		public function RefreshPostedTotalAmount($blnSave = true) {
			$fltTotalAmount = 0;
			
			foreach ($this->GetStewardshipPostArray() as $objPost)
				$fltTotalAmount += $objPost->TotalAmount;

			$this->PostedTotalAmount = $fltTotalAmount;
			if ($blnSave) $this->Save();
		}


		/**
		 * Refreshes this batch's current Status
		 * @param boolean $blnSave whether or not to make the call to Save() after Status has been updated.
		 */
		public function RefreshStatus($blnSave = true) {
			$this->RefreshActualTotalAmount(false);
			$this->RefreshPostedTotalAmount(false);

			if ($this->CountStewardshipPosts()) {
				$this->StewardshipBatchStatusTypeId =
					(count($this->GetUnpostedBalanceByStewardshipFundId()) ||
						StewardshipContribution::CountByStewardshipBatchIdUnpostedFlag($this->intId, true)) ?
					StewardshipBatchStatusType::UnpostedChangesExist : StewardshipBatchStatusType::PostedInFull;
			} else {
				$this->StewardshipBatchStatusTypeId = StewardshipBatchStatusType::NewBatch;
			}

			if ($blnSave) $this->Save();
		}

		public function RefreshStackNumbering() {
			$intStackNumber = 1;
			foreach ($this->GetStewardshipStackArray(QQ::OrderBy(QQN::StewardshipStack()->StackNumber)) as $objStack) {
				$objStack->StackNumber = $intStackNumber;
				$objStack->Save();
				$intStackNumber++;
			}
		}

		public static function RefreshBatchLettering(QDateTime $dttDateEntered) {
			$objBatchArray = StewardshipBatch::QueryArray(QQ::Equal(QQN::StewardshipBatch()->DateEntered, $dttDateEntered), QQ::OrderBy(QQN::StewardshipBatch()->BatchLabel));
			$intOrd = ord('A');
			foreach ($objBatchArray as $objBatch) {
				$objBatch->BatchLabel = chr($intOrd);
				$objBatch->Save();
				$intOrd++;
			}
		}

		/**
		 * Performs a Post of any balance on the batch.
		 * @param Login $objLogin
		 * @return StewardshipPost $objPost the actual post object if posted, or null if nothing was needed to be posted
		 */
		public function PostBalance(Login $objLogin) {
			$objPost = null;

			$fltBalanceArray = $this->GetUnpostedBalanceByStewardshipFundId();
			if (count($fltBalanceArray) || StewardshipContribution::CountByStewardshipBatchIdUnpostedFlag($this->intId, true)) {
				$objLastPost = StewardshipPost::QuerySingle(QQ::Equal(QQN::StewardshipPost()->StewardshipBatchId, $this->intId), QQ::OrderBy(QQN::StewardshipPost()->PostNumber, false));
				if ($objLastPost)
					$intPostNumber = $objLastPost->PostNumber + 1;
				else
					$intPostNumber = 1;

				$objPost = new StewardshipPost();
				$objPost->StewardshipBatch = $this;
				$objPost->PostNumber = $intPostNumber;
				$objPost->DatePosted = QDateTime::Now();
				$objPost->CreatedByLoginId = $objLogin->Id;
				$objPost->Save();

				// It is possible (Due to status caching) that this can be called when there is actually nothing to post
				// If this happens, we'll want to delete the Post"
				$blnPosted = false;

				$fltTotalAmount = 0;
				foreach ($fltBalanceArray as $intFundId => $fltAmount) {
					$blnPosted = true;
					$objPostAmount = new StewardshipPostAmount();
					$objPostAmount->StewardshipPostId = $objPost->Id;
					$objPostAmount->StewardshipFundId = $intFundId;
					$objPostAmount->Amount = $fltAmount;
					$objPostAmount->Save();

					$fltTotalAmount += $fltAmount;
				}

				$objPost->TotalAmount = $fltTotalAmount;
				$objPost->Save();

				// Add the Line Items
				foreach (StewardshipContribution::LoadArrayByStewardshipBatchIdUnpostedFlag($this->intId, true) as $objContribution) {
					if ($objContribution->PostLineItems($objPost)) $blnPosted = true;
				}

				// if NOTHING was physically posted, then delete the Post object.
				if (!$blnPosted) {
					$objPost->Delete();
					$objPost = null;
				}
			}

			$this->RefreshStatus();

			// Let's refresh the descriptions
			foreach ($this->GetStewardshipPostArray() as $objPostToRefresh)
				foreach ($objPostToRefresh->GetStewardshipPostLineItemArray() as $objPostLineItem)
					$objPostLineItem->RefreshDescription();

			return $objPost;
		}

		/**
		 * Gets the total UNPOSTED amount to each Fund for this batch.  Returns as an array of float values, indexed by the StewardshipFundId
		 * @return float[]
		 */
		public function GetUnpostedBalanceByStewardshipFundId() {
			$fltTotalAmountArray = $this->GetAmountTotalsByStewardshipFundId();
			$fltTotalPostedArray = $this->GetPostedTotalsByStewardshipFundId();

			// Add Zero values for non-existing indexes
			foreach ($fltTotalAmountArray as $intFundId => $fltAmount)
				if (!array_key_exists($intFundId, $fltTotalPostedArray)) $fltTotalPostedArray[$intFundId] = 0;
			foreach ($fltTotalPostedArray as $intFundId => $fltAmount)
				if (!array_key_exists($intFundId, $fltTotalAmountArray)) $fltTotalAmountArray[$intFundId] = 0;

			// Calculate the Balance by Fund ID
			$fltBalanceArray = array();

			foreach ($fltTotalAmountArray as $intFundId => $fltAmount) {
				$fltAmount = $fltTotalAmountArray[$intFundId] - $fltTotalPostedArray[$intFundId];
				if ($fltAmount) $fltBalanceArray[$intFundId] = $fltAmount;
			}

			return $fltBalanceArray;
		}

		/**
		 * Gets the total amount CONTRIBUTED to each Fund for this batch.  Returns as an array of float values, indexed by the StewardshipFundId
		 * @return float[]
		 */
		public function GetAmountTotalsByStewardshipFundId() {
			$strQuery = 'SELECT SUM(amount) AS amount_sum, stewardship_fund_id ' .
				'FROM stewardship_contribution_amount, stewardship_contribution ' .
				'WHERE stewardship_contribution_id  = stewardship_contribution.id ' .
				'AND stewardship_batch_id=%s ' .
				'GROUP BY stewardship_fund_id';
			$strQuery = sprintf($strQuery, $this->intId);
			$objResult = StewardshipBatch::GetDatabase()->Query($strQuery);

			$fltArrayToReturn = array();
			while ($objRow = $objResult->GetNextRow()) {
				$fltArrayToReturn[$objRow->GetColumn('stewardship_fund_id')] = $objRow->GetColumn('amount_sum');
			}
			return $fltArrayToReturn;
		}
		
		/**
		 * Gets the total amount POSTED to each Fund for this batch.  Returns as an array of float values, indexed by the StewardshipFundId
		 * @return float[]
		 */
		public function GetPostedTotalsByStewardshipFundId() {
			$strQuery = 'SELECT SUM(amount) AS amount_sum, stewardship_fund_id ' .
				'FROM stewardship_post_amount, stewardship_post ' .
				'WHERE stewardship_post_id  = stewardship_post.id ' .
				'AND stewardship_batch_id=%s ' .
				'GROUP BY stewardship_fund_id';
			$strQuery = sprintf($strQuery, $this->intId);
			$objResult = StewardshipBatch::GetDatabase()->Query($strQuery);

			$fltArrayToReturn = array();
			while ($objRow = $objResult->GetNextRow()) {
				$fltArrayToReturn[$objRow->GetColumn('stewardship_fund_id')] = $objRow->GetColumn('amount_sum');
			}
			return $fltArrayToReturn;
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of StewardshipBatch objects
			return StewardshipBatch::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::StewardshipBatch()->Param1, $strParam1),
					QQ::GreaterThan(QQN::StewardshipBatch()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single StewardshipBatch object
			return StewardshipBatch::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::StewardshipBatch()->Param1, $strParam1),
					QQ::GreaterThan(QQN::StewardshipBatch()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of StewardshipBatch objects
			return StewardshipBatch::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::StewardshipBatch()->Param1, $strParam1),
					QQ::Equal(QQN::StewardshipBatch()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = StewardshipBatch::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`stewardship_batch`.*
				FROM
					`stewardship_batch` AS `stewardship_batch`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return StewardshipBatch::InstantiateDbResult($objDbResult);
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