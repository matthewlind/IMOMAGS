<?php
/*
 * Plugin Name: IMO Flex Gallery
 * Plugin URI: http://github.com/imoutdoors
 * Description: Adds a shortcode for responsive Flex galleries. Requires deactivation of IMO Ajax Gallery and activation of IMO Varnish Device Detection. NextGen Gallery activation required for NextGen based galleries (not community). IMO Community API activation required for comunity galleries.
 * Version: 0.6
 * Author: Salah for InterMedia Outdoors
 */

add_shortcode( 'imo-slideshow', 'imo_flex_gallery' );

// [slideshow gallery=GALLERY_ID]
function imo_flex_gallery( $atts ) {
	$dartDomain = get_option("dart_domain", $default = false);
	extract(
		shortcode_atts(
			array(
				'gallery' => null,
				'community' => 'false',
				'tag' => null,
			),
			$atts
		)
	);
	if($community == 'true' || $community == 'yes' || $community == 'on' || $community == '1') {
		$community = true;
		return imoCommunityGallery($gallery, $community, $tag, $dartDomain);
	} else {
		$community = 0;//zero instead of false
		if(!$gallery) $gallery = 1;
		return imoGallery($gallery, $community, $tag, $dartDomain);
	}

}

function imoCommunityGallery($gallery, $community, $tag, $dartDomain) {
	$baseUrl = get_bloginfo('url');
	
	//Retrieve and sort JSON data
	if($_GET['gallery_sort']) {
		if($gallery) {
			if($gallery == 'master-angler') {
				if($_GET['gallery_sort'] == 'master-angler') {
					$jsonData = file_get_contents($baseUrl.'/community-api/posts?sort=DESC&master=1');
				}  else {
					$jsonData = file_get_contents($baseUrl.'/community-api/posts?sort=DESC&order_by='.$_GET['gallery_sort']);
				}
			} else {
				if($_GET['gallery_sort'] == 'master-angler') {
					$jsonData = file_get_contents($baseUrl.'/community-api/posts?sort=DESC&master=1&post_type='.$gallery );
				} else {
					$jsonData = file_get_contents($baseUrl.'/community-api/posts?sort=DESC&post_type='.$gallery.'&order_by='.$_GET['gallery_sort']);
				}
			}
		} else {
			if($_GET['gallery_sort'] == 'master-angler') {
				$jsonData = file_get_contents($baseUrl.'/community-api/posts?sort=DESC&master=1');
			} else {
				$jsonData = file_get_contents($baseUrl.'/community-api/posts?sort=DESC&order_by='.$_GET['gallery_sort']);
			}
			$gallery = 'all';
		}
	} else {
		if($gallery) {
			if($gallery == 'master-angler') {
				$jsonData = file_get_contents($baseUrl.'/community-api/posts?sort=DESC&master=1');
			} else {
				$jsonData = file_get_contents($baseUrl.'/community-api/posts?sort=DESC&post_type='.$gallery);
			}
		} else {
			$jsonData = file_get_contents($baseUrl.'/community-api/posts?sort=DESC');
			$gallery = 'all';
		}
	}
	$pictures = json_decode($jsonData);
	$emptySlides = 0;
	foreach ($pictures as $picture) {if(empty($picture->img_url)) $emptySlides = $emptySlides + 1;}
	$totalSlides = count($pictures) - $emptySlides;
	return galleryOutput($gallery, $pictures, $totalSlides, $dartDomain, $community, $baseUrl);
}


function imoGallery($gallery, $community, $tag, $dartDomain) {
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
	return galleryOutput($gallery, $pictures, $totalSlides, $dartDomain, $community, $baseUrl);
}

