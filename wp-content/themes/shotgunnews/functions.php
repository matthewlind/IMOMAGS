<?php
define("DARTADGEN_SITE", "imo.shotgunnews");
define("JETPACK_SITE", "shotgunnews");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=27701&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=27701&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=Mjc3MDE0NDc4NSZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 80% off<br/> the Cover Price");

define("FACEBOOK_LINK", "https://www.facebook.com/ShotgunNews");
define("RSS_LINK", "http://www.shotgunnews.com/feed/");
define("SITE_LINK", "shotgunnews.com");
define("SITE_NAME", "Shotgun News");

function social_networks(){
	echo '<div class="socials">';
		echo '<a href="'.FACEBOOK_LINK.'" class="facebook">Facebook</a>';
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

add_action( 'wp_ajax_nopriv_cat-filter', 'trading_post_cat_posts' );
add_action( 'wp_ajax_cat-filter', 'trading_post_cat_posts' );
function trading_post_cat_posts () {
    $tradingPostName = $_POST[ 'tradingPost' ];
    $tradingPostID = get_cat_ID( $tradingPostName );
    $filterName = $_POST[ 'cat' ];
	$filterID = get_cat_ID( $filterName );
	
	if($filterID == ""){
		$args = array( 
			'post_type' => 'post',
			'post_status' => 'publish',
			'category_name' => $tradingPostName
		); 

	}else{
		$args = array( 
			'post_type' => 'post',
			'post_status' => 'publish',
			'category__and' => array( $tradingPostID, $filterID )
		); 

	}
		 
  	$posts = get_posts( $args );
	
	
	global $post;
	
	ob_start ();
	
	
	foreach ( $posts as $post ) {
		setup_postdata( $post ); 
		
		$post_id = $post->ID;
		$slug = $post->post_name;
		$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
		$cats = get_the_category( $post_id );
		
		?>
	
		
		<div id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix'); ?>  data-slug="<?php echo $slug; ?>">
			<h3 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark" data-title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h3>
			<div class="article-content">
				<div class="thumb-area">
			    	<a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb'); ?></a>
			    	<?php $url = get_the_permalink();
			    	if(function_exists('wpsocialite_markup')){ wpsocialite_markup(array('url' => $url )); } ?>
				</div>
		        <div class="article-holder">
		    		<div class="entry-content">
		    			<?php the_content( __( 'more <span class="meta-nav">&raquo;</span>', 'twentytwelve' ) ); ?>
		    			<?php //the_excerpt(); ?>
		    		</div><!-- .entry-content -->
		        </div>
			</div>
		</div><!-- #post -->
			
	<?php } 
	wp_reset_postdata();

	$response = ob_get_contents();
	ob_end_clean();
	
	echo $response;
	die(1);
}
