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
 *
 * The same file drives the mobile layout drawer (OBLYON_MOBILE_LAYOUT, see themeoblyon/mobile.inc.php).
 */
jQuery(document).ready(function () {
	'use strict';

	var $ = jQuery;
	var OPEN = 'is-touch-open';

	// Read the flags exposed by the theme CSS (touchmenu.inc.php, flyoutmenu.inc.php, mobile.inc.php)
	function cssFlag(name) {
		try {
			return parseInt(getComputedStyle(document.documentElement).getPropertyValue(name), 10) === 1;
		} catch (e) {
			return false;
		}
	}
	function cssInt(name, def) {
		try {
			var v = parseInt(getComputedStyle(document.documentElement).getPropertyValue(name), 10);
			return isNaN(v) ? def : v;
		} catch (e) {
			return def;
		}
	}

	/*
	 * Mobile layout (OBLYON_MOBILE_LAYOUT, see themeoblyon/mobile.inc.php).
	 *
	 * Below the phone breakpoint the main menu is an off-canvas drawer and every desktop behaviour
	 * of this file (content offset under the sticky bar, flyout positioning, touch toggles) must
	 * stand aside : mobileActive() is the single test used everywhere. The breakpoint is read from
	 * the CSS so that the JS and the @media rules can never disagree.
	 */
	var mobile = cssFlag('--oblyon-mobile');
	var mobileMq = (mobile && window.matchMedia) ? window.matchMedia('(max-width: ' + cssInt('--oblyon-mobile-bp', 600) + 'px)') : null;
	function mobileActive() {
		return !!(mobileMq && mobileMq.matches);
	}
	function onMobileChange(fn) {
		if (!mobileMq) {
			return;
		}
		if (mobileMq.addEventListener) {
			mobileMq.addEventListener('change', fn);
		} else if (mobileMq.addListener) {
			mobileMq.addListener(fn);
		}
	}

	/*
	 * Inverted top menu (MAIN_MENU_INVERT + THEME_STICKY_TOPMENU) : dynamic content offset.
	 *
	 * The inverted top bar (#tmenu_tooltipinvert) is position:fixed and the content below
	 * (#id-left, #id-right which contains .fiche) is pushed down by a HARDCODED padding-top
	 * (40/52px) sized for a single 40px row. When there are too many entries for the available
	 * width, the bar wraps onto several lines and grows taller, but the static offset does not
	 * follow, so the top of the content is hidden behind the bar. We recompute the offset from
	 * the real bar height. Runs on every device, so it must stay BEFORE the touch early-return.
	 * The sub-menus are position:absolute (excluded from outerHeight), so hovering does not
	 * change the measured height.
	 */
	(function () {
		var $bar = $('#tmenu_tooltipinvert');
		if (!$bar.length) {
			return;
		}
		var $left = $('#id-left');
		var $right = $('#id-right');
		function adjustInvertOffset() {
			// Mobile layout : the bar is a fixed 48px row and the offset is sized by the CSS
			// Non sticky bar : it is in normal flow and pushes the content by itself, no offset to patch
			if (mobileActive() || $bar.css('position') !== 'fixed') {
				$left.css('padding-top', '');
				$right.css('padding-top', '');
				return;
			}
			var h = $bar.outerHeight();
			if (!h) {
				return;
			}
			if ($left.length) {
				$left.css('padding-top', h + 'px');
			}
			if ($right.length) {
				$right.css('padding-top', (h + 12) + 'px');	// keep the original 12px gap (id-left 40 / id-right 52)
			}
		}
		adjustInvertOffset();
		$(window).on('load', adjustInvertOffset);	// fonts / FA icons can change the height after load
		var resizeTimer;
		$(window).on('resize', function () {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(adjustInvertOffset, 150);
		});
	})();

	/*
	 * Mobile drawer.
	 *
	 * The drawer is the main menu itself (nav.main-nav), positioned off-canvas by the CSS below the
	 * phone breakpoint. The button (.oblyon-mnav-btn, printed in the top bar by the menu manager)
	 * toggles body.oblyon-mnav-open ; the overlay, the close button and the Escape key close it.
	 * Inside, the chevrons (.oblyon-mnav-toggle) fold / unfold the sub-menu trees (accordion, class
	 * .is-mobile-open) while the links keep navigating. On the first opening the current module and
	 * the branch of the current page are unfolded. With classic menus the search form and the
	 * bookmarks are printed in the (collapsed) left column : they are moved into the drawer while
	 * the phone layout is active and put back in place above the breakpoint.
	 */
	if (mobile) {
		(function () {
			var $nav = $('nav.main-nav').first();
			var $btn = $('.oblyon-mnav-btn');
			if (!$nav.length || !$btn.length) {
				return;
			}
			var $body = $('body');
			var BODYOPEN = 'oblyon-mnav-open';
			var ITEMOPEN = 'is-mobile-open';
			var $overlay = $('<div class="oblyon-mnav-overlay"></div>').appendTo($body);
			var expanded = false;

			function setToggleState($li) {
				$li.children('.oblyon-mnav-toggle').attr('aria-expanded', $li.hasClass(ITEMOPEN) ? 'true' : 'false');
			}
			function expandCurrent() {
				if (expanded) {
					return;
				}
				expanded = true;
				var $active = $nav.find('.oblyon-flyout li.is-active');
				$nav.find('.main-nav__item.is-sel, .main-nav__item.tmenusel')
					.add($active.parents('li.has-children'))
					.add($active.closest('.main-nav__item'))
					.addClass(ITEMOPEN)
					.each(function () {
						setToggleState($(this));
					});
			}
			function openDrawer() {
				expandCurrent();
				$body.addClass(BODYOPEN);
				$btn.attr('aria-expanded', 'true');
			}
			function closeDrawer() {
				$body.removeClass(BODYOPEN);
				$btn.attr('aria-expanded', 'false');
			}

			$btn.on('click', function (e) {
				e.preventDefault();
				e.stopPropagation();
				if ($body.hasClass(BODYOPEN)) {
					closeDrawer();
				} else {
					openDrawer();
				}
			});
			$nav.on('click', '.oblyon-mnav-close', function (e) {
				e.preventDefault();
				closeDrawer();
			});
			$overlay.on('click', closeDrawer);
			$(document).on('keydown', function (e) {
				if ((e.key === 'Escape' || e.keyCode === 27) && $body.hasClass(BODYOPEN)) {
					closeDrawer();
				}
			});

			// Accordion : a chevron folds / unfolds its module or its entry ; folding also folds everything below it
			$nav.on('click', '.oblyon-mnav-toggle', function (e) {
				if (!mobileActive()) {
					return;
				}
				e.preventDefault();
				e.stopPropagation();
				var $li = $(this).closest('li');
				$li.toggleClass(ITEMOPEN);
				if (!$li.hasClass(ITEMOPEN)) {
					$li.find('.' + ITEMOPEN).removeClass(ITEMOPEN).each(function () {
						setToggleState($(this));
					});
				}
				setToggleState($li);
			});

			// Search form / bookmarks of the left column (classic menus only : with inverted menus they are already inside the drawer)
			var $extras = $('#id-left').find('#blockvmenusearch, #blockvmenubookmarks').filter(function () {
				return !$.contains($nav.get(0), this);
			});
			var $placeholders = $();
			function relocateExtras() {
				if (!$extras.length) {
					return;
				}
				if (mobileActive()) {
					if (!$placeholders.length) {
						$extras.each(function () {
							var $ph = $('<span class="oblyon-mnav-placeholder" hidden></span>').insertBefore(this);
							$placeholders = $placeholders.add($ph);
						});
						var $head = $nav.children('.oblyon-mnav-head');
						if ($head.length) {
							$head.after($extras);
						} else {
							$nav.prepend($extras);
						}
					}
				} else if ($placeholders.length) {
					$extras.each(function (i) {
						$placeholders.eq(i).replaceWith(this);
					});
					$placeholders = $();
				}
			}
			relocateExtras();
			onMobileChange(function () {
				if (!mobileActive()) {
					closeDrawer();
				}
				relocateExtras();
			});

			// Lists : the filter row is folded on phones (CSS) ; a button inserted above the table unfolds it.
			// It is unfolded from the start when a filter is set, and the button shows how many. The button is
			// hidden by the CSS above the phone breakpoint, and the class has no effect there.
			var lblFilters = '';
			try {
				lblFilters = getComputedStyle(document.documentElement).getPropertyValue('--oblyon-lbl-filters').trim().replace(/^["']|["']$/g, '');
			} catch (e) {
				lblFilters = '';
			}
			$('div.div-table-responsive, div.div-table-responsive-no-min').each(function () {
				var $wrap = $(this);
				var $table = $wrap.find('table.liste').first();
				var $filter = $table.children('tbody').children('tr.liste_titre_filter');
				if (!$filter.length) {
					return;
				}
				var count = 0;
				$filter.find('input, select').each(function () {
					if (this.type === 'hidden' || this.type === 'button' || this.type === 'submit' || this.type === 'checkbox' || this.type === 'radio') {
						return;
					}
					var v = $(this).val();
					if (v === null || v === undefined) {
						return;
					}
					if (Array.isArray(v)) {
						if (v.length) {
							count++;
						}
						return;
					}
					v = String(v).trim();
					if (v !== '' && v !== '-1') {
						count++;
					}
				});
				var $btn = $('<button type="button" class="oblyon-mfilter-btn"><span class="fa fa-filter" aria-hidden="true"></span><span class="oblyon-mfilter-lbl"></span></button>');
				$btn.find('.oblyon-mfilter-lbl').text(lblFilters || 'Filters');
				if (count) {
					$btn.addClass('is-active').append($('<span class="oblyon-mfilter-count"></span>').text(count));
					$table.addClass('oblyon-mfilter-open');
				}
				$btn.attr('aria-expanded', count ? 'true' : 'false');
				$wrap.before($btn);
				$btn.on('click', function () {
					$table.toggleClass('oblyon-mfilter-open');
					$btn.attr('aria-expanded', $table.hasClass('oblyon-mfilter-open') ? 'true' : 'false');
				});
			});
		})();
	}

	var forced = cssFlag('--oblyon-touchmenu-forced');
	var reduceHover = cssFlag('--oblyon-reduce-hover');
	var flyout = cssFlag('--oblyon-flyout');
	var autoTouch = ('ontouchstart' in window) || (window.matchMedia && window.matchMedia('(hover: none) and (pointer: coarse)').matches);

	/*
	 * Flyout sub-menus (OBLYON_EFFECT_REDUCE_LEFTMENU = flyout, see themeoblyon/flyoutmenu.inc.php) : positioning.
	 *
	 * CSS alone (:hover + position:absolute) is enough in the common case. Two cases need a hand:
	 *  - sticky side bar (OBLYON_STICKY_LEFTBAR): .side-nav is position:fixed with overflow hidden,
	 *    which would clip the panel -> the level 1 panel is switched to position:fixed and placed
	 *    next to the bar with viewport coordinates;
	 *  - a panel taller than the space left below its entry -> shifted up (level 1) or opened
	 *    upwards / backwards (nested panels) so it stays inside the viewport.
	 * Runs on every device (mouseenter / focusin), so it stays BEFORE the touch early-return.
	 * Nothing to do while the mobile drawer is active (panels are an accordion there).
	 */
	var placeFlyout = null;
	if (flyout) {
		(function () {
			var $items = $('.main-nav.is-inverted .main-nav__item');
			if (!$items.length) {
				return;
			}
			var sticky = ($('.side-nav').css('position') === 'fixed');
			var rtl = (getComputedStyle(document.body).direction === 'rtl');
			var MARGIN = 4;

			function placeMain($item) {
				if (mobileActive()) {
					return;
				}
				var $fly = $item.children('.oblyon-flyout');
				if (!$fly.length) {
					return;
				}
				$fly.removeClass('oblyon-flyout--fixed').css({top: '', left: '', right: '', 'max-height': '', 'overflow-y': ''});
				var rect = $item.get(0).getBoundingClientRect();
				var h = $fly.outerHeight();
				var vh = window.innerHeight;
				if (!h) {
					return;
				}
				if (sticky) {
					var bar = $item.closest('.vmenu').get(0).getBoundingClientRect();
					var top = rect.top;
					if (top + h > vh - MARGIN) {
						top = Math.max(MARGIN, vh - h - MARGIN);
					}
					$fly.addClass('oblyon-flyout--fixed').css('top', top + 'px');
					if (rtl) {
						$fly.css('right', (window.innerWidth - bar.left) + 'px');
					} else {
						$fly.css('left', bar.right + 'px');
					}
					if (h > vh - 2 * MARGIN) {
						$fly.css({'max-height': (vh - 2 * MARGIN) + 'px', 'overflow-y': 'auto'});
					}
				} else {
					var overflow = rect.top + h - (vh - MARGIN);
					if (overflow > 0) {
						$fly.css('top', (-Math.min(overflow, Math.max(0, rect.top - MARGIN))) + 'px');
					}
				}
			}

			function placeSub($li) {
				if (mobileActive()) {
					return;
				}
				var $sub = $li.children('.oblyon-flyout__sub');
				if (!$sub.length) {
					return;
				}
				$sub.removeClass('oblyon-flyout--up oblyon-flyout--back');
				var rect = $sub.get(0).getBoundingClientRect();
				var vh = window.innerHeight;
				var vw = window.innerWidth;
				if (rect.bottom > vh - MARGIN && rect.height < rect.bottom - MARGIN) {
					$sub.addClass('oblyon-flyout--up');
				}
				if (rtl ? (rect.left < MARGIN) : (rect.right > vw - MARGIN)) {
					$sub.addClass('oblyon-flyout--back');
				}
			}

			placeFlyout = placeMain;
			$items.on('mouseenter focusin', function () {
				placeMain($(this));
			});
			$(document).on('mouseenter focusin', '.oblyon-flyout li.has-children', function () {
				placeSub($(this));
			});
		})();
	}

	/*
	 * Notification center (OBLYON_NOTIFICATION_CENTER, see themeoblyon/notifcenter.inc.php and the printTopRightMenu hook).
	 *
	 * The bell printed in the top right area keeps, per user and per browser (localStorage, 50 entries, 7 days), every message
	 * shown by jNotify ($.jnotify is wrapped: the original still displays the message briefly, then it lands in the bell).
	 * With the center on, errors and warnings are no longer sticky: shown 6 s (jNotify queues the messages one after the other), then kept in the list. Labels come from the
	 * data-lbl-* attributes printed by the hook (nothing hard-coded here). Runs on every device, so it stays BEFORE the touch early-return.
	 */
	(function () {
		var $nc = $('.oblyon-notif').first();
		if (!$nc.length) {
			return;
		}
		var KEY = 'oblyon_notif_' + (parseInt($nc.attr('data-userid'), 10) || 0);
		var MAX = 50, TTL = 7 * 86400000, OPENCLASS = 'is-open';
		var $btn = $nc.find('.oblyon-notif-btn'), $count = $nc.find('.oblyon-notif-count'), $panel = $nc.find('.oblyon-notif-panel');
		var $list = $nc.find('.oblyon-notif-list'), $empty = $nc.find('.oblyon-notif-empty');

		function lbl(key) {
			return String($nc.attr('data-lbl-' + key) || '');
		}
		function load() {
			try {
				var now = Date.now();
				return (JSON.parse(localStorage.getItem(KEY) || '[]') || []).filter(function (n) {
					return n && typeof n.m === 'string' && (now - n.d) < TTL;
				}).map(function (n) {
					n.k = n.k || String(n.d);	// entries stored before the key existed
					return n;
				});
			} catch (e) {
				return [];
			}
		}
		function newKey(d) {
			return d + '-' + Math.random().toString(36).slice(2, 7);
		}
		function indexOfKey(list, k) {
			for (var i = 0; i < list.length; i++) {
				if (list[i].k === k) {
					return i;
				}
			}
			return -1;
		}
		function save(list) {
			try {
				localStorage.setItem(KEY, JSON.stringify(list.slice(0, MAX)));
			} catch (e) {
				// private browsing or storage blocked : the bell still shows the messages of this page
			}
		}
		function strip(html) {
			// DOMParser : the parsed document is inert (no script run, no image fetched, no onerror), unlike innerHTML on a detached element
			var text = '';
			try {
				text = new DOMParser().parseFromString(String(html), 'text/html').body.textContent || '';
			} catch (e) {
				text = String(html).replace(/<[^>]*>/g, ' ');
			}
			return text.replace(/\s+/g, ' ').trim();
		}
		function typeOf(opt) {
			var t = '';
			if (typeof opt === 'string') {
				t = opt;
			} else if (opt && typeof opt === 'object' && opt.type) {
				t = String(opt.type);
			}
			t = t.toLowerCase();
			if (t.indexOf('error') !== -1) {
				return 'error';
			}
			if (t.indexOf('warn') !== -1) {
				return 'warning';
			}
			return 'info';
		}
		function relative(d) {
			var s = Math.round((Date.now() - d) / 1000);
			if (s < 60) {
				return lbl('now');
			}
			var m = Math.round(s / 60);
			if (m < 60) {
				return lbl('min').replace('%s', m);
			}
			var h = Math.round(m / 60);
			if (h < 24) {
				return lbl('hour').replace('%s', h);
			}
			return lbl('day').replace('%s', Math.round(h / 24));
		}
		var memory = null;	// list of this page when localStorage is unavailable
		function current() {
			var list = load();
			return (list.length || !memory) ? list : memory;
		}
		function render() {
			var list = current(), unread = 0;
			$list.empty();
			list.forEach(function (n, i) {
				if (!n.r) {
					unread++;
				}
				var $li = $('<li class="oblyon-notif-item"></li>').addClass('oblyon-notif-' + n.t).toggleClass('is-unread', !n.r).attr('data-k', n.k);	// key, not index : another tab may have changed the list meanwhile
				var $body = $('<span class="oblyon-notif-body"></span>').appendTo($li);
				$('<span class="oblyon-notif-msg"></span>').text(n.m).appendTo($body);
				$('<span class="oblyon-notif-time"></span>').text(relative(n.d)).appendTo($body);
				$('<a href="#" class="oblyon-notif-del" aria-label="' + lbl('delete').replace(/"/g, '&quot;') + '" title="' + lbl('delete').replace(/"/g, '&quot;') + '">&times;</a>').appendTo($li);
				$list.append($li);
			});
			$empty.prop('hidden', list.length > 0);
			$count.text(unread > 99 ? '99+' : String(unread)).prop('hidden', unread === 0);
			$btn.toggleClass('has-unread', unread > 0);
		}
		function store(list) {
			memory = list;
			save(list);
			render();
		}
		function add(type, text) {
			if (!text) {
				return;
			}
			var list = current(), d = Date.now();
			list.unshift({k: newKey(d), t: type, m: text, d: d, r: false});
			store(list);
		}

		// Wrap $.jnotify : record every message, keep the original display, errors / warnings shown 6 s instead of sticky
		if (typeof $.jnotify === 'function' && !$.jnotify.oblyonWrapped) {
			var orig = $.jnotify;
			var wrapped = function (msg, opt) {
				var type = typeOf(opt);
				add(type, strip(msg));
				var args = Array.prototype.slice.call(arguments);
				if (type !== 'info') {
					if (typeof opt === 'string') {
						args[1] = {type: opt, sticky: false, delay: 6000};
						if (args.length > 2 && (typeof args[2] === 'boolean' || typeof args[2] === 'number')) {
							args.splice(2, 1);
						}
					} else if (opt && typeof opt === 'object') {
						args[1] = $.extend({}, opt, {sticky: false, delay: Math.max(parseInt(opt.delay, 10) || 0, 6000)});
					}
				}
				return orig.apply(this, args);
			};
			// the plugin calls its own helpers through $.jnotify.setup / play / pause / stop... : every property of the original is carried over
			for (var k in orig) {
				if (Object.prototype.hasOwnProperty.call(orig, k)) {
					wrapped[k] = orig[k];
				}
			}
			wrapped.oblyonWrapped = true;
			$.jnotify = wrapped;
		}

		function open() {
			render();
			$panel.prop('hidden', false);
			$nc.addClass(OPENCLASS);
			$btn.attr('aria-expanded', 'true');
		}
		function close() {
			$panel.prop('hidden', true);
			$nc.removeClass(OPENCLASS);
			$btn.attr('aria-expanded', 'false');
		}
		$btn.on('click', function (e) {
			e.preventDefault();
			e.stopPropagation();
			if ($panel.prop('hidden')) {
				open();
			} else {
				close();
			}
		});
		$panel.on('click', function (e) {
			e.stopPropagation();
		});
		// Handlers are delegated from the panel itself : its click handler above stops the propagation, so nothing bound higher (the bell block) would fire
		$panel.on('click', '.oblyon-notif-del', function (e) {
			e.preventDefault();
			e.stopPropagation();
			var list = current(), i = indexOfKey(list, String($(this).closest('.oblyon-notif-item').attr('data-k')));
			if (i >= 0) {
				list.splice(i, 1);
				store(list);
			}
		});
		$panel.on('click', '.oblyon-notif-item', function () {
			var list = current(), i = indexOfKey(list, String($(this).attr('data-k')));
			if (i >= 0 && !list[i].r) {
				list[i].r = true;
				store(list);
			}
		});
		$panel.on('click', '.oblyon-notif-readall', function (e) {
			e.preventDefault();
			var list = current();
			list.forEach(function (n) {
				n.r = true;
			});
			store(list);
		});
		$panel.on('click', '.oblyon-notif-clear', function (e) {
			e.preventDefault();
			store([]);
		});
		$(document).on('click', function () {
			if (!$panel.prop('hidden')) {
				close();
			}
		});
		$(document).on('keydown', function (e) {
			if ((e.key === 'Escape' || e.keyCode === 27) && !$panel.prop('hidden')) {
				close();
			}
		});
		render();
	})();

	/*
	 * User block (OBLYON_USER_BLOCK, see the printTopRightMenu hook, layout.inc.php for the avatar and dropdown.inc.php for the redesigned user menu).
	 *
	 * The hook prints a hidden marker with the mode and the user's initials. initials: the two <img> of the user block (top bar and header of the
	 * dropdown) become a circle carrying the initials ; photo: same thing, only when the user has no photo (data-hasphoto = 0), the real photo is kept otherwise.
	 * The core prints the images itself, so the swap happens here, in the browser (nothing else in the core markup changes).
	 */
	(function () {
		var $ub = $('.oblyon-userblock').first();
		if (!$ub.length) {
			return;
		}
		var mode = String($ub.attr('data-mode') || ''), initials = String($ub.attr('data-initials') || '');
		if (!initials || mode === 'default' || (mode === 'photo' && $ub.attr('data-hasphoto') === '1')) {
			return;
		}
		$('#topmenu-login-dropdown img.userphoto, #topmenu-login-dropdown img.dropdown-user-image').each(function () {
			$(this).replaceWith($('<span class="oblyon-avatar" aria-hidden="true"></span>').text(initials));
		});
	})();

	/*
	 * Native agenda, "modern" style (OBLYON_AGENDA_STYLE, see widgets.inc.php) : every event card takes a light tint of its own colour.
	 * The core prints the type / user colour only as an inline left border (and an inline grey background the theme overrides) : read that
	 * border colour and expose it to the CSS as --oblyon-ev-tint (14 % alpha). Without this script the cards fall back to the neutral background.
	 */
	(function () {
		if (!cssFlag('--oblyon-agenda-modern')) {
			return;
		}
		$('table.cal_event').each(function () {
			var m = String(getComputedStyle(this).borderLeftColor || '').match(/rgba?\((\d+),\s*(\d+),\s*(\d+)/);
			if (m) {
				this.style.setProperty('--oblyon-ev-tint', 'rgba(' + m[1] + ',' + m[2] + ',' + m[3] + ',.14)');
			}
		});
	})();

	// Mouse device without forcing: keep the native hover behaviour, do nothing.
	if (!forced && !autoTouch) {
		return;
	}

	$('body').addClass('oblyon-touchmenu');

	// Close every open menu, except an optional one to keep open.
	function closeAll($except) {
		$('.' + OPEN).each(function () {
			if (!$except || this !== $except.get(0)) {
				$(this).removeClass(OPEN);
			}
		});
	}

	var $invertbar = $('#tmenu_tooltipinvert');

	// --- Inverted top menu (MAIN_MENU_INVERT) - li/ul structure ---
	$invertbar.on('click', '.sec-nav.is-inverted .sec-nav__item.item-heading > a.sec-nav__link', function (e) {
		var $item = $(this).closest('.sec-nav__item');
		// No sub-menu: let the link navigate normally.
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

	// --- Inverted top menu - legacy div.menu_titre / div.menu_contenu structure ---
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

	// --- Reduced left menu with "hover" effect (OBLYON_REDUCE_LEFTMENU + effect hover) ---
	// First tap expands the collapsed menu (and swallows that tap to avoid an accidental
	// navigation on an icon); once expanded, links navigate normally. Not in the mobile drawer.
	if (reduceHover) {
		$(document).on('click', '.vmenu', function (e) {
			if (mobileActive()) {
				return;
			}
			var $vmenu = $(this);
			if (!$vmenu.hasClass(OPEN)) {
				e.preventDefault();
				e.stopPropagation();
				closeAll($vmenu);
				$vmenu.addClass(OPEN);
			}
		});
	}

	// --- Flyout sub-menus (OBLYON_EFFECT_REDUCE_LEFTMENU = flyout) ---
	// First tap on an icon opens its panel (a second tap on the icon closes it); a tap on an entry
	// with children toggles its nested panel; other entries navigate normally. Not in the mobile
	// drawer (accordion driven by the chevrons, links navigate).
	if (flyout) {
		$(document).on('click', '.main-nav.is-inverted .main-nav__item > div > a.main-nav__link', function (e) {
			if (mobileActive()) {
				return;
			}
			var $item = $(this).closest('.main-nav__item');
			if (!$item.children('.oblyon-flyout').length) {
				return;
			}
			e.preventDefault();
			e.stopPropagation();
			var willOpen = !$item.hasClass(OPEN);
			closeAll();
			if (willOpen) {
				$item.addClass(OPEN);
				if (placeFlyout) {
					placeFlyout($item);
				}
			}
		});
		$(document).on('click', '.oblyon-flyout li.has-children > a.oblyon-flyout__link', function (e) {
			if (mobileActive()) {
				return;
			}
			var $li = $(this).closest('li');
			e.preventDefault();
			e.stopPropagation();
			var willOpen = !$li.hasClass(OPEN);
			$li.siblings('.' + OPEN).removeClass(OPEN).find('.' + OPEN).removeClass(OPEN);	// one open branch at a time, ancestors kept open
			$li.toggleClass(OPEN, willOpen);
		});
	}

	// --- Close open menus on a tap outside ---
	$(document).on('click', function (e) {
		if (!$(e.target).closest('#tmenu_tooltipinvert, .vmenu').length) {
			closeAll();
		}
	});
});
