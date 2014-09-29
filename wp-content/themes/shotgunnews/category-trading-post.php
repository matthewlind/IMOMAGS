<?php
//Single template located in parent theme utilizing custom single template function.
$dataPos = 0;
$idObj = get_category_by_slug('trading-post'); 
$id = $idObj->term_id;
$acfID = 'category_' . $id;

get_header(); ?>
    <div class="sidebar-area">
    	<div class="sidebar">
    		<div class="widget_advert-widget widget">
    			<?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>
    		</div>
    		<div class="widget_advert-widget widget left-125">
    			<?php imo_ad_placement("atf_button_1"); ?>
    		</div>
    		<div class="widget_advert-widget widget right-125">
    			<?php imo_ad_placement("atf_button_2"); ?>
    		</div>
    		<div class="widget widget_text">
    			<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FShotgunNews&amp;width=310&amp;height=184&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23DDDDDD&amp;stream=false&amp;header=false&amp;appId=218070564894418" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:310px; height:184px;" allowTransparency="true" id="fb-sidebar"></iframe>    		
    		</div>
    	</div>
    	<div id="responderfollow"></div>
		<div class="sidebar advert">
			<div class="widget_advert-widget widget">
				<?php imo_ad_placement("btf_medium_rectangle_300x250"); ?>
			</div>
			<div class="widget_advert-widget widget left-125">
    			<?php imo_ad_placement("btf_button_1"); ?>
			</div>
			<div class="widget_advert-widget widget right-125">
    			<?php imo_ad_placement("btf_button_2"); ?>
    		</div>
		</div>
    </div>
    <div id="primary" class="general trading-post">
        <div id="content" role="main" class="general-frame">
			
            <?php if ( have_posts() ) : ?>
				<?php
                    if(function_exists('z_taxonomy_image_url')){ 
                    	if (z_taxonomy_image_url()) {
	                    	echo '<div class="category-img"><img src="'.z_taxonomy_image_url().'" alt="'.single_cat_title( '', false ).'" title="'.single_cat_title( '', false ).'" /></div>';
						}
                    }
                ?>
                <div class="sponsor"><?php imo_ad_placement("sponsor_logo_240x60"); ?></div>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
                    <h1 class="page-title"><span>Trading Post</span></h1>
                    <div class="header-content">
                    	<?php $category_description = category_description();
							if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<p>' . $category_description . '</p>' ); ?>
	                    <?php $url = "http://www.shotgunnews.com/trading-post/";
						if(function_exists('wpsocialite_markup')){ wpsocialite_markup(array('url' => $url )); } ?>
						<?php $cats = get_field("category_filter", $acfID);
						if( $cats ){ ?>
						 <select class="trading-post-filter">
							<option value="">Filter Products</option>
							<?php 
							foreach( $cats as $cat ){  
								$category = get_term_by('id', $cat, 'category'); ?>
								<option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
							<?php } ?>
						</select>
					<?php } ?>
                    </div>
                    <div class="loading-gif"></div>
				</div>

                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">
					<?php $i = 1; while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content/content-trading-post', get_post_format() ); ?>
                    <?php $i++; endwhile; ?>
                </div>

                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
                    <a href="#" class="btn-base paginate-posts">Load More</a>
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
