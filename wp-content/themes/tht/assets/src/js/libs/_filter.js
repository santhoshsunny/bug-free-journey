var filters = (function ($, window, document, undefined) {
	'use strict';

	var $productCat;
	var $productFilters;
	var $sort;
	var $newsCat;
	var $newsFilters;
	var $sortOrder;
	var $viewToggle;

	var events = function () {
		if (window.location.href.indexOf("news-category") > -1) {​​
			if ($('#newsList').length > 0) {
				$('html, body').animate({​​
					scrollTop: ($('#newsList').offset().top)
				}​​, 2000);
			}
		}
		
		$productCat.on('change', function () {
			$productFilters.submit();
		});

		$viewToggle.on('change', function () {
			if ($productFilters.length) {
				$productFilters.submit();
			}
		});

		$sort.on('change', function () {
			$('#sort_val').val($(this).val());

			if ($productFilters.length) {
				$productFilters.submit();
			} else {
				$newsFilters.submit();
			}
		});

		$sortOrder.on('change', function () {
			if ($productFilters.length) {
				$productFilters.submit();
			} else {
				$newsFilters.submit();
			}
		});

		$newsCat.on('change', function () {
			$newsFilters.submit();
		});

		$(window).load(pageLoad());
	}

	var pageLoad = function () {
		var cat_post = ($.urlParam('product-category'));
		if (cat_post) {
			$productCat.val(cat_post);
		}

		var view_mode = ($.urlParam('view-mode'));
		if(view_mode) {
			$('html,body').animate({
				scrollTop: $productFilters.offset().top
			},
			'slow');
		}
	}

	$.urlParam = function (name) {
		var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.search);

		return (results !== null) ? results[1] || 0 : false;
	}

	return {
		init: function () {
			$productCat = $('#product-category');
			$productFilters = $('#product-filters');

			$sort = $('#select-sort');

			$newsCat = $('#news-category');
			$newsFilters = $('#news-filters');

			$sortOrder = $('#sort-order');

			$viewToggle = $('.view-toggle');

			events();
		}
	}
})(jQuery, window, document);
site.queue(filters);