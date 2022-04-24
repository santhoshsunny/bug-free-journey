var animations =  (function($, window, document, undefined) {
    'use strict';

    function initAnimations() {
      if (AOS) { 
        AOS.init({
          duration: 1000,
          once: true
        });
      }
    }

    function events() {
      $(window).on('load resize', function(){
        staffAnimate();
        acqAnimate();
      });
    }

    function staffAnimate() {
      if($('#staff')) {
        var staff = $('#staff').find('.staff--member');
        var cols;
        if(site.getBreakpoint() == 'mobile') {
          cols = 1;
        }else if(site.getBreakpoint() == 'tablet') {
          cols = 3;
        } else {
          cols = 4;
        }

        $.each(staff, function(k,v){
          var delay = (k%cols)*250;

          $(this).attr('data-aos-delay',delay);
        });
      }
    }

    function acqAnimate() {
      if($('#criteriaBlock')) {
        var blocks = $('#criteriaBlock').find('.criterion');
        var cols;
        if(site.getBreakpoint() == 'mobile') {
          cols = 1;
        } else {
          cols = 2;
        }

        $.each(blocks, function(k,v){
          var delay = (k%cols)*250;

          $(this).attr('data-aos-delay',delay);
        });
      }

      if($('#acquisitionDetails')) {
        var blocks = $('#acquisitionDetails').find('.detail-block');
        var cols;
        if(site.getBreakpoint() == 'mobile') {
          cols = 1;
        } else if (site.getBreakpoint() == 'tablet') {
          cols = 2;
        } else {
          cols = 3;
        }

        $.each(blocks, function(k,v){
          var delay = (k%cols)*250;

          $(this).attr('data-aos-delay',delay);
        });
      }
    }


    return {
      init: function () {
        initAnimations();
        events();
      }
    }
  })(jQuery, window, document);
site.queue(animations);