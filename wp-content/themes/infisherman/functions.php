<?php

define("JETPACK_SITE", "infisherman");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=01469&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=01469&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0Njk0NDY5NSZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 70% off<br/> the Cover Price");
define("DRUPAL_SITE", TRUE);

// Widgets
include_once('widgets/subscribe.php');
include_once('widgets/newsletter-signup.php');


function new_excerpt_more( $more ) {
	return '... <a href="'. get_permalink( get_the_ID() ) .'" >more <span class="meta-nav">&raquo;</span></a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function if_addons_sidebar_init() {

$sidebar_defaults = array(
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title"><span>',
    'after_title' => '</span></h3>'
  );

register_sidebar(array_merge($sidebar_defaults, array(
    'id' => 'sidebar-community',
    'name' => 'Community Sidebar',
    'Shown on community pages.'
  )));
}
add_action( 'widgets_init', 'if_addons_sidebar_init' );

//Uses WordPress filter for image_downsize
function my_image_downsize($value = false,$id = 0, $size = "medium") {
	if ( !wp_attachment_is_image($id) )
		return false;
	$img_url = wp_get_attachment_url($id);

	$height;
	$width;

	//Mimic functionality in image_downsize function in wp-includes/media.php
	if ( $intermediate = image_get_intermediate_size($id, $size) ) {
		$img_url = str_replace(basename($img_url), $intermediate['file'], $img_url);
		$height = $intermediate['height'];
		$width = $intermediate['width'];

	}
	elseif ( $size == 'thumbnail' ) {
		// fall back to the old thumbnail
		if ( $thumb_file = wp_get_attachment_thumb_file() && $info = getimagesize($thumb_file) ) {
			$img_url = str_replace(basename($img_url), basename($thumb_file), $img_url);
			$width = $info[0];
			$height = $info[1];
		}
	}

	//Return the image and height and width
	if ( $img_url) {

		return array($img_url, $width, $height);
	}
	return false;
}
add_filter('image_downsize', 'my_image_downsize',1,3);



