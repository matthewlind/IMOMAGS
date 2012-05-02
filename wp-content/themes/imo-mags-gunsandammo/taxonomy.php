<?php

/**
 * Generic Template for Taxonomy Archive
 * 
 *
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * **********************************************************************
 */


if (!is_admin()) {
	//Not sure if this actually works here...			
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('featured-thumbs-js',NULL,array('jquery','jquery-ui-core','jquery-ui-tabs'));
				
}

?>
<?php get_header(); ?>

<div class="page-template-page-right-php taxonomy-page">
	<h1 class="seo-h1"><?php single_cat_title('');?></h1>
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('reviews-sidebar')) : else : ?><?php endif; ?>
	</div>
	
	<div class="col-abc taxonomy-col-abc">
		<div class="section-title posts" style="width:648px;">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
  								<span><?php single_cat_title('');?></span>
						</h4>
					</div>
				</div>

<?php
$term = get_queried_object();
$term_id = $term->term_id;
$term_slug = $term->slug;
$taxonomy = $term->taxonomy;

?>

<?php

$args = array(
	$taxonomy => $term_slug,
	'paged' => get_query_var('paged'),
	'posts_per_page' => 90,

);

query_posts($args);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$count = 0;

$items = array();
$item = array();


?> 
<?php while (have_posts()) : the_post(); ?> 

<?php 
	$count++;


	$featuredPostCount = 4;

	if ($taxonomy == "guntype") {
		$featuredPostCount = 1;
	}

	
	if ($count <= $featuredPostCount && $paged == 1) {//If we are on the first page, show the featured thumbs followed by regular loop.
		
		
	    $item['title'] = get_the_title();
		$item['link'] = get_page_link();
		$item['id'] = get_the_id();
		
		$_img = $_img_id = null;
		$_img_id = get_post_meta($item['id'], '_thumbnail_id', true);
		if (!empty($_img_id) && $_img = wp_get_attachment_image_src($_img_id, "large-featured-thumb-x", false)) {
			$item['img_src'] = $_img;
			$item['img_src_thumb'] = wp_get_attachment_image_src($_img_id, "small-featured-thumb-x", false);
		}
		
		
		$items[$count] = $item;
		
		
		       
		if ($count == 1) {
			
						$args = array(
						$taxonomy => $term_slug,
						"posts_per_page" => 7,
						"orderby" => "comment_count",
						
					);
					
					// The Query
					$the_query = new WP_Query( $args );
					
					// The Loop
					while ( $the_query->have_posts() ) : $the_query->the_post();
						$url = get_permalink();
						$title = the_title(null,null,FALSE);
						//echo "<li><a href='$url'>$title</a></li>";

					endwhile;
					
					// Reset Post Data
					wp_reset_postdata();
					
					
					?>
					
		<div class='featured-wide-articles'>

	<?php if (!empty($items)) {
			$count = 0;
			foreach ($items as $key => $item) {
				
				$count++;
				
				
				?>
					<div class='featured-item-pane' id='featured-item-<?php echo $count; ?>'>
						<div class='featured-item-image'>
						   <a href="<?php echo $item['link']; ?>"><img style="width:648px;height:auto;" src="<?php echo $item['img_src'][0]; ?>"/></a>
						</div>
						<div class='featured-item-description'>
						  <h2><a href="<?php echo $item['link']; ?>"><?php echo $item['title']; ?></a></h2>
						</div>
					</div>
				
				<?php
				
				
			}
		}
	?>
	</div><!-- end feature -->  
								
<hr>
<div class="c4-1234 cfct-block-abc cfct-block block-0">
			<div class="cfct-module cfct-html section-title posts">
				<div class="cfct-mod-content"><h4>
  						<div class="icon"></div>
  						<span>Latest Reviews</span>
				</h4></div>
			</div>	
	
		<?php
						
		}
       
	} else {//If not on first
		?>
		<li class="page-reviews">
		<?php if (has_post_thumbnail()) :
		echo '<a href="', the_permalink(),'">', the_post_thumbnail('post-thumbnail', array('class' => 'entry-img')), '</a>'; ?>
		<?php endif; ?>
		<a class="title" rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title() ?></a><br />
		<a class="comments" href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
		</li>

		<?php
	}
		
?> 

<?php endwhile;?>

<?php cfct_misc('nav-posts'); ?>
</div> <!-- end div col-abc-->
</div> <!-- end class="page-template-page-right-php" -->

<?php
get_footer();
?>