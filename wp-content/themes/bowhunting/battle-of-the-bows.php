<?php
/**
 * Template Name: Battle of the Bows Page
 * Description: A Page Template for Battle of the Bows (bracket).
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
 
$dataPos = 0;
get_header(); ?>
    <div id="content" role="main" data-mobile="">
		<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
			<h1 class="page-title" style="display:none;height:0;">
				<div class="icon"></div>
				<span><?php the_title(); ?></span>
		    </h1>
			<ul class="bob-social-top social-buttons">
				<li>
					<a href="http://www.facebook.com/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&t=<?php the_title(); ?>" class="socialite facebook-like reload-fb" data-href="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-share="true" data-action="like" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden"></span></a>
				</li>
			    <li>
			        <a href="http://twitter.com/share" class="socialite twitter-share reload-twitter" data-text="<?php the_title(); ?>" data-url="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" rel="nofollow" target="_blank"><span class="vhidden"></span></a>
			    </li>
			</ul>
		    <?php if(mobile()){ ?>
		    	<img class="madness-logo-mobile" src="/wp-content/plugins/bowmadness/images/BOB-logo.png" alt="Bow Madness" title="Bow Madness" />
				<?php 
			} ?>
		    <ul id="ga-madness-nav">
				<li><a href="/battle-of-the-bows">Bow Bracket</a></li>
				<li><a href="/battle-of-the-bows/enter">Enter</a></li>
				<?php if(!mobile()){ ?>
					<li class="madness-logo"><img src="/wp-content/plugins/bowmadness/images/BOB-logo.png" alt="Bow Madness" title="Bow Madness" />
					</li>
				<?php } ?>
				<li><a href="/battle-of-the-bows/prizes-rules">Prizes & Rules</a></li>
				<li><a href="/battle-of-the-bows/how-it-works">How it Works</a></li>
			</ul>
		</div>
		<div data-position="<?php echo $dataPos = $dataPos + 1; ?>"  id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix js-responsive-section'); ?>>
			<div class="article-holder ga-madness">

				<?php
					$ismobile = mobile();
					//$ismobile = true;
					the_content();
				?>
				 
				
		    </div><!-- .article-holder -->
	    	<ul class="bob-social-bottom social-buttons">
				<li>
					<a href="http://www.facebook.com/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&t=<?php the_title(); ?>" class="socialite facebook-like reload-fb" data-href="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-share="true" data-action="like" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden"></span></a>
				</li>
			    <li>
			        <a href="http://twitter.com/share" class="socialite twitter-share reload-twitter" data-text="<?php the_title(); ?>" data-url="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" rel="nofollow" target="_blank"><span class="vhidden"></span></a>
			    </li>
			</ul>
		</div>
		
	</div><!-- #content -->
	<?php imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
					<div class="post-comments-area">
			            <?php comments_template( '', true ); ?>
			        </div>
				</div>
            </div>
        </div>
	</div>
<?php get_footer(); ?>




















