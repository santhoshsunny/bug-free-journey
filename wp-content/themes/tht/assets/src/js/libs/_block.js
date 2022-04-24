var block =  (function($, window, document, undefined) {
    'use strict';

    var events = function () {
        $(window).on('resize', function(){
            blockSpacing();
        });
    }

    var blockSpacing = function () {
        if($('body').hasClass('home')) {
            $('.block.greyDiagonal').each(function(){
                var prev = $(this).prev('.block');
                var next = $(this).next('.block.background__bottom');

                //Remove any existing inline styles
                $(this).removeAttr('style');
                $(prev).removeAttr('style');

                var pad = parseInt($(this).css('padding-bottom').replace('px',''));
                var prevMargin = parseInt($(prev).css('margin-bottom').replace('px',''));
                var nextHeight = next.height();

                //Calc new values
                var offset = (0 - (nextHeight / 2)); //Needs to be negative value
                var newPad = pad + (nextHeight / 2);

                //Set new styles
                $(prev).css('margin-bottom',0);
                $(this).css({'padding-bottom' : newPad , 'padding-top' : prevMargin});
                $(next).css('margin-top',offset);
            });
        }
    }

    return {
      init: function () {
        blockSpacing();
        events();
      }
    }
  })(jQuery, window, document);
site.queue(block);