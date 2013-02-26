<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post(); 

?>

<div class="page-template-page-right-php right-sidebar-landing">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('reviews-sidebar')) : else : ?><?php endif; ?>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php if (function_exists("imo_dart_tag")) {
	            imo_dart_tag("300x250");
	          } else { ?>
	            <script type="text/javascript">
	              document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.'+dartadsgen_site+'/;sect=;page=index;pos=btf;subs=;sz=728x90;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
	            </script>
	            <script type="text/javascript">
	              ++pr_tile;
	            </script>
	            <noscript>
	              <a href="http://ad.doubleclick.net/adj/imo.outdoorsbest/;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?">
	                <img src="http://ad.doubleclick.net/ad/imo.outdoorsbest/home;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?" border="0" />
	              </a>
	            </noscript>
	          <?php } ?>

			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
		</div>
	</div>
	<div id="content">
		<h1 class="seo-h1">Reviews</h1>
		<div <?php post_class('entry entry-full'); ?>>
			<div class="entry-content">
				<div class="cfct-module cfct-html section-title posts">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
  								<span>Reviews</span>
						</h4>
					</div>
				</div>
				<?php				
				the_content(__('Continued&hellip;', 'carrington-business')); ?>
				<div class="cfct-module cfct-html section-title posts">
					<div class="cfct-mod-content">
						<h4 class="reviews-form-header">
 							<div class="icon"></div>
  								<span>Filter Reviews</span> 
						</h4>
						<script>
						
						</script>
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
						</select></div>
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
						</select></div>
						</form>
					</div>
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
							<article class="post type-post status-publish format-standard hentry category-news-brief entry entry-excerpt has-img">
							<?php if(has_post_thumbnail()){ ?>
								<a<?php if( get_post_type() == 'imo_video' || in_category('video') ){echo ' class="video-excerpt"';} ?> class="thumbnail-link" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); if( get_post_type() == 'imo_video' || in_category('video') ){echo '<span></span>';} ?></a>
							<?php } ?>
							<div class="entry-summary">
		  						<span class="entry-category">
		    						<span class="review-date" style="color:#CE181E;"><?php the_time('F jS, Y') ?></span>
		    					</span>
		    					<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p class="review-excerpt"><?php the_excerpt(); ?></p>
							</div>
	  
	  						<a class="comment-count" href="<?php comments_link(); ?>"><?php echo get_comments_number(); ?></a>


							</article>		
								
						<?php endwhile;
						// Reset Post Data
						wp_reset_postdata();
				
					
					
					wp_link_pages(); ?>
					
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>