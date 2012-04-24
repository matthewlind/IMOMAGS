<?php

function ecpt_check_for_notices() {
	global $ecpt_base_file;
	
	// show an error if plugin is activated network wide
	if(function_exists('is_plugin_active_for_network')) {
		if(is_plugin_active_for_network($ecpt_base_file)) {
			add_action('network_admin_notices', 'ecpt_network_activation_warning');
			add_action('admin_notices', 'ecpt_network_activation_warning');
		}
	}
}
add_action('admin_init', 'ecpt_check_for_notices');

function ecpt_network_activation_warning() {
	echo '<div class="error"><p>Easy Content Types cannot be network activated. Please activate separately on each site.</p></div>';
}