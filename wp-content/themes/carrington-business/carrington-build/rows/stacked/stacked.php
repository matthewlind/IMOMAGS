<?php

if (!class_exists('cfct_stacked_example')) {
	class cfct_row_stacked_example extends cfct_build_row {
		protected $_deprecated_id = 'cfct-row-stacked-example'; // deprecated property, not needed for new module development
		
		public function __construct() {
			$config = array(
				'name' => __('A Multi-Row', 'carrington-build'),
				'description' => __('Carrington Build is capable of complex row layouts', 'carrington-build'),
				'icon' => 'stacked/icon.png',
				'class' => 'cfct-row-stacked-example',
				'html' => '
					<div id="{id}" class="{class}">
						<div class="cfct-row-inner">
							<div class="cfct-stacked-left">{block_0}</div>
							<div class="cfct-stacked-right">
								<div class="cfct-stacked-right-top">{block_1}</div>
								<div class="cfct-stacked-right-bottom">{block_2}{block_3}</div>
							</div>
						</div>
					</div>
					',
				'admin_blocks' => '
					<tr>
						{block_0}
						{block_1}
					</tr>
					<tr>
						{block_1_controls}
					</tr>
					<tr>
						{block_2}{block_3}
					</tr>
					<tr>
						{block_0_controls}
						{block_2_controls}
						{block_3_controls}
					</tr>
					',
				'blocks' => array(
					array(
						'class' => 'cfct-block-stacked-a cfct-block-a',
						'attrs' => array(
							'rowspan' => 3
						)
					),
					array(
						'class' => 'cfct-block-stacked-bc cfct-block-bc',
						'attrs' => array(
							'colspan' => 2
						)
					),
					array(
						'class' => 'cfct-block-stacked-b cfct-block-b'
					),
					array(
						'class' => 'cfct-block-stacked-c cfct-block-c'
					)
				)
			);
			parent::__construct($config);
		}

		public function admin_css() {
			return $this->common_css();
		}
		
		public function css() {
			return $this->common_css();
		}

		public function common_css() {
			return '
				.'.$this->config['class'].' .cfct-stacked-left {
					display: inline;
					float: left;
					width: 33.33%;
				}
				.'.$this->config['class'].' .cfct-stacked-right {
					display: inline;
					float: left;
					width: 66.66%;
				}
				.'.$this->config['class'].' .cfct-stacked-left .cfct-block-stacked-a,
				.'.$this->config['class'].' .cfct-stacked-right .cfct-block-stacked-bc {
					width: 100%;
				}
				.'.$this->config['class'].' .cfct-stacked-right .cfct-stacked-right-bottom .cfct-block-stacked-b,
				.'.$this->config['class'].' .cfct-stacked-right .cfct-stacked-right-bottom .cfct-block-stacked-c {
					width: 50%;
				}
				';
		}
	}
	#cfct_build_register_row('cfct_row_stacked_example');
}

?>