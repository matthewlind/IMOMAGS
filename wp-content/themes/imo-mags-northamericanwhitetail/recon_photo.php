<?php

/**
 * Template Name: Recon Photo
 * Description: Displays a specific photo
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

get_header();

$spid =  get_query_var("spid");
$requestURL = "http://www.northamericanwhitetail.deva/slim/api/superpost/post/$spid";

$file = file_get_contents($requestURL);
$data = json_decode($file);
$data = $data[0];


$grav_url = "http://www.gravatar.com/avatar/" . $data->gravatar_hash . ".jpg?s=25&d=identicon";
?>
<header id="masthead">
	<h1>RECON NETWORK: PHOTO</h1>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
</header><!-- #masthead -->
<div class="bonus-background">
	<div class="bonus">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-landing')) : else : ?><?php endif; ?>
	</div>
</div>
<div class="col-abc">
	<div <?php post_class('entry entry-full clearfix'); ?>>
		<div class="entry-content">
       
            <img src="<?php echo $data->img_url; ?>" width=585>
            <div class="userinfo">
            <img src="<?php echo $grav_url; ?>"> <?php echo $data->username; ?>
            </div>
     
		</div>
	</div><!-- .entry -->
	<?php //comments_template(); ?>
</div><!-- .col-abc -->
<?php get_footer(); ?>