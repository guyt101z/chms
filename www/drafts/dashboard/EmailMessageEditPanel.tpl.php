<?php
	// This is the HTML template include file (.tpl.php) for email_messageEditPanel.
	// Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the drafts/dashboard subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
	<div id="formControls">
		<?php $_CONTROL->lblId->RenderWithName(); ?>

		<?php $_CONTROL->lstEmailMessageStatusType->RenderWithName(); ?>

		<?php $_CONTROL->calDateReceived->RenderWithName(); ?>

		<?php $_CONTROL->txtRawMessage->RenderWithName(); ?>

		<?php $_CONTROL->txtMessageIdentifier->RenderWithName(); ?>

		<?php $_CONTROL->txtSubject->RenderWithName(); ?>

		<?php $_CONTROL->txtFromAddress->RenderWithName(); ?>

		<?php $_CONTROL->txtResponseHeader->RenderWithName(); ?>

		<?php $_CONTROL->txtResponseBody->RenderWithName(); ?>

		<?php $_CONTROL->txtErrorMessage->RenderWithName(); ?>

	</div>

	<div id="formActions">
		<div id="save"><?php $_CONTROL->btnSave->Render(); ?></div>
		<div id="cancel"><?php $_CONTROL->btnCancel->Render(); ?></div>
		<div id="delete"><?php $_CONTROL->btnDelete->Render(); ?></div>
	</div>
