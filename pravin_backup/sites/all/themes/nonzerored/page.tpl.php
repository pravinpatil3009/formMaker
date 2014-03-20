<?php
// $Id: page.tpl.php,v 1.1 2009/03/02 08:20:32 drupalexpertamit Exp $
// Drupal themes designed by DrupalThemeBank.com.
// Created Feb 13, 2009, Last Updated: Feb 16, 2009
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<head>
 <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyle Content in IE */ ?> </script>

<link rel="stylesheet" type="text/css" title="Red" href="style.css" />
<script src="styleswitch.js" type="text/javascript">
</script>
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="<?php print base_path() . path_to_theme() ?>/fix-ie.css" />
      <![endif]-->
</head>
<body>

<div id="header">

	<div id="header_inner" class="fixed">

<div id="logo">
<?php if ($logo) { ?><a href="<?php print $front_page ?>" title="<?php print t('Home') ?>"><img src="<?php print $logo ?>" alt="<?php print t('Home') ?>" /></a><?php } ?>
<?php if ($site_name) { ?><h1 class='site-name'><a href="<?php print $front_page ?>" title="<?php print t('Home') ?>"><?php print $site_name ?></a></h1><?php } ?>
<?php if ($site_slogan) { ?><div class='site-slogan'><?php print $site_slogan ?></div><?php } ?>
</div>

		<div id="menu">

				<?php if (isset($secondary_links)) { ?><?php print theme('links', $secondary_links, array('class' => 'links', 'id' => 'subnavlist')) ?><?php } ?>
      <?php if (isset($primary_links)) { ?><?php print theme('links', $primary_links, array('class' => 'links', 'id' => 'navlist')) ?><?php } ?>


		</div>

	</div>
</div>

<div id="main">

	<div id="main_inner" class="fixed">

		<div id="primaryContent_3columns">

			<div id="columnA_3columns">

				<?php if ($mission) { ?><div id="mission"><?php print $mission ?></div><?php } ?>
				<?php print $breadcrumb ?>
				 <h1 class="title"><?php print $title ?></h1>
				<div class="tabs"><?php print $tabs ?></div>
				<?php if ($show_messages) { print $messages; } ?>
        <?php print $help ?>
        <?php print $content; ?>
        <?php print $feed_icons; ?>




				<br class="clear" />

				<div class="post">





				</div>

			</div>

		</div>

		<div id="secondaryContent_3columns">

			<div id="columnB_3columns">
                  <?php print $search_box ?>
				 <?php print $left ?>
			</div>

			<div id="columnC_3columns">
				<?php print $right ?>
			</div>

		</div>

		<br class="clear" />

	</div>

</div>

<div id="footer" class="fixed">
	<?php print $footer_message ?>   <?php
include(path_to_theme().'/footer.php');
?>
</div>
  <?php print $closure ?>
</body>
</html>