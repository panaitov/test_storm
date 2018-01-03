;(function($) {

	var last_scroll_top = 0,
			$body = $('body'),
			$head_top = $('.head-top'),
			$mobile_menu_and_hamburger = $('.mobile-menu, .hamburger');
			$overlay = $('.overlay');

	$(document).ready(function() {
		/* magic line */
		var $top_hover_line = $('#top-hover-line');
		var $bottom_hover_line = $('#bottom-hover-line');
		if($top_hover_line.length) {
			var $secondNavList = $('.second-nav__list');
			/*if($('.second-nav__list li').hasClass('active')){
				var $lineWidth = $('.header .header__menu li.active').innerWidth(),
					$posX = $('.header .header__menu li.active').offset().left;

				$top_hover_line.width($lineWidth).css('left', $posX);
			}*/

			$secondNavList.on('mouseover', 'li', function() {
				moveLineHover($(this), $secondNavList, $top_hover_line);
			}).on('mouseleave', function() {
				resetLineHoverPosition($top_hover_line);
			});
		}

		if($bottom_hover_line.length) {
			var $mainNavList = $('.head-nav');
			/*if($('.main-nav__list li').hasClass('active')){
				var $lineWidth = $('.header .header__menu li.active').innerWidth(),
					$posX = $('.header .header__menu li.active').offset().left;

				$top_hover_line.width($lineWidth).css('left', $posX);
			}*/

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

		/*Loading page after 300ms closing mobile menu*/
		$(document).on('click', '.mobile-menu__list a', function(e) {
			if( window.matchMedia('(max-width: 768px)').matches ) {
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
			arrows: false,
			dots: true,
			slide: '.testimonials-slide',
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

		$('.modal-wrap').click(function(e){
			openCloseModal();
		}).children().click(function(e){
			e.stopPropagation();
		}); // end click

		$('.modal__btn').click(function(event) {
			event.preventDefault();
			openCloseModal();
		}); // end click

	});	/* end ready*/

	$(window).on('load resize', function() {
		/* Hide mobile menu*/
		classAction($mobile_menu_and_hamburger, 'is-active', 'remove');
		classAction($overlay, 'is-active', 'remove');

		/* Delete head-top element scroll-down class*/
		classAction($head_top, 'scroll-down', 'remove');
	});	/* end load resize*/

	$(window).on('scroll', function() {
		/* Hide top line when scrolling down and show when scrolling up on desktop*/
		if( window.matchMedia('(min-width: 769px)').matches ) {
			var scroll_direction =  $(this).scrollTop();
			if (scroll_direction > last_scroll_top){
				/*scroll down code*/
				$head_top.addClass('scroll-down');
			} else {
				/*scroll up code*/
				$head_top.removeClass('scroll-down');
			}
			last_scroll_top = scroll_direction;
		}
	});	/* end scroll*/

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
		} else if( action === 'add'){
			$(el).addClass(cls);
		} else {
			$(el).removeClass(cls);
		}
	}
	/* Show hide modal window*/
	function openCloseModal() {
		if( !$body.hasClass('js-overflow') ) {
			$body.addClass('js-overflow');
			$(arguments[0]).addClass('js-modal-open');
		} else {
			$body.removeClass('js-overflow');
			$('.modal-wrap').removeClass('js-modal-open');
		}
	}
})(jQuery);


