<?php
function edit_contactmethods( $contactmethods ) {
 $contactmethods['user-city'] = 'City'; 

   unset($contactmethods['yim']);
   unset($contactmethods['aim']);
   unset($contactmethods['jabber']);


 return $contactmethods;
 }
 add_filter('user_contactmethods','edit_contactmethods',10,1);