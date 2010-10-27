<?php
	/**
	 * The QueryDataType class defined here contains
	 * code for the QueryDataType enumerated type.  It represents
	 * the enumerated values found in the "query_data_type" table
	 * in the database.
	 * 
	 * To use, you should use the QueryDataType subclass which
	 * extends this QueryDataTypeGen class.
	 * 
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the QueryDataType class.
	 * 
	 * @package ALCF ChMS
	 * @subpackage GeneratedDataObjects
	 */
	abstract class QueryDataTypeGen extends QBaseClass {
		const StringValue = 1;
		const IntegerValue = 2;
		const DateValue = 4;
		const TypeValue = 8;
		const BooleanValue = 16;
		const CustomValue = 32;

		const MaxId = 32;

		public static $NameArray = array(
			1 => 'String Value',
			2 => 'Integer Value',
			4 => 'Date Value',
			8 => 'Type Value',
			16 => 'Boolean Value',
			32 => 'Custom Value');

		public static $TokenArray = array(
			1 => 'StringValue',
			2 => 'IntegerValue',
			4 => 'DateValue',
			8 => 'TypeValue',
			16 => 'BooleanValue',
			32 => 'CustomValue');

		public static function ToString($intQueryDataTypeId) {
			switch ($intQueryDataTypeId) {
				case 1: return 'String Value';
				case 2: return 'Integer Value';
				case 4: return 'Date Value';
				case 8: return 'Type Value';
				case 16: return 'Boolean Value';
				case 32: return 'Custom Value';
				default:
					throw new QCallerException(sprintf('Invalid intQueryDataTypeId: %s', $intQueryDataTypeId));
			}
		}

		public static function ToToken($intQueryDataTypeId) {
			switch ($intQueryDataTypeId) {
				case 1: return 'StringValue';
				case 2: return 'IntegerValue';
				case 4: return 'DateValue';
				case 8: return 'TypeValue';
				case 16: return 'BooleanValue';
				case 32: return 'CustomValue';
				default:
					throw new QCallerException(sprintf('Invalid intQueryDataTypeId: %s', $intQueryDataTypeId));
			}
		}

	}
?>