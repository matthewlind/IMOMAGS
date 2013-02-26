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
<?php
if(has_term('sportsman-hd','column', $post->ID )) { ?> 
<div class="bw-fullwidth picofday">
<div class="col-abc">
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-picofday')) : else : ?>
	<?php endif; ?>
	<?php
	cfct_loop();
	comments_template();
	?>
</div>

<?php } 
	else { ?>
<div class="bw-fullwidth">
<div class="col-ab">
	<?php
	cfct_loop();
	comments_template();
	?>
</div>

<div id="sidebar" class="col-c">
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
	<div id="responderfollow"></div>
	<div class="sidebar advert">
		<?php if (function_exists("imo_dart_tag")) {
	            imo_dart_tag("300x250");
	          } else { ?>
	            <script type="text/javascript">
	              document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.'+dartadsgen_site+'/;sect=;page=index;pos=btf;subs=;sz=728x90;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
	            </script>
	            <script type="text/javascript">
	              ++pr_tile;
	            </script>
	            <noscript>
	              <a href="http://ad.doubleclick.net/adj/imo.outdoorsbest/;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?">
	                <img src="http://ad.doubleclick.net/ad/imo.outdoorsbest/home;sect=;page=index;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?" border="0" />
	              </a>
	            </noscript>
	          <?php } ?>

		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : ?><?php endif; ?>
	</div>
</div>
</div>
<?php } ?>
<?php
get_footer();
?>