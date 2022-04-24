var odometer =  (function($, window, document, undefined) {
    'use strict';

    var $odoDiv;
    var $odoSelector;

    var offset = 0;
    var odoOpts = {};
    var odos = [];

    var initOdo = function () {
        if($($odoDiv).length > 0) {
            offset = $($odoDiv).offset().top;
        }

        $odoSelector.each(function(){
            var fig = $(this).find('.figure');

            odos.push(fig);
        });
    };

    var events = function () {
        $(window).on('scroll', function(){
            var wh = $(window).innerHeight();
            var pos = parseFloat($(window).scrollTop() + (wh / 2));

            if(pos >= offset) {
                $odoSelector.each(function(){
                    var digit = $(this).data('digit');
                    $(this).html(digit);

                    $(this).removeClass('odo-ready'); //So it doesn't run multiple times
                });
            }
        });
    };

    return {
      init: function () {
        $odoDiv = $('.odometers');
        $odoSelector = $('.odometer.odo-ready');
        initOdo();
        events();
      }
    }
  })(jQuery, window, document);
  site.queue(odometer);
