var site = (function($, window, document, undefined) {
    'use strict';

    var debug = true;

    var loading = function (l) {
      $('body').toggleClass('loading', l);
    }

    var scrollTo = function ($el) {
      $('html, body').animate({ scrollTop: $el.offset().top}, 1000);
    }

    var getBreakpoint = function () {
      var w = $(window).width();

      if (w < site.breakpoints.mobile) {
        return 'mobile';
      }
      if (w <= site.breakpoints.tablet) {
        return 'tablet';
      }
      else {
        return 'desktop';
      }
    }

    var bindEvents = function () {

    }

    return {
      init: function () {
        //polyfills();
        //bindEvents();
      },

      loading: function (l) {
        return loading(l);
      },

      onResize: function (options) {
        return onResize(options);
      },

      queue: function (module) {
        $(document).ready(function () {
          module.init();
        });
      },

      scrollTo: function ($el) {
        return scrollTo($el);
      },

      getBreakpoint: function () {
        return getBreakpoint();
      },

      breakpoints: {
        desktop: 1200,
        tablet: 1024,
        mobile: 768
      }
    }
  })(jQuery, window, document);
  site.queue(site);
