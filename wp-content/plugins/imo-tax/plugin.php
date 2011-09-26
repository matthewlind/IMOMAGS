<?php
/*
 * Plugin Name: IMO Taxonomy
 * Plugin URI: http://github.com/imoutdoors
 * Description: Provides a static, hard-coded taxonomy for classification of articles
 * Version: 0.1
 * Author: jacob angel 
 * Author URI: http://imomags.com
 */


/**
 * Define Region Custom Taxonomy
 */
function imo_tax_init() {
    $labels = array();

    $labels['activity'] = array(
        'name' => _x( 'Activities', 'taxonomy general name' ),
        'singular_name' => _x( 'Activity', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Activities' ),
        'all_items' => __( 'All Activities' ),
        'parent_item' => __( 'Parent Activity' ),
        'parent_item_colon' => __( 'Parent Activity:' ),
        'edit_item' => __( 'Edit Activity' ), 
        'update_item' => __( 'Update Activity' ),
        'add_new_item' => __( 'Add New Activity' ),
        'new_item_name' => __( 'New Activity Name' ),
        'menu_name' => __( 'Activity' ),
    ); 

    $labels['gear'] = array(
        'name' => _x( 'Gear', 'taxonomy general name' ),
        'singular_name' => _x( 'Gear', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Gear' ),
        'all_items' => __( 'All Gear' ),
        'parent_item' => __( 'Parent Gear' ),
        'parent_item_colon' => __( 'Parent Gear:' ),
        'edit_item' => __( 'Edit Gear' ), 
        'update_item' => __( 'Update Gear' ),
        'add_new_item' => __( 'Add New Gear' ),
        'new_item_name' => __( 'New Gear Name' ),
        'menu_name' => __( 'Gear' ),
    ); 

    $labels['location'] = array(
        'name' => _x( 'Locations', 'taxonomy general name' ),
        'singular_name' => _x( 'Location', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Locations' ),
        'all_items' => __( 'All Locations' ),
        'parent_item' => __( 'Parent Location' ),
        'parent_item_colon' => __( 'Parent Location:' ),
        'edit_item' => __( 'Edit Location' ), 
        'update_item' => __( 'Update Location' ),
        'add_new_item' => __( 'Add New Location' ),
        'new_item_name' => __( 'New Location Name' ),
        'menu_name' => __( 'Location' ),
    ); 

    $labels['species'] = array(
        'name' => _x( 'Species', 'taxonomy general name' ),
        'singular_name' => _x( 'Species', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Species' ),
        'all_items' => __( 'All Species' ),
        'parent_item' => __( 'Parent Species' ),
        'parent_item_colon' => __( 'Parent Species:' ),
        'edit_item' => __( 'Edit Species' ), 
        'update_item' => __( 'Update Species' ),
        'add_new_item' => __( 'Add New Species' ),
        'new_item_name' => __( 'New Species Name' ),
        'menu_name' => __( 'Species' ),
    );    

    $taxonomies = array(
        "activity" => array(
            "labels" => $labels['activity'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"activity"),
        ),
        "gear" => array(
            "labels" => $labels['gear'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"gear"),
        ),
        "location" => array(            
            "labels" => $labels['location'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"location"),
        ),
        "species" => array(            
            "labels" => $labels['species'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"species"),
        ),
    );

    $types = array("post");

    foreach ($taxonomies as $target_taxonomy => $taxonomy) {
        register_taxonomy(
            $target_taxonomy,
            $types,
            $taxonomy);
    }
}

add_action("init", "imo_tax_init");

/**
 * imo_tax_import_terms() 
 * Recursivly imports terms from a nested array.
 *
 * $terms - array
 * $taxonomy - string - the name of the taxonomy, not the id
 * $parent_id - integer
 *        
 * returns - boolean, false means that you put in bad parameters.  
 */
function imo_tax_import_terms($terms, $taxonomy, $parent_id=NULL) {

    if ( !is_array($terms) || !is_string($taxonomy)) {
        // bad inputs. do not try to import.
        return False;
    }
    else {
        foreach ($terms as $term_key=>$term_value) {
            // slugs may only contain lower-case alphanumeric, -, and _ characters
            $term_name = (is_array($term_value)) ? $term_key : $term_value;
            $slug = preg_replace( '/[^a-z0-9_-]+/', '-', strtolower( $taxonomy . "-" . $term_name ) );
            $new_term = wp_insert_term( $term_name, $taxonomy, array('slug'=> $slug, "parent"=> (int) $parent_id) );
            if ( is_wp_error($new_term) ) {
                print "<p>Could not import term $term_name:" . $new_term->get_error_message() . "</p>";
            }
            elseif ( is_array($term_value) ) {
                imo_tax_import_terms($term_value, $taxonomy, (int) $new_term['term_id']);
            }
        }

        return True;
    }

}
function imo_tax_view_existing_terms($tax_name) {
    print $tax_name;
    $terms  =  get_terms($tax_name, array("taxonomy" => $tax_name, "fields"=>"names", "hide_empty"=>0));
    return $terms;
}

function imo_tax_delete_terms($tax_name) {
    $terms = get_terms($tax_name, array("taxonomy"=> $tax_name, "fields"=>"ids", "hide_empty"=>0));

    foreach ($terms as $id) {
        wp_delete_term( $id, $tax_name);   
    }
}
function imo_tax_simulate_values($terms, $taxonomy, $parent_id=NULL, $string='') {
    if ($parent_id==NULL) {
        $string .= "<ul class='imo-preview'>";
    }
    foreach ($terms as $term_key=>$term_value) {
        $term_name = (is_array($term_value))? $term_key : $term_value;
        $slug = preg_replace( '/[^a-z0-9_-]+/', '-', strtolower( $taxonomy . "-" . $term_name ) );
        $string .= "<li><strong>name: </strong>$term_name<br /><strong>slug: </strong>$slug<br />"; 
        if ($parent_id !== NULL) {
            $string .= "<strong>parent:</strong> $parent_id";
        }
        else {
            $string .= "<strong>children</strong>";
        }
        if ( is_array($term_value)  ) {
            $child_string = imo_tax_simulate_values($term_value, $taxonomy, $term_name, ""); 
            $string .= "<ul class='child-taxonomy'>$child_string</ul>";
        }
        $string .="</li>";

    }
    if ($parent_id==NULL) {
        $string .= "</ul>";
    }
    return $string;
}

/**
 * Admin menu add_action callback.
 */
function imo_tax_menu() {
    add_options_page('IMO Term Importer', 'IMO Term Import', "administrator", "imo-tax", "imo_tax_options");
}


/**
 * Options Page Callback
 */
function imo_tax_options() {
    $taxonomy_list = array(
        "activity"=> array(
            "Hunting" => array(
                "Rifle Hunting",
                "Shotgun Hunting",
                "Handgun Hunting",
                "Muzzleloader Hunting",
                "Bowhunting",
                "Crossbow Hunting",
                "Dog Training",
                "Scouting",
                "Management",
            ),
            "Shooting" => array(
                "Personal Defense",
                "Competitive",
                "Tactical",
                "Reloading",
                "Gunsmithing",
            ),
            "Fishing" => array(
                "Casting",
                "Trolling",
                "Rigging",
                "Still Fishing",
                "Fly Fishing",
                "Ice Fishing",
            ),
        ),
        "gear" => array(
            "Ammo",
            "Bows",
            "Firearms" => array("Handguns", "Shotguns", "Rifles", "Muzzleloaders"),
            "Clothing & Apparel",
            "Optics",
            "Accessories",
            "ATVs",
            "Boats",
            "Autos",
            "Rods",
            "Reels",
            "Motors",
            "Boats",
            "Electronics",
            "Lines",
            "Tackle",
            "Lures",
        ),
        "species" => array(
            "Deer" => array(
                "Coues", "Whitetail", "Blacktail", "Mule Deer", "Sitka",
            ),
            "Big Game" => array(
                "Bear", "Moose", "Caribou", "Sheep & Goats", "Hogs", "Elk", "Musk Ox", "Pronghorn", "Bison",
            ),
            "Birds" => array(
                "Waterfowl", "Upland", "Turkey",
            ),
            "Small Game & Predators" => array(
                "Cats", "Varmints", "Squirrels & Rabbits", "Wolves",
            ),
            "African Game" => array(
                "Plains Game", "Dangerous Game",
            ),
            "Exotic" => array(
                "North American", "International",
            ),
            "Fish" => array(
                "Saltwater" => array(
                    "Snook", "Tarpon", "Sea Trout", 
                    "Redfish", "Grouper", "Flounder",
                    "Dolphin", "Wahoo", "King Mackerel", 
                    "Cobio", "Sailfish", "Red Snapper",
                ),
                "Freshwater" => array(
                    "Largemouth Bass", "Smallmouth Bass", "Walleye",
                    "Panfish", "Catfish", "Pike", 
                    "Muskie", "Trout", "Salmon",
                    "Burbot", "Carp", "Drum", 
                    "Gar", "Herring, Shad & Smelt", "Sauger",
                    "Sucker", "Temperate Bass", "Whitefish",
                ),
            ),
        ),
        "location" => array(
            "North America" => array(
                "West" => array(
                    "Washington", "Oregon", "California", "Idaho", "Nevada", "Montana",
                    "Wyoming", "Utah", "Colorado",
                ),
                "Southwest" => array(
                    "Arizona", "New Mexico", "Texas", "Oklahoma", 
                ),
                "Midwest" => array(
                    "North Dakota", "South Dakota", "Nebraska", "Kansas",
                    "Minnesota", "Iowa", "Missouri", "Wisconsin",
                    "Illinois", "Michigan", "Indiana", "Ohio",
                ),
                "Northeast" => array(
                    "Pennsylvania", "Maryland", "Delaware", "New Jersey",
                    "New York", "Connecticut", "Rhode Island", "Vermont",
                    "Massachusetts", "New Hampshire", "Maine",
                ),
                "Southeast" => array(
                    "Arkansas", "Louisiana", "Mississippi", "Tennessee",
                    "Kentucky", "Alabama", "Florida", "Georgia", "North Carolina",
                    "South Carolina", "Virginia", "West Virginia",
                ),
                "Canada" => array(
                    "British Columbia", "Alberta", "Sakatchewan", "Manitoba", "Ontario",
                    "Quebec", "New Brunswick", "Nova Scotia", "Prince Edward Island",
                    "Yukon", "Northwest Territories", "Nunavut", "Newfoundland and Labrador",
                ),
            ),
            "International" => array(
                "Africa", "Asia", "Australia", "Europe", "South America",
            ),
        ),
    );
    /**
     * ONLY ADMINS SHOULD BE ABLE TO SEE THIS.
     */
    if (!current_user_can('administrator'))  
    {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    $taxonomies = array("activity", "gear", "species", "location");
    $target_taxonomy = strtolower($_POST['taxonomy']);


    if ( empty($_POST['taxonomy']) || empty($_POST["tax_action"]) ) {
        $resp=""; // first time visiting...
    }

    elseif ( $target_taxonomy == "all" ) {
        $resp = "";
        foreach ($taxonomies as $taxon) {
            $resp .= imo_tax_handle_action($_POST['tax_action'], $taxonomy_list[$taxon], $taxon);
        }
    }

    elseif ( in_array($target_taxonomy, $taxonomies) ) {
        $resp = imo_tax_handle_action($_POST['tax_action'], $taxonomy_list[$target_taxonomy], $target_taxonomy);

    }

    else {
        $resp = "<p style='color:#C00;'>Sorry, Wordpress did not recognize your request.</p>";
    }

    include("imo-tax-options-page.tpl.php");
}


/**
 * Helper function
 * @see imo_tax_options()
 *
 * @params
 * $action - string 
 *    Current actions: 
 *    preview -> prints a preview of the terms.
 *    import -> imports the new item.
 *
 * $tax_array - array - contains the list of terms. 
 * $tax_name - string - the name of the taxonomy into which the terms are going.
 *
 * returns nothing; purely procedural
 */
function imo_tax_handle_action( $action, $tax_array, $tax_name ) {

    switch ($action) {
    case "import":
        imo_tax_import_terms($tax_array, $tax_name, NULL);
        // if you don't delete this cache, then you will only see the parents, major bummer. 
        delete_option($tax_name."_children");
        return "<p>Imported terms into the <a href='".admin_url( "edit-tags.php?taxonomy=$tax_name", "http"). "' target='_blank'>" . ucfirst( $tax_name ) . " taxonomy</a></p>"; 
        break; 

    case "delete":
        imo_tax_delete_terms($tax_name);
        return "<p>Deleted all terms in the <a href='".admin_url( "edit-tags.php?taxonomy=$tax_name", "http"). "' target='_blank'>" . ucfirst( $tax_name ) . " taxonomy</a></p>"; 
        break;

    case "view_existing":
        $terms_array = imo_tax_view_existing_terms($tax_name);
        return "<pre>" . print_r($terms_array, TRUE) . "</pre>";
        break;

    case "preview":
        $response = "<h3 style='margin-bottom:5px;'>$tax_name</h3>";
        $response .= "<h4 style='margin-bottom:5px;'>Raw</h4>";
        $response .= "<pre style='border:1px dashed #DDD;background: #fff; padding: 5px 8px;'>";
        $response .= print_r($tax_array, TRUE);
        $response .= "</pre>";
        $response .= "<style>.imo-preview { } ol.imo-preview {} ul.imo-preview { margin:0 0 0 1em; list-style: disc; color: #000; } ol.imo-preview li, ul.imo-preview li{ } ol.imo-preview li > ol, ul.imo-preview li > ul { color: #777; list-style: square;margin-left:2em; } ol.imo-preview li > ol > li, ul.imo-preview li > ul > li{}</style>";
        $response .= "<h4 style='margin-bottom:5px;'>Processed</h4>";
        $response .= imo_tax_simulate_values($tax_array, $tax_name, NULL, "");
        return $response;
        break;
    }
    return "<p style='color:#C00;'>Sorry, Wordpress did not recognize your request.</p>";
}

add_action("admin_menu", "imo_tax_menu");
