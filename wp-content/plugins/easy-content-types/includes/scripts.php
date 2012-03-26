<?php

function ecpt_admin_styles() 
{
	global $ecpt_base_dir;
	wp_enqueue_style('thickbox');
	wp_enqueue_style('ecpt-admin', $ecpt_base_dir . 'includes/css/admin-styles.css');
	wp_enqueue_style('tooltip-css', $ecpt_base_dir . 'includes/css/thetooltip.css');
	wp_enqueue_style('ecpt-jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css');
}

function ecpt_admin_scripts()
{
	global $ecpt_base_dir;
	
	wp_enqueue_script('media-upload'); 
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('ecpt-admin', $ecpt_base_dir . 'includes/js/ecpt-admin.js', array('jquery'));
	wp_enqueue_script('ecpt-jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js', array('jquery'));
}


// load all the scripts
if (isset($_GET['page']) && 
		(
			$_GET['page'] == 'easy-content-types/easy-content-types.php?posttypes' || 
			$_GET['page'] == 'easy-content-types/easy-content-types.php?taxonomies' ||
			$_GET['page'] == 'easy-content-types/easy-content-types.php?metaboxes' ||
			$_GET['page'] == 'easy-content-types/easy-content-types.php?export' ||
			$_GET['page'] == 'easy-content-types/easy-content-types.php?help' ||
			$_GET['page'] == 'easy-content-types/easy-content-types.php'
		)
	) 
{ 
	add_action('admin_enqueue_scripts', 'ecpt_admin_styles');
	add_action('admin_enqueue_scripts', 'ecpt_admin_scripts');
}


function ecpt_post_edit_scripts() {
	global $ecpt_base_dir, $post;
	wp_enqueue_script('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('ecpt-ui', $ecpt_base_dir . 'includes/js/ui-scripts.js', array('jquery')); 
	wp_localize_script( 'ecpt-ui', 'post_vars', 
		array( 
			'post_id' => $post->ID
		) 
	);
	wp_enqueue_script('jquery-ui.min', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js', false, '1.8', 'all');
}
function ecpt_post_edit_styles() {
	global $ecpt_base_dir;
	wp_enqueue_style('thickbox');
	wp_enqueue_style('datepicker-slider', $ecpt_base_dir . 'includes/css/datepicker-slider.css');
}

// these are for newest versions of WP
add_action('admin_print_scripts-post.php', 'ecpt_post_edit_scripts');
add_action('admin_print_scripts-edit.php', 'ecpt_post_edit_scripts');
add_action('admin_print_scripts-post-new.php', 'ecpt_post_edit_scripts');
add_action('admin_print_styles-post.php', 'ecpt_post_edit_styles');
add_action('admin_print_styles-edit.php', 'ecpt_post_edit_styles');
add_action('admin_print_styles-post-new.php', 'ecpt_post_edit_styles');

// load the pretty js and css for the export page
function ecpt_prettify_scripts() {
	global $ecpt_base_dir;
	wp_enqueue_script('prettify', $ecpt_base_dir . 'includes/js/jquery.beautyOfCode-min.js');	
	wp_enqueue_script('export-scripts', $ecpt_base_dir . 'includes/js/export-scripts.js');	
	wp_enqueue_script('postbox' );
	wp_enqueue_script('dashboard' );
}
if (isset($_GET['page']) && $_GET['page'] == 'easy-content-types/easy-content-types.php?export') {
	add_action('admin_print_scripts', 'ecpt_prettify_scripts');
}