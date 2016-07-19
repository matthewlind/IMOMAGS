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
$send_offers = get_user_meta($profileuser->ID,"send_offers",true);
$send_community_updates = get_user_meta($profileuser->ID,"send_community_updates",true);

if ($send_offers)
    $send_offers_checked = "checked";
if ($send_community_updates)
    $send_community_updates_checked = "checked";

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

<div class="title-underline">
    <!-- <h1>COMMUNITY PROFILE</h1> -->
    <a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="logout" alt="Logout" title="Logout">Logout</a>
</div>
<?php if(mobile()){ ?>
	<div class="image-banner posts-image-banner">
		<?php imo_dart_tag("300x50"); ?>
	</div>
<?php } ?>
<?php $template->the_action_template_message( 'profile' ); ?>
<?php $template->the_errors(); ?>
<form class="form" method="post" action="#">
    	<?php wp_nonce_field( 'update-user_' . $current_user->ID ) ?>
		<input type="hidden" name="from" value="profile" />
		<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />

		<?php if ( !$theme_my_login->options->get_option( array( 'themed_profiles', $user_role, 'restrict_admin' ) ) && !has_action( 'personal_options' ) ): ?>

		<?php endif; // restrict admin ?>

		<?php do_action( 'profile_personal_options', $profileuser ); ?>

        <fieldset>
            <div class="general-title clearfix">
                <h2>Profile <span>Info</span></h2>
            </div>
            <div class="f-row">
                <label for="namePublicly">Display name publicly as</label>
                <div class="f-input">
                    <input id="namePublicly" type="text" value="<?php echo esc_attr( $profileuser->display_name ); ?>" />
                </div>
            </div>
            <div class="f-row">
                <label for="fName">First name</label>
                <div class="f-input">
                    <input  name="first_name" id="first_name" value="<?php echo esc_attr( $profileuser->first_name ) ?>" type="text" />
                </div>
            </div>
            <div class="f-row">
                <label for="lName">Last name</label>
                <div class="f-input">
                    <input name="last_name" id="last_name" value="<?php echo esc_attr( $profileuser->last_name ) ?>" type="text" />
                </div>
            </div>
            <div class="f-row">
                <label for="age">Age</label>
                <div class="f-input">
                    <input name="age" id="age<?php $template->the_instance(); ?>" value="<?php echo $age; ?>" class="input-short" type="text" />
                </div>
            </div>
            <div class="f-row">
                <label for="address1<?php $template->the_instance(); ?>">Address 1</label>
                <div class="f-input">
                    <input name="address1" id="address1<?php $template->the_instance(); ?>" value="<?php echo $address1; ?>"  type="text" />
                </div>
            </div>
            <div class="f-row">
                <label for="address2<?php $template->the_instance(); ?>">Address 2</label>
                <div class="f-input">
                    <input name="address2" id="address2<?php $template->the_instance(); ?>" value="<?php echo $address2; ?>"  type="text" />
                </div>
            </div>
            <div class="f-row">
                <label for="city<?php $template->the_instance(); ?>">City</label>
                <div class="f-input">
                    <input name="city" id="city<?php $template->the_instance(); ?>" value="<?php echo $city; ?>" type="text" />
                    <div class="form-note">Only your city and state will be shown as your hometown</div>
                </div>
            </div>
            <div class="f-row">
                <label for="state<?php $template->the_instance(); ?>">State</label>
                <div class="f-input">
                    <input name="state" id="state<?php $template->the_instance(); ?>" value="<?php echo $state; ?>" class="input-short" type="text" />
                    <div class="row-item">
                        <label for="zip<?php $template->the_instance(); ?>">ZIP</label>
                        <input name="zip" id="zip<?php $template->the_instance(); ?>" value="<?php echo $zip; ?>" class="input-short" type="text" />
                    </div>
                </div>
            </div>
            <div class="f-row">
                <label for="email">E-mail</label>
                <div class="f-input">
                    <input name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ) ?>" type="text" />
                    <span class="required">*</span>
                </div>

            </div>
            <!--<div class="f-row">
                <label for="twitter"> Twitter</label>
                <div class="f-input">
                    <input name="twitter" id="twitter" value="<?php echo esc_attr( $profileuser->$name ) ?>" type="text" />
                </div>
            </div>-->
            <?php
			$show_password_fields = apply_filters( 'show_password_fields', true, $profileuser );
			if ( $show_password_fields ) :
			?>
            <div class="f-row">
                <label for="pass1"><?php _e( 'New Password', 'theme-my-login' ); ?></label>
                <div class="f-input">
                    <input type="password" name="pass1" id="pass1" value="" autocomplete="off" />
                    <div class="form-note">If you would like to change the password type a new one. Otherwise leave this blank.</div>
                </div>
            </div>
            <div class="f-row">
                <label for="pass2">Repeat New Password</label>
                <div class="f-input">
                    <input type="password" name="pass2" id="pass2" value="" autocomplete="off" />
                </div>
            </div>

            <?php endif; ?>

            <div class="f-row checkbox">


                <input type="checkbox" name="send_community_updates" id="send_community_updates" value="1" <?php echo $send_community_updates_checked; ?> >
                <label for="send_community_updates" class="checkbox-label">Send Me Community Updates</label>
            </div>
            <div class="f-row checkbox">

                <input type="checkbox" name="send_offers" id="send_offers" value="1" <?php echo $send_offers_checked; ?>>
                <label for="send_offers" class="checkbox-label">Send Me Special Offers</label>


            </div>


            <?php do_action( 'show_user_profile', $profileuser ); ?>
           <!-- <?php if ( count( $profileuser->caps ) > count( $profileuser->roles ) && apply_filters( 'additional_capabilities_display', true, $profileuser ) ) { ?>
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
		<?php } ?>-->
            <div class="f-row single-row">
            	<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
                <span class="btn-red"><input type="submit" value="<?php esc_attr_e( 'Update Profile', 'theme-my-login' ); ?>" name="submit" /></span>
            </div>
        </fieldset>
    </form>
