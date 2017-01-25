<li class="c-item">
	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('list-thumb'); ?></a>
	<div class="c-info">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
		<?php if(in_category("master-angler")){ ?><img class="ma-badge" src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pic/badge-ma.png" alt="Master Angler" /><?php } ?>
	</div>
</li>