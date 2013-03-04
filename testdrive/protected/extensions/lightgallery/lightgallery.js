/**
* LightGallery v1.4
* Author: Dmitri Ischenko - ischenkodv@gmail.com
* Website: http://code.google.com/p/lightgallery
* Freely distributable under MIT-style license
*/
var lightgallery = (function(){

// local variables
var dy = false,
    minContainerWidth,
    readyBound,
    isReady,
    bInProgress,
    
    /* constants */
    HIDDEN      = 'hidden',
    VISIBLE     = 'visible',
    BLOCK       = 'block',
    NONE        = 'none',
    OPACITY     = 'opacity',
    LEFT        = 'left',
    TOP         = 'top',
    WIDTH       = 'width',
    HEIGHT      = 'height',
    PX          = 'px',
    DIV         = 'div',
    STRING      = 'string',
    WND         = window,
    DOC         = document,

    // Library options
    options = {
        showOverlay     : true,
        overlayColor    : '#000',
        overlayOpacity  : .85,
        zoomStep        : .2,
        animate         : true,
        duration        : 800,
        resizeSync      : false,    // resize container both vertically and horizontally at the same time
        enableZoom      : true,
        fadeImage       : true,
        alias           : 'lightgallery',
        fullSize        : false,
        minPadding      : 15        // minimal distance between container and window
    },

    // Language variables
    langVars = {
        next      : 'Next',
        prev      : 'Previous',
        zoomIn    : 'Zoom In',
        zoomOut   : 'Zoom Out',
        fullSize  : 'Full Size',
        fitScreen : 'Fit screen',
        close     : 'Close',
        image     : 'Image',
        of        : 'of'
    },

    // If Internet Explorer
    // TODO: remove browser detection.
    isIE,

    /* container and its elements */
    container,      // container which holds image;
    titleBar    = _(DIV, {id:'LG_titleBar'}),       // title bar
    picture     = _('img', {id:'LG_pic'/*, width:300, height:300*/}), // Image inside lightbox
    prevBtn     = _(DIV, {id:'LG_prevLink',title:langVars.prev}),        // "previous" button
    nextBtn     = _(DIV, {id:'LG_nextLink',title:langVars.next}),        // "next" button
    fullSizeBtn = _(DIV, {id: 'LG_zoomNormal', title: langVars.fullSize}),    // button which show image full size
    zoomIn      = _(DIV, {id: 'LG_zoomIn', title: langVars.zoomIn}),    // Zoom In button
    zoomOut     = _(DIV, {id: 'LG_zoomOut', title: langVars.zoomOut}),    // Zoom Out button
    imgIndex    = _(DIV, {id: 'LG_imgIndex'}, langVars.image + ' 20 ' + langVars.of + ' 20 '), // index of images
    loaderImage = _('img'),    // image loader

    gallery,
    isOpen,         // if gallery open?
    current,        // index of the current image

    oThrobber = _(DIV,{id:'LG_loading'}),      // Loading indicator
    
    /* Reference to overlay */
    overlay = _(DIV, {id:'LG_overlay'}),

    images, // list of images

    /****************************/
    /*     Functions            */
    /****************************/

    /**
     * Add event listener
     */
    addEvent = (function(){
        if (WND.addEventListener) {
            return function(el, type, fn) {
                el.addEventListener(type, fn, false);
            }
        } else if (WND.attachEvent) {
            return function(el, type, fn) {
                el.attachEvent('on' + type, function() {
                    fn.call(el, WND.event);
                });
            }
        }
    })();

var G = {

    /**
     * Set language variables
     * @param {Object} vars - language variables
     */
    setLangVars : function(vars) {
        extend(langVars, vars);
    },


    /**
     * Initialize gallery
     * @param {object} opts - gallery options
     */
    init: function(opts){

        opts && extend(options, opts);

        if (!readyBound) return bindReady();


        // detect engine
        if (/MSIE ([^;]+)/.test(navigator.userAgent)) {
            isIE = parseFloat( RegExp["$1"] );
        }


        // get images
        images = [];
        var imgs = DOC.getElementsByTagName('a'),
            regx = new RegExp('^'+options.alias+'\\[([a-zA-Z0-9_-]+)\\]|'+options.alias+'$'),
            r;      // variable to hold RegEx matches
        
        // filter images that match specified RegEx expression
        for (var i=0, len=imgs.length; i<len; i++) {
            if (imgs[i].rel && (r = imgs[i].rel.match(regx))) {
                addEvent(imgs[i], 'click', G.showImage);
                if (r = r[1]) {
                    // save gallery name in image
                    imgs[i].__gallery__ = r;

                    if (!images[r]) {
                        images[r] = [];
                    }

                    imgs[i].__index__ = images[r].push(imgs[i]) - 1;
                }
            }
        }

        // create overlay and container and add it to body
        var body = DOC.body;
        
        overlay.onclick = G.close;
        body.appendChild(overlay);

        
        body.appendChild( container = createContainer() );
        innerCont = container.lastChild;

        addEvent(
            (body.attachEvent) ? body : WND,
            'keypress',
            keyPressHandler
        );

        // create new Image element to load images
        loaderImage.onload=function(){
            hideLoadingIcon();

            picture.src = loaderImage.src;
            setContPos(options.fullSize ? 1 : 0, true);
            preload();
        }

        // define the difference between container and image size
        if (dy === false) {
            dy = container.offsetHeight;
            minContainerWidth = isIE ? 200 : container.offsetWidth;
        }
        
        // set default color and opacity for overlay
        css(overlay, {
            background: options.overlayColor,
            display: NONE,
            opacity: options.overlayOpacity
        });
    },

    /**
     * Open (show) gallery
     */
    open : function(){
        if (isOpen) return;

        showOverlay();

        // display container
        picture.style.display=BLOCK;
        setContPos();
        css(container, {visibility: VISIBLE, display: BLOCK});
        isOpen = 1;
    },

    /**
     * Close gallery
     */
    close: function(){
        hideOverlay();
        css(container, {visibility: HIDDEN, display: NONE});

        loaderImage.src = picture.src = '';
    },

    zoomIn: function(){
        G.Zoom(1 + options.zoomStep);
    },

    zoomOut: function(){
        G.Zoom(1 - options.zoomStep);
    },

    zoomNormal: function(){
        if(this.$disabled)
            return;

        G.Zoom(
            picture.width == loaderImage.width && picture.height == loaderImage.height ? 0 : 1
        );
    },

    Zoom : function(coef){
        hideContent();
        setContPos(coef)
    },

    /**
     * Shows image when user click it
     * @param {Object} e - event object
     */
    showImage: function(e){
        var img = this,
            i = img.__index__;

        e = e || WND.event;
        e.returnValue=false;
        e.preventDefault && e.preventDefault();

        if (img.__gallery__ && i > -1) {
            gallery = img.__gallery__;
            G.show(i);
        } else {
            gallery = null;
            G.showSingle(img);
        }
    },

    /**
     * Show single image
     * @param {Element} elem - reference to element
     */
    showSingle: function(elem){
        G.open();

        // Hide content and show loading icon
        hideContent();
        showLoadingIcon();

        loaderImage.src = elem.href;

        titleBar.innerHTML = elem.title;
        imgIndex.innerHTML = '';
        prevBtn.style.visibility = nextBtn.style.visibility = HIDDEN;
    },

    /**
     * Show image from the gallery
     * @param {Number} index - index of the image
     */
    show: function(index){
        if (!gallery || index < 0
            || index > images[gallery].length-1
            || (options.animate && bInProgress)
           ) return;

        G.open();

        var gal = images[gallery],
            ns = nextBtn.style,
            ps = prevBtn.style;

        hideContent();
        showLoadingIcon();

        bInProgress = 1;
        
        loaderImage.src=gal[index].href;
        titleBar.innerHTML = gal[index].title;
        imgIndex.innerHTML = langVars.image+' '+(index+1)+' '+langVars.of+' '+gal.length;

        current = index;
        
        // show or hide prev/next buttons depending on image index
        hasNext() ? ns.visibility = VISIBLE : ns.visibility = HIDDEN;
        hasPrev() ? ps.visibility = VISIBLE : ps.visibility = HIDDEN;

        WND.focus();
    },

    // show next image
    next: function(){
        G.show(current + 1);
    },

    // show previous image
    prev: function(){
        G.show(current - 1);
    }
}

/**
 * Detects if gallery has next image after current
 */
function hasNext() {
    return current < (images[gallery].length - 1) ? true : false;
}

/**
 * Detects if gallery has previous image before current
 */
function hasPrev() {
    return current ? true : false;
}

/**
 * Preload adjacent images
 */
function preload(){
    var gal = images[gallery];
    if (!gal) return;
    if (gal[current+1]) _('img').src = gal[current+1].href;
    if (gal[current-1]) _('img').src = gal[current-1].href;
}


/**
 * Set the size and position of the container
 */
function showOverlay(){
    if (options.showOverlay){

        // set overlay size
        var ar = getPageSize();
        css(overlay, {
            width: ar[0],
            height: ar[1]
        });

        // show overlay if it's not shown already
        if (overlay.style.display != BLOCK) {
            css(overlay, {display:BLOCK});
            animate(overlay, {opacity: options.overlayOpacity}, 300)
        }
    }
}

/**
 * Hides overlay
 */
function hideOverlay(){
    animate(overlay, {opacity: 0}, 300, function(){
        overlay.style.display = NONE;
        isOpen = 0;
    });
}

/**
 * Set container position
 * @param {number} vScale
 * @param {boolean} bIsOnload - show if function is called from whithin onload event
 */
function setContPos(vScale, bIsOnload){
    // define references and variables
    var notFitScreen, fsTitle,
        w,h,    // width and height of the container
        padding = options.minPadding*2,

        // size of the container plus padding
        dLoadWidth = loaderImage.width,
        dLoadHeight = loaderImage.height,

        // size of the viewport and the space available to the container
        ar = getPageSize(),
        dScreenWidth = ar[2],
        dScreenHeight = ar[3],
        dAvailableWidth =  dScreenWidth - padding,
        dAvailableHeight =  dScreenHeight - padding - dy;

    // *****************************************
    // define width and height of the container
    if (vScale == 0 || (bIsOnload && !vScale)) {
        // set size of the container according to the size of the viewport
        if (dLoadWidth > dAvailableWidth || dLoadHeight > dAvailableHeight) {
            var newWidth = dAvailableWidth,
                newHeight = dAvailableWidth * dLoadHeight / dLoadWidth;

            if (newHeight > dAvailableHeight) {
                newHeight = dAvailableHeight;
                newWidth = dAvailableHeight * dLoadWidth / dLoadHeight;
            }

            w = picture.width = newWidth;
            h = (picture.height = newHeight) + dy;
        } else {
            w = picture.width = dLoadWidth;
            h = (picture.height = dLoadHeight) + dy;
        }

    } else if (vScale==1) {
        // show image in real size
        w = picture.width = dLoadWidth;
        h = (picture.height = dLoadHeight) + dy;
    } else if (vScale < 1 || vScale > 1) {
        // zoom image according to vScale
        w = (picture.width *= vScale);
        h = (picture.height *= vScale) + dy;
    } else {
        w = h = 300;    // default size
        var disableAnimate = true;
    }

    // enable/disable the full size button
    if (notFitScreen = ( w > dAvailableWidth || h > (dAvailableHeight + dy) )) {
        fsTitle = langVars.fitScreen;
        fsClass = 'LG_fitScreen';
    } else if (picture.width != dLoadWidth || picture.height != dLoadHeight) {
        fsTitle = langVars.fullSize;
        fsClass = 'LG_zoomNormal';
    }

    fullSizeBtn.$disabled = false;
    if (picture.getAttribute('width') == dLoadWidth) {
        // it is real size of the image
        if (notFitScreen) {
            fullSizeBtn.id = fsClass;
            fullSizeBtn.setAttribute('title', fsTitle);
        } else {
            fullSizeBtn.id = 'LG_zoom_disabled';
            fullSizeBtn.$disabled = true;
        }
    } else {
        fullSizeBtn.id = 'LG_zoomNormal';
        fullSizeBtn.setAttribute('title', langVars.fullSize);
    }

    // here we set the minimal width of the container
    w = Math.max(w, minContainerWidth);

    // correct coords according to scroll bars position
    var scr = getScrollXY(),
        y = (dScreenHeight > h ? (dScreenHeight - h)/2 : options.minPadding) + scr[1],
        x = (dScreenWidth > w ? (dScreenWidth - w)/2 : options.minPadding) + scr[0],

        // set the width of the prev/next buttons as 1/3 of the picture width
        dBtnWidth = (w/3),
        dBtnHeight = (h - dy - 10)
        animCallback = function(){
            showOverlay();
            showContent();
        };

    css(nextBtn, {width: dBtnWidth, height: dBtnHeight});
    css(prevBtn, {width: dBtnWidth, height: dBtnHeight});

    if (options.animate && !disableAnimate) {
        if (options.resizeSync) {
            animate(container, {
                width: w,
                left: x,
                height: h,
                top: y
            }, options.duration, animCallback);
        } else {
            animate(container, {width: w, left: x}, options.duration/2, function(){
                animate(container, {height: h, top: y}, options.duration/2, animCallback)
            });
        }
    } else {
        css(container, {top: y, left: x, width: w, height: h});
        animCallback();
    }
}

/**
 * Show container content
 */
function showContent(){
    innerCont.style.display = BLOCK;

    css(picture, {opacity:0});
    animate(picture, {opacity: 1}, options.fadeImage ? 400 : 0, function(){ bInProgress = 0 });
}

/**
 * Hide container content
 */
function hideContent() {
    innerCont.style.display = NONE;
}

function showLoadingIcon() {
    oThrobber.style.display = BLOCK;
}

function hideLoadingIcon() {
    oThrobber.style.display = NONE;
}

/**
 * Create container
 */
function createContainer() {
    if (!options.enableZoom) {
        zoomIn = zoomOut = '';
    }

    var container = _(DIV, {id:'LG_container'},
        oThrobber,
        _(DIV, {id:'LG_innerCont'},
            _(DIV, {id:'LG_panel'},
                zoomIn, zoomOut, fullSizeBtn, imgIndex, _(DIV,{id:'LG_closeBtn',title:langVars.close}), _(DIV, {style: 'clear:both'})
            ),
            picture,
            titleBar,
            prevBtn, nextBtn
        )
    );


	var navHandler = function(event){
		event.cancelBubble = true;
		event.stopPropagation && event.stopPropagation();
		
        var target = event.target || event.srcElement;
		
		if (event.type == 'click') {
			var fnList = {
				LG_closeBtn: G.close,
				LG_zoomNormal: G.zoomNormal,
                LG_fitScreen: G.zoomNormal,
				LG_zoomIn: G.zoomIn,
				LG_zoomOut: G.zoomOut,
				LG_nextLink: G.next,
				LG_prevLink: G.prev
			};

			if (target.id in fnList) {
				fnList[target.id].call(G);
			}
            
        } else if (target.id == 'LG_nextLink' || target.id == 'LG_prevLink') {
            animate(
                target,
                {opacity: event.type == 'mouseout' ? 0 : 1}
            );
        }
	}
	
	addEvent(container, 'click', navHandler);
	addEvent(container, 'mouseover', navHandler);
	addEvent(container, 'mouseout', navHandler);

    return container
}

function keyPressHandler(e){

    if(!isOpen) return;

    var e = e || WND.event,
        code = e.keyCode ? e.keyCode : (e.which ? e.which : e.charCode),
        fnList = {
            110 : G.next,       // n key
            98  : G.prev,       // b key
            102 : G.zoomNormal, // f key
            43  : G.zoomIn,     // +
            45  : G.zoomOut,    // -
            27  : G.close       // Esc key
        };

    fnList[code] && fnList[code]();
}

/**
 * Extends object with properties of another object
 * @param {object} target
 * @param {object} source
 */
function extend(target, source) {
    for (var i in source) {
        target[i] = source[i];
    }
}

/**
* Set CSS style of the element
* @param {object} elem
* @param {object} styles
*/
function css(elem, styles){
    for (var prop in styles) {
        setElemStyle(elem, prop, styles[prop]);
    }
}

/**
 * Get the page and viewport size
 * @return {Array}
 */
function getPageSize(){
    var xScroll,
        yScroll,
        windowWidth,
        windowHeight,
        de = DOC.documentElement,
        body = DOC.body,
        elem = document.compatMode === "CSS1Compat" ?  de : body;

    if (WND.innerHeight && WND.scrollMaxY) {
        xScroll = body.scrollWidth;
        yScroll = WND.innerHeight + WND.scrollMaxY;
    } else if (body.scrollHeight > body.offsetHeight){ // all but Explorer Mac
        xScroll = body.scrollWidth;
        yScroll = body.scrollHeight;
    } else if (de && de.scrollHeight > de.offsetHeight){ // Explorer 6 strict mode
        xScroll = de.scrollWidth;
        yScroll = de.scrollHeight;
    } else { // Explorer Mac...would also work in Mozilla and Safari
        xScroll = body.offsetWidth;
        yScroll = body.offsetHeight;
    }


    windowHeight = elem.clientHeight;
    windowWidth = elem.clientWidth;

    return [
        // Viewport height. For small pages with total width less then width of the viewport
        xScroll < windowWidth? windowWidth : xScroll,

        // Viewport height. For small pages with total height less then height of the viewport
        yScroll < windowHeight? windowHeight : yScroll,

        windowWidth,
        windowHeight
    ]
}

/**
 * Get coords of scroll bars
 * @return {Array} - [coord horizontal, coord vertical]
 */
function getScrollXY() {
    var scrOfX = 0, scrOfY = 0, b = DOC.body, de = DOC.documentElement;
    if( typeof( WND.pageYOffset ) == 'number' ) {
        //Netscape compliant
        scrOfY = WND.pageYOffset;
        scrOfX = WND.pageXOffset;
    } else if( b && ( b.scrollLeft || b.scrollTop ) ) {
        //DOM compliant
        scrOfY = b.scrollTop;
        scrOfX = b.scrollLeft;
    } else if( de && ( de.scrollLeft || de.scrollTop ) ) {
        //IE6 Strict
        scrOfY = de.scrollTop;
        scrOfX = de.scrollLeft;
    }
    return [ scrOfX, scrOfY ];
}

/**
 * Create HTML element
 * @param {String} tag - tag name
 * @param {Object} attr - attributes to set, ex: {'name':'someClass',value:'the value'}
 */
function _(tag, attr){

    var elem = DOC.createElement(tag),
        i = 2,
        j,
        name,
        value,
        len = arguments.length;

    if (attr){
        for (name in attr) {
            value = attr[name];
            if (typeof value == STRING) {
                if (name == 'class'){
                    elem.className = value;
                } else {
                    elem.setAttribute(name, value);
                }

            }
        }
    }

    for (; i < len; i++) {
        if (typeof arguments[i] == STRING) {
            elem.innerHTML += arguments[i];
        } else {
            elem.appendChild(arguments[i]);
        }
    }

    return elem;
}

/**
 * ondomready functionality from jQuery framework:
 */
function ready() {
    if (!isReady) {
        if (!DOC.body) {
            return setTimeout(ready, 13);
        }

        isReady = true;

        G.init();
    }
}

function bindReady() {

    if (readyBound) return;
    readyBound = true;

    if (DOC.readyState === "complete" ) {
        return ready();
    }

    if (DOC.addEventListener) {
        DOC.addEventListener( "DOMContentLoaded", function DOMContentLoaded() {
            DOC.removeEventListener( "DOMContentLoaded", DOMContentLoaded, false );
            ready();
        }, false);

    // If IE event model is used
    } else if (DOC.attachEvent) {
        DOC.attachEvent("onreadystatechange", function onreadystatechange() {
            if ( document.readyState === "complete" ) {
                DOC.detachEvent("onreadystatechange", onreadystatechange);
                ready();
            }
        });

        // If IE and not a frame
        // continually check to see if the document is ready
        var toplevel = false;

        try {
            toplevel = WND.frameElement == null;
        } catch(e){}

        if (DOC.documentElement.doScroll && toplevel) {

            function doScrollCheck() {
                if (isReady) {
                    return;
                }

                try {
                    // If IE is used, use the trick by Diego Perini
                    // http://javascript.nwbox.com/IEContentLoaded/
                    DOC.documentElement.doScroll("left");
                } catch(e) {
                    setTimeout( doScrollCheck, 1 );
                    return;
                }

                // and execute any waiting functions
                ready();
            }

            doScrollCheck();
        }
    }
}


var isFilterOpacity = typeof _('a').style.filter == STRING,
  requestAnimFrame = (function(){
    return  WND.requestAnimationFrame       || 
            WND.webkitRequestAnimationFrame || 
            WND.mozRequestAnimationFrame    || 
            WND.oRequestAnimationFrame      || 
            WND.msRequestAnimationFrame     || 
            function(callback){
              setTimeout(callback, 16.66);
            }
  })();
  setElemStyle = (function(){

      var pxs = {
          width: 1,
          height: 1,
          top: 1,
          left: 1
      }

      if (isFilterOpacity) {
          return function(elem, prop, option) {
              if (prop == 'opacity'){
                  elem.style['filter'] = 'alpha(opacity='+option*100+')';
              }
			  elem.style[prop] = option + (pxs[prop] ? 'px':'');
          }
      }

      return function(elem, prop, option) {
          elem.style[prop] = option + (pxs[prop] ? 'px':'');
      }
  })();

var animate = function(el, target, duration, after){
    if (options.animate) {
        duration = typeof duration == 'number' ? duration : 200;
    } else {
        duration = 0;
    }

    var comp = el.currentStyle ? el.currentStyle : getComputedStyle(el, null),
        prop,
        current = {},
        start = +new Date,
        finish = start + duration,
        running = true,
        cmpValue = 0,
        match,
        easing = function(pos){ return (-Math.cos(pos*Math.PI)/2) + 0.5; },
        loop = function(){
            if (!running) return;

            // This is needed for opera. It doesn't pass timestamp as first
            // argument to loop.
            var time = +new Date;

            requestAnimFrame(loop);
            pos = time > finish ? 1 : (time-start) / duration;

            for (prop in target) {
                setElemStyle(el, prop, (current[prop] + (target[prop] - current[prop]) * easing(pos)).toFixed(3))
            }

            if (time > finish) {
                running = false;
                after && after();
            }
        };

    for (prop in target) {
        if (prop == 'opacity' && isFilterOpacity) {
			match = comp.filter.match(/opacity\=(\d+)/);
			if (match) {
				cmpValue = parseFloat(match[1])/100;
			}

        } else {
            cmpValue = parseFloat(comp[prop]);
        }

        current[prop] = cmpValue;
    }

    requestAnimFrame(loop);
}

return G;
})();
