<?php 

include("functions/profile.php");
include("plus/functions-plus.php");

// Thumbs
add_image_size('medium-thumb', 420, 330, true);
add_image_size('huge-thumb', 672, 407, true);
add_image_size('gear-thumb', 250, 250, true);
add_image_size('video-widget-thumb', 318, 228, true);
add_image_size('gallery-thumb', 'auto', 169, true);
add_image_size('gallery-grid', 158, 158, true);

// SHORTCODES
/*
 * [mm-current-issue]
 *
 * For use with the UberMenu plugin.
 *
 */
function mm_current_issue($atts, $content = null) {
	extract(shortcode_atts(array(
    "" => ""
	), $atts));
	
	$magazine_img = get_option("magazine_cover_uri", get_stylesheet_directory_uri(). "/img/magazine.png" );
  if (empty($magazine_img)) {
      $magazine_img = get_stylesheet_directory_uri(). "/img/magazine.png";
  }
	
	return '<div class="current-issue">
	        <h3 class="month">'.date("F, Y").'</h3>
	        <img src="'.$magazine_img.'" alt />
	        </div>
	        <ul class="subscriber-links">
	        <li class="subscribe"><a href="http://subs.northamericanwhitetail.com/">Subscribe</a></li>
	        <li><a href="http://subs.northamericanwhitetail.com/gift">Give a Gift</a></li>
            <li><a href="https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0OEQ0NDcyNCZpVHlwZT1FTlRFUg==">Subscriber Services</a></li>
            <li><a href="/contact/">Contact the Editors</a></li>
	        </ul>';
}

add_shortcode("mm-current-issue", "mm_current_issue");


/***
**
** Enqueue Scripts
**
***/
function naw_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script("jquery-simplemodal", get_stylesheet_directory_uri() . "/js/jquery.simplemodal.1.4.2.min.js");
    wp_enqueue_script("cross-site-feed", get_stylesheet_directory_uri() . "/js/cross-site-feed.js");
    wp_enqueue_script("local-site-feed", get_stylesheet_directory_uri() . "/js/local-site-feed.js");
    wp_enqueue_script("date", get_stylesheet_directory_uri() . "/js/date.js");

}    
 
add_action('wp_enqueue_scripts', 'naw_scripts_method');

// Widget structure
function naw_imo_addons_sidebar_init() {
  
  $sidebar_defaults = array(
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title"><span>',
    'after_title' => '</span></h3>'
  );
  
  register_sidebar(array_merge($sidebar_defaults, array(
    'id' => 'sidebar-default',
    'name' => 'Sidebar Default',
    'Shown on blog posts and archives.'
  )));

  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-home-top',
      'name' => __('Top Homepage Sidebar', 'carrington-business'),
      'description' => __('Shown on the top right of the homepage.', 'carrington-business')
  )));
  
  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-home-bottom',
      'name' => __('Bottom Homepage Sidebar', 'carrington-business'),
      'description' => __('Shown on the bottom right of the homepage.', 'carrington-business')
  )));
  register_sidebar(array_merge($sidebar_defaults, array(
    'id' => 'gear-home',
    'name' => __('Homepage Gear Slider', 'carrington-business'),
    'description' => __('Gear slider near bottom of the homepage', 'carrington-business')
  )));
  register_sidebar(array_merge($sidebar_defaults, array(
    'id' => 'secondary-home',
    'name' => __('Homepage Secondary', 'carrington-business'),
    'description' => __('area below main and sidebar columns on the homepage', 'carrington-business')
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
      'id' => 'superpost-sidebar',
      'name' => __('Superpost Single Sidebar', 'carrington-business'),
      'description' => __('Sidebar for Superposts.', 'carrington-business')
  )));
  
  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'state-sidebar',
      'name' => __('State Page Sidebar', 'carrington-business'),
      'description' => __('Sidebar for State Pages.', 'carrington-business')
  )));
  
  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-community',
      'name' => __('Community Page Sidebar', 'carrington-business'),
      'description' => __('Sidebar for Community Page and Community Post Page.', 'carrington-business')
  )));
    
}
add_action( 'widgets_init', 'naw_imo_addons_sidebar_init' );


