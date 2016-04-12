<?php
	get_header('redesign');
	$is_single_default = true;
	global $post;
	
	$post_id	= $post->ID;
	$author_id	= $post->post_author;
	
	$author 	= get_the_author();
	
	$byline 	= get_post_meta($post_id, 'ecpt_byline', true);
	$acf_byline = get_field("byline", $post_id);
	
	// POST CATEGORIES
	$post_categories = wp_get_post_categories( $post_id );
	$cat_list = '';
	foreach($post_categories as $c){
	    $cat = get_category( $c );
	    $cat_url = get_category_link( $c );			    
	    $cat_list .= "<a href='".  $cat_url . "'>" . $cat->name . "</a>";
	}
	
?>

<main class="main-single">
	<article id="article" class="article">
		<header class="article-header">
			<div class="post-cats">
				<?php echo $cat_list; ?>
			</div>
			<h1><?php the_title(); ?></h1>
			<div class="byline">
				<span>
<?php 				if (!$acf_byline) { 
						if ($author != 'admin') echo 'by&nbsp;' . $author . '&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;';
					} else {
						echo $acf_byline . '&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;';
					} 
					the_time('F jS, Y'); 
?>				</span>
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
<?php		$content 	= apply_filters('the_content', $post->post_content);
			$add_p		= get_field('add_p', $post_id); if (!$add_p) $add_p = 0;
			$contents = explode("</p>", $content);
			$p_counter = 0;
			foreach($contents as $content){
			    echo $content.'</p>';
			    
			    if ($p_counter == 1) { ?>
				    <div id="sticky-ad" class="sticky-ad">
					    <div class="sticky-ad-inner"></div>
				    </div>
<?php			}
			   
			    if ($current_p == 5){ ?>
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
				if ($current_p == 7){ ?>
					<div class="article-elem">
						<div class="ae-header">
							<div></div>
							<h4><span>Related</span></h4>
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
<?php			}
	
				if ($current_p == 8){ ?>
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
			    $p_counter++;
			    $current_p = $p_counter - ($add_p);
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
	    	<div class="social-single">
				<ul>
					<li><a href=""><i class="icon-facebook"></i><span>Share</span></a></li>
					<li><a href=""><i class="icon-twitter"></i><span>Tweet</span></a></li>
					<li><a href=""><i class="icon-envelope"></i><span>Email</span></a></li>
				</ul>
			</div>
		</div>

		<div id="ad-stop"></div>
	</article>
</main>




<?php get_footer('redesign'); ?>