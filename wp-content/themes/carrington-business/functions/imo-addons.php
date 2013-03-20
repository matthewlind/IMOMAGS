<?php

/**
 * imo-addons.php
 *
 * Defines additions to Carrington Build's theme. 
 */
 

/***
**
** Enqueue Scripts
**
***/


add_action("init","grab_bracket_polling_data");

function grab_bracket_polling_data() {
	
	global $wpdb;
	
	$pollPosts = $wpdb->get_results("SELECT post_name,post_content from {$wpdb->prefix}posts WHERE post_status = 'publish' AND post_type = 'gamadness'");
	
	$pollDataOutput = array();
	
	foreach ($pollPosts as $key => $post) {
		$slug = $post->post_name;
		
		$postContent = $post->post_content;
		
		$pollID = filter_var($postContent, FILTER_SANITIZE_NUMBER_INT);
		
		$pollPosts[$key]->poll_id = $pollID;
		
		
		$pollDataOutput[$pollID]['slug'] = $slug;
		
	}
	
	$pollAnswers = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}pollsa");
	
	

	
	$pollQuestions = array();
	
	foreach ($pollAnswers as $answer) {
		
		$qid = $answer->polla_qid;
			
		$pollQuestions[$qid][] = $answer->polla_votes;
		
		
		
	}
	
	foreach ($pollQuestions as $key => $question) {
		
		if ($question[0] > $question[1]) {
			$pollDataOutput[$key]['winner'] = "first";
		} else if ($question[0] < $question[1]){
			$pollDataOutput[$key]['winner'] = "second";
		} else {
			$pollDataOutput[$key]['winner'] = null;
		}
			
		
	}
	
	
	_log($pollDataOutput);
	_log($pollQuestions);

	
	wp_localize_script( 'carrington-business-custom', 'madness_poll_data', $pollDataOutput);
	
	
	
}


function sitewide_scripts_method() {
    wp_deregister_script( 'jquery' );

    
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script("jquery-simplemodal", get_stylesheet_directory_uri() . "/js/jquery.simplemodal.1.4.2.min.js");



}    
 
/** tweak excerpts **/
 function new_excerpt_length($length) {
	return 20;
} 
add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($more) {
       global $post;
	return '<a href="'. get_permalink($post->ID) . '">...&raquo;</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
 

/**
 * Adds pagination after the post
 * Added by Berry 11/16/2011
 * @uses is_single()
 */
 
add_filter('the_content','pagination_after_post',1);

function pagination_after_post($content){
    if( is_single() ){
        $content .= " \n" . '<div class="pagination">' . wp_link_pages('before=&after=&next_or_number=number&nextpagelink= &previouspagelink= &echo=0') . '</div>';
    }
    return $content;
} // pagination_after_post
 
 
 
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
        'id' => 'sidebar-gallery',
        'name' => __('Gallery Sidebar', 'carrington-business'),
        'description' => __('Sidebar for Gallery posts.', 'carrington-business')
    )));
    
    
    register_sidebar(array_merge($sidebar_defaults, array(
        'id' => 'sidebar-articles',
        'name' => __('Article Sidebar', 'carrington-business'),
        'description' => __('Shown on article posts.', 'carrington-business')
    )));
    
    
     register_sidebar(array_merge($sidebar_defaults, array(
        'id' => 'sidebar-digmag-article',
        'name' => __('DIGMAG Article Sidebar', 'carrington-business'),
        'description' => __('Shown on DIGMAG article posts.', 'carrington-business')
    )));   
    

    register_sidebar(array(
        'name' => 'Bonus Sidebar',
        'id'   => 'bonus_sidebar',
        'description'   => 'Appears on pages that use the Right Sidebar template',
        'before_widget' => '<div id="bonus-area">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
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
    register_setting( 'imo-subs-settings-group', 'sons_header_uri' );
    register_setting( 'imo-subs-settings-group', 'defend_header_uri' );
    register_setting( 'imo-subs-settings-group', 'history_header_uri' );
    register_setting( 'imo-subs-settings-group', 'competition_header_uri' );
    register_setting( 'imo-subs-settings-group', 'news_header_uri' );
    register_setting( 'imo-subs-settings-group', 'zombie_header_uri' );
    register_setting( 'imo-subs-settings-group', 'affiliates_desc_uri' );
    register_setting( 'imo-subs-settings-group', 'ma_desc_uri' );
    register_setting( 'imo-subs-settings-group', 'subs_form_link' );
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
        <td><strong>Magazine Section</strong></td>
        </tr>
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
        <tr valign="top">
        <td><strong>Blog Headers</strong></td>
        </tr>
        <tr valign="top">
        <th scope="row">Sons of Guns & Ammo Header URL</th>
        <td><input type="text" name="sons_header_uri" value="<?php echo get_option('sons_header_uri'); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">News Brief Header URL</th>
        <td><input type="text" name="news_header_uri" value="<?php echo get_option('news_header_uri'); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Defend Thyself Header URL</th>
        <td><input type="text" name="defend_header_uri" value="<?php echo get_option('defend_header_uri'); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">From the History Books Header URL</th>
        <td><input type="text" name="history_header_uri" value="<?php echo get_option('history_header_uri'); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">For the Love of Competition Header URL</th>
        <td><input type="text" name="competition_header_uri" value="<?php echo get_option('competition_header_uri'); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Zombie Nation Header URL</th>
        <td><input type="text" name="zombie_header_uri" value="<?php echo get_option('zombie_header_uri'); ?>" /></td>
        </tr>
        <tr valign="top">
        <td><strong>Affiliates Descriptions</strong></td>
        </tr>
        <tr valign="top">
        <th scope="row">Affiliates Description</th>
        <td><input type="text" name="affiliates_desc_uri" value="<?php echo get_option('affiliates_desc_uri'); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Military Arms Description</th>
        <td><input type="text" name="ma_desc_uri" value="<?php echo get_option('ma_desc_uri'); ?>" /></td>
        </tr>
        <tr valign="top">
        <td><strong>Subscribe</strong></td>
        </tr>
        <tr valign="top">
        <th scope="row">Subscription Form Action</th>
        <td><input type="text" name="subs_form_link" value="<?php echo get_option('subs_form_link'); ?>" /><p>(No slash at the end: 'http://www.example.com'.)</p></td>
        </tr>        
        <th scope="row">iMagID</th>
        <td><input type="text" name="iMagID" value="<?php echo get_option('iMagID'); ?>" /></br><p>(Leave this alone if you don't konw what this does.)</p></td>
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