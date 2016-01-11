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

$video_id = get_post_meta(get_the_ID(), '_video_id', TRUE);
$adServerURL = "http://ad.doubleclick.net/pfadx/" .  get_option("dart_domain", _imo_dart_guess_domain())  ."/tv";
$videoLink = !empty($postID) ? get_permalink($postID) :  site_url() . $_SERVER['REQUEST_URI']; 

// post slug
$slug_tv = get_post( $post )->post_name; 
?>
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
    	if (windowWidth <= 610) {
	         jQuery("#palce4schedule").load("/wp-content/themes/imo-mags-parent/content/tv-show/show-schedule.php");
	         jQuery("body").css({
	         "background-image" : "url(<?php echo get_field('background_skin_mobile',$acfID); ?>)"
	         });
         } else {
	        jQuery("body").css({
	         "background-image" : "url(<?php echo get_field('background_skin',$acfID); ?>)"
	         });
        }
    });
</script>
<div id="show-destination" playerID="<?php echo get_field("tv_player_id","options"); ?>" adServerURL="<?php echo $adServerURL; ?>" videoLink="<?php echo $videoLink; ?>">
	<?php get_template_part( 'content/tv-show/show-header' ); ?>
		<div class="sidebar-area">
			<div class="sidebar">
				<div class="widget_advert-widget widget">
					<?php imo_ad_placement("300_atf"); ?>
				</div>
				<?php the_widget( 'Schedule_Widget' ); ?>
				<div class="widget"><?php get_template_part( 'widgets/sportsmanLocator' ); ?></div>
				<?php the_widget( 'imo\SubscribeWidget' ); ?>
			</div><!-- end of .sidebar -->
		</div><!-- end of .sidebar-area -->

		<div class="show-child-general">
			<div class="show-child-general-frame">
				<div class="show-header js-responsive-section">
					<h1 class="page-title">
						<span><?php the_title(); ?></span>
				    </h1>
				</div>
				
				<div id="post-<?php the_ID(); ?>" <?php post_class('article-brief js-responsive-section'); ?>>
					<div class="article-holder">
						<?php the_content(); ?>
					</div>
				</div>
				
				<?php get_template_part( "content/tv-show/{$slug_tv}" ); ?>
			</div><!-- end of .show-child-general-frame -->
		</div><!-- end of .show-child-general -->
	</div><!-- end of #show-destination -->
</div><!-- end of #shows_player_area :::: this div ends an open div in the show header template-->
<div class="wrap4padding"><div class="border-stripes"></div></div>
<?php 
//get_template_part( "content/tv-show/show-schedule" );
get_template_part( 'content/tv-show/show-store' ); 
get_template_part( 'content/tv-show/show-sponsors' ); ?>















	
