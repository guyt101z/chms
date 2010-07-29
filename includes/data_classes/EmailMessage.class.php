<?php
	require(__DATAGEN_CLASSES__ . '/EmailMessageGen.class.php');

	/**
	 * The EmailMessage class defined here contains any
	 * customized code for the EmailMessage class in the
	 * Object Relational Model.  It represents the "email_message" table 
	 * in the database, and extends from the code generated abstract EmailMessageGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package ALCF ChMS
	 * @subpackage DataObjects
	 * 
	 */
	class EmailMessage extends EmailMessageGen {
		protected $strHeaderArray;
		
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objEmailMessage->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('EmailMessage Object %s',  $this->intId);
		}

		/**
		 * Creates a new EmailMessage object with the raw data from a POP3 Server.
		 * @param string $strRawMessage
		 * @return EmailMessage
		 */
		public static function CreateWithRawMessage($strRawMessage) {
			$objEmailMessage = new EmailMessage();
			$objEmailMessage->RawMessage = $strRawMessage;
			$objEmailMessage->EmailMessageStatusTypeId = EmailMessageStatusType::NotYetAnalyzed;
			$objEmailMessage->DateReceived = QDateTime::Now();
			$objEmailMessage->Save();
			
			return $objEmailMessage;
		}

		/**
		 * This will analyze a NotYetAnalyzed message, doing the appropriate
		 * things to setup links to related objects, queueing outgoing messages, etc.
		 * 
		 * This will throw an exception if its MessageType is NOT NotYetAnalyzed.
		 * @return void
		 */
		public function AnalyzeMessage() {
			if ($this->intEmailMessageStatusTypeId != EmailMessageStatusType::NotYetAnalyzed)
				throw new QCallerException('EmailMessage that is NOT in NotYetAnalyzed status cannot be Analyzed');

			// Do Initial Cleanup and Setup Work
			$this->CleanupAndSetup();

			// Check MessageId
			if (!is_null($this->strMessageIdentifier)) {
				// Duplicate Message -- if so, delete this an move on
				$objMessage = EmailMessage::LoadByMessageIdentifier($this->strMessageIdentifier);

				if ($objMessage && ($objMessage->Id != $this->intId)) {
					$this->Delete();
					return;
				}
			}

			// First, Figure out what the sender Email address is
			$strFromAddress = $this->LookupSenderEmailAddress();

			// If not valid, then something is very wrong -- we should punt immediately
			if (is_null($strFromAddress)) {
				$this->strErrorMessage = 'Invaid From Address';
				$this->intEmailMessageStatusTypeId = EmailMessageStatusType::Error;
				$this->Save();
				return;
			}

			// Get a PersonArray and update Login / CommListEntry links
			$objPersonArray = $this->LookupSenderObject($strFromAddress);
			$this->Save();

			// Next, Figure out the totel set of *potential* recpieint(s) are
			$strEmailAddressArray = $this->CalculateEmailArray();
			$objGroupArray = $this->LookupGroups($strEmailAddressArray);
			$objCommunicationListArray = $this->LookupCommunicationLists($strEmailAddressArray);

			// Next, iterate throug EACH CommList and Group to see which ones that the sender can send to
			$objUnauthorizedCommuniationListArray = $this->SetupCommunicationListAssociations($objCommunicationListArray, $objPersonArray);
			$objUnauthorizedGroupArray = $this->SetupGroupAssociations($objGroupArray, $objPersonArray);

			// Next, Error Reporting
			$this->SetupErrorMessage($strEmailAddressArray, $objUnauthorizedCommuniationListArray, $objUnauthorizedGroupArray);
			$this->Save();
		}

		protected function SetupErrorMessage($strUnmatchedEmailAddressArray, $objUnauthorizedCommuniationListArray, $objUnauthorizedGroupArray) {
			$strErrorMessageArray = array();

			if (count($strUnmatchedEmailAddressArray)) {
				$strErrorMessageArray[] = "The following email addresses do not exist on the system:\r\n    - " . implode("\r\n    - ", $strUnmatchedEmailAddressArray);
			}

			$strUnauthorizedArray = array();
			foreach ($objUnauthorizedCommuniationListArray as $objCommuniationList) $strUnauthorizedArray[] = $objCommuniationList->Token . '@groups.alcf.net';
			foreach ($objUnauthorizedGroupArray as $objGroup) $strUnauthorizedArray[] = $objGroup->Token . '@groups.alcf.net';
			if (count($strUnauthorizedArray)) {
				$strErrorMessageArray[] = "You are not currently authorized to send messages to the following groups or communication lists:\r\n    - " . implode("\r\n    - ", $strUnauthorizedArray);
			}

			if (!$this->CountCommunicationLists() && !$this->CountGroups()) {
				$strErrorMessageArray[] = "No valid groups or communication lists were found in the system.\r\n" .
					"Please be sure you have entered the address correctly and that you are NOT using BCC.";
			}

			if (count($strErrorMessageArray))
				$this->strErrorMessage = implode("\r\n\r\n", $strErrorMessageArray);
			else
				$this->strErrorMessage = null;
		}

		/**
		 * Given the locally set Login and CommListEntry link, and given an array of Person[] objects all which
		 * represent the FromEmailAddress, iterate through the array of Group objects to see which ones
		 * the sender can send to.  Associate any valid ones to this object.  Return any invalid (e.g. unauthorized) ones
		 * as an array.
		 * @param Group[] $objGroupArray
		 * @param Person[] $objPersonArray
		 * @return Group[] returns any unauthorized Groups that the sender is not allowed to send to
		 */
		protected function SetupGroupAssociations($objGroupArray, $objPersonArray) {
			$objUnauthorizedArray = array();

			// TODO

			return $objUnauthorizedArray;
		}
		
		/**
		 * Given the locally set Login and CommListEntry link, and given an array of Person[] objects all which
		 * represent the FromEmailAddress, iterate through the array of CommunicationList objects to see which ones
		 * the sender can send to.  Associate any valid ones to this object.  Return any invalid (e.g. unauthorized) ones
		 * as an array.
		 * @param CommunicationList[] $objCommunicationListArray
		 * @param Person[] $objPersonArray
		 * @return CommunicationList[] returns any unauthorized CommLists that the sender is not allowed to send to
		 */
		protected function SetupCommunicationListAssociations($objCommunicationListArray, $objPersonArray) {
			$objUnauthorizedArray = array();

			// TODO

			return $objUnauthorizedArray;
		}
		
		/**
		 * Given a valid From EmailAddress, this will set the local Login and CommListEntry properties,
		 * as well as return an array of Person objects that all correnspond to this FromEmailAddress.
		 * @param string $strFromAddress
		 * @return Person[]
		 */
		protected function LookupSenderObject($strFromAddress) {
			$this->CommunicationListEntry = CommunicationListEntry::LoadByEmail($strFromAddress);
			$this->Login = Login::LoadByEmail($strFromAddress);

			// Get all Person objects that have this as an email address
			$objPersonArray = Person::QueryArray(QQ::Equal(QQN::Person()->Email->Address, $strFromAddress), QQ::Distinct());
			return $objPersonArray;

//			// Iterate through each person and each group see if there is a GroupParticipation for the pair
//			foreach ($objPersonArray as $objPerson) {
//				if (!$this->Person) {
//					foreach ($objGroupArray as $objGroup) {
//						if (GroupParticipation::CountByPersonIdGroupId($objPerson->Id, $objGroup->Id)) {
//							$this->Person = $objPerson;
//							break;
//						}
//					}
//				}
//			}
//
//			if (!$this->Person) {
//				// Iterate through each CommList see if there is a association for the pair
//				foreach ($objPersonArray as $objPerson) {
//					if (!$this->Person) {
//						foreach ($objCommunicationListArray as $objCommunicationList) {
//							if ($objPerson->IsCommunicationListAssociated($objCommunicationList)) {
//								$this->Person = $objPerson;
//								break;
//							}
//						}
//					}
//				}
//			}
		}

		/**
		 * Attempts to lookup the Sender's Email Address.  Will return NULL if not valid or none.
		 * @return string
		 */
		protected function LookupSenderEmailAddress() {
			$strEmailAddressArray = QEmailServer::GetEmailAddresses($this->GetHeaderValue('From'));
			if (count($strEmailAddressArray) < 1) {
				return null;
			}

			$strFrom = strtolower($strEmailAddressArray[0]);
			foreach ($strEmailAddressArray as $strEmailAddress) {
				if ($strFrom != strtolower($strEmailAddress)) {
					return null;
				}
			}

			return $strFrom;
		}

		protected function CleanupAndSetup() {
			// First, cleanup anything from a prior incomplete analysis (if applicable)
			$this->DeleteAllEmailOutgoingQueues();
			$this->UnassociateAllCommunicationLists();
			$this->UnassociateAllGroups();
			$this->Person = null;
			$this->CommunicationListEntry = null;
			$this->strErrorMessage = null;

			// Parse and cleanup headers
			$intPosition = strpos($this->strRawMessage, "\r\n\r\n");
			if ($intPosition === false) throw new QCallerException('Message does not have distinct Header/Body sections');
			$this->strResponseHeader = substr($this->strRawMessage, 0, $intPosition);
			$this->strResponseBody = substr($this->strRawMessage, $intPosition + 4);

			// Get the HeaderArray
			$this->GetHeaderArray();

			// Update Fields
			$this->strSubject = $this->GetHeaderValue('Subject');
			$this->strMessageIdentifier = $this->GetHeaderValue('Message-Id');
		}

		/**
		 * Given the "To" and "Cc" in the header, create an array of Email Addresses that should be looked up
		 * @return string[]
		 */
		protected function CalculateEmailArray() {
			$strTo = $this->GetHeaderValue('To') . ', ' .
				$this->GetHeaderValue('Cc') . ', ' .
				$this->GetHeaderValue('TO') . ', ' .
				$this->GetHeaderValue('CC') . ', ' .
				$this->GetHeaderValue('to') . ', ' .
				$this->GetHeaderValue('cc');

			$strArrayToReturn = array();

			foreach (QEmailServer::GetEmailAddresses($strTo) as $strEmailAddress) {
				$strEmailAddress = strtolower($strEmailAddress);
				if (strpos($strEmailAddress, '@groups.alcf.net')) $strArrayToReturn[$strEmailAddress] = $strEmailAddress;
			}

			return $strArrayToReturn;
		}

		/**
		 * Given an array of @groups.alcf.net email addresses, lookup which CommLists they belong to.
		 * 
		 * Any FOUND CommList will remove it from the Array!
		 * 
		 * @param string $strEmailAddressArray
		 * @return CommunicationList[]
		 */
		protected function LookupCommunicationLists(&$strEmailAddressArray) {
			$objArrayToReturn = array();
			foreach ($strEmailAddressArray as $strEmailAddress) {
				$strTokens = explode('@', $strEmailAddress);
				if ($objCommunicationList = CommunicationList::LoadByToken($strTokens[0])) {
					$objArrayToReturn[] = $objCommunicationList;
					unset($strEmailAddressArray[$strEmailAddress]);
				}
			}
			return $objArrayToReturn;
		}

		/**
		 * Given an array of @groups.alcf.net email addresses, lookup which Groups they belong to.
		 * 
		 * Any FOUND Group will remove it from the Array!
		 * 
		 * @param string $strEmailAddressArray
		 * @return Group[]
		 */
		protected function LookupGroups(&$strEmailAddressArray) {
			$objArrayToReturn = array();
			foreach ($strEmailAddressArray as $strEmailAddress) {
				$strTokens = explode('@', $strEmailAddress);
				if ($objGroup = Group::LoadByToken($strTokens[0])) {
					$objArrayToReturn[] = $objGroup;
					unset($strEmailAddressArray[$strEmailAddress]);
				}
			}
			return $objArrayToReturn;
		}

		/**
		 * Gets the Value portion of a Header Key/Value pair.
		 * 
		 * This will return NULL if the Header Key does not even exist.
		 * 
		 * If a specific IndexNumber is specified (default), it will return that index item
		 * from the ValueArray for the HeaderKey.
		 * 
		 * If a NULL IndexNumber is specified, it will return any/all Values as an array.
		 * 
		 * @param string $strHeaderKey
		 * @param integer $intIndexNumber
		 * @return mixed
		 */
		public function GetHeaderValue($strHeaderKey, $intIndexNumber = 0) {
			if (array_key_exists($strHeaderKey, $this->strHeaderArray)) {
				if (is_null($intIndexNumber))
					return $this->strHeaderArray[$strHeaderKey];
				else
					return $this->strHeaderArray[$strHeaderKey][$intIndexNumber];
			}

			return null;
		}

		/**
		 * Gets the HeaderInformation as an array of arrays
		 * @return string[][]
		 */
		public function GetHeaderArray() {
			$this->strHeaderArray = array();

			$strCurrentHeaderKey = null;
			$strCurrentHeaderValue = null;
			foreach (explode("\r\n", $this->strResponseHeader) as $strHeaderLine) {
				// Are we on a folded line (as defined by RFC 822, Section 3.1.1)
				if ((substr($strHeaderLine, 0, 1) == ' ') || (substr($strHeaderLine, 0, 1) == "\t")) {
					// Yes -- Process as a continuation
					if (is_null($strCurrentHeaderKey)) throw new Exception('Invalid Header Continuation Found');
					$strCurrentHeaderValue .= ' ' . trim($strHeaderLine);
				} else {
					// No -- Process as a New Header Field/Value pair
					
					// Check to see if we have an existing HeaderKey/Value pair to save
					if (!is_null($strCurrentHeaderKey)) {
						if (!array_key_exists($strCurrentHeaderKey, $this->strHeaderArray)) $this->strHeaderArray[$strCurrentHeaderKey] = array();
						$this->strHeaderArray[$strCurrentHeaderKey][] = $strCurrentHeaderValue;
					}

					$intPosition = strpos($strHeaderLine, ':');
					if ($intPosition === false) throw new Exception('Invalid Header Line Found: ' . $strHeaderLine);
					$strCurrentHeaderKey = trim(substr($strHeaderLine, 0, $intPosition));
					$strCurrentHeaderValue = trim(substr($strHeaderLine, $intPosition+1));
				}
			}

			// One Last Check to see if we have an existing HeaderKey/Value pair to save
			if (!is_null($strCurrentHeaderKey)) {
				if (!array_key_exists($strCurrentHeaderKey, $this->strHeaderArray)) $this->strHeaderArray[$strCurrentHeaderKey] = array();
				$this->strHeaderArray[$strCurrentHeaderKey][] = $strCurrentHeaderValue;
			}

			return $this->strHeaderArray;
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of EmailMessage objects
			return EmailMessage::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::EmailMessage()->Param1, $strParam1),
					QQ::GreaterThan(QQN::EmailMessage()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single EmailMessage object
			return EmailMessage::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::EmailMessage()->Param1, $strParam1),
					QQ::GreaterThan(QQN::EmailMessage()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of EmailMessage objects
			return EmailMessage::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::EmailMessage()->Param1, $strParam1),
					QQ::Equal(QQN::EmailMessage()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = EmailMessage::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`email_message`.*
				FROM
					`email_message` AS `email_message`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return EmailMessage::InstantiateDbResult($objDbResult);
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