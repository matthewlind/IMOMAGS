<?php
	get_header('redesign');
	$is_single_default = true;
	global $post;
	
	$dartdomain 	= get_option('dart_domain', false);
	$post_id		= $post->ID;
	$hide_date		= get_field('hide_date');
	$author_id		= $post->post_author;
	$author_url		= get_author_posts_url($author_id);
	$author_name	= (!get_field("author_name")) ? get_the_author() : get_field("author_name");
	$author_title	= get_field("author_title");
	$byline 		= get_post_meta($post_id, 'ecpt_byline', true);
	if(!$byline){
		$byline 		= get_field("byline");
	}
	
	
	$tv_player_id 	= get_field("tv_player_id","options");
	
	// POST CATEGORIES
	$post_meta			= get_post_meta($post_id);
	$primary_cat_id		= $post_meta["_category_permalink"][0];
	$primary_cat_name	= get_cat_name($primary_cat_id);	

?>

<main class="main-single">
	<article id="article" class="article">
		<header class="article-header">
			<div class="cat-feat-wrap">
				<?php if (function_exists('primary_and_secondary_categories')){ echo primary_and_secondary_categories(); } ?>
				<?php if ($hide_date == false) { ?> <div class="the-date"><?php the_time('F jS, Y'); ?></div> <?php } ?>
			</div>
			<h1><?php the_title(); ?></h1>
			<div class="byline"><span><?php if($byline) { echo $byline; } ?></span></div>
			<div class="author-wrap clearfix">
				<!--<div class="author-img"><?php //echo get_avatar($author_id, 120);?></div>-->
				<h4><?php echo $author_name;?></h4>
				<span class="author-title"><?php if($author_title) { echo $author_title; ?><i>&nbsp;&nbsp;•&nbsp;&nbsp;</i><br><?php }?><a href="<?php echo $author_url;?>">More From <?php echo $author_name;?></a></span>
			</div>
			<div class="social-single">
				<ul>
					<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank"><i class="icon-facebook"></i><span>Share</span></a></li>
					<li><a href="http://twitter.com/intent/tweet?status=<?php the_title(); ?>+<?php the_permalink(); ?>" target="_blank"><i class="icon-twitter"></i><span>Tweet</span></a></li>
					<li><a href="mailto:?body=<?php the_permalink(); ?>"><i class="icon-envelope"></i><span>Email</span></a></li>
				</ul>
			</div>
		</header>
		<div class="article-body">
			
