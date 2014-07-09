<?php
/**
 * The template used for displaying page content in show-page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$dataPos = 0;
?>
<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
	<h1 class="page-title<?php if(is_page("guns-ammo-tv-2")){ echo ' section-title videos'; } ?>">
		<div class="icon"></div>
		<span><?php 
		
		
		//leverage some of the advanced custom fields to add content here instead of the default WP title	
		the_title(); 
		
		
		?></span>
    </h1>
</div>

<div data-position="<?php echo $dataPos = $dataPos + 1; ?>"  id="post-<?php the_ID(); ?>" <?php post_class('clearfix js-responsive-section'); ?>>
	<?php 
	
	
	//leverage some of the advanced custom fields to add content here instead of the default WP content	
	the_content(); 
	
	
	
	?>
</div><!-- #post-<?php the_ID(); ?> -->
               

