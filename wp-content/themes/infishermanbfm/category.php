<?php
get_header(); ?>
        <?php get_sidebar(); ?>
        <div id="primary" class="general">
            <div id="content" role="main" class="general-frame">
                
                <?php if ( have_posts() ) : ?>
    
                    <div data-position="1" class="page-header clearfix js-responsive-section">
                        <h1 class="page-title"><?php
                            printf('<span>' . single_cat_title( '', false ) . '</span>' );
                            ?>
                        </h1>
                        <img src="<?php bloginfo('template_directory'); ?>/images/logos/livingston.png" alt="" class="tite-logo" />
    
                        <?php
                            $category_description = category_description();
                            if ( ! empty( $category_description ) )
                                echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
                        ?>
                    </div>
                    <div data-position="2" class="sub-titile-banner js-responsive-section">
                        <a href="#">
                            <img src="<?php bloginfo('template_directory'); ?>/images/pic/revo-sx-family.jpg" alt="" />
                        </a>
                    </div>
                    <div data-position="3" class="filter-by jq-filter-by js-responsive-section">
                        <strong>filter by:</strong>
                        <ul class="filter-links">
                            <li><a href="#">Latest</a></li>
                            <li><a href="#">Most Viewed</a></li>
                            <li><a href="#">Most Commented</a></li>
                            <li><a href="#">Most Shared</a></li>
                        </ul>
                    </div>
                    
                    <div data-position="4" class="js-responsive-section main-content-preppend">
                        <?php //twentyeleven_content_nav( 'nav-above' ); ?>
    
                        <?php /* Start the Loop */ ?>
                        <?php $i = 1; while ( have_posts() ) : the_post(); ?>
        
                            <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'content', get_post_format() );
                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            ?>

                        <?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>
                        <div class="image-banner posts-image-banner">
                            <a href="#"><img src="/wp-content/themes/infisherman/images/pic/banner-evinrude.jpg" alt=""></a>
                        </div>
                        <?php endif;?>
        
                        <?php $i++; endwhile; ?>
        
                        <?php //twentyeleven_content_nav( 'nav-below' ); ?>
                    </div>
    
                    <div data-position="5" class="pager-holder js-responsive-section">
                        <!-- <a href="#" class="btn-base">Load More</a> -->
                        <?php wp_pagenavi(array("before" => '<a href="#" class="btn-base">Load More</a>')); ?>
                        <a href="#" class="go-top jq-go-top">go top</a>

                        <img src="/wp-content/themes/infisherman/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
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
    
                <div class="foot-social clearfix">
                    <strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
                    <div class="socials">
                        <a href="#" class="facebook">Facebook</a>
                        <a href="#" class="twitter">Twitter</a>
                        <a href="#" class="youtube">YouTube</a>
                        <a href="#" class="rss">RSS</a>
                    </div>
                </div>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                
                <a href="#" class="get-newsletter">Get the In-Fisherman <br />Newsletter</a>
                <a href="#" class="subscribe-banner">
                    <img src="<?php bloginfo('template_directory'); ?>/images/pic/subscribe-banner.jpg" alt="" />
                </a>
                <a href="#" class="back-top jq-go-top">back to top</a>
                
            </div><!-- #content -->
        </div><!-- #primary -->
<script type="text/javascript">
( function($){

    $(function(){
        $(".pager-holder a.btn-base").click(function(e){
            $("#ajax-loader").show();

            if ($(window).width() <  610 ) {
                var findId = 'div.post, div.posts-image-banner';
            } else {
                var findId = 'div.post';
            }
            e.preventDefault()
            if ($("a.next-link").length) {
                $.ajax({
                    url: $("a.next-link").attr('href'),
                    dataType: 'html',
                    success: function(data) {
                        $('.main-content-preppend').append(
                            $(data).find('.js-responsive-section').find(findId).hide()
                        );
                        $('.main-content-preppend').find(findId).show('slow')
                        if ($(data).find('a.next-link').length) {
                            $("a.next-link").attr({'href': $(data).find('a.next-link').attr('href')})
                        } else {
                            $(".pager-holder a.btn-base").hide();
                        }
                        $("#ajax-loader").hide();
                    },
                    error: function () {$("#ajax-loader").hide();}
                })
            }
        })
    })

} )(jQuery)
</script>
<?php get_footer(); ?>