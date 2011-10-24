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
<a href="/blogs/<?php echo "the-dirty-lens"; ?>/" title="<?php echo $current_category; ?>"><div class="dl-header-mini"></div></a>

<?php } else if (in_category("deadly-passion")) { ?>
<a href="/blogs/<?php echo "deadly-passion"; ?>/" title="<?php echo $current_category; ?>"><div class="dd-header-mini"></div></a>

<?php } else if (in_category("the-guns-crush")) { ?>
<a href="/blogs/<?php echo "the-guns-crush"; ?>/" title="<?php echo $current_category; ?>"><div class="gc-header-mini"></div></a>

<?php } else if (in_category("the-urban-huntress")) { ?>
<a href="/blogs/<?php echo "the-urban-huntress"; ?>/" title="<?php echo $current_category; ?>"><div class="uh-header-mini"></div></a>

<?php } else if (in_category("editor-at-large")) { ?>
<a href="/blogs/<?php echo "editor-at-large"; ?>/" title="<?php echo $current_category; ?>"><div class="eal-header-mini"></div></a>

<?php } else if (in_category("fare-game")) { ?>
<a href="/blogs/<?php echo "fare-game"; ?>/" title="<?php echo $current_category; ?>"><div class="fg-header-mini"></div></a>

<?php } else if (in_category("buck-wild")) { ?>
<a href="/blogs/<?php echo "buck-wild"; ?>/" title="<?php echo $current_category; ?>"><div class="bw-header-mini"></div></a>

<?php } else if (in_category("news-brief")) { ?>
<a href="/blogs/<?php echo "news-brief"; ?>/" title="<?php echo $current_category; ?>"><div class="nb-header-mini"></div></a>

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