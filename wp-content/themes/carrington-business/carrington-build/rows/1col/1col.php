<?php

if (!class_exists('cfct_row_a')) {
	class cfct_row_a extends cfct_build_row {
		protected $_deprecated_id = 'row-a'; // deprecated property, not needed for new module development
		
		public function __construct() {
			$config = array(
				'name' => __('1 Column', 'carrington-build'),
				'description' => __('A single full-width column', 'carrington-build'),
				'icon' => '1col/icon.png',
				'class' => 'cfct-row-abc',
				'blocks' => array(
					array(
						'class' => 'cfct-block-abc'
					)
				)
			);
			parent::__construct($config);		
		}
	}
	cfct_build_register_row('cfct_row_a');
}

?>