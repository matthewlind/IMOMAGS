<?php

/**
 * Template Name: New Post
 * Description: Community - Post a photo
 *
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * **********************************************************************
 */
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }

get_header();
imo_sidebar("community");

$displayStyle = "display:none;";
$loginStyle = "";

if ( is_user_logged_in() ) {

	$displayStyle = "";
	$loginStyle = "display:none;";

	wp_get_current_user();

	$current_user = wp_get_current_user();
    if ( !($current_user instanceof WP_User) )
         return;
}



include 'common-templates.php';




?>


	<!-- *********************************************************** -->
	<!-- ***************** UNDERSCORE TEMPLATE ********************* -->
	<!-- *********************************************************** -->
	<script type="text/template" id="new-post-template">

		<form id="new-post-form">
			 <div class="basic-form post-page">

		        <div id="attachments" class="clearfix">
			    	<input class="title-input" placeholder="Title (Required)" type="text" name="title" value="<%= post ? post.title : "" %>">
		        </div>

		        <div class="photo-link-area">
		        	<div id="fileupload">
						<div class="fileupload-buttonbar ">
							<label class="upload-button">
								<span class="add-photo-link">ADD YOUR PHOTO</span>
								<input id="image-upload" type="file" name="photo-upload">
							</label>
						</div>
					</div>
				</div>
				<div class="loading-gif"></div>
				<div class="dropdown-selects">
					<select id="ma-species" class="post_type alter-sel mobile-select" name="post_type">
						
			
						<% var taxonomyTerms = IMO_COMMUNITY_CONFIG.post_types; 
		         		 _.each(taxonomyTerms,function(term,index){   
		         		 %>
				 			<option value="<%= index %>"><%= term.display_name %></option>
				 		<% }); %>

				
		         					        </select>
			        

				    <select name="state" placeholder="Choose the state for this post:" class="alter-sel mobile-select" id="ma-state">
			            <option value="" >SELECT STATE</option>
			            <option value="AL" <%= post && post.state == "AL" ? "SELECTED" : "" %> >Alabama</option>
			            <option value="AK" <%= post && post.state == "AK" ? "SELECTED" : "" %> >Alaska</option>
			            <option value="AZ" <%= post && post.state == "AZ" ? "SELECTED" : "" %> >Arizona</option>
			            <option value="AR" <%= post && post.state == "AR" ? "SELECTED" : "" %> >Arkansas</option>
			            <option value="CA" <%= post && post.state == "CA" ? "SELECTED" : "" %> >California</option>
			            <option value="CO" <%= post && post.state == "CO" ? "SELECTED" : "" %> >Colorado</option>
			            <option value="CT" <%= post && post.state == "CT" ? "SELECTED" : "" %> >Connecticut</option>
			            <option value="DE" <%= post && post.state == "DE" ? "SELECTED" : "" %> >Delaware</option>
			            <option value="DC" <%= post && post.state == "DC" ? "SELECTED" : "" %> >District of Columbia</option>
			            <option value="FL" <%= post && post.state == "FL" ? "SELECTED" : "" %> >Florida</option>
			            <option value="GA" <%= post && post.state == "GA" ? "SELECTED" : "" %> >Georgia</option>
			            <option value="HI" <%= post && post.state == "HI" ? "SELECTED" : "" %> >Hawaii</option>
			            <option value="ID" <%= post && post.state == "ID" ? "SELECTED" : "" %> >Idaho</option>
			            <option value="IL" <%= post && post.state == "IL" ? "SELECTED" : "" %> >Illinois</option>
			            <option value="IN" <%= post && post.state == "IN" ? "SELECTED" : "" %> >Indiana</option>
			            <option value="IA" <%= post && post.state == "IA" ? "SELECTED" : "" %> >Iowa</option>
			            <option value="KS" <%= post && post.state == "KS" ? "SELECTED" : "" %> >Kansas</option>
			            <option value="KY" <%= post && post.state == "KY" ? "SELECTED" : "" %> >Kentucky</option>
			            <option value="LA" <%= post && post.state == "LA" ? "SELECTED" : "" %> >Louisiana</option>
			            <option value="ME" <%= post && post.state == "ME" ? "SELECTED" : "" %> >Maine</option>
			            <option value="MD" <%= post && post.state == "MD" ? "SELECTED" : "" %> >Maryland</option>
			            <option value="MA" <%= post && post.state == "MA" ? "SELECTED" : "" %> >Massachusetts</option>
			            <option value="MI" <%= post && post.state == "MI" ? "SELECTED" : "" %> >Michigan</option>
			            <option value="MN" <%= post && post.state == "MN" ? "SELECTED" : "" %> >Minnesota</option>
			            <option value="MS" <%= post && post.state == "MS" ? "SELECTED" : "" %> >Mississippi</option>
			            <option value="MO" <%= post && post.state == "MO" ? "SELECTED" : "" %> >Missouri</option>
			            <option value="MT" <%= post && post.state == "MT" ? "SELECTED" : "" %> >Montana</option>
			            <option value="NE" <%= post && post.state == "NE" ? "SELECTED" : "" %> >Nebraska</option>
			            <option value="NV" <%= post && post.state == "NV" ? "SELECTED" : "" %> >Nevada</option>
			            <option value="NH" <%= post && post.state == "NH" ? "SELECTED" : "" %> >New Hampshire</option>
			            <option value="NJ" <%= post && post.state == "NJ" ? "SELECTED" : "" %> >New Jersey</option>
			            <option value="NM" <%= post && post.state == "NM" ? "SELECTED" : "" %> >New Mexico</option>
			            <option value="NY" <%= post && post.state == "NY" ? "SELECTED" : "" %> >New York</option>
			            <option value="NC" <%= post && post.state == "NC" ? "SELECTED" : "" %> >North Carolina</option>
			            <option value="ND" <%= post && post.state == "ND" ? "SELECTED" : "" %> >North Dakota</option>
			            <option value="OH" <%= post && post.state == "OH" ? "SELECTED" : "" %> >Ohio</option>
			            <option value="OK" <%= post && post.state == "OK" ? "SELECTED" : "" %> >Oklahoma</option>
			            <option value="OR" <%= post && post.state == "OR" ? "SELECTED" : "" %> >Oregon</option>
			            <option value="PA" <%= post && post.state == "PA" ? "SELECTED" : "" %> >Pennsylvania</option>
			            <option value="RI" <%= post && post.state == "RI" ? "SELECTED" : "" %> >Rhode Island</option>
			            <option value="SC" <%= post && post.state == "SC" ? "SELECTED" : "" %> >South Carolina</option>
			            <option value="SD" <%= post && post.state == "SD" ? "SELECTED" : "" %> >South Dakota</option>
			            <option value="TN" <%= post && post.state == "TN" ? "SELECTED" : "" %> >Tennessee</option>
			            <option value="TX" <%= post && post.state == "TX" ? "SELECTED" : "" %> >Texas</option>
			            <option value="UT" <%= post && post.state == "UT" ? "SELECTED" : "" %> >Utah</option>
			            <option value="VT" <%= post && post.state == "VT" ? "SELECTED" : "" %> >Vermont</option>
			            <option value="VA" <%= post && post.state == "VA" ? "SELECTED" : "" %> >Virginia</option>
			            <option value="WA" <%= post && post.state == "WA" ? "SELECTED" : "" %> >Washington</option>
			            <option value="WV" <%= post && post.state == "WV" ? "SELECTED" : "" %> >West Virginia</option>
			            <option value="WI" <%= post && post.state == "WI" ? "SELECTED" : "" %> >Wisconsin</option>
			            <option value="WY" <%= post && post.state == "WY" ? "SELECTED" : "" %> >Wyoming</option>
			            <option value="AB" <%= post && post.state == "AB" ? "SELECTED" : "" %> >Alberta, Canada</option>
			            <option value="BC" <%= post && post.state == "BC" ? "SELECTED" : "" %> >British Columbia, Canada</option>
			            <option value="MB" <%= post && post.state == "MB" ? "SELECTED" : "" %> >Manitoba, Canada</option>
			            <option value="NB" <%= post && post.state == "NB" ? "SELECTED" : "" %> >New Brunswick, Canada</option>
			            <option value="NL" <%= post && post.state == "NL" ? "SELECTED" : "" %> >Newfoundland and Labrador, Canada</option>
			            <option value="NT" <%= post && post.state == "NT" ? "SELECTED" : "" %> >Northwest Territories, Canada</option>
			            <option value="NS" <%= post && post.state == "NS" ? "SELECTED" : "" %> >Nova Scotia, Canada</option>
			            <option value="NU" <%= post && post.state == "NU" ? "SELECTED" : "" %> >Nunavut, Canada</option>
			            <option value="ON" <%= post && post.state == "ON" ? "SELECTED" : "" %> >Ontario, Canada</option>
			            <option value="PE" <%= post && post.state == "PE" ? "SELECTED" : "" %> >Prince Edward Island, Canada</option>
			            <option value="QC" <%= post && post.state == "QC" ? "SELECTED" : "" %> >Quebec, Canada</option>
			            <option value="SK" <%= post && post.state == "SK" ? "SELECTED" : "" %> >Saskatchewan, Canada</option>
			            <option value="YT" <%= post && post.state == "YT" ? "SELECTED" : "" %> >Yukon, Canada</option>
                        <option value="MX" <%= post && post.state == "MX" ? "SELECTED" : "" %> >Mexico</option>
					</select>
				</div>
				


				<% if (post && post.id) { %>
						<input type="hidden" name="id" value="<%= post.id %>" >
				<% } %>

                <div class="enter-master-angler" style="display:none;">
                    <img src="/wp-content/themes/infisherman/images/pic/badge-ma.png">
                    <h2>Awesome catch.</h2>

                    <p>Congratulations! Your fish qualifies for Master Angler.</p>



					<span class="btn-red btn-post btn-new-post"><a href="" class="enter-ma-now">Enter Your Catch!</a></span>
		            <div>

					    <span class=""><a href="" class="no-thanks">No Thanks</a></span>
					</div>

                    <a href="#" class="ma-read-rules">Read Rules</a>
                </div>



	            <div class="gform_wrapper master-angler-form-container"  style="display:none;" id="master-angler-container">

	                <div class='gform_body'>
	                    <ul class='gform_fields top_label description_below' >
	                        <li class='gfield gsection' >
	                            <h2 class='gsection_title'>Master Angler <span>Contact Information</span></h2>
	                        </li>

	                        <li class='gfield formname gfield_contains_required' >
	                            <label class='gfield_label' for='input_4_3_3'>Name<span class='gfield_required'>*</span></label>

	                            <div class='ginput_complex ginput_container' >
	                                <span class='ginput_left' >
	                                    <input  name='first_name' tabindex='1' type='text' value=''>
	                                        <label for=''>First</label>
	                                </span>
	                                <span class='ginput_right' >
	                                    <input  name='last_name' tabindex='2' type='text' value=''>
	                                        <label for=''>Last</label>
	                                    </span>
	                            </div>
	                        </li>

	                        <li class='gfield gfield_contains_required' >
	                            <label class='gfield_label' for='input_4_4'>Email<span class='gfield_required'>*</span></label>

	                            <div class='ginput_complex ginput_container' >
	                                <span class='ginput_left' >
	                                	<input  name='email' tabindex='3' type='text' value='' class="email-field">
	                                	<label for='input_4_4'>Enter Email</label>
	                                </span>
	                                <span class='ginput_right' >
	                                	<input  name='confirm-email' tabindex='4' type='text' value='' class="email-field">
	                                	<label for='input_4_4_2'>Confirm Email</label>
	                                </span>
	                            </div>


	                        </li>

	                        <li class='gfield formaddress gfield_contains_required' >
	                            <label class='gfield_label' for='input_4_5_1'>Address<span class='gfield_required'>*</span></label>

	                            <div class='ginput_complex ginput_container' >
	                                <span class='ginput_full' >
	                                    <input  name='street_address_1' tabindex='5' type='text' value=''>
	                                    <label for='input_4_5_1' >Street Address</label>
	                                </span>
	                                <span class='ginput_full' >
	                                    <input  name='street_address_2' tabindex='6' type='text' value=''>
	                                    <label for='input_4_5_2' >Address Line 2</label>
	                                </span>
	                                <span class='ginput_left' >
	                                    <input  name='city' tabindex='7' type='text' value=''>
	                                    <label for='input_4_5_3' >City</label>
	                                </span>
	                                <span class='ginput_right' >
	                                    <input  name='state_address' tabindex='9' type='text' value=''>
	                                    <label for='input_4_5_4' >State / Province / Region</label>
	                                </span>
	                                <span class='ginput_left' >
	                                    <input  name='zip' tabindex='10' type='text' value=''>
	                                    <label for='input_4_5_5' >Zip / Postal Code</label>
	                                </span>

	                            </div>
	                        </li>

	                        <li class='gfield formphone gfield_contains_required' >
	                            <label class='gfield_label' for='input_4_6'>Phone<span class='gfield_required'>*</span></label>

	                            <div class='ginput_container'>
	                                <input class='medium'  name='phone' tabindex='12' type='text' value=''>
	                            </div>
	                        </li>

	                        <li class='gfield gsection' >
	                            <h2 class='gsection_title'>About Your Catch</h2>
	                        </li>



	                        <li class='gfield gfield_contains_required' >
	                            <label class='gfield_label' for='input_4_10'>Date Caught<span class='gfield_required'>*</span></label>

	                            <div class='clear-multi'>
	                                <div class='gfield_date_month ginput_container' >
	                                    <input  maxlength='2' name='month' tabindex='21' type='text' value=''><label for='input_4_10_1'>MM</label>
	                                </div>

	                                <div class='gfield_date_day ginput_container' >
	                                    <input  maxlength='2' name='day' tabindex='22' type='text' value=''><label for='input_4_10_2'>DD</label>
	                                </div>

	                                <div class='gfield_date_year ginput_container' >
	                                    <input  maxlength='4' name='year' tabindex='23' type='text' value=''><label for='input_4_10_3'>YYYY</label>
	                                </div>
	                            </div>
	                        </li>

	                        <li class='gfield gfield_contains_required' >
	                            <label class='gfield_label' for='input_4_44'>Body of Water<span class='gfield_required'>*</span></label>

	                            <div class='ginput_container'>
	                                <input class='medium'  name='body_of_water' tabindex='24' type='text' value=''>
	                            </div>
	                        </li>

	                        <li class='gfield gfield_contains_required' >
	                            <label class='gfield_label' for='input_4_45'>Nearest Town<span class='gfield_required'>*</span></label>

	                            <div class='ginput_container'>
	                                <input class='medium'  name='nearest_town' tabindex='25' type='text' value=''>
	                            </div>
	                        </li>



	                        <li class='gfield'>
	                            <label class='gfield_label' for='input_4_15'>Lure or Bait</label>

	                            <div class='ginput_container'>
	                                <input class='medium'  name='kind_of_lure' tabindex='32' type='text' value=''>
	                            </div>
	                        </li>

	                        <li class='gfield gfield_contains_required' >
	                            <label class='gfield_label' for='input_4_14'>Kept or Released<span class='gfield_required'>*</span></label>

	                            <div class='ginput_container'>
	                                <select class='small gfield_select'  name='kept' onchange='' tabindex='31'>
	                                    <option selected='selected' value='Select'>
	                                        Select
	                                    </option>

	                                    <option value='1'>
	                                        Kept
	                                    </option>

	                                    <option value='0'>
	                                        Released
	                                    </option>
	                                </select>
	                            </div>
	                        </li>

	                        <li class='gfield' >
	                            <label class='gfield_label'>Newsletters &amp; Special Offers</label>

	                            <div class='ginput_container'>
	                                <ul class='gfield_checkbox' >
	                                    <li class='gchoice_41_1'><input checked='checked'  name='yes_newsletter' tabindex='57' type='checkbox' value='1'><label for='choice_41_1'>Yes, sign me up for the In-Fisherman Newsletter!</label></li>

	                                    <li class='gchoice_41_2'><input checked='checked'  name='yes_offers' tabindex='58' type='checkbox' value='1'><label for='choice_41_2'>I&#39;d also like to recieve special offers!</label></li>
	                                </ul>
	                            </div>
	                        </li>

	                        <li class='gfield gfield_html gfield_html_formatted gfield_no_follows_desc' >
	                            <a href="#">Official Rules</a>
	                        </li>


	                    </ul>
	                </div>
	            </div>
	            <div class="login-area">
	            	<p class="login-message" style="<?php echo $loginStyle; ?>">Post Your Photo:</p>
	            	<a href="#" id="imo-fb-login-button" class="imo-community-new-post fb-login join-widget-fb-login btn-fb-login">Fast Login & Submit</a>
	            	<span class="or-delim" style="<?php echo $loginStyle; ?>">OR</span>
	            	<a href="#" class="email-signup email-signup-button jq-open-reg-popup" style="<?php echo $loginStyle; ?>" >login with email address</a>
	            	<!-- <p class="login-message" style="<?php echo $loginStyle; ?>">Your post will be submitted immediately after Login</p> -->
				    <span class="btn-red btn-post btn-submit"  style="<?php echo $displayStyle; ?>"><input id="post-photo" type="submit" class="share-photo-btn" value="Share Your Photo"></span>
	            </div>
	            <hr>


			</div>




		</form>



	</script>
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	
	
	<script type="text/template" id="single-attachment-template">
			     
      	<a href="<%= attachment.img_url %>" class="thickbox">
      			<div class="attachment-image-container">
		      		<img src="<%= attachment.img_url %>/convert?w=150&h=150&fit=crop&rotate=exif" width=75 height=75 style="height:75px">
		      	</div>
      	</a>
	  	 <div class="caption-area" name="caption-body" value="<%= attachment.body %>">
            <textarea id="" class="area caption-field" cols="30" rows="10" placeholder="Tell Your Story (optional)"></textarea>
        </div>

	</script>
	
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->

<div class="page-community">
	<div class="general general-com">
		<div class="custom-title clearfix">
            <a href="/community"><img src="<?php echo plugins_url('images/naw-plus.png' , __FILE__ ); ?>" alt="NAW community" class="custom-tite-logo"></a>
            <div class="title-crumbs">
                <h1>Share Your Photo</h1>
				<div class="sponsor"><?php imo_dart_tag("240x60"); ?></div>
			</div>
        </div>

	    <div id="form-container">

	    </div>

	</div>

</div>






<?php get_footer(); ?>