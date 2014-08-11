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
		<div class="sidebar-area">
			<div class="sidebar">
				<div class="widget_advert-widget">
				<?php imo_dart_tag("300x250"); ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
		<div class="show-child-general">
			<div class="show-child-general-frame">
				<div class="page-header clearfix js-responsive-section">
					<h1 class="page-title">
						<span><?php the_title(); ?></span>
				    </h1>
				</div>
				
				<div id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix js-responsive-section'); ?>>
					<div class="article-holder">
						<?php the_content(); ?>
					</div>
				</div>
		</div>
		</div>
	</div><!-- end of #shows_player_area :::: this div ends an open div in the show header template-->

	<div id="imo-store">
			
	</div>
	
	<?php get_template_part( 'content/show-sponsors' ); ?>
	</div>
</div>
	
	
	
	
	
	
	
	
	
	
	
