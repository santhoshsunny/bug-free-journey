var opportunities =  (function($, window, document, undefined) {
    'use strict';

    var $linkNav;

    var events = function () {
        $(window).on('resize', function() {
            positionNav();
        });
    }

    var setNav = function() {
        var path = window.location.pathname;
        path = path.replace(/\/$/, "");
        path = decodeURIComponent(path);

        $linkNav.find(".sublink a").each(function () {
            var href = $(this).get(0).pathname.replace(/\/$/, "");

            if (path.substring(0, href.length) === href) {
                $(this).closest('.sublink').addClass('active');
            }
        });

        positionNav();
    }

    var positionNav = function() {
        var $scrollDiv = $linkNav.find('.horizontal-scroll');
        var $innerListItem = $scrollDiv.find('.sublink.active');
        var pos = $innerListItem.position();

        var $innerScroll = $scrollDiv.find('.hs-wrapper');
        var $innerWidth = 0;

        $.each($innerScroll.find('.sublink'), function(){
            $innerWidth += $(this).outerWidth();
        });

        if($innerWidth > $('body').innerWidth()) {
            $innerScroll.css('justify-content','flex-start');
        }else {
            $innerScroll.css('justify-content','center');
        }

        $scrollDiv.animate({
            scrollTop: pos.left
        },500);

    }

    return {
        init: function () {
            $linkNav = $('#opportunitiesLinks');

            if($linkNav.length) {
                setNav();
                events();
            }
        }
    }
})(jQuery, window, document);

site.queue(opportunities);
