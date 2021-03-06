<?php
	require(__DATAGEN_CLASSES__ . '/GroupGen.class.php');

	/**
	 * The Group class defined here contains any
	 * customized code for the Group class in the
	 * Object Relational Model.  It represents the "group" table 
	 * in the database, and extends from the code generated abstract GroupGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package ALCF ChMS
	 * @subpackage DataObjects
	 * 
	 */
	class Group extends GroupGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objGroup->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('Group Object %s',  $this->intId);
		}

		public function __get($strName) {
			switch ($strName) {
				case 'Type': return GroupType::$NameArray[$this->intGroupTypeId];
				case 'CsvFilename':
					$strName = $this->strName;
					$strToReturn = null;
					for ($i = 0; $i < strlen($strName); $i++) {
						$intOrd = ord($strName[$i]);
						if ((($intOrd >= ord('a')) && ($intOrd <= ord('z'))) ||
							(($intOrd >= ord('A')) && ($intOrd <= ord('Z'))) ||
							(($intOrd >= ord('0')) && ($intOrd <= ord('9'))))
							$strToReturn .= $strName[$i];
					}
					return $strToReturn . '.csv';

				case 'GroupDetail':
					switch ($this->GroupTypeId) {
						case GroupType::GroupCategory:
							return $this->GroupCategory;
						case GroupType::SmartGroup:
							return $this->SmartGroup;
						default:
							throw new QCallerException('Invalid GroupTypeId');
					}
					break;

				case 'EmailTypeHtml':
					switch ($this->EmailBroadcastTypeId) {
						case EmailBroadcastType::PrivateList:
						case EmailBroadcastType::PublicList:
						case EmailBroadcastType::AnnouncementOnly:
							return sprintf('%s &nbsp;|&nbsp; <a href="mailto:%s@groups.alcf.net">%s@groups.alcf.net</a>',
								EmailBroadcastType::$NameArray[$this->EmailBroadcastTypeId],
								QApplication::HtmlEntities($this->Token),
								QApplication::HtmlEntities($this->Token));

						case null:
							return '<span style="color: #999; font-size: 10px; ">None</span>';

						default:
							throw new Exception('Invalid EmailBroadcastTypeId: ' . $this->EmailBroadcastTypeId);
					}

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
		
		public function Delete() {
			$this->DeleteAllEmailMessageRoutes();
			$this->DeleteAllGroupParticipations();
			if ($this->GrowthGroup) $this->GrowthGroup->Delete();
			if ($this->SmartGroup) $this->SmartGroup->Delete();
			if ($this->GroupCategory) $this->GroupCategory->Delete();
			foreach ($this->GetChildGroupArray() as $objChildGroup) $objChildGroup->Delete();
			parent::Delete();
		}

		/**
		 * Retruns an array of groups containing this group and all its children and decendents
		 * Uses Cached Hierarchy Data
		 * @return Group[]
		 */
		public function GetThisAndChildren() {
			$objGroupArray = Group::QueryArray(QQ::AndCondition(
				QQ::Equal(QQN::Group()->MinistryId, $this->intMinistryId),			
				QQ::GreaterOrEqual(QQN::Group()->HierarchyOrderNumber, $this->intHierarchyOrderNumber)
			), QQ::OrderBy(QQN::Group()->HierarchyOrderNumber));

			//$objToReturn = array($objGroupArray[0]);
			$objToReturn = array();
			for ($intIndex = 1; $intIndex < count($objGroupArray); $intIndex++) {
				if ($objGroupArray[$intIndex]->HierarchyLevel > $this->intHierarchyLevel) {
					if($objGroupArray[$intIndex]->ActiveFlag == true)
						$objToReturn[] = $objGroupArray[$intIndex];
				} else {
					return $objToReturn;
				}
			}
			return $objToReturn;
		}

		/**
		 * Gets all associated ACTIVE GroupParticipations as an array of GroupParticipation objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return GroupParticipation[]
		*/ 
		public function GetActiveGroupParticipationArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return GroupParticipation::QueryArray(
					QQ::AndCondition(
						QQ::Equal(QQN::GroupParticipation()->GroupId, $this->intId),
						QQ::OrCondition(
							QQ::IsNull(QQN::GroupParticipation()->DateEnd),
							QQ::GreaterThan(QQN::GroupParticipation()->DateEnd, QDateTime::Now())
						)
					), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Creates a new group for a ministry
		 * @param Ministry $objMinistry
		 * @param integer $intGroupTypeId
		 * @param string $strName
		 * @param string $strDescription
		 * @param Group $objParentGroup optional parent group or NULL for none
		 * @return Group
		 */
		public static function CreateGroupForMinistry(Ministry $objMinistry, $intGroupTypeId, $strName, $strDescription, Group $objParentGroup = null) {
			if ($objParentGroup &&
				($objParentGroup->MinistryId != $objMinistry->Id)) {
				throw new QCallerException('Parent Group is in a different Ministry');
			}

			$objGroup = new Group();
			$objGroup->Ministry = $objMinistry;
			$objGroup->GroupTypeId = $intGroupTypeId;
			$objGroup->Name = $strName;
			$objGroup->Description = $strDescription;
			$objGroup->ParentGroup = $objParentGroup;
			$objGroup->ActiveFlag = true;
			$objGroup->Save();

			return $objGroup;
		}

		/**
		 * Adds a Person to this Group as a Group Participation record.  Throws an exception
		 * if the GroupRole doesn't exist in the Ministry that the group belongs to.
		 * 
		 * If StartDate is NULL, it will use Now()
		 * 
		 * @param Person $objPerson
		 * @param integer $intGroupRoleId
		 * @param QDateTime $dttDateStart
		 * @param QDateTime $dttDateEnd
		 * @return GroupParticipation
		 */
		public function AddPerson(Person $objPerson, $intGroupRoleId, QDateTime $dttDateStart = null, QDateTime $dttDateEnd = null) {
			$objGroupParticipation = new GroupParticipation();
			$objGroupParticipation->Person = $objPerson;
			$objGroupParticipation->Group = $this;
			$objGroupParticipation->GroupRoleId = $intGroupRoleId;
			$objGroupParticipation->DateStart = ($dttDateStart ? $dttDateStart : QDateTime::Now());
			$objGroupParticipation->DateEnd = $dttDateEnd;
			$objGroupParticipation->Save();
		}


		/**
		 * Can the Login view this group information (based on Confidentiality rules)
		 * @param Login $objLogin
		 * @return boolean
		 */
		public function IsLoginCanView(Login $objLogin) {
			// Administrators can always view
			if ($objLogin->RoleTypeId == RoleType::ChMSAdministrator) return true;

			// Anyone can view non-confidential
			if (!$this->blnConfidentialFlag) return true;

			// Otherwise, only ministry members can view
			return $objLogin->IsMinistryAssociated($this->Ministry);
		}

		/**
		 * Can the Login edit this group information (based on Login roles / ministry assignments)
		 * @param Login $objLogin
		 * @return boolean
		 */
		public function IsLoginCanEdit(Login $objLogin) {
			// Administrators can always view
			if ($objLogin->RoleTypeId == RoleType::ChMSAdministrator) return true;

			// Otherwise, only ministry members can edit
			return $objLogin->IsMinistryAssociated($this->Ministry);
		}

		public function IsGroupCanHaveExplicitlyDefinedParticipants() {
			switch ($this->intGroupTypeId) {
				case GroupType::RegularGroup:
				case GroupType::GrowthGroup:
					return true;

				case GroupType::GroupCategory:
				case GroupType::SmartGroup:
					return false;

				default:
					throw new QCallerException('Invalid GroupTypeId to Check: ' . $this->intGroupTypeId);
			}
		}

		/**
		 * Returns the hierarchy of the group, returning any/all parents and ancestors as an a string-based array, indexed by group_id
		 * 
		 * The array itself is ordered, from oldest parent first to immediate parent, last.
		 * 
		 * The array will return an emtpy array if this group is a top-level group (e.g. no parents or ancestors)
		 * @return string[]
		 */
		public function GetGroupNameHierarchyArray() {
			$strArrayToReturn = array();
			$objGroup = $this;
			while ($objParent = $objGroup->ParentGroup) {
				$strArrayToReturn[$objGroup->ParentGroup->Id] = $objGroup->ParentGroup->Name;
				$objGroup = $objParent;
			}
			return array_reverse($strArrayToReturn, true);
		}

		/**
		 * Assuming that the cached heirarchy values are set up correctly, this will return an array of group items
		 * correctly ordered for a hierarchical-listing of groups for a given ministry
		 * @param integer $intMinistryId
		 * @param boolean $blnIncludeConfidential
		 * @param boolean $blnActiveOnly (optional) will only return the "active" ones
		 * @return Group[]
		 */
		public static function LoadOrderedArrayByMinistryIdAndConfidentiality($intMinistryId, $blnIncludeConfidential, $blnActiveOnly = false) {
			$objCondition = QQ::Equal(QQN::Group()->MinistryId, $intMinistryId);

			if (!$blnIncludeConfidential)
				$objCondition = QQ::AndCondition($objCondition, QQ::Equal(QQN::Group()->ConfidentialFlag, false));

			if ($blnActiveOnly)
				$objCondition = QQ::AndCondition($objCondition, QQ::Equal(QQN::Group()->ActiveFlag, true));

			return Group::QueryArray($objCondition, QQ::OrderBy(QQN::Group()->HierarchyOrderNumber));
		}

		/**
		 * Gets an array of Groups for a given ministry, ordered in hierarchical order and name
		 * Only used internally by this class to perform RefreshHierarchyDataForMinistry
		 * @param integer $intMinistryId
		 * @return Group[]
		 */
		protected static function LoadOrderedArrayForMinistry($intMinistryId) {
			$objGroupArray = Group::LoadArrayByMinistryId($intMinistryId, QQ::OrderBy(QQN::Group()->Name));

			return self::LoadOrderedArrayForMinistryHelper($objGroupArray, null);
		}

		/**
		 * Retrieves a list of Groups that can be managed by a given login
		 * @param Login $objLogin
		 * @return Group[]
		 */
		public static function LoadArrayByManagedByLogin(Login $objLogin) {
			if ($objLogin->RoleTypeId == RoleType::ChMSAdministrator) {
				$intMinistryIdArray = array();
				foreach (Ministry::LoadArrayByActiveFlag(true) as $objMinistry) $intMinistryIdArray[] = $objMinistry->Id;
			} else {
				$intMinistryIdArray = array();
				foreach ($objLogin->GetMinistryArray() as $objMinistry) $intMinistryIdArray[] = $objMinistry->Id;
			}

			return Group::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::Group()->GroupTypeId, GroupType::RegularGroup),
					QQ::In(QQN::Group()->MinistryId, $intMinistryIdArray),
					QQ::Equal(QQN::Group()->ActiveFlag, true)
				), QQ::OrderBy(QQN::Group()->Name)
			);
		}

		/**
		 * Helper method to recurse through an array of ministries for LoadOrderedArrayForMinistry
		 * @param Group[] $objGroupArray
		 * @param integer $intParentGroupId
		 * @return Group[]
		 */
		protected static function LoadOrderedArrayForMinistryHelper($objGroupArray, $intParentGroupId) {
			$arrToReturn = array();
			foreach ($objGroupArray as $objGroup) {
				if (($objGroup->ParentGroupId == $intParentGroupId) ||
					(is_null($objGroup->ParentGroupId) && is_null($intParentGroupId))) {
					$arrToReturn[] = $objGroup;
					$arrToReturn = array_merge($arrToReturn, self::LoadOrderedArrayForMinistryHelper($objGroupArray, $objGroup->Id));
				}
			}

			return $arrToReturn;
		}

		/**
		 * Refreshes all the groups within a ministry with the correct HierarchOrderNumber
		 * @param integer $intMinistryId
		 * @return void
		 */
		public static function RefreshHierarchyDataForMinistry($intMinistryId) {
			$intOrderNumber = 1;
			foreach (Group::LoadOrderedArrayForMinistry($intMinistryId) as $objGroup) {
				$objGroup->HierarchyOrderNumber = $intOrderNumber;
				$objGroup->RefreshHierarchyLevel();
				$intOrderNumber++;
			}
		}

		/**
		 * Refreshes the hierarchy "Level" of this object based on where it is in the hierarchy.
		 * 
		 * Top-level groups for a ministry have a level of "0".
		 * 
		 * @param boolean $blnSaveFlag
		 * @return integer
		 */
		protected function RefreshHierarchyLevel($blnSaveFlag = true) {
			$intLevel = 0;
			$objGroup = $this;

			while ($objParentGroup = $objGroup->ParentGroup) {
				$intLevel++;
				$objGroup = $objParentGroup;
			}

			$this->intHierarchyLevel = $intLevel;
			if ($blnSaveFlag) $this->Save();

			return $intLevel;
		}

		/**
		 * Quick check to see if "Anyone" can send an email through this list.  This
		 * only works of this has a broadcast type of PublicList.
		 * @return boolean
		 */
		public function IsAnyoneCanSendEmail() {
			return $this->intEmailBroadcastTypeId == EmailBroadcastType::PublicList;
		}

		/**
		 * Calculates whether or not a given Login object is allowed to send emails
		 * to this Group email list.  Return true if the Login can.  Returns false
		 * if the Login is not allowed to OR if there is no Email List for this Group.
		 * @param Login $objLogin
		 * @return boolean
		 */
		public function IsLoginCanSendEmail(Login $objLogin) {
			switch ($this->intEmailBroadcastTypeId) {
				case EmailBroadcastType::PublicList:
					return true;

				case EmailBroadcastType::PrivateList:
					return $this->IsLoginCanEdit($objLogin);

				case EmailBroadcastType::AnnouncementOnly:
					return $this->IsLoginCanEdit($objLogin);

				default:
					return false;
			}
		}

		/**
		 * Calculates whether or not a given Person object is allowed to send emails
		 * to this Group email list.  Return true if the Person can.  Returns false
		 * if the Person is not allowed to OR if there is no Email List for this Group.
		 * @param Person $objPerson
		 * @return boolean
		 */
		public function IsPersonCanSendEmail(Person $objPerson) {
			switch ($this->intEmailBroadcastTypeId) {
				case EmailBroadcastType::PublicList:
					return true;

				case EmailBroadcastType::PrivateList:
					foreach (GroupParticipation::LoadArrayByPersonIdGroupId($objPerson->Id, $this->intId) as $objParticipation) {
						if (!$objParticipation->DateEnd || $objParticipation->DateEnd->IsLaterThan(QDateTime::Now()))
							return true;
					}
					return false;

				case EmailBroadcastType::AnnouncementOnly:	
					$objLogin = Login::LoadByEmail($objPerson->PrimaryEmail->Address);	
					if($objLogin) {
						if($objLogin->IsMinistryAssociated($this->Ministry))
							return true;
						else		
							return false;
					}
					return false;

				default:
					return false;
			}
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of Group objects
			return Group::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::Group()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Group()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single Group object
			return Group::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Group()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Group()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of Group objects
			return Group::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::Group()->Param1, $strParam1),
					QQ::Equal(QQN::Group()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = Group::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`group`.*
				FROM
					`group` AS `group`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return Group::InstantiateDbResult($objDbResult);
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