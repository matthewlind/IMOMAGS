<?php

function generateEmailSubject($emailData){
	$subject = "Whitetail Community Update";
	$commentCount = $emailData['highest_comment_count'];
	
	$featuredEventCommentCount = $emailData['featured_event_comment_count'];

	
	if ($commentCount > 0) {
		
		$otherCount = $featuredEventCommentCount - 1;
		
		$subject = $emailData['featured_event']->event_display_name . " and $otherCount Others Commented On " . $emailData['featured_event']->post_title;
		
		if ($featuredEventCommentCount == 1) {
			$subject = $emailData['featured_event']->event_display_name . " Commented On " . $emailData['featured_event']->post_title;
		}
		if ($featuredEventCommentCount == 2) {
			$subject = $emailData['featured_event']->event_display_name . " and Another Commented On " . $emailData['featured_event']->post_title;
		}		
		
	} else {//If there are no comments
	
		$shareCount = $emailData['featured_shared_event_count'];
	
		$subject = $emailData['featured_shared_event']->post_title . " was shared $shareCount times";
		
		
		
	}

	
	
/*
	echo "<pre>";
	print_r($emailData);
	echo "</pre>";
*/
		
	
	
	return $subject;
}

function generateEmailHTML($emailData) {
	
//echo json_encode($emailData);	

$display_name = $emailData['display_name'];
$user_score = $emailData['user_score'];

$templateHeader = <<<EOFEOFEOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">
  <head>
<!-- If you delete this meta tag, the ground will open and swallow you. -->
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>NAW Community</title>


<style type="text/css">
/* ------------------------------------- 
		GLOBAL 
------------------------------------- */
* { 
	margin:0;
	padding:0;
}
* { font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }

img { 
	max-width: 100%; 
}
.collapse {
	margin:0;
	padding:0;
}
body {
	-webkit-font-smoothing:antialiased; 
	-webkit-text-size-adjust:none; 
	width: 100%!important; 
	height: 100%;
}


/* ------------------------------------- 
		ELEMENTS 
------------------------------------- */


.btn {
	text-decoration:none;
	color: #FFF;
	background-color: #c22d26;
	padding:10px 16px;
	font-weight:bold;
	margin-right:10px;
	text-align:center;
	cursor:pointer;
	display: inline-block;
	font-size:14px;
}

p.callout {
	padding:15px;
	background-color:#ECF8FF;
	margin-bottom: 15px;
}
.callout a {
	font-weight:bold;
	color: #2BA6CB;
}

table.social {
/* 	padding:15px; */
	background-color: #ebebeb;
	
}
.social .soc-btn {
	padding: 3px 7px;
	font-size:12px;
	margin-bottom:10px;
	text-decoration:none;
	color: #FFF;font-weight:bold;
	display:block;
	text-align:center;
}
a.fb { background-color: #3B5998!important; }
a.tw { background-color: #1daced!important; }
a.gp { background-color: #DB4A39!important; }
a.ms { background-color: #000!important; }

.sidebar .soc-btn { 
	display:block;
	width:100%;
}

/* ------------------------------------- 
		HEADER 
------------------------------------- */
table.head-wrap { width: 100%;}

.header.container table td.logo { padding: 15px; }
.header.container table td.label { padding: 15px; padding-left:0px;}


/* ------------------------------------- 
		BODY 
------------------------------------- */
table.body-wrap { width: 100%;}


/* ------------------------------------- 
		FOOTER 
------------------------------------- */
table.footer-wrap { width: 100%;	clear:both!important;
}
.footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
.footer-wrap .container td.content p {
	font-size:10px;
	font-weight: bold;
	
}


/* ------------------------------------- 
		TYPOGRAPHY 
------------------------------------- */
h1,h2,h3,h4,h5,h6 {
font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
}

h1 a,h2 a,h3 a,h4 a,h5 a,h6 a {
font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
}

h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

h1 { font-weight:200; font-size: 44px;}
h2 { font-weight:200; font-size: 37px;}
h3 { font-weight:500; font-size: 27px;}
h4 { font-weight:500; font-size: 23px;}
h5 { font-weight:900; font-size: 17px;}
h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}

.collapse { margin:0!important;}

p, ul { 
	margin-bottom: 10px; 
	font-weight: normal; 
	font-size:14px; 
	line-height:1.6;
}
p.lead { font-size:17px; }
p.last { margin-bottom:0px;}

ul li {
	margin-left:5px;
	list-style-position: inside;
}

/* ------------------------------------- 
		SIDEBAR 
------------------------------------- */
ul.sidebar {
	background:#ebebeb;
	display:block;
	list-style-type: none;
}
ul.sidebar li { display: block; margin:0;}
ul.sidebar li a {
	text-decoration:none;
	color: #666;
	padding:10px 16px;
/* 	font-weight:bold; */
	margin-right:10px;
/* 	text-align:center; */
	cursor:pointer;
	border-bottom: 1px solid #777777;
	border-top: 1px solid #FFFFFF;
	display:block;
	margin:0;
}
ul.sidebar li a.last { border-bottom-width:0px;}
ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}



/* --------------------------------------------------- 
		RESPONSIVENESS
		Nuke it from orbit. It's the only way to be sure. 
------------------------------------------------------ */

/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
	display:block!important;
	max-width:600px!important;
	margin:0 auto!important; /* makes it centered */
	clear:both!important;
}

/* This should also be a block element, so that it will fill 100% of the .container */
.content {
	padding:15px;
	max-width:600px;
	margin:0 auto;
	display:block; 
}

/* Let's make sure tables in the content area are 100% wide */
.content table { width: 100%; }


/* Odds and ends */
.column {
	width: 300px;
	float:left;
}
.column tr td { padding: 15px; }
.column-wrap { 
	padding:0!important; 
	margin:0 auto; 
	max-width:600px!important;
}
.column table { width:100%;}
.social .column {
	width: 280px;
	min-width: 279px;
	float:left;
}

/* Be sure to place a .clear element after each set of columns, just to be safe */
.clear { display: block; clear: both; }


/* ------------------------------------------- 
		PHONE
		For clients that support media queries.
		Nothing fancy. 
-------------------------------------------- */
@media only screen and (max-width: 600px) {
	
	a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

	div[class="column"] { width: auto!important; float:none!important;}
	
	table.social div[class="column"] {
		width:auto!important;
	}

}

/* ------------------------------------------- 
		IMO DESIGN
-------------------------------------------- */

img.avatar {
	vertical-align: middle;
	margin-right:5px;
	float:left;
}

h4 {
	/* line-height: 39px; */
	margin-bottom:0px;

}

.btn { 
	margin-top:10px;
}

.title-section {
	padding-bottom:0px;
}

.share-message {
	margin-left: 30px;
}


p.light-gray {
	color:#aaaaaa;
}



</style>

  </head>
  <body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">&#13;
&#13;
<!-- HEADER -->&#13;
<table class="head-wrap" bgcolor="#dddddd" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; width: 100%; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"></td>&#13;
		<td class="header container" align="" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; display: block !important; max-width: 600px !important; clear: both !important; margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">&#13;
			&#13;
			<!-- /content -->&#13;
			<div class="content" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; max-width: 600px; display: block; margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto; padding-top: 15px; padding-right: 15px; padding-bottom: 15px; padding-left: 15px;">&#13;
				<table bgcolor="#dddddd" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; width: 100%; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><img src="http://media.imoutdoors.com/northamericanwhitetail/community/logo4.png" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; max-width: 100%; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;" alt="Whitetail Community Update"/></td>&#13;
						<td align="right" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><h5 class="collapse" style="font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif; line-height: 1.1; color: #000; font-weight: 900; font-size: 17px; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"></h5></td>&#13;
					</tr></table></div><!-- /content -->&#13;
			&#13;
		</td>&#13;
		<td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"></td>&#13;
	</tr></table><!-- /HEADER --><!-- BODY --><table class="body-wrap" bgcolor="" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; width: 100%; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"></td>&#13;
		<td class="container" align="" bgcolor="#FFFFFF" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; display: block !important; max-width: 600px !important; clear: both !important; margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">&#13;
			&#13;
			<!-- content -->&#13;
			<div class="content title-section" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; max-width: 600px; display: block; margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto; padding-top: 15px; padding-right: 15px; padding-bottom: 0px; padding-left: 15px;">&#13;
				<table style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; width: 100%; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">&#13;
							&#13;
							<h1 style="font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif; line-height: 1.1; color: #000; font-weight: 200; font-size: 36px; margin-top: 0; margin-right: 0; margin-bottom: 15px; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">Hello $display_name!</h1>&#13;
							<p class="lead" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-weight: normal; font-size: 17px; line-height: 1.6; margin-top: 0; margin-right: 0; margin-bottom: 10px; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">Your posts on the <b style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">North American Whitetail Community</b> are popular! You now have <b style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">$user_score</b> points.</p>&#13;
	&#13;
						</td>&#13;
					</tr></table></div><!-- /content -->&#13;
			&#13;
			
EOFEOFEOF;


foreach ($emailData['posts'] as $post) {

$post_title = $post['post_title'];
$post_img_url = $post['post_img_url'];
$post_type = $post['post_type'];
$post_url = $post['post_url'];

$post_score = $post['post_score'];
$post_score_string = ($post_score == 1 ? "$post_score Point" : "$post_score Points");

$post_comment_count = $post['post_comment_count'];
$post_comment_string = ($post_comment_count == 1? "has $post_comment_count comment" : "has $post_comment_count comments");



$post_image_tag = "";

if (!empty($post_img_url)) {

$post_image_tag = <<<EOFEOFEOFGG

<img src="$post_img_url" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; max-width: 75px; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;" />


EOFEOFEOFGG;
}

$templateContentTop = <<<EOFEOFEOFGG


<!-- content -->&#13;
			<div class="content" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; max-width: 600px; display: block; margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto; padding-top: 15px; padding-right: 15px; padding-bottom: 15px; padding-left: 15px;">&#13;
				&#13;
				<table bgcolor="#ffffff" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; width: 100%; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><td class="small" width="20%" style="vertical-align: top; text-align: center; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 10px; padding-bottom: 0; padding-left: 0;" align="center" valign="top">&#13;
							<a href="$post_url">$post_image_tag</a><p class="light-gray" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-weight: normal; font-size: 14px; line-height: 1.6; color: #aaaaaa; margin-top: 0; margin-right: 0; margin-bottom: 10px; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><small style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">$post_score_string</small></p>&#13;
						</td>&#13;
						<td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">&#13;
							<h4 style="font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif; line-height: 1.1; color: #000; font-weight: 500; font-size: 23px; margin-top: 0; margin-right: 0; margin-bottom: 0px; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><a href="$post_url" style="color:#000000;text-decoration:none;font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;">$post_title</a><small style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"></small></h4><p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-weight: normal; font-size: 14px; line-height: 1.6; margin-top: 0; margin-right: 0; margin-bottom: 10px; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">$post_comment_string</p>&#13;
							
EOFEOFEOFGG;

$shareCount = 0;
$commentCount = 0;
$templateContentMiddle = "";
foreach ($post['events'] as $event) {

	
	$profileURL = "http://www.northamericanwhitetail.com/profile/" . $event->event_username;
	if ($event->event_type == 'share')
		$shareCount++;
	
	if ($event->event_type == "comment") {
		
		$commentCount++;
		$templateContentMiddle .= <<<EOFEOFEOFSS
		
		
<p class="" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-weight: normal; font-size: 14px; line-height: 1.6; margin-top: 0; margin-right: 0; margin-bottom: 10px; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"> &#13;
								&#13;
								<a href="$profileURL"><img src="http://www.northamericanwhitetail.com/avatar?uid=$event->uid" class="avatar" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; max-width: 100%; vertical-align: middle; float: left; margin-top: 0; margin-right: 5px; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;" align="left" height=25 width=25 /></a><b style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><a href="$profileURL" style="text-decoration:none;color:#000000;">$event->event_display_name</a></b><br style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;" /><small style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">commented $event->time_ago_string</small>&#13;
							</p>&#13;
							
EOFEOFEOFSS;


	}
	
}


if ($commentCount > 0) {
	$shareMargin = "30px";
	$goButtonText = "Join the Conversation";
}
else {
	$shareMargin = "0px";	
	$goButtonText = "Check it Out";
}

if ($shareCount>0) {

	if ($shareCount == 1)
		$shareCountText = "1 Person";
	else
		$shareCountText = "$shareCount People";

	
	$templateContentMiddle .= <<<EOFEOFEOFSS


							
							<p class="share-message" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-weight: normal; font-size: 14px; line-height: 1.6; margin-top: 0; margin-right: 0; margin-bottom: 10px; margin-left: $shareMargin; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"> &#13;
								&#13;
								<b style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">$shareCountText</b><br style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;" /><small style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">shared your post</small>&#13;
							</p>&#13;

							
EOFEOFEOFSS;

	
}







$templateContentBottom = <<<EOFEOFEOFD

							
							<a href="$post_url" class="btn" style="margin: 0;padding: 10px 16px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #FFF;text-decoration: none;background-color: #c22d26;font-weight: bold;margin-right: 10px;text-align: center;cursor: pointer;display: inline-block;margin-top: 10px;font-size:14px;">$goButtonText »</a>&#13;
						</td>&#13;
					</tr></table></div>&#13;
			<!-- /content -->&#13;
EOFEOFEOFD;



$templateContent .= $templateContentTop . $templateContentMiddle . $templateContentBottom;	
}

		
			
$templateFooter = <<<EOFEOFEOFS

			<!-- content -->&#13;
			<div class="content title-section" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; max-width: 600px; display: block; margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto; padding-top: 15px; padding-right: 15px; padding-bottom: 0px; padding-left: 15px;">&#13;
				<table style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; width: 100%; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">&#13;
							&#13;
					&#13;
							<p class="lead" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-weight: normal; font-size: 17px; line-height: 1.6; margin-top: 0; margin-right: 0; margin-bottom: 10px; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><b style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">Thanks for Posting!<b style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"></b></b></p>&#13;
	&#13;
						</td>&#13;
					</tr></table></div><!-- /content -->&#13;
&#13;
		</td>&#13;
		<td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"></td>&#13;
	</tr></table><!-- /BODY --><!-- FOOTER --><table class="footer-wrap" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; width: 100%; clear: both !important; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"></td>&#13;
		<td class="container" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; display: block !important; max-width: 600px !important; clear: both !important; margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">&#13;
			&#13;
				<!-- content -->&#13;
				<div class="content" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; max-width: 600px; display: block; margin-top: 0; margin-right: auto; margin-bottom: 0; margin-left: auto; padding-top: 15px; padding-right: 15px; padding-bottom: 15px; padding-left: 15px;">&#13;
					<table style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; width: 100%; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><td align="center" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">&#13;
								<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-weight: normal; font-size: 14px; line-height: 1.6; margin-top: 0; margin-right: 0; margin-bottom: 10px; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">&#13;
									<a href="#" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; color: #2BA6CB; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">Terms</a> |&#13;
									<a href="#" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; color: #2BA6CB; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">Privacy</a> |&#13;
									<a href="#" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; color: #2BA6CB; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"><unsubscribe style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;">Change Email Preferences</unsubscribe></a>&#13;
								</p>&#13;
							</td>&#13;
						</tr></table></div><!-- /content -->&#13;
				&#13;
		</td>&#13;
		<td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; margin-top: 0; margin-right: 0; margin-bottom: 0; margin-left: 0; padding-top: 0; padding-right: 0; padding-bottom: 0; padding-left: 0;"></td>&#13;
	</tr></table><!-- /FOOTER --></body>
</html>

EOFEOFEOFS;


return $templateHeader . $templateContent . $templateFooter;
}