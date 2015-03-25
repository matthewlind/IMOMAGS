<?php
/**
 * Template Name: Shoot101
 * Description: A page template for shoot101 articles
 */

echo get_template_part( 'header', 'shoot101' ); 
 
/*
	$parrent_id = wp_get_post_parent_id( $post_ID ); 
	$post_slug = $post->post_name;
*/

	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
	
	$postID = get_the_ID();
	$byline = get_post_meta($postID, 'ecpt_byline', true);
	$acf_byline = get_field("byline",$postID); 
?>

<div id="fb-root"></div>
<div class="sponsors-disclaimer">
	<span>BROGHT TO YOU BY VISTA OUTDOOR INC. AND ITS FAMILY OF <a href="#">BRANDS</a></span>
</div>
<div class="m-article-wrap clearfix">
	<div class="m-article-image" style="background-image: url('/wp-content/themes/gunsandammo/images/shoot101/shooter-photo.jpg');">
		
	</div>
	<article class="m-article clearfix">
		<?php echo get_template_part("content/social", "buttons"); ?>
		<h1><?php the_title();?></h1>
		<h3>HIT THE BULLSEYE WITHOUT HITTING YOUR WALLET</h3>
		<span class="m-post-byline">Words by Peter Wolf &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</span><?php if ($acf_byline) { ?><span class="m-post-byline">Photos by <?php echo $acf_byline;?></span><?php } ?>
		<?php the_content(); ?>
		<?php echo get_template_part("content/social", "buttons"); ?>
	</article>
</div><!-- end .m-article-wrap -->
<div class="m-more-wrap">
	
</div>






<?php echo get_template_part( 'footer', 'shoot101' ); ?>