<?php 
	global $microsite;
	$microsite = true;
	
	get_header(); 
// echo get_template_part( 'header', 'shoot101' ); 
	$category = get_the_category(); 
	$cat_slug = $category[0]->slug;
	$cat_name = $category[0]->cat_name;

	$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$image_large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'lafge' );	
	$postID = get_the_ID();
	$byline = get_post_meta($postID, 'ecpt_byline', true);
	$acf_byline = get_field("byline",$postID); 
	$author = get_the_author();
	$subtitle = get_field("subtitle");
?>
<div class="m-article-wrap clearfix">
	<?php if(mobile() == true) {
		if($image_large[0]) { ?>
			<div class="m-article-image" style="background-image: url('<?php echo $image_large[0]; ?>');"></div>
	<?php	}
		
	} else {
		if($image_full[0]) { ?>
			<div class="m-article-image" style="background-image: url('<?php echo $image_full[0]; ?>');"></div>
	<?php	}
	}
	?>
	<article class="m-article clearfix">
		<div class="m-social-wrap">
			<ul class="share-count social-buttons">
				<li>
					<a href="http://www.facebook.com/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&t=<?php the_title(); ?>" class="socialite facebook-like reload-fb" data-href="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-share="true" data-action="like" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden"></span></a> 
				</li>
			    <li>
			         <a href="http://twitter.com/share" class="socialite twitter-share reload-twitter" data-text="<?php the_title(); ?>" data-url="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" rel="nofollow" target="_blank"><span class="vhidden"></span></a> 
			    </li>
			</ul>
		</div><!-- end .m-social-wrap -->
		<h1><?php the_title();?></h1>
		<?php if ($subtitle) { ?><h2 class="m-subtitle"><?php echo $subtitle; ?></h2><?php } ?>
		<?php if(get_the_author() != "admin" && get_the_author() != "infisherman"){ ?><span class="m-post-byline">Words by <?php echo $author; ?></span><?php } ?><?php if ($acf_byline) { ?><span class="m-post-byline">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $acf_byline;?></span><?php } ?>
		<div class="alignright-content inline-ad">
			<?php imo_ad_placement("microsite_ATF_300x250"); ?>
		</div>
		<?php the_content(); ?>
		<!-- end of the_content(); -->
		
		<div class="m-article-bottom clearfix">
			<div class="m-social-wrap">
				<p class="m-hlep-grow">Share This Article</p>
				<ul class="share-count social-buttons">
					<li>
						<a href="http://www.facebook.com/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&t=<?php the_title(); ?>" class="socialite facebook-like reload-fb" data-href="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-share="true" data-action="like" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden"></span></a> 
					</li>
				    <li>
				         <a href="http://twitter.com/share" class="socialite twitter-share reload-twitter" data-text="<?php the_title(); ?>" data-url="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" rel="nofollow" target="_blank"><span class="vhidden"></span></a> 
				    </li>
				</ul>
			</div><!-- end .m-social-wrap -->
			<div class="alignright-content inline-ad">
				<?php imo_ad_placement("microsite_BTF_300x250"); ?>
			</div>
		</div><!-- .m-article-bottom -->
	</article>
</div><!-- .m-article-wrap -->

<div class="m-banners clearfix m-banners-region">
	<div class="m-truck-container">
		<div class="m-truck">
			<div class="m-truck-title clearfix">
				<h3>RIGGED & READY</h3>
				<div title="track tips"></div>
			</div>
			<p>Explore the RAM 1500<br> Outdoorsman<sup>&reg;</sup></p>
			<a href="/rigged-ready/2015-ram-1500-outdoorsman/" class="blue-round-btn">
				<span class="m-text-under">READ NOW</span>
				<div class="m-btn-horizontal"></div>
				<div class="m-btn-vertical"></div>
				<span class="m-text-over">READ NOW</span>
			</a>
		</div>
	</div><!-- .m-truck-container -->
	<div class="m-truck-container">
		<div class="m-truck">
			<div class="m-truck-title clearfix">
				<h3>RIGGED & READY</h3>
				<div title="track tips"></div>
			</div>
			<p>Explore the RAM 1500<br> Outdoorsman<sup>&reg;</sup></p>
			<a href="/rigged-ready/2015-ram-1500-outdoorsman/" class="blue-round-btn">
				<span class="m-text-under">READ NOW</span>
				<div class="m-btn-horizontal"></div>
				<div class="m-btn-vertical"></div>
				<span class="m-text-over">READ NOW</span>
			</a>
		</div>
	</div><!-- .m-truck-container -->	
</div><!-- .m-banners -->

<div class="m-more">
	<h2>More Stories
		<?php  
			if (in_category("ne")) {
				$cat_slug1 = "ne"; $cat_name1 = "from the Northeast";
			} elseif (in_category("se")) {
				$cat_slug1 = "se"; $cat_name1 = "from the Southeast";
			} elseif (in_category("mw")) {
				$cat_slug1 = "mw"; $cat_name1 = "from the Midwest";
			} elseif (in_category("sw")) {
				$cat_slug1 = "sw"; $cat_name1 = "from the Southwest";
			} elseif (in_category("nw")) {
				$cat_slug1 = "nw"; $cat_name1 = "from the Northwest";
			} else {
				$cat_slug1 = "rigged-ready"; $cat_name1 = " ";
			}
			echo $cat_name1;
		?> 
	</h2>
	<div class="m-more-wrap clearfix">
		<?php		
		$args = array (
			'category_name'         	=> $cat_slug1,			
			'posts_per_page'      		=> 6,
			'order'						=> 'DESC',
			'orderby'					=> 'rand',
			'post__not_in'				=> array($postID)
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();								
				$image_id = get_post_meta(get_the_ID(),"image", true);
				$image = wp_get_attachment_image_src($image_id, "large");
		?>
		<a class="link-box" href="<?php the_permalink(); ?>">	
			<div class="post-box" style="background-image: url('<?php echo $image[0]; ?>')"></div>
		</a>
		<?php
				}
			} else {
				echo "not found";
			}
			wp_reset_postdata();
		?>
	</div><!-- .m-more-wrap -->
</div><!-- .m-more -->

<div class="m-loc">
	<h2>Choose A Region</h2>
	<div class="m-loc-wrap">
		<ul class="clearfix">
			<li>
				<a href="/rigged-ready/ne/">
					<div class="m-loc-circle <?php if (in_category("ne")) { echo "m-shiny-circle"; }?>"></div>
					<span>NORTHEAST</span>
				</a>
			</li>
			<li>
				<a href="/rigged-ready/se/">
					<div class="m-loc-circle <?php if (in_category("se")) { echo "m-shiny-circle"; }?>"></div>
					<span>SOUTHEAST</span>
				</a>
			</li>
			<li>
				<a href="/rigged-ready/mw/">
					<div class="m-loc-circle <?php if (in_category("mw")) { echo "m-shiny-circle"; }?>"></div>
					<span>MIDWEST</span>
				</a>
			</li>
			<li>
				<a href="/rigged-ready/sw/">
					<div class="m-loc-circle <?php if (in_category("sw")) { echo "m-shiny-circle"; }?>"></div>
					<span>SOUTHWEST</span>
				</a>
			</li>
			<li>
				<a href="/rigged-ready/nw/">
					<div class="m-loc-circle <?php if (in_category("nw")) { echo "m-shiny-circle"; }?>"></div>
					<span>NORTHWEST</span>
				</a>
			</li>
		</ul>
	</div>
</div><!-- .m-loc -->


<?php get_footer(); ?>