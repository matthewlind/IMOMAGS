<?php // Custom Browse Community Widget

class browse_community_Widget extends WP_Widget {
	function browse_community_Widget() {
		$widget_ops = array('classname' => 'widget_browse_community', 'description' => 'Browse Community Widget.' );
		$this->WP_Widget('browse_community', 'Browse Community', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
?>

    <aside id="browse-community" class="browse-community-widget">
     	<div class="sidebar-header">
		    <h2>Browse the Community</h2>
		</div>
		 <div class="post_type_styled_select">
	         <select id="dynamic_select" class="post_type" name="post_type">
	         	<option value="" selected="selected">Choose a Topic</option> 
	         	<option value="/community/report">Rut Reports</option> 
	         	<option value="/community/question">Q&A</option>      
	            <option value="/community/general">General Discussion</option>
	          </select>
	          
	          <div class="or">- OR -</div>
	          
	          <div class="state-dropdown-container-sidebar">
		          <select id="state" name="state" class="post_type state">
		            <?php
		            $hostname = 'http://'.$_SERVER['SERVER_NAME'];	
		            if (is_page('trophy')){
			            echo '<option value="">State Trophy Bucks</option>';
			            echo strtolower('<option value="'.$hostname.'/community/trophy/alabama">Alabama</option>
			            <option value="'.$hostname.'/community/trophy/Arizona">Arizona</option>
			            <option value="'.$hostname.'/community/trophy/Arkansas">Arkansas</option>
			            <option value="'.$hostname.'/community/trophy/California">California</option>
			            <option value="'.$hostname.'/community/trophy/Colorado">Colorado</option>
			            <option value="'.$hostname.'/community/trophy/Connecticut">Connecticut</option>
			            <option value="'.$hostname.'/community/trophy/Delaware">Delaware</option>
			            <option value="'.$hostname.'/community/trophy/Florida">Florida</option>
			            <option value="'.$hostname.'/community/trophy/Georgia">Georgia</option>
			            <option value="'.$hostname.'/community/trophy/Idaho">Idaho</option>
			            <option value="'.$hostname.'/community/trophy/Illinois">Illinois</option>
			            <option value="'.$hostname.'/community/trophy/Indiana">Indiana</option>
			            <option value="'.$hostname.'/community/trophy/Iowa">Iowa</option>
			            <option value="'.$hostname.'/community/trophy/Kansas">Kansas</option>
			            <option value="'.$hostname.'/community/trophy/Kentucky">Kentucky</option>
			            <option value="'.$hostname.'/community/trophy/Louisiana">Louisiana</option>
			            <option value="'.$hostname.'/community/trophy/Maine">Maine</option>
			            <option value="'.$hostname.'/community/trophy/Maryland">Maryland</option>
			            <option value="'.$hostname.'/community/trophy/Massachusetts">Massachusetts</option>
			            <option value="'.$hostname.'/community/trophy/Michigan">Michigan</option>
			            <option value="'.$hostname.'/community/trophy/Minnesota">Minnesota</option>
			            <option value="'.$hostname.'/community/trophy/Mississippi">Mississippi</option>
			            <option value="'.$hostname.'/community/trophy/Missouri">Missouri</option>
			            <option value="'.$hostname.'/community/trophy/Montana">Montana</option>
			            <option value="'.$hostname.'/community/trophy/Nebraska">Nebraska</option>
			            <option value="'.$hostname.'/community/trophy/Nevada">Nevada</option>
			            <option value="'.$hostname.'/community/trophy/new-hampshire">New Hampshire</option>
			            <option value="'.$hostname.'/community/trophy/new-jersey">New Jersey</option>
			            <option value="'.$hostname.'/community/trophy/new-mexico">New Mexico</option>
			            <option value="'.$hostname.'/community/trophy/new-york">New York</option>
			            <option value="'.$hostname.'/community/trophy/north-carolina">North Carolina</option>
			            <option value="'.$hostname.'/community/trophy/north-dakota">North Dakota</option>
			            <option value="'.$hostname.'/community/trophy/Ohio">Ohio</option>
			            <option value="'.$hostname.'/community/trophy/Oklahoma">Oklahoma</option>
			            <option value="'.$hostname.'/community/trophy/Oregon">Oregon</option>
			            <option value="'.$hostname.'/community/trophy/Pennsylvania">Pennsylvania</option>
			            <option value="'.$hostname.'/community/trophy/rhode-island">Rhode Island</option>
			            <option value="'.$hostname.'/community/trophy/south-carolina">South Carolina</option>
			            <option value="'.$hostname.'/community/trophy/south-dakota">South Dakota</option>
			            <option value="'.$hostname.'/community/trophy/Tennessee">Tennessee</option>
			            <option value="'.$hostname.'/community/trophy/Texas">Texas</option>
			            <option value="'.$hostname.'/community/trophy/Utah">Utah</option>
			            <option value="'.$hostname.'/community/trophy/Vermont">Vermont</option>
			            <option value="'.$hostname.'/community/trophy/Virginia">Virginia</option>
			            <option value="'.$hostname.'/community/trophy/Washington">Washington</option>
			            <option value="'.$hostname.'/community/trophy/west-virginia">West Virginia</option>
			            <option value="'.$hostname.'/community/trophy/Wisconsin">Wisconsin</option>
			            <option value="'.$hostname.'/community/trophy/Wyoming">Wyoming</option>');
			        }else{
			            echo '<option value="">State Rut Reports</option>';
			            echo strtolower('<option value="'.$hostname.'/community/report/alabama">Alabama</option>
			            <option value="'.$hostname.'/community/report/Arizona">Arizona</option>
			            <option value="'.$hostname.'/community/report/Arkansas">Arkansas</option>
			            <option value="'.$hostname.'/community/report/California">California</option>
			            <option value="'.$hostname.'/community/report/Colorado">Colorado</option>
			            <option value="'.$hostname.'/community/report/Connecticut">Connecticut</option>
			            <option value="'.$hostname.'/community/report/Delaware">Delaware</option>
			            <option value="'.$hostname.'/community/report/Florida">Florida</option>
			            <option value="'.$hostname.'/community/report/Georgia">Georgia</option>
			            <option value="'.$hostname.'/community/report/Idaho">Idaho</option>
			            <option value="'.$hostname.'/community/report/Illinois">Illinois</option>
			            <option value="'.$hostname.'/community/report/Indiana">Indiana</option>
			            <option value="'.$hostname.'/community/report/Iowa">Iowa</option>
			            <option value="'.$hostname.'/community/report/Kansas">Kansas</option>
			            <option value="'.$hostname.'/community/report/Kentucky">Kentucky</option>
			            <option value="'.$hostname.'/community/report/Louisiana">Louisiana</option>
			            <option value="'.$hostname.'/community/report/Maine">Maine</option>
			            <option value="'.$hostname.'/community/report/Maryland">Maryland</option>
			            <option value="'.$hostname.'/community/report/Massachusetts">Massachusetts</option>
			            <option value="'.$hostname.'/community/report/Michigan">Michigan</option>
			            <option value="'.$hostname.'/community/report/Minnesota">Minnesota</option>
			            <option value="'.$hostname.'/community/report/Mississippi">Mississippi</option>
			            <option value="'.$hostname.'/community/report/Missouri">Missouri</option>
			            <option value="'.$hostname.'/community/report/Montana">Montana</option>
			            <option value="'.$hostname.'/community/report/Nebraska">Nebraska</option>
			            <option value="'.$hostname.'/community/report/Nevada">Nevada</option>
			            <option value="'.$hostname.'/community/report/new-hampshire">New Hampshire</option>
			            <option value="'.$hostname.'/community/report/new-jersey">New Jersey</option>
			            <option value="'.$hostname.'/community/report/new-mexico">New Mexico</option>
			            <option value="'.$hostname.'/community/report/new-york">New York</option>
			            <option value="'.$hostname.'/community/report/north-carolina">North Carolina</option>
			            <option value="'.$hostname.'/community/report/north-dakota">North Dakota</option>
			            <option value="'.$hostname.'/community/report/Ohio">Ohio</option>
			            <option value="'.$hostname.'/community/report/Oklahoma">Oklahoma</option>
			            <option value="'.$hostname.'/community/report/Oregon">Oregon</option>
			            <option value="'.$hostname.'/community/report/Pennsylvania">Pennsylvania</option>
			            <option value="'.$hostname.'/community/report/rhode-island">Rhode Island</option>
			            <option value="'.$hostname.'/community/report/south-carolina">South Carolina</option>
			            <option value="'.$hostname.'/community/report/south-dakota">South Dakota</option>
			            <option value="'.$hostname.'/community/report/Tennessee">Tennessee</option>
			            <option value="'.$hostname.'/community/report/Texas">Texas</option>
			            <option value="'.$hostname.'/community/report/Utah">Utah</option>
			            <option value="'.$hostname.'/community/report/Vermont">Vermont</option>
			            <option value="'.$hostname.'/community/report/Virginia">Virginia</option>
			            <option value="'.$hostname.'/community/report/Washington">Washington</option>
			            <option value="'.$hostname.'/community/report/west-virginia">West Virginia</option>
			            <option value="'.$hostname.'/community/report/Wisconsin">Wisconsin</option>
			            <option value="'.$hostname.'/community/report/Wyoming">Wyoming</option>');
		            } ?>
		           		
		          </select>	
	          </div>
        </div>
        <div class="buttons">
	     	<a href="/community/question" class="ask-question">Ask a Question</a>
	     	<a href="/community-post" class="share-photo">Share a Photo</a>        
        </div>
        </aside>

<?php	}
 
}
register_widget('browse_community_Widget');