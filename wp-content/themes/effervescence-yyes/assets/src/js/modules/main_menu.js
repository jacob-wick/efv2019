var MainMenu = (function ($) {

  var prevFocus,
      currFocus,
      preClickFocus;


  var init = function()
  {
    currFocus = document;

    saveFocus();
    addHoverFocus();
    setMainMenuTabIndex(-1);
    mobileMenuButton();
    escToCloseMenu();
    closeMenuOnLinkClick();

  };


  var closeMenuOnLinkClick = function()
  {
    $('.layover ul a').on('click', function(){

      var targetUrl = $(this).attr('href');
      var targetHashTag = findHashtag(targetUrl);
      var urlNoHash = targetUrl.replace(targetHashTag, "");

      /*
      console.log('Pathname for this page: '+window.location.pathname);
      console.log('Target URL: '+targetUrl);
      console.log('Target URL withot Hashtag: '+urlNoHash);
      console.log('Target Hashtag: '+targetHashTag);
      */
     
      setTimeout(function(){

        $('.js-hamburger').trigger('click');

        if (targetHashTag && window.location.pathname === urlNoHash) {
          
          var hash = location.hash.replace('#','');

          setTimeout(function(){
            var element = $('#'+hash);
            $(window).scrollTop(element.offset().top).scrollLeft(element.offset().left);
          }, 200);

        }

      }, 500);
      
    });
  };


  var findHashtag = function(searchText)
  {
    var regexp = /\B\#\w\w+\b/g;
    var result;

    result = searchText.match(regexp);
    
    if (result) {
        return result;
    } else {
        return false;
    }
  };


  var saveFocus = function()
  {
    $(window).on( 'focusin', function () {
      prevFocus = currFocus;
      currFocus = document.activeElement;
    });
  };


  var addHoverFocus = function()
  {
    $('#mainMenu a').on('hover', function(){
      $(this).focus();
    });
  };


  var trapFocus = function()
  {
    $('.master a').attr('tabindex','-1');
  };


  var releaseFocus = function()
  {
    $('.master a').attr('tabindex','0');
  };


  var setMainMenuTabIndex = function(val)
  {
    $('#mainMenu li').each(function() {
      $(this).find('a').attr('tabindex',val);
    });
  };


  var escToCloseMenu = function()
  {
    $(document).keyup(function(e) {
      if (e.which === 27) {

        if ($('body').hasClass('show-layover')) {
          var btn = $('#mainMenuButton');
          closeOverlay(btn);
        }

      }
    });
  };


  var closeOverlay = function(elem)
  {
    $(elem).removeClass('is-active');

    // remove overlay mode from the site
    $('body').removeClass('show-layover');

    // remove menu items from tabindex
    setMainMenuTabIndex(-1);

    releaseFocus();

    // return focus to original element prior to button click
    // $(preClickFocus).focus();
  };


  var openOverlay = function(elem)
  {
    // store the element focused prior to click
    preClickFocus = prevFocus;
    
    $(elem).addClass('is-active');

    // add class to body that puts the page into overlay visibility mode
    $('body').addClass('show-layover');

    // set focus on the first a tag in the main menu
    setMainMenuTabIndex(0);
    $('#mainMenu a:first').focus();
    trapFocus();
  };


  var mobileMenuButton = function()
  {

    $('.js-hamburger').on('click',function(){
      
      var btn = $(this);

      // if the button is active...
      if ($(this).hasClass('is-active')) {
        closeOverlay(btn);        
      } else {
        openOverlay(btn);
      }

    });
  };
  

  return {
    init: init
  };
  
})(jQuery);