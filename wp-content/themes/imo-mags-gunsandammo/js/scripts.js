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
	
  // Video Slideshow
  $("#video-slideshow").tabs();
  
  var $tabs = $('.ui-tabs').tabs();
  
  // Add Prev/Next Navigation to jQuery UI Tabs
  $(".ui-tabs").each(function() {
    $(this).append("<a href='#' class='next-tab'>Next Page &#187;</a><a href='#' class='prev-tab'>&#171; Prev Page</a>");
  });
  
  var totalSize = $(".ui-tabs-panel").size() - 1;
  
  $('.next-tab').click(function() {
    var selected = $tabs.tabs('option', 'selected');
    if (selected == totalSize) {
      selected = 0; 
    } else {
     selected++;
    }
    $tabs.tabs('select', selected);
    return false;
  });

  $('.prev-tab').click(function() {
    var selected = $tabs.tabs('option', 'selected');
    if (selected == 0) {
      selected = totalSize; 
    } else {
     selected--;
    }
    $tabs.tabs('select', selected);
    return false;
  });
  
  // Show the Prev/Next navigation only on hover
  $(".ui-tabs").mouseover(function() {
    $('.prev-tab, .next-tab').show();
  }).mouseout(function() {
    $('.prev-tab, .next-tab').hide();
  });
  

});