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
define("_BC_DEFAULT_PLAYER_ID", "973698996001");
define("_BC_DEFAULT_PLAYER_KEY", "AQ~~,AAAAAETeEfI~,i-5J2ubuAMtrBswh0PvpouAMH3Ey66kE");

/**
 * Embed Handler for Brightcove videos.
 */
function wp_embed_handler_brightcove ( $matches, $attr, $url, $rawattr ) {
    //Set width and height for the default video player
    $width = 480;
    $height = 270;

    // videoid should be alpha numeric. remove all and any non numbers from the string. 
    // we don't want to use an int conversion, becuase ids are very large and will overflow.
    $videoid = preg_replace('/[^0-9]/', '', esc_attr($matches[1]));
    
    $output = '<object id="flashObj" width="%4$s" height="%5$s" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,47,0">
	<param name="movie" value="http://c.brightcove.com/services/viewer/federated_f9?isVid=1&amp;isUI=1" />
	<param name="bgcolor" value="#FFFFFF" />
	<param name="flashVars" value="@videoPlayer=%3$s&amp;playerID=%1$s&amp;playerKey=%6$s&amp;domain=embed&amp;dynamicStreaming=true" />
	<param name="base" value="http://admin.brightcove.com" />
	<param name="seamlesstabbing" value="false" />
	<param name="allowFullScreen" value="true" />
	<param name="swLiveConnect" value="true" />
	<param name="allowScriptAccess" value="always" />
	<param name="@videoPlayer" value="%3$s" />
	<embed src="http://c.brightcove.com/services/viewer/federated_f9?isVid=1&amp;isUI=1" bgcolor="#FFFFFF" flashVars="@videoPlayer=%3$s&amp;playerID=%1$s&amp;playerKey=%6$s&amp;domain=embed&amp;dynamicStreaming=true" base="http://admin.brightcove.com" name="flashObj" width="%4$s" height="%5$s" seamlesstabbing="false" type="application/x-shockwave-flash" allowFullScreen="true" allowScriptAccess="always" swLiveConnect="true" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
	</embed>
	</object>';

    $embed = sprintf( $output,
        _BC_DEFAULT_PLAYER_ID,
        _BC_PUBLISHER_ID,
        $videoid,
        $width,
        $height,
        _BC_DEFAULT_PLAYER_KEY);
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

wp_embed_register_handler( "brightcove", '#http://brightcove=([^]]*)#i', "wp_embed_handler_brightcove");
