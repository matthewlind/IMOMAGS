<?php

/**
 * Taxonomy Archive with No Featured Content
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


<div class="col-abc taxonomy-col-abc">


<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div id="category-content">
	<?php
       cfct_excerpt();
	?>
	</div>

 <?php endwhile; else: ?>
 <h3>No posts matching that criteria exist.</h3>
 <?php endif;?>


</div> <!-- end div col-abc-->
</div> <!-- end class="page-template-page-right-php" -->
<?php
get_footer();
?>