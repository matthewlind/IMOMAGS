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
<div id="reeltime-wrapper">

<header id="masthead" class="fstv-header">
	<a href="/fstv/" title="Florida Sportsman TV"><h1 class="fstv-title"><?php the_title(); ?></h1></a>
	
</header><!-- #masthead -->

<nav class="nav nav-secondary"><!--new REEL TIME MENU-->
	
	<?php wp_nav_menu( array( 'theme_location' => 'fstv-menu', 'fallback_cb' => '' ) ); ?>
	
</nav>


<div class="page-template-page-right-php reeltime-template">
	<div class="bonus-background">
		<div class="bonus reeltime-bonus">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-fstv')) : else : ?><?php endif; ?>
		</div>
	</div>
	<div class="col-abc">
		<div <?php post_class('entry entry-full clearfix'); ?>>
			<div class="entry-content">
				<?php
				the_content(__('Continued&hellip;', 'carrington-business'));
				wp_link_pages();
				
				?>
			</div>
			<?php edit_post_link(__('Edit', 'carrington-business')); ?>
		</div><!-- .entry -->
		
		<?php if (is_page(array('fstv', 'sponsors'))) {
			 
		} else {
			comments_template();
		}?>
		
	</div><!-- .col-abc -->
</div>

</div>
<?php get_footer(); ?>