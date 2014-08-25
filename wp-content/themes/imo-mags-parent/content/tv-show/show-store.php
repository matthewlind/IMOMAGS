<?php
/**
 * The template used for displaying page content in show-page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<div id="show-store">
	<div class="store-left">
		<h2>Store</h2>
		<p>Bowhunter TV</p>
		<a href="https://store.intermediaoutdoors.com/brands.php?brand=<?php echo bloginfo("name"); ?>" class="show-btn" target="_blank">Visit Store</a>
	</div>
	<div class="store-sep"></div>
	<?php the_widget("imo\IMOStoreWidget"); ?></div>
</div>