//Configure infish community
//This section does nothing unless imo-community plugin is enabled
add_action("init","infish_community_init");
function infish_community_init() {

	//////////////////////////////////
	//Community Configuration
	//////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "community";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'In-Fisherman Community';
	$IMO_COMMUNITY_CONFIG['template'] = '/templates/blank-template.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'infish_community';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'infishcommunity';
	$IMO_COMMUNITY_CONFIG['post_types'] = array(

		"report" => array(
			"display_name" => "Rut Reports",
			"post_list_style" => "tile"
		),

		"question" => array(
			"display_name" => "Q&A",
			"post_list_style" => "list"
		),

		"general" => array(
			"display_name" => "general",
			"post_list_style" => "list"
		)

	);
	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		//Third Part Scripts
		array(
			"script-name" => "underscore-js",
			"script-path" => "js/underscore-min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "backbone-js",
			"script-path" => "js/backbone-min.js",
			"script-dependencies" => array('jquery','underscore-js')
		),
		array(
			"script-name" => "form-params-js",
			"script-path" => "js/formParams.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "filepicker-io-js",
			"script-path" => "js/filepicker.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "imo-community-grid-js",
			"script-path" => "js/backgrid.min.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js')
		),
		//Application specific scripts
		array(
			"script-name" => "imo-community-common",
			"script-path" => "js/common.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js')
		),
		array(
			"script-name" => "imo-community-models",
			"script-path" => "js/models.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-common')
		),
		array(
			"script-name" => "imo-community-mod",
			"script-path" => "js/mod2.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-models','imo-community-common')
		),
		array(
			"script-name" => "imo-community-community",
			"script-path" => "js/community.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-models','imo-community-common','imo-community-mod')
		),
		array(
			"script-name" => "imo-community-routes",
			"script-path" => "js/routes.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-community','imo-community-mod')
		),
		array(
			"script-name" => "backgrid-select-all",
			"script-path" => "js/backgrid-select-all.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-grid-js','custom.js','jquery.timeago.js')
		)

	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "imo-community-stylesheet-main",
			"style-path" => "css/bootstrap.min.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "stylesheet_responsive",
			"style-path" => "css/bootstrap-responsive.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "imo-community-grid-css",
			"style-path" => "css/backgrid.min.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "styles-select-all",
			"style-path" => "css/styles-select-all.css",
			"style-dependencies" => array('custom.css')
		),
		array(
			"style-name" => "stylesheet_custom",
			"style-path" => "css/custom.css",
			"style-dependencies" => null
		)
	);
	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['beta-community'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////



	//////////////////////////////////
	//Solunar Calendar iPad Embed config
	//////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "solunar-calendar-ipad";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Solunar Calendar';
	$IMO_COMMUNITY_CONFIG['template'] = '/solunar/solunar-template-minimal.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'solunar_calendar';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'solunarcalendar';
	$IMO_COMMUNITY_CONFIG['post_types'] = null;
	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		array(
			"script-name" => "jquery-mousewheel-zf",
			"script-path" => "solunar/js/plugins/zfselect/js/jquery.mousewheel.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "jquery-zfselect",
			"script-path" => "solunar/js/plugins/zfselect/js/jquery.zfselect.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "jquery-carousel-fred",
			"script-path" => "solunar/js/plugins/carouFredSel/jquery.carouFredSel-6.2.0-packed.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "lodash",
			"script-path" => "solunar/js/lodash.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "solunar-googletag",
			"script-path" => "solunar/js/googletag.js",
			"script-dependencies" => null,
			"show-in-header" => true
		),
		array(
			"script-name" => "solunar-app",
			"script-path" => "solunar/js/script.js",
			"script-dependencies" => array('jquery','lodash','jquery-carousel-fred','jquery-zfselect','jquery-mousewheel-zf')
		),



	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "solunar-base-css",
			"style-path" => "solunar/css/css-php.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "solunar-style-css",
			"style-path" => "solunar/css/styles.css?v=2",
			"style-dependencies" => null
		),
		array(
			"style-name" => "zfselect-css",
			"style-path" => "solunar/js/plugins/zfselect/css/zfselect.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "flexslider-css",
			"style-path" => "solunar/js/plugins/flexslider/flexslider.css",
			"style-dependencies" => null
		),
	);
	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['solunar-calendar-ipad'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////
	/////////////////////////////////////////////////



	//////////////////////////////////
	//Solunar Calendar config
	//////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "solunar-calendar";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Solunar Calendar';
	$IMO_COMMUNITY_CONFIG['template'] = '/solunar/solunar-template.php';
	$IMO_COMMUNITY_CONFIG['post_types'] = null;
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'solunar_calendar';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'solunarcalendar';
	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		array(
			"script-name" => "jquery-mousewheel-zf",
			"script-path" => "solunar/js/plugins/zfselect/js/jquery.mousewheel.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "jquery-zfselect",
			"script-path" => "solunar/js/plugins/zfselect/js/jquery.zfselect.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "jquery-carousel-fred",
			"script-path" => "solunar/js/plugins/carouFredSel/jquery.carouFredSel-6.2.0-packed.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "lodash",
			"script-path" => "solunar/js/lodash.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "solunar-googletag",
			"script-path" => "solunar/js/googletag.js",
			"script-dependencies" => null,
			"show-in-header" => true
		),
		array(
			"script-name" => "solunar-app",
			"script-path" => "solunar/js/script.js",
			"script-dependencies" => array('jquery','lodash','jquery-carousel-fred','jquery-zfselect','jquery-mousewheel-zf')
		),

	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "solunar-base-css",
			"style-path" => "solunar/css/css-php.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "solunar-style-css",
			"style-path" => "solunar/css/styles.css?v=2",
			"style-dependencies" => null
		),
		array(
			"style-name" => "zfselect-css",
			"style-path" => "solunar/js/plugins/zfselect/css/zfselect.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "flexslider-css",
			"style-path" => "solunar/js/plugins/flexslider/flexslider.css",
			"style-dependencies" => null
		),
	);
	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['solunar-calendar'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////
	/////////////////////////////////////////////////

	//////////////////////////////////
	//Mobile Solunar Calendar config
	//////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "solunar-calendar-mobile";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Solunar Calendar';
	$IMO_COMMUNITY_CONFIG['template'] = '/solunar-mobile/solunar-template-mobile.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'solunar_calendar';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'solunarcalendar';
	$IMO_COMMUNITY_CONFIG['post_types'] = null;

	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['solunar-calendar-mobile'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////
}


define('TIMELY_FEATURES', 'timely-features');
define('MASTER_ANGLERS', 'master-angler');
define('FEATURED', 'featured');
define('CATFISH', 'catfish');
define('ICE_FISHING', 'ice-fishing');
define('TRTUT_SALMON', 'trout-salmon');
define('PANFISH', 'panfish');
define('WALLEYE', 'walleye');

add_theme_support( 'post-thumbnails' ); 
add_action( 'widgets_init', 'infisherman_widgets_init' );
add_action('after_setup_theme', 'infisherman_setup');
add_action( 'widgets_init', 'register_recipes_widget' );  
// add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

// function special_nav_class($classes, $item){
//     $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
//     if (!empty($children)) {
//         $classes[] = 'has-drop';
//     }    
//     return $classes;
// }

class AddParentClass_Walker extends Walker_Nav_Menu 
{
    
    function start_lvl( &$output, $depth ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
            );
        $class_names = implode( ' ', $classes );
      
        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

    function end_lvl( &$output, $depth ) {
       
        if ($depth > 0) {
            $output .= "\n" . '</div>' . "\n";    
        }
        $output .= "\n" . '</ul>' . "\n";
    }

    function start_el( &$output, $item, $depth, $args ) 
    {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
      
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
      
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
      
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
      
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $has_drop = '';
        $template = '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s';
        $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
        if (!empty($children)) {
            $has_drop = 'has-drop';
            $template = '%1$s<a%2$s>%3$s%4$s%5$s</a><div class="drop-down">%6$s';
        }  

        $attributes .= ' class="menu-link ' . $has_drop . ' ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
      
        
        $item_output = sprintf( $template,
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
      
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    function end_el( &$output, $item, $depth, $args ) 
    {
        global $wp_query;
        $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
      
        if (!empty($children)) {
            if ($item->object == 'category') {
                $query = new WP_Query(array( 
                    'category__and' =>  
                        array_merge(get_categories_ids(array(
                            FEATURED
                        )), array((int)$item->object_id)),
                    'posts_per_page' => 1 ) 
                );

                ob_start(); 
?>
                <?php while ($query->have_posts()): $query->the_post();?>
                    <div class="drop-feat-post">
                        <h4 class="submenu-category-title"><?php echo $item->title ?></h4>
                        <a class="drop-feat-img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(230, 155)); ?></a>
                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    </div>
                <?php endwhile; ?>
<?php
                    $output .= ob_get_contents();
                    ob_end_clean();
            }
        }

        $output .= apply_filters( 'walker_nav_menu_end_el', '</li>', $item, $depth, $args );
    }
}

function register_recipes_widget() {  
    register_widget( 'Recipes_Widget' );  
}  

class Recipes_Widget extends WP_Widget
{
    function __construct() {
        $widget_ops = array( 'classname' => 'recipes', 'description' => __('A widget that displays the last recipes ', 'recipes') );
        
        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'recipes-widget' );
        
        $this->WP_Widget( 'recipes-widget', __('Recipes Widget', 'recipes'), $widget_ops, $control_ops );
    }
    
    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title'] );

        echo $before_widget;

        if ( $title )
            echo $before_title . $title . $after_title;

        $query = new WP_Query( 'category_name=recipes&posts_per_page=1' );

        ?>

        <?php if ($query->have_posts()): ?>
        <div data-position="8" class="recipes-holder js-responsive-section">
            <h3 class="widget-title hidden-widget-title">Recipes</h3>
            <div class="recipes-box">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php the_post_thumbnail(array(125,80)); ?>
                    <div class="recipes-text">
                        <h3><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
                        <div class="comment-count"><?php echo get_comments_number(); ?> Comments</div>
                    </div>
            <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>
        <?php

        
        echo $after_widget;
    }
     
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }

    
    function form( $instance ) {
        $defaults = array( 'title' => __('Recipes', 'recipes'));
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'recipes'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>

        <?php
    }

}        

