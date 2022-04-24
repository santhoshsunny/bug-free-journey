var site = (function($, window, document, undefined) {
    'use strict';

    var debug = true;

    var loading = function (l) {
      $('body').toggleClass('loading', l);
    }

    var scrollTo = function ($el) {
      $('html, body').animate({ scrollTop: $el.offset().top}, 1000);
    }

    var isIos = function () {
  
        var iosT = /iPad|iPhone|iPod/.test(navigator.platform)
        || (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);
        return iosT;

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

    var stripNonNumeric = (str) => {
	    str += '';
	    var rgx = /^\d|\.|-$/;
	    var out = '';
	    for( var i = 0; i < str.length; i++ ) {
		    if(rgx.test(str.charAt(i))) {
			    if( !( ( str.charAt(i) == '.' && out.indexOf( '.' ) != -1 ) ||
					  ( str.charAt(i) == '-' && out.length != 0 ) ) ){
			        out += str.charAt(i);
			      }
		    }
	    }
	    return out;
    }

    var disableBackground = function() {
      if(isIos()){
        $('#homebanner').find('.banner--img').addClass('ios-banner');
      }
    }

    var disableBgEffect = function() {
      var cpage = window.location.href;
        if(cpage.indexOf('contact-us') !== -1) {
          var temp = cpage.split('/');
          if(temp[4] !== '') {
            $('#page-banner').find('.banner--img').addClass('detail-banner');
          }
        }
    }

    var addCommas = (nStr) => {
      nStr += '';
      var x = nStr.split('.');
      var x1 = x[0];
      var x2 = x.length > 1 ? '.' + x[1] : '';
      var rgx = /(\d+)(\d{3})/;

      while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }

      return x1 + x2;
    }

    return {
      init: function () {
        disableBackground();
        disableBgEffect();
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

      stripNonNumeric: function (str) {
        return stripNonNumeric(str);
      },

      addCommas: function (nStr) {
        return addCommas(nStr);
      },

      breakpoints: {
        desktop: 1200,
        tablet: 1024,
        mobile: 768
      }
    }
  })(jQuery, window, document);
  site.queue(site);
