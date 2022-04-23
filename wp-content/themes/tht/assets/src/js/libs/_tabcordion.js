var tabcordion =  (function($, window, document, undefined) {
    'use strict';

    var $trigger;
    var $tabContent;
    var $tabInner;

    var events = function () {
        $($trigger).on('click', function() {
            var tabIndex = $(this).data('tab');

            $tabContent.removeClass('is-active');
            $trigger.removeClass('is-active');

            $('#'+tabIndex).addClass('is-active');
            $(this).addClass('is-active');
            $('nav > .tab--trigger[data-tab="'+tabIndex+'"]').addClass('is-active');

            resetActive();

            //Responsive Only
            if(site.getBreakpoint() !== 'desktop') {
              var panel = this.nextElementSibling;

              setMaxHeight(panel);
            }
        });

        $(window).on('resize load', function(){
          if(site.getBreakpoint() !== 'desktop') {
            var panelDiv = $('.tab--content.is-active > .tab--content__inner');

            if(panelDiv.length) {
              var panel = panelDiv.get(0);

              if((panel.style.maxHeight == null) || (panel.style.maxHeight == '')) {
                setMaxHeight(panel);
              }
            }
          } else {
            resetActive();
          }
        });
    };

    function resetActive() {
      $.each($tabInner, function(k, v){
        v.style.maxHeight = null;
      });
    }

    function setMaxHeight($_element) {
      $_element.style.maxHeight = $_element.scrollHeight + "px";
    }

    return {
      init: function () {
        $trigger = $('.tab--trigger');
        $tabContent = $('.tab--content');
        $tabInner = $('.tab--content__inner');
        events();
      }
    };
  })(jQuery, window, document);
  site.queue(tabcordion);