function galleryOutput($gallery, $pictures, $totalSlides, $dartDomain, $community, $baseUrl) {
	if (function_exists('imo_add_this')) {
		ob_start();
		imo_add_this();
		$addThisLegacy = ob_get_clean();
	}
	if($community == true ) {
		$communityClass = 'flex-community-gallery';
	} else {
		$title = stripcslashes($pictures[0]->title);
	}
	if(is_single()){
		$entryContentClose = '</div><!-- .entry-content -->';
		$entryContentOpen = '<div class="entry-content">';
	}
	if($community == true ) {
		$addThis = '<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4de0e5f24e016c81"></script>';
	} else {
		$addThis = $addThisLegacy;
	}
	$desktop_tablet_output = <<<EOT_a1
	$entryContentClose
	<div class="flex-gallery-insertion-point"></div>
	<div class="flex-gallery-container $communityClass">
	<div class="imo-flex-loading-block flex-gallery-inner">
		<div class="flex-gallery" id="gallery-$gallery" style="visibility:hidden;">
		<div id="flex-gallery-top-left">
			<div class="flex-gallery-title clearfix">
			<a class="btn-full-screen flex-gallery-button">Fullscreen</a>
				<h2>$title</h2>
				<div class="clear"></div>	
				<div id="flex-gallery-social">$addThis</div><div class="flex-counter"><span class="flex-counter-extra">Picture </span><span class="current-slide">1</span> of $totalSlides</div>
			</div>
			<div class="clear"></div>
		</div>
		    <ul class="slides">
EOT_a1;
	$count = 1;
	foreach ($pictures as $picture) {
		if(!empty($picture->img_url)) {
			if($community == true ) {
				$picture->img_url = $picture->img_url;
				//$picture->img_url = $baseUrl.$picture->img_url;
				$picture->thumbnail = $picture->img_url.'/convert?rotate=0&w=60&h=45&fit=crop';
				$picture->description = $picture->body;
				$image = '<img src="'.$picture->img_url.'/convert?rotate=0" alt="'.$picture->title.'" class="slide-image">';
			} else {
				$picture->title = stripcslashes($picture->alttext);
				//$picture->descriptionRaw = stripcslashes($picture->description);
				//$picture->description = strip_tags($picture->description, '<p><a><br><b><i><strong><u>');
				$picture->description = stripcslashes($picture->description);
				$image = '<img src="'.$picture->img_url.'" alt="'.$picture->title.'" class="slide-image">';
			}
			
			$addThis .= '
				<div id="flex-addthis-'.$count.'" class="flex-addthis">
					<div addthis:url="'.$baseUrl.'/photos/'.$picture->id.'" addthis:title="'.htmlentities($picture->title).'" class="addthis_toolbox addthis_default_style ">
						<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
						<a class="addthis_button_tweet"></a>
						<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
						<a class="addthis_counter addthis_pill_style"></a>
					</div>
				</div>
			';
$desktop_tablet_output .= <<<EOT_a2
		        <li class="flex-slide flex-slide-$count">				
		           $image				
		        </li>
EOT_a2;
		$count++;
		}
	}
$desktop_tablet_output .= <<<EOT_a3
		    </ul>
		</div>
		<div class="flex-carousel" id="carousel-$gallery">
		    <ul class="slides">
EOT_a3;
	foreach ($pictures as $picture) {
		if(!empty($picture->img_url)) {
$desktop_tablet_output .= <<<EOT_a4
		        <li>
		           <span class="flex-thumb-wrap"><img src="$picture->thumbnail" alt="$picture->title"></span>
		        </li>
EOT_a4;
		}
	}
$desktop_tablet_output .= <<<EOT_a5_1
		    </ul>
		</div>
		<div class="flex-carousel-nav"></div>
		<div class="flex-carousel-fade-left"></div><div class="flex-carousel-fade-right"></div>
		</div>
EOT_a5_1;
		//Just for viewing with the admin bar in the way
		if(is_admin_bar_showing()) { $desktop_tablet_output .= '<style>.flex-gallery-slide-out{margin-top:-28px;}</style>'; }
$desktop_tablet_output .= <<<EOT_a5_2
		
		<div class="flex-gallery-slide-out $communityClass" >
			<div class="flex-gallery-slide-out-inner" >
				<div class="slide-out-content">
					<div class="slide-out-content-top">
						<span class="x-close">&times;</span>
					</div>
					<div class="community-only">
						<a href="$baseUrl/photos/new" class="flex-gallery-button post-a-photo community-only"><span><span class="post-a-photo-icon"></span>Post a Photo</span></a>
						<div class="clear"></div>
						<form>
							<select class="community-select flex-gallery-select">
								<option value="">Sort posts by...</option>
								<option value="created">Latest</option>
								<option value="share_count_today">Trending Today</option>
								<option value="share_count_week">Trending This Week</option>
								<option value="master-angler">Master Anglers</option>
							</select>
						</form>
					</div>
					<div class="clear"></div>
EOT_a5_2;
	$count = 1;
	foreach ($pictures as $picture) {
		if(!empty($picture->img_url)) {
			if($picture->comment_count > 0) {
				if($picture->comment_count == 1) {
					$replies = '<span class="flex-gallery-replies">1 Reply</span>';
				} else {
					$replies = '<span class="flex-gallery-replies">'.$picture->comment_count.' Replies</span>';	
				}
			}
			if($community == true){
				$pictureTitle = '<a href="'.$baseUrl.'/photos/'.$picture->id.'">'.$picture->title.'</a>';
			} else {
				$pictureTitle = $picture->title;
			}
$desktop_tablet_output .= <<<EOT_a6
					<span id="flex-content-title-$count" class="slide-out-content-title">$pictureTitle</span>
					<div class="clear"></div>
					<div id="flex-content-$count" class="flex-content">
							<div class="clear"></div>
							$picture->description
					</div>
					<div class="community-only">
						<div id="flex-content-community-$count" class="slide-out-community-features">
								$replies<a href="$baseUrl/photos/$picture->id#reply_field" class="flex-gallery-button">Post a Reply</a>
								<div class="clear"></div>
						</div>
					</div>
EOT_a6;
		$count++;
		}
	}
$desktop_tablet_output .= <<<EOF_a
	
				</div>
				<div class="slide-out-ad">
					<iframe id="gallery-iframe-ad" height=280 width=330 src="/iframe-ad.php?ad_code=$dartDomain"></iframe>
				</div>
			</div>
		</div>
</div><!-- .flex-gallery-container -->
	<div class="flex-gallery-jquery-container">
		<div class="flex-gallery-jquery">
			<script type="text/javascript">	imoFlexInitiate($community, "$gallery", $totalSlides, false);</script>
		</div>
	</div>
<div id="flex-gallery-social-save" class="display-none">$addThis</div>
<div class="background-overlay"></div>
$entryContentOpen
EOF_a;

/* Begin Mobile */
		
if($community == true) {
	$pictureLimit = 20;
	$mobile_output = <<<EOT
<div class="flex-gallery-insertion-point"></div>
<div class="imo-flex-mobile imo-flex-loading-block">    
<div class="explore-more-mobile-container">
     <div class="explore-more-mobile">
        <div class="general-title clearfix">
            <h2><span>Explore</span></h2>
				<form>
					<select id="sort-posts" class="community-select flex-gallery-select-mobile">
						<option value="">Sort posts by...</option>
						<option value="created">Latest</option>
						<option value="share_count_today">Trending Today</option>
						<option value="share_count_week">Trending This Week</option>
						<option value="master-angler">Master Anglers</option>
					</select>
				</form>
        </div>
        <div class="explore-posts">
            <div class="jq-explore-slider">
                <ul class="slides">       
EOT;
	$count = 0;
	foreach ($pictures as $picture) {
    	if(!empty($picture->img_url) && $count < $pictureLimit) {
		$picture->meta_data = unserialize($picture->meta_data);

		$picture->photo_desc = stripcslashes($picture->photo_desc);
		$picture->alttext = stripcslashes($picture->alttext);
		$picture->description = stripcslashes($picture->description);


$mobile_output .= <<<EOT2
		        <li>
		            <a href="$baseUrl/photos/$picture->id"><img src="$picture->img_url/convert?rotate=0&w=119&h=89&fit=crop" alt="$picture->alttext" ></a>
		        </li>
EOT2;
		$count++;
		}
	}
$mobile_output .= <<<EOFmobile_community
                </ul>
            </div>
        </div>      
    </div>   
		<script type="text/javascript">
			imoFlexSetupMobile($community, $pictureLimit);
		</script>
</div>
</div>
EOFmobile_community;
} else {
	$mobile_output = <<<EOT
	<div class="loading-block">
		<div class="jq-gallery-slider gallery-slider" id="gallery-$gallery">
		<div class="general-title clearfix">
		    <h2><span>$title</span></h2>
		</div>
		<iframe id="gallery-iframe-ad" width="320" height="50" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?size=320x50&ad_code=$dartDomain"></iframe>
		<span class="slide-count">$totalSlides</span>
		    <ul class="slides">
EOT;
	foreach ($pictures as $picture) {
    	if(!empty($picture->img_url)) {
		$picture->meta_data = unserialize($picture->meta_data);

		$picture->photo_desc = stripcslashes($picture->photo_desc);
		$picture->alttext = stripcslashes($picture->alttext);
		$picture->description = stripcslashes($picture->description);


$mobile_output .= <<<EOT2
		        <li>
		            <img src="$picture->img_url/convert?w=119&h=119&fit=crop" alt="$picture->alttext">
		            <div class="feat-text">
		                <h3>$picture->alttext</h3>
						$picture->description
		            </div>
		        </li>
EOT2;
		}
	}
$mobile_output .= <<<EOT3
		    </ul>
		</div>
		</div>


		<script type="text/javascript">
		    jQuery(function(){
				function positionNavArrows() {
					//var arrowNavTop = jQuery('.gallery-slider .slide-count').outerHeight() + jQuery('.gallery-slider .gallery-iframe-ad').outerHeight() + jQuery('.gallery-slider .general-title').outerHeight() + ((jQuery('.gallery-slider ul.slides').height() - jQuery('.gallery-slider .feat-text').outerHeight())/2) - (jQuery('.gallery-slider .flex-direction-nav a').height()/2) + 20;
					var arrowNavTop = 20 + jQuery('.gallery-slider .slide-count').outerHeight() + jQuery('.gallery-slider .gallery-iframe-ad').outerHeight() + jQuery('.gallery-slider .general-title').outerHeight() + (jQuery('.gallery-slider ul.slides .flex-active-slide img:first').height()/2);
					if(jQuery('.gallery-slider ul.slides .flex-active-slide img:first').height() < 200) {
						var arrowNavTop = arrowNavTop + 10;
					}
					jQuery('.gallery-slider .flex-direction-nav a').css({
						'margin-top': 0,
						'top':arrowNavTop
					});
				}
		    	var fslider = jQuery('#gallery-$gallery').flexslider({
		            animation: "slide",
		            animationSpeed: 200,
		            slideshow: false,
		            start: function (slider) {
						positionNavArrows();		
EOT3;
		                if (count($pictures) > 1) {
			                $mobile_output .= " updateSliderCounter(slider); ";
		                }

$mobile_output .= <<<EOFmobile_standard

		            },
		            after: function (slider) {
						positionNavArrows();
						updateSliderCounter(slider);
		                _gaq.push(['_trackPageview',"/" + window.location.pathname + "#" + slider.currentSlide]);
		                document.getElementById('gallery-iframe-ad').contentWindow.location.reload();

		            }
		        });


					jQuery(window).bind('resize', function () { 
						positionNavArrows();
					});
		    })
		</script>
EOFmobile_standard;
}
		if($_SERVER['SERVER_NAME'] == "www.in-fisherman.com" || $_SERVER['SERVER_NAME'] == "www.in-fisherman.salah" || $_SERVER['SERVER_NAME'] == "www.in-fisherman.fox" || $_SERVER['SERVER_NAME'] == "www.in-fisherman.deva"){
			if (mobile()){
				return $mobile_output;
			}else{
            	//return $mobile_output;
               	return $desktop_tablet_output;
			}
		} else {
            return $desktop_tablet_output;
		}
}

