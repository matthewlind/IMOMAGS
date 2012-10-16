<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

// For cross-blog queries
global $switched;
$args = array(
  'post_type'			  =>	'post',
	'posts_per_page'	=>	3,
	'orderby'			    =>	'date',
	'order'				    =>	'DESC'
); 


$displayStyle = "display:none;";
$loginStyle = "";

if ( is_user_logged_in() ) {

	$displayStyle = "";
	$loginStyle = "display:none;";
	
	wp_get_current_user();
	
	$current_user = wp_get_current_user();
    if ( !($current_user instanceof WP_User) )
         return;
    }

?>
		</div><!-- #main -->
	</section><!-- .container -->

  <footer id="footer" class="end-scroll">
    
      <section id="imo-network">
        <div class="container">
          <!-- <h4><span class="white">Guns &amp; Ammo</span> Shooting Network <span class="tail"></span></h4> -->
          <div id="mag-bowhunter" class="mag first">
            <a class="site-link" href="http://www.bowhunter.com/" title="Visit www.bowhunter.com">
              <img class="cover" src="<?php print get_stylesheet_directory_uri(); ?>/img/mags_bowhunter.jpg" alt />
              <h5>Bowhunter</h5>
            </a>
            <?php switch_to_blog(3);
            $blog = new WP_Query($args);
            if ($blog->have_posts()) :?>
            <ul class="recent-posts">
              <?php while ($blog->have_posts()) : $blog->the_post(); ?>
              <li class="date"><?php the_date('F jS'); ?></li>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile ?>
            </ul>
            <?php endif; restore_current_blog(); ?>
          </div>
          <div id="mag-gf" class="mag">
            <a class="site-link" href="http://www.gameandfishmag.com/" title="Visit www.gameandfishmag.com">
              <img class="cover" src="<?php print get_stylesheet_directory_uri(); ?>/img/mags_gf.jpg" alt />
              <h5>Game & Fish</h5>
            </a>
            <?php switch_to_blog(14);
            $blog = new WP_Query($args);
            if ($blog->have_posts()) :?>
            <ul class="recent-posts">
              <?php while ($blog->have_posts()) : $blog->the_post(); ?>
              <li class="date"><?php the_date('F jS'); ?></li>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile ?>
            </ul>
            <?php endif; restore_current_blog(); ?>
          </div>
          <div id="mag-petersen" class="mag">
            <a class="site-link" href="http://www.petersenshunting.com/" title="Visit www.petersenshunting.com">
              <img class="cover" src="<?php print get_stylesheet_directory_uri(); ?>/img/mags_petersen.jpg" alt />
              <h5>Petersen's Hunting</h5>
            </a>
            <?php switch_to_blog(7);
            $blog = new WP_Query($args);
            if ($blog->have_posts()) :?>
            <ul class="recent-posts">
              <?php while ($blog->have_posts()) : $blog->the_post(); ?>
              <li class="date"><?php the_date('F jS'); ?></li>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile ?>
            </ul>
            <?php endif; restore_current_blog(); ?>
          </div>
                 
          <div style="clear:both"></div>
        
        <div class="intermedia-network">
            	<div class="network-title">THE INTERMEDIA OUTDOORS NETWORK</div>
                <div class="otd-networkblock">
                	 <div class="slides-container-f">
                        <ul id="slides-footer" class="jcarousel-skin-tango">
                        	<li><a href="http://www.thesportsmanchannel.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/sportsman_channel.png" alt="" /></a></li>
							<li><a href="http://www.petersenshunting.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/hunting.png" alt="" /></a></li>
							<li><a href="http://www.floridasportsman.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/florida_sportsman.png" alt="" /></a></li>
							<li><a href="http://www.flyfisherman.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/fly_fisherman.png" alt="" /></a></li>
							<li><a href="http://www.gunsandammo.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/gunsandammo.png" alt="" /></a></li>
							
							<li><a href="http://www.in-fisherman.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/in_fisherman.png" alt="" /></a></li>
							<li><a href="http://www.gameandfishmag.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/game_and_fish.png" alt="" /></a></li>
							<li><a href="http://www.gundogmag.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/gun_dog.png" alt="" /></a></li>
							<li><a href="http://www.handgunsmag.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/handguns.png" alt="" /></a></li>
							<li><a href="http://www.bowhunter.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/bowhunter.png" alt="" /></a></li>
							<li><a href="http://www.bowhuntingmag.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/bowhunting.png" alt="" /></a></li>
							
							<li><a href="http://www.rifleshootermag.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/rifleshooter.png" alt="" /></a></li>
							<li><a href="http://www.shootingtimes.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/shooting.png" alt="" /></a></li>
							<li><a href="http://www.shotgunnews.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/shotgun_news.png" alt="" /></a></li>
							
							<li><a href="http://www.sportsmenvote.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/sp-logo-sm.png" alt="" /></a></li>
							<li><a href="http://www.wildfowlmag.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/wildfowl.png" alt="" /></a></li>
							 <li><a href="http://www.bassfan.com/"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/imo_logos/new/bassfan.png" alt="" /></a></li>
							 							<li><a href="http://store.intermediaoutdoors.com/"><img src="http://www.northamericanwhitetail.com/wp-content/themes/carrington-business/imo-footer/images/imo-store.png" alt="" /></a></li>
                        </ul>
                      </div>    
                </div>
            </div>

        </div>
      </section>
      <section class="stay-connected">
        <div class="container">
          
          <div class="top">
            <h4>Stay Connected</h4>
            <ul class="connections">
              <li class="facebook"><a href="http://www.facebook.com/NAWhitetail" title="Find us on Facebook">Facebook</a></li>
              <li class="twitter"><a href="http://twitter.com/NAWhitetail" title="Follow us on Twitter">Twitter</a></li>
              <li class="news"><a href="/newsletter/">Newsletter</a></li>
              <!--<li class="apps"><a href="/apps/">Apps</a></li>-->
              <li class="mags"><a href="https://securesubs.intermediaoutdoors.com/orderpage_ex.php?m=northamericanwhitetail">Get the Magazine</a></li>
            </ul>
          </div>
        
          <hr />
          <div class="extras">
           		Copyright &copy; <?php echo date('Y'); ?>, Intermedia Outdoors. All Rights Reserved.</div>
          	<div class="bottom">
         
            <div class="utility"> 
              <a href="http://www.imoutdoorsmedia.com/IM3/" title="">About</a>
              <a href="http://www.imoutdoorsmedia.com" title="">Advertise</a>
              <a href="http://www.imoutdoorsmedia.com/IM3/privacy.php">Privacy Policy</a>
             <!-- <a href="/privacy" title="">Privacy Policy</a> &middot;-->
              <!--<a href="/terms" title="">Terms &amp; Conditions</a>-->
            </div>
          </div>

        </div>
      </section>
      
      

    
  </footer>

  <?php if (CFCT_DEBUG) : ?>
  <div style="border: 1px solid #ccc; background: #ffc; padding: 20px;">The <code>CFCT_DEBUG</code> setting is currently enabled, which shows the filepath of each included template file. To hide the file paths, edit this setting in the <?php echo CFCT_PATH; ?>functions.php file.</div>
  <?php endif; ?>

  <?php wp_footer(); ?>
  
  <div class="new-post-share-box" style="display:none;">
  <h2><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/nawp-crosshair-icon.png" class="share-box-icon">Share this post to get more points!</h2>
  <div class="big-addthis">
  	<?php imo_add_this_big(); ?>
  </div>
  <p>The more activity your post has, the higher your score!</p>
  <p><a href="" class="share-not-now">(not this time)</a></p>
  </div>
  

  <div class="new-superpost-modal-container new-superpost-box" style="display:none;height:425px:width:600px;background-color:white;">
    <h1>Post Something!</h1>

    <form id="fileUploadForm" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-form">

        <input type="text" name="title" id="title" placeholder="Title"/>
        <textarea name="body" id="body" placeholder="Description"></textarea>
         <div class="post_type_styled_select">
         <select class="modal_post_type" name="post_type">
        	<option value="report" class="report">Rut Reports</option>
         	<option value="trophy" class="trophy">Trophy Bucks</option>
            <option value="question" class="question">Q&A</option>
            <option value="general" class="general">General Discussion</option>
            <option value="gear" class="gear">Gear</option>
            <option value="lifestyle" class="lifestyle">Lifestyle</option>
            <option value="tip" class="tip">Tips & Tactics</option>
          </select>
        </div>
        
       

        <div class="state-dropdown-container" style="display:none;">
          <select name="state" class="state-chzn" style="width:400px;padding:5px;" data-placeholder="Choose the state for this post:">
            <option value=""></option>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
            <option value="CN">Canada</option>
            <option value="AB">Alberta</option>
            <option value="BC">British Columbia</option>
            <option value="MB">Manitoba</option>
            <option value="NB">New Brunswick</option>
            <option value="NL">Newfoundland and Labrador</option>
            <option value="NT">Northwest Territories</option>
            <option value="NS">Nova Scotia</option>
            <option value="NU">Nunavut</option>
            <option value="ON">Ontario</option>
            <option value="PE">Prince Edward Island</option>
            <option value="QC">Quebec</option>
            <option value="SK">Saskatchewan</option>
            <option value="YT">Yukon</option>
            <option value="AG">Aguascalientes</option>
            <option value="BJ">Baja California</option>
            <option value="BS">Baja California Sur</option>
            <option value="CP">Campeche</option>
            <option value="CH">Chiapas</option>
            <option value="CI">Chihuahua</option>
            <option value="CU">Coahuila</option>
            <option value="CL">Colima</option>
            <option value="DF">Distrito Federal</option>
            <option value="DG">Durango</option>
            <option value="GJ">Guanajuato</option>
            <option value="GR">Guerrero</option>
            <option value="HG">Hidalgo</option>
            <option value="JA">Jalisco</option>
            <option value="EM">Mexico</option>
            <option value="MH">Michoacán</option>
            <option value="MR">Morelos</option>
            <option value="NA">Nayarit</option>
            <option value="NL">Nuevo León</option>
            <option value="OA">Oaxaca</option>
            <option value="PU">Puebla</option>
            <option value="QA">Querétaro</option>
            <option value="QR">Quintana Roo</option>
            <option value="SL">San Luis Potosi</option>
            <option value="SI">Sinaloa</option>
            <option value="SO">Sonora</option>
            <option value="TA">Tabasco</option>
            <option value="TM">Tamaulipas</option>
            <option value="TL">Tlaxcala</option>
            <option value="VZ">Veracruz</option>
            <option value="YC">Yucatan</option>
            <option value="ZT">Zacatecas</option>

          </select>
          
          
        </div>
        
        <div class="question-dropdown-container" style="display:none;">
          <select class="modal_post_type" name="secondary_post_type">
            <option value="general">Question Topic</option>
            <option value="general">General</option>
            <option value="tips">Tips & Tactics</option>
            <option value="land">Land Management</option>
            <option value="trophy">Trophy Bucks</option>
            <option value="gear">Gear</option>
            <option value="cooking">Cooking</option>
          </select>
        </div>
            
        
        

        <input id="file" type="file" name="photo-upload" id="photo-upload" style="display:none"/>
