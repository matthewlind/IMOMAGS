<?php
/**
 * Template Name: GA Madness Page
 * Description: A Page Template for G&A Madness (bracket).
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
 
$dataPos = 0;

get_header();
imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
					<h1 class="page-title">
						<div class="icon"></div>
						<span><?php the_title(); ?></span>
				    </h1>
				</div>
				
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>"  id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix js-responsive-section'); ?>>
					<div class="article-holder ga-madness">
						<div class="addthis-below"><?php if (function_exists('imo_add_this')) {imo_add_this();} ?></div>
						<?php //the_content(); ?>
						<div id="tabs">
							<ul>
								<li><a href="#tabs-1">First</a></li>
								<li><a href="#tabs-2">Second</a></li>
								<li><a href="#tabs-3">Sweet 16</a></li>
								<li><a href="#tabs-4">Elite 8</a></li>
								<li><a href="#tabs-5">Final 4</a></li>
							</ul>
							<div class="clearfix"></div>
							<div id="tabs-1">
								<div class="matchup">									
									<div class="action-arrow"></div>
									<a href="#" class="contender">
										<span class="rank">(1) Gun type</span>
										<span class="rank">(8) Gun type</span>
									</a>
								</div>
								<div class="matchup">									
									<div class="action-arrow"></div>
									<a href="#" class="contender">
										<span class="rank">(1) Gun type</span>
										<span class="rank">(8) Gun type</span>
									</a>
								</div>
							</div>
							<div id="tabs-2">
								
							</div>
							<div id="tabs-3">
								
								
							</div>
							<div id="tabs-4">
								
								
							</div>
							<div id="tabs-5">
								
							</div>
						</div>
						<div class="gun-types">
							<ul>
								<li><a href="#">AR-15s</a></li>
								<li><a href="#">Handguns</a></li>
								<li><a href="#">Shotguns</a></li>
								<li><a href="#">Rifles</a></li>
								<li><a href="#">Finals</a></li>
							</ul>
						
						
						
						</div>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
						<footer class="entry-meta">
							<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
						</footer><!-- .entry-meta -->
				    </div><!-- .article-holder -->
				</div><!-- #post-<?php the_ID(); ?> -->
				               
				<?php sub_footer(); ?> 
            </div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>