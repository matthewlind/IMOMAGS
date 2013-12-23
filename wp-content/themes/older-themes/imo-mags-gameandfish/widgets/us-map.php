<?php // Custom US Map Nav Widget

class us_map_Widget extends WP_Widget {
	function us_map_Widget() {
		$widget_ops = array('classname' => 'widget_us_map', 'description' => 'US Map Widget.' );
		$this->WP_Widget('us_map', 'US Map', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
?>

    <aside id="us-map-nav" class="us-map-widget">
    <div class="state-info">
    	<h2>Select Your state</h2>
    	<p class="state-name"></p>
    	<div class="state-list">
	    	<ul>
	    		<li>NEW ENGLAND</li>
	    		<li><a href="/connecticut/">connecticut</a></li>
	    		<li><a href="/maine/">maine</a></li>
	    		<li><a href="/massachusetts/">massachusetts</a></li>
	    		<li><a href="/newhampshire/">new hampshire</a></li>
				<li><a href="/rhodeisland/">rhode island</a></li>
	    		<li><a href="/vermont/">vermont</a></li>
	    		<li>NORTHEAST</li>
	    		<li><a href="/delaware/">delaware</a></li>
				<li><a href="/maryland/">maryland</a></li>		
				<li><a href="/newjersey/">new jersey</a></li>
				<li><a href="/newyork/">new york</a></li>
				<li><a href="/pennsylvania/">pennsylvania</a></li>
				<li>MIDWEST</li>
				<li><a href="/illinois/">illinois</a></li>
				<li><a href="/indiana/">indiana</a></li>
				<li><a href="/iowa/">iowa</a></li>
				<li><a href="/kansas/">kansas</a></li>
				<li><a href="/michigan/">michigan</a></li>
			</ul>
	    	<ul>	
				<li><a href="/minnesota/">minnesota</a></li>
				<li><a href="/missouri/">missouri</a></li>
				<li><a href="/nebraska/">nebraska</a></li>
				<li><a href="/northdakota/">north dakota</a></li>
				<li><a href="/ohio/">ohio</a></li>
				<li><a href="/wisconsin/">wisconsin</a></li>
				<li><a href="/southdakota/">south dakota</a></li>
				<li>ROCKY MOUNTAINS</li>
				<li><a href="/colorado/">colorado</a></li>
				<li><a href="/idaho/">idaho</a></li>
				<li><a href="/montana/">montana</a></li>
				<li><a href="/utah/">utah</a></li>
				<li><a href="/wyoming/">wyoming</a></li>
				<li>SOUTH</li>
	    		<li><a href="/alabama/">alabama</a></li>
				<li><a href="/arkansas/">arkansas</a></li>
				<li><a href="/florida/">florida</a></li>
				<li><a href="/georgia/">georgia</a></li>
			</ul>
	    	<ul>	
				<li><a href="/kentucky/">kentucky</a></li>
				<li><a href="/louisiana/">louisiana</a></li>		
				<li><a href="/mississippi/">mississippi</a></li>
				<li><a href="/northcarolina/">north carolina</a></li>
				<li><a href="/southcarolina/">south carolina</a></li>
				<li><a href="/tennessee/">tennessee</a></li>
				<li><a href="/virginia/">virginia</a></li>
				<li><a href="/westvirginia/">west virginia</a></li>
				<li>SOUTHWEST</li>
	    		<li><a href="/arizona/">arizona</a></li>
				<li><a href="/nevada/">nevada</a></li>
				<li><a href="/newmexico/">new mexico</a></li>
				<li><a href="/oklahoma/">oklahoma</a></li>	
				<li><a href="/texas/">texas</a></li>
	    		<li>WEST COAST</li>
				<li><a href="/california/">california</a></li>
				<li><a href="/oregon/">oregon</a></li>
				<li><a href="/washington/">washington</a></li>
	    	</ul>
    	</div>
    </div>
     	<div id="us-map-ubermenu-container" style="min-width: 686px;height: 420px;margin-left: 400px;padding-top:30px;"></div>
    </aside>

<?php	}
 
}
register_widget('us_map_Widget');