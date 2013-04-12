<?php

namespace imo;
/**
 * Father's Day Gift Guide Widget
 *
 * Creates the cross site feed for Father's Day Gift Guide. 
 */
class FathersDayGiftGuideWidget extends \WP_Widget {

    function __construct()
    {
        parent::__construct("fdgg-widget", "Father's Day Gift Guide Widget");
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget() {
    ?>      
    	
	    <aside id="gift-guide">

			<div class="gift-guide-widget">
				<h3 class="widget-title"><span>Father's Day Gift Guide</span></h3>
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1">Shooting<div class="arrow">&nbsp;</div></a></li>
						<li><a href="#tabs-2">Hunting<div class="arrow">&nbsp;</div></a></li>
						<li><a href="#tabs-3">Fishing<div class="arrow">&nbsp;</div></a></li>
					</ul>
										
						<div class="network-feed">
							<ul id="tabs-1" class="gift-guide" term="fathers-day-gift-guide">
						    	<li>tab1</li>
						    	<li class="gg-presented">Presented by</li>
						    	<li class="gg-sponsor-logo">
							    	<!-- add script for sponsor instead -->
							    	<a href="#" target="_blank"><img src="/wp-content/plugins/imo-gift-guide/img/slidefire-logo.jpg" alt="Galco" /></a>
							    </li>
							</ul>
							
							<ul id="tabs-2" class="gift-guide" term="fathers-day-gift-guide">
						    	<li>tab2</li>
						    	<li class="gg-presented">Presented by</li>
						    	<li class="gg-sponsor-logo">
							    	<!-- add script for sponsor instead -->
							    	<a href="#" target="_blank"><img src="/wp-content/plugins/imo-gift-guide/img/slidefire-logo.jpg" alt="Galco" /></a>
							    </li>
							</ul>
							
							<ul id="tabs-3" class="gift-guide" term="fathers-day-gift-guide">
						    	<li>tab3</li>
						    	<li class="gg-presented">Presented by</li>
						    	<li class="gg-sponsor-logo">
							    	<!-- add script for sponsor instead -->
							    	<a href="#" target="_blank"><img src="/wp-content/plugins/imo-gift-guide/img/slidefire-logo.jpg" alt="Galco" width="122" height="auto" /></a>
							    </li>
							</ul>
						</div>
					</div>
							</div>
			<div class="btm-bg"></div>
		</aside>
		<div style="clear:both;"></div>
		<!-- clone -->
		<li id="gg-widget-template" style="display:none;">
			<a class="network-thumb" href="http://www.northamericanwhitetail.deva/2012/03/13/deer-of-the-day-buckeye-brute-alexa-perry/"><img src="http://www.handgunsmag.com/files/2013/04/Picking-duty-pistols-190x120.jpg" alt="title" /></a>
			<div class="site"><a href="http://gunsandammo.com">www.gunsandammo.com</a></div>				
			<a class="title" rel="bookmark" href="http://www.northamericanwhitetail.deva/2012/03/13/deer-of-the-day-buckeye-brute-alexa-perry/">Deer of the Day Buckeye Brute, Alexa Perry</a>				
		</li>
<?php
                    
      
    }

 }       

add_action("widgets_init", function() {
    return register_widget("imo\FathersDayGiftGuideWidget");
});

