<?php

/**
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

$allowedposttags["object"] = array(
 "height" => array(),
 "width" => array()
);

$allowedposttags["param"] = array(
 "name" => array(),
 "value" => array()
);

$allowedposttags["embed"] = array(
 "src" => array(),
 "type" => array(),
 "allowfullscreen" => array(),
 "allowscriptaccess" => array(),
 "height" => array(),
 "width" => array()
);


$allowedposttags["script"] = array(
 "src" => array(),
 "type" => array(),
 "language" => array()
);


/* This function allows for logging when debugging mode is on */
if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}

/**
 * Adds Additional Images sizes for featured widget.
 * NOTE: Thumbnails must be rebuilt after adding additional image sizes
 * 
 */
add_image_size("small-featured-thumb",110,70,TRUE);
add_image_size("large-featured-thumb",308,225,TRUE);
add_image_size("small-featured-thumb-x",98,76,TRUE);
add_image_size("large-featured-thumb-x",420,300,TRUE);
add_image_size("huge-featured-thumb-x",648,225,TRUE);
add_image_size("imo-slider-thumb",134,90,TRUE);
add_image_size("imo-mini-slider-thumb",70,70,TRUE);
add_image_size( 'index-thumb', 200, 150, true );
add_image_size( 'legacy-thumb', 190, 120, true );
add_image_size( 'post-thumb', 700, 450, true );
add_image_size( 'post-home-thumb', 695, 380, true );
add_image_size( 'post-home-small-thumb', 335, 225, true );





/**
 * If set to TRUE, ads will be automatically be refreshed periodically without reloading the page.
 * This is set to FALSE so that it can be set to TRUE on a per theme basis.
 */
define("USE_IFRAME_ADS",FALSE);



if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

load_theme_textdomain('carrington-business');
/**
 * Set this to "true" to turn on debugging mode.
 * Debug helps with development by showing you the paths of the files loaded by Carrington.
 */
define('CFCT_DEBUG', false);

define('CFCT_PATH', trailingslashit(TEMPLATEPATH));

/**
 * Theme version.
 */
define('CFCT_THEME_VERSION', '1.1.1');

/**
 * Theme URL version.
 * Added to query var at the end of assets to force browser cache to reload after upgrade.
 */
define('CFCT_URL_VERSION', '1.1.1');

include_once(CFCT_PATH.'carrington-core/carrington.php');
include_once(CFCT_PATH.'carrington-build/carrington-build.php');
include_once(CFCT_PATH.'functions/patch-nav-menu.php');
include_once(CFCT_PATH.'functions/css3pie.php');
include_once(CFCT_PATH.'functions/post-type-news.php');
include_once(CFCT_PATH.'functions/sidebars.php');
include_once(CFCT_PATH.'functions/imo-addons.php');
include_once(CFCT_PATH.'functions/admin.php');

if ( ! function_exists( 'cfct_setup' ) ) {
	function cfct_setup() {
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
		// Width, Height, Crop
		set_post_thumbnail_size( 190, 120, true );
		// Image sizes to support Carousel
		add_image_size('post-image-large', 584, 370, true);
		add_image_size('post-image-medium', 426, 270, true);
		add_image_size('post-image-small', 268, 170, true);

		register_nav_menus(array(
			'main' => __( 'Main Navigation', 'carrington-business' ),
			'featured' => __( 'Featured Navigation', 'carrington-business' ),
			'footer' => __( 'Footer Navigation', 'carrington-business' )
		));
		
		if (!is_admin()) {
			wp_enqueue_script('carrington-business', get_bloginfo('template_directory') . '/js/master.js', array('jquery'), CFCT_URL_VERSION);
			wp_enqueue_script('carrington-business-custom', get_bloginfo('template_directory') . '/js/custom.js', array('jquery'), CFCT_URL_VERSION);
		}
		
		// Enqueue child styles at theme setup (allow child themes to override)
		if (is_child_theme() && !is_admin()) {
			wp_enqueue_style('carrington-business', get_bloginfo('stylesheet_url'), array(), CFCT_URL_VERSION, 'screen');
		}
		
		// Attach CSS3PIE behavior to the following elements
		css3pie_enqueue('#main-content, #main-content .str-content, #masthead, #footer-content, #footer-content .str-content, nav.nav li ul, .cfct-module.style-b, .cfct-module.style-b .cfct-mod-title, .cfct-module.style-c, .cfct-module.style-d, .cft-module.style-d .cfct-mod-title, .cfct-notice, .notice, .cfct-pullquote, .cfct-module-image img.cfct-mod-image, .cfct-module-hero, .cfct-module-hero-image, .wp-caption, .loading span, .cfct-block-abc .cfct-module-carousel, .cfct-block-abc .cfct-module-carousel, .carousel, .cfct-block-abc .cfct-module-carousel .car-content');
	}
}
add_action( 'after_setup_theme', 'cfct_setup' );

function cfct_js_global() {
	echo '<script type="text/javascript">
	CFCT = {
		url: "'.trailingslashit(get_bloginfo('url')).'"
	};
</script>';
}
// wp_enqueue_script adds at priority 9, wp_enqueue_style at priority 7. We want this in-between.
add_action('wp_head', 'cfct_js_global', 8);

/**
 * Run the following tasks on init
 */
