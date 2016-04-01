<?php 
  	$postID = get_the_ID();
    $dartDomain = get_option("dart_domain", $default = false);
    $magazine_img = get_option('magazine_cover_uri' );
    if($dartDomain == "imo.gunsandammo" || $dartDomain == "imo.in-fisherman" || $dartDomain == "imo.shotgunnews" || $dartDomain == "imo.shootingtimes"){
	    $subs_link = get_option('subs_link');
    }else{
		$subs_link = get_option('subs_link') . "/?pkey=";
    }
	$iMagID = get_option('iMagID' );
	$deal_copy = get_option('deal_copy' );
	$gift_link = get_option('gift_link' );
	$service_link = get_option('service_link' );
	$subs_form_link = get_option('subs_form_link' );
	$i4ky = get_option('i4ky' );		
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



<div class="hfeed wrapper <?php if(get_field("full_width") == true){ echo ' full-width full-content'; }else if( is_page_template('show-page.php') || is_category("tv") || is_category("show-galleries") || (is_single() && (has_post_format( 'video' ) || in_category("show-galleries")) ) ){ echo ' tv-show full-content'; } ?>" data-role="content" role="main">
	



<header class="main-header">
	<div id="header_wrap" class="header-wrap">
		<nav id="menu_drop">
			<div class="menu-container">
				<div class="menu-inner">
					<section class="menu-content">
<!-- 						<?php if(has_nav_menu( 'top' )){ wp_nav_menu(array('theme_location'=>'top', 'container' => '0')); } ?> -->
						 <?php
                    wp_nav_menu(array(
                        'menu_class'	=> 'menu',
                        'theme_location'=> 'bottom',
                        'container' 	=> '0',
                        'walker'		=> new AddParentClass_Walker()
                    ));   
                    ?>
					</section>
					<section class="menu-footer"></section>
					<section id="m_drop" class="menu-close"><i class="icon-cross"></i><span>&nbsp;CLOSE</span></section>
				</div>
			</div>
		</nav>
		<div class="head-inner">
			<div class="head-left">
				<div class="main-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
				</div>
				<div id="h_drop" class="nav-btn">
					<div id="nav-icon3"><span></span> <span></span> <span></span> <span></span></div>
					<span class="menu-head-span">MENU</span>
				</div>
				<div class="head-search">
					<i class="icon-search"></i>
				</div>
			</div>
			<div class="head-right">
				<div class="head-mag-cover">
					<a href="<?php echo $online_store_url; ?>" target="_blank">
						<img src="<?php echo $mag_cover_image['url']; ?>" alt="">
					</a> 
				</div>
				<div class="head-subscribe" id="head-subscribe">
					<span>&nbsp;BUY MAGAZINE</span><i class="icon-caret-down"></i>
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








	
<?php if(get_field("full_width") != true){ ?>
    <div class="content-banner-section">
    	<div class="mob-mdl-banner">
			<?php imo_ad_placement("320_atf"); ?>
		</div>
		<div class="mdl-banner">
			<?php 
			imo_ad_placement("leaderboard"); 
			imo_ad_placement("billboard"); 
			?>
		</div>
    </div>
<?php } ?>
<main id="main" class="main clearfix js-responsive-layout">