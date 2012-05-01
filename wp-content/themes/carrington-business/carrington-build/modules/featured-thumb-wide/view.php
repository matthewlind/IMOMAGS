      <!-- start feature -->



    <div class='featured-wide-articles'>


	<?php
		
		
		
		if (!empty($items)) {
			$count = 0;
			foreach ($items as $key => $item) {
				
				$count++;
				
				
				?>
					<div class='featured-item-pane' id='featured-item-<?php echo $count; ?>'>
						<div class='featured-item-image'>
						   <a href="<?php echo $item['link']; ?>"><img style="width:648px;height:auto;" src="<?php echo $item['img_src'][0]; ?>"/></a>
						</div>
						<div class='featured-item-description'>
						  <h2><a href="<?php echo $item['link']; ?>"><?php echo $item['title']; ?></a></h2>
						</div>
					</div>
				
				<?php
				
				
			}
		}
	?>
			
		
		
		   
    
</div>
 <!-- end feature -->  

