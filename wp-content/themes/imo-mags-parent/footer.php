<?php
	$rigged_cat = array("riggedready", "northeast", "southeast", "midwest", "southwest", "northwest");
	
	
	if (is_home() || is_search()) {
		get_template_part('footer/footer', 'default');
	}	else {
		if ( in_category($rigged_cat) || is_category($rigged_cat)) {
 			get_template_part('footer/footer', 'riggedready'); 			
		} else {
			get_template_part('footer/footer', 'default');
		}
	}
?>