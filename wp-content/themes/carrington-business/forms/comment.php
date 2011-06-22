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

global $post, $user_identity;

$commenter = wp_get_current_commenter();

extract($commenter);

$req = get_option('require_name_email');

// if post is open to new comments
if (comments_open()) {
	// if you need to be regestered to post comments..
	if ( get_option('comment_registration') && !is_user_logged_in() ) { ?>

<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'carrington-business'), get_bloginfo('wpurl').'/wp-login.php?redirect_to='.urlencode(get_permalink())); ?></p>

<?php
	}
	else { 
?>
<div id="respond">
<form action="<?php echo trailingslashit(get_bloginfo('wpurl')); ?>wp-comments-post.php" method="post">
	<h3 class="section-title"><label for="comment"><?php comment_form_title(__('Post a Comment', 'carrington-business'), __('Reply to %s', 'carrington-business')); ?></label></h3>
	<p><textarea name="comment" id="comment" rows="6" cols="60"></textarea></p>
<?php
		if (is_user_logged_in()) {
?>
	<p><?php
			printf(__('Logged in as <a href="%s">%s</a>. ', 'carrington-business'), get_bloginfo('wpurl').'/wp-admin/profile.php', $user_identity);
			wp_loginout();
		?></p>
<?php
		}
		else { 
?>
	<p>
		<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" />
		<label for="author"><?php _e('Name', 'carrington-business'); if ($req) { echo ' <em>' , _e('(required)', 'carrington-business'), '</em>'; } ?></label>
	</p>
	<p>
		<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" />
		<label for="email"><?php _e('Email', 'carrington-business');
			$req ? $email_note = __('(required, but never shared)', 'carrington-business') : $email_note = __('(never shared)', 'carrington-business');
			echo ' <em>'.$email_note.'</em>';
		?></label>
	</p>
	<p>
		<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" />
		<label title="<?php _e('Your website address', 'carrington-business'); ?>" for="url"><?php _e('Web', 'carrington-business'); ?></label>
	</p>
<?php 
		} 
?>
	<p>
		<input name="submit" type="submit" id="submit" value="<?php _e('Post Comment', 'carrington-business'); ?>" class="btn btn-b" />
		<?php cancel_comment_reply_link(__('cancel reply', 'carrington-business')); ?>
	</p>
<?php
	comment_id_fields();
	do_action('comment_form', $post->ID);
?>
</form>
</div>
<?php 
	} // If registration required and not logged in 
} // If you delete this the sky will fall on your head
?>