<?php
/*
Plugin Name: Brightcove Embed
Plugin URI: http://github.com/imoutdoors/bc_embe
Description: Adds an input filter to add BC embed text.
Version: 0.1
Author: Jacob Angel
Author URI: http://github.com/jacobangel
License: GPL2
*/

//Set the publisher ID - YOU MAY SET THIS TO YOUR OWN PUBLISHER ID
define("_BC_PUBLISHER_ID", "1");

//Set a default player to use - YOU MUST SET THIS TO YOUR OWN DEFAULT PLAYER
define("_BC_DEFAULT_PLAYER_ID", "958487378001");
define("_BC_DEFAULT_PLAYER_KEY", "AQ~~,AAAAAETeEfI~,i-5J2ubuAMtrBswh0PvpouAMH3Ey66kE");



/**
 * New Embed Handler for Brightcove videos.
 */
function bcplayer_function($atts){
   extract(shortcode_atts(array(
      'id' => "",
   ), $atts));
   //Set width and height for the default video player

   $adServerURL = "http://ad.doubleclick.net/pfadx/" .  get_option("dart_domain", _imo_dart_guess_domain())  ."/video";
   
   $playerID = get_option("bc_new_player_id", _BC_NEW_PLAYER_ID );
   $playerKey = get_option("bc_new_player_key", _BC_NEW_PLAYER_KEY );
   
   $return_string = '<!-- Start of Brightcove Player -->

<!--
By use of this code snippet, I agree to the Brightcove Publisher T and C
found at https://accounts.brightcove.com/en/terms-and-conditions/.
-->

<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
<div id="player">

	<object id="myExperience" class="BrightcoveExperience">
	  <param name="bgcolor" value="#FFFFFF" />
	  <param name="playerID" value="'.$playerID.'" />
	  <param name="playerKey" value="'.$playerKey.'" />
	  <param name="isVid" value="true" />
	  <param name="isUI" value="true" />
	  <param name="dynamicStreaming" value="true" />
	  <param name="@videoPlayer" value="'.$id.'" />
	  <param name="media_delivery" value="http" />
	  <param name="adServerURL" value="'.$adServerURL.'" />
	
	</object>
	
	<!--
	This script tag will cause the Brightcove Players defined above it to be created as soon
	as the line is read by the browser. If you wish to have the player instantiated only after
	the rest of the HTML is processed and the page load is complete, remove the line.
	-->
	<script type="text/javascript">brightcove.createExperiences();</script>
	
	<!-- End of Brightcove Player -->

</div>';
   
   return $return_string;
}

/**
 * New Fish Embed Handler for Brightcove videos.
 */
function bcplayerFish_function($atts){
   extract(shortcode_atts(array(
      'id' => "",
   ), $atts));
   //Set width and height for the default video player

   $adServerURL = "http://ad.doubleclick.net/pfadx/" .  get_option("dart_domain", _imo_dart_guess_domain())  ."/video";
   
   $playerID = get_option("bc_gf2_player_id", _BC_GF2_PLAYER_ID );
   $playerKey = get_option("bc_gf2_player_key", _BC_GF2_PLAYER_KEY );
   
   $return_string = '<!-- Start of Brightcove Player -->

<!--
By use of this code snippet, I agree to the Brightcove Publisher T and C
found at https://accounts.brightcove.com/en/terms-and-conditions/.
-->

<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
<div id="player">

	<object id="myExperience" class="BrightcoveExperience">
	  <param name="bgcolor" value="#FFFFFF" />
	  <param name="playerID" value="'.$playerID.'" />
	  <param name="playerKey" value="'.$playerKey.'" />
	  <param name="isVid" value="true" />
	  <param name="isUI" value="true" />
	  <param name="dynamicStreaming" value="true" />
	  <param name="@videoPlayer" value="'.$id.'" />
	  <param name="media_delivery" value="http" />
	  <param name="adServerURL" value="'.$adServerURL.'" />
	
	</object>
	
	<!--
	This script tag will cause the Brightcove Players defined above it to be created as soon
	as the line is read by the browser. If you wish to have the player instantiated only after
	the rest of the HTML is processed and the page load is complete, remove the line.
	-->
	<script type="text/javascript">brightcove.createExperiences();</script>
	
	<!-- End of Brightcove Player -->

</div>';
   
   return $return_string;
}

