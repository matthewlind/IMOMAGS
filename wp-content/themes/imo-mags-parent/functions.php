<?php

add_theme_support( 'post-thumbnails' );
add_action( 'widgets_init', 'parent_theme_widgets_init' );
add_action('after_setup_theme', 'parent_theme_setup');
add_action( 'widgets_init', 'register_recipes_widget' );

// Widgets
include_once('widgets/subscribe.php');
include_once('widgets/newsletter-signup.php');
include_once('widgets/newsletter-signup-header.php');
include_once('widgets/ford-widget.php');
include_once('widgets/community-login-widget.php');
include_once('widgets/user-info.php');
include_once('widgets/forecast.php');
include_once('widgets/featured-sidebar-widget.php');

$magazine_img = get_option("magazine_cover_uri", get_stylesheet_directory_uri(). "/images/pic/journals.png" );
$subs_link = get_option("subs_link");

/** changing default wordpres email settings */
add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');



function imo_login_form_shortcode( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'redirect' => ''
      ), $atts ) );

    if (!is_user_logged_in()) {
        if($redirect) {
            $redirect_url = $redirect;
        } else {
            $redirect_url = get_permalink();
        }
        $form = wp_login_form(array('echo' => false, 'redirect' => $redirect_url ));
    }
    return $form;
}
add_shortcode('loginform', 'imo_login_form_shortcode');

function imo_overridable_message( $atts, $content = null ) {

    extract( shortcode_atts( array(
      'text' => 'asdf'
      ), $atts ) );

    if ($_GET['override']) {
        $text = $_GET['override'];
    }
    return $text;
}
add_shortcode('override', 'imo_overridable_message');



function new_mail_from($old) {
	$url = home_url();
	$url = str_replace("http://www.", "", $url);
	return 'noreply@'.$url;
}
function new_mail_from_name($old) {
 	return bloginfo("name");
}

function new_excerpt_more( $more ) {
	return '... <a href="'. get_permalink( get_the_ID() ) .'" >more <span class="meta-nav">&raquo;</span></a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


class social_post_metabox{

    function admin_init()
    {
        $screens = apply_filters('social_post_metabox_screens', array('post', 'page') );
        foreach($screens as $screen)
        {
        add_meta_box('Sharing', 'Sharing', array($this, 'post_metabox'), $screen, 'side', 'default'  );
        }
        add_action('save_post', array($this, 'save_post') );

        add_filter('default_hidden_meta_boxes', array($this,  'default_hidden_meta_boxes' )  );
    }

    function default_hidden_meta_boxes($hidden)
    {
        $hidden[] = 'social';
        return $hidden;
    }

    function post_metabox(){
        global $post_id;

        if ( is_null($post_id) )
            $checked = '';
        else
        {
            $custom_fields = get_post_custom($post_id);
            $checked = ( isset ($custom_fields['social_exclude'])   ) ? 'checked="checked"' : '' ;
        }

        wp_nonce_field('social_postmetabox_nonce', 'social_postmetabox_nonce');
        echo '<label for="social_show_option">';
        _e("Remove Sharing:", 'myplugin_textdomain' );
        echo '</label> ';
        echo '<input type="checkbox" id="social_show_option" name="social_show_option" value="1" '.$checked.'>';
    }

    function save_post($post_id)
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;

        if ( ! isset($_POST['social_postmetabox_nonce'] ) ||  !wp_verify_nonce( $_POST['social_postmetabox_nonce'], 'social_postmetabox_nonce' ) )
            return;

        if ( ! isset($_POST['social_show_option']) )
        {
            delete_post_meta($post_id, 'social_exclude');
        }
        else
        {
            $custom_fields = get_post_custom($post_id);
            if (! isset ($custom_fields['social_exclude'][0])  )
            {
                add_post_meta($post_id, 'social_exclude', 'true');
            }
            else
            {
                update_post_meta($post_id, 'social_exclude', 'true' , $custom_fields['social_exclude'][0]  );
            }
        }

    }

}

$social_post_metabox = new social_post_metabox;
add_action('admin_init', array($social_post_metabox, 'admin_init'));


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
                        <h4 class="submenu-category-title"><?php //echo $item->title ?></h4>
                        <a class="drop-feat-img" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('legacy-thumb'); ?></a>
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



