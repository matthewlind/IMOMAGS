<?php
	get_header();
	$is_single_default = true;
	global $post;
	$permalink 		= str_replace("artem", "com", get_permalink());
	$dartdomain 	= get_option('dart_domain', false);
	$post_id		= $post->ID;
	$post_type 		= get_post_type( $post_id );
	$hide_date		= get_field('hide_date');
	$author_id		= $post->post_author;
	$author_url		= get_author_posts_url($author_id);
	$author_name	= (!get_field("author_name")) ? get_the_author() : get_field("author_name");
	$author_title	= get_field("author_title");
	$tv_player_id 	= get_field("tv_player_id","options");
	
	// for sponsored stories
	$sponsored_text = get_field("sponsored_text");
	$sponsor_logo = get_field("sponsor_logo");
	$sponsor_url = get_field("sponsor_url");
	
	// POST CATEGORIES
	$post_meta			= get_post_meta($post_id);
	$primary_cat_id		= ( !empty($post_meta["_category_permalink"][0])) ? $post_meta["_category_permalink"][0] : '';
	$post_cats			= array();
	if (empty($primary_cat_id)) {
		$post_cats = get_the_category();
		$primary_cat_name = $post_cats[0]->slug;
		$primary_cat_id	= $post_cats[0]->term_id;
	} else {
		$primary_cat_name = get_cat_name($primary_cat_id);
	}
	
	$fb_count = facebook_count($permalink);
	$fb_zero  = ($fb_count < 1) ? 'fb-zero' : '';
	
	$is_sponsored = (in_category('sponsored')) ? 1 : 0;
?>

<main class="main-single">
	<article id="article" class="article">
		<header class="article-header">
			<div class="sponsor-info">
				<?php imo_ad_placement("sponsor"); ?>
<!-- 				<img src="http://www.in-fisherman.com/files/2017/02/sponsored-logo-5.jpg"> -->
			</div>
			<div class="cat-feat-wrap">
				<?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(); } ?>
			</div>
			<h1><?php the_title(); ?></h1>			
			<div class="author-wrap clearfix">
				<?php if ($author_name != 'admin') { ?>
				<!--<div class="author-img"><?php //echo get_avatar($author_id, 120);?></div>-->
				<h4><?php echo $author_name;?></h4>
				
				<?php if ($hide_date == false) { ?> <span class="the-date"><?php the_time('F jS, Y'); ?>&nbsp;&nbsp;|&nbsp;&nbsp;</span><?php } ?>
				<span class="author-title"><?php if($author_title) { echo $author_title; ?><i>&nbsp;&nbsp;•&nbsp;&nbsp;</i><br><?php }?><a href="<?php echo $author_url;?>">More From <?php echo $author_name;?></a></span>
				<?php } ?>
			</div>
			<div class="social-single <?php echo $fb_zero; ?>">
				<ul>
					<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink; ?>&title=<?php the_title(); ?>" target="_blank"><i class="icon-facebook"></i><span>Share</span></a><b title="Facebook share count"><?php echo $fb_count; ?></b></li>
					<li><a href="http://twitter.com/intent/tweet?status=<?php the_title(); ?>+<?php echo $permalink; ?>" target="_blank"><i class="icon-twitter"></i><span>Tweet</span></a></li>
					<li><a href="mailto:?body=<?php echo $permalink; ?>"><i class="icon-envelope"></i><span>Email</span></a></li>
				</ul>
			</div>
		</header>
		<div class="article-body">
			
<?php	
//echo facebook_count('http://www.in-fisherman.com/panfish/world-record-sunfish/');
		
		// these acf fields are numbers to push n pargraphs up or n paragraphs down the inline element
		$sponsored_el	= (get_field('sponsored_el'))	? get_field('sponsored_el') : 0 ;
		$video_el		= (get_field('video_el')) 		? get_field('video_el') 	: 0 ;
		$inline_ad_1	= (get_field('inline_ad_1')) 	? get_field('inline_ad_1') 	: 0 ;
		$inline_ad_2	= (get_field('inline_ad_2')) 	? get_field('inline_ad_2') 	: 0 ;
		$inline_ad_3	= (get_field('inline_ad_3')) 	? get_field('inline_ad_3') 	: 0 ;
		
		$p_counter 		= 0;
		$content 		= apply_filters('the_content', $post->post_content);
		$contents 		= explode("</p>", $content);
		$p_number		= count($contents);
		$slots			= array();
		//$vs				= 1; // video element slot (sponsored story is in slot 0)
		$as1			= 0; // inline ad slot
		$as2			= 1; // inline ad slot
		$as3			= 2; // inline ad slot
		$interval		= $p_number / 2;
		$ad_count 		= 0;
		
		//if 		(empty($tv_player_id)) {$video_el = 999; $as1 = 1; $as2 = 2; $as3 = 3;}
		
		if 		($p_number >= 25) { $interval = $p_number / 5; }
		else if ($p_number >= 20) { $interval = $p_number / 4; } 
		else if ($p_number >= 15) { $interval = $p_number / 3; } 
		
		for 	($i = $interval; $i <= $p_number; $i+=$interval) { $slots[] = floor($i); }
		
		
		
