<h2><?php _e('Easy Custom Meta Boxes', 'ecpt'); ?></h2>
<?php if(isset($_GET['metabox-added'])) : ?>
	<div class="updated fade">
		<p><?php _e('Meta Box added. Now you should add some fields to your meta box by clicking "Edit Fields"', 'ecpt'); ?></p>
	</div>
<?php endif; ?>		
<table class="wp-list-table widefat fixed posts">
	<thead>
		<tr>
			<th><?php _e('Name', 'ecpt'); ?></th>
			<th><?php _e('ID', 'ecpt'); ?></th>
			<th><?php _e('Page', 'ecpt'); ?></th>
			<th><?php _e('Context', 'ecpt'); ?></th>
			<th><?php _e('Priority', 'ecpt'); ?></th>
			<th><?php _e('Fields', 'ecpt'); ?></th>
			<th><?php _e('Edit', 'ecpt'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th><?php _e('Name', 'ecpt'); ?></th>
			<th><?php _e('ID', 'ecpt'); ?></th>
			<th><?php _e('Page', 'ecpt'); ?></th>
			<th><?php _e('Context', 'ecpt'); ?></th>
			<th><?php _e('Priority', 'ecpt'); ?></th>
			<th><?php _e('Fields', 'ecpt'); ?></th>
			<th><?php _e('Edit', 'ecpt'); ?></th>
		</tr>
	</tfoot>
	<tbody>
	<?php
	$i = 0;
	$metaboxes = ecpt_get_cached_metaboxes();
	
	foreach( $metaboxes as $key => $metabox) 
	{
		$name = $metabox->name;
		?>			
			<tr <?php if(ecpt_is_odd($i)) { echo 'class="alternate"'; } ?> id="ecpt-metabox-<?php echo $metabox->id; ?>">
				<td><?php echo $metabox->nicename; ?></td>
				<td><?php echo $metabox->name; ?></td>
				<td><?php echo $metabox->page; ?></td>
				<td><?php echo $metabox->context; ?></td>
				<td><?php echo $metabox->priority; ?></td>
				<td>
					<?php
						foreach( $wpdb->get_results("SELECT * FROM " . $ecpt_db_meta_fields_name . " WHERE parent='" . $name . "';") as $key => $meta_field)	
						{
							echo $meta_field->nicename . ', ';
						}
					?>
				</td>
				<td>
					<a href="admin.php?page=easy-content-types/easy-content-types.php?metaboxes&metabox-edit=<?php echo $metabox->id; ?>" title="<?php _e('Edit Metabox', 'ecpt'); ?>" class="ecpt-edit"><?php _e('Edit', 'ecpt'); ?></a> | 
					<a href="admin.php?page=easy-content-types/easy-content-types.php?metaboxes&fields-edit=<?php echo $metabox->id; ?>" title="<?php _e('Edit Fields', 'ecpt'); ?>" class="ecpt-edit"><?php _e('Edit Fields', 'ecpt'); ?></a> | 
					<a href="admin.php?page=easy-content-types/easy-content-types.php?metaboxes&ecpt-action=delete-metabox&metabox-id=<?php echo $metabox->id; ?>&metabox-name=<?php echo $metabox->name; ?>" title="<?php _e('Delete', 'ecpt'); ?> <?php echo $metabox->name; ?>" class="ecpt-delete-metabox" id="ecpt-delete-<?php echo $metabox->id; ?>"><?php _e('Delete', 'ecpt'); ?></a>
				</td>
			</tr>
		<?php $i++;
	} ?>
	</tbody>
</table>
<p><?php _e('Click the "Edit Fields" link in order to add fields to a meta box', 'ecpt'); ?></p>
<p><?php _e('Need help displaying the content from your meta boxes?', 'ecpt'); ?> <a href="admin.php?page=easy-content-types/easy-content-types.php?help#field-info"><?php _e('Click here', 'ecpt'); ?></a>.