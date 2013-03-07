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
	<a href="http://www.handgunsmag.com/blogs/carry-on/">
		<img src="http://www.handgunsmag.com/files/2013/03/carry-on.jpeg" class="cfct-mod-image " alt="Carry On Header" title="Carry On Header">
	</a>
	<div class="cfct-module cfct-heading">
		<h4 class="cfct-mod-title">Carry On</h4>
	</div>
	<div class="cfct-module cfct-heading jamestarr">
		<h5 class="cfct-mod-title">with James Tarr</h5>
	</div>
	
					
	<?php

	$args = array(
		'category_name' => 'carry-on',
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
		<span class="next"><a href="/blogs/carry-on" title="Next Page">More Carry On</a></span>
	</div>
	
	<a href="http://www.handgunsmag.com/blogs/sixguns-sagebrush/">
		<img src="http://www.handgunsmag.com/files/2013/03/sixguns-sagebrush.jpeg" class="cfct-mod-image " alt="SixgunsandSageBrush-613" title="SixgunsandSageBrush-613">
	</a>
	<div class="cfct-module cfct-heading sixguns-blog-page">
		<h3 class="cfct-mod-title">Sixguns &amp; Sagebrush</h3>
	</div>
	<div class="cfct-module cfct-heading sixguns-header-text-blogs-page">
		<h5 class="cfct-mod-title">with Bart Skelton</h5>
	</div>
	
	
	<?php

	$args = array(
		'category_name' => 'sixguns-sagebrush',
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
		<span class="next"><a href="/blogs/sixguns-sagebrush/" title="Next Page">More Sixguns &amp; Sagebrush</a></span>
	</div>
				
	<a href="http://www.handgunsmag.com/blogs/firing-line/">
		<img src="http://www.handgunsmag.com/files/2013/03/firing-line.jpeg" class="cfct-mod-image " alt="Firing Line" title="Firing Line">
	</a>			
	<div class="cfct-module cfct-heading">
		<h2 class="cfct-mod-title">Firing Line</h2>
	</div>
	<div class="cfct-module cfct-heading by-scottrupp-blogs">
		<h5 class="cfct-mod-title">by J. Scott Rupp</h5>
	</div>
		
	
	<?php

	$args = array(
		'category_name' => 'firing-line',
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
		<span class="next"><a href="/blogs/firing-line" title="Next Page">More Firing Line</a></span>
	</div>


</div>
<?php } else { ?>

	<?php if(is_category("firing-line")){ ?>
		<div id="cfct-row-6ee0d44926960ea5168d6a12b175ad58" class="row-c6-12-3456 row cfct-row-a-bc cfct-row cfct-inrow-heading cfct-inrow-callout">
	<div class="cfct-row-inner"><div id="cfct-block-bb7adf2569401f2dcc1f3a0725a59e86" class="c6-12 cfct-block-a cfct-block block-0">
			<div class="cfct-module cfct-heading">
				<h2 class="cfct-mod-title">Firing Line</h2>
			</div>
			<div class="cfct-module cfct-heading scottrupp">
				<h5 class="cfct-mod-title">with J. Scott Rupp</h5>
			</div></div><div id="cfct-block-b103ddd39b90342b569c052860753d48" class="c6-3456 cfct-block-bc cfct-block block-1">
			<div class="cfct-module cfct-callout firing-line-header">
				<div class="cfct-mod-content">
	</div>

			</div></div></div>
</div>
<div id="cfct-row-05fee1bfbc0ba685f9e1d0f29f9e4a6b" class="row-c4-1234 row cfct-row-abc cfct-row cfct-inrow-rich-text cfct-inrow-divider">
	<div class="cfct-row-inner"><div id="cfct-block-c5f23260fb3b02c10d111c93332a9ddd" class="c4-1234 cfct-block-abc cfct-block block-0">
			<div class="cfct-module cfct-rich-text">
				<div class="cfct-mod-content"><p><strong><a class="rss-subscribe" title="Subscribe to Firing Line" href="http://handgunsmag.com/?cat=829&amp;feed=rss2">Subscribe</a></strong><span class="twitter-follow-button">&nbsp;&nbsp;&nbsp; <iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/follow_button.1362636220.html#_=1362679629737&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=HandgunsMag&amp;show_count=false&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button twitter-follow-button" style="width: 150px; height: 20px;" title="Twitter Follow Button" data-twttr-rendered="true"></iframe><script type="text/javascript">// <![CDATA[
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
// ]]&gt;</script></span></p></div>
			</div>
			<div class="cfct-module cfct-divider">
				<hr class="cfct-div-solid">
			</div></div></div>
</div>
	

	<?php } else if(is_category("sixguns-sagebrush")){ ?>
		<div id="cfct-row-61847d54d24a703f764641df02e476c1" class="row-c4-12-34 row cfct-row-d-e cfct-row cfct-inrow-heading cfct-inrow-callout cfct-inrow-rich-text">
	<div class="cfct-row-inner"><div id="cfct-block-ba17768632f92ffd6e5d3f18ac32b827" class="c4-12 cfct-block-d cfct-block block-0">
			<div class="cfct-module cfct-heading">
				<h3 class="cfct-mod-title">Sixguns &amp; Sagebrush</h3>
			</div>
			<div class="cfct-module cfct-heading sixguns-header-text">
				<h5 class="cfct-mod-title">with Bart Skelton</h5>
			</div>
			<div class="cfct-module cfct-rich-text">
				<div class="cfct-mod-content"><p><strong><a class="rss-subscribe" title="Subscribe to Sixguns &amp; Sagebrush" href="http://handgunsmag.com/?cat=830&amp;feed=rss2">Subscribe</a></strong><span class="twitter-follow-button">&nbsp; </span><iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/follow_button.1362636220.html#_=1362679877372&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=Bart4570&amp;show_count=false&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button twitter-follow-button" style="width: 118px; height: 20px;" title="Twitter Follow Button" data-twttr-rendered="true"></iframe></p><script type="text/javascript">// <![CDATA[
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
// ]]&gt;</script></div>
			</div></div><div id="cfct-block-65a0a46a642e251a9b39df7c1fcd53da" class="c4-34 cfct-block-e cfct-block block-1">
			<div class="cfct-module cfct-callout sixgunsandsagebrush-header">
				<div class="cfct-mod-content">
	</div>

			</div></div></div>
</div>

			
			
			
			<?php } else if(is_category("carry-on")){ ?>

			
				<div id="cfct-row-d35e0379127ff468447e1e3389bc233e" class="row-c6-12-3456 row cfct-row-a-bc cfct-row cfct-inrow-heading cfct-inrow-callout cfct-inrow-rich-text">
	<div class="cfct-row-inner"><div id="cfct-block-4522d6443f46014e9483549889655fd8" class="c6-12 cfct-block-a cfct-block block-0">
			<div class="cfct-module cfct-heading">
				<h4 class="cfct-mod-title">Carry On</h4>
			</div>
			<div class="cfct-module cfct-heading jamestarr">
				<h5 class="cfct-mod-title">with James Tarr</h5>
			</div>
			<div class="cfct-module cfct-rich-text">
				<div class="cfct-mod-content"><p><strong><a class="rss-subscribe" title="Subscribe to Carry On" href="http://handgunsmag.com/?cat=829&amp;feed=rss2">Subscribe</a></strong><iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/follow_button.1362636220.html#_=1362680871481&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=TarrJames&amp;show_count=false&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button twitter-follow-button" style="width: 127px; height: 20px;" title="Twitter Follow Button" data-twttr-rendered="true"></iframe></p><script type="text/javascript">// <![CDATA[
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
// ]]&gt;</script></div>
			</div></div><div id="cfct-block-cca4c499b9489235ce09bd9b88cdd9e1" class="c6-3456 cfct-block-bc cfct-block block-1">
			<div class="cfct-module cfct-callout carryon-header">
				<div class="cfct-mod-content">
	</div>

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
	
	
		<?php if(is_category("firing-line")){ ?>
	
		<div class="cfct-module cfct-heading">
				<h1 class="cfct-mod-title">Scott Rupp</h1>
			</div>
		<div class="cfct-module cfct-callout">
				<img width="150" height="150" src="http://www.handgunsmag.fox/files/2012/02/scott-about-photo-150x150.jpg" class="cfct-mod-image  cfct-image-left" alt="scott-about-photo" title="scott-about-photo"><div class="cfct-mod-content cfct-content-medium">
					<p>The editor's blog for Handguns, J. Scott Rupp keeps us current on the hottest trends and happenings from the world of sidearms. </p>
					</div>

			</div>	
	<?php } else if(is_category("carry-on")){ ?>


		<div class="cfct-module cfct-heading">
			<h1 class="cfct-mod-title">James Tarr</h1>
		</div>
		<div class="cfct-module cfct-callout">
					<img width="150" height="150" src="http://www.handgunsmag.fox/files/2010/09/hg_james-tarr-champion_a-150x150.jpg" class="cfct-mod-image  cfct-image-left" alt="hg_james-tarr-champion_a" title="hg_james-tarr-champion_a"><div class="cfct-mod-content cfct-content-medium">
		<p>James Tarr has worked as a plainclothes and uniformed police officer, and has been a private investigator for the last 15 years, but the most dangerous thing he ever did was drive an armored car around Detroit for $6.49/hour. He carries a gun every day for the same reason he wears a seat belt while driving?the world is full of dangerous people.  </p>
		</div>
		</div>
	
	<?php } else if(is_category("sixguns-sagebrush")){ ?>
		<div class="cfct-module cfct-heading">
				<h1 class="cfct-mod-title">Bart Skelton</h1>
			</div>
			<div class="cfct-module cfct-callout">
				<img width="150" height="150" src="http://www.handgunsmag.fox/files/2012/02/bart-about-photo-150x150.jpg" class="cfct-mod-image  cfct-image-left" alt="bart-about-photo" title="bart-about-photo"><div class="cfct-mod-content cfct-content-medium">
					<p>Drawing on decades of experience, Bart Skelton brings us a southwestern point shooter's journal about sidearms loved and lost, whiskey spilt, and cigars smoked. He occasionally might talk about lawmen and outlaws too.  </p>
			</div></div>

	<?php } ?>
</div>
<?php }
get_sidebar();
get_footer();

?>