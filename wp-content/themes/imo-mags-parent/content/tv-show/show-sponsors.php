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

<div class="shows-player-area sponsors-wrap">
	<div class="sidebar-area">
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<div class="widget_advert-widget widget"><?php imo_ad_placement("300_btf"); ?></div>
			<?php the_widget( 'imo\SubscribeWidget' ); ?>	
		</div>
	</div>
	<div id="primary" class="show-child-general">
	    <div id="content" class="show-child-general-frame" role="main">
			<div id="sponsors-area">
				<h2>Sponsors</h2>
				<?php if( have_rows('sponsors',$acfID) ): ?>
						<ul>
						<?php while( have_rows('sponsors',$acfID) ): the_row(); ?>
							<li class="sponsor-img">
								<?php
								$image = get_sub_field('image');
								
								$url = $image['url'];
								$title = $image['title'];
								$alt = $image['alt'];
								$caption = $image['caption'];
								?>
								<a href="<?php echo get_sub_field('url'); ?>" target="_blank">
									<img class="sposors-box-img" src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" title="<?php echo $title; ?>" />
								</a>
							</li>
						<?php endwhile; ?>
						</ul>
				<?php endif; ?>
			</div>
	    </div>
	</div>
</div>