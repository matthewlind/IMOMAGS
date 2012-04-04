<?php
/**
 * functions.php 
 */
 
 

define("JETPACK_SITE", "phunting");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0144V&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0144V&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0144V&i4Ky=IBZN");
define("SUBS_DEAL_STRING", "Save Over 80% off<br/> the Cover Price");
define("DRUPAL_SITE", TRUE);

function my_connection_types() {
	// Make sure the Posts 2 Posts plugin is active.
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;

	p2p_register_connection_type( array(
		'name' => 'columnists-to-columnistposts',
		'from' => 'columnists',
		'to' => 'columnistposts'
	) );
}
add_action( 'wp_loaded', 'my_connection_types' );
?>