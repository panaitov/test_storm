;(function($) {

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

	});	/* end ready*/

	$(window).on('load resize', function() {

	});	/* end load resize*/

	$(window).on('scroll', function() {

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
})(jQuery);


