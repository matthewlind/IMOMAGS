<?php 
	$cat = get_query_var('cat');
	$thiscat = get_category ($cat);
	$catslug = $thiscat->slug;
?>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/normalize.css" />


<!-- Petersens Hunting -->
<?php
	if (site_url() == "http://www.petersenshunting.com/") { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/microsite-css/petersenshunting/microsite-<?php echo $catslug ?>.css" />


<!-- In-fisherman -->		
<?php	} elseif (site_url() == "http://www.in-fisherman.artem") { ?>
	
	
	<?php	$rigged_cat = array("riggedready", "northeast", "southeast", "midwest", "southwest", "northwest");
		
			if ( is_category($rigged_cat) || in_category($rigged_cat)) {	
	?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/in-fisherman/microsite-rigged-ready.css" />
<?php	} else { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/css/microsite-css/in-fisherman/microsite-<?php echo $catslug ?>.css" />
<?php	} ?>




		
		
<?php	} else { ?>
		<!-- <?php echo site_url(); ?> -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/microsite-css/microsite.css" />
		
<?php	} ?>
