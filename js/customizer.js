( function( $ ) {
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
}( jQuery ) );
