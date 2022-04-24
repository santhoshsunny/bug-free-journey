var navigation = (function ($, window, document, undefined) {
    'use strict';

    var $hamburger;

    var events = function () {
        $(document).on('click', 'button.hamburger', function () {
            $('.menu-item').removeClass('is-expanded');
            $(this).toggleClass('is-active');
            $('#site-navigation').toggleClass('is-expanded');
            $('body').toggleClass('nav-expanded');
        });

        $(document).on('click', '.menu-item.nolink', function () {
            if (!(site.getBreakpoint() == 'desktop')) {
                if ($(this).hasClass('is-expanded')) {
                    $(this).removeClass('is-expanded');
                } else {
                    $('.menu-item').removeClass('is-expanded');
                    $(this).addClass('is-expanded');
                }
            }
        });

        $(window).on('resize', function () {
            if (site.getBreakpoint() == 'desktop') {
                $('.menu-item').removeClass('is-expanded');
            }
        });
    }

    if (window.outerWidth < 1025) {
        $("<span class='expand'></span>").insertBefore("#main-nav .sub-menu");
        $(".expand").on('click', function (e) {
            e.preventDefault();
            $(this).toggleClass('minus').parent().siblings().find('.expand').removeClass('minus');
            //$(this).parent().toggleClass('minus').siblings().removeClass('minus');
        });
    }
    return {
        init: function () {
            $hamburger = $('button.hamburger');
            events();
        }
    }
})(jQuery, window, document);
site.queue(navigation);
