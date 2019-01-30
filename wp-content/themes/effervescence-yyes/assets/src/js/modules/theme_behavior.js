var ThemeBehavior = (function ($) {

  var init = function()
  {
    relocateWPAdminMenu();
    triggerMatchHeight();
    triggerAccordions();
    triggerFancyBox();
    scanLinksForHash();
    hashModalLauncher();
    triggerEventbriteModal();
  };


  var relocateWPAdminMenu = function()
  {
    if ( $('#wpadminbar').length ) {
      $('#wpadminbar').appendTo('body');
    }
  };


  var triggerMatchHeight = function()
  {
    $(function() {
      $('.main-menu > li').matchHeight();
    });
  };


  var triggerAccordions = function()
  {

    $('.js-toggler').on('click',function(){

      var target = '#'+$(this).data('accordion-target');

      $(this).toggleClass('is-active');

      if ($(this).hasClass('is-active')) {
        console.log('Show target');
        $(target).slideDown();
      } else {
        console.log('Hide target');
        $(target).slideUp();
      }

    });

  };


  var triggerFancyBox = function()
  {

    $("[data-fancybox]").fancybox({
      toolbar : false,
      autoFocus : false
    });

  };


  var scanLinksForHash = function()
  {
    
    $('a.btn, .wysiwyg a').each(function(){
      
      var href = $(this).attr('href');

      if (href === null) {
        return;
      }
      
      /*
      if ( href.indexOf('#tickets') > -1 ) {
        $(this).addClass('open-eventbrite-modal');
      }
      */

    });

  };


  var hashModalLauncher = function()
  {

    // watch URL for hash - this works for a reload or direct link, but not
    // for links on an existing page.
    if ( window.location.hash ) {

      var windowHash = window.location.hash;

      if ( !windowHash ) {
        return;
      }

      if ( windowHash === '#signup' ) {

        // let's add an element to the hidden modal container and then we'll simulate a click on that link
        $('<a href="#" id="tempModalLink" data-fancybox data-src="">Open Modal</a>').appendTo('.modal-hide').attr('data-src',windowHash);
        
        // simulate a click
        $('#tempModalLink').trigger('click');

        // then remove the element
        $('#tempModalLink').remove();

      } else if ( windowHash === '#tickets' ) {

        /*
        if ( $('.open-eventbrite-modal').length ) {
          $('.hidden-eventbrite-modal-link')[0].click();
        }
        */
       
      }

    }

  };


  var triggerEventbriteModal = function()
  {

    $('.open-eventbrite-modal').on('click', function(){
      $('.hidden-eventbrite-modal-link')[0].click();
      return false;
    });
    
  };

  
  return {
    init: init
  };
  
})(jQuery);