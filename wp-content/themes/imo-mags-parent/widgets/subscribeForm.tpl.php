<?php
/**
 * Subscribe Forum
 */


    global $IMO_USER_STATE;

    $sportsmanStates = array("GA","MI","MN","WI","AR","TN","TX");

    $cover = get_option('magazine_cover_uri');

     if (in_array($IMO_USER_STATE, $sportsmanStates)) {
        $cover = get_option('magazine_cover_alt_uri');
    }
?>

<!-- Magazine sign up  -->
<div class="block subscribe-form-block" id="store">
<!-- <div class="subs-header"><h4><?php print get_option('headline_1'); ?></h4><h4><?php print get_option('headline_2'); ?></h4></div> -->
	<div class="subs-header"><h1><?php print get_option('headline_1'); ?></h1></div>
    <div class="content">
    	<div class="mag-cover">
    		<a href="<?php print get_option("subs_link");?>"><img src='<?php print $cover; ?>'></a>
			<div class="mag-copy"><?php print get_option('deal_copy' ); ?></div>
			<div class="now-ontablets">Now on Tablets!</div>
    	</div>
        <div class="subscribeAdMod">
            <div class="subscribeAdModContent">
                <?php $dartDomain = get_option("dart_domain", $default = false);
			    if($dartDomain == "imo.gunsandammo" || $dartDomain == "imo.in-fisherman" || $dartDomain == "imo.shotgunnews" || $dartDomain == "imo.shootingtimes"){ ?>
				    <form method="GET" action="<?php print get_option("subs_form_link"); ?>" target="_blank" onsubmit="_gaq.push(['_trackEvent', 'Subscribe', 'Location', 'Widget']);">
			    <?php }else{ ?>
					<form method="GET" action="<?php print get_option("subs_form_link"); ?>/?pkey=<?php print get_option('i4ky')?>" target="_blank" onsubmit="_gaq.push(['_trackEvent', 'Subscribe', 'Location', 'Widget']);">
			   <?php } ?>

                
                
                
                    <input type="hidden" name="pkey" value="<?php print get_option('i4ky')?>" />
                    <div class="subscribe-row">
                        <input type="text" class="form-text" name="firstname" placeholder="First Name" />
                    </div>
                    <div class="subscribe-row">
                        <input type="text" class="form-text" name="lastname" placeholder="Last Name" />
                    </div>
                    <div class="subscribe-row">
                        <input type="text" class="form-text" name="address" placeholder="Address" />
                    </div>
					<div class="subscribe-row">
                        <input type="text" class="form-text" name="address2" placeholder="Address 2" />
                    </div>
                    <div class="subscribe-row">
                        <input type="text" class="form-text" name="city" placeholder="City" />
                    </div>

                    <div class="subscribe-row">
                        <select id="stateDropDown" name="ship_state">
							<option value=""> State</option><option value="1" >Alabama</option><option value="2" >Alaska</option><option value="52" >Alberta</option><option value="66" >APO/AFP Americas</option><option value="67" >APO/FPO Europe </option><option value="68" >APO/FPO Pacific</option><option value="3" >Arizona</option><option value="4" >Arkansas</option><option value="53" >British Columbia</option><option value="5" >California</option><option value="6" >Colorado</option><option value="7" >Connecticut</option><option value="8" >Delaware</option><option value="9" >District of Columbia</option><option value="10" >Florida</option><option value="11" >Georgia</option><option value="12" >Hawaii</option><option value="13" >Idaho</option><option value="14" >Illinois</option><option value="15" >Indiana</option><option value="16" >Iowa</option><option value="17" >Kansas</option><option value="18" >Kentucky</option><option value="19" >Louisiana</option><option value="20" >Maine</option><option value="54" >Manitoba</option><option value="21" >Maryland</option><option value="22" >Massachusetts</option><option value="23" >Michigan</option><option value="24" >Minnesota</option><option value="25" >Mississippi</option><option value="26" >Missouri</option><option value="27" >Montana</option><option value="28" >Nebraska</option><option value="29" >Nevada</option><option value="55" >New Brunswick</option><option value="30" >New Hampshire</option><option value="31" >New Jersey</option><option value="32" >New Mexico</option><option value="33" >New York</option><option value="56" >Newfoundland</option><option value="34" >North Carolina</option><option value="35" >North Dakota</option><option value="57" >Northwest Territory</option><option value="58" >Nova Scotia</option><option value="65" >Nunavut</option><option value="36" >Ohio</option><option value="37" >Oklahoma</option><option value="59" >Ontario</option><option value="38" >Oregon</option><option value="39" >Pennsylvania</option><option value="60" >Prince Edward</option><option value="64" >Puerto Rico</option><option value="61" >Quebec</option><option value="40" >Rhode Island</option><option value="62" >Saskatchewan</option><option value="41" >South Carolina</option><option value="42" >South Dakota</option><option value="43" >Tennessee</option><option value="44" >Texas</option><option value="45" >Utah</option><option value="46" >Vermont</option><option value="47" >Virginia</option><option value="48" >Washington</option><option value="49" >West Virginia</option><option value="50" >Wisconsin</option><option value="51" >Wyoming</option><option value="63" >Yukon</option>
                        </select>
                        	<input type="hidden" name="ship_country" value="US" />
                        	<input type="text" class="zipCode form-text" name="zip" placeholder="Zip" />
                    </div>

                    <div class="subscribe-row">
                        <input type="text" class="form-text" name="our_email" placeholder="Email" />
                    </div>
                    <div class="subscribeButton btn-base">
                        <input type="submit" value="Subscribe" class="submit-button">
                    </div>
                </form>

                <div class="subscribeLinks"> <br clear="all" /> </div>
            </div>
        </div>
    </div>
</div>
