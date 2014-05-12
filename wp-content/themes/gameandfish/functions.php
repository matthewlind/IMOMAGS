<?php

define("JETPACK_SITE", "gamefish");
define("DARTADGEN_SITE", "imo.gameandfish");
define("USE_IFRAME_ADS",FALSE);
define("SUBS_LINK", "http://subs.gameandfishmag.com/");
define("GIFT_LINK", "http://subs.gameandfishmag.com/gift");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0ODg0NDcwNSZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 70% off<br/> the Cover Price");

define("FACEBOOK_LINK", "https://www.facebook.com/GameAndFish");
define("TWITTER_LINK", "https://www.twitter.com/@gameandfishmag");
define("RSS_LINK", "http://www.gameandfishmag.com/feed/");
define("SITE_LINK", "gameandfishmag.com");
define("SITE_NAME", "Game & Fish");

define("FACEBOOK_APP_ID","624736570896056");
define("FACEBOOK_APP_SECRET","4011410d01c27af26e016760c03492ea");

include_once("widgets/gf-community-slider.php");

//community menus
register_nav_menus(array(
    'hunting' => 'Hunting Community Menu',
    'fishing' => 'Fishing Community Menu'
));

/* This function allows for logging when debugging mode is on */
if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}
function imo_sidebar($type){
	//Speed up mobile load time by not loading sidebar in the background
	if(!mobile()){
		$dartDomain = get_option("dart_domain", $default = false);
		echo '<div class="sidebar-area">';
			echo '<div class="sidebar">';
				echo '<div class="widget_advert-widget">';
				echo '<iframe id="sidebar-iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?ad_code='.$dartDomain.'"></iframe>';
				echo '</div>';
			echo '</div>';
		    get_sidebar($type);
		    	echo '<div id="responderfollow"></div>';
				echo '<div class="sidebar advert">';
					echo '<div class="widget_advert-widget">';
						echo '<iframe id="sticky-iframe-ad" width="310" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-sticky.php?ad_code='.$dartDomain.'"></iframe>';
					echo '</div>';
					get_sidebar("sticky");
				echo '</div>';
		echo '</div>';
	}
}

