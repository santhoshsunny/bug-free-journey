var dispoGrid = (function ($, window, document, undefined) {
	'use strict';

	var $propList;
	var $props;

	var events = function () {
        $props.on('mouseover', function(){
            if(isGrid()) {
                $(this).addClass('active');
            }
        });

        $props.on('mouseout', function(){
            if(isGrid()) {
                $(this).removeClass('active');
            }
        });

        //Mobile Events
        /*
        $props.on('touchend', function(event){
            event.preventDefault();

            if(isGrid()) {
                if($(event.target).hasClass('data-close')){
                    $(this).removeClass('active');
                } else {
                    $(this).addClass('active');
                }
            }
        });*/
    }

    function isGrid() {
        return $propList.hasClass('view-mode__grid');
    }

    function loadMore() {
        $(".property").slice(0, 5).show();
        $("#loadMore").on('click', function (e) {
            e.preventDefault();
            $(".property:hidden").slice(0, 5).fadeIn();
            if ($(".property:hidden").length == 0) {
                $("#loadMore").fadeOut('slow');
            }
            $('html,body').animate({
                scrollTop: $(this).offset().top
            }, 1500);
        });
    }

	return {
		init: function () {
            $propList = $('#propertyList');
            $props = $propList.find('.property');
            events();
            loadMore();
		}
	}
})(jQuery, window, document);
site.queue(dispoGrid);