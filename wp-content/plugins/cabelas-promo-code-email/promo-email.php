<?php
/*
 * Plugin Name: Cabela's Promo Code Email
 * Plugin URI: http://github.com/imoutdoors
 * Description: Generates emails whenever someone enters the Cabela's IIYN father's day contest
 * Version: 0.1
 * Author: Aaron Baker
 * Author URI: http://imomags.com
*/

include 'postmark.php';
include 'Barcode39.php';



 add_action("gform_post_submission", "send_cabelas_email", 10, 2);



 function send_cabelas_email($entry,$form) {


 	$formID = $form["id"];

 	//If we are reciving data from the IIYN father's day form
 	if ($formID == 32) {


	 	$entryEmail = $entry["2"];
	 	$entryName = $entry["1.3"];

	 	$entryFullName = $entry["1.3"] . " " . $entry["1.6"];
	 	$firstLastInitial = $entry["1.3"]. " " .substr($entry["1.6"], 0,1);
	 	
	 	$postID = $entry['post_id'];

	 	add_post_meta($postID,"cabelas_entry_full_name",$firstLastInitial);

	 	$subject = "Your Cabela's $20 Off Coupon";


	 	$html = generateEmailHTML($subject, $entryName, $entryEmail);




	 	$postmark = new Postmark("2338c32a-e4b3-4a36-a6a6-6ff501f4f614","no-reply@gameandfishmag.com");

	 	$result = $postmark->to($entryEmail)
			->subject($subject)
			->html_message($html)
			->send();

		if ($result === true) {
			_log("message sent");
		}


 	}




 }

function generateBarCodeAndGetURL($code) {
	// set object



	$bc = new Barcode39($code);

	$filepath = "/data/wordpress/imomags/wp-content/cache/barcode/" . $code . ".gif";




	// set barcode bar thickness (thick bars)
	$bc->barcode_bar_thick = 2;

	// set barcode bar thickness (thin bars)
	$bc->barcode_bar_thin = 1;

	$bc->barcode_width = 235;
	$bc->barcode_use_dynamic_width = false;
	$bc->barcode_text = false;

	// save barcode GIF file
	$bc->draw($filepath);

	$url = "http://www.gameandfishmag.com/wp-content/cache/barcode/" . $code . ".gif";



	return $url;
}

