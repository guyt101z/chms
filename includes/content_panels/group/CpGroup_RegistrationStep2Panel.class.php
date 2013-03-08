<?php
class CpGroup_RegistrationStep2Panel extends QPanel {
	protected $strTemplate;
	public $dtgGroups;
	public $btnAssign;
	public $objRegistrant;
	public $rbtnSelectArray;
	public $intPersonId;
	public $chkLocation;
	public $chkGroupType;
	public $chkDayOfWeek;
	public $chkAvailability;
	public $lblRegistrantInfo;
	public $intFacilitatorRoleId;
	protected $strMethodCallBack;
	
	public function __construct($objParentObject,$objRegistrant,$intPersonId, $strMethodCallBack, $strControlId = null) {
		// First, let's call the Parent's __constructor
		try {
			parent::__construct($objParentObject, $strControlId);
		} catch (QCallerException $objExc) {
			$objExc->IncrementOffset();
			throw $objExc;
		}
		$this->strTemplate = dirname(__FILE__) . '/' . get_class($this) . '.tpl.php';
			
		// Next, we set the local registrant object
		$this->objRegistrant = $objRegistrant;
		$this->intPersonId = $intPersonId;
		$this->strMethodCallBack = $strMethodCallBack;
		
		$strGroupTypes = '';
		foreach(GrowthGroupStructure::LoadAll() as $objGroupStructure) {
			if($this->objRegistrant->IsGrowthGroupStructureAsGroupstructureAssociated($objGroupStructure)) {
				$strGroupTypes .= $objGroupStructure->Name. ', ';
			}
		}
		$strGroupTypes = substr($strGroupTypes, 0, strlen($strGroupTypes)-1);
		$this->lblRegistrantInfo	= new QLabel($this);
		$this->lblRegistrantInfo->HtmlEntities = false;
		$this->lblRegistrantInfo->HtmlBefore = 'For: ';
		$this->lblRegistrantInfo->Text = sprintf('%s %s<br>Requested Group Types: %s<br>Requested Days: %s<br>Preferred Locations: %s, %s',
			$this->objRegistrant->FirstName, $this->objRegistrant->LastName,$strGroupTypes,
			$this->objRegistrant->GroupDay,$this->objRegistrant->PreferredLocation1,$this->objRegistrant->PreferredLocation2);
			
		$this->chkLocation = new QCheckBox($this);
		$this->chkLocation->Text = 'Location';
		$this->chkLocation->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'dtgGroups_Refresh'));
		$this->chkGroupType = new QCheckBox($this);
		$this->chkGroupType->Text = 'Group Type';
		$this->chkGroupType->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'dtgGroups_Refresh'));
		$this->chkDayOfWeek = new QCheckBox($this);
		$this->chkDayOfWeek->Text = 'Day Of Week';
		$this->chkDayOfWeek->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'dtgGroups_Refresh'));
		$this->chkAvailability= new QCheckBox($this);
		$this->chkAvailability->Text = 'Availability';
		$this->chkAvailability->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'dtgGroups_Refresh'));
			
		$this->rbtnSelectArray = array();
		
		
		// Now initialize the controls
		$this->dtgGroups = new GrowthGroupDataGrid($this);
		$this->dtgGroups->Paginator = new QPaginator($this->dtgGroups);
		$this->dtgGroups->AddColumn(new QDataGridColumn('', '<?= $_CONTROL->ParentControl->RenderSelectGroup($_ITEM); ?>', 'HtmlEntities=false'));				
		$this->dtgGroups->AddColumn(new QDataGridColumn('Name', '<?= $_CONTROL->ParentControl->RenderName($_ITEM); ?>', 'HtmlEntities=false'));
		$this->dtgGroups->AddColumn(new QDataGridColumn('Description', '<?= $_CONTROL->ParentControl->RenderDescription($_ITEM); ?>', 'HtmlEntities=false'));
		$this->dtgGroups->AddColumn(new QDataGridColumn('Group Type', '<?= $_CONTROL->ParentControl->RenderGroupStructure($_ITEM); ?>', 'HtmlEntities=false'));
		$this->dtgGroups->MetaAddTypeColumn('GrowthGroupDayTypeId', 'GrowthGroupDayType');
		$this->dtgGroups->AddColumn(new QDataGridColumn('Location Region', '<?= $_CONTROL->ParentControl->RenderLocationRegion($_ITEM); ?>', 'HtmlEntities=false'));
		$this->dtgGroups->AddColumn(new QDataGridColumn('Group Facilitator', '<?= $_CONTROL->ParentControl->RenderFacilitator($_ITEM); ?>', 'HtmlEntities=false'));
		
		$this->dtgGroups->NoDataHtml = 'No results found.  Please use a less-restrictive filter.';
		$this->dtgGroups->SetDataBinder('dtgGroups_Bind',$this);

		$this->btnAssign = new QButton($this);
		$this->btnAssign->Text = 'Assign '.$this->objRegistrant->FirstName.' '.$this->objRegistrant->LastName. ' to the selected groups';
		$this->btnAssign->CssClass = 'primary';
		$this->btnAssign->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnAssign_Click'));
		
		$this->intFacilitatorRoleId = 0;
		foreach(GroupRole::LoadAll() as $objGroupRole) {
			if(($objGroupRole->Name == 'Facilitator')&&
			($objGroupRole->MinistryId == Ministry::LoadByToken('growth')->Id)) {
				$this->intFacilitatorRoleId = $objGroupRole->Id;
			}
		}
	}
	
	public function dtgGroups_Refresh() {
		//$this->dtgGroups->RemoveChildControls(true);
		//$this->rbtnSelectArray = array(); // clear the array to be sure.
		$this->dtgGroups->PageNumber = 1;
		$this->dtgGroups->Refresh();
	}
		
	public function RenderSelectGroup(GrowthGroup $objGrowthGroup) {
		$strControlId = 'SelectGrpBtn'.$objGrowthGroup->GroupId;
		$rbtnSelected = $this->objForm->GetControl($strControlId);
		if(!$rbtnSelected) {
			$rbtnSelected = new QCheckBox($this->dtgGroups,$strControlId);
			$rbtnSelected->Text = '';
			$rbtnSelected->ActionParameter = $objGrowthGroup->GroupId;
			$rbtnSelected->Checked = false;
			$this->rbtnSelectArray[] = $rbtnSelected;
		}
		return $rbtnSelected->Render(false);
		
	}
	public function RenderName(GrowthGroup $objGrowthGroup) {
		$objGroup = Group::Load($objGrowthGroup->GroupId);
		return $objGroup->Name;
	}
	public function RenderDescription(GrowthGroup $objGrowthGroup) {
		$objGroup = Group::Load($objGrowthGroup->GroupId);
		return $objGroup->Description;
	}
	public function RenderGroupStructure(GrowthGroup $objGrowthGroup) {
		$strReturn = '';
		foreach(GrowthGroupStructure::LoadAll() as $objGroupStructure) {
			if($objGrowthGroup->IsGrowthGroupStructureAssociated($objGroupStructure)) {
				$strReturn .= $objGroupStructure->Name . ',';
			}
		}
		$strReturn = substr($strReturn ,0 ,strlen($strReturn)-1 );
		return $strReturn;
	}
	public function RenderLocationRegion(GrowthGroup $objGrowthGroup) {
		return GrowthGroupLocation::Load($objGrowthGroup->GrowthGroupLocationId)->Location;
	}
	public function RenderFacilitator(GrowthGroup $objGrowthGroup) {
		$strReturn = '';
		$objGroupParticipants = GroupParticipation::LoadArrayByGroupId($objGrowthGroup->GroupId);
		foreach($objGroupParticipants as $objParticipant) {
			if($objParticipant->GroupRoleId == $this->intFacilitatorRoleId) {
				$objPerson = Person::Load($objParticipant->PersonId);
				$strReturn = sprintf('%s %s',$objPerson->FirstName, $objPerson->LastName );
			}			
		}
		return $strReturn;
	}
	
	public function btnAssign_Click($strFormId, $strControlId, $strParameter) {
		$objPerson = Person::Load($this->intPersonId);
		$intRoleId = $this->objRegistrant->GroupRoleId;
		 			
		foreach($this->rbtnSelectArray as $rbtnSelect) {
			if($rbtnSelect->Checked) {
				$objGroup = Group::Load($rbtnSelect->ActionParameter);	
							
				// Validate the Dates
				$dttDateArray = GroupParticipation::GetParticipationDatesArrayForPersonIdGroupIdGroupRoleId($objPerson->Id, $objGroup->Id, $intRoleId);
				
				// Add This Date
				$dtDateStart= new QDateTime(QDateTime::Now);
				$dttDateArray[] = array($dtDateStart, null);
										
				// Go ahead and create the record
				$objGroup->AddPerson($objPerson, $intRoleId, $dtDateStart, null);				
			}
			
		}
		$this->objRegistrant->ProcessedFlag = true;
		$this->objRegistrant->Save();
		
		// GJS: Send email to both Person and facilitator. CC Andrea
		$this->SendMessage();
		
		// Hide panels and refresh the participants page
		// by calling the Form's Method CallBack, passing in "true" to state that we've made an update
        $strMethodCallBack = $this->strMethodCallBack;
        $this->objForm->$strMethodCallBack(true);
	}
	
	public function SendMessage() {
		$facilitatorList = array();
		$groupInfo = array();
		// Get information for each selected group
		foreach($this->rbtnSelectArray as $rbtnSelect) {
			if($rbtnSelect->Checked) {
				$objGroup = Group::Load($rbtnSelect->ActionParameter);
				$objGroupParticipants = GroupParticipation::LoadArrayByGroupId($objGroup->Id);
				foreach($objGroupParticipants as $objParticipant) {
					if($objParticipant->GroupRoleId == $this->intFacilitatorRoleId) {
						$objPerson = Person::Load($objParticipant->PersonId);
						$facilitatorList[] = $objPerson;
					}
				}
				$ggGroup = GrowthGroup::Load($rbtnSelect->ActionParameter);				
				$groupInfo[] = array($ggGroup->GrowthGroupLocation->Location,
					GrowthGroupDayType::ToString($ggGroup->GrowthGroupDayTypeId),
					$ggGroup->StartTime);
			}
		}
		
		// Set debug mode
		//QEmailServer::$TestMode = true;
		//QEmailServer::$TestModeDirectory = __DOCROOT__ . '/../file_assets/emails';
		
		QEmailServer::$SmtpServer = SMTP_SERVER;
		
		// Create a new message
		// Note that you can list multiple addresses and that Qcodo supports Bcc and Cc
		$objMessage = new QEmailMessage();
		$objMessage->From = 'Andrea Alo <andrea.alo@alcf.net>';
		$objMessage->To = $this->objRegistrant->Email;
		$objMessage->Bcc = 'andrea.alo@alcf.net';
		$objMessage->Subject = 'Invitation to Growth Groups';
		
		// Setup Plaintext Message
		$strBody = "Dear ".$this->objRegistrant->FirstName .",\r\n\r\n";
		$strBody .= "Thank you so much for your patience! Below is the information on two Growth Groups in your area. Please contact the facilitators below for more information about visiting. I've copied them on this e-mail so that they will know of your interest.";
		$strBody .= sprintf("%s %s\r\n%s\r\n%s\r\n",$this->objRegistrant->FirstName, $this->objRegistrant->LastName,
			$this->objRegistrant->Phone, $this->objRegistrant->Email);
		
		if(count($groupInfo) >= 1) {
			$strBody .= sprintf("%s, %s, %s\r\nFacilitator: %s %s\r\n%s\r\n", $groupInfo[0][0],
				$groupInfo[0][1], $groupInfo[0][2], $facilitatorList[0]->FirstName, $facilitatorList[0]->LastName,
				Email::Load($facilitatorList[0]->PrimaryEmailId)->Address);
				$objMessage->Cc = Email::Load($facilitatorList[0]->PrimaryEmailId)->Address;
		}
		if(count($groupInfo) >= 2) {
			$strBody .= sprintf("%s, %s, %s\r\nFacilitator: %s %s\r\n%s\r\n", $groupInfo[1][0],
			$groupInfo[1][1], $groupInfo[1][2], $facilitatorList[1]->FirstName, $facilitatorList[1]->LastName,
			Email::Load($facilitatorList[1]->PrimaryEmailId)->Address);
			$objMessage->Cc .= ', '.Email::Load($facilitatorList[1]->PrimaryEmailId)->Address;
		}
		$strBody .= 'Regards, \r\nAndrea Alo';
		$objMessage->Body = $strBody;
		
		// Also setup HTML message (optional)
		$strBody = "Dear ".$this->objRegistrant->FirstName .',<br/><br/>';
		$strBody .= "Thank you so much for your patience! Below is the information on two Growth Groups
in your area. <br>Please contact the facilitators below for more information about visiting. I have copied them on this e-mail so that they will know of your interest.<br><br>";
		
		$strBody .= sprintf("%s %s<br>%s<br>%s<br>",$this->objRegistrant->FirstName, $this->objRegistrant->LastName,
		$this->objRegistrant->Phone, $this->objRegistrant->Email);
		
		if(count($groupInfo) >= 1) {
			$strBody .= sprintf("%s, %s, %s\<br>Facilitator: %s %s<br>%s<br>", $groupInfo[0][0],
			$groupInfo[0][1], $groupInfo[0][2], $facilitatorList[0]->FirstName, $facilitatorList[0]->LastName,
			Email::Load($facilitatorList[0]->PrimaryEmailId)->Address);
		}
		if(count($groupInfo) >= 2) {
			$strBody .= sprintf("%s, %s, %s<br><b>Facilitator:</b> %s %s<br>%s<br>", $groupInfo[1][0],
			$groupInfo[1][1], $groupInfo[1][2], $facilitatorList[1]->FirstName, $facilitatorList[1]->LastName,
			Email::Load($facilitatorList[1]->PrimaryEmailId)->Address);
		}
		$strBody .= 'Regards,<br/><b>Andrea Alo</b>';
		$objMessage->HtmlBody = $strBody;
		
		// Add random/custom email headers
		$objMessage->SetHeader('x-application', 'Growth Groups Ministry');	
		QEmailServer::Send($objMessage);
	}
	public function dtgGroups_Bind() {
		$objConditions = QQ::All();
		$objClauses = array();
			
		$objConditions = QQ::AndCondition($objConditions, QQ::Equal(QQN::GrowthGroup()->Group->ActiveFlag, true));
		
		if ($this->chkDayOfWeek->Checked) {
			// Map to Days of Week
			$dayArray = array();
			foreach(GrowthGroupDayType::$NameArray as $key=>$value) {
				if(strpos(strtolower($this->objRegistrant->GroupDay) ,strtolower($value)) !== false){
					$dayArray[] = $key;
				}
			}
			$objConditions = QQ::AndCondition($objConditions,			
				QQ::In((QQN::GrowthGroup()->GrowthGroupDayTypeId),$dayArray)
			);
		}
		$growthGroupArray = GrowthGroup::QueryArray($objConditions);
		
		if ($this->chkGroupType->Checked) {
			$requestedGroupStructureArray = array();
			foreach(GrowthGroupStructure::LoadAll() as $objGroupStructure) {
				if($this->objRegistrant->IsGrowthGroupStructureAsGroupstructureAssociated($objGroupStructure)) {
					$requestedGroupStructureArray[] = $objGroupStructure;
				}
			}
			
			$newGrowthGroupArray = array();
			foreach($growthGroupArray as $objGroup) {
				foreach($requestedGroupStructureArray as $objGroupStructure){
					if ($objGroup->IsGrowthGroupStructureAssociated($objGroupStructure)) {
						$newGrowthGroupArray[] = $objGroup;
						break;
					}
				}
			}
			$growthGroupArray = $newGrowthGroupArray;
			
		}

		if ($this->chkAvailability->Checked) {
			$newGrowthGroupArray = array();
			$intClosed = 0;
			foreach(AvailabilityStatus::LoadAll() as $objStatus){
				if($objStatus->Name == 'Closed') {
					$intClosed = $objStatus->Id;
				}
			}	
			foreach($growthGroupArray as $objGroup) {
				$intStatus = Group::Load($objGroup->GroupId)->Status;
				if($intStatus != $intClosed) {
					$newGrowthGroupArray[] = $objGroup;
				}
			}
			$growthGroupArray = $newGrowthGroupArray;
		}
		
		if ($this->chkLocation->Checked) {
			// Map to our existing Growth Group Locations
			$locationIdArray = array();
			$strLocationArray = array($this->objRegistrant->PreferredLocation1,$this->objRegistrant->PreferredLocation2);
			for($i=0; $i<2; $i++) {
				switch($strLocationArray[$i]) {
					case 'Foster City':
					case 'San Bruno':
					case 'San Carlos':
					case 'San Mateo':
					case 'San Francisco':
					case 'South San Francisco':
						$locationIdArray[] = 1;
						break;								
					
					case 'East Palo Alto':
					case 'Mountain View':
					case 'Menlo Park':
					case 'Palo Alto':
					case 'Redwood City':
						$locationIdArray[] = 2;
						break;
						
					case 'Campbell':
					case 'Cupertino':
					case 'Los Altos':
					case 'Sunnyvale':
						$locationIdArray[] = 3;
						break;
	
					case 'San Jose':
					case 'South San Jose':
					case 'Santa Clara':
						$locationIdArray[] = 4;
						break;
						
					case 'Fremont':
					case 'Milpitas':
					case 'Newark ':
					case 'Pleasanton':
					case 'Tracy':
						$locationIdArray[] = 5;
						break;																
										
					case 'Oakland':
					case 'Clayton':
						$locationIdArray[] = 6;
						break;	
				}
			}
			$newGrowthGroupArray = array();
			foreach($growthGroupArray as $objGroup) {			
				if (($objGroup->GrowthGroupLocationId == $locationIdArray[0]) || 
					 ($objGroup->GrowthGroupLocationId == $locationIdArray[1])) {
					$newGrowthGroupArray[] = $objGroup;
				}
			}
			$growthGroupArray = $newGrowthGroupArray;
		}
		$this->dtgGroups->DataSource = $growthGroupArray;
		
	}
	
}