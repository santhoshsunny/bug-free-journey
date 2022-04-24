var tabcordion =  (function($, window, document, undefined) {
    'use strict';

    var $trigger;
    var $tabContent;
    var $tabInner;
    var $tabDiv;
    var $tabNav;

    var events = function () {
        if(site.getBreakpoint() !== 'desktop') {
          $trigger.addClass('is-active');
        }
        $($trigger).on('click', function() {
          const $this = $(this);
          var skip = 0;
          if(site.getBreakpoint() !== 'desktop') {
            if($($this).hasClass('is-active')){
              skip = 1;
            }
          }
          var tabIndex = $this.data('tab');
          $tabContent.removeClass('is-active');
          $trigger.removeClass('is-active');
          if(site.getBreakpoint() !== 'desktop') {
            if(skip == 1){
              resetActive();
              return;
            }
          }
          $('#'+tabIndex).addClass('is-active');
          $(this).addClass('is-active');
          $('nav > .tab--trigger[data-tab="'+tabIndex+'"]').addClass('is-active');

          resetActive();

            //Responsive Only
            if(site.getBreakpoint() !== 'desktop') {
              console.log('1');
              var panel = this.nextElementSibling;

              setMaxHeight(panel);
            } else {
              animateLine();
            }
        });

        $(window).on('resize', function(){

          var panelDiv = $('.tab--content.is-active > .tab--content__inner');

          if(panelDiv.length) {
            var panel = panelDiv.get(0);

            if((panel.style.maxHeight == null) || (panel.style.maxHeight == '')) {
              setMaxHeight(panel);
            }
          }

          resetActive();

          if(site.getBreakpoint() == 'desktop') {
            animateLine();
          }
        });

        $(window).on('load', function(){
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
          
          //Set animated underline
          $tabDiv.find('nav:has(.nav-underline)').each(function initialize() {
            const $container = $(this);
            const $active = $container.find('.tab--trigger.is-active').first();
            const $underline = $container.find('.nav-underline');
        
            const left = $active.position().left;
            const width = $active.outerWidth();
          
            $underline.css({left, width});
          });

        });
    };

    function animateLine() {
      var $this = $('.tab--trigger.is-active');
      const $parent = $this.parent();
      const $container = $parent.closest('nav');
      const $underline = $container.find('.nav-underline');
      const left = $this.position().left;
      const width = $this.outerWidth();

      $underline.css({left, width});
    }

    function resetActive() {
      var h = 0;

      $.each($tabInner, function(k, v){
        var oh = $(v).outerHeight();

        if(oh > h) {
          h = oh;
        }

        v.style.maxHeight = null;
      });

      if(site.getBreakpoint() == 'desktop') {
        $tabContent.height(h);
        var nh = $tabNav.height();
        $tabDiv.height(parseInt(nh + h));
      } else {
        $tabContent.height('auto');
        $tabDiv.height('auto');
      }
    }

    function setMaxHeight($_element) {
      console.log($_element.style);
      $_element.style.maxHeight = $_element.scrollHeight + "px";
    }

    return {
      init: function () {
        $tabDiv = $('.tabcordion');
        $tabNav = $tabDiv.find('nav');
        $trigger = $('.tab--trigger');
        $tabContent = $('.tab--content');
        $tabInner = $('.tab--content__inner');
        events();
      }
    };
})(jQuery, window, document);
site.queue(tabcordion);