function imo_sidebar($type){
	$dartDomain = get_option("dart_domain", $default = false);
	echo '<div class="sidebar-area">';
	    get_sidebar($type);
	    if (!is_mobile()) { 
		    echo '<div id="responderfollow"></div>';
			echo '<div class="sidebar advert">';
				echo '<div class="widget_advert-widget">';
					echo '<iframe id="sticky-iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-sticky.php?ad_code='.$dartDomain.'"></iframe>';
					//imo_dart_tag("300x250",array("pos"=>"btf"));
				echo '</div>';
				if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; 
			echo '</div>';
		}
	echo '</div>';
}
function social_networks(){
	echo '<div class="socials">';
		echo '<a href="https://www.facebook.com/InFisherman" class="facebook">Facebook</a>';
	    echo '<a href="https://www.twitter.com/@InFishermanTV" class="twitter">Twitter</a>';
	    echo '<a href="http://www.youtube.com/user/InFishermanTV" class="youtube">YouTube</a>';
	    echo '<a href="http://www.in-fisherman.com/feed/" class="rss">RSS</a>';
	echo '</div>';
}

function infisherman_setup()
{
    // This theme uses a custom image size for featured images, displayed on "standard" posts.
    //add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 100, 9999 ); // Unlimited height, soft crop
    add_image_size( 'index-thumb', 200, 150, true );
    add_image_size( 'post-thumb', 700, 450, true );
    add_image_size( 'post-home-thumb', 695, 460, true );
    add_image_size( 'post-home-small-thumb', 335, 225, true );
}

