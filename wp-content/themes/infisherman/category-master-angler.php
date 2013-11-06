<?php
//Gallery Scripts
wp_enqueue_script('flexslider-js',plugins_url('imo-flex-gallery/jquery.flexslider.js'));
wp_enqueue_style('flexslider-css',plugins_url('imo-flex-gallery/flexslider.css'));
wp_enqueue_script('flex-gallery-js',plugins_url('imo-flex-gallery/flex-gallery.js'));
wp_enqueue_script('jquery-mobile',plugins_url('imo-flex-gallery/jquery.mobile.custom.min.js'));
wp_enqueue_script('jquery-ui-slide-effect',plugins_url('imo-flex-gallery/jquery-ui-slide-effect.min.js'));
wp_enqueue_script('jquery-scrollface',plugins_url('imo-flex-gallery/jquery.scrollface.min.js'));
wp_enqueue_script('jquery-buffet',plugins_url('imo-flex-gallery/jquery.buffet.min.js'));
wp_enqueue_script('jquery-mousewheel',plugins_url('imo-flex-gallery/jquery.mousewheel.min.js'));
wp_enqueue_script('perfect-scrollbar-js',plugins_url('imo-flex-gallery/perfect-scrollbar-0.4.3.with-mousewheel.min.js'));
wp_enqueue_style('ajax-gallery-css',plugins_url('imo-flex-gallery/flex-gallery.css','imo-flex-gallery'));
wp_enqueue_style('perfect-scrollbar-css',plugins_url('imo-flex-gallery/perfect-scrollbar-0.4.3.min.css'));

$dataPos = 0;
get_header(); ?>
        <?php imo_sidebar("landing");?>
        <div id="primary" class="general">
            <div id="content" role="main" class="general-frame">

                <?php if ( have_posts() ) : ?>

                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
                        <h1 class="page-title"><?php
                            printf('<span>' . single_cat_title( '', false ) . '</span>' );
                            ?>
                        </h1>
						<div class="sponsor"><?php //imo_dart_tag("240x60"); ?></div>
                   </div>

                    <?php if (z_taxonomy_image_url()) echo '<div class="category-img"><img src="'.z_taxonomy_image_url().'" alt="'.single_cat_title( '', false ).'" title="'.single_cat_title( '', false ).'" /></div>'; ?>
                    <?php
                    	$category_description = category_description();
                            if ( ! empty( $category_description ) )
                                echo apply_filters( 'category_archive_meta', '<div data-position="'.$dataPos = $dataPos + 1 .'" class="category-archive-meta taxdescription js-responsive-section">' . $category_description . '</div>' ); ?>
	                <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="js-responsive-section">
	                	<?php echo do_shortcode('[imo-slideshow community=true gallery=master-angler]'); ?>
					</div>

                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="article-brief js-responsive-section ma-info">

	                    <div class="ma-enter">
							<a href="/photos/new#master" class="btn-base"><span>Enter Now!</span></a>

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
						<a href="/photos/new#master" class="btn-base"><span>Enter Now!</span></a>

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
                    <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" id="ma-entries" class="js-responsive-section main-content-preppend"></div>
							
						<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
	                    <a href="#" class="btn-base load-more" style="display:block;">Load More</a>
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
               <?php social_footer(); ?>
               <a href="#" class="back-top jq-go-top">back to top</a>

            </div><!-- #content -->
        </div><!-- #primary -->
<?php get_footer(); ?>