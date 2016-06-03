<?php
	get_header('redesign');
	$post_id = $post->ID;
	$is_single_default = true;


/*
$dartDomain 		= get_option("dart_domain", $default = false);
$disqus_shortname 	= "gunsammo";
$disqus_array 		= array(
	"imo.northamericanwhitetail" => "northamericanwhitetail",
	"imo.bowhunting"	=> "bowhuntingmag",
	"imo.gundog"		=> "gundogmag",
	"imo.wildfowl"		=> "wildfowlmag",
	"imo.bowhunter"		=> "bowhuntermag",
	"imo.hunting" 		=> "petersenshunting",
	"imo.handguns"		=> "handguns",
	"imo.rifleshooter"	=> "rifleshooter",
	"imo.shootingtimes"	=> "shootingtimesmag",
	"imo.shotgunnews"	=> "shotgunnews",
	"imo.gunsandammo" 	=> "gunsammo",
	"imo.in-fisherman"	=> "infisherman",
	"imo.flyfisherman"	=> "flyfisherman"
);
foreach($disqus_array as $key=>$value) { if($dartDomain == $key) { $disqus_shortname = $value; } }
*/

// POST CATEGORIES
	$post_meta			= get_post_meta($post_id);
	$primary_cat_id		= $post_meta["_category_permalink"][0];
	$primary_cat_name	= get_cat_name($primary_cat_id);	

	

?>
<div class="section-inner-wrap"><?php get_template_part( 'nav', get_post_format() );?></div>
<main class="main-single">
	
	<article id="article" class="article">
		<header class="article-header">
			<div class="cat-feat-label">
			    <?php
				$categories = get_the_category();
				$separator = ' ';
				$output = '';
				if($dartDomain == "imo.hunting"){ $photosURL = "/rack-room?"; }
				else{$photosURL = "/photos?";}
				
				if($categories){
					foreach($categories as $category) {
						$tracking = "_gaq.push(['_trackEvent','Category','".$category->cat_name."']);";
						$output .= '<a class="category-name-link" onclick="'.$tracking.'" href="'.$photosURL.$category->slug.'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
					}
					echo trim($output, $separator);
				}
				?>
			</div>
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
			    <div class="sticky-ad-inner"></div>
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
	<h1 id="ms_h1">More Photos <?php echo $primary_cat_name; ?></h1>
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
	<div id="btn_more_stories" class="btn-lg" data-cat="<?php echo $primary_cat_id; ?>" data-post-type="reader_photos" data-post-not="<?php echo $post_id; ?>">
		<span>Show More</span>
		<div class="loader-anim dnone">
			<div class="line-spin-fade-loader">
				<div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div> <div></div>
			</div>
		</div>
	</div>
</div>



<?php get_footer('redesign'); ?>