<?php
/*
Plugin Name: IMO Category Group Meta Boxes
Description: Create and organize groups of categories in meta boxes for the post edit screen. Replaces defualt category metabox.
Version: 0.1
Author: Salah for InterMedia Outdoors
*/

require_once dirname( __FILE__ ) . '/imo-category-groups-api.php';
class imo_settings_api_setup {	

    private $settings_api;

    function __construct() {
        $this->settings_api = imo_settings_api::getInstance();

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
		$tab_settings = get_option('imo_tab_settings');
		$tabs = $tab_settings['imo_tab_count'];
        $this->settings_api->set_sections( $this->get_settings_sections($tabs) );
        $this->settings_api->set_fields( $this->get_settings_fields($tabs) );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
		add_menu_page('IMO Category Group Meta Boxes Settings', 'Category Groups', 'editor', 'imo_category_groups', array($this, 'plugin_page'), '', '5.4');
    }

    function get_settings_sections($tabs) {
        $sections = array(
            array(
                'id' => 'imo_tab_settings',
                'title' => __( 'Settings', 'imo' )
            )
        );
		$i = 1;
		while($i <= $tabs ){
        	$sections[$i] = array(
            		'id' => 'imo_tab_'.$i,
            		'title' => __( 'Group '.$i, 'imo' )
        	);
			$i++;
		}
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields($tabs) {
		//Turn Categories into Array For Multiple check Settigns Field
		$imo_group_cats = '';
		$imo_get_cats = get_categories(
			array(
				'type'			=> 'post',
				'parent'		=> 0,
				'orderby'		=> 'name',
				'order'			=> 'ASC',
				'hide_empty'	=> 0
			)
		);
		foreach($imo_get_cats as $category) {
			$imo_group_cats .= '
                array(
                    "name" => "'.$category->cat_ID.'",
                    "label" => __( "'.$category->cat_name.'", "imo" ),
                    "type" => "checkbox"
                ),
				';
			
			$imo_get_child_cats = get_categories(
				array(
					'type'			=> 'post',
					'parent'		=> $category->cat_ID,
					'orderby'		=> 'name',
					'order'			=> 'ASC',
					'hide_empty'	=> 0
				)
			);
			foreach($imo_get_child_cats as $child_category) {
				$imo_group_cats .= '
                	array(
                    	"name" => "'.$child_category->cat_ID.'",
                    	"label" => __( "— '.$child_category->cat_name.'", "imo" ),
                    	"type" => "checkbox"
					),
				';		
			}	
		}
		
		$to_eval_array_loop = '';
		while($tabs > 0) {
			$to_eval_array_loop .= '
			"imo_tab_'.$tabs.'" => array(
                array(
                    "name" => "imo_group_title",
                    "label" => __( "<h4>Group Name</h4>", "imo" ),
                    "type" => "text",
                    "default" => ""
                ),
				'.$imo_group_cats.'

            ),
			';
			$tabs--;
		}
			
		
		$to_eval_array = '
		$settings_fields = array(
           '.$to_eval_array_loop.'
            "imo_tab_settings" => array(
                array(
                    "name" => "imo_tab_count",
                    "label" => __( "<h4>Number of Groups</h4>", "imo" ),
                    "type" => "text",
                    "default" => "1"
                ),
                array(
                    "name" => "imo_group_delete",
                    "label" => __( "delete this group", "imo" ),
                    "type" => "text",
                    "default" => ""
                )
            )
        );
		';
		eval($to_eval_array);
		
        return $settings_fields;
    }

    function plugin_page() {
        echo '
		<style>
		.postbox form h3 {display: none;}
		.sub-cat-spacer {float:left;width:17px;height:1px;}
		.clear {clear:both;}
		.wrap h2 {padding-bottom: 0px;}
		.updated {float: left; position: relative; z-index: 1000; margin: 12px 0 0 12px !important;}
		#wpbody-content .metabox-holder,
		#wpbody-content .metabox-holder .postbox {
			padding-top:0;
			-moz-box-shadow: none;
			-webkit-box-shadow: none;
			box-shadow: none;
		}
		#wpbody-content .metabox-holder .postbox {
			margin-top: -3px;
			border: 1px solid #aaa;
			padding: 10px;
		}
		a.nav-tab-active {
			background: #aaa;
			border: 1px solid #aaa;
			color: #fff;
			text-shadow: #000 0 1px 0;
		}
		.imo-success-or-error {
			margin-bottom:10px;
			padding: 10px;
			background: #FFFBCC;
			border: 1px solid #E6DB55;
			color: #000;
			font-weight: bold;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			width: 110px;
			text-align: center;
			display: none;
			float: left;
		}
		.form-submit-saving {
			padding-left: 20px;
			background: #FFFBCC url(../wp-content/plugins/imo-category-groups/assets/ajax-loader.gif) no-repeat 20px 10px;
		}
		.form-submit-success {
			border: 1px solid #0C5F1B;
			background: #ABD85A;
		}
		.form-submit-error {
			border: 1px solid red;
		}
		.title-input {
			padding: 0 5px 0 5px;
			width: 100% !important;
			margin-bottom: 20px;
		}
		h4, .title-input {
			font-size: 18px;
			line-height: 28px;
			height: 28px;
			display: inline;
			font-weight: normal;
		}
		.cat-list {
			float: left;
			margin: 10px 40px 0 0;
		}
		.child-checkbox {
			margin-left: 16px;
		}
		</style>
		<div class="wrap">
		<h1>IMO Category Group Meta Boxes</h1>
		';
        //settings_errors();
		
