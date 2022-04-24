var modal = (function ($, window, document, undefined) {
    'use strict';

    var $trigger,
        $content,
        $modal;

    var events = function () {
        $('body').on('click', function (e) {
            var clicked = $(e.target);

            if (clicked.hasClass('modal--trigger')) {
                $content = $(clicked).closest('.modal--content');
                var cloned = $('<div>').append($content.clone()).html();

                populateModal(cloned);
                openModal();
            } else if(clicked.hasClass('gallery--trigger')) {
                return;
            } else {
                if ($(this).hasClass('modal-open')) {
                    if (!(clicked.closest('#modal--inner').length > 0)) {
                        closeModal();
                    }
                }
            }
        });
    }

    function populateModal(content) {
        var closeBtn = '<div id="modal--close"/></div>';

        $modal.append('<div class="wrapper">' + closeBtn + '<div id="modal--inner">' + content + '</div>').addClass('is-open');
    }

    function openModal() {
        $('body').addClass('modal-open');
    }

    function closeModal() {
        $modal.removeClass('is-open').empty();
        $('body').removeClass('modal-open');
    }

    return {
        init: function () {
            this.setVars();
            events();
        },
        getModal: function () {
            return this;
        },
        setVars: function () {
            $trigger = $('.modal--trigger');
            $modal = $('#modal');
        },
        populate: function ($content) {
            console.log($content);
            populateModal($content);
        },
        open: function () {
            openModal();
        }
    }
})(jQuery, window, document);
site.queue(modal);
