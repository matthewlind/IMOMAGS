<?php

/**
 * 3 Column Row for Pages with Right Sidebar
 *
 * @package Carrington Build
 */
if (!class_exists('cfct_row_abc_rs')) {
	class cfct_row_abc_rs extends cfct_build_row {
		protected $_deprecated_id = 'row-abc'; // deprecated property, not needed for new module development
		
		public function __construct() {
			$config = array(
				'name' => __('3 Column with Right Sidebar', 'carrington-build'),
				'description' => __('A 3 column row to fit right sidebar.', 'carrington-build'),
				'icon' => '3col/icon.png',
				'class' => 'cfct-row-a-b-c',
				'blocks' => array(
					array(
						'class' => 'cfct-block-third',
					),
					array(
						'class' => 'cfct-block-third',
					),
					array(
						'class' => 'cfct-block-third-last',
					)
				)
			);


			$this->set_filter_mod('cfct-row-a-b-c');

			$this->add_classes(array('row-c6-12-34-56'));
			$this->add_classes(array('cfct-row-a-b-c'));

			$this->push_block(new cfct_block_c6_third);
			$this->push_block(new cfct_block_c6_third_2);
			$this->push_block(new cfct_block_c6_third_last);

			
			
			


			parent::__construct($config);
		}
	}
	cfct_build_register_row('cfct_row_abc_rs');
}

?>