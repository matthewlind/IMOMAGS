<?php 
?><!DOCTYPE html>
<!-- bid: <?php global $blog_id; print $blog_id ?>; env: <?php if(defined("WEB_ENV")) { print WEB_ENV; } else { print "production"; } ?> -->
<!-- X-Device-Type Varnish Header Found: <?php global $varnishHeaderExists; echo ($varnishHeaderExists ? "YES" : 'NO'); ?> -->
<!-- Mobile Detected: <?php echo (mobile() ? "YES" : 'NO'); ?> -->
<!-- Tablet Detected: <?php echo (tablet() ? "YES" : 'NO'); ?> -->
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 10]>
<html id="ie10" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

			
	<!-- DEFAULTS ************************************************** -->
	
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
	<meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
	<title>
		<?php
		    /*
		     * Print the <title> tag based on what is being viewed.
		     */
		    global $page, $paged, $microsite ;
	
		    wp_title( '| ', true, 'right' );
	
		    // Add the blog name.
		    //bloginfo( 'name' );
					
		    // Add the blog description for the home/front page.
		
		    if ( $site_description && ( is_home() || is_front_page() ) )
		        get_bloginfo( 'description', 'display' );
	
		    // Add a page number if necessary:
		    if ( $paged >= 2 || $page >= 2 )
		        echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
	    ?>
	</title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if IE 8]><style type="text/css">img{max-width: none !important;}.BCLvideoWrapper object{width:480px !important;}</style><![endif]-->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	
	
	
	
	<!-- STYLES ************************************************** -->
	
	<?php	if ( $microsite){ 
			include('css/styles-microsites.php');
			echo "<!-- This is microsite AAAAAAA -->";
	} else { ?>
			<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
			<!-- NOT A microsite -->
	<?php	
	} 
	
	wp_enqueue_script("jquery");
    wp_head();
    ?>
    <!-- HEAD INCLUDES ************************************************** -->
	<?php	
		if ( $microsite){ 
				echo "<!-- This is microsite AAAAAAA -->";
				get_template_part('head-includes', 'microsite.php');
		} else { 
				echo "<!-- NOT A microsite  -->";
				get_template_part('head-includes', 'default.php');
				
		} 
	?>
</head>


<!-- CONTENT ************************************************** -->

<body <?php body_class(); ?>  >

	<?php	
		if ( $microsite ){ 
				echo "<!-- This is microsite AAAAAAABBBB  -->";
				include('header-content/header-content-microsites.php');
// 				get_template_part('header-content/header-content', 'microsites.php');
		} 
		else { 
				echo "<!-- NOT A microsite  -->";
				get_template_part('header-content/header-content', 'default');
		} 
	?>