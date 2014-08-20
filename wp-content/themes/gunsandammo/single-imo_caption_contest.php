<?php
$productName = get_post_meta($post->ID,"product_name",true);
$productDescription = get_post_meta($post->ID,"product_description",true);
$thumbnailID = get_post_meta($post->ID,"product",true);

$thumbnailImage = wp_get_attachment_image($thumbnailID,"thumbnail");
get_header();
if(get_field('featured_stories')){
	$features = get_field('featured_stories'); 
}else{
	$features = get_field('article_featured_stories','options' ); 
}
?>
<div class="special-features">
	<ul>
		<li class="home-featured features">
			<div class="arrow-right"></div>
			<div class="feat-post">
	        	<div class="feat-text">
	        	<h3>
		        	<?php if(get_field('featured_stories_title')){
		        		echo get_field("featured_stories_title"); 
	        		}else if(get_field("featured_title","options")){ 
	        			echo get_field("featured_title","options"); 
	        		} ?>
	        	</h3>
	            </div>
	        </div>
		</li>
		<?php if( $features ){
			foreach( $features as $feature ): 
			
				if(get_field("promo_title",$feature->ID)){
			    	$title = get_field("promo_title",$feature->ID);
				}else{
			    	$title = $feature->post_title;
				} 
					
				$url = $feature->guid;
		    	$tracking = "_gaq.push(['_trackEvent','Special Features Post','$title','$url']);";
				$thumb = get_the_post_thumbnail($feature->ID,"list-thumb"); ?>
		    	<li class='home-featured'>
		            <div class='feat-post'>
		                <div class='feat-text'>
		                    <h3><a href='<?php echo $url; ?>' onclick='<?php echo $tracking; ?>'><?php echo $title ?></a></h3>
		                </div>
		            </div>
		        </li>
		    <?php endforeach; ?>
	<?php } ?>
	</ul>
</div>
    <div class="inner-main">
    	<?php imo_sidebar(); ?>
		<div id="primary" class="general">
            <div id="content" class="general-frame" role="main">

                <?php while ( have_posts() ) : the_post(); ?>
                   
                    <div id="post-<?php the_ID(); ?>" <?php post_class('full-post'); ?>>
				    <?php if ( is_single() ) : ?>
				    <?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(); } ?>
				    <div class="sponsor"><?php imo_ad_placement("sponsor_logo_240x60"); ?></div>
				    <div class="post-header">
				        <h1 class="entry-title"><?php the_title(); ?></h1>
				        <?php else : ?>
				        <h1 class="entry-title">
				            <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				        </h1>
				        <?php endif; // is_single()
				        if(get_the_author() != "admin" && get_the_author() != "infisherman"){ ?>
				        <em class="meta-date-author">by <span class="author-item"><?php the_author_link(); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;<?php } the_time('F jS, Y'); ?></em>
				        <a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
				    </div>
				                        	
				    <?php if ( mobile() ){ ?>
				    <div class="image-banner posts-image-banner">
				        <?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>	
				    </div>
				    <?php } ?>
				
				    <?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup(); } ?>
				    <!-- .entry-header -->
				    <div class="entry-content-holder">
				        <?php if ( is_search() ) : // Only display Excerpts for Search ?>
				        <div class="entry-summary">
				            <?php the_excerpt(); ?>
				        </div><!-- .entry-summary -->
				        <?php else : ?>
				        <div class="entry-content">
				            <?php the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
				            
					        <div class="caption-banner">
						        <div class="caption-banner-text">This Week's Photo</div>
						        
						      </div>
						
						      <div class="caption-contest">
						  		  
						  		  <?php $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full"); ?>
								    <img src="<?php echo $img_src[0]; ?>" class="wp-post-image" alt="<?php the_title(); ?>" />
						  		  
						  		  <?php
						  		  $commentID = get_post_meta($post->ID, '_caption_id', true);
						  		  if ($commentID) : 
						    		  $comment = get_comment($commentID); ?>
						  		    <h2>The Winning Caption:</h2>
						    		  <?php echo get_avatar($comment->comment_author_email, 60); ?>
						    		  <div class="winning-caption">
						    		    <div class="author"><?php echo $comment->comment_author; ?></div>
						    		    <div class="caption"><?php echo $comment->comment_content; ?></div>
						    		  </div>
						  		  <?php endif; ?>
						  		
						  		</div>
						
						      <div class="prize-box">
						        <div class="prize-thumb">
						          <?php echo $thumbnailImage; ?>
						        </div>
						        <h2>The Prize:</h2>
						        <h4><?php echo $productName; ?></h4>
						        <p><?php echo $productDescription; ?></p>
						
						        
						     </div>
						
						</div>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
			        </div><!-- .entry-content -->
			        <?php endif; ?>
			        <div class="article-brief">
			         	<div class="addthis-below" <?php if(mobile()){ echo 'style="width: 320px;"'; } ?>><?php if (function_exists('imo_add_this')) {imo_add_this();} ?></div>
				    </div>
					<?php 
					if(get_the_author() != "admin" && get_the_author() != "infisherman"){ ?>
			        <div class="author-info article-brief">
			                <div class="author-avatar">
			                    <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 68 ) ); ?>
			                </div><!-- .author-avatar -->
			                <div class="author-description">
			                    <h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
			                    <p><?php the_author_meta( 'description' ); ?>
				                    <div class="author-link">
				                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				                            <?php printf( __( 'View all stories by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
				                        </a>
				                    </div><!-- .author-link -->
			                    </p>
			                   
			                </div><!-- .author-description -->
			            </div><!-- .author-info -->
				    </div>
				    <?php } ?>
				    
				    <?php imo_ad_placement("e_commerce_widget"); ?>	
				    	   
				    <?php if ( function_exists('yarpp_plugin_activate') ): ?>
					    <?php if ( isset_related_posts() ): ?>	
						    <?php if(mobile() || tablet()){ ?>
						    	<h2 class="related-stories">Related Stories</h2>
						    <?php } ?>
						    <div class="paging-posts paging-single-post">
						        <div class="jq-single-paging-slider">
						        <?php related_posts(); ?>
						        </div>
						    </div>
					    <?php endif; ?>
				    <?php endif; ?>
					    <?php sub_footer(); ?> 
						<div class="hr mobile-element"></div>
				    <div class="entry-meta">
				        <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
       
               </div><!-- .entry-meta -->
			   </div><!-- #post -->

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