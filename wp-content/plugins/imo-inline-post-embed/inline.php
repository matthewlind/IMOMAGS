<?php
/*
 * Plugin Name: IMO Inline Post Embed
 * Plugin URI: http://github.com/imoutdoors
 * Description: Allows editors to embed a post inline with content
 * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */


add_filter('media_buttons_context', 'inline_post_media_button');
function inline_post_media_button($context) {

	$imgURL = plugins_url('inline-post-icon.png', __FILE__);

	$frameURL = plugins_url('inline-post-frame.html', __FILE__);

	$inline_post_media_button = ' %s' . '<a href="'.$frameURL.'?TB_iframe=true" class="thickbox"><img src="'.$imgURL.'"></a>';
	return sprintf($context, $inline_post_media_button);
  }


add_action( 'init', 'imo_inline_register_shortcodes');

function imo_inline_register_shortcodes(){
   add_shortcode('inline-post', 'displayInlinePost');
}


function displayInlinePost($atts) {

	extract(shortcode_atts(array(
	  'id' => 34636,
	  'title' => '',
	  'body' => ''
	), $atts));


	$post = get_post($id);

	if (!empty($title))
		$post->post_title = $title;
	if (!empty($body))
		$post->post_content = $body;

	$permalink = get_permalink($id);

	$thumbnailTag = get_the_post_thumbnail($id,'list-thumb');

	$outputString = "<div class='wp-caption inline-post'><a href='$permalink'>$thumbnailTag<div class='inline-details'><h1>{$post->post_title}</h1><p>{$post->post_content}</p></div></a></div>";

	return $outputString;


}
