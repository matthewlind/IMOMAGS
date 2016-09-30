<?php
/*
Plugin Name: Easy Table Creator
Plugin URI: http://wordpress.org/extend/plugins/easy-table-creator
Version: 0.1.1
Author: PolyVision
Description: This plugin allows you to easily add an image gallery to a post or page.

Copyright 2010  PolyVision

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributded in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/



if (!class_exists("EasyTableCreator")) {
	class EasyTableCreator {
                var $adminOptionsName = "EasyTableCreatorAdminOptions";




		function EasyTableCreator() { //constructor

		}

                function init() {
                    $this->getAdminOptions();

                }



                function getAdminOptions() {
                    $EasyTableCreatorAdminOptions = array(
                        'easy_table_creator_link' => true,
                        'easy_table_creator_tablesorter'=>true
                    );


                    $EasyTableCreatorOptions = get_option($this->adminOptionsName);
                    if (!empty($EasyTableCreatorOptions)) {
                        foreach ($EasyTableCreatorOptions as $key => $option)
                           $EasyTableCreatorAdminOptions[$key] = $option;
                    }
                    update_option($this->adminOptionsName, $EasyTableCreatorAdminOptions);



                    return $EasyTableCreatorAdminOptions;


                }


		


                function printAdminPage() {

                    global $wpdb;

                    $EasyTableCreatorOptions = $this->getAdminOptions();

                    if (isset($_POST['update_easy_table_creator_settings'])) {


                            $EasyTableCreatorOptions['easy_table_creator_link'] = $_POST['easy_table_creator_link'];
                           
                               $EasyTableCreatorOptions['easy_table_creator_tablesorter'] = $_POST['easy_table_creator_tablesorter'];




                        update_option($this->adminOptionsName, $EasyTableCreatorOptions);

                       

                       ?>

                        <div class="updated"><p><strong><?php _e("Settings Updated.", "EasyTableCreator");?></strong></p></div>

                     <?php
                    }

                    ?>
                    <div class="wrap">

				<h2>Easy Table Creator</h2>
				<div class="postbox-container" style="width:65%;">
					<div class="metabox-holder">
						<div class="meta-box-sortables">
                    <form action="<?php echo get_bloginfo('wpurl') ; ?>/wp-admin/options-general.php?page=easy-table-creator.php" method="post">
                        <div class="postbox" style="">
                            <h3>
                                <span>Easy Table Creator Settings</span>
                            </h3>
                            <div class="inside" style="padding:10px;">
                        <table class="form-table">
                            <tbody>

                             <tr>
                                    <th scope="row">
                                        <label for="easy_table_creator_tablesorter">Use Tablesorter:</label>
                                    </th>
                                    <td>
                                        <input type="checkbox" id="easy_table_creator_tablesorter" name="easy_table_creator_tablesorter" <?php if ($EasyTableCreatorOptions['easy_table_creator_tablesorter']=='on') echo 'CHECKED' ;?> />
                                        <span class="description">
                                            <a href="http://tablesorter.com/docs/">Tablesorter</a> is a jQuery plugin that allows you to easily sort your table.
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        <label for="easy_table_creator_link">Add link to creator:</label>
                                    </th>
                                    <td>
                                        <input type="checkbox" id="easy_table_creator_link" name="easy_table_creator_link" <?php if ($EasyTableCreatorOptions['easy_table_creator_link']=='on') echo 'CHECKED' ;?> />
                                        <span class="description">
                                            This link is a way to thank <a target="_new" href="http://www.polyvision.com">us</a> for all our hard work in putting this plugin  together. If you like
                        the plugin please consider leaving the link in.
                                        </span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="alignright">
                        <input type="submit" class="button-primary" name="update_easy_table_creator_settings" value="<?php _e('Update Settings', 'EasyTableCreator') ?>" /></div>
                        <br class="clear" />
                            </div>
                        </div>









                                      </form>


                         </div><!--metabox-sortables-->
                                        </div><!--metabox-holder-->
                                </div><!--postbox-container-->
                                <div style="width: 20%;" class="postbox-container side">
                                    <div class="metabox-holder">
                                        <div class="meta-box-sortables ui-sortable">
                                            <div class="postbox" id="toc">
                                                
                                                    <h3>Bugs or Questions?</h3>
                                                    <div class="inside">
                                                        <p style="padding:10px;">Please post any questions or bugs you find to the
                                                            wordpress forum for this plugin.<br />
                                                            <a href="http://wordpress.org/tags/easy-table-creator?forum_id=10">
                                                                Easy Table Creator Forum
                                                            </a>
                                                        </p>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>








                                </div>
                      

                    </div><!--wrap-->

                        <?php



                }



                function addHeaderCode() {
                    global $user_ID;
                    $EasyTableCreatorOptions = $this->getAdminOptions();



                    echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/easy-table-creator/css/easy_table_creator.css" />' . "\n";

                     if ($EasyTableCreatorOptions['easy_table_creator_tablesorter']) {
                        echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/easy-table-creator/css/tablesorter/style.css" />' . "\n";

                     }


                    if (function_exists('wp_enqueue_script')) {

                       wp_enqueue_script('easy_table_creator_js', get_bloginfo('wpurl') . '/wp-content/plugins/easy-table-creator/js/easy_table_creator.js', array('jquery'), '0.1');

                       if ($EasyTableCreatorOptions['easy_table_creator_tablesorter']) {

                            wp_enqueue_script('easy_table_creator_tablesorter_js', get_bloginfo('wpurl') . '/wp-content/plugins/easy-table-creator/js/jquery.tablesorter.min.js', array('jquery'), '0.1');


                       }
            

                    }

                    $EasyTableCreatorAdminOptions = $this->getAdminOptions();

                    //not sure about this one
                    if (!isset($EasyTableCreatorAdminOptions['show_header']) || $EasyTableCreatorAdminOptions['show_header'] == "false") { return; }

                }


                function addFooterCode() {
                      $EasyTableCreatorOptions = $this->getAdminOptions();
                    //nothing to do here

                     if ($EasyTableCreatorOptions['easy_table_creator_tablesorter']) {
                         ?>
<script type="text/javascript">

    jQuery(document).ready(function(){
        jQuery(".easy-table-creator").tablesorter({widgets: ['zebra']});


    })



</script>
<?php


                     }





                }


                function linkFilter($content = '') {
                    $EasyTableCreatorOptions = $this->getAdminOptions();
                    if ($EasyTableCreatorOptions['easy_table_creator_link']) {
                      $link = '<p style="clear:left;font-size:10px;"><a href="http://www.polyvision.com">Interactive Whiteboards</a> by PolyVision</p>';

                    } else {
                        $link='<p class="easy_table_creator_link" style="clear:left;padding:0;margin:0;"></p>';
                    }

                    //if there is just one instance of <!--[EASY_TABLE_CREATOR_LINK]--> replace it , then remove others

                    //<div class="polyvision_credit_link"></div>
                     $content = preg_replace('/\<div\ class=\"polyvision_credit_link">\<\!\-\-POLYVISION_CREDIT\-\-\>\<\/div\>/',$link,$content,1);




                     return $content;
                }


                /*mce stuff*/
                function myplugin_addbuttons() {
                   // Don't bother doing this stuff if the current user lacks permissions
                   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
                     return;

                   // Add only in Rich Editor mode
                   if ( get_user_option('rich_editing') == 'true') {

                     add_filter("mce_external_plugins", array(&$this, 'add_myplugin_tinymce_plugin'),1 );
                     add_filter('mce_buttons', array(&$this, 'register_myplugin_button'),1);

                     //need to add filter for external_image_list_url
                     add_filter('tiny_mce_before_init', array(&$this, 'my_change_mce_options'), 1);
                   }
                }

                function my_change_mce_options( $init ) {

                   
                    $init['select_image'] = get_bloginfo('wpurl') . '/wp-content/plugins/easy-table-creator/tinymce/easytablecreator/img/gallery_btn.gif';
                    return $init;
                }

                function register_myplugin_button($buttons) {

                   array_push($buttons, "EasyTableCreator");
                   return $buttons;
                }

                // Load the TinyMCE plugin : editor_plugin.js (wp2.5)
                function add_myplugin_tinymce_plugin($plugin_array) {

                   $plugin_array['EasyTableCreator'] =  get_bloginfo('wpurl') . '/wp-content/plugins/easy-table-creator/tinymce/easytablecreator/editor_plugin.js';

                   return $plugin_array;
                }





	}

} //End Class EasyTableCreator

