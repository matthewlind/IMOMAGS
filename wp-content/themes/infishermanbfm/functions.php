<?php

define('TIMELY_FEATURES', 'timely-features');
define('MASTER_ANGLERS', 'master-anglers');
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

    register_sidebar( array(
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
    ) );

    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'infisherman' ),
        'id' => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Showcase Sidebar', 'infisherman' ),
        'id' => 'sidebar-2',
        'description' => __( 'The sidebar for the optional Showcase Template', 'twentyeleven' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    register_sidebar( array(
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
    ) );

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