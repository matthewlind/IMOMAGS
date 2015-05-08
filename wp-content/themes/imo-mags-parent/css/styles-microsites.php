<?php 
	$cat = get_query_var('cat');
	$thiscat = get_category ($cat);
	$catslug = $thiscat->slug;
	
	$url_string = site_url();
	$url_suffixes = array(".com", ".com/", ".artem", ".artem/", ".fox", ".fox/");
	$site_url = str_replace($url_suffixes, "", $url_string);
?>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/normalize.css" />


<!------------------------------------------------------------------------
	Petersens Hunting 
-------------------------------------------------------------------------->
<?php
	if ($site_url == "http://www.petersenshunting") { 
		
		if ( is_category("wheels-afield") || in_category("wheels-afield")) {
	?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/petersenshunting2/microsite-wheels-afield.css" />
<?php   } else { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/microsite-css/microsite.css" />
<?php	}    ?>


<!------------------------------------------------------------------------
	In-fisherman 
-------------------------------------------------------------------------->			
<?php	} elseif ($site_url == "http://www.in-fisherman") { ?>
	
	
	<?php	$rigged_cat = array("rigged-ready", "ne", "se", "mw", "sw", "nw");
		
			if ( is_category($rigged_cat) || in_category($rigged_cat)) {	
	?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/in-fisherman/microsite-rigged-ready.css" />
<?php	} else { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/in-fisherman/microsite-<?php echo $catslug ?>.css" />
<?php	} ?>


<!------------------------------------------------------------------------
	Else 
-------------------------------------------------------------------------->		
<?php	} else { ?>
		<!-- <?php echo site_url(); ?> -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/microsite-css/microsite.css" />
		
<?php	} ?>
