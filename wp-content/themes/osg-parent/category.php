<?php

get_header(); 

$is_home_cat 	= true;
$dartdomain 	= get_option('dart_domain', false);
$magazine_img 	= get_option('magazine_cover_uri' );
$deal_copy 		= get_option('deal_copy' );
$features 		= get_field('homepage_featured_stories','options' );
$site_name		= trim(get_bloginfo('name'), "Magazine");


$this_cat 		= get_category( get_query_var( 'cat' ) );
$this_cat_id	= $this_cat->term_id;
$this_cat_name	= $this_cat->name;

$overwrite_cat_btf = get_field('overwrite', 'category_'.$this_cat_id);
?>


<div id="sections_wrap" class="sections-wrap" data-overwrite-cat-btf="<?php echo $overwrite_cat_btf; ?>">
	<section class="section-latest-posts">
		<div id="l_container" class="section-inner-wrap">
			<header class="main-h">
				<h1><?php echo $this_cat_name;?></h1>
				<?php if (category_description( $this_cat_id )) {  echo '<p>'. category_description( $this_cat_id ) . '</p>'; }?>
			</header>
				<ul id="latest_list" class="c-list">
			<?php 	
				$p_counter = 0;		
				$args = array(
					'cat'	=> $this_cat_id,
					'posts_per_page' => 5,
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$author 		= get_the_author();
						$acf_byline 	= get_field("byline", $post->ID);
						?>
						<li class="c-item">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('list-thumb'); ?></a>
							<div class="c-info">
								<?php if (in_category('sponsored', $post->ID)) echo '<span class="is-sponsored">Sponsored</span>'; ?>
								<div class="c-cats"><?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(null, ','); } ?></div>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<span class="c-author"><?php if (!$acf_byline) { if ($author != 'admin') echo 'by '. $author;} else {echo $acf_byline;} ?></span>
							</div>
						</li>
			<?php		if ($p_counter == 1) { ?>
							<li class="c-ad ad-wrap">
								<span class="ad-span">Advertisement</span>
								<div id="c_ad_inner" class="ad-inner">
									<?php imo_ad_placement("medium_rect_ATF"); ?>
								</div>
							</li>
			<?php		}
						$p_counter++;
					}
				} else {
					echo "no posts found";
				}
				wp_reset_postdata();
			?>
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
	<?php //the rest of the page is loaded from /functions/redesign/home-and-cat.php  ?>
</div>





<?php get_footer(); ?>