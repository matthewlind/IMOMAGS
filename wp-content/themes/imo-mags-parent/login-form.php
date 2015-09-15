<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<style type="text/css">
.btn-grey {
    width:220px;
    height:41px;
    display:block;
    font:17px/41px "stagmedium", serif;
    color:#fff;
    text-shadow:0 -1px 0 #000;
    border-radius:4px;
    text-align:center;
    margin:0 auto;
    background:url(../images/btn-grey.png) no-repeat 50% 0;
}
.btn-grey:hover {color:#040503;}
/* sidebar */
.btn-red .ui-btn-inner {
    display:none;
}
.btn-red,
.singl-post-photo {
	margin:0;
	padding-left: 62px;
	padding-right: 62px;
	background: black;
	color: #f9cc39;
	height: 40px;
    display:block;
    font:15px/42px "stagmedium", serif;
    border-radius:4px;
    text-align:center;
}
.btn-red {
	width:310px;
    margin-bottom:0;
    width:274px;
    cursor: pointer;
}
.basic-popup .btn-red {
    width:177px !important;
    margin:0 auto !important;
    padding: 0;
}
.btn-fb-login {
    display:block;
    width:300px;
    height:65px;
    overflow:hidden;
    text-indent:-9999px;
    margin:0 0 8px;
    background:url(/wp-content/plugins/imo-facebook-auth/facebook-login-button.png);
}

.imo-community-new-post {
    margin-left:auto;
    margin-right:auto;
}

.btn-fb-login:hover {opacity:0.8;}
.sub-photo-note {
    text-align:center;
    font-size:11px;
    margin:0 0 14px;
}
.or-delim {
    display:block;
    margin:0 0 4px;
    text-align:center;
    font:16px "open_sansbold", sans-serif;
    color:#7e7e7e;
    text-transform:uppercase;
}
.logout{float: right;margin-top: 10px;}
.form .general-title {
	padding-left:200px;
	margin-bottom:23px;
}
.form .f-row {
    padding:0 0 17px;
}
.form .f-row.checkbox {
    padding-left:200px;
}
.form .single-row {padding-left:200px;}
.form label {
    float:left;
    width:182px;
    margin:10px 18px 0 0;
    color:#040503;
    font:13px/1.1 "open_sansbold", sans-serif;
    text-transform:uppercase;
    text-align:right;
}

.form label.checkbox-label {
    float:none;
}

.form div.ui-input-text {
    display:inline-block;
}
.row-item {
    display:inline-block;
    vertical-align:top;
}
.row-item label {
    width:auto;
    text-align:left;
    margin-left:26px;
    margin-right:15px;
    float:none;
    display:inline-block;
    vertical-align:top;
}
.form .f-input {
    margin-left:200px;
}
.f-input input {
    border:1px solid #d9d9d9;
    background:#fff;
    padding:6px 10px 7px;
    width:333px;
    font:13px "open_sansregular", sans-serif;
    color:#040503;
    display:inline-block;
    vertical-align:top;
}
.f-input .input-short {width:132px;}
.form-note {
    font-size:12px;
    font-style:italic;
    color:#3c3c3c;
    padding:4px 0;
    max-width:330px;
}
.form .required {
    font:16px/1 "open_sansbold", sans-serif;
    color:#040503;
    display:inline-block;
    vertical-align:top;
    margin:0 0 0 2px;
}
.f-indicator {
    width:333px;
    background:#e5e5e5;
    border:1px solid #d9d9d9;
    padding:5px;
    font:10px "open_sansbold", sans-serif;
    color:#3c3c3c;
    text-transform:uppercase;
    text-align:center;
    margin:0 0 12px;
}
.btn-red input {font: 17px/20px "stagmedium", serif;text-shadow: none;}
.form .btn-red input,
.form .btn-red {width:198px;}

</style>

<?php $template->the_action_template_message( 'login' ); ?>
<?php $template->the_errors(); ?>
<div id="theme-my-login<?php $template->the_instance(); ?>">

	<div class="title-underline">
    	<!-- <h1>Login</h1> -->
    	<!--<a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="logout" alt="Logout" title="Logout">Logout</a>-->
	</div>
	<form name="loginform" class="form" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login' ); ?>" method="post">
		 <fieldset>
            <div class="f-row">
                <label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username or Email', 'theme-my-login' ) ?></label>
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
	<a href="http://imomags.com/lost-password/">Forgot Password?</a>
	<p>New to NAW Community or having trouble? <a href="/register">Register Here</a></p>
</div>