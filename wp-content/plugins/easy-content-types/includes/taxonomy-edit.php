<div id="icon-edit" class="icon32 icon32-posts-post"><br/></div>
<h2><?php _e('Edit Taxonomy ', 'ecpt'); ?>- <a href="admin.php?page=easy-content-types/easy-content-types.php?taxonomies" title="Go Back"><?php _e('Go Back', 'ecpt'); ?></a></h2>
<?php if(isset($_GET['taxonomy-updated'])) : ?>
	<div class="updated fade">
		<p><?php _e('Taxonomy updated. If you changed the slug or name, you should update <a href="options-permalink.php">permalinks</a> now', 'ecpt'); ?></p>
	</div>
<?php endif; ?>	
<form method="POST" id="ecpt-tax-edit">
	<table class="form-table">
		<tbody>
			<?php
			$i = 0;
		
			foreach( $wpdb->get_results("SELECT * FROM " . $ecpt_db_tax_name . " WHERE id ='" . $_GET['edit-tax'] . "';") as $key => $tax)
			{
				?>			
					<tr class="form-field">
						<th scope="row" valign="top">
							<label for="tax-name"><?php _e('Name', 'ecpt'); ?></label>
						</th>
						<td>
							<input type="text" name="tax-name" id="tax-name" value="<?php echo $tax->name; ?>" />
							<p class="description"><?php _e('The name is the variable used to query the taxonomy from the database.', 'ecpt'); ?></p>
						</td>
					</tr>
					<tr class="form-field">
						<th scope="row" valign="top">
							<label for="tax-singular"><?php _e('Single Label', 'ecpt'); ?></label>
						</th>
						<td>
							<input type="text" name="tax-singular" id="tax-singular" value="<?php echo $tax->singular_name; ?>" />
							<p class="description"><?php _e('The single label is used to refer to single taxonomy items, such as "View Genre".', 'ecpt'); ?></p>
						</td>
					</tr>
					<tr class="form-field">
						<th scope="row" valign="top">
							<label for="tax-plural"><?php _e('Plural Label', 'ecpt'); ?></label>
						</th>
						<td>
							<input type="text" name="tax-plural" id="tax-plural" value="<?php echo $tax->plural_name; ?>" />
							<p class="description"><?php _e('The plural name is used to refer to plural taxonomy items, such as "Search Genres".', 'ecpt'); ?></p>
						</td>
					</tr>
					<tr class="form-field">
						<th scope="row" valign="top">
							<label for="tax-page"><?php _e('Object(s)', 'ecpt'); ?></label>
						</th>
						<td>
							<select multiple name="tax-page[]" id="tax-page" class="ecpt-text no-float ecpt-multi-select"/>
								<?php
									$tax_objects = get_post_types('', 'objects');
									$pages = explode(',', $tax->page);
									foreach ($tax_objects as $object) {
										echo '<option', in_array($object->name, $pages) ? ' selected="selected"' : '', '>', $object->name, '</option>';
									}
								?>
							</select>
							<p class="description"><?php _e('The object is the post type that the taxonomy will be applied to. For example, if you choose "post", then this taxonomy will be available to the regular post object.', 'ecpt'); ?></p>
						</td>
					</tr>
					<tr class="form-field">
						<th scope="row" valign="top">
							<label for="tax-slug"><?php _e('Slug', 'ecpt'); ?></label>
						</th>
						<td>
							<input type="text" name="tax-slug" class="ecpt-text no-float" id="tax-slug" value="<?php echo $tax->slug; ?>" />
							<p class="description"><?php _e('The slug is the name you will use in the URL to display your taxonomy archive.', 'ecpt'); ?></p>
						</td>
					</tr>
					<tr class="form-field">
						<th scope="row" valign="top">
							<label><?php _e('Attributes', 'ecpt'); ?></label>
						</th>
						<td>
							<div class="ecpt-atts">
							<?php 
								$checked = '';
								if($tax->hierarchical == 1) { $checked = 'checked="checked"'; }
								echo '<div><input type="checkbox" name="tax-hierarchical" id="tax-hierarchical"' . $checked . '/>';
								echo '<label for="tax-hierarchical">' . __('Hierarchical', 'ecpt') . '</label>';
								echo '</div>';									
								$checked = '';
							
								if($tax->show_tagcloud == 1) { $checked = 'checked="checked"'; }
								echo '<div><input type="checkbox" name="tax-tagcloud" id="tax-tagcloud"' . $checked . '/>';
								echo '<label for="tax-tagcloud">' . __('Show Tag Cloud', 'ecpt') . '</label>';
								echo '</div>';									
								$checked = '';
							
								if($tax->show_in_nav_menus == 1) { $checked = 'checked="checked"'; }
								echo '<div><input type="checkbox" name="tax-show-in-nav" id="tax-show-in-nav"' . $checked . '/>';
								echo '<label for="tax-show-in-nav">' . __('Show in Nav Menu', 'ecpt') . '</label>';
								echo '</div>';
								$checked = '';
							
								if($tax->with_front == 1) { $checked = 'checked="checked"'; }
								echo '<div><input type="checkbox" name="tax-with-front" id="tax-with-front"' . $checked . '/>';
								echo '<label for="tax-with-front">' . __('Disable with_front', 'ecpt') . '</label>';
								echo '</div>';
								$checked = '';
								
								if( is_plugin_active('ecpt-filter-by-taxonomy/ecpt-filter-by-taxonomy.php') ) {
									if($tax->enable_filter == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="tax-enable-filter" id="tax-enable-filter"' . $checked . '/>';
									echo '<label for="tax-enable-filter">' . __('Enable taxonomy filter', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';
								}
							?>
							</div>
						</td>
					</tr>
				<?php $i++;
			}
			?>
		</tbody>
	</table>
	<p class="submit">
		<input type="hidden" name="ecpt-action" value="update-taxonomy" />
		<input type="hidden" name="tax-id" value="<?php echo $tax->id; ?>"/>
		<input type="submit" class="button-primary tax-update" value="<?php _e('Update', 'ecpt'); ?>"/>
	</p>
</form>