<?php
/**
 * Includes a header file at the top of the page. 
 */

function include_header_file() {
	include('header-content.php');
}

add_action('wp_head','include_header_file');

?>
