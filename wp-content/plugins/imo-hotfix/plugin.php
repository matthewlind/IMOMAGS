<?php
/*
 * Plugin Name: IMO Hot Fix
 * Plugin URI: http://github.com/imoutdoors
 * Description: Adds a stylesheet to the header containing any temporary style hot fixes needed
 * Version: 0.1
 * Author: jacob angel 
 * Author URI: http://imomags.com
 */

/******************************************************************************************
 * Administration Menus
 * Adds a hotfix settings page 
 ******************************************************************************************/



/* add_settings_field callback */
function imo_hotfix_css_settings_option() {
?>
    <textarea cols='45' rows='9' name='hotfix_css' id='imo-hotfix_hotfix-css'><?php print get_option("hotfix_css", ""); ?></textarea>
<?php
}

/* create options page. */
function imo_hotfix_generate_options_page() {
?>
<div class="wrap">
<h2>IMO Hot Fixes</h2>
<form method="post" action="options.php" >
<?php settings_fields( 'imo-hotfix-settings' ); ?>
<table class="form-table">
        <tr valign="top">
<th scope="row"><label for="hotfix_css">CSS Rules</label></th>
<td>
    <textarea cols='45' rows='9' name='hotfix_css' ><?php print get_option("hotfix_css"); ?></textarea>
</td>
</tr>
</table>
    <p class="submit">
    <input type="hidden" name="hotfix_cachebuster" value="<?php print time(); ?>"/>
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
</form>
</div>
<?php
}


/** admin_init call back **/
function register_imo_hotfix_settings() {
    register_setting("imo-hotfix-settings", "hotfix_css", "esc_html");
    register_setting("imo-hotfix-settings", "hotfix_cachebuster", "intval");
}


/* admin_menu callback. */
function imo_hotfix_settings_init() {
    add_action("admin_init", "register_imo_hotfix_settings");
    add_submenu_page("options-general.php", "IMO Hot Fixes", "Hot Fixes", "manage_options", "imo-hotfix", "imo_hotfix_generate_options_page");
}

add_action("admin_menu", "imo_hotfix_settings_init");

function imo_hotfix_css() {
    if (preg_match("/^\/hotfix-style\.css(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
        header('Content-type: text/css');
        header("Cache-Control: public");
        // Cache for 1 week
        header('Expires: '.gmdate('D, d M Y H:i:s', time() + 86400*7) . 'GMT'); 
        ?>
/**
 * Hotfix Stylesheet
 */
<?php
        print esc_html(get_option("hotfix_css"));
        die();
    } 
}

function imo_hotfix_add_stylesheet(){
    $contents = get_option("hotfix_css",'');
    if (!empty($contents)) {
        wp_enqueue_style("hotfix_stylesheet", "/hotfix-style.css", array(), get_option("hotfix_cachebuster"), 'screen');
    }
}


add_action('wp_print_styles', 'imo_hotfix_add_stylesheet');
add_action("init", "imo_hotfix_css");
