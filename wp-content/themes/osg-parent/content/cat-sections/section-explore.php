<section class="section-exp-cats">
	<div class="section-inner-wrap">
		<h1>Explore <?php echo $site_name;?></h1>
		<ul class="ec-list">
		<?php 	
		$card_count		= 0;
		
		while( have_rows('explore_section', $options)) {
			the_row();
			$c 			= get_sub_field('category');
			$cat_name 	= get_cat_name($c);
			$cat_url	= get_category_link($c);
			$card_out 	= "<li><h2><a href='$cat_url'>$cat_name</a></h2>";
			$args = array(
				'cat'	=> $c,
				'posts_per_page' => 1,
				'order' => 'DESC'
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$thumb 	= get_the_post_thumbnail($query->post->ID,"list-thumb");
					$permalink	= get_permalink();
					$get_title	= get_the_title();
					
					$card_out .= "<a href='$permalink'>$thumb</a>";
					$card_out .=	"<h3><a href='$permalink'>$get_title</a></h3>";	
				}
			} else {
				echo "no posts found";
			}
			wp_reset_postdata();
			$card_out .= "<a class='ec-link' href='$cat_url'>More $cat_name</a></li>";
			
			echo $card_out;
			
			if ($card_count == 4) { ?>
				<li class="ec-ad ad-wrap">
					<span class="ad-span">Advertisement</span>
					<div id="ec_ad_inner" class="ad-inner"><?php imo_ad_placement("medium_rect_explore"); ?></div>
				</li>
			<?php }
			
			$card_count++;
		}
		?>
		</ul>	
	</div>
</section>