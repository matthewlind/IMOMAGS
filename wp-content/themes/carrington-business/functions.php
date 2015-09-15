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
//Gravity Form forgot password hook
// remember, the hook suffix, should contain the form id!
add_filter( "gform_field_validation_16", 'wp_doin_validation_16', 10, 4 );
/**
 * Let's verify for the user email or username provided
 *
 * @return ARRAY_A
 */
function wp_doin_validation_16($result, $value, $form, $field) {
	$classes = explode( ' ', $field['cssClass'] );
	// let's assume it's all valid
	$result['is_valid'] = true;
	// lets check if the user with such a username is already in the database
	if ( in_array( 'user-email', $classes ) ) {
		// this means that the user has specified email
		if ( strpos( $value, '@' ) ) {
			$user_data = get_user_by( 'email', trim( $value ) );
			if ( empty( $user_data ) ) {
				$result['is_valid'] = false;
				$result['message'] = 'No such email in database.';
			}
			$allow = check_if_reset_is_allowed( $user_data->ID );
		} else {
			// let's verify the username existence
			$user_id = username_exists( $value );
			if ( !$user_id ) {
				// let's mark this field is invalid
				$result['is_valid'] = false;
				$result['message'] = 'No such user in database.';
			}
			$allow = check_if_reset_is_allowed( $user_id );
		}
	}

	return $result;
}
/**
 * Utility to check if password reset is allowed based on user id.
 * 
 * @param INT $user_id
 * @return BOOL true / false
 */
function check_if_reset_is_allowed($user_id) {
	$allow = apply_filters( 'allow_password_reset', true, $user_id );
	if ( !$allow ) {
		return false;
	} elseif ( is_wp_error( $allow ) ) {
		return false;
	}
	return true;
}


add_action( "gform_pre_submission_16", "wp_doin_pre_submission_16" );
/**
 * 
 * @param type $form
 * @return type
 */
function wp_doin_pre_submission_16($form) {
	global $wpdb, $wp_hasher;
	// get the submitted value
	$email_or_username = $_POST['input_1'];
	// let's check if the user has provided email or username
	if ( strpos( $email_or_username, '@' ) ) {
		$email = sanitize_email( $email_or_username );
		$user_data = get_user_by( 'email', $email );
	} else {
		$username = esc_attr( $email_or_username );
		$user_data = get_user_by( 'login', $username );
	}
	// Redefining user_login ensures we return the right case in the email.
	$user_login = $user_data->user_login;
	$user_email = $user_data->user_email;
	$key = wp_generate_password( 20, false );
	// Now insert the key, hashed, into the DB.
	if ( empty( $wp_hasher ) ) {
		require_once ABSPATH . WPINC . '/class-phpass.php';
		$wp_hasher = new PasswordHash( 8, true );
	}
	// obtain new hashed password
	$hashed = $wp_hasher->HashPassword( $key );
	// update user with new activation key
	$wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user_login ) );
	// construct the email message for the user
	$message = __( 'Someone requested that the password be reset for the following account:' ) . "\r\n\r\n";
	$message .= network_home_url( '/' ) . "\r\n\r\n";
	$message .= sprintf( __( 'Username: %s' ), $user_login ) . "\r\n\r\n";
	$message .= __( 'If this was a mistake, just ignore this email and nothing will happen.' ) . "\r\n\r\n";
	$message .= __( 'To reset your password, visit the following address:' ) . "\r\n\r\n";
	$message .= '<' . network_site_url( "/recover-password/?action=rp&method=gf&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";
	if ( is_multisite() ) {
		$blogname = $GLOBALS['current_site']->site_name;
	} else {
		/*
		 * The blogname option is escaped with esc_html on the way into the database
		 * in sanitize_option we want to reverse this for the plain text arena of emails.
		 */
		$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
	}
	
	$title = sprintf( __( '[%s] Password Reset' ), $blogname );
	/**
	 * Filter the subject of the password reset email.
	 *
	 * @since 2.8.0
	 *
	 * @param string $title Default email title.
	 */
	$title = apply_filters( 'retrieve_password_title', $title );
	/**
	 * Filter the message body of the password reset mail.
	 *
	 * @since 2.8.0
	 * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
	 *
	 * @param string  $message    Default mail message.
	 * @param string  $key        The activation key.
	 * @param string  $user_login The username for the user.
	 * @param WP_User $user_data  WP_User object.
	 */
	$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );
	if ( $message && !wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) )
		wp_die( __( 'The e-mail could not be sent.' ) . "<br />\n" . __( 'Possible reason: your host may have disabled the mail() function.' ) );
	return;
}


add_action( 'init', 'wp_doin_verify_user_key', 999 );
/**
 * Check if the user has hit the proper rest password page. The check is identical to that 
 * from wp-login.php, hence extra $_GET['method'] parameter was included to exclude redirects
 * from wp-login.php file on standard password reset method.
 * 
 * @hook wp_head
 */