		$this->settings_api->show_header();
        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}

$settings = new imo_settings_api_setup();

//Post Edit Screen
function imo_cat_groups_post_edit_screen() {
	remove_meta_box('categorydiv', 'post', 'side');
/**
 * Calls the class on the post edit screen
 */
function call_imoMetaBoxClass() 
{
    return new imoMetaBoxClass();
}
if ( is_admin() ) add_action( 'admin_init', 'call_imoMetaBoxClass' );

/** 
 * The Class
 */
class imoMetaBoxClass {
	const LANG = 'imo_textdomain';
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}
	
	public function options_data() {

	}

	/**
	 * Adds the meta box container
	 */
	public function add_meta_box() {
		$settings = get_option('imo_tab_settings');
		$tabs = $settings['imo_tab_count'];
		$i = 1;
		while($i <= $tabs){
			$qued_tab = 'imo_tab_'.$i;
			$options = get_option($qued_tab);
			$title = $options['imo_group_title'];
			$types = array( 'post', 'reviews', 'reader_photos' );
			foreach( $types as $type ) {
				add_meta_box(
				 	$qued_tab
					,__( $title, self::LANG )
					,array( &$this, 'render_meta_box_content' )
					,$type
					,'side'
					,'high'
				);
			}
			$i++;
		}

	}
	
	//Meta Box content
	public function render_meta_box_content( $post, $qued_tab ) {
		wp_nonce_field( plugin_basename( __FILE__ ), 'validate_data_noncename' );

		echo '
		<style>
		.imo-group-box ul, .imo-group-box li {list-style-type: none !important;}
		ul.children {margin: 5px 0 0 16px;}
		</style>
		<div class="imo-group-box">
		';
		
		$imo_get_cats = get_categories(
			array(
				'type'			=> 'post',
				'orderby'		=> 'name',
				'order'			=> 'ASC',
				'hide_empty'	=> 0
			)
		);
		foreach($imo_get_cats as $category) {
			$options = get_option($qued_tab['id']);
			
			if($options[$category->cat_ID] == 'on' && $options[$category->category_parent] != 'on') {
				wp_category_checklist($post->ID, $category->cat_ID, '', '', '', false);
			}
		}
		
		echo '
		</div>
		';
	
	}

	public function save( $post_id ) {
		// Security, check if authorised to do this action. 
		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) )
				return;
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) )
				return;
		}
		if ( ! isset( $_POST['validate_data_noncename'] ) || ! wp_verify_nonce( $_POST['validate_data_noncename'], plugin_basename( __FILE__ ) ) )
			return;

		//Get and change post categories
		
		
		
		
		
	}
}

}
add_action('admin_menu', 'imo_cat_groups_post_edit_screen');



?>