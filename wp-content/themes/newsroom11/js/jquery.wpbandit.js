/*!
 * WPBandit Theme Plugin v1.1
 *
 * Copyright (c) 2012 WPBandit
 * Dual licensed under the MIT and GPL licenses.
 *  - http://www.opensource.org/licenses/mit-license.php
 *  - http://www.opensource.org/licenses/GPL-2.0
 *
 * Note : Do not use this file . It is embedded and minimized in the top
 *        of jquery.theme.js. We keep it here for reference only.
 *
 */

;(function ( $, window, document, undefined ) {

	var methods = {

		init : function() {},

		/*-------------------------------------------------------------------*/
		/* Navigation
		/*-------------------------------------------------------------------*/
		
		// Nav Dropdown
		nav_dropdown : function ( opts ) {
			// Set options
			var options = $.extend({}, {
				'submenu'	: 'ul.sub-menu',
				'speed'		: 'fast'
			}, opts );

			return this.each(function() {
				// Nav top-level items
				var nav_items = $(this).children('li');

				// Hide sub menus
				nav_items.children(options.submenu).hide();

				// Show submenus on hover
				nav_items.hover( 
					function() {
						$(this).children(options.submenu).slideDown(options.speed);
					},
					function() {
						$(this).children(options.submenu).hide();
					}
				);
			});
		},

		// Nav Mobile
		nav_mobile : function ( opts ) {
			// Set options
			var options = $.extend({}, {
				'autoHide'			: true,
				'before'			: false,
				'containerClass'	: 'select-nav',
				'defaultOption'		: 'Navigate to ...',
				'deviceWidth'		: 768,
				'menuClass'			: 'nav',
				'subMenuClass'		: 'sub-menu',
				'subMenuDash'		: '&ndash;',
				'useWindowWidth'	: true
			}, opts );

			// Nav Menu
			var nav = $(this);

			// Create on resize
			var navTimeout;
			$(window).resize(function() {
				clearTimeout(navTimeout);
				navTimeout = setTimeout(function() {
					nav.wpbandit('nav_mobile',options);
				}, 500);
			});

			// Get window/screen width
			var width = (options.useWindowWidth === true) ? $(window).width() : screen.width;

			// Create navigation menu for mobile devices
			if (width < options.deviceWidth) {
				var container = $('<div class="' + options.containerClass + '"></div>');
				var menu = $('<select class="' + options.menuClass + '"></select>');

				if($('.' + options.containerClass).length > 0) { return; }

				// Add container to page
				if ( options.before ) {
					$(this).before(container);
				} else {
					$(this).after(container);
				}

				// Append menu to container
				menu.appendTo(container);

				// Default option
				$('<option />', {
					'selected'	: 'selected',
					'value'		: '',
					'text'		: options.defaultOption
				}).appendTo(menu);

				// Populate dropdown with menu items
				$(this).find('a').each(function() {
					var el = $(this);
					var optionText = el.text();
					var optionValue = el.attr('href');

					var optionParents = el.parents('.' + options.subMenuClass);
					var len = optionParents.length;

					// Add dash to option text if sub-menu item
					if(len > 0) {
						dash = Array( len + 1 ).join(options.subMenuDash);
						optionText = dash + ' ' + optionText;
					}

					$('<option />', {
						'html'		: optionText,
						'value'		: optionValue,
						'selected'	: (this.href == window.location.href),
					}).appendTo(menu);
				});

				menu.change(function() {
					window.location = $(this).find("option:selected").val();
				});
			}

		},



		/*-------------------------------------------------------------------*/
		/* Shortcodes
		/*-------------------------------------------------------------------*/

		// Shortcode : Accordion
		sc_accordion : function( opts ) {
			// Set options
			var options = $.extend({}, {
				'trigger'	: '.title a',
				'toggle'	: '.inner'
			}, opts );

			return this.each(function() {
				var container = $(this);
				var trigger = container.find(options.trigger);
				var panels = container.find(options.toggle);

				// Hide panels
				panels.hide();

				// Toggle panel
				trigger.click(function(e) {
					e.preventDefault();

					// Target panel
					var target = $(this).parent().next();

					// Display target panel if not visible
					if(!target.is(':visible')) {
						panels.slideUp();
						target.slideDown();
						container.find('.title').removeClass('active');
						$(this).parent().addClass('active');
					}
				});
			});
		},

		// Shortcode : Alert
		sc_alert : function( opts ) {
			// Set options
			var options = $.extend({}, {
				'button'	: '.alert-close'
			}, opts );

			return this.each(function() {
				var alert = $(this);

				// Alert close button
				var button_close = alert.children(options.button);

				// Close alert on button click
				button_close.click(function(e) {
					e.preventDefault();
					alert.slideUp();
				});
			});
		},

		// Shortcode : Tabs
		sc_tabs : function( opts ) {
			// Set options
			var options = $.extend({}, {
				'tabs'		: '.tab',
				'trigger'	: '.tabs-nav a'
			}, opts );

			return this.each(function() {
				var tabs = $(this).find(options.tabs);
				var trigger = $(this).find(options.trigger);

				// Set class to active for first nav tab link
				trigger.filter(':first').addClass('active');

				// Show content of first tab
				tabs.filter(':first').show();

				// Show tab on click
				trigger.click(function(e) {
					e.preventDefault();

					tabs.hide();
					tabs.filter(this.hash).show();
					trigger.removeClass('active');
					$(this).addClass('active');
				});
			});
		},

		// Shortcode : Toggle
		sc_toggle : function( opts ) {
			// Set options
			var options = $.extend({}, {
				'trigger'	: '.title',
				'toggle'	: '.inner'
			}, opts );

			return this.each(function() {
				var trigger = $(this).children(options.trigger);
				var content = $(this).children(options.toggle);

				trigger.toggle(
					function() {
						$(this).addClass('active');
						content.slideDown();
					},
					function () {
						$(this).removeClass('active');
						content.slideUp();
					}
				);
			});
		},


		/*-------------------------------------------------------------------*/
		/* Widgets
		/*-------------------------------------------------------------------*/

		// Widget : Tabs
		widget_tabs : function( opts ) {
			// Set options
			var options = $.extend({}, {
				'tabs'		: '.wpb-tab',
				'trigger'	: '.wpb-tabs a'
			}, opts );

			return this.each(function() {
				var tabs = $(this).find(options.tabs);
				var trigger = $(this).find(options.trigger);

				// Set class to active for first nav tab link
				trigger.filter(':first').addClass('active');

				// Show content of first tab
				tabs.filter(':first').show();

				// Show tab on click
				trigger.click(function(e) {
					e.preventDefault();

					tabs.hide();
					tabs.filter(this.hash).show();
					trigger.removeClass('active');
					$(this).addClass('active');
				});
			});
		},


		/*-------------------------------------------------------------------*/
		/* Miscellaneous
		/*-------------------------------------------------------------------*/

		// Scroll To Top
		scroll_top : function( opts ) {
			// Set options
			var options = $.extend({}, {
				'speed'	: 'slow'
			}, opts );

			return this.each(function() {
				// Scroll to top of page on click
				$(this).click(function(e) {
					e.preventDefault();
					$('html, body').animate({scrollTop: 0}, options.speed);
				});
			});
		},

		// Sticky footer
		sticky_footer : function( opts ) {
			// Set options
			var options = $.extend({}, {
				'pushDiv'	: '#sticky-footer-push'
			}, opts );

			// Footer
			var footer = $(this);

			wpbPositionFooter(footer,options.pushDiv);
 
			$(window)
				.scroll(function() {
					wpbPositionFooter(footer,options.pushDiv);
				})
				.resize(function() {
					wpbPositionFooter(footer,options.pushDiv);
				});

			function wpbPositionFooter(footer,pushDiv) {
				var docHeight = $(document.body).height() - $(pushDiv).height();

				if(docHeight < $(window).height()) {
					var diff = $(window).height() - docHeight;
					
					if(!$(pushDiv).length > 0) {
						footer.before('<div id="' + pushDiv.substring(1, pushDiv.length) + '"></div>');
					}
					$(pushDiv).height(diff);
				}
			}
		},


		/*-------------------------------------------------------------------*/
		/* Portfolio
		/*-------------------------------------------------------------------*/

		// Portfolio : Category Filters
		portfolio_category_filter : function( opts ) {
			// Set options
			var options = $.extend({}, {
				'currentClass'	: 'current'
			}, opts );

			return this.each(function() {
				var filters =  $(this).children('li');

				filters.find('a').click(function(e) {
					e.preventDefault();

					var category = $(this).attr('data-filter');

					filters.removeClass(options.currentClass);
					$(this).parent().addClass(options.currentClass);
					$('.isotope').isotope({ filter: category });
				});
			});
		},

		// Portfolio : Size Switcher
		portfolio_size_switcher : function( opts ) {
			// Set options
			var options = $.extend({}, {
				'container'	: '#portfolio',
				'isotope'	: true
			}, opts );

			return this.each(function() {
				var switcherContainer = $(this);
				var defaultLayout = switcherContainer.attr('data-current');
				var switcherItems = $(this).find('li');
				var portfolioItems = $(options.container).children('div');

				// Set default filter li class
				switcherItems.find('a').each(function(e) {
					if(defaultLayout == $(this).attr('data-layout')) {
						$(this).parent().addClass('current');
					}
				});

				// Switch size
				switcherItems.find('a').click(function(e) {
					e.preventDefault();

					// Set switcher item class
					switcherItems.removeClass('current');
					$(this).parent().addClass('current');

					// Old and new layout
					var oldLayout = switcherContainer.attr('data-current');
					var newLayout = $(this).attr('data-layout');

					// Update switcher current layout
					switcherContainer.attr('data-current',newLayout);

					// Change class of portfolio items
					portfolioItems.removeClass(oldLayout).addClass(newLayout);

					// Reset isotope layout
					if(options.isotope) {
						$('.isotope').isotope('reLayout');
					}	
				});
			});
		},
	}

	$.fn.wpbandit = function( method ) {

		if ( methods[method] ) {
			return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' does not exist on jQuery.wpbandit' );
		}

	};

})( jQuery, window, document );