function imo_community_sidebar(){
	$dartDomain = get_option("dart_domain", $default = false);
	echo '<div class="sidebar-area">';
		echo '<label class="upload-button">';
        echo '<a href="/add-new-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a>';
        echo '<input id="image-upload" class="common-image-upload" type="file" name="photo-upload">';
		echo '</label>';
		get_sidebar("community");
		echo '<div class="sidebar">';
			echo '<div class="widget_advert-widget">';
			echo '<iframe id="community-iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?ad_code='.$dartDomain.'"></iframe>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

function social_networks(){
	echo '<div class="socials">';
		echo '<a href="'.FACEBOOK_LINK.'" class="facebook" target="_blank">Facebook</a>';
	    echo '<a href="'.TWITTER_LINK.'" class="twitter" target="_blank">Twitter</a>';
	    echo '<a href="'.RSS_LINK.'" class="rss" target="_blank">RSS</a>';
	echo '</div>';
}

function sub_footer(){ ?>
	<div class="sub-boxes">
		<div class="sub-box banner-box">
			<?php imo_dart_tag("300x250",array("pos"=>"mid")); ?>
		</div>
		<div class="sub-box fb-box">
			<div class="newsletter-box bottom-newsletter">
				<?php the_widget("Signup_Widget_Header", "title=GET THE NEWSLETTER!"); ?>
			</div>
		</div>
	</div>
	<?php
}

function social_footer(){ ?>
	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
<?php }


//SETTINGS PAGE FOR US STATE POST SETS
add_action("admin_menu", "gf_post_sets_menu");

function gf_post_sets_menu() {
    add_menu_page("Game & Fish State Post Sets", "G&F State Post Sets", "editor", 'gf-post-sets', "gf_post_sets_page");
    add_action("admin_init", "gf_post_sets_settings");
}

function gf_post_sets_settings () {

register_setting( 'gf-post-sets-settings-group', 'AL_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'AK_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'AZ_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'AR_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'CA_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'CO_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'CT_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'DE_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'DC_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'FL_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'GA_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'HI_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'ID_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'IL_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'IN_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'IA_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'KS_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'KY_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'LA_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'ME_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'MT_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'NE_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'NV_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'NH_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'NJ_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'NM_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'NY_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'NC_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'ND_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'OH_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'OK_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'OR_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'MD_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'MA_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'MI_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'MN_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'MS_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'MO_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'PA_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'RI_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'SC_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'SD_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'TN_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'TX_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'UT_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'VT_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'VA_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'WA_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'WV_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'WI_state_post_set');
register_setting( 'gf-post-sets-settings-group', 'WY_state_post_set');

}


function gf_post_sets_page() {
?>
<div class="wrap">
<h2>Game & Fish Post Sets</h2>
<form method="post" action="options.php">
<?php settings_fields( 'gf-post-sets-settings-group' ); ?>
<table class="form-table">
		<tr valign="top">
        <td><strong>Enter the Post Set ID for each state. If no ID is set, the most recent state articles will be chosen instead.</strong></td>
        </tr>
<tr valign="top">
    <th scope="row">AL</th>
    <td><input type="text" name="AL_state_post_set" value="<?php echo get_option('AL_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">AK</th>
    <td><input type="text" name="AK_state_post_set" value="<?php echo get_option('AK_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">AZ</th>
    <td><input type="text" name="AZ_state_post_set" value="<?php echo get_option('AZ_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">AR</th>
    <td><input type="text" name="AR_state_post_set" value="<?php echo get_option('AR_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">CA</th>
    <td><input type="text" name="CA_state_post_set" value="<?php echo get_option('CA_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">CO</th>
    <td><input type="text" name="CO_state_post_set" value="<?php echo get_option('CO_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">CT</th>
    <td><input type="text" name="CT_state_post_set" value="<?php echo get_option('CT_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">DE</th>
    <td><input type="text" name="DE_state_post_set" value="<?php echo get_option('DE_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">DC</th>
    <td><input type="text" name="DC_state_post_set" value="<?php echo get_option('DC_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">FL</th>
    <td><input type="text" name="FL_state_post_set" value="<?php echo get_option('FL_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">GA</th>
    <td><input type="text" name="GA_state_post_set" value="<?php echo get_option('GA_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">HI</th>
    <td><input type="text" name="HI_state_post_set" value="<?php echo get_option('HI_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">ID</th>
    <td><input type="text" name="ID_state_post_set" value="<?php echo get_option('ID_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">IL</th>
    <td><input type="text" name="IL_state_post_set" value="<?php echo get_option('IL_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">IN</th>
    <td><input type="text" name="IN_state_post_set" value="<?php echo get_option('IN_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">IA</th>
    <td><input type="text" name="IA_state_post_set" value="<?php echo get_option('IA_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">KS</th>
    <td><input type="text" name="KS_state_post_set" value="<?php echo get_option('KS_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">KY</th>
    <td><input type="text" name="KY_state_post_set" value="<?php echo get_option('KY_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">LA</th>
    <td><input type="text" name="LA_state_post_set" value="<?php echo get_option('LA_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">ME</th>
    <td><input type="text" name="ME_state_post_set" value="<?php echo get_option('ME_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">MT</th>
    <td><input type="text" name="MT_state_post_set" value="<?php echo get_option('MT_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">NE</th>
    <td><input type="text" name="NE_state_post_set" value="<?php echo get_option('NE_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">NV</th>
    <td><input type="text" name="NV_state_post_set" value="<?php echo get_option('NV_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">NH</th>
    <td><input type="text" name="NH_state_post_set" value="<?php echo get_option('NH_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">NJ</th>
    <td><input type="text" name="NJ_state_post_set" value="<?php echo get_option('NJ_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">NM</th>
    <td><input type="text" name="NM_state_post_set" value="<?php echo get_option('NM_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">NY</th>
    <td><input type="text" name="NY_state_post_set" value="<?php echo get_option('NY_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">NC</th>
    <td><input type="text" name="NC_state_post_set" value="<?php echo get_option('NC_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">ND</th>
    <td><input type="text" name="ND_state_post_set" value="<?php echo get_option('ND_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">OH</th>
    <td><input type="text" name="OH_state_post_set" value="<?php echo get_option('OH_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">OK</th>
    <td><input type="text" name="OK_state_post_set" value="<?php echo get_option('OK_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">OR</th>
    <td><input type="text" name="OR_state_post_set" value="<?php echo get_option('OR_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">MD</th>
    <td><input type="text" name="MD_state_post_set" value="<?php echo get_option('MD_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">MA</th>
    <td><input type="text" name="MA_state_post_set" value="<?php echo get_option('MA_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">MI</th>
    <td><input type="text" name="MI_state_post_set" value="<?php echo get_option('MI_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">MN</th>
    <td><input type="text" name="MN_state_post_set" value="<?php echo get_option('MN_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">MS</th>
    <td><input type="text" name="MS_state_post_set" value="<?php echo get_option('MS_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">MO</th>
    <td><input type="text" name="MO_state_post_set" value="<?php echo get_option('MO_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">PA</th>
    <td><input type="text" name="PA_state_post_set" value="<?php echo get_option('PA_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">RI</th>
    <td><input type="text" name="RI_state_post_set" value="<?php echo get_option('RI_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">SC</th>
    <td><input type="text" name="SC_state_post_set" value="<?php echo get_option('SC_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">SD</th>
    <td><input type="text" name="SD_state_post_set" value="<?php echo get_option('SD_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">TN</th>
    <td><input type="text" name="TN_state_post_set" value="<?php echo get_option('TN_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">TX</th>
    <td><input type="text" name="TX_state_post_set" value="<?php echo get_option('TX_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">UT</th>
    <td><input type="text" name="UT_state_post_set" value="<?php echo get_option('UT_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">VT</th>
    <td><input type="text" name="VT_state_post_set" value="<?php echo get_option('VT_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">VA</th>
    <td><input type="text" name="VA_state_post_set" value="<?php echo get_option('VA_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">WA</th>
    <td><input type="text" name="WA_state_post_set" value="<?php echo get_option('WA_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">WV</th>
    <td><input type="text" name="WV_state_post_set" value="<?php echo get_option('WV_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">WI</th>
    <td><input type="text" name="WI_state_post_set" value="<?php echo get_option('WI_state_post_set'); ?>" /></td>
 </tr>
<tr valign="top">
    <th scope="row">WY</th>
    <td><input type="text" name="WY_state_post_set" value="<?php echo get_option('WY_state_post_set'); ?>" /></td>
 </tr>

  </table>

    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
</form>
</div>

<?php
}

function custom_post_author_archive($query) {
    if ($query->is_author) {

        $query->set( 'post_type', array('reader_photos', 'reader_photo', 'post') );

    }

    remove_action( 'pre_get_posts', 'custom_post_author_archive' );
}
add_action('pre_get_posts', 'custom_post_author_archive');




/******************************************************************************************
 * Admin Settings Menu for Community New Post Promo Image
 ******************************************************************************************/

/* add_settings_field callback */
function gf_community_promo_settings_option() {
    echo "<input type='text' name='community_promo_image_url' id='gf-promo-settings' value='".get_option("community_promo_image_url", "" )."' />";
}

function gf_community_promo_settings_section() {
    echo "";
}

/* admin_menu callback. */
function gf_community_promo_settings_init() {
    add_settings_section("community_promo_settings", __("Community Promo Settings"), "gf_community_promo_settings_section", "general");
    add_settings_field("community_promo_image_url", __("Community Promo Image URL"), "gf_community_promo_settings_option", "general", "community_promo_settings");
    register_setting("general", "community_promo_image_url");
}
add_action("admin_menu", "gf_community_promo_settings_init");




//G&F Wordpress Community Config
add_action("init","gf_wp_community_init",2);
function gf_wp_community_init() {

    wp_enqueue_script( 'bootstrap-dropdown', get_stylesheet_directory_uri() . '/js/bootstrap-dropdown.js', array("jquery",'underscore'), '0.1', true );
    wp_enqueue_script( 'gf-wp-community-listing', get_stylesheet_directory_uri() . '/js/community-listing.js', array("jquery",'underscore','bootstrap-dropdown'), '0.1', true );

}



//Configure G&F community
//This section does nothing unless imo-community plugin is enabled
add_action("init","gf_community_init",0);
function gf_community_init() {

	//////////////////////////////////
	//Community Configuration
	//////////////////////////////////
	//External Community Configurations

	include("community-config/community-term-list.php"); //Post types array is moved here
	include("community-config/general.php");
	include("community-config/new-post.php");
	//include("community-config/single.php");
	include("community-config/profile.php");
	include("community-config/edit-profile.php");
	include("community-config/admin.php");
	//include("community-config/listing.php");
	include("community-config/nested-listing.php");
	include("community-config/nested-single.php");
	include("community-config/state-report.php");

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//NOTE: Configuration order matters! More specific URLs should appear before less specific urls on the same path.
	// For example, the "single" page_type below needs to appear before "listing" page type on the same path.
	//Also, solunar-calendar-mobile should appear before solunar-calendar
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
