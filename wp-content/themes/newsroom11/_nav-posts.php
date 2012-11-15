<?php if ( wpb_show_post_nav() ): ?>
	<?php if ( function_exists('wp_pagenavi') ): ?>
		<nav class="entry-nav pad fix">
			<?php wp_pagenavi(); ?>
		</nav>
	<?php else: ?>
		<nav class="entry-nav pad">
			<ul class="fix">
				<li class="prev left"><?php previous_posts_link(__('&larr; Previous','newsroom')); ?></li>
				<li class="next right"><?php next_posts_link(__('Next &rarr;','newsroom')); ?></li>
			</ul>
		</nav>
	<?php endif; ?>
<?php endif; ?>
