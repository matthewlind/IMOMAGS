<?php

/**
 * Custom sidebar for News archives/single pages
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

?>

<div id="sidebar" class="col-c">
	<?php
	if (!dynamic_sidebar('sidebar-news')) { ?>
	<aside class="widget">
		<h1 class="widget-title"><?php _e('No Widgets Yet!', 'carrington-business'); ?></h1>
		<p><?php printf(__('It looks like you haven&rsquo;t added any widgets to this sidebar yet. To customize this sidebar (News Sidebar), go <a href="%s">add some</a>!', 'carrington-business'), admin_url('widgets.php')); ?></p>
	</aside>
	<?php
	}
	?>
</div><!--#sidebar-->