<?php		
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
		$vs				= 1; // video element slot (sponsored story is in slot 0)
		$as1			= 2; // inline ad slot
		$as2			= 3; // inline ad slot
		$as3			= 4; // inline ad slot
		$interval		= $p_number / 2;
		$ad_count 		= 0;
		
		if 		(empty($tv_player_id)) {$video_el = 999; $as1 = 1; $as2 = 2; $as3 = 3;}
		
		if 		($p_number >= 25) { $interval = $p_number / 5; }
		else if ($p_number >= 20) { $interval = $p_number / 4; } 
		else if ($p_number >= 15) { $interval = $p_number / 3; } 
		
		for 	($i = $interval; $i <= $p_number; $i+=$interval) { $slots[] = floor($i); }
		
		/*
		echo '<div style="color: #4464B2;">';
		echo 'Number of paragraphs: ' . $p_number. '<br><br>';
		echo '$slots array: <pre>'; print_r($slots); echo '</pre>Sponsored content element is always in $slots[0]';
		echo '<br>First ad is in the slot: '.$as1.' , after '.$slots[$as1].'th paragraph<br>';
		echo 'Second ad is in the slot: '.$as2.' , after '.$slots[$as2].'th paragraph... and so on<br>';
		echo '</div>';
		*/
		foreach($contents as $content){
		    echo $content.'</p>';
		    
		    if ($p_counter == 1) { ?>
			    <div id="sticky-ad" class="sticky-ad">
				    <div class="sticky-ad-inner"><iframe class="iframe-ad" onload="resizeIframe(this)" width="300" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term=<?php echo $term; ?>&camp=<?php echo $camp; ?>&ad_code=<?php echo $dartdomain; ?>&ad_unit=sticky&page=article"></iframe></div>
			    </div>
<?php			}
		   
		   // if ($p_number > 5 && $p_counter - ($sponsored_el) == $slots[0]){ ?>
				<!--<div class="article-elem">
					<div class="ae-header">
						<div></div>
						<h4><span>Sponsored Story</span></h4>
					</div>
					<div class="ae-content sp-inner clearfix">
						<a class="ae-img" href="#"><div style="background-image: url(/wp-content/themes/imo-mags-parent/images/temp/1.jpg)"></div></a>
						<a class="ae-title" href="#"><span>Introducing the 2016 Franchi Instinct Catalyst</span></a><br>
						<div class="ae-sponsor"><span>Presented by <a href="#">Quebec Tourism</a></span></div> 
					</div>
		    	</div>-->
<?php 			//}	


			if ($p_number > 10 && $p_counter - ($video_el) == $slots[$vs]){ ?>
				<!--<div class="video-elem">
					<div class="ve-head">
						<h4>DON’T MISS IN-FISHERMAN TV</h4>
						<span>Saturday’s at 10am ET on <a href="">Sportsman Channel</a></span>
					</div>
					<div class="ve-content">
						<ul class="clearfix">
							<li>
								<a class="ve-img" href="#">
									<div style="background-image: url(/wp-content/themes/imo-mags-parent/images/temp/1.jpg)">
										<div class="ae-play"><div class="ae-triangle"></div></div>
									</div>
								</a>
								<a href=""><h4>Lure Strategies for Ice Walleyes</h4></a>
							</li>
							<li>
								<a class="ve-img" href="#">
									<div style="background-image: url(/wp-content/themes/imo-mags-parent/images/temp/1.jpg)">
										<div class="ae-play"><div class="ae-triangle"></div></div>
									</div>
								</a>
								<a href=""><h4>Lorem Ipsum Dolor Reveals Some of The Season's</h4></a>
							</li>
							<li>
								<a class="ve-img" href="#">
									<div style="background-image: url(/wp-content/themes/imo-mags-parent/images/temp/1.jpg)">
										<div class="ae-play"><div class="ae-triangle"></div></div>
									</div>
								</a>
								<a href=""><h4>Lure Strategies for Ice Walleyes</h4></a>
							</li>
						</ul>
					</div>
					<a class="ve-link" href="#">Watch More In-Fisherman TV</a>
		    	</div>-->
<?php			}
			if ($p_number > 10 && $p_counter - ($inline_ad_1) == $slots[$as1] || $p_number > 15 && $p_counter - ($inline_ad_2) == $slots[$as2] || $p_number > 20 && $p_counter - ($inline_ad_3) == $slots[$as3]){ 
			$ad_count++; ?>
				<div class="ad-single-inline">
					<div class="as-inner"><iframe class="iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term=<?php echo $term; ?>&camp=<?php echo $camp; ?>&ad_code=<?php echo $dartdomain; ?>&ad_unit=mediumRectangle&page=article&pos=inline-<?php echo $ad_count; ?>"></iframe></div>
				</div>
<?php			}
		    $p_counter++;
		    
		    
		    
		}
?>		
			<!--<div class="article-elem">
				<div class="ae-header">
					<div></div>
					<h4><span>Read This Next</span></h4>
				</div>
				<div class="ae-content clearfix">
					<a class="ae-img" href="#">
						<div style="background-image: url(/wp-content/themes/imo-mags-parent/images/temp/1.jpg)">
							<div class="ae-play"><div class="ae-triangle"></div></div>
						</div>
					</a>
					<a class="ae-title" href="#">
						<span>Lure Strategies for Ice Walleyes</span>
						<p>Check out this video: The In-Fisherman staff reveals some of the season's slickest new lure strategies for ice walleyes.</p>
					</a>
				</div>
	    	</div>
		</div>-->
		<div class="social-single">
			<ul>
				<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank"><i class="icon-facebook"></i><span>Share</span></a></li>
				<li><a href="http://twitter.com/intent/tweet?status=<?php the_title(); ?>+<?php the_permalink(); ?>" target="_blank"><i class="icon-twitter"></i><span>Tweet</span></a></li>
				<li><a href="mailto:?body=<?php the_permalink(); ?>"><i class="icon-envelope"></i><span>Email</span></a></li>
			</ul>
		</div>
		<div class="a-comments">
			<div id="load-comments" class="show-comments">
				<span class="show-comm-1">Load Comments ( </span><span id="spandisqus" class="disqus-comment-count" data-disqus-url="<?php the_permalink(); ?>"></span><span class="show-comm-2">)</span>
			</div>
			<div id="disqus_thread"></div>
		</div>
		<div class="ad-single-bottom">
			<div class="as-inner"><iframe class="iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term=<?php echo $term; ?>&camp=<?php echo $camp; ?>&ad_code=<?php echo $dartdomain; ?>&ad_unit=mediumRectangle&page=article&pos=btf"></iframe></div>
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
	<div id="btn_more_stories" class="btn-lg" data-cat="<?php echo $primary_cat_id; ?>" data-post-not="<?php echo $post_id; ?>">
		<span>Show More</span>
		<div class="loader-anim dnone">
			<div class="line-spin-fade-loader">
				<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
			</div>
		</div>
	</div>
</div>




<?php get_footer('redesign'); ?>