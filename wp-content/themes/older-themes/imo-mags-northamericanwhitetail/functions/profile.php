<?php
function edit_contactmethods( $contactmethods ) {
 $contactmethods['twitter'] = 'Twitter';

   unset($contactmethods['yim']);
   unset($contactmethods['aim']);
   unset($contactmethods['jabber']);


 return $contactmethods;
 }
 add_filter('user_contactmethods','edit_contactmethods',10,1);


function imo_user_profile( $user_id ) {



	if ( !empty( $_POST['age'] ) )
		update_user_meta( $user_id, 'age', $_POST['age'] );

	if ( !empty( $_POST['address1'] ) )
		update_user_meta( $user_id, 'address1', $_POST['address1'] );
	if ( !empty( $_POST['address2'] ) )
		update_user_meta( $user_id, 'address2', $_POST['address2'] );
	if ( !empty( $_POST['city'] ) )
		update_user_meta( $user_id, 'city', $_POST['city'] );
	if ( !empty( $_POST['state'] ) )
		update_user_meta( $user_id, 'state', $_POST['state'] );
	if ( !empty( $_POST['zip'] ) )
		update_user_meta( $user_id, 'zip', $_POST['zip'] );

    if ( !empty( $_POST['send_community_updates'] ) )
        update_user_meta( $user_id, 'send_community_updates', $_POST['send_community_updates'] );
    else
        update_user_meta( $user_id, 'send_community_updates', 0 );
    if ( !empty( $_POST['send_offers'] ) )
        update_user_meta( $user_id, 'send_offers', $_POST['send_offers'] );
    else
        update_user_meta( $user_id, 'send_offers', 0 );


}
add_action( 'edit_user_profile_update', 'imo_user_profile' );
add_action( 'edit_user_profile', 'imo_user_profile' );
add_action( 'personal_options_update', 'imo_user_profile' );