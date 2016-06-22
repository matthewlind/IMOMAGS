<?php

/**
 * Template Name: User Profile Edit
 * Description: Displays the edit form for the user
 *
` *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
	

$args = array(
	'show_title' => false,
	'default_action' => 'profile'
);

get_header();
imo_sidebar("community"); ?>

<div id="primary" class="general">
    <div id="content" class="general-frame" role="main">
		<?php theme_my_login($args); ?>
	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
