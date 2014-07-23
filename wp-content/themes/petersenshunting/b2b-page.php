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
				
				<div id="nav-wrap">
					<div id="shows-nav">
						<?php	wp_nav_menu( array( 'theme_location' => 'b2b', 'container' => '0' ) ); ?>
					</div>
				</div><!-- #b2b-nav-wrap -->
					
<!-- 					<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="show-video clearfix js-responsive-section"> -->
				<article id="article-wrap">
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
					<section class="episode<?php echo $ep_num ; ?>">	
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
				
				
				
				
				
				
				
				
				
				
				
				
				<div class="map-left">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 486.3 1315.7" enable-background="new 0 0 486.3 1315.7" xml:space="preserve">
<rect x="55.3" y="259.7" fill="#FFFFFF" width="145.7" height="51"/>
<rect x="37.3" y="423.3" fill="#FFFFFF" width="216.5" height="53.6"/>
<rect x="37.3" y="643.4" fill="#FFFFFF" width="163.7" height="51"/>
<rect x="2.8" y="1202.8" fill="#FFFFFF" width="178.8" height="50.7"/>
<rect x="161.3" y="1055.9" fill="#FFFFFF" width="154.9" height="43.9"/>
<rect x="164.1" y="968.3" fill="#FFFFFF" width="145" height="33.4"/>
<rect x="147.9" y="823.4" fill="#FFFFFF" width="122.9" height="47"/>
<g>
	<g>
		<path fill="none" stroke="#B7B7B7" stroke-miterlimit="10" d="M170.7,336.7c0,0,4.7,5.9,3.7,7.2c-1,1.3,4.6,2.8,3.2,5.6
			c-1.3,2.8,1.1,3.4,4.2,5.4c3.1,2,1.5,6.1,7,6.1s5.5,0,5.5,0s-10.4,6.2-13.8,8.2c-3.3,2-9.1,5.1-10.6,8.6
			c-1.5,3.5-0.6,7.2-0.8,11.7c-0.2,4.5-3.8,8.5-6.1,10.9c-2.3,2.4-3.1,6.1-2.8,13.1c0.3,7.1-0.7,16.5-2.4,18.5s-4.8,5.5-6.3,2.6
			c-1.5-2.9,5.1-32.1,3-37.6c-2.1-5.5-2.6-20.8-1-22.9c1.7-2.1,3.6-5.6,4.2-6.9s-3.9-4.8-1.9-8.3c2-3.5,0.9-12.4,5.1-15.1
			C165.3,341.3,170.7,336.7,170.7,336.7z"/>
		<path fill="none" stroke="#B7B7B7" stroke-miterlimit="10" d="M214,263.8c0,0,7.9,4.6,6.6,8.3c-1.2,3.7-5.1,4.9-3.7,9
			s3.1,8.4,2,11.4s-3.2,8.9-2.9,12.2c0.4,3.3,0.8,10.8,0.8,10.8s-5.3-0.4-5.9,2.6s1.4,6.2-0.2,8.3c-1.7,2.1-7.5,8.9-8.3,10.4
			c-0.8,1.5-7,2.9-6.2-1.9c0.9-4.8,3.3-6.3,2-9c-1.3-2.7,0.8-7.4,1.6-8.5c0.8-1-2.1-1.7-3.7,0.4s0.7-6.2-0.7-7.8
			c-1.4-1.5-4.2,2.6-4.1,5.7c0.1,3.1,2.1,7.6,1.2,8.6c-0.8,1-5.5,8.1-7,4.3c-1.5-3.8,0.4-16.7,2.3-19.1c1.8-2.4,5.4-4.7,3.2-6.8
			s-6.3-5-3.9-5.2s5.3-2.4,7.5-5.2c2.2-2.8,2.4,0.7,4.5-1.4c2.1-2.1-0.7-8.2-0.7-8.2s-1.6-3.8-0.4-5.4c1.2-1.6-2.4-8.3-0.2-7.8
			s10.8-1.2,10.8-1.2L214,263.8z"/>
		<path fill="none" stroke="#B7B7B7" stroke-miterlimit="10" d="M224.3,235.8c0,0,0.3-3.6,5.7,2s10.4,5.7,10,10.5
			s-1.6,13.2-2.1,17.1c-0.5,3.9-1.2,8.4-5,6.3c-3.8-2.2-7.5-5.5-8.1-6.4s-3.6-6.2-6.4-6.4c-2.9-0.1-1.2-6-1.2-6s-2.1-5.9-5.4,0.9
			c-3.3,6.8-6.8,11.2-9.1,11.5c-2.3,0.3-8.2,3.3-6.6-1.8c1.5-5.2,5.1-2.1,9.4-6.5c4.3-4.4,4.9-9.4,4.7-12.1s0.3-10.4,3.8-9.3
			c3.4,1,3.8,4.3,4.6,7.5s4.4,3.1,5.1,0.6C224.5,241,224.3,235.8,224.3,235.8z"/>
		<path fill="none" stroke="#B7B7B7" stroke-miterlimit="10" d="M242,177.1c0,0-1.5,11.6-3.7,13.2s-7.7,9.2-7.6,12.7
			c0.2,3.5-2.4,12.5-3.3,13.5c-0.9,1-5.7,1-7.7,3.7c-2.1,2.6-6.4,6.4-5.8,7.3c0.6,0.9,10.7,2.1,14,0c3.3-2,6-1.6,8.7-2.9
			c2.7-1.3,8.3-10.4,8.3-10.4s0.5-14.1,1.7-16.1s-0.6-7.3-1.5-9.3s-0.3-15.2-4.3-12.8C236.7,178.4,242,177.1,242,177.1z"/>
		<path fill="none" stroke="#B7B7B7" stroke-miterlimit="10" d="M218.3,166.8c0,0,3,1.5,5.7,2c2.7,0.4,2,2.9,2.4,4.5
			c0.4,1.6,1.9,4.5,2.4,6.1c0.4,1.6,4.7,3.3,4.1,5.8c-0.6,2.5-4,9.6-5.8,12.4c-1.8,2.8-8.4,13.8-10.5,16.4
			c-2.1,2.6-16,29.8-16.9,30.9c-0.8,1-7.9,7.8-7.9,7.8s0.2-10.4,2.2-16.1c2-5.7-0.9-12.3,1.1-13.2c2-0.9,8.1-5.9,7.9-9.9
			c-0.2-4-3-6.3-7.3-3.1c-4.3,3.2-3.5-4.2-1.9-4.6c1.6-0.4,5.9-4.7,7-8.9s0.2-10.9,0.9-16.7c0.8-5.8-0.9-16,4.1-15.9
			C210.9,164.3,218.3,166.8,218.3,166.8z"/>
		<path fill="none" stroke="#B7B7B7" stroke-miterlimit="10" d="M228.7,355.8l14.4-3.1l8.5-4.3l8.8-16.4l6.5-3.4l3.7-7.3l-5.7-4.6
			l2.6-6l-1.9-1.9l-0.2-6.1l-4.3-4.3l-4.5-14.7l-5-3.9l5.2-6.5l-2.5-4.9l6.3-4.8l-5.2-6.3l4.9-2.9l8.8-55.6l3.6-1.8l-0.5-16.6
			l-4-10.4l3.6-9.9l-0.7-9.9l-3.9-4.8l2.2-1.7l0.6-5.5l4.3-3.8l-1.1-13.6l-20.1-5.3l-2.8,4.6l-4.4-3.1l-10.7,9.8l-4.5-4l-18.6-1.2
			l7.5-11.1c0,0-3.6-33.5-2.2-35.8c1.1-1.8-0.4-7.6-1.2-10.2c-0.1-0.5-2.4-6.3-4-10.4c-0.8-2-9.3-25.4-11.2-30.7
			c-0.1-0.4-5.3-5.7-9.5-10c-1.4-1.4-15.7-10.2-20-12.8c-0.8-0.5-23.5,6.5-23.5,6.5l0.5,0.3c6.2,4.5,12.1,9,14.3,13.8
			c2.2,4.7,6.3,6,8.3,6.7s5.2-4.5,5.2-4.5l1.4,4.1l-3.5,4.4c0,0-7.1-1.7-6.9,0.6c0.3,2.3,7.3,14.3,12.2,19c4.8,4.7,9.3,7,11.7,6.7
			c2.3-0.3,5-6.3,5-6.3l2.8,3.9l7.3-0.1l-7.2,5.8l-2.3,4l-9.1,2.3c0,0,6.4,18.7,10.4,30.4c3.9,11.6,6.4,16.6,5,18.9
			c-1.4,2.3-3.1,6.1-3.1,6.1s2.1,14.5,3.8,18.3c1.6,3.8,5.6,13.4,5.6,13.4s10.2,6.4,11.5,7s3.6-4,5.6-7c2-3.1,2-7.3-0.5-12.3
			s-6.1-12.1-5.5-12.9c0.6-0.8,7.2,3.2,7.2,3.2l0.5,8.5c0,0,0.3,4.5,4,4c3.7-0.4,5.7-4,5.3,0.3c-0.5,4.3-4.1,11.6-5.8,13.7
			c-1.7,2.1-4.7,4.3-4.6,5.7c0.2,1.4,5.3,2.5,6.9,2.1c1.6-0.4,2.4,2.3,1.6,5.5c-0.8,3.2-3.1,10.3-0.5,7.7c2.5-2.7,12.2-17.5,16-23.9
			c3.8-6.4,7.2-11.7,7.8-10.9s-4.2,12.8-5.6,15.1c-1.4,2.3-2.5,9.5-4.7,15s-0.5,12.4,0.6,13.7c1.1,1.3,3.1,4.6,5.8,2.9
			c2.6-1.7,8.7-5,8.7-5s-9.4,4.9-11.2,8.2c-1.7,3.3-5.2,12.4-2.8,12.6c2.4,0.2,6-1.6,6-1.6s-1.5,1.3-3.2,4s-0.1,2.8-0.2,9.4
			c-0.2,6.7-3.3,2-4.5,2.4s-2.1,6.8-4.3,11c-2.2,4.2-4.5,1.1-5.5,4.6s2.3,5.2,3.9,6.9s3.5,3.6,2.1,7.6c-1.4,4-1.8,5-2,9.5
			s1.7,6.4,1.2,8.6c-0.5,2.2-1.5,7.8-2.8,8.9s-4.8,1.3-5.5,2.1c-0.6,0.8-2.9-4.9-4.2-3.3c-1.2,1.6-7.5,6.8-7.5,8.9
			c0,2.1,2.7,5.1,2.3,7.3c-0.5,2.2,5,4,5,4s4.8-7.7,8.2-7.1c3.4,0.6,4.2,3.3,4.2,3.3s-9.1,1.3-10,4c-0.9,2.7-3.9,4.5-6.1,4.5
			c-2.2,0-8.7,2.9-8.1,5.9c0.6,3,8,1.2,9.7,0.1c1.8-1.2,6.4-3.8,5.8-1.4c-0.7,2.4-4.2,10.1-6.9,8.7s-9.2,2.4-9.3,5.8
			c-0.1,3.3,8.3,6.2,8.9,7c0.6,0.9,6.9,2.5,9.2,1.3s4.7-0.5,3.7,1.2c-1,1.8-7.7,2.8-9.3,3.7c-1.6,0.9-6.8,6.5-7,8.9
			c-0.2,2.4-2,7.4-0.4,8.6c1.6,1.2,4.7,1.6,4.7,1.6L228.7,355.8"/>
	</g>
	<polygon fill="none" stroke="#B7B7B7" stroke-miterlimit="10" points="149.2,1244.3 246.6,1121.6 354.1,1206.9 268.5,1314.8 
		199.9,1260.3 201.9,1269.5 172.2,1246.4 164.6,1256.5 	"/>
	<polygon fill="none" stroke="#B7B7B7" stroke-miterlimit="10" points="246.6,1121.6 354.1,1206.9 371.6,1220.8 445,1128.4 
		319.3,1029.9 	"/>
	<polygon fill="none" stroke="#B7B7B7" stroke-miterlimit="10" points="360.8,903.7 485.6,1002.7 408.5,1099.8 319.3,1029.9 
		283.3,1001.3 	"/>
	<path fill="none" stroke="#B7B7B7" stroke-miterlimit="10" d="M195.8,893.2l106.3,84.3l49.3-62.1c0,0-2.7-3-2.1-3.8
		c0.6-0.8,1.9-4,0.5-6c-1.4-2-2.4-0.2-3.5,0.6c-1.1,0.8-3.1,1.8-4.4,0.7s-3.1-4.2-4.2-3.3c-1.1,0.8-3.9-1-4.3-2.6
		c-0.4-1.6-1.8-5.3-4.3-4.3c-2.5,1-3.5,2.3-5.5-0.6c-2-2.9-2-2.9-2-2.9s-4.6,3.6-5.9,0.4s-0.9-5.4,1.5-7.8s4.7-4.8,2.6-8.1
		c-2-3.3-6-0.5-4.4-3.5c1.5-3,3-10.8,4.1-12.1c1-1.3,1.7-5.9,0.8-7.4s-1.5-2.9,1.3-4.9c2.9-2,5.8-3,2-5.2s-5.5-0.6-6.3,0.5
		c-0.8,1-5.7-0.3-5.3-2.9c0.4-2.7,1-4.5,1.8-5.5s2.4-1.4,5.1-2.2c2.8-0.8,3.9-2.8,3.8-5.9s-0.7-4,1.4-4.4c2.1-0.5,4.5-0.3,5.2-2.3
		c0.7-2-0.9-3.7,2.3-4.5c3.2-0.8,7.3-2.3,4.5-4.5c-2.9-2.3-4.8-2.5-4.8-6.3s0.5-3.9-0.3-6.6c-0.8-2.8-2.8-1.8-1-6.3
		c1.9-4.5,1.7-5.9,0.5-8.1c-1.2-2.2-1.6-1.7-2.7-4.7c-1.1-3-1.2-4.3,0.1-5.5c1.3-1.1-1.2-2.7,2.5-3.1c3.7-0.4,3-1,2.5-3.1
		c-0.5-2.1-2.2-4.3-1.5-6.7c0.7-2.4,1.5-7.3,1.5-7.3l13.1-16.4l8.2-10.9l-16.7-13.3l-56.4,71c0,0,0,3.8-0.9,4.8
		c-0.8,1-4,0.7-4.5,1.9c-0.2,0.5-0.5,1.4-0.7,2.6c-0.4,2-0.6,4.6,0.2,5.5c1.4,1.5,1.1,3,2,5c0.9,2,6.1,3.6,2.7,5.1
		c-3.4,1.6-16.4,7.8-16.4,7.8s-6.8,2.7-7.9,4c-1,1.3-0.2,4.1-2.7,3.4c-2.4-0.7-7.5,0.9-9.4,2.7s-4.7,2.2-5.8,3.5
		c-1,1.3-1.2,3.7,0.1,5.2c1.4,1.5,4.9,5.6,1.7,6.4c-3.2,0.8-9.6,5.1-9.6,5.1L195.8,893.2z"/>
	<path fill="none" stroke="#B7B7B7" stroke-miterlimit="10" d="M239.3,766c0,0-3.5,0.2-6.4-2.1c-2.9-2.3-8.7-3.5-12.4-4.3
		s-16-0.8-16.3-5.2c-0.3-4.5-0.3-4.5-0.3-4.5s-6.8,0.5-7.3-1.5c-0.5-2.1-2.9-4.9-6.6-8.3s-13.4-7.2-14-8.1c-0.6-0.9-6.3,1-8-3.4
		c-1.7-4.3,1.5-12,2.1-14.9s2-9,0-10.7c-2.1-1.7-3.4-1-4.7-3.7c-1.3-2.7-3.7-1.2-4.4-3.5c-0.7-2.3-4.2-3.8-4.2-3.8s-0.1-3-0.8-4.4
		c-0.6-1.4-2.3-1.9-2.3-1.9s3.5-0.2,5.2-2.3c1.7-2.1,9.7-18.7,12.1-22.3c2.4-3.6,3-13.4,5.6-15.6s1.6-9,2.3-10.9
		c0.7-2,10.2-16.6,10.2-16.6s6.7,14.7,9.1,17.5c2.5,2.8,5.3,6.7,9.5,8.4c4.2,1.6,6.6,1.8,8.4-1c1.8-2.8,3.9-7.1,3.9-7.1s5.9,0,6.8-1
		c0.8-1-1.5-9.3-1.5-9.3l112.3,89.1l-56.4,71c0,0,0.7,4.1-0.9,4.8s-4.5,1.9-4.5,1.9l-0.7,2.6L239.3,766z"/>
	<path fill="none" stroke="#B7B7B7" stroke-miterlimit="10" d="M395.6,532.6c0,0-1.5,3.5-3.5,4.9s-2.2,3.8,3.4,10.8
		c5.5,7-3.1,8.2-3.1,8.2s-0.8,5.3,1,11c1.8,5.7,2.6,8.5,3.4,12.9c0.7,4.4-1.7,8-2.4,10.5s-3.9,7.6-4.1,10c-0.2,2.4,5.3,7.2,5.3,7.2
		s1.6,5.5,3.3,7.7c1.7,2.2,2.8,3.5,3.3,5.6c0.5,2.1-1.9,4-3.3,4.2c-1.4,0.2,3.1,11.8,3.1,11.8l2.1,4.2c0,0-0.3,10,1.2,12.9
		c1.5,2.9-1.6,4.2-3.8,8c-2.2,3.8,1.7,10.2,2.9,13c1.3,2.7,0.4,5.4-1.1,8.9c-1.5,3.5-0.5,7.7-0.6,9.3c0,1.7,4.1,9.3,3.9,12.8
		s-3.5,4.4-1.9,8.3s-4,8.3-7,11c-3,2.7-5.1,5.3-6.5,7.2c-1.5,1.8-2.3,2.9-1.4,6.1c0.8,3.2,0.3,4.9-0.6,7.2s1.8,3.6,2.5,5.4
		c0.7,1.8-2.9,3.7-2.9,3.7l-34.5-27.4l-16.7-13.3l-112.3-89.1c0,0,4.9-8.9,3.3-12.2c-1.6-3.4-6.1-7.4-6.7-8.7
		c-0.6-1.4-4.8-10.6-3.9-12.8s2.6-6.5,2.9-7.5c0.4-1-0.8-9.2-4.2-11.4c-3.3-2.2-3.4,1.6-4.2,6.4c-0.9,4.8-2.1,6.9-4.1,9.5
		c-2.1,2.6,3.4,10.8,7.3,17.7c3.9,6.9,5.6,16,5.6,16s-2,3.5-2,7.3s-5.1,7.5-6.4,8.6c-1.3,1.1-4.7,0.9-6.4-0.2
		c-1.8-1-7.8-15.2-10.6-17.3c-2.9-2.2-4.5-9.2-4.6-11.8s-2.1-5.7-4.6-8.5c-2.5-2.8-2.5-3.2-4.4-7.3c-1.9-4.1-1.4-7.9-1.2-12.4
		c0.2-4.5-3.3-12-4.5-20.1c-1.2-8.2-1.4-18.6-4.1-24.9s0.4-12.9-0.1-17.1c-0.5-4.2-1.2-10.8,0.6-13.1s9.5-0.1,12.6,1.9
		c3.1,2,4.8,10.6,4.7,12.3c0,1.7,2,9.3,3.8,12.4s5.8,3.4,8.2,1c2.3-2.4-0.6-3.5-1.7-6.4s-1.4-2-1.6-8.1c-0.2-6.1,0.1-7.1-2.9-12.5
		c-3-5.4-2.5-4.9-2.7-8.9c-0.2-4,3.2-0.8,8.3-6.6s-2.4-6.6,0.8-11.2c3.3-4.6,5.5-1.6,3.5-8.7c-2-7.1-3.1-2.5-4.1-7.1
		s4.6-5.7,3.4-9.6c-1.2-3.9-3-3.7-3.6-6.2c-0.5-2.5,3.8-5.9,4.3-10.2c0.5-4.3-2.8-7.7-1.6-9.8c1.2-2,4.9-2.9,5.7-8.2
		s-1.7-4.8-3.1-4.6c-1.4,0.2-5.8,1.4-6.5-2.6s0.6-7.2-0.9-10.1c-1.5-2.9-3-5.8-2.6-8.5c0.4-2.7,6-1.2,6-1.2s5.2,1.5,6,0.5
		c0.8-1,0.6-3.4-0.2-4c-0.8-0.6-4.7-1.6-5.3-4.6s-0.6-5.6,2-9.5c2.6-3.9,3.1-2.3,3.1-3.9c0-1.7,3.8,8.6,3.8,8.6l5.5,4.8l4.4-1.2
		l-3.1-6.8l4.5-10.5l2.3-7.1l2.5-2.7l14.4-3.1l8.5-4.3l8.8-16.4l6.5-3.4l3.7-7.3l-5.7-4.6l2.6-6l-1.9-1.9l-0.2-6.1l-4.3-4.3
		l-4.5-14.7l-5-3.9l5.2-6.5l-2.5-4.9l6.3-4.8l-5.2-6.3l4.9-2.9l8.8-55.6l3.6-1.8l-0.5-16.6l-4-10.4l3.6-9.9l-0.7-9.9l-3.9-4.8
		l2.2-1.7l0.6-5.5l4.3-3.8l-1.1-13.6l-20.1-5.3l-2.8,4.6l-4.4-3.1l-10.7,9.8l-4.5-4l-18.6-1.2l7.5-11.1c0,0-3.6-33.5-2.2-35.8
		c1.4-2.3-1.6-11.4-1.6-11.4s198.4,156.8,264.2,208.8L395.6,532.6z"/>
