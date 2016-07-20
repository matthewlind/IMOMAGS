<?php
get_header('redesign');
$post_id = $post->ID;
$is_single_default = true;
$dartdomain = get_option('dart_domain', false);

if(is_page("post-photo")){ ?>
<div id="sections_wrap" class="sections-wrap">
	<section class="section-photo-menu">
		<div class="section-inner-wrap">
			<?php get_template_part( 'nav', get_post_format() ); ?>
		</div>
	</section>
</div>
<?php } ?>
<main class="main-single">
		<article id="article" class="article">
				<header class="article-header">
			<h1><?php the_title(); ?></h1>
			<?php if(!is_page("post-photo")){ ?>
			<div class="social-single">
				<ul>
					<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank"><i class="icon-facebook"></i><span>Share</span></a></li>
					<li><a href="http://twitter.com/intent/tweet?status=<?php the_title(); ?>+<?php the_permalink(); ?>" target="_blank"><i class="icon-twitter"></i><span>Tweet</span></a></li>
					<li><a href="mailto:?body=<?php the_permalink(); ?>"><i class="icon-envelope"></i><span>Email</span></a></li>
				</ul>
			</div>
			<?php } ?>
		</header>
		<div class="article-body">
			<div id="sticky-ad" class="sticky-ad">
			    <div class="sticky-ad-inner"><iframe class="iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term=<?php echo $term; ?>&camp=<?php echo $camp; ?>&ad_code=<?php echo $dartdomain; ?>&ad_unit=mediumRectangle&page=article"></iframe></div>
		    </div>
			<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; // end of the loop. ?>
		</div>
		<?php if(!is_page("post-photo")){ ?>
		<div class="social-single">
			<ul>
				<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank"><i class="icon-facebook"></i><span>Share</span></a></li>
					<li><a href="http://twitter.com/intent/tweet?status=<?php the_title(); ?>+<?php the_permalink(); ?>" target="_blank"><i class="icon-twitter"></i><span>Tweet</span></a></li>
					<li><a href="mailto:?body=<?php the_permalink(); ?>"><i class="icon-envelope"></i><span>Email</span></a></li>
			</ul>
		</div>
		<?php } ?>
		<div id="ad-stop"></div>
		<?php imo_ad_placement("e_commerce_widget"); ?> 
	</article>
</main>

<?php get_footer('redesign'); ?>