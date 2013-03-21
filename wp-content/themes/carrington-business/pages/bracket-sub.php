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

the_post();
?>
<header>
	<ul id="ga-madness-nav">
		<li><a href="/bracket">Gun Bracket</a></li>
		<li><a href="/bracket/enter">Enter Now</a></li>
		<li style="width:270px;"></li>
		<li><a href="/bracket/prizes">Prizes & Rules</a></li>
		<li><a class="how-works">How it Works</a></li>
	</ul>
	<div class="ga-madness-nav-logo"></div>
	<?php if( is_page("enter") ){ echo '<div class="bracket-sub-header"></div>'; } ?>
	<?php if( !is_page("how-it-works") ){ ?><h1><?php the_title(); ?></h1><?php } ?>
</header>
<div class="page-template-page-right-php<?php if( is_page("enter") ){ echo ' bracket-sub'; } ?>">
	<div id="sidebar">
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
	
	<div class="col-abc">
		<div <?php post_class('entry entry-full clearfix'); ?>>
			<div class="entry-content how-content">
				<?php 
				if( is_page("enter") ){ 
					if (function_exists('imo_add_this')) {imo_add_this();} 
				}
				?>
				<?php if( is_page("how-it-works") ){ ?>
					<h1><?php the_title(); ?></h1>
				<?php } 
				the_content(__('Continued&hellip;', 'carrington-business'));
				wp_link_pages();
				?>
			</div>
		</div><!-- .entry -->
		<?php //comments_template(); ?>
	</div><!-- .col-abc -->
</div><!-- .page-template-page-right-php -->
<div id="bracket-modal" class="new-superpost-modal-container new-superpost-box" style="display:none;width:740px;height:558px;background-color:white;">
	<div class="ga-madness-logo"></div>
	<div class="poll-area"></div>
	<div class="extra-poll-content" style="display:none;">
		<div class="vote-thumb" style="display:none;"></div>
		<div class="vs">vs.</div>
	</div>
	<div class="poll-pagination" style="display:none;">
			<a class="prev-poll">Previous Matchup</a>
			<a class="next-poll">Next Matchup</a>
		</div>
	<div id="Gen" class="marginLeft">
		<div class="block" id="rotate_01"></div>
		<div class="block" id="rotate_02"></div>
		<div class="block" id="rotate_03"></div>
		<div class="block" id="rotate_04"></div>
		<div class="block" id="rotate_05"></div>
		<div class="block" id="rotate_06"></div>
		<div class="block" id="rotate_07"></div>
		<div class="block" id="rotate_08"></div>
		<div class="clearfix"></div>
		<p>Loading...</p>
	</div>
	
</div>
<?php get_footer(); ?>