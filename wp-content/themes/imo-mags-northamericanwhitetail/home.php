<?php

/**
 * Template Name: Home Page+
 * Description: Homepage for the new NAW+
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
?>

<div class="col-abc">
    <div <?php post_class('entry entry-full clearfix'); ?>>
        <div class="entry-content">
            <h1>Recon Network</h1>

            <ul class="post-type-select">
                <li class='selected' title='all'>ALL</li>
                <li title='photo'>Photos</li>
                <li title='report'>Reports</li>
                <li title='tip'>Tips</li>
            </ul>
            
            <div id="recon-activity">


            </div>



        </div>
    </div><!-- .entry -->
</div><!-- .col-abc -->
<?php get_footer(); ?>