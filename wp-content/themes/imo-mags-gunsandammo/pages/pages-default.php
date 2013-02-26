<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();
global $post;
the_post(); ?>
<div class="page-template-page-right-php right-sidebar-landing">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('reviews-sidebar')) : else : ?><?php endif; ?>
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
	
	<div id="content">
		<div <?php post_class('entry entry-full'); ?>>
			<div class="entry-content">
				<div class="cfct-module cfct-html section-title posts">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
  								<span><?php the_title(); ?></span>
						</h4>
					</div>
				</div>
			<?php
			the_content(__('Continued&hellip;', 'carrington-business'));
			wp_link_pages(); ?>
			</div><!-- .entry-content -->
			<?php edit_post_link(__('Edit', 'carrington-business')); ?>
		</div><!-- .post-class -->
	</div><!-- #content -->
</div>

<?php get_footer(); ?>