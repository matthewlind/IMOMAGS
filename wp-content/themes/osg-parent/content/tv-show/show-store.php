<?php
/**
 * The template used for displaying page content in show-page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$idObj = get_category_by_slug('tv'); 
$id = $idObj->term_id;
$acfID = 'category_' . $id;
?>
<div id="show-store">
	<div class="store-left">
		<h2>Store</h2>
		<p><?php echo get_field('show_title',$acfID); ?></p>
		<a href="<?php echo get_field('show_store',$acfID); ?>" class="show-btn" target="_blank">Visit Store</a>
	</div>
	<div class="store-sep"></div>
	<?php the_widget("imo\IMOStoreWidget"); ?>
</div>