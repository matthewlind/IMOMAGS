<?php

function ecpt_process_ajax_data() {
	global $wpdb;
	$ecpt_db_meta_fields_name = $wpdb->prefix . "ecpt_meta_box_fields";
	$updateRecordsArray = $_POST['recordsArray'];
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {

		$wpdb->update($ecpt_db_meta_fields_name, array('list_order' => $listingCounter ), array('id' => $recordIDValue));
		$listingCounter++;
	}
	die('test');
}
add_action('wp_ajax_ecpt_update_field_listing', 'ecpt_process_ajax_data');