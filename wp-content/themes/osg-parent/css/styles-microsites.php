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
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/microsite-default.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/petersenshunting/microsite-wheels-afield.css" />
<?php   } else { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/microsite-default.css" />
<?php	}    




/* ------------------------------------------------------------------------
	Wildfowl 
-------------------------------------------------------------------------- */		
	} elseif ($dartDomain == "imo.wildfowl") { 
		if ( is_category('gear-guide') || in_category('gear-guide')) {	
	?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/microsite-default.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/wildfowl/microsite-gear-guide.css" />
<!-- 		<meta property="og:image" content="http://www.in-fisherman.com/files/2015/06/RR-sweeps-no-btn-968x504FB.jpg" /> -->			
<?php	} 




/* ------------------------------------------------------------------------
	Game and Fish 
-------------------------------------------------------------------------- */		
	} elseif ($dartDomain == "imo.gameandfish") { 
		
		$deer_zone_cat = array("deer-zone", "ne", "se", "mw", "sw", "nw", "dz-sweeps");
		
		if ( is_category('crossbows') || in_category('crossbows') || in_category('crossbow-revolution')) {	
?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/microsite-default.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/gameandfish/microsite-crossbows.css" />
				
<?php	} elseif ( is_category($deer_zone_cat) || in_category($deer_zone_cat)) { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/rigged-ready-default.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/gameandfish/microsite-deer-zone.css" />
		
<?php // This meta is inserted to display featured share image for facebook
				if ( is_category('sweeps')) { ?>
<!-- 					<meta property="og:image" content="http://www.in-fisherman.com/files/2015/06/RR-sweeps-no-btn-968x504FB.jpg" /> -->
<?php 				} ?>
<?		} else { ?>
			<!-- NOTHING -->
<?php	} 
	



/* ------------------------------------------------------------------------
	In-fisherman 
-------------------------------------------------------------------------- */		
	} elseif ($dartDomain == "imo.in-fisherman") { ?>
	
	
	<?php	$rigged_cat = array("rigged-ready", "ne", "se", "mw", "sw", "nw", "sweeps");
		
		if ( is_category($rigged_cat) || in_category($rigged_cat)) {	
	?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/rigged-ready-default.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/in-fisherman/microsite-rigged-ready.css" />
			<?php // This meta is inserted to display featured share image for facebook
				if ( is_category('sweeps')) { ?>
					<meta property="og:image" content="http://www.in-fisherman.com/files/2015/06/RR-sweeps-no-btn-968x504FB.jpg" />
			<?php } ?>
<?php	} else { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/in-fisherman/microsite-<?php echo $catslug ?>.css" />
<?php	} 



	
/* ------------------------------------------------------------------------
	Guns and Ammo 
-------------------------------------------------------------------------- */		
	} elseif ($dartDomain == "imo.gunsandammo") { 
		
		if ( is_category('shoot101') || in_category('shoot101')) {	
	?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/microsite-default.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/gunsandammo/microsite-shoot101.css" />
<?php	} else { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/microsite-default.css" />
<?php	} ?>

<?php
	
	
	
/*------------------------------------------------------------------------
	Else 
--------------------------------------------------------------------------*/	
	} else { ?>
		<!-- <?php echo site_url(); ?> -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/microsite-default.css" />
		
<?php	} ?>
