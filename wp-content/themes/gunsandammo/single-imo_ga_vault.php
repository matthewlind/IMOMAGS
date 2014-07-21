<?php get_header(); ?>
    <div class="inner-main">
		<div id="primary">
            <div id="content" role="main">
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="facts-header clearfix js-responsive-section">
		            <h1>G&A Vault</h1><span>Instantly increase your gun knowledge</span>
					<div class="sponsor"><?php echo get_imo_dart_tag("240x60",1,false,array("page"=>"ga_vault","sect"=>"ga_vault")); ?></div>
				</div>
                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="facts js-responsive-section">
				    <?php while ( have_posts() ) : the_post(); ?>
						<?php the_post_thumbnail('list-thumb'); ?>
						<p><?php the_content(); ?></p>
					<?php endwhile; ?>
					<div class="fact-share">
						<a class="facebook-share" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>"><img src="/wp-content/themes/gunsandammo/images/facts/share-button.png" alt="share-button" width="" height="" />Share</a>
						<a class="twitter-share" href="http://twitter.com/share?text=<?php the_permalink(); ?>"><img src="/wp-content/themes/gunsandammo/images/facts/tweet.png" alt="tweet" width="" height="" />Tweet</a>						
						<a href="/ga-vault" class="next-fact">Next</a>
					</div>
				</div>
				
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="facts-footer js-responsive-section">
		        	<ul>
		        		<li class="widgets"><?php imo_dart_tag("300x250"); ?></li>
		        		<li class="widgets">
		        			<h3>Related Stories</h3>
							<div class="fancy">
								<ul>
									<?php $related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 9, 'post__not_in' => array($post->ID) ) );
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
        </div><!-- #primary -->
        
    </div>
<?php get_footer(); ?>