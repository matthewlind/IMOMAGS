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
<!-- 	<meta name="viewport" content="initial-scale=1, maximum-scale=1" /> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
	<title>
		<?php
		    /*
		     * Print the <title> tag based on what is being viewed.
		     */
		    global $page, $paged, $microsite, $microsite_default, $microsite_rigged, $redesign, $is_search;
	
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
	<link rel="stylesheet" type="text/css" media="all" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,800" />
	<link rel="stylesheet" type="text/css" media="all" href="https://fonts.googleapis.com/css?family=Merriweather:400,400italic,700,700italic" />
<?php	
	if ( $microsite){ 
		include('css/styles-microsites.php');
	} else { 
		if (is_category("tv") || in_category("tv") || is_page_template( "show-page.php" )) { ?>
				<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' );?>/css/category-tv.css" />
<?php 	} // end if if (is_category("tv") ?>	
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php		

	} // end else
	
	if (is_single() || is_page()) { ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' );?>/css/redesign/single.css" />	
<?php }
	
	if (is_home() || is_category() || is_archive('reader_photos') || is_search() || is_author() || is_404()) { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' );?>/css/redesign/home-and-cat.css" />
<?php } 
	
	wp_enqueue_script("jquery");
    wp_head();
?>
    
    
    <!-- HEAD INCLUDES ************************************************** -->
    
	<?php
    /* We add some JavaScript to pages with the comment form
     * to support sites with threaded comments (when in use).
     */
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    $postID = get_the_ID();
    $dartDomain = get_option("dart_domain", $default = false);
    $magazine_img = get_option('magazine_cover_uri' );
    if($dartDomain == "imo.gunsandammo" || $dartDomain == "imo.in-fisherman" || $dartDomain == "imo.shotgunnews" || $dartDomain == "imo.shootingtimes"){
	    $subs_link = get_option('subs_link');
    }else{
		$subs_link = get_option('subs_link') . "/?pkey=";
    }
	$iMagID = get_option('iMagID' );
	$deal_copy = get_option('deal_copy' );
	$gift_link = get_option('gift_link' );
	$service_link = get_option('service_link' );
	$subs_form_link = get_option('subs_form_link' );
	$i4ky = get_option('i4ky' );
	include_once get_template_directory() . "/head-includes.php";
	include_once get_stylesheet_directory() . "/head-includes.php";
	?>

</head>


<!-- CONTENT ************************************************** -->

<body <?php body_class(); ?> id="<?php echo $postID; ?>" domain="<?php echo $dartDomain; ?>" >

	<?php	
		imo_ad_placement("interstitial");
		if ( $microsite ){ 
// 				include('header-content/header-content-microsites.php');
 				get_template_part('header-content/header-content', 'microsites');
		} 
		else { 
				get_template_part('header-content/header-content', 'redesign');
		} 
	?>