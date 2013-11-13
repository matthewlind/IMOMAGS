<?php
/*
 * Plugin Name: IMO Featured
 * Plugin URI: http://github.com/imoutdoors
 * Description: Provides an featured posts widget
 * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */


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
		wp_enqueue_script('imo-featured-script',plugins_url( 'imo-featured/featured.js' , dirname(__FILE__) ),array("jquery","jquery-ui-sortable","jquery-ui-autocomplete"));

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


function showFeaturedList() {


if ($_GET['action'] == "update") {
	updateSet($_GET['setID'],$_GET['post_ids']);
}

//*********************************************************************************************************************
//*********************************************************************************************************************
//*****************************************   ADMIN PAGE DISPLAY   ************************************************
//*********************************************************************************************************************
//*********************************************************************************************************************
?>


	<div style="padding:10px 20px 20px 10px">
		<h1 style="padding-bottom:10px;">Manage Sets of Posts</h1>

		<a class="btn" href="/wp-admin/options-general.php?page=imo-featured-manager&setID=new">New Set</a>
	</div>




	<script type="text/javascript">
	//Main App Script

	</script>

<?php

//*********************************************************************************************************************
//*********************************************************************************************************************
//*********************************************************************************************************************
//*********************************************************************************************************************
//*********************************************************************************************************************
//*********************************************************************************************************************
}


function showFeaturedDetail($setID) {

	if ($setID == "new")
		echo "<h1>Create New Set</h1>";
	else
		echo "<h1>Edit Set $setID</h1>";

	?>
	<div class="ui-widget post-search">
	  <label for="featured-search">Search for Posts to Add: </label>
	  <input id="featured-search" style="width: 650px;" />
	</div>

	<p class="list-header">Reorder and Remove Posts:</p>

	<ul id="sortable" class="sortable-list">
	</ul>

	<form class="hidden-form">
		<input type="hidden" id="setID" name="setID" value="<?php echo $setID; ?>">
		<input type="hidden" id="post_ids" name="post_ids">
		<input type="hidden" id="page" name="page" value="imo-featured-manager">
		<input type="hidden" id="action" name="action" value="update">

		<input type="submit" value="Save Changes" class="btn btn-primary save-changes">

	</form>


	<?php
}

function updateSet($setID,$postIDs) {

	if ($setID == "new") {

		//Query the db to get the next set ID.
		global $wpdb;
    	$sets = $wpdb->get_results( "SELECT * FROM {$wpdb->options} WHERE option_name LIKE 'featured_set_%' ORDER BY option_id ASC" );

    	print_r($sets);

    	if (empty($sets)) {
    		$setID = 1;
    	} else {

    		foreach ($sets as $set) {


    			$setName = $set->option_name;


				preg_match_all('!\d+!', $setName, $valueArray);

				$setID = $valueArray[0][0] + 1;
    		}

    	}

	}//End if NEW

	update_option("featured_set_$setID",$postIDs);

	//Now that we have the ID, let's insert it!


}

