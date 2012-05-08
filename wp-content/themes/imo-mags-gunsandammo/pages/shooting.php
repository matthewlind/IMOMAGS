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
				if ( $query->have_posts() ) :
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span class="icon-shooting">Personal Defense</span>
						</h4></div>
					</div>	
				<div class="top">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(134,90), array('class' => 'entry-img')); ?></a>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<span><?php comments_number( 'no responses', 'one response', '% responses' ); ?></span>
				
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				$args = array(
					'category_name' => 'personal-defense',
					'post_status'  => 'publish',
					'posts_per_page' => 5,
					'offset' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args ); ?>
				</div>
				<ul class="fancy">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				</ul>
				
				<div class="cfct-module cfct-divider"><hr class="cfct-div-solid"></div>
					<div class="cfct-module cfct-html aligncenter">
						<div class="cfct-mod-content">
							<a class="cta" href="/shooting/personal-defense/">More Personal Defense<span></span></a>
						</div>
					</div>
				</div>
				<?php endif;
				// Reset Post Data
				wp_reset_postdata(); ?>
				
				
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
				if ( $query->have_posts() ) :
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span class="icon-shooting">New Products</span>
						</h4></div>
					</div>	
				<div class="top">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(134,90), array('class' => 'entry-img')); ?></a>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<span><?php comments_number( 'no responses', 'one response', '% responses' ); ?></span>				
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				$args = array(
					'category_name' => 'new-products',
					'post_status'  => 'publish',
					'posts_per_page' => 5,
					'offset' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args ); ?>
				</div>
				<ul class="fancy">	
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				</ul>
				
				<div class="cfct-module cfct-divider"><hr class="cfct-div-solid"></div>
					<div class="cfct-module cfct-html aligncenter">
						<div class="cfct-mod-content">
							<a class="cta" href="/shooting/new-products/">More New Products<span></span></a>
						</div>
					</div>
				</div>

				<?php endif;
				// Reset Post Data
				wp_reset_postdata(); ?>
				
									
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
				if ( $query->have_posts() ) :
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span class="icon-shooting">Ammo</span>
						</h4></div>
					</div>	
				<div class="top">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(134,90), array('class' => 'entry-img')); ?></a>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<span><?php comments_number( 'no responses', 'one response', '% responses' ); ?></span>
				
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();
				
				$args = array(
					'category_name' => 'ammo',
					'post_status'  => 'publish',
					'posts_per_page' => 5,
					'offset' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				?>
				</div>				
				<ul class="fancy">	
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				</ul>
				
				<div class="cfct-module cfct-divider"><hr class="cfct-div-solid"></div>
					<div class="cfct-module cfct-html aligncenter">
						<div class="cfct-mod-content">
							<a class="cta" href="/shooting/ammo/">More Ammo<span></span></a>
						</div>
					</div>
				</div>
				<?php endif;
				// Reset Post Data
				wp_reset_postdata(); ?>
				
				
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
				if ( $query->have_posts() ) :
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span class="icon-shooting">Reloading</span>
						</h4></div>
					</div>	
				<div class="top">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(134,90), array('class' => 'entry-img')); ?></a>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<span><?php comments_number( 'no responses', 'one response', '% responses' ); ?></span>
				
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();
				
				$args = array(
					'category_name' => 'reloading',
					'post_status'  => 'publish',
					'posts_per_page' => 5,
					'offset' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				?>
				</div>
				<ul class="fancy">	
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				</ul>
				
				<div class="cfct-module cfct-divider"><hr class="cfct-div-solid"></div>
					<div class="cfct-module cfct-html aligncenter">
						<div class="cfct-mod-content">
							<a class="cta" href="/shooting/reloading/">More Reloading<span></span></a>
						</div>
					</div>
				</div>
				<?php endif; 
				// Reset Post Data
				wp_reset_postdata(); ?>
				

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
				if ( $query->have_posts() ) :
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span class="icon-shooting">Gear and Accessories</span>
						</h4></div>
					</div>	
			
				<div class="top">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(134,90), array('class' => 'entry-img')); ?></a>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<span><?php comments_number( 'no responses', 'one response', '% responses' ); ?></span>
				
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				$args = array(
					'category_name' => 'gear-and-accessories',
					'post_status'  => 'publish',
					'posts_per_page' => 5,
					'offset' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				?>
				</div>				
				<ul class="fancy">	
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				</ul>
				
				<div class="cfct-module cfct-divider"><hr class="cfct-div-solid"></div>
					<div class="cfct-module cfct-html aligncenter">
						<div class="cfct-mod-content">
							<a class="cta" href="/shooting/gear-and-accessories/">More Gear and Accessories<span></span></a>
						</div>
					</div>
				</div>
				<?php endif;
				// Reset Post Data
				wp_reset_postdata(); ?>
				
				
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
				if ( $query->have_posts() ) :
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span class="icon-shooting">Tips & Tactics</span>
						</h4></div>
					</div>	
			
				<div class="top">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(134,90), array('class' => 'entry-img')); ?></a>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<span><?php comments_number( 'no responses', 'one response', '% responses' ); ?></span>
				
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();
				
				$args = array(
					'category_name' => 'tips-tactics',
					'post_status'  => 'publish',
					'posts_per_page' => 5,
					'offset' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				?>
				</div>				
				<ul class="fancy">	
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				</ul>
				
				<div class="cfct-module cfct-divider"><hr class="cfct-div-solid"></div>
					<div class="cfct-module cfct-html aligncenter">
						<div class="cfct-mod-content">
							<a class="cta" href="/shooting/tips-tactics/">More Tips & Tactics<span></span></a>
						</div>
					</div>
				</div>
				<?php endif;
				
				// Reset Post Data
				wp_reset_postdata(); ?>
				

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
				if ( $query->have_posts() ) :
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span class="icon-shooting">How To</span>
						</h4></div>
					</div>	
			
				<div class="top">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(134,90), array('class' => 'entry-img')); ?></a>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<span><?php comments_number( 'no responses', 'one response', '% responses' ); ?></span>
				
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				$args = array(
					'category_name' => 'how-to',
					'post_status'  => 'publish',
					'posts_per_page' => 5,
					'offset' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				?>
				</div>				
				<ul class="fancy">	
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata(); ?>
				</ul>
				<div class="cfct-module cfct-divider"><hr class="cfct-div-solid"></div>
					<div class="cfct-module cfct-html aligncenter">
						<div class="cfct-mod-content">
							<a class="cta" href="/shooting/how-to/">More How To<span></span></a>
						</div>
					</div>
				</div>
				<?php endif;

				// Reset Post Data
				wp_reset_postdata(); ?>
				
				
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
				if ( $query->have_posts() ) :
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span class="icon-shooting">Second Amendment</span>
						</h4></div>
					</div>	
			
				<div class="top">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(134,90), array('class' => 'entry-img')); ?></a>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<span><?php comments_number( 'no responses', 'one response', '% responses' ); ?></span>
				
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				$args = array(
					'category_name' => 'second-amendment',
					'post_status'  => 'publish',
					'posts_per_page' => 5,
					'offset' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				?>
				</div>				
				<ul class="fancy">	
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				</ul>
				
				<div class="cfct-module cfct-divider"><hr class="cfct-div-solid"></div>
					<div class="cfct-module cfct-html aligncenter">
						<div class="cfct-mod-content">
							<a class="cta" href="/shooting/second-amendment/">More Second Amendment<span></span></a>
						</div>
					</div>
				</div>
				<?php endif;

				// Reset Post Data
				wp_reset_postdata(); ?>
				

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
				if ( $query->have_posts() ) :
				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span class="icon-shooting">Gunsmithing</span>
						</h4></div>
					</div>	
			
				<div class="top">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(134,90), array('class' => 'entry-img')); ?></a>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<span><?php comments_number( 'no responses', 'one response', '% responses' ); ?></span>
				
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				$args = array(
					'category_name' => 'gunsmithing',
					'post_status'  => 'publish',
					'posts_per_page' => 5,
					'offset' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				?>
				</div>				
				<ul class="fancy">	
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				</ul>
				
				<div class="cfct-module cfct-divider"><hr class="cfct-div-solid"></div>
					<div class="cfct-module cfct-html aligncenter">
						<div class="cfct-mod-content">
							<a class="cta" href="/shooting/gunsmithing/">More Gunsmithing<span></span></a>
						</div>
					</div>
				<?php endif; ?>
				</div>
				<?php 
				// Reset Post Data
				wp_reset_postdata(); ?>

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
				if ( $query->have_posts() ) : 				
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="tiles">
					<div class="section-title posts">
						<div class="cfct-mod-content"><h4>
  							<div class="icon"></div>
  							<span class="icon-shooting">Military & Law</span>
						</h4></div>
					</div>	
			
				<div class="top">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(134,90), array('class' => 'entry-img')); ?></a>
				<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
				<span><?php comments_number( 'no responses', 'one response', '% responses' ); ?></span>
				
				<?php endwhile;

				// Reset Post Data
				wp_reset_postdata();

				$args = array(
					'category_name' => 'military-law-enforcement',
					'post_status'  => 'publish',
					'posts_per_page' => 5,
					'offset' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				
				?>
				</div>
				<ul class="fancy">	
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<li><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>

				</ul>
				
				<div class="cfct-module cfct-divider"><hr class="cfct-div-solid"></div>
				<div class="cfct-module cfct-html aligncenter">
					<div class="cfct-mod-content">
						<a class="cta" href="/shooting/military-law-enforcement/">More Military & Law<span></span></a>
					</div>
				</div>
			</div>
				<?php endif;

				// Reset Post Data
				wp_reset_postdata(); ?>
																		
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>