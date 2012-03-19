<?php 
	if (!empty($title)) {
		if (!empty($pagination_url))
			echo '<h2 class="cfct-mod-title"><a href="'.$pagination_url.'">'.esc_html($title).'</a></h2>';
		else
			echo '<h2 class="cfct-mod-title">'.esc_html($title).'</h2>';
	}
?>
<div class="cfct-mod-content">
	<?php 
		echo $content; 
		
		if (!empty($pagination_url)) {
			echo '
				<div class="pagination">
					<span class="next"><a href="'.$pagination_url.'" title="Next Page">'.
						(!empty($pagination_text) ? $pagination_text : __('More', 'carrington-build').' &raquo;').
					'</a></span>
				</div>
				';
		} 
	?>
</div>