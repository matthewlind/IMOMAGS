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
?>
<a class="crown-ad" href="<?php echo home_url(); ?>/crownroyal/"><div class="callout-ad">&nbsp;</div></a>
<div class="col-ab">
	<?php
	//Most Recent
						$the_query = new WP_Query( array( 'post_type' => 'crown_your_catch', 'orderby' => 'date', 'order' => 'DESC' ) );
						while ( $the_query->have_posts() ) : $the_query->the_post(); 
							if(has_post_thumbnail()){  
								foreach($the_query as $query) ?>
								<li><a href="<?php echo $query->guid; ?>"><span></span><?php the_post_thumbnail('thumbnail'); ?></a></li>
            					<?php
       						}
						endwhile;	
						// Reset Post Data
						wp_reset_postdata();

	comments_template();
	?>
</div>
<?php get_sidebar('crown'); ?>
<div class="top-footer">
<p>Please Drink Responsibly.</p>
<p>CROWN ROYAL Blended Canadian Whisky. 40% Alc/Vol. &copy; <?php the_date('Y') ?> The Crown Royal Company, Norwalk, CT. NO PURCHASE NECESSARY. Contest valid only to residents of AL, MS, NC, WV, VA, PA, ME, NH, VT.<br />Must be 21 to enter.<p>
</div>
<?php get_footer(); ?>
