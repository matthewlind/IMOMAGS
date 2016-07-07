<?php
get_header(); ?>
    <?php get_sidebar(); ?>
    <div id="primary" class="general">
        <?php //imo_dart_tag("300x250"); ?>
        <div id="content" class="general-frame" role="main">
        <?php if ( have_posts() ) : ?>

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'content', get_post_format() ); ?>
            <?php endwhile; ?>
            <div data-position="5" class="pager-holder js-responsive-section">
                <!-- <a href="#" class="btn-base">Load More</a> -->
                <?php wp_pagenavi(array("before" => '<a href="#" class="btn-base">Load More</a>')); ?>
                <a href="#" class="go-top jq-go-top">go top</a>

                <img src="/wp-content/themes/infisherman/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
            </div>
        <?php else : ?>

            <div id="post-0" class="post no-results not-found">

            <?php if ( current_user_can( 'edit_posts' ) ) :
                // Show a different message to a logged-in user who can add posts.
            ?>
                <div class="post-header clearfix">
                    <h1 class="entry-title"><?php _e( 'No posts to display', 'twentytwelve' ); ?></h1>
                </div>

                <div class="entry-content">
                    <p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'twentytwelve' ), admin_url( 'post-new.php' ) ); ?></p>
                </div><!-- .entry-content -->

            <?php else :
                // Show the default message to everyone else.
            ?>
                <div class="post-header clearfix">
                    <h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
                </div>

                <div class="entry-content">
                    <p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'twentytwelve' ); ?></p>
                    <br />
                    <?php get_search_form(); ?>
                </div><!-- .entry-content -->
            <?php endif; // end current_user_can() check ?>

            </div><!-- #post-0 -->

        <?php endif; // end have_posts() check ?>

        </div><!-- #content -->
    </div><!-- #primary -->


<?php get_footer(); ?>