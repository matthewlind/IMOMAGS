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
<div class="page-template-page-right-php right-sidebar-landing">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('shooting-sidebar')) : else : ?><?php endif; ?>
	</div>
	<div id="content">
		<h1 class="seo-h1">Shooting</h1>
		<div <?php post_class('entry entry-full'); ?>>
			<div class="entry-content">
			<div class="cfct-module cfct-html section-title posts">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
  								<span><?php the_title(); ?></span>
						</h4>
					</div>
				</div>
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