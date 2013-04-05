<?php
/**
 * functions.php 
 */

define("JETPACK_SITE", "infisherman");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=01469&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=01469&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0Njk0NDY5NSZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 70% off<br/> the Cover Price");
define("DRUPAL_SITE", TRUE);

function if_addons_sidebar_init() {

$sidebar_defaults = array(
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title"><span>',
    'after_title' => '</span></h3>'
  );
  
register_sidebar(array_merge($sidebar_defaults, array(
    'id' => 'sidebar-community',
    'name' => 'Community Sidebar',
    'Shown on community pages.'
  )));
}
add_action( 'widgets_init', 'if_addons_sidebar_init' );

//Uses WordPress filter for image_downsize
function my_image_downsize($value = false,$id = 0, $size = "medium") {
	if ( !wp_attachment_is_image($id) )
		return false;
	$img_url = wp_get_attachment_url($id);
	
	$height;
	$width;
	
	//Mimic functionality in image_downsize function in wp-includes/media.php
	if ( $intermediate = image_get_intermediate_size($id, $size) ) {
		$img_url = str_replace(basename($img_url), $intermediate['file'], $img_url);
		$height = $intermediate['height'];
		$width = $intermediate['width'];
		
	}
	elseif ( $size == 'thumbnail' ) {
		// fall back to the old thumbnail
		if ( $thumb_file = wp_get_attachment_thumb_file() && $info = getimagesize($thumb_file) ) {
			$img_url = str_replace(basename($img_url), basename($thumb_file), $img_url);
			$width = $info[0];
			$height = $info[1];
		}
	}
	
	//Return the image and height and width
	if ( $img_url) {
		
		return array($img_url, $width, $height);
	}
	return false;
}
add_filter('image_downsize', 'my_image_downsize',1,3);


