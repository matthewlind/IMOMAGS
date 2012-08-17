<?php // Custom Community Topics Widget

class community_topics_Widget extends WP_Widget {
	function community_topics_Widget() {
		$widget_ops = array('classname' => 'widget_community_topics', 'description' => 'Community Topics Widget.' );
		$this->WP_Widget('community_topics', 'Community Topics', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
?>

    <aside id="community-topics" class="community-topics-widget">
     	<div class="sidebar-header">
		    <h2>Browse the Community</h2>
		</div>
		 <div class="post_type_styled_select">
	         <select id="dynamic_select" class="post_type" name="post_type">
	         	<option value="" selected="selected">Choose a Topic</option>        
	         	<option value="/community/general">General Discussion</option>
	            <option value="/community/question">Q&A</option>
	            <option value="/community/report">Rut Reports</option>
	            <option value="/community/tip"">Tips & Tactics</option>
	            <option value="/community/lifestyle">Lifestyle</option>
	            <option value="/community/trophy">Trophy Bucks</option>
	            <option value="/community/gear">Gear</option>
	          </select>
	          
	          <div class="or">- OR -</div>
	          
	          <div class="state-dropdown-container">
		          <select id="state" name="state" class="post_type">
		            <?php if (is_page('trophy')){
			            echo '<option value="">State Trophy Bucks</option>
			            <option value="/community/trophy/alabama">Alabama</option>
			            <option value="/community/trophy/Arizona">Arizona</option>
			            <option value="/community/trophy/Arkansas">Arkansas</option>
			            <option value="/community/trophy/California">California</option>
			            <option value="/community/trophy/Colorado">Colorado</option>
			            <option value="/community/trophy/Connecticut">Connecticut</option>
			            <option value="/community/trophy/Delaware">Delaware</option>
			            <option value="/community/trophy/Florida">Florida</option>
			            <option value="/community/trophy/Georgia">Georgia</option>
			            <option value="/community/trophy/Idaho">Idaho</option>
			            <option value="/community/trophy/Illinois">Illinois</option>
			            <option value="/community/trophy/Indiana">Indiana</option>
			            <option value="/community/trophy/Iowa">Iowa</option>
			            <option value="/community/trophy/Kansas">Kansas</option>
			            <option value="/community/trophy/Kentucky">Kentucky</option>
			            <option value="/community/trophy/Louisiana">Louisiana</option>
			            <option value="/community/trophy/Maine">Maine</option>
			            <option value="/community/trophy/Maryland">Maryland</option>
			            <option value="/community/trophy/Massachusetts">Massachusetts</option>
			            <option value="/community/trophy/Michigan">Michigan</option>
			            <option value="/community/trophy/Minnesota">Minnesota</option>
			            <option value="/community/trophy/Mississippi">Mississippi</option>
			            <option value="/community/trophy/Missouri">Missouri</option>
			            <option value="/community/trophy/Montana">Montana</option>
			            <option value="/community/trophy/Nebraska">Nebraska</option>
			            <option value="/community/trophy/Nevada">Nevada</option>
			            <option value="/community/trophy/new-hampshire">New Hampshire</option>
			            <option value="/community/trophy/new-jersey">New Jersey</option>
			            <option value="/community/trophy/new-mexico">New Mexico</option>
			            <option value="/community/trophy/new-york">New York</option>
			            <option value="/community/trophy/north-carolina">North Carolina</option>
			            <option value="/community/trophy/north-dakota">North Dakota</option>
			            <option value="/community/trophy/Ohio">Ohio</option>
			            <option value="/community/trophy/Oklahoma">Oklahoma</option>
			            <option value="/community/trophy/Oregon">Oregon</option>
			            <option value="/community/trophy/Pennsylvania">Pennsylvania</option>
			            <option value="/community/trophy/rhode-island">Rhode Island</option>
			            <option value="/community/trophy/south-carolina">South Carolina</option>
			            <option value="/community/trophy/south-dakota">South Dakota</option>
			            <option value="/community/trophy/Tennessee">Tennessee</option>
			            <option value="/community/trophy/Texas">Texas</option>
			            <option value="/community/trophy/Utah">Utah</option>
			            <option value="/community/trophy/Vermont">Vermont</option>
			            <option value="/community/trophy/Virginia">Virginia</option>
			            <option value="/community/trophy/Washington">Washington</option>
			            <option value="/community/trophy/west-virginia">West Virginia</option>
			            <option value="/community/trophy/Wisconsin">Wisconsin</option>
			            <option value="/community/trophy/Wyoming">Wyoming</option>';
			        }else{
			            echo '<option value="">State Rut Reports</option>
			            <option value="/community/report/alabama">Alabama</option>
			            <option value="/community/report/Arizona">Arizona</option>
			            <option value="/community/report/Arkansas">Arkansas</option>
			            <option value="/community/report/California">California</option>
			            <option value="/community/report/Colorado">Colorado</option>
			            <option value="/community/report/Connecticut">Connecticut</option>
			            <option value="/community/report/Delaware">Delaware</option>
			            <option value="/community/report/Florida">Florida</option>
			            <option value="/community/report/Georgia">Georgia</option>
			            <option value="/community/report/Idaho">Idaho</option>
			            <option value="/community/report/Illinois">Illinois</option>
			            <option value="/community/report/Indiana">Indiana</option>
			            <option value="/community/report/Iowa">Iowa</option>
			            <option value="/community/report/Kansas">Kansas</option>
			            <option value="/community/report/Kentucky">Kentucky</option>
			            <option value="/community/report/Louisiana">Louisiana</option>
			            <option value="/community/report/Maine">Maine</option>
			            <option value="/community/report/Maryland">Maryland</option>
			            <option value="/community/report/Massachusetts">Massachusetts</option>
			            <option value="/community/report/Michigan">Michigan</option>
			            <option value="/community/report/Minnesota">Minnesota</option>
			            <option value="/community/report/Mississippi">Mississippi</option>
			            <option value="/community/report/Missouri">Missouri</option>
			            <option value="/community/report/Montana">Montana</option>
			            <option value="/community/report/Nebraska">Nebraska</option>
			            <option value="/community/report/Nevada">Nevada</option>
			            <option value="/community/report/new-hampshire">New Hampshire</option>
			            <option value="/community/report/new-jersey">New Jersey</option>
			            <option value="/community/report/new-mexico">New Mexico</option>
			            <option value="/community/report/new-york">New York</option>
			            <option value="/community/report/north-carolina">North Carolina</option>
			            <option value="/community/report/north-dakota">North Dakota</option>
			            <option value="/community/report/Ohio">Ohio</option>
			            <option value="/community/report/Oklahoma">Oklahoma</option>
			            <option value="/community/report/Oregon">Oregon</option>
			            <option value="/community/report/Pennsylvania">Pennsylvania</option>
			            <option value="/community/report/rhode-island">Rhode Island</option>
			            <option value="/community/report/south-carolina">South Carolina</option>
			            <option value="/community/report/south-dakota">South Dakota</option>
			            <option value="/community/report/Tennessee">Tennessee</option>
			            <option value="/community/report/Texas">Texas</option>
			            <option value="/community/report/Utah">Utah</option>
			            <option value="/community/report/Vermont">Vermont</option>
			            <option value="/community/report/Virginia">Virginia</option>
			            <option value="/community/report/Washington">Washington</option>
			            <option value="/community/report/west-virginia">West Virginia</option>
			            <option value="/community/report/Wisconsin">Wisconsin</option>
			            <option value="/community/report/Wyoming">Wyoming</option>';
		            } ?>
		           		
		          </select>	
	          </div>
        </div>
        <div class="buttons">
	     	<a href="#" class="ask-question post new-post question">Ask a Question</a>
	     	<a href="#" class="share-photo post new-post general">Share a Photo</a>        
        </div>
        </aside>

<?php	}
 
}
register_widget('community_topics_Widget');