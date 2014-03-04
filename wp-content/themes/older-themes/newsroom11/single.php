<?php get_header(); ?>

<div id="page">
	<div class="container">
		<div id="page-inner">
			
			<?php while ( have_posts() ): the_post(); ?>
			<header class="content">
				<div class="pad fix">
					<?php if ( !wpb_option('post-hide-comments-single') ): ?>
						<p class="entry-comments">
							<a href="<?php comments_link(); ?>">
								<span><?php comments_number( '0', '1', '%' ); ?><i class="pike"></i></span>
							</a>
						</p>
					<?php endif; ?>
					
					<?php if ( !wpb_option('post-hide-categories-single') ): ?>
						<p class="entry-category"><?php the_category(' &middot; '); ?></p>
					<?php endif; ?>
					
					<div class="clear"></div>
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<ul class="entry-meta fix">
						<?php if ( !wpb_option('post-hide-author-single') ): ?>
							<li class="entry-author"><?php _e('by','newsroom'); ?> <?php the_author_posts_link(); ?></li>
						<?php endif; ?>
						
						<?php if ( !wpb_option('post-hide-date-single') ): ?>
							<ul class="entry-meta fix">
								<li class="entry-date">
									<?php the_time('F j, Y'); ?>
									<?php if ( !wpb_option('post-hide-detailed-date') ): ?>
										<?php _e('at','newsroom'); ?> <?php the_time('g:i a'); ?>
									<?php endif; ?>
								</li>
							</ul>
						<?php endif; ?>
					</ul>
				</div><!--/pad-->
			</header>

			<div class="main fix <?php echo wpb_option('general-sidebar','sidebar-right'); ?>">

				<div class="content-part">
					<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>	
						<?php if ( get_post_format() ) { get_template_part('_post-formats'); } ?>
						<div class="pad fix">	
						
							<div class="text">
								<?php the_content(); ?>
								<?php wp_link_pages(array('before'=>'<div class="entry-page-links">'.__('Pages:','newsroom'),'after'=>'</div>')); ?>
								<div class="clear"></div>
							</div>
							
							<?php if ( !wpb_option('post-hide-tags-single') ): // Post Tags ?>
								<?php the_tags('<p class="entry-tags"><span>'.__('Tags:','newsroom').'</span> ','','</p>'); ?>
							<?php endif; ?>

							<?php if ( wpb_option('post-enable-author-block') ): // Post Author Block ?>
								<div class="entry-author-block fix">
									<div class="entry-author-avatar"><?php echo get_avatar(get_the_author_meta('user_email'),'80'); ?></div>
									<p class="entry-author-name">&mdash; <?php the_author_meta('display_name'); ?></p>
									<p class="entry-author-description"><?php the_author_meta('description'); ?></p>
								</div>
							<?php endif; ?>
							
						</div><!--/entry content-->
					</article>
					
					<?php if ( wpb_option('single-postnav') == '1' ): ?>
					<ul class="entry-browse fix">
						<li class="previous"><?php previous_post_link('%link', '<strong>'.__('Previous story', 'newsroom').'</strong> <span>%title</span>'); ?></li>
						<li class="next"><?php next_post_link('%link', '<strong>'.__('Next story', 'newsroom').'</strong> <span>%title</span>'); ?></li>
					</ul>
					<?php endif; ?>
					
					<?php comments_template(); ?>

				</div><!--/content-part-->
				
				<div class="sidebar">	
					<?php if ( wpb_option('single-postnav') == '2' ): ?>
					<ul class="entry-browse fix">
						<li class="previous"><?php previous_post_link('%link', '<strong>'.__('Previous story', 'newsroom').'</strong> <span>%title</span>'); ?></li>
						<li class="next"><?php next_post_link('%link', '<strong>'.__('Next story', 'newsroom').'</strong> <span>%title</span>'); ?></li>
					</ul>
					<?php endif; ?>

					<?php get_sidebar(); ?>
				</div><!--/sidebar-->
				
			</div><!--/main-->
			<?php endwhile;?>

		</div><!--/page-inner-->
	</div><!--/container-->
</div><!--/page-->

<?php get_footer(); ?>