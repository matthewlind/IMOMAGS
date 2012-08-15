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
	         	<option value="" selected>Choose a Topic</option>        
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
		          <select name="state" class="post_type">
		            <option value="">Choose State</option>
		            <option value="AL">Alabama</option>
		            <option value="AK">Alaska</option>
		            <option value="AZ">Arizona</option>
		            <option value="AR">Arkansas</option>
		            <option value="CA">California</option>
		            <option value="CO">Colorado</option>
		            <option value="CT">Connecticut</option>
		            <option value="DE">Delaware</option>
		            <option value="DC">District of Columbia</option>
		            <option value="FL">Florida</option>
		            <option value="GA">Georgia</option>
		            <option value="HI">Hawaii</option>
		            <option value="ID">Idaho</option>
		            <option value="IL">Illinois</option>
		            <option value="IN">Indiana</option>
		            <option value="IA">Iowa</option>
		            <option value="KS">Kansas</option>
		            <option value="KY">Kentucky</option>
		            <option value="LA">Louisiana</option>
		            <option value="ME">Maine</option>
		            <option value="MD">Maryland</option>
		            <option value="MA">Massachusetts</option>
		            <option value="MI">Michigan</option>
		            <option value="MN">Minnesota</option>
		            <option value="MS">Mississippi</option>
		            <option value="MO">Missouri</option>
		            <option value="MT">Montana</option>
		            <option value="NE">Nebraska</option>
		            <option value="NV">Nevada</option>
		            <option value="NH">New Hampshire</option>
		            <option value="NJ">New Jersey</option>
		            <option value="NM">New Mexico</option>
		            <option value="NY">New York</option>
		            <option value="NC">North Carolina</option>
		            <option value="ND">North Dakota</option>
		            <option value="OH">Ohio</option>
		            <option value="OK">Oklahoma</option>
		            <option value="OR">Oregon</option>
		            <option value="PA">Pennsylvania</option>
		            <option value="RI">Rhode Island</option>
		            <option value="SC">South Carolina</option>
		            <option value="SD">South Dakota</option>
		            <option value="TN">Tennessee</option>
		            <option value="TX">Texas</option>
		            <option value="UT">Utah</option>
		            <option value="VT">Vermont</option>
		            <option value="VA">Virginia</option>
		            <option value="WA">Washington</option>
		            <option value="WV">West Virginia</option>
		            <option value="WI">Wisconsin</option>
		            <option value="WY">Wyoming</option>
		            <option value="CN">Canada</option>
		            <option value="AB">Alberta</option>
		            <option value="BC">British Columbia</option>
		            <option value="MB">Manitoba</option>
		            <option value="NB">New Brunswick</option>
		            <option value="NL">Newfoundland and Labrador</option>
		            <option value="NT">Northwest Territories</option>
		            <option value="NS">Nova Scotia</option>
		            <option value="NU">Nunavut</option>
		            <option value="ON">Ontario</option>
		            <option value="PE">Prince Edward Island</option>
		            <option value="QC">Quebec</option>
		            <option value="SK">Saskatchewan</option>
		            <option value="YT">Yukon</option>
		            <option value="AG">Aguascalientes</option>
		            <option value="BJ">Baja California</option>
		            <option value="BS">Baja California Sur</option>
		            <option value="CP">Campeche</option>
		            <option value="CH">Chiapas</option>
		            <option value="CI">Chihuahua</option>
		            <option value="CU">Coahuila</option>
		            <option value="CL">Colima</option>
		            <option value="DF">Distrito Federal</option>
		            <option value="DG">Durango</option>
		            <option value="GJ">Guanajuato</option>
		            <option value="GR">Guerrero</option>
		            <option value="HG">Hidalgo</option>
		            <option value="JA">Jalisco</option>
		            <option value="EM">Mexico</option>
		            <option value="MH">Michoacán</option>
		            <option value="MR">Morelos</option>
		            <option value="NA">Nayarit</option>
		            <option value="NL">Nuevo León</option>
		            <option value="OA">Oaxaca</option>
		            <option value="PU">Puebla</option>
		            <option value="QA">Querétaro</option>
		            <option value="QR">Quintana Roo</option>
		            <option value="SL">San Luis Potosi</option>
		            <option value="SI">Sinaloa</option>
		            <option value="SO">Sonora</option>
		            <option value="TA">Tabasco</option>
		            <option value="TM">Tamaulipas</option>
		            <option value="TL">Tlaxcala</option>
		            <option value="VZ">Veracruz</option>
		            <option value="YC">Yucatan</option>
		            <option value="ZT">Zacatecas</option>
		
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