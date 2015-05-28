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

// Custom Fields
$show_logo = get_field('show_logo',$acfID);
?>

<div class="clearfix js-responsive-section">
	<div id="header-top">
		<div class="shows-logo" style="background-image: url('<?php echo $show_logo; ?>');">
			<a href="/tv"><!-- <img src="<?php echo get_field('show_logo',$acfID); ?>" alt="<?php echo get_field('show_title',$acfID); ?>"> --></a>
		</div>
		<div class="shows-title">
			<h1><?php //echo get_field('show_title',$acfID); ?></h1>
		</div><!-- end of #shows-title -->
		<div class="shows-sponsor">
			<?php imo_ad_placement("sponsor_logo_240x60"); ?>
		</div>
	</div><!-- end of #header-top -->
	<div id="shows-nav">
		<?php if( have_rows('show_menu',$acfID) ): ?>
			<div class="menu">
				<ul class="clearf">
					<li class="page_item page-item-mobile page-item-mobile-btn">
							<?php 
								$post = get_post($postID);
								$slug = $post->post_name;	
								if($post->post_parent) { 
									$post_data = get_post($post->post_parent);
									$parent_slug = $post_data->post_name; 
								}
								if (empty($parent_slug)) {
									echo "Home";
								} elseif ($parent_slug == "tv") {
									if ($slug == "photo") {
										echo "Photo";
									} elseif ($slug == "about") {
										echo "About & Hosts";
									} elseif ($slug == "shows") {
										echo "More Shows";
									} else {
										echo "Menu";
									}
								}	
							?>
							<i class="fa fa-caret-down"></i>
						<div class="mobile-dropdown-menu">
							<ul>
								<?php while( have_rows('show_menu',$acfID) ): the_row(); ?>
									<li class="page_item"><a href="<?php echo get_sub_field('url'); ?>"><?php echo get_sub_field('name'); ?></a></li>
								<?php endwhile; ?>
									<li class="page_item"><a href="<?php echo get_field('show_store',$acfID); ?>" target="_blank">Store</a></li>
							</ul>
						</div>
					 </li>
					 <li class="page_item page-item-mobile">
					 	<a href="/tv/shows">More Shows</a>
					 </li>
					<?php while( have_rows('show_menu',$acfID) ): the_row(); ?>
					<li class="page_item non-mobile-item"><a href="<?php echo get_sub_field('url'); ?>"><?php echo get_sub_field('name'); ?></a></li>
					<?php endwhile; ?>
					<li><div class="fb-like" data-href="<?php echo site_url(); ?>/tv/" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div></li>
				</ul>
			</div>
		<?php endif; ?>

	</div>
</div><!-- end of .page-header -->	
	