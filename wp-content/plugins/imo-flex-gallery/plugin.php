<?php
/*
 * Plugin Name: IMO Flex Gallery
 * Plugin URI: http://github.com/imoutdoors
 * Description: Adds a shortcode for responsive Flex galleries. Requires NextGen Gallery and IMO Varnish Device Detection plugins.
 * Version: 0.3
 * Author: Salah for InterMedia Outdoors
 */

add_shortcode( 'imo-slideshow', 'imo_flex_gallery' );


// [slideshow gallery=GALLERY_ID]
function imo_flex_gallery( $atts ) {

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

	$title = stripcslashes($pictures[0]->title);
	$slides = '<div class="slideshow_mask image_slideshow_mask">
	  			<div class="slideshow">';
	$textSlides = '<div class="slideshow_mask text-slides">
	  			<div class="text-slideshow text-slides">';
	$thumbPager = '';
	$count = 0;
	$totalSlides = count($pictures);
	
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
	

	if (function_exists('imo_add_this')) {
		ob_start();
		imo_add_this();
		$addThis = ob_get_clean();
	}


	$desktop_tablet_output = <<<EOT_a1
	</div><!-- .entry-content -->
	<div class="flex-gallery-insertion-point"></div>
	<div class="flex-gallery-container">
	<div class="imo-flex-loading-block flex-gallery-inner">
		<div class="flex-gallery" id="gallery-$gallery_id">
		<div class="flex-gallery-title clearfix">
		    <h2>$title</h2>
			<div class="clear"></div>
			<div class="flex-gallery-social">$addThis</div><div class="flex-counter"><span class="flex-counter-extra">Picture </span><span class="current-slide">1</span> of $count</div>
		</div>
		<div class="clear"></div>
		    <ul class="slides">
EOT_a1;
	foreach ($pictures as $picture) {
		$picture->meta_data = unserialize($picture->meta_data);

		$picture->photo_desc = stripcslashes($picture->photo_desc);
		$picture->alttext = stripcslashes($picture->alttext);
		$picture->description = stripcslashes($picture->description);


$desktop_tablet_output .= <<<EOT_a2
		        <li class="flex-slide">

				
		            <img src="$picture->img_url" alt="$picture->alttext" class="slide-image">

					
					
		        </li>
EOT_a2;
	}
$desktop_tablet_output .= <<<EOT_a3
		    </ul>
		</div>
		<div class="flex-carousel" id="carousel-$gallery_id">
		    <ul class="slides">
EOT_a3;
	foreach ($pictures as $picture) {
$desktop_tablet_output .= <<<EOT_a4
		        <li>
		            <img src="$picture->thumbnail" alt="$picture->alttext">
		        </li>
EOT_a4;
	}
$desktop_tablet_output .= <<<EOT_a5_1
		    </ul>
		</div>
		<div class="flex-carousel-nav">
		</div>
		</div>
EOT_a5_1;
		//Just for viewing with the admin bar in the way
		//if(is_admin_bar_showing()) { $desktop_tablet_output .= '<style>.flex-gallery-slide-out{margin-top:-28px;}</style>'; }
$desktop_tablet_output .= <<<EOT_a5_2
		
		<div class="flex-gallery-slide-out" >
			<div class="slide-out-content">
						<span class="btn-full-screen">Fullscreen</span>
						<span class="x-close">&times;</span>
			<div class="clear"></div>
EOT_a5_2;
	$count = 1;
	foreach ($pictures as $picture) {
$desktop_tablet_output .= <<<EOT_a6
				<div id="flex-content-$count" class="flex-content">
						<span class="slide-out-content-title">$picture->alttext</span>
						<div class="clear"></div>
						$picture->description
				</div>
EOT_a6;
		$count++;
	}
$desktop_tablet_output .= <<<EOF_a
	
			</div>
			<div class="slide-out-ad">
				<iframe id="gallery-iframe-ad" height=280 width=330 src="/iframe-ad.php?ad_code=$dartDomain"></iframe>
			</div>
		</div>
		
</div><!-- .gallery-hover-div -->
<div class="background-overlay"></div>
<div class="entry-content">
		<script type="text/javascript">		
			//Setup Flex Slider
		    jQuery(function(){
		    	var fslider = 
				jQuery('#carousel-$gallery_id').flexslider({
					animation: "slide",
					controlNav: false,
					animationLoop: false,
					slideshow: false,
					itemWidth: 80,
					itemMargin: 0,
 					asNavFor: '#gallery-$gallery_id'
				});
				jQuery('#gallery-$gallery_id').flexslider({
		            animation: "slide",
					controlNav: false,
					animationLoop: true,
		            animationSpeed: 200,
		            slideshow: false,
					sync: '#carousel-$gallery_id',
		            start: function (slider) {
							imoFlexSetup();
		            },
		            after: function (slider) {
		                
		                _gaq.push(['_trackPageview',"/" + window.location.pathname + "#" + slider.currentSlide]);
		                document.getElementById('gallery-iframe-ad').contentWindow.location.reload();
						
						var totalSlides = '$totalSlides';
						var theSlide = slider.currentSlide+1;
						while(totalSlides > 0){
							jQuery('#flex-content-'+totalSlides).hide();
							totalSlides--;
						}
						jQuery('#flex-content-'+theSlide).show();
						jQuery('span.current-slide').text(theSlide);
						jQuery('.flex-content').perfectScrollbar('update');	

		            }
		        });
		    })
		</script>

EOF_a;



		

	$mobile_output = <<<EOT
	<div class="imo-flex-loading-block">
		<div class="jq-gallery-slider gallery-slider" id="gallery-$gallery_id">
		<div class="general-title clearfix">
		    <h2><span>$title</span></h2>
		</div>
		<iframe id="gallery-iframe-ad" width="320" height="50" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?size=320x50&ad_code=$dartDomain"></iframe>
		<span class="slide-count">$count</span>
		    <ul class="slides">
EOT;
	foreach ($pictures as $picture) {
		$picture->meta_data = unserialize($picture->meta_data);

		$picture->photo_desc = stripcslashes($picture->photo_desc);
		$picture->alttext = stripcslashes($picture->alttext);
		$picture->description = stripcslashes($picture->description);


$mobile_output .= <<<EOT2
		        <li>
		            <img src="$picture->img_url" alt="$picture->alttext">
		            <div class="feat-text">
		                <h3>$picture->alttext</h3>
						$picture->description
		            </div>
		        </li>
EOT2;
	}
$mobile_output .= <<<EOT3
		    </ul>
		</div>
		</div>

		<script type="text/javascript">
		    jQuery(function(){
		    	var fslider = jQuery('#gallery-$gallery_id').flexslider({
		            animation: "slide",
		            animationSpeed: 200,
		            slideshow: false,
		            start: function (slider) {

EOT3;
		                if (count($pictures) > 1) {
			                $mobile_output .= " updateSliderCounter(slider); ";
		                }

$mobile_output .= <<<EOFasdf

		            },
		            after: function (slider) {
		                updateSliderCounter(slider);
		                _gaq.push(['_trackPageview',"/" + window.location.pathname + "#" + slider.currentSlide]);
		                document.getElementById('gallery-iframe-ad').contentWindow.location.reload();

		            }
		        });
		    })
		</script>

EOFasdf;
		if($_SERVER['SERVER_NAME'] == "www.in-fisherman.com" || $_SERVER['SERVER_NAME'] == "www.in-fisherman.salah" || $_SERVER['SERVER_NAME'] == "www.in-fisherman.fox" || $_SERVER['SERVER_NAME'] == "www.in-fisherman.deva"){
			if (mobile()){
				return $mobile_output;
			}else{
                return $desktop_tablet_output;
			}
		} else {
            return $desktop_tablet_output;
		}
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
			if(mobile() == false){
			// enqueue here
			wp_enqueue_script('flex-gallery-js',plugins_url('flex-gallery.js', __FILE__));
            wp_enqueue_script('jquery-mobile',plugins_url('jquery.mobile.custom.min.js', __FILE__));
			wp_enqueue_script('jquery-scrollface',plugins_url('jquery.scrollface.min.js', __FILE__));
			wp_enqueue_script('jquery-buffet',plugins_url('jquery.buffet.min.js', __FILE__));
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-slide-effect',plugins_url('jquery-ui-slide-effect.min.js', __FILE__));
			wp_enqueue_script('jquery-mousewheel',plugins_url('jquery.mousewheel.min.js', __FILE__));
			wp_enqueue_script('perfect-scrollbar-js',plugins_url('perfect-scrollbar-0.4.3.with-mousewheel.min.js', __FILE__));
			wp_enqueue_style('ajax-gallery-css',plugins_url('flex-gallery.css', __FILE__));
			wp_enqueue_style('perfect-scrollbar-css',plugins_url('perfect-scrollbar-0.4.3.min.css', __FILE__));
			}


		}

	} else {//If there are no posts, such as a category page


			$cat = get_category( get_query_var( 'cat' ) );
			$categorySlug = $cat->slug;

			$slugArray = array("thanks-dad-iiyn","more-category-slugs-here");

			if (in_array($categorySlug, $slugArray)) {
				wp_enqueue_script('flex-gallery-js',plugins_url('flex-gallery.js', __FILE__));
           		wp_enqueue_script('jquery-mobile',plugins_url('jquery.mobile.custom.min.js', __FILE__));
				wp_enqueue_script('jquery-scrollface',plugins_url('jquery.scrollface.min.js', __FILE__));
				wp_enqueue_script('jquery-buffet',plugins_url('jquery.buffet.min.js', __FILE__));
				wp_enqueue_script('jquery-ui-draggable');
				wp_enqueue_script('jquery-mousewheel',plugins_url('jquery.mousewheel.min.js', __FILE__));
				wp_enqueue_script('perfect-scrollbar-js',plugins_url('perfect-scrollbar-0.4.3.with-mousewheel.min.js', __FILE__));
				wp_enqueue_style('ajax-gallery-css',plugins_url('flex-gallery.css', __FILE__));
				wp_enqueue_style('perfect-scrollbar-css',plugins_url('perfect-scrollbar-0.4.3.min.css', __FILE__));
			}


	}



	return $posts;
}

?>