<!--custom metabox creation form-->
<h3><?php _e('Create New Custom Metabox', 'ecpt'); ?></h3>
<form method="post" action="" id="ecpt-add-metabox">
	<fieldset>
		<legend><?php _e('Metabox General', 'ecpt'); ?></legend><br/>
		
		<label for="ecpt-metabox-name"><?php _e('Metabox Name', 'ecpt'); ?><span class="required">*</span></label>
		<input type="text" name="metabox-name" id="ecpt-metabox-name" class="ecpt-text"/>
		<p class="ecpt-description"><?php _e('This is the main name of the metabox', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('The metabox name will show up in the header of the box on the editor screen', 'ecpt'); ?></span></a></p><br/>
		
		<label for="ecpt-metabox-page"><?php _e('Page', 'ecpt'); ?></label>
		<select name="metabox-page" id="ecpt-metabox-page" class="ecpt-text"/>
			<?php 
			$pages = get_post_types('', 'objects');
			$metabox_pages = array();
			foreach($pages as $page) { $metabox_pages[] = $page->name; }
			$metabox_pages[] = 'link';
			foreach ($metabox_pages as $metabox_page) {
				echo '<option>' . $metabox_page . '</option>';
			}
			?>
		</select>
		<p class="ecpt-description"><?php _e('This is the post type that will use this metabox', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('If you want to put the metabox on the regular Posts screen, then choose "post"', 'ecpt'); ?></span></a></p><br/>
		
		<label for="ecpt-metabox-context"><?php _e('Context', 'ecpt'); ?></label>
		<select name="metabox-context" id="ecpt-metabox-context" class="ecpt-text"/>
			<option><?php _e('normal', 'ecpt'); ?></option>
			<option><?php _e('advanced', 'ecpt'); ?></option>
			<option><?php _e('side', 'ecpt'); ?></option>
		</select>
		<p class="ecpt-description"><?php _e('The location on the editor screen to display the meta box.', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('Advanced / Normal = main column, with Advanced being above Normal. Side = right, narrow column.', 'ecpt'); ?></span></a></p><br/>
		
		<label for="ecpt-metabox-priority"><?php _e('Priority', 'ecpt'); ?></label>
		<select name="metabox-priority" id="ecpt-metabox-priority" class="ecpt-text"/>
			<option><?php _e('default', 'ecpt'); ?></option>
			<option><?php _e('high', 'ecpt'); ?></option>
			<option><?php _e('core', 'ecpt'); ?></option>
			<option><?php _e('low', 'ecpt'); ?></option>
		</select>
		<p class="ecpt-description"><?php _e('The priority determines how "high" the meta box appears in the editor', 'ecpt'); ?><a href="#" class="ecpt-help"><span class="tooltip center midnightblue"><?php _e('Metaboxes with "high" priorites will appear above boxes with "default" priority, for example', 'ecpt'); ?></span></a></p><br/>
		
	</fieldset><br/>
	<input type="hidden" name="ecpt-action" value="add-metabox"/>
	<input type="submit" id="ecpt-submit" class="button-primary" value="<?php _e('Add Meta Box', 'ecpt'); ?>"/>
</form>