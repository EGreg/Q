if (!window.Q) { // You can remove this part after you've run install.php
	document.getElementsByTagName('body')[0].innerHTML = "<h1>Please run MyApp/scripts/Q/install.php --all</h1>";
	throw "Q is not defined";
}

var MyApp = (function (Q, $) {
	
	// Here is some example code to get you started
	
	var MyApp = {
		userContextual: function (item) {
			var action = $(item).attr('data-action');
			if (MyApp.actions[action]) {
				Q.handle(MyApp.actions[action], MyApp, [item]);
			}
		},
		actions: {
			logout: Q.Users.logout,
			setIdentifier: Q.Users.setIdentifier
		}
	};
	
	Q.page('', function () {
		
		$('.MyApp_login').on(Q.Pointer.click, function () {
			Q.Users.login();
			return false;
		});
		
		Q.addScript("plugins/Q/js/QTools.js", function () {
			var avatar = $('#dashboard .Users_avatar_tool');
			if (avatar.length) {
				Q.Contextual.add(avatar, $('#dashboard_user_contextual'));	
			}
		});
		
		// For hiding notices and errors that may be displayed
		$('#notices li').on(Q.Pointer.fastclick, function () {
			var $this = $(this), key;
			$this.css('min-height', 0)
			.slideUp(300, function () {
				$(this).remove();
				if (!$('#notices li').length) {
					$('#notices_slot').empty();
				}
				Q.layout();
			});
			if (key = encodeURIComponent($this.attr('data-key'))) {
				Q.req('Q/notice', 'data', null, { 
					method: 'delete', 
					fields: {key: key} 
				});
			}
		}).css('cursor', 'pointer');
		
	});
	
	Q.page("MyApp/welcome", function () {
		// when loading
		return function () {
			// unloading;
		};
	});
	
	// example stream
	Q.Streams.define("MyApp/cool", "js/streams/MyApp/cool.js");
	
	// example tool
	Q.Tool.define("MyApp/cool", "js/tools/MyApp/cool.js");

	// tell Q.handle to load pages using AJAX
	Q.handle.options.loadUsingAjax = true;
	
	// make the app feel more native on touch devices
	Q.Pointer.preventRubberBand({
		direction: 'vertical'
	});
	Q.Pointer.startBlurringOnTouch();
	
	return MyApp;
	
})(Q, jQuery);