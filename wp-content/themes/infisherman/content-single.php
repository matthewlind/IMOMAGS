<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('full-post'); ?>>
    
    <?php //the_post_thumbnail(); ?>
    <?php if ( is_single() ) : ?>
    <div class="clearfix">
        <?php echo primary_and_secondary_categories(); ?>
        <a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
    </div>
    
    <div class="post-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php else : ?>
        <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h1>
        <?php endif; // is_single() ?>
        <em class="meta-date-author">by <span class="author-item"><?php the_author() ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;<?php the_time('F jS, Y') ?></em>
    </div>
    <!-- .entry-header -->
    <div class="entry-content-holder">
        <?php if ( is_search() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
        <?php else : ?>
        <div class="entry-content">
            <?php the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
        </div><!-- .entry-content -->
        <?php endif; ?>
    </div>
    <?php if (isset_related_posts()): ?>
    <div class="paging-posts paging-single-post">
        <div class="jq-single-paging-slider">
        <?php related_posts(); ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="hr mobile-element"></div>
    <div class="sub-boxes">
            <div class="sub-box banner-box">
                <img src="<?php bloginfo('template_directory'); ?>/images/pic/sounds-vibration.jpg" alt="" />
            </div>
            <div class="sub-box fb-box">
               <div class="fb-recommendations" data-site="in-fisherman.com" data-width="309" data-height="252" data-header="true" data-font="arial"></div>
            </div>
        </div>

    <div class="entry-meta">
        <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
        <?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
            <div class="author-info article-brief">
                <div class="author-avatar">
                    <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 68 ) ); ?>
                </div><!-- .author-avatar -->
                <div class="author-description">
                    <h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
                    <p><?php the_author_meta( 'description' ); ?>
	                    <div class="author-link">
	                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
	                            <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
	                        </a>
	                    </div><!-- .author-link -->
                    </p>
                   
                </div><!-- .author-description -->
            </div><!-- .author-info -->
        <?php endif; ?>
    </div><!-- .entry-meta -->
</div><!-- #post -->
