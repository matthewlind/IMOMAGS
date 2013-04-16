<?php

namespace imo;
/**
 * Cabela's Essentials Scroll Widget
 *
 * Cabela's essentials scroller for article pages.
 */
class CabelasEssentialsScrollWidget extends \WP_Widget {

    function __construct()
    {
        parent::__construct("fdgg-widget", "Cabela's Essentials Scroll Widget");
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget() {
    ?>      
    	
	    <aside id="gift-guide">

				</aside>
		<div style="clear:both;"></div>

<?php
                    
      
    }

 }       

add_action("widgets_init", function() {
    return register_widget("imo\CabelasEssentialsScrollWidget");
});

