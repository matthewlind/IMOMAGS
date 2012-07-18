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
	cfct_loop(); ?>
	<div class="post-content-area">
		<div class="related-products">
			<h2>Related Products</h2>
			<div id="leiki1demo"></div>
			<script>
			(function() {
			//*** Note! If URL is not the ID of the page, uncomment
			//*** the line below and replace CONTENT_ID with the page ID.
			//var leiki_cid = 'CONTENT_ID';
			var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
			s.src = 'http://kiwi12.leiki.com/focus/mwidget?wname=sb1' +((typeof leiki_cid !== 'undefined' && leiki_cid!='')? '&cid='+encodeURIComponent(leiki_cid) : '')+ '&first=' + top.leiki_first + '&ts='+new Date().getTime();
			var x = document.getElementsByTagName('script')[0];
			x.parentNode.insertBefore(s, x);
			top.leiki_first="no";
			})();
			</script>		
		</div>
		<div class="fb-recommendations recommendations" data-site="www.floridasportsman.com" data-width="300" data-height="250" data-header="true"></div>
	<?php comments_template();
	?>
</div>

<?php
get_sidebar();
?>
</div>
<?php } ?>
<?php
get_footer();
?>