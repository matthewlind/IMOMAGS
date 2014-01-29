<?php
/**
 * functions.php 
 */

define("JETPACK_SITE", "rifleshootermag");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0145Y&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0145Y&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0NVk0NDc3NSZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 65% off<br/> the Cover Price");


/**************************************************************************************************************************************
******
*****  Custom Meta Boxes for admin area
******
**************************************************************************************************************************************/


// Add to admin_init function
add_action('save_post', 'save_category_data', 50 );
 
function save_category_data($post_id) {  
    // verify this came from the our screen and with proper authorization.
    if ( !wp_verify_nonce( array($_POST['post_category[]']), $post_id )) {
        return $post_id;
    }

    // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
        return $post_id;
     
    // Check permissions
    if ( !current_user_can( 'edit_post', $post_id ) )
        return $post_id;
   
       
  
    // OK, we're authenticated: we need to find and save the data   
    $post = get_post($post_id);

    //if ($post->post_type == 'post') { 
        //update_post_meta($post_id, '_gallery_type', esc_attr($_POST['gallery_type']) );
                //return(esc_attr($_POST['gallery_type']));
     $terms = array($_POST['post_category[]']); 
     wp_set_post_categories($post_id, $terms);
    return(esc_attr($terms));
        	
   // }

    return $post_id;
   
}


// remove the old CATEGORY box
function remove_default_categories_box() {
    remove_meta_box('categorydiv', 'post', 'side');
}
add_action( 'admin_head', 'remove_default_categories_box' );


// add a Post Placement meta box
function add_custom_categories_box() {
    add_meta_box('customcategorydiv', 'Post Placement', 'custom_post_categories_meta_box', 'post', 'side', 'high', array( 'taxonomy' => 'category' ));
}
add_action('admin_menu', 'add_custom_categories_box');

/**
 *
 * Post Placement custom list.
 *
*/
function custom_terms_checklist($post_id = 0, $args = array()) {
	        $defaults = array(
	                'descendants_and_self' => 0,
	                'selected_cats' => false,
	                'popular_cats' => false,
	                'walker' => null,
	                'taxonomy' => 'category',
	                'checked_ontop' => true
	        );
	        $args = apply_filters( 'custom_terms_checklist_args', $args, $post_id );
	        
	        //Convert the slugs to ids for the list
	        $featured = get_term_by( 'slug', 'featured', 'category' );	 
	        $galleries = get_term_by( 'slug', 'galleries', 'category' );       
	       	$video = get_term_by( 'slug', 'video', 'category' );
	       	$blogs = get_term_by( 'slug', 'blogs', 'category' );	        
	       	$powder = get_term_by( 'slug', 'powder-burns', 'category' );
	       	$rupp = get_term_by( 'slug', 'rupp-on-rifles', 'category' );
	       	$blogs = get_term_by( 'slug', 'blogs', 'category' );
	       	$editors_desk = get_term_by( 'slug', 'editors-desk', 'category' );
	       	$reviews = get_term_by( 'slug', 'reviews', 'category' );
	       	$news = get_term_by( 'slug', 'news', 'category' );

	      		        
		    // Create the ID array
		    $include = array(
		    	$featured->term_id,$galleries->term_id,$video->term_id,
		    	$blogs->term_id,$editors_desk->term_id,$reviews->term_id,$news->term_id
		    );
		    
	        extract( wp_parse_args($args, $defaults), EXTR_SKIP );
	
	        if ( empty($walker) || !is_a($walker, 'Walker') )
	                $walker = new Walker_Category_Checklist;
	
	        $descendants_and_self = (int) $descendants_and_self;
	
	        $args = array('taxonomy' => $taxonomy);
	
	        $tax = get_taxonomy($taxonomy);
	        $args['disabled'] = !current_user_can($tax->cap->assign_terms);
	        
	        if ( is_array( $selected_cats ) )
	                $args['selected_cats'] = $selected_cats;
	        elseif ( $post_id )
	                $args['selected_cats'] = wp_get_object_terms($post_id, $taxonomy, array_merge($args, array('fields' => 'ids')));
	        else
	                $args['selected_cats'] = array();
	
	        if ( $descendants_and_self ) {
	                $categories = (array) get_terms($taxonomy, array( 'child_of' => $descendants_and_self, 'hierarchical' => 0, 'hide_empty' => 0 ) );
	                $self = get_term( $descendants_and_self, $taxonomy );
	                array_unshift( $categories, $self );
	        } else {
	        	
	        	    $categories = (array) get_terms($taxonomy, array( 'child_of' => $descendants_and_self, 'include' => $include, 'hide_empty' => 0 ));
	        }
	
	        if ( $checked_ontop ) {
	                // Post process $categories rather than adding an exclude to the get_terms() query to keep the query the same across all posts (for any query cache)
	                $checked_categories = array();
	                $keys = array_keys( $categories );
	
	                foreach( $keys as $k ) {
	                        if ( in_array( $categories[$k]->term_id, $args['selected_cats'] ) ) {
	                                $checked_categories[] = $categories[$k];
	                                unset( $categories[$k] );
	                        }
	                }
	
	                // Put checked cats on top
	                echo call_user_func_array(array(&$walker, 'walk'), array($checked_categories, 0, $args));
	        }
	        // Then the rest of them
	        echo call_user_func_array(array(&$walker, 'walk'), array($categories, 0, $args));
}

