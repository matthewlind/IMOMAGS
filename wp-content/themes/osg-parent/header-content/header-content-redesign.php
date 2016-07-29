<?php 
	global $term, $camp;
  	$postID 		= get_the_ID();
    $dartDomain 	= get_option("dart_domain", $default = false);
    $magazine_img 	= get_option('magazine_cover_uri' );
    $subs_link 		= get_option('subs_link') . "/?pkey=";
	$mailURL 		= get_option('mail_url' );
	$iMagID 		= get_option('iMagID' );
	$deal_copy 		= get_option('deal_copy' );
	$gift_link 		= get_option('gift_link' );
	$service_link 	= get_option('service_link' );
	$subs_form_link = get_option('subs_form_link' );
	$i4ky 			= get_option('i4ky' );		
	
	if(is_home()){
		$page = "homepage";
	}else if (is_category() || is_author()){
		$page = "category";
	}else if(is_single()){
		$page = "article";
	}
	
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="wrapper">	
<?php imo_ad_placement("superheader"); ?>

<header class="main-header">
	<div id="header_wrap" class="header-wrap">
		
		<div class="head-inner">
			<div class="head-left">
				<div class="main-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
				</div>
				<div id="h_drop" class="nav-btn">
					<div id="nav-icon3"><span></span> <span></span> <span></span> <span></span></div>
					<span class="menu-head-span">MENU</span>
				</div>
				<label id="h_search" class="head-search" for="s">
					<i class="icon-search"></i>
				</label>
			</div>
			<div class="head-right">
				<div class="head-mag-cover">
					<a href="<?php echo $subs_link . get_option("header_key"); ?>" target="_blank">
						<img src="<?php echo $magazine_img; ?>" alt="Subscribe">
					</a> 
				</div>
				<a href="<?php echo $subs_link . get_option("header_key"); ?>" target="_blank">
					<div class="head-subscribe" id="head-subscribe">
						<span>&nbsp;SUBSCRIBE</span><!--<i class="icon-caret-down"></i>-->
						<?php //include(get_template_directory() . "/content/microsite-template-parts/buy-mag-dropdown.php"); ?>
					</div>
				</a>
				<div class="head-social">
					<ul>
						<?php if(defined('FACEBOOK_LINK')){ ?><li><a href="<?php echo FACEBOOK_LINK; ?>" class="icon-facebook" target="_blank"></a></li><?php } ?>
						<?php if(defined('TWITTER_LINK')){ ?><li><a href="<?php echo TWITTER_LINK; ?>" class="icon-twitter" target="_blank"></a></li><?php } ?>
						<?php if(defined('YOUTUBE_LINK')){ ?><li><a href="<?php echo YOUTUBE_LINK; ?>" class="icon-youtube-play" target="_blank"></a></li><?php } ?>
						<?php if($mailURL){ ?><li><a href="<?php echo $mailURL; ?>" class="icon-envelope" target="_blank"></a></li><?php } ?>
					</ul>
				</div>
			</div>
		</div><!-- .header-inner -->	
		<div id="h_search_form" class="h-search-form"><?php parent_theme_get_search_form(); ?></div>
		<?php if( in_array( 'sponsors_disclaimer', get_field('additional_elements', $term_cat_id) ) ) { 
				$sponsors_disclaimer 	= get_field('sponsors_disclaimer', $term_cat_id);
		?>
			<div class="sponsors-disclaimer">
				<span><?php echo $sponsors_disclaimer;?></span>
			</div>
		<?php } ?>
	</div><!-- .header-wrap -->
	
	<div class="head-bottom">
		<div class="head-social">
			<ul>
				<?php if(defined('FACEBOOK_LINK')){ ?><li><a href="<?php echo FACEBOOK_LINK; ?>" class="icon-facebook" target="_blank"></a></li><?php } ?>
				<?php if(defined('TWITTER_LINK')){ ?><li><a href="<?php echo TWITTER_LINK; ?>" class="icon-twitter" target="_blank"></a></li><?php } ?>
				<?php if(defined('YOUTUBE_LINK')){ ?><li><a href="<?php echo YOUTUBE_LINK; ?>" class="icon-youtube-play" target="_blank"></a></li><?php } ?>
				<?php if($mailURL){ ?><li><a href="<?php echo $mailURL; ?>" class="icon-envelope" target="_blank"></a></li><?php } ?>		
			</ul>
		</div>
		<div class="head-subscribe">
			<a href="<?php print $subs_link . get_option("sticky_key"); ?>" target="_blank"><span id="head-bottom-subscribe">&nbsp;SUBSCRIBE</span></a><!--<i class="icon-triangle-down"></i>-->
			<?php //include(get_template_directory() . "/content/microsite-template-parts/buy-mag-dropdown.php"); ?>
		</div>
		<div class="head-mag-cover">
			<a href="">
				<img src="" alt="">
			</a> 
		</div>
	</div>
</header>
<nav id="menu_drop">
	<div class="menu-container">
		<div class="menu-inner">
			<section class="menu-content">
			<?php
            wp_nav_menu(array(
                'menu_class'	=> 'menu',
                'theme_location'=> 'bottom',
                'container' 	=> '0',
                'walker'		=> new AddParentClass_Walker()
            ));   
            ?>
            <?php if(has_nav_menu( 'top' )){
            	wp_nav_menu(array(
                    'menu_class'=>'menu',
                    'theme_location'=>'top'
				));  
            } 
            ?>
			</section>
			<section class="menu-footer">
				<div class="menu-footer-inner">
					<h3>Don’t forget to sign up!</h3>
					<p>Get the Top Stories from <?php bloginfo('name'); ?> Delivered to Your Inbox Every Week</p>
					<?php get_template_part("content/redesign/content", "newsletter"); ?>
				</div>
			</section>
			<section id="m_drop" class="menu-close"><i class="icon-close"></i><span>&nbsp;CLOSE MENU</span></section>
		</div>
	</div>
</nav>
<?php if(has_nav_menu( 'desk_vis' )){ ?>
<div class="desktop-menu">
	<div class="desktop-menu-inner">
	<?php 
    	wp_nav_menu(array(
            'menu_class'=>'desk-menu',
            'theme_location'=>'desk_vis',
            'container' => false
		));  
    ?>
	</div>
</div>
<?php } ?>
<?php if(has_nav_menu( 'desk_vis_sec' )){ ?>
<div class="desktop-secmenu">
	<div class="desktop-secmenu-inner">
	<?php 
    	wp_nav_menu(array(
            'menu_class'=>'desk-secmenu',
            'theme_location'=>'desk_vis_sec',
            'container' => false
		));  
    ?>
	</div>
</div>
<?php } ?>


<?php if(get_field("full_width") != true){ ?>
    <div class="content-banner-section">
		<div class="mdl-banner">
			<iframe class="iframe-ad" onload="resizeIframe(this)" style="display:none;" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term=<?php echo $term; ?>&camp=<?php echo $camp; ?>&ad_code=<?php echo $dartDomain; ?>&ad_unit=billboard&page=<?php echo $page; ?>"></iframe>
		</div>
    </div>
<?php } ?>