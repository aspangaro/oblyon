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
	* 	\file		../theme/oblyon/flyoutmenu.inc.php
	* 	\brief		CSS for the Oblyon flyout sub-menus mode (OBLYON_EFFECT_REDUCE_LEFTMENU = flyout, inverted + reduced left menu)
	************************************************/

	if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet');
	$oblyon_flyout	= getDolGlobalInt('MAIN_MENU_INVERT') && getDolGlobalInt('OBLYON_REDUCE_LEFTMENU') && getDolGlobalString('OBLYON_EFFECT_REDUCE_LEFTMENU') == 'flyout' && !getDolGlobalInt('OBLYON_HIDE_LEFTMENU') && empty($conf->dol_optimize_smallscreen);
?>

/* <style type="text/css" > dont remove this line it's an ide hack */
/* ================================================================================================
   oblyon/themeoblyon/flyoutmenu.inc.php
   Role      : Sous-menus en volets du menu reduit (OBLYON_EFFECT_REDUCE_LEFTMENU = flyout)
   Inclus par : global.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/*
 * Flyout sub-menus mode : third opening effect of the reduced left menu (inverted menus only)
 *
 * The main menu stays in the left side bar (.main-nav.is-inverted), reduced to its icons.
 * The top bar no longer holds any menu entry (only the logo / search / bookmarks and the
 * core login block). Hovering an icon opens a panel (ul.oblyon-flyout, printed by
 * print_oblyon_flyout()) on the right of the bar with the whole sub-menu tree of the module;
 * entries with children open a nested panel (ul.oblyon-flyout__sub) on their right, and so on.
 *
 * Colors come from the left menu constants (--bgnavleft*) and the main color (--maincolor).
 * The CSS variable --oblyon-flyout is read by js/oblyon.js (positioning when the side bar
 * is sticky or when a panel would overflow the viewport, tap-to-toggle on touch screens).
 */
:root {
	--oblyon-flyout: <?php echo $oblyon_flyout ? 1 : 0; ?>;
}
<?php if ($oblyon_flyout) { ?>

/* Top bar : no menu entries any more (only the logo), so its content is shorter than the 40px login block :
   height fixed to 40px to match it, no expansion on hover */
#tmenu_tooltipinvert,
#tmenu_tooltipinvert:hover {
	height: 40px;
	min-height: 40px;
	max-height: 40px;
}

/* Side bar : panels must not be clipped ; stays reduced on hover (panels replace the "hover" expansion effect) */
div.vmenu,
div.vmenu:hover {
	overflow: visible;
	max-width: 40px !important;
	min-width: 0 !important;
}

.main-nav.is-inverted .main-nav__item {
	position: relative;
}

@keyframes oblyonFlyoutIn {
	from { opacity: 0; transform: translateX(-4px); }
	to   { opacity: 1; transform: none; }
}

/* Panels (level 1 attached to the main entry, nested ones attached to an entry with children) */
.main-nav.is-inverted .oblyon-flyout,
.oblyon-flyout .oblyon-flyout__sub {
	display: none;
	position: absolute;
	top: 0;
	<?php print $left; ?>: calc(100% + 4px);
	min-width: 240px;
	margin: 0;
	padding: 6px 0;
	list-style: none;
	background-color: var(--bgnavleft);
	border-radius: var(--infras_radius);
	box-shadow: 0 6px 18px rgba(0, 0, 0, .22), 0 1px 3px rgba(0, 0, 0, .18);
	z-index: 200;
	animation: oblyonFlyoutIn .12s ease-out;
}

/* Invisible bridge over the 4px gap so the pointer does not lose the hover while crossing it */
.main-nav.is-inverted .oblyon-flyout::before,
.oblyon-flyout .oblyon-flyout__sub::before {
	content: '';
	position: absolute;
	top: 0;
	bottom: 0;
	<?php print $left; ?>: -6px;
	width: 6px;
}

.main-nav.is-inverted .main-nav__item:hover > .oblyon-flyout,
.main-nav.is-inverted .main-nav__item:focus-within > .oblyon-flyout,
.main-nav.is-inverted .main-nav__item.is-touch-open > .oblyon-flyout,
.oblyon-flyout li:hover > .oblyon-flyout__sub,
.oblyon-flyout li:focus-within > .oblyon-flyout__sub,
.oblyon-flyout li.is-touch-open > .oblyon-flyout__sub {
	display: block;
}

