<?php

$dataPos = 0;

get_header();
get_template_part( 'nav', get_post_format() );
imo_community_sidebar(); ?>
    <div id="primary" class="general">
        <div id="content" role="main" class="general-frame">

            <?php if ( have_posts() ) : ?>

                <?php get_template_part( 'content/content-single', "community" ); ?>
				<div class="post-comments-area">
                    <?php comments_template( '', true ); ?>
                </div>					
            <?php endif; ?>
        </div><!-- #content -->
    </div><!-- #primary -->




<?php get_footer(); ?>
               

