<?php
/**
 * Template Name: Shoot101
 * Description: A page template for shoot101 articles
 */

echo get_template_part( 'header', 'shoot101' ); 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );	
	$postID = get_the_ID();
	$byline = get_post_meta($postID, 'ecpt_byline', true);
	$acf_byline = get_field("byline",$postID); 
?>
<div class="sponsors-disclaimer">
	<span>BROGHT TO YOU BY VISTA OUTDOOR INC. AND ITS FAMILY OF <a href="#">BRANDS</a></span>
</div>
<div class="m-article-wrap clearfix">
	<div class="m-article-image" style="background-image: url('<?php echo $image[0]; ?>');">
		
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
<div class="m-more">
	<h2>More Stories</h2>
	<div class="m-more-wrap clearfix">
		<?php
		$args = array (
			'category_name'         	=> 'shoot101',			
			'posts_per_page'      		=> 6,
			'order'						=> 'DESC',
			'orderby'					=> 'rand'
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();								
				$image_id = get_post_meta(get_the_ID(),"image", true);
				$image = wp_get_attachment_image_src($image_id, "large");
		?>
		<a class="link-box" href="<?php the_permalink(); ?>">	
			<div class="post-box" style="background-image: url('<?php echo $image[0]; ?>')"></div>
		</a>
		<?php
				}
			} else {
				echo "not found";
			}
			wp_reset_postdata();
		?>
	</div><!-- end .m-more-wrap -->
</div><!-- end .m-more -->






<?php echo get_template_part( 'footer', 'shoot101' ); ?>