(function (Q, $) {

/**
 * @module Q-tools
 */
	
/**
 * This tool renders a nice set of tabs that adapts to different environments
 * @class Q tabs
 * @constructor
 * @param {Object} [options] This object contains properties for this function
 *  @param {Array} [options.tabs] An associative array of name: title pairs.
 *  @param {Array} [options.urls] An associative array of name: url pairs to override the default urls.
 *  @param {String} [options.field='tab'] Uses this field when urls doesn't contain the tab name.
 *  @param {Boolean} [options.vertical=false] Stack the tabs vertically instead of horizontally
 *  @param {Boolean} [options.compact=false] Display the tabs interface in a compact space with a contextual menu
 *  @param {String} [options.overflow] Override the text that is displayed when the tabs overflow. You can interpolate {{count}}, {{text}} or {{html}} in the string. 
 *  @param {String} [options.overflowGlyph] Override the glyph that appears next to the overflow text. You can interpolate {{count}} here
 *  @param {String} [options.selectors] Object of {slotName: selector} pairs, where the values are CSS style selectors indicating the element to update with javascript, and can be a parent of the tabs. Set to null to reload the page.
 *  @param {String} [options.slot] The name of the slot to request when changing tabs with javascript.
 *  @param {Function} [options.loader] Name of a function which takes url, slot, callback. It should call the callback and pass it an object with the response info. Can be used to implement caching, etc. instead of the default HTTP request. This function shall be Q.batcher getter
 *  @param {Q.Event} [options.onClick] Event when a tab was clicked, with arguments (name, element). Returning false cancels the tab switching.
 *  @param {Q.Event} [options.beforeSwitch] Event when tab switching begins. Returning false cancels the switching.
 *  @param {Function} [options.beforeScripts] Name of the function to execute after tab is loaded but before its javascript is executed.
 *  @param {Function} [options.onCurrent] Event after a tab has been selected. Note that this is in the view layer, so your handlers would trigger recursion if they call Q.layout().
 *  @param {Function} [options.onActivate] Event after a tab has been activated. Note that this is in the view layer, so your handlers would trigger recursion if they call Q.layout().
 * @return Q.Tool
 */
Q.Tool.define("Q/tabs", function(options) {

	var tool = this;
	var state = tool.state;
	var $te = $(tool.element);
	
	Q.addStylesheet('plugins/Q/css/tabs.css');

	state.defaultTab = state.defaultTab || Q.firstKey(options.tabs);
	
	// catches events that bubble up from any child elements
	$te.on([Q.Pointer.fastclick, '.Q_tabs'], '.Q_tabs_tab', function () {
		if (false === state.onClick.handle.call(tool, this.getAttribute('data-name'), this)) {
			return;
		}
		if (Q.Pointer.canceledClick || $('.Q_discouragePointerEvents', tool.element).length) {
			return;
		}
		var element = this;
		setTimeout(function () {
			tool.switchTo([element.getAttribute('data-name'), element]);	
		}, 0);
	}).click(function (event) {
		event.preventDefault();
		// return false;
	});
	
	tool.$tabs = $('.Q_tabs_tab', tool.element).css('visibility', 'hidden');
	function _showTabs() {
		tool.$tabs.css('visibility', 'visible');
	}
	
	Q.onLayout.set(function () {
		tool.refresh(_showTabs);
	}, tool);
	
	tool.refresh(_showTabs);
	
},

{
	field: 'tab',
	slot: 'content,title',
	selectors: { content: '#content_slot' },
	overflow: '{{count}} more',
	overflowGlyph: '&#9660;',
	loaderOptions: {},
	loader: Q.req,
	onClick: new Q.Event(),
	beforeSwitch: new Q.Event(),
	onActivate: new Q.Event(),
	onCurrent: new Q.Event(),
	tabName: null, // set by indicateCurrent
	tab: null // set by indicateCurrent
},

{
	/**
	 * @method switchTo
	 * @param {String|Array} name the name of the tab to switch to.
	 *  Can also be [name, tabElement]
	 * @param {Object} loaderOptions any options to merge on top of
	 *  tool.state.loaderOptions
	 * @param {Mixed} extra anything to pass to beforeSwitch handlers
	 */
	switchTo: function (name, loaderOptions, extra) {
		var tool = this;
		var state = this.state;
		var tab;
		if (Q.typeOf(name) === 'array') {
			tab = name[1];
			name = name[0];
		}
		if (tab === undefined) {
			$('.Q_tabs_tab', tool.element).each(function () {
				if (this.getAttribute('data-name') === name) {
					tab = this;
					return false;
				}
			});
			if (tab === undefined) {
				console.warn('Q/tabs: no tab with name "' + name + '"');
				return false;
			}
		}

		state.slots = typeof state.slot === "string" 
			? state.slot.split(',')
			: state.slot;

		var slots = state.slots;

		href = tool.getUrl(tab);

		if (false === Q.handle(state.beforeSwitch, tool, [tab, href, extra])) {
			return false;
		}

		if (href && !state.selectors) {
		    Q.handle(href);
			return;
		}

		if (!slots || !state.selectors || !href) {
			return;
		}

		var o = Q.extend({
			slotNames: slots,
			onError: new Q.Event(function (msg) {
				alert(msg);
			}, "Q/tabs"),
			onActivate: new Q.Event(function () {
				tool.indicateCurrent(tool.getName(tab));
				tool.refresh();
				state.onActivate.handle.call(this, tab, name);
			}, "Q/tabs"),
			loadExtras: true,
			ignorePage: tool.isInDialog(),
			ignoreHistory: tool.isInDialog(),
			loader: state.loader,
			slotContainer: function (slotName) {
				return $(state.selectors[slotName])[0]
					|| document.getElementById(slotName+"_slot");
			}
		}, 10, state.loaderOptions, 10, loaderOptions);

		Q.handle(href, o);
	},
	
	/**
	 * @method isInDialog
	 * @return {Boolean} whether the tabs are rendered inside an overlay / dialog
	 */
	isInDialog: function() {
		return !!$(this.element).parents('.Q_overlay').length;
	},

	/**
	 * @method indicateCurrent
	 * @param {String} tab optional name of the tab to indicate
	 */
	indicateCurrent: function (tab) {
		var name;
		if (typeof tab === 'string') {
			name = tab;
			tab = null;
		}
		var tool = this;
		if (!$(tool.element).closest('body').length) {
			// the replaced html probably included the tool's own element,
			// so let's find something with the same id on the page
			var element = document.getElementById(this.element.id);
			if (!element) {
				return false;
			}
			tool = element.Q('Q/tabs');
		}
		var $tabs = tool.$tabs;
		var url = window.location.href.split('#')[0];
		var state = tool.state;
		var defaultTab = null;
		$tabs.removeClass('Q_current');
		if (!tab) {
			$tabs.each(function (k, t) {
				var tdn = tool.getName(t);
				var tu = tool.getUrl(t);
				if (tdn === name
				|| (!name && tu === url)
				|| (!name && !state.field && tu === url.split('?')[0])) {
					tab = t;
					return false;
				}
				if (state.defaultTab === tdn) {
					defaultTab = t;
				}
			});
		}
		if (!tab) {
			tab = defaultTab;
		}
		$(tab).addClass('Q_current');
		state.tabName = name || tool.getName(tab);
		state.tab = tab;
		state.onCurrent.handle.call(tool, tab, name);
	},
	
	/**
	 * @method getName
	 * @param {HTMLElement} tab corresponds to the tab
	 * @return {String} the name of the tab
	 */
	getName: function (tab) {
		return tab ? tab.getAttribute("data-name") : '';
	},
	
	/**
	 * @method getUrl
	 * @param {HTMLElement} tab corresponds to the tab
	 * @return {String} the url that the tab links to
	 */
	getUrl: function (tab) {
		var $tab = $(tab);
		var state = this.state;
		var href = tab.getAttribute('href');
		var name = tab.getAttribute("data-name");
		if (!href) {
			href = state.urls && state.urls[name];
		}
		if (!href && state.field && name) {
			href = window.location.href.split('?')[0]
				+ '?' + window.location.search.queryField(state.field, name);
		}
		return href;
	},
	
	/**
	 * Render the tabs element again and indicate the selected tab
	 * @method refresh
	 */
	refresh: Q.preventRecursion('refresh', function (callback) {
		var tool = this;
		var state = tool.state;
		var $te = $(tool.element);
		var w = $te.width(), w2 = 0, w3 = 0, index = -10;
		var $o = $('.Q_tabs_overflow', $te);
		tool.indicateCurrent();
		if (!parseInt($te[0].style.width)) {
			$te.siblings(':visible').each(function () {
				var $t = $(this);
				if ($t.css('float') != 'none') {
					w -= $t.outerWidth(true);
				}
			});
		}
		if ($o.length) {
			if ($o.data('Q_contextual')) {
				$('.Q_tabs_tab', $o.data('Q_contextual')).insertAfter($o);
			}
			$o.plugin("Q/contextual", "remove");
			$o.remove();
		}
		var $tabs = tool.$tabs = $('.Q_tabs_tab', $te);
		var $overflow, $lastVisibleTab;
		if (tool.state.vertical) {
			return callback && callback.call(this);
		}
		if (state.compact) {
			index = 0;
		} else {
			$tabs.each(function (i) {
				var $t = $(this);
				w3 = w2;
				w2 += $t.outerWidth(true);
				if (w2 > w + $tabs.length) {
					index = i-1;
					return false;
				}
			});
		}
		if (index >= 0) {
			var values = {
				count: $tabs.length - index - 1,
				text: $(state.tab).text() || "",
				html: $(state.tab).html() || ""
			};
			$lastVisibleTab = $tabs.eq(index);
			$overflow = $('<li class="Q_tabs_tab Q_tabs_overflow" />')
			.css('visibility', 'visible')
			.html(state.overflow.interpolate(values));
			var oneLess = !!state.compact;
			if (!oneLess) {
				$overflow.insertAfter($lastVisibleTab);
				// REFLOW happens here
				if ($overflow.outerWidth(true) > w - w3) {
					oneLess = true;
				}
			}
			if (oneLess) {
				--index;
				values.count = $tabs.length - index - 1;
				$overflow.insertBefore($lastVisibleTab)
				.html(this.state.overflow.interpolate(values));
			}
			if (state.overflowGlyph) {
				$('<span class="Q_tabs_overflowGlyph" />')
					.html(state.overflowGlyph.interpolate(values))
					.prependTo($overflow);
			}
		}
		if (!$overflow) {
			tool.$overflow = null;
			return callback && callback.call(tool);
		}
		tool.overflowIndex = index;
		tool.$overflow = $overflow;
		Q.addScript("plugins/Q/js/QTools.js", function () {
			var elements = [];
			for (var i=index+1; i<$tabs.length; ++i) {
				elements.push($tabs[i]);
			}
			$overflow.plugin("Q/contextual", {
				elements: elements,
				defaultHandler: function ($tab) {
					tool.switchTo([$tab.attr('data-name'), $tab[0]]);
				},
				className: "Q_tabs_contextual",
				onConstruct: function ($contextual) {
					callback && callback.call(tool);
				}
			});
			tool.$overflowed = $(elements);
		});
	})
}
);

Q.Template.set('Q/tabs/contextual',
	'<div class="Q_contextual"><ul class="Q_listing"></ul></div>'
);

})(Q, jQuery);