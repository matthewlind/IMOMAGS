<?php

/**
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * **********************************************************************
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }
?>
<!DOCTYPE html>
<!-- bid: <?php global $blog_id; print $blog_id ?>; env: <?php if(defined("WEB_ENV")) { print WEB_ENV; } else { print "production"; } ?> -->
<!--[if IE 6]><![endif]-->
<html <?php language_attributes() ?>>
<head>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />

	<title><?php wp_title(''); ?></title>

	<meta http-equiv="X-UA-Compatible" content="chrome=1" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<?php wp_get_archives(array('type' => 'monthly', 'format' => 'link')); ?>
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/css/css.php?ver=<?php echo CFCT_URL_VERSION; ?>" />
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!--[if lte IE 7]>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/css/lte-ie7.css?ver=<?php echo CFCT_URL_VERSION; ?>" />
	<![endif]-->
	
	<?php
	// Include javascript for threaded comments if needed
	if ( is_singular() && get_option('thread_comments') ) { wp_enqueue_script( 'comment-reply' ); }
	
	wp_head();
	include_once get_stylesheet_directory() . "/head-includes.php"; 
	
	if (defined('GOOGLE_FONT')): ?>
	<link href='<?php print GOOGLE_FONT; ?>' rel='stylesheet' type='text/css'>
<?php endif; ?>
<link href='http://fonts.googleapis.com/css?family=Glegoo|Lato:300,400|Gudea|Share' rel='stylesheet' type='text/css'>
<?php if (is_page_template("page-cabelas.php")) : ?>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/css/contest.css?ver=<?php echo CFCT_URL_VERSION; ?>" />
<?php  endif; ?>     	
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.jfollow.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/scripts.js"/></script>
  <script type="text/javascript" src="/wp-content/themes/imo-mags-gunsandammo/js/flash_heed.js"></script>

<?php if (defined('JETPACK_SITE')): ?>
<script type='text/javascript' src='http://ads.jetpackdigital.com/sites/<?php print JETPACK_SITE; ?>/jpd.js'></script>
<?php endif; ?> 
</head>
<body <?php body_class(); ?>>
<div id="imo-tophat">
		<div class="top-bar">
		
			<h2>Guns & Ammo Network</h2>
			<hr>
		</div>
		
		<div class="network-nav">
			<ul>
				<li class="ga"><a href="http://gunsandammo.com"><div></div></a></li>
				<li class="hg"><a href="http://handgunsmag.com"><div></div></a></li>
				<li class="st-active active"><div></div></li>
				<li class="rs"><a href="http://rifleshootermag.com"><div></div></a></li>
				<li class="sn"><a href="http://shotgunnews.com"><div></div></a></li>
			</ul>
		</div>
	
	</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php if (function_exists('imo_expandable_scripts')) { 
		//ad run dates
		if(date("Ymd") >= $GLOBALS['startDate'] && date("Ymd") <= $GLOBALS['expDate']){	?>
			
			<div class="super-ad">
				<div>
					<a class="super-ad-close" style="display:none;">Close</a>
					<a class="super-ad-exp">Expand</a>
					<!-- Site - Guns and Ammo -->
					<div class="collapsed">
						<img src="<?php echo get_option('expandable_collapsed_image'); ?>" width="980" height="70" />
					</div>
					<div class="expanded" style="display:none;">
						<iframe id="super-header-iframe" src="<?php echo get_option('expandable_expanded_image'); ?>sz=980x276;ord=' + ord + '?" width="980" height="276" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>
					</div>
		
				</div>
			</div>
		<?php } 
	} ?>
	<header id="header">
    	<div class="str-container">
			<div class="stay-connected">
	  			 <p class="label">Stay Connected</p>
	  			 
	  			 <ul class="connections">
	  			   <li><a target="_blank" class="facebook" href="https://www.facebook.com/ShootingTimesMag" title="Find us on Facebook">Facebook</a></li>
	  			   <li><a target="_blank" class="twitter" href="http://twitter.com/ShootingTimesUS" title="Follow us on Twitter">Twitter</a></li>
	  			   <li><a target="_blank" class="feed" href="http://www.shootingtimes.com/feed/" title="Get the RSS Feed">RSS Feed</a></li>
	  			</ul>
	  		</div>

			
<?php if (!is_active_sidebar("header-slot")) { 
    include_once get_template_directory() . "/head-subscribe.php"; 
}
else { 
    dynamic_sidebar("header-slot");
}
?>
			
			
			     <h1 class="site-title"><a href="<?php echo home_url('/'); ?>" title="<?php _e('Home', 'carrington-business') ?>"><?php bloginfo('name'); ?></a></h1>
			     
			 
		
			<?php
            wp_nav_menu(array( 
				'theme_location' => 'featured',
				'container' => 'nav',
				'container_class' => 'nav-featured nav',
				'depth' => 2,
				'fallback_cb' => null
			));
            wp_nav_menu(array( 
				'theme_location' => 'main',
				'container' => 'nav',
				'container_class' => 'nav-main nav',
				'depth' => 2,
			));
            wp_nav_menu(array( 
				'theme_location' => 'subnav-right',
				'container' => 'nav',
				'container_class' => 'nav-subnav nav-subnav-right nav',
				'depth' => 2,
				'fallback_cb' => null
			));
            wp_nav_menu(array( 
				'theme_location' => 'subnav',
				'container' => 'nav',
				'container_class' => 'nav-subnav nav',
				'depth' => 2,
				'fallback_cb' => null
			));
//			cfct_form('search');
			?>
		</div>
	</header><!-- #header -->
	
	<!-- Breadcrumbs -->
	<?php if ( !is_front_page() && is_page() && is_archive() && function_exists('yoast_breadcrumb') ): ?>
	<div id="crumb-wrapper">
		<?php	yoast_breadcrumb('<p id="breadcrumbs">','</p>'); ?>
	</div>
	<?php endif; ?>
	<!-- end Breadcrumbs -->
	
	<hr class="accessibility" />
	<section id="main" class="str-container">
		<div id="main-content">
			<div class="str-content clearfix">
        <div class="aligncenter centerad">
<?php if (function_exists("imo_dart_tag")) {
    imo_dart_tag("728x90");
}
else { ?>
	<!-- 728x90 Ad: -->
<script type="text/javascript">
document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.'+dartadsgen_site+'/;sect=;page=index;subs=;sz=728x90;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
</script>
<script type="text/javascript">
    ++pr_tile;
</script>
<noscript>
    <a href="http://ad.doubleclick.net/adj/imo.outdoorsbest/;sect=;page=index;subs=;sz=728x90;dcopt=;tile=1;ord=7391727509?">
        <img src="http://ad.doubleclick.net/ad/imo.outdoorsbest/home;sect=;page=index;subs=;sz=728x90;dcopt=;tile=1;ord=7391727509?" border="0" />
    </a>
</noscript>
<!-- END 728x90 Ad: -->
<?php } ?>
</div>
