<?php
/**
 * Subscribe Forum
 */
?>

<!-- Magazine sign up  --> 
<div class="block subscribe-form-block" id="store"> 
<div class="mag-cover"><a href="<?php print get_option("subs_link");?>"><img src='/wp-content/themes/infisherman/images/pic/journals.png'></a> </div>
<h2 class="title stag-bold">Save Over 70% off the Cover Price</h2> 
    <div class="content"> 
        <div class="subscribeAdMod"> 
            <div class="subscribeAdModContent"> 
                <form method="GET" action="<?php print get_option("subs_form_link"); ?>/?pkey=<?php print get_option('i4ky', 'IBZE')?>" target="_blank">
                    <input type="hidden" name="i4Ky" value="<?php print get_option('i4ky', 'IBZN')?>" />
                    <input type="hidden" name="pkey" value="<?php print get_option('i4ky', 'IBZN')?>" />
                    <input type="hidden" name="iMagId" value="<?php print get_option('iMagId')?>" />
                    <div class="subscribe-row"> 
                        <span class="text">First Name</span> 
                        <input type="text" class="form-text" name="firstname"/> 
                    </div> 
                    <div class="subscribe-row"> 
                        <span class="text">Last Name</span> 
                        <input type="text" class="form-text" name="lastname"/> 
                    </div> 
                    <div class="subscribe-row"> 
                        <span class="text">Address 1</span> 
                        <input type="text" class="form-text" name="address"/> 
                    </div> 
                    <div class="subscribe-row"> 
                        <span class="text">Address 2</span> 
                        <input type="text" class="form-text" name="address2"/> 
                    </div> 
                    <div class="subscribe-row"> 
                        <span class="text">City</span> 
                        <input type="text" class="form-text" name="city"/> 
                    </div> 

                    <div class="subscribe-row"> 
                        <span class="text state">State</span> 
                        <select id="stateDropDown" name="ship_state"> 
                        <option value="1" >Alabama</option><option value="2" >Alaska</option><option value="52" >Alberta</option><option value="66" >APO/AFP Americas</option><option value="67" >APO/FPO Europe </option><option value="68" >APO/FPO Pacific</option><option value="3" >Arizona</option><option value="4" >Arkansas</option><option value="53" >British Columbia</option><option value="5" >California</option><option value="6" >Colorado</option><option value="7" >Connecticut</option><option value="8" >Delaware</option><option value="9" >District of Columbia</option><option value="10" >Florida</option><option value="11" >Georgia</option><option value="12" >Hawaii</option><option value="13" >Idaho</option><option value="14" >Illinois</option><option value="15" >Indiana</option><option value="16" >Iowa</option><option value="17" >Kansas</option><option value="18" >Kentucky</option><option value="19" >Louisiana</option><option value="20" >Maine</option><option value="54" >Manitoba</option><option value="21" >Maryland</option><option value="22" >Massachusetts</option><option value="23" >Michigan</option><option value="24" >Minnesota</option><option value="25" >Mississippi</option><option value="26" >Missouri</option><option value="27" >Montana</option><option value="28" >Nebraska</option><option value="29" >Nevada</option><option value="55" >New Brunswick</option><option value="30" >New Hampshire</option><option value="31" >New Jersey</option><option value="32" >New Mexico</option><option value="33" >New York</option><option value="56" >Newfoundland</option><option value="34" >North Carolina</option><option value="35" >North Dakota</option><option value="57" >Northwest Territory</option><option value="58" >Nova Scotia</option><option value="65" >Nunavut</option><option value="36" >Ohio</option><option value="37" >Oklahoma</option><option value="59" >Ontario</option><option value="38" >Oregon</option><option value="39" >Pennsylvania</option><option value="60" >Prince Edward</option><option value="64" >Puerto Rico</option><option value="61" >Quebec</option><option value="40" >Rhode Island</option><option value="62" >Saskatchewan</option><option value="41" >South Carolina</option><option value="42" >South Dakota</option><option value="43" >Tennessee</option><option value="44" >Texas</option><option value="45" >Utah</option><option value="46" >Vermont</option><option value="47" >Virginia</option><option value="48" >Washington</option><option value="49" >West Virginia</option><option value="50" >Wisconsin</option><option value="51" >Wyoming</option><option value="63" >Yukon</option>
                        </select>  
                        <span class="text zip">Zip</span> 
                        <input type="hidden" name="ship_country" value="US">
                        <input type="text" class="zipCode form-text" name="zip" /> 
                    </div> 

                    <div class="subscribe-row"> 
                        <span class="text">Email</span> 
                        <input type="text" class="form-text" name="our_email"/> 
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
