<?php	
	$cat 			= get_query_var('cat');
	$this_cat 		= get_category($cat);
	$this_cat_slag 	= $this_cat->slug;
	$this_cat_id	= $this_cat->term_id;
	$term_cat_id 	= 'category_'.$this_cat_id;
	
	$social_share_message 	= get_field('social_share_message', $term_cat_id);
	$sponsors_disclaimer 	= get_field('sponsors_disclaimer', $term_cat_id);

?>

<?php if( in_array( 'sponsors_disclaimer', get_field('additional_elements', $term_cat_id) ) ) { ?>
<div class="sponsors-disclaimer">
	<span><?php echo $sponsors_disclaimer;?></span>
</div>
<?php } ?>

<div class="content">
	<div class="posts-wrap" id="posts_wrap">
		
		<?php if ($dartDomain == "imo.gameandfish") { include(get_template_directory() . '/content/microsite-category/related-microsite.php'); } else { }?>
	</div><!-- end .posts-wrap -->
</div><!-- end .content -->