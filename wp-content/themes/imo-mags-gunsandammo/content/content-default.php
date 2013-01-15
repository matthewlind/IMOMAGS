<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

// Let's get the Primary Category (Hikari Plugin)
$postID = get_the_ID();
$categoryID = get_post_meta($postID);
$catID = $categoryID["_category_permalink"];
$categoryName = get_term_by('id', $catID[0], 'category'); 

//set the primary category urls
$url="/shooting/".$categoryName->slug;

?>
<div <?php post_class('entry entry-full clearfix') ?>>
	<div class="entry-header">
		<?php 
		if(in_category("shot-show-2013")){
			echo '<div class="primary-shot-show">'; 
				echo '<a class="primary-cat" href="'.$url.'">'.$categoryName->name.'</a>'; 
				echo '<div class="presented-by">Presented By</div>'; 
					echo '<div class="sponsor-logo">'; 
						echo '<a href="http://resources.springfield-armory.com/" target="_blank"><img src="/wp-content/themes/imo-mags-gunsandammo/img/sausa.png" alt="Springfield Amory USA" title="Springfield Amory USA" /></a>'; 
					echo '</div>'; 
				echo '</div>'; 
		}else{
			echo '<a class="primary-cat" href="'.$url.'">'.$categoryName->name.'</a>'; 
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
			<span class="spacer">|</span>
            <?php endif; ?>
			<time class="published" datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time>
			<?php if(function_exists('wp_print')) { ?>
			<span class="spacer">|</span>
			<?php print_link(); } ?>
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