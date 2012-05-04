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

<header id="masthead">
	<h1><?php wp_title_multitax('');?></h1>
</header><!-- #masthead -->

<div class="page-template-page-right-php taxonomy-page bw-fullwidth">
	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('blog-sidebar')) : else : ?><?php endif; ?>
		</div>
	</div>


<div class="col-abc taxonomy-col-abc">



<?php
/*$table = mysql_query("SELECT * FROM wp_redirect_items");
while($row = mysql_fetch_object($table)){
	
	print_r($row);
	echo "<br>";
} */
$term = get_queried_object();
$term_id = $term->term_id;
$term_slug = $term->slug;
$taxonomy = $term->taxonomy;

?>

<?php
/*
$args = array(
	$taxonomy => $term_slug,
	'paged' => get_query_var('paged'),
	'posts_per_page' => 30,

);
*/


//?activity=activity-fishing&region=region-keys&column=

$qs = wp_parse_args($query_string);

$activity = $qs['activity'];
$region = $qs['region'];
$column = $qs['column'];
$gear = $qs['gear'];
$location = $qs['location'];
$species = $qs['species'];
$campaign = $qs['campaign'];
$show = $qs['show'];
$marketplace = $qs['marketplace'];
$blog = $qs['blog'];
$page = $qs['paged'];




$args = array(	
	'paged' => $page ? $page : get_query_var('page'),
	'posts_per_page' => 20,
	'activity' => $activity,
	'column' => $column,
	'region' => $region,
	'gear' => $gear,
	'location' => $location,
	'species' => $species,
	'campaign' => $campaign,
	'show' => $show,
	'marketplace' => $marketplace,
	'blog' => $blog

); 


$posts_array = query_posts($args);


$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$count = 0;

$items = array();
$item = array();


?> 
<?php while (have_posts()) : the_post(); ?> 

<?php 

	$count++;



	
	if ($count <= 4 && $paged == 1 && count($posts_array) >= 4) {//If we are on the first page, show the featured thumbs followed by regular loop.
		
		
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
		
		
		       
		if ($count == 4) {
			
			?>
			
			<div class="taxonomy-featured-container">
				
				<div class='taxonomy-right-box widget' style="">
					<h2 class="widget-title">Trending Now</h2>
					
					<ul>
					
					<?php
					$args = array(
						$taxonomy => $term_slug,
						"posts_per_page" => 10,
						"orderby" => "comment_count",
						
					);
					
					
					
					// The Query
					$the_query = new WP_Query( $args );
					
					// The Loop
					while ( $the_query->have_posts() ) : $the_query->the_post();
						$url = get_permalink();
						$title = the_title(null,null,FALSE);
						echo "<li><a href='$url'>$title</a></li>";

					endwhile;
					
					// Reset Post Data
					wp_reset_postdata();
					
					
					?>
					
					</ul>
					
				</div>
			
				<div class='featured-articles'>
					<?php
					
					$itemCount = 0;
					foreach($items as $item) {//First create the big images
						
						$itemCount++;
						?>
						
						<div class='featured-item-pane' id='featured-item-<?php echo $itemCount; ?>'>
							<div class='featured-item-image'>
							   <img src="<?php echo $item['img_src'][0]; ?>"/>
							</div>
							<div class='featured-item-description'>
							  <h2><a href="<?php echo $item['link']; ?>"><?php echo $item['title']; ?></a></h2>
							</div>
						</div>
						
						<?php
				
					}
					
					
					?>
					<ul id='featured-articles-navigator'>	
						<?php
						
						
						$itemCount = 0;
						foreach($items as $item) {//Then make the thumbs.
							
							$itemCount++;
					
							if ($itemCount == 1)
								$listClass = "class='first'";
							else
								$listClass = "";
							
							?>
								<li <?php echo $listClass; ?>>
									<a href="#featured-item-<?php echo $itemCount; ?>">
										<img src='<?php echo $item['img_src_thumb'][0]; ?>'/>
									</a>
								</li>
							
							<?php
						
						}			
						
						?>
					</ul>
				</div>
			
			</div>  <!-- End taxonomy-featured-containter -->

<hr>
			<?php
			
			
		}
       
	} else {//If not on first
		?>
		<div id="category-content">
		<?php
	       cfct_excerpt();
		?>
		</div>
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