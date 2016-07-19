<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$dataPos = 0;
?>
<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
	<h1 class="page-title">
		<span><?php the_title(); ?></span>
    </h1>
</div>

<div data-position="<?php echo $dataPos = $dataPos + 1; ?>"  id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix js-responsive-section'); ?>>
	<div class="article-holder">

		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
    </div>
</div><!-- #post-<?php the_ID(); ?> -->


