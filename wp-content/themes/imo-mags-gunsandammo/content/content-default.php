<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

// Let's get the Primary Category
$postID = get_the_ID();
$categoryID = get_post_meta($postID);
$catID = $categoryID["_category_permalink"];
$categoryName = get_term_by('id', $catID[0], 'category');
$byline = get_post_meta($postID, 'ecpt_byline', true);
//set the primary category urls
$url="/shooting/".$categoryName->slug;

?>
<div <?php post_class('entry entry-full clearfix') ?>>
	<div class="entry-header">
		<?php
		if(in_category("shot-show-2013")){
			echo '<div class="primary-shot-show">';
				echo primary_and_secondary_categories("/shooting");	
		}else if(has_tag("nra-show")){ ?>
		<div class="blog-headers shot-show nra-show">
			<div class="blog-border"></div>
			<h1>NRA SHOW 2013</h1>
			
			<div class="presented-by">Presented By</div>
			<div class="desc">G&A brings you all the guns, gear and politics from the floor of the 2013 NRA Annual Meetings in Houston, Texas.  </div>
			<div class="sponsor-logo" style="">
				<!-- Site - Guns and Ammo -->
				<script type="text/javascript">
				  var ord = window.ord || Math.floor(Math.random() * 1e16);
				  document.write('<a href="http://ad.doubleclick.net/N4930/jump/imo.gunsandammo;sz=200x48;ord=' + ord + '?"><img src="http://ad.doubleclick.net/N4930/ad/imo.gunsandammo;sz=200x48;ord=' + ord + '?" width="200" height="48" /></a>');
				</script>
				<noscript>
				<a href="http://ad.doubleclick.net/N4930/jump/imo.gunsandammo;sz=200x48;ord=[timestamp]?">
				<img src="http://ad.doubleclick.net/N4930/ad/imo.gunsandammo;sz=200x48;ord=[timestamp]?" width="200" height="48" />
				</a>
				</noscript></div>
				
		</div>
		<?php echo primary_and_secondary_categories("/shooting"); ?>
		<?php }else{
			echo primary_and_secondary_categories("/shooting");	
		}

		// If we're not showing this particular single post page, link the title
		$this_post_is_not_single = (!is_single(get_the_ID()));
		if ($this_post_is_not_single) { ?>
			<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php
		} else {
		?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php
		}
		?>
		<div class="entry-info">
            <?php if (! in_category("What's Biting Now")): ?>
			<span class="author vcard"><span class="fn">by <?php the_author_link(); ?></span></span>
			<span class="spacer">|</span>            <?php endif; ?>
			<time class="published" datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time>
			<?php if(function_exists('wp_print')) { ?>
			<span class="spacer">|</span>
			<?php print_link(); } ?>
			<div class="post-byline"><?php echo $byline; ?></div>
		</div>
		<a class="comment-count" href="#idc-container"><?php echo get_comments_number(); ?></a>
	</div>
	<?php if (function_exists('imo_add_this')) {imo_add_this();} ?>
	<div class="entry-content">
		<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>
	</div>
  <!-- <div class="entry-footer">
    <?php _e('In', 'carrington-business'); ?>
    <?php
    the_category(', ');
    the_tags(__(' <span class="spacer">&bull;</span> Tagged ', 'carrington-business'), ', ', '');
    wp_link_pages();
    ?>
  </div> -->
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
</div>