<?php
if (have_rows('featured_cat', $options)) {
	while (have_rows('featured_cat', $options)) {
		the_row();
		$cat_id 		= get_sub_field('category');
		$subtitle 		= get_sub_field('subtitle');
		$sponsor_logo 	= get_sub_field('sponsor_logo');
		$sponsor_text 	= get_sub_field('sponsor_text');
		$sponsor_url 	= get_sub_field('sponsor_url');
		$cat_name 		= get_cat_name($cat_id);
	}
	if ($curr_cat_id !== $cat_id) {
?>
<section class="section-twins">
	<div class="section-inner-wrap clearfix">
		<div class="twins-title">
			<h1><?php echo $cat_name; ?></h1>
			<?php if ($subtitle) { echo '<span>'.$subtitle.'</span><br>'; }?>
			<a class="link-to-all" href="<?php echo get_category_link($cat_id); ?>">More <?php echo $cat_name ?></a>
			<?php if ($sponsor_logo) { ?>
				<div class="twins-logo-wrap">
					<span><?php if ($sponsor_text) {echo $sponsor_text;} else { echo 'Presented by';} ?> </span>
					<a href="<?php echo $sponsor_url; ?>" target="_blank"><img src="<?php echo $sponsor_logo; ?>"></a>
				</div>	
			<?php } ?>
		</div>
		<div class="twins-thumbs clearfix">
			<ul>
				<?php	
					$args = array ('cat' => $cat_id,'posts_per_page' => 2,'order' => 'DESC');
					$query = new WP_Query( $args );
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							$thumb 	= get_the_post_thumbnail($query->post->ID,"list-thumb");	
					?>
					<li class="twins-item" featured_id="<?php echo $feature->ID ?>">
						<div class="twins-img"><a href="<?php the_permalink(); ?>"><?php echo $thumb; ?></a></div>
						<div class="twins-thumb-title">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</div>
					</li>
					<?php
						}
					} else {
						echo "no posts found";
					}
					wp_reset_postdata(); 
				?>
			</ul>
		</div>
	</div>
</section>
<?php } } ?>
