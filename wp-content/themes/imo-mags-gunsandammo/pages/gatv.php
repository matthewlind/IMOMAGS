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

get_header();

the_post();
?>

<nav class="nav nav-secondary"><!--new TV MENU-->
	<img src="/wp-content/themes/imo-mags-gunsandammo/img/Ga-tv-banner-980x200.jpeg" alt="Guns & Ammo TV" />
	<?php wp_nav_menu( array( 'theme_location' => 'tv-menu', 'fallback_cb' => '' ) ); ?>
</nav>
<div class="page-template-page-right-php right-sidebar-landing tv-pages">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-tv')) : else : ?><?php endif; ?>
	</div>
	<div id="content" class="tv-pages">
		<h1 class="seo-h1">GATV</h1>
		<div <?php post_class('entry entry-full'); ?>>
			<div class="entry-content">
		
				<?php the_content(__('Continued&hellip;', 'carrington-business'));
				wp_link_pages();
				
				?>
			</div>
			<?php edit_post_link(__('Edit', 'carrington-business')); ?>
		</div><!-- .entry -->
		
		<?php if (is_page(array('rtfs','host-george-gozdz','prizes','about-rtfs','episode-guide','sponsors'))) {
			 
		} else {
			comments_template();
		}?>
		
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>