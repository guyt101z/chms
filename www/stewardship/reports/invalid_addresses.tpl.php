<?php require(__INCLUDES__ . '/header.inc.php'); ?>
	<h1>Stewardship Report - Invalid Stewardship Addresses</h1>
	<h3>For Stewardship Transactions in <?php _p(QApplication::PathInfo(0)); ?></h3>

	<div class="section">
		<?php $this->dtgItems->Render(); ?>
	</div>

<?php require(__INCLUDES__ . '/footer.inc.php'); ?>