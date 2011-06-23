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
	?>
 <?php if (is_page_template("page-cabelas.php")) { ?>
                <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/css/contest.css?ver=<?php echo CFCT_URL_VERSION; ?>" />
        <?php  } ?>     	
	
<!-- +++++++++ IMO MODS ++++++++ -->
	
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Anton&v1' rel='stylesheet' type='text/css'>

	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5816642-20']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/scripts.js"/></script>
<?php if (defined('JETPACK_SITE')): ?>
<script type='text/javascript' src='http://ads.jetpackdigital.com/sites/<?php print JETPACK_SITE; ?>/jpd.js'></script>
<?php endif; ?> 
</head>
<body <?php body_class(); ?>>
	
<div class='str-container'>
        <div class='aligncenter centerad'>
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
</div>
</div>

	<header id="header">
    		<div class="str-container">
			
			<div style="float:right;padding-top:20px;width:240px;">
				<div style="float:right;p">
                                        <a href="https://secure.palmcoastd.com/pcd/eSv?iMagId=0146S&i4Ky=IBZN"><img style="border: 1px solid #cccccc;" width="83px" src="http://dev.imomags.com/imgs/handguns-magazine.png"></a> 
                                 </div> 
				<div style="float:left; adding-right:10px;margin-right:10px;text-align:right;">
					<p style="FONT-WEIGHT: bold; COLOR:#cccccc;line-height:13px;">Save Over 70% off<br> the Cover Price </p> 
					<p style="margin-bottom:2px;margin-top:10px;"><a href="https://secure.palmcoastd.com/pcd/eSv?iMagId=0146S&i4Ky=IBZN" style="FONT-WEIGHT: bold; COLOR: #ffffff; TEXT-DECORATION: none">Subscribe Now!</a></p> 
					<p style="margin-bottom:2px;"><a href="https://secure.palmcoastd.com/pcd/eSv?iMagId=0146S&i4Ky=IBZN" style="FONT-WEIGHT: bold; COLOR: #ffffff; TEXT-DECORATION: none">Give a Gift</a></p> 
					<p><a href="https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0NlM0NDY5NCZpVHlwZT1FTlRFUg==" style="FONT-WEIGHT: bold; COLOR: #ffffff; TEXT-DECORATION: none">Subscriber Services</a></p> 
				</div>	
				
 
                        </div>
			
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
	
	<hr class="accessibility" />
	<section id="main" class="str-container">
		<div id="main-content">
			<div class="str-content clearfix">
