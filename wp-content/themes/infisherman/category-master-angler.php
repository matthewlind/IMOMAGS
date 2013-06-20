<?php
$dataPos = 0;
get_header(); ?>
        <?php imo_sidebar();?>
        <div id="primary" class="general">
            <div id="content" role="main" class="general-frame">
                
                <?php if ( have_posts() ) : ?>
    
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
                        <h1 class="page-title"><?php
                            printf('<span>' . single_cat_title( '', false ) . '</span>' );
                            ?>
                        </h1>
							<!-- Site - In-Fisherman 
							<script type="text/javascript">
							  var ord = window.ord || Math.floor(Math.random() * 1e16);
							  document.write('<iframe src="http://ad.doubleclick.net/N4930/adi/imo.in-fisherman;sz=260x35;camp=master_angler;ord=' + ord + '?" width="260" height="35" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>');
							</script>
							<noscript>
							<a href="http://ad.doubleclick.net/N4930/jump/imo.in-fisherman;sz=260x35;camp=master_angler;ord=[timestamp]?">
							<img src="http://ad.doubleclick.net/N4930/ad/imo.in-fisherman;sz=260x35;camp=master_angler;ord=[timestamp]?" width="260" height="35" />
							</a>
							</noscript>-->
                   </div>
                      
                    <?php if (z_taxonomy_image_url()) echo '<div class="category-img"><img src="'.z_taxonomy_image_url().'" alt="'.single_cat_title( '', false ).'" title="'.single_cat_title( '', false ).'" /></div>'; ?>                    
                    <?php
                    	$category_description = category_description();
                            if ( ! empty( $category_description ) )
                                echo apply_filters( 'category_archive_meta', '<div data-position="'.$dataPos = $dataPos + 1 .'" class="category-archive-meta taxdescription js-responsive-section">' . $category_description . '</div>' );
                        
                        $fetured_slider_query = new WP_Query( 'category_name='.MASTER_ANGLERS.'&posts_per_page=6' ); ?>
		                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="double-posts double-post-slider js-responsive-section">
		                    <div class="jq-slider clearfix">
		                        <ul class="slides-inner slides">
		                            <?php $i = 1  ?>
		                            <?php while ($fetured_slider_query->have_posts()) : $fetured_slider_query->the_post(); ?>
		                            
		                            <?php if (!(($i+1)%2) ): ?>
		                            <li>
		                            <?php endif; ?>
		                            
		                            <div class="feat-post">
		                                <div class="feat-img"><a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('post-home-small-thumb');?></a></div>
		                                <div class="feat-text">
		                                    <div class="clearfix">
		                                    	<?php echo primary_and_secondary_categories(); ?>
		                                    </div>
		                                    <h3><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
		                                    <div class="shares-count">
		                                        <?php render_shares_count(get_permalink(), $post->ID) ?> <span>Shares</span>
		                                    </div>
		                                    <a class="view-post" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">&nbsp;</a>
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

                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="article-brief js-responsive-section ma-info">
                    
	                    <div class="ma-enter">
							<a href="/master-angler/entry-form/" class="btn-base"><span>Enter Now!</span></a>
							
							<div>Want to mail your entry? <a href="http://www.in-fisherman.com/files/2012/02/2012MasterAnglerFP.pdf" target="_blank"><strong>Download a printable form (PDF)</strong></a>
							</div>
	                    </div>
						
						<img src="http://www.in-fisherman.com/files/2011/07/map1.jpeg" alt="map1" title="map1">
					
					
						<h2>ACHIEVEMENT AWARDS</h2>
						<p>Anglers who enter qualifying fish receive a Master Angler patch (one per year) and species chevron.<img style="float:right" src="http://dev.imomags.com/infisherman/files/2011/07/sharvestlogo.jpg" /></p>
						<h2>SELECTIVE HARVEST</h2>
						<p>Selective Harvest is wise conservation of our natural resources. It maintains a tradition of harvesting some fish to eat, as they're nutritious, delicious, and renewable when harvested wisely. Large predators and large panfish must be released to sustain good fishing. Only numerous and smaller fish should be kept.</p>
						<h2>RECOGNITION PIN AND CERTIFICATE</h2>
						<p>In each region, anglers who enter the largest kept or largest released fish of a species receive a Master Angler lapel pin and a parchment certificate suitable for framing.</p>
						<h2>RECOGNITION PLAQUE</h2>
						<p>Anglers who enter a state-record fish qualify for a personalized Master Angler plaque.</p>
					
						<img src="http://www.in-fisherman.com/files/2011/07/species11.jpeg" alt="species1" title="species1" />				
						
						<h2>Rules for 2013</h2>
		
						<ol>
							<li>In-Fisherman readers and television viewers are eligible to apply for Master Angler awards.</li>
							<li>Fish must be taken by angling and in accordance with regulations of the state or province where the fish was caught.</li>
							<li>Each official qualifying fish entry form (or photocopy) must be submitted individually in its own envelope within 30 days of the catch (no exceptions). If fishing alone, the witness verification section may be omitted for released fish. Otherwise, all sections (including a witness) must be completed.</li>
							<li>Each entry must be accompanied by one clear, standard-size, side view photograph (no videos) of the fish, preferably of the angler with the fish. Photographs of released fish must be taken at the catch site (no exceptions). No driveway or baitshop shots for catch &amp; release fish are acceptable. Do not write on the back of photos. Do not use paper clips, tape or staples, since they ruin photos. Entries without photos, and illegible or incomplete entries, will be disqualified and not returned.</li>
							<li>Kept fish must be witnessed, and weighed on a certified scale.</li>
							<li>Measure released fish from the tip of the nose (with mouth closed) to the tip of the tail. Quickly photograph and release the fish. Don't hang fish to be released on a scale; impale them on a gaff, or place them on a stringer. Fish showing signs of improper handling will be disqualified.</li>
							<li>Include a brief description of how the fish was caught.</li>
							<li>Entry and photograph become the property of In-Fisherman with publication and television rights. We are not responsible for lost or mis- placed entries. Photos cannot be returned.</li>
							<li>The awards program runs from Jan. 1 to Dec. 31, 2013. Entries must be received by Jan. 15, 2014, to qualify for the 2013 program.</li>
							<li>Each entry is reviewed by the awards commit- tee whose decision is final.</li>
							<li>For each species, only one kept and two released fish may be entered during the awards program year (no upgrading allowed).</li>
							<li>Each entry must be mailed by angler catching fish and not by guide service or fishing lodge.</li>
						</ol>
		
					</div>
				
					<div class="ma-enter" style="padding-top:20px;">
						<a href="/master-angler/entry-form/" class="btn-base"><span>Enter Now!</span></a>
						
						<div>Want to mail your entry? <a href="http://www.in-fisherman.com/files/2012/02/2012MasterAnglerFP.pdf" target="_blank"><strong>Download a printable form (PDF)</strong></a>
						</div>
                    </div>
                    </div>
					<!--<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="filter-by jq-filter-by js-responsive-section">               
                        <strong>filter by:</strong>
                        <ul class="filter-links">
                            <li><a href="#">Latest</a></li>
                            <li><a href="#">Most Viewed</a></li>
                            <li><a href="#">Most Discussed</a></li>
                            <li><a href="#">Most Shared</a></li>
                        </ul>
                    </div>-->
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="js-responsive-section main-content-preppend">
						
                        <?php /* Start the Loop */ 
                        //query_posts('category_name=master-angler&offset=6');
                        $i = 1; while ( have_posts() ) : the_post(); ?>
        
                            <?php
                                /* Include the Post-Format-specific template for the content.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'content/content', get_post_format() );
                            ?>

                       <?php if ( (($i - (($paged -1) * 2 ))%6) == 0 ): ?>
	                        <?php if ( mobile() ){ ?>
	                        <div class="image-banner posts-image-banner">
	                            <?php imo_dart_tag("300x250",array("pos"=>"mob")); ?> 
	                        </div>
	                        <?php } ?>
                        <?php endif;?>
        
                        <?php $i++; endwhile; ?>        
                    </div>
    
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
                        <a href="#" class="btn-base">Load More</a>
                        <div class="next-link" style="display:none;"><?php next_posts_link(); ?></div>
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
                    <div class="fb-like" data-href="http://www.facebook.com/InFisherman" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
                     <?php social_networks(); ?>
                </div>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                
                <a href="/newsletter-signup" class="get-newsletter">Get the In-Fisherman <br />Newsletter</a>
                <a href="<?php print SUBS_LINK;?>" class="subscribe-banner">                                        
                	<img src="<?php bloginfo('template_directory'); ?>/images/pic/subscribe-banner.jpg" alt="" />
                </a>
                <a href="#" class="back-top jq-go-top">back to top</a>
                
            </div><!-- #content -->
        </div><!-- #primary -->
<?php get_footer(); ?>