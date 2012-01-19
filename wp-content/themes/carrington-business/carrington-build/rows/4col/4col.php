<?php

/**
 * 4 Column Row by BoldWater for FLSM
 *
 * @package Carrington Build
 */

class cfct_row_4col extends cfct_build_row {
	public function __construct() {
		$config = array(
			'name' => __('4 Column', 'carrington-build'),
			'description' => __('4 Column Row for Florida Sportsman'),
			'icon' => '4col/icon.png',
			'class' => 'cfct_row_4col',
			'blocks' => array(
				array(
					'class' => 'cfct_row_4col-block-a'
				),
				array(
					'class' => 'cfct_row_4col-block-b'
				),
				array(
					'class' => 'cfct_row_4col-block-c'
				),
				array(
					'class' => 'cfct_row_4col-block-d'
				)
			)
		);
		parent::__construct($config);
	}
}
cfct_build_register_row('cfct_row_4col');

?>