//Since we don't want to add the scripts to every page, we check to see if we need them before adding

add_filter('posts_request', 'conditionally_add_scripts_and_styles');
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
        	//Enqueue for Mobile Community
            if(mobile() == true) {
            	wp_enqueue_script('flex-gallery-js',plugins_url('flex-gallery.js', __FILE__));
                wp_enqueue_style('ajax-gallery-css',plugins_url('flex-gallery.css', __FILE__));
            	wp_enqueue_script('flexslider-js',plugins_url('jquery.flexslider.js', __FILE__));
                wp_enqueue_style('flexslider-css',plugins_url('flexslider.css', __FILE__));
                
            }
           

			if(mobile() == false){
			//Enqueue Desktop/Tablet Only
            wp_enqueue_script('flexslider-js',plugins_url('jquery.flexslider.js', __FILE__));
            wp_enqueue_style('flexslider-css',plugins_url('flexslider.css', __FILE__));
			wp_enqueue_script('flex-gallery-js',plugins_url('flex-gallery.js', __FILE__));
            wp_enqueue_script('jquery-mobile-touch-events',plugins_url('jquery.mobile.custom.min.js', __FILE__));
			wp_enqueue_script('jquery-scrollface',plugins_url('jquery.scrollface.min.js', __FILE__));
			wp_enqueue_script('jquery-buffet',plugins_url('jquery.buffet.min.js', __FILE__));
			wp_enqueue_script('jquery-ui-slide-effect',plugins_url('jquery-ui-slide-effect.min.js', __FILE__));
			wp_enqueue_script('jquery-mousewheel',plugins_url('jquery.mousewheel.min.js', __FILE__));
			wp_enqueue_script('perfect-scrollbar-js',plugins_url('perfect-scrollbar-0.4.3.with-mousewheel.min.js', __FILE__));
			wp_enqueue_style('ajax-gallery-css',plugins_url('flex-gallery.css', __FILE__));
			wp_enqueue_style('perfect-scrollbar-css',plugins_url('perfect-scrollbar-0.4.3.min.css', __FILE__));
			}


		}

	} else {
				//Exceptions to load scripts even if there are no posts present with the shortcode
				$cat = get_category( get_query_var( 'cat' ) );
                $categorySlug = $cat->slug;
                $slugArray = array('thanks-dad-iiyn','more-category-slugs-here');
                if ( in_array($categorySlug, $slugArray) ) {
                	//un-used exception strpos($_SERVER['REQUEST_URI'],'photos')
                	$exception = true;
                }
                
                if ($exception) {
                    wp_enqueue_script('flexslider-js',plugins_url('jquery.flexslider.js', __FILE__));
                    wp_enqueue_style('flexslider-css',plugins_url('flexslider.css', __FILE__));
                    wp_enqueue_script('flex-gallery-js',plugins_url('flex-gallery.js', __FILE__));
                    wp_enqueue_script('jquery-mobile',plugins_url('jquery.mobile.custom.min.js', __FILE__));
                    wp_enqueue_script('jquery-scrollface',plugins_url('jquery.scrollface.min.js', __FILE__));
                    wp_enqueue_script('jquery-buffet',plugins_url('jquery.buffet.min.js', __FILE__));
                    wp_enqueue_script('jquery-mousewheel',plugins_url('jquery.mousewheel.min.js', __FILE__));
                    wp_enqueue_script('perfect-scrollbar-js',plugins_url('perfect-scrollbar-0.4.3.with-mousewheel.min.js', __FILE__));
                    wp_enqueue_style('ajax-gallery-css',plugins_url('flex-gallery.css', __FILE__));
                    wp_enqueue_style('perfect-scrollbar-css',plugins_url('perfect-scrollbar-0.4.3.min.css', __FILE__));
                }
    
    
        }



	return $posts;
}

?>