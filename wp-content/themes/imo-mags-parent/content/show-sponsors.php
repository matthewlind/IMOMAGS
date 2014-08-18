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
$acfID = 'category_' . $id; ?>

<div class="inner-main">
	<div class="sidebar-area">
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<div class="widget_advert-widget widget"><?php imo_ad_placement("btf_medium_rectangle_300x250"); ?></div>
			<?php the_widget( 'imo\SubscribeWidget' ); ?>	
		</div>
	</div>
	<div id="primary" class="general">
	    <div id="content" class="general-frame" role="main">
			<div id="sponsors-area">
				<h2>Sponsors</h2>
				<?php if( have_rows('sponsors',$acfID) ): ?>
						<ul>
						<?php while( have_rows('sponsors',$acfID) ): the_row(); ?>
							<li class="sponsor-img"><a href="<?php echo get_sub_field('url'); ?>"><img src="<?php echo get_sub_field('image'); ?>" alt="<?php echo get_sub_field('name'); ?>" /></a></li>
						<?php endwhile; ?>
						</ul>
				<?php endif; ?>
			</div>
	    </div>
	</div>
</div>