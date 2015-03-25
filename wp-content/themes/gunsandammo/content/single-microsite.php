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
		<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.
		</p>
		<div id="attachment_30512" class="wp-caption alignright" style="width: 300px">
			<div class="m-buy-mag">
				<h2>NOW AVAILABLE ON NEWSSTANDS!</h2>
				<div class="m-buy-mag-bottom">
					<div class="m-buy-mag-img"></div>
					<a></a>
					<a></a>
				</div>
			</div>
			<a href="http://www.gunsandammo.artem/files/2015/01/springfield_armory_xd9_mod-2_f.jpg">
				<img class="wp-image-30512 size-medium" src="http://www.gunsandammo.artem/files/2015/01/springfield_armory_xd9_mod-2_f-300x225.jpg" alt="springfield_armory_xd9_mod-2_f" width="300" height="225">
			</a>
			<p class="wp-caption-text">Align Right caption text</p>
		</div>
		<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.
		</p>
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