function cfct_theme_init() {
	// Keep Carrington Build styles out of the front-end. We'll ad our own.
	wp_deregister_style('cfct-build-css');

	// Set up AJAX post request handler
	cfct_ajax_load();
}
add_action('init', 'cfct_theme_init');

/**
 * Next Posts/Comments link attributes
 */
function cfct_next_link_attributes() {
	return 'class="next" rel="next"';
}
add_filter('next_comments_link_attributes', 'cfct_next_link_attributes');
add_filter('next_posts_link_attributes', 'cfct_next_link_attributes');

/**
 * Previous Posts/Comments link attributes
 */
function cfct_previous_link_attributes() {
	return 'class="prev" rel="previous"';
}
add_filter('previous_comments_link_attributes', 'cfct_previous_link_attributes');
add_filter('previous_posts_link_attributes', 'cfct_previous_link_attributes');

/**
 * Add has-img post class to posts with featured image.
 */
function cfct_post_class_thumbnail($classes, $class, $post_id) {
	if (has_post_thumbnail()) {
		$classes[] = 'has-img';
	}
	
	return $classes;
}
add_filter('post_class', 'cfct_post_class_thumbnail', 10, 3);

/**
 * Override the default caption shortcode output
 */
function cfct_img_caption_shortcode($unused, $attr, $content = null) {
	extract(shortcode_atts(array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . $width . 'px">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
add_filter('img_caption_shortcode', 'cfct_img_caption_shortcode', 10, 3);

/**
 * Show number of pages available on archive page and where you are
 * @param array||str $args
 */
function cfct_page_x_of_y($args = '') {
	global $wp_query;
	
	$default_args = array(
		'before' => '',
		'after' => '',
		'showalways' => false
	);
	$args = wp_parse_args($args, $default_args);
	extract($args);
	
	$max_num_pages = $wp_query->max_num_pages;
	
	$paged = get_query_var('paged');
	
	if (!$paged && !empty($wp_query->query['offset']) && !empty($wp_query->query['posts_per_page'])) {
		$paged = ($wp_query->query['offset']/$wp_query->query['posts_per_page'])+1;
	}
	
	// If we aren't paged, we're on page 1.
	(!$paged) ? $paged = 1 : $paged;
	
	if ($showalways || $max_num_pages > 1) {
		echo $before . sprintf(__('%s of %s', 'carrington-business'), $paged, $max_num_pages) . $after;
	}
}

/**
 * Output the blog title, or the site title + "Blog" if the blog title is empty.
 */
function cfct_blog_title() {
	$title = cfct_get_option('cfctbiz_blog_title');
	if (!$title) {
		$title = sprintf(__('%s Blog', 'carrington-business'), get_bloginfo('name'));
	}
	echo $title;
}

function cfct_news_title() {
	$title = cfct_get_option('cfctbiz_news_title');
	if (!$title) {
		$title = sprintf(__('%s News', 'carrington-business'), get_bloginfo('name'));
	}
	echo $title;
}
if ( ! function_exists( 'cfct_get_loginout' ) ) {
	function cfct_get_loginout($redirect = '', $before = '', $after = '') {
		if (cfct_get_option('cfctbiz_login_link_enable') != 'no') {
			return $before . wp_loginout($redirect, false) . $after;
		}
	}
}

/**
 * Filter default wp_link_pages output
 */
function cfct_link_pages_args($args) {
	$my_args = array(
		'before' => '<div class="pagination-content"><p>'.__('Pages:', 'carrington-business'),
		'after' => '</p></div>',
	);
	return array_merge($args, $my_args);
}
add_filter('wp_link_pages_args', 'cfct_link_pages_args');

/**
 * Neuter Carrington Core's image gallery. Use standard WP gallery instead.
 */
remove_filter('post_gallery', 'cfct_post_gallery', 10, 2);

/**
 * Since we're using HTML5, we don't want to use the rev attribute on permalinks either.
 * This is used for AJAX in Carrington Blog and the filter ships with Carrington by
 * default but we don't need it here and it causes validation errors.
 */
remove_filter('comments_popup_link_attributes', 'cfct_ajax_comment_link');

/**
 * Filter out extra Build wrapping div
 */
function cfct_cfct_row_html($html, $class) {
	return '<div id="{id}" class="{class}">
	{blocks}
</div>';
}
add_filter('cfct-row-html', 'cfct_cfct_row_html', 10, 3);
remove_action('wp_head', 'wp_generator');

/**
 * Facebook Thumbnail Support Script
 */
function insert_image_src_rel_in_head() {
	global $post;
	if ( !is_singular()) //if it is not a post or a page
		return;
	if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
		$default_image="http://example.com/image.jpg"; //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	}
	else{
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
	echo "\n";
}
add_action( 'wp_head', 'insert_image_src_rel_in_head', 5 );

// function insert_image_src_rel_in_head() {

//     global $post;

//     if ( !is_singular()) //if it is not a post or a page

//         return;
//     if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image

//         $default_image="http://example.com/image.jpg"; //replace this with a default image on your server or an image in your media library

//         echo '<meta property="og:image" content="' . $default_image . '"/>';

//     }

//     else{

//         $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );

//         echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';

//     }

//     echo "\n";

// }

add_action( 'wp_head', 'insert_image_src_rel_in_head', 5 );


include_once (CFCT_PATH.'/widgets/related-products.php');
include_once (CFCT_PATH.'/widgets/forecast.php');