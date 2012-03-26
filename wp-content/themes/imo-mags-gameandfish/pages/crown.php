<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
/**
 * @package favebusiness
 *
 * This file is part of the FaveBusiness Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/favebusiness/
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
	
	<link href="/wp-content/themes/imo-mags-gameandfish/960.css" media="screen" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Glegoo|Lato:300,400|Gudea|Share' rel='stylesheet' type='text/css'>

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
<?php if (defined('GOOGLE_FONT')): ?>
	<link href='<?php print GOOGLE_FONT; ?>' rel='stylesheet' type='text/css'>
<?php endif; ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/scripts.js"/></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.buffet.js"/></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.buffet.min.js"/></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/ageblock.js"/></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/ageblock.min.js"/></script>

</head>
	<body>
		<!--  <div id="dialog">TESTING</div> -->

		<!-- container -->
		<div class="container container_16">
			<div class="header-cr">
				<h1 class="site-title-cr"><a href="<?php echo home_url('/'); ?>" title="<?php _e('Home', 'carrington-business') ?>"><?php bloginfo('name'); ?></a></h1>
			</div>
			<div class="str-container-cr">
			
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
			?>
			</div>
	</div>
	<div class="clear">&nbsp;</div>
	<!-- homepage top -->
	<div id="page-top">
		<!-- container -->
		<div class="container container_16">

			<!-- left content -->
			<div class='grid_4'>
				<div class="box-230">
					<p class="purple purp-callout">Enter To Win<br />And Share Your<br />Best Catch</p>
				</div>
				

				<div class="box-110">
					<p class="white callout upload"><a href="#sign-up-area">Upload<br />Your<br />Photo</a></p>
				</div>
				<div class="box-110 box-right">
					<p class="white callout gallery"><a href="#gallery">View<br />Entries</a></p>
				</div>
				<div class="box-230">
					<p class="white cr-callout"></p>
				</div>
			</div>

			<!-- right content -->
			<div class='grid_12'>
				<div class="box-710">
			<?php
		
			$the_query = new WP_Query( array( 'post_type' => 'photo_contest', 'posts_per_page' => 1, 'orderby' => 'rand') );
			while ( $the_query->have_posts() ) : $the_query->the_post();   
			?> 		
			<a href="<?php the_permalink(); ?>" class="slide">
			<?php if(has_post_thumbnail()){  
			the_post_thumbnail(array(710,'auto')); 
			}else{ ?>
			<!-- <img src="<?php //create and use a first post??? ?>" alt="Photo Entry" /> -->
			<?php }	?>
			<div class="meta"><h2>
			<?php 
			//truncate the title
			$tit = the_title('','',FALSE);
			echo substr($tit, 0, 32);
			if (strlen($tit) > 32) echo " ...";
			?>
			</h2>
			<span><em>posted on <?php the_date(); ?></em></span>
			</div></a>
			
			<?php
					
			endwhile;	
			// Reset Post Data
			wp_reset_postdata(); ?>
				</div>
				<div class="box-350 slideshow_btm">
					<a href="#prizes" class="prizes-area">
           			<span><abbr>View The Prizes</abbr></span>
            		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/home_prizes.jpg" alt="Prizes" />
       				</a>

				</div>
				<div class="box-350 slideshow_btm box-right">
					<a href="#footer" class="rules-area">
           			<span><abbr>View The Rules</abbr></span>
            		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/home_rules.jpg" alt="Rules" />
       				</a>

				</div>			
			</div>

		</div><!--/ end container -->
	</div><!--/ end homepage top -->
	
	
	<!-- Gallery -->
	<div id="gallery">
		<!-- container -->
		<div class="gallery-entries">
			<h1>Contest Entries</h1>
						
			<!-- left content -->
			<div id="tabs">
				<ul id="filters" class="tabs-bottom">
					<li>Filter By:</li>
					<li><a href="#tabs-1">Most Recent</a></li>
					<li><a href="#tabs-2">Random</a></li>
				</ul>
				
				<!-- Tab Most Recent -->
				<div id="tabs-1">
					<div class="scroll_mask">				
 						<ul class="scroll">
						<?php
						//Most Recent
						$the_query = new WP_Query( array( 'post_type' => 'photo_contest', 'orderby' => 'date', 'order' => 'DESC' ) );
						while ( $the_query->have_posts() ) : $the_query->the_post(); 
							if(has_post_thumbnail()){  
								foreach($the_query as $query) ?>
								<li><a href="<?php echo $query->guid; ?>"><span></span><?php the_post_thumbnail('thumbnail'); ?></a></li>
            					<?php
       						}
						endwhile;	
						// Reset Post Data
						wp_reset_postdata();
						?>
			  			</ul>
					</div>
					<a class="prev">Previous</a>
					<a class="next">Next</a>
				</div><!-- end tab-1 -->
				
				<!-- Tab Random -->
				<div id="tabs-2">
					<div class="scroll_mask">				
 						<ul class="scroll">
			
						<?php
						//Random Order
						$the_query = new WP_Query( array( 'post_type' => 'photo_contest', 'orderby' => 'rand' ) );
							while ( $the_query->have_posts() ) : $the_query->the_post(); 
								if(has_post_thumbnail()){  
									foreach($the_query as $query) ?>
									<li><a href="<?php echo $query->guid; ?>"><span></span><?php the_post_thumbnail('thumbnail'); ?></a></li>
            						<?php 
       								
       							}
							endwhile;	
							// Reset Post Data
							wp_reset_postdata();
							?>
			  			</ul>
					</div>
					<a class="prev">Previous</a>
					<a class="next">Next</a>
				</div><!-- end tab-2 -->
						
			</div><!-- end tabs -->
		</div><!-- end container -->
	</div><!-- end container gallery -->


	<!-- sign up area -->		
	<div id="sign-up-area">
		<!-- container -->
		<div class="sign-up-form">
			<h1>Register</h1>
			<p class="required"><span>*</span> = Required.</p>
			<?php 
			// Call the forms
			gravity_form(9, false, false, false, '', false);
			?>		
		</div><!-- /end container -->
	</div><!-- /end sign up area -->	
			
	
	<!-- Prizes -->	
	<div id="prizes">
		<!-- container -->
		<div class="container container_16">
		<h1>Prizes</h1>
			
			<!-- left content -->
			<div class='grid_8'>
				<div class="box-470 grand">
					<h2>1st Grand Prize</h2>
           			<a href="javascript:void(0)">
           			<span>
           				<ol>
							<li>2012 Triton Explorer Series Boat</li>
							<li>115 HP Mercury outboard</li>
							<li>Complete with trailer and Motor Guide trolling motor.</li>
						</ol>
					</span>
            		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/grand_prize.jpg" alt="Grand Prize" />
       				</a>
				</div>
				<div class="box-470 grand">
					<h2>2nd Grand Prize</h2>
					<a href="javascript:void(0)">
					<span>
						<ol>
							<li>All expense paid trip for two to the Florida Keys</li>
							<li>Two night stay and one full day guided fishing trip with all tackle and license provided</li>
							<li>Round trip air fare and meals included</li>
						</ol>
					</span>
            		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/second_prize.jpg" alt="Second Grand Prize" />
       				</a>
				</div>
			</div>

			<!-- middle content -->
			<div class='grid_6'>
				<div class="box-350 box-350-states">
					<h2>State Prizes</h2>
					<a href="javascript:void(0)">
						<span>There will be 9 winners, one, from each state.<br />The Prize package will consist of:<br /><br />
							<ol>
								<li>"This Story Calls for a Crown" Fishing Jersey</li>
								<li>Crown Royal fishing cap</li>
								<li>Plano fishing tackle box</li>
								<li>Penn Rod and Reel Combo</li>
								<li>Shipping included</li>
							</ol>
						</span>
            		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/states.jpg" alt="State Prizes" class="states-bg" />
            		</a>

				</div>
			</div>

			<!-- right content -->
			<div class='grid_2'>
				<div class="box-110">
					<p class="purple purp-callout">Check Out<br />These<br />Prizes</p>
				</div>
				<div class="box-110">
					<p class="white callout upload"><a href="#sign-up-area">Upload<br />Your<br />Photo</a></p>
				</div>
				<div class="box-110">
					<p class="white callout gallery"><a href="#gallery">View<br />Member<br />Photos</a></p>
				</div>
				<div class="box-110">
					<p class="white callout rules"><a href="#footer">The<br />Official<br />Rules</a></p>
				</div>
			</div>

		</div><!--/end container -->		
	</div><!--/end Prizes -->			
	
	
	<!-- Footer -->		
	<div id="footer">
		<!-- container -->
		<div class="container container_16">
			<div class='grid_8'>
			<h1>Official Rules</h1>		
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
			<div class='grid_8 rules-right'>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>	
				
			</div>

		</div><!-- /end container -->
	</div><!-- /end Footer -->	
	<div class="clear">&nbsp;</div>

<p id="back-top" style="display: block;"><a href="#top"><span></span>Back to Top</a></p>
<!-- AddThis Fixed-Positioned Toolbox -->
<div class="addthis_toolbox atfixed">   
    <div class="custom_images">
        <a class="addthis_button_facebook"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/fb32.png" alt="Share to Facebook" /></a>
        <a class="addthis_button_twitter"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/tw32.png"  alt="Share to Twitter" /></a>
        <a class="addthis_button_more"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/at32.png" alt="More..." /></a>
    </div>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4de660d91dde9eba"></script>
<?php wp_footer(); ?>
</body>
</html>