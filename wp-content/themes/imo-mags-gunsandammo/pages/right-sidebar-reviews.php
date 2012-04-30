<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post(); 

?>

<div class="page-template-page-right-php right-sidebar-landing">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('homepage-sidebar')) : else : ?><?php endif; ?>
	</div>
	<div id="content">
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
					<form action="<?php $_SELF['REQUEST_URI']; ?>" method="post" id="form" class="reviews-form">

					<select class="guntype reviews-select">
							<option selected="selected" name="guntype" value="">Type</option>
							<?php
							$parents = array('parent' => 0);
							$terms = get_terms("guntype", $parents);
 							$count = count($terms);
 							if ( $count > 0 ){
								foreach ( $terms as $term ) {
       								echo "<option value=".$term->slug.">" . $term->name . "</option>";
        						}
							}
							?>
						</select>
						<!-- disabled="disabled" -->
						<select name="manufacturer" class="manufacturer reviews-select" value="">
							<option selected="selected" name="Manufacturer" value="">Manufacturer</option> 
							<?php
							$terms = get_terms("manufacturer");
 							$count = count($terms);
 							if ( $count > 0 ){
								foreach ( $terms as $term ) {
       								echo "<option value=".$term->slug.">" . $term->name . "</option>";
        						}
							}
							?>
						</select>
						<select class="caliber reviews-select">
							<option selected="selected" name="caliber" value="">Caliber</option>
							<option name="null" value="">Choose a Manufacturer</option>
							<?php include('/wp-content/themes/imo-mags-gunsandammo/ajax_caliber.php'); ?>
						</select>
						<?php
						/* 
						**
						** Add Alerts
						*/
						?>
						</form>
					</div>
				</div>

				<div class="reviews-section">
				
				<?php

				// Latest Reviews default
					$args = array(
						'post_type' => 'reviews',
	    				'posts_per_page' => 9,
						'orderby' => 'date',
						'order' => 'DESC'
					);		


    				$query = new WP_Query( $args );
					while ( $query->have_posts() ) : $query->the_post(); ?>
						<article class="post type-post status-publish format-standard hentry category-news-brief entry entry-excerpt has-img">
						<?php if(has_post_thumbnail()){ ?>
							<a class="thumbnail-link" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); ?></a>
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

<?php get_footer(); ?>