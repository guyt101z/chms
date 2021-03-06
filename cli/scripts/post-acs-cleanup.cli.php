<?php
	$objPersonCursor = Person::QueryCursor(QQ::All());
	QDataGen::DisplayForEachTaskStart('Refreshing Person data', Person::CountAll());
	while ($objPerson = Person::InstantiateCursor($objPersonCursor)) {
		QDataGen::DisplayForEachTaskNext('Refreshing Person data');
		$objPerson->RefreshAge(false);
		$objPerson->RefreshMaritalStatusTypeId(false);
		$objPerson->RefreshMembershipStatusTypeId(false);
		$objPerson->RefreshPrimaryContactInfo(true);
		$objPerson->RefreshNameItemAssociations();
	}
	QDataGen::DisplayForEachTaskEnd('Refreshing Person data');

	$objHouseholdCursor = Household::QueryCursor(QQ::All());
	QDataGen::DisplayForEachTaskStart('Refreshing Household data', Household::CountAll());
	while ($objHousehold = Household::InstantiateCursor($objHouseholdCursor)) {
		QDataGen::DisplayForEachTaskNext('Refreshing Household data');
		$objHousehold->RefreshMembers(false);

		$objMarriedPersonArray = array();
		foreach ($objHousehold->GetHouseholdParticipationArray() as $objParticipation) {
			if (($objParticipation->Person->MaritalStatusTypeId == MaritalStatusType::Married) &&
				($objParticipation->Person->CountMarriages() == 1))
				$objMarriedPersonArray[] = $objParticipation->Person;
		}

		if (count($objMarriedPersonArray) == 2) {
			$objMarriedPersonArray[0]->DeleteAllMarriages();
			$objMarriedPersonArray[1]->DeleteAllMarriages();
			$objMarriedPersonArray[0]->CreateMarriageWith($objMarriedPersonArray[1]);
		} else if (count($objMarriedPersonArray)) {
			print "\r\nWhat!?  Household " . $objHousehold->Id . " has a marriage count of " . count($objMarriedPersonArray) . "!\r\n";
		}

		$objHousehold->Save();
	}
	QDataGen::DisplayForEachTaskEnd('Refreshing Household data');

	$objStewardshipCursor = StewardshipContribution::QueryCursor(QQ::All());
	QDataGEn::DisplayForEachTaskStart('Refreshing Contributions', StewardshipContribution::CountAll());
	while ($objContribution = StewardshipContribution::InstantiateCursor($objStewardshipCursor)) {
		QDataGen::DisplayForEachTaskNext('Refreshing Contributions');
		$objContribution->RefreshTotalAmount();
	}
	QDataGen::DisplayForEachTaskEnd('Refreshing Contributions');

	$objStewardshipCursor = StewardshipStack::QueryCursor(QQ::All());
	QDataGEn::DisplayForEachTaskStart('Refreshing Stacks', StewardshipStack::CountAll());
	while ($objStack = StewardshipStack::InstantiateCursor($objStewardshipCursor)) {
		QDataGen::DisplayForEachTaskNext('Refreshing Stacks');
		$objStack->RefreshActualTotalAmount();
	}
	QDataGen::DisplayForEachTaskEnd('Refreshing Stacks');

	$objStewardshipCursor = StewardshipBatch::QueryCursor(QQ::All());
	QDataGEn::DisplayForEachTaskStart('Refreshing Batches', StewardshipBatch::CountAll());
	while ($objBatch = StewardshipBatch::InstantiateCursor($objStewardshipCursor)) {
		QDataGen::DisplayForEachTaskNext('Refreshing Batches');
		$objBatch->PostBalance(Login::Load(1));
	}
	QDataGen::DisplayForEachTaskEnd('Refreshing Batches');

	$objStewardshipCursor = StewardshipPledge::QueryCursor(QQ::All());
	QDataGEn::DisplayForEachTaskStart('Refreshing Pledges', StewardshipPledge::CountAll());
	while ($objPledge = StewardshipPledge::InstantiateCursor($objStewardshipCursor)) {
		QDataGen::DisplayForEachTaskNext('Refreshing Pledges');
		$objPledge->Refresh();
	}
	QDataGen::DisplayForEachTaskEnd('Refreshing Pledges');
?>