<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

$s = get_search_query();

// Generate unique ID for searchform, so this file can be loaded multiple times
$id = uniqid('s-');

if (get_option('permalink_structure') != '') {
	$onsubmit = "location.href=this.action+'search/'+encodeURIComponent(this.s.value).replace(/%20/g, '+'); return false;";
}
else {
	$onsubmit = '';
} ?>

<form id="searchform" action="<?php echo home_url( '/' ); ?>" method="get" onsubmit="<?php echo $onsubmit; ?>">
  <input type="search" class="searchfield" name="s" id="<?php echo $id; ?>" value="<?php esc_attr_e($s); ?>" placeholder="Search the Site">
  <input type="submit" class="searchsubmit" value="<?php _e('Search', 'carrington-business'); ?>" />
</form>