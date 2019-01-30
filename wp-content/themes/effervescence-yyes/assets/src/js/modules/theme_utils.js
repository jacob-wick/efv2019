var ThemeUtils = (function ($) {
  
  var scrollPos = 0,
      windowHeight,
      windowWidth,
      layoutMode,
      layoutModeBreakpoint = 900,
      previousMode;


	/**
	 * 
	 */
	var init = function() {

    doStuffOnResize();
    doStuffOnScroll();

    if (document.addEventListener) {
      // $.on('resize', $.debounce(200,doStuffOnResize));
      // $.on('scroll', $.throttle(200,doStuffOnScroll));
    } else {
      // document.attachEvent('resize', $.debounce(200,doStuffOnResize));
      // document.attachEvent('scroll', $.throttle(200,doStuffOnScroll));
    }

    $(window).on('resize', $.debounce(200,doStuffOnResize));
    $(window).on('scroll', $.throttle(100,doStuffOnScroll));

  };


  // ---------------------------------------------------------------
  // RESPONSIVE FUNCTIONS
  // ---------------------------------------------------------------

	/**
	 * 
	 */
  var updateScrollPosition = function() {
		scrollPos = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
	};


	/**
	 * 

	var getScrollPosition = function() {
		return scrollPos;
  };
	 */  

	/**
	 * 
	 */
	var updateWindowHeight = function() {
		windowHeight = getWindowHeight();
	};


  /**
	 * 
	 */
	var getWindowHeight = function() {

		var w = window,
				d = document,
				e = d.documentElement,
				g = d.getElementsByTagName('body')[0],
				// x = w.innerWidth || e.clientWidth || g.clientWidth,
				y = w.innerHeight|| e.clientHeight || g.clientHeight;
		
		return y;

  };
  

	/**
	 * 
	 */
  var updateWindowWidth = function() {

    var w = window,
        d = document,
        e = d.documentElement,
        g = d.getElementsByTagName('body')[0],
        x = w.innerWidth || e.clientWidth || g.clientWidth;
        // y = w.innerHeight|| e.clientHeight || g.clientHeight;

    windowWidth = x;

  };


	/**
	 * 
	 */
  var getWindowWidth = function() {
    return windowWidth;
  };


	/**
	 * Resets various layout components for mobile display

	var resetForMobile = function() {
    //
	};
	 */

	/**
	 * Resets various layout components for desktop display

	var resetForDesktop = function() {};
	 */  

	/**
	 * Resets the layout based on layout mode

  var resetLayoutBasedOnMode = function() {};
	 */


	/**
	 * 

  var modeChanged = function() {

    if ( previousMode !== layoutMode ) {
      return true;
    } else {
      return false;
    }

  };
	 */  

	/**
	 * 
	 */
  var updateLayoutMode = function() {
    
    if ( previousMode !== layoutMode ) {
      previousMode = layoutMode;
    }

    if (getWindowWidth() > layoutModeBreakpoint) {
      layoutMode = 'desktop';
    } else {
      layoutMode = 'mobile';
    }
    
  };


	/**
	 * 
	 */
  var doStuffOnResize = function() {
    updateWindowWidth();
    updateWindowHeight();
    updateLayoutMode();
  };


  var addVisibilityClass = function()
  {

    /* Check the location of each desired element */
    $('.animate').each( function() {

      if (!$(this).hasClass('is-visible')) {
        var offset = 0;
        var top_of_object    = $(this).offset().top;
        var bottom_of_window = $(window).scrollTop() + $(window).height() + offset;

        /* If the object is completely visible in the window, fade it it */
        if( bottom_of_window > top_of_object ){
          $(this).addClass('is-visible');
        }
      }

    });

  };

	/**
	 * 
	 */
  var doStuffOnScroll = function() {
    updateScrollPosition();
    addVisibilityClass();
  };


  return {
    init: init,
  };
  
  })(jQuery);