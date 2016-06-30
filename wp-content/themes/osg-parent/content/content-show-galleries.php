<?php
/**
 * The template used for displaying page content in show-page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$postID = get_the_ID();
$idObj = get_category_by_slug('tv'); 
$id = $idObj->term_id;
$acfID = 'category_' . $id;
$format = get_post_format( $postID );
$adServerURL = "http://ad.doubleclick.net/pfadx/" .  get_option("dart_domain", _imo_dart_guess_domain())  ."/tv";
$videoLink = !empty($postID) ? get_permalink($postID) :  site_url() . $_SERVER['REQUEST_URI']; 

$post_data = get_post($postID,ARRAY_A);
$slug = $post_data['post_name'];

?>
<style type="text/css">
	body {
		background: url(<?php echo get_field('background_skin',$acfID); ?>);
	    background-repeat: no-repeat;
		background-size: 100% auto;
		background-color: #2a2a2a;
	}
</style>
<div id="show-destination" playerID="<?php echo get_field("tv_player_id","options"); ?>" adServerURL="<?php echo $adServerURL; ?>" videoLink="<?php echo $videoLink; ?>">
	<?php get_template_part( 'content/show-header' ); ?>
		<div id="video-player-area">
			<div id="show-gallery" class="video-player-wrap" slug="<?php echo $slug ?>">
				<ul class="slides">
					<?php 
					if( have_rows('gallery_images') ):
						while( have_rows('gallery_images', $postID) ): the_row(); ?>
							<li>
								<?php
								$image = get_sub_field('image');
								$url = $image['url'];
								$title = $image['title'];
								$alt = $image['alt'];
								$caption = $image['caption'];
							 
								// thumbnail
								$size = 'post-thumb';
								$thumb = $image['sizes'][ $size ];
								$width = $image['sizes'][ $size . '-width' ];
								$height = $image['sizes'][ $size . '-height' ];
								?>
								<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" title="<?php echo $title; ?>" />
								<div id="description-area">
									<div class="unify">
										<div class="content-height">
											<div class="video-description"><?php the_sub_field('description'); ?></div>
										</div>
									</div>
								</div>	
								<div class="image-title" style="display:none;"><?php the_sub_field('title'); ?></div>
							</li>
						<?php endwhile;
					endif; ?>
				</ul>
			</div>
								<div id="carousel" class="flexslider">
						<ul class="slides">
						<?php 
			if( have_rows('gallery_images') ):
				while( have_rows('gallery_images', $postID) ): the_row(); 
								$image = get_sub_field('image');
								$url = $image['url'];
								$title = $image['title'];
								$alt = $image['alt'];
								$caption = $image['caption'];
							 
								// thumbnail
								$size = 'index-thumb';
								$thumb = $image['sizes'][ $size ];
								$width = $image['sizes'][ $size . '-width' ];
								$height = $image['sizes'][ $size . '-height' ];
								?>
							<li><img src="<?php echo $thumb; ?>" alt="" title="" /></li>
							
							<?php endwhile;
			endif; ?>
						</ul>
					</div>
				
			<div class="locate-helper">
				<!-- this widget is located in imo-mags-parent/widgets -->
				<?php get_template_part( 'widgets/sportsmanLocator' ); ?>	
			</div>
				<div class="video-player-sidebar">
					<div id="description-area gallery-title-area">
						<div class="unify">
							<h1 class="video-title side-title"></h1>
							<div class="social-share">
								<div class="share-results">
									<span>2K</span>				
									<div class="shares"><span>SHARES</span></div>		
								</div>
								<div class="social-share-btns">
									<a class="reload-fb" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" title="Share on Facebook." target="_blank">
										<div class="facebook-share">
											<i class="fa fa-facebook"></i>
										</div>
									</a>
									<a class="reload-twitter" href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="Tweet this!" target="_blank">
										<div class="twitter-share">
											<i class="fa fa-twitter"></i>
										</div>	
									</a>
									<a class="reload-google" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
				  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
										<div class="google-share">
											<i class="fa fa-google-plus"></i>
										</div>
									</a>
								</div>
							</div><!-- end of .social-share -->
						</div><!-- end of .unify -->
					</div><!-- end of #description-area -->
					<div class="ad-block">
						<?php imo_ad_placement("300_atf"); ?>
					</div>
					<div id="more-galleries">
						<h2>More Galleries</h2>
						<ul class="slides">
							<?php $query = new WP_Query( 'category_name=show-galleries' ); 
							while ($query->have_posts()) : $query->the_post();
							$id = get_the_id();
								if($id != $postID){ ?>
								<li>
									<a href="<?php the_permalink(); ?>">
										<h3><?php the_title(); ?></h3>
										<?php the_post_thumbnail("post-home-small-thumb"); ?>
									</a>
								</li>
							<?php } endwhile; ?>
						</ul>
					</div>
				</div>
			</div>
		</div><!-- end of #video-player-area -->
	</div><!-- end of #shows_player_area -->
	<div id="upcoming">
		<div class="container tiled-grid clr">
			<div class="tonight-bg"></div>
			<div class="tiled-grid-entry on-tonight clr span_1_of_4 col col-1">
				<h2>On Tonight</h2>
				<a class="" href="/schedule">Full Schedule</a>
			</div>
			<div class="tonight-schedule">
				<ul class="slides">
					<?php echo do_shortcode('[tscschedule format="tonight"]'); ?>
				</ul>
			</div>
		</div>
	</div>
	<div id="imo-store">
		
	</div>
</div>
<div class="sponsor-pad">
	<?php get_template_part( 'content/show-sponsors' ); ?>
</div>
</div>
	
	
	
	
	
	
	
	
	
	
	
