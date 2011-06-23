<?php require(__INCLUDES__ . '/header_my.inc.php'); ?>

	<h1><?php _p($this->objSignupForm->Name); ?></h1>
	<h2>Event Signup</h2>
	Please fill out the following form to sign up for <strong><?php _p($this->objSignupForm->Name); ?></strong><?php _p($this->objEvent->GeneratedDescription); ?>.
	<br/>
	(*) Fields in <strong>BOLD</strong> are required.
	<br/>
	<br/>

	<div class="section">
	<?php
		// First check for HtmlAfter chains
		foreach ($this->objFormQuestionControlArray as $objControl) {
				if (substr($objControl->ActionParameter, 0, 1) == '_') {
					$strParentControlId = substr($objControl->ActionParameter, 1);
					$objParentControl = $this->GetControl($strParentControlId);
					$strRenderMethod = $objControl->RenderMethod;
					
					$objParentControl->HtmlAfter .= ' ' . $objControl->$strRenderMethod(false);
				}
		}
	
		// Now, render each item outside of an HtmlAfter chain
		foreach ($this->objFormQuestionControlArray as $objControl) {
				if (substr($objControl->ActionParameter, 0, 1) != '_') {
					$strRenderMethod = $objControl->RenderMethod;
					$objControl->$strRenderMethod();
				}
		}
	?>
	</div>

<?php require(__INCLUDES__ . '/footer_my.inc.php'); ?>