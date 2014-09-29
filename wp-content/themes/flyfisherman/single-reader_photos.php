<?php

$dataPos = 0;

get_header();
get_template_part( 'nav', get_post_format() );

?>


<div id="community-wrap">
    <div id="primary" class="general">
        <div id="content" role="main" class="general-frame">

            <?php if ( have_posts() ) : ?>

                <?php get_template_part( 'content/content-single', "community" ); ?>
								
            <?php endif; ?>
        </div><!-- #content -->
    </div><!-- #primary -->

</div><!-- #community-wrap -->
<?php imo_community_sidebar(); ?>

<?php get_footer(); ?>
               

