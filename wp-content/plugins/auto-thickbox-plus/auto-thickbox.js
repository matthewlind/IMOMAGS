/*
 * JavaScript for Auto ThickBox Plus
 * Copyright (C) 2010-2012 attosoft <http://attosoft.info/en/>
 * This file is distributed under the same license as the Auto ThickBox Plus package.
 * attosoft <contact@attosoft.info>, 2012.
 */

jQuery(function($) {
	postboxes.add_postbox_toggles("auto-thickbox-options");

	$(".colorpicker").each(function() {
		var text = $(this).prevAll("label").children("input:text");
		var checkbox = $(this).nextAll("label").children("input:checkbox");
		var preview = $(this).prevAll(".colorpreview");
		var fb = $.farbtastic(this, function(color) {
			text.val(color);
			preview.css("backgroundColor", color);
			text.filter(":disabled").removeAttr("disabled");
			checkbox.filter(":checked").removeAttr("checked");
		});
		if (text.val()[0] == '#') fb.setColor(text.val()); // color in hex
		else preview.css("backgroundColor", text.val());
	});
	$(".pickcolor").click(function() { $(this).nextAll(".colorpicker").show(); return false; });
	$(document).mousedown(function() { $(".colorpicker:visible").hide(); });

	$("#opacity-bg-slider").slider({
		max: 1,
		step: 0.05,
		value: $("#opacity-bg").val(),
		slide: function(event, ui) { $("#opacity-bg").val(ui.value); },
		change: function(event, ui) { $("#opacity-bg").val(ui.value); }
	});
	$("#opacity-bg-trans").click(function() { $("#opacity-bg-slider").slider("value", 0); });
	$("#opacity-bg-opaque").click(function() { $("#opacity-bg-slider").slider("value", 1); });
});

function updateEffectSpeed(radio) {
	var text = document.form[radio.name][document.form[radio.name].length - 1]
	text.disabled = radio.value != "number";
	switch (radio.value) {
		case "fast": text.value = "200"; break;
		case "normal": text.value = "400"; break;
		case "slow": text.value = "600"; break;
	}
}

function disableClickEnd(disabled) {
	disabled = typeof disabled === 'boolean' ? disabled : true;
	for (var i = 0; i < document.form['auto-thickbox-plus[click_end]'].length; i++)
		document.form['auto-thickbox-plus[click_end]'][i].disabled = disabled;
}

function disableOption(checkbox) {
	document.form[checkbox.name][0].disabled = checkbox.checked;
}