</g>
<g>
	<path fill="none" stroke="#8E8E8E" stroke-width="2" stroke-miterlimit="10" stroke-dasharray="3" d="M248.5,432.2
		c1-2.3-9.6-19.1-17.2-33.6c-3.4-6.4-4.4-14.2-6.7-17c-7.3-9-8.4-14.5-10.3-19.7c-1-2.9-1.9-5.7-2.7-8.6c-6-22.5-3.9-43.3-3.7-45.2
		c1-9.5,0-20,0-20"/>
	<path fill="none" stroke="#8E8E8E" stroke-width="2" stroke-miterlimit="10" stroke-dasharray="3" d="M222.7,668.8
		c-1.5-4,24-18,19.1-18.8s0-17,0-17s4.8-13,3.8-19.9c-1-6.7,29.4-43.7,25.9-47.4c0,0-2.1-28.3,0.3-34.3c2.4-6,2-11.7,0-14.3
		c-2-2.7-4.2-16.7-4.9-19.3c-0.7-2.7,0-19.3,2-24c2-4.7,0.3-13.3-0.3-16c-0.7-2.7-7.4-12.7-8.7-13.7s-11.4-11.8-11.4-11.8"/>
	<path fill="none" stroke="#8E8E8E" stroke-width="2" stroke-miterlimit="10" stroke-dasharray="3" d="M263.7,706.9"/>
	<path fill="none" stroke="#8E8E8E" stroke-width="2" stroke-miterlimit="10" stroke-dasharray="3" d="M291.9,848.6
		c0.3-1.4,0.5-2.4,0.5-2.5c0-0.4-2.5-6.4-2.5-8.4s3-7,3.5-8.5s9-18,9-18s7.5-7,8-8.5s1-12,0.5-13.5s-7-10.5-7-10.5
		s-10.2-8.8-9.5-9.7c0.7-0.9-2.9-4.8-2.9-4.8s-1.2-5.5,0-10.2c0.5-2,0.2-7-2.4-8.3c-4.8-2.4-4.2-12.3-4.2-12.3s-4.5-7.2-5-8.7
		s-15.3-1.6-15.3-1.6l-4.8-4.7l-6.2-3.7c0,0-3.3-5.3-4.4-7.8c0,0-4.2-3.2-7.2-3.6s-8.6-2.4-10-5c-1.4-2.6-5.3-21.3-5.3-21.3l-4-8.1"
		/>
	<path fill="none" stroke="#8E8E8E" stroke-width="2" stroke-miterlimit="10" stroke-dasharray="3" d="M328,987.2
		c-0.3-0.3-0.5-0.7-0.6-1.1c-2-5.5-4.5-11.5-4.5-11.5s-5.5-32-7-34.5s-11-12-11-12s-10.5-5.5-11-7.5s1.5-9,1.5-9l-3.5-3.5v-4.5
		l2-6.5l-5.5-6c0,0-3.3-12-5.2-14.5s-0.2-7.5,0-9.5s2.2-7.5,4.7-9.5c1.7-1.4,3.2-6.1,4-9.1"/>
	<path fill="none" stroke="#8E8E8E" stroke-width="2" stroke-miterlimit="10" stroke-dasharray="3" d="M335.1,1079.2
		c1.4-7.2,4.3-19,4.3-19l-2.5-9c0,0,3.5-9.5,5.5-11.5s14.5-25.5,14.5-31s-7.5-13.5-7.5-13.5s-17.4-3.1-21.4-7.9"/>
	<path fill="none" stroke="#8E8E8E" stroke-width="2" stroke-miterlimit="10" stroke-dasharray="3" d="M172.2,1246.4
		c0.7-6.7,5.2-8.7,8.2-10.7s7.5-4.5,10.5-4.5s7.5-5.5,8-7s-3-1.7,2.5-3.4c5.5-1.6,6-3.6,7-5.6s10.5-9.5,10.5-9.5l8-6
		c0,0-1.5-4.5,0-6s9.5-5,9.5-5h15.2l9.3-4l6-2.5h14c0,0,6.5-6.5,6.5-8s1-7,0-8.5s3-14,3-14l8-3l4.5-7c0,0,5-20.5,6.5-22.5
		s8.5-10,8.5-10l10-6c0,0,6.5-15.5,6.5-19c0-0.8,0.3-2.7,0.7-5"/>
