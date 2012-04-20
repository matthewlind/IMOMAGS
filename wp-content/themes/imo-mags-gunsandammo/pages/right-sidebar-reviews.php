<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post(); ?>

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
				<form>
				Filter: 
						

						<select>
							<option name="guntype" value="">Type</option>
							<?php
							$parents = array('parent' => 0);
							$terms = get_terms("guntype", $parents);
 							$count = count($terms);
 							if ( $count > 0 ){
								foreach ( $terms as $term ) {
       								echo "<option value=".$term->name.">" . $term->name . "</option>";
        						}
							}
							?>
						</select>
						<!-- disabled="disabled" -->
						<select>
							<option name="manufacturer" value="">Manufacturer</option> 
							<?php
							$terms = get_terms("manufacturer");
 							$count = count($terms);
 							if ( $count > 0 ){
								foreach ( $terms as $term ) {
       								echo "<option value=".$term->term_id.">" . $term->name . "</option>";
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
       								echo "<option value=".$term->name.">" . $term->name . "</option>";
        					}
							
							?>
						
						</select>
						<input type="submit" value="Submit" />
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
				
					/* Print results based on query.
					** 	---> $args will have to be variables that are 
					**	---> replaced by $_POST values.
					*/
					
					// Reviews based on filter type
					$args = array(
 					'post_type' => 'reviews',
 					'tax_query' => array(
						'relation' => 'OR',
							array(
							'taxonomy' => 'guntype',
							'field' => 'slug',
							'terms' => array( 'handgun' )
							),
							array(
							'taxonomy' => 'manufacturer',
							'field' => 'slug',
							'terms' => array( 'benelli' )
							)
						)
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
  
  					<a class="comment-count" href="http://www.gunsandammo.fox/2012/04/12/introducing-the-smith-wesson-mp-shield/#comments"><?php echo get_comments_number(); ?></a>

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
					
					
					$tax = array(
 					'post_type' => 'reviews',
 					'tax_query' => array(
						'relation' => 'OR',
							array(
							'taxonomy' => 'guntype',
							'field' => 'slug',
							'terms' => array( 'handgun' )
							),
							array(
							'taxonomy' => 'manufacturer',
							'field' => 'slug',
							'terms' => array( 'benelli' )
							)
						)
					); 	
					
					global $wpdb;
					$querystr = "
    SELECT * 
    FROM $wpdb->posts
    LEFT JOIN $wpdb->term_relationships ON($wpdb->posts.ID = $wpdb->term_relationships.object_id)
    LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
    LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
    WHERE $wpdb->posts.post_type = 'reviews' 
    AND $wpdb->posts.post_status = 'publish'
    AND $wpdb->term_taxonomy.taxonomy = 'guntype'
    AND $wpdb->terms.slug = 'handgun'
    ORDER BY $wpdb->posts.post_date DESC
    LIMIT 10
    ";
    

					$results = $wpdb->get_results($querystr, OBJECT);
					var_dump($results);
						foreach($results as $result){
							echo '<li>';
							//echo $result->title;
							
							echo '</li>';
						}
					
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
  
  						<a class="comment-count" href="http://www.gunsandammo.fox/2012/04/12/introducing-the-smith-wesson-mp-shield/#comments"><?php echo get_comments_number(); ?></a>

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