function parent_theme_setup()
{
    // This theme uses a custom image size for featured images, displayed on "standard" posts.
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 100, 9999 ); // Unlimited height, soft crop
    add_image_size( 'index-thumb', 200, 150, true );
    add_image_size( 'list-thumb', 440, 270, true );
    add_image_size( 'legacy-thumb', 190, 120, true );
    add_image_size( 'post-thumb', 700, 450, true );
    add_image_size( 'post-home-thumb', 695, 380, true );
    add_image_size( 'post-home-small-thumb', 335, 225, true );
    add_image_size("imo-mini-slider-thumb",70,70,TRUE);
    add_image_size("community-square",320,320,TRUE);
    add_image_size("community-square-retina",640,640,TRUE);
    add_image_size("video-thumb",130,90,TRUE);
    add_image_size("show-thumb",248,165,TRUE);
}

function parent_theme_widgets_init()
{
	 register_sidebar( array(
        'name' => __( 'Main Sidebar', 'imo-mags-parent' ),
        'id' => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

	//Community Sidebar
	register_sidebar( array(
	    'name' => __( 'Community Sidebar', 'imo-mags-parent' ),
	    'id' => 'sidebar-4',
	    'description' => __( 'The sidebar for community pages', 'twentyeleven' ),
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => "</div>",
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
	) );

	register_sidebar( array(
        'name' => __( 'Mobile Widgets', 'imo-mags-parent' ),
        'id' => 'sidebar-99',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Sticky Widgets', 'imo-mags-parent' ),
        'id' => 'sidebar-98',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );


    // register_widget( 'Twenty_Eleven_Ephemera_Widget' );

    /*register_sidebar( array(
        'name' => __( 'Header Sidebar', 'parent_theme' ),
        'id' => 'sidebar-header',
        'before_widget' => '<div id="%1$s" class="widget %2$s header-elements">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Header Sidebar First', 'parent_theme' ),
        'id' => 'sidebar-header-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s header-elements">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Header Sidebar Second', 'parent_theme' ),
        'id' => 'sidebar-header-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s header-elements">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );


    register_sidebar( array(
        'name' => __( 'Article Sidebar', 'imo-mags-parent' ),
        'id' => 'sidebar-2',
        'description' => __( 'The sidebar for single pages', 'twentyeleven' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Landing Page Sidebar', 'imo-mags-parent' ),
        'id' => 'sidebar-3',
        'description' => __( 'The sidebar for landing pages', 'twentyeleven' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

   register_sidebar( array(
        'name' => __( 'Footer Area Two', 'parent_theme' ),
        'id' => 'sidebar-4',
        'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Area Three', 'parent_theme' ),
        'id' => 'sidebar-5',
        'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Main Menu', 'parent_theme' ),
        'id' => 'sidebar-6',
        'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );*/
    register_nav_menus(array(
        'top' => 'Top Menu',
        'bottom' => 'Main Menu',
        'mobile' => 'Mobile Menu',
        'community' => 'Community Menu',
        'shows_menu' => 'Shows Menu'
    ));

}

function parent_theme_get_categories($categories_list, $show_featured = true)
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

function parent_theme_get_search_form($echo = true) {
    do_action( 'get_search_form' );

    $search_form_template = locate_template('searchform.php');
    if ( '' != $search_form_template ) {
        require($search_form_template);
        return;
    }

    $form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/' ) ) . '" >
    <div class="search-field"  data-role="fieldcontain"><!-- label class="screen-reader-text" for="s">' . __('Search for:') . '</label -->
    <input type="text" placeholder="Search" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </div>
    </form>';

    if ( $echo )
        echo apply_filters('get_search_form', $form);
    else
        return apply_filters('get_search_form', $form);
}

function parent_theme_get_featured_posts_query_in_slider()
{
    add_filter( 'posts_where', 'parent_theme_filter_where' );
    $query = new WP_Query(
        array(
            'category' => FEATURED,
            'posts_per_page' => 9
        )
    );
    remove_filter( 'posts_where', 'parent_theme_filter_where' );

    return $query;
}

function parent_theme_filter_where( $where = '' ) {
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
 * Reader Photo Slider Shortcode
 *
 * [reader-photo-slider]
 *
**/

function reader_photo_slider() {

	$id = get_the_ID();
	$features = get_field('reader_photos',$id );

	if( $features ): ?>
		<div id="photoSlider" class="reader-photo-slider loading-block clearfix">
	        <div class="photo-slider onload-hidden">
	            <ul class="slides-inner slides">

    				<?php foreach( $features as $feature ):
	           	 		$title = $feature->post_title;
	           	 		$url = $feature->guid;
						$thumb = get_the_post_thumbnail($feature->ID,"community-square-retina"); ?>

	               	 	<li>
	                    	<div><a href="<?php echo $url; ?>"><?php echo $thumb; ?></a></div>
	                        <h3><a href="<?php echo $url; ?>"><?php echo $title; ?></a></h3>
	                    </li>
				    <?php endforeach; ?>

            </ul>
        </div>
    </div>
	<?php endif;
	wp_enqueue_script('flexslider-reader-js','/wp-content/themes/imo-mags-parent/js/plugins/flexslider/jquery.flexslider.js', __FILE__);
}

add_shortcode( 'reader-photo-slider', 'reader_photo_slider' );

/**
 * Callback Handler for the admin_menu action.
 */
function imo_addons_create_subscriptions_menu() {
    add_menu_page("Site & Subs Settings", "Site & Subs Settings",
        "administrator", 'subs', "imo_addons_subscription_page");
    add_action("admin_init", "register_imo_subscribe_settings");
}
function register_imo_subscribe_settings () {
    register_setting( 'imo-subs-settings-group', 'iMagID' );
    register_setting( 'imo-subs-settings-group', 'headline_1' );
    register_setting( 'imo-subs-settings-group', 'headline_2' );
    register_setting( 'imo-subs-settings-group', 'deal_copy' );
    register_setting( 'imo-subs-settings-group', 'subs_link' );
    register_setting( 'imo-subs-settings-group', 'gift_link' );
    register_setting( 'imo-subs-settings-group', 'service_link' );
    register_setting( 'imo-subs-settings-group', 'magazine_cover_uri' );
    register_setting( 'imo-subs-settings-group', 'magazine_cover_alt_uri' );
    register_setting( 'imo-subs-settings-group', 'sons_header_uri' );
    register_setting( 'imo-subs-settings-group', 'defend_header_uri' );
    register_setting( 'imo-subs-settings-group', 'history_header_uri' );
    register_setting( 'imo-subs-settings-group', 'competition_header_uri' );
    register_setting( 'imo-subs-settings-group', 'news_header_uri' );
    register_setting( 'imo-subs-settings-group', 'zombie_header_uri' );
    register_setting( 'imo-subs-settings-group', 'affiliates_desc_uri' );
    register_setting( 'imo-subs-settings-group', 'ma_desc_uri' );
    register_setting( 'imo-subs-settings-group', 'subs_form_link' );
    register_setting( 'imo-subs-settings-group', 'header_key' );
    register_setting( 'imo-subs-settings-group', 'menu_key' );
    register_setting( 'imo-subs-settings-group', 'mobile_menu_key' );
    register_setting( 'imo-subs-settings-group', 'i4ky' );
    register_setting( 'imo-subs-settings-group', 'sticky_key' );
    register_setting( 'imo-subs-settings-group', 'newsletter_id' );
    register_setting( 'imo-subs-settings-group', 'master_angler_pdf' );
    register_setting( 'imo-subs-settings-group', 'home_player_id' );
    register_setting( 'imo-subs-settings-group', 'home_player_key' );
    register_setting( 'imo-subs-settings-group', 'video_title' );
    register_setting( 'imo-subs-settings-group', 'home_player_camp' );
}
/**
 *HTML generation call back for the Subscriptions settings page.
 * @see imo_addons_create_subscriptions_menu()
 */
function imo_addons_subscription_page() {
?>
<div class="wrap">
<h2>Site & Subscription Settings</h2>
<form method="post" action="options.php">
<?php settings_fields( 'imo-subs-settings-group' ); ?>
<table class="form-table">
		<tr valign="top">
        <td><strong>Magazine Section</strong></td>
        </tr>
        <tr valign="top">
        <th scope="row">Widget Headline Left</th>
        <td><input type="text" name="headline_1" value="<?php echo get_option('headline_1'); ?>" /></td>
        </tr>
		 <tr valign="top">
        <th scope="row">Widget Headline Right</th>
        <td><input type="text" name="headline_2" value="<?php echo get_option('headline_2'); ?>" /></td>
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
        </tr>
        <tr valign="top">
        <th scope="row">Magazine Cover URL</th>
        <td><input type="text" name="magazine_cover_uri" value="<?php echo get_option('magazine_cover_uri'); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">Magazine Cover URL - Alternate</th>
        <td><input type="text" name="magazine_cover_alt_uri" value="<?php echo get_option('magazine_cover_alt_uri'); ?>" /></td>
        </tr>
        <tr valign="top">
        <td><strong>Subscribe</strong></td>
        </tr>
        <tr valign="top">
        <th scope="row">Subscription Form Action</th>
        <td><input type="text" name="subs_form_link" value="<?php echo get_option('subs_form_link'); ?>" /><p>(No slash at the end: 'http://www.example.com'.)</p></td>
        </tr>
        <th scope="row">iMagID</th>
        <td><input type="text" name="iMagID" value="<?php echo get_option('iMagID'); ?>" /></br><p>(Leave this alone if you don't know what this does.)</p></td>
        </tr> <tr valign="top">
        <tr>
        <th scope="row">Header Subscribe Key</th>
        <td><input type="text" name="header_key" value="<?php echo get_option('header_key'); ?>" /></td>
        </tr>
        <tr>
        <th scope="row">Menu Subscribe Key</th>
        <td><input type="text" name="menu_key" value="<?php echo get_option('menu_key'); ?>" /></td>
        </tr>
         <tr>
        <th scope="row">Mobile Menu Subscribe Key</th>
        <td><input type="text" name="mobile_menu_key" value="<?php echo get_option('mobile_menu_key'); ?>" /></td>
        </tr>
        <tr>
         <th scope="row">Widget Key</th>
        <td><input type="text" name="i4ky" value="<?php echo get_option('i4ky'); ?>" /></td>
        </tr>
        <tr>
        <th scope="row">Sticky Bar Subscribe Key</th>
        <td><input type="text" name="sticky_key" value="<?php echo get_option('sticky_key'); ?>" /></td>
        </tr>
        <tr valign="top">
        <td><strong>Newsletter</strong></td>
        </tr>
		<tr>
        <th scope="row">ID</th>
        <td><input type="text" name="newsletter_id" value="<?php echo get_option('newsletter_id'); ?>" /></td>
        </tr>
        <tr valign="top">
        <td><strong>Homepage Video Player</strong></td>
        </tr>
        <tr>
        <th scope="row">Title</th>
        <td><input type="text" name="video_title" value="<?php echo get_option('video_title'); ?>" /></td>
        </tr>
		<tr>
        <th scope="row">Player ID</th>
        <td><input type="text" name="home_player_id" value="<?php echo get_option('home_player_id'); ?>" /></td>
        </tr>
        <tr>
        <th scope="row">Player Key</th>
        <td><input type="text" name="home_player_key" value="<?php echo get_option('home_player_key'); ?>" /></td>
        </tr>
        <tr>
        <th scope="row">Dart Campaign</th>
        <td><input type="text" name="home_player_camp" value="<?php echo get_option('home_player_camp'); ?>" /></td>
        </tr>


        <?php
        $dartDomain = get_option("dart_domain", $default = false);
        if($dartDomain == "imo.in-fisherman"){ ?>
	        <tr valign="top">
	        <td><strong>Master Angler</strong></td>
	        </tr>
	        <tr valign="top">
	        <th scope="row">File URL path</th>
	        <td><input type="text" name="master_angler_pdf" value="<?php echo get_option('master_angler_pdf'); ?>" /></td>
	        </tr>
		<?php } ?>
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


function edit_community_contactmethods( $contactmethods ) {
 $contactmethods['twitter'] = 'Twitter';

   unset($contactmethods['yim']);
   unset($contactmethods['aim']);
   unset($contactmethods['jabber']);


 return $contactmethods;
 }
 add_filter('user_contactmethods','edit_community_contactmethods',10,1);


function imo_community_user_profile( $user_id ) {



    if ( !empty( $_POST['age'] ) )
        update_user_meta( $user_id, 'age', $_POST['age'] );

    if ( !empty( $_POST['address1'] ) )
        update_user_meta( $user_id, 'address1', $_POST['address1'] );
    if ( !empty( $_POST['address2'] ) )
        update_user_meta( $user_id, 'address2', $_POST['address2'] );
    if ( !empty( $_POST['city'] ) )
        update_user_meta( $user_id, 'city', $_POST['city'] );
    if ( !empty( $_POST['state'] ) )
        update_user_meta( $user_id, 'state', $_POST['state'] );
    if ( !empty( $_POST['zip'] ) )
        update_user_meta( $user_id, 'zip', $_POST['zip'] );


    if ( !empty( $_POST['send_community_updates'] ) )
        update_user_meta( $user_id, 'send_community_updates', $_POST['send_community_updates'] );
    else
        update_user_meta( $user_id, 'send_community_updates', 0 );
    if ( !empty( $_POST['send_offers'] ) )
        update_user_meta( $user_id, 'send_offers', $_POST['send_offers'] );
    else
        update_user_meta( $user_id, 'send_offers', 0 );
}
add_action( 'edit_user_profile_update', 'imo_community_user_profile' );


add_action( 'edit_user_profile', 'imo_community_user_profile' );
add_action( 'personal_options_update', 'imo_community_user_profile' );


add_action( 'init','imo_parent_theme_init',1);

function imo_parent_theme_init() {

        wp_register_script( 'underscore', get_template_directory_uri() . '/js/underscore-min.js', '0.1', true );


}

/**
add_action( 'init', 'codex_video_init' );

 * Register a video post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
/*function codex_video_init() {
	$labels = array(
		'name'               => _x( 'Videos', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Video', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Videos', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Video', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'video', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Video', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Video', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Video', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Video', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Videos', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Videos', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Videos:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No videos found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No videos found in Trash.', 'your-plugin-textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'video' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'video', $args );
}

*/
//Featured ACF
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_category-options',
		'title' => 'Category Options',
		'fields' => array (
			array (
				'key' => 'field_5395f9a91cb2a',
				'label' => 'Featured Category Posts',
				'name' => 'featured_category_posts',
				'type' => 'relationship',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'post',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'featured_image',
					1 => 'post_type',
					2 => 'post_title',
				),
				'max' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'category',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_post-options',
		'title' => 'Post Options',
		'fields' => array (
			array (
				'key' => 'field_5395f6d8ea787',
				'label' => 'Promo Title',
				'name' => 'promo_title',
				'type' => 'text',
				'instructions' => 'Rewrite the title to be shorter or more catchy for when the story appears around the site.',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'reviews',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'imo_video',
					'order_no' => 0,
					'group_no' => 3,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'imo_ga_vault',
					'order_no' => 0,
					'group_no' => 4,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'magazines',
					'order_no' => 0,
					'group_no' => 5,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_article-options',
		'title' => 'Article Options',
		'fields' => array (
			array (
				'key' => 'field_5396107ccddd5',
				'label' => 'Featured Title',
				'name' => 'featured_title',
				'type' => 'text',
				'instructions' => 'Choose the title of this featured area',
				'default_value' => 'Special Features',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53960ffccddd4',
				'label' => 'Article Featured Stories',
				'name' => 'article_featured_stories',
				'type' => 'relationship',
				'instructions' => 'Choose 2 stories that appear above every post ',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'post',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'featured_image',
					1 => 'post_type',
					2 => 'post_title',
				),
				'max' => 2,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 30,
	));
	register_field_group(array (
		'id' => 'acf_homepage-options',
		'title' => 'Homepage Options',
		'fields' => array (
			array (
				'key' => 'field_5395f79a968de',
				'label' => 'Homepage Featured Stories',
				'name' => 'homepage_featured_stories',
				'type' => 'relationship',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'post',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'featured_image',
					1 => 'post_type',
					2 => 'post_title',
				),
				'max' => 6,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 31,
	));
	register_field_group(array (
		'id' => 'acf_sidebar-options',
		'title' => 'Sidebar Options',
		'fields' => array (
			array (
				'key' => 'field_5396107ccddd5',
				'label' => 'Featured Title',
				'name' => 'sidebar_featured_title',
				'type' => 'text',
				'instructions' => 'Choose the title of this featured area',
				'default_value' => 'Special Features',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5395f79a968df',
				'label' => 'Sidebar Featured Stories',
				'name' => 'sidebar_featured_stories',
				'type' => 'relationship',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'post',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'featured_image',
					1 => 'post_type',
					2 => 'post_title',
				),
				'max' => 6,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 32,
	));
	register_field_group(array (
		'id' => 'acf_special-features-override',
		'title' => 'Special Features Override',
		'fields' => array (
			array (
				'key' => 'field_5398ab4434b57',
				'label' => 'Featured Stories',
				'name' => 'featured_stories',
				'type' => 'relationship',
				'instructions' => 'Choose TWO stories to feature about the story for this article only (will override the global article featured).',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'all',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'featured_image',
					1 => 'post_type',
					2 => 'post_title',
				),
				'max' => 2,
			),
			array (
				'key' => 'field_5398ab9de2816',
				'label' => 'Featured Stories Title',
				'name' => 'featured_stories_title',
				'type' => 'text',
				'instructions' => 'Choose a special callout for these stories, or leave it alone and it will use the global title.',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'reviews',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 2,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'imo_video',
					'order_no' => 0,
					'group_no' => 3,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'imo_ga_vault',
					'order_no' => 0,
					'group_no' => 4,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'magazines',
					'order_no' => 0,
					'group_no' => 5,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}


//Survey ACF
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_survey',
		'title' => 'Survey',
		'fields' => array (
			array (
				'key' => 'field_53a1d16893eb1',
				'label' => 'Display survey?',
				'name' => 'display_survey',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_53a1cfab0e370',
				'label' => 'Survey url',
				'name' => 'survey_url',
				'type' => 'text',
				'instructions' => 'Link to the survey',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53a1cfc00e371',
				'label' => 'Survey image',
				'name' => 'survey_image',
				'type' => 'text',
				'instructions' => 'link to the survey image',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_full-width-pages',
		'title' => 'Full Width Pages',
		'fields' => array (
			array (
				'key' => 'field_53c6a004666f2',
				'label' => 'Full Width',
				'name' => 'full_width',
				'type' => 'true_false',
				'instructions' => 'Check if you want this page to be full width with no site skin.',
				'message' => '',
				'default_value' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}


function fixed_connect_footer(){

	$formID = get_option("newsletter_id");

?>
<div class="fixed-connect<?php if(mobile()){ echo ' fixed-connect-mobile';} ?>">
	<div class="close"><a href="javascript:void(0);" title="Collapse bottom bar"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/close_icon_small.png" alt="Collapse bottom bar"></a>
	</div>
	<div class="container">
		<?php if(!mobile()){ ?>
			<div class="currentIssue">
				<div class="journal">
	                <?php
	                    global $IMO_USER_STATE;

	                    $sportsmanStates = array("GA","MI","MN","WI","AR","TN","TX");

	                    $cover = get_option('magazine_cover_uri');

	                     if (in_array($IMO_USER_STATE, $sportsmanStates)) {
	                        $cover = get_option('magazine_cover_alt_uri');
	                    }
	                ?>

			        <img src="<?php echo $cover; ?>" alt="Subscribe">
			    </div>
			</div>
			<?php } ?>
		<div class="subscribe">
		<?php $dartDomain = get_option("dart_domain", $default = false);
	    if($dartDomain == "imo.gunsandammo" || $dartDomain == "imo.in-fisherman" || $dartDomain == "imo.shotgunnews" || $dartDomain == "imo.shootingtimes"){ ?>
		    <a href="<?php print get_option('subs_link') . get_option('sticky_key'); ?>" target="_blank" onClick="_gaq.push(['_trackEvent', 'Subscribe', 'Location', 'Sticky Footer']);">Subscribe</a>
	    <?php }else{ ?>
			<a href="<?php print get_option('subs_link') . "/?pkey=" . get_option('sticky_key'); ?>" target="_blank" onClick="_gaq.push(['_trackEvent', 'Subscribe', 'Location', 'Sticky Footer']);">Subscribe</a>
	   <?php } ?>
		</div>
		<div class="newsletter">
			<div class="title">Get The Newsletter</div>

				<script type="text/javascript">
				/***********************************************
				* Textarea Maxlength script- � Dynamic Drive (www.dynamicdrive.com)
				* This notice must stay intact for legal use.
				* Visit http://www.dynamicdrive.com/ for full source code
				***********************************************/
				function ismaxlength(obj, mlength)
				{
				  if (obj.value.length > mlength)
				    obj.value = obj.value.substring(0, mlength)
				}
				</script>

				<form method="post" name="profileform" action="https://intermediaoutdoors.informz.net/clk/remote_post.asp">

					<SCRIPT LANGUAGE="JavaScript">
						function moveCaret(event, objThisField, objNextField, objPrevField, nSize)
						{
							var keynum;
							if(window.event) // IE
								keynum = event.keyCode;
							else if(event.which) // Netscape/Firefox/Opera
								keynum = event.which;
							if (keynum == 37 || keynum == 39 || keynum == 38 || keynum == 40 || keynum == 8) //left, right, up, down arrows, backspace
							{
								var nCaretPosition = getCaretPosition(objThisField);
								if (keynum == 39 && nCaretPosition == nSize)
									moveToNextField(objNextField);
								if ((keynum == 37 || keynum == 8) && nCaretPosition == 0)
									moveToPrevField(objPrevField);
								return;
							}
							if (keynum == 9) //Tab
							return;
						if (objThisField.value.length >= nSize && objNextField != null)
							moveToNextField(objNextField);
					}
					function moveToNextField(objNextField)
					{
						if (objNextField == null)
							return;
						objNextField.focus();
						if (document.selection) //IE
						{
							oSel = document.selection.createRange ();
							oSel.moveStart ('character', 0);
							oSel.moveEnd ('character', objNextField.value.length);
							oSel.select();
						}
						else
						{
						   objNextField.selectionStart = 0;
					       objNextField.selectionEnd = objNextField.value.length;
						}
					}
					function moveToPrevField(objPrevField)
					{
						if (objPrevField == null)
							return;
						objPrevField.focus();
						if (document.selection) //IE
						{
							oSel = document.selection.createRange ();
							oSel.moveStart ('character', 0);
							oSel.moveEnd ('character', objPrevField.value.length);
							oSel.select ();
						}
						else
						{
						   objPrevField.selectionStart = 0;
					       objPrevField.selectionEnd = objNextField.value.length;
						}
					}
					function getCaretPosition(objField)
					{
						var nCaretPosition = 0;
						if (document.selection) //IE
						{
						   var oSel = document.selection.createRange ();
						   oSel.moveStart ('character', -objField.value.length);
						   nCaretPosition = oSel.text.length;
						}
						if (objField.selectionStart || objField.selectionStart == '0')
					       nCaretPosition = objField.selectionStart;
						return nCaretPosition;
					}
					</script>

					<fieldset>
						<input alt="Email Address" type="text" name="email" size="25" maxlength="100" value="" placeholder="Enter Your Email..." >
				        <script type="text/javascript">
							function ShowDescriptions(SubDomain,val, brid) {
								myWindow = window.open(SubDomain + '/description.asp?brid=' + brid + '&id=' + val, 'Description', 'location=no,height=180,width=440,resizeable=no,scrollbars=yes,dependent=yes');
								myWindow.focus()
							}
						</script>

				        <input alt="Third Party" type="checkbox" checked="checked" value="22697" name="interests" id="receive" />
				        <input type="hidden" name="OptoutInfo" value="">
				        <div class="opt-in">Yes, I'd like to receive offers from your partners</div>
						<input type="submit" value="Sign Up" name="update" >
				        <input type=hidden name=fid value=<?php echo $formID; ?>>
						<input type=hidden name=b value=4038>
						<input type=hidden name=returnUrl value="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?zmsg=1">

					</fieldset>
				</form>
				<script language='javascript'>
				fullURL = document.URL
				sAlertStr = ''
				nLoc = fullURL.indexOf('&')
				if (nLoc == -1)
					nLoc = fullURL.length
				if (fullURL.indexOf('zreq=') > 0){
					sRequired = fullURL.substring(fullURL.indexOf('zreq=')+5, nLoc)
					if (sRequired.length > 0){
						sRequired = ',' + sRequired.replace('%20',' ')
						sRequired = sRequired.replace(/,/g,'\n  - ')
						sAlertStr = 'The following item(s) are required: '+sRequired + '\n'
					}

				}
				if (sAlertStr.length > 0){
					alert(sAlertStr)
				}else if( document.URL.indexOf('zmsg=1') > -1){
					alert('Thank you for subscribing.')
				}

				</script>

			</div>
			<div class="follow">
              <div class="follow-us">Follow us:</div>
              <?php social_networks(); ?>
			</div>
		</div>
	</div>

<?php }

//post formats
add_theme_support( 'post-formats', array( 'video', 'gallery' ) );

add_action('template_include', 'load_single_template');
function load_single_template($template) {
  $new_template = '';
 
  // single post template
  if( is_single() ) {
    global $post;
 
    // template for post with video format
    if ( has_post_format( 'video' )) {
      // use template file single-video.php for video format
      $new_template = locate_template(array('single-video.php' ));
    }
 
  }
  return ('' != $new_template) ? $new_template : $template;
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_show-page-home',
		'title' => 'Show Page Home',
		'fields' => array (
			array (
				'key' => 'field_53ceb4a4f00ca',
				'label' => 'TV Page',
				'name' => 'tv_page',
				'type' => 'true_false',
				'instructions' => 'Check to edit as a TV show page',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_53cd5aadfceb8',
				'label' => 'Show Menu',
				'name' => 'show_menu',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53ceb4a4f00ca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'Assign the show navigation',
				'sub_fields' => array (
					array (
						'key' => 'field_53cd5ad1fceb9',
						'label' => 'Name',
						'name' => 'name',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_53ceb4a4f00ca',
									'operator' => '==',
									'value' => '1',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => 'Home',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_53cd5ae5fceba',
						'label' => 'URL',
						'name' => 'url',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_53ceb4a4f00ca',
									'operator' => '==',
									'value' => '1',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '/bowhunter-tv/about',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
			array (
				'key' => 'field_53cd59621035f',
				'label' => 'Background Skin',
				'name' => 'background_skin',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53ceb4a4f00ca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'The url of the show\'s background image',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53cd598f10360',
				'label' => 'Show Logo',
				'name' => 'show_logo',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53ceb4a4f00ca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'the url of the show logo image',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53cd5a876d31a',
				'label' => 'Show Title',
				'name' => 'show_title',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53ceb4a4f00ca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'Choose if you want a title next to the logo',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53cd5b42ce9ee',
				'label' => 'When to Watch',
				'name' => 'when_to_watch',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53ceb4a4f00ca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'Use the show ID to link the when to watch schedule',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53cd5b61ce9ef',
				'label' => 'Remind Me',
				'name' => 'remind_me',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53ceb4a4f00ca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'The Remind me to watch url',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53cd6197d13df',
				'label' => 'Facebook',
				'name' => 'facebook',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53ceb4a4f00ca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'facebook page url',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53cd61e9d13e0',
				'label' => 'Twitter',
				'name' => 'twitter',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53ceb4a4f00ca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'Twitter follow link',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53cd6204d13e1',
				'label' => 'Google',
				'name' => 'google',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53ceb4a4f00ca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'Google Plus link',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53cd623df2156',
				'label' => 'Shares',
				'name' => 'shares',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53ceb4a4f00ca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'link to share count',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53cd627d2f0bd',
				'label' => 'Sponsors',
				'name' => 'sponsors',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53ceb4a4f00ca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'instructions' => 'Sponsor Images',
				'sub_fields' => array (
					array (
						'key' => 'field_53cd62af2f0c0',
						'label' => 'name',
						'name' => 'name',
						'type' => 'text',
						'instructions' => 'Sponsor name',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_53cd62972f0be',
						'label' => 'image',
						'name' => 'image',
						'type' => 'text',
						'instructions' => 'Image url',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_53cd62a52f0bf',
						'label' => 'url',
						'name' => 'url',
						'type' => 'text',
						'instructions' => 'Sponsor link',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'category',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

