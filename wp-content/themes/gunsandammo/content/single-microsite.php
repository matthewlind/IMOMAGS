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
?>

<div id="fb-root"></div>
<div class="sponsors-disclaimer">
	<span>BROGHT TO YOU BY VISTA OUTDOOR INC. AND ITS FAMILY OF <a href="#">BRANDS</a></span>
</div>
<div class="article-wrap clearfix">
	<div class="article-image" style="background-image: url('/wp-content/themes/gunsandammo/images/shoot101/shooter-photo.jpg');">
		
	</div>
	<article class="article clearfix">
			<div class="m-social-buttons">
				<ul>
					<li><a class="icon-facebook" target="_blank" href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo urlencode(the_title());?>&amp;p[summary]=<?php echo urlencode(the_title()) ?>&amp;p[url]=<?php echo urlencode(get_permalink()); ?>&amp;p[images][0]=<?php echo urlencode($image[0])?>" ></a></li>
					<li><a href="http://twitter.com/intent/tweet?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>" class="icon-twitter" target="_blank"></a></li>
					<li><a class="icon-mail" target="_blank"></a></li>
				</ul>
			</div>
		
		<h1>SIGHTING SOLUTIONS: 10 GREAT OPTICS AT EVERY PRICE POINT</h1>
		<h3>HIT THE BULLSEYE WITHOUT HITTING YOUR WALLET</h3>
		<span class="a-author">Peter Wolf</span>
		<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.</p>
		<blockquote>
			Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip
		</blockquote>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. </p>
<?php the_content(); ?>

		
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	</article>
</div><!-- end .article-wrap -->


























<?php echo get_template_part( 'footer', 'shoot101' ); ?>