<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<div id="post-<?php the_ID(); ?>">
		<?php the_content(); ?>
</div><!-- #post-<?php the_ID(); ?> -->
               
