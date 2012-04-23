<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }



$productName = get_post_meta($post->ID,"product_name",true);
$productDescription = get_post_meta($post->ID,"production_descfription",true);
$thumbnailID = get_post_meta($post->ID,"product",true);

$thumbnailData = wp_get_attachment_image($thumbnailID,"thumbnail");
print_r($thumbnailID);
print_r($thumbnailData);


get_header(); ?>
<div id="content" class="col-abc">
  <div <?php post_class('entry entry-full clearfix') ?>>
  	<div class="entry-header">
			<h1 class="entry-title"><?php the_title() ?></h1>
  		<div class="entry-info">
  			<span class="author vcard"><span class="fn">by <?php the_author_link(); ?></span></span>
  			<span class="spacer">|</span>
  			<time class="published" datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time>
  		</div>
  		<a class="comment-count" href="<?php comments_link(); ?>"><?php comments_number('0', '1', '%'); ?></a>
  	</div>
  	<div class="entry-content"><p>
  		<?php echo $post->post_content; ?></p>
  		
  		<div class="caption-banner">
        <div class="caption-banner-text">This Month's Photo</div>
        
      </div>

      <div class="caption-contest">
  		  
  		  <?php $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full"); ?>
		    <img src="<?php echo $img_src[0]; ?>" class="wp-post-image" alt="<?php the_title(); ?>" />
  		  
  		  <?php
  		  $commentID = get_post_meta($post->ID, '_caption_id', true);
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

  	</div>
    <!-- <div class="entry-footer">
      <?php the_tags(__('Tagged ', 'carrington-business'), ', ', '');
      wp_link_pages(); ?>
    </div> -->
  </div>
  <?php comments_template(); ?>
</div>
<div id="sidebar">
  <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-video')) : else : ?><?php endif; ?>
</div>

<?php get_footer(); ?>
