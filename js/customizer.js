( function( $ ) {
	// Sticky header
	var header = $('#header');
	var stickyOffset = header.offset().top;

	$(window).on('scroll', function() {
		if ($(window).scrollTop() > stickyOffset) {
			header.addClass('sticky');
		} else {
			header.removeClass('sticky');
		}
	});
	
	$('#main-menu').slicknav({
		label: '',
		appendTo:'.header',
		closeOnClick: true,
		allowParentLinks: true,
		closedSymbol: '',
		openedSymbol: ''
	});

	$('.logo-list').slick({
		arrows: false,
		autoplay: true,
		autoplaySpeed: 2000,
		slidesToShow: 6,
		slidesToScroll: 1,
		speed: 1000,
		pauseOnHover: false,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 6
				}
			},
			{
				breakpoint: 769,
				settings: {
					slidesToShow: 4
				}
			},
			{
				breakpoint: 500,
				settings: {
					slidesToShow: 2
				}
			}
		]
	});

	$('.testimonials').slick({
		nextArrow: '<button type="button" class="slick-next slick-arrow"><i class="fa-solid fa-chevron-right"></i></button>',
		prevArrow: '<button type="button" class="slick-prev slick-arrow"><i class="fa-solid fa-chevron-left"></i></button>'
	});

	const $items = $('.resource-grid__item');
	const itemsPerLoad = 3;
	let currentVisible = 9;
	const threshold = 600;
	let loading = false;
	let debounce;

	// init
	$items.hide().slice(0, currentVisible).show();

	function revealNext() {
		if (loading) return;
		if (currentVisible >= $items.length) {
		// all shown; stop listening
		$(window).off('scroll.infinite resize.infinite');
			return;
		}
		loading = true;

		const nextVisible = Math.min(currentVisible + itemsPerLoad, $items.length);
		$items.slice(currentVisible, nextVisible).fadeIn(180);
		currentVisible = nextVisible;

		loading = false;
	}

	function nearBottom() {
		return $(window).scrollTop() + $(window).height() >= $(document).height() - threshold;
	}

	function onScroll() {
		clearTimeout(debounce);
		debounce = setTimeout(function () {
		if (nearBottom()) revealNext();
		// If content still doesn't fill viewport, keep loading until it does or we run out
		while ($(document).height() <= $(window).height() + threshold && currentVisible < $items.length) {
			revealNext();
		}
		}, 80);
	}

	// bind + run once
	$(window).on('scroll.infinite resize.infinite', onScroll);
	onScroll(); // prime load in case page starts short

	// setInterval(function(){
	// 	$('#mega-menu-item-32').addClass('mega-toggle-on');
	// }, 1000);
}( jQuery ) );