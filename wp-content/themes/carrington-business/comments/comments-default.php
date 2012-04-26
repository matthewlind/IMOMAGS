<?php

/**
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * **********************************************************************
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

global $post, $wp_query, $comments, $comment;

if (have_comments() || comments_open()) {

if (have_comments()) {
	echo '<h2 id="comments" class="section-title">',comments_number(__('No Responses Yet', 'carrington-business'), __('One Response', 'carrington-business'), __('% Responses', 'carrington-business')),'</h2>';
}
if (!post_password_required()) {
	echo '<ol class="reply-list">', wp_list_comments(array('callback'=> 'cfct_threaded_comment')), '</ol>';
	
	if (get_previous_comments_link() || get_next_comments_link()) {
		echo '<div class="pagination">', previous_comments_link(), next_comments_link(),'</div>';
	}
}
cfct_form('comment');
}
?>