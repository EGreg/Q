(function (Q, $) {
/**
 * @module Q-tools
 */
	
/**
 * This tool contains functionality to show things in columns
 * @class Q columns
 * @constructor
 * @param {Object}   [options] Override various options for this tool
 *  @param {Object}  [options.animation] For customizing animated transitions
 *  @param {Number}  [options.animation.duration] The duration of the transition in milliseconds, defaults to 500
 *  @param {Object}  [options.animation.hide] The css properties in "hide" state of animation
 *  @param {Object}  [options.back] For customizing the back button on mobile
 *  @param {String}  [options.back.src] The src of the image to use for the back button
 *  @param {Boolean} [options.back.triggerFromTitle] Whether the whole title would be a trigger for the back button. Defaults to true.
 *  @param {Boolean} [options.back.hide] Whether to hide the back button. Defaults to false, but you can pass true on android, for example.
 *  @param {Object}  [options.close] For customizing the back button on desktop and tablet
 *  @param {String}  [options.close.src] The src of the image to use for the close button
 *  @param {String}  [options.title] You can put a default title for all columns here (which is shown as they are loading)
 *  @param {String}  [options.column] You can put a default content for all columns here (which is shown as they are loading)
 *  @param {Object}  [options.clickable] If not null, enables the Q/clickable tool with options from here. Defaults to null.
 *  @param {Object}  [options.scrollbarsAutoHide] If not null, enables Q/scrollbarsAutoHide functionality with options from here. Enabled by default.
 *  @param {Boolean} [options.fullscreen] Whether to use fullscreen mode on mobile phones, using document to scroll instead of relying on possibly buggy "overflow" CSS implementation. Defaults to true on Android, false everywhere else.
 *  @param {Q.Event} [options.onOpen] Event that happens after a column is opened.
 *  @param {Q.Event} [options.beforeClose] Event that happens before a column is closed. Return false to prevent closing.
 *  @param {Q.Event} [options.onOpen] Event that happens after a column is opened.
 *  @param {Q.Event} [options.beforeClose] Event that happens before a column is closed. Return false to prevent closing.
 * @return Q.Tool
 */
Q.Tool.define("Q/columns", function(options) {
	var tool = this;
	var state = tool.state;

	state.max = 0;
	state.columns = [];
	//state.triggers = [];

	state.container = tool.$('.Q_columns_container')[0];
	if (!state.container) {
		state.container = document.createElement('div')
			.addClass('Q_columns_container Q_clearfix');
		tool.element.appendChild(this.state.container);
	} else {
		tool.$('.Q_columns_column').each(function (index) {
			state.columns.push(this);
			$(this).data(dataKey_index, index)
				.data(dataKey_scrollTop, Q.Pointer.scrollTop());
			++state.max;
			tool.open({
				title: undefined,
				column: undefined,
				animation: {duration: 0}
			}, index);
		});
	}

	var selector = '.Q_close';
	if (Q.info.isMobile && state.back.triggerFromTitle) {
		selector = '.Q_columns_title';
	};
	$(tool.element).on(Q.Pointer.click, selector, function(){
		var index = $(this).closest('.Q_columns_column').data(dataKey_index);
		if (index) {
			tool.close(index);
		}
	}); // no need for key, it will be removed when tool element is removed
	
	Q.onScroll.set(Q.debounce(function () {
		if (state.$currentColumn) {
			state.$currentColumn.data(dataKey_scrollTop, Q.Pointer.scrollTop());
		}
	}, 100));
	
	tool.refresh();
	Q.onLayout.set(function () {
		tool.refresh();
	}, tool);
},

{
	animation: { 
		duration: 300, // milliseconds
		css: {
			hide: {
				opacity: 0, 
				top: '50%',
				height: '0'
			}
		},
	},
	back: {
		src: "plugins/Q/img/back-v.png",
		triggerFromTitle: true,
		hide: false
	},
	close: {
		src: "plugins/Q/img/x.png",
		clickable: null
	},
	title: '<img class="Q_columns_loading" src="' + Q.url('plugins/Q/img/throbbers/loading.gif') +'" alt="">',
	column: undefined,
	scrollbarsAutoHide: {},
	fullscreen: Q.info.isMobile && Q.info.isAndroid(1000),
	beforeOpen: new Q.Event(),
	beforeClose: new Q.Event(),
	onOpen: new Q.Event(),
	onClose: new Q.Event()
},

{
	max: function () {
		return this.state.max;
	},
	
	push: function (options, callback) {
		this.open(options, this.max(), callback);
	},
	
	pop: function (callback) {
		this.close(this.max()-1, callback);
	},
	
	open: function (options, index, callback) {
		var tool = this;
		var state = this.state;
		var o = Q.extend({}, 10, state, 10, options);

		if (index > this.max()) {
			throw new Q.Exception("Q/columns open: index is too big");
		}
		if (index < 0) {
			throw new Q.Exception("Q/columns open: index is negative");
		}
		
		if (false === state.beforeOpen.handle.call(tool, options, index)
		 || false === Q.handle(options.beforeOpen, tool, [options, index])) {
			return false;
		}
		
		var div = this.column(index);
		var titleSlot, columnSlot;
		var $div;
		if (!div) {
			div = document.createElement('div').addClass('Q_columns_column');
			div.style.display = 'none';
			$div = $(div);
			++this.state.max;
			this.state.columns[index] = div;
			var $ts = $('<h2 class="title_slot"></h2>');
			titleSlot = $ts[0];
			var $close = !index ? $() : $('<div class="Q_close"></div>');
			var $title = $('<div class="Q_columns_title"></div>')
				.append($ts);
			if (index) {
				$title.prepend($close);
			}
			if (Q.info.isMobile) {
				$close.addClass('Q_back').append(
					$('<img alt="Back" />').attr('src', Q.url(o.back.src))
				);
			} else {
				$close.append(
					$('<img alt="Close" />').attr('src', Q.url(o.close.src))
				);
			}
			columnSlot = document.createElement('div').addClass('column_slot');
			$div.append($title, columnSlot)
				.data(dataKey_index, index)
				.data(dataKey_scrollTop, Q.Pointer.scrollTop())
				.appendTo(state.container);
			if (o.fullscreen) {
				$(window).scrollTop(0);
			}
			presentColumn(tool);
		} else {
			$div = $(div);
			$close = $('Q_close', div);
			titleSlot = $('.title_slot', div)[0];
			columnSlot = $('.column_slot', div)[0];
		}
		state.$currentColumn = $div;
		if (o.back.hide) {
			$close.hide();
		}
		
		if (options.name) {
			var n = Q.normalize(options.name);
			$div.attr('data-name', options.name)
				.addClass('Q_column_'+n + 'Q_column_'+index);
		}

		var p = Q.pipe();
		var waitFor = ['animation'];
		
		if (options.url) {
			waitFor.push('activated');
			var url = options.url;
			var params = Q.extend({
				slotNames: ["title", "column"], 
				slotContainer: {
					title: titleSlot,
					column: columnSlot
				},
				quiet: true,
				ignoreHistory: true,
				ignorePage: true
			}, options);
			params.handler = function _handler(response) {
				var elementsToActivate = [];
				if ('title' in response.slots) {
					$(titleSlot).html(response.slots.title);
					elementsToActivate['title'] = titleSlot;
				}
				columnSlot.innerHTML = response.slots.column;
				elementsToActivate['column'] = columnSlot;
				return elementsToActivate;
			};
			params.onActivate = p.fill('activated');
			// this.state.triggers[index] = options.trigger || null;
			Q.loadUrl(url, params);
		}
		
		p.add(waitFor, function () {
			Q.handle(callback, tool, [options, index]);
			state.onOpen.handle.call(tool, options, index);
			Q.handle(options.onOpen, tool, [options, index]);
		});
		
		if (o.title != undefined) {
			titleSlot.innerHTML = o.title;
		}
		if (o.column != undefined) {
			columnSlot.innerHTML = o.column;
		}
		
		_onOpen();
		
		function _onOpen() {
			var $te = $(tool.element);
			var show = {
				opacity: 1,
				top: 1
			};
			var oldMinHeight;
			var hide = o.animation.css.hide;
			$div.css('position', 'absolute');
			if (Q.info.isMobile) {
				var $sc = $(state.container);
				var h = $(window).height() - $sc.offset().top;
				show.width = $(tool.element).width();
				show.height = h;
				$sc.height(h);
			} else {
				$div.show();
				show.width = $div.width();
				show.height = $div.height();
				for (var k in hide) {
					if (hide[k].toString().substr(-1) === '%') {
						hide[k] = show.height * parseInt(hide[k]) / 100;
					}
				}
				$div.hide()
				.css('position', 'relative');
			}
			$div.data(dataKey_hide, hide);
			
			openAnimation();

			function openAnimation(){
				// open animation
				var duration = o.animation.duration;
				var $sc = $(state.container);
				var $cs = $('.column_slot', $div);
				var $ct = $('.Q_columns_title', $div);
				
				var $prev = $div.prev();
				$div.css('z-index', $prev.css('z-index')+1 || 1);
				
				if (Q.info.isMobile) {
					$div.add($ct).css('width', '100%');
				} else {
					$sc.width(tool.$('.Q_columns_column').length * tool.$('.Q_columns_column').outerWidth(true));

					var $toScroll = ($te.css('overflow') === 'visible')
						? $te.parents()
						: $te;
					$toScroll.each(function () {
						$(this).animate({
							scrollLeft: this.scrollWidth
						});
					})
				}
				
				oldMinHeight = $div.css('min-height');
				$div.css('min-height', 0);
				
				if (o.fullscreen) {
					$ct.css('position', 'absolute');
				} else {
					$('html').css('overflow', 'hidden');
				}
				$div.show()
				.addClass('Q_columns_opening')
				.css(o.animation.css.hide)
				.animate(show, duration, function(){
					afterAnimation($cs, $sc, $ct);
				});
			}

			function afterAnimation($cs, $sc, $ct){
				
				var heightToBottom = $(window).height()
					- $cs.offset().top
					- parseInt($cs.css('padding-top'));
				if (Q.info.isMobile) {
					if (o.fullscreen) {
						$cs.add($div).css('height', 'auto');
						$cs.css('min-height', heightToBottom);
					} else {
						$cs.height(heightToBottom);
						$div.css('height', 'auto');
					}
					$div.prev().hide();
				} else {
					if (o.close.clickable) {
						$close.plugin("Q/clickable", o.close.clickable);
					}
					$div.css('min-height', oldMinHeight);
				}
				
				$div.removeClass('Q_columns_opening')
				.addClass('Q_columns_opened');
				
				presentColumn(tool);

				if (!Q.info.isMobile) {
					var heightToBottom = $(tool.element).height()
						- $cs.offset().top + $cs.parent().offset().top
						- parseInt($cs.css('padding-top'));
					$cs.height(heightToBottom);
				}

				if (Q.info.isTouchscreen) {
					if (o.fullscreen) {
						$cs.css({
							'overflow': 'visible', 
							'height': 'auto'
						});
					} else {
						$cs.addClass('Q_overflow');
						if (Q.info.isTouchscreen && !window.overthrow) {
							Q.ensure(
								window.overthrow, 
								"plugins/Q/js/overthrow.js",
								function () {
									overthrow.scrollIndicatorClassName = 'Q_overflow';
									overthrow.set();
								}
							)
							Q.addScript();
						}
					}
				} else {
					if (o.scrollbarsAutoHide) {
						$cs.plugin('Q/scrollbarsAutoHide', o.scrollbarsAutoHide);
					} else {
						$cs.css('overflow', 'auto');
					}
				}

				p.fill('animation')();
			}
		}
	},

	close: function (index, callback) {
		var tool = this;
		var state = tool.state;
		var div = tool.column(index);
		if (!div) {
			throw new Q.Exception("Column with index " + index + " doesn't exist");
		}
		var $div = $(div);
		var width = $div.outerWidth(true);
		var shouldContinue = state.beforeClose.handle.call(tool, index);
		if (shouldContinue === false) return;
		
		var w = $div.outerWidth(true);
		var duration = state.animation.duration;
		var $prev = $div.prev();
		$prev.show();
		if (state.fullscreen) {
			$(window).scrollTop($prev.data(dataKey_scrollTop) || 0);
			// make the title move while animating, until it is removed
			$('.Q_columns_title', $div).css('position', 'absolute');
		}
		state.$currentColumn = $prev;
		presentColumn(tool);
	
		$div.css('min-height', 0);
		
		$div.animate($div.data(dataKey_hide), duration, function () {
			Q.removeElement(div); // remove it correctly
			state.columns[index] = null;
		
			if (index === state.max-1) {
				--state.max;
			}
			var $sc = $(state.container);
			$sc.width($sc.width() - w);
			presentColumn(tool);
			Q.handle(callback, tool, [index, div]);
			state.onClose.handle.call(tool, index, div);
		});
	},

	column: function (index) {
		return this.state.columns[index] || null;
	},
	
	refresh: function () {
		var tool = this;
		var state = tool.state;
		var $te = $(tool.element);
		var $columns = $('.Q_columns_column', $te);
		var $container = $('.Q_columns_container', $te);
		var $cs = $('.Q_columns_column .column_slot', $te);
		var top = 0;
		
		$te.prevAll().each(function () {
			var $this = $(this);
			if ($this.css('position') === 'fixed') {
				top += $this.outerHeight() + parseInt($this.css('margin-bottom'));
			}
		});
		
		if (Q.info.isMobile) {
			$te.css('top', top + 'px');
			$te.add($container)
				.add($columns)
				.width($(window).width());
			if (!state.fullscreen) {
				$te.add($container)
					.add($columns)
					.height($(window).height()-$te.offset().top);
			}
			presentColumn(tool);
		}

		if (state.fullscreen) {
			$te.addClass('Q_fullscreen');
		}
		
		var overshoot = Q.Pointer.scrollTop() + $(document).height() - $(window).height();
		if (overshoot > 0) {
			$(window).scrollTop( $(window).scrollTop()-overshoot );
		}
	}
}
);

Q.Template.set('Q/columns/column',
	'<div class="Q_contextual"><ul class="Q_listing"></ul></div>'
);

function presentColumn(tool) {
	if (!tool.state.$currentColumn) return;
	$cs = $('.column_slot', tool.state.$currentColumn);
	if (tool.state.fullscreen) {
		var $ct = tool.$('.Q_columns_title');
		$ct.css('position', 'fixed');
		$ct.css('top', $(tool.element).offset().top + 'px');
		$cs.css('padding-top', $cs.prev().outerHeight()+'px');
	}
	if (Q.info.isMobile) {
		var heightToBottom = $(window).height()
			- $cs.offset().top
			- parseInt($cs.css('padding-top'));
		if (!tool.state.fullscreen) {
			$cs.height(heightToBottom);
			// TODO: iscroll
		} else {
			$cs.css('min-height', heightToBottom);
		}
	}
}

var dataKey_index = 'index';
var dataKey_scrollTop = 'scrollTop';
var dataKey_hide = 'hide';

})(Q, jQuery);