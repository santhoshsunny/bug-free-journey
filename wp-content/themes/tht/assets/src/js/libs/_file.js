var file =  (function($, window, document, undefined) {
    'use strict';

    var $file;

    var events = function () {
        $($file).each(function(){
            var $btn = $(this).find('.wptht-file__btn');
            var $input = $(this).find('input[type="file"]');
            var $fileBox = $(this).find('.wptht-file__name');

            $($btn).on('click', function(){
                $input.trigger('click');
            });

            $($input).on('change', function(){
                var filepath = $(this).val();
                var fileNameIndex = filepath.lastIndexOf('\\') + 1;
                var filename = filepath.substr(fileNameIndex);

                console.log(filename);
                $fileBox.html(filename);
            });
        });
    }

    return {
      init: function () {
        $file = $('.wptht-file');
        events();
      }
    }
})(jQuery, window, document);
site.queue(file);