//Initialize the admin panel
if (!function_exists("EasyTableCreator_ap")) {
    function EasyTableCreator_ap() {

        global $easy_table_creator_plugin;
        if (!isset($easy_table_creator_plugin)) {
            return;
        }

        if (function_exists('add_options_page')) {

            add_options_page('Easy Table Creator', 'Easy Table Creator', 9, basename(__FILE__), array(&$easy_table_creator_plugin, 'printAdminPage'));

        }

    }
}



if (class_exists("EasyTableCreator")) {
	$easy_table_creator_plugin = new EasyTableCreator();
}



//Actions and Filters
if (isset($easy_table_creator_plugin)) {
	//Actions
        add_action('init',  array(&$easy_table_creator_plugin, 'myplugin_addbuttons'),1);
    	add_action('wp_head', array(&$easy_table_creator_plugin, 'addHeaderCode'), 1);
        add_action('wp_footer', array(&$easy_table_creator_plugin, 'addFooterCode'), 1);
        add_action('admin_menu', 'EasyTableCreator_ap');
        add_action('activate_tinymce-thumbnail-gallery/tinymce-thumbnail-gallery.php', array(&$easy_table_creator_plugin, 'init'));


        ////Filters
        add_filter( "the_content", array(&$easy_table_creator_plugin, 'linkFilter'));

}