function infisherman_widgets_init() 
{

    // register_widget( 'Twenty_Eleven_Ephemera_Widget' );

    /*register_sidebar( array(
        'name' => __( 'Header Sidebar', 'infisherman' ),
        'id' => 'sidebar-header',
        'before_widget' => '<div id="%1$s" class="widget %2$s header-elements">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Header Sidebar First', 'infisherman' ),
        'id' => 'sidebar-header-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s header-elements">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Header Sidebar Second', 'infisherman' ),
        'id' => 'sidebar-header-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s header-elements">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );*/

    register_sidebar( array(
        'name' => __( 'Home Sidebar', 'infisherman' ),
        'id' => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Article Sidebar', 'infisherman' ),
        'id' => 'sidebar-2',
        'description' => __( 'The sidebar for the optional Showcase Template', 'twentyeleven' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    /*register_sidebar( array(
        'name' => __( 'Footer Area One', 'infisherman' ),
        'id' => 'sidebar-3',
        'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Area Two', 'infisherman' ),
        'id' => 'sidebar-4',
        'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Area Three', 'infisherman' ),
        'id' => 'sidebar-5',
        'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Main Menu', 'infisherman' ),
        'id' => 'sidebar-6',
        'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );*/

    register_nav_menus(array(  
        'top' => 'Top Menu',  
        'bottom' => 'Bottom Menu'
    )); 
}

function infisherman_get_categories($categories_list, $show_featured = true)
{
    $categories = implode(' ', 
        array_map(
            function($item){
                return '<span class="category-name-box"><a class="category-name-link" href="'.esc_url(get_category_link(get_cat_ID($item->name))).'">'.$item->name.'</a></span>';
            }, 
            array_filter(
                $categories_list, 
                function ($item) use ($show_featured) {
                    if (($item->slug == TIMELY_FEATURES || $item->slug == FEATURED) && !$show_featured) {
                        return false;
                    }
                    return true;
                }
            )
        )
    );

    return $categories;
}

/**
 * This function returns categories ids in array
 * @param  array $slugs  list of categories slugs
 * @return array         list of categories ids
 */
function get_categories_ids($slugs){
    $ids = array_map(function($slug){
        $category = get_category_by_slug($slug);
        if (!is_null($category)) {
            return  $category->term_id;
        }
        return null;
    }, $slugs);
    return $ids;
}

function get_more_posts_query($limit = 4)
{
    $query = new WP_Query(array( 
        'category__not_in' =>  
            get_categories_ids(array(
                MASTER_ANGLERS, TIMELY_FEATURES, FEATURED
            )),
        'posts_per_page' => $limit ) 
    );
    return $query;
}

function get_category_title_by_slug($slug)
{
    $category = get_category_by_slug($slug);
    return $category->name;
}


function render_shares_count($url, $post_id)
{
    $elem_id = $post_id.rand(0,9999);
    ?>
    <script type="text/javascript">
    jQuery(function(){
        // addthis.ready(function(){
        window.setTimeout(function(){
            addthis.sharecounters.getShareCounts({service: 'facebook', countUrl: "<?php echo $url ?>"}, function(obj) {
                setCountShares(obj.count, "share-count-<?php echo $elem_id ?>")
            })
            addthis.sharecounters.getShareCounts({service: 'twitter', countUrl: "<?php echo $url ?>"}, function(obj) {
                setCountShares(obj.count, "share-count-<?php echo $elem_id ?>")
            })
            addthis.sharecounters.getShareCounts({service: 'google', countUrl: "<?php echo $url ?>"}, function(obj) {
                setCountShares(obj.count, "share-count-<?php echo $elem_id ?>")
            })
        }, 1500);
        // })
    });

    function setCountShares(count, elemid)
    {
        if (count == '?')
            count = 0;

        jQuery("#"+elemid).text(
            parseInt(jQuery("#"+elemid).text()) + count
        ) 

    }
    </script>
    <div id="share-count-<?php echo $elem_id; ?>">0</div>
    <?php
}

function infisherman_get_search_form($echo = true) {
    do_action( 'get_search_form' );

    $search_form_template = locate_template('searchform.php');
    if ( '' != $search_form_template ) {
        require($search_form_template);
        return;
    }

    $form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/' ) ) . '" >
    <div class="search-field"><!-- label class="screen-reader-text" for="s">' . __('Search for:') . '</label -->
    <input type="text" placeholder="Search" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </div>
    </form>';

    if ( $echo )
        echo apply_filters('get_search_form', $form);
    else
        return apply_filters('get_search_form', $form);
}

function infisherman_get_featured_posts_query_in_slider()
{
    add_filter( 'posts_where', 'infisherman_filter_where' );
    $query = new WP_Query(
        array( 
            'category' => FEATURED,
            'posts_per_page' => 9
        )
    );
    remove_filter( 'posts_where', 'infisherman_filter_where' );

    return $query; 
}

function infisherman_filter_where( $where = '' ) {
    $where .= " AND post_name LIKE '%featured%'";
    return $where;
}

function isset_related_posts()
{
    ob_start(); 
    related_posts();
    $output .= ob_get_contents();
    ob_end_clean();
    return (false == strpos($output, 'No related photos'));
}



/**
 * Callback Handler for the admin_menu action.
 */
function imo_addons_create_subscriptions_menu() {
    add_menu_page("Subscriptions Settings", "Subscription Settings",
        "administrator", 'subs', "imo_addons_subscription_page");
    add_action("admin_init", "register_imo_subscribe_settings");
}
function register_imo_subscribe_settings () {
    register_setting( 'imo-subs-settings-group', 'iMagID' );
    register_setting( 'imo-subs-settings-group', 'deal_copy' );
    register_setting( 'imo-subs-settings-group', 'subs_link' );
    register_setting( 'imo-subs-settings-group', 'gift_link' );
    register_setting( 'imo-subs-settings-group', 'service_link' );
    register_setting( 'imo-subs-settings-group', 'magazine_cover_uri' );
    register_setting( 'imo-subs-settings-group', 'sons_header_uri' );
    register_setting( 'imo-subs-settings-group', 'defend_header_uri' );
    register_setting( 'imo-subs-settings-group', 'history_header_uri' );
    register_setting( 'imo-subs-settings-group', 'competition_header_uri' );
    register_setting( 'imo-subs-settings-group', 'news_header_uri' );
    register_setting( 'imo-subs-settings-group', 'zombie_header_uri' );
    register_setting( 'imo-subs-settings-group', 'affiliates_desc_uri' );
    register_setting( 'imo-subs-settings-group', 'ma_desc_uri' );
    register_setting( 'imo-subs-settings-group', 'subs_form_link' );
    register_setting( 'imo-subs-settings-group', 'i4ky' );
}
/**
 *HTML generation call back for the Subscriptions settings page.
 * @see imo_addons_create_subscriptions_menu()
 */
function imo_addons_subscription_page() {
?>
<div class="wrap">
<h2>Subscription Settings</h2>
<form method="post" action="options.php">
<?php settings_fields( 'imo-subs-settings-group' ); ?>
<table class="form-table">
		<tr valign="top">
        <td><strong>Magazine Section</strong></td>
        </tr>
        <tr valign="top">
        <th scope="row">Deal Copy</th>
        <td><input type="text" name="deal_copy" value="<?php echo get_option('deal_copy'); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Subscription Link</th>
        <td><input type="text" name="subs_link" value="<?php echo get_option('subs_link'); ?>" /></td>
        </tr>
         <tr valign="top">
        <th scope="row">Gift Link</th>
        <td><input type="text" name="gift_link" value="<?php echo get_option('gift_link'); ?>" /></td>
        </tr>
         <tr valign="top">
        <th scope="row">Service Link</th>
        <td><input type="text" name="service_link" value="<?php echo get_option('service_link'); ?>" /></td>
        </tr><tr valign="top">
        <th scope="row">Magazine Cover URL</th>
        <td><input type="text" name="magazine_cover_uri" value="<?php echo get_option('magazine_cover_uri'); ?>" /></td>
        </tr>
        <tr valign="top">
        <td><strong>Subscribe</strong></td>
        </tr>
        <tr valign="top">
        <th scope="row">Subscription Form Action</th>
        <td><input type="text" name="subs_form_link" value="<?php echo get_option('subs_form_link'); ?>" /><p>(No slash at the end: 'http://www.example.com'.)</p></td>
        </tr>        
        <th scope="row">iMagID</th>
        <td><input type="text" name="iMagID" value="<?php echo get_option('iMagID'); ?>" /></br><p>(Leave this alone if you don't konw what this does.)</p></td>
        </tr> <tr valign="top">
        <th scope="row">Special Keys</th>
        <td><input type="text" name="i4ky" value="<?php echo get_option('i4ky'); ?>" /></td>
        </tr>
  </table>

    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
</form>
</div>
<?php 
}
add_action("widgets_init", 'imo_addons_sidebar_init'); 
add_action("admin_menu", "imo_addons_create_subscriptions_menu");
add_action('wp_head','imo_addons_include_header_file');