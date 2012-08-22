      <!-- start feature -->



    <div class='featured-articles'>


	<?php
		
		
		
		if (!empty($items)) {
			$count = 0;
			foreach ($items as $key => $item) {
				
				$count++;
				
				
				?>
					<div class='featured-item-pane' id='featured-item-<?php echo $count; ?>'>
						<div class='featured-item-image'>
						    <a href="<?php echo $item['link']; ?>"><img src="<?php echo $item['img_src'][0]; ?>"/></a>
						</div>
						<div class='featured-item-description'>
						  <h2><a href="<?php echo $item['link']; ?>"><?php echo $item['title']; ?></a></h2>
						</div>
					</div>
				
				<?php
				
				
			}
		}
	?>
			
			
	<ul id='featured-articles-navigator'>		
	<?php
		
		
		if (!empty($items)) {
			$count = 0;
			foreach ($items as $key => $item) {
				
				$count++;
				
				
				
				if ($count == 1)
					$listClass = "class='first'";
				else
					$listClass = "";
				
				?>
					<li <?php echo $listClass; ?>>
						<a href="#featured-item-<?php echo $count; ?>">
							<img src='<?php echo $item['img_src_thumb'][0]; ?>'/>
						</a>
					</li>
				
				<?php
				
				
			}
		}
	?>
	</ul>		
			
			
				
				
		   
    
</div>
 <!-- end feature -->  
<?php echo $js_init; ?>
