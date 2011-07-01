<?php
/**
 * Subscribe Forum
 */
?>

<!-- Magazine sign up  --> 
<div class="block subscribe-form-block" id="store"> 
<div class="mag-cover"><a href="<?php print get_option("subs_link");?>"><img src='<?php print get_option("magainze_cover_url", get_stylesheet_directory_uri(). "/img/magazine.png" ); ?>'></a> </div>
<h2 class="title"><?php print strip_tags(get_option("deal_copy"));?></h2> 
    <div class="content"> 
        <div class="subscribeAdMod"> 
            <div class="subscribeAdModContent"> 
                <form method="POST" action="https://secure.palmcoastd.com/pcd/eSv?iMagId=<?php print get_option('iMagId')?>&i4Ky=<?php print get_option('i4ky', 'IBZN')?>" target="_blank">
                    <input type="hidden" name="i4Ky" value="<?php print get_option('i4ky', 'IBZN')?>" />
                    <input type="hidden" name="iMagId" value="<?php print get_option('iMagId')?>" />
                    <div class="subscribe-row"> 
                        <span class="text">First Name</span> 
                        <input type="text" class="form-text" name="iOrdBillFName"/> 
                    </div> 
                    <div class="subscribe-row"> 
                        <span class="text">Last Name</span> 
                        <input type="text" class="form-text" name="iOrdBillLName"/> 
                    </div> 
                    <div class="subscribe-row"> 
                        <span class="text">Address 1</span> 
                        <input type="text" class="form-text" name="iOrdBillAddr1"/> 
                    </div> 
                    <div class="subscribe-row"> 
                        <span class="text">Address 2</span> 
                        <input type="text" class="form-text" name="iOrdBillAddr2"/> 
                    </div> 
                    <div class="subscribe-row"> 
                        <span class="text">City</span> 
                        <input type="text" class="form-text" name="iOrdBillCity"/> 
                    </div> 

                    <div class="subscribe-row"> 
                        <span class="text state">State</span> 
                        <select id="stateDropDown" name="iOrdBillState"> 
                            <option value="AL">AL</option> 
                            <option value="AK">AK</option> 
                            <option value="AZ">AZ</option> 
                            <option value="AR">AR</option> 
                            <option value="CA">CA</option> 
                            <option value="CO">CO</option> 
                            <option value="CT">CT</option> 
                            <option value="DE">DE</option> 
                            <option value="DC">DC</option> 
                            <option value="FL">FL</option> 
                            <option value="GA">GA</option> 
                            <option value="HI">HI</option> 
                            <option value="ID">ID</option> 
                            <option value="IL">IL</option> 
                            <option value="IN">IN</option> 
                            <option value="IA">IA</option> 
                            <option value="KS">KS</option> 
                            <option value="KY">KY</option> 
                            <option value="LA">LA</option> 
                            <option value="ME">ME</option> 
                            <option value="MD">MD</option> 
                            <option value="MA">MA</option> 
                            <option value="MI">MI</option> 
                            <option value="MN">MN</option> 
                            <option value="MS">MS</option> 
                            <option value="MO">MO</option> 
                            <option value="MT">MT</option> 
                            <option value="NE">NE</option> 
                            <option value="NV">NV</option> 
                            <option value="NH">NH</option> 
                            <option value="NJ">NJ</option> 
                            <option value="NM">NM</option> 
                            <option value="NY">NY</option> 
                            <option value="NC">NC</option> 
                            <option value="ND">ND</option> 
                            <option value="OH">OH</option> 
                            <option value="OK">OK</option> 
                            <option value="OR">OR</option> 
                            <option value="PA">PA</option> 
                            <option value="PR">PR</option> 
                            <option value="RI">RI</option> 
                            <option value="SC">SC</option> 
                            <option value="SD">SD</option> 
                            <option value="TN">TN</option> 
                            <option value="TX">TX</option> 
                            <option value="UT">UT</option> 
                            <option value="VT">VT</option> 
                            <option value="VI">VI</option> 
                            <option value="VA">VA</option> 
                            <option value="WA">WA</option> 
                            <option value="WV">WV</option> 
                            <option value="WI">WI</option> 
                            <option value="WY">WY</option> 
                        </select>  
                        <span class="text zip">Zip</span> 
                        <input type="text" class="zipCode form-text" name="iOrdBillPCode" /> 
                    </div> 

                    <div class="subscribe-row"> 
                        <span class="text">Email</span> 
                        <input type="text" class="form-text" name="iOrdBilleMail"/> 
                    </div> 
                    <div class="subscribeButton"> 
                        <input type="submit" value="Subscribe" class="submit-button"> 
                    </div> 
                </form> 

                <div class="subscribeLinks"> 

                    <br clear="all" /> 
            </div></div> 
