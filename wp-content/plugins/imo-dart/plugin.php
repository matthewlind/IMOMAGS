<?php
/*
 * Plugin Name: IMO Dart Tags
 * Plugin URI: http://github.com/imoutdoors
 * Description: Basic doubleclick library for generating tags. 
 * Version: 0.1
 * Author: jacob angel 
 * Author URI: http://imomags.com
 */
include_once("AdvertWidget.php");


/**
 * returns a string containing the formatted dart tag.
 */
function get_imo_dart_tag($size, $tile=1, $iframe=False, $override_params=array()) {

    $params = array_merge(_imo_dart_get_params($size, $tile), $override_params);

    if (!empty($params['camp'])) {
        
        $params['campaign-key-value-pair'] = "camp=" . imo_dart_clean_tag($params['camp']) . ";";
        $params['campaign'] = imo_dart_clean_tag($params['camp']);
    }

    $tag = _imo_dart_get_tag($iframe);
    return _imo_dart_sprint_tag($params, $tag); 
}



/**
 * format the correct parameters based on the size and tile wanted.
 */
function _imo_dart_get_params($size, $tile) {

    //Check for add campaigns and grab the slug for later.

    $adCampaignSlug = null;
    if (function_exists("get_terms")) {
        $post = get_queried_object();

        $postID = $post->ID;

        if ($adCampaignTerms = wp_get_object_terms($postID,"campaign")) {

            if (!is_object($adCampaignTerms)) {

                $adCampaignTerm = $adCampaignTerms[0];
                $adCampaignSlug = $adCampaignTerm->slug;

            }
        }
    }

    // only allow proper sizes to be used; the names are only included
    // for referecee
    $sizes = array(
        "box-ad" => "300x250", "skyscraper" => "160x600", "leaderboard" => "728x90",
        "rectangle" => "180x150", "wide-skyscraper" => "300x600", "button2" => "120x60",
    );
    if ( !in_array($size, $sizes)) {
        $size = "300x250";
    }

    // grab the correct parameters
    $defaults = array(
        "domain" => get_option("dart_domain", _imo_dart_guess_domain()),
        "width"=> array_shift(explode("x", $size)),
        "height"=> array_pop(explode("x", $size)),
        "size" => $size,
        "tile" => $tile,
        "refresh" => 45,
    );


    if (is_admin()) {
        $params = array(
            "zone" => "admin",
            "sect" => "admin",
            "subs" => "",
            "page" => "admin",
        );  }
    elseif (is_front_page()) {
        $params = array(
            "zone" => "home",
            "sect" => "home",
            "subs" => "",
            "page" => "index",
        );
    }
    elseif (is_single()) {
        global $the_ID;
        $cat = array_shift(get_the_category($the_ID));
        $params = array(
            "zone" => $cat->name,
            "sect" => $cat->name,
            "subs" => "",
            "page" => the_title("","", false),
        );

    }
    elseif (is_page()) {
        global $post;
        $page = get_page($post->ID);
        $zone = (isset($page->cat_name)) ? $page->cat_name : $page->post_name;
        $params = array(
            "zone" => $zone,
            "sect" => $zone,
            "subs" => "",
            "page" => $page->post_title,
        ); }
    elseif ( is_tax() || is_tag() || is_category() ) {
        if (is_category()) {
            $tax_title = single_cat_title('', False);
        }
        else {
            $tax_title = single_tag_title("", False);
        }
        $params = array(
            "zone" => $tax_title,
            "sect" => $tax_title,
            "subs" => "",
            "page" => $tax_title . " Archive", 
        ); }
        else {
            $params = array(
                "zone" => "misc",
                "sect" => "misc",
                "subs" => "",
                "page" => "index",
            );  
        }

            //If there is an ad campaign, add a key/value pair


    

    $mergedParams = array_merge(array_map("imo_dart_clean_tag", $params), $defaults);


    if (!empty($adCampaignSlug)) {
        $mergedParams['campaign-key-value-pair'] = "camp=" . imo_dart_clean_tag($adCampaignSlug) . ";";
        $mergedParams['campaign'] = $adCampaignSlug;

    }


        return $mergedParams;
} 


/**
 * Return the correct tag structure.
 */
