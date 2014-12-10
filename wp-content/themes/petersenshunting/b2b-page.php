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
	<?php 
		$slug_b2b = get_post( $post )->post_name;
		$b2b_page_id = get_page_by_path( 'border-to-border' )->ID;
	?>
	<div id="primary" class="general b2b">
		<div class="modal-overlay" id="modal-dialog" data-hidden="true">
			<div class="modal-content" id="modal-holder">
			
				<h1 id="modal-title">Border to Border - The Trailer</h1>
				<div id="yt-player">
					<iframe width="560" height="315" src="<?php echo get_field('youtube_video_link', $b2b_page_id);?>?enablejsapi=1" frameborder="0" allowfullscreen></iframe>
				</div>
				<div class="btn-close" id="modal_close" type="button">x</div>
			</div> <!-- end .modal-content -->
		</div> <!-- end .modal-overlay -->
        <div class="general-frame">
            <div id="content" role="main">
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header marquee-img clearfix js-responsive-section b2b-header">
					<div class="b2b-title">
						<img class="b2b-img-phtv" src="/wp-content/themes/petersenshunting/images/b2b/ph-presents.png">
						<img class="b2b-img-title" src="/wp-content/themes/petersenshunting/images/b2b/b2b-title.png">
						<span>WITH MIKE SCHOBY</span>
					</div>
					<div class="header-info clearf">
						<div class="header-info-inner clearf">
							<div class="black-wrap">
								<h2><?php the_field('main_poster_text_1', $b2b_page_id); ?></h2>
							</div>
							<div class="black-wrap black-wrap2">
								<h2><?php the_field('main_poster_text_2', $b2b_page_id); ?></h2>
							</div>
							<img class="b2b-logo" src="/wp-content/themes/petersenshunting/images/b2b/b2b-logo.png">
							<a href="http://www.thesportsmanchannel.com/" target="_blank"><img class="b2b-sportsman-logo" src="/wp-content/themes/petersenshunting/images/b2b/sportsmench-logo.png"></a>
							<a href="#!" type="button" id="modal_open">
								<div class="b2b-trailer-wrap">
									<img src="/wp-content/themes/petersenshunting/images/b2b/trailer-img.jpg">
									<span>Watch The Trailer</span>
								</div>
							</a>
						</div>
					</div>
					<h1 class="page-title hidden-seo"><?php the_title(); ?></h1>
				</div>
				<div id="b2b-map">
					<script>
						var mapImage    	= jQuery(".b2b-map-img");
						var mapImageHeight  = jQuery(".b2b-map-img").height();
						var mapImageWidth   = jQuery(".b2b-map-img").width();
						var mapText		 	= jQuery(".b2b-map-text");
					// .b2b-map-text repeting height and width of the .b2b-map-image
					function mapTextSize(){
						jQuery(mapText).css({"height": (mapImageHeight + "px"), "width": (mapImageWidth + "px") });
					}
					</script>
					<div class="shadow-block"></div>
					<div class="map-wrap">
						<div class="map-trailer">
							<h4>Watch The Trailer</h4>
							<div class="map-trailer-wrap">
									<iframe width="320" height="180" src="<?php echo get_field('youtube_video_link', $b2b_page_id);?>" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>
						<img class="b2b-map-img" src="/wp-content/themes/petersenshunting/images/b2b/b2b-map.jpg">
						<div class="b2b-map-text">
							<?php if( have_rows('b2b_rules') ): ?>
							<div class="b2b-rules">
								<h1>RULES</h1>
								<ul>
									<?php while ( have_rows('b2b_rules') ) : the_row();
										$text_line = get_sub_field('text_line');
									?>
									<li><?php echo $text_line; ?></li>
									<?php endwhile; ?>
								</ul>
							</div><!-- end .b2b-rules -->
							<?php endif; ?>	
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