function generateEmailHTML($subject,$entryName,$entryEmail) {

	$codeObject = getUniqueCodeForEmail($entryEmail);

	$code = $codeObject->cabbuck . $codeObject->seccode;
	$cabbuck = $codeObject->cabbuck;
	$seccode = $codeObject->seccode;

	$barcodeURL = generateBarCodeAndGetURL($code);

$HTML = <<< EEE87fhhiuasdf

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
<head style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
<!-- If you delete this tag, the sky will fall on your head -->
<meta name="viewport" content="width=device-width" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
<title style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">$subject</title>



</head>

<body bgcolor="#ffffff" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;height: 100%;width: 100%;">


<!-- HEADER -->
<table class="head-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
<div align="center" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
<img src="http://media.imoutdoors.com/IIYN-coupon-email/IIYN-header-image.jpg" style="margin: 0;padding: 0;border:0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 100%;">
</div>

</table><!-- /HEADER -->


<!-- BODY -->
<div class="green-bg padding" style="margin: 0;padding: 10px 10px 20px 10px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;background-image: url(file:///Users/kayla.pfaff/Desktop/IIYN_green_parchment-strip.jpg);background-repeat: repeat;">
<table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
	<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
		<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
		<td class="container" bgcolor="#ffffff" style="margin: 0 auto;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;display: block;max-width: 600px;clear: both;">

			<div class="content" style="margin: 0 auto;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 600px;display: block;">
			<table style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
				<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
					<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">

						<h3 align="center" style="margin: 0;padding: 0;font-family: &quot;HelveticaNeue-Light&quot;, &quot;Helvetica Neue Light&quot;, &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;line-height: 1.1;margin-bottom: 15px;color: #113d22;font-weight: 500;font-size: 27px;"><strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">Hi, $entryName. Thank you for entering!</strong></h3>

<!-- Callout Panel -->

<p class="callout" align="center" style="margin: 0;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 15px;font-weight: normal;font-size: 14px;line-height: 1.6;background-color: #f3f3f3;">
			Please enjoy this coupon for $20 off your next $150 purchase! <br><a href="http://www.cabelas.com" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #52a2bc;font-weight: bold;">Shop Now! &raquo;</a>
						</p>
<!-- /Callout Panel -->
						<p class="lead" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 17px;line-height: 1.6;"></p>
						<div class="coupon-box" style="margin: 0;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;border: 1px dashed #333d35;margin-bottom: 20px;text-align:center">
						<!-- A Real Hero (and a real human being) -->
						<p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">


							<table border=0 style="width:100%"><tr><td style="font-size: 22px;text-align:left;padding-left:20px">  Cabela's # $cabbuck<td><td style="text-align:right;font-size: 22px;font-weight:bold">$20 of $150</td><tr></table>

							<img src="$barcodeURL" style="padding-top:10px;">
							<p style="font-size: 22px;text-align:left;padding-left:20px;margin-top:10px;">Cabela's Buck Code: $seccode</p>

						</p><!-- /hero -->
						</div>





						<!-- social & contact -->

						<table class="social" width="100%" style="margin: 0;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;background-color: #f1f1eb;width: 100%;">
							<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
								<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">



									<!--- leagal stuff -->




												<p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">Offer Expires July 2, 2013.  This offer is valid on Cabela's catalog, Internet and U.S. Store merchandise only.   This offer is not valid on the purchase of Gift Certificates, Gift Cards or licenses.  This offer has no cash value and is not transferable.  Offer cannot be used on prior purchases.  No change will be given.  In the event of a return or exchange, refund amount will be less any discount applied to original purchase.  Not available to Cabela's employees.  Offer cannot be used in combination with any other promotion, rebate or previous offer.  This offer may be used only once. Cabela's reserves the right to exclude certain products from this promotion.</p>

							<!-- legal stuff -->

									<span class="clear" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;display: block;clear: both;"></span>

								</td>
							</tr>
						</table>
					<!-- /social & contact -->





			</td></tr></table></div>

		</td>
		<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
	</tr>
</table><!-- /BODY -->


<!-- FOOTER -->
<table class="footer-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;clear: both;">
	<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
		<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
		<td class="container" style="margin: 0 auto;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;display: block;max-width: 600px;clear: both;">

				<!-- content -->
				<div class="content" style="margin: 0 auto;padding: 15px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;max-width: 600px;display: block;">
				<table style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;width: 100%;">
				<tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
					<td align="center" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;">
						<p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;margin-bottom: 10px;font-weight: normal;font-size: 14px;line-height: 1.6;">
							<a href="http://www.imoutdoorsmedia.com/IM3/privacy.php" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;color: #2BA6CB;">Privacy Policy</a>
						</p>
					</td>
				</tr>
			</table>
				</div><!-- /content -->

		</td>
		<td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;"></td>
	</tr>
</table><!-- /FOOTER -->
</div>
</body>
</html>




EEE87fhhiuasdf;

return $HTML;

}



function getUniqueCodeForEmail($email) {
	global $wpdb;

	$sql = $wpdb->prepare("INSERT INTO cabelas_promo_codes_used (email) values (%s)" , $email);
	$wpdb->query( $sql );

	$insertID = $wpdb->insert_id;

	$sql = $wpdb->prepare("SELECT * from cabelas_promo_codes WHERE id = %s",$insertID);

	$codeObject = $wpdb->get_row( $sql );

	$sql = $wpdb->prepare("UPDATE cabelas_promo_codes_used SET promoid = %s, cabbuck = %d, seccode = %s WHERE id = %d",
		$codeObject->promoid,$codeObject->cabbuck,$codeObject->seccode,$insertID);
	$wpdb->query( $sql );

	$sql = $wpdb->prepare("UPDATE cabelas_promo_codes SET valid = 0 WHERE id = %d",$insertID);
	$wpdb->query( $sql );

	return $codeObject;


}