.oblyon-flyout li {
	position: relative;
	margin: 0;
	padding: 0;
	float: none;
}

/* Entries. Selectors are kept more specific than the generic link rule (a:link, a:visited ... in global.inc.php)
   and than .main-nav__item.is-sel a (selected module), so every panel gets the same colors */
.main-nav.is-inverted .oblyon-flyout .oblyon-flyout__link,
.main-nav.is-inverted .oblyon-flyout a.oblyon-flyout__link:link,
.main-nav.is-inverted .oblyon-flyout a.oblyon-flyout__link:visited {
	display: block;
	position: relative;
	padding: 9px 34px 9px 16px;
	border-<?php print $left; ?>: 3px solid transparent;
	background-color: transparent;
	color: var(--bgnavleft_txt);
	font-family: var(--fontfamilydol);
	font-size: var(--fontsize);
	font-weight: normal;
	line-height: 1.3em;
	text-align: var(--left);
	text-decoration: none;
	white-space: nowrap;
	transition: background-color .12s ease-in-out, border-color .12s ease-in-out;
}

.main-nav.is-inverted .oblyon-flyout a.oblyon-flyout__link:hover,
.main-nav.is-inverted .oblyon-flyout li:hover > a.oblyon-flyout__link,
.main-nav.is-inverted .oblyon-flyout li.is-touch-open > a.oblyon-flyout__link {
	background-color: var(--bgnavleft_hover);
	border-<?php print $left; ?>-color: var(--maincolor);
	color: var(--bgnavleft_txt_hover);
}

/* Current entry (page being displayed) */
.main-nav.is-inverted .oblyon-flyout li.is-active > a.oblyon-flyout__link {
	border-<?php print $left; ?>-color: var(--maincolor);
	color: var(--bgnavleft_txt_active);
	font-weight: 600;
}

/* Entries with children : chevron on the right (FontAwesome, same font as the menu icons) */
.main-nav.is-inverted .oblyon-flyout .has-children > .oblyon-flyout__link::after {
	content: '\f054';
	position: absolute;
	<?php print $right; ?>: 14px;
	top: 50%;
	transform: translateY(-50%)<?php print ($langs->trans('DIRECTION') == 'rtl' ? ' scaleX(-1)' : ''); ?>;
	font-family: var(--fontawesomeFamily);
	font-weight: var(--fontawesomeWeight);
	font-size: .65em;
	opacity: .7;
	transition: opacity .12s ease-in-out;
}

.main-nav.is-inverted .oblyon-flyout .has-children:hover > .oblyon-flyout__link::after,
.main-nav.is-inverted .oblyon-flyout .has-children.is-touch-open > .oblyon-flyout__link::after {
	opacity: 1;
}

.main-nav.is-inverted .oblyon-flyout .is-disabled > .oblyon-flyout__link {
	opacity: .5;
	cursor: not-allowed;
}

/* Nested panel : slightly lower than its parent entry so the nesting reads at a glance */
.oblyon-flyout .oblyon-flyout__sub {
	top: -4px;
	<?php print $left; ?>: calc(100% + 2px);
}

/* Repositioning done by js/oblyon.js : sticky side bar (the level 1 panel is taken out of the clipped bar), panels overflowing the viewport */
.main-nav.is-inverted .oblyon-flyout.oblyon-flyout--fixed {
	position: fixed;
	animation: none;	/* a transform would offset the fixed coordinates */
}

.oblyon-flyout .oblyon-flyout__sub.oblyon-flyout--up {
	top: auto;
	bottom: -4px;
}

.oblyon-flyout .oblyon-flyout__sub.oblyon-flyout--back {
	<?php print $left; ?>: auto;
	<?php print $right; ?>: calc(100% + 2px);
}

.oblyon-flyout .oblyon-flyout__sub.oblyon-flyout--back::before {
	<?php print $left; ?>: auto;
	<?php print $right; ?>: -6px;
}

/* Touch mode (see touchmenu.inc.php) : the transient :hover must not fight the tap toggle */
body.oblyon-touchmenu .main-nav.is-inverted .main-nav__item:not(.is-touch-open):hover > .oblyon-flyout,
body.oblyon-touchmenu .oblyon-flyout li:not(.is-touch-open):hover > .oblyon-flyout__sub {
	display: none;
}
<?php } ?>
