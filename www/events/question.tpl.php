<?php require(__INCLUDES__ . '/header.inc.php'); ?>

	<h1><?php _p($this->objSignupForm->Type . ' Signup Form: ' . $this->objSignupForm->Name); ?></h1>
	<?php $this->lblHeading->Render('TagName=h3')?>

	<div class="section">
		<?php $this->lblFormQuestionType->RenderWithName(); ?>
		<?php $this->txtShortDescription->RenderWithName(); ?>
		<?php $this->chkInternalFlag->RenderWithName(); ?>
		<br/>
		
		<?php $this->txtQuestion->RenderWithName(); ?>
		<?php $this->chkRequiredFlag->RenderWithName(); ?>

		<?php $this->txtOptions->RenderWithName(); ?>
		<?php $this->chkAllowOtherFlag->RenderWithName(); ?>
	</div>

	<div class="buttonBar">
		<?php $this->btnSave->Render(); ?>
		&nbsp; or &nbsp;
		<?php $this->btnCancel->Render(); ?>
		<?php if ($this->btnDelete) $this->btnDelete->Render(); ?>
	</div>
	<br clear="all"/>

<?php require(__INCLUDES__ . '/footer.inc.php'); ?>