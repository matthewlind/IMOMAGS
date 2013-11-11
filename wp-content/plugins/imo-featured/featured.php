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

		wp_enqueue_script('jquery-ui-autocomplete');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('imo-featured-script',plugins_url( 'imo-featured/featured.js' , dirname(__FILE__) ),array("jquery","jquery-ui-sortable","jquery-ui-autocomplete"));

	}


}


function imo_featured_options() {

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}



	if ($_GET['setID'])
		showFeaturedDetail($_GET['setID']);
	else
		showFeaturedList();

}


function showFeaturedList() {
//*********************************************************************************************************************
//*********************************************************************************************************************
//*****************************************   ADMIN PAGE DISPLAY   ************************************************
//*********************************************************************************************************************
//*********************************************************************************************************************
?>


	<div style="padding:10px 20px 20px 10px">
		<h1 style="padding-bottom:10px;">Hello There</h1>

		<a href="/wp-admin/options-general.php?page=imo-featured-manager&setID=new">New Set</a>
	</div>

	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/backbone.js/0.9.9/backbone-min.js"></script>


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
		echo "<h1>Edit Set</h1>";

	?>
	<div class="ui-widget">
	  <label for="featured-search">Search: </label>
	  <input id="featured-search" />
	</div>


	<?php
}



