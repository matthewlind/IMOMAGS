<?php

function ff_login_form_shortcode( $atts, $content = null ) {

	extract( shortcode_atts( array(
      'redirect' => ''
      ), $atts ) );

	if (!is_user_logged_in()) {
		if($redirect) {
			$redirect_url = $redirect;
		} else {
			$redirect_url = get_permalink();
		}
		$form = wp_login_form(array('echo' => false, 'redirect' => $redirect_url ));

		$registrationURL = wp_registration_url();;

		$form .= "<p>Don't Have an account? </p><a href='$registrationURL'>Register</a>";
	}
	return $form;
}
add_shortcode('loginform', 'ff_login_form_shortcode');


function imo_wordpress_534_add_custom_query_var( $vars ){
  $vars[] = "category_name_2";
  $vars[] = "category_name_3";
  return $vars;
}
add_filter( 'query_vars', 'imo_wordpress_534_add_custom_query_var' );

add_action('init', 'cptui_register_my_cpt_reader_photos');
function cptui_register_my_cpt_reader_photos() {
	register_post_type(
		'reader_photos', array(
			'label' => 'Reader Photos',
			'description' => 'Upload a photo to Fly Fisherman!',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'reader_post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array('slug' => 'photos'),
			'query_var' => true,
			'has_archive' => true,
			'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes'),
			'taxonomies' => array('category'),
			'labels' => array (
			  'name' => 'Reader Photos',
			  'singular_name' => 'Reader Photo',
			  'menu_name' => 'Reader Photos',
			  'add_new' => 'Add Reader Photo',
			  'add_new_item' => 'Add New Reader Photo',
			  'edit' => 'Edit',
			  'edit_item' => 'Edit Reader Photo',
			  'new_item' => 'New Reader Photo',
			  'view' => 'View Reader Photo',
			  'view_item' => 'View Reader Photo',
			  'search_items' => 'Search Reader Photos',
			  'not_found' => 'No Reader Photos Found',
			  'not_found_in_trash' => 'No Reader Photos Found in Trash',
			  'parent' => 'Parent Reader Photo',
			)
		)
	);


}