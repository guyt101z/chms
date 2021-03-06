<?php require(__INCLUDES__ . '/header.inc.php'); ?>

	<h1>Search Households</h1>
	
	<h3>Filter Results</h3>
	<div class="section">
		<div class="filterBy filterByFirst">First Name<br/><?php $this->txtFirstName->Render(); ?></div>
		<div class="filterBy">Last Name<br/><?php $this->txtLastName->Render(); ?></div>
		<div class="filterBy">Phone<br/><?php $this->txtPhone->Render(); ?></div>
		<div class="filterBy">City<br/><?php $this->txtCity->Render(); ?></div>
		<div class="cleaner">&nbsp;</div>
	</div>

	<div class="section"><?php $this->dtgHouseholds->Render(); ?></div>

<?php require(__INCLUDES__ . '/footer.inc.php'); ?>