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

            <span id="toggle-display-button">
                Toggle Display
            </span>
            <span id="new-post-button">
                + POST
            </span>

            <ul class="post-type-select">
                <li class='selected' title='all'>ALL</li>
                <li title='report'>Reports</li>
                <li title='tip'>Tips</li>
                <li title='lifestyle'>LifeStyles</li>
                <li title='trophy'>Trophy Bucks</li>
                <li title='gear'>Gear</li>

            </ul>
            <!-- This div id="recon-activity" is filled with posts by the displayRecon() function
                     inside plus.js -->    
            <div id="recon-activity">


            </div>
            <span id="more-superposts-button">
                More Recon
            </span>



        </div>
    </div><!-- .entry -->
</div><!-- .col-abc -->
<?php get_footer(); ?>