/**
 * Display CUSTOM post categories form fields.
 *
 * @since 2.6.0
 *
 * @param object $post
*/
function custom_post_categories_meta_box( $post, $box ) {
    $defaults = array('taxonomy' => 'category');
    if ( !isset($box['args']) || !is_array($box['args']) )
        $args = array();
    else
        $args = $box['args'];
    extract( wp_parse_args($args, $defaults), EXTR_SKIP );
    $tax = get_taxonomy($taxonomy);

    ?>
    <div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv primary-box">
       <div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
            <?php
            $name = ( $taxonomy == 'category' ) ? 'post_category' : 'tax_input[' . $taxonomy . ']';
            echo "<input type='hidden' name='{$name}' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
            ?>
            <ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy?> categorychecklist form-no-clear">
                <?php custom_terms_checklist($post->ID, array( 'taxonomy' => $taxonomy, 'popular_cats' => $popular_ids ) ) ?>
            </ul>
        </div>
         
    </div>
    <?php 
}







// add a Gun terminology meta box
function add_custom_gun_terminology_box() {
    add_meta_box('customguntermdiv', 'Gun Terminology', 'custom_post_gun_terminology_meta_box', 'post', 'side', 'high', array( 'taxonomy' => 'category' ));
}
add_action('admin_menu', 'add_custom_gun_terminology_box');

