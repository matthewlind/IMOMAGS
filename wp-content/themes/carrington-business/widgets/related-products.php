<?php // Custom Related Products Widget

class Related_Products_Widget extends WP_Widget {
	function Related_Products_Widget() {
		$widget_ops = array('classname' => 'widget_rp_form', 'description' => 'Related Products Widget' );
		$this->WP_Widget('related_products', 'Related Products', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
		if(is_single()){   
		?>

			<aside id="related-products-widget">
			<div class="leikiSmartBanner"></div>
				<script>
				(function() {
					var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
					
					s.wname = 'sb300x250_intermedia';
					s.w = 300;
					s.h = 250;
					if (typeof leiki_count === 'undefined') leiki_count = 1;
					s.c = leiki_count;
					s.f = ((typeof leiki_first !== 'undefined')? leiki_first : 'undefined');
					
				   	var ts = new Date();
				   	s.src = 'http://kiwi12.leiki.com/focus/widgets/smartbanners/loader.js?ts='+(ts - ts % (24*3600*1000));
				   	s.onload = function() {loadBanner(document,s);};
				   	var x = document.getElementsByTagName('script')[0];
				   	x.parentNode.insertBefore(s, x);
				})();
				leiki_count++;
				leiki_first="no";
				</script>    
			</aside>
		<?php	
		}
	}
 
}
register_widget('Related_Products_Widget');