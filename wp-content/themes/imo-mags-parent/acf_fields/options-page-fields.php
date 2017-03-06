<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_general-setting',
		'title' => 'General Settings',
		'fields' => array (
			array (
				'key' => 'field_588252af99b29',
				'label' => 'Brightcove Player ID',
				'name' => 'brightcove_player_id',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_588252af99b30',
				'label' => 'Brightcove Account Number',
				'name' => 'brightcove_account_num',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
}

?>