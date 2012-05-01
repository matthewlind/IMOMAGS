<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();
?>

<header id="masthead">
  <h1>Video</h1>
</header>
<div id="content" class="col-abc">
	<?php
$posts = query_posts($query_string . '&posts_per_page=5');
if (have_posts()) : ?>
  
  <div id="video-slideshow">
  
  <?php while (have_posts()) : the_post(); ?>

    <div class="slide" id="post-<?php the_ID(); ?>">
      
      <?php the_post_thumbnail('post-slide'); ?>
      
      <div class="slide-info">
        <span class="category"><?php echo get_the_term_list($post->ID, 'video_channel'); ?></span>
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
      'post_type' => 'imo_video',
      'limit' => '12'
    );
    the_widget('imo\IMOSliderWidget', $instance); ?>
	</section>
  
  <section class="section-title videos">
    <h4>
      <div class="icon"></div>
      <span>Categories</span>
    </h4>
  </section>

  <div class="video-category">
    <h4>Tips &amp; Tactics</h4>
    <?php $instance = array (
      'post_type' => 'imo_video',
      'limit' => '12',
      'taxonomy' => 
          array (
            0 => 'tips-tactics'
          ),
    );
    the_widget('imo\IMOSliderWidget', $instance); ?>
    <a class="cta" href="/videos/tips-tactics/">View All <span></span></a>
  </div>

  <div class="video-category">
    <h4>Reviews</h4>
    <?php $instance = array (
      'post_type' => 'imo_video',
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
      'post_type' => 'imo_video',
      'limit' => '12',
      'taxonomy' => 
          array (
            0 => 'personal-defense',
          ),

    );
    the_widget('imo\IMOSliderWidget', $instance); ?>
    <a class="cta" href="/videos/personal-defense">View All <span></span></a>
  </div>
	
</div>
<div id="sidebar">
  <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-video')) : else : ?><?php endif; ?>
</div>

<?php
get_footer();
?>
