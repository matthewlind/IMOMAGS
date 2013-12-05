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
include_once('widgets/community-slider.php');
include_once('widgets/user-info.php');
include_once('widgets/forecast.php');


$magazine_img = get_option("magazine_cover_uri", get_stylesheet_directory_uri(). "/images/pic/journals.png" );
$subs_link = get_option("subs_link");

function new_excerpt_more( $more ) {
	return '... <a href="'. get_permalink( get_the_ID() ) .'" >more <span class="meta-nav">&raquo;</span></a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

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
}

function parent_theme_widgets_init()
{

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
    ) );*/

    register_sidebar( array(
        'name' => __( 'Home Sidebar', 'imo-mags-parent' ),
        'id' => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
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
        'name' => __( 'Community Sidebar', 'imo-mags-parent' ),
        'id' => 'sidebar-4',
        'description' => __( 'The sidebar for community pages', 'twentyeleven' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

   /*register_sidebar( array(
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
        'community' => 'Community Menu'
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
 * Callback Handler for the admin_menu action.
 */
function imo_addons_create_subscriptions_menu() {
    add_menu_page("Subscriptions Settings", "Subscription Settings",
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



//SHORTCODES

//shortcode featured sliders for pages
/*function imo_featured_flexslider( $atts ) {
	$post = new WP_Query( 'category_name=featured&posts_per_page=4' ); ?>
    <div class="post-slider loading-block js-responsive-section">
        <div class="jq-featured-slider onload-hidden">
            <ul class="slides-inner slides">
                <?php while ($post->have_posts()) : $post->the_post();

	                $thumb = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>

	                <li data-thumb="<?php echo $thumb; ?>">
	                    <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('large-featured-thumb-x');?></a>
	                    <div class="nl-txt">
	                        <h2><a href="<?php the_permalink(); ?>" ><?php $title = the_title('','',FALSE); echo substr($title, 0, 70); if (strlen($title) > 70) echo "..."; ?></a></h2>
	                   </div>
	                </li>
	            <?php endwhile; ?>
            </ul>
        </div>
    </div>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.jq-featured-slider').flexslider({
			animation: "slide",
			animationSpeed: 200,
			controlNav: "thumbnails",
			slideshow: true
		});
		jQuery('ol.flex-control-thumbs img').resizecrop({
		  width:98,
		  height:76,
		  vertical:"middle"
		});
		//fix
		jQuery('ol.flex-control-thumbs li:first-child img').addClass("flex-active");
	});
	</script>
<?php }
wp_enqueue_style('flexslider-css',get_template_directory_uri() . '/js/flexslider/flexslider.css', __FILE__);
wp_enqueue_script('flex-slider-js',get_template_directory_uri() . '/js/flexslider/jquery.flexslider.js',array('jquery'));
wp_enqueue_script('resizecrop-js',get_template_directory_uri() . '/js/jquery.resizecrop-1.0.3.js', __FILE__);

add_shortcode( 'imo-featured-flexslider', 'imo_featured_flexslider' );



// shortcode loop for pages
//[loop pagination="false" category="news" posts_per_page=20 query="" type="list"]
function myLoop($atts, $content = null) {
	extract(shortcode_atts(array(
		"pagination" => 'true',
		"query" => '',
		"category" => '',
		"posts_per_page" => 20,
		"type" => 'excerpt'
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	if($pagination == 'true'){
		$query .= '&paged='.$paged;
	}
	$query .= '&post_type=post';
	if(!empty($category)){
		$query .= '&category_name='.$category;
	}
	if(!empty($posts_per_page)){
		$query .= '&posts_per_page='.$posts_per_page;
	}
	if(!empty($query)){
		$query .= $query;
	}
	$wp_query->query($query);
	ob_start();

	if($type == "excerpt"){

		while ($wp_query->have_posts()) : $wp_query->the_post();  ?>
			<div class="post type-post status-publish format-standard hentry category-breeds entry entry-excerpt clearfix has-img">
				<div class="entry-summary">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(190,120),array('class' => 'entry.has-img entry-summary entry-img'));?></a>
					<div class="entry-info">
						<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php the_date(); ?>
						<a href="<?php the_permalink(); ?>/#comments" title="<?php the_title(); ?>"><?php comments_number(); ?></a>
					</div>
					<?php the_excerpt(); ?>
				</div>
			</div>

		<?php endwhile;
	}

	if($type == "list"){
		while ($wp_query->have_posts()) : $wp_query->the_post();  ?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile;
	}

	if(pagination == 'true'){ ?>
	<div class="navigation">
	  <div class="alignleft"><?php previous_posts_link('« Previous') ?></div>
	  <div class="alignright"><?php next_posts_link('More »') ?></div>
	</div>
	<?php } ?>
	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("loop", "myLoop");*/


function fixed_connect_footer(){ ?>
<div class="fixed-connect">
	<div class="close"><a href="javascript:void(0);" title="Collapse bottom bar"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/close_icon_small.png" alt="Collapse bottom bar"></a>
	</div>
	<div class="container">
		<div class="currentIssue">
			<div class="journal">
		        <img src="<?php echo get_option('magazine_cover_uri'); ?>" alt="Subscribe">
		    </div>		    
		</div>
		<div class="subscribe">						
			<a href="<?php print get_option('subs_link') . "/?pkey=" . get_option('sticky_key'); ?>" target="_blank">Subscribe</a>
		</div>
		<div class="newsletter">
			<div class="title">Get The Newsletter</div>
		
				<script type="text/javascript">
				/***********************************************
				* Textarea Maxlength script- © Dynamic Drive (www.dynamicdrive.com)
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
				        <input type=hidden name=fid value=2493>
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
				if (fullURL.indexOf('zmsg=') > 0) {
					sMessage = fullURL.substring(fullURL.indexOf('zmsg=')+5, fullURL.length)
					if (sMessage.length > 0) {
						sMessage = sMessage.replace(/%20/g, ' ')
						sMessage = sMessage.replace(/%0A/g, '\n')
						sAlertStr = sAlertStr + sMessage
					}
				}
				
				if (sAlertStr.length > 0)
					alert(sAlertStr)
				</script>

			</div>
			<div class="follow">
              <div class="follow-us">Follow us:</div>
              <?php social_networks(); ?>
			</div>
		</div>
	</div>              

<?php }
