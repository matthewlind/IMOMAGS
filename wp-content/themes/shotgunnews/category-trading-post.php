<?php
$cat = get_category( get_query_var( 'cat' ) );
$cat_slug = $cat->slug;
$cat_name = $cat->cat_name;
if($cat_slug == "pike-muskie"){
	$cat_slug = "pike_amp_muskie";
}
if($cat_slug == "trout-salmon"){
	$cat_slug = "trout_amp_salmon";
}
$featuredCatID = $cat->id;
$dataPos = 0;

get_header(); ?>
    <div class="sidebar-area">
    	<div class="sidebar">
    		<div class="widget_advert-widget">
    			<?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>
    		</div>
    		<div class="widget widget_text">
    			<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FShotgunNews&amp;width=310&amp;height=184&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23DDDDDD&amp;stream=false&amp;header=false&amp;appId=218070564894418" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:310px; height:184px;" allowTransparency="true" id="fb-sidebar"></iframe>    		</div>
    	</div>
    	<div id="responderfollow"></div>
		<div class="sidebar advert">
			<div class="widget_advert-widget">
				<?php imo_ad_placement("btf_medium_rectangle_300x250"); ?>
			</div>
		</div>
    </div>
    <div id="primary" class="general trading-post">
        <div id="content" role="main" class="general-frame">
			
            <?php if ( have_posts() ) : ?>
				<?php
                    if(function_exists('z_taxonomy_image_url')){ 
                    	if (z_taxonomy_image_url()) {
	                    	echo '<div class="sponsor">'.imo_ad_placement("sponsor_logo_240x60").'</div>';
	                    	echo '<div class="category-img"><img src="'.z_taxonomy_image_url().'" alt="'.single_cat_title( '', false ).'" title="'.single_cat_title( '', false ).'" /></div>';
						}
                    }
                	$category_description = category_description();
                    if ( ! empty( $category_description ) )
                        echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta taxdescription js-responsive-section">' . $category_description . '</div>' );
                ?>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
                    <h1 class="page-title" style="<?php if(function_exists('z_taxonomy_image_url')){ if (z_taxonomy_image_url()){ echo 'text-indent:-9999px;height:0;'; } } ?>">
					<div class="icon" style="<?php if(function_exists('z_taxonomy_image_url')){ if (z_taxonomy_image_url()){ echo 'text-indent:-9999px;height:0;'; } } ?>"></div>
                    <?php
                        printf('<span>' . single_cat_title( '', false ) . '</span>' );
                        ?>
                    </h1>
                    <div class="header-content">
	                    <p>Today's hot new products from Shotgun News</p>
	                    <?php $url = "http://www.shotgunnews.fox/trading-post/";
						if(function_exists('wpsocialite_markup')){ wpsocialite_markup(array('url' => $url )); } ?>
	                    <select class="trading-post-filter">
							<option value="">Filter Products</option>
							<option value=""></option>
							<option value=""></option>
							<option value=""></option>
							<option value=""></option>
						</select>
                    </div>
                    <?php if(function_exists('z_taxonomy_image_url')){ 
                    	if (z_taxonomy_image_url() == false){ ?>
							<div class="sponsor"><?php imo_ad_placement("sponsor_logo_240x60"); ?></div>
                    <?php } } ?>
				</div>

                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">
					<?php $i = 1; while ( have_posts() ) : the_post(); ?>
                           
                        <div id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix'); ?>  data-slug="<?php echo $post->post_name;?>">
							<h3 class="entry-title">
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark" data-title="<?php the_title(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="article-content">
								<div class="thumb-area">
							    	<a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb'); ?></a>
							    	<?php $url = get_the_permalink();
							    	if(function_exists('wpsocialite_markup')){ wpsocialite_markup(array('url' => $url )); } ?>
								</div>
						        <div class="article-holder">
						    		<div class="entry-content">
						    			<?php the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
						    			<?php //the_excerpt(); ?>
						    		</div><!-- .entry-content -->
						        </div>
							</div>
						</div><!-- #post -->

				
                    <?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>

                    <div class="image-banner posts-image-banner">
                       <?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>
                    </div>
                    <?php endif;?>

                    <?php $i++; endwhile; ?>

                </div>

                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
                    <a href="#" class="btn-base">Load More</a>
                    <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
                    <a href="#" class="go-top jq-go-top">go top</a>

                    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
                </div>
            <?php else : ?>

                <div id="post-0" class="post no-results not-found">
                    <div class="entry-header">
                        <h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
                    </div><!-- .entry-header -->

                    <div class="entry-content">
                        <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
                        <?php get_search_form(); ?>
                    </div><!-- .entry-content -->
                </div><!-- #post-0 -->

            <?php endif; ?>
            <?php social_footer(); ?>
            <a href="#" class="back-top jq-go-top">back to top</a>

        </div><!-- #content -->
    </div><!-- #primary -->
<?php get_footer(); ?>