/*
				echo '<div style="color: #4464B2;">';
		echo 'Number of paragraphs: ' . $p_number. '<br><br>';
		echo '$as1 = '. $as1 . '<br>';
		echo '$as2 = '. $as2 . '<br>';
		echo '$as3 = '. $as3 . '<br>';
		echo '$tv_player_id = '. $tv_player_id . '<br>';
		echo '$slots array: <pre>'; print_r($slots); echo '</pre>Sponsored content element is always in $slots[0]';
		echo '<br>First ad is in the slot: '.$as1.' , after '.$slots[$as1].'th paragraph<br>';
		echo 'Second ad is in the slot: '.$as2.' , after '.$slots[$as2].'th paragraph... and so on<br>';
		echo '</div>';
*/
		
		
		foreach($contents as $content){
		    echo $content.'</p>';
		    
		    if ($p_counter == 1) { ?>
			    <div id="sticky-ad" class="sticky-ad">
				    <div class="sticky-ad-inner">
					    <?php imo_ad_placement("sticky"); ?>
					</div>
			    </div>
<?php		}
			if (in_category('sponsored')) {
				if ($p_number > 10 && $p_counter - ($inline_ad_1) == $slots[$as1] || $p_number > 15 && $p_counter - ($inline_ad_2) == $slots[$as2]){ 
				$ad_count++; ?>
					<div class="ad-single-inline">
						<div class="as-inner">
							<?php 
								$tag_name = "article_ad_" . $ad_count;
								imo_ad_placement($tag_name);
							?>
						</div>
					</div>
	<?php		}
			} else {
				if ($p_number > 10 && $p_counter - ($inline_ad_1) == $slots[$as1] || $p_number > 15 && $p_counter - ($inline_ad_2) == $slots[$as2] || $p_number > 20 && $p_counter - ($inline_ad_3) == $slots[$as3]){ 
				$ad_count++; ?>
					<div class="ad-single-inline">
						<div class="as-inner">
							<?php 
								$tag_name = "article_ad_" . $ad_count;
								imo_ad_placement($tag_name);
							?>
						</div>
					</div>
	<?php		}
			}
			
		    $p_counter++;
		    
		    
		    
		}
?>		
		<div class="social-single <?php echo $fb_zero; ?>">
			<ul>
				<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $permalink; ?>&title=<?php the_title(); ?>" target="_blank"><i class="icon-facebook"></i><span>Share</span></a><b title="Facebook share count"><?php echo $fb_count; ?></b></li>
				<li><a href="http://twitter.com/intent/tweet?status=<?php the_title(); ?>+<?php echo $permalink; ?>" target="_blank"><i class="icon-twitter"></i><span>Tweet</span></a></li>
				<li><a href="mailto:?body=<?php echo $permalink; ?>"><i class="icon-envelope"></i><span>Email</span></a></li>
			</ul>
		</div>
		<div class="a-comments">
			<div id="load-comments" class="show-comments">
				<span class="show-comm-1">Load Comments ( </span><span id="spandisqus" class="disqus-comment-count" data-disqus-url="<?php the_permalink(); ?>"></span><span class="show-comm-2">)</span>
			</div>
			<div id="disqus_thread"></div>
		</div>
		<div class="ad-single-bottom">
			<div class="as-inner">
				<?php imo_ad_placement("medium_rect_after_article"); ?>
			</div>
		</div>
<!-- 		<div class="grey-hr"></div> -->
		<div class="single-newsletter">
			<h3>Don’t forget to sign up!</h3>
			<p>Get the Top Stories from <?php bloginfo('name'); ?> Delivered to Your Inbox Every Week</p>
			<?php get_template_part("content/redesign/content", "newsletter"); ?>
		</div>
		<div id="ad-stop"></div>
		<?php imo_ad_placement("fordWidget"); ?>
		<?php imo_ad_placement("e_commerce_widget"); ?> 
	</article>
</main>
<div id="more_stories" class="more-stories">
	<h1 id="ms_h1">Even More <?php echo $primary_cat_name; ?></h1>
	<div id="ms_loader">
		<div class="ms-loader-inner ball-grid-pulse">
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
	</div>
	<div id="btn_more_stories" class="btn-lg" data-cat="<?php echo $primary_cat_id; ?>" data-post-type="<?php echo $post_type; ?>" data-post-not="<?php echo $post_id; ?>" data-fb-like="<?php if (in_category('master-angler')) echo '1'; ?>" data-is-sponsored="<?php echo $is_sponsored; ?>">
		<span>Show More</span>
		<div class="loader-anim dnone">
			<div class="line-spin-fade-loader">
				<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
			</div>
		</div>
	</div>
</div>




<?php get_footer(); ?>