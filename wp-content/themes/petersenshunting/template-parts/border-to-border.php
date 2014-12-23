<div class="map-left">
	<?php get_template_part( 'template-parts/svg-map' ); ?>				
</div><!-- .map-left -->
<section class="about-show">
	<h1 class="a-text"><?php the_field("article_headline");?></h1>
	<div class="a-text">
		<div class="block-aside">
			<div class="ad-aside">
				<?php imo_ad_placement("btf_medium_rectangle_300x250"); ?>	
			</div>
		</div>
		<?php 
		/*
if( get_field('about_text') ) {
			while( has_sub_field('about_text') ) { $paragraph = get_sub_field('paragraph'); echo "<p>" . $paragraph . "</p>"; } 
			}
*/
the_content();
		?>
		<?php if( get_field('show_stats') ): ?>
		<div class="overall-stats">
			<?php while( has_sub_field('show_stats')): 
				$stats_number = get_sub_field("stats_number");
				$stats_title = get_sub_field("stats_title");
				$stats_comment = get_sub_field("stats_comment");
			?>
			<div class="stats-item">
				<span><?php echo $stats_number; ?></span>
				<p><?php echo $stats_title; ?></p>
				<span><?php echo $stats_comment; ?></span>
			</div>
			<?php endwhile; ?>
		</div><!-- .overall-stats -->		
		<?php endif; ?>
	</div><!-- .a-text -->	
</section><!-- .about-show -->	
<?php 
$this_page_id=$wp_query->post->ID; 
$flex_num = 1;
$args = array(
	'posts_per_page' 	=> -1,
	'orderby'		 	=> 'date',
	'order'			 	=> 'ASC',
	'post_parent' 		=> $this_page_id,
	'post_type'      	=> 'page',
	'meta_key'			=> 'is_episode',
	'meta_value'  		=> '1'
);
query_posts($args);
if (have_posts()) {
	while (have_posts()) {
		the_post();

$flex_id_num = $flex_num++;		
$ep_num = get_field("episode_number");
$state_img = get_field("state_image");
$species_info = get_field("species_info");
$full_width_image_back = get_field("full_width_image_back");
$full_width_image_caption = get_field("full_width_image_caption");
$images_slider = get_field("images_slider");
$small_game = get_field("small_game");
?>
<section class="episode-<?php echo $ep_num ; ?>">	
	<h1 class="a-text"><?php echo get_the_title(); ?></h1>
	<div class="a-text">
	<!-- Links with a state image on the background -->
		<div class="block-aside ">
			<div class="links-aside">
				<?php if( !empty($state_img) ): ?> 
					<img src="<?php echo $state_img['url']; ?>" alt="<?php echo $state_img['alt']; ?>" /> 
				<?php endif; ?>	
				<ul class="list-links-aside">
				<?php while(has_sub_field("aside_links")): ?>
					<li><a href="<?php
						$aside_link = get_sub_field("aside_link");
						$aside_link_name = get_sub_field("aside_link_name");
						$aside_external_link = get_sub_field("aside_external_link");
						if ( empty($aside_external_link) ):
							echo $aside_link;
						endif;
							
						if ( !empty($aside_external_link) ):
							echo $aside_external_link;
						endif;
							?>" target="_blank"><?php echo $aside_link_name; ?></a><i class="fa fa-angle-double-right"></i>
					 </li>
				<?php endwhile; ?>
				</ul>
			</div>
		</div><!-- END .block-aside -->	
		<?php while(has_sub_field("text_beginning")): ?>
		<p><?php the_sub_field('paragraph'); ?></p>
		<?php endwhile; ?>
		<!-- Start .a-slideshow -->
		<?php if( !empty($images_slider) ): ?> 
		<div class="a-slideshow">
			<div id="slider-<?php echo $flex_id_num; ?>" class="flexslider slider-wrap">
			  <ul class="slides">
			  <?php while(has_sub_field("images_slider")): 
					$image = get_sub_field("image_slider");
					$caption_slider = get_sub_field("caption_slider");
				  
					// vars
					$url = $image['url'];
					$title = $image['title'];
					$alt = $image['alt'];
					$caption = $image['caption'];
					
					$size = 'large';
					
					$thumb = $image['sizes'][ $size ];
					$width = $image['sizes'][ $size . '-width' ];
					$height = $image['sizes'][ $size . '-height' ];
			  ?>
			    <li>
					<img src="<?php if (mobile() == false) { echo $url; } else { echo $thumb; } ?>" alt="<?php echo $alt; ?>" />
					<p class="flex-caption"><?php echo $caption_slider; ?></p>
			    </li>
			  <?php endwhile; ?>  
			  </ul>
			</div>
			<div id="thumbs-<?php echo $flex_id_num; ?>" class="flexslider thumbs-wrap">
			  <ul class="slides">
			  <?php while(has_sub_field("images_slider")): 
				  $image = get_sub_field("image_slider");
				  $caption_slider = get_sub_field("caption_slider");
			  ?>
			    <li style="background-image: url('<?php echo $image['url']; ?>')">
			    </li>
			  <?php endwhile; ?>  
			  </ul>
			</div>
		</div>
		<?php endif; ?><!--END .a-slideshow -->	
		
		<?php while(has_sub_field("text_end")): ?>
		<p><?php the_sub_field('paragraph'); ?></p>
		<?php endwhile; ?>
		
		<!-- Start .species-info -->							
		<?php if($species_info): ?>						
		<?php while( has_sub_field('species_info') ): ?>
		<?php 
		$species_img = get_sub_field("species_image");
		$species_title = get_sub_field("species_title");
		$species_description = get_sub_field("species_description");
		?>
		<div class="species-info">
			<div class="species-description">									
				<img src="<?php  echo $species_img['url']; ?>" alt="<?php echo $species_img['alt']; ?>" /> 
				<h2><?php echo $species_title; ?></h2>
				<p><?php echo $species_description; ?></p>
			</div><!-- .species-description -->
			<?php if( get_sub_field('species_stats') ): ?>
				<div class="species-stats">
					<?php while( has_sub_field('species_stats') ): ?>
					<?php
					$species_stats_num = get_sub_field("species_stats_num");
					$species_stats_title = get_sub_field("species_stats_title");
					$species_stats_comment = get_sub_field("species_stats_comment");
					?>
					<div class="stats-item">
						<span><?php echo $species_stats_num; ?></span>
						<p><?php echo $species_stats_title; ?></p>
						<?php if( !empty($species_stats_comment) ): ?> 
						<span><?php echo $species_stats_comment; ?></span>
						<?php endif; ?>	
					</div>
					<?php endwhile; ?>
				</div><!-- END .species-stats -->
			<?php endif; ?>
		</div><!-- END .species-info -->
		<?php endwhile; ?>
	<?php endif; ?>
	</div><!-- END .a-text -->
	<?php if( !empty($full_width_image_back) ): ?> 
	<div class="a-cell">
		<div class="a-inner-cell" style="background-image: url('<?php echo $full_width_image_back;?>');"></div>
		<?php if ($full_width_image_caption): ?>
		<div class="a-cell-caption">
			<p><?php echo $full_width_image_caption;?></p>
		</div>
		<?php endif ?>
	</div><!-- END .a-cell -->
	<?php endif; ?><!--END .a-cell -->	
</section>	
<?php			
	} // End While
} 	else { echo '<h2>Not Found</h2>'; }
wp_reset_query();
?>	