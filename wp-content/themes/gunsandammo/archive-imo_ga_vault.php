<?php
$dataPos = 0;
get_header(); ?>
    <div id="content" role="main">
    	<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="clearfix js-responsive-section">
            <h1><?php post_type_archive_title(); ?></h1>
			<div class="sponsor"><?php imo_ad_placement("sponsor_logo_240x60"); ?></div>
		</div>
		<?php $query = new WP_Query( array ( 'post_type' => 'imo_ga_vault', 'orderby' => 'rand', 'posts_per_page' => '1' ) );
			if ( $query->have_posts() ) : 
				while ( $query->have_posts() ) : $query->the_post(); 
					$postID = $post->ID; ?>
					<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="facts js-responsive-section" title="<?php the_title(); ?>" slug="<?php echo $post->post_name; ?>">
						<?php the_post_thumbnail('list-thumb'); ?>
						<?php the_content(); ?>
						<div class="fact-share">
							<a class="facebook-share" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>"><img src="/wp-content/themes/gunsandammo/images/facts/share-button.png" alt="share-button" width="" height="" />Share</a>
							<a class="twitter-share" href="http://twitter.com/share?text=<?php the_permalink(); ?>"><img src="/wp-content/themes/gunsandammo/images/facts/tweet.png" alt="tweet" width="" height="" />Tweet</a>						
							<a href="/ga-vault" class="next-fact">Next</a>
						</div>
					</div>
				<?php endwhile;
		wp_reset_postdata(); 
		endif; ?>
		
        <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="facts-footer js-responsive-section">
		        	<ul>
		        		<li class="widgets"><?php imo_ad_placement("btf_medium_rectangle_300x250"); ?></li>
		        		<li class="widgets">
		        			<h3>Related Stories</h3>
							<div class="fancy">
								<ul>
									<?php $related = get_posts( array( 'category__in' => wp_get_post_categories($postID), 'numberposts' => 9, 'post__not_in' => array($postID) ) );
											if( $related ) foreach( $related as $post ) {
												setup_postdata($post); ?>
												<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
											<?php }
											wp_reset_postdata(); ?>
								</ul>
							</div>
		        		</li>
		        		<li class="widgets"><?php echo the_widget("imo\SubscribeWidget"); ?></li>
		        	</ul>
		        </div>

	</div><!-- #content -->
<?php get_footer(); ?>