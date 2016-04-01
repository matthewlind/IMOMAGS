<?php	
	global $microsite ;
	
	if ( $microsite ){ 
			get_template_part('footer/footer', 'microsite');
			
	} else { 
			get_template_part('footer/footer', 'redesign');
	} 
	
?>