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
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_directory' ); ?>/css/shoot101.css" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php
		wp_enqueue_script("jquery");
		 
		// Prevent loading scripts from plugins you don't use
		
		// nextgen-gallery
		wp_dequeue_script('ngg-slideshow');
		wp_dequeue_script( 'shutter' );
		wp_dequeue_style('NextGEN');
		wp_dequeue_style( 'thickbox');
		wp_dequeue_style('shutter');
		
		// easy-table-creator
		wp_dequeue_script('easy_table_creator_js');
		wp_dequeue_script('easy_table_creator_tablesorter_js');
		
		
		wp_dequeue_script( 'madnessjs');
		wp_dequeue_style( 'madnesscss');
		wp_dequeue_script( 'magnificjs');
		wp_dequeue_style( 'magnificcss');		
		wp_dequeue_script( 'htmlparser');
		wp_dequeue_script( 'postscribe');
		wp_dequeue_script( 'xdomainrequest');
		wp_dequeue_script('hoverintent');
		wp_dequeue_script('wpubermenu');
		wp_dequeue_script('jquery-flexslider');
	    wp_dequeue_script('network-topics-js');
		wp_dequeue_style('network-topics-css');
		
		// wpsocialite
		wp_dequeue_script('socialite-lib');
        wp_dequeue_script('wpsocialite');
        wp_dequeue_style('socialite-css');
        
        // addthis
        wp_dequeue_script( 'addthis' );
        wp_dequeue_script( 'addthis_options_page_script');
        wp_dequeue_style( 'addthis' );
		
		// Prevent loading scripts from plugins you don't use END
		

		 
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
		fixed_connect_footer();
		if ( mobile() ) { ?><div class="mobile-adhesion"><?php imo_ad_placement("mobile_adhesion_320x50"); ?></div><?php } ?>
	
	<div class="top-panel">
		<a href="http://www.gunsandammo.com/" class="icon-arrow-left">Back to Guns & Ammo</a>
	</div>
	<div class="s101 <?php /* if (is_category( 'shoot101' )) { echo "cat-shoot101"; } */ if ( in_category( 'shoot101' )) { echo "cat-shoot101";}?>">
		
		<header class="main-header">
			
			<div class="menu-area clearfix">
				<?php
				    $category_id = get_cat_ID( 'shoot101' );				
				    $category_link = get_category_link( $category_id );
				?>
				<div class="shoot101-logo">
					<a href="<?php echo esc_url( $category_link ); ?>" title="shoot101"><img  src="/wp-content/themes/gunsandammo/images/shoot101/Shoot101-logo-light.png"></a>
				</div>
	<!-- 			<div class="nav-container"> -->
					<nav id="site-navigation" class="main-nav" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'shoot101_menu', 'container' => '0' ) ); ?>
					</nav>
					<div class="social-buttons">
						<ul>
							<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode(get_permalink())); ?>&title=<?php print(urlencode(the_title())); ?>" class="icon-facebook"></a></li>
							<li><a href="http://twitter.com/intent/tweet?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>" class="icon-twitter"></a></li>
							<li><a href="mailto:?subject=Article I came across&body=Check out this article! Title: '<?php the_title(); ?>'. Link: <?php the_permalink(); ?>" class="icon-mail"></a></li>
						</ul>
					</div>
	<!-- 			</div> -->
			</div>
		</header>