function wp_doin_verify_user_key() {
	global $gf_reset_user;
	// analyze wp-login.php for a better understanding of these values
	list( $rp_path ) = explode( '?', wp_unslash( $_SERVER['REQUEST_URI'] ) );
	$rp_cookie = 'wp-resetpass-' . COOKIEHASH;
	// lets redirect the user on pass change, so that nobody could spoof his key
	if ( isset( $_GET['key'] ) and isset( $_GET['method'] ) ) {
		if ( $_GET['method'] == 'gf' ) {
			$value = sprintf( '%s:%s', wp_unslash( $_GET['login'] ), wp_unslash( $_GET['key'] ) );
			setcookie( $rp_cookie, $value, 0, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
			wp_safe_redirect( remove_query_arg( array( 'key', 'login', 'method' ) ) );
			exit;
		}
	}
	// lets compare the validation cookie with the hash key stored with the database data
	// if they match user data will be returned
	if ( isset( $_COOKIE[$rp_cookie] ) && 0 < strpos( $_COOKIE[$rp_cookie], ':' ) ) {
		list( $rp_login, $rp_key ) = explode( ':', wp_unslash( $_COOKIE[$rp_cookie] ), 2 );
		$user = check_password_reset_key( $rp_key, $rp_login );
		if ( isset( $_POST['pass1'] ) && !hash_equals( $rp_key, $_POST['rp_key'] ) ) {
			$user = false;
		}
	} else {
		$user = false;
	}
	// if any error occured make sure to remove the validation cookie
	if ( !$user || is_wp_error( $user ) ) {
		setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
	}
	// make sure our user is available for later reference
	$gf_reset_user = $user;
}


add_shortcode( 'verify_user_pass', 'wp_doin_verify_user_pass' );
/**
 * Shortcode which is used to cover Gravity Forms shortcode. It will not render the password 
 * reset form in case of invalid pass.
 * 
 * @shortcode verify user pass
 */
function wp_doin_verify_user_pass($args, $content = null) {
	// lets make usage of the custom global variable to fetch
	// the values from the safe / cookie validation functions
	global $gf_reset_user;
	// start output buffering for a more visually appealing output
	ob_start();
	
	if ( !$gf_reset_user || is_wp_error( $gf_reset_user ) ) {
		if ( $gf_reset_user && $gf_reset_user->get_error_code() === 'expired_key' )
			echo '<h2 class="error">The key has expired.</h2>';
		else
			echo '<h2 class="error">The key is invalid</h2>';
	} else {
		echo '<h2>Please update your password below.</h2>';
		echo do_shortcode( $content );
	}
	return ob_get_clean();
}


// remember, the hook suffix, should contain the form id!
add_filter( 'gform_field_validation_17', 'wp_doin_validation_17', 10, 4 );
/**
 * Custom GF validation function used for pagination and required fields
 *
 * @return string
 */
function wp_doin_validation_17($result, $value, $form, $field) {
	global $pass;
	$result['is_valid'] = true;
	$classes = explode( ' ', $field['cssClass'] );
	// lets store the new-pass in a global variable to make sure it'd be 
	// recursively available next time
	if ( in_array( 'new-pass', $classes ) ) {
		$pass = $value;
	}
	// lets check if the password fields are equal
	if ( in_array( 'repeat-pass', $classes ) ) {
		// if these two dont match make sure the fields are not valid
		if ( $pass != $value ) {
			$result['is_valid'] = false;
			$result['message'] = 'Password mismatch.';
		}
	}
	return $result;
}
add_action( "gform_pre_submission_17", "wp_doin_pre_submission_17" );
function wp_doin_pre_submission_17($form) {
	// we'll need the data created before to update the correct user
	global $gf_reset_user;
	list( $rp_path ) = explode( '?', wp_unslash( $_SERVER['REQUEST_URI'] ) );
	$rp_cookie = 'wp-resetpass-' . COOKIEHASH;
	
	// get the old and new pass values
	$pass = $_POST['input_1'];
	$pass_confirm = $_POST['input_2'];
	// if we're doing a cron job let's forget about it
	if ( defined( 'DOING_CRON' ) || isset( $_GET['doing_wp_cron'] ) )
		return;
	// let's check if a user with given name exists
	// we're already doing that in the form validation, but this gives us another bridge of safety
	$user_id = username_exists( $gf_reset_user->ID );
	// let's validate the email and the user
	if ( !$user_id ) {
		// let's add another safety check to make sure that the passwords remain unchanged
		if ( !empty( $pass ) and ! empty( $pass_confirm ) and $pass === $pass_confirm ) {
			reset_password( $gf_reset_user, $pass );
			setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
			wp_logout();
		}
	} else {
		// validation failed
		return;
	}
}
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