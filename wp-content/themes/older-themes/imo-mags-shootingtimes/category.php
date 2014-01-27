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

// NOTE: this file is here for compatibility reasons - active templates are in the posts/ dir

if (CFCT_DEBUG) { cfct_banner(__FILE__); }

$h1Class = "";
$imageURL = false;

if (category_description()) {
	$h1Class = "has-category";
}

$categoryID = get_query_var('cat');

$this_category = get_category($cat);
$categorySlug =  $this_category->category_nicename;


$useNetworkFeed = get_option('use_network_feed_'.$categoryID, false);
$fullWidthImage = get_option('full_width_image_'.$categoryID, false);


if (function_exists('z_taxonomy_image_url'))
	$imageURL = z_taxonomy_image_url();

if ($imageURL)
	$h1Class .= " has-image";

get_header(); ?>
<div class="category-page">

	<div class="bonus-background">
		<div class="sidebar">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
		</div>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php imo_dart_tag("300x250",false,array("pos"=>"btf")); ?>
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : ?><?php endif; ?>
		</div>
	</div>


	<div class="col-ab">


		<header id="masthead" class="<?php echo $h1Class; ?>">


		<?php if ($fullWidthImage != "") { ?>
			<h1><img alt="<?php single_cat_title(''); ?>" class="full-width-header" src="<?php echo $imageURL; ?>"><span style="display:none;"><?php single_cat_title(''); ?></span></h1>

		<?php } else { ?>

				<?php if ($imageURL): ?>
					<div class="header-bonus" style="background-image:url('<?php echo $imageURL; ?>');">
						<!-- <img src="<?php echo $imageURL; ?>"> -->
					</div>
				<?php endif; ?>
			<div class="header-info <?php echo $h1Class; ?>">
				<h1 class="<?php echo $h1Class; ?>"><?php single_cat_title(''); ?></h1>
				<div class="description"> <?php echo category_description(); ?></div>
			</div>

		<?php } ?>

		</header>

	<?php

		if (!$useNetworkFeed) {
			cfct_loop();
			cfct_misc('nav-posts');
		} else {

			?>
				<div class="cross-site-feed" term="<?php echo $categorySlug; ?>"><!-- This term= attribute is searched for by displayCrossSiteFeed() in cross-site-feed.js --></div>
				<div class="cross-site-feed-more-button">
					<div class="more-button button btn">
						<span class="">Load More <?php single_cat_title(''); ?> Articles<span></span></span>
					</div><span class="load-spinner" style="display:none;"><img src="/wp-content/themes/carrington-business/img/spiffygif_20x20.gif"> Loading...</span>
				</div>


<article id="excerpt-template" class="post type-post status-publish format-standard hentry entry entry-excerpt has-img" style="display:none;">
<div class="entry-summary entry-summary-dynamic">
				<a href="http://www.shootingtimes.deva/2011/01/03/optics_optics_090706/"><img width="190" height="120" src="http://www.shootingtimes.deva/files/2010/09/stoptics_090706pl.jpg" class="entry-img wp-post-image" alt="stoptics_090706pl" title="stoptics_090706pl" /></a>		<div class="entry-info">
<div class="entry-category"><a href="http://www.bowhuntingmag.com" rel="category tag" target="_blank">From Petersen's Bowhunting Magazine</a> </div>
			<h2 class="entry-title"><a rel="bookmark" href="http://www.shootingtimes.deva/2011/01/03/optics_optics_090706/">How To Cope With A Cross-Eyed Rifle</a></h2>
			<!--
			-->

			<span class="author vcard"><span class="fn">by Hugh Birnbaum</span></span>


			<a href="http://www.shootingtimes.deva/2011/01/03/optics_optics_090706/#comments" rel="nofollow" title="Comment on How To Cope With A Cross-Eyed Rifle"> <span class="spacer">&bull;</span> <span class="dsq-postid" rel="2332 http://www.shootingtimes.com/2011/01/03/optics_optics_090706/"><span class="comment-count">3</span> comments</span></a>		</div>

		<p class="entry-content">Hugh explains how to cope with a rifle that has misaligned scope-mount holes.</p>
	</div>
	</article>


			<?php

		}

	?>


	</div>

<?php get_footer(); ?>
