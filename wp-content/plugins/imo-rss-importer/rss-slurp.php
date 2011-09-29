<?php
/*  Copyright 2011 Theodore Witkmap  (email : theodore.witkamp@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
Plugin Name: IMO RSS Importer
Plugin URI: https://github.com/witkamp/improved-rss-importer
Description: Import posts from an RSS feed, including enclosures
Author: witkamp
Author URI:
Version: 0.1
Stable tag: 0.1
License: GPL2
*/




add_action('init', 'digmag_article_init');
function digmag_article_init() {
	$labels = array(
		'name' => _x('DIGMAG Articles', 'post type general name'),
		'singular_name' => _x('DIGMAG Article', 'post type singular name'),
		'add_new' => _x('Add New', 'article'),
		'add_new_item' => __("Add New DIGMAG Article"),
		'edit_item' => __("Edit DIGMAG Article"),
		'new_item' => __("New DIGMAG Article"),
		'view_item' => __("View DIGMAG Article"),
		'search_items' => __("Search DIGMAG Article"),
		'not_found' =>  __('No DIGMAG articles found'),
		'not_found_in_trash' => __('No DIGMAG Articles found in Trash'), 
		'parent_item_colon' => ''
	  );

	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array('slug' => 'magazine/digital/share/article', 'with_front' => FALSE),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor')
	  ); 
	  register_post_type('digmag_article',$args);

}

//function digmag_article_flush() {
//  digmag_article_init();
//  flush_rewrite_rules();
//}
//register_activation_hook(__FILE__, 'digmag_article_flush');










if ( !defined('WP_LOAD_IMPORTERS') )
	return;

// Load Importer API
require_once ABSPATH . 'wp-admin/includes/import.php';

require_once('rss-parser.php');


function rss_slurp_greet() {
	?>
	<div class="narrow">
	<p>This imports RSS feeds created in DIGMAG.
	It uses a XML parser instead of regex to extract the data. This allows it to handle feeds with CDATA blocks correctly. Enclosure tags are preserved. This makes importing podcasts possible.</p>
	<h2>Features</h2>
	<lu>
		<li>CDATA blocks are supported</li>
		<li>Enclosure tags are preserved</li>
		<li>Improved parsing performance</li>
	</lu>
	<?php
	// TODO: Change this to use URLs or file from computer
	wp_import_upload_form("admin.php?import=improved-rss-importer&amp;step=1");
	echo '</div>';
}

function rss_slurp_import(){
	// Check the Nonce in wp_import_upload_form
	check_admin_referer('import-upload');
	
	// Get uploaded file info
	$file_info = wp_import_handle_upload();
	if ( isset($file_info['error']) ) {
		echo $file_info['error'];
		return;
	}

	$file = $file_info['file'];
	
	// Parse & Import RSS
	$parser = new RSSParser();
	$parser->read(fopen($file,'r'));

	// Delete Attachment
	wp_delete_attachment($file_info['id']);
	
	do_action('import_done', 'rss-slurp');
	echo '<h3>';
	printf(__('All done. <a href="%s">Have fun!</a>'), get_option('home'));
	echo '</h3>';
}

function rss_slurp_dispatch(){
	if (empty ($_GET['step'])){
		$step = 0;
	}else{
		$step = (int) $_GET['step'];
	}

	echo '<div class="wrap">';
	// Put the tool icon on the page
	screen_icon();
	// Echo title
	echo '<h2>'.__('Improved RSS Importer').'</h2>';

	switch ($step) {
		case 0 :
			rss_slurp_greet();
			break;
		case 1 :
			// Show the results of the import
			rss_slurp_import();
			break;
	}
	echo '</div>';
}	

register_importer('improved-rss-importer', __('IMO RSS Importer'), __('Import posts from a DIGMAG RSS feed.'), rss_slurp_dispatch);
?>
