<?php

/**
 * imo-addons.php
 *
 * Defines additions to Carrington Build's theme. 
 */
include_once(CFCT_PATH.'widgets/subscribe.php');


/**
 * A title callback for the article type.
 */
function cfct_articles_title() {
	$title = cfct_get_option('cfctbiz_articles_title');
	if (!$title) {
		$title = sprintf(__('%s Articles', 'carrington-business'), get_bloginfo('name'));
	}
	echo $title;
}


/**
 * Includes a header file at the top of the page. 
 */
function imo_addons_include_header_file() {
	include(CFCT_PATH.'functions/header-content.php');
}

function imo_addons_sidebar_init() {

    
    register_nav_menus(array(
        'subnav' => __( 'Sub Navigation', 'carrington-business' ),
        'subnav-right' => __( 'Sub Navigation - Right', 'carrington-business' ),
    ));
    //default configuration from carrington build
    $sidebar_defaults = array(
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>'
    );

    register_sidebar(array_merge($sidebar_defaults, array(
        'id' => 'header-slot',
        'name' => 'Header Slot',
        'description' => 'Shown on the right of the logo.',
    )));

    register_sidebar(array_merge($sidebar_defaults, array(
		'id' => 'sidebar-home',
		'name' => __('Homepage Sidebar', 'carrington-business'),
		'description' => __('Shown on the homepage.', 'carrington-business')
	)));

    register_sidebar(array_merge($sidebar_defaults, array(
		'id' => 'sidebar-landing',
		'name' => __('Landing Page Sidebar', 'carrington-business'),
		'description' => __('Shown on Landing Pages.', 'carrington-business')
    )));	
    
    register_sidebar(array_merge($sidebar_defaults, array(
		'id' => 'sidebar-video',
		'name' => __('Video Sidebar', 'carrington-business'),
		'description' => __('Shown on video posts.', 'carrington-business')
	)));
    register_sidebar(array_merge($sidebar_defaults, array(
		'id' => 'sidebar-articles',
		'name' => __('Article Sidebar', 'carrington-business'),
		'description' => __('Shown on article posts.', 'carrington-business')
	)));
}

/**
 * Callback Handler for the admin_menu action.
 */
function imo_addons_create_subscriptions_menu() {
    add_menu_page("Subscriptions Settings", "Subscription Settings",
        "administrator", 'subs', "imo_addons_subscription_page");
    add_action("admin_init", "register_imo_subscribe_settings");
}
function register_imo_subscribe_settings () {
    register_setting( 'imo-subs-settings-group', 'iMagID' );
    register_setting( 'imo-subs-settings-group', 'deal_copy' );
    register_setting( 'imo-subs-settings-group', 'subs_link' );
    register_setting( 'imo-subs-settings-group', 'gift_link' );
    register_setting( 'imo-subs-settings-group', 'service_link' );
    register_setting( 'imo-subs-settings-group', 'magazine_cover_uri' );
    register_setting( 'imo-subs-settings-group', 'i4ky' );
}
/**
 *HTML generation call back for the Subscriptions settings page.
 * @see imo_addons_create_subscriptions_menu()
 */
function imo_addons_subscription_page() {
?>
<div class="wrap">
<h2>Subscription Settings</h2>
<form method="post" action="options.php">
<?php settings_fields( 'imo-subs-settings-group' ); ?>
<table class="form-table">
        <tr valign="top">
        <th scope="row">Deal Copy</th>
        <td><input type="text" name="deal_copy" value="<?php echo get_option('deal_copy'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Subscription Link</th>
        <td><input type="text" name="subs_link" value="<?php echo get_option('subs_link'); ?>" /></td>
        </tr>
         <tr valign="top">
        <th scope="row">Gift Link</th>
        <td><input type="text" name="gift_link" value="<?php echo get_option('gift_link'); ?>" /></td>
        </tr>
         <tr valign="top">
        <th scope="row">Service Link</th>
        <td><input type="text" name="service_link" value="<?php echo get_option('service_link'); ?>" /></td>
        </tr><tr valign="top">
        <th scope="row">Magazine Cover URL</th>
        <td><input type="text" name="magazine_cover_uri" value="<?php echo get_option('magazine_cover_uri'); ?>" /></td>
        </tr>
        <th scope="row">iMagID</th>
        <td><input type="text" name="iMagID" value="<?php echo get_option('iMagID'); ?>" /></br><p>(Leave this alone if you don't konw what this does.)</td>
        </tr> <tr valign="top">
        <th scope="row">Special Keys</th>
        <td><input type="text" name="i4ky" value="<?php echo get_option('i4ky'); ?>" /></td>
        </tr>
  </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
</form>
</div>
<?php 
}
add_action("widgets_init", 'imo_addons_sidebar_init'); 
add_action("admin_menu", "imo_addons_create_subscriptions_menu");
add_action('wp_head','imo_addons_include_header_file');
