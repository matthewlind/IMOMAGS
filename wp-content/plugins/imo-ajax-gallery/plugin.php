<?php
/*
 * Plugin Name: IMO Ajax Gallery
 * Plugin URI: http://github.com/imoutdoors
 * Description: Adds a shortcode for Ajax galleries (requires NextGen Gallery)
 * Version: 0.1
 * Author: Aaron Baker
 */

add_shortcode( 'imo-slideshow', 'slideshow_gallery' );

// [slideshow gallery=GALLERY_ID]
function slideshow_gallery( $atts ) {


	extract(
    shortcode_atts(
      array(
        'gallery' => 1,
        'tag' => null,
      ),
      $atts
    )
  );

	return displayGallery($gallery,$tag);

}


function displayGallery($gallery_id,$tag) {

	$dartDomain = get_option("dart_domain", $default = false);

	global $wpdb;

	$prefix = $wpdb->prefix;

  if (!$tag) {
  	$pictures = $wpdb->get_results($wpdb->prepare(
      "SELECT * , CONCAT('/' , path, '/' , filename) as img_url, CONCAT('/' , path, '/thumbs/thumbs_' , filename) as thumbnail, meta_data, pictures.description as photo_desc
      from {$prefix}ngg_gallery as gallery
      JOIN `{$prefix}ngg_pictures` as pictures ON (gallery.gid = pictures.galleryid)
      WHERE gallery.gid = %d
      ORDER BY sortorder asc",
      $gallery_id
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
      $gallery_id,
      $tag
      )
    );

  }


  _log($pictures);



	$title = stripcslashes($pictures[0]->title);



	$slides = '<div class="slideshow_mask image_slideshow_mask">
	  			<div class="slideshow">';


	$textSlides = '<div class="slideshow_mask text-slides">
	  			<div class="text-slideshow text-slides">';

	$thumbPager = "";

	$count = 0;
	foreach ($pictures as $picture) {

		$count++;




		$picture->meta_data = unserialize($picture->meta_data);

		$picture->photo_desc = stripcslashes($picture->photo_desc);
		$picture->alttext = stripcslashes($picture->alttext);

		 // echo "<pre>";
		 // print_r($picture);
		 // echo "</pre>";


		$class = "";
		if ($count == 1) {
			$class = "active";
		}


		$height = $picture->meta_data["height"];
		$width = $picture->meta_data["width"];

		$slides .=  "<div class='slide'><div class='pic'><img src='$picture->img_url' image-height=$height image-width=$width></div></div>";

		$textSlides .=  "<div class='slide' style='display:none'><div class='scroll-content'><h2>{$picture->alttext}</h2>
				<p>{$picture->photo_desc}</p></div></div>";

		$thumbPager .= "<li><div class='thumb-container $class'><a><img src='{$picture->thumbnail}' class='slideshow-thumb' /></a><div></li>";
	}

	$slides .= "</div>
				</div>";

	$textSlides .= "</div>
					</div>";

	$output .= <<<EOT
	<div class="gallery-hover-div" style="z-index:6000">
		<div class="gallery-slide-out" style="">
			<div class="x-close">&times;</div>
			<div class="slide-out-content">

				$textSlides

			</div>
			<div class="slide-out-ad">
				<iframe id="gallery-iframe-ad" height=280 width=330 src="/iframe-ad.php?ad_code=$dartDomain"></iframe>
			</div>
		</div>
		<div class="ngg-imagebrowser">

			<div class="ngg-imagebrowser-nav">
				<div class="back">
					<a class="ngg-browser-prev" id="ngg-prev-1473" href="">&#9668; Back</a>
				</div>

				<div class="next">
					<a class="ngg-browser-next" id="ngg-next-1476" href="">Next &#9658;</a>
				</div>
		        <div class="ajax-counter">Picture <span class="current-image">1</span> of $count</div>
		                <div class="ngg-imagebrowser-desc"><h3>$title</h3></div>
			</div>
			<div class="slide-container">
				<div class="hidden-arrows" style="z-index:99999">
					<div class="back">
						<a href="" class="thumb-arrow" style="display:none;z-index:99999">&#9668; Back</a>
					</div>
					<div class="next">
						<a href="" class="thumb-arrow" style="display:none;z-index:99999">Next &#9658;</a>
					</div>
				</div>
				$slides
			</div>
			<div id="slideshow-pager">
				<ul class="thumb-pager">
					$thumbPager
				</ul>

			</div>
			<div id="thumb-button-holder">
				<a id="thumb-prev" class="thumb-arrow"></a>
				<a id="thumb-next" class="thumb-arrow"></a>
			</div>


		</div>
	</div>


EOT;

	return $output;
}














//Since we don't want to add the scripts to every page, we check to see if we need them before adding
add_filter('the_posts', 'conditionally_add_scripts_and_styles'); // the_posts gets triggered before wp_head
function conditionally_add_scripts_and_styles($posts){



	if (!empty($posts)) {

		$shortcode_found = false; // use this flag to see if styles and scripts need to be enqueued
		foreach ($posts as $post) {
			if (stripos($post->post_content, '[imo-slideshow') !== false) {
				$shortcode_found = true; // bingo!
				break;
			}
		}

		if ($shortcode_found) {
			// enqueue here
			wp_enqueue_script('ajax-gallery-js',plugins_url('ajax-gallery.js', __FILE__));
			wp_enqueue_script('jquery-scrollface',plugins_url('jquery.scrollface.min.js', __FILE__));
			wp_enqueue_script('jquery-buffet',plugins_url('jquery.buffet.min.js', __FILE__));
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-mousewheel',plugins_url('jquery.mousewheel.min.js', __FILE__));
			wp_enqueue_script('jquery-mCustomScrollbar',plugins_url('jquery.mCustomScrollbar.js', __FILE__));
			wp_enqueue_style('ajax-gallery-css',plugins_url('ajax-gallery.css', __FILE__));
			wp_enqueue_style('ajax-mCustomScrollbar-css',plugins_url('jquery.mCustomScrollbar.css', __FILE__));
		}

	} else {//If there are no posts, such as a category page


			$cat = get_category( get_query_var( 'cat' ) );
			$categorySlug = $cat->slug;

			$slugArray = array("thanks-dad-iiyn","more-category-slugs-here");

			if (in_array($categorySlug, $slugArray)) {
				wp_enqueue_script('ajax-gallery-js',plugins_url('ajax-gallery.js', __FILE__));
				wp_enqueue_script('jquery-scrollface',plugins_url('jquery.scrollface.min.js', __FILE__));
				wp_enqueue_script('jquery-buffet',plugins_url('jquery.buffet.min.js', __FILE__));
				wp_enqueue_script('jquery-ui-draggable');
				wp_enqueue_script('jquery-mousewheel',plugins_url('jquery.mousewheel.min.js', __FILE__));
				wp_enqueue_script('jquery-mCustomScrollbar',plugins_url('jquery.mCustomScrollbar.js', __FILE__));
				wp_enqueue_style('ajax-gallery-css',plugins_url('ajax-gallery.css', __FILE__));
				wp_enqueue_style('ajax-mCustomScrollbar-css',plugins_url('jquery.mCustomScrollbar.css', __FILE__));
			}


	}



	return $posts;
}
?>

