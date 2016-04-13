<?php
/*
 * Plugin Name: OSG Gallery
 * Plugin URI: http://github.com/imoutdoors
 * Description: Adds a shortcode for responsive Flex galleries. Requires deactivation of IMO Flex Gallery. NextGen Gallery activation required for NextGen based galleries.
 * Version: 0.1
 * Author: Fox
 */


add_action('init', 'register_gallery_script');
add_action('wp_footer', 'print_gallery_script');

function register_gallery_script() {
	wp_register_script('flexslider-js', plugins_url('js/jquery.flexslider.js', __FILE__));
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
	$firstDescription = stripcslashes($pictures[0]->description);
	$firstDescription = htmlspecialchars($firstDescription);
	$firstImage = '<div class="flex-img-wrap"><img src="'.$pictures[0]->img_url.'" alt="'.$pictures[0]->title.'" title="'.$pictures[0]->title.'" /></div><p class="first-desc">'. $firstDescription .'</p>';

	$title = stripcslashes($pictures[0]->title);
	$slug = $pictures[0]->name;
	$prefix = $wpdb->prefix;
	
	$html = '<div class="osg-gallery"><div class="gallery-header"><div class="gallery-title">GALLERY: '. $title .'</div><div class="gallery-count"><span class="curr-count">1</span> of '. $totalSlidesShow .'</div></div>';
	
	$html .= '<div class="gallery-images"><ul class="slides">';
	
	$count = 1;
	foreach ($pictures as $picture) {
		if(!empty($picture->img_url)) {
			$picture->title = stripcslashes($picture->alttext);
			$desc = stripcslashes($picture->description);
			
			//$desc = str_replace(chr(146), "'", $desc);
			$desc = htmlspecialchars($desc);

			$imageURL = $picture->img_url;
			$imageTitle = $picture->title;
		}
			
		$html .= '<li class="flex-slide" url="'. $imageURL .'" style="display:none;"><div style="display:none;">'. $desc .'</div></li>';
	}
	
	$html .= '<li class="gallery-first-image flex-slide">'. $firstImage .'</li>';
	$html .= '</ul><span id="i_load_gallery"><i></i></span><section class="first-img-overlay"> <span><div class="loader-inner ball-pulse-sync"><div></div><div></div><div></div></div></span> </section></div>';

	$html .= '</ul></div></div>';
	
	return $html;

	
}


wp_enqueue_style('flexslider-css',plugins_url('css/flexslider.css', __FILE__));
wp_enqueue_style('gallery-css',plugins_url('css/style.css', __FILE__));













