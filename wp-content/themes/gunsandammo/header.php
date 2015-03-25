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
	    global $page, $paged;

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
	if (is_home()) { ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php }	else { 
		if ( in_category('shoot101')) { ?>
			<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/shoot101.css" />
	<?php } else { ?>
			<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php	}
	}
	?>
	
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
	    
	    $magazine_img = get_option('magazine_cover_uri' );
		$subs_link = get_option('subs_link'); 
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
	<script type='text/javascript'>
		var googletag = googletag || {};
		googletag.cmd = googletag.cmd || [];
		(function() {
		var gads = document.createElement('script');
		gads.async = true;
		gads.type = 'text/javascript';
		var useSSL = 'https:' == document.location.protocol;
		gads.src = (useSSL ? 'https:' : 'http:') +
		'//www.googletagservices.com/tag/js/gpt.js';
		var node = document.getElementsByTagName('script')[0];
		node.parentNode.insertBefore(gads, node);
		})();
	</script>
	 
	<script type='text/javascript'>
		googletag.cmd.push(function() {
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [1, 1], 'div-gpt-ad-1386782139095-0').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [240, 60], 'div-gpt-ad-1386782139095-1').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 120], 'div-gpt-ad-1386782139095-2').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 250], 'div-gpt-ad-1386782139095-3').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 300], 'div-gpt-ad-1386782139095-4').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 600], 'div-gpt-ad-1386782139095-5').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 602], 'div-gpt-ad-1386782139095-6').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [728, 90], 'div-gpt-ad-1386782139095-7').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [1080, 90], 'div-gpt-ad-1386782139095-8').addService(googletag.pubads());
			googletag.pubads().enableSingleRequest();
			googletag.pubads().enableVideoAds();
			googletag.enableServices();
		});
	</script>
	<?php if ( defined('JETPACK_SITE') && mobile() == false && tablet() == false): ?>
		<script type='text/javascript' src='http://ads.jetpackdigital.com/sites/<?php print JETPACK_SITE; ?>/jpd.js'></script>
	<?php endif; ?>
</head>

<body <?php body_class(); ?>  >
<?php
	if (is_home()) {
		get_template_part('content/content', 'header');
	}	else {
		if ( in_category('shoot101')) {
			get_template_part('content/content', 'header-microsite');
		} else {
			get_template_part('content/content', 'header');
		}
	}
?>
