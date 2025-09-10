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
		infinite: true,
		slidesToShow: 6,
		slidesToScroll: 1
	});
}( jQuery ) );
