var accordion =  (function($, window, document, undefined) {
    'use strict';

    var $trigger;
    var $panel;

    var events = function () {
      $($trigger).on('click', function() {
        $panel.css('max-height','0');
        $trigger.removeClass('is-active');

        $(this).addClass('is-active');
        var content = this.nextElementSibling;
        setMaxHeight(content);
      });

      $(window).on('load resize', function(){
        $('.accordion').each(function(){
          var dd = $(this).find('dt.is-active').next('dd');

          if(dd) {
            setMaxHeight(dd.get(0));
          }
        });
      });
    };

    function setMaxHeight($_element) {
      var panelPad = 58;

      if(site.getBreakpoint() !== 'desktop') {
        panelPad = 52;
      }

      if($_element.style) {
        $_element.style.maxHeight = parseInt($_element.scrollHeight + panelPad) + "px";
      }
    }

    return {
      init: function () {
        $trigger = $('.accordion > dt');
        $panel = $('.accordion > dd');
        events();
      }
    };
  })(jQuery, window, document);
  site.queue(accordion);
