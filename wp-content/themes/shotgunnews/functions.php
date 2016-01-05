<?php
define("DARTADGEN_SITE", "imo.shotgunnews");
define("JETPACK_SITE", "shotgunnews");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=27701&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=27701&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=Mjc3MDE0NDc4NSZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 80% off<br/> the Cover Price");

define("FACEBOOK_LINK", "https://www.facebook.com/FireArmsNews/");
define("RSS_LINK", "http://www.firearmsnews.com/feed/");

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
	$offset = $_POST[ 'offset' ];
	
	if($filterID == ""){
		$args = array( 
			'post_type' => 'post',
			'post_status' => 'publish',
			'category_name' => $tradingPostName,
			'offset' => $offset,
			'posts_per_page' => 10
		); 

	}else{
		$args = array( 
			'post_type' => 'post',
			'post_status' => 'publish',
			'category__and' => array( $tradingPostID, $filterID ),
			'offset' => $offset,
			'posts_per_page' => 10
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
	
		
		<div id="post-<?php the_ID(); ?>" <?php post_class('post article-brief clearfix'); ?>  data-slug="<?php echo $slug; ?>">
			<h3 class="entry-title">
				<?php the_title(); ?>
			</h3>
			<em class="meta-date-author"><?php the_time('F jS, Y'); ?></em>
			<div class="article-content">
				<div class="thumb-area">
			    	<?php the_post_thumbnail('list-thumb'); ?>
			    	<?php $url = get_the_permalink(); ?>
			    	<div class="fb-like" data-href="<?php echo $url; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
	    	<a data-url="<?php echo $url; ?>" href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			<span class="googleplus">
				<script src="https://apis.google.com/js/platform.js" async defer></script>
				<div class="g-plusone" data-size="medium" data-href="<?php echo $url; ?>"></div>
			</span>
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
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_trading-post',
		'title' => 'Trading Post',
		'fields' => array (
			array (
				'key' => 'field_54075c93e9977',
				'label' => 'Category Filter',
				'name' => 'category_filter',
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
}
