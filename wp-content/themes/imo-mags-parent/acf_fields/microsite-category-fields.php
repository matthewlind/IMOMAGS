<?php
/// ACF for microsites
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_microsite-category-fields',
		'title' => 'Microsite Category Fields',
		'fields' => array (
			array (
				'key' => 'field_55b29c0ed940d',
				'label' => 'Is Microsite',
				'name' => 'is_microsite',
				'type' => 'true_false',
				'instructions' => 'Check to edit as a microsite ',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_55b29d0600034',
				'label' => 'Hide all "buy mag" options',
				'name' => 'hide_all_buy_mag_options',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55b29c0ed940d',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_55b29d9000035',
				'label' => 'Mag is Available in Online Store',
				'name' => 'mag_online_store',
				'type' => 'true_false',
				'instructions' => 'Check if this SIP is available in our online store',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55b29c0ed940d',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_55b29d0600034',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => '',
				'default_value' => 1,
			),
			array (
				'key' => 'field_55b29dda88d35',
				'label' => 'Online Store URL',
				'name' => 'online_store_url',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55b29c0ed940d',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_55b29d9000035',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55b29e2a88d38',
				'label' => 'Digital Edition is Available',
				'name' => 'digital_edition_available',
				'type' => 'true_false',
				'instructions' => 'Check if digital edition of this SIP is available',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55b29c0ed940d',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_55b29d0600034',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => '',
				'default_value' => 1,
			),
			array (
				'key' => 'field_55b29e608e051',
				'label' => 'Digital Edition Urls',
				'name' => 'digital_edition_urls',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55b29c0ed940d',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_55b29e2a88d38',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_55b29e7d8e052',
						'label' => 'iTunes URL',
						'name' => 'itunes_url',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_55b29e8e8e053',
						'label' => 'Google Play URL',
						'name' => 'google_play_url',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_55b29e9b8e054',
						'label' => 'Windows Store URL',
						'name' => 'windows_store_url',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => 1,
				'row_limit' => 1,
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_55b29f43a3447',
				'label' => 'Message displayed if mag is unavailable in stores',
				'name' => 'message_unavailable',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55b29c0ed940d',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_55b29d0600034',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => 'This magazine is temporary unavailable',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55b29f68fe676',
				'label' => 'Logo',
				'name' => 'logo',
				'type' => 'image',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55b29c0ed940d',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_55b29f84fe677',
				'label' => 'Social Share Message',
				'name' => 'social_share_message',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55b29c0ed940d',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55b29fb1fe678',
				'label' => 'Mag Info',
				'name' => 'mag_info',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55b29c0ed940d',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_55b29fd1fe679',
						'label' => 'Mag Cover Image',
						'name' => 'mag_cover_image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_55b29fe1fe67a',
						'label' => 'Mag Title',
						'name' => 'mag_title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_55b29ff0fe67b',
						'label' => 'Mag Description',
						'name' => 'mag_description',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => 'Try to make it not more than 156 chars. Limited to 200 chars',
						'maxlength' => 200,
						'rows' => 3,
						'formatting' => 'br',
					),
				),
				'row_min' => 1,
				'row_limit' => 1,
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_55b2a04f8407c',
				'label' => 'End Date for Newsstands',
				'name' => 'end_date_newsstands',
				'type' => 'date_picker',
				'instructions' => 'Date when this SIP will stop to be available on newsstands',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55b29c0ed940d',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_55b29d0600034',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),
			array (
				'key' => 'field_55b2a08c8407e',
				'label' => 'Additional Elements',
				'name' => 'additional_elements',
				'type' => 'checkbox',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55b29c0ed940d',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'choices' => array (
					'sponsors_disclaimer' => 'Header Sponsors Disclaimer',
					'second_test_element' => 'Second Test Element',
					'third_test_element' => 'Third Test Element',
				),
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_55b2a0be8407f',
				'label' => 'Sponsors Disclaimer Text and Link',
				'name' => 'sponsors_disclaimer',
				'type' => 'textarea',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55b29c0ed940d',
							'operator' => '==',
							'value' => '1',
						),
						array (
							'field' => 'field_55b2a08c8407e',
							'operator' => '==',
							'value' => 'sponsors_disclaimer',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => 'BROUGHT TO YOU BY VISTA OUTDOOR INC. AND ITS FAMILY OF <a href="http://www.vistaoutdoor.com/brands/" target="_blank">BRANDS</a>',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 2,
				'formatting' => 'html',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'category',
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


/// END ACF for microsites

?>