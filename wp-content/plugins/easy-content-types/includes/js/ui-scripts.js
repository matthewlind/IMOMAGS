jQuery(document).ready(function($)
{
	
	if($('.form-table .ecpt_upload_field').length > 0 ) {
		// Media Uploader
		window.formfield = '';

		$('.ecpt_upload_image_button').on('click', function() {
			window.formfield = $('.ecpt_upload_field',$(this).parent());
            tb_show('', 'media-upload.php?post_id='+post_vars.post_id+'&type=file&TB_iframe=true');
            	return false;
        });

		window.original_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
			if (window.formfield) {
				imgurl = $('a','<div>'+html+'</div>').attr('href');
				window.formfield.val(imgurl);
				tb_remove();
			}
			else {
				window.original_send_to_editor(html);
			}
			window.formfield = '';
			window.imagefield = false;
		}
	}
	if($('.form-table .ecpt-slider').length > 0 ) {
		$('.ecpt-slider').each(function(){
			var $this = $(this);
			var id = $this.attr('rel');
			var val = $('#' + id).val();
			var max = $('#' + id).attr('rel');
			max = parseInt(max);
			//var step = $('#' + id).closest('input').attr('rel');
			$this.slider({
				value: val,
				max: max,
				step: 1,
				slide: function(event, ui) {
					$('#' + id).val(ui.value);
				}
			});
		});
	}
	
	if($('.form-table .ecpt_datepicker').length > 0 ) {
		var dateFormat = 'mm/dd/yy';
		$('.ecpt_datepicker').datepicker({dateFormat: dateFormat});
	}
	
	// add new repeatable field
	$(".ecpt_add_new_field").on('click', function() {					
		var field = $(this).closest('td').find("div.ecpt_repeatable_wrapper:last").clone(true);
		var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_wrapper:last');
		// get the hidden field that has the name value
		var name_field = $("input.ecpt_repeatable_field_name", ".ecpt_field_type_repeatable:first");
		// set the base of the new field name
		var name = $(name_field).attr("id");
		// set the new field val to blank
		$('input', field).val("");
		
		// set up a count var
		var count = 0;
		$('.ecpt_repeatable_field').each(function() {
			count = count + 1;
		});
		name = name + '[' + count + ']';
		$('input', field).attr("name", name);
		$('input', field).attr("id", name);
		field.insertAfter(fieldLocation, $(this).closest('td'));

		return false;
	});
	
	// add new repeatable upload field
	$(".ecpt_add_new_upload_field").on('click', function() {	
		var container = $(this).closest('tr');
		var field = $(this).closest('td').find("div.ecpt_repeatable_upload_wrapper:last").clone(true);
		var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_upload_wrapper:last');
		// get the hidden field that has the name value
		var name_field = $("input.ecpt_repeatable_upload_field_name", container);
		// set the base of the new field name
		var name = $(name_field).attr("id");
		// set the new field val to blank
		$('input[type="text"]', field).val("");
		
		// set up a count var
		var count = 0;
		$('.ecpt_repeatable_upload_field', container).each(function() {
			count = count + 1;
		});
		name = name + '[' + count + ']';
		$('input', field).attr("name", name);
		$('input', field).attr("id", name);
		field.insertAfter(fieldLocation, $(this).closest('td'));

		return false;
	});
	
	// remove repeatable field
	$('.ecpt_remove_repeatable').on('click', function(e) {
		e.preventDefault();
		var field = $(this).parent();
		$('input', field).val("");
		field.remove();				
		return false;
	});
});