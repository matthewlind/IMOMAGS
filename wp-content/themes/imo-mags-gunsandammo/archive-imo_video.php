<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();
?>
<div class="page-template-page-right-php right-sidebar-landing">

<div id="sidebar">
  <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-video')) : else : ?><?php endif; ?>
</div>
<div id="content">
	<div class="entry-content">
				<div class="cfct-module cfct-html section-title videos">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
  								<span>Videos</span>
						</h4>
					</div>
				</div>
<?php


//$query_string = "category_name=video-reviews";

$posts = query_posts(array('category_name' => 'video', 'posts_per_page' => 5 ));

if (have_posts()) : ?>
  
  <div id="video-slideshow">
  
  <?php while (have_posts()) : the_post(); ?>

    <div class="slide" id="post-<?php the_ID(); ?>">
      
      <?php the_post_thumbnail('post-slide'); ?>
      
      <div class="slide-info">
 
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </div>
      
      <a class="play" href="<?php the_permalink(); ?>"></a>
    </div>
      
  <?php endwhile; ?>
  
    <ul class="tabs">
      <?php while (have_posts()) : the_post(); ?>
      <li class="tab"><a href="#post-<?php the_ID(); ?>"></a></li>
      <?php endwhile; ?>
    </ul>
  
  </div>

<?php endif; ?>
  
  <section class="newest-videos">
    <h4>Newest Videos</h4>
    <?php $instance = array (
      'post_type' => 'any',
      'limit' => '12',
      'taxonomy' => 
        array (
          0 => 'video'
        ),
    );
    the_widget('imo\IMOSliderWidget', $instance); ?>
  </section>
  
  <section class="section-title videos">
    <h4>
      <div class="icon"></div>
      <span>Video Channels</span>
    </h4>
  </section>

  <div class="video-category">
    <h4>Tips &amp; Tactics</h4>
    <?php $instance = array (
      'post_type' => 'any',
      'limit' => '12',
      'taxonomy' => 
          array (
            0 => 'tips-tactics',
            1 => 'video'
          ),
    );
    the_widget('imo\IMOSliderWidget', $instance); ?>
    
    <a class="cta" href="/videos/tips-tactics/">View All <span></span></a>
  </div>

  <div class="video-category">
    <h4>Reviews</h4>
    <?php $instance = array (
      'post_type' => 'any',
      'limit' => '12',
      'taxonomy' => 
          array (
            0 => 'video-reviews',

          ),
    );
    the_widget('imo\IMOSliderWidget', $instance); ?>
    <a class="cta" href="/videos/video-reviews">View All <span></span></a>
  </div>

  <div class="video-category">
    <h4>Personal Defense</h4>
    <?php $instance = array (
      'post_type' => 'any',
      'limit' => '12',
      'taxonomy' => 
          array (
            0 => 'personal-defense',
            1 => 'video'
          ),

    );
    the_widget('imo\IMOSliderWidget', $instance); ?>
    <a class="cta" href="/videos/personal-defense">View All <span></span></a>
  </div>
  
</div>


<?php
get_footer();
?>
