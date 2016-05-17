<?php	
	$cat 			= get_query_var('cat');
	$this_cat 		= get_category($cat);
	$this_cat_slag 	= $this_cat->slug;
	$this_cat_id	= $this_cat->term_id;
	$term_cat_id 	= 'category_'.$this_cat_id;
	
	$social_share_message 	= get_field('social_share_message', $term_cat_id);
	
	if ($this_cat_slag == 'crossbows') $this_cat_slag = 'crossbow-revolution';
?>

<div class="content">
	<div class="posts-wrap" id="posts_wrap">
		<?php // html generated here is in file:///data/wordpress/imomags/wp-content/themes/imo-mags-parent/functions/microsites/ajax-load-posts.php ?>		
		<?php if ($dartDomain == "imo.gameandfish") { include(get_template_directory() . '/content/microsite-category/related-microsite.php'); } else { }?>
	</div><!-- end .posts-wrap -->
</div><!-- end .content -->