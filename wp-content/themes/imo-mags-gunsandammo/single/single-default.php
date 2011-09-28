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

$soga_slug = "sons-of-guns-and-ammo";
$floc_slug = "for-the-love-of-competition";
$dt_slug = "defend-thyself";
$nb_slug = "news-brief";
$tfl_slug = "the-front-lines";
$tgg_slug = "the-gun-guys";
$tgr_slug = "the-gun-room";
$zn_slug = "zombie-nation";

?>

<?php if (in_category($soga_slug)) { ?>
<a href="/blogs/<?php echo "sons-of-gunsandammo"; ?>/" title="<?php echo $current_category; ?>"><div class="soga-header"></div></a>

<?php } else if (in_category($floc_slug)) { ?>
<a href="/blogs/<?php echo $floc_slug; ?>/" title="<?php echo $current_category; ?>"><div class="floc-header"></div></a>

<?php } else if (in_category($dt_slug)) { ?>
<a href="/blogs/<?php echo $dt_slug; ?>/" title="<?php echo $current_category; ?>"><div class="dt-header"></div></a>

<?php } else if (in_category($nb_slug)) { ?>
<a href="/blogs/<?php echo $nb_slug; ?>/" title="<?php echo $current_category; ?>"><div class="nb-header"></div></a>

<?php } else if (in_category($tfl_slug)) { ?>
<a href="/blogs/<?php echo $tfl_slug; ?>/" title="<?php echo $current_category; ?>"><div class="tfl-header"></div></a>

<?php } else if (in_category($tgg_slug)) { ?>
<a href="/blogs/<?php echo $tgg_slug; ?>/" title="<?php echo $current_category; ?>"><div class="tgg-header"></div></a>

<?php } else if (in_category($tgr_slug)) { ?>
<a href="/blogs/<?php echo $tgr_slug; ?>/" title="<?php echo $current_category; ?>"><div class="tgr-header"></div></a>

<?php } else if (in_category($zn_slug)) { ?>
<a href="/blogs/<?php echo $zn_slug; ?>/" title="<?php echo $current_category; ?>"><div class="zn-header"></div></a>

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
