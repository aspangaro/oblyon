/* Copyright (C) 2026   Sylvain Legrand   <contact@infras.fr>   InfraS - <https://www.infras.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

/*
 * Touch menu mode
 *
 * Oblyon dropdown sub-menus open only on CSS :hover. On a touch screen there is no
 * hover, so a tap fires a transient hover that collapses as soon as the finger lifts
 * ("se replie de facon incontrolee"). This script replaces the :hover trigger by a
 * tap-to-toggle behaviour using the .is-touch-open class (see themeoblyon/touchmenu.inc.php).
 *
 * The mode is enabled when:
 *  - the admin option OBLYON_TOUCH_MENU forces it (CSS var --oblyon-touchmenu-forced = 1), or
 *  - the device is detected as touch only ((hover: none) and (pointer: coarse), or ontouchstart).
 */
jQuery(document).ready(function () {
	'use strict';
	var $ = jQuery;
	var OPEN = 'is-touch-open';
	function cssFlag(name) {
		try {
			return parseInt(getComputedStyle(document.documentElement).getPropertyValue(name), 10) === 1;
		} catch (e) {
			return false;
		}
	}
	var forced = cssFlag('--oblyon-touchmenu-forced');
	var reduceHover = cssFlag('--oblyon-reduce-hover');
	var autoTouch = ('ontouchstart' in window) || (window.matchMedia && window.matchMedia('(hover: none) and (pointer: coarse)').matches);
	if (!forced && !autoTouch) {
		return;
	}
	$('body').addClass('oblyon-touchmenu');
	function closeAll($except) {
		$('.' + OPEN).each(function () {
			if (!$except || this !== $except.get(0)) {
				$(this).removeClass(OPEN);
			}
		});
	}
   
	var $invertbar = $('#tmenu_tooltipinvert');

	$invertbar.on('click', '.sec-nav.is-inverted .sec-nav__item.item-heading > a.sec-nav__link', function (e) {
		var $item = $(this).closest('.sec-nav__item');
		if (!$item.find('.sec-nav__sub-list').length) {
			return;
		}
		e.preventDefault();
		e.stopPropagation();
		var willOpen = !$item.hasClass(OPEN);
		closeAll();
		if (willOpen) {
			$item.addClass(OPEN);
			$invertbar.addClass(OPEN);
		} else {
			$invertbar.removeClass(OPEN);
		}
	});
	$invertbar.on('click', 'div.menu_titre > a.vmenu', function (e) {
		var $titre = $(this).closest('div.menu_titre');
		var $contenu = $titre.next('div.menu_contenu');
		if (!$contenu.length) {
			return;
		}
		e.preventDefault();
		e.stopPropagation();
		var willOpen = !$titre.hasClass(OPEN);
		closeAll();
		if (willOpen) {
			$titre.addClass(OPEN);
			$invertbar.addClass(OPEN);
		} else {
			$invertbar.removeClass(OPEN);
		}
	});
	if (reduceHover) {
		$(document).on('click', '.vmenu', function (e) {
			var $vmenu = $(this);
			if (!$vmenu.hasClass(OPEN)) {
				e.preventDefault();
				e.stopPropagation();
				closeAll($vmenu);
				$vmenu.addClass(OPEN);
			}
		});
	}
	$(document).on('click', function (e) {
		if (!$(e.target).closest('#tmenu_tooltipinvert, .vmenu').length) {
			closeAll();
		}
	});
});
