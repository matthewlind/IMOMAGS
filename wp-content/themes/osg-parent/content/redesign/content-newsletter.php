<div class="newsletter">
	<?php
	$formID = get_option('newsletter_id');

	$url = "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
    $errorcode = $_GET["errorcode"];
    $errorcontrol = $_GET["errorControl"];

    switch($errorcode) {

        case "1" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
        case "2" : $strError = "The list provided does not exist."; break;
        case "3" : $strError = "Information was not provided for a mandatory field. (".$errorcontrol.")"; break;
        case "4" : $strError = "Please provide an email address.".$errorcontrol; break;
        case "5" : $strError = "Information provided is not unique. (".$errorcontrol.")"; break;
        case "6" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
        case "7" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
        case "8" : $strError = "Subscriber already exists."; break;
        case "9" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
        case "10" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
          //case "11" : This error does not exist.
        case "12" : $strError = "The subscriber you are attempting to insert is on the master unsubscribe list or the global unsubscribe list."; break;
        default : $strError = "Other"; break;
          //case "13" : Check that the list ID and/or MID specified in your code is correct.
	}
	?>
	<form action="http://cl.exct.net/subscribe.aspx?lid=<?php echo $formID; ?>" name="subscribeForm" method="post">
		<input type="hidden" name="thx" value="<?php echo $url; ?>#subscribe-success" />
		<input type="hidden" name="err" value="<?php echo $url; ?>" />
		<input type="hidden" name="MID" value="6283180" />
		<fieldset>
			<input alt="Email Address" type="text" name="Email Address" size="25" maxlength="100" value="" placeholder="Enter Your Email..." >
	        <!--<input alt="Third Party" type="checkbox" checked="checked" value="22697" name="interests" id="receive" />
	        <input type="hidden" name="OptoutInfo" value="">
	        <div class="opt-in">Yes, I'd like to receive offers from your partners</div>-->
			<input type="submit" value="Sign Up" style="margin-left: 20px;" />
		</fieldset>
	</form>
	<script type="text/javascript">
		var querystring = window.location.search.substring(1);
		var vars = querystring.split('&');
		var subsSuccess = window.location.hash.substr(1)

		if(subsSuccess == "subscribe-success"){
			alert('Thank you for subscribing to the <?php echo SITE_NAME; ?> Newsletter.');
		}
		else if(vars[0] == "errorcode=1" || vars[0] == "errorcode=2" || vars[0] == "errorcode=3" || vars[0] == "errorcode=4" || vars[0] == "errorcode=5" || vars[0] == "errorcode=6" || vars[0] == "errorcode=7" || vars[0] == "errorcode=8" || vars[0] == "errorcode=9" || vars[0] == "errorcode=10" || vars[0] == "errorcode=12"){
			alert('<?php echo $strError; ?>');
		}	
	</script>
</div>