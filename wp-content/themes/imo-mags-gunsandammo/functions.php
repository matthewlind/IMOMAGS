<?php
/**
 * functions.php 
 */

define("JETPACK_SITE", "gunsammo");
define("DARTADGEN_SITE", "imo.gunsandammo");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0145V&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0145V&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0NVY0NDY5Mg=");
define("SUBS_DEAL_STRING", "Save 80%");
define("DRUPAL_SITE", TRUE);

if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}


// Add new image size for post lists
add_image_size('post-thumb', 226, 147, true);


// New excerpt ending
function new_excerpt_more($more) {
  global $post;
 return '&nbsp;&hellip; ';
}
add_filter('excerpt_more', 'new_excerpt_more');


// Widget structure
function imo_addons_sidebar_init() {
  
  register_nav_menus(array(
      'subnav' => __( 'Sub Navigation', 'carrington-business' ),
      'subnav-right' => __( 'Sub Navigation - Right', 'carrington-business' ),
  ));
  
  $sidebar_defaults = array(
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title"><span>',
    'after_title' => '</span></h3>'
  );
  
  register_sidebar(array_merge($sidebar_defaults, array(
    'id' => 'sidebar-default',
    'name' => 'Blog Sidebar',
    'Shown on blog posts and archives.'
  )));

  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'header-slot',
      'name' => 'Header Slot',
      'description' => 'Shown on the right of the logo.',
  )));

  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-home',
      'name' => __('Homepage Sidebar', 'carrington-business'),
      'description' => __('Shown on the homepage.', 'carrington-business')
  )));
  
  register_sidebar(array_merge($sidebar_defaults, array(
    'id' => 'secondary-home',
    'name' => __('Homepage Secondary', 'carrington-business'),
    'description' => __('area below main and sidebar columns on the homepage', 'carrington-business')
  )));

  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-landing',
      'name' => __('Landing Page Sidebar', 'carrington-business'),
      'description' => __('Shown on Landing Pages.', 'carrington-business')
  )));	

  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-video',
      'name' => __('Video Sidebar', 'carrington-business'),
      'description' => __('Shown on video posts.', 'carrington-business')
  )));
  
  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-gallery',
      'name' => __('Gallery Sidebar', 'carrington-business'),
      'description' => __('Sidebar for Gallery posts.', 'carrington-business')
  )));
  
  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-articles',
      'name' => __('Article Sidebar', 'carrington-business'),
      'description' => __('Shown on article posts.', 'carrington-business')
  )));
      
   register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-digmag-article',
      'name' => __('DIGMAG Article Sidebar', 'carrington-business'),
      'description' => __('Shown on DIGMAG article posts.', 'carrington-business')
  )));

  register_sidebar(array_merge($sidebar_defaults, array(
      'name' => 'Bonus Sidebar',
      'id'   => 'bonus_sidebar',
      'description'   => 'Appears on pages that use the Right Sidebar template',
  )));

}
add_action( 'widgets_init', 'imo_addons_sidebar_init' );


function cfct_widgets_init() {
  $sidebar_defaults = array(
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title"><span>',
    'after_title' => '</span></h3>'
  );
  register_sidebar(array_merge($sidebar_defaults, array(
		'id' => 'sidebar-default',
		'name' => __('Blog Sidebar', 'carrington-business'),
		'description' => __('Shown on blog posts and archives.', 'carrington-business')
	)));
	register_sidebar(array_merge($sidebar_defaults, array(
		'id' => 'sidebar-news',
		'name' => __('News Sidebar', 'carrington-business'),
		'description' => __('Shown on news pages and archives.', 'carrington-business')
	)));	
}
add_action( 'widgets_init', 'cfct_widgets_init' );


// Custom Signup Form Widget powered by Gravity Forms
class Signup_Widget extends WP_Widget {
	function Signup_Widget() {
		$widget_ops = array('classname' => 'widget_gravity_form', 'description' => 'Add a Gravity Form email signup form.' );
		$this->WP_Widget('newsletter_signup', 'Newsletter Signup', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); ?>

    <aside id="newsletter_signup" class="box widget_gravity_form">
      <div class="content_wrapper">
        <?php if(!empty($title)) : ?>
        <h5 class="box_title">
          <span><?php echo $title; ?></span>
        </h5>
        <?php endif; ?>
        <?php if (function_exists('gravity_form')) gravity_form(2, false, false); ?>
      </div>
    </aside>

<?php	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
 
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => ''));
		$title = strip_tags($instance['title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
	}
}
register_widget('Signup_Widget');
