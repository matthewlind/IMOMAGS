<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }


global $the_ID;
$cat = array_shift(get_the_category($the_ID));

$sidebar_name = "sidebar-ad";

?>


	<?php
	if (!dynamic_sidebar($sidebar_name)) { ?>
	<aside class="widget">
		<h1 class="widget-title"><?php _e('No Widgets Yet!', 'carrington-business'); ?></h1>
		<p><?php printf(__('It looks like you haven&rsquo;t added any widgets to this sidebar yet. To customize this sidebar (Blog Sidebar), go <a href="%s">add some</a>!', 'carrington-business'), admin_url('widgets.php')); ?></p>
	</aside>
	<?php
	}
	?>

