var gallery = (function ($, window, document, undefined) {
	'use strict';

	var $galleryTrigger;
    var $galleryImgs;
    var $_modal;

	var events = function () {
        $galleryTrigger.on('click touchstart', function(){
            $galleryImgs = $(this).next('.gallery--items');

            var cloned = $('<div>').append($galleryImgs.clone()).html();
            $_modal.populate(cloned);
            $_modal.open();

            $("#modal .gallery--items").slick({
                slide: ".simple-slider__slider___slide",
                arrows: $(this).data('arrows'),
                dots: $(this).data('dots'),
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                adaptiveHeight: true
            });

            setTimeout(function(){
                $('#modal .gallery--items').slick('refresh');
            }, 500);

        });
	}

	return {
		init: function () {
            $_modal = modal.getModal();

			$galleryTrigger = $('.gallery--trigger');

            events();
		}
	}
})(jQuery, window, document);
site.queue(gallery);


