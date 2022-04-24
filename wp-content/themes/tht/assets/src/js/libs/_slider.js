var simpleSlider =  (function($, window, document, undefined) {
    'use strict';

    var $slider;

    var events = function () {
      $slider.each(function (idx, item) {
          var sliderId = "carousel" + idx;
          item.id = sliderId;

          $(item).slick({
              slide: "#" + sliderId +" .simple-slider__slider___slide",
              arrows: $(item).data('arrows'),
              dots: $(item).data('dots'),
              infinite: true,
              slidesToShow: 1,
              slidesToScroll: 1,
              adaptiveHeight: true,
              fade: true,
              cssEase: 'linear',
              responsive: [
                {
                  breakpoint: 1024,
                  settings: { slidesToShow: 1 }
              },
              {
                  breakpoint: 767,
                  settings: { slidesToShow: 1 }
              }
            ]
          });

          var otherSlides = $(item).find('.slick-slide:not(.slick-current)');

          $.each(otherSlides, function(k, v){
            var animates = $(v).find('.slide-content .aos-init');
            $(animates).removeClass('aos-animate');
          });
      });
    }

    return {
      init: function () {
        $slider = $('.is-slider');
        events();
      }
    }
  })(jQuery, window, document);
  site.queue(simpleSlider);
