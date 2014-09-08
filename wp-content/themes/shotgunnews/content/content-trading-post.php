<div id="<?php echo $post->post_name;?>" <?php post_class('article-brief clearfix'); ?>  data-slug="<?php echo $post->post_name;?>">
	<h3 class="entry-title"><?php the_title(); ?></h3>
	<em class="meta-date-author"><?php the_time('F jS, Y'); ?></em>
	<div class="article-content">
		<div class="thumb-area">
	    	<?php the_post_thumbnail('list-thumb'); ?>
	    	<?php $url = get_the_permalink(); ?>
	    	<div class="fb-like" data-href="<?php echo $url; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
	    	<a data-url="<?php echo $url; ?>" href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			<span class="googleplus">
				<script src="https://apis.google.com/js/platform.js" async defer></script>
				<div class="g-plusone" data-size="medium" data-href="<?php echo $url; ?>"></div>
			</span>
		</div>
        <div class="article-holder">
    		<div class="entry-content">
    			<?php the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
    			<?php //the_excerpt(); ?>
    		</div><!-- .entry-content -->
        </div>
	</div>
</div><!-- #post -->
<?php
if(is_single()){
	$args = array( 
		'post_type' => 'post',
		'post_status' => 'publish',
		'category_name' => 'trading-post',
		'post__not_in' => array(get_the_ID()),
		'posts_per_page' => 10
	); 
	
	$posts = get_posts( $args );
	
	
	global $post;

	
	foreach ( $posts as $post ) {
		setup_postdata( $post ); 
		
		$post_id = $post->ID;
		$slug = $post->post_name;
		$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
		$cats = get_the_category( $post_id );
		
		?>
	
		
		<div id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix'); ?>  data-slug="<?php echo $slug; ?>">
			<h3 class="entry-title">
				<?php the_title(); ?>
			</h3>
			<em class="meta-date-author"><?php the_time('F jS, Y'); ?></em>
			<div class="article-content">
				<div class="thumb-area">
			    	<?php the_post_thumbnail('list-thumb'); ?>
			    	<?php $url = get_the_permalink(); ?>
			    	<div class="fb-like" data-href="<?php echo $url; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
			    	<a data-url="<?php echo $url; ?>" href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					<span class="googleplus">
						<script src="https://apis.google.com/js/platform.js" async defer></script>
						<div class="g-plusone" data-size="medium" data-href="<?php echo $url; ?>"></div>
					</span>				</div>
		        <div class="article-holder">
		    		<div class="entry-content">
		    			<?php the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
		    			<?php //the_excerpt(); ?>
		    		</div><!-- .entry-content -->
		        </div>
			</div>
		</div><!-- #post -->
			
	<?php } 
	wp_reset_postdata();

}
?>