<?php

namespace imo;
$should_print_my_script = true;

/**
 * IMOcsfWidget
 *
 * Creates the cross site feed for a page. 
 */
class IMOcsfWidget extends \WP_Widget {

    function __construct()
    {
        parent::__construct("csf-widget", "IMO Cross Site Feed Widget");
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget() {
    ?>      
    	<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700' rel='stylesheet' type='text/css'>
    	<aside id="cross-site-feed-widget" class="box">
	    	<div class="logo"></div>
		    <div class="cross-site-feed-widget" term=""></div><!-- This term= attribute is searched for by displayCrossSiteFeed() in cross-site-feed.js -->
	    </aside>
	    
	    <article id="excerpt-widget-template" class="post type-post status-publish format-standard hentry entry entry-excerpt has-img" style="display:none;">
			<a href="http://www.northamericanwhitetail.deva/2012/03/13/deer-of-the-day-buckeye-brute-alexa-perry/" target="_blank"><img width="130" height="auto" src="http://www.northamericanwhitetail.deva/files/2012/03/NAWdd_031312-190x120.jpg" class="entry-img wp-post-image" alt="" title="" /></a>
			
			<div class="entry-summary">
				
				<h2 class="entry-title"><a rel="bookmark" href="http://www.northamericanwhitetail.deva/2012/03/13/deer-of-the-day-buckeye-brute-alexa-perry/" target="_blank">Deer of the Day Buckeye Brute, Alexa Perry</a></h2>
				<span class="entry-category"><a href="http://www.northamericanwhitetail.deva/category/deer-of-the-day/" title="View all posts in Deer of the Day" rel="category tag" target="_blank">Deer of the Day</a></span>
			</div>
		</article>
		

<?php
                    
      
    }

 }       

add_action("widgets_init", function() {
    return register_widget("imo\IMOcsfWidget");
});

