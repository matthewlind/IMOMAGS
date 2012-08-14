<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.


Be sure to check out functions/profile.php for more stuff related to this template. --Aaron

*/

$age = get_user_meta($profileuser->ID,"age",true);
$address1 = get_user_meta($profileuser->ID,"address1",true);
$address2 = get_user_meta($profileuser->ID,"address2",true);
$city = get_user_meta($profileuser->ID,"city",true);
$state = get_user_meta($profileuser->ID,"state",true);
$zip = get_user_meta($profileuser->ID,"zip",true);


$user_role = reset( $profileuser->roles );
if ( is_multisite() && empty( $user_role ) ) {
	$user_role = 'subscriber';
}

$user_can_edit = false;
foreach ( array( 'posts', 'pages' ) as $post_cap )
	
$user_can_edit |= current_user_can( "edit_$post_cap" );
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
<div class="login profile" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'profile' ); ?>
	<?php $template->the_errors(); ?>
	<form id="your-profile" action="" method="post">
		<?php wp_nonce_field( 'update-user_' . $current_user->ID ) ?>
		<p>
			<input type="hidden" name="from" value="profile" />
			<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />
		</p>

		<?php if ( !$theme_my_login->options->get_option( array( 'themed_profiles', $user_role, 'restrict_admin' ) ) && !has_action( 'personal_options' ) ): ?>

		
		<?php endif; // restrict admin ?>

		<?php do_action( 'profile_personal_options', $profileuser ); ?>

		<h3><?php _e( 'Name', 'theme-my-login' ) ?></h3>

		<table class="form-table">
<!--
		<tr>
			<th><label for="user_login"><?php _e( 'Username', 'theme-my-login' ); ?></label></th>
			<td><input type="text" name="user_login" id="user_login" value="<?php echo esc_attr( $profileuser->user_login ); ?>" disabled="disabled" class="regular-text" /> <span class="description"><?php _e( 'Your username cannot be changed.', 'theme-my-login' ); ?></span></td>
		</tr>
			
-->

		<tr>
			<th><label for="display_name"><?php _e( 'Display name publicly as', 'theme-my-login' ) ?></label></th>
			<td>
				<input type="text" name="display_name" id="display_name" value="<?php echo esc_attr( $profileuser->display_name ) ?>" class="regular-text" />
			</td>
		</tr>

		<tr>
			<th><label for="first_name"><?php _e( 'First name', 'theme-my-login' ) ?></label></th>
			<td><input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( $profileuser->first_name ) ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="last_name"><?php _e( 'Last name', 'theme-my-login' ) ?></label></th>
			<td><input type="text" name="last_name" id="last_name" value="<?php echo esc_attr( $profileuser->last_name ) ?>" class="regular-text" /></td>
		</tr>

<!-- Deleted section that allowed users to set nickname. Real names are required on site. -->


		<tr>
	
			<th><label for="age<?php $template->the_instance(); ?>">Age</label></th>
			<td><input type="text" name="age" id="age<?php $template->the_instance(); ?>" class="input" value="<?php echo $age; ?>" size="2" tabindex="20" /></td>
		
		</tr>
		
		<tr>
	
			<th><label for="address1<?php $template->the_instance(); ?>">Address 1</label></th>
			<td><input type="text" name="address1" id="address1<?php $template->the_instance(); ?>" class="input" value="<?php echo $address1; ?>" size="35" tabindex="20" /></td>
		
		</tr>
		
		<tr>
	
			<th><label for="address2<?php $template->the_instance(); ?>">Address 2</label></th>
			<td><input type="text" name="address2" id="address2<?php $template->the_instance(); ?>" class="input" value="<?php echo $address2; ?>" size="35" tabindex="20" /></td>
		
		</tr>
		
		<tr>
	
			<th><label for="city<?php $template->the_instance(); ?>">City</label></th>
			<td><input type="text" name="city" id="city<?php $template->the_instance(); ?>" class="input" value="<?php echo $city; ?>" size="20" tabindex="20" /></td>
		
		</tr>
		
		<tr>
	
			<th><label for="state<?php $template->the_instance(); ?>">State</label></th>
			<td><input type="text" name="state" id="state<?php $template->the_instance(); ?>" class="input" value="<?php echo $state; ?>" size="2" tabindex="20" /></td>
		
		</tr>
		
		<tr>
	
			<th><label for="zip<?php $template->the_instance(); ?>">Zip</label></th>
			<td><input type="text" name="zip" id="zip<?php $template->the_instance(); ?>" class="input" value="<?php echo $zip; ?>" size="5" tabindex="20" /></td>
		
		</tr>


