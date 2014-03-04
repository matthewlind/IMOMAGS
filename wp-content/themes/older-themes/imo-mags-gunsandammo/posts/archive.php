<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>


<div class="page-flow">
	<div id="content" class="col-ab">
		<header>
			<h1><?php _e('', 'carrington-business'); wp_title('&rsaquo;'); ?></h1>
		</header>
		<?php
		cfct_loop();
		cfct_misc('nav-posts'); ?>
	</div>
</div>
<?php
get_sidebar();
get_footer(); ?>