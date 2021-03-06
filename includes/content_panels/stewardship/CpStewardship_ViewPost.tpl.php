<?php if ($_CONTROL->objPost) { ?>
	<h1><?php printf('Post #%s :: %s<br/><span style="font-size: 10px; font-weight: normal; font-style: italic; color: #666;">Posted on %s by %s</span>',
		$_CONTROL->objPost->PostNumber, QApplication::DisplayCurrency($_CONTROL->objPost->TotalAmount), $_CONTROL->objPost->DatePosted->ToString('MMMM D, YYYY'), $_CONTROL->objPost->CreatedByLogin->Name); ?>
		<button class="primary" onclick="document.location='#/post_batch'; return false;">Back</button></h1>
<?php } else if ($this->objBatch->StewardshipBatchStatusTypeId == StewardshipBatchStatusType::NewBatch) { ?>
	<h1>Unposted Funds
		<button class="primary" onclick="document.location='#1'; return false;">Back</button></h1>
<?php } else { ?>
	<h1>Unposted Funds
		<button class="primary" onclick="document.location='#/post_batch'; return false;">Back</button></h1>
<?php }?>

<h3>Overview
<?php if ($_CONTROL->objPost) { ?>
	&nbsp;&nbsp;&nbsp;
	<span class="subhead"><a target="_blank" href="/stewardship/print_report.php/funds/<?php _p($_CONTROL->objBatch->Id); ?>/<?php _p($_CONTROL->objPost->PostNumber); ?>"/>Print</a></span>
<?php } ?>
</h3>
<div class="section"><?php $_CONTROL->dtgFunds->Render(); ?></div>

<h3><?php _p($_CONTROL->objPost ? 'Details of Changes' : 'Details of Unposted Contributions')?>
<?php if ($_CONTROL->objPost) { ?>
	&nbsp;&nbsp;&nbsp;
	<span class="subhead"><a target="_blank" href="/stewardship/print_report.php/line_items/<?php _p($_CONTROL->objBatch->Id); ?>/<?php _p($_CONTROL->objPost->PostNumber); ?>"/>Print</a></span>
<?php } ?>
</h3>
<div class="section" style="max-height: 260px; overflow: auto; "><?php $_CONTROL->dtgLineItems->Render(); ?></div>

<?php $_CONTROL->btnSave->RenderInSection('ActionParameter=buttonBar'); ?>