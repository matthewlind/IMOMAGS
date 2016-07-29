<?php
apply_filters ( 'admin_memory_limit', 512 );
add_theme_support( 'post-thumbnails' );
add_action( 'widgets_init', 'parent_theme_widgets_init' );
add_action('after_setup_theme', 'parent_theme_setup');

// Widgets
include_once('widgets/subscribe.php');
include_once('widgets/ford-widget.php');
include_once('widgets/tsc-schedule.php');
include_once('widgets/tune-in-widget.php');

$magazine_img = get_option("magazine_cover_uri", get_stylesheet_directory_uri(). "/images/pic/journals.png" );
$subs_link = get_option("subs_link");
remove_action('wp_head', 'wp_generator');
/** changing default wordpres email settings */
add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');

// filter that creates category single pages
add_filter('single_template', create_function(
	'$the_template',
	'foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
		return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
);



// ACF for microsites. Original "Microsite Category Fields" exported from Petersens's Hunting site 
include_once('acf_fields/microsite-category-fields.php');
include_once('acf_fields/redesign-fields.php');

// Microsite Ajax load more posts
include_once( get_template_directory() .'/functions/microsites/ajax-load-posts.php' );

// Redesign functions
include_once( get_template_directory() .'/functions/redesign/single.php' );
include_once( get_template_directory() .'/functions/redesign/home-and-cat.php' );
include_once( get_template_directory() .'/functions/redesign/search-load-more.php' );


function sub_footer(){ ?>
	<!-- future promotional area -->
<?php
}

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
            $template = '%1$s<a%2$s>%3$s%4$s%5$s</a><div class="drop-down clearfix">%6$s';
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
    
    //new
    add_image_size( 'footer-thumb', 250, 210, true );
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

	register_nav_menus(array(
        'top' => 'Top Menu',
        'bottom' => 'Main Menu',
        'desk_vis' => 'Desktop Visible Menu',
        'desk_vis_sec' => 'Desktop Secondary Menu',
        'mobile' => 'Mobile Menu',
        'community' => 'Community Menu',
        'shows_menu' => 'Shows Menu',
        'b2b' => 'B2B Menu',
        'wheels_afield' => 'Wheels Afield',
        'microsite' => 'Microsite Menu'
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
    register_setting( 'imo-subs-settings-group', 'mail_url' );
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
        <th scope="row">Home Mid-level Subscribe Key</th>
        <td><input type="text" name="home_key" value="<?php echo get_option('home_key'); ?>" /></td>
        </tr>
         <tr>
        <th scope="row">Category Mid-level Subscribe Key</th>
        <td><input type="text" name="category_key" value="<?php echo get_option('category_key'); ?>" /></td>
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
        <td><strong>Mail Icon URL</strong></td>
        </tr>
		<tr>
        <th scope="row">URL</th>
        <td><input type="text" name="mail_url" value="<?php echo get_option('mail_url'); ?>" /></td>
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
add_action("admin_menu", "imo_addons_create_subscriptions_menu");



/*add_action( 'init','imo_parent_theme_init',1);

function imo_parent_theme_init() {

        wp_register_script( 'underscore', get_template_directory_uri() . '/js/underscore-min.js', '0.1', true );


}*/

//IMO VIDEO
/* Define the Video ID metabox */

add_action( 'add_meta_boxes', 'imo_video_add_custom_box' );
add_action( 'save_post', 'imo_video_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function imo_video_add_custom_box() {
    add_meta_box( 
        'imo_video_sectionid',
        __( 'Choose Brightcove Video', 'imo_video_textdomain' ),
        'imo_video_inner_custom_box',
        'post',
        'side',
        'high' 
    );
    add_meta_box( 
        'imo_video_legacy',
        __( 'Legacy URL', 'imo_video_legacy_domain' ),
        'imo_video_inner_custom_box_legacy',
        'post' 
    );

}
/* Prints the box content */
function imo_video_inner_custom_box_legacy( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'imo_video_noncename' );
  
  
  $valueTag = "value='" .  get_post_meta($post->ID, '_video_legacy_url', TRUE) . "'";
  
  
  // The actual fields for data entry
  echo '<input type="text" id="imo_video_legacy_url" name="imo_video_legacy_url" size="50" ' . $valueTag . ' />';
}
/* Prints the box content */
function imo_video_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'imo_video_noncename' );
  
  
  $valueTag = "value='" .  get_post_meta($post->ID, '_video_id', TRUE) . "'";
  
  
  // The actual fields for data entry
  echo '<label for="imo_video_video_id">';
       _e("Video ID", 'imo_video_textdomain' );
  echo '</label> ';
  echo '<input type="text" id="imo_video_video_id" name="imo_video_video_id" placeholder="36124564556" size="25" ' . $valueTag . ' />';
  echo '<p>A <b>Featured Image</b> will automatically be downloaded from Brightcove when this post is published.  There is no need to add a Featured Image.</p>';


 //_log(imo_video_bc_import_gather_videos());

}

