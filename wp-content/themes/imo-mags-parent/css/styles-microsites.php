<?php 
	$dartDomain = get_option("dart_domain", $default = false);
	
	$cat = get_query_var('cat');
	$thiscat = get_category ($cat);
	$catslug = $thiscat->slug;
	
/*
	$url_string = site_url();
	$url_suffixes = array(".com", ".com/", ".artem", ".artem/", ".fox", ".fox/", ".devj", ".devj/");
	$site_url = str_replace($url_suffixes, "", $url_string);
*/
?>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/normalize.min.css" />

<?php
/* ------------------------------------------------------------------------
	Petersens Hunting 
-------------------------------------------------------------------------- */

	if ($dartDomain == "imo.hunting") { 
		
		if ( is_category("wheels-afield") || in_category("wheels-afield")) {
	?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/petersenshunting/microsite-wheels-afield.css" />
<?php   } else { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/microsite-css/microsite.css" />
<?php	}    ?>


<?php
/* ------------------------------------------------------------------------
	In-fisherman 
-------------------------------------------------------------------------- */		
	} elseif ($dartDomain == "imo.in-fisherman") { ?>
	
	
	<?php	$rigged_cat = array("rigged-ready", "ne", "se", "mw", "sw", "nw");
		
			if ( is_category($rigged_cat) || in_category($rigged_cat)) {	
	?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/in-fisherman/microsite-rigged-ready.css" />
<?php	} else { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/in-fisherman/microsite-<?php echo $catslug ?>.css" />
<?php	} ?>

<?php
/*------------------------------------------------------------------------
	Else 
--------------------------------------------------------------------------*/	
	} else { ?>
		<!-- <?php echo site_url(); ?> -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/microsite-css/microsite.css" />
		
<?php	} ?>
