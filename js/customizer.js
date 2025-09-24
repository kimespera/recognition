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

	setInterval(function(){
		$('#mega-menu-item-32').addClass('mega-toggle-on');
	}, 1000);
}( jQuery ) );
