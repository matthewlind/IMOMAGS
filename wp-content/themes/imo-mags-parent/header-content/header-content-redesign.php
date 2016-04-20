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


<div class="wrapper">	



<header class="main-header">
	<div id="header_wrap" class="header-wrap">
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
							<div class="newsletter">
								<?php
								$formID = get_option('newsletter_id');
						
								$url = "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
							    $errorcode = $_GET["errorcode"];
							    $errorcontrol = $_GET["errorControl"];
							
							    switch($errorcode) {
							
							        case "1" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
							        case "2" : $strError = "The list provided does not exist."; break;
							        case "3" : $strError = "Information was not provided for a mandatory field. (".$errorcontrol.")"; break;
							        case "4" : $strError = "Please provide an email address.".$errorcontrol; break;
							        case "5" : $strError = "Information provided is not unique. (".$errorcontrol.")"; break;
							        case "6" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
							        case "7" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
							        case "8" : $strError = "Subscriber already exists."; break;
							        case "9" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
							        case "10" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
							          //case "11" : This error does not exist.
							        case "12" : $strError = "The subscriber you are attempting to insert is on the master unsubscribe list or the global unsubscribe list."; break;
							        default : $strError = "Other"; break;
							          //case "13" : Check that the list ID and/or MID specified in your code is correct.
								}
								?>
								<form action="http://cl.exct.net/subscribe.aspx?lid=<?php echo $formID; ?>" name="subscribeForm" method="post">
									<input type="hidden" name="thx" value="<?php echo $url; ?>#subscribe-success" />
									<input type="hidden" name="err" value="<?php echo $url; ?>" />
									<input type="hidden" name="MID" value="6283180" />
									<fieldset>
										<input alt="Email Address" type="text" name="Email Address" size="25" maxlength="100" value="" placeholder="Enter Your Email..." >
								        <!--<input alt="Third Party" type="checkbox" checked="checked" value="22697" name="interests" id="receive" />
								        <input type="hidden" name="OptoutInfo" value="">
								        <div class="opt-in">Yes, I'd like to receive offers from your partners</div>-->
										<input type="submit" value="Sign Up" style="margin-left: 20px;" />
									</fieldset>
								</form>
								<script type="text/javascript">
									var querystring = window.location.search.substring(1);
									var vars = querystring.split('&');
									var subsSuccess = window.location.hash.substr(1)
							
									if(subsSuccess == "subscribe-success"){
										alert('Thank you for subscribing to the <?php echo SITE_NAME; ?> Newsletter.');
									}
									else if(vars[0] == "errorcode=1" || vars[0] == "errorcode=2" || vars[0] == "errorcode=3" || vars[0] == "errorcode=4" || vars[0] == "errorcode=5" || vars[0] == "errorcode=6" || vars[0] == "errorcode=7" || vars[0] == "errorcode=8" || vars[0] == "errorcode=9" || vars[0] == "errorcode=10" || vars[0] == "errorcode=12"){
										alert('<?php echo $strError; ?>');
									}	
								</script>
							</div>
						</div>
					</section>
					<section id="m_drop" class="menu-close"><i class="icon-close"></i><span>&nbsp;CLOSE MENU</span></section>
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
						<img src="<?php echo $magazine_img; ?>" alt="Subscribe">
					</a> 
				</div>
				<div class="head-subscribe" id="head-subscribe">
					<span>&nbsp;SUBSCRIBE</span><i class="icon-caret-down"></i>
					<?php include(get_template_directory() . "/content/microsite-template-parts/buy-mag-dropdown.php"); ?>
				</div>
				<div class="head-social">
					<ul>
						<li><a href="http://www.facebook.com/sharer/sharer.php?u=$url_for_social&title=$face_twit_title" class="icon-facebook" target="_blank"></a></li>
						<li><a href="http://twitter.com/intent/tweet?status=$face_twit_title+$url_for_social" class="icon-twitter" target="_blank"></a></li>
						<li><a href="http://www.facebook.com/sharer/sharer.php?u=$url_for_social&title=$face_twit_title" class="icon-youtube-play" target="_blank"></a></li>
						<li><a href="mailto:?subject=$email_subject&body=$email_message $url_for_social" class="icon-envelope" target="_blank"></a></li>
					</ul>
				</div>
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
		<div class="head-social">
			<ul>
				<li><a href="http://www.facebook.com/sharer/sharer.php?u=$url_for_social&title=$face_twit_title" class="icon-facebook" target="_blank"></a></li>
				<li><a href="http://twitter.com/intent/tweet?status=$face_twit_title+$url_for_social" class="icon-twitter" target="_blank"></a></li>
				<li><a href="http://www.facebook.com/sharer/sharer.php?u=$url_for_social&title=$face_twit_title" class="icon-youtube-play" target="_blank"></a></li>
				<li><a href="mailto:?subject=$email_subject&body=$email_message $url_for_social" class="icon-envelope" target="_blank"></a></li>
			</ul>
		</div>
		<div class="head-subscribe">
			<span id="head-bottom-subscribe">&nbsp;SUBSCRIBE</span><i class="icon-triangle-down"></i>
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