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
	<div id="primary" class="general b2b">
        <div class="general-frame">
            <div id="content" role="main">
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header marquee-img clearfix js-responsive-section">
					<h1 class="page-title hidden-seo"><?php the_title(); ?></h1>
				</div>
				<div id="b2b-map">
					<div class="shadow-block"></div>
					<div id="map-wrap">
						<img id="b2b-map-img" src="/wp-content/themes/petersenshunting/images/b2b/b2b-map.jpg">
					</div>
				</div><!-- #b2b-map -->
				
				<div class="nav-wrap">
					<div class="shows-nav">
						<?php	wp_nav_menu( array( 'theme_location' => 'b2b', 'container' => '0' ) ); ?>
					</div>
				</div><!-- #b2b-nav-wrap -->
					
<!-- 					<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="show-video clearfix js-responsive-section"> -->
				<article id="article-wrap">
					<div class="map-left">
						<?php get_template_part( 'template-parts/svg-map' ); ?>				
					</div><!-- .map-left -->
					<section class="about-show">
						<h1 class="a-text"><?php the_field("article_headline");?></h1>
						<div class="a-text">
							<div class="block-aside">
								<div class="ad-aside">
								<?php imo_dart_tag("300x250"); ?>
								</div>
							</div>
							<?php
							if( get_field('about_text') )
							{
								while( has_sub_field('about_text') )
								{ 
									$paragraph = get_sub_field('paragraph');
							 
									echo "<p>" . $paragraph . "</p>";
								}
							}
							?>

							
							<?php if( get_field('show_stats') ): ?>
							<div class="overall-stats">
								<?php while( has_sub_field('show_stats')): 
									$stats_number = get_sub_field("stats_number");
									$stats_title = get_sub_field("stats_title");
									$stats_comment = get_sub_field("stats_comment");
								?>
								<div class="stats-item">
									<span><?php echo $stats_number; ?></span>
									<p><?php echo $stats_title; ?></p>
									<span><?php echo $stats_comment; ?></span>
								</div>
								<?php endwhile; ?>
							</div>	
							<?php endif; ?>
						</div><!-- .a-text -->	
					</section><!-- .about-show -->	
			
					<?php $this_page_id=$wp_query->post->ID; ?>
					<?php
					$args = array(
						'posts_per_page' 	=> -1,
						'orderby'		 	=> 'date',
						'order'			 	=> 'ASC',
						'post_parent' 		=> $this_page_id,
						'post_type'      	=> 'page',
						'meta_key'			=> 'is_episode',
						'meta_value'  		=> '1',
						'meta_key'			=> 'is_episode',					
					);

					query_posts($args);
					
					if (have_posts())
					{
						while (have_posts())
						{
							the_post();
							
					$ep_num = get_field("episode_number");
					$state_img = get_field("state_image");
					$slideshow_imgs = get_field("slideshow_imgs");
					$slideshow_cap = get_field("slideshow_caption");
					$species_info = get_field("species_info");
					$full_width_image_back = get_field("full_width_image_back");
					$full_width_image_caption = get_field("full_width_image_caption");
					?>
					<section class="episode-<?php echo $ep_num ; ?>">	
						<div class="episode-heading a-text">
							<div><span>#<?php echo $ep_num ;?></span></div>
							<h1><?php echo get_the_title(); ?></h1>
						</div>
						<div class="a-text">
							<div class="block-aside">
								<div class="links-aside">
									<?php if( !empty($state_img) ): ?> 
										<img src="<?php echo $state_img['url']; ?>" alt="<?php echo $state_img['alt']; ?>" /> 
										<?php endif; ?>	
									<ul class="list-links-aside">
									<?php while(has_sub_field("aside_links")): ?>
										<li><a href="<?php the_sub_field('aside_link'); the_sub_field('aside_external_link');?>" target="_blank"><?php the_sub_field('aside_link_name'); ?></a><i class="fa fa-angle-double-right"></i></li>
										<?php endwhile; ?>
									</ul>
								</div>
							</div>
							<?php while(has_sub_field("text_beginning")): ?>
							<p><?php the_sub_field('paragraph'); ?></p>
							<?php endwhile; ?>
							<div class="a-slideshow">
								<div class="a-slideshow-container">
									<div class="a-slideshow-images">
										<?php if( !empty($slideshow_imgs) ): ?> 
										<img src="<?php echo $slideshow_imgs['url']; ?>" alt="<?php echo $slideshow_imgs['alt']; ?>" /> 
										<?php endif; ?>								
										</div>
									<!--
<div class="a-slideshow-thumbs">
										<img class="a-slideshow-thumb" src="/wp-content/themes/petersenshunting/images/b2b/thumb.jpg">
										<img class="a-slideshow-thumb a-slideshow-thumb--active" src="/wp-content/themes/petersenshunting/images/b2b/thumb.jpg">
									</div>
-->
									<div class="a-slideshow-captions">
										<?php if( !empty($slideshow_cap) ): ?> 
										<div class="a-slideshow-caption"><?php echo $slideshow_cap; ?></div>
										<?php endif; ?>	
									</div>
								</div>
							</div><!-- .a-slideshow -->
							<?php while(has_sub_field("text_end")): ?>
							<p><?php the_sub_field('paragraph'); ?></p>
							<?php endwhile; ?>
														
							<?php if($species_info): ?>						
							<?php while( has_sub_field('species_info') ): ?>
							<?php 
							$species_img = get_sub_field("species_image");
							$species_title = get_sub_field("species_title");
							$species_description = get_sub_field("species_description");
							
							?>
							<div class="species-info">
								<div class="species-description">									
									<img src="<?php  echo $species_img['url']; ?>" alt="<?php echo $species_img['alt']; ?>" /> 
									<h2><?php echo $species_title; ?></h2>
									<p><?php echo $species_description; ?></p>
								</div><!-- .species-description -->
								<?php if( get_sub_field('species_stats') ): ?>
									<div class="species-stats">
									<?php while( has_sub_field('species_stats') ): ?>
									<?php
									$species_stats_num = get_sub_field("species_stats_num");
									$species_stats_title = get_sub_field("species_stats_title");
									$species_stats_comment = get_sub_field("species_stats_comment");
									?>
										<div class="stats-item">
											<span><?php echo $species_stats_num; ?></span>
											<p><?php echo $species_stats_title; ?></p>
											<?php if( !empty($species_stats_comment) ): ?> 
											<span><?php echo $species_stats_comment; ?></span>
											<?php endif; ?>	
										</div>
									<?php endwhile; ?>
									</div><!-- .species-stats -->
								<?php endif; ?>
							</div><!-- .species-info -->
							<?php endwhile; ?>
						<?php endif; ?>
						</div><!-- .a-text -->
						<div class="a-cell">
							<div class="a-inner-cell" style="background-image: url('<?php echo $full_width_image_back;?>');"></div>
							<div class="a-cell-caption">
								<p><?php echo $full_width_image_caption;?></p>
							</div>
						</div>
					</section>	
					
					<?php			
						}
					}
					else
					{
						echo '<h2>Not Found</h2>';
					}

					wp_reset_query();
				?>	
				
								
				
				
				

				</article><!-- #article-wrap -->
						
						
					<!-- </div> .show-video -->
            </div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>