</g>
<g>
	<path class="road-al road" fill="none" stroke="#FC6600" stroke-width="2" stroke-miterlimit="10" d="M248.5,432.2c1-2.3-9.6-19.1-17.2-33.6
		c-3.4-6.4-4.4-14.2-6.7-17c-7.3-9-8.4-14.5-10.3-19.7c-1-2.9-1.9-5.7-2.7-8.6c-6-22.5-3.9-43.3-3.7-45.2c1-9.5,0-20,0-20"/>
	<path class="road-bc road" fill="none" stroke="#FC6600" stroke-width="2" stroke-miterlimit="10" d="M222.7,668.8c-1.5-4,24-18,19.1-18.8s0-17,0-17
		s4.8-13,3.8-19.9c-1-6.7,29.4-43.7,25.9-47.4c0,0-2.1-28.3,0.3-34.3c2.4-6,2-11.7,0-14.3c-2-2.7-4.2-16.7-4.9-19.3
		c-0.7-2.7,0-19.3,2-24c2-4.7,0.3-13.3-0.3-16c-0.7-2.7-7.4-12.7-8.7-13.7s-11.4-11.8-11.4-11.8"/>
	<path class="road-wa road" fill="none" stroke="#FC6600" stroke-width="2" stroke-miterlimit="10" d="M263.7,706.9"/>
	<path class="road-id road" fill="none" stroke="#FC6600" stroke-width="2" stroke-miterlimit="10" d="M291.9,848.6c0.3-1.4,0.5-2.4,0.5-2.5
		c0-0.4-2.5-6.4-2.5-8.4s3-7,3.5-8.5s9-18,9-18s7.5-7,8-8.5s1-12,0.5-13.5s-7-10.5-7-10.5s-10.2-8.8-9.5-9.7
		c0.7-0.9-2.9-4.8-2.9-4.8s-1.2-5.5,0-10.2c0.5-2,0.2-7-2.4-8.3c-4.8-2.4-4.2-12.3-4.2-12.3s-4.5-7.2-5-8.7s-15.3-1.6-15.3-1.6
		l-4.8-4.7l-6.2-3.7c0,0-3.3-5.3-4.4-7.8c0,0-4.2-3.2-7.2-3.6s-8.6-2.4-10-5c-1.4-2.6-5.3-21.3-5.3-21.3l-4-8.1"/>
	<path class="road-wy road" fill="none" stroke="#FC6600" stroke-width="2" stroke-miterlimit="10" d="M328,987.2c-0.3-0.3-0.5-0.7-0.6-1.1
		c-2-5.5-4.5-11.5-4.5-11.5s-5.5-32-7-34.5s-11-12-11-12s-10.5-5.5-11-7.5s1.5-9,1.5-9l-3.5-3.5v-4.5l2-6.5l-5.5-6
		c0,0-3.3-12-5.2-14.5s-0.2-7.5,0-9.5s2.2-7.5,4.7-9.5c1.7-1.4,3.2-6.1,4-9.1"/>
	<path class="road-co road" fill="none" stroke="#FC6600" stroke-width="2" stroke-miterlimit="10" d="M335.1,1079.2c1.4-7.2,4.3-19,4.3-19l-2.5-9
		c0,0,3.5-9.5,5.5-11.5s14.5-25.5,14.5-31s-7.5-13.5-7.5-13.5s-17.4-3.1-21.4-7.9"/>
	<path class="road-nm road" fill="none" stroke="#FC6600" stroke-width="2" stroke-miterlimit="10" d="M172.2,1246.4c0.7-6.7,5.2-8.7,8.2-10.7
		s7.5-4.5,10.5-4.5s7.5-5.5,8-7s-3-1.7,2.5-3.4c5.5-1.6,6-3.6,7-5.6s10.5-9.5,10.5-9.5l8-6c0,0-1.5-4.5,0-6s9.5-5,9.5-5h15.2l9.3-4
		l6-2.5h14c0,0,6.5-6.5,6.5-8s1-7,0-8.5s3-14,3-14l8-3l4.5-7c0,0,5-20.5,6.5-22.5s8.5-10,8.5-10l10-6c0,0,6.5-15.5,6.5-19
		c0-0.8,0.3-2.7,0.7-5"/>
