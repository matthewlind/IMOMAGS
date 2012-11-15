<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: Header
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'header-custom-logo',
		'title'	=> 'Custom Logo'
	),
	array(
		'id'	=> 'header-tagline',
		'title'	=> 'Tagline',
	),
	array(
		'id'	=> 'header-archive-heading',
		'title'	=> 'Archive Heading'
	),
	array(
		'id'	=> 'header-widgets',
		'title'	=> 'Header Widgets'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Custom Logo
/*-------------------------------------------------------*/

//! Custom Logo URL
$fields[] = array(
	'id'		=> 'custom-logo',
	'label'		=> 'Logo URL',
	'section'	=> 'header-custom-logo',
	'type'		=> 'image'
);

/* Tagline
/*-------------------------------------------------------*/

//! Disable Tagline
$fields[] = array(
	'id'		=> 'disable-tagline',
	'label'		=> 'Disable',
	'section'	=> 'header-tagline',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'disable-tagline' => 'Disable tagline (site description)'
	)
);

/* Archive Heading
/*-------------------------------------------------------*/

//! Disable archive heading
$fields[] = array(
	'id'		=> 'disable-archive-heading',
	'label'		=> 'Disable',
	'section'	=> 'header-archive-heading',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'disable-archive-heading' => 'Disable archive heading'
	)
);

/* Footer Widgets
/*-------------------------------------------------------*/

//! Enable Ads Area
$fields[] = array(
	'id'		=> 'header-widgets',
	'label'		=> 'Enable',
	'section'	=> 'header-widgets',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'header-widget-ads' => 'Enable full-width header ads widget area'
	)
);