function _imo_dart_get_tag($iframe) {
    if ($iframe) 
    {
        $tag = '<iframe src="/iframe-advert.php?size=%1$s&zone=%3$s&sect=%4$s&page=%6$s&rr=%10$s&subs=%5$s&camp=%12$s" frameBorder="0" width="%8$s" height="%9$s" scrolling="no" allowTransparency="true">';
        $tag .= _imo_dart_get_tag(false);
        $tag .="</iframe>";
    }
    else
    {
        $tag = '<!-- %1$s Ad: -->
            <script type="text/javascript">
document.write(unescape(\'%%3Cscript src="http://ad.doubleclick.net/adj/%2$s/%3$s;%11$ssect=%4$s;page=%6$s;subs=%5$s;sz=%1$s;dcopt=;tile=%7$s;ord=\'+dartadsgen_rand+\'?"%%3E%%3C/script%%3E\'));
    </script>
    <noscript>
        <a href="http://ad.doubleclick.net/adj/%2$s/%3$s;%11$ssect=%4$s;page=%6$s;subs=%5$s;sz=%1$s;dcopt=;tile=%7$s;ord=6545512368?">
            <img src="http://ad.doubleclick.net/ad/%2$s/%3$s;%11$ssect=%4$s;page=%6$s;subs=%5$s;sz=%1$s;dcopt=;tile=%7$s;ord=6545512368?" border="0" />
        </a>
    </noscript>
<!-- END %1$s Ad: -->';
    }
    return $tag;
}


function _imo_dart_sprint_tag($params, $tag) {
    return sprintf($tag, $params['size'], $params['domain'], $params['zone'], $params['sect'], $params['subs'],$params['page'], $params['tile'], $params['width'], $params['height'], $params['refresh'],$params['campaign-key-value-pair'],$params['campaign']);
}
/**
 * Attempt to formulate a domain based on the currentiste domain.
 */
function _imo_dart_guess_domain() {
    if ($domain = get_option("dart_domain", false)) {
        return $domain;
    }
    elseif ($site = get_site_url()) {
        $domain = explode(".", substr($site, 7));
        $domain = "imo." . $domain[1];        
        if (substr($domain, -3)=="mag") {
            $domain = substr($domain, 0, -3);
        }
        return $domain;
    }
    else {
        return "imo.outdoorsbest";
    }
}

/**
 * prints the dart tag to the page.
 *
 * $size - size of the placement
 * $iframe - boolean - set to true or false depending on whether to generate an iframetag or normal tag.
 * $override_params: will be merged into params at the end, so that we can pass params to the iframe
 *
 */
function imo_dart_tag($size, $iframe=False, $override_params=array()) {
    static $tile = 0; 
    $tile++;
    print get_imo_dart_tag($size, $tile, $iframe, $override_params);
}

/**
 * Testing
 */
function imo_dart_run_tests() {
    $params = array(
        "domain" => get_option("dart_domain", _imo_dart_guess_domain()),
        "size" => "300x250",
        "tile" => 1,
        'height'=>250,
        'width' => 300,
        "zone" => "misc",
        "sect" => "misc",
        "subs" => "",
        "page" => "index",);
    echo _imo_dart_sprint_tag($params, _imo_dart_get_tag(False) );
    echo _imo_dart_sprint_tag($params, _imo_dart_get_tag(True) );
}

if (__FILE__ == $_SERVER['PWD'] . '/'. $_SERVER['SCRIPT_FILENAME']) { 
    if (! function_exists("get_option")) {
        function get_option($a, $b) {
            return $b;
        }
    }
    imo_dart_run_tests(); 
}


function iframe_maker () {
    if (preg_match("/^\/iframe-advert\.php(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) 
    {
        $refresh_rate = ( intval($_GET['rr']) < 45 || empty($_GET['rr']) ) ? 45 : intval($_GET['rr']);
         $sizes = array(
            "box-ad" => "300x250", "skyscraper" => "160x600", "leaderboard" => "728x90",
            "rectangle" => "180x150", "wide-skyscraper" => "300x600", "button2" => "120x60",
        );
        $size=$_GET['size'];
        $string_list = array("size", "zone", "sect", "subs", "page","camp");
        $params = array();
        foreach ($string_list as $parameter) {
            if(isset($_GET[$parameter])) {
                $params[$parameter] = imo_dart_clean_tag($_GET[$parameter]);
            }
        }
        if ( !in_array($size, $sizes)) {
            $size = "300x250";
        }
?>
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="refresh" content="<?php print $refresh_rate; ?>">
    </head>
    <body style="margin:0px;border:0px;">
        <script type="text/javascript">
        var dartadsgen_rand = Math.floor((Math.random()) * 100000000), pr_tile = 1; 
        </script>
<?php imo_dart_tag($size, False, $params); ?>
    </body>
    </html>
<?php
        die();
    }
}


/* The only valid characters are alphanumeric characters, numbers and underscores. */
function imo_dart_clean_tag($string) {
    return preg_replace("/\s+/", '_', preg_replace("/[^a-z0-9 ]/", '', strtolower($string)));
}

add_action("init", "iframe_maker");


/******************************************************************************************
 * Administration Menus
 * Adds a dart_domain setting to the General Options page in the admin_menu, allowing for 
 * overriding the inferred domain tag.
 ******************************************************************************************/

/* add_settings_field callback */
function imo_dart_domain_settings_option() {
    echo "<input type='text' name='dart_domain' id='imo-dart_dart-domain' value='".get_option("dart_domain", "" )."' />";
}

function imo_dart_settings_section() {
    echo "";
}

/* admin_menu callback. */
function imo_dart_settings_init() {
    add_settings_section("dart_settings", __("Dart Settings"), "imo_dart_settings_section", "general");
    add_settings_field("dart_domain", __("Domain"), "imo_dart_domain_settings_option", "general", "dart_settings");
    register_setting("general", "dart_domain");
}
add_action("admin_menu", "imo_dart_settings_init");

/******************************************************************************************
 * Ad Campaign Taxonomy
 ******************************************************************************************/
add_action("init", "imo_add_campaign_init");


function imo_add_campaign_init() {
    $labels = array();

    $labels['campaign'] = array(
        'name' => _x( 'Ad Campaigns', 'taxonomy general name' ),
        'singular_name' => _x( 'Campaign', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Campaigns' ),
        'all_items' => __( 'All Ad Campaigns' ),
        'parent_item' => __( 'Parent Campaign' ),
        'parent_item_colon' => __( 'Parent Campaign:' ),
        'edit_item' => __( 'Edit Campaign' ), 
        'update_item' => __( 'Update Campaign' ),
        'add_new_item' => __( 'Add New Campaign' ),
        'new_item_name' => __( 'New Ad Campaign Name' ),
        'menu_name' => __( 'Ad Campaigns' ),
    ); 

    $taxonomies = array(
        "campaign" => array(
            "labels" => $labels['campaign'],
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"campaign"),
        )
    );

    $types = array("post","page","imo_video","imo_gallery","imo_blog");

    foreach ($taxonomies as $target_taxonomy => $taxonomy) {
        register_taxonomy(
            $target_taxonomy,
            $types,
            $taxonomy);
    }
}









