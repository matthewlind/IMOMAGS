<?php
$dartDomain = get_option('dart_domain', false);
$is_home_cat= true;
$string = parse_url($_SERVER['REQUEST_URI']);
$term = (empty($string["query"])) ? '' : $string["query"];
$args = array(
	'category_name' => $term,
	'post_type' => $post_type,
	'posts_per_page' => 8,
	'order' => 'DESC'
);
?>

<div id="sections_wrap" class="sections-wrap">
	<section class="section-photo-menu">
		<div class="section-inner-wrap">
		<?php //get_template_part( 'nav', get_post_format() ); ?>
			<div class="community-header">
				<div class="header-section community-logo">
					<a href="/photos/"><img src="/wp-content/themes/osg-parent/images/photo-page/<?php echo $dartDomain; ?>-photos.png" alt="Reader Photos" title="Reader Photos" /></a>
					<div class="community-mobile-menu"><div class="select-arrow"></div>Photos Menu</div>
				</div>
				<?php $photosMenu = get_field("photos_menu", "options"); ?>
				<div class="header-section menu-photo-wrap">
					<ul class="menu">
						<?php if( $photosMenu ){ 
							foreach( $photosMenu as $menu ){  
								$categoryList = get_term_by('id', $menu, 'category'); ?>
								<ul class="sub-list">
									<li class="sub-list"><a href="/photos?<?php echo $categoryList->slug; ?>" class="photo-menu" slug="<?php echo $categoryList->slug; ?>"><?php echo $categoryList->name; ?></a></li>
								</ul>
							<?php } ?>
						<?php } ?>
					</ul>
				</div>			
				<div class="community-nav-below clearfix">
					<a href="/post-photo/">Share Your Photo Now!</a>
					<?php if ($dartDomain == 'imo.in-fisherman') echo '<a href="/entry-form/">Enter Master Angler</a>'; ?>
				</div>
			</div>
		</div>
	</section>
	<section class="section-latest-posts">
		<div id="l_container" class="section-inner-wrap">
<!-- 			<h1 class="main-h"><?php echo $ph_cat_name;?></h1> -->
			<ul id="latest_list" class="c-list">
			<?php	
				$query = new WP_Query( $args );	
				$p_counter = 0;		
				if ( $query->have_posts() ) { 
					while ( $query->have_posts() ) { 
						$query->the_post();
					?>
					<li class="c-item">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('list-thumb'); ?></a>
						<div class="c-info">
							<div class="c-cats">
							    <?php
								$categories = get_the_category();
								$separator = ', ';
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
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</div>
					</li>
					<?php 
						if ($p_counter == 1) {
							echo '<li class="c-ad ad-wrap"><span class="ad-span">Advertisement</span><div id="c_ad_inner" class="ad-inner"><iframe class="iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term='.$term.'&camp='.$camp.'&ad_code='.$dartDomain.'&ad_unit=mediumRectangle&page=category"></iframe></div></li>';
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
			<div id="btn_more_posts" class="btn-lg"  data-post-not="" data-cat-slug="<?php echo $term;?>">
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