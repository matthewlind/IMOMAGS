<?php

// Add scripts only if $is_single_default = true. Scripts to be loaded only on single post pages
//--------------------------------------------//
add_action('init', 'register_single_script');
add_action('wp_footer', 'print_single_script');

function register_single_script() {
	wp_register_script( 'single-default-script', get_bloginfo( 'template_directory' ) . '/js/redesign/single.js', array( 'jquery' ), '1.0', true );
	wp_register_script( 'single-disqus', "//gundogmag.disqus.com/count.js", array( 'jquery' ), '1.0', true );
	
	wp_localize_script( 'single-default-script', 'ajax_object',
        array( 
        	'ajax_url' 	=> admin_url( 'admin-ajax.php' )
        ) 
	);
}


function print_single_script() {
	global $is_single_default;

	if ( ! $is_single_default )
		return;

	wp_print_scripts('single-default-script');
	//wp_print_scripts('single-disqus');
}


// Related story shortcode
//--------------------------------------------//
// example: [rstory id="10062" video="yes" desc="lorem ipsum" image="http://www.gameandfishmag.com/files/2015/07/Trigger.jpg"]
function rstory_func( $atts ) {
    $a = shortcode_atts( array(
        'video' => 'no', 	// if yes, display 'play' icon
        'id'	=> '125',	// post id
        'desc'	=> '', 		// Custom description, excerp
        'image' => ''		// Custom image url
    ), $atts );
    
    $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id($a['id']) , 'medium' );
    $post_title = get_the_title($a['id']);
    $post_excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $a['id']));
    
    ob_start(); ?>
    <div class="article-elem">
		<div class="ae-header">
			<div></div>
			<h4><span>Related</span></h4>
		</div>
		<div class="ae-content clearfix">
			<a class="ae-img" href="#">
				<div style="background-image: url(<?php if ($a['image'] == '') { echo $feat_image[0];} else {echo $a['image'];} ?>)">
					<?php if ($a['video'] == 'yes') { ?><div class="ae-play"><div class="ae-triangle"></div></div><?php }?>
				</div>
			</a>
			<a class="ae-title" href="#">
				<?php echo '<span>' .  $post_title . '</span>';?>
				<?php if ($a['desc'] == '') {echo  '<p>'. $post_excerpt . '</p>';} else { echo  '<p>'. $a['desc'] . '</p>';}?>
			</a>
		</div>
	</div>
<?php    return ob_get_clean();
}
add_shortcode( 'rstory', 'rstory_func' );


// Load More Posts
//--------------------------------------------//	
if ( is_admin()) {  
    add_action( 'wp_ajax_ms_load_more', 'ms_load_more' );
    add_action( 'wp_ajax_nopriv_ms_load_more', 'ms_load_more' );
} else {
    // Add non-Ajax front-end action hooks here
}

function ms_load_more() {

	global $wpdb; 
    ob_clean(); 
   
    $dartDomain     	= get_option("dart_domain", $default = false);
    $cat_id				= $_POST['cat_id'];
    $post_count			= $_POST['post_count'];
    $post_per_page		= $_POST['post_per_page'];
    $ad_after_post		= $_POST['ad_after_post'];
    $post_not			= $_POST['post_not'];
    $post_type			= $_POST['post_type'];
    $current_post_id	= $_POST['current_post_id'];
    $post_not_array 	= explode(',', $post_not);
	$p_counter			= 0;
	
	$term = get_the_title($current_post_id);
	$campaign = wp_get_post_terms($current_post_id,"campaign");
	foreach($campaign as $c){
		$camp = $c->name;
	}

	$args = array (
		'cat'         		=> $cat_id,
		'post_type'			=> $post_type,
		'posts_per_page'	=> $post_per_page,
		'order'				=> 'DESC',
		'post_status'		=> 'publish',
		'post__not_in'		=> $post_not_array,
		'offset'			=> $post_count
	);
	// The Query
	$query = new WP_Query( $args );
	// The Loop
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();			
			$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) ,"list-thumb" );?>
			
			<a class="ms-box" href="<?php the_permalink(); ?>">
				<div class="ms-image" style="background-image: url(<?php echo $feat_image[0]; ?>)"></div>
				<div class="ms-desc"><?php the_title( '<h1>', '</h1>'); ?></div>
			</a>
<?php		if ($p_counter == $ad_after_post) {
				echo '<div class="ms-ad ad-wrap"><span class="ad-span">Advertisement</span><div class="ad-inner"><iframe class="new-iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term='.$term.'&camp='.$camp.'&ad_code='.$dartDomain.'&ad_unit=mediumRectangle&page=single"></div></div>';
			}
			$p_counter++;
		}
	} else { ?>
		<script>
			jQuery('#btn_more_stories > span').text('No more posts').css("color", "#eeeeee"); 
			jQuery('#btn_more_stories').removeAttr("id");
		</script>
<?php }
	wp_reset_postdata();
   
	wp_die();
}

