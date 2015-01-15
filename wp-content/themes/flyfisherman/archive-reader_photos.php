<?php

$dataPos = 0;

get_header();
get_template_part( 'nav', get_post_format() );
imo_community_sidebar();

$string = parse_url($_SERVER[REQUEST_URI]);

$pieces = explode("&", $string["query"]);
$piece1 = $pieces[0]; // piece1
$piece2 = $pieces[1]; // piece2
?>



    <div id="primary" class="page-community">
        <div id="content" role="main" class="general">
			<div id="<?php echo $piece1; ?>" type="<?php echo $piece2; ?>" isFly="yes" data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="posts-list js-responsive-section main-content-preppend">

	             <?php 
				 
				 if($piece2){
					 $args = array(
						   'post_type' => 'reader_photos',
						   'tax_query' => array(
						      'relation' => 'AND',
						      array(
						         'taxonomy' => 'category',
						         'field' => 'slug',
						         'terms' => array( $piece1 )
						      ),
						      array (
						         'taxonomy' => 'category',
						         'field' => 'slug',
						         'terms' => array( $piece2 )
						      )
						   )
						);
					}else{
						$args = array(
						   'post_type' => 'reader_photos',
						   'tax_query' => array(
						      'relation' => 'AND',
						      array(
						         'taxonomy' => 'category',
						         'field' => 'slug',
						         'terms' => array( $piece1 )
						      )
						   )
						);
	
					}	
	             if($piece1){
	             	$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					 	get_template_part( 'content/content-category-reader_photos', get_post_format() ); 
					endwhile;
	             }else{
		             while ( have_posts() ) : the_post(); 
					 	get_template_part( 'content/content-category-reader_photos', get_post_format() ); 
					endwhile;
	             } ?>
	             
	             
	            
	        </div>
            <div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
				<a href="#" class="btn-base paginate-photos">Load More</a>
			    <a href="#" class="go-top jq-go-top">go top</a>
			
			    <img src="/wp-content/themes/imo-mags-parent/images/ajax-loader.gif" id="ajax-loader" style="display:none;"/>
			</div>
        </div><!-- #content -->
    </div><!-- #primary -->
    

<?php get_footer(); ?>