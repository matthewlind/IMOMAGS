<?php
/**
 * Template Name: Border To Border Page
 * Description: A Page Template for Border To Border Show.
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

get_header(); ?>
	<?php $slug_b2b = get_post( $post )->post_name; ?> 
	<div id="primary" class="general b2b">
        <div class="general-frame">
            <div id="content" role="main">
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header marquee-img clearfix js-responsive-section b2b-header">
					<h1 class="page-title hidden-seo"><?php the_title(); ?></h1>
				</div>
				<div id="b2b-map">
					<div class="shadow-block"></div>
					<div class="map-wrap">
						<img class="b2b-map-img" src="/wp-content/themes/petersenshunting/images/b2b/b2b-map.jpg">
						<div class="b2b-map-text">
							<div class="b2b-rules">
								<h1>RULES</h1>
								<ul>
									<li>1. Never spend the night under a roof</li>
									<li>2. Survive on what you kill or catch and the basic provisions in your kit</li>
									<li>3. No guides…all DIY hunts and fishing with over-the-counter tags/licenses</li>
								</ul>
							</div>
							<div class="b2b-map-txt text-al">ALASKA</div>
							<div class="b2b-map-txt text-bc">BRITISH COLUMBIA</div>
							<div class="b2b-map-txt text-ws">WASHINGTON</div>
							<div class="b2b-map-txt text-id">IDAHO</div>
							<div class="b2b-map-txt text-wy">WYOMING</div>
							<div class="b2b-map-txt text-co">COLORADO</div>
							<div class="b2b-map-txt text-nm">NEW MEXICO</div>
							<div class="b2b-map-txt text-st">Start</div>
							<div class="b2b-map-txt text-fn">Finish</div>
						</div>
					</div>
				</div><!-- #b2b-map -->
				
				<div class="nav-wrap">
					<div class="shows-nav">
						<?php	wp_nav_menu( array( 'theme_location' => 'b2b', 'container' => '0' ) ); ?>
					</div>
				</div><!-- #b2b-nav-wrap -->
					
				<article id="article-wrap" class="<?php echo $slug_b2b; ?>">
					<?php 
					// Make shore that template part name and slug of this page is the same
					 get_template_part("template-parts/{$slug_b2b}"); 
					 
					 
					// If page's parent's slug is how-to-guides
					if($post->post_parent) { $post_data = get_post($post->post_parent);
						 if ($post_data->post_name == "how-to-guides") {
							 get_template_part("template-parts/how-to-guides"); 
						 };
					};
					?>
					 
				</article><!-- End #article-wrap -->
            </div><!-- End #content -->
        </div><!-- End general-frame -->
    </div><!-- End #primary -->
<?php get_footer(); ?>
