(function( $ ) {
	'use strict';

	$(function() {
		$('.frequently-asked-questions .faq-question').click(function() {
			$(this).parent('.faq-bin').toggleClass('opened');
		});
	});
})( jQuery );