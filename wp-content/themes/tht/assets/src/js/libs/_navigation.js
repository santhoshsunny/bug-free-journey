var navigation =  (function($, window, document, undefined) {
    'use strict';

    var $hamburger;

    var events = function () {
        $(document).on('click', 'button.hamburger', function() {
            $(this).toggleClass('is-active');
            $('#site-navigation').toggleClass('is-expanded');
            $('body').toggleClass('nav-expanded');
        });
    }

    return {
      init: function () {
        $hamburger = $('button.hamburger');
        events();
      }
    }
  })(jQuery, window, document);
  site.queue(navigation);
