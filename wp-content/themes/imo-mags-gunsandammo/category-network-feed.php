<?php

/**
 * G&A VERSION
 * COPY THIS TEMPLATE TO THE THEME TO OVERRIDE!!!!!
 *  COPY THIS TEMPLATE TO THE THEME TO OVERRIDE!!!!!
 *   COPY THIS TEMPLATE TO THE THEME TO OVERRIDE!!!!!
 *    COPY THIS TEMPLATE TO THE THEME TO OVERRIDE!!!!!
 *     COPY THIS TEMPLATE TO THE THEME TO OVERRIDE!!!!!
 *      COPY THIS TEMPLATE TO THE THEME TO OVERRIDE!!!!!
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
<div class="page-template-page-right-php category-page">

	<div id="sidebar" class="bonus-background">
		<div class="sidebar">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
		</div>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php imo_dart_tag("300x250",false,array("pos"=>"btf")); ?>
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : ?><?php endif; ?>
		</div>
	</div>


	<div id="content" class="col-ab">





		<?php if ($fullWidthImage != "") { ?>
			<h1 class="category-header-image"><img alt="<?php single_cat_title(''); ?>" class="full-width-header" src="<?php echo $imageURL; ?>"><span style="display:none;"><?php single_cat_title(''); ?></span></h1>

		<?php } else { ?>


				<?php if ($imageURL): ?>
					<div class="header-bonus" style="background-repeat: no-repeat;height: 120px; background-image:url('<?php echo $imageURL; ?>');">
						<!-- <img src="<?php echo $imageURL; ?>"> -->
					</div>
				<?php endif; ?>
			<div class="header-info <?php echo $h1Class; ?>">

				<div class="section-title posts" style="width:648px;">
					<div class="cfct-mod-content">
						<h4>
								<div class="icon"></div>
									<span><?php single_cat_title('');?></span>
						</h4>
						<div class="description"> <?php echo category_description(); ?></div>
					</div>
				</div>




			</div>

		<?php } ?>



	<?php

		if (!$useNetworkFeed) {
			cfct_loop();
			cfct_misc('nav-posts');
		} else {


			?>
				<div class="category-cross-site-feed" term="<?php echo $categorySlug; ?>"><!-- This term= attribute is searched for by displayCrossSiteFeed() in cross-site-feed.js --></div>
				<div class="category-cross-site-feed-more-button" style="">
					<div class="more-button button btn" style="">
						<span class="">Load More <?php single_cat_title(''); ?> Articles<span></span></span>
					</div><span class="load-spinner" style="display:none;"><img src="/wp-content/themes/carrington-business/img/spiffygif_20x20.gif"> Loading...</span>
				</div>


<article id="category-excerpt-template" class="post-18066 post type-post status-publish format-standard hentry category-home-featured category-military-law-enforcement entry entry-excerpt has-img" style="display:none;">

					<a href="http://www.gunsandammo.deva/2012/12/07/ga-retrospective-pearl-harbor-71-years-later/">

						<img width="226" height="147" src="http://www.gunsandammo.deva/files/2012/12/000_Pearl-Harbor-226x147.jpg" class="entry-img wp-post-image" alt="000_Pearl-Harbor" title="000_Pearl-Harbor" /></a>



	<div class="entry-summary">
	    <span class="cat-feat-label entry-category"><a class="category-name-link" onclick="_gaq.push([&#39;_trackEvent&#39;,&#39;Category&#39;,&#39;Military &amp; Law Enforcement&#39;]);" href="/shooting/military-law-enforcement">Military &amp; Law Enforcement</a> </span>		<h2 class="entry-title"><a rel="bookmark" href="http://www.gunsandammo.deva/2012/12/07/ga-retrospective-pearl-harbor-71-years-later/">G&#038;A Retrospective: Pearl Harbor 71 Years Later</a></h2>
		<span class="entry-category"><span style="color:#CE181E;" class="author">December 7, 2012</span></span>
		<p class="entry-content">Dec. 7, 2012, marks 71 years since the Japanese attack on Pearl Harbor. The unity, innovation and perseverance that followed<a href="http://www.gunsandammo.deva/2012/12/07/ga-retrospective-pearl-harbor-71-years-later/">&#8230;&raquo;</a></p>
	</div>

  <a class="comment-count" href="http://www.gunsandammo.deva/2012/12/07/ga-retrospective-pearl-harbor-71-years-later/#comments">0</a>
</article>


			<?php

		}

	?>


	</div>

<?php get_footer(); ?>
