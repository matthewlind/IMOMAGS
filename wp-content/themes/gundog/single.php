<?php
	get_header('redesign');
	$is_single_default = true;
	global $post;
	
	$post_id		= $post->ID;
	$hide_date		= get_field('hide_date');
	$author_id		= $post->post_author;
	$author_url		= get_author_posts_url($author_id);
	$author_name	= (!get_field("author_name")) ? get_the_author() : get_field("author_name");
	$author_title	= get_field("author_title");
	
	//$byline 		= get_post_meta($post_id, 'ecpt_byline', true);
	
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
			<div class="author-wrap clearfix">
				<div class="author-img"><?php echo get_avatar($author_id, 120);?></div>
				<h4><?php echo $author_name;?></h4>
				<span class="author-title"><?php if($author_title) { echo $author_title; ?><i>&nbsp;&nbsp;•&nbsp;&nbsp;</i><br><?php }?><a href="<?php echo $author_url;?>">More From <?php echo $author_name;?></a></span>
			</div>
			<div class="social-single">
				<ul>
					<li><a href=""><i class="icon-facebook"></i><span>Share</span></a></li>
					<li><a href=""><i class="icon-twitter"></i><span>Tweet</span></a></li>
					<li><a href=""><i class="icon-envelope"></i><span>Email</span></a></li>
				</ul>
			</div>
		</header>
		<div class="article-body">
			
<?php		
		// these acf fields are numbers to push n pargraphs up or n paragraphs down the inline element
		$sponsored_el	= (!get_field('sponsored_el')) 	? 0 : get_field('sponsored_el');
		$video_el		= (!get_field('video_el')) 		? 0 : get_field('video_el');
		$inline_ad_1	= (!get_field('inline_ad_1')) 	? 0 : get_field('inline_ad_1');
		$inline_ad_2	= (!get_field('inline_ad_2')) 	? 0 : get_field('inline_ad_2');
		$inline_ad_3	= (!get_field('inline_ad_3')) 	? 0 : get_field('inline_ad_3');
		
		$p_counter 		= 0;
		$content 		= apply_filters('the_content', $post->post_content);
		$contents 		= explode("</p>", $content);
		$p_number		= count($contents);
		$ep				= array();
		$vp				= 1; // video element position
		$ap1			= 2; // inline ad positon 1
		$ap2			= 3; // inline ad positon 2
		$ap3			= 4; // inline ad positon 3
		$interval		= $p_number / 2;
		
		if 		(empty($tv_player_id)) {$video_el = 999; $ap1 = 1; $ap2 = 2; $ap3 = 3;}
		
		if 		($p_number >= 25) { $interval = $p_number / 5; }
		else if ($p_number >= 20) { $interval = $p_number / 4; } 
		else if ($p_number >= 15) { $interval = $p_number / 3; } 
		
		for 	($i = $interval; $i <= $p_number; $i+=$interval) { $ep[] = floor($i); }
		
		print_r($ep);
		
		echo '<br>' . $p_number . '<br>' . $move_el . '<br>Video position: ' . $ep[$vp] . '<br>player id: ' . $tv_player_id;
			
		foreach($contents as $content){
		    echo $content.'</p>';
		    
		    if ($p_counter == 1) { ?>
			    <div id="sticky-ad" class="sticky-ad">
				    <div class="sticky-ad-inner"></div>
			    </div>
<?php			}
		   
		    if ($p_number > 5 && $p_counter - ($sponsored_el) == $ep[0]){ ?>
				<div class="article-elem">
					<div class="ae-header">
						<div></div>
						<h4><span>Sponsored Story</span></h4>
					</div>
					<div class="ae-content sp-inner clearfix">
						<a class="ae-img" href="#"><div style="background-image: url(/wp-content/themes/imo-mags-parent/images/temp/1.jpg)"></div></a>
						<a class="ae-title" href="#"><span>Introducing the 2016 Franchi Instinct Catalyst</span></a><br>
						<div class="ae-sponsor"><span>Presented by <a href="#">Quebec Tourism</a></span></div> 
					</div>
		    	</div>
<?php 			}	


			if ($p_number > 10 && $p_counter - ($video_el) == $ep[$vp]){ ?>
				<div class="video-elem">
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
		    	</div>
<?php			}
			if ($p_number > 10 && $p_counter - ($inline_ad_1) == $ep[$ap1] || $p_number > 15 && $p_counter - ($inline_ad_2) == $ep[$ap2] || $p_number > 20 && $p_counter - ($inline_ad_3) == $ep[$ap3]){ ?>
				<div class="ad-single-inline">
					<div class="as-inner"></div>
				</div>
<?php			}
		    $p_counter++;
		    
		    
		}
		
?>		
			<div class="article-elem">
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
		</div>
		<div class="social-single">
			<ul>
				<li><a href=""><i class="icon-facebook"></i><span>Share</span></a></li>
				<li><a href=""><i class="icon-twitter"></i><span>Tweet</span></a></li>
				<li><a href=""><i class="icon-envelope"></i><span>Email</span></a></li>
			</ul>
		</div>
		<div class="a-comments">
			<div id="load-comments" class="show-comments">
				<span class="show-comm-1">Load Comments ( </span><span id="spandisqus" class="disqus-comment-count" data-disqus-url="<?php the_permalink(); ?>"></span><span class="show-comm-2">)</span>
			</div>
			<div id="disqus_thread"></div>
		</div>
		<div class="ad-single-bottom">
			<div class="as-inner"></div>
		</div>
<!-- 		<div class="grey-hr"></div> -->
		<div class="single-newsletter">
			<h3>Don’t forget to sign up!</h3>
			<p>Get the Top Stories from <?php bloginfo('name'); ?> Delivered to Your Inbox Every Week</p>
			<?php get_template_part("content/redesign/content", "newsletter"); ?>
		</div>
		<div id="ad-stop"></div>
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