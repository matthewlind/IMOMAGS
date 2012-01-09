<?php
/*  Copyright 2011 Aaron Baker

*/

/*
Plugin Name: IMO Blogs
Plugin URI: https://imomags.com
Description: Creates a blog post content type for IMO
Author: aaron
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/



add_action('init', 'imo_blog_init');
add_action("init", "imo_blog_tax_init");


function imo_blog_tax_init() {
    $labels = array();

    $labels['blog_tax'] = array(
        'name' => _x( 'Blogs', 'taxonomy general name' ),
        'singular_name' => _x( 'Blog', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Blogs' ),
        'all_items' => __( 'All Blogs' ),
        'parent_item' => __( 'Parent Blog' ),
        'parent_item_colon' => __( 'Parent Blog:' ),
        'edit_item' => __( 'Edit Blog' ), 
        'update_item' => __( 'Update Blog' ),
        'add_new_item' => __( 'Add New Blog' ),
        'new_item_name' => __( 'New Blog Name' ),
        'menu_name' => __( 'Blogs' ),
    ); 

    $taxonomies = array(
        "blog_tax" => array(
            "labels" => $labels['blog_tax'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"blog"),
        )
    );

    $types = array("imo_blog","posts");

    foreach ($taxonomies as $target_taxonomy => $taxonomy) {
        register_taxonomy(
            $target_taxonomy,
            $types,
            $taxonomy);
    }
}

function imo_blog_init() {
	$labels = array(
		'name' => _x('Blog Posts', 'post type general name'),
		'singular_name' => _x('Blog Post', 'post type singular name'),
		'add_new' => _x('Add New', 'blog post'),
		'add_new_item' => __("Add New Blog Post"),
		'edit_item' => __("Edit Blog Post"),
		'new_item' => __("New Blog Post"),
		'view_item' => __("View Blog Post"),
		'search_items' => __("Search Blog Posts"),
		'not_found' =>  __('No blog posts found'),
		'not_found_in_trash' => __('No blog posts found in Trash'), 
		'parent_item_colon' => ''
	  );
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail','excerpt','editor','author'),
		'rewrite' => array('slug' => 'blog_posts',FALSE),
		'taxonomies' => array('blog_tax','post_tag','activity','location','gear','species'),
	  ); 
	register_post_type('imo_blog',$args);

    // Uncomment this later if you want to use dates in the path
    // global $wp_rewrite;
    // $gallery_structure = '/%year%/%monthnum%/%day%/de/%imo_blog%';
    // $wp_rewrite->add_rewrite_tag("%imo_blog%", '([^/]+)', "imo_blog=");
    // $wp_rewrite->add_permastruct('imo_blog', $gallery_structure, false);


    flush_rewrite_rules();
}

function imo_blog_flush() {
  //imo_blog_init();
  flush_rewrite_rules();

}
register_activation_hook(__FILE__, 'imo_blog_flush');
register_deactivation_hook( __FILE__, 'imo_blog_flush' );

// Add filter to plugin init function

//Uncomment this later if you want to use dates in the path.
//add_filter('post_type_link', 'imo_blog_permalink', 10, 3);   


// Adapted from get_permalink function in wp-includes/link-template.php
function imo_blog_permalink($permalink, $post_id, $leavename) {
    $post = get_post($post_id);
    $rewritecode = array(
        '%year%',
        '%monthnum%',
        '%day%',
        '%hour%',
        '%minute%',
        '%second%',
        $leavename? '' : '%postname%',
        '%post_id%',
        '%category%',
        '%author%',
        $leavename? '' : '%pagename%',
    );
 
    if ( '' != $permalink && !in_array($post->post_status, array('draft', 'pending', 'auto-draft')) ) {
        $unixtime = strtotime($post->post_date);
 
        $category = '';
        if ( strpos($permalink, '%category%') !== false ) {
            $cats = get_the_category($post->ID);
            if ( $cats ) {
                usort($cats, '_usort_terms_by_ID'); // order by ID
                $category = $cats[0]->slug;
                if ( $parent = $cats[0]->parent )
                    $category = get_category_parents($parent, false, '/', true) . $category;
            }
            // show default category in permalinks, without
            // having to assign it explicitly
            if ( empty($category) ) {
                $default_category = get_category( get_option( 'default_category' ) );
                $category = is_wp_error( $default_category ) ? '' : $default_category->slug;
            }
        }
 
        $author = '';
        if ( strpos($permalink, '%author%') !== false ) {
            $authordata = get_userdata($post->post_author);
            $author = $authordata->user_nicename;
        }
 
        $date = explode(" ",date('Y m d H i s', $unixtime));
        $rewritereplace =
        array(
            $date[0],
            $date[1],
            $date[2],
            $date[3],
            $date[4],
            $date[5],
            $post->post_name,
            $post->ID,
            $category,
            $author,
            $post->post_name,
        );
        $permalink = str_replace($rewritecode, $rewritereplace, $permalink);
    } else { // if they're not using the fancy permalink option
    }
    return $permalink;
}


