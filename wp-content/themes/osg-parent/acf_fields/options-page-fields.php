<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_footer-featured-content',
		'title' => 'Footer Featured Content',
		'fields' => array (
			array (
				'key' => 'field_573a2ca08df2a',
				'label' => 'Footer Featured Post or Page',
				'name' => 'footer_post_or_page',
				'type' => 'relationship',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_574470b4c56ce',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'return_format' => 'id',
				'post_type' => array (
					0 => 'all',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
					1 => 'post_type',
				),
				'result_elements' => array (
					0 => 'featured_image',
					1 => 'post_type',
					2 => 'post_title',
				),
				'max' => 1,
			),
			array (
				'key' => 'field_574470b4c56ce',
				'label' => 'Custom Image and Url?',
				'name' => 'is_custom_img_and_url',
				'type' => 'true_false',
				'instructions' => 'Check this box to input your own featured image, title, link and call to action.',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5744759608d14',
				'label' => 'Featured Content TITLE',
				'name' => 'foot_post_title',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_574470b4c56ce',
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
				'key' => 'field_574471a31c73a',
				'label' => 'Featured Content URL',
				'name' => 'foot_post_url',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_574470b4c56ce',
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
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_574471441c739',
				'label' => 'Featured Content IMAGE',
				'name' => 'foot_post_img',
				'type' => 'image',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_574470b4c56ce',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'object',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array (
				'key' => 'field_574471ec1c73b',
				'label' => 'Featured Content CTA',
				'name' => 'foot_post_btn_txt',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_574470b4c56ce',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => 'Explore Now!',
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
		'menu_order' => -20,
	));
	
	register_field_group(array (
		'id' => 'acf_homepage-fields',
		'title' => 'Homepage Fields',
		'fields' => array (
			array (
				'key' => 'field_573c885547f34',
				'label' => 'Homepage Featured Category',
				'name' => 'homepage_featured_category',
				'type' => 'taxonomy',
				'taxonomy' => 'category',
				'field_type' => 'select',
				'allow_null' => 0,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
			),
			array (
				'key' => 'field_57597848699dd',
				'label' => 'Homepage "explore" categories',
				'name' => 'home_explore_categories',
				'type' => 'repeater',
				'instructions' => 'Preferred numbers of chosen categories	are 3, 5, 8 or 11',
				'sub_fields' => array (
					array (
						'key' => 'field_575978cffc7b2',
						'label' => 'Explore Category',
						'name' => 'explore_category',
						'type' => 'taxonomy',
						'column_width' => '',
						'taxonomy' => 'category',
						'field_type' => 'select',
						'allow_null' => 0,
						'load_save_terms' => 0,
						'return_format' => 'id',
						'multiple' => 0,
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
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
	
	//Byline
	register_field_group(array (
		'id' => 'acf_byline-field',
		'title' => 'Byline Field',
		'fields' => array (
			array (
				'key' => 'field_578fa885cb826',
				'label' => 'Byline',
				'name' => 'byline',
				'type' => 'text',
				'instructions' => 'Enter the byline',
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
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	
	register_field_group(array (
		'id' => 'acf_homepage-options',
		'title' => 'Homepage Options',
		'fields' => array (
			array (
				'key' => 'field_5396f72a968le',
				'label' => 'Homepage Featured Stories.',
				'name' => 'homepage_featured_stories_',
				'type' => 'relationship',
				'instructions' => 'Choose 5 featured posts to be displayed at the beginning of the homepage',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'post',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'featured_image',
					1 => 'post_type',
					2 => 'post_title',
				),
				'max' => 6,
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
		'menu_order' => 31,
	));
}

?>
