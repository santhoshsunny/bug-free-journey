var select =  (function($, window, document, undefined) {
    'use strict';

    var $selectEl;

    var events = function () {
        $(document).ready(function(){
            $($selectEl).each(function(){
                $(this).select2({
                  minimumResultsForSearch: 10
                });
            });
        });
    }

    return {
      init: function () {
        $selectEl = $('.style-select, .wpcf7-select');
        events();
      }
    }
  })(jQuery, window, document);
site.queue(select);
