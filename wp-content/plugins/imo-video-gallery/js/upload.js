jQuery(document).ready(function() {
	
	jQuery('.microsite_image_upload_button').click(function() {
		
		formfield = jQuery(this).prev().attr('id');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});

	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		jQuery('#'+formfield).val(imgurl);
		tb_remove();
	}

});