/**
 *
 * Gun Terminology custom list.
 *
*/
function custom_gun_terminology_checklist($post_id = 0, $args = array()) {
        $defaults = array(
                'descendants_and_self' => 0,
                'selected_cats' => false,
                'popular_cats' => false,
                'walker' => null,
                'taxonomy' => 'category',
                'checked_ontop' => true
        );
        $args = apply_filters( 'custom_gun_terminology_checklist_args', $args, $post_id );
        
        //Convert the slugs to ids for the list
        $ar15 = get_term_by( 'slug', 'ar-15', 'category' );
        $rifles = get_term_by( 'slug', 'rifles', 'category' );
        $bolt = get_term_by( 'slug', 'bolt-action', 'category' );
        $lever = get_term_by( 'slug', 'lever-action', 'category' );
        $rim_rifle = get_term_by( 'slug', 'rim-fire-rifle', 'category' );
        $semi_rifle = get_term_by( 'slug', 'semi-auto-rifle', 'category' );
        $ammo = get_term_by( 'slug', 'ammo', 'category' );
        $gear = get_term_by( 'slug', 'gear-accessories', 'category' );
        $optics = get_term_by( 'slug', 'optics', 'category' );
        $ballistics = get_term_by( 'slug', 'ballistics', 'category' );
        $airguns = get_term_by( 'slug', 'airguns', 'category' ); 
        $riflescopes = get_term_by( 'slug', 'riflescopes', 'category' );
        $longrange = get_term_by( 'slug', 'long-range', 'category' );

	    // Create the ID array
	    $include = array(
	    	$handguns->term_id,$nineteen_elevens->term_id,$compacts->term_id,$rim_revolvers->term_id,
	        $rim_hand->term_id,$semi_hand->term_id,$ar15->term_id,$rifles->term_id,$bolt->term_id,
	        $lever->term_id,$rim_rifle->term_id,$semi_rifle->term_id,$shotguns->term_id,$double->term_id,
	        $pump_shot->term_id,$semi_shot->term_id,$ammo->term_id,$gear->term_id,$optics->term_id,
	        $ballistics->term_id,$airguns->term_id,$riflescopes->term_id,$longrange->term_id
	    );

        extract( wp_parse_args($args, $defaults), EXTR_SKIP );

        if ( empty($walker) || !is_a($walker, 'Walker') )
                $walker = new Walker_Category_Checklist;

        $descendants_and_self = (int) $descendants_and_self;

        $args = array('taxonomy' => $taxonomy);

        $tax = get_taxonomy($taxonomy);
        $args['disabled'] = !current_user_can($tax->cap->assign_terms);

        if ( is_array( $selected_cats ) )
                $args['selected_cats'] = $selected_cats;
        elseif ( $post_id )
                $args['selected_cats'] = wp_get_object_terms($post_id, $taxonomy, array_merge($args, array('fields' => 'ids')));
        else
                $args['selected_cats'] = array();

        if ( $descendants_and_self ) {
                $categories = (array) get_terms($taxonomy, array( 'child_of' => $descendants_and_self, 'hierarchical' => 0, 'hide_empty' => 0 ) );
                $self = get_term( $descendants_and_self, $taxonomy );
                array_unshift( $categories, $self );
        } else {
                $categories = (array) get_terms($taxonomy, array( 'child_of' => $descendants_and_self, 'include' => $include, 'hide_empty' => 0 ));
        }

        if ( $checked_ontop ) {
                // Post process $categories rather than adding an exclude to the get_terms() query to keep the query the same across all posts (for any query cache)
                $checked_categories = array();
                $keys = array_keys( $categories );

                foreach( $keys as $k ) {
                        if ( in_array( $categories[$k]->term_id, $args['selected_cats'] ) ) {
                                $checked_categories[] = $categories[$k];
                                unset( $categories[$k] );
                        }
                }

                // Put checked cats on top
                echo call_user_func_array(array(&$walker, 'walk'), array($checked_categories, 0, $args));
        }
        // Then the rest of them
        echo call_user_func_array(array(&$walker, 'walk'), array($categories, 0, $args));
}

/**
 * Display CUSTOM Gun Terminology form fields.
 *
 * @since 2.6.0
 *
 * @param object $post
*/
function custom_post_gun_terminology_meta_box( $post, $box ) {
    $defaults = array('taxonomy' => 'category');
    if ( !isset($box['args']) || !is_array($box['args']) )
        $args = array();
    else
        $args = $box['args'];
    extract( wp_parse_args($args, $defaults), EXTR_SKIP );
    $tax = get_taxonomy($taxonomy);

    ?>
    <div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv primary-box">
       <div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
            <?php
            $name = ( $taxonomy == 'category' ) ? 'post_cat' : 'tax_input[' . $taxonomy . ']';
            echo "<input type='hidden' name='{$name}' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
            ?>
            <ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy?> categorychecklist form-no-clear">
                <?php custom_gun_terminology_checklist($post->ID, array( 'taxonomy' => $taxonomy, 'popular_cats' => $popular_ids ) ) ?>
            </ul>
        </div>
         
    </div>
    <?php 
}




// add Topics box
function add_custom_topics_box() {
    add_meta_box('customtopicsdiv', 'Topics', 'custom_post_topics_meta_box', 'post', 'side', 'high', array( 'taxonomy' => 'category' ));
}
add_action('admin_menu', 'add_custom_topics_box');

