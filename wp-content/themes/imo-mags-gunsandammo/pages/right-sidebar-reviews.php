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
						<h4>
 							<div class="icon"></div>
  								<span>Latest Reviews</span> 
						</h4>
				<form action="?" method="post" id="form">

				Filter: 
						

						<select>
							<option name="guntype" value="">Type</option>
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
						<select name="manufacturer" value="">
							<option name="" value="">Manufacturer</option> 
							<?php
							$terms = get_terms("manufacturer");
 							$count = count($terms);
 							if ( $count > 0 ){
								foreach ( $terms as $term ) {
       								echo "<option name=".$term->name." value=".$term->term_id.">" . $term->name . "</option>";
        						}
							}
							?>
						</select>
						<select>
							<option name="caliber" value="">Caliber</option>
							<?php
							$id = 171; //replace with javascript: $term->term_id from above when value is assigned.
							$taxonomyName = 'manufacturer';
							$termchildren = get_term_children( $id, $taxonomyName );
 							foreach ($termchildren as $child) {
								$term = get_term_by( 'id', $child, $taxonomyName );
       								echo "<option value=".$term->slug.">" . $term->name . "</option>";
        					}
							
							?>
						
						</select>
						<input name="submit" type="submit" value="Submit" />
						<?php
						/* 
						** Run $_POST query with above 'value' attributes.
						** Remember to use term_id for manufacturer.
						** 
						** Add inline AJAX.
						** Add Alerts
						*/
						?>
						
					</div>
				</div>

				
				</form>
				<?php
				
				if(isset($_POST['submit']) && $_POST['manufacturer'] != '' || $_POST['guntype'] != ''){
					echo $_POST['manufacturer'];
					/* Print results based on query.
					** 	---> $args will have to be variables that are 
					**	---> replaced by $_POST values.
					*/
					
					// Get values from post fields
					$guntype = $_POST['guntype'];
					$manufacturer = $_POST['manufacturer'];
					$caliber = $_POST['caliber'];
					
					$args = array(
					
    				'post_type' => 'reviews',
    				'multiple_terms' => array('guntype' => "'".$guntype."'", 'manufacturer' => "'".$manufacturer."'", 'caliber' => "'".$caliber."'"),
    				'posts_per_page' => 9,
					'orderby' => 'date',
					'order' => 'DESC'
					);		

					$query = new WP_Query( $args );
						
					while ( $query->have_posts() ) : $query->the_post(); ?>
						<article class="post type-post status-publish format-standard hentry category-news-brief entry entry-excerpt has-img">
					<?php if(has_post_thumbnail()){ ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); ?></a>
					<?php } ?>
					<div class="entry-summary">
	  					<span class="entry-category">
	    					<span style="color:#CE181E;"><?php the_time('F jS, Y') ?></span>
	    				</span>
	    				<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php the_excerpt(); ?></p>
					</div>
  
  					<a class="comment-count" href="<?php comments_link(); ?>"><?php echo get_comments_number(); ?></a>

					</article>			
					<?php endwhile;
					// Reset Post Data
					wp_reset_postdata();
				
					
				// Latest Reviews default
				}else{ 
					$args = array(
					
    				'post_type' => 'reviews',
    				'posts_per_page' => 9,
					'orderby' => 'date',
					'order' => 'DESC'
					);		

					
    				$query = new WP_Query( $args );
					while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php foreach($query as $que){ echo $que->guid; } ?>
						<article class="post type-post status-publish format-standard hentry category-news-brief entry entry-excerpt has-img">
						<?php if(has_post_thumbnail()){ ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(190,120), array('class' => 'entry-img')); ?></a>
						<?php } ?>
						<div class="entry-summary">
	  						<span class="entry-category">
	    						<span style="color:#CE181E;"><?php the_time('F jS, Y') ?></span>
	    					</span>
	    					<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php the_excerpt(); ?></p>
						</div>
  
  						<a class="comment-count" href="<?php comments_link(); ?>"><?php echo get_comments_number(); ?></a>

						</article>		
							
					<?php endwhile;
					// Reset Post Data
					wp_reset_postdata();
					
					
					}
				
				wp_link_pages(); ?>
				
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>