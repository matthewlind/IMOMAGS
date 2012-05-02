<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post(); ?>
<div class="page-template-page-right-php right-sidebar-landing">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('shooting-sidebar')) : else : ?><?php endif; ?>
	</div>
	<div id="content">
		<h1 class="seo-h1">Shooting</h1>
		<div <?php post_class('entry entry-full'); ?>>
			<div class="entry-content">
			<div class="cfct-module cfct-html section-title posts">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
  								<span><?php the_title(); ?></span>
						</h4>
					</div>
				</div>
				<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>
				
				<?php
				// PERSONAL DEFENSE
				$args = array(
					'category_name' => 'personal-defense',
					'post_status'  => 'publish',
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span>Personal Defense</span>
						</h4></div>
					</div>	

				<?php the_post_thumbnail(array(312,312)); ?>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<a href="/shooting/personal-defense/">More Personal Defense &raquo;</a>
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				?>
				</div>
				
				<?php
				// NEW PRODUCTS
				$args = array(
					'category_name' => 'new-products',
					'post_status'  => 'publish',
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span>New Products</span>
						</h4></div>
					</div>	
			
				<?php the_post_thumbnail(array(312,312)); ?>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<a href="/shooting/new-products/">More New Products &raquo;</a>
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				?>
				</div>
					
				<?php
				// AMMO
				$args = array(
					'category_name' => 'ammo',
					'post_status'  => 'publish',
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span>Ammo</span>
						</h4></div>
					</div>	
			
				<?php the_post_thumbnail(array(312,312)); ?>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<a href="/shooting/ammo/">More Ammo &raquo;</a>
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				?>
				</div>
				
				<?php
				// RELOADING
				$args = array(
					'category_name' => 'reloading',
					'post_status'  => 'publish',
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span>Reloading</span>
						</h4></div>
					</div>	
			
				<?php the_post_thumbnail(array(312,312)); ?>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<a href="/shooting/reloading/">More Reloading &raquo;</a>
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				?>
				</div>

				<?php
				// Gear and Accessories
				$args = array(
					'category_name' => 'gear-and-accessories',
					'post_status'  => 'publish',
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span>Gear and Accessories</span>
						</h4></div>
					</div>	
			
				<?php the_post_thumbnail(array(312,312)); ?>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<a href="/shooting/gear-and-accessories/">More Gear and Accessories &raquo;</a>
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				?>
				</div>
				
				<?php
				// Tips & Tactics
				$args = array(
					'category_name' => 'tips-tactics',
					'post_status'  => 'publish',
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span>Tips & Tactics</span>
						</h4></div>
					</div>	
			
				<?php the_post_thumbnail(array(312,312)); ?>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<a href="/shooting/tips-tactics/">More Tips & Tactics &raquo;</a>
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				?>
				</div>
				
				<?php
				// How To
				$args = array(
					'category_name' => 'how-to',
					'post_status'  => 'publish',
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span>How To</span>
						</h4></div>
					</div>	
			
				<?php the_post_thumbnail(array(312,312)); ?>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<a href="/shooting/how-to/">More How To &raquo;</a>
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				?>
				</div>
				
				<?php
				// Second Amendment
				$args = array(
					'category_name' => 'second-amendment',
					'post_status'  => 'publish',
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span>Second Amendment</span>
						</h4></div>
					</div>	
			
				<?php the_post_thumbnail(array(312,312)); ?>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<a href="/shooting/second-amendment/">More Second Amendment &raquo;</a>
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				?>
				</div>
				
				<?php
				// Gunsmithing
				$args = array(
					'category_name' => 'gunsmithing',
					'post_status'  => 'publish',
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span>Gunsmithing</span>
						</h4></div>
					</div>	
			
				<?php the_post_thumbnail(array(312,312)); ?>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<a href="/shooting/gunsmithing/">More Gunsmithing &raquo;</a>
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				?>
				</div>

				<?php
				// Military & Law
				$args = array(
					'category_name' => 'military-law-enforcement',
					'post_status'  => 'publish',
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span>Military & Law</span>
						</h4></div>
					</div>	
			
				<?php the_post_thumbnail(array(312,312)); ?>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<a href="/shooting/military-law-enforcement/">More Military & Law &raquo;</a>
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				?>
				</div>
														
				<?php wp_link_pages(); ?>
				
				
							</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>