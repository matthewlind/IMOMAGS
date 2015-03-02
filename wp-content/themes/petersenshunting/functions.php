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
      wp_enqueue_script("cross-site-feed", get_stylesheet_directory_uri() . "/js/cross-site-feed.js");
      wp_enqueue_script("scrollface", get_stylesheet_directory_uri() . "/js/jquery.scrollface.min.js");
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

// PH Rack Room Photo pagination
add_action( 'wp_ajax_nopriv_fishhead-photos-filter', 'prefix_load_fishhead_photos_posts' );
add_action( 'wp_ajax_fishhead-photos-filter', 'prefix_load_fishhead_photos_posts' );
function prefix_load_fishhead_photos_posts () {
	

	$cat_id = $_POST[ 'cat' ];
    $offset = $_POST[ 'offset' ];
    
    if($cat_id){
	    $args = array(
			'post_type' => 'rack_room',
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
			'post_type' => 'rack_room',
			'offset' => $offset,
			'showposts' => 10,
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
	            <?php if(in_category("master-angler")){ ?><span class="badge"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pic/badge-ma.png" alt="Master Angler" /></span><?php } ?>
	        </div>
	    </div>

					
	<?php } 
	wp_reset_postdata();

	$response = ob_get_contents();
	ob_end_clean();
	
	echo $response;
	die(1);
}
