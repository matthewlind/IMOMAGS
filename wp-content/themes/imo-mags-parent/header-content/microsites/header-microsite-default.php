<?php		
	$cat 			= get_query_var('cat');
	$this_cat 		= get_category($cat);
	$this_cat_slag 	= $this_cat->slug;
	$this_cat_name	= $this_cat->name;
	$this_cat_id	= $this_cat->term_id;
	$term_cat_id 	= 'category_'.$this_cat_id;
	
	
	
	
	$hide_all_buy_mag_options = get_field('hide_all_buy_mag_options', $term_cat_id);	
	$message_unavailable = get_field('message_unavailable', $term_cat_id);	
	$end_date_newsstand = get_field('end_date_newsstands', $term_cat_id);
	$mag_online_store = get_field('mag_online_store', $term_cat_id);
	$digital_edition_available = get_field('digital_edition_available', $term_cat_id);
	$online_store_url = get_field('online_store_url', $term_cat_id);
	
	
	$logo 			= get_field('logo', $term_cat_id);
	$logo			= "<a href='/$this_cat_slag' title='$this_cat_name'><img src='" . $logo['url'] . "' alt='" . $logo['alt'] . "'></a>";
/*
	$rows = get_field('mag_info', $term_cat_id ); // get all the rows
	$first_row = $rows[0]; // get the first row
	$first_row_image = $first_row['mag_cover_image' ]; // get the sub field value
	$mag_cover_image = wp_get_attachment_image_src( $first_row_image, 'full' );
*/
	
	$today = date("Ymd"); 			
?>
<div class="top-panel">
	<a href="<?php echo site_url(); ?>" class="icon-arrow-left">Back to <?php echo $blog_title; ?></a>
</div>
			
<header class="main-header">
	<div class="header-inner">
		<div class="head-left">
			<div class="menu-wrap">
				<i class="icon-chevron-thin-left"></i><span class="menu-head-span">SECTIONS</span>
			</div>
			<div class="main-logo">
				<?php echo $logo; ?>
			</div>
			<div class="search"><i class="icon-search"></i></div>
		</div>
		<div class="head-right">
			<div class="head-social">
				<ul>
					<li></li>
				</ul>
			</div>
			<div class="head-subscribe">
				<span>SUBSCRIBE</span><i class="icon-caret"></i>
			</div>
			<div class="head-mag-cover">
				<a href="">
					<img src="" alt="">
				</a> 
			</div>
		</div>
	</div>
</header>