
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
	    	if (windowWidth < 760 && windowWidth > 611) {
		         jQuery("#palce4schedule").load("/wp-content/themes/imo-mags-parent/content/tv-show/show-schedule.php");
		         jQuery("body").css({
		         "background-image" : "url(<?php echo get_field('background_skin_mobile',$acfID); ?>)",
		         "background-repeat" : "no-repeat",
		         "background-size" : "160% auto",
		         "background-position" : "20% 0",
		         "background-color" : "#2a2a2a"
		         });
	         }else if (windowWidth < 610) {
		         jQuery("body").css({
		         "background-image" : "url(<?php echo get_field('background_skin_mobile',$acfID); ?>)",
		         "background-repeat" : "no-repeat",
		         "background-size" : "160% auto",
		         "background-position" : "20% 50px",
		         "background-color" : "#2a2a2a"

		         });

	         }else if (windowWidth > 760){
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
					<?php if( !mobile() ){ ?>
					<div class="ad-block">
						<?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>
						<div class="new-show"></div>
						<?php get_template_part( 'widgets/sportsmanLocator' ); ?>
					</div>
					<?php } ?>
				</div><!-- end of .video-player-wrap -->
				<div id="description-area">
					<div class="unify">
						<h1 class="video-title" data-videoid="<?php echo $video_id; ?>" data-slug="<?php echo $post->post_name;?>"><?php the_title(); ?></h1>
						<ul class="social-buttons">
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
						<!--<div class="social-share clearf">
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
				<!-- this widget is located in imo-mags-parent/widgets -->
			</div><!-- end of #video-player-area -->
		</div><!-- end of #show-destination-->
	</div><!-- end of #shows_player_area from show-header.php-->
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
						<?php the_post_thumbnail("show-thumb"); ?>
						<span class="season-number"><?php echo $catName; ?></span>
						<h3><?php the_title(); ?></h3>
						<span class="play-btn"></span>
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
			<h3>On Tonight</h3>
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

	
	
	
	
	
	
	
	
	
	
	