/* When the post is saved, saves our custom data */
function imo_video_save_postdata( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['imo_video_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  // Check permissions
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // OK, we're authenticated: we need to find and save the data

  $mydata = $_POST['imo_video_video_id'];
  $legacyURL = $_POST['imo_video_legacy_url'];

  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
  update_post_meta($post_id, '_video_legacy_url', esc_attr($legacyURL) );
  update_post_meta($post_id, '_video_id', esc_attr($mydata) );

  //Get The thumbnail
  $videoID = $mydata;

 
}

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
// TV Show acf
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_tv-video-portal',
		'title' => 'TV & Video Portal',
		'fields' => array (
			array (
				'key' => 'field_53e8ed6a110a7',
				'label' => 'TV player ID',
				'name' => 'tv_player_id',
				'type' => 'text',
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
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	
	register_field_group(array (
		'id' => 'acf_tv-abouthosts-page',
		'title' => 'TV - About&Hosts Page',
		'fields' => array (
			array (
				'key' => 'field_53eba15050b75',
				'label' => 'Host Item',
				'name' => 'host_item',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_53eba6fb5df0a',
						'label' => 'Host Photo',
						'name' => 'host_photo',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_53eba7205df0b',
						'label' => 'Host Name',
						'name' => 'host_name',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_53eba72d5df0c',
						'label' => 'Host Fact',
						'name' => 'host_fact',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_53eba73e5df0d',
						'label' => 'Host Fact Image',
						'name' => 'host_fact_img',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_53eba7555df0e',
						'label' => 'Host Copy',
						'name' => 'host_copy',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'formatting' => 'br',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Host',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'show-page.php',
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
	register_field_group(array (
		'id' => 'acf_tv-more-shows-page',
		'title' => 'TV - More Shows Page',
		'fields' => array (
			array (
				'key' => 'field_53eb877bd344b',
				'label' => 'Show Item',
				'name' => 'show_item',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_53ebb28bdf5c7',
						'label' => 'Show Title',
						'name' => 'show_title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_53ebb29ddf5c8',
						'label' => 'Show Image',
						'name' => 'show_image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_53ebb2b0df5c9',
						'label' => 'Show Description',
						'name' => 'show_description',
						'type' => 'textarea',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'formatting' => 'br',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Show',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'show-page.php',
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
			<?php
			$formID = get_option('newsletter_id');
	
			$url = "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
		    $errorcode = $_GET["errorcode"];
		    $errorcontrol = $_GET["errorControl"];
		
		    switch($errorcode) {
		
		        case "1" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
		        case "2" : $strError = "The list provided does not exist."; break;
		        case "3" : $strError = "Information was not provided for a mandatory field. (".$errorcontrol.")"; break;
		        case "4" : $strError = "Please provide an email address.".$errorcontrol; break;
		        case "5" : $strError = "Information provided is not unique. (".$errorcontrol.")"; break;
		        case "6" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
		        case "7" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
		        case "8" : $strError = "Subscriber already exists."; break;
		        case "9" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
		        case "10" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
		          //case "11" : This error does not exist.
		        case "12" : $strError = "The subscriber you are attempting to insert is on the master unsubscribe list or the global unsubscribe list."; break;
		        default : $strError = "Other"; break;
		          //case "13" : Check that the list ID and/or MID specified in your code is correct.
			}
			?>
														
			<div class="title">Get The Newsletter</div>
			
			<form action="http://cl.exct.net/subscribe.aspx?lid=<?php echo $formID; ?>" name="subscribeForm" method="post">
				<input type="hidden" name="thx" value="<?php echo $url; ?>#subscribe-success" />
				<input type="hidden" name="err" value="<?php echo $url; ?>" />
				<input type="hidden" name="MID" value="6283180" />
		        

				<fieldset>
					<input alt="Email Address" type="text" name="Email Address" size="25" maxlength="100" value="" placeholder="Enter Your Email..." >
			        <!--<input alt="Third Party" type="checkbox" checked="checked" value="22697" name="interests" id="receive" />
			        <input type="hidden" name="OptoutInfo" value="">
			        <div class="opt-in">Yes, I'd like to receive offers from your partners</div>-->
			        
					<input type="submit" value="Sign Up" style="margin-left: 20px;" />
				      

				</fieldset>
			</form>
			<script type="text/javascript">
				var querystring = window.location.search.substring(1);
				var vars = querystring.split('&');
				var subsSuccess = window.location.hash.substr(1)
		
				if(subsSuccess == "subscribe-success"){
					alert('Thank you for subscribing to the <?php echo SITE_NAME; ?> Newsletter.');
				}
				else if(vars[0] == "errorcode=1" || vars[0] == "errorcode=2" || vars[0] == "errorcode=3" || vars[0] == "errorcode=4" || vars[0] == "errorcode=5" || vars[0] == "errorcode=6" || vars[0] == "errorcode=7" || vars[0] == "errorcode=8" || vars[0] == "errorcode=9" || vars[0] == "errorcode=10" || vars[0] == "errorcode=12"){
					alert('<?php echo $strError; ?>');
				}	
		
			</script>

		
			<div class="follow" style="margin-top: -8px;">
            	<div class="follow-us">Follow us:</div>
                <?php social_networks(); ?>
			</div>
				
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


//Show Pages
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
						'placeholder' => '/tv/about',
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
				'key' => 'field_53cd59621035k',
				'label' => 'Background Skin Mobile',
				'name' => 'background_skin_mobile',
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
				'instructions' => 'The url of the show\'s background image for mobile to reduce loading time',
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
				'key' => 'field_53cd5a876d31b',
				'label' => 'Store URL',
				'name' => 'show_store',
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
				'instructions' => 'Link to the store',
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
				'key' => 'field_54297167d11cb',
				'label' => 'Seasons',
				'name' => 'seasons',
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

				'instructions' => 'List which seasons to display in the season filter. Please list them from newest to oldest.',
				'sub_fields' => array (
					array (
						'key' => 'field_542972383f704',
						'label' => 'Season',
						'name' => 'season',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => 'Season 8',
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
				'key' => 'field_53ff6b8b9f459',
				'label' => 'Category Filter',
				'name' => 'category_filter',
				'type' => 'taxonomy',
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

				'instructions' => 'Choose the categories to filter by.',
				'taxonomy' => 'category',
				'field_type' => 'checkbox',
				'allow_null' => 0,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
			),
			array (
				'key' => 'field_53f4b2515ed4c',
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

				'instructions' => 'Add sponsor images.',
				'sub_fields' => array (
					array (
						'key' => 'field_53f4b2725ed4d',
						'label' => 'Sponsor Name',
						'name' => 'name',
						'type' => 'text',
						'instructions' => 'Name of the sponsor.',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_53f4b2845ed4e',
						'label' => 'Sponsor Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => 'Sponsor Image.',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_53f4b2a75ed4f',
						'label' => 'Sponsor URL',
						'name' => 'url',
						'type' => 'text',
						'instructions' => 'Sponsor link.',
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
	register_field_group(array (
		'id' => 'acf_post-format-galleries',
		'title' => 'Post Format: Galleries',
		'fields' => array (
			array (
				'key' => 'field_53e90c18b4eae',
				'label' => 'Gallery Images',
				'name' => 'gallery_images',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_53e90c43b4eaf',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
						'instructions' => 'Select an image',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_53e90c63b4eb0',
						'label' => 'title',
						'name' => 'title',
						'type' => 'text',
						'instructions' => 'Image Title',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_53e90c6eb4eb1',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'text',
						'instructions' => 'Image description',
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
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
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
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_scroll-tracking',
		'title' => 'Scroll Tracking',
		'fields' => array (
			array (
				'key' => 'field_5410b1fb2b42d',
				'label' => 'Enable GA scroll tracking',
				'name' => 'scroll_tracking',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
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
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_tune-in-widget',
		'title' => 'Tune In Widget',
		'fields' => array (
			array (
				'key' => 'field_544ea5046cf05',
				'label' => 'Display Widget',
				'name' => 'display_widget',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_544ea4bb54d2b',
				'label' => 'Show Post',
				'name' => 'show_post',
				'type' => 'relationship',
				'instructions' => 'Show Title',
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
				'max' => 1,
			),
			array (
				'key' => 'field_545a65a45c65d',
				'label' => 'Show Title',
				'name' => 'title',
				'type' => 'text',
				'instructions' => 'Title of the show.',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_544ea7c566ded',
				'label' => 'Day of the Week',
				'name' => 'day',
				'type' => 'select',
				'instructions' => 'Choose the reoccurring day of the week you would like this to show.',
				'choices' => array (
					'Sunday' => 'Sunday',
					'Monday' => 'Monday',
					'Tuesday' => 'Tuesday',
					'Wednesday' => 'Wednesday',
					'Thursday' => 'Thursday',
					'Friday' => 'Friday',
					'Saturday' => 'Saturday',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_545a5e6a88396',
				'label' => 'Air Time',
				'name' => 'air_time',
				'type' => 'select',
				'instructions' => 'Select what time the show airs.',
				'choices' => array (
					'0000' => '12:30am',
					'0100' => '1am',
					'0130' => '1:30am',
					'0200' => '2am',
					'0230' => '2:30am',
					'0300' => '3am',
					'0330' => '3:30am',
					'0400' => '4am',
					'0430' => '4:30am',
					'0500' => '5am',
					'0530' => '5:30am',
					'0600' => '6am',
					'0630' => '6:30am',
					'0700' => '7am',
					'0730' => '7:30am',
					'0800' => '8am',
					'0830' => '8:30am',
					'0900' => '9am',
					'0930' => '9:30am',
					1000 => '10am',
					1030 => '10:30am',
					1100 => '11am',
					1130 => '11:30am',
					1200 => '12:30pm',
					1300 => '1pm',
					1330 => '1:30pm',
					1400 => '2pm',
					1430 => '2:30pm',
					'01500' => '3pm',
					1530 => '3:30pm',
					1600 => '4pm',
					1630 => '4:30pm',
					1700 => '5pm',
					1730 => '5:30pm',
					1800 => '6pm',
					1830 => '6:30pm',
					1900 => '7pm',
					1930 => '7:30pm',
					2000 => '8pm',
					2030 => '8:30pm',
					2100 => '9pm',
					2130 => '9:30pm',
					2200 => '10pm',
					2230 => '10:30pm',
					2300 => '11pm',
					2330 => '11:30pm',
				),
				'default_value' => '',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_54625356a712c',
				'label' => 'Show Promo',
				'name' => 'show_promo',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'Tonight at 8pm EST',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_544ea4d74f654',
				'label' => 'Show Description',
				'name' => 'show_description',
				'type' => 'text',
				'instructions' => 'Show Description',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_544ea724356d9',
				'label' => 'Show URL',
				'name' => 'show_url',
				'type' => 'text',
				'instructions' => 'URL to the TV show page',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_544ea4e24f655',
				'label' => 'Remind Me',
				'name' => 'remind_me',
				'type' => 'text',
				'instructions' => 'url of the remind me button',
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
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}


add_action( 'wp_ajax_nopriv_load-filter', 'prefix_load_cat_posts' );
add_action( 'wp_ajax_load-filter', 'prefix_load_cat_posts' );
function prefix_load_cat_posts () {
	
	$idObj = get_category_by_slug('tv'); 
	$id = $idObj->term_id;
	$acfID = 'category_' . $id;
	$seasons = get_field("season_filter", $acfID);
	
    $cat_id = $_POST[ 'cat' ];
    $offset = $_POST[ 'offset' ];
    
    if($cat_id == "most-recent"){
	     $args = array( 
		    'tax_query' => array(
			    array(
			      'taxonomy' => 'post_format',
			      'field' => 'slug',
			      'terms' => 'post-format-video'
			    )
			  ),
		'offset' => $offset,
		'showposts' => 8 
		); 
    }else{
    
	    $args = array (
	        'tax_query' => array(
	        'relation' => 'AND',
			    array(
			        'taxonomy' => 'category',
			        'field' => 'slug',
			        'terms' => array ( $cat_id ),
			    ),
			    array(
			      'taxonomy' => 'post_format',
			      'field' => 'slug',
			      'terms' => 'post-format-video'
			    )
			  ),
		'offset' => $offset,
		'showposts' => 8 
		  );
	}
	$posts = get_posts( $args );
	
	
	global $post;
	
	ob_start ();
	
	$i = $offset;
	

	foreach ( $posts as $post ) {
		$i++;
		setup_postdata( $post ); 
		
		$post_id = $post->ID;
		$slug = $post->post_name;
		$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
		$video_id = get_post_meta($post_id, '_video_id', TRUE);
		$videoLink = !empty($post_id) ? get_permalink($post_id) :  site_url() . $_SERVER['REQUEST_URI']; 
		$adServerURL = "http://ad.doubleclick.net/pfadx/" .  get_option("dart_domain", _imo_dart_guess_domain())  ."/tv";
		$cats = get_the_category( $post_id );
		foreach($cats as $cat){
			$catSlug = $cat->slug;
			if(strpos($catSlug,'season') !== false){
				$catSlug = $cat->slug;
				$catName = $cat->name;
			}
		} ?>

		<li id="thumb-<?php echo $i; ?>" data-videoid="<?php echo $video_id; ?>">
			<div class="data-description" style="display:none;"><?php the_content(); ?></div>
			<a class="video-thumb" data-slug="<?php echo $slug; ?>" data-img_url="<?php echo $thumb_url; ?>" data-post_url="<?php echo get_permalink(); ?>" data-title="<?php echo get_the_title(); ?>" data-date="<?php the_time('F jS, Y'); ?>" data-videoid="<?php echo $video_id; ?>" adServerURL="<?php echo $adServerURL; ?>" videoLink="<?php echo $videoLink; ?>">
				<div class="thumb-wrap">
					<?php the_post_thumbnail("show-thumb"); ?>
					<span class="play-btn"></span>
				</div>
				<span class="season-number"><?php echo $catName; ?></span>
				<h3><?php the_title(); ?></h3>
			</a>
		</li>
			
	<?php } 
	wp_reset_postdata();

	$response = ob_get_contents();
	ob_end_clean();
	
	echo $response;
	die(1);
}

// G&F Reader Photo pagination
add_action( 'wp_ajax_nopriv_photos-filter', 'prefix_load_photos_posts' );
add_action( 'wp_ajax_photos-filter', 'prefix_load_photos_posts' );
function prefix_load_photos_posts () {

	$dartDomain = get_option("dart_domain", $default = false);
	
	if($dartDomain == "imo.hunting"){
	
		$postType = "rack_room";
		
	}else if($dartDomain == "imo.in-fisherman"){
	
		$postType = "fish_head_photos";
		
	}else{
	
		$postType = "reader_photos";
		
	}

	$cat_id = $_POST[ 'cat' ];
    $offset = $_POST[ 'offset' ];
    
    if($cat_id){
	    $args = array(
			'post_type' => $postType,
			'offset' => $offset,
			'showposts' => 10,
			'tax_query' => array(
			  'relation' => 'AND',
			  array(
			     'taxonomy' => 'category',
			     'field' => 'slug',
			     'terms' => array( $cat_id )
			  )
			)
		);

    }else{
	    $args = array(
			'post_type' => $postType,
			'offset' => $offset,
			'showposts' => 10,
		);

    }
    
	

	$posts = get_posts( $args );
	
	
	global $post;
	
	ob_start ();
	
	$i = $offset;
	

	foreach ( $posts as $post ) {
		$comment_number = get_comments_number();
		if($comment_number == 1){
			$reply = "reply";
		}else{
			$reply = "replies";
		}

		$categories = get_the_category($post->id);
		$i++;
		setup_postdata( $post ); 
		
		?>
		
		<div class="dif-post post">
	        <div class="feat-img">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("list-thumb"); ?></a>
	        </div>
	        <div class="dif-post-text">
	            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	            <div class="profile-panel">
	                <div class="profile-data">
	                	<?php if($dartDomain == "imo.northamericanwhitetail"){ ?>
							<h4><a href="/author/<?php echo get_the_author_meta("user_nicename"); ?>"><?php the_author(); ?></a></h4>
							
							 <ul class="prof-tags">
			                	<?php foreach($categories as $category) { ?>
			                    	<li><a href="/community/?<?php echo $category->slug; ?>"><?php echo $category->cat_name; ?></a></li>    
			                    <?php } ?>                
			                </ul>
				            <div class="clearfix"></div>
			                <ul class="replies">
			                    <li><?php the_time('F jS, Y'); ?><div class="bullet"></div></li>
			                    <li><a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(). " ".$reply; ?></a></li>
			                </ul>
			
						<?php } ?>
	                    <ul class="prof-like">
	                    	<li>
	                    		<div class="fb-like fb_iframe_widget" data-href="<?php echo get_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
	                       </li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>

					
	<?php } 
	wp_reset_postdata();

	$response = ob_get_contents();
	ob_end_clean();
	
	echo $response;
	die(1);
}


// FlyFish Reader Photo pagination
add_action( 'wp_ajax_nopriv_ff-photos-filter', 'prefix_load_ff_photos_posts' );
add_action( 'wp_ajax_ff-photos-filter', 'prefix_load_ff_photos_posts' );
function prefix_load_ff_photos_posts () {
	
	$piece2 = $_POST[ 'cat' ];
    $offset = $_POST[ 'offset' ];
	$piece1 = $_POST[ 'type' ];

	if($piece1 && $piece2){
		 $args = array(
			   'post_type' => 'reader_photos',
			   'offset' => $offset,
			   'showposts' => 10,
			   'tax_query' => array(
			      'relation' => 'AND',
			      array(
			         'taxonomy' => 'category',
			         'field' => 'slug',
			         'terms' => array( $piece1 )
			      ),
			      array (
			         'taxonomy' => 'category',
			         'field' => 'slug',
			         'terms' => array( $piece2 )
			      )
			   )
			);
	}else if($piece1 && !$piece2){
		$args = array(
		   'post_type' => 'reader_photos',
		   'offset' => $offset,
		   'showposts' => 10,
		   'tax_query' => array(
		      'relation' => 'AND',
		      array(
		         'taxonomy' => 'category',
		         'field' => 'slug',
		         'terms' => array( $piece1 )
		      )
		   )
		);

	}else if(!$piece1 && !$piece2){
		
		$args = array(
		   'post_type' => 'reader_photos',
		   'offset' => $offset,
		   'showposts' => 10
		);

	}	
		
	$posts = get_posts( $args );
	
	
	global $post;
	
	ob_start ();
	
	$i = $offset;
	

	foreach ( $posts as $post ) {
		$i++;
		setup_postdata( $post ); 
		?>
		
		<div class="dif-post post">
	        <div class="feat-img">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("list-thumb"); ?></a>
	        </div>
	        <div class="dif-post-text">
	            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	            <div class="profile-panel">
	                <div class="profile-data">
	                    <ul class="prof-like">
	                    	<li>
	                    		<div class="fb-like fb_iframe_widget" data-href="<?php echo get_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
	                       </li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>

					
	<?php } 
	wp_reset_postdata();

	$response = ob_get_contents();
	ob_end_clean();
	
	echo $response;
	die(1);
}

/*
 *  Set default values for the upload media box
 */
//update_option('image_default_align', 'center' );
update_option('image_default_link_type', 'none' );
//update_option('image_default_size', 'large' );








