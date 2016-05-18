<?php

$dataPos = 0;

get_header('redesign');
get_template_part( 'nav', get_post_format() );
//imo_sidebar();

$is_home_cat= true;
$string 	= parse_url($_SERVER[REQUEST_URI]);
$term 		= $string["query"];

$args = array(
	'post_type' => 'reader_photos',
	'tax_query' => array(
		'relation' => 'AND',
		
		array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => array( $term )
		)
	)
);
?>

<div id="sections_wrap" class="sections-wrap">
	<section class="section-latest-posts">
		<div id="l_container" class="section-inner-wrap">
			<h1 class="main-h"><?php echo $this_cat_name;?></h1>
			
			<?php	
				$loop = new WP_Query( $args );		
	            if($term){
	             	
	             	if ( $loop->have_posts() ) { ?>
	             		<ul id="latest_list" class="c-list">
		             		
						<?php while ( $loop->have_posts() ) { $loop->the_post(); ?>
						 	<li class="dif-post post">
							    <div class="feat-img">
							        <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb'); ?></a>
							    </div>
							    <div class="dif-post-text">
							        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							        <div class="profile-panel">
							            <div class="profile-data">
							                <ul class="prof-like">
							                	<li>
							                		<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
							                   </li>
							                </ul>
							            </div>
							        </div>
							        <?php if(in_category("master-angler")){ ?><span class="badge"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pic/badge-ma.png" alt="Master Angler" /></span><?php } ?>
							    </div>
							</li> 
						<?php } ?>
	             		</ul>
					<?php } else { ?>

						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title">No one has submitted a photo for <span style="text-transform:capitalize;font-size:1.2em;"><?php echo str_replace("-", " ", $term ); ?></span> yet.</h1>
								<p>Be the first to post one!</p>
								<label class="upload-button"><a href="/post-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a></label>
							</header><!-- .entry-header -->
		
						</article><!-- #post-0 -->
						
					<?php }
					
					
	            } else {
	             	
		            while ( have_posts() ) : the_post(); 
					 	get_template_part( 'content/content-category-reader_photos', get_post_format() ); 
					endwhile; ?>
					</div>
		            <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
					    <a href="#" class="btn-base paginate-photos">Load More</a>
					    <a href="#" class="go-top jq-go-top">go top</a>
					
					    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
					</div>
				<?php } ?>

				
				
				

			<div id="btn_more_posts" class="btn-lg"  data-post-not="" data-cat="<?php echo $this_cat_id;?>">
				<span>Show More</span>
				<div class="loader-anim dnone">
					<div class="line-spin-fade-loader">
						<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
					</div>
				</div>
			</div><!-- .btn-lg -->	
		</div>
	</section>
	<section id="section_loader">
		<div class="ball-grid-pulse clearfix">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
	</section>
	
	
	
	
	
	
	
	
	
	
    <div id="primary" class="page-community">
        <div id="content" role="main" class="general">
			<div id="<?php echo $term; ?>" data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">
				<?php if($term == "memories"){ ?>
					<div class="memories-promo" style="background:url(<?php echo get_field("memories_background", "options"); ?>) no-repeat;">
						<h2><?php echo get_field("memories_header", "options"); ?></h2>
						<p><?php echo get_field("memories_copy", "options"); ?></p>
					</div>
					
				<?php } ?>
				<?php		
	            $loop = new WP_Query( $args );		
	            if($term){
	             	
	             	if ( $loop->have_posts() ) :
						while ( $loop->have_posts() ) : $loop->the_post();
						 	get_template_part( 'content/content-category-reader_photos', get_post_format() ); 
						endwhile; ?>
			</div>
            <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
			    <a href="#" class="btn-base paginate-photos">Load More</a>
			    <a href="#" class="go-top jq-go-top">go top</a>
			
			    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
			</div>

					<?php else : ?>

						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title">No one has submitted a photo for <span style="text-transform:capitalize;font-size:1.2em;"><?php echo str_replace("-", " ", $term ); ?></span> yet.</h1>
								<p>Be the first to post one!</p>
								<label class="upload-button"><a href="/post-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a></label>
							</header><!-- .entry-header -->
		
						</article><!-- #post-0 -->
						
					<?php endif; 
					
					
	             }else{
	             	
		            while ( have_posts() ) : the_post(); 
					 	get_template_part( 'content/content-category-reader_photos', get_post_format() ); 
					endwhile; ?>
					</div>
		            <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
					    <a href="#" class="btn-base paginate-photos">Load More</a>
					    <a href="#" class="go-top jq-go-top">go top</a>
					
					    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
					</div>
				<?php } ?>
	             
	             
	            
        </div><!-- #content -->
    </div><!-- #primary -->
    
</div>

<?php get_footer('redesign'); ?>