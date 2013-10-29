<?php
$dataPos = 0;
get_header(); ?>
	<?php imo_sidebar('home');?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            <?php if ( is_home() ) : ?>
            	<?php $fetured_slider_query = new WP_Query( 'category_name=featured&posts_per_page=5' ); ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="ma-section clearfix js-responsive-section">
                    <!--<div class="general-title clearfix">
                        <h2>Featured</h2>
                    </div>-->
                    <div class="clearfix">
                        <div class="master-angler-banner">
                            <h2>Camera <br />Corner <br /><span class="tite-year">Reader Best Photos</span></h2>
                            <a href="/reader-photos/" class="btn-base btn-base-middle">Share Now!</a>
                        </div>
                        <div class="single-post-slider loading-block">
							<div class="single-featured-slider onload-hidden">
                                <ul class="slides-inner slides">
                                 <?php while ($fetured_slider_query->have_posts()) : $fetured_slider_query->the_post(); ?>
								  	<li>
                                        <div class="feat-post">
                                            <div class="feat-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('index-thumb'); ?></a></div>
                                            <div class="feat-text">
                                                <h3><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                                </ul>
                            </div>
                            <div class="post-panel clearfix">
                              	<a class="see-all" href="/reader-photos/" style="visibility:hidden;">See All </a>
                            </div>
                        </div>

                    </div>
                </div>

                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">
                    <!--<div class="general-title clearfix">
                        <h2><span>Popular</span></h2>
                    </div>-->
                    <?php $more_query = new WP_Query( 'posts_per_page=20' ); ?>
                    <?php while ($more_query->have_posts()) : $more_query->the_post(); ?>

                    <div class="article-brief clearfix">
                        <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('index-thumb');?></a>
                        <div class="article-holder">
                            <div class="clearfix">
                                <?php echo primary_and_secondary_categories(); ?>
                            </div>
                            <h3 class="entry-title">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h3>
                            <!-- .entry-header -->
                            <a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                                <?php //the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
                                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
                            </div><!-- .entry-content -->
                        </div>
                    </div><!-- #post -->
                    <?php endwhile; ?>
                </div>
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
                    <a href="#" class="btn-base">Load More</a>
                    <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
                    <a href="#" class="go-top jq-go-top">go top</a>

                    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
                </div>

                <?php sub_footer(); ?>
                <!-- end home page content-->
            <?php endif; // end have_posts() check ?>

            </div><!-- #content -->
        </div>
    </div><!-- #primary -->


<?php get_footer(); ?>
