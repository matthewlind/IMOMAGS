<?php	
	if ( $microsite = true ){ 
		echo "<!-- This is microsite AAAAAAABBBB  -->";
			get_template_part('footer/footer', 'microsite');
			
	} else { 
		echo "<!-- NOT A microsite  -->";
			get_template_part('footer/footer', 'default');
	} 
?>