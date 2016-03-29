<?php		
	$this_cat 		= get_category_by_slug($cat_slug);
	$this_cat_slag 	= $this_cat->slug;
	$this_cat_name	= $this_cat->name;
	$this_cat_id	= $this_cat->term_id;
	$term_cat_id 	= 'category_'.$this_cat_id;
	
	$hide_all_buy_mag_options 	= get_field('hide_all_buy_mag_options', $term_cat_id);	
	$message_unavailable 		= get_field('message_unavailable', $term_cat_id);	
	$end_date_newsstand 		= get_field('end_date_newsstands', $term_cat_id);
	$mag_online_store 			= get_field('mag_online_store', $term_cat_id);
	$digital_edition_available 	= get_field('digital_edition_available', $term_cat_id);
	$online_store_url 			= get_field('online_store_url', $term_cat_id);
	$mag_cover_image 			= array();
	
	if (have_rows('mag_info', $term_cat_id)) { 
		while ( have_rows('mag_info', $term_cat_id) ) { the_row();
			$mag_cover_image = get_sub_field('mag_cover_image');
		}
	}	
	
	$logo 			= get_field('logo', $term_cat_id);
	$logo			= "<a href='/$this_cat_slag' title='$this_cat_name'><img src='" . $logo['url'] . "' alt='" . $logo['alt'] . "'></a>";
		
	$today = date("Ymd");
	
	// HEADER SOCIAL BUTTONS
	if( have_rows('site_share_buttons', $term_cat_id) ) { 						
		while ( have_rows('site_share_buttons', $term_cat_id) ) { the_row();
			$face_twit_title	= get_sub_field('face_twit_title');
			$email_subject 		= get_sub_field('email_subject');
			$email_message 		= get_sub_field('email_message');
			$youtube			= (is_category('shoot101') || in_category('shoot101')) ? "<li><a href='https://www.youtube.com/channel/UCiUI8tBSAW88CEAr7oknkoA?utm_source=navbarlink&utm_medium=website&utm_campaign=shoot101&utm_content=youtubechannel' class='icon-youtube' target='_blank'></a></li>" : "";
			$url_for_social		= site_url() . '/'. $cat_slug;
			$social_buttons		= <<<END
			<ul>
				$youtube
				<li><a href="http://www.facebook.com/sharer/sharer.php?u=$url_for_social&title=$face_twit_title" class="icon-facebook" target="_blank"></a></li>
				<li><a href="http://twitter.com/intent/tweet?status=$face_twit_title+$url_for_social" class="icon-twitter" target="_blank"></a></li>
				<li><a href="mailto:?subject=$email_subject&body=$email_message $url_for_social" class="icon-mail" target="_blank"></a></li>
			</ul>			
END;
		}
	} 			
?>
<div class="microsite-container">

<div class="top-panel">
	<a href="<?php echo site_url(); ?>" class="icon-arrow-left">Back to <?php echo $blog_title; ?></a>
</div>
			
<header class="main-header">
	<div id="header_wrap" class="header-wrap">
		<nav id="menu_drop" class="menu-drop">
			<section class="menu-content">
				<?php wp_nav_menu( array( 'theme_location' => $theme_location, 'container' => '0' ) ); ?>
			</section>
			<section class="menu-footer"></section>
			<section id="m_drop" class="menu-close"><i class="icon-cross"></i><span>&nbsp;CLOSE</span></section>
		</nav>
		<div class="head-inner">
			<div class="head-left">
				<div class="main-logo">
					<?php echo $logo; ?>
				</div>
				<div id="h_drop" class="nav-btn">
					<div id="nav-icon3"><span></span> <span></span> <span></span> <span></span></div>
					<span class="menu-head-span">MENU</span>
				</div>
			</div>
			<div class="head-right">
				<div class="head-mag-cover">
					<a href="<?php echo $online_store_url; ?>" target="_blank">
						<img src="<?php echo $mag_cover_image['url']; ?>" alt="">
					</a> 
				</div>
				<div class="head-subscribe" id="head-subscribe">
					<span>&nbsp;BUY MAGAZINE</span><i class="icon-triangle-down"></i>
					<?php include(get_template_directory() . "/content/microsite-template-parts/buy-mag-dropdown.php"); ?>
				</div>
				<div class="head-social"><?php echo $social_buttons; ?></div>
			</div>
		</div><!-- .header-inner -->	
		<?php if( in_array( 'sponsors_disclaimer', get_field('additional_elements', $term_cat_id) ) ) { 
				$sponsors_disclaimer 	= get_field('sponsors_disclaimer', $term_cat_id);
		?>
			<div class="sponsors-disclaimer">
				<span><?php echo $sponsors_disclaimer;?></span>
			</div>
		<?php } ?>
	</div><!-- .header-wrap -->
	
	<div class="head-bottom">
		<div class="head-social"><?php echo $social_buttons; ?></div>
		<div class="head-subscribe">
			<span id="head-bottom-subscribe">&nbsp;BUY MAGAZINE</span><i class="icon-triangle-down"></i>
			<?php include(get_template_directory() . "/content/microsite-template-parts/buy-mag-dropdown.php"); ?>
		</div>
		<div class="head-mag-cover">
			<a href="">
				<img src="" alt="">
			</a> 
		</div>
	</div>
</header>

