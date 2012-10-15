<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }



$productName = get_post_meta($post->ID,"product_name",true);
$productDescription = get_post_meta($post->ID,"product_description",true);
$thumbnailID = get_post_meta($post->ID,"product",true);

$thumbnailImage = wp_get_attachment_image($thumbnailID,"thumbnail");




get_header(); ?>
<div class="entry-header">
	<h1 class="entry-title"><?php the_title() ?></h1>
	<div class="entry-info">
 		<abbr class="published" title="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></abbr>
 		<span class="author vcard"><span class="fn">by <?php the_author_link(); ?></span></span>
		<?php
		//if ($this_post_is_not_single) {
			echo ' <span class="spacer">&bull;</span> ';
			comments_popup_link(__('No comments', 'carrington-business'), __('1 comment', 'carrington-business'), __('% comments', 'carrington-business'));
		//}
		?>
	</div>
</div>

<div class="col-ab">
	<?php if (function_exists('imo_add_this')) {imo_add_this();} 
	echo $post->post_content; ?></p>
		
	<div class="caption-banner">
  		<div class="caption-banner-text">This Week's Photo</div>
	</div>

  	<div class="caption-contest">
	  
	  	<?php $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full"); ?>
	  	<img src="<?php echo $img_src[0]; ?>" class="wp-post-image" alt="<?php the_title(); ?>" />
	  
	  	<?php
		$commentID = get_post_meta($post->ID, '_buck_id', true);
		if ($commentID) : 
			$comment = get_comment($commentID); ?>
			<h2>The Winning Caption:</h2>
			<?php echo get_avatar($comment->comment_author_email, 60); ?>
			<div class="winning-caption">
				<div class="author"><?php echo $comment->comment_author; ?></div>
				<div class="caption"><?php echo $comment->comment_content; ?></div>
			</div>
		<?php endif; ?>
	
	</div>

	<div class="prize-box">
		<div class="prize-thumb">
			<?php echo $thumbnailImage; ?>
		</div>
		<h2>The Prize:</h2>
		<h4><?php echo $productName; ?></h4>
		<p><?php echo $productDescription; ?></p>
	</div>
	<?php comments_template(); ?>
</div>
<div class="bonus-background">
	<div class="bonus">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
	</div>
	<div id="responderfollow"></div>
	<div class="sidebar advert">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : ?><?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>
