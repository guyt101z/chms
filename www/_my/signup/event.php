<?php
	require(dirname(__FILE__) . '/../../../includes/prepend.inc.php');
	QApplication::AuthenticatePublic();
	require(dirname(__FILE__) . '/SignupQForm.class.php');

	class EventSignupQForm extends SignupQForm {
		/**
		 * @var EventSignupForm
		 */
		protected $objEvent;

		protected function Form_Create() {
			try {
				parent::Form_Create();
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// If we are in an "error condition" then return
			if ($this->blnFormErrorFlag) return;

			// Ensure it is the correct type and it exists
			if (!($this->objEvent = $this->objSignupForm->EventSignupForm)) {
				$this->strHtmlIncludeFilePath = '_notfound.tpl.php';
				return;
			}

			$this->CreateFormItemControls();
		}
	}

	EventSignupQForm::Run('EventSignupQForm');
?>