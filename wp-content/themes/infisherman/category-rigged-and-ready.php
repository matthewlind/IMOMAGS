<?php get_header(); ?>

				
				
				<h1>url: <?php bloginfo('url'); ?></h1>
				<h1>uri: <?php echo get_template_directory_uri(); ?></h1>
				<h1>get_template: <?php echo get_template() ?></h1>
				
				
				<p><?php $cat = get_query_var('cat');
  $yourcat = get_category ($cat);
  echo 'the slug is '. $yourcat->slug;?></p>

<?php get_footer(); ?>