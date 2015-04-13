<?php

$dataPos = 0;

get_header();
get_template_part( 'nav', get_post_format() );
imo_community_sidebar();


$string = parse_url($_SERVER[REQUEST_URI]);
$term = $string["query"];

$args = array(
   'post_type' => 'rack_room',
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
    <div id="primary" class="page-community">
        <div id="content" role="main" class="general">
			<div id="<?php echo $term; ?>" data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">

	           <?php		
	           $loop = new WP_Query( $args );		
	           if($term){
	             	
	             	if ( $loop->have_posts() ) :
						while ( $loop->have_posts() ) : $loop->the_post();
						 	get_template_part( 'content/content-category-reader_photos', get_post_format() ); 
						endwhile;
					else : ?>

						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title">No one has submitted a photo for <span style="text-transform:capitalize;font-size:1.2em;"><?php echo $term; ?></span> yet.</h1>
								<p>Be the first to post one!</p>
								<label class="upload-button"><a href="/post-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a></label>
							</header><!-- .entry-header -->
		
						</article><!-- #post-0 -->
		
					<?php endif; 
	             }else{
	             	
		            while ( have_posts() ) : the_post(); 
					 	get_template_part( 'content/content-category-reader_photos', get_post_format() ); 
					endwhile;

	             } ?>
	             
	             
	            
	        </div>
	        <?php if ( $loop->have_posts() || have_posts() ) : ?>
	            <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
				    <a href="#" class="btn-base paginate-photos">Load More</a>
				    <a href="#" class="go-top jq-go-top">go top</a>
				
				    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
				</div>
			<?php endif; ?>
        </div><!-- #content -->
    </div><!-- #primary -->
    

<?php get_footer(); ?>