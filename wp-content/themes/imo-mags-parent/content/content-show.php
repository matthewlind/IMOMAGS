
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
?>

<?php 
if( !is_single() ){
	query_posts(array( 
    'tax_query' => array(
	    array(
	      'taxonomy' => 'post_format',
	      'field' => 'slug',
	      'terms' => 'post-format-video'
	    )
	  ),
    'showposts' => 1 
	)); 
}
while (have_posts()) : the_post();
$video_id = get_post_meta(get_the_ID(), '_video_id', TRUE); ?>

<!-- this style is loading small image for the background. We need it because it is loading faster then the script so you don't see flickering -->
<style type="text/css">
	body {
		background: url("/wp-content/themes/imo-mags-parent/images/shows/dark-background.jpg");
	    background-repeat: repeat;
		background-color:#2a2a2a;
	}
</style>
<!-- script loading smaller image for mobile devices -->
<script typ="text/javascript">
    jQuery(document).ready(function(){
    var windowWidth 	= jQuery(window).width(); 
    	if (windowWidth < 760) {
	         jQuery("#palce4schedule").load("/wp-content/themes/imo-mags-parent/content/tv-show/show-schedule.php");
	         jQuery("body").css({
	         "background-image" : "url(<?php echo get_field('background_skin_mobile',$acfID); ?>)",
	         "background-repeat" : "no-repeat",
	         "background-size" : "160% auto",
	         "background-position" : "20% 0",
	         "background-color" : "#2a2a2a"
	         });
         }
        if (windowWidth > 760) {
	        jQuery("body").css({
	         "background-image" : "url(<?php echo get_field('background_skin',$acfID); ?>)",
	         "background-repeat" : "no-repeat",
	         "background-size" : "100% auto",
	         "background-color" : "#2a2a2a"
	         });
        }
    });
</script>
<div id="show-destination" playerID="<?php echo get_field("tv_player_id","options"); ?>" adServerURL="<?php echo $adServerURL; ?>" videoLink="<?php echo $videoLink; ?>">
	<?php get_template_part( 'content/tv-show/show-header' ); ?>
		<div class="video-player-area">
			<div id="video-gallery" class="video-player-wrap clearf">
				<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script> 
				<div id="player"></div>
				<div class="new-show">
					<img src="/wp-content/themes/imo-mags-parent/images/temp/new-show.jpg">
				</div>
			</div><!-- end of .video-player-wrap -->
			<div id="description-area">
				<div class="unify">
					<div class="content-height">
						<span class="show-video-date"><?php the_time('F jS, Y'); ?></span>
						<h1 class="video-title" data-videoid="<?php echo $video_id; ?>" data-slug="<?php echo $post->post_name;?>"><?php the_title(); ?></h1>
						<div class="video-description"><?php the_content(); ?></div>
					</div>
					<div class="video-more-content" style="display:none;"><div class="more-link">Read More</div></div>
					<div class="social-share clearf">
						<div class="social-share">
							<!--<div class="share-results">
								<span>2K</span>				
								<div class="shares"><span>SHARES</span></div>		
							</div>-->
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
				<div class="video-player-sidebar">
					<div class="new-show"></div>
					<div class="ad-block">
						<?php imo_ad_placement("btf_medium_rectangle_300x250"); ?>

					</div>
			</div><!-- end of #description-area -->
			<!--
<div class="video-player-sidebar">
				
				
			</div>
-->
			
			<!-- this widget is located in imo-mags-parent/widgets -->
			<?php get_template_part( 'widgets/sportsmanLocator' ); ?>
		</div><!-- end of #video-player-area -->
		
	</div><!-- end of #shows_player_area -->
	<?php endwhile; ?> 
	<div id="show-featured" class="clearf">
		
		<?php query_posts(array( 
		    'tax_query' => array(
			    array(
			      'taxonomy' => 'post_format',
			      'field' => 'slug',
			      'terms' => 'post-format-video'
			    )
			  ),
		    'showposts' => 8 
			)); 
		?>

		<div class="thumbs-full">
			<ul id="video-filter">
				<li><a slug="all" class="video-thumb-active video-ajax">Most Recent</a></li>
				<li><a slug="bestshots" class="video-ajax">Bestshots</a></li>
			</ul>
			<ul id="video-thumbs">
				<?php while (have_posts()) : the_post(); $i++; 
					$post_id = get_the_id();
					$post = get_post($post_id);
					$slug = $post->post_name;
					$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
					$cats = get_the_category( $post_id );
					
					$video_id = get_post_meta(get_the_ID(), '_video_id', TRUE);
					$videoLink = !empty($post_id) ? get_permalink($post_id) :  site_url() . $_SERVER['REQUEST_URI']; 
				?>					
					<li id="thumb-<?php echo $i; ?>">
						<div class="data-description" style="display:none;"><?php the_content(); ?></div>
						<a class="video-thumb" data-slug="<?php echo $slug; ?>" data-img_url="<?php echo $thumb_url; ?>" data-post_url="<?php echo get_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" data-date="<?php the_time('F jS, Y'); ?>" data-videoid="<?php echo $video_id; ?>" adServerURL="<?php echo $adServerURL; ?>" videoLink="<?php echo $videoLink; ?>">
							<?php the_post_thumbnail("show-thumb"); ?>
							<h3><?php the_title(); ?></h3>
							<span class="play-btn"></span>
						</a>
					</li>
			
				<?php endwhile; ?>
			</ul>
			<div class="btn-grey-sm paginate-videos">
				<a class="paginate-videos">Load more videos <i class="fa fa-long-arrow-down"></a></i>
			</div>
		</div><!-- end of .thumbs-full -->
		
		<div id="imo-store">
			
		</div>
	</div><!-- end of #show-featured -->
	<div id="upcoming">
		<div class="container tiled-grid clr">
			<div class="tonight-bg"></div>
			<div class="tiled-grid-entry on-tonight clr span_1_of_4 col col-1">
				<h3>On Tonight</h3>
				<a class="" href="/schedule">Full Schedule <i class="fa fa-angle-double-right"></i></a>
			</div>
			<div class="tonight-schedule">
				<ul class="slides">
					<?php echo do_shortcode('[tscschedule format="tonight"]'); ?>
				</ul>
			</div>
		</div>
	</div><!-- end of #upcoming -->
	<!--
<style type="text/css">
	body {
		background: url(<?php echo get_field('background_skin',$acfID); ?>);
	    background-repeat: no-repeat;
		background-size: 100% auto;
		background-color: #2a2a2a;
	}
</style>
-->
	
	<div id="palce4schedule"></div>


	
	<?php get_template_part( 'content/tv-show/show-sponsors' ); ?>
</div>
	
	
	
	
	
	
	
	
	
	
	
