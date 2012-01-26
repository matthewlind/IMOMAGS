<?php
	if (!empty($title)) {
		echo '<h2 class="cfct-mod-title">';
		if (!empty($pagination_url)) 
			echo '<a href="'.$pagination_url.'" title="Next Page">';
		echo esc_html($title);
		if (!empty($pagination_url)) 
			echo '</a>';
		echo '</h2>';
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