function register_shortcodes(){
   add_shortcode('bcplayer', 'bcplayer_function');
   add_shortcode('bcplayerfish', 'bcplayerFish_function');
}
add_action( 'init', 'register_shortcodes');

/**
 * Old Embed Handler for Brightcove videos.
 */
function wp_embed_handler_brightcove ( $matches, $attr, $url, $rawattr ) {
    //Set width and height for the default video player
    $width = 620;
    $height = 349;

    // videoid should be alpha numeric. remove all and any non numbers from the string.
    // we don't want to use an int conversion, becuase ids are very large and will overflow.
    $videoid = preg_replace('/[^0-9]/', '', esc_attr($matches[1]));
    global $the_ID;
    $video_link = !empty($the_ID) ? get_permalink($the_ID) :  site_url() . $_SERVER['REQUEST_URI'];


    $adServerURL = "http://ad.doubleclick.net/pfadx/" .  get_option("dart_domain", _imo_dart_guess_domain())  ."/video";


    $output = '<!-- Start of Brightcove Player -->

<!--
By use of this code snippet, I agree to the Brightcove Publisher T and C
found at https://accounts.brightcove.com/en/terms-and-conditions/.
-->

<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
<div id="player">

	<object id="myExperience" class="BrightcoveExperience">
	  <param name="bgcolor" value="#FFFFFF" />
	  <param name="width" value="%4$s" />
	  <param name="height" value="%5$s" />
	  <param name="playerID" value="%1$s" />
	  <param name="playerKey" value="%6$s" />
	  <param name="isVid" value="true" />
	  <param name="isUI" value="true" />
	  <param name="dynamicStreaming" value="true" />
	  <param name="linkBaseURL" value="%7$s" />
	  <param name="@videoPlayer" value="%3$s" />
	  <param name="media_delivery" value="http" />
	  <param name="adServerURL" value="%8$s" />
	
	</object>
	
	<!--
	This script tag will cause the Brightcove Players defined above it to be created as soon
	as the line is read by the browser. If you wish to have the player instantiated only after
	the rest of the HTML is processed and the page load is complete, remove the line.
	-->
	<script type="text/javascript">brightcove.createExperiences();</script>
	
	<!-- End of Brightcove Player -->

</div>';




    $embed = sprintf( $output,
         get_option("bc_player_id", _BC_DEFAULT_PLAYER_ID ),
        _BC_PUBLISHER_ID,
        $videoid,
        $width,
        $height,
        get_option("bc_player_key", _BC_DEFAULT_PLAYER_KEY),

        $video_link,
	$adServerURL
    );
    return apply_filters( 'embed_brightcove', $embed, $matches, $attr, $url, $rawattr );
}


/**
 * MOBILE Embed Handler for Brightcove videos.
 */
