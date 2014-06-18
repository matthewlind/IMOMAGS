<?php
/**
 * Template Name: Topics Page
 * Description: A Page Template for G&A Topics Page.
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

$term['title'] = "G&A Lists";
$term['slug'] = "ga-lists";
$term['featured'] = 3;

$shootingTerms[] = $term;

$term['title'] = "Personal Defense";
$term['slug'] = "personal-defense";
$term['featured'] = 6;

$shootingTerms[] = $term;

$term['title'] = "Ammo";
$term['slug'] = "ammo";
$term['featured'] = 7;

$shootingTerms[] = $term;

$term['title'] = "Reloading";
$term['slug'] = "reloading";
$term['featured'] = 8;

$shootingTerms[] = $term;

$term['title'] = "Tips & Tactics";
$term['slug'] = "tips-tactics";
$term['featured'] = 9;

$shootingTerms[] = $term;

$term['title'] = "How To";
$term['slug'] = "how-to";
$term['featured'] = 10;

$shootingTerms[] = $term;

$term['title'] = "Second Amendment";
$term['slug'] = "second-amendment";
$term['featured'] = 11;

$shootingTerms[] = $term;

$term['title'] = "Gunsmithing";
$term['slug'] = "gunsmithing";
$term['featured'] = 12;

$shootingTerms[] = $term;

$term['title'] = "Military & Law";
$term['slug'] = "military-law-enforcement";
$term['featured'] = 13;

$shootingTerms[] = $term;

get_header();
imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            	
	            	           
	            <?php foreach($shootingTerms as $term){ ?>
	            <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
	            	
                 	<div class="section-title posts">
					    <h2 class="">
					        <div class="icon"></div>
					        <span>
					        <?php echo $term['title']; ?>
					        </span> 
					    </h2>
					</div>
				
                    <div class="ga-lists-featured">
                    	<?php $featured_query = new WP_Query( 'category_name=' . $term['slug'] . '&posts_per_page=1');                    
						while ($featured_query->have_posts()) : $featured_query->the_post(); ?>	
	                    	<li class="home-featured">
	                        	<div class="feat-post">
                                    <div class="feat-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("list-thumb"); ?></a></div>
                                    <div class="feat-text">
                                    	<div class="clearfix">
	                                    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    	</div>
									</div>
									<div class="feat-sep"><div></div></div>
								</div>
	                       </li>
						<?php $i++; endwhile; wp_reset_postdata(); ?>
					</div>
					
                    <div class="ga-lists-list">
	                    <div class="fancy">
							<ul>
								<?php $lists_query = new WP_Query( 'category_name=' . $term['slug'] . '&posts_per_page=8&offset=1');                     
								while ($lists_query->have_posts()) : $lists_query->the_post(); ?>			
									<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php $i++; endwhile; wp_reset_postdata(); ?>
							</ul>
						</div>
						<hr class="cfct-div-solid">
						<a class="cta" href="/<?php echo $term['slug']; ?>/">See More <?php echo $term['title']; ?><span></span></a>
                    </div> 
                </div>
			<?php } ?>
				

			</div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>
