<?php
define("JETPACK_SITE", "northamericanwhitetail");

define("FACEBOOK_LINK", "https://www.facebook.com/NAWhitetail");
define("TWITTER_LINK", "https://www.twitter.com/@NAWhitetail");
define("RSS_LINK", "http://www.northamericanwhitetail.com/feed/");
define("SITE_LINK", "northamericanwhitetail.com");
define("SITE_NAME", "North American Whitetail");

include_once('widgets/buck-contest.php');
include_once('widgets/get-app.php');
include_once("wordpress-community.php");

/***
**
** Enqueue Scripts
**
***/




function naw_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script("cross-site-feed", get_template_directory_uri() . "/js/cross-site-feed.js");

}
add_action('wp_enqueue_scripts', 'naw_scripts_method');

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


// NAW Photo pagination
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
