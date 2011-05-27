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
?>
<div class="cfct-row cfct-row-abc" style="clear:both"> 
	<div class="cfct-block block-0 cfct-block-abc"> 
			<div class="cfct-module cfct-divider "> 
				<hr class="cfct-div-solid" /> 
			</div></div> 
</div>
        <div class='aligncenter centerad'>
	<!-- 728x90 Ad: -->
<script type="text/javascript">
document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.'+dartadsgen_site+'/;sect=;page=index;subs=;sz=728x90;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
</script>
<script type="text/javascript">
    ++pr_tile;
</script>
<noscript>
    <a href="http://ad.doubleclick.net/adj/imo.outdoorsbest/;sect=;page=index;subs=;sz=728x90;dcopt=;tile=1;ord=7391727509?">
        <img src="http://ad.doubleclick.net/ad/imo.outdoorsbest/home;sect=;page=index;subs=;sz=728x90;dcopt=;tile=1;ord=7391727509?" border="0" />
    </a>
</noscript>
<!-- END 728x90 Ad: -->
</div>

		</div><!-- .str-content -->
	</div><!-- #main-content -->
</section><!-- .str-container -->
<hr class="accessibility" />
<footer id="footer">
	<div class="str-container">
		<div id="footer-content">
			<div class="str-content clearfix">
				<div class="col-a">
					<?php
					if (!dynamic_sidebar('footer-a')) { ?>
					<aside class="widget style-f">
						<h1 class="widget-title"><?php _e('No Widgets Yet!', 'carrington-business'); ?></h1>
						<p><?php printf(__('It looks like you haven&rsquo;t added any widgets to this sidebar (Footer Left) yet. To customize this sidebar, go <a href="%s">add some</a>!', 'carrington-business'), admin_url('widgets.php')); ?></p>
					</aside>
					<?php
					}
					?>
				</div>
				<div class="col-b">
					<?php
					if (!dynamic_sidebar('footer-b')) { ?>
					<aside class="widget style-f">
						<h1 class="widget-title"><?php _e('No Widgets Yet!', 'carrington-business'); ?></h1>
						<p><?php printf(__('It looks like you haven&rsquo;t added any widgets to this sidebar (Footer Center) yet. To customize this sidebar, go <a href="%s">add some</a>!', 'carrington-business'), admin_url('widgets.php')); ?></p>
					</aside>
					<?php
					}
					?>
				</div>
				<div class="col-c">
					<?php
					if (!dynamic_sidebar('footer-c')) { ?>
					<aside class="widget style-f">
						<h1 class="widget-title"><?php _e('No Widgets Yet!', 'carrington-business'); ?></h1>
						<p><?php printf(__('It looks like you haven&rsquo;t added any widgets to this sidebar (Footer Right) yet. To customize this sidebar, go <a href="%s">add some</a>!', 'carrington-business'), admin_url('widgets.php')); ?></p>
					</aside>
					<?php
					}
					?>
				</div>
			</div><!-- .str-content -->
		</div><!-- #footer-content -->
		<div id="footer-sub">
			<nav class="nav nav-footer">
				<h3 class="site-title"><a href="<?php echo home_url('/') ?>" title="<?php _e('Home', 'carrington-business') ?>"><?php bloginfo('name') ?></a></h3>
				<?php
				wp_nav_menu(array( 
					'theme_location' => 'footer',
					'container' => false,
					'depth' => 1,
				));
				?>
			</nav><!--/nav-footer-->
			<?php
			if (cfct_get_option('cfct_credit') == 'yes') { ?>
			<p id="site-generator"><?php
			printf(__('Powered by <a href="%s">WordPress</a>. <a href="%s" title="Carrington Business theme for WordPress">Carrington Business</a> by <a id="cf-logo" title="Custom Web Applications and WordPress Development" href="%s">Crowd Favorite</a>', 'carrington-business'), 'http://wordpress.org/', 'http://crowdfavorite.com/wordpress/themes/carrington-business/', 'http://crowdfavorite.com/');
			?></p>
			<?php 
			}
			
			$colophon = str_replace('%Y', date('Y'), cfct_get_option('cfctbiz_legal_footer'));
			$sep = ($colophon ? ' &bull; ' : '');
			$loginout = cfct_get_loginout('', $sep);
			if ($colophon || $loginout) {
				echo '<p>'.$colophon.$loginout.'</p>';
			}
			?>
		</div><!-- #footer-sub -->
	</div><!-- .str-container -->
</footer><!-- #footer -->

<?php
if (CFCT_DEBUG) {
?>
<div style="border: 1px solid #ccc; background: #ffc; padding: 20px;">The <code>CFCT_DEBUG</code> setting is currently enabled, which shows the filepath of each included template file. To hide the file paths, edit this setting in the <?php echo CFCT_PATH; ?>functions.php file.</div>
<?php
}

wp_footer();
?>
</body>
</html>
