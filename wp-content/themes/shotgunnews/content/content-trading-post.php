<div id="<?php echo $post->post_name;?>" <?php post_class('article-brief clearfix'); ?>  data-slug="<?php echo $post->post_name;?>">
	<h3 class="entry-title">
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark" data-title="<?php the_title(); ?>"><?php the_title(); ?></a>
	</h3>
	<div class="article-content">
		<div class="thumb-area">
	    	<a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb'); ?></a>
	    	<?php $url = get_the_permalink();
	    	if(function_exists('wpsocialite_markup')){ wpsocialite_markup(array('url' => $url )); } ?>
		</div>
        <div class="article-holder">
    		<div class="entry-content">
    			<?php the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
    			<?php //the_excerpt(); ?>
    		</div><!-- .entry-content -->
        </div>
	</div>
</div><!-- #post -->