function wp_embed_handler_brightcove_mobile ( $matches, $attr, $url, $rawattr ) {
    //Set width and height for the default video player
    $width = 300;
    $height = 169;

    // videoid should be alpha numeric. remove all and any non numbers from the string.
    // we don't want to use an int conversion, becuase ids are very large and will overflow.
    $videoid = preg_replace('/[^0-9]/', '', esc_attr($matches[1]));
    global $the_ID;
    $video_link = !empty($the_ID) ? get_permalink($the_ID) :  site_url() . $_SERVER['REQUEST_URI'];


    $adServerURL = "http://ad.doubleclick.net/pfadx/" .  get_option("dart_domain", _imo_dart_guess_domain())  ."/video";


    $output = '<!-- Start of Brightcove Player -->

<div style="display:none">
Plays videos on our IMO Mags website
</div>

<!--
By use of this code snippet, I agree to the Brightcove Publisher T and C
found at https://accounts.brightcove.com/en/terms-and-conditions/.
-->

<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
<div id="player">
	<object id="myExperience" class="BrightcoveExperience">
	  <param name="bgcolor" value="#FFFFFF" />
	  <param name="width" value="%4$s" />
	  <param name="height" value="%5$s" />
	  <param name="playerID" value="%1$s" />
	  <param name="playerKey" value="%6$s" />
	  <param name="isVid" value="true" />
	  <param name="isUI" value="true" />
	  <param name="dynamicStreaming" value="true" />
	  <param name="linkBaseURL" value="%7$s" />
	  <param name="@videoPlayer" value="%3$s" />
	  <param name="media_delivery" value="http" />
	  <param name="adServerURL" value="%8$s" />
	
	</object>
	
	<!--
	This script tag will cause the Brightcove Players defined above it to be created as soon
	as the line is read by the browser. If you wish to have the player instantiated only after
	the rest of the HTML is processed and the page load is complete, remove the line.
	-->
	<script type="text/javascript">brightcove.createExperiences();</script>
	
	<!-- End of Brightcove Player -->

</div>';


    $embed = sprintf( $output,
         get_option("bc_player_id", _BC_DEFAULT_PLAYER_ID ),
        _BC_PUBLISHER_ID,
        $videoid,
        $width,
        $height,
        get_option("bc_player_key", _BC_DEFAULT_PLAYER_KEY),

        $video_link,
	$adServerURL
    );
    return apply_filters( 'embed_brightcove', $embed, $matches, $attr, $url, $rawattr );
}







/**
 * FISHING Embed Handler for Brightcove videos.
 */
function wp_embed_handler_brightcove_fishing ( $matches, $attr, $url, $rawattr ) {
    //Set width and height for the default video player
    $width = 300;
    $height = 169;

    // videoid should be alpha numeric. remove all and any non numbers from the string.
    // we don't want to use an int conversion, becuase ids are very large and will overflow.
    $videoid = preg_replace('/[^0-9]/', '', esc_attr($matches[1]));
    global $the_ID;
    $video_link = !empty($the_ID) ? get_permalink($the_ID) :  site_url() . $_SERVER['REQUEST_URI'];


    $adServerURL = "http://ad.doubleclick.net/pfadx/" .  get_option("dart_domain", _imo_dart_guess_domain())  ."/video";


    $output = '

<!-- Start of Brightcove Player -->

<div style="display:none">

</div>

<!--
By use of this code snippet, I agree to the Brightcove Publisher T and C
found at https://accounts.brightcove.com/en/terms-and-conditions/.
-->

<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
<div id="player">
	<object id="myExperience%3$s" class="BrightcoveExperience">
	  <param name="bgcolor" value="#FFFFFF" />
	  <param name="width" value="480" />
	  <param name="height" value="270" />
	  <param name="playerID" value="2436822682001" />
	  <param name="playerKey" value="AQ~~,AAAA-01d-uE~,FiwRPPEEyN5QUjsXPxydyLn0dbP3yaNm" />
	  <param name="isVid" value="true" />
	  <param name="isUI" value="true" />
	  <param name="dynamicStreaming" value="true" />
	
	  <param name="@videoPlayer" value="%3$s" />
	
	  <param name="media_delivery" value="http" />
	  <param name="adServerURL" value="%8$s" />
	</object>
	
	<!--
	This script tag will cause the Brightcove Players defined above it to be created as soon
	as the line is read by the browser. If you wish to have the player instantiated only after
	the rest of the HTML is processed and the page load is complete, remove the line.
	-->
	<script type="text/javascript">brightcove.createExperiences();</script>
	
	<!-- End of Brightcove Player -->
</div>';



    $embed = sprintf( $output,
         get_option("bc_player_id", _BC_DEFAULT_PLAYER_ID ),
        _BC_PUBLISHER_ID,
        $videoid,
        $width,
        $height,
        get_option("bc_player_key", _BC_DEFAULT_PLAYER_KEY),

        $video_link,
  $adServerURL
    );
    return apply_filters( 'embed_brightcove', $embed, $matches, $attr, $url, $rawattr );
}






/**
 * Embed formatter, included incase we decide to change the method of including
 * brightcove videos.
 *
 * @param $brightcove_ID - string
 *
 * @return - string - formatted tag for brightcove.
 */
