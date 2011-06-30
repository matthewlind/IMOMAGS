<?php

/**
 * imo-addons.php
 *
 * Defines additions to Carrington Build's theme. 
 */



function imo_addons_sidebar_init() {

    //default configuration from carrington build
	$sidebar_defaults = array(
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>'
	);

	register_sidebar(array_merge($sidebar_defaults, array(
		'id' => 'header-slot',
		'name' => 'Header Slot',
		'description' => 'Shown on the right of the logo.',
	)));
}

add_action("widgets_init", 'imo_addons_sidebar_init'); 

