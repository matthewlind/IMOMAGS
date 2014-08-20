<?php
/**
 * Template Name: Reviews Page
 * Description: A Page Template for G&A Reviews Page.
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
 
$dataPos = 0;
$features = get_field('reviews_featured','options' ); 
get_header();
imo_sidebar(); ?>
<div id="primary" class="general">
    <div class="general-frame">
        <div id="content" role="main">
             
             <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area page-header clearfix js-responsive-section">
                <div class="section-title posts">
				    <h2 class="">
				        <div class="icon"></div>
				        <span>Proofhouse - Reviews</span> 
				    </h2>
				</div>
				<?php if(function_exists('wpsocialite_markup')){ wpsocialite_markup(); } ?>                
				<div class="clearfix">
					<?php if( $features ): ?>
	                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area clearfix js-responsive-section">
	                    <div class="clearfix">
	                        <ul>
	                       	 	<?php foreach( $features as $feature ): 
	                       	 		$title = $feature->post_title;
	                       	 		$url = $feature->guid;
									$thumb = get_the_post_thumbnail($feature->ID, "list-thumb");
									$tracking = "_gaq.push(['_trackEvent','Special Features Reviews','$title','$url']);"; ?>
		                       	 	<li class="home-featured" featured_id="<?php echo $feature->ID ?>">
		                                <div class="feat-post">
		                                    <div class="feat-img"><a href="<?php echo $url; ?>" onclick="<?php echo $tracking; ?>"><?php echo $thumb; ?></a></div>
		                                    <div class="feat-text">
		                                    	<div class="clearfix">
			                                    	<h3><a href="<?php echo $url; ?>" onclick="<?php echo $tracking; ?>"><?php echo $title; ?></a></h3>
		                                    	</div>
			                                </div>
			                                <div class="feat-sep"><div></div></div>
			                            </div>
			                         </li>
								<?php endforeach; ?>
	                       	</ul>
	                    </div>
	                </div>
                <?php endif; ?>

                </div>
            </div>

        	<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list page-header js-responsive-section main-content-preppend">
	
				<div class="section-title posts">
					<h2 class="reviews-form-header">
						<div class="icon"></div>
						<span>Filter Reviews</span> 
					</h2>
					<form action="<?php $_SELF['REQUEST_URI']; ?>" method="post" id="form" class="reviews-form">
						<div class="review-select1">
							<select class="guntype reviews-select reviews-select-guntype">
									<option selected="selected" name="guntype" value="">Type</option>
									<?php
									$parents = array('parent' => 0);
									$terms = get_terms("guntype", $parents);
		 							$count = count($terms);
		
		 							
		
		
		 							if ( $count > 0 ){
										foreach ( $terms as $term ) {
											$termName = str_replace(" Reviews","",$term->name);
		       								echo "<option value=".$term->slug.">" . $termName . "</option>";
		        						}
									}
									?>
							</select>
						</div>
						<div class="review-select2">
							<select name="manufacturer" class="manufacturer reviews-select reviews-select-manufacturer" value="">
								<option selected="selected" name="Manufacturer" value="">Manufacturer</option> 
								<?php
								$terms = get_terms("manufacturer",array("parent" => 0));
	 							$count = count($terms);
	 							if ( $count > 0 ){
									foreach ( $terms as $term ) {
	       								echo "<option value=".$term->slug.">" . $term->name . "</option>";
	        						}
								}
								?>
							</select></div>
							<div class="review-select3">
							<select class="caliber reviews-select reviews-select-caliber">
								<option selected="selected" name="caliber" value="">Caliber</option>
								<option name="null" value="">Choose Manufacturer First...</option>
							</select>
						</div>
					</form>
				</div>
	
				<div class="reviews-section">
	
					<div class="reviews-cover" style="display:none;"></div>
					<div class="reviews-container">
					<?php
						
					// Latest Reviews default
						$args = array(
							'post_type' => 'reviews',
		    				'posts_per_page' => 25,
							'orderby' => 'date',
							'order' => 'DESC'
						);		
		
						
						$query = new WP_Query( $args );
						while ( $query->have_posts() ) : $query->the_post(); ?>
							<div class="<?php the_ID(); ?> post article-brief clearfix">
								<a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb'); ?></a>
								<div class="article-holder">
								    <div class="clearfix">
								        <?php 
								           // if(function_exists('primary_and_secondary_categories')){
								            	//echo primary_and_secondary_categories(); 
								           // }                                
								        ?>
								    </div>
								    <h3 class="entry-title">
								        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
								    </h3>
								   <a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
								    <div class="entry-content">
								        <?php the_excerpt(); ?>
								        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
								    </div>
								</div>
							</div>
							<?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>
							<?php if ( mobile() ){ ?>
							<div class="image-banner posts-image-banner">
							    <?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>	
							</div>
							<?php } ?>
							<?php endif;?>
						
						<?php endwhile;
						// Reset Post Data
						wp_reset_postdata();
						
							
							
							wp_link_pages(); ?>
							
					</div>
				</div>
        	</div>
	 	</div><!-- #content -->
    </div><!-- .general-frame -->
</div><!-- #primary -->
<?php get_footer(); ?>
