<?php

if (!class_exists('cfct_row_ab_c')) {
	class cfct_row_ab_c extends cfct_build_row {
		protected $_deprecated_id = 'row-ab-c'; // deprecated property, not needed for new module development
		
		public function __construct() {
			$config = array(
				'name' => __('Right Sidebar', 'carrington-build'),
				'description' => __('2 columns. The first column is wider than the second.', 'carrington-build'),
				'icon' => '2col-1wide/icon.png',
				'class' => 'cfct-row-ab-c',
				'blocks' => array(
					array(
						'class' => 'cfct-block-ab',
					),
					array(
						'class' => 'cfct-block-c',
					)
				)
			);
			parent::__construct($config);
		}
	}
	cfct_build_register_row('cfct_row_ab_c');
}

?>