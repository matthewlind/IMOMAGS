<?php
	if (is_home() || is_search()) {
		get_template_part('footer/footer', 'default');
	}	else {
		if ( in_category('rigged-and-ready') || is_category('rigged-and-ready')) {
 			get_template_part('footer/footer', 'rigged-and-ready'); 			
		} else {
			get_template_part('footer/footer', 'default');
		}
	}
?>