<?php
/**
 * This file was forked from Carrington Business, and should eventually be merged back into
 * the main line. 
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
<?php if (defined('JETPACK_SITE')): ?>
<script type='text/javascript' src='http://ads.jetpackdigital.com/sites/<?php print JETPACK_SITE; ?>/jpd.js'></script>
<?php endif; ?> 
</head>
<body <?php body_class(); ?>>
	
<div class='str-container'>
        <div class='aligncenter centerad'>
            <div class="ad-left">
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
<div class='ad-right'>
    <a href="http://www.nssf.org/FirstShots/" target="_blank"><img src='<?php print bloginfo('stylesheet_directory') . "/img/nssf.png"?>' alt="Visit the National Shooting Sports Foundation"/></a>
</div>
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
		
//			cfct_form('search');
			?>
		</div>
	</header><!-- #header -->
	
	<!-- Breadcrumbs -->
	<?php if ( !is_front_page() && function_exists('yoast_breadcrumb') ): ?>
	<div id="crumb-wrapper">
		<?php	yoast_breadcrumb('<p id="breadcrumbs">','</p>'); ?>
	</div>
	<?php endif; ?>
	<!-- end Breadcrumbs -->
	
	<hr class="accessibility" />
	<section id="main" class="str-container">
		<div id="main-content">
			<div class="str-content clearfix">