</g>
<circle fill="#777777" cx="172.7" cy="1246.9" r="6.7"/>
<text transform="matrix(1 0 0 1 21.3118 1235.3688)" fill="#4C4C4C" font-family="'MyriadPro-Regular'" font-size="22">#1. New Mexico</text>
<text transform="matrix(1 0 0 1 187.7205 1086.3011)" fill="#4C4C4C" font-family="'MyriadPro-Regular'" font-size="22">#2. Colorado</text>
<text transform="matrix(1 0 0 1 181.542 991.9824)" fill="#4C4C4C" font-family="'MyriadPro-Regular'" font-size="22">#3. Wyoming</text>
<circle fill="#777777" cx="335.5" cy="1079.6" r="6.7"/>
<circle fill="#777777" cx="327.6" cy="987.6" r="6.7"/>
<text transform="matrix(1 0 0 1 173.4199 852.8061)" fill="#4C4C4C" font-family="'MyriadPro-Regular'" font-size="22">#4. Idaho</text>
<circle fill="#777777" cx="291.6" cy="848.1" r="6.7"/>
<text transform="matrix(1 0 0 1 52.2161 674.9968)" fill="#4C4C4C" font-family="'MyriadPro-Regular'" font-size="22">#5. Washington</text>
<circle fill="#777777" cx="222.7" cy="668.8" r="6.7"/>
<text transform="matrix(1 0 0 1 56.6208 459.2992)" fill="#4C4C4C" font-family="'MyriadPro-Regular'" font-size="22">#6. British Columbia</text>
<circle fill="#777777" cx="248.5" cy="432.2" r="6.7"/>
<text transform="matrix(1 0 0 1 78.1987 292.7699)" fill="#4C4C4C" font-family="'MyriadPro-Regular'" font-size="22">#7,8. Alaska </text>
<circle fill="#777777" cx="207.6" cy="288.2" r="6.7"/>
</svg>
				
				</div><!-- .map-left -->
				
				
				
				
				<!-- <?php get_template_part( 'content/content-show' ); ?>	 -->
				</article><!-- #article-wrap -->
						
						
					<!-- </div> .show-video -->
            </div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>
