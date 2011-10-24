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

$dirtylens_slug = "dirty-lens";
$dd_slug = "deadly-draw";
$gc_slug = "gun-crush";
$uh_slug = "urban-huntress";
$eal_slug = "editor-at-large";
$fg_slug = "fare-game";
$bw_slug = "buck-wild";
$nb_slug = "news-brief";

?>

<?php if (in_category($dl_slug)) { ?>
<a href="/blogs/<?php echo $dl_slug; ?>/" title="<?php echo $current_category; ?>"><div class="dl-header-mini"></div></a>

<?php } else if (in_category($dd_slug)) { ?>
<a href="/blogs/<?php echo $dd_slug; ?>/" title="<?php echo $current_category; ?>"><div class="dd-header-mini"></div></a>

<?php } else if (in_category($gc_slug)) { ?>
<a href="/blogs/<?php echo $gc_slug; ?>/" title="<?php echo $current_category; ?>"><div class="gc-header-mini"></div></a>

<?php } else if (in_category($uh_slug)) { ?>
<a href="/blogs/<?php echo $uh_slug; ?>/" title="<?php echo $current_category; ?>"><div class="uh-header-mini"></div></a>

<?php } else if (in_category($eal_slug)) { ?>
<a href="/blogs/<?php echo $eal_slug; ?>/" title="<?php echo $current_category; ?>"><div class="eal-header-mini"></div></a>

<?php } else if (in_category($fg_slug)) { ?>
<a href="/blogs/<?php echo $fg_slug; ?>/" title="<?php echo $current_category; ?>"><div class="fg-header-mini"></div></a>

<?php } else if (in_category($bw_slug)) { ?>
<a href="/blogs/<?php echo $bw_slug; ?>/" title="<?php echo $current_category; ?>"><div class="bw-header-mini"></div></a>

<?php } else if (in_category($nb_slug)) { ?>
<a href="/blogs/<?php echo $nb_slug; ?>/" title="<?php echo $current_category; ?>"><div class="nb-header-mini"></div></a>

<?php } ?>

<div class="col-ab">
	<?php
	cfct_loop();
	comments_template();
	?>
</div>
<?php
get_sidebar();
get_footer();
?>