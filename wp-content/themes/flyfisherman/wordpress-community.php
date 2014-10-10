<?php

register_activation_hook( __FILE__, 'imo_wordpress_community_flush' );
register_deactivation_hook( __FILE__, 'imo_wordpress_community_flush' );






//FF Wordpress Community Scripts Config
add_action("wp_enqueue_scripts","ff_wp_community_scripts");
function ff_wp_community_scripts() {
	$photos = get_post_type();
	
    if ( is_post_type_archive( "reader_photos" ) || $photos == "reader_photos" ) {

        wp_enqueue_script( 'bootstrap-dropdown', get_stylesheet_directory_uri() . '/js/bootstrap-dropdown.js', array("jquery",'underscore'), '0.1', true );
        wp_enqueue_script( 'gf-wp-community-listing', get_stylesheet_directory_uri() . '/js/community-listing.js', array("jquery",'underscore','bootstrap-dropdown'), '0.1', true );
    }
}


function imo_wordpress_community_flush() {

	flush_rewrite_rules( false );
}



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

add_action('init', 'category_cpt_rewrites');
function category_cpt_rewrites() {
	
	/*
	$photos = get_field("photos_menu", "options"); 
		if( $photos ){ 
			foreach( $photos as $photo ){  
				$categoryList = get_term_by('id', $photo, 'category'); 
				$slug = $categoryList->slug;
				$rule = "photos" . '/'.$slug.'/(.+?)/?$';
			    $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name=$matches[1]&category_name_2='.$slug;
			    add_rewrite_rule($rule,$rewrite,'top');
				
				$rule = "photos" . '/'.$slug;
			    $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name='.$slug;
			    add_rewrite_rule($rule,$rewrite,'top');
				
			} 
		} 
	$flies = get_field("flies_menu", "options"); 

	
    $rule = "photos" . '/fish-photos/(.+?)/?$';
    $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name=$matches[1]&category_name_2=fish-photos';
    add_rewrite_rule($rule,$rewrite,'top');

    $rule = "photos" . '/scenic-photos/(.+?)/?$';
    $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name=$matches[1]&category_name_2=scenic-photos';
    add_rewrite_rule($rule,$rewrite,'top');

    $rule = "photos" . '/flies/(.+?)/?$';
    $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name=$matches[1]&category_name_2=flies';
    add_rewrite_rule($rule,$rewrite,'top');

    $rule = "photos" . '/fish-photos';
    $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name=fish-photos';
    add_rewrite_rule($rule,$rewrite,'top');

    $rule = "photos" . '/scenic-photos';
    $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name=scenic-photos';
    add_rewrite_rule($rule,$rewrite,'top');

    $rule = "photos" . '/flies';
    $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name=flies';
    add_rewrite_rule($rule,$rewrite,'top');
*/	
 //    $rule = "photos" . '/hunting';
 //    $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name=hunting';
 //    add_rewrite_rule($rule,$rewrite,'top');



    // $rule = "photos" . '/fishing';
    // $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name=fishing';
    // add_rewrite_rule($rule,$rewrite,'top');

	// $rule2 = "photos" . '/(.+?)/?$';
 //    $rewrite2 = 'index.php?post_type=' . "reader_photos" . '&category_name=$matches[1]';
 //    add_rewrite_rule($rule2,$rewrite2,'top');

	// $rule2 = "photos" . '/(.+?)/(.+?)/?$';
 //    $rewrite2 = 'index.php?post_type=' . "reader_photos" . '&category_name=$matches[1]' . '&category_name_2=gar';
 //    add_rewrite_rule($rule2,$rewrite2,'top');

 //    $rule2 = "photos" . '/(.+?)/(.+?)/(.+?)/?$';
 //    $rewrite2 = 'index.php?post_type=' . "reader_photos" . '&category_name=$matches[1]' . '&category_name_2=$matches[2]' . '&category_name_3=$matches[3]';
 //    add_rewrite_rule($rule2,$rewrite2,'top');


    // $rule = "photos" . '/flytest';
    // $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name=fish-photos&category_name_2=bass';
    // add_rewrite_rule($rule,$rewrite,'top');


}


// add_filter( 'wp_unique_post_slug', 'imo_wordpress_community_post_slug', 10, 4 );
// function imo_wordpress_community_post_slug( $slug, $post_ID, $post_status, $post_type ) {

// 		if ($post_type == "reader_photos") {

// 			if (strpos($slug,"photo-") === FALSE && $post_ID == 0) {

// 				$slug = "photo-" . $slug;
// 			}

// 		}


//     return $slug;
// }



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