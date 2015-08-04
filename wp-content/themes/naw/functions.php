<?php
define("JETPACK_SITE", "northamericanwhitetail");

define("FACEBOOK_LINK", "https://www.facebook.com/NAWhitetail");
define("TWITTER_LINK", "https://www.twitter.com/@NAWhitetail");
define("RSS_LINK", "http://www.northamericanwhitetail.com/feed/");
define("SITE_LINK", "northamericanwhitetail.com");
define("SITE_NAME", "North American Whitetail");

include_once('widgets/buck-contest.php');
include_once('widgets/get-app.php');
include_once("widgets/naw-community-slider.php");

function custom_post_author_archive( &$query )
{
    if ( $query->is_author )
        $query->set( 'post_type', 'reader_photos' );
    remove_action( 'pre_get_posts', 'reader_photos' ); // run once!
}
add_action( 'pre_get_posts', 'custom_post_author_archive' );

add_action( 'init', 'my_add_shortcodes' );

function my_add_shortcodes() {

	add_shortcode( 'my-login-form', 'my_login_form_shortcode' );
}
function my_login_form_shortcode() {

	if ( !is_user_logged_in() )
		

	echo '<p>Login to share a photo.</p>'.wp_login_form( array( 'echo' => false ) ).'<p>New to NAW Community? <a href="/register">Register Here</a></p><p><a href="'.wp_lostpassword_url().'">Lost Your Password?</a></p>';
}

/***
**
** Enqueue Scripts
**
***/
function naw_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script("cross-site-feed", get_template_directory_uri() . "/js/cross-site-feed.js");

}
add_action('wp_enqueue_scripts', 'naw_scripts_method');

function social_networks(){
	echo '<div class="socials">';
		echo '<a href="'.FACEBOOK_LINK.'" class="facebook">Facebook</a>';
	    echo '<a href="'.TWITTER_LINK.'" class="twitter">Twitter</a>';
	    echo '<a href="'.RSS_LINK.'" class="rss">RSS</a>';
	echo '</div>';
}



function social_footer(){ ?>
	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
<?php }

//Configure naw community
//This section does nothing unless imo-community plugin is enabled
add_action("init","naw_community_init",0);
function naw_community_init() {
	//////////////////////////////////
	//Community Configuration
	//////////////////////////////////
	//This Post Types array is used in multiple configurations
	$nawPostTypes = array(
		"report" => array(
			"display_name" => "State Rut Report",
			"post_list_style" => "tile"
		),
		"general" => array(
			"display_name" => "General Discussion",
			"post_list_style" => "tile"
		),
		"question" => array(
			"display_name" => "Questions",
			"post_list_style" => "tile"
		)
	);
	//External Community Configurations
	include("community-config/state-report.php");
	include("community-config/report.php");
	include("community-config/general.php");
	include("community-config/question.php");
	include("community-config/new-post.php");
	include("community-config/single.php");
	include("community-config/profile.php");
	include("community-config/edit-profile.php");
	include("community-config/admin.php");
	include("community-config/listing.php");
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//NOTE: Configuration order matters! More specific URLs should appear before less specific urls on the same path.
	// For example, the "single" page_type below needs to appear before "listing" page type on the same path.
	//Also, solunar-calendar-mobile should appear before solunar-calendar
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

add_action('init', 'cptui_register_my_cpt_reader_photos');
function cptui_register_my_cpt_reader_photos() {
	register_post_type(
		'reader_photos', array(
			'label' => 'Community',
			'description' => 'Upload a photo',
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
			  'name' => 'Community',
			  'singular_name' => 'Community',
			  'menu_name' => 'Community',
			  'add_new' => 'Add Community Photo',
			  'add_new_item' => 'Add New Community Photo',
			  'edit' => 'Edit',
			  'edit_item' => 'Edit Community Photo',
			  'new_item' => 'New Community Photo',
			  'view' => 'View Community Photo',
			  'view_item' => 'View Community Photo',
			  'search_items' => 'Search Community',
			  'not_found' => 'No Community Photo Found',
			  'not_found_in_trash' => 'No Community Photo Found in Trash',
			  'parent' => 'Parent Community',
			)
		)
	);


}
