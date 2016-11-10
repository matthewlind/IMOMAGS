<?php
if (have_rows('upload_photo', 'options')) {
	while (have_rows('upload_photo', 'options')) {
		the_row();
		$p_title 		= get_sub_field('title');
		$p_subtitle 	= get_sub_field('subtitle');
		$p_post_id_1 	= get_sub_field('post_id_1');
		$p_post_id_2 	= get_sub_field('post_id_2');
		$p_title_1		= get_the_title($p_post_id_1);
		$p_permalink_1	= get_permalink($p_post_id_1);
		$p_thumb_1		= get_the_post_thumbnail($p_post_id_1, 'list-thumb');
		$p_title_2		= get_the_title($p_post_id_2);
		$p_permalink_2	= get_permalink($p_post_id_2);
		$p_thumb_2		= get_the_post_thumbnail($p_post_id_2, 'list-thumb');
		$p_buttons		= '';
		$p_links		= '';
		if (have_rows('buttons')) {
			while (have_rows('buttons')){
				the_row();
				$p_button_text 	= get_sub_field('button_text');
				$p_button_url 	= get_sub_field('button_url');
				$p_buttons .= '<a class="btn-lg" href="'.$p_button_url.'" target="_blank">'.$p_button_text.'</a>'.PHP_EOL;
			}
		}
		if (have_rows('links')) {
			while (have_rows('links')){
				the_row();
				$p_link_text 	= get_sub_field('link_text');
				$p_link_url 	= get_sub_field('link_url');
				$p_links .= '<a class="link-to-all" href="'.$p_link_url.'">'.$p_link_text.'</a>'.PHP_EOL;
			}
		}
	}
?>	
<section class="section-twins">
	<div class="section-inner-wrap clearfix">
		<div class="twins-title">
		<?php
			echo '<h1>'.$p_title.'</h1>';
			if ($p_subtitle) { echo '<span>'.$p_subtitle.'</span><br>'; }
			if (!empty($p_buttons)) { echo '<div class="twins-btns">'. $p_buttons	.'</div>';}
			echo $p_links; 
		?>
		</div>
		<div class="twins-thumbs clearfix">
			<ul>
				<li class="twins-item">
					<div class="twins-img"><a href="<?php echo $p_permalink_1; ?>"><?php echo $p_thumb_1; ?></a></div>
					<div class="twins-thumb-title">
						<h3><a href="<?php echo $p_permalink_1; ?>"><?php echo $p_title_1; ?></a></h3>
					</div>
				</li>
				<li class="twins-item">
					<div class="twins-img"><a href="<?php echo $p_permalink_2; ?>"><?php echo $p_thumb_2; ?></a></div>
					<div class="twins-thumb-title">
						<h3><a href="<?php echo $p_permalink_2; ?>"><?php echo $p_title_2; ?></a></h3>
					</div>
				</li>
			</ul>
		</div>
	</div>
</section>	
<?php }	?>
