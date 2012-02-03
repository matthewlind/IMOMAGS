<?php

/**
 * 3 Column Row
 *
 * @package Carrington Build
 */
if (!class_exists('cfct_row_abc_mod1')) {
	class cfct_row_abc_mod1 extends cfct_build_row {
		protected $_deprecated_id = 'row-abc'; // deprecated property, not needed for new module development
		
		public function __construct() {
			$config = array(
				'name' => __('3 Column mod 1 ', 'carrington-build'),
				'description' => __('A modified 3 column row.', 'carrington-build'),
				'icon' => '3col-a/icon.png',
				'class' => 'cfct-row-a-b-c-mod1',
				'blocks' => array(
					array(
						'class' => 'cfct-block-d',
					),
					array(
						'class' => 'cfct-block-f',
					),
					array(
						'class' => 'cfct-block-g',
					)
				)
			);
			$this->push_block(new cfct_block_c6_d);
			$this->push_block(new cfct_block_c6_f);
			$this->push_block(new cfct_block_c6_g);

			

			parent::__construct($config);
		}
	}
	cfct_build_register_row('cfct_row_abc_mod1');
}

?> 
