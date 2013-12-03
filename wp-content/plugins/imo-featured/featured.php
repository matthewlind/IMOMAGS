<?php
/*
 * Plugin Name: IMO Featured
 * Plugin URI: http://github.com/imoutdoors
 * Description: Provides an featured posts widget
 * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */

include("sidebar-widget.php");
include("thumbs-sidebar-widget.php");

add_action( 'admin_menu', 'imo_featured_menu' );
add_action( 'admin_enqueue_scripts', 'imo_featured_scripts' );

function imo_featured_menu() {
	add_options_page( 'Featured Posts', 'Featured Posts', 'manage_options', 'imo-featured-manager', 'imo_featured_options' );
}

function imo_featured_scripts($hook) {


	//If we're on the right page, enqueue some styles and scripts
	if ($hook == "settings_page_imo-featured-manager") {

		wp_enqueue_style('twitter-bootstrap',"http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.0/css/bootstrap.css");
		wp_enqueue_style('jquery-ui-style',"http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css");
		wp_enqueue_style('imo-featured-style',plugins_url( 'imo-featured/featured.css' , dirname(__FILE__) ));

		wp_enqueue_script('jquery-ui-autocomplete');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-masonry',plugins_url( 'imo-featured/masonry.pkgd.js' , dirname(__FILE__) ),array("jquery"));
		wp_enqueue_script('imo-featured-script',plugins_url( 'imo-featured/featured.js' , dirname(__FILE__) ),array("jquery","jquery-ui-sortable","jquery-ui-autocomplete","jquery-masonry"));
	}


}

function imo_featured_options() {

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}



	if ($_GET['setID'] && $_GET['action'] != "update")
		showFeaturedDetail($_GET['setID']);
	else
		showFeaturedList();

}


//*********************************************************************************************************************
//*********************************************************************************************************************
//*****************************************   ADMIN PAGE DISPLAY   ************************************************
//*********************************************************************************************************************
//*********************************************************************************************************************
function showFeaturedList() {


if ($_GET['action'] == "update") {
	updateSet($_GET['setID'],$_GET['post_ids'],$_GET['name']);
}

?>


	<div style="padding:10px 20px 20px 10px">
		<h1 style="padding-bottom:10px;">Featured Post Sets</h1>
		<p>Organize posts into sets so that they can be featured! Just use this shortcode to feature a set: <b>[featured-posts set_id=2]</b> </p>

		<a class="btn" href="/wp-admin/options-general.php?page=imo-featured-manager&setID=new">New Set</a>
	</div>
	<div class="set-list-container">

	</div>

<?php

}


function showFeaturedDetail($setID) {

	if ($setID == "new")
		echo "<h1>Create New Set</h1>";
	else
		echo "<h1 class='edit-set-header'>Edit Set $setID: </h1>";

	?>

	<form class="hidden-form">

		<label for="name" >Name your Set:</label>
		<input id="name" name="name" placeholder="Name">

		<form class="hidden-form">
		<div class="post-search">
		  <label for="featured-search">Search for Posts to Add: </label>
		  <input id="featured-search" style="width: 650px;" />
		</div>

		<p class="list-header">Reorder and Remove Posts:</p>

		<ul id="sortable" class="sortable-list">
		</ul>


		<input type="hidden" id="setID" name="setID" value="<?php echo $setID; ?>">
		<input type="hidden" id="post_ids" name="post_ids">
		<input type="hidden" id="page" name="page" value="imo-featured-manager">
		<input type="hidden" id="action" name="action" value="update">


		<input type="submit" value="Save Changes" class="btn btn-primary save-changes">

	</form>


	<?php
}

function updateSet($setID,$postIDs,$name) {

	if ($setID == "new") {

		//Query the db to get the next set ID.
		global $wpdb;
    	$sets = $wpdb->get_results( "SELECT * FROM {$wpdb->options} WHERE option_name LIKE 'featured_set_%' ORDER BY option_id ASC" );



    	//print_r($sets);

    	if (count($sets) < 1) {
    		$setID = 1;
    	} else {



    		$prevSetID = 0;

    		foreach ($sets as $set) {




    			$setName = $set->option_name;


				preg_match_all('!\d+!', $setName, $valueArray);


				if ($prevSetID <= $valueArray[0][0])
					$setID = $valueArray[0][0] + 1;


				$prevSetID = $setID;


    		}

    	}

	}//End if NEW


	$setData['post_id_string'] = $postIDs;
	$setData['name'] = $name;


	update_option("featured_set_$setID",$setData);

	//header('Location: http://www.google.com');



}

//*********************************************************************************************************************
//*********************************************************************************************************************
//*****************************************   SHORTCODE DISPLAY   ************************************************
//*********************************************************************************************************************
//*********************************************************************************************************************

add_action( 'init', 'imo_featured_register_shortcodes');

function imo_featured_register_shortcodes(){
   add_shortcode('featured-posts', 'showFeaturedPosts');
}

function showFeaturedPosts($atts) {

	extract(shortcode_atts(array(
	  'set_id' => 1,
	), $atts));


	$setData = get_option("featured_set_{$set_id}");

	$postIDString = $setData['post_id_string'];

	$outputString = "";

	global $wpdb;

    $query = "SELECT
        posts.ID as id,
        posts.post_title as title,
        posts.guid as url,
        posts.post_type as type,
        attachmentmeta.meta_value as attachment_meta,
        posts.guid as url
        FROM {$wpdb->posts} as posts
        JOIN {$wpdb->postmeta} as postmeta ON (posts.ID = postmeta.post_id)
        JOIN {$wpdb->posts} as attachments ON (attachments.ID = postmeta.meta_value)
        JOIN {$wpdb->postmeta} as attachmentmeta ON (attachments.ID = attachmentmeta.post_id)
        WHERE posts.ID IN ($postIDString)
        AND posts.post_status = 'publish'
        AND postmeta.meta_key = '_thumbnail_id'
        AND attachmentmeta.meta_key = '_wp_attachment_metadata'
        ORDER BY FIELD (posts.ID,$postIDString)";



    $posts = $wpdb->get_results( $query );




    foreach($posts as $post) {

		$thumb = getSetItemThumbnail(unserialize($post->attachment_meta));
    	$title = $post->title;
    	$url = $post->url;
    	$outputString .= "<li class='home-featured'>
                                <div class='feat-post'>
                                    <div class='feat-img'><a href='$url'><img src='$thumb' alt='$title' /></a></div>
                                    <div class='feat-text'><h3><a href='$url' onclick='_gaq.push(['_trackEvent','Special Features','$title','$url']);'>$title</a></h3>
                                </div>
                                <div class='feat-sep'><div></div></div>
                            </li>";
    }


	return $outputString;

}



function getSetItemThumbnail($dataArray) {

    $filepath = $dataArray['file'];

    $filepathParts = explode("/",$filepath);

    $filename = $dataArray['sizes']['list-thumb']['file'];

    $fullPath = "/files/" . $filepathParts[0] . "/" . $filepathParts[1] . "/" . $filename;

    if (empty($filename)) {
        $fullPath = "/files/" . $filepath;
    }

    return $fullPath;
}