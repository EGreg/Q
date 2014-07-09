(function (Q, $, window, document, undefined) {

    /**
     * This plugin creates scalable and draggable element content or wraps that element.
     * Using this plugin you can move content of element inside element and make a zoom of element content with mouse whell
     * @method viewport
     * @param {Object} [options] this object contains function parameters
     *   @param {String} [options.containerClass] any class names to add to the actions container
     *   @default ''
     *   @param {Boolean} [options.wrap] Make element wrap or not
     *   @default false
     *   @param {Object} [options.initial] start position of content inside element
     *     @param {Number} [options.initial.left] left position
     *     @default 0
     *     @param {Number} [options.initial.top] top position
     *     @default 0
     *     @param {Number} [options.initial.width]
     *     @default 0
     *     @param {Number} [options.initial.height]
     *     @default 0
     *   @param {Object} [options.result]
     *   @param {Event} [options.onRelease] This event triggering after viewport creation
     *   @default Q.Event()
     *   @param {Event} [options.onZoom] This event triggering after zooming
     *   @default Q.Event()
     *   @param {Event} [options.onMove] This event triggering after element move
     *   @default Q.Event()
     */
Q.Tool.jQuery('Q/viewport',

function (options) {
	var container, stretcher;
	var position = this.css('position');
	var display = this.css('display');
	
	this.state('Q/viewport').oldCursor = this.css('cursor');
	this.css('cursor', 'move');
	
	container = $('<span class="Q_viewport_container" />').css({
		'display': (display === 'inline' || display === 'inline-block') ? 'inline-block' : display,
		'zoom': 1,
		'position': position === 'static' ? 'relative' : position,
		'left': position === 'static' ? 0 : this.position().left,
		'top': position === 'static' ? 0 : this.position().top,
		'margin': '0px',
		'padding': '0px',
		'border': '0px solid transparent',
		'float': this.css('float'),
		'z-index': this.css('z-index'),
		'overflow': 'hidden',
		'width': this.outerWidth(true),
		'height': this.outerHeight(true),
		'text-align': 'left',
		'overflow': 'hidden',
		'line-height': this.css('line-height'),
		'vertical-align': this.css('vertical-align'),
		'text-align': this.css('text-align')
	}).addClass('Q_viewport_container')
	.insertAfter(this);
	
	stretcher = $('<div class="Q_viewport_stretcher" />').css({
		'position': 'absolute',
		'left': (options.initial.left ? -options.initial.left : 0)+'px',
		'top': (options.initial.top ? -options.initial.top : 0)+'px',
		'width': container.width()+0.5+'px',
		'height': container.height()+0.5+'px',
		'overflow': 'visible',
		'padding': '0px',
		'margin': '0px'
	}).appendTo(container)
	.append(this);
	
	var useZoom = Q.info.isIE(0, 8);
	
	if (options.containerClass) {
		container.addClass(options.containerClass);
	}
	
	var grab = null;
	var cur = null;
	var pos = null;
	container.on('dragstart', function () {
		return false;
	}).on(Q.Pointer.start, function (e) {
		
		var f = useZoom ? scale.factor : 1;
		var touches = e.originalEvent.touches;
		var touchDistance;
		if (touches && touches.length > 1) {
			touchDistance = Math.sqrt(
				Math.pow(touches[1].pageX - touches[0].pageX, 2) +
				Math.pow(touches[1].pageY - touches[0].pageY, 2)
			);
		}
		
		function _moveHandler (e) {
			var offset, touches;
            offset = stretcher.offset();
            console.log('_moveHandler offset'+offset);
			cur = {
				x: Q.Pointer.getX(e),
				y: Q.Pointer.getY(e)
			};
			if (!pos) return;
			if (Q.info.isTouchscreen && (touches = e.originalEvent.touches)) {
				if (touches.length > 1) {
					var newDistance = Math.sqrt(
						Math.pow(touches[1].pageX - touches[0].pageX, 2) +
						Math.pow(touches[1].pageY - touches[0].pageY, 2)
					);
					var factor = scale.factor * newDistance / touchDistance;
					if (factor >= 1) {
						scale(factor, Q.Pointer.getX(e), Q.Pointer.getY(e));
						touchDistance = newDistance;
					}
				}
			} else if (Q.Pointer.which(e) !== Q.Pointer.which.LEFT) {
				return;
			}
			var x = Q.Pointer.getX(e);
			var y = Q.Pointer.getY(e);
			var newPos = {
				left: pos.left + (x - grab.x)/f,
				top: pos.top + (y - grab.y)/f
			}
			fixPosition(newPos);
			stretcher.css(newPos);
			Q.Pointer.cancelClick(); // on even the slightest move
		}
		
		function _endHandler (e) {
			start = pos = null;
			container.off(Q.Pointer.move);
			$(window).off(Q.Pointer.end, _endHandler);
			$(window).off(Q.Pointer.clickHandler, _clickHandler);
			e.preventDefault();
		}
		
		function _cancelHandler (e) {
			$(window).off(Q.Pointer.end, _endHandler);
			$(window).off(Q.Pointer.clickHandler, _clickHandler);
		}
		
		function _clickHandler (e) {
			$(window).off(Q.Pointer.clickHandler, _clickHandler);
			e.preventDefault();
		}
		
		if (Q.Pointer.canceledClick) return;
		grab = cur = {
			x: Q.Pointer.getX(e),
			y: Q.Pointer.getY(e)
		};
		pos = {
			left: parseInt(stretcher.css('left')),
			top: parseInt(stretcher.css('top'))
		};
		container.on(Q.Pointer.move, _moveHandler);
		$(window).on(Q.Pointer.end, _endHandler);
		$(window).on(Q.Pointer.cancel, _cancelHandler);
		$(window).on(Q.Pointer.click, _clickHandler);
	});
	
	scale.factor = 1;
	container.on(Q.Pointer.wheel, function (e) {
		if (typeof e.deltaY === 'number' && !isNaN(e.deltaY)) {
			scale(
				Math.max(1, scale.factor - e.deltaY * 0.01),
				Q.Pointer.getX(e),
				Q.Pointer.getY(e)
			);
		}
		return false;
	});
<<<<<<< HEAD
	
	function scale(factor, x, y) {
		var left1, left2, left3, top1, top2, top3, offset, css;
		var offset = stretcher.offset();
		var f = useZoom ? scale.factor : 1;
		left1 = parseInt(stretcher.css('left')) * f;
		top1 = parseInt(stretcher.css('top')) * f;
		left1 -= (x - offset.left) * (factor / scale.factor - 1);
		top1 -= (y - offset.top) * (factor / scale.factor - 1);
		if (!useZoom) {
			css = { 
				left: left1,
				top: top1,
				transform: 'scale('+factor+')',
				transformOrigin: '0% 0%'
			};
			fixPosition(css);
			for (var k in css) {
				css[Q.info.browser.prefix+k] = css[k];
			}
			stretcher.css(css);
		} else if (!scale.inProgress) {
			scale.inProgress = true;
			css = {
				left: left1 / factor,
				top: top1 / factor,
				zoom: factor
			};
			fixPosition(css);
			stretcher.css(css);
			scale.inProgress = false;
		}
		scale.factor = factor;
	}
	
=======

    function scale_bak(zoom, mouseX, mouseY) {
        console.log(zoom, mouseX, mouseY);
        var zoomObj = stretcher.children();
        var Z = zoom / scale.factor;

        if (!Q.info.isIE(0, 8)) {
            var containerOffset = zoomObj.offset();
            var mouseRel = {
                x: mouseX - containerOffset.left,
                y: mouseY - containerOffset.top
            };
            var dimension = {
                width: zoomObj.width() * Z,
                height: zoomObj.height() * Z
            };

            var translate = {
                left: containerOffset.left + (mouseRel.x - dimension.width * mouseRel.x / zoomObj.width() ),
                top: containerOffset.top + (mouseRel.y - dimension.height * mouseRel.y / zoomObj.height() )
            };
            var css = {
                'transform-origin': '0% 0%',
                'width': dimension.width,
                'height': dimension.height,
                'top': translate.top,
                'left': translate.left
            };
            for (var k in css) {
                css[Q.info.browser.prefix + k] = css[k];
            }
            zoomObj.css(css);
            scale.factor = zoom;

        }
	};


    function scale(factor, x, y) {
        console.log(' scale.factor ', scale.factor, 'factor ', factor);
        var left1, left2, left3, top1, top2, top3, offset, css;
        var offset = stretcher.position();
        var abs_offset = container.offset();
//        x -=  abs_offset.left; y -= abs_offset.top;

        console.log('scale offset'+offset);
        var f = useZoom ? scale.factor : 1;

        left1 = parseInt(stretcher.css('left')) * f;
        top1 = parseInt(stretcher.css('top')) * f;
        left1 -= (x - offset.left) * (factor / scale.factor ); //- 1
        top1 -= (y - offset.top) * (factor / scale.factor );//- 1

        if (!useZoom) {
            if ( stretcher.width()*factor <= container.parent().width() || stretcher.height()*factor <=  container.parent().height() ) {
                console.log(stretcher.width()*factor, container.parent().width());
                console.log('Block zoom out');
                return;
            }
            css = {
                left: left1,
                top: top1,
                transform: 'scale('+factor+')',
                transformOrigin: '0% 0%'
            };
            fixPosition(css);
            for (var k in css) {
                css[Q.info.browser.prefix+k] = css[k];
            }
            stretcher.css(css);


        } else if (!scale.inProgress) {
            scale.inProgress = true;
            css = {
                left: left1 / factor,
                top: top1 / factor,
                zoom: factor
            };

            fixPosition(css);
            stretcher.css(css);
            scale.inProgress = false;
        }
        scale.factor = factor;
    }

>>>>>>> temp_imgcrop
	function fixPosition(pos) {
		var f = useZoom ? 1: scale.factor;
		var w = -(stretcher.width()*scale.factor - container.width())/f;
		var h = -(stretcher.height()*scale.factor - container.height())/f;
        console.log('w ',w, 'h ', h);
		pos.left = Math.min(0, Math.max(pos.left, w+1)) + 'px';
		pos.top = Math.min(0, Math.max(pos.top, h+1)) + 'px';
	}
},

{	// default options:
	containerClass: '', // any class names to add to the actions container
	wrap: false,
	initial: { left: 0, top: 0, width: 0, height: 0 },
	result: {},
	onRelease: new Q.Event(),
	onZoom: new Q.Event(),
	onMove: new Q.Event()
},

{
	remove: function () {
		this.css('cursor', this.state('Q/viewport').oldCursor);
	}
}

);

})(Q, jQuery, window, document);