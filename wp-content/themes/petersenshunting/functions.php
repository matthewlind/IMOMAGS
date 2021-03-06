<?php

define("JETPACK_SITE", "phunting");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0144V&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0144V&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0144V&i4Ky=IBZN");
define("SUBS_DEAL_STRING", "Save Over 80% off<br/> the Cover Price");
define("DRUPAL_SITE", TRUE);

define("FACEBOOK_LINK", "https://www.facebook.com/PetersensHuntingMag");
define("TWITTER_LINK", "https://www.twitter.com/@HuntingMag");
define("RSS_LINK", "http://www.petersenshunting.com/feed/");
define("SITE_LINK", "petersenshunting.com");
define("SITE_NAME", "Petersens Hunting");
include_once("wordpress-community.php");

function my_connection_types() {
	// Make sure the Posts 2 Posts plugin is active.
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;

	p2p_register_connection_type( array(
		'name' => 'columnists-to-columnistposts',
		'from' => 'columnists',
		'to' => 'columnistposts'
	) );
}
add_action( 'wp_loaded', 'my_connection_types' );

/***
**
** Enqueue Scripts
**
***/
function my_scripts_method() {
	 if( is_page( 'border-to-border' ) || is_page( 'the-truck' )  ){ 
		 wp_enqueue_style('flexslider-css',get_template_directory_uri().'/plugins/flexslider/flexslider.css');
		 wp_enqueue_script('flexslider-js', get_template_directory_uri().'/plugins/flexslider/jquery.flexslider.js'); 
	}
}    
 
add_action('wp_enqueue_scripts', 'my_scripts_method');

function social_networks(){
	echo '<div class="socials">';
		echo '<a href="'.FACEBOOK_LINK.'" class="facebook">Facebook</a>';
	    echo '<a href="'.TWITTER_LINK.'" class="twitter">Twitter</a>';
	    echo '<a href="'.RSS_LINK.'" class="rss">RSS</a>';
	echo '</div>';
}



function social_footer(){ ?>
	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
<?php }

