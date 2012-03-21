<?php
/*
Plugin Name: Easy Content Types
Plugin URI: http://pippinsplugins.com/easy-content-types/
Description: The easiest way to create unlimited custom post types, taxonomies, and meta boxes
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
Version: 2.5.0
*/

/*****************************************
plugin shortname = ECPT
*****************************************/


/*****************************************
global variables
*****************************************/

global $wpdb;

// plugin root folder
global $ecpt_base_dir;
$ecpt_base_dir = WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__), "" ,plugin_basename(__FILE__));

// plugin root file
global $ecpt_base_file;
$ecpt_base_file = plugin_basename(__FILE__);

// plugin prefix
global $ecpt_prefix;
$ecpt_prefix = 'ecpt_';

// ECPT DB version
global $ecpt_db_version;
$ecpt_db_version = 1.3;

// ECPT DB taxonomy version
global $ecpt_db_tax_version;
$ecpt_db_tax_version = 1.4;

// ECPT DB meta box version
global $ecpt_db_meta_version;
$ecpt_db_meta_version = 1.0;

// ECPT DB meta box fields version
global $ecpt_db_meta_fields_version;
$ecpt_db_meta_fields_version = 1.9;

// name of the ECPT post type database
global $ecpt_db_name;
$ecpt_db_name = $wpdb->prefix . "ecpt_post_types";

// name of the ECPT post type database
global $ecpt_db_tax_name;
$ecpt_db_tax_name = $wpdb->prefix . "ecpt_taxonomies";

// name of the ECPT metabox database
global $ecpt_db_meta_name;
$ecpt_db_meta_name = $wpdb->prefix . "ecpt_meta_boxes";

// name of the ECPT metabox fields database
global $ecpt_db_meta_fields_name;
$ecpt_db_meta_fields_name = $wpdb->prefix . "ecpt_meta_box_fields";

// field types
$field_types = array('text', 'textarea', 'select', 'checkbox', 'radio', 'date', 'upload', 'slider', 'repeatable', 'repeatable upload');

// metabox page
$metabox_pages = get_post_types('', 'objects');

// metabox context
$metabox_contexts = array('normal', 'advanced', 'side');

// metabox priority
$metabox_priorities = array('default', 'high', 'core', 'low');

// taxonomy objects
$tax_objects = get_post_types('', 'objects');


// taxonomy attributes
$tax_atts = array('hierarchical', 'show_tagcloud', 'show_in_nav_menus');

// user levels
$user_levels = array('Admin', 'Editor', 'Author');

// load the plugin options
$ecpt_options = get_option( 'ecpt_settings' );

/*****************************************
load the languages
*****************************************/

