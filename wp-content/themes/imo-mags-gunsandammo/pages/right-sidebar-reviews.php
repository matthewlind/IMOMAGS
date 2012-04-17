<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post(); ?>

<div class="page-template-page-right-php right-sidebar-landing">

  <header id="masthead">
    <h1><?php //the_title(); ?></h1>
  </header>
  <div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('reviews_sidebar')) : else : ?><?php endif; ?>
	</div>
	<div id="content">
		<div <?php post_class('entry entry-full'); ?>>
			<div class="entry-content">
				<div class="cfct-module cfct-html section-title posts">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
  								<span>Reviews</span>
						</h4>
					</div>
				</div>
				<?php
		$args = array(
	'tax_query' => array(
		array(
			'taxonomy' => 'gun-types',
			'field' => 'slug',
			'terms' => 'gun-types'
		)
	)
);	

// The Query
$the_query = new WP_Query( $args );

// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post();
	//the_thumbnail();
	the_title();

endwhile;

// Reset Post Data
wp_reset_postdata();



				the_content(__('Continued&hellip;', 'carrington-business'));
				wp_link_pages(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>