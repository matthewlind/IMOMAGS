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

<!-- Set the blog header on single blog entry pages -->
<?php

$current_category = single_cat_title("", false);


?>


<?php if (in_category("the-dirty-lens")) { ?>
<a href="/blogs/<?php echo "the-dirty-lens"; ?>/" title=""><div class="dl-header-mini"></div></a>

<?php } else if (in_category("deadly-draw")) { ?>
<a href="/blogs/<?php echo "deadly-draw"; ?>/" title=""><div class="dd-header-mini"></div></a>

<?php } else if (in_category("the-gun-crush")) { ?>
<a href="/blogs/<?php echo "the-gun-crush"; ?>/" title=""><div class="gc-header-mini"></div></a>

<?php } else if (in_category("the-urban-huntress")) { ?>
<a href="/blogs/<?php echo "the-urban-huntress"; ?>/" title=""><div class="uh-header-mini"></div></a>

<?php } else if (in_category("editor-at-large")) { ?>
<a href="/blogs/<?php echo "editor-at-large"; ?>/" title=""><div class="eal-header-mini"></div></a>

<?php } else if (in_category("fare-game")) { ?>
<a href="/blogs/<?php echo "fare-game"; ?>/" title=""><div class="fg-header-mini"></div></a>

<?php } else if (in_category("buck-wild")) { ?>
<a href="/blogs/<?php echo "buck-wild"; ?>/" title=""><div class="bw-header-mini"></div></a>

<?php } else if (in_category("news-brief")) { ?>
<a href="/blogs/<?php echo "news-brief"; ?>/" title=""><div class="nb-header-mini"></div></a>

<?php } ?>

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
			<script type="text/javascript">
	              document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.'+dartadsgen_site+'/;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
	            </script>
	            <script type="text/javascript">
	              ++pr_tile;
	            </script>
	            <noscript>
	              <a href="http://ad.doubleclick.net/adj/imo.outdoorsbest/;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?">
	                <img src="http://ad.doubleclick.net/ad/imo.outdoorsbest/home;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?" border="0" />
	              </a>
	            </noscript>

			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
		</div>
</div>
<?php get_footer(); ?>