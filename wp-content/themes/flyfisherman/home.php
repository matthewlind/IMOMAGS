<?php
$dataPos = 0;
get_header(); ?>
	<?php imo_sidebar('home');?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            <?php if ( is_home() ) : ?>
               <!-- start home page content-->
               <!-- <a data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="subscribe-banner subscribe-banner-top js-responsive-section" href="#">
                    <img alt="" src="<?php bloginfo('template_directory'); ?>/images/pic/subscribe-banner.jpg">
                </a>-->
                <?php $featured_slider_query = new WP_Query( 'category_name=featured&posts_per_page=5' ); ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?> "class="post-slider loading-block js-responsive-section">
                    <div class="jq-slider onload-hidden">
                        <ul class="slides-inner slides">
                            <?php while ($featured_slider_query->have_posts()) : $featured_slider_query->the_post(); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('post-home-thumb');?></a>
                                <div class="nl-txt">
                                    <?php echo the_primary_category(); ?>
                                    <h2 class="entry-title home-entry-title"><a href="<?php the_permalink(); ?>" ><?php $title = the_title('','',FALSE); echo substr($title, 0, 70); if (strlen($title) > 70) echo "..."; ?></a></h2>
                                    <!--<div class="shares-count">
                                        <?php render_shares_count(get_permalink(), $post->ID) ?> <span>SHARES</span>
                                    </div>
                                    <a class="view-post" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">view post</a>-->
                                </div>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
				                
                <?php $featured_slider_query = new WP_Query( 'category_name=fly-tying&posts_per_page=8' ); ?> 
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="double-posts double-post-slider loading-block js-responsive-section">
                    <div class="general-title clearfix">
                        <h2>Fly <span>Tying</span></h2>
                    </div>
	                    <div class="jq-slider onload-hidden clearfix">
	                        <ul class="slides-inner slides">
	                            <?php $i = 1  ?>
	                            <?php while ($featured_slider_query->have_posts()) : $featured_slider_query->the_post(); ?>
	                            
	                            <?php if (!(($i+1)%2) ): ?>
	                            <li>
	                            <?php endif; ?>
	                            
	                            <div class="feat-post">
	                                <div class="feat-img"><a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('post-home-small-thumb');?></a></div>
	                                <div class="feat-text">
	                                    <div class="clearfix">
	                                    	<?php echo primary_and_secondary_categories(); ?>
	                                    </div>
	                                    <h3><a href="<?php the_permalink(); ?>" ><?php $title = the_title('','',FALSE); echo substr($title, 0, 54); if (strlen($title) > 54) echo "..."; ?></a></h3>
	                                    <!--<div class="shares-count">
	                                        <?php //render_shares_count(get_permalink(), $post->ID) ?> <span>Shares</span>
	                                    </div>
	                                    <a class="view-post" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">&nbsp;</a>-->
	                                </div>
	                            </div>
	                            
	                            <?php if (!($i%2)): ?>
	                            </li>
	                            <?php endif; ?>
	                            
	                            <?php $i++; ?>
	                            <?php endwhile; ?>
	                        </ul>
	                    </div>
				</div>
				
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section">
                    <div class="general-title clearfix">
                        <h2><span>Popular</span></h2>
                    </div>
                    <?php $more_query = get_more_posts_query(); ?>
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
    
                <!-- start footer posts -->
                <div class="links-holder">
                    <div class="image-banner">
                     <?php if (mobile()) { 
	                 	imo_dart_tag("300x250",array("pos"=>"mob"));
	                 } ?>              
                    </div>
                    <div>
                        <div class="links-section">
                            <div class="links-column">
                               <?php $footer_query = new WP_Query( 'category_name=beginners&posts_per_page=3' ); ?>
                               <h4><?php echo get_category_title_by_slug("beginners"); ?></h4>
                               <ul class="links-list">
                                    <?php while ($footer_query->have_posts()) : $footer_query->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'flyfisherman' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </li><!-- #post -->                
                                    <?php endwhile; ?>
                               </ul>
                            </div>
                            <div class="links-column">
                                <?php $footer_query = new WP_Query( 'category_name=beginners&posts_per_page=3' ); ?>
                                <h4><?php echo get_category_title_by_slug("beginners"); ?></h4>
                                <ul class="links-list">
                                    <?php while ($footer_query->have_posts()) : $footer_query->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'flyfisherman' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </li><!-- #post -->                
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                            <div class="links-column">
                                <?php $footer_query = new WP_Query( 'category_name=beginners&posts_per_page=3' ); ?>
                                <h4><?php echo get_category_title_by_slug("beginners"); ?></h4>
                                <ul class="links-list">
                                    <?php while ($footer_query->have_posts()) : $footer_query->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'flyfisherman' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </li><!-- #post -->                
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="links-section">
                            <div class="links-column">
                                <?php $footer_query = new WP_Query( 'category_name=beginners&posts_per_page=3' ); ?>
                                <h4><?php echo get_category_title_by_slug("beginners"); ?></h4>
                                <ul class="links-list">
                                    <?php while ($footer_query->have_posts()) : $footer_query->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'flyfisherman' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </li><!-- #post -->                
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                            <div class="links-column">
                                <?php $footer_query = new WP_Query( 'category_name=beginners&posts_per_page=3' ); ?>
                                <h4><?php echo get_category_title_by_slug("beginners"); ?></h4>
                                <ul class="links-list">
                                    <?php while ($footer_query->have_posts()) : $footer_query->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'flyfisherman' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </li><!-- #post -->                
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                            <div class="links-column">
                                <?php $footer_query = new WP_Query( 'category_name=beginners&posts_per_page=3' ); ?>
                                <h4><?php echo get_category_title_by_slug("beginners"); ?></h4>
                                <ul class="links-list">
                                    <?php while ($footer_query->have_posts()) : $footer_query->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'flyfisherman' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </li><!-- #post -->                
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end footer posts -->
                
               <?php sub_footer(); ?>
            <!-- end home page content-->
            <?php endif; // end have_posts() check ?>
    
            </div><!-- #content -->
        </div>
    </div><!-- #primary -->


<?php get_footer(); ?>
