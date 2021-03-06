<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NOAH<?php _p($this->strPageTitle ? ' - ' . $this->strPageTitle : null); ?></title>
<style type="text/css">@import url("<?php _p(__CSS_ASSETS__); ?>/chms.css");</style>
<style type="text/css">@import url("<?php _p(__CSS_ASSETS__); ?>/jquery-ui-1.8.19.custom.css");</style>
<?php if (SERVER_INSTANCE != 'prod') { ?>
<style type="text/css">
	div.contentBackground { background: url(/assets/images/main_content_background_<?php _p(SERVER_INSTANCE); ?>.png); }
</style>
<?php } ?>
<script type="text/javascript" src="<?php _p(__JS_ASSETS__); ?>/chms.js"></script>
<script type="text/javascript" src="<?php _p(__JS_ASSETS__); ?>/_core/_qc_packed.js"></script>
<script type="text/javascript" src="<?php _p(__JS_ASSETS__); ?>/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php _p(__JS_ASSETS__); ?>/jquery-ui-1.8.19.custom.min.js"></script>
<script type="text/javascript" src="<?php _p(__JS_ASSETS__); ?>/amcharts/amcharts.js"></script>
<script type="text/javascript" src="<?php _p(__JS_ASSETS__); ?>/amcharts/serial.js"></script>
<script type="text/javascript" src="<?php _p(__JS_ASSETS__); ?>/amcharts/pie.js"></script>
</head><body>
<?php $this->RenderBegin(); ?>

<div class="headerBackground">
<div class="left">&nbsp;</div>
</div>

<div class="header" title="ALCF ChMS" onclick="document.location='/';">
<?php if (SERVER_INSTANCE != 'prod') { ?>
	<div class="serverInstance">Not on Production &mdash; <?php _p(ucwords(SERVER_INSTANCE)); ?> Server</div>
<?php } ?>
<?php if (QApplication::$Login) { ?>
	<div class="status">
		Welcome, <strong><?php _p(QApplication::$Login->Name); ?></strong>
		&nbsp;|&nbsp;
		<?php _p(QDateTime::Now()->ToString('DDDD, MMMM D, YYYY')); ?>
		&nbsp;|&nbsp;
		<a href="/logout/" title="Log Out of ALCF ChMS">Logout</a>
		<br/>
		<span class="subhead">You are logged in as a <strong><?php _p(QApplication::$Login->Type); ?></strong></span><br/>
	</div>
<?php } ?>
</div>

<?php if (QApplication::$Login) { ?>
	<div class="navbar"><ul class="navbar">
<?php
		$intWidth = floor(980 / count(ChmsForm::$NavSectionArray));
		foreach (ChmsForm::$NavSectionArray as $intNavSectionId => $strNavSectionArray) {
			$strClassInfo = ($intNavSectionId == $this->intNavSectionId) ? 'class="selected"' : null;
			printf('<li style="width: %spx;"><a href="%s" %s title="%s">%s</a></li>',
				$intWidth, $strNavSectionArray[1], $strClassInfo, $strNavSectionArray[0], $strNavSectionArray[0]
			);
		}
?>
	</ul></div>
<?php } ?>

<div class="contentBackground"><div class="content">