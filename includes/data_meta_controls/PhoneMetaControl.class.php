<?php
	require(__DATAGEN_META_CONTROLS__ . '/PhoneMetaControlGen.class.php');

	/**
	 * This is a MetaControl customizable subclass, providing a QForm or QPanel access to event handlers
	 * and QControls to perform the Create, Edit, and Delete functionality of the
	 * Phone class.  This code-generated class extends from
	 * the generated MetaControl class, which contains all the basic elements to help a QPanel or QForm
	 * display an HTML form that can manipulate a single Phone object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QForm or QPanel which instantiates a PhoneMetaControl
	 * class.
	 *
	 * This file is intended to be modified.  Subsequent code regenerations will NOT modify
	 * or overwrite this file.
	 * 
	 * @package ALCF ChMS
	 * @subpackage MetaControls
	 */
	class PhoneMetaControl extends PhoneMetaControlGen {
		/**
		 * Create and setup QTextBox txtNumber
		 * @param string $strControlId optional ControlId to use
		 * @return QTextBox
		 */
		public function txtNumber_Create($strControlId = null) {
			$this->txtNumber = new PhoneTextBox($this->objParentObject, $strControlId);
			$this->txtNumber->Name = QApplication::Translate('Number');
			$this->txtNumber->Text = $this->objPhone->Number;
			$this->txtNumber->MaxLength = Phone::NumberMaxLength;
			return $this->txtNumber;
		}
	}
?>