<!--    
        <input type="hidden" name="clone_target" value="superpost-box">
        <input type="hidden" name="attach_target" value="post-container">
        <input type="hidden" name="attachment_point" value="prepend">
        <input type="hidden" name="masonry" value="true"> 
-->
        <input type="hidden" name="form_id" value="fileUploadForm">
        <input type="hidden" name="attachment_id" class="attachment_id" value="">

        <input type="submit" value="Submit" class="submit" style="<?php echo $displayStyle; ?>"/>
		<div class="fast-login-then-post-button modal-popup-button" style="<?php echo $loginStyle; ?>">Submit & Login <!--<img class="submit-icon" src="/wp-content/themes/imo-mags-northamericanwhitetail/img/fb.png" height=20 width=20>--></div>

        <p class="login-note">
        </p>
        </form>
        
        <div class="media-section">
	        
	        	<form id="fileUploadForm-image" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-image-form">
			    	<div id="fileupload" >
			        	<div class="fileupload-buttonbar ">
			            	<label class="upload-button">
				                <span><span class="white-plus-sign">+</span><span class="button-text">ATTACH PHOTO</span></span>
				                <input id="image-upload" type="file" name="photo-upload" id="photo-upload" />
			                </label>
			           </div>
			       </div>
			       <input type="hidden" name="post_type" value="photo">
			       <input type="hidden" name="form_id" value="fileUploadForm">
		       </form><!-- end form -->
		      
			   <div class="video-button">
			        <span><span class="white-plus-sign"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/youtube.png" alt="YouTube" /></span>ADD YOUTUBE VIDEO</span>
			   </div>
			   <div class="video-url-form-holder-container" style="display:none;">
			   		<div class="video-url-form-holder" style="">
			        	<form id="video-url-form" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-image-form">		            
				            <div class="video-body-holder">
				            	<input type="text" name="body" id="video-body" placeholder="Paste YouTube URL or code here"/>
				            </div>
				            <input type="hidden" name="post_type" value="youtube">
				            <input type="hidden" name="form_id" value="fileUploadForm">
				       </form>
				   </div>
			       <div class="video-close-button">
			       </div>
			  </div><!-- /.video-url-form-holder-container-->
			  
			  <h4 style="display:none" class="photo-attachement-header">Photos</h4>
			  <div class="attached-photos">
			  </div>
		</div><!-- /.media-section-->
    </div> <!-- End new-superpost-modal-container -->


	<article id="excerpt-template" class="post type-post status-publish format-standard hentry entry entry-excerpt has-img" style="display:none;">
	<a href="http://www.northamericanwhitetail.deva/2012/03/13/deer-of-the-day-buckeye-brute-alexa-perry/" class="no-olay"><img width="190" height="120" src="http://www.northamericanwhitetail.deva/files/2012/03/NAWdd_031312-190x120.jpg" class="entry-img wp-post-image" alt="" title="" /><span></span></a>
	
	<div class="entry-summary">
	  <span class="entry-category"><a href="http://www.northamericanwhitetail.deva/category/deer-of-the-day/" title="View all posts in Deer of the Day" rel="category tag">Deer of the Day</a></span>
	<h2 class="entry-title"><a rel="bookmark" href="http://www.northamericanwhitetail.deva/2012/03/13/deer-of-the-day-buckeye-brute-alexa-perry/">Deer of the Day Buckeye Brute, Alexa Perry</a></h2>
	<span class="author vcard">March 13, 2012 <span class="fn">by North American Whitetail Online Staff</span></span>
	<p class="excerpt-body">13-year-old Alexa Perry shot this fantastic buck the third week in November in Ohio. The buck grossed 180 3/8 inches.<a href="http://www.northamericanwhitetail.deva/2012/03/13/deer-of-the-day-buckeye-brute-alexa-perry/">&#8230;&raquo;</a></p>
	</div>
	<a class="comment-count" href="http://www.northamericanwhitetail.deva/2012/03/13/deer-of-the-day-buckeye-brute-alexa-perry/#comments">2</a>
	</article>
	
  <div class="user-login-modal-container" style="display:none">
    <div id="LoginWithAjax"><?php //ID must be here, and if this is a template, class name should be that of template directory ?>
              <span id="LoginWithAjax_Status"></span>
              <form name="LoginWithAjax_Form" id="LoginWithAjax_Form" action="/login/?callback=?&template=" method="post">
              
                

            <div class="fb-login-button" scope="email">Fast Login with Facebook</div>
                  <table width='100%' cellspacing="0" cellpadding="0">
                      <tr id="LoginWithAjax_Username">
                          <td class="username_label">
                              <label><?php _e( 'Username' ) ?></label>
                          </td>
                          <td class="username_input">
                              <input type="text" name="log" id="lwa_user_login" class="input" value="<?php echo attribute_escape(stripslashes($user_login)); ?>" />
                          </td>
                      </tr>
                      <tr id="LoginWithAjax_Password">
                          <td class="password_label">
                              <label><?php _e( 'Password' ) ?></label>
                          </td>
                          <td class="password_input">
                              <input type="password" name="pwd" id="lwa_user_pass" class="input" value="" />
                          </td>
                      </tr>
                      <tr id="LoginWithAjax_Submit">
                          <td id="LoginWithAjax_SubmitButton">
                              <input type="submit" name="wp-submit" id="lwa_wp-submit" value="<?php _e('Log In'); ?>" tabindex="100" />
                              <input type="hidden" name="redirect_to" value="http://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>" />
                              <input type="hidden" name="testcookie" value="1" />
                              <input type="hidden" name="lwa_profile_link" value="<?php echo $lwa_data['profile_link'] ?>" />
                          </td>
                          <td id="LoginWithAjax_Links">
                              <input name="rememberme" type="hidden" id="lwa_rememberme" value="forever" /> <label><?php _e( 'Remember Me' ) ?></label>
                              <br />
                              <a id="LoginWithAjax_Links_Remember" href="<?php echo site_url('wp-login.php?action=lostpassword', 'login') ?>" title="<?php _e('Password Lost and Found') ?>"><?php _e('Lost your password?') ?></a>
                              <?php
                                  //Signup Links
                                  if ( get_option('users_can_register') ) {
                                      echo "<br />";  
                                      if ( function_exists('bp_get_signup_page') ) { //Buddypress
                                        $register_link = bp_get_signup_page();
                                      }elseif ( file_exists( ABSPATH."/wp-signup.php" ) ) { //MU + WP3
                                          $register_link = site_url('wp-signup.php', 'login');
                                      } else {
                                          $register_link = site_url('wp-login.php?action=register', 'login');
                                      }
                                      ?>
                                      <a href="<?php echo $register_link ?>" id="LoginWithAjax_Links_Register" rel="#LoginWithAjax_Register"><?php _e('Register') ?></a>
                                      <?php
                                  }
                              ?>
                          </td>
                      </tr>
                  </table>
              </form>
              <form name="LoginWithAjax_Remember" id="LoginWithAjax_Remember" action="/login/?action=lostpassword&callback=?&template=" method="post" style="display:none;">
                  <table width='100%' cellspacing="0" cellpadding="0">
                      <tr>
                          <td>
                              <strong><?php echo __("Forgotten Password", 'login-with-ajax'); ?></strong>         
                          </td>
                      </tr>
                      <tr>
                          <td class="forgot-pass-email">  
                              <?php $msg = __("Enter username or email", 'login-with-ajax'); ?>
                              <input type="text" name="user_login" id="lwa_user_remember" value="<?php echo $msg ?>" onfocus="if(this.value == '<?php echo $msg ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $msg ?>'}" />   
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <input type="submit" value="<?php echo __("Get New Password", 'login-with-ajax'); ?>" />
                                <a href="#" id="LoginWithAjax_Links_Remember_Cancel"><?php _e("Cancel"); ?></a>
                              <input type="hidden" name="login-with-ajax" value="remember" />         
                          </td>
                      </tr>
                  </table>
              </form>
              <?php 
          //Taken from wp-login.php
          ?>
              <?php if ( get_option('users_can_register') && $lwa_data['registration'] == true ) : ?>
          <div id="LoginWithAjax_Register">
            <form name="registerform" id="registerform" action="<?php echo $this->url_register ?>" method="post">
            <table width='100%' cellspacing="0" cellpadding="0">
                      <tr>
                          <td>
                              <strong><?php _e('Register For This Site') ?></strong>         
                          </td>
                      </tr>
                      <tr>
                          <td>  
                              <?php $msg = __('Username') ?>
                              <input type="text" name="user_login" id="user_login"  value="<?php echo $msg ?>" onfocus="if(this.value == '<?php echo $msg ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $msg ?>'}" /></label>   
                          </td>
                      </tr>
                      <tr>
                          <td>  
                              <?php $msg = __('E-mail') ?>
                              <input type="text" name="user_email" id="user_email"  value="<?php echo $msg ?>" onfocus="if(this.value == '<?php echo $msg ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $msg ?>'}"/></label>   
                          </td>
                      </tr>
                      <tr>
                          <td>
                  <?php
                    //If you want other plugins to play nice, you need this: 
                    do_action('register_form'); 
                  ?>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <p><?php _e('A password will be e-mailed to you.') ?></p>
                  <input type="submit" value="<?php esc_attr_e('Register'); ?>" tabindex="100" />
                  <a href="#" id="LoginWithAjax_Links_Register_Cancel"><?php _e("Cancel"); ?></a>
                  <input type="hidden" name="lwa" value="1" />
                          </td>
                      </tr>
                  </table>
            </form>
          </div>
          <?php endif; ?> 
        </div>


  </div><!-- End user login modal container -->
  <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.jfollow.js"></script>

</body>
</html>