/**
 *
 * Topics custom list.
 *
*/
function custom_topics_checklist($post_id = 0, $args = array()) {
	        $defaults = array(
	                'descendants_and_self' => 0,
	                'selected_cats' => false,
	                'popular_cats' => false,
	                'walker' => null,
	                'taxonomy' => 'category',
	                'checked_ontop' => true
	        );
	        $args = apply_filters( 'custom_topics_checklist_args', $args, $post_id );
	        
	        //Convert the slugs to ids for the list
	        $reloading = get_term_by( 'slug', 'reloading', 'category' );
	        $military = get_term_by( 'slug', 'military-law-enforcement', 'category' );
	        $historical = get_term_by( 'slug', 'historical', 'category' );
	        $tactical = get_term_by( 'slug', 'tactical', 'category' );
	        $personal = get_term_by( 'slug', 'personal-defense', 'category' );
	        $culture = get_term_by( 'slug', 'gun-culture', 'category' );
	        $survival = get_term_by( 'slug', 'survival', 'category' );
	        $gunsmithing = get_term_by( 'slug', 'gunsmithing', 'category' );
	        $zombie = get_term_by( 'slug', 'zombie', 'category' );
	        $competition = get_term_by( 'slug', 'competition', 'category' );
		    $politics = get_term_by( 'slug', 'politics', 'category' );
		    $carry = get_term_by( 'slug', 'concealed-carry', 'category' );
		    $longrange = get_term_by( 'slug', 'longrange', 'category' );
		    $personal = get_term_by( 'slug', 'personal-defense', 'category' );
		    $hunting = get_term_by( 'slug', 'hunting', 'category' );
		        
		    // Create the ID array
		    $include = array(
		    	$reloading->term_id,$military->term_id,$historical->term_id,$tactical->term_id,
		        $personal->term_id,$culture->term_id,$survival->term_id,$gunsmithing->term_id,
		        $competition->term_id,$politics->term_id,$carry->term_id,$zombie->term_id,
		        $longrange->term_id,$personal->term_id,$hunting->term_id
		    );

	        extract( wp_parse_args($args, $defaults), EXTR_SKIP );
	
	        if ( empty($walker) || !is_a($walker, 'Walker') )
	                $walker = new Walker_Category_Checklist;
	
	        $descendants_and_self = (int) $descendants_and_self;
	
	        $args = array('taxonomy' => $taxonomy);
	
	        $tax = get_taxonomy($taxonomy);
	        $args['disabled'] = !current_user_can($tax->cap->assign_terms);
	
	        if ( is_array( $selected_cats ) )
	                $args['selected_cats'] = $selected_cats;
	        elseif ( $post_id )
	                $args['selected_cats'] = wp_get_object_terms($post_id, $taxonomy, array_merge($args, array('fields' => 'ids')));
	        else
	                $args['selected_cats'] = array();

	        if ( $descendants_and_self ) {
	                $categories = (array) get_terms($taxonomy, array( 'child_of' => $descendants_and_self, 'hierarchical' => 0, 'hide_empty' => 0 ) );
	                $self = get_term( $descendants_and_self, $taxonomy );
	                array_unshift( $categories, $self );
	        } else {
	                $categories = (array) get_terms($taxonomy, array( 'child_of' => $descendants_and_self, 'include' => $include, 'hide_empty' => 0 ));
	        }
	
	        if ( $checked_ontop ) {
	                // Post process $categories rather than adding an exclude to the get_terms() query to keep the query the same across all posts (for any query cache)
	                $checked_categories = array();
	                $keys = array_keys( $categories );
	
	                foreach( $keys as $k ) {
	                        if ( in_array( $categories[$k]->term_id, $args['selected_cats'] ) ) {
	                                $checked_categories[] = $categories[$k];
	                                unset( $categories[$k] );
	                        }
	                }
	
	                // Put checked cats on top
	                echo call_user_func_array(array(&$walker, 'walk'), array($checked_categories, 0, $args));
	        }
	        // Then the rest of them
	        echo call_user_func_array(array(&$walker, 'walk'), array($categories, 0, $args));
}

/**
 * Display CUSTOM Topics form fields.
 *
 * @since 2.6.0
 *
 * @param object $post
*/
function custom_post_topics_meta_box( $post, $box ) {
    $defaults = array('taxonomy' => 'category');
    if ( !isset($box['args']) || !is_array($box['args']) )
        $args = array();
    else
        $args = $box['args'];
    extract( wp_parse_args($args, $defaults), EXTR_SKIP );
    $tax = get_taxonomy($taxonomy);

    ?>
    <div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv primary-box">
       <div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
            <?php
            $name = ( $taxonomy == 'category' ) ? 'post_cat' : 'tax_input[' . $taxonomy . ']';
            echo "<input type='hidden' name='{$name}' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
            ?>
            <ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy?> categorychecklist form-no-clear">
                <?php custom_topics_checklist($post->ID, array( 'taxonomy' => $taxonomy, 'popular_cats' => $popular_ids ) ) ?>
            </ul>
        </div>
         
    </div>
    <?php 
}


// add G&A Network box
function add_custom_ga_network_box() {
    add_meta_box('customganetworkdiv', 'G&A Network', 'custom_post_ga_network_meta_box', 'post', 'side', 'high', array( 'taxonomy' => 'category' ));
}
add_action('admin_menu', 'add_custom_ga_network_box');

