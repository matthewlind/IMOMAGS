<?php

$dataPos = 0;

get_header();


?>

<h1>TEMPLATE</h1>


<div id="community-wrap">
    <div id="primary" class="general">
        <div id="content" role="main" class="general-frame">

            <?php if ( have_posts() ) : ?>

                <?php get_template_part( 'content/content-category-reader_photos', get_post_format() ); ?>

            <?php endif; ?>
        </div><!-- #content -->
    </div><!-- #primary -->
    <?php //imo_community_sidebar(); ?>
</div><!-- #community-wrap -->
<?php get_footer(); ?>