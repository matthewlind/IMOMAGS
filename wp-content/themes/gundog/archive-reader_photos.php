<?php

$dataPos = 0;

get_header('redesign');
//get_template_part( 'nav', get_post_format() );
//imo_sidebar();

$is_home_cat= true;
/*
$string 	= parse_url($_SERVER[REQUEST_URI]);
$term 		= $string["query"];
echo $term;
var_dump($term);
*/





$args = array(
	'category_name' => 'on-point',
	'post_type' => 'reader_photos',
	'posts_per_page' => 8,
	'order' => 'DESC'
);
?>

<div id="sections_wrap" class="sections-wrap">
	<section class="section-photo-menu">
		<div class="section-inner-wrap">
		<?php get_template_part( 'nav', get_post_format() ); ?>
		</div>
	</section>
	<section class="section-latest-posts">
		<div id="l_container" class="section-inner-wrap">
			<h1 class="main-h"><?php echo $this_cat_name;?></h1>
			<ul id="latest_list" class="c-list">
			<?php	
				$query = new WP_Query( $args );		
	             	
             	if ( $query->have_posts() ) { 
					while ( $query->have_posts() ) { 
						$query->the_post();
					?>
					<li class="c-item">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('list-thumb'); ?></a>
						<div class="c-info">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
						</div>
					</li>
					<?php 
						if ($p_counter == 1) {
							echo '<li class="c-ad ad-wrap"><span class="ad-span">Advertisement</span><div id="c_ad_inner" class="ad-inner"></div></li>';
						}
						$p_counter++;
					} 
				} else { ?>
					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title">No one has submitted a photo for <span style="text-transform:capitalize;font-size:1.2em;"><?php echo str_replace("-", " ", $term ); ?></span> yet.</h1>
							<p>Be the first to post one!</p>
							<label class="upload-button"><a href="/post-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a></label>
						</header><!-- .entry-header -->
					</article><!-- #post-0 -->
				<?php } ?>
				</ul>
			<div id="btn_more_posts" class="btn-lg"  data-post-not="" data-cat="<?php echo $this_cat_id;?>">
				<span>Show More</span>
				<div class="loader-anim dnone">
					<div class="line-spin-fade-loader">
						<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
					</div>
				</div>
			</div><!-- .btn-lg -->	
		</div>
	</section>
	<section id="section_loader">
		<div class="ball-grid-pulse clearfix">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
	</section>
</div>

<?php get_footer('redesign'); ?>