function _bc_embed_format_tag($brightcove_ID) {
    $tag = "http://brightcove=%s";
    $brightcove_ID = preg_replace('/[^0-9]/', '', esc_attr($brightcove_ID));

    return sprintf($tag, $brightcove_ID);
}


wp_embed_register_handler( "brightcoveNew", '#http://brightcoveplayer=([^]]*)#i', "wp_embed_handler_new_brightcove");
wp_embed_register_handler( "brightcoveFish", '#http://brightcovefish=([^]]*)#i', "wp_embed_handler_gf2_brightcove");
wp_embed_register_handler( "brightcove", '#http://brightcove=([^]]*)#i', "wp_embed_handler_brightcove");
wp_embed_register_handler( "brightcovefishing", '#http://brightcovefishing=([^]]*)#i', "wp_embed_handler_brightcove_fishing");
wp_embed_register_handler( "brightcovemobile", '#http://brightcovemobile=([^]]*)#i', "wp_embed_handler_brightcove_mobile");

/******************************************************************************************
 * Administration Menus
 * Adds a bc_player_id setting to the General Options page in the admin_menu, allowing for
 * overriding the inferred domain tag.
 ******************************************************************************************/

/* add_settings_field callback */
function bc_embed_id_option() {
    echo "<input type='text' name='bc_new_player_id' id='bc-player_bc-new-player-id' value='".get_option("bc_new_player_id", _BC_NEW_PLAYER_ID )."' />";
}

function bc_embed_new_key_settings_option() {
    echo "<input type='text' name='bc_new_player_key' id='bc-player_bc-new-player-key' value='".get_option("bc_new_player_key", _BC_NEW_PLAYER_KEY )."' />";
}

function bc_embed_gf2_option() {
    echo "<input type='text' name='bc_gf2_player_id' id='bc-player_bc-gf2-player-id' value='".get_option("bc_gf2_player_id", _BC_GF2_PLAYER_ID )."' />";
}

function bc_embed_gf2_key_settings_option() {
    echo "<input type='text' name='bc_gf2_player_key' id='bc-player_bc-gf2-player-key' value='".get_option("bc_gf2_player_key", _BC_GF2_PLAYER_KEY )."' />";
}

function bc_embed_settings_option() {
    echo "<input type='text' name='bc_player_id' id='bc-player_bc-player-id' value='".get_option("bc_player_id", _BC_DEFAULT_PLAYER_ID )."' />";
}

function bc_embed_key_settings_option() {
    echo "<input type='text' name='bc_player_key' id='bc-player_bc-player-key' value='".get_option("bc_player_key", _BC_DEFAULT_PLAYER_KEY )."' />";
}

function imo_bc_embed_settings_section() {
    echo "";
}

/* admin_menu callback. */
function imo_bc_embed_settings_init() {
    add_settings_section("bc_embed_settings", __("Brightcove Settings"), "imo_bc_embed_settings_section", "general");
    
    add_settings_field("bc_new_player_id", __("NEW Brightcove Player ID"), "bc_embed_id_option", "general", "bc_embed_settings");
    add_settings_field("bc_new_player_key", __("NEW Brightcove Player Key"), "bc_embed_new_key_settings_option", "general", "bc_embed_settings");
    
    add_settings_field("bc_gf2_player_id", __("Fishing Brightcove Player ID"), "bc_embed_gf2_option", "general", "bc_embed_settings");
    add_settings_field("bc_gf2_player_key", __("Fishing Brightcove Player 2 Key"), "bc_embed_gf2_key_settings_option", "general", "bc_embed_settings");
    
    add_settings_field("bc_player_id", __("Brightcove Player ID"), "bc_embed_settings_option", "general", "bc_embed_settings");
    add_settings_field("bc_player_key", __("Brightcove Player Key"), "bc_embed_key_settings_option", "general", "bc_embed_settings");
    
    register_setting("general", "bc_player_id");
    register_setting("general", "bc_player_key");
    
    register_setting("general", "bc_new_player_id");
    register_setting("general", "bc_new_player_key");
    
    register_setting("general", "bc_gf2_player_id");
    register_setting("general", "bc_gf2_player_key");
}
add_action("admin_menu", "imo_bc_embed_settings_init");
