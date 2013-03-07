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

get_header();
?>

<?php if(is_category("blogs")){ ?>
<div class="col-ab">
	<a href="http://www.rifleshootermag.com/powder-burns/">
		<img src="http://www.rifleshootermag.com/files/2013/03/rupp-rifles-blog.jpg" class="cfct-mod-image  cfct-image-left" alt="RS-Powder-Burns" title="RS-Powder-Burns">
	</a>
	<div class="cfct-module cfct-heading">
		<h2 class="cfct-mod-title">Powder Burns</h2>
	</div>
	<div class="cfct-module cfct-heading">
		<h6 class="cfct-mod-title" style="float:none;">with Brad Fitzpatrick</h6>
	</div>
					
	<?php

	$args = array(
		'category_name' => 'powder-burns',
		'posts_per_page' => 2
	);
	// The Query
	$the_query = new WP_Query( $args );
	
	// The Loop
	while ( $the_query->have_posts() ) :
		$the_query->the_post(); ?>
		
		<div id="post-excerpt-<?php the_ID(); ?>" <?php post_class('entry entry-excerpt clearfix') ?>>
		
		<div class="entry-summary">
			<?php
			if (has_post_thumbnail()) {
				echo '<a href="', the_permalink(),'">', the_post_thumbnail('post-thumbnail', array('class' => 'entry-img')), '</a>';
			}?>
			<div class="entry-info">
			
				<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
				<!--<span class="author vcard"><span class="fn">by <?php the_author(); ?></span></span>
				<span class="spacer">&bull;</span>-->
				<abbr class="published" title="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></abbr>
				<span class="spacer">&bull;</span>
				
				<?php comments_popup_link(__('No comments', 'carrington-business'), __('1 comment', 'carrington-business'), __('% comments', 'carrington-business')); ?>
			</div>
			
			<?php
			
			the_excerpt();
			?>
		</div>
		<div class="entry-footer">
			<?php _e('In', 'carrington-business'); ?>
			<?php
			the_category(', ');
			the_tags(__(' <span class="spacer">&bull;</span> Tagged ', 'carrington-business'), ', ', '');
			?>
		</div>
		<?php edit_post_link(__('Edit', 'carrington-business')); ?>
	</div>
	
	<?php endwhile;
	
	/* Restore original Post Data 
	 * NB: Because we are using new WP_Query we aren't stomping on the 
	 * original $wp_query and it does not need to be reset.
	*/
	wp_reset_postdata();
	
	?>
		
	<div class="pagination">
		<span class="next"><a href="/powder-burns" title="Next Page">More Powder Burns</a></span>
	</div>
	
				
	<a href="http://www.rifleshootermag.com/rupp-on-rifles/">
		<img src="http://www.rifleshootermag.com/files/2013/03/powder-burns-blog.jpg" class="cfct-mod-image " alt="RS-Rupp-on-rifles" title="RS-Rupp-on-rifles">
	</a>
	<div class="cfct-module cfct-heading">
		<h2 class="cfct-mod-title">Rupp On Rifles</h2>
	</div>
	<div class="cfct-module cfct-heading">
		<h6 class="cfct-mod-title" style="float:none;">With J. Scott Rupp</h6>
	</div>
		
	
	<?php

	$args = array(
		'category_name' => 'rupp-on-rifles',
		'posts_per_page' => 2
	);
	// The Query
	$the_query = new WP_Query( $args );
	
	// The Loop
	while ( $the_query->have_posts() ) :
		$the_query->the_post(); ?>
		
		<div id="post-excerpt-<?php the_ID(); ?>" <?php post_class('entry entry-excerpt clearfix') ?>>
		
		<div class="entry-summary">
			<?php
			if (has_post_thumbnail()) {
				echo '<a href="', the_permalink(),'">', the_post_thumbnail('post-thumbnail', array('class' => 'entry-img')), '</a>';
			}?>
			<div class="entry-info">
			
				<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
				<!--<span class="author vcard"><span class="fn">by <?php the_author(); ?></span></span>
				<span class="spacer">&bull;</span>-->
				<abbr class="published" title="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></abbr>
				<span class="spacer">&bull;</span>
				
				<?php comments_popup_link(__('No comments', 'carrington-business'), __('1 comment', 'carrington-business'), __('% comments', 'carrington-business')); ?>
			</div>
			
			<?php
			
			the_excerpt();
			?>
		</div>
		<div class="entry-footer">
			<?php _e('In', 'carrington-business'); ?>
			<?php
			the_category(', ');
			the_tags(__(' <span class="spacer">&bull;</span> Tagged ', 'carrington-business'), ', ', '');
			?>
		</div>
		<?php edit_post_link(__('Edit', 'carrington-business')); ?>
	</div>
	
	<?php endwhile;
	
	/* Restore original Post Data 
	 * NB: Because we are using new WP_Query we aren't stomping on the 
	 * original $wp_query and it does not need to be reset.
	*/
	wp_reset_postdata();
	
	?>		
			
			
	<div class="pagination">
		<span class="next"><a href="/rupp-on-rifles" title="Next Page">More Rupp On Rifles</a></span>
	</div>


</div>
<?php } else { ?>

	<?php if(is_category("powder-burns")){ ?>
		
		<div id="cfct-row-e79a6f8d1b12d7a2dec8704dd204538e" class="row-c6-12-3456 row cfct-row-a-bc cfct-row cfct-inrow-heading cfct-inrow-callout">
	<div class="cfct-row-inner"><div id="cfct-block-60529448c9a5c43b28409c4a0486bfcd" class="c6-12 cfct-block-a cfct-block block-0">
			<div class="cfct-module cfct-heading">
				<h2 class="cfct-mod-title">Powder Burns</h2>
			</div>
			<div class="cfct-module cfct-heading">
				<h6 class="cfct-mod-title">with Brad Fitzpatrick</h6>
			</div></div><div id="cfct-block-4ed6c2a976cf696ec22abbf1ae17726c" class="c6-3456 cfct-block-bc cfct-block block-1">
			<div class="cfct-module cfct-callout">
				<img width="634" height="100" src="http://www.rifleshootermag.com/files/2012/06/RS-Powder-Burns1.jpg" class="cfct-mod-image " alt="RS-Powder-Burns" title="RS-Powder-Burns"><div class="cfct-mod-content">
	</div>

			</div></div></div>
	</div>
		<div id="cfct-row-9f00881772ccb5aa96e78d7407039513" class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-rich-text cfct-inrow-divider">
		<div class="cfct-row-inner"><div id="cfct-block-f35075facbc685ae99bfd376fd4a8c01" class="c4-1234 cfct-block-abc cfct-block block-0">
				<div class="cfct-module cfct-rich-text">
					<div class="cfct-mod-content"><p><strong><a class="rss-subscribe" title="Subscribe to Powder Burns" href="http://rifleshootermag.com/?cat=743&amp;feed=rss2">Subscribe</a></strong><span class="twitter-follow-button">&nbsp;&nbsp; <iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/follow_button.1362636220.html#_=1362686836830&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=rifleshootermag&amp;show_count=false&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button twitter-follow-button" style="width: 156px; height: 20px;" title="Twitter Follow Button" data-twttr-rendered="true"></iframe><script type="text/javascript">// <![CDATA[
	!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
	// ]]&gt;</script></span></p></div>
				</div>
				<div class="cfct-module cfct-divider">
					<hr class="cfct-div-dotted">
				</div></div></div>
	</div>
		
	<?php } else if(is_category("rupp-on-rifles")){ ?>
		<div id="cfct-row-6723b70a3c0848d36fb4f11ff476fd72" class="row-c6-12-3456 row cfct-row-a-bc cfct-row cfct-inrow-heading cfct-inrow-callout">
	<div class="cfct-row-inner"><div id="cfct-block-55256b6b23e0213d69fec975369cbfb6" class="c6-12 cfct-block-a cfct-block block-0">
			<div class="cfct-module cfct-heading">
				<h2 class="cfct-mod-title">Rupp On Rifles</h2>
			</div>
			<div class="cfct-module cfct-heading">
				<h6 class="cfct-mod-title">with J. Scott Rupp</h6>
			</div></div><div id="cfct-block-0702329a7bc58a8d184236fa0d2cd08b" class="c6-3456 cfct-block-bc cfct-block block-1">
			<div class="cfct-module cfct-callout">
				<img width="638" height="100" src="http://www.rifleshootermag.com/files/2012/06/RS-Rupp-on-rifles.jpg" class="cfct-mod-image " alt="RS-Rupp-on-rifles" title="RS-Rupp-on-rifles"><div class="cfct-mod-content">
	</div>

			</div></div></div>
</div>	
		<div id="cfct-row-3e9ac529b8e4131668aee1c95d6dfa08" class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-rich-text cfct-inrow-divider">
	<div class="cfct-row-inner"><div id="cfct-block-1b67ccb66b3caa64bd9b4c116040728a" class="c4-1234 cfct-block-abc cfct-block block-0">
			<div class="cfct-module cfct-rich-text">
				<div class="cfct-mod-content"><p><strong><a class="rss-subscribe" title="Subscribe to Rupp on Rifles" href="http://rifleshootermag.com/?cat=744&amp;feed=rss2">Subscribe</a></strong><span class="twitter-follow-button">&nbsp;&nbsp; <iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/follow_button.1362636220.html#_=1362686898331&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=rifleshootermag&amp;show_count=false&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button twitter-follow-button" style="width: 156px; height: 20px;" title="Twitter Follow Button" data-twttr-rendered="true"></iframe><script type="text/javascript">// <![CDATA[
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
// ]]&gt;</script></span></p></div>
			</div>
			<div class="cfct-module cfct-divider">
				<hr class="cfct-div-dotted">
			</div></div></div>
</div>
			<?php }else{ ?>
	<header id="masthead">
		<h1><?php single_cat_title(''); ?></h1>
	</header><!-- #masthead -->
	<?php } ?>
<div class="col-ab">
	<?php
	cfct_loop();
	cfct_misc('nav-posts');
	?>
	
	
	<?php if(is_category("powder-burns")){ ?>


		<div class="cfct-module cfct-heading">
				<h1 class="cfct-mod-title">Brad Fitzpatrick</h1>
			</div>
			
		<div class="cfct-module cfct-callout">
				<img width="150" height="150" src="http://www.rifleshootermag.com/files/2012/06/Brad-Fitzpatrick-150x150.jpg" class="cfct-mod-image  cfct-image-left" alt="Brad Fitzpatrick" title="Brad Fitzpatrick"><div class="cfct-mod-content">
	<p>Powder Burns takes an in-depth look at the latest developments in rifle shooting and offers expert advice on different aspects of the sport, from which rifle to choose for a Colorado elk hunt to the proper method to clean a fouled barrel. We'll examine the latest trends in rifles and gear, share advice from experts in the field and share tips and techniques to make you a better shooter.</p>
</div>

			</div>	
	<?php } else if(is_category("rupp-on-rifles")){ ?>
		<div class="cfct-module cfct-heading">
				<h1 class="cfct-mod-title">J. Scott Rupp</h1>
			</div>
			
			
					<div class="cfct-module cfct-callout">
				<img width="150" height="150" src="http://www.rifleshootermag.com/files/2012/06/Scott-Rupp-150x150.jpg" class="cfct-mod-image  cfct-image-left" alt="Scott-Rupp" title="Scott-Rupp"><div class="cfct-mod-content">
	<p>The editor's blog for Rifle Shooter, J. Scott Rupp keeps us current on the hottest trends and happenings from the world of Rifles.</p>
</div>

			</div>
	<?php } ?>
</div>
<?php }
get_sidebar();
get_footer();

?>