/**
 *
 * Network Topics custom list.
 *
*/
function custom_ga_network_checklist($post_id = 0, $args = array()) {
	        $defaults = array(
	                'descendants_and_self' => 0,
	                'selected_cats' => false,
	                'popular_cats' => false,
	                'walker' => null,
	                'taxonomy' => 'category',
	                'checked_ontop' => true
	        );
	        $args = apply_filters( 'custom_ga_network_checklist_args', $args, $post_id );
	        
	        //Convert the slugs to ids for the list
	        $guns= get_term_by( 'slug', 'the-guns-network', 'category' );
	        $gear = get_term_by( 'slug', 'the-gear-network', 'category' );
	        $survival = get_term_by( 'slug', 'survival-network', 'category' );
	        $culture = get_term_by( 'slug', 'culture-politics-network', 'category' );
	        $personal = get_term_by( 'slug', 'personal-defense-network', 'category' );
		        
		    // Create the ID array
		    $include = array($guns->term_id,$gear->term_id,$survival->term_id,$culture->term_id,$personal->term_id);

	        extract( wp_parse_args($args, $defaults), EXTR_SKIP );
	
	        if ( empty($walker) || !is_a($walker, 'Walker') )
	                $walker = new Walker_Category_Checklist;
	
	        $descendants_and_self = (int) $descendants_and_self;
	
	        $args = array('taxonomy' => $taxonomy);
	
	        $tax = get_taxonomy($taxonomy);
	        $args['disabled'] = !current_user_can($tax->cap->assign_terms);
	
	        if ( is_array( $selected_cats ) )
	                $args['selected_cats'] = $selected_cats;
	        elseif ( $post_id )
	                $args['selected_cats'] = wp_get_object_terms($post_id, $taxonomy, array_merge($args, array('fields' => 'ids')));
	        else
	                $args['selected_cats'] = array();

	        if ( $descendants_and_self ) {
	                $categories = (array) get_terms($taxonomy, array( 'child_of' => $descendants_and_self, 'hierarchical' => 0, 'hide_empty' => 0 ) );
	                $self = get_term( $descendants_and_self, $taxonomy );
	                array_unshift( $categories, $self );
	        } else {
	                $categories = (array) get_terms($taxonomy, array( 'child_of' => $descendants_and_self, 'include' => $include, 'hide_empty' => 0 ));
	        }
	
	        if ( $checked_ontop ) {
	                // Post process $categories rather than adding an exclude to the get_terms() query to keep the query the same across all posts (for any query cache)
	                $checked_categories = array();
	                $keys = array_keys( $categories );
	
	                foreach( $keys as $k ) {
	                        if ( in_array( $categories[$k]->term_id, $args['selected_cats'] ) ) {
	                                $checked_categories[] = $categories[$k];
	                                unset( $categories[$k] );
	                        }
	                }
	
	                // Put checked cats on top
	                echo call_user_func_array(array(&$walker, 'walk'), array($checked_categories, 0, $args));
	        }
	        // Then the rest of them
	        echo call_user_func_array(array(&$walker, 'walk'), array($categories, 0, $args));
}

/**
 * Display CUSTOM G&A Network form fields.
 *
 * @since 2.6.0
 *
 * @param object $post
*/
function custom_post_ga_network_meta_box( $post, $box ) {
    $defaults = array('taxonomy' => 'category');
    if ( !isset($box['args']) || !is_array($box['args']) )
        $args = array();
    else
        $args = $box['args'];
    extract( wp_parse_args($args, $defaults), EXTR_SKIP );
    $tax = get_taxonomy($taxonomy);

    ?>
    <div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv primary-box">
       <div id="<?php echo $taxonomy; ?>-all" class="tabs-panel" style="height:auto;">
            <?php
            $name = ( $taxonomy == 'category' ) ? 'post_cat' : 'tax_input[' . $taxonomy . ']';
            echo "<input type='hidden' name='{$name}' value=' ' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
            ?>
            <ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy?> categorychecklist form-no-clear">
                <?php custom_ga_network_checklist($post->ID, array( 'taxonomy' => $taxonomy, 'popular_cats' => $popular_ids ) ) ?>
            </ul>
        </div>
         
    </div>
    <?php 
}

// Primary Category Quick & Bulk edit functions
// Add the Column to our admin_init function
add_filter('manage_post_posts_columns', 'shiba_add_post_columns');
 
