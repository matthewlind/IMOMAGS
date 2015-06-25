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
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
	<meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
	<title><?php
	    /*
	     * Print the <title> tag based on what is being viewed.
	     */
	    global $page, $paged, $microsite;

	    wp_title( '| ', true, 'right' );

	    // Add the blog name.
	    //bloginfo( 'name' );

	    // Add the blog description for the home/front page.

	    if ( $site_description && ( is_home() || is_front_page() ) )
	        get_bloginfo( 'description', 'display' );

	    // Add a page number if necessary:
	    if ( $paged >= 2 || $page >= 2 )
	        echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	    ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<!--[if IE 8]><style type="text/css">img{max-width: none !important;}.BCLvideoWrapper object{width:480px !important;}</style><![endif]-->
	
	<?php

		if ( $microsite ){ 
			get_template_part('../imo-mags-parent/css/styles', 'microsites');
		} else { ?>
			<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php	} ?>
	
	

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
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
	    wp_enqueue_script("jquery");
	    wp_head();

        global $IMO_USER_STATE;

        $sportsmanStates = array("GA","MI","MN","WI","AR","TN","TX");

        $magazine_img = get_option('magazine_cover_uri');

         if (in_array($IMO_USER_STATE, $sportsmanStates)) {
            $magazine_img = get_option('magazine_cover_alt_uri');
        }




		$subs_link = get_option('subs_link') . "/?pkey=";
		$iMagID = get_option('iMagID' );
		$deal_copy = get_option('deal_copy' );
		$gift_link = get_option('gift_link' );
		$service_link = get_option('service_link' );
		$subs_form_link = get_option('subs_form_link' );
		$i4ky = get_option('i4ky' );
		$dartDomain = get_option("dart_domain", $default = false);
		include_once get_template_directory() . "/head-includes.php";
		include_once get_stylesheet_directory() . "/head-includes.php";
	?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/dart.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.jfollow.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/flash_heed.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/snap.js"></script>
	<?php if ( defined('JETPACK_SITE') && mobile() == false && tablet() == false): ?>
		<script type='text/javascript' src='http://ads.jetpackdigital.com/sites/<?php print JETPACK_SITE; ?>/jpd.js'></script>
	<?php endif; ?>
	<script async src="http://cdn.mediavoice.com/nativeads/script/IMOutdoors/GnFTEST.js"></script>
</head>

<body <?php body_class(); ?>  >
<?php
	if ( $microsite ){
		get_template_part('../imo-mags-parent/header-content/microsites/gameandfish/header-content', 'crossbows');
	}else{
		get_template_part('content/content', 'header');
	}
?>
