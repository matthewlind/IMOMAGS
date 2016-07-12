<?php
	get_header('redesign');
	$post_id = $post->ID;
	$is_single_default = true;
	$dartdomain 	= get_option('dart_domain', false);

?>
<main class="main-single">
	<article id="article" class="article">
		<header class="article-header">
			<h1><?php the_title(); ?></h1>
			<div class="byline"><span><?php the_time('F jS, Y'); ?></span></div>
			<div class="social-single">
				<ul>
					<li><a href=""><i class="icon-facebook"></i><span>Share</span></a></li>
					<li><a href=""><i class="icon-twitter"></i><span>Tweet</span></a></li>
					<li><a href=""><i class="icon-envelope"></i><span>Email</span></a></li>
				</ul>
			</div>
		</header>
		<div class="article-body">
			<div id="sticky-ad" class="sticky-ad">
			    <div class="sticky-ad-inner"><iframe class="iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term=<?php echo $term; ?>&camp=<?php echo $camp; ?>&ad_code=<?php echo $dartdomain; ?>&ad_unit=mediumRectangle&page=article&pos=btf"></iframe></div>
		    </div>
			<div class="feat-img">
	            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
	        </div>
	        <div class="photo-text">
		        <?php the_content(); ?>
	        </div>
		</div>
		<div class="social-single">
			<ul>
				<li><a href=""><i class="icon-facebook"></i><span>Share</span></a></li>
				<li><a href=""><i class="icon-twitter"></i><span>Tweet</span></a></li>
				<li><a href=""><i class="icon-envelope"></i><span>Email</span></a></li>
			</ul>
		</div>
		<div id="ad-stop"></div>
		<?php imo_ad_placement("e_commerce_widget"); ?> 
	</article>
</main>

<?php get_footer('redesign'); ?>