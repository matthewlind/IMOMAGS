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
            	
	             <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="featured-area clearfix js-responsive-section">
	                <div class="section-title posts">
					    <h2 class="">
					        <div class="icon"></div>
					        <span>Shooting</span> 
					    </h2>
					</div>
					<div class="addthis-below" <?php if(mobile()){ echo 'style="width: 320px;"'; } ?>><?php if (function_exists('imo_add_this')) {imo_add_this();} ?></div>
	                <div class="clearfix">
	                    <ul>
	                   	 	<?php if( function_exists('showFeaturedList') ){ echo showFeaturedPosts(array('set_id' => 5)); } ?>
	                   	</ul>
	                </div>
	            </div>
	           
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
                    	
							<?php if( function_exists('showFeaturedList') ){ echo showFeaturedPosts(array('set_id' => $term['featured'] )); } ?>                
					</div>
					
                    <div class="ga-lists-list">
	                    <div class="fancy">
							<ul>
								<?php $slug = 'featured';
								$category = get_category_by_slug($slug);
								
								$lists_query = new WP_Query( 'category_name=' . $value->slug . '&posts_per_page=8&cat=-' . $category->cat_ID );                     
								while ($lists_query->have_posts()) : $lists_query->the_post(); ?>			
									<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php $i++; endwhile; ?>
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
