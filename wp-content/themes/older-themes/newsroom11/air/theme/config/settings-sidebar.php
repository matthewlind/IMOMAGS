<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: Sidebar
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'sidebar-mobile',
		'title'	=> 'Mobile Sidebar',
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Mobile Sidebar
/*-------------------------------------------------------*/

//! Enable Mobile Sidebar
$fields[] = array(
	'id'		=> 'sidebar-mobile-enable',
	'label'		=> 'Enable',
	'section'	=> 'sidebar-mobile',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'sidebar-mobile-enable' => 'Show sidebar content on mobile layouts'
	)
);