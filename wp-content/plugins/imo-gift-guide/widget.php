<?php

namespace imo;
/**
 * Gift Guide Widget
 *
 * Creates the cross site feed for Gift Guides. 
 */
 

 //TO DO: Add campaign choices in admin area and populate them in the term field
 
class GiftGuideWidget extends \WP_Widget {

    function __construct()
    {
        parent::__construct("gg-widget", "Gift Guide Widget");
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget($args, $instance) {
    	extract($args, EXTR_SKIP);

	    $dartSite = get_option('dart_domain'); 
	     	
	    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
	    $camp = empty($instance['camp']) ? '' : apply_filters('widget_camp', $instance['camp']);
    ?>      
    	
	    <aside id="gift-guide">
			<div class="gift-guide-widget">
			<?php if(!empty($title)) : ?>
			<h3 class="widget-title">
				<span><?php echo $title; ?></span>
				</h3>
			<?php endif; ?>
				<div id="tabs">
					<ul>
						<li id="tab-shoot"><a href="#tabs-1">Shooting<div class="arrow">&nbsp;</div></a></li>
						<li id="tab-hunt"><a href="#tabs-2">Hunting<div class="arrow">&nbsp;</div></a></li>
						<li id="tab-fish"><a href="#tabs-3">Fishing<div class="arrow">&nbsp;</div></a></li>
					</ul>
										
						<div class="network-feed">
							<ul id="tabs-1" class="gift-guide" term="<?php echo $camp; ?>">
								<li></li>
								<ul class="gg-sponsor">
							    	<li class="gg-presented"><p>Presented by</p></li>
							    	<li class="gg-sponsor-logo">
								    	<!-- Site - Guns and Ammo -->
										<script type="text/javascript">
										  var ord = window.ord || Math.floor(Math.random() * 1e16);
										  document.write('<a href="http://ad.doubleclick.net/N4930/jump/<?php echo $dartSite; ?>;sz=1x1;camp=shoot;ord=' + ord + '?"><img src="http://ad.doubleclick.net/N4930/ad/<?php echo $dartSite; ?>;sz=1x1;camp=shoot;ord=' + ord + '?" width="1" height="1" /></a>');
										</script>
										<noscript>
										<a href="http://ad.doubleclick.net/N4930/jump/<?php echo $dartSite; ?>;sz=1x1;camp=shoot;ord=[timestamp]?">
										<img src="http://ad.doubleclick.net/N4930/ad/<?php echo $dartSite; ?>;sz=1x1;camp=shoot;ord=[timestamp]?" width="1" height="1" />
										</a>
										</noscript>
								    </li>
							    </ul>
							    
							</ul>
							<ul id="tabs-2" class="gift-guide" term="<?php echo $camp; ?>">
						    	<li></li>
						    	<ul class="gg-sponsor">
							    	<li class="gg-presented"><p>Presented by</p></li>
							    	<li class="gg-sponsor-logo">
								    	<!-- Site - Hunting -->
										<script type="text/javascript">
										  var ord = window.ord || Math.floor(Math.random() * 1e16);
										  document.write('<a href="http://ad.doubleclick.net/N4930/jump/<?php echo $dartSite; ?>;sz=1x1;camp=hunt;ord=' + ord + '?"><img src="http://ad.doubleclick.net/N4930/ad/<?php echo $dartSite; ?>;sz=1x1;camp=hunt;ord=' + ord + '?" width="1" height="1" /></a>');
										</script>
										<noscript>
										<a href="http://ad.doubleclick.net/N4930/jump/<?php echo $dartSite; ?>;sz=1x1;camp=hunt;ord=[timestamp]?">
										<img src="http://ad.doubleclick.net/N4930/ad/<?php echo $dartSite; ?>;sz=1x1;camp=hunt;ord=[timestamp]?" width="1" height="1" />
										</a>
										</noscript>
								    </li>
						    	</ul>
							</ul>
							
							<ul id="tabs-3" class="gift-guide" term="<?php echo $camp; ?>">
						    	<li></li>
						    	<ul class="gg-sponsor">
							    	<li class="gg-presented"><p>Presented by</p></li>
							    	<li class="gg-sponsor-logo">
								    	<!-- Site - Hunting -->
										<script type="text/javascript">
										  var ord = window.ord || Math.floor(Math.random() * 1e16);
										  document.write('<a href="http://ad.doubleclick.net/N4930/jump/<?php echo $dartSite; ?>;sz=1x1;camp=fish;ord=' + ord + '?"><img src="http://ad.doubleclick.net/N4930/ad/<?php echo $dartSite; ?>;sz=1x1;camp=fish;ord=' + ord + '?" width="1" height="1" /></a>');
										</script>
										<noscript>
										<a href="http://ad.doubleclick.net/N4930/jump/<?php echo $dartSite; ?>;sz=1x1;camp=fish;ord=[timestamp]?">
										<img src="http://ad.doubleclick.net/N4930/ad/<?php echo $dartSite; ?>;sz=1x1;camp=fish;ord=[timestamp]?" width="1" height="1" />
										</a>
										</noscript>
									</li>
						    	</ul>
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
			<a href="http://gunsandammo.com" class="site">www.gunsandammo.com</a>			
			<a class="title" rel="bookmark" href="http://www.northamericanwhitetail.deva/2012/03/13/deer-of-the-day-buckeye-brute-alexa-perry/">Deer of the Day Buckeye Brute, Alexa Perry</a>				
		</li>

    <?php	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['camp'] = $new_instance['camp'];
		return $instance;
	}
 
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => '','camp' => ''));
		$title = strip_tags($instance['title']);
		$camp = $instance['camp']
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Holiday Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
			
			<p>Ad Campaign:
			<?php $terms = get_terms( 'campaign', 'orderby=count&hide_empty=0' ); ?>
				<select id="<?php echo $this->get_field_id('camp'); ?>" name="<?php echo $this->get_field_name('camp'); ?>" class="widefat" style="width:100%;">
				    <?php 

				    foreach( $terms as $term) { ?>
				        <option <?php selected( $instance['camp'], $term->name ); ?> value="<?php echo $term->name; ?>"><?php echo $term->name; ?></option>
				    <?php 

				    } ?>      
				</select>
			</p>
<?php
	}


 }       

add_action("widgets_init", function() {
    return register_widget("imo\GiftGuideWidget");
});

