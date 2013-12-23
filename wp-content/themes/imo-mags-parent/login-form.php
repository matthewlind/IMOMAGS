<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>


<?php $template->the_action_template_message( 'login' ); ?>
<?php $template->the_errors(); ?>
<div id="theme-my-login<?php $template->the_instance(); ?>">

	<div class="title-underline">
    	<!-- <h1>Login</h1> -->
    	<!--<a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="logout" alt="Logout" title="Logout">Logout</a>-->
	</div>
	<div class="login-form-facebook" style="">
		<a href="#" id="imo-fb-login-button" class="go-to-profile fb-login join-widget-fb-login btn-fb-login">Fast Login &amp; Submit</a>
	<p style="margin-top:10px">or Login with your Email Address</p>
	</div>
	<form name="loginform" class="form" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login' ); ?>" method="post">
		 <fieldset>
            <div class="f-row">
                <label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'theme-my-login' ) ?></label>
                <div class="f-input">
                    <input name="log" id="user_login<?php $template->the_instance(); ?>" type="text" value="<?php $template->the_posted_value( 'log' ); ?>" />
                </div>
            </div>

            <div class="f-row">
                <label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password', 'theme-my-login' ) ?></label>
                <div class="f-input">
                    <input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>"  />
                </div>
            </div>

			<?php
			do_action( 'login_form' ); // Wordpress hook
			do_action_ref_array( 'tml_login_form', array( &$template ) ); // TML hook
			?>
			<div class="f-row">
				<label for="rememberme<?php $template->the_instance(); ?>"><?php _e( 'Remember Me', 'theme-my-login' ); ?></label>
				<input name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever" tabindex="90" />
			</div>
			<div class="f-row single-row">
                <span class="btn-red">
					<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php _e( 'Log In', 'theme-my-login' ); ?>" tabindex="100" />
				</span>
				<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
				<input type="hidden" name="testcookie" value="1" />
				<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
				</div>

			</fieldset>
		</form>
	<?php $template->the_action_links( array( 'login' => false ) ); ?>
	<a href="/wp-login.php?action=lostpassword">Forgot Password?</a>
</div>