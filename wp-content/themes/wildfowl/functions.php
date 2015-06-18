<?php

define("JETPACK_SITE", "wildfowlmag");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=014HT&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=014HT&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0SFQ0NDY5OCZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 65% off<br/> the Cover Price");

define("FACEBOOK_LINK", "https://www.facebook.com/WildfowlMag");
define("TWITTER_LINK", "https://www.twitter.com/@wildfowlmag");
define("RSS_LINK", "http://www.wildfowlmag.com/feed/");
define("SITE_LINK", "wildfowlmag.com");
define("SITE_NAME", "Wildfowl Magazine");

function social_networks(){
	echo '<div class="socials">';
		echo '<a href="'.FACEBOOK_LINK.'" class="facebook">Facebook</a>';
	    echo '<a href="'.TWITTER_LINK.'" class="twitter">Twitter</a>';
	    echo '<a href="'.RSS_LINK.'" class="rss">RSS</a>';
	echo '</div>';
}

function social_footer(){ ?>
	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated!</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
<?php }

add_action('init', 'cptui_register_my_cpt_reader_photos');
function cptui_register_my_cpt_reader_photos() {
	register_post_type(
		'reader_photos', array(
			'label' => 'Reader Photos',
			'description' => 'Upload a photo',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'reader_post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array('slug' => 'photos'),
			'query_var' => true,
			'has_archive' => true,
			'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes'),
			'taxonomies' => array('category'),
			'labels' => array (
			  'name' => 'Reader Photos',
			  'singular_name' => 'Reader Photo',
			  'menu_name' => 'Reader Photos',
			  'add_new' => 'Add Reader Photo',
			  'add_new_item' => 'Add New Reader Photo',
			  'edit' => 'Edit',
			  'edit_item' => 'Edit Reader Photo',
			  'new_item' => 'New Reader Photo',
			  'view' => 'View Reader Photo',
			  'view_item' => 'View Reader Photo',
			  'search_items' => 'Search Reader Photos',
			  'not_found' => 'No Reader Photos Found',
			  'not_found_in_trash' => 'No Reader Photos Found in Trash',
			  'parent' => 'Parent Reader Photo',
			)
		)
	);


}
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_photos',
		'title' => 'Photos',
		'fields' => array (
			array (
				'key' => 'field_55805a9ca937f',
				'label' => 'Photos Menu',
				'name' => 'photos_menu',
				'type' => 'taxonomy',
				'taxonomy' => 'category',
				'field_type' => 'checkbox',
				'allow_null' => 0,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
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





