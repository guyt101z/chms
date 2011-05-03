<?php
	/**
	 * The SignupEntryStatusType class defined here contains
	 * code for the SignupEntryStatusType enumerated type.  It represents
	 * the enumerated values found in the "signup_entry_status_type" table
	 * in the database.
	 * 
	 * To use, you should use the SignupEntryStatusType subclass which
	 * extends this SignupEntryStatusTypeGen class.
	 * 
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the SignupEntryStatusType class.
	 * 
	 * @package ALCF ChMS
	 * @subpackage GeneratedDataObjects
	 */
	abstract class SignupEntryStatusTypeGen extends QBaseClass {
		const Incomplete = 1;
		const Test = 2;
		const Complete = 3;

		const MaxId = 3;

		public static $NameArray = array(
			1 => 'Incomplete',
			2 => 'Test',
			3 => 'Complete');

		public static $TokenArray = array(
			1 => 'Incomplete',
			2 => 'Test',
			3 => 'Complete');

		public static function ToString($intSignupEntryStatusTypeId) {
			switch ($intSignupEntryStatusTypeId) {
				case 1: return 'Incomplete';
				case 2: return 'Test';
				case 3: return 'Complete';
				default:
					throw new QCallerException(sprintf('Invalid intSignupEntryStatusTypeId: %s', $intSignupEntryStatusTypeId));
			}
		}

		public static function ToToken($intSignupEntryStatusTypeId) {
			switch ($intSignupEntryStatusTypeId) {
				case 1: return 'Incomplete';
				case 2: return 'Test';
				case 3: return 'Complete';
				default:
					throw new QCallerException(sprintf('Invalid intSignupEntryStatusTypeId: %s', $intSignupEntryStatusTypeId));
			}
		}

	}
?>