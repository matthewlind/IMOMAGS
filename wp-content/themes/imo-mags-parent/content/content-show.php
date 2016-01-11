
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


if( !is_single() ){
	query_posts(array( 
	'post_type' => 'post',
	'post_status' => 'publish',
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
	
	<!-- this style is loading small image for the background. We need it here because it's loading faster then the script so you don't see flickering -->
<!--
	<style type="text/css">
		body {
			background: url("/wp-content/themes/imo-mags-parent/images/shows/dark-background.jpg");
		    background-repeat: repeat;
			background-color:#2a2a2a;
		}
	</style>
-->
	<!-- script loading smaller image for mobile devices -->
	<script typ="text/javascript">
	    jQuery(document).ready(function(){
	    var windowWidth 	= jQuery(window).width(); 
	    	if (windowWidth < 760 && windowWidth > 611) {
		         jQuery("#palce4schedule").load("/wp-content/themes/imo-mags-parent/content/tv-show/show-schedule.php");
			}else if (windowWidth < 610) {
				jQuery("body").css({
					"background-image" : "url(<?php echo get_field('background_skin_mobile',$acfID); ?>)"
				});
			
			}else if (windowWidth > 611){
				jQuery("body").css({
					"background-image" : "url(<?php echo get_field('background_skin',$acfID); ?>)"
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
				</div><!-- end of .video-player-wrap -->
				<div id="description-area">
					<div class="unify">
						<h1 class="video-title" data-videoid="<?php echo $video_id; ?>" data-slug="<?php echo $post->post_name;?>"><?php the_title(); ?></h1>
						<ul class="social-buttons clearfix">
						    <li>
						        <a href="http://twitter.com/share" class="socialite twitter-share reload-twitter" data-text="<?php the_title(); ?>" data-url="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" data-count="none" rel="nofollow" target="_blank"><span class="vhidden"></span></a>
						    </li>
						    <li>
						        <a href="https://plus.google.com/share?url=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" data-annotation="none" class="socialite googleplus-one g-plusone reload-google" data-href="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" rel="nofollow" target="_blank"><span class="vhidden"></span></a>
						    </li>
						    <li>
						        <a href="http://www.facebook.com/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&t=<?php the_title(); ?>" class="socialite facebook-like reload-fb" data-href="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden"></span></a>
						    </li>
						</ul>
						<div class="video-description"><?php the_content(); ?></div>
						<div class="video-more-content" style="display:none;"><div class="more-link">Read More</div></div>					
					</div><!-- end of .unify -->										
				</div><!-- end of #description-area -->
				
			</div><!-- end of #video-player-area -->
							
			<div class="ad-block">
				<div class="tv-ad-container">
					<?php imo_ad_placement("300_atf"); ?>
				</div>
				<?php //get_template_part( 'widgets/sportsmanLocator' ); ?>
			</div>
				
				<!-- this widget is located in imo-mags-parent/widgets -->

		</div><!-- end of .shows_player_area-->
	</div><!-- end of #show-destination-->
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
	
				
			<div class="loading-gif"></div>
			<?php if( have_rows('seasons', $acfID) ): ?>
				
				<select class="seasons-filter">
					<option value="">Sort by Season</option>
					<?php while ( have_rows('seasons', $acfID) ) : the_row(); 
						$slug = str_replace(" ", "-", get_sub_field('season', $acfID)); ?>
						<option value="<?php echo $slug; ?>"><?php echo get_sub_field('season', $acfID); ?></option>
					<?php endwhile; ?>
				</select>
			<?php endif; ?>

			

		<?php $categories = get_field("category_filter", $acfID);
		if( $categories ){ ?>
			<ul id="video-filter">		
				<li><a slug="most-recent" class="active-slug video-thumb-active video-ajax">Most Recent</a></li>
				<?php 
				foreach( $categories as $category ){  
					$categoryList = get_term_by('id', $category, 'category'); ?>
					<li id="<?php echo $categoryList->slug; ?>"><a slug="<?php echo $categoryList->slug; ?>" class="video-ajax"><?php echo $categoryList->name; ?></a></li>
				<?php } ?>
			</ul>
		<?php } ?>

		<ul id="video-thumbs">
			<?php while (have_posts()) : the_post(); $i++; 
				$post_id = get_the_id();
				$post = get_post($post_id);
				$slug = $post->post_name;
				$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				$cats = get_the_category( $post_id );
				
				$video_id = get_post_meta(get_the_ID(), '_video_id', TRUE);
				$videoLink = !empty($post_id) ? get_permalink($post_id) :  site_url() . $_SERVER['REQUEST_URI']; 
				
				foreach($cats as $cat){
					$catSlug = $cat->slug;
					
					if(strpos($catSlug,'season') !== false){
						$catSlug = $cat->slug;
						$catName = $cat->name;
					}
				} ?>
				<li id="thumb-<?php echo $i; ?>">
					<div class="data-description" style="display:none;"><?php the_content(); ?></div>
					<a class="video-thumb" data-slug="<?php echo $slug; ?>" data-img_url="<?php echo $thumb_url; ?>" data-post_url="<?php echo get_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" data-videoid="<?php echo $video_id; ?>" adServerURL="<?php echo $adServerURL; ?>" videoLink="<?php echo $videoLink; ?>">
						<div class="thumb-wrap">
							<?php the_post_thumbnail("show-thumb"); ?>
							<span class="play-btn"></span>
						</div>
						<span class="season-number"><?php echo $catName; ?></span>
						<h3><?php the_title(); ?></h3>
					</a>
				</li>
		
			<?php endwhile; ?>
		</ul>
		<div class="paginate-videos">
			<a class="paginate-videos show-btn">Load more videos <i class="fa fa-long-arrow-down"></a></i>
			<div class="loading-gif bottom-paginate"></div>
		</div>
	</div><!-- end of .thumbs-full -->
</div><!-- end of #show-featured -->
<div id="upcoming">
	<div class="container tiled-grid clr">
		<div class="tonight-bg"></div>
		<div class="tiled-grid-entry on-tonight clr span_1_of_4 col col-1">
			<h3>Sportsman Channel Tonight</h3>
			<a class="" href="http://thesportsmanchannel.com/schedule" tarfet="_blank">Full Schedule <i class="fa fa-angle-double-right"></i></a>
		</div>
		<div class="tonight-schedule">
			<ul class="slides">
				<?php echo do_shortcode('[tscschedule format="tonight"]'); ?>
			</ul>
		</div>
	</div>
</div><!-- end of #upcoming -->
<?php 
	get_template_part( 'content/tv-show/show-store' ); 
	get_template_part( 'content/tv-show/show-sponsors' ); 
?>

	
	
	
	
	
	
	
	
	
	
	
