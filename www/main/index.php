<?php
	require(dirname(__FILE__) . '/../../includes/prepend.inc.php');
	QApplication::Authenticate();

	class MainForm extends ChmsForm {
		protected $strPageTitle = 'Main Menu';
		protected $intNavSectionId = null;

		protected $lblMessage;
		protected $btnButton;

		protected function Form_Create() {
			$this->lblMessage = new QLabel($this);
			$this->lblMessage->Text = 'Click the button to change my message.';

			$this->btnButton = new QButton($this);
			$this->btnButton->Text = 'Click Me';
			$this->btnButton->AddAction(new QClickEvent(), new QAjaxAction('btnButton_Click'));
		}

		protected function btnButton_Click($strFormId, $strControlId, $strParameter) {
			$this->lblMessage->Text = 'Hello, World!';
		}
	}

	MainForm::Run('MainForm');
?>