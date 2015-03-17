<?php
	echo get_template_part( 'header', 'shoot101' );
	// The opening class in the header is .scroller-inner
	$parrent_id = wp_get_post_parent_id( $post_ID ); 
	$post_slug = $post->post_name;
	
	$cat = get_category( get_query_var( 'cat' ) );
	$cat_slug = $cat->slug;
	$cat_name = $cat->cat_name;
?>


<div class="content clearfix">
	
	
	<?php
	// WP_Query arguments
	$args = array (
		'cat'                    	=> '3020',
		'category_name'         	=> 'shoot101',
		'posts_per_page'      		=> -1,
		'order'						=> 'DESC'
	);
	// The Query
	$query = new WP_Query( $args );
	// The Loop
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			
	?>
	<?php 		
/*
		$image = get_post_meta(get_the_ID(),'image_101', true);
		$box_size_field = get_post_meta(get_the_ID(),'box_size', true);
		$box_size_value = get_post_meta(get_the_ID(),'box_size', true);
		$box_size_label = $box_size_field['choices'][ $box_size_value ];
*/
/*
		$image = get_subfield('image_101');
		$box_size_field = get_sub_field_object('box_size');
		$box_size_value = get_sub_field('box_size');
		$box_size_label = $box_size_field['choices'][ $box_size_value ];
*/
	$image_id = get_post_meta(get_the_ID(),"image", true);
	
	$image = wp_get_attachment_image_src($image_id);
	?>
	<a href="<?php the_permalink(); ?>">
		<h1><?php the_title(); ?></h1>		
		<div class="post-box <?php  /* echo $box_size_label; */ ?> " style="background-image: url('<?php echo $image[0]; ?>')"></div>
	</a>
	<?php
			}
		} else {
			echo "not found";
		}
		wp_reset_postdata();
	?>
</div>




























<?php echo get_template_part( 'footer', 'shoot101' ); ?>