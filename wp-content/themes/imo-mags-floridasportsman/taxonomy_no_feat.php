<?php

/**
 * Results Page for Best Boat
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

$term = get_queried_object();
$term_id = $term->term_id;
$term_slug = $term->slug;
$taxonomy = $term->taxonomy;
?>

<?php get_header(); ?>

<header id="masthead">

	<h1>Your Best Boat<br/><span style="font-size:14px;"><?php if (isset($_GET['where'])) {
$taxonomy = 'where';
$queried_term = get_query_var($taxonomy);
$terms = get_terms($taxonomy, 'slug='.$queried_term);
if ($terms) {
  foreach($terms as $term) {
    echo 'for ' . $term->name . '';
  }
}
}
?> <?php if (isset($_GET['price'])) {
$taxonomy = 'price';
$queried_term = get_query_var($taxonomy);
$terms = get_terms($taxonomy, 'slug='.$queried_term);
if ($terms) {
  foreach($terms as $term) {
    echo 'with a price range of ' . $term->name . '';
  }
}
 } ?></span></h1>
 
</header><!-- #masthead -->

<div class="page-template-page-right-php taxonomy-page bw-fullwidth">
	<div class="bonus-background">
		<div class="bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('blog-sidebar')) : else : ?><?php endif; ?>
		</div>
	</div>

	<?php
	global $wp_query;
		$args = array(
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'column',
				'field' => 'slug',
				'terms' => 'bb-featured',
			)
		)
	);
	$args = array_merge( $wp_query->query, $args );
	$the_query = new WP_Query( $args );

	// The Loop
	if ($the_query->have_posts()) {?>
	<div class="col-abc taxonomy-col-abc">
	<?php while ( $the_query->have_posts() ) : $the_query->the_post();?>
	<div id="category-content">
	<?php
       cfct_excerpt();
	?>
	</div>
	
	<?php wp_reset_postdata(); endwhile;?>
	</div>
	<hr/><br/>
	<?php } else { ?>
	<!--Nothing found!-->
	<?php } ?>
	
<div class="col-abc taxonomy-col-abc">

	<?php
	global $wp_query;
		$args = array(
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'column',
				'field' => 'slug',
				'terms' => 'bb-featured',
				'operator' => 'NOT IN'
			)
		)
	);
	$args = array_merge( $wp_query->query, $args );
	$the_query = new WP_Query( $args );

	// The Loop
	if ($the_query->have_posts()) { while ( $the_query->have_posts() ) : $the_query->the_post();?>
	
	<div id="category-content">
	<?php
       cfct_excerpt();
	?>
	</div>
	
	<?php wp_reset_postdata();

	endwhile;}?>


</div> <!-- end div col-abc-->
</div> <!-- end class="page-template-page-right-php" -->
<?php
get_footer();
?>