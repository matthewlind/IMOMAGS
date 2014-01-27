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
	?>
<?php if (is_page_template("page-cabelas.php")) : ?>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/css/contest.css?ver=<?php echo CFCT_URL_VERSION; ?>" />
<?php  endif; ?>     	

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/scripts.js"/></script>
<script type="text/javascript" src="/wp-content/themes/imo-mags-gunsandammo/js/flash_heed.js"></script>
<?php if (defined('JETPACK_SITE')): ?>
<script type='text/javascript' src='http://ads.jetpackdigital.com/sites/<?php print JETPACK_SITE; ?>/jpd.js'></script>
<?php endif; ?> 

<!-- code for custom ad units from REGGIE HUDSON -->
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
googletag.defineSlot('/4930/imo.floridasportsman/rtfs/sponsors/yeti-coolers', [[160, 600], [300, 250], [728, 90]], 'div-gpt-ad-1331066554622-0').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>


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
googletag.defineSlot('/4930/imo.floridasportsman/regions/tropics', [[728, 90]], 'div-gpt-ad-1340122297419-0').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>
<!-- end that custom REGGIE UNIT STUFF -->

</head>
<body <?php body_class(); ?>>
<?php imo_dart_tag("1x1",false,array("pos"=>"skin")); ?>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<div id="bottom-wrap">
<div class='str-container'>
        <div class='aligncenter centerad'>
<?php if (function_exists("imo_dart_tag") && !is_page('tropics')) {
    imo_dart_tag("728x90");
}else if(is_page('tropics')){ ?>
<!-- Site - Florida Sportsman/regions/tropics -->
<div id='div-gpt-ad-1340122297419-0'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1340122297419-0'); });
</script>
</div>
<?php }else{ ?>
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
</div>

	<header id="header">
    		<div class="str-container">
	
<?php if (!is_active_sidebar("header-slot")) { 
    include_once get_template_directory() . "/head-subscribe.php"; 
}
else { 
    dynamic_sidebar("header-slot");
}
?>
	     <h1 class="site-title"><a href="<?php echo home_url('/'); ?>" title="<?php _e('Home', 'carrington-business') ?>"><?php bloginfo('name'); ?></a></h1>
         <a href="/rtfs/"><img class="header-feature-nav" src="/wp-content/themes/imo-mags-floridasportsman/img/bw-header_04-rtfs.png" border="0" /></a>
<a class="header-gallery" href="/galleries/"><img  src="/wp-content/themes/imo-mags-floridasportsman/img/bw-header_07.png"></a>
<a class="header-webxtra" href="/store/" rel="nofollow"><img  src="/wp-content/themes/imo-mags-floridasportsman/img/bw-header_08.png"></a>
					     
			 
		
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
	<?php if ( !is_front_page() && function_exists('yoast_breadcrumb') && !isset($_GET['where']) && !isset($_GET['price']) && !is_tax('price') && !is_tax('where') ): ?>
	<div id="crumb-wrapper">
		<?php yoast_breadcrumb('<p id="breadcrumbs">','</p>'); ?>
	</div>
	<?php endif; ?>
	
	<?php if (isset($_GET['where']) || isset($_GET['price']) || is_tax('price') || is_tax('where')) {?>
    <div id="crumb-wrapper">
		<p id="breadcrumbs" style="text-transform:capitalize;">You are Here: <a href="/">Home</a> : <a href="">Your Best Boat</a> : <?php if (isset($_GET['where']) || is_tax('where')) {
$taxonomy = 'where';
$queried_term = get_query_var($taxonomy);
$terms = get_terms($taxonomy, 'slug='.$queried_term);
if ($terms) {
  foreach($terms as $term) {
    echo 'for ' . $term->name . '';
  }
}
}
?> <?php if (isset($_GET['price']) || is_tax('price')) {
$taxonomy = 'price';
$queried_term = get_query_var($taxonomy);
$terms = get_terms($taxonomy, 'slug='.$queried_term);
if ($terms) {
  foreach($terms as $term) {
    echo 'with a price range of ' . $term->name . '';
  }
}
 } ?></p>
	</div>
    <?php } ?>
	<!-- end Breadcrumbs -->
	
	<hr class="accessibility" />
	<section id="main" class="str-container">
		<div id="main-content">
			<div class="str-content clearfix">
