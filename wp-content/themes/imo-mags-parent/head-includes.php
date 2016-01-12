<?php

/**
 *head-includes.php makes special things special.
 */
 
if( is_preview() ){
	echo '<script type="text/javascript">var _gaq = _gaq || [];</script>';
}

$dartDomain = get_option("dart_domain", $default = false);

$id = get_the_ID();
if(is_single()){
$campaign = wp_get_post_terms($id,"campaign");
	foreach($campaign as $c){
		$camp = $c->name;
	}
}
if(is_home()){
	$term = "home";
	$pageName = "home";
}
else if (is_category()) {
	$cat = get_query_var('cat');
	$yourcat = get_category ($cat);
	$term = $yourcat->slug;
	$pageName = $yourcat->slug;
 
}
else if (is_single()) {
    global $the_ID;

    $post = get_queried_object();

    $categories = get_the_category($the_ID);

    $count = 0;
    foreach ($categories as $cat) {
    	$count++;
        $term .= $cat->name;
        if ($count != count($categories))
        	$term .= ",";
    }

	$pageName = get_the_title();

    if ($post->post_type == "imo_caption_contest") {
        if ($term != "")
        	$term .= ",";
        $term .= "caption_contest";
        $pageName = "caption_contest";

    }

    if ($post->post_type == "imo_video") {
        if ($term != "")
        	$term .= ",";
        $term .= "video";
        $pageName = "video";

    }

    /*if ($post->post_type == "reviews"){
    	$terms = wp_get_post_terms( $post->ID, "guntype");

    	$count = 0;
    	foreach ($terms as $term) {
        	$count++;
	        $term .= $term->name;
	        if ($count != count($terms))
	        	$term .= ",";
        }

        if ($term != "")
        	$term .= ",";
        $term .= "post_type_review";

    }*/

    if (get_option("dart_domain") == "imo.floridasportsman") {

      $term_array = wp_get_post_terms($post->ID, "activity" );
      $term = $term_array[0]->slug;

      if ($term_array[0]->parent == 308 || $term_array[0]->term_id == 308)
        $term = "fishing";
      if ($term_array[0]->parent == 292 || $term_array[0]->term_id == 292)
        $term = "hunting";
      if ($term_array[0]->parent == 635 || $term_array[0]->term_id == 635)
        $term = "boating";
      if ($term_array[0]->parent == 637 || $term_array[0]->term_id == 637)
        $term = "conservation";
      if ($term_array[0]->parent == 636 || $term_array[0]->term_id == 636)
        $term = "cooking";
      if ($term_array[0]->parent == 634 || $term_array[0]->term_id == 634)
        $term = "diving";
      if ($term_array[0]->parent == 705 || $term_array[0]->term_id == 705)
        $term = "paddling";
    }

    $params = array(
       "sect" => $term,
    );

}
else if (is_page()) {
	
    global $post;
    
    $pageName = $post->post_title;
    $term = $post->post_name;
}
else if ( is_tax() || is_tag() || is_category() ) {
    if (is_category()) {
        $tax_title = single_cat_title('', False);
    }
    else {
        $tax_title = single_tag_title("", False);
    }
    $params = array(
        "sect" => $tax_title,
    ); 
}
else {
    $params = array(
        "sect" => "misc",
    );
}
?>

<script type='text/javascript'>
  (function() {
    var useSSL = 'https:' == document.location.protocol;
    var src = (useSSL ? 'https:' : 'http:') +
        '//www.googletagservices.com/tag/js/gpt.js';
    document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
  })();
</script>

<script type='text/javascript'>
googletag.cmd.push(function() {

var w = window.innerWidth;
var h = window.innerHeight;

    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [240, 60], 'sponsor').addService(googletag.pubads());
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [2, 2], 'native').addService(googletag.pubads());
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [564, 252], 'e_commerce_widget').addService(googletag.pubads());
	
	<?php if($microsite){ ?>
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 250], 'microsite_ATF_300x250').addService(googletag.pubads().setTargeting('sect', ['micro_atf']));
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 250], 'microsite_BTF_300x250').addService(googletag.pubads().setTargeting('sect', ['micro_btf']));
	<?php } ?>
	
	<?php if(is_page( 'border-to-border' ) || is_page( 'epic-moments' )){ ?>
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 250], 'microsite_ATF_300x250').addService(googletag.pubads().setTargeting('sect', ['micro_atf']));
	<?php } ?>
	
if (w>=1100)
{
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [3, 3], 'superheader').addService(googletag.pubads());
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [[970, 250], [728, 90]], 'billboard').addService(googletag.pubads());
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [[300, 600], [300, 250]], '300_atf').addService(googletag.pubads());
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [728, 90], '728_btf').addService(googletag.pubads());
}
if (w>=600 && w<=1099)
{
    //googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [1, 1], 'tablet2').addService(googletag.pubads());
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [728, 90], 'leaderboard').addService(googletag.pubads());
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 250], '300_atf').addService(googletag.pubads());
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [728, 90], '728_btf').addService(googletag.pubads());
}
if (w<=599)
{
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [320, 100], [320, 50], '320_atf').addService(googletag.pubads());
    //googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [1, 1], 'mobile3').addService(googletag.pubads());
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 250], '300_mobile').addService(googletag.pubads());
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [320, 100], [320, 50], '320_btf').addService(googletag.pubads());
}

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setTargeting('sect', ['<?php echo $term; ?>']);
    googletag.pubads().collapseEmptyDivs(); 
    googletag.pubads().enableSyncRendering();
    googletag.enableServices();
  });

</script>

<?php 
//sidebar

function imo_sidebar($type){

   	//Speed up mobile load time by not loading sidebar in the background
	if(!mobile()){
		$dartDomain = get_option("dart_domain", $default = false); ?>
		<div class="sidebar-area">
			<div class="sidebar">
				<div class="widget_advert-widget">
					<?php imo_ad_placement("300_atf"); ?>		
				</div>
			</div>
		    <?php get_sidebar($type);

	    	echo '<div id="responderfollow"></div>';
			echo '<div class="sidebar advert">';
				echo '<div class="widget_advert-widget">';
					echo '<iframe id="sticky-iframe-ad" width="310" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-sticky.php?ad_code='.$dartDomain.'"></iframe>';
				echo '</div>';
				get_sidebar("sticky");
			echo '</div>';
		echo '</div>';
	}
}

//ad placement
function imo_ad_placement($size){ ?>
	<div id='<?php echo $size; ?>'>
		<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('<?php echo $size; ?>'); });
		</script>
	</div>

<?php } ?>