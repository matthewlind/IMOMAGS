<?php
/*
Plugin Name: IMO Category Custom Fields
Plugin URI: http://www.imomgas.com
Description: Adds a checkbox to turn a category page into a Network category page, among other things.
Author: Aaron Baker
Version: 0.1
*/


add_action('category_add_form_fields', 'imo_category_add_field');
add_action('category_edit_form_fields', 'imo_category_add_field');


add_action("pre_get_posts","imo_category_page_scripts");


function imo_category_page_scripts() {

	if ( is_category() ) {


		wp_enqueue_script("category-network-feed",plugins_url('category-network-feed.js', __FILE__),array('jquery'));

	}
}

function imo_category_add_field($term) {

	$term_id = $term->term_id;

	$networkFeedChecked = "";
	$fullWidthChecked = "";

	if (get_option('use_network_feed_'.$term_id))
		$networkFeedChecked = "checked";

	if (get_option('full_width_image_'.$term_id))
		$fullWidthChecked = "checked";


	echo "<tr class='form-field'>
			<th scope='row' valign='top'><label for='use_network_feed'>Use Network Feed </label></th>
			<td><input type='checkbox' style='width:20px' name='use_network_feed' id='use_network_feed' value='1' $networkFeedChecked />
				<span class='description'>Check this to pull content form this taxonomy from across the entire network</span>
			</td>
		</tr>";

	echo "<tr class='form-field'>
			<th scope='row' valign='top'><label for='full_width_image'>Full Width Image</label></th>
			<td><input type='checkbox' style='width:20px' name='full_width_image' id='ufull_width_image' value='1' $fullWidthChecked />
				<span class='description'>If the image below is intended to be shown without a title and description, check this.
				<h3>Image Upload Guidelines:</h3>
				<ul>
					<li>Full Width images should should have a width of 620px. Images shown with text should have a height of 100-120px. If the image is wider than 160px, the text will overlap the image. This may be what you want.</li>
				</ul>
				</span>
			</td>
		</tr>";
}



// save our taxonomy image while edit or save term
add_action('edit_term','save_imo_category_field');
add_action('create_term','save_imo_category_field');
function save_imo_category_field($term_id) {

    if(isset($_POST['use_network_feed']))
        update_option('use_network_feed_'.$term_id, $_POST['use_network_feed']);
    else
    	delete_option('use_network_feed_'.$term_id);

    if(isset($_POST['full_width_image']))
        update_option('full_width_image_'.$term_id, $_POST['full_width_image']);
    else
    	delete_option('full_width_image_'.$term_id);
}