<!--	Deleted section that allowed users to change display name -->

		</table>

		<h3><?php _e( 'Contact Info', 'theme-my-login' ) ?></h3>

		<table class="form-table">
		<tr>
			<th><label for="email"><?php _e( 'E-mail', 'theme-my-login' ); ?> <span class="description"><?php _e( '(required)', 'theme-my-login' ); ?></span></label></th>
			<td><input type="text" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ) ?>" class="regular-text" /></td>
		</tr>

<!--  This section is temporarily commented out. We don't want users to be able to link to websites because that can encourage spam comments. 
	  However, we will want outfitters to do this later.
		<tr>
			<th><label for="url"><?php _e( 'Website', 'theme-my-login' ) ?></label></th>
			<td><input type="text" name="url" id="url" value="<?php echo esc_attr( $profileuser->user_url ) ?>" class="regular-text code" /></td>
		</tr>
-->

		<?php if ( function_exists( '_wp_get_user_contactmethods' ) ) :
			foreach ( _wp_get_user_contactmethods() as $name => $desc ) {
				//This section displays the twitter name
				//Check functions/profile.php for other things this section could show
		?>
		
		<tr>
			<th><label for="<?php echo $name; ?>"><?php echo apply_filters( 'user_'.$name.'_label', $desc ); ?></label></th>
			<td><input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_attr( $profileuser->$name ) ?>" class="regular-text" /></td>
		</tr>
		
		
		
		<?php
			}
			endif;
		?>
		</table>

		<h3><?php _e( 'About Yourself', 'theme-my-login' ); ?></h3>

		<table class="form-table">
		
<!--	Commented out this section because we currently do not display user biographies.
		<tr>
			<th><label for="description"><?php _e( 'Biographical Info', 'theme-my-login' ); ?></label></th>
			<td><textarea name="description" id="description" rows="5" cols="30"><?php echo esc_html( $profileuser->description ); ?></textarea><br />
			<span class="description"><?php _e( 'Share a little biographical information to fill out your profile. This may be shown publicly.', 'theme-my-login' ); ?></span></td>
		</tr>
-->

		<?php
		$show_password_fields = apply_filters( 'show_password_fields', true, $profileuser );
		if ( $show_password_fields ) :
		?>
		<tr id="password">
			<th><label for="pass1"><?php _e( 'New Password', 'theme-my-login' ); ?></label></th>
			<td><input type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" /> <span class="description"><?php _e( 'If you would like to change the password type a new one. Otherwise leave this blank.', 'theme-my-login' ); ?></span><br />
				<input type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" /> <span class="description"><?php _e( 'Type your new password again.', 'theme-my-login' ); ?></span><br />
				<div id="pass-strength-result"><?php _e( 'Strength indicator', 'theme-my-login' ); ?></div>
				<p class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', 'theme-my-login' ); ?></p>
			</td>
		</tr>
		<?php endif; ?>
		</table>

		<?php
			do_action( 'show_user_profile', $profileuser );
		?>

		<?php if ( count( $profileuser->caps ) > count( $profileuser->roles ) && apply_filters( 'additional_capabilities_display', true, $profileuser ) ) { ?>
		<br class="clear" />
			<table width="99%" style="border: none;" cellspacing="2" cellpadding="3" class="editform">
				<tr>
					<th scope="row"><?php _e( 'Additional Capabilities', 'theme-my-login' ) ?></th>
					<td><?php
					$output = '';
					global $wp_roles;
					foreach ( $profileuser->caps as $cap => $value ) {
						if ( !$wp_roles->is_role( $cap ) ) {
							if ( $output != '' )
								$output .= ', ';
							$output .= $value ? $cap : "Denied: {$cap}";
						}
					}
					echo $output;
					?></td>
				</tr>
			</table>
		<?php } ?>

		<p class="submit">
			<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
			<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Update Profile', 'theme-my-login' ); ?>" name="submit" />
		</p>
	</form>
<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout">Logout</a>
</div>
