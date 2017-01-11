<?php
/*
 * Plugin Name: IMO JSON Taxonomy
 * Plugin URI: http://github.com/imoutdoors
 * Description: Adds JSON variables to every page so that wordpress taxonomies are available to javascript
 * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */

add_action("wp", "output_json_taxonomy");


function output_json_taxonomy() {
	$terms = array();
	
	if(is_array(get_queried_object())) {
	

		if (is_archive()) {

			$terms[] = get_queried_object()->slug;

		} else {
			$post = get_queried_object();
		

			$termObjects = wp_get_post_terms($post->ID,"category");

			foreach ($termObjects as $term) {
				$terms[] = $term->slug;
				}
		}

	}

	wp_enqueue_script('json-taxonomy-fakescript', plugins_url('/fakescript.js', __FILE__) );
	wp_localize_script('json-taxonomy-fakescript','taxonomyTerms',$terms);


}