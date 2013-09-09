<?php  ?>




<div class="user-login-modal-container" style="">
    <div id="LoginWithAjax"><?php //ID must be here, and if this is a template, class name should be that of template directory ?>
	    <h2>Login</h2>
	      <span id="LoginWithAjax_Status"></span>
	      <form name="LoginWithAjax_Form" id="imo-ajax-login-form" action="/imo-email-login.json" method="post">
                 <table width='100%' cellspacing="0" cellpadding="0" align="center">
                      <tr id="LoginWithAjax_Email">
                          <td class="email_input">
                              <input type="text" name="email" id="lwa_user_login" class="input" placeholder="Email Address" value="<?php echo attribute_escape(stripslashes($user_login)); ?>" />
                          </td>
                      </tr>
                      <tr id="LoginWithAjax_Password">
                          <td class="password_input">
                              <input type="password" name="password" id="lwa_user_pass" class="input" placeholder="Password" value="" />
                          </td>
                      </tr>
                      <tr id="LoginWithAjax_Submit">
                          <td id="LoginWithAjax_SubmitButton">
                              <input type="submit" name="wp-submit" id="lwa_wp-submit" value="<?php _e('Log In'); ?>" tabindex="100" />
                              <input id="hidden-redirect" type="hidden" name="redirect_to" value="http://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>" />
                              <input type="hidden" name="testcookie" value="1" />
                              <input type="hidden" name="lwa_profile_link" value="<?php echo $lwa_data['profile_link'] ?>" />
                          </td>
                     </tr>
                     <tr>
                     	<td id="LoginWithAjax_Links">
                              <!--<input name="rememberme" type="hidden" id="lwa_rememberme" value="forever" /> <label><?php _e( 'Remember Me' ) ?></label>
                              <br />-->
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
                     <div>
                     <h2>- or -</h2>
            <form name="registerform" id="imo-ajax-register-form" action="/imo-email-register.json" method="post">
            <table width='100%' cellspacing="0" cellpadding="0">
                      <tr>
                          <td>
                              <h2>Register for NAW+</h2>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <?php $msg = __('Display Name') ?>
                              <input type="text" name="displayname" id="imo-login-displayname" class="input" placeholder="Display Name" />
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <input type="text" name="email" id="lwa_user_login" class="input" placeholder="Email Address" />
                          </td>
                      </tr>

                       <tr>
                          <td>
                              <?php $msg = __('Password') ?>
                             <input type="password" name="password" id="lwa_user_pass" class="input" placeholder="Password" value="" />
                          </td>
                      </tr>
                      <tr>
                          <td>
	                          <input type="submit" name="register" id="register" value="<?php _e('Submit'); ?>" tabindex="100" />
					 	  </td>
                      </tr>
                                           <!--<tr>
                          <td>
                              <?php $msg = __('Password') ?>
                              <input type="text" name="user_pass" id="user_pass"  value="<?php echo $msg ?>" onfocus="if(this.value == '<?php echo $msg ?>'){this.value = '';}" onblur="if(this.value == ''){this.value = '<?php echo $msg ?>'}"/></label>
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
                      </tr>-->
                  </table>
            </form>
          </div>
        </div>
  </div><!-- End user login modal container -->