load_plugin_textdomain( 'ecpt', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

/*****************************************
includes
*****************************************/
if(is_admin()) {
	// get_plugin_data() is only available in admin
	require(dirname(__FILE__) . '/update-notifier.php');
	include(dirname(__FILE__) . '/includes/page-home.php');
	include(dirname(__FILE__) . '/includes/admin-notices.php');
	include(dirname(__FILE__) . '/includes/process-data.php');
	include(dirname(__FILE__) . '/includes/process-ajax-data.php');
	include(dirname(__FILE__) . '/includes/post-types-admin.php');
	include(dirname(__FILE__) . '/includes/taxonomies-admin.php');
	include(dirname(__FILE__) . '/includes/metabox-admin.php');
	include(dirname(__FILE__) . '/includes/scripts.php');
	include(dirname(__FILE__) . '/includes/register-meta-boxes.php');
	include(dirname(__FILE__) . '/includes/settings.php');
	include(dirname(__FILE__) . '/includes/export-admin.php');
	include(dirname(__FILE__) . '/includes/help-page.php');
	include(dirname(__FILE__) . '/includes/admin-menus.php');
	include(dirname(__FILE__) . '/includes/plugin-action-links.php');
}
include(dirname(__FILE__) . '/includes/register-post-types.php');
include(dirname(__FILE__) . '/includes/register-taxonomies.php');
include(dirname(__FILE__) . '/includes/display-functions.php');
include(dirname(__FILE__) . '/includes/shortcodes.php');
include(dirname(__FILE__) . '/includes/ecpt-widgets.php');
include(dirname(__FILE__) . '/includes/misc-functions.php');
include(dirname(__FILE__) . '/includes/caching-functions.php');


/*****************************************
Install
*****************************************/

// function to create the DB / Options / Defaults					
function ecpt_options_install() {
   	global $wpdb;
  	global $ecpt_db_name;
  	global $ecpt_db_version;
  	global $ecpt_db_tax_name;
  	global $ecpt_db_tax_version;
  	global $ecpt_db_meta_name;
  	global $ecpt_db_meta_version;
  	global $ecpt_db_meta_fields_name;
  	global $ecpt_db_meta_fields_version;

	// create the ECPT post type database table
	if($wpdb->get_var("show tables like '$ecpt_db_name'") != $ecpt_db_name) 
	{
		$sql = "CREATE TABLE " . $ecpt_db_name . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`name` tinytext NOT NULL,
		`singular_name` tinytext NOT NULL,
		`plural_name` tinytext NOT NULL,
		`hierarchical` tinyint NOT NULL,
		`title` tinyint NOT NULL,
		`editor` tinyint NOT NULL,
		`author` tinyint NOT NULL,
		`thumbnail` tinyint NOT NULL,
		`excerpt` tinyint NOT NULL,
		`fields` tinyint NOT NULL,
		`comments` tinyint NOT NULL,
		`revisions` tinyint NOT NULL,
		`has_archive` tinyint NOT NULL,
		`post_formats` tinyint NOT NULL,
		`page_attributes` tinyint NOT NULL,
		`show_in_nav_menus` tinyint NOT NULL,
		`menu_position` tinyint NOT NULL,
		`menu_icon` tinytext NOT NULL,
		`exclude_from_search` TINYINT NOT NULL,		
		`slug` TINYTEXT NOT NULL,		
		`with_front` tinyint NOT NULL,	
		`post_tags` tinyint NOT NULL,
		`categories` tinyint NOT NULL,	
		UNIQUE KEY id (id)
		);";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
				
		add_option("ecpt_db_version", $ecpt_db_version);	
	}
	// check to see if the slug column needs added for post types
	if(!$wpdb->query("SELECT `slug` FROM `" . $ecpt_db_name . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $ecpt_db_name . "` ADD `slug` tinytext");
		update_option('ecpt_db_version', 1.1 );	
	}
	// check to see if the with_front column needs added for post types
	if(!$wpdb->query("SELECT `with_front` FROM `" . $ecpt_db_name . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $ecpt_db_name . "` ADD `with_front` tinyint");
		update_option('ecpt_db_version', 1.2 );	
	}
	if(!$wpdb->query("SELECT `post_tags` FROM `" . $ecpt_db_name . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $ecpt_db_name . "` ADD `post_tags` tinyint");
		$wpdb->query("ALTER TABLE `" . $ecpt_db_name . "` ADD `categories` tinyint");
		update_option('ecpt_db_version', 1.3 );	
	}
	
	// create the ECPT taxonomy database table
	if($wpdb->get_var("show tables like '$ecpt_db_tax_name'") != $ecpt_db_tax_name) 
	{
		$sql = "CREATE TABLE " . $ecpt_db_tax_name . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`name` tinytext NOT NULL,
		`page` tinytext NOT NULL,
		`singular_name` tinytext NOT NULL,
		`plural_name` tinytext NOT NULL,
		`hierarchical` tinyint NOT NULL,
		`show_tagcloud` tinyint NOT NULL,
		`show_in_nav_menus` tinyint NOT NULL,
		`slug` TINYTEXT NOT NULL,
		`with_front` tinyint NOT NULL,
		`enable_filter` tinyint NOT NULL,
		UNIQUE KEY id (id)
		);";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
				
		add_option("ecpt_db_tax_version", $ecpt_db_tax_version);	
	}
	// check to see if the slug column needs added for taxonomies
	if(!$wpdb->query("SELECT `slug` FROM `" . $ecpt_db_tax_name . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $ecpt_db_tax_name . "` ADD `slug` tinytext");
		update_option('ecpt_db_tax_version', 1.1 );	
	}
	// check to see if the with_front column needs added for taxonomies
	if(!$wpdb->query("SELECT `with_front` FROM `" . $ecpt_db_tax_name . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $ecpt_db_tax_name . "` ADD `with_front` tinyint");
		update_option('ecpt_db_tax_version', 1.2 );	
	}
	// remove the menu_position column if it's present
	if($wpdb->query("SELECT `menu_position` FROM `" . $ecpt_db_tax_name . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $ecpt_db_tax_name . "` DROP COLUMN `menu_position`");
		update_option('ecpt_db_tax_version', 1.3 );	
	}
	if(!$wpdb->query("SELECT `enable_filter` FROM `" . $ecpt_db_tax_name . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $ecpt_db_tax_name . "` ADD `enable_filter` tinyint");
		update_option('ecpt_db_tax_version', 1.4 );	
	}
	
	
	// create the ECPT metabox database table
	if($wpdb->get_var("show tables like '$ecpt_db_meta_name'") != $ecpt_db_meta_name) 
	{
		$sql = "CREATE TABLE " . $ecpt_db_meta_name . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`name` tinytext NOT NULL,
		`nicename` tinytext NOT NULL,
		`page` tinytext NOT NULL,
		`context` tinytext NOT NULL,
		`priority` tinytext NOT NULL,
		UNIQUE KEY id (id)
		);";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
				
		add_option("ecpt_db_meta_version", $ecpt_db_meta_version);	
	}
	
	// create the ECPT metabox fields database table
	if($wpdb->get_var("show tables like '$ecpt_db_meta_fields_name'") != $ecpt_db_meta_fields_name) 
	{
		$sql = "CREATE TABLE " . $ecpt_db_meta_fields_name . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`name` tinytext NOT NULL,
		`nicename` tinytext NOT NULL,
		`parent` tinytext NOT NULL,
		`type` tinytext NOT NULL,
		`options` mediumtext NOT NULL,
		`description` longtext NOT NULL,
		`list_order` tinyint NOT NULL,
		`rich_editor` tinyint NOT NULL,
		`max` tinyint NOT NULL,
		UNIQUE KEY id (id)
		);";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
				
		add_option("ecpt_db_meta_fields_version", $ecpt_db_meta_fields_version);	
	}
	// check if the meatbox fields table needs to be upgraded
	if(get_option('ecpt_db_meta_fields_version') < 1.3)
	{
		$wpdb->query("ALTER TABLE " . $ecpt_db_meta_fields_name . " MODIFY `list_order` tinyint");
		update_option('ecpt_db_meta_fields_version', 1.3 );	
	} 
	
	// check if the rich_editor column exists
	if(!$wpdb->query("SELECT `description` FROM `" . $ecpt_db_meta_fields_name . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $ecpt_db_meta_fields_name . "` ADD `description` tinytext");
	}
	
	// check if the rich_editor column exists
	if(!$wpdb->query("SELECT `rich_editor` FROM `" . $ecpt_db_meta_fields_name . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $ecpt_db_meta_fields_name . "` ADD `rich_editor` tinyint");
	}
	// check if the max column exists
	if(!$wpdb->query("SELECT `max` FROM `" . $ecpt_db_meta_fields_name . "`")) 
	{
		$wpdb->query("ALTER TABLE `" . $ecpt_db_meta_fields_name . "` ADD `max` tinyint");
	}
	// upgrade the options meta field column to medium text to allow more options
	if(get_option('ecpt_db_meta_fields_version') < 1.8) 
	{
		$wpdb->query("ALTER TABLE " . $ecpt_db_meta_fields_name . " MODIFY `options` mediumtext");
	}
	// upgrade the options meta field column to medium text to allow more options
	if(get_option('ecpt_db_meta_fields_version') < 1.9) 
	{
		$wpdb->query("ALTER TABLE " . $ecpt_db_meta_fields_name . " MODIFY `description` longtext");
	}
	
	update_option('ecpt_db_meta_fields_version', $ecpt_db_meta_fields_version );
}
// run the install scripts upon plugin activation
register_activation_hook(__FILE__,'ecpt_options_install');
