<?php
get_header(); ?>

<div class="inner-main">

    <?php //get_template_part( 'nav', get_post_format() ); ?>
	<?php imo_sidebar(); ?>
	<div id="primary" class="general">
        <div id="content" class="general-frame" role="main">

            <?php while ( have_posts() ) : the_post(); ?>


                <?php get_template_part( 'content/content-single', "community" ); ?>

                <div class="post-comments-area">
                    <?php comments_template( '', true ); ?>
                </div>

                <div class="hr"></div>
                <?php social_footer(); ?>
				<a href="#" class="back-top jq-go-top">back to top</a>
            <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->
    </div><!-- #primary -->

</div>
<?php get_footer(); ?>