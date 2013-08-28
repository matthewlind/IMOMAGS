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

?>


	<!-- *********************************************************** -->
	<!-- ***************** UNDERSCORE TEMPLATE ********************* -->
	<!-- *********************************************************** -->
	<script type="text/template" id="new-post-template">
	<h2><%= post ? 'Edit' : 'Post' %> a photo</h2>

		<form id="new-post-form">
			 <div class="basic-form post-page post-reply-slide">
		        <div class="f-row">
		            <input placeholder="Title" type="text" name="title" value="<%= post ? post.title : "" %>">
		        </div>

		        <div id="attachments" class="clearfix"></div>


				<div id="progressBar">

					<div></div><span></span>
				</div>

		        <div class="photo-link-area">
		        	<div id="fileupload">
						<div class="fileupload-buttonbar ">
							<label class="upload-button">
								<span class="add-photo-link">ATTACH PHOTO</span>
								<input id="image-upload" type="file" name="photo-upload">
							</label>
						</div>
					</div>
				</div>


				<div class="dropdown-selects">
					<select id="dynamic_select" class="post_type alter-sel mobile-select" name="post_type">
		         		<option value="">SPECIES</option>
				 		<% _.each(post_types,function(postType,index){ %>
		         			<option value="<%= index %>" <%= post && post.post_type == postType.index ? "SELECTED" : "" %> ><%= postType.display_name %></option>
				 		<% }); %>
			        </select>
				    <select name="state" placeholder="Choose the state for this post:" class="alter-sel mobile-select">
			            <option value="" >STATE</option>
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
					</select>
				</div>


				<% if (post && post.id) { %>
						<input type="hidden" name="id" value="<%= post.id %>" >
				<% } %>

			    <span class="btn-red btn-post"><input type="submit"></span>
			</div>
		</form>
	</script>
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->

	<script type="text/template" id="single-attachment-template">

			      <div style="margin:20px 0" class="add-photo-field">
				      	<a href="<%= attachment.img_url %>" class="thickbox">

				      			<img src="<%= attachment.img_url %>/convert?w=150&h=150&fit=crop" width=75 height=75 style="height:75px">

				      	</a>
					  	 <div class="caption-area" name="caption-body" placeholder="Caption (optional)" value="<%= attachment.body %>">
			                <textarea id="" class="area caption-field" cols="30" rows="10" placeholder="Add Caption (optional)"></textarea>
			            </div>
				      	<a href="" class="delete-attachment"><span>Delete</span></a>

				   </div>




	</script>
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->
	<!-- *********************************************************** -->

<div class="page-community">
	<div class="general general-com">
		<div class="custom-title clearfix">
            <img src="<?php echo plugins_url('images/fishhead2.png' , __FILE__ ); ?>" alt="FishHeads" class="custom-tite-logo">
            <div class="title-crumbs">
                <h1>Fishhead Photos</h1>
                <p>Description goes here in this place holder</p>
			</div>
        </div>

	    <div id="form-container">

	    </div>

	</div>

</div>






<?php get_footer(); ?>