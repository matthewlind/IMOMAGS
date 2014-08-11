<?php

$dataPos = 0;
$i = -1;

get_header(); ?>
<div id="primary" class="general">
	<div id="content" role="main" class="general-frame">
        <div id="video-portal">
        	<h1 class="video-portal-title">Videos</h1>
			<div id="video-gallery">
				<script type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script> 
				<div id="player"></div>
			</div><!-- /#video-gallery -->	
		</div><!-- #video-portal -->
    </div>
</div>
<?php query_posts(array( 
    'post_type' => 'video',
    'showposts' => 30 
	)); 

?>
<div class="sidebar-area video-sidebar">
	<div class="sidebar">
		<h1><?php the_title(); ?></h1>
		<div class="share-video">
			<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
			<a data-url="<?php the_permalink(); ?>" href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>
		<?php $dartDomain = get_option("dart_domain", $default = false);
				echo '<iframe id="video-iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?size=300x250&ad_code='.$dartDomain.'"></iframe>'; ?>
			
	</div>
</div>
<div class="thumbs-full">
	<ul id="video-thumbs">
		<?php while (have_posts()) : the_post(); $i++; 
			$post_id = get_the_id();
			$post = get_post($post_id);
			$slug = $post->post_name;
			$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		?>
	
		<li id="thumb-<?php echo $i; ?>"><a class="video-thumb" data-slug="<?php echo $slug; ?>" data-img_url="<?php echo $thumb_url; ?>" data-post_url="<?php echo get_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" data-videoid="<?php echo get_field( "brightcove_id",get_the_ID() ); ?>"><?php the_post_thumbnail("video-thumb"); ?><h3><?php the_title(); ?></h3></a></li>
	
		<?php endwhile;?>
	</ul>
</div>
<?php get_footer(); ?>