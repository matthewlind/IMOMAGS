<?php

/**
 * Template Name: User Login
 * Description: Displays the login user
 *
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

$args = array(
	'show_title' => false,
	'default_action' => 'login'
);

get_header();
imo_sidebar("community"); ?>

<div id="primary" class="general">
    <div id="content" class="general-frame" role="main">
		<?php theme_my_login($args);  ?>
    </div>
</div>
<a href="/wp-login.php?action=lostpassword">Forgot Password?</a>

<?php get_footer(); ?>

