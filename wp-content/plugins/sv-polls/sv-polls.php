<?php
/*
Plugin Name:SportsmenVote Polls
Plugin URI: https://imomags.com
Description: Allows SV polls to be embedded into wordpress posts
Author: aaron
Author URI:
Version: 0.1
License: IMO
*/


add_action("init", "sv_polls_init");


function sv_polls_init() {

	wp_enqueue_style('sv-polls-style', plugins_url('sv-polls.css', __FILE__),null,"0.0.1" );
	wp_enqueue_script('sv-polls-script', plugins_url('sv-polls.js', __FILE__),array("jquery"),"0.0.1" );

}


add_shortcode( 'sv-polls', 'sv_polls_shortcode' );


// [slideshow gallery=GALLERY_ID]
function sv_polls_shortcode( $atts ) {

	extract(
    shortcode_atts(
      array(
        'pollpost' => null,
        'pollheader' => "G&A POLLS"
      ),
      $atts
    )
  );

	return svDisplayPoll($pollpost,$pollheader);

}

function svDisplayPoll($pollpost,$pollheader){


	$sharingURL = "http://www.sportsmenvote.com/poll-redirector?poll_post_id=" . $pollpost;

	//$addThis = imo_add_this_for_this($sharingURL,null,false);

	//get the ad campaign code.
	$adCampCode = "shooting_polls";

	$serverName = $_SERVER['SERVER_NAME'];

	if (strstr($serverName, "hunt") || strstr($serverName, "whitetail") || strstr($serverName, "wildfowl") || strstr($serverName, "gundog") || strstr($serverName, "game")) {
		$adCampCode = "hunting_polls";
	}


	$output = "";


	$dartAdTag = get_imo_dart_tag("300x250",null,false,array("camp"=>$adCampCode));
	$dartSponsorTag = get_imo_dart_tag("240x60",null,false,array("camp"=>$adCampCode));

	$output .= <<<EOFEOFEOF

	<div class="sv-poll-container" poll-post-id="$pollpost" id="poll-post-$pollpost">
		<div class="poll-header">
			<span class="poll-header-title">$pollheader</span>
			<!-- <span class="presented-by modern">presented by</span> -->
			<span class="sponsor-logo">

				$dartSponsorTag

			</span>

			<span class="sharing-links" id="sharing-links-$pollpost">

			</span>

		</div>
		<h1 class="poll-question">Loading...</h1>
		<div class="poll-right-column">
			<div class="poll-ad">

				$dartAdTag


			</div>

		</div>


		<div class="poll-form-container">
			<form>
				<div class="poll-answers-container">
					<ul class="poll-answers unanswered">



					</ul>
				</div>
				<div>
					<input type="submit" value="VOTE" class="poll-vote-button">
						<span class="poll-sponsor">

							<span class="powered-by modern">powered by</span>

							<a href="http://www.sportsmenvote.com" target="_blank">
								<img class="sv-logo" src="/wp-content/plugins/sv-polls/img/sv-logo.png" />
							</a>

						</span>
				</div>
			</form>
		</div>
		<div class="poll-stats" style="display:none;">
			<span class="poll-total-votes">1,923</span> Total Votes <span class="poll-bullet">•</span> <a class="poll-link" target="_blank" href=""><span class="poll-comment-count">10</span> Comments </a><span class="poll-bullet">•</span> <a href="http://www.sportsmenvote.com/polls" target="_blank">See More Polls</a>
		</div>


		<div class="spacer"></div>

	</div>
EOFEOFEOF;
	return $output;
}







// //Since we don't want to add the scripts to every page, we check to see if we need them before adding
// add_filter('the_posts', 'conditionally_add_scripts_and_styles'); // the_posts gets triggered before wp_head
// function conditionally_add_scripts_and_styles($posts){



// 	if (!empty($posts)) {

// 		$shortcode_found = false; // use this flag to see if styles and scripts need to be enqueued
// 		foreach ($posts as $post) {
// 			if (stripos($post->post_content, '[imo-slideshow') !== false) {
// 				$shortcode_found = true; // bingo!
// 				break;
// 			}
// 		}

// 		if ($shortcode_found) {
// 			if(mobile() == false || tablet() == false){
// 			// enqueue here
// 			wp_enqueue_script('ajax-gallery-js',plugins_url('ajax-gallery.js', __FILE__));
// 			wp_enqueue_script('jquery-scrollface',plugins_url('jquery.scrollface.min.js', __FILE__));
// 			wp_enqueue_script('jquery-buffet',plugins_url('jquery.buffet.min.js', __FILE__));
// 			wp_enqueue_script('jquery-ui-draggable');
// 			wp_enqueue_script('jquery-mousewheel',plugins_url('jquery.mousewheel.min.js', __FILE__));
// 			wp_enqueue_script('jquery-mCustomScrollbar',plugins_url('jquery.mCustomScrollbar.js', __FILE__));
// 			wp_enqueue_style('ajax-gallery-css',plugins_url('ajax-gallery.css', __FILE__));
// 			wp_enqueue_style('ajax-mCustomScrollbar-css',plugins_url('jquery.mCustomScrollbar.css', __FILE__));
// 			}


// 		}

// 	} else {//If there are no posts, such as a category page


// 			$cat = get_category( get_query_var( 'cat' ) );
// 			$categorySlug = $cat->slug;

// 			$slugArray = array("thanks-dad-iiyn","fall-iiyn","more-category-slugs-here");

// 			if (in_array($categorySlug, $slugArray)) {
// 				wp_enqueue_script('ajax-gallery-js',plugins_url('ajax-gallery.js', __FILE__));
// 				wp_enqueue_script('jquery-scrollface',plugins_url('jquery.scrollface.min.js', __FILE__));
// 				wp_enqueue_script('jquery-buffet',plugins_url('jquery.buffet.min.js', __FILE__));
// 				wp_enqueue_script('jquery-ui-draggable');
// 				wp_enqueue_script('jquery-mousewheel',plugins_url('jquery.mousewheel.min.js', __FILE__));
// 				wp_enqueue_script('jquery-mCustomScrollbar',plugins_url('jquery.mCustomScrollbar.js', __FILE__));
// 				wp_enqueue_style('ajax-gallery-css',plugins_url('ajax-gallery.css', __FILE__));
// 				wp_enqueue_style('ajax-mCustomScrollbar-css',plugins_url('jquery.mCustomScrollbar.css', __FILE__));
// 			}


// 	}



// 	return $posts;
// }
