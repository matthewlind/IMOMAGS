/**
 * Scripts.js
 */

var dartadsgen_rand = Math.floor((Math.random()) * 100000000), pr_tile = 1, dartadsgen_site="gunsandammo";


jQuery(document).ready(function($) {
  
  // Add some nth-child love for IE
  $('#secondary aside:nth-child(3n)').addClass('last');
  $('.fancy > li:nth-child(2n+1)').addClass('odd');

  // A little magic for browsers that don't support the HTML5 placeholder attribute
  // via WebDesignerWall.com
  if (!Modernizr.input.placeholder) {

		$('[placeholder]').focus(function() {
		  var input = $(this);
		  if (input.val() == input.attr('placeholder')) {
			input.val('');
			input.removeClass('placeholder');
		  }
		}).blur(function() {
		  var input = $(this);
		  if (input.val() == '' || input.val() == input.attr('placeholder')) {
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		  }
		}).blur();
		$('[placeholder]').parents('form').submit(function() {
		  $(this).find('[placeholder]').each(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
			  input.val('');
			}
		  })
		});

	}

});