include_once get_stylesheet_directory().'/widgets/newsletter-signup.php';
include_once get_stylesheet_directory().'/widgets/join.php';
include_once get_stylesheet_directory().'/widgets/get-app.php';
include_once get_stylesheet_directory().'/widgets/video-callout.php';
include_once get_stylesheet_directory().'/widgets/gallery-loop.php';
include_once get_stylesheet_directory().'/widgets/superpost-thumbs-grid.php';
include_once get_stylesheet_directory().'/widgets/superpost-thumbs-scroller.php';
include_once get_stylesheet_directory().'/widgets/community-topics.php';
include_once get_stylesheet_directory().'/widgets/browse-community.php';
include_once get_stylesheet_directory().'/widgets/questions-widget.php';
include_once get_stylesheet_directory().'/widgets/questions-list-widget.php';
include_once get_stylesheet_directory().'/widgets/us-map.php';
include_once get_stylesheet_directory().'/widgets/community-menu.php';
include_once get_stylesheet_directory().'/widgets/gear-grid.php';
include_once get_stylesheet_directory().'/widgets/buck-contest.php';
include_once get_stylesheet_directory().'/widgets/user-info.php';


//Configure infish community
//This section does nothing unless imo-community plugin is enabled
add_action("init","naw_community_init");
function naw_community_init() {

	//////////////////////////////////
	//Community Configuration
	//////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "beta-community";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Beta Community Admin';
	$IMO_COMMUNITY_CONFIG['template'] = '/templates/blank-template.php';
	$IMO_COMMUNITY_CONFIG['post_types'] = array(
	
		"report" => array(
			"display_name" => "Rut Reports",
			"post_list_style" => "tile"
		),
	
		"question" => array(
			"display_name" => "Q&A",
			"post_list_style" => "list"
		),
	
		"general" => array(
			"display_name" => "general",
			"post_list_style" => "list"
		)
	
	);
	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		//Third Part Scripts
		array(
			"script-name" => "underscore-js",
			"script-path" => "js/underscore-min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "backbone-js",
			"script-path" => "js/backbone-min.js",
			"script-dependencies" => array('jquery','underscore-js')
		),
		array(
			"script-name" => "form-params-js",
			"script-path" => "js/formParams.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "filepicker-io-js",
			"script-path" => "js/filepicker.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "imo-community-grid-js",
			"script-path" => "js/backgrid.min.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js')
		),
		//Application specific scripts				
		array(
			"script-name" => "imo-community-common",
			"script-path" => "js/common.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js')
		),
		array(
			"script-name" => "imo-community-models",
			"script-path" => "js/models.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-common')
		),
		array(
			"script-name" => "imo-community-mod",
			"script-path" => "js/mod2.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-models','imo-community-common')
		),
		array(
			"script-name" => "imo-community-community",
			"script-path" => "js/community.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-models','imo-community-common','imo-community-mod')
		),
		array(
			"script-name" => "imo-community-routes",
			"script-path" => "js/routes.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-community','imo-community-mod')
		),
		array(
			"script-name" => "backgrid-select-all",
			"script-path" => "js/backgrid-select-all.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-grid-js','custom.js','jquery.timeago.js')
		)
	
	);
	
	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "imo-community-stylesheet-main",
			"style-path" => "css/bootstrap.min.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "imo-community-grid-css",
			"style-path" => "css/backgrid.min.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "styles-select-all",
			"style-path" => "css/styles-select-all.css",
			"style-dependencies" => array('custom.css')
		),
	);
	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['beta-community'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////
	/////////////////////////////////////////////////
	
	
}





