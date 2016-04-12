<?php

add_action('init', 'register_single_script');
add_action('wp_footer', 'print_single_script');

function register_single_script() {
	wp_register_script( 'single-default-script', get_bloginfo( 'template_directory' ) . '/js/redesign/single.js', array( 'jquery' ), '1.0', true );
	wp_register_script( 'single-disqus', "//gundogmag.disqus.com/count.js", array( 'jquery' ), '1.0', true );
	
}

function print_single_script() {
	global $is_single_default;

	if ( ! $is_single_default )
		return;

	wp_print_scripts('single-default-script');
	wp_print_scripts('single-disqus');
}

?>