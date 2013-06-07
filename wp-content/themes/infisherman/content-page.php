<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<div data-position="1" class="page-header clearfix js-responsive-section">
	<h1 class="page-title">
		<span><?php the_title(); ?></span>
    </h1>
	<img src="<?php bloginfo('template_directory'); ?>/images/logos/livingston.png" alt="" class="tite-logo" />
</div>
<div data-position="2" class="sub-titile-banner js-responsive-section">
	<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/pic/revo-sx-family.jpg" alt="" /></a>
</div> 
<div data-position="3"  id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix js-responsive-section'); ?>>
	<div class="article-holder">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
    </div>
</div><!-- #post-<?php the_ID(); ?> -->
<div class="sub-boxes">
	<div class="sub-box banner-box">
	    <?php imo_dart_tag("300x250",array("pos"=>"mid")); ?>
	</div>
	<div class="sub-box fb-box">
	   <div class="fb-recommendations" data-site="in-fisherman.com" data-width="309" data-height="252" data-header="true" data-font="arial"></div>
	</div>
</div>
                
<div class="foot-social clearfix">
    <strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
    <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
     <?php social_networks(); ?>
</div>
<a href="#" class="get-newsletter">Get the In-Fisherman <br />Newsletter</a>
<a href="#" class="back-top jq-go-top">back to top</a>

