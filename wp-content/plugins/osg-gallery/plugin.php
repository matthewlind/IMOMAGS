<?php
/*
 * Plugin Name: OSG Gallery
 * Plugin URI: http://github.com/imoutdoors
 * Description: Adds a shortcode for responsive Flex galleries. Requires deactivation of IMO Flex Gallery. NextGen Gallery activation required for NextGen based galleries.
 * Version: 0.1
 * Author: Fox
 */
// Gallery ACF Options
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_gallery-color-option',
		'title' => 'Gallery Color Option',
		'fields' => array (
			array (
				'key' => 'field_5730baf4af6c1',
				'label' => 'Gallery Color',
				'name' => 'gallery_color',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '#000000',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

add_action('init', 'register_gallery_script');
add_action('wp_footer', 'print_gallery_script');
function register_gallery_script() {
	wp_register_script('flexslider-js', get_template_directory_uri().'/plugins/flexslider/jquery.flexslider.js');
	wp_register_script('gallery-js', plugins_url('js/gallery.js', __FILE__));
}
function print_gallery_script() {
	global $add_gallery_script;
	if ( ! $add_gallery_script )
		return;
		
	wp_print_scripts('flexslider-js');
	wp_print_scripts('gallery-js');
}
add_shortcode( 'imo-slideshow', 'imo_flex_gallery' );
// [slideshow gallery=GALLERY_ID]
function imo_flex_gallery( $atts ) {
	global $add_gallery_script;
	$add_gallery_script = true;
		
	$dartDomain = get_option("dart_domain", $default = false);
	extract(
		shortcode_atts(
			array(
				'gallery' => null,
				'tag' => null
			),
			$atts
		)
	);
	$baseUrl = get_bloginfo('url');
	global $wpdb;
	$prefix = $wpdb->prefix;
    if (!$tag) {
	  	$pictures = $wpdb->get_results($wpdb->prepare(
	      "SELECT * , CONCAT('/' , path, '/' , filename) as img_url, CONCAT('/' , path, '/thumbs/thumbs_' , filename) as thumbnail, meta_data, pictures.description as photo_desc
	      from {$prefix}ngg_gallery as gallery
	      JOIN `{$prefix}ngg_pictures` as pictures ON (gallery.gid = pictures.galleryid)
	      WHERE gallery.gid = %d
	      ORDER BY sortorder asc",
	      $gallery
	      )
	    );
    } else {
  	$pictures = $wpdb->get_results($wpdb->prepare(
      "SELECT * , CONCAT('/' , path, '/' , filename) as img_url, CONCAT('/' , path, '/thumbs/thumbs_' , filename) as thumbnail, meta_data, pictures.description as photo_desc
		from {$prefix}ngg_gallery as gallery
		JOIN `{$prefix}ngg_pictures` as pictures ON (gallery.gid = pictures.galleryid)
		JOIN {$prefix}term_relationships as relationships ON (pictures.pid = relationships.object_id)
		JOIN {$prefix}term_taxonomy as term_taxonomy ON (relationships.term_taxonomy_id = term_taxonomy.term_taxonomy_id)
		JOIN {$prefix}terms as terms ON (terms.term_id = term_taxonomy.term_id)
		WHERE gallery.gid = %d
		AND terms.slug = %s
		ORDER BY sortorder asc",
      $gallery,
      $tag
      )
    );
  }
  
	$totalSlides = count($pictures);
	$totalSlidesShow = $totalSlides;
	
	global $wpdb;
	$firstPicture = str_replace("//", "/", $pictures[0]->img_url);
	$firstDescription = htmlspecialchars(str_replace('\\', '', "<h2>".$pictures[0]->alttext."</h2>".$pictures[0]->description));
	$firstImage = '<div class="flex-img-wrap"><img src="'.$firstPicture.'" alt="'.$pictures[0]->title.'" title="'.$pictures[0]->title.'" /></div><div class="first-desc gallery-desc">'.$firstDescription.'</div>';
	$title = stripcslashes($pictures[0]->title);
	$slug = $pictures[0]->name;
	$prefix = $wpdb->prefix;
	$galleryColor = get_field("gallery_color","options");
	if($galleryColor == NULL){
		$galleryColor = "#000000";
	}
	$html = '<div class="osg-gallery"><style type="text/css">.gallery-header{background: '. $galleryColor .';}.span-load-gallery i, .flex-direction-nav a:before, .flex-direction-nav a.flex-prev:before,.flex-direction-nav a.flex-next:before{border-color: transparent '. $galleryColor .'; }
</style><div class="gallery-header"><div class="gallery-title" slug="'. $slug .'">GALLERY: '. $title .'</div><div class="gallery-count"><span class="curr-count">1</span> of '. $totalSlidesShow .'</div></div>';
	
	$html .= '<div id="gallery-start" class="gallery-images"><ul class="slides">';
	$html .= '<li class="gallery-first-image">'. $firstImage .'</li>';
	$count = 1;
	foreach ($pictures as $picture) {
		if(!empty($picture->img_url)) {
			$picture->title = stripcslashes($picture->alttext);
			$desc = stripcslashes($picture->description);
			//$desc = str_replace(chr(146), "'", $desc);
			$desc = htmlspecialchars("<h2>".$picture->title."</h2>".$desc);
			$imageURL = str_replace("//", "/", $picture->img_url);
			
		}
			
		$html .= '<li class="flex-slide is-flex-image" url="'. $imageURL .'" style="display:none;"><div style="display:none;">'. $desc .'</div></li>';
	}
	
	
	$html .= '</ul><span class="span-load-gallery"><i></i></span><section class="first-img-overlay"> <span><div class="loader-inner ball-pulse-sync"><div></div><div></div><div></div></div></span> </section></div>';
		
	return $html;
}

wp_enqueue_style('flexslider-css',get_template_directory_uri().'/plugins/flexslider/flexslider.css');
wp_enqueue_style('gallery-css',plugins_url('css/style.css', __FILE__));

