;(function($) {

	var last_scroll_top = 0,
		$body = $('body'),
		$head_top = $('.head-top'),
		$mobile_menu_and_hamburger = $('.mobile-menu, .hamburger'),
		$overlay = $('.overlay'),
		$scroll_top_link = $('.scroll-top__link'),
		$scroll_top_btn = $('.scroll-top'),
		headerHeight = $('.header').outerHeight();

	$(document).ready(function() {

		/*Init smoothscroll*/
		if(window.matchMedia('(max-width: 768px)').matches) {
			SmoothScroll({
				touchpadSupport: true
			});
		}
		/* magic line */
		var $top_hover_line = $('#top-hover-line');
		var $bottom_hover_line = $('#bottom-hover-line');
		if($top_hover_line.length) {
			var $secondNavList = $('.second-nav__list');

			$secondNavList.on('mouseover', 'li', function() {
				moveLineHover($(this), $secondNavList, $top_hover_line);
			}).on('mouseleave', function() {
				resetLineHoverPosition($top_hover_line);
			});
		}

		if($bottom_hover_line.length) {
			var $mainNavList = $('.head-nav');

			$mainNavList.on('mouseover', 'li', function() {
				moveLineHover($(this), $mainNavList, $bottom_hover_line);
			}).on('mouseleave', function() {
				resetLineHoverPosition($bottom_hover_line);
			});
		}
		/* magic line end*/

		/* Button hover */
		$('.btn-wrap').on('mouseenter', function(e) {
			var parentOffset = $(this).offset(),
				relX = e.pageX - parentOffset.left,
				relY = e.pageY - parentOffset.top;
			$(this).find('.btn-wrap__shadow').css({top: relY, left: relX})
		}).on('mouseout', function(e) {
			var parentOffset = $(this).offset(),
				relX = e.pageX - parentOffset.left,
				relY = e.pageY - parentOffset.top;
			$(this).find('.btn-wrap__shadow').css({top: relY, left: relX})
		});

		/*  Mobile menu*/
		$(document).on('click', '.hamburger', function() {
			classAction($mobile_menu_and_hamburger, 'is-active', 'toggle');
			classAction($overlay, 'is-active', 'toggle');
		});

		/* Close mobile menu*/
		$('.overlay').click(function() {
			classAction($mobile_menu_and_hamburger, 'is-active', 'remove');
			classAction($(this), 'is-active', 'remove');
		}); // end click

		/*Loading page after 300ms closing mobile menu*/
		$(document).on('click', '.mobile-menu__list a', function(e) {
			if(window.matchMedia('(max-width: 768px)').matches) {
				e.preventDefault();
				var link = $(this).attr('href');
				classAction($mobile_menu_and_hamburger, 'is-active', 'remove');
				setTimeout(function() {
					window.location.href = link;
				}, 300);
			}
		});

		/* Testimonials slider*/
		$('.testimonials-slider').slick({
			arrows      : false,
			dots        : true,
			slide       : '.testimonials-slide',
			slidesToShow: 1
		});

		/* Error 404 button*/
		$(document).on('click', '.btn-error-404', function(e) {
			e.preventDefault();
			window.history.back();
		}); //end click

		/* Show, close modal*/
		$(document).on('click', '.js-modal-show', function(event) {
			event.preventDefault();
			var modal = $(this).attr('href');
			openCloseModal(modal);
		}); // end click

		$('.modal-wrap').click(function(e) {
			openCloseModal();
		}).children().click(function(e) {
			e.stopPropagation();
		}); // end click

		$('.modal__btn').click(function(event) {
			event.preventDefault();
			openCloseModal();
		}); // end click

		/* Scroll top page to need section*/
		$(document).on('click', '.scroll-top__link', function(event) {
			event.preventDefault();

			var elementId = $(this).attr('href');
			var top = $(elementId).offset().top;

			$('body, html').animate({
				scrollTop: top
			}, 1000);
		});// end click

	});
	/* end ready*/

	$(window).on('load resize', function() {

		/* Hide mobile menu*/
		classAction($mobile_menu_and_hamburger, 'is-active', 'remove');
		classAction($overlay, 'is-active', 'remove');

		/* Delete head-top element scroll-down class*/
		classAction($head_top, 'scroll-down', 'remove');
	});
	/* end load resize*/

	$(window).scroll(function() {
		var scroll_direction = $(this).scrollTop();

		/* Hide top line when scrolling down and show when scrolling up on desktop*/
		if(window.matchMedia('(min-width: 769px)').matches) {
			if(scroll_direction > last_scroll_top) {
				/*scroll down code*/
				$head_top.addClass('scroll-down');
			} else {
				/*scroll up code*/
				$head_top.removeClass('scroll-down');
			}
			last_scroll_top = scroll_direction;
		}

		/* Show hide arrow scroll top*/
		if(scroll_direction > headerHeight) {
			$scroll_top_btn.addClass('js-scroll-top-show');
		} else {
			$scroll_top_btn.removeClass('js-scroll-top-show');
		}
		if(scroll_direction > ($('.site-content').height()) && window.matchMedia('(max-width: 350px)').matches) {
			$scroll_top_link.addClass('body_bottom');
		} else {
			$scroll_top_link.removeClass('body_bottom');
		}
	});
	/* end scroll*/

	/* Hover line for header menus*/
	function moveLineHover(el, parent, line) {
		var $lineWidth = el.innerWidth(),
			$posX = el.offset().left;
		parent.find('li').removeClass('active');
		el.addClass('active');
		line.width($lineWidth).css('left', $posX);
	}

	function resetLineHoverPosition(line) {
		line.width('0').css('left', '0');
	}

	/* add, delete, toggle class*/
	function classAction(el, cls, action) {
		if(action === 'toggle') {
			$(el).toggleClass(cls);
		} else if(action === 'add') {
			$(el).addClass(cls);
		} else {
			$(el).removeClass(cls);
		}
	}

	/* Show hide modal window*/
	function openCloseModal() {
		if(!$body.hasClass('js-overflow')) {
			$body.addClass('js-overflow');
			$(arguments[0]).addClass('js-modal-open');
		} else {
			$body.removeClass('js-overflow');
			$('.modal-wrap').removeClass('js-modal-open');
			$('.wpcf7-not-valid').removeClass('wpcf7-not-valid');
			$('.wpcf7-response-output').css('display', 'none');
		}
	}
})(jQuery);


