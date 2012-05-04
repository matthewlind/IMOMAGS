<?php
/*
Plugin Name: SV Ad Widget
Plugin URI: http://www.sportsmenvote.com
Description: Creates a widget a dynamic ad for SportsmenVote
Version: 1.0
Author: Aaron Baker
Author URI: http://imomags.com
*/

include("widget.php");

function SVAdInit() {



}

add_action("init",SVAdInit,12);