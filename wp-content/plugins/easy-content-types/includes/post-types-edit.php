<div id="icon-edit" class="icon32 icon32-posts-post"><br/></div>
<h2>
	<?php _e('Edit Post Type', 'ecpt'); ?> - 
	<a href="admin.php?page=easy-content-types/easy-content-types.php?posttypes" title="Go Back"><?php _e('Go Back', 'ecpt'); ?></a>
</h2>
<?php if(isset($_GET['post-type-updated'])) : ?>
	<div class="updated fade">
		<p><?php _e('Post type updated. If you changed the slug or name, you should update <a href="options-permalink.php">permalinks</a> now', 'ecpt'); ?></p>
	</div>
<?php endif; ?>	
<form id="ecpt-posttype-edit" method="POST">
	<table class="form-table">
	
		<tbody>
			<?php
			$i = 0;		
			// editing a posttype
			if(isset($_GET['posttype-edit'])) : 
		
				foreach( $wpdb->get_results("SELECT * FROM " . $ecpt_db_name . " WHERE id='" . $_GET['posttype-edit'] . "';") as $key => $posttype)
				{			
					?>			
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="posttype-name"><?php _e('Name', 'ecpt'); ?></label>
							</th>
							<td>
								<input type="text" name="posttype-name" id="posttype-name" value="<?php echo $posttype->name; ?>" />
								<p class="description"><?php _e('This is the name that will be used to query the post type from the database. Keep it a single word and simple.', 'ecpt'); ?></p>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="posttype-singlular"><?php _e('Single', 'ecpt'); ?></label>
							</th>
							<td>
								<input type="text" name="posttype-singlular" id="posttype-singlular" value="<?php echo $posttype->singular_name; ?>" />
								<p class="description"><?php _e('The single label is used to refer to single post type items, such as "Add New Book".', 'ecpt'); ?></p>
							
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="posttype-plural"><?php _e('Plural', 'ecpt'); ?></label>
							</th>
							<td>							
								<input type="text" name="posttype-plural" id="posttype-plural" value="<?php echo $posttype->plural_name; ?>" />
								<p class="description"><?php _e('The plural label is used to refer to plural post type items, such as "Search Books".', 'ecpt'); ?></p>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="posttype-slug"><?php _e('Slug', 'ecpt'); ?></label>
							</th>
							<td>
								<input type="text" name="posttype-slug" id="posttype-slug" value="<?php echo $posttype->slug; ?>" />
								<p class="description"><?php _e('The slug is the url friendly name of the post type.', 'ecpt'); ?></p>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="posttype-position"><?php _e('Menu Position', 'ecpt'); ?></label>
							</th>
							<td>
								<input type="text" name="posttype-position" id="posttype-position" value="<?php echo $posttype->menu_position; ?>" />
								<p class="description"><?php _e('The position of the post type in the menu. For help: ', 'ecpt'); ?><a href="wp-admin/admin.php?page=easy-content-types/easy-content-types.php?help#post-type-advanced"><?php _e('documentation', 'ecpt'); ?></p>
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
									if($posttype->has_archive == 1) { $checked = 'checked="checked"'; }
									echo '<div>';
									echo '<input type="checkbox" name="posttype-has_archive" id="posttype-has_archive"' . $checked . '/>';
									echo '<label for="posttype-has_archive">' . __('Archives', 'ecpt') . '</label></div>';					
									$checked = '';
								
									if($posttype->title == 1) { $checked = 'checked="checked"'; }
									echo '<div>';
									echo '<input type="checkbox" name="posttype-title" id="posttype-title"' . $checked . '/>';
									echo '<label for="posttype-title">' . __('Title', 'ecpt') . '</label></div>';									
									$checked = '';
								
									if($posttype->editor == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-editor" id="posttype-editor"' . $checked . '/>';
									echo '<label for="posttype-editor">' . __('Editor', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';
								
									if($posttype->author == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-author" id="posttype-author"' . $checked . '/>';
									echo '<label for="posttype-author">' . __('Author', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';
								
									if($posttype->thumbnail == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-thumbnail" id="posttype-thumbnail"' . $checked . '/>';
									echo '<label for="posttype-thumbnail">' . __('Thumbnail', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';
								
									if($posttype->excerpt == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-excerpt" id="posttype-excerpt"' . $checked . '/>';
									echo '<label for="posttype-excerpt">' . __('Excerpt', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';										
								
									if($posttype->fields == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-fields" id="posttype-fields"' . $checked . '/>';
									echo '<label for="posttype-fields">' . __('Custom Fields', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';
								
									if($posttype->comments == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-comments" id="posttype-comments"' . $checked . '/>';
									echo '<label for="posttype-comments">' . __('Comments', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';
								
								?>
								</div>
								<div class="ecpt-atts">
								<?php
								
									if($posttype->revisions == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-revisions" id="posttype-revisions"' . $checked . '/>';
									echo '<label for="posttype-revisions">' . __('Revisions', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';
								
									if($posttype->hierarchical == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-hierarchical" id="posttype-hierarchical"' . $checked . '/>';
									echo '<label for="posttype-hierarchical">' . __('Hierarchical', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';
								
									if($posttype->post_formats == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-post_formats" id="posttype-post_formats"' . $checked . '/>';
									echo '<label for="posttype-post_formats">' . __('Post Formats', 'ecpt') . '</label>';
									echo '</div>';
									$checked = '';
								
									if($posttype->exclude_from_search == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-exclude_from_search" id="posttype-exclude_from_search"' . $checked . '/>';
									echo '<label for="posttype-exclude_from_search">' . __('Exclude From Search', 'ecpt') . '</label>';
									echo '</div>';									
									$checked = '';
								
									if($posttype->show_in_nav_menus == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-show_in_nav_menus" id="posttype-show_in_nav_menus"' . $checked . '/>';
									echo '<label for="posttype-show_in_nav_menus">' . __('Show in Nav Menus', 'ecpt') . '</label>';
									echo '</div>';									
									$checked = '';
								
									if($posttype->with_front == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-with-front" id="posttype-with_front"' . $checked . '/>';
									echo '<label for="posttype-with_front">' . __('Disable with_front', 'ecpt') . '</label>';
									echo '</div>';	
									$checked = '';	
									if($posttype->post_tags == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-tags" id="posttype-tags"' . $checked . '/>';
									echo '<label for="posttype-tags">' . __('Enable Post Tags', 'ecpt') . '</label>';
									echo '</div>';	
									$checked = '';
								
									$checked = '';	
									if($posttype->categories == 1) { $checked = 'checked="checked"'; }
									echo '<div><input type="checkbox" name="posttype-categories" id="posttype-categories"' . $checked . '/>';
									echo '<label for="posttype-categories">' . __('Enable Categories', 'ecpt') . '</label>';
									echo '</div>';	
									$checked = '';
								?>
								</div>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="posttype-menu-icon"><?php _e('Menu Icon', 'ecpt'); ?></label>
							</th>
							<td>
								<?php if ($posttype->menu_icon != 'undefined' && $posttype->menu_icon != '') { ?>
								<img src="<?php echo $posttype->menu_icon; ?>" class="ecpt_menu_icon"/>
								<?php } else { ?>
								<img src="<?php echo $ecpt_base_dir; ?>/includes/images/icon.png" class="ecpt_menu_icon" />
								<?php } ?>
								<input type="text" name="posttype-menu-icon" class="ecpt_upload_image posttype-menu-icon" id="upload_image_<?php echo $posttype->id; ?>" value="<?php if ($posttype->menu_icon != 'undefined' && $posttype->menu_icon != '') { echo $posttype->menu_icon; } ?>" />
								<input id="upload_image_button_<?php echo $posttype->id; ?>" class="ecpt_upload_image_button edit_posttype_upload button-secondary" value="<?php _e('Choose Image', 'ecpt'); ?>" type="button" />
							</td>
						</tr>
					<?php
					$i++;
				}
			endif;
			?>	
		</tbody>
	</table>
	<p class="submit">
		<input type="hidden" name="posttype-id" value="<?php echo $posttype->id; ?>"/> 
		<input type="hidden" name="ecpt-action" value="update-post-type" />
		<input type="submit" class="button-primary posttype-update" value="<?php _e('Update', 'ecpt'); ?>"/>
	</p>
</form>