function shiba_add_post_columns($columns) {
    $columns['primary_set'] = 'Primary Category';
    return $columns;
}
// Add to our admin_init function
add_action('manage_posts_custom_column', 'shiba_render_post_columns', 10, 2);
 
function shiba_render_post_columns($column_name, $id) {
    switch ($column_name) {
    case 'primary_set':
        $primary_id = get_post_meta( $id, '_category_permalink', TRUE);
       
        $post_id = get_post_meta( 'post_id', '_category_permalink', TRUE);
        $primary = (array) get_term_by('id', $primary_id, 'category');
        $primary_name = $primary['name'];

        $primary_set = NULL;
        
        if ($primary_id) 
            $primary_set = get_post($primary_id);        
        if (!NULL) echo $primary_name; 
        else echo 'None';             
        break;
    }
}

// Add Bulk edit to our admin_init function
add_action('bulk_edit_custom_box',  'shiba_add_bulk_edit', 10, 2);
 
function shiba_add_bulk_edit($column_name, $post_type) {
    if ($column_name != 'primary_set') return;
    ?>
    <fieldset class="inline-edit-col-left">
    <div class="inline-edit-col">
        <span class="title">Primary Category</span>
        <input type="hidden" name="shiba_primary_set_noncename" id="shiba_primary_set_noncename" value="" />
        <?php // Get all Categories sets
            $categories = get_categories();
        ?>
        <select name='post_primary_set' id='post_primary_set'>
            <option class='primary-option' value='0'>None</option>
            <?php 
            foreach ($categories as $category) {
                echo "<option class='primary-option' value='{$category->cat_ID}'>{$category->name}</option>\n";
            }
                ?>
        </select>
    </div>
    </fieldset>
    <?php   
}

// Add save Bulk edit to our admin_init function
add_action('admin_footer', 'shiba_bulk_edit_javascript');
 
function shiba_bulk_edit_javascript() {
    global $current_screen;
    if (($current_screen->id != 'edit-post') || ($current_screen->post_type != 'post')) return; 
     
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function ($){
    	
    	
    	
		$( '#bulk_edit' ).live( 'click', function() {
		
		// define the bulk edit row
		var $bulk_row = $( '#bulk-edit' );
		
		// get the selected post ids that are being edited
		var $post_ids = new Array();
		$bulk_row.find( '#bulk-titles' ).children().each( function() {
		  $post_ids.push( $( this ).attr( 'id' ).replace( /^(ttle)/i, '' ) );
		});
		
		// get the release date
		var $post_primary_set = $bulk_row.find( '#post_primary_set' ).val();
		
		//Set the category to save along with it (fail safe for if the primary isn't already assigned to the post as a category
		var $catVal = $(".category-checklist input#in-category-" + $post_primary_set).val();
		if($catVal == $post_primary_set)	{
	    	//$('.category-checklist input#in-category-' + $post_primary_set).attr('checked','checked');
	    	$('.category-checklist input#in-category-' + $post_primary_set).prop('checked', true);
    	}
		// save the data
		$.ajax({
		  url: ajaxurl, // this is a variable that WordPress has already defined for us
		  type: 'POST',
		  async: false,
		  cache: false,
		  data: {
		     action: 'shiba_save_bulk_edit', // this is the name of our WP AJAX function that we'll set up next
		     post_ids: $post_ids, // and these are the 2 parameters we're passing to our function
		 post_primary_set: $post_primary_set
		 
		  }
		});
		});	
		
});
    </script>
    <?php
}

add_action( 'wp_ajax_shiba_save_bulk_edit', 'shiba_save_bulk_edit' );
function shiba_save_bulk_edit() {

   // get our variables
   $post_ids = ( isset( $_POST[ 'post_ids' ] ) && !empty( $_POST[ 'post_ids' ] ) ) ? $_POST[ 'post_ids' ] : array();
   $post_primary_set = ( isset( $_POST[ 'post_primary_set' ] )  ) ? $_POST[ 'post_primary_set' ] : NULL;
   
   // if everything is in order
   if ( !empty( $post_ids ) && is_array( $post_ids )  ) {
      foreach( $post_ids as $post_id ) {
      	if($post_primary_set != 0){
      		update_post_meta( $post_id, '_category_permalink', $post_primary_set ); 		      	
      	}else{
      		delete_post_meta( $post_id, '_category_permalink' ); 		      	
      	}
      }       
    
    }
  
}