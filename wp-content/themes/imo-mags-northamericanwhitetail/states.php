<?php

/**
 * Template Name: States
 * Description: Displays a specific superpost
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
// convert some slugs
$stateSlugToAbbv = array("alabama"=>"AL",
"alaska"=>"AK","arizona"=>"AZ","arkansas"=>"AR","california"=>"CA","colorado"=>"CO","connecticut"=>"CT","delaware"=>"DE","district-of-columbia"=>"DC","florida"=>"FL","georgia"=>"GA","hawaii"=>"HI","idaho"=>"ID","illinois"=>"IL","indiana"=>"IN","iowa"=>"IA","kansas"=>"KS","kentucky"=>"KY","louisiana"=>"LA","maine"=>"ME","maryland"=>"MD","massachusetts"=>"MA","michigan"=>"MI","minnesota"=>"MN","mississippi"=>"MS","missouri"=>"MO","montana"=>"MT","nebraska"=>"NE","nevada"=>"NV","new-hampshire"=>"NH","new-jersey"=>"NJ","new-mexico"=>"NM","new-york"=>"NY","north-carolina"=>"NC","north-dakota"=>"ND","ohio"=>"OH","oklahoma"=>"OK","oregon"=>"OR","pennsylvania"=>"PA","rhode-island"=>"RI","south-carolina"=>"SC","south-dakota"=>"SD","tennessee"=>"TN","texas"=>"TX","utah"=>"UT","vermont"=>"VT","virginia"=>"VA","washington"=>"WA","west-virginia"=>"WV","wisconsin"=>"WI","wyoming"=>"WY","alberta"=>"AB","british-columbia"=>"BC","manitoba"=>"MB","new-brunswick"=>"NB","newfoundland-and-labrador"=>"NL","northwest-territories"=>"NT","nova-scotia"=>"NS","nunavut"=>"NU","ontario"=>"ON","prince-edward-island"=>"PE","quebec"=>"QC","saskatchewan"=>"SK","yukon"=>"YT");    
 
$term_slug = get_query_var("state");

if (empty($stateSlugToAbbv[$term_slug]))
	header('Location: http://www.northamericanwhitetail.com/404'); 
 


get_header();  

the_post();



$post_type = "report";


if (strstr($_SERVER["REQUEST_URI"], "trophy"))
	$post_type = "trophy";
	
	
// Create the titles	
if ($post_type == "report"){
	$title = "Rut Reports";
	$singulartitle = "Rut Report";
}else{
	$title = "Trophy Bucks";
	$singulartitle = "Trophy Buck";
}	

//print_r($post_type);

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
    
$hostname = $_SERVER['SERVER_NAME'];



//First get post data
$spid =  get_query_var("spid");


$state = $stateSlugToAbbv[$term_slug];
if ($term_slug == 'new-york'){
	$stateTitle = 'New York';
}else if ($term_slug == 'rhode-island'){
	$stateTitle = 'Rhode Island';
}else if ($term_slug == 'south-carolina'){
	$stateTitle = 'South Carolina';
}else if ($term_slug == 'south-dakota'){
	$stateTitle = 'South Dakota';
}else if ($term_slug == 'new-hampshire'){
	$stateTitle = 'New Hampshire';
}else if ($term_slug == 'new-jersey'){
	$stateTitle = 'New Jersey';
}else if ($term_slug == 'new-mexico'){
	$stateTitle = 'New Mexico';
}else if ($term_slug == 'north-carolina'){
	$stateTitle = 'North Carolina';
}else if ($term_slug == 'north-dakota'){
	$stateTitle = 'North Dakota';
}else if ($term_slug == 'new-brunswick'){
	$stateTitle = 'New Brunswick';
}else if ($term_slug == 'newfoundland-and-labrador'){
	$stateTitle = 'Newfoundland and Labrador';
}else if ($term_slug == 'northwest-territories'){
	$stateTitle = 'Northwest Territories';
}else if ($term_slug == 'nova-scotia'){
	$stateTitle = 'Nova Scotia';
}else if ($term_slug == 'prince-edward-island'){
	$stateTitle = 'Prince Edward Island';	
}else{
	$stateTitle = $term_slug;
}

$requestURL = "http://$hostname/slim/api/superpost/state/$state/type/$post_type/10/0";


$file = file_get_contents($requestURL);
$data = json_decode($file);
$data = $data[0];
    
?>
<div class="page-community">
   	<div class="bonus-background">
		<div class="bonus">
			<!-- state nav -->
			  <aside id="browse-community" class="browse-community-widget state-nav">
     	<div class="sidebar-header">
		    <h2>Browse by State</h2>
		</div>
		 <div class="post_type_styled_select">
	     	<div class="state-dropdown-container-sidebar">
		    	<select id="state" name="state" class="post_type state">
		    		<option value="">State <?php echo $title; ?></option>
		    		<option value="/community/<?php echo $post_type; ?>/alabama">Alabama</option>
		            <option value="/community/<?php echo $post_type; ?>/arizona">Arizona</option>
		            <option value="/community/<?php echo $post_type; ?>/arkansas">Arkansas</option>
		            <option value="/community/<?php echo $post_type; ?>/california">California</option>
		            <option value="/community/<?php echo $post_type; ?>/colorado">Colorado</option>
		            <option value="/community/<?php echo $post_type; ?>/connecticut">Connecticut</option>
		            <option value="/community/<?php echo $post_type; ?>/delaware">Delaware</option>
		            <option value="/community/<?php echo $post_type; ?>/florida">Florida</option>
		            <option value="/community/<?php echo $post_type; ?>/georgia">Georgia</option>
		            <option value="/community/<?php echo $post_type; ?>/idaho">Idaho</option>
		            <option value="/community/<?php echo $post_type; ?>/illinois">Illinois</option>
		            <option value="/community/<?php echo $post_type; ?>/indiana">Indiana</option>
		            <option value="/community/<?php echo $post_type; ?>/iowa">Iowa</option>
		            <option value="/community/<?php echo $post_type; ?>/kansas">Kansas</option>
		            <option value="/community/<?php echo $post_type; ?>/kentucky">Kentucky</option>
		            <option value="/community/<?php echo $post_type; ?>/louisiana">Louisiana</option>
		            <option value="/community/<?php echo $post_type; ?>/maine">Maine</option>
		            <option value="/community/<?php echo $post_type; ?>/maryland">Maryland</option>
		            <option value="/community/<?php echo $post_type; ?>/massachusetts">Massachusetts</option>
		            <option value="/community/<?php echo $post_type; ?>/michigan">Michigan</option>
		            <option value="/community/<?php echo $post_type; ?>/minnesota">Minnesota</option>
		            <option value="/community/<?php echo $post_type; ?>/mississippi">Mississippi</option>
		            <option value="/community/<?php echo $post_type; ?>/missouri">Missouri</option>
		            <option value="/community/<?php echo $post_type; ?>/montana">Montana</option>
		            <option value="/community/<?php echo $post_type; ?>/nebraska">Nebraska</option>
		            <option value="/community/<?php echo $post_type; ?>/nevada">Nevada</option>
		            <option value="/community/<?php echo $post_type; ?>/new-hampshire">New Hampshire</option>
		            <option value="/community/<?php echo $post_type; ?>/new-jersey">New Jersey</option>
		            <option value="/community/<?php echo $post_type; ?>/new-mexico">New Mexico</option>
		            <option value="/community/<?php echo $post_type; ?>/new-york">New York</option>
		            <option value="/community/<?php echo $post_type; ?>/north-carolina">North Carolina</option>
		            <option value="/community/<?php echo $post_type; ?>/north-dakota">North Dakota</option>
		            <option value="/community/<?php echo $post_type; ?>/ohio">Ohio</option>
		            <option value="/community/<?php echo $post_type; ?>/oklahoma">Oklahoma</option>
		            <option value="/community/<?php echo $post_type; ?>/oregon">Oregon</option>
		            <option value="/community/<?php echo $post_type; ?>/pennsylvania">Pennsylvania</option>
		            <option value="/community/<?php echo $post_type; ?>/rhode-island">Rhode Island</option>
		            <option value="/community/<?php echo $post_type; ?>/south-carolina">South Carolina</option>
		            <option value="/community/<?php echo $post_type; ?>/south-dakota">South Dakota</option>
		            <option value="/community/<?php echo $post_type; ?>/tennessee">Tennessee</option>
		            <option value="/community/<?php echo $post_type; ?>/texas">Texas</option>
		            <option value="/community/<?php echo $post_type; ?>/utah">Utah</option>
		            <option value="/community/<?php echo $post_type; ?>/vermont">Vermont</option>
		            <option value="/community/<?php echo $post_type; ?>/virginia">Virginia</option>
		            <option value="/community/<?php echo $post_type; ?>/washington">Washington</option>
		            <option value="/community/<?php echo $post_type; ?>/west-virginia">West Virginia</option>
		            <option value="/community/<?php echo $post_type; ?>/wisconsin">Wisconsin</option>
		            <option value="/community/<?php echo $post_type; ?>/wyoming">Wyoming</option>
		            <option value="/community/<?php echo $post_type; ?>/alberta">Alberta, Canada</option>
		            <option value="/community/<?php echo $post_type; ?>/british-columbia">British Columbia, Canada</option>
		            <option value="/community/<?php echo $post_type; ?>/manitoba">Manitoba, Canada</option>
		            <option value="/community/<?php echo $post_type; ?>/new-brunswick">New Brunswick, Canada</option>
		            <option value="/community/<?php echo $post_type; ?>/newfoundland-and-labrador">Newfoundland and Labrador, Canada</option>
		            <option value="/community/<?php echo $post_type; ?>/northwest-territories">Northwest Territories, Canada</option>
		            <option value="/community/<?php echo $post_type; ?>/nova-scotia">Nova Scotia, Canada</option>
		            <option value="/community/<?php echo $post_type; ?>/nunavut">Nunavut, Canada</option>
		            <option value="/community/<?php echo $post_type; ?>/ontario">Ontario, Canada</option>
		            <option value="/community/<?php echo $post_type; ?>/prince-edward-island">Prince Edward Island, Canada</option>
		            <option value="/community/<?php echo $post_type; ?>/quebec">Quebec, Canada</option>
		            <option value="/community/<?php echo $post_type; ?>/saskatchewan">Saskatchewan, Canada</option>
		            <option value="/community/<?php echo $post_type; ?>/yukon">Yukon, Canada</option>		            		
		        </select>	
			</div>	         
        </div>
    </aside>
            
    <div class="clearfix" style="margin-bottom: 10px;"></div>
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('state-page-sidebar')) : else : ?><?php endif; ?>
		</div>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<script type="text/javascript">
	              document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.'+dartadsgen_site+'/;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
	            </script>
	            <script type="text/javascript">
	              ++pr_tile;
	            </script>
	            <noscript>
	              <a href="http://ad.doubleclick.net/adj/imo.outdoorsbest/;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?">
	                <img src="http://ad.doubleclick.net/ad/imo.outdoorsbest/home;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?" border="0" />
	              </a>
	            </noscript>

			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : ?><?php endif; ?>
		</div>

	</div>

	<div class="col-abc">
	<header class="header-title">
    	
    		       <h1 style="text-transform:capitalize;">
	       <?php 
	       if($post_type == 'report'){
		      	echo $stateTitle.' '.$title;  
	       }else{
		       	echo 'Community: '.$title; 
	       }
	       
	       ?>
	       </h1>
	       <div class="community-crumbs">
	       		<a href="/community">Community Home</a> &raquo; <a href="/<?php echo $post_type; ?>"><?php echo $title; ?></a> &raquo; <?php echo $stateTitle; ?> 
			</div>
		</header>
		<div class="post-form-btn-container">
			<a class="post-form-btn" style="text-transform:capitalize;">+ Start a New Post in <?php echo $stateTitle; ?> Rut Report</a>
		</div>
		
		<h2 class="comm-header post-header" style="text-transform:capitalize;">Start a New <?php echo $stateTitle." ".$singulartitle; ?></h2>
					
		<div class="new-superpost-modal-container">
		
		<form id="fileUploadForm" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-form">
	        <input type="text" name="title" id="title" placeholder="Title"/>
	        <input type="text" name="post_type" id="post_type" value="<?php echo $post_type; ?>" style="display:none;"/>
	        	           

	        <textarea name="body" placeholder="Description"></textarea>
	        
	       <input id="file" type="file" name="photo-upload" id="photo-upload" style="display:none"/>
	<!--    
	        <input type="hidden" name="clone_target" value="superpost-box">
	        <input type="hidden" name="attach_target" value="post-container">
	        <input type="hidden" name="attachment_point" value="prepend">
	        <input type="hidden" name="masonry" value="true"> 
	-->
	        <input type="hidden" name="form_id" value="fileUploadForm">
	        <input type="hidden" name="attachment_id" class="attachment_id" value="">	   
	        <input type="submit" value="Submit" class="submit" style="<?php echo $displayStyle; ?>"/>
	        <div id="imo-fb-login-button" class="fb-login join-widget-fb-login" style="<?php echo $loginStyle; ?>">Fast Facebook Login</div>

	        <p class="login-note">
	        </p>
			  <div class="state-dropdown-container" style="display:none;">
		          <select id="state" name="state" class="post_type">
		          	<option value="<?php echo $state; ?>"></option>
		        </select>
		      </div>    


	        </form>
	        
	        <div class="media-section">
	
		     		
		       <form id="fileUploadForm-image" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-image-form">
		        <div id="fileupload" >
		          <div class="fileupload-buttonbar ">
		              <label class="upload-button">
		                  <span><span class="white-plus-sign">+</span><span class="button-text">ATTACH PHOTO</span></span>
		                  <input id="image-upload" type="file" name="photo-upload" id="photo-upload" />
		
		              </label>
		          </div>
		        </div>
		        <input type="hidden" name="post_type" value="photo">
		        <input type="hidden" name="form_id" value="fileUploadForm">
		
		
		      </form>
		      
		      <div class="video-button">
		        <span><span class="white-plus-sign"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/youtube.png" alt="YouTube" /></span>ADD YOUTUBE VIDEO</span>
		      </div>
		      <div class="video-url-form-holder-container" style="display:none;">
		
		        <div class="video-url-form-holder" style="">
		          <form id="video-url-form" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-image-form">
		            
		            <div class="video-body-holder">
		            <input type="text" name="body" id="video-body" placeholder="Paste YouTube URL or code here"/>
		            </div>
		            <input type="hidden" name="post_type" value="youtube">
		            <input type="hidden" name="form_id" value="fileUploadForm">
		
		
		          </form>
		
		        </div>
		        <div class="video-close-button">
		        </div>
		      </div>
		       
		      
		      
		      </div><!-- /.media-section-->
		      <h4 style="display:none" class="photo-attachement-header">Photos</h4>
		      <div class="attached-photos">
		      </div>
		      <div class="email-login" style="<?php echo $loginStyle; ?>"><a>or use your email</a></div>
	    </div> <!-- End new-superpost-modal-container -->
	    </div> <!-- end .col-abc -->

	    <div class="col-abc">
		
	    <h2 class="comm-header stream-header" style="text-transform:capitalize;">Latest <?php if($post_type == 'report'){ echo $stateTitle.' Rut '.$post_type.'s';  }else{ echo $stateTitle.' '.$post_type.' Bucks'; } ?></h2>
	    <div id="no-activity">
    		<p>No Activity.</p>
    	</div>

        <div id="recon-activity" term="<?php echo $post_type; ?>" display="list" widthMode="short" state="<?php echo $state; ?>">


       </div>
       <span id="more-community-button" style="display:none;">Load More<span></span></span>
   </div>
</div>
<?php get_footer(); ?>
