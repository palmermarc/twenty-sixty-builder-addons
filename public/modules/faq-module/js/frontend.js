(function( $ ) {
	'use strict';

	$(function() {
		$('.faq-question').click(function() {
			$(this).parent('.faq-bin').toggleClass('opened');
		});
	});
})( jQuery );