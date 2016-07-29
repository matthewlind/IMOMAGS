<?php

/**
 *head-includes.php makes special things special.
 */

if( is_preview() ){
	echo '<script type="text/javascript">var _gaq = _gaq || [];</script>';
}
global $term, $camp;

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
	$page = "homepage";
}
else if (is_category()) {
	$cat = get_query_var('cat');
	$yourcat = get_category ($cat);
	$term = $yourcat->slug;
	$page = "category";
 
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

	$page = "article";
	
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

    $params = array(
       "sect" => $term,
    );

}
else if (is_page()) {
	
    global $post;
    
    $pageName = $post->post_title;
    $term = $post->post_name;
}

else if (is_author()) {
	$term = "author";
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

$term = str_replace(" &amp; ", "-", $term);
$term = str_replace("'", "", $term);
?>
<script language="javascript" type="text/javascript">
	function resizeIframe(obj) {
		obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
		obj.style.width = obj.contentWindow.document.body.scrollWidth + 'px';
		obj.style.display = "inline-block";
	}
</script>
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
	<?php if(is_single()){ ?>
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/<?php echo $page; ?>', [4, 4], 'teads').addService(googletag.pubads());
	    <?php } ?>
	    
	if (w>=1100){
		googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/<?php echo $page; ?>', [3, 3], 'superheader').addService(googletag.pubads());
	}
	
	if (w>=600){
	    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [648, 110], 'fordWidget').addService(googletag.pubads());
	}
	if (w<=599){
		googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [320, 200], 'fordWidget').addService(googletag.pubads());
	}
	
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/<?php echo $page; ?>', [2, 2], 'nativeAd').addService(googletag.pubads());
	googletag.defineOutOfPageSlot('/4930/<?php echo $dartDomain; ?>/<?php echo $page; ?>','interstitial').addService(googletag.pubads());	 
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [240, 60], 'sponsor').addService(googletag.pubads());
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [2, 2], 'native').addService(googletag.pubads());
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [564, 252], 'e_commerce_widget').addService(googletag.pubads());
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [2, 2], 'standard_native').addService(googletag.pubads());
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [2, 3], 'vide_native').addService(googletag.pubads());
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [2, 4], 'collection_native').addService(googletag.pubads());
	
	<?php if($microsite){ ?>
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 250], 'microsite_ATF_300x250').addService(googletag.pubads().setTargeting('sect', ['micro_atf']));
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 250], 'microsite_BTF_300x250').addService(googletag.pubads().setTargeting('sect', ['micro_btf']));
	<?php } ?>
	
	<?php if(is_page( 'border-to-border' ) || is_page( 'epic-moments' )){ ?>
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 250], 'microsite_ATF_300x250').addService(googletag.pubads().setTargeting('sect', ['micro_atf']));
	<?php } ?>
		
	googletag.pubads().enableSingleRequest();
	googletag.pubads().setTargeting('sect', ['<?php echo $term; ?>']).setTargeting('camp', ['<?php echo $camp; ?>']);
	googletag.pubads().collapseEmptyDivs(); 
	googletag.pubads().enableSyncRendering();
	googletag.enableServices();
	
});

</script>
<?php 
//sidebar

//ad placement
function imo_ad_placement($size){ ?>
	<div id='<?php echo $size; ?>'>
		<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('<?php echo $size; ?>'); });
		</script>
	</div>

<?php } ?>