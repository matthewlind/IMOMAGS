<div class="map-left">
	<?php get_template_part( 'template-parts/svg-map' ); ?>				
</div><!-- .map-left -->
<section class="about-show">
	<h1 class="a-text"><?php the_field("article_headline");?></h1>
	<div class="a-text">
		<div class="block-aside">
			<div class="ad-aside">
			<?php imo_dart_tag("300x250"); ?>
			</div>
		</div>
		<?php 
		if( get_field('about_text') ) {
			while( has_sub_field('about_text') ) { $paragraph = get_sub_field('paragraph'); echo "<p>" . $paragraph . "</p>"; } 
			}
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
	'meta_value'  		=> '1',
	'meta_key'			=> 'is_episode',					
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
	<div class="episode-heading a-text">
		<div><span>#<?php echo $ep_num ;?></span></div>
		<h1><?php echo get_the_title(); ?></h1>
	</div>
	<div class="a-text">
	<!-- Links with a state image on the background -->
		<div class="block-aside ">
			<div class="links-aside">
				<?php if( !empty($state_img) ): ?> 
					<img src="<?php echo $state_img['url']; ?>" alt="<?php echo $state_img['alt']; ?>" /> 
				<?php endif; ?>	
				<ul class="list-links-aside">
				<?php while(has_sub_field("aside_links")): ?>
					<li><a href="<?php the_sub_field('aside_link'); the_sub_field('aside_external_link');?>" target="_blank"><?php the_sub_field('aside_link_name'); ?></a><i class="fa fa-angle-double-right"></i></li>
				<?php endwhile; ?>
				</ul>
			</div>
		</div><!-- END .block-aside -->	
		<?php while(has_sub_field("text_beginning")): ?>
		<p><?php the_sub_field('paragraph'); ?></p>
		<?php endwhile; ?>
		<!-- Start .s-game-wrap -->
		<?php if( !empty($small_game) ): ?> 
		<div class="s-game-wrap clearf">
			<?php while(has_sub_field("small_game")): 
				$specie_name = get_sub_field("specie_name");
				$specie_img = get_sub_field("specie_img");
				$cover_image = get_sub_field("cover_image");
			?>
			<div class="s-game-item">
				<img src="<?php echo $specie_img['url']; ?>" alt="<?php echo $specie_img['alt']; ?>">
				<img class="s-game-cover" src="<?php echo $cover_image['url']; ?>" alt="<?php echo $cover_image['alt']; ?>">
				<p><?php echo $specie_name;?></p>
			</div>	
			<?php endwhile; ?>	
		</div>
		<?php endif; ?>	
		<!-- END .s-game-wrap -->
		<!-- Start .a-slideshow -->
		<?php if( !empty($images_slider) ): ?> 
		<div class="a-slideshow">
			<div id="slider-<?php echo $flex_id_num; ?>" class="flexslider slider-wrap">
			  <ul class="slides">
			  <?php while(has_sub_field("images_slider")): 
				  $image_slider = get_sub_field("image_slider");
				  $caption_slider = get_sub_field("caption_slider");
			  ?>
			    <li>
			      <img src="<?php echo $image_slider['url']; ?>" alt="<?php echo $image_slider['alt']; ?>" />
			       <p class="flex-caption"><?php echo $caption_slider; ?></p>
			    </li>
			  <?php endwhile; ?>  
			  </ul>
			</div>
			<div id="thumbs-<?php echo $flex_id_num; ?>" class="flexslider thumbs-wrap">
			  <ul class="slides">
			  <?php while(has_sub_field("images_slider")): 
				  $image_slider = get_sub_field("image_slider");
				  $caption_slider = get_sub_field("caption_slider");
			  ?>
			    <li style="background-image: url('<?php echo $image_slider['url']; ?>')">
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
		<div class="a-cell-caption">
			<p><?php echo $full_width_image_caption;?></p>
		</div>
	</div><!-- END .a-cell -->
	<?php endif; ?><!--END .a-cell -->	
</section>	
<?php			
	} // End While
} 	else { echo '<h2>Not Found</h2>'; }
wp_reset_query();
?>	