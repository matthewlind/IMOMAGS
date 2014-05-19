<?php

$dataPos = 0;

get_header();
get_template_part( 'nav', get_post_format() );

?>
<div id="community-wrap">
    <div id="primary" class="general">
        <div id="content" role="main" class="general-frame">

            <?php if ( have_posts() ) : ?>

                <?php get_template_part( 'content/content-category-reader_photos', get_post_format() ); ?>

            <?php endif; ?>
<<<<<<< HEAD
        </div><!-- #content -->
    </div><!-- #primary -->
    <?php imo_community_sidebar(); ?>
</div><!-- #community-wrap -->
=======
            <?php social_footer(); ?>
            <a href="#" class="back-top jq-go-top">back to top</a>

        </div><!-- #content -->
    </div><!-- #primary -->
    <?php imo_sidebar(); ?>
</div>
>>>>>>> 0891535794e2cfca5412b75e0961eb826971ed7e
<?php get_footer(); ?>