var modal =  (function($, window, document, undefined) {
    'use strict';

    var $trigger,
        $content,
        $modal;

    var events = function () {
        $($trigger).on('click', function(e) {
            e.preventDefault();

            console.log(this);

            $content = $(this).closest('.modal--content');
            var cloned = $('<div>').append($content.clone()).html();

            populateModal(cloned);
            openModal();
        });

        $(document).on('click', '#modal--close', function() {
            closeModal();
        });
    }

    function populateModal(content) {
        var closeBtn = '<div id="modal--close"/>';

        $modal.append('<div class="wrapper">'+ closeBtn + '<div id="modal--inner">' + content + '</div></div>').addClass('is-open');
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
        getModal: function(){
            return this;
        },
        setVars: function() {
            $trigger = $('.modal--trigger');
            $modal = $('#modal');
        },
        populate: function($content){
            populateModal($content);
        },
        open: function(){
            openModal();
        }
    }
  })(jQuery, window, document);
  site.queue(modal);
