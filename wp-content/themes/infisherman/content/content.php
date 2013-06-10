<?php

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix'); ?>>
    
    	<a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('index-thumb'); ?></a>
        <div class="article-holder">
		    <div class="clearfix">
                <?php echo primary_and_secondary_categories(); ?>
            </div>
			<?php //the_post_thumbnail(); ?>
			<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
			<h3 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h3>
			<?php endif; // is_single() ?>
    		<!-- .entry-header -->
    		
    		<a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
    		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
    		<div class="entry-summary">
    			<?php the_content(); ?>
    		</div><!-- .entry-summary -->
    		<?php else : ?>
    		<div class="entry-content">
    			<?php //the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
    			<?php echo substr(strip_tags($post->post_content), 0, 200); ?>
    			<a href="<?php the_permalink(); ?>" >more <span class="meta-nav">&raquo;</span></a>
    			<?php //wp_link_pages( array( 'before' => '<div class="page-links">' . 'Pages:', 'after' => '</div>' ) ); ?>
    		</div><!-- .entry-content -->
    		<?php endif; ?>
      		<div class="entry-meta">
    			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
    			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
    				<div class="author-info">
    					<div class="author-avatar">
    						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentytwelve_author_bio_avatar_size', 68 ) ); ?>
    					</div><!-- .author-avatar -->
    					<div class="author-description">
    						<h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
    						<p><?php the_author_meta( 'description' ); ?></p>
    						<div class="author-link">
    							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
    								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
    							</a>
    						</div><!-- .author-link	-->
    					</div><!-- .author-description -->
    				</div><!-- .author-info -->
    			<?php endif; ?>
    		</div><!-- .entry-meta -->
            
        </div>
    <!-- #post -->
</div><!-- #post -->
