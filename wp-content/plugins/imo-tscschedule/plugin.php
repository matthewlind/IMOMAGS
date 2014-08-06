<?php
/*  Copyright 2014 Intermedia Outdoors

*/

/*
Plugin Name: TSC Program Schedule for IMO sites
Plugin URI: https://imomags.com
Description: 2014 
Author: Jeff Burrows
Author URI:
Version: 0.1
Stable tag: 0.1
License: GPL2

This plugin works a little differently to adapt to the IMO TV Show pages

<?php echo do_shortcode("[tscschedule format='singleshow' postid='".$id."']"); ?>

*/
	
function tscschedule_func($atts) {
	//global $ismobile;
	$ismobile = false;

	wp_enqueue_script( 'momentjs', plugin_dir_url( __FILE__ ) . 'moment.js', array( 'jquery' ) );
	wp_enqueue_script( 'tscschedulejs', plugin_dir_url( __FILE__ ) . 'tscschedule.js', array( 'jquery' ) );
	wp_enqueue_style( 'tscschedulecss', plugin_dir_url( __FILE__ ) . 'tscschedule.css' );

	return jsTSCSRender($ismobile, $atts);
}
add_shortcode( 'tscschedule', 'tscschedule_func' );


function getTSCSwpshows() {
	global $wpdb;
	$sql = "SELECT p.*, m1.meta_value AS seriesid, m2.meta_value AS thumb FROM wp_posts p "
		 . "LEFT JOIN wp_postmeta m1 ON p.ID = m1.post_id AND m1.meta_key = 'series_id' "
		 . "LEFT JOIN wp_postmeta wm1 ON "
		 . "(wm1.post_id = p.id AND wm1.meta_value IS NOT NULL AND wm1.meta_key = '_thumbnail_id') "
		 . "LEFT JOIN wp_postmeta m2 ON "
		 . "(wm1.meta_value = m2.post_id AND m2.meta_key = '_wp_attachment_metadata' AND m2.meta_value IS NOT NULL)"
		 . "WHERE post_type = 'shows' AND post_status = 'publish' "
		 . "ORDER BY post_title";
	$posts = $wpdb->get_results($sql);
	
	return $posts;
}


function jsTSCSRender($mobile, $atts) {

	$format = $atts["format"];

	$datapath = "http://www.imoutdoors.com/tscschedule/scheduledata.php";
	$data = file_get_contents ($datapath);
    $showjson = json_decode($data, true);
	
	$posts = getTSCSwpshows();
	

	if($format=="full") {

		$scripts = 'makeDayBar();';
	}
	else if($format=="tonight") {
		
		$scripts = 'makeTonightBar();';
	}
	else if($format=="singleshow") {
		
		
	}

	$wpshows = array();
	foreach($posts as $post) {
		$image = unserialize($post->thumb);
		$imagea = explode("/", $image["file"]);
		array_pop($imagea);
		$path = implode($imagea, "/");

		$fimage = "";
		if(isset($image["sizes"]["schedule-thumb"]))
			$fimage = $path."/".$image["sizes"]["schedule-thumb"]["file"];
		
		$wpshowa = array();
		$wpshowa["postname"] = $post->post_name;
		$wpshowa["fimage"] = $fimage;
		$wpshowa["postid"] = $post->ID;
	
		$wpshows[$post->seriesid] = $wpshowa;
	}

	foreach($showjson as $key=>&$row) {
    	if(isset($wpshows[$row["SeriesID"]])) {
    		$row["PostName"] = $wpshows[$row["SeriesID"]]["postname"];
			$row["FeatImage"] = $wpshows[$row["SeriesID"]]["fimage"];
			$row["PostID"] = $wpshows[$row["SeriesID"]]["postid"];
		}
		else {
			$row["PostName"] = "";
			$row["FeatImage"] = "";
			$row["PostID"] = "";
		}
	}

	if($format=="singleshow") {
		//$outp = "";
		
		date_default_timezone_set('America/New_York');

		$nextweek = date("Y/m/d",strtotime("+8 days"));
		
		//print_r($showjson);
		foreach($showjson as $show) {
			
			if($show["SeriesID"] == $atts["postid"]) {
				
				foreach($show["Timeslots"] as $slot){
					
					
					$time = $slot["src"];
					$date = new DateTime($slot["rdate"]);
					$dateResult = $date->format('M d');
					
					$expired = $result .' ' . $time;
					
					$aired = new DateTime($expired);
					$airedResult = $aired->format('M d H');
					
				}
				if($airedResult >= date("M d H")){
					echo '<div class="schedule-item">';
					echo '<span class="episode-title">'.$show["EpisodeTitle"].'</span>';
					echo '<span class="episode-time">'.$dateResult.': '.$time.' ET/PT</span>';						
					echo '</div>';
				}
				
								
			}	
										
		}
				
		
	}else {
		$outp = "";

		$outp.= '<script type="text/javascript">'
			 .  'var sdata = '.json_encode($showjson).';'
			 .  'jQuery(document).ready(function() {'
			 .   $scripts
			 .	'});'
			 .  '</script>';
		
		return $outp;
	}

	
}

?>
