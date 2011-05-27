<?php

if (!class_exists('cfct_row_two_col_float_right')) {
	class cfct_row_two_col_float_right extends cfct_build_row {
		protected $_deprecated_id = 'two-col-float-right'; // deprecated property, not needed for new module development
		
		public function __construct() {
			$config = array(
				'name' => __('Full Column, Right Float', 'carrington-build'),
				'description' => __('A full-width column with a second column floated to the right. Contents of the full-width column wrap around the floated column.', 'carrington-build'),
				'icon' => '2col-2floatright/icon.png',
				'class' => 'cfct-row-float-c',
				'html' => '<div id="{id}" class="{class}">{block_1}{block_0}</div>', // specify each block instead of {blocks} to dictate the output order
				'blocks' => array(
					array(
						'class' => 'cfct-block-float-abc cfct-block-ab', // use built in styles for admin layout
						'html' => '<div id="{id}" class="cfct-block cfct-block-abc">{module}</div>' // use our own styles for client side layout
					),
					array(
						'class' => 'cfct-block-float-c cfct-block-c', // use built in styles for admin layout
						'html' => '<div id="{id}" class="cfct-block cfct-block-float-c">{module}</div>' // use our own styles for client side layout
					)
				)
			);
			parent::__construct($config);
		}
		
		public function css() {
			return apply_filters(
				'cfct_row_two_col_float_right_css',
				'
				.cfct-row-float-c .cfct-block-abc {
					float: none;
					width: auto;
				}
				.cfct-row-float-c .cfct-block-float-c {
					float: right;
					/* Force text wrapping. This is an arbitrary number, but we have
					to specify something or text wrapping will not work properly. */
					max-width: 350px;
				}
				.cfct-row-float-c .cfct-block {
					overflow: visible;
				}
				.cfct-row-float-c .cfct-block-float-c .cfct-module {
					margin-bottom: 15px;
					margin-right: 0;
				}
			');
		}
	}
	cfct_build_register_row('cfct_row_two_col_float_right');
}

?>