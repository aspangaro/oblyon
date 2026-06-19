<?php
	/************************************************
	* Copyright (C) 2026   Sylvain Legrand   <contact@infras.fr>   InfraS - <https://www.infras.fr>
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
	************************************************/

	/************************************************
	* 	\file		../theme/oblyon/touchmenu.inc.php
	* 	\brief		CSS for Oblyon touch menu mode (tap-to-toggle on touch screens)
	************************************************/

	if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>

/* <style type="text/css" > dont remove this line it's an ide hack */
/*
 * Touch menu mode
 *
 * Oblyon dropdown sub-menus only open on CSS :hover. On a touch screen there is
 * no hover, so a tap triggers a transient hover that collapses as soon as the
 * finger lifts. This file replaces the :hover trigger by a class (.is-touch-open)
 * toggled by js/oblyon.js, and neutralizes the transient :hover when the touch
 * mode is active (body.oblyon-touchmenu, added by the JS).
 *
 * The two CSS variables below are read by js/oblyon.js:
 *  --oblyon-touchmenu-forced : 1 when the admin option OBLYON_TOUCH_MENU forces the mode
 *  --oblyon-reduce-hover     : 1 when the left menu is reduced with the "hover" effect
 */
:root {
	--oblyon-touchmenu-forced: <?php echo getDolGlobalInt('OBLYON_TOUCH_MENU'); ?>;
	--oblyon-reduce-hover: <?php echo (getDolGlobalString('OBLYON_REDUCE_LEFTMENU') && getDolGlobalString('OBLYON_EFFECT_REDUCE_LEFTMENU') == 'hover') ? 1 : 0; ?>;
}

/*
 * Inverted top menu (MAIN_MENU_INVERT) - expand the bar and show sub-lists on tap
 */
body.oblyon-touchmenu #tmenu_tooltipinvert.is-touch-open {
	max-height: 400px;
}

body.oblyon-touchmenu .sec-nav.is-inverted .sec-nav__item.is-touch-open .sec-nav__sub-list {
	display: block;
	position: absolute;
	opacity: 1;
	visibility: visible;
}

body.oblyon-touchmenu #tmenu_tooltipinvert div.menu_titre.is-touch-open + div.menu_contenu {
	display: block;
}

/* Neutralize the transient :hover so a stray hover (forced mode on desktop) does not fight the tap toggle */
body.oblyon-touchmenu #tmenu_tooltipinvert:not(.is-touch-open):hover {
	max-height: 40px;
}

body.oblyon-touchmenu .sec-nav.is-inverted .sec-nav__item:not(.is-touch-open):hover .sec-nav__sub-list {
	display: none;
}

body.oblyon-touchmenu #tmenu_tooltipinvert div.menu_titre:not(.is-touch-open):hover + div.menu_contenu {
	display: none;
}

/*
 * Reduced left menu with "hover" effect (OBLYON_REDUCE_LEFTMENU + OBLYON_EFFECT_REDUCE_LEFTMENU = hover)
 * Collapsed width is 40px, expanded width is 230px.
 */
body.oblyon-touchmenu .vmenu.is-touch-open {
	max-width: 230px;
	min-width: 230px;
}

body.oblyon-touchmenu .vmenu:not(.is-touch-open):hover {
	max-width: 40px;
	min-width: 0;
}
