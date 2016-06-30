<?php 
	global $microsite, $microsite_rigged;
	$microsite = true;
	$microsite_rigged = true;
	
	get_header(); 
// echo get_template_part( 'header', 'shoot101' ); 
	$category = get_the_category(); 
	$cat_slug = $category[0]->slug;
	$cat_name = $category[0]->cat_name;
	
/*
	$category_parent_id = $category[0]->category_parent;
	$category_parent = get_term( $category_parent_id, 'category' );
	$category_parent_slug = $category_parent->slug;
*/

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
		<h1><?php the_title(); ?></h1>
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

<?php
	
	if (in_category('rigged-ready')) {
		get_template_part('content//microsite-template-parts/rigged-ready/sweeps', 'banner'); 
	} elseif (in_category('deer-zone')) {
		get_template_part('content//microsite-template-parts/deer-zone/sweeps', 'banner'); 
	}
	
	 
?>

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
				$cat_slug1 = $category_parent_slug; $cat_name1 = " ";
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

<?php 
	if (in_category('rigged-ready')) {
		get_template_part('content/microsite-template-parts/rigged-ready/choose', 'location-bottom');  
	} elseif (in_category('deer-zone')) {
		get_template_part('content/microsite-template-parts/deer-zone/choose', 'location-bottom');  
	}
	
	get_footer(); 
?>