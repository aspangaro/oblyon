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
	* 	\file		../theme/oblyon/mobile.inc.php
	* 	\brief		CSS of the Oblyon mobile layout (OBLYON_MOBILE_LAYOUT) : screens narrower than the phone breakpoint
	************************************************/

	if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet');
	$oblyon_mobile		= getDolGlobalInt('OBLYON_MOBILE_LAYOUT', 1) && GETPOST('optioncss', 'aZ09') != 'print';
	$oblyon_bp_phone	= 600;	// px : below this width, single top bar + drawer + full width content (phones)
	$oblyon_bp_tablet	= 900;	// px : below this width, tablet adjustments (content only, the side bar stays)
	$oblyon_menu_invert	= getDolGlobalInt('MAIN_MENU_INVERT');
	$oblyon_mbar_bg		= $oblyon_menu_invert ? 'var(--bgnavleft)' : 'var(--bgnavtop)';			// top bar colors : same as the desktop top bar of the current menu mode
	$oblyon_mbar_txt	= $oblyon_menu_invert ? 'var(--bgnavleft_txt)' : 'var(--bgnavtop_txt)';
	$oblyon_mbar_hover	= $oblyon_menu_invert ? 'var(--bgnavleft_hover)' : 'var(--bgnavtop_hover)';
	$oblyon_rtl			= ($langs->trans('DIRECTION') == 'rtl');
?>

/* <style type="text/css" > dont remove this line it's an ide hack */
/* ================================================================================================
   oblyon/themeoblyon/mobile.inc.php
   Role      : Disposition mobile (3.5.0) : barre unique et tiroir sous 600 px
   Inclus par : global.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/*
 * Mobile layout (OBLYON_MOBILE_LAYOUT, default on)
 *
 * The screen width decides, not the user agent : everything below is driven by @media queries, so it
 * works on a real phone, on a tablet in portrait mode and in a narrowed desktop window. Below the phone
 * breakpoint, whatever the menu mode chosen for the desktop (classic, inverted, reduced, flyout) :
 *  - the top bar (#id-top) becomes a single fixed 48px bar : drawer button, logo, login block icons ;
 *  - the main menu (nav.main-nav, in the top bar for classic menus, in the side bar for inverted menus)
 *    becomes an off-canvas drawer opened by the button ; every module carries the whole tree of its
 *    sub-menus (ul.oblyon-flyout, printed by print_oblyon_flyout() when the layout is on) rendered as an
 *    accordion (chevron button .oblyon-mnav-toggle, class .is-mobile-open set by js/oblyon.js) ;
 *  - the side bar (#id-left) is collapsed and the content (#id-right) takes the whole width.
 * The CSS variables --oblyon-mobile and --oblyon-mobile-bp are read by js/oblyon.js.
 */
:root {
	--oblyon-mobile: <?php echo $oblyon_mobile ? 1 : 0; ?>;
	--oblyon-mobile-bp: <?php echo $oblyon_bp_phone; ?>;
	--oblyon-mobile-bar-h: 48px;
	--oblyon-touch-target: 44px;
	--oblyon-mobile-gutter: 12px;
	--oblyon-lbl-filters: "<?php print str_replace('"', '\"', $langs->transnoentities('Filters')); ?>";	/* label of the filters button of the lists, read by js/oblyon.js */
}
<?php if ($oblyon_mobile) { ?>

/* Desktop : the mobile-only elements printed by the menu manager stay hidden, and so do the sub-menu trees
   printed for the drawer (the flyout effect shows them on hover with its own, more specific, rules) */
.oblyon-mnav-btn,
.oblyon-mnav-head,
.oblyon-mnav-toggle,
.oblyon-mnav-overlay,
.oblyon-mfilter-btn {
	display: none;
}
.main-nav .oblyon-flyout {
	display: none;
}
/* Phone user agent on a wide screen (inverted menus) : the core prints its search form as a "Search..." link inside the
   main menu, clipped by the 40px side bar ; it belongs to the drawer only */
div.vmenu .main-nav .blockvmenusearchphone {
	display: none;
}

@media only screen and (max-width: <?php echo $oblyon_bp_phone; ?>px) {

	/* ---------- Page frame : one 48px bar fixed at the top, content below on the whole width ---------- */
	/* On html ONLY : content wider than the screen (a module table, an open dropdown) would otherwise widen the layout
	   viewport itself, and the fixed bar and the drawer would follow it beyond the screen. Never on body as well : when
	   both html and body carry an overflow, the one of body stops applying to the viewport and body becomes a second
	   scroll container (the page scrolled twice, leaving a blank area as tall as the window scroll under the content) */
	html {
		overflow-x: hidden;
	}
	body {
		overflow-x: clip;		/* clips the wide content (keeps the layout viewport at the screen width) WITHOUT making body a scroll container, unlike hidden */
		overflow-y: visible;
		height: auto;
	}
	#id-top {
		display: flex;
		align-items: center;
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		height: var(--oblyon-mobile-bar-h);
		background-color: <?php print $oblyon_mbar_bg; ?>;
		box-shadow: var(--oblyon-shadow-md);
		z-index: 110;
	}
	#tmenu_tooltip,
	#tmenu_tooltipinvert,
	#tmenu_tooltip:hover,
	#tmenu_tooltipinvert:hover {
		display: flex;
		align-items: center;
		flex: 1 1 auto;
		min-width: 0;
		position: static;
		height: var(--oblyon-mobile-bar-h);
		min-height: 0;
		max-height: var(--oblyon-mobile-bar-h);
		width: auto;
		margin: 0;
		padding: 0 !important;
		overflow: visible;
		background-color: transparent;
		box-shadow: none !important;
		animation: none;
	}
	/* Gone from the bar : the old slide-menu button, the inverted sub-menus (they live in the drawer now), the company name */
	#id-top .pushy-btn,
	#id-top .sec-nav,
	#id-top .blockvmenusocietyname {
		display: none !important;
	}
	#id-top .menulogocontainer {
		display: block !important;
		flex: 0 1 auto;
		min-width: 0;
		margin: 0 8px;
		padding: 2px 6px;
		border-radius: var(--oblyon-radius-sm);
		line-height: 0;
		overflow: hidden;
		text-align: <?php print $left; ?>;
	}
	#id-top .menulogocontainer img.mycompany {
		height: 28px !important;
		max-width: 140px !important;
		vertical-align: middle;
	}
	#id-top .menulogocontainer a {
		display: inline-block;
		line-height: 0;
	}

	/* Drawer button */
	.oblyon-mnav-btn {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		flex: 0 0 auto;
		width: var(--oblyon-mobile-bar-h);
		height: var(--oblyon-mobile-bar-h);
		margin: 0;
		padding: 0;
		border: 0;
		border-radius: 0;
		background: transparent;
		color: <?php print $oblyon_mbar_txt; ?>;
		font-size: 20px;
		line-height: 1;
		cursor: pointer;
		-webkit-tap-highlight-color: transparent;
	}
	.oblyon-mnav-btn:hover,
	.oblyon-mnav-btn:focus-visible,
	body.oblyon-mnav-open .oblyon-mnav-btn {
		background-color: <?php print $oblyon_mbar_hover; ?>;
		outline: none;
	}

	/* Login block : icons only, on the same row as the button and the logo */
	div.login_block {
		position: static !important;
		display: flex !important;
		align-items: center;
		flex: 0 0 auto;
		height: var(--oblyon-mobile-bar-h);
		max-width: none;
		margin: 0 0 0 auto;
		padding: 0 4px 0 0;
		background-color: transparent;
		font-size: 16px !important;
		z-index: auto;
	}
	div.login_block > div {
		display: inline-flex !important;
		align-items: center;
		float: none !important;
		height: var(--oblyon-mobile-bar-h);
		line-height: var(--oblyon-mobile-bar-h);
		width: auto !important;
		min-width: 0;
		max-width: none;
		margin: 0;
		padding: 0;
		clear: none;
	}
	div.login_block .login_block_elem,
	div.login_block .login_block_elem_name {
		float: none !important;
	}
	div.login_block .login_block_other,
	div.login_block .usertext,
	div.login_block .hideonsmartphone {
		display: none !important;
	}
	/* Dropdowns of the bar (user, bookmarks, quick add, breadcrumb) : full width under the bar */
	#id-top .dropdown .dropdown-menu {
		position: fixed !important;
		top: var(--oblyon-mobile-bar-h) !important;
		<?php print $left; ?>: 8px !important;
		<?php print $right; ?>: 8px !important;
		width: auto !important;
		min-width: 0 !important;
		max-width: none !important;
		max-height: calc(100vh - var(--oblyon-mobile-bar-h) - 8px);
		overflow-y: auto;
		transform: none !important;
	}

	/* Content : side bar collapsed (only the main menu survives in it, as the drawer), content on the whole width */
	#id-container {
		display: block;
		width: 100%;
		padding-top: var(--oblyon-mobile-bar-h);
		table-layout: auto;
	}
	.side-nav,
	#id-left {
		display: block !important;
		position: static !important;
		float: none !important;
		width: 0 !important;
		min-width: 0 !important;
		max-width: none !important;
		height: 0 !important;
		margin: 0 !important;
		padding: 0 !important;
		overflow: visible !important;
		transform: none !important;
		background: transparent !important;
		box-shadow: none !important;
		z-index: auto;
	}
	#id-left > :not(.vmenu),
	.vmenu > :not(nav.main-nav) {
		display: none !important;
	}
	div.vmenu,
	div.vmenu:hover {
		display: block;
		position: static;
		width: 0 !important;
		min-width: 0 !important;
		max-width: none !important;
		height: 0;
		min-height: 0;
		margin: 0;
		padding: 0 !important;
		overflow: visible !important;
		background: transparent !important;
		box-shadow: none !important;
	}
	#id-right {
		display: block !important;
		float: none !important;
		width: 100% !important;
		padding-top: 8px !important;
		padding-<?php print $left; ?>: 0 !important;
	}
	div.fiche {
		margin-<?php print $left; ?>: var(--oblyon-mobile-gutter);
		margin-<?php print $right; ?>: var(--oblyon-mobile-gutter);
	}

	/* ---------- Drawer : the main menu, off-canvas on the left, opened by the button ---------- */
	nav.main-nav,
	nav.main-nav.is-inverted {
		display: block !important;
		position: fixed !important;
		top: 0;
		bottom: 0;
		<?php print $left; ?>: 0;
		<?php print $right; ?>: auto;
		width: min(85vw, 340px);
		max-width: none !important;
		min-width: 0 !important;
		height: 100%;
		margin: 0;
		padding: 0;
		overflow-y: auto;
		overflow-x: hidden;
		-webkit-overflow-scrolling: touch;
		background-color: var(--bgnavtop);
		color: var(--bgnavtop_txt);
		font-size: 15px;
		white-space: normal;
		box-shadow: var(--oblyon-shadow-lg);
		z-index: 130;
		visibility: hidden;
		transform: translateX(<?php print $oblyon_rtl ? '100%' : '-100%'; ?>);
		transition: transform .25s ease-out, visibility 0s linear .25s;
	}
	body.oblyon-mnav-open nav.main-nav {
		visibility: visible;
		transform: none;
		transition: transform .25s ease-out;
	}
	body.oblyon-mnav-open {
		overflow: hidden;
	}
	.oblyon-mnav-overlay {
		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background-color: rgba(0, 0, 0, .45);
		z-index: 125;
	}
	body.oblyon-mnav-open .oblyon-mnav-overlay {
		display: block;
	}

	/* Drawer header : company name + close button */
	.oblyon-mnav-head {
		display: flex;
		align-items: center;
		position: sticky;
		top: 0;
		height: var(--oblyon-mobile-bar-h);
		padding: 0 4px 0 var(--oblyon-mobile-gutter);
		background-color: var(--bgnavtop);
		border-bottom: 1px solid rgba(128, 128, 128, .3);
		color: var(--bgnavtop_txt);
		font-weight: 600;
		z-index: 1;
	}
	.oblyon-mnav-title {
		flex: 1 1 auto;
		min-width: 0;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	.oblyon-mnav-close {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		flex: 0 0 auto;
		width: var(--oblyon-touch-target);
		height: var(--oblyon-touch-target);
		margin: 0;
		padding: 0;
		border: 0;
		background: transparent;
		color: inherit;
		font-size: 18px;
		cursor: pointer;
		-webkit-tap-highlight-color: transparent;
	}

	/* Search form and bookmarks inside the drawer (printed there with inverted menus, moved there by JS with classic menus) */
	nav.main-nav .blockvmenusearch,
	nav.main-nav .blockvmenubookmarks {
		display: block;
		margin: 0;
		padding: 10px var(--oblyon-mobile-gutter);
		background-color: transparent;
		border-bottom: 1px solid rgba(128, 128, 128, .3);
		box-shadow: none;
	}
	div.vmenu .main-nav .blockvmenusearchphone {
		display: block;
	}
	nav.main-nav .blockvmenusearch .select2-container,
	nav.main-nav .vmenusearchselectcombo {
		width: 100% !important;
		min-width: 0 !important;
		max-width: none !important;
	}

	/* Modules : one 48px row each, icon + label, chevron on the right when the module has sub-menus */
	nav.main-nav .main-nav__list,
	#tmenu_tooltip .main-nav__list {
		display: block;
		margin: 0;
		padding: 4px 0 24px;
		text-align: <?php print $left; ?>;
	}
	nav.main-nav .main-nav__item,
	#tmenu_tooltip .main-nav__item,
	nav.main-nav li.tmenusel {
		display: block;
		float: none !important;
		position: relative;
		width: 100%;
		height: auto !important;
		min-width: 0;
		max-width: none !important;
		margin: 0;
		padding: 0;
		background-color: transparent;
	}
	nav.main-nav .main-nav__item:hover {
		background-color: transparent;
	}
	nav.main-nav .main-nav__item > div {
		display: block;
	}
	nav.main-nav .main-nav__item > div > a.main-nav__link,
	#tmenu_tooltip .main-nav__link {
		display: flex !important;
		align-items: center;
		height: var(--oblyon-mobile-bar-h) !important;
		max-width: none !important;
		margin: 0;
		padding: 0 !important;
		padding-<?php print $left; ?>: var(--oblyon-mobile-gutter) !important;
		padding-<?php print $right; ?>: 56px !important;
		line-height: 1.2;
		overflow: hidden;
		background-color: transparent;
		color: var(--bgnavtop_txt) !important;
		font-size: 15px;
		font-weight: 500 !important;
		text-decoration: none;
	}
	nav.main-nav .main-nav__item > div > a.main-nav__link:hover,
	nav.main-nav .main-nav__item > div > a.main-nav__link:focus-visible {
		background-color: var(--bgnavtop_hover);
		color: var(--bgnavtop_txt_hover) !important;
		outline: none;
	}
	nav.main-nav .main-nav__item.is-sel > div > a.main-nav__link,
	nav.main-nav .main-nav__item.tmenusel > div > a.main-nav__link {
		background-color: var(--bgnavtop_hover) !important;
		color: var(--bgnavtop_txt_active) !important;
		box-shadow: inset <?php print $oblyon_rtl ? '-3px' : '3px'; ?> 0 0 var(--maincolor);
	}
	nav.main-nav .main-nav__link .icon,
	nav.main-nav.is-inverted .icon,
	#tmenu_tooltip .main-nav .icon {
		display: inline-block !important;
		flex: 0 0 auto;
		float: none !important;
		width: 24px;
		min-width: 24px;
		height: auto !important;
		margin: 0;
		margin-<?php print $right; ?>: 12px;
		line-height: 1 !important;
		font-size: 18px;
		text-align: center;
	}
	nav.main-nav .mainmenuaspan,
	nav.main-nav div.tmenucenter {
		display: inline !important;
		max-width: none !important;
		padding: 0 !important;
		font-size: inherit !important;
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
	}

	/* Accordion chevrons */
	.oblyon-mnav-toggle {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		position: absolute;
		top: 0;
		<?php print $right; ?>: 0;
		width: var(--oblyon-mobile-bar-h);
		height: var(--oblyon-mobile-bar-h);
		margin: 0;
		padding: 0;
		border: 0;
		background: transparent;
		color: var(--bgnavtop_txt);
		font-size: 13px;
		opacity: .75;
		cursor: pointer;
		-webkit-tap-highlight-color: transparent;
		z-index: 1;
	}
	.oblyon-flyout > li > .oblyon-mnav-toggle {
		width: var(--oblyon-touch-target);
		height: var(--oblyon-touch-target);
	}
	.oblyon-mnav-toggle .fa {
		transition: transform .2s ease-in-out;
	}
	.is-mobile-open > .oblyon-mnav-toggle {
		opacity: 1;
	}
	.is-mobile-open > .oblyon-mnav-toggle .fa {
		transform: rotate(180deg);
	}

	/* Sub-menu trees as an accordion (the desktop flyout rules - absolute panels on hover, fixed panel when the side bar is sticky - are all neutralised) */
	nav.main-nav .oblyon-flyout,
	nav.main-nav .oblyon-flyout .oblyon-flyout__sub,
	nav.main-nav .main-nav__item:hover > .oblyon-flyout,
	nav.main-nav .main-nav__item:focus-within > .oblyon-flyout,
	nav.main-nav .main-nav__item.is-touch-open > .oblyon-flyout,
	nav.main-nav .oblyon-flyout li:hover > .oblyon-flyout__sub,
	nav.main-nav .oblyon-flyout li:focus-within > .oblyon-flyout__sub,
	nav.main-nav .oblyon-flyout li.is-touch-open > .oblyon-flyout__sub {
		display: none !important;
		position: static !important;
		top: auto !important;
		bottom: auto !important;
		left: auto !important;
		right: auto !important;
		width: 100%;
		min-width: 0;
		max-height: none !important;
		margin: 0;
		padding: 0;
		overflow: visible !important;
		background-color: transparent;
		border-radius: 0;
		box-shadow: none;
		animation: none;
		list-style: none;
	}
	nav.main-nav .main-nav__item.is-mobile-open > .oblyon-flyout,
	nav.main-nav .oblyon-flyout li.is-mobile-open > .oblyon-flyout__sub {
		display: block !important;
	}
	nav.main-nav .main-nav__item.is-mobile-open > .oblyon-flyout {
		padding: 4px 0;
		background-color: rgba(0, 0, 0, .14);
	}
	nav.main-nav .oblyon-flyout::before,
	nav.main-nav .oblyon-flyout .oblyon-flyout__sub::before {
		display: none;
	}
	nav.main-nav .oblyon-flyout li {
		position: relative;
		float: none;
		margin: 0;
		padding: 0;
	}
	nav.main-nav .main-nav__list .oblyon-flyout .oblyon-flyout__link,
	nav.main-nav .main-nav__list .oblyon-flyout a.oblyon-flyout__link:link,
	nav.main-nav .main-nav__list .oblyon-flyout a.oblyon-flyout__link:visited {
		display: flex;
		align-items: center;
		position: static;
		min-height: var(--oblyon-touch-target);
		box-sizing: border-box;
		padding: 8px 0;
		padding-<?php print $left; ?>: 48px;
		padding-<?php print $right; ?>: 52px;
		border-<?php print $left; ?>: 3px solid transparent;
		background-color: transparent;
		color: var(--bgnavtop_txt) !important;
		font-size: 14px;
		font-weight: normal;
		line-height: 1.3;
		white-space: normal;
		text-decoration: none;
	}
	nav.main-nav .main-nav__list .oblyon-flyout .item-level1 > .oblyon-flyout__link {
		padding-<?php print $left; ?>: 64px;
	}
	nav.main-nav .main-nav__list .oblyon-flyout .item-level2 > .oblyon-flyout__link {
		padding-<?php print $left; ?>: 80px;
	}
	nav.main-nav .main-nav__list .oblyon-flyout .item-level3 > .oblyon-flyout__link {
		padding-<?php print $left; ?>: 96px;
	}
	nav.main-nav .main-nav__list .oblyon-flyout .has-children > .oblyon-flyout__link::after {
		content: none;
	}
	nav.main-nav .main-nav__list .oblyon-flyout a.oblyon-flyout__link:hover,
	nav.main-nav .main-nav__list .oblyon-flyout a.oblyon-flyout__link:focus-visible,
	nav.main-nav .main-nav__list .oblyon-flyout li.is-mobile-open > a.oblyon-flyout__link {
		background-color: var(--bgnavtop_hover);
		color: var(--bgnavtop_txt_hover) !important;
		outline: none;
	}
	nav.main-nav .main-nav__list .oblyon-flyout li.is-active > a.oblyon-flyout__link {
		border-<?php print $left; ?>-color: var(--maincolor);
		color: var(--bgnavtop_txt_active) !important;
		font-weight: 600;
	}
	nav.main-nav .main-nav__list .oblyon-flyout .is-disabled > .oblyon-flyout__link {
		opacity: .5;
	}

	/* ---------- Cards : title, banner, tabs, fields, action buttons ---------- */
	/* Page title (load_fiche_titre / print_barre_liste) : the title cell takes the width, the right cell (pagination,
	   buttons) only what it needs and wraps under the title when needed ; the picto stays small */
	div.fiche table.table-fiche-title {
		margin-top: 10px;
		margin-bottom: 8px;
		table-layout: auto;
	}
	table.table-fiche-title td.col-picto {
		width: 1%;
		padding-<?php print $right; ?>: 6px;
	}
	table.table-fiche-title td.col-picto .pictotitle {
		font-size: 1.3em;
	}
	table.table-fiche-title td.col-title {
		width: auto;
		min-width: 50%;
	}
	table.table-fiche-title .col-title div.titre {
		line-height: 1.25;
		white-space: normal;
	}
	table.table-fiche-title td.col-center {
		display: none;
	}
	table.table-fiche-title td.col-right {
		width: auto;
		white-space: normal;
		text-align: <?php print $right; ?>;
	}
	table.table-fiche-title td.col-right .pagination ul {
		flex-wrap: wrap;
		justify-content: flex-end;
	}
	/* Banner (dol_banner_tab) : compact, never sticky on a phone, photo 48px, status under the ref on its own line */
	div.arearef,
	div.arearefnobottom {
		position: static !important;
		padding-top: 0;
		padding-bottom: 8px;
		margin-bottom: 8px;
	}
	div.heightref {
		min-height: 0;
	}
	div.divphotoref {
		padding-<?php print $right; ?>: 8px !important;
	}
	img.photoref,
	div.photoref {
		height: 48px;
		width: 48px;
		padding: 2px;
	}
	/* Order inside the banner (showrefnav prints : navigation, status, photo, ref) : navigation on top, photo + ref side by side, status under */
	div.arearef > div,
	div.arearefnobottom > div {
		display: grid;
		grid-template-columns: auto minmax(0, 1fr);
		grid-template-areas: "nav nav" "photo ref" "status status";
		align-items: center;
		gap: 4px 8px;
	}
	div.arearef .paginationref,
	div.arearefnobottom .paginationref {
		grid-area: nav;
		display: flex;
		justify-content: flex-end;
		padding-bottom: 0;
	}
	div.arearef .paginationref ul.right,
	div.arearefnobottom .paginationref ul.right {
		float: none;
		margin: 0;
	}
	div.arearef > div > div.floatleft:not(.refid),
	div.arearefnobottom > div > div.floatleft:not(.refid) {
		float: none !important;	/* photo (or any other block) : auto-placed in the free "photo" cell */
	}
	div.arearef .refid .nowrap,
	div.arearef .refidno,
	div.arearef .refidno *,
	div.arearefnobottom .refid .nowrap,
	div.arearefnobottom .refidno,
	div.arearefnobottom .refidno * {
		white-space: normal !important;
		overflow-wrap: anywhere;
	}
	div.arearef .refid,
	div.arearefnobottom .refid {
		grid-area: ref;
		min-width: 0;
		max-width: none !important;
		margin: 0 !important;
		padding: 0 !important;
		float: none !important;
		font-size: 1.25em;
	}
	div.arearef .statusref,
	div.arearefnobottom .statusref {
		grid-area: status;
		float: none;
		clear: both;
		padding-<?php print $left; ?>: 0;
		margin: 2px 0 0 0;
		text-align: <?php print $left; ?>;
	}
	div.arearef .refid,
	div.arearef .refidno,
	div.arearefnobottom .refid,
	div.arearefnobottom .refidno {
		white-space: normal;
		word-break: break-word;
		line-height: 1.35;
	}
	div.refidno {
		font-size: var(--fontsize) !important;
	}
	/* Tabs : one horizontal strip that scrolls with the finger (no wrapping, no "more" needed) */
	div.tabs {
		display: flex;
		flex-wrap: nowrap;
		align-items: flex-end;
		height: auto;
		margin: 10px 0 -1px 0;
		padding: 0 0 0 2px;
		overflow-x: auto;
		overflow-y: hidden;
		-webkit-overflow-scrolling: touch;
		scrollbar-width: none;
		white-space: nowrap;
	}
	div.tabs::-webkit-scrollbar {
		display: none;
	}
	div.tabs > div.tabsElem {
		flex: 0 0 auto;
		float: none;
		margin: 0 4px 0 0;
	}
	div.tabs > div.tabsElem.floatright {
		order: 99;
		margin-<?php print $left; ?>: auto;
		margin-<?php print $right; ?>: 0;
	}
	div.tabs a.tab {
		white-space: nowrap;
		padding-left: 10px;
		padding-right: 10px;
	}
	/* Tabs grouped by the core under "+N" (the core limits a phone to one visible tab, main.inc.php small screen flag) :
	   the "+N" entry is hidden and the grouped tabs join the scrolling strip as ordinary tabs */
	div.tabs > div.tabsElem[id^="moretabs"] {
		display: contents;
	}
	div.tabs > div.tabsElem[id^="moretabs"] > div.tab {
		display: none;
	}
	div.tabs > div.tabsElem[id^="moretabs"] > div[id^="moretabsList"],
	div.tabs > div.tabsElem[id^="moretabs"] > div[id^="moretabsList"] > div.popuptabset,
	div.tabs > div.tabsElem[id^="moretabs"] > div[id^="moretabsList"] > div.popuptabset > div.popuptab {
		display: contents !important;
		position: static !important;
		width: auto !important;
		margin: 0 !important;
		padding: 0 !important;
		border: 0 !important;
		box-shadow: none !important;
	}
	div.tabs > div.tabsElem[id^="moretabs"] div.popuptab > a {
		display: inline-block;
		flex: 0 0 auto;
		margin: 0 4px 0 0;
		padding: 8px 10px;
		border-radius: var(--oblyon-radius) var(--oblyon-radius) 0 0;
		color: var(--colorfline);
		font-weight: 500;
		white-space: nowrap;
		text-decoration: none;
	}
	div.tabBar {
		padding-left: 10px;
		padding-right: 10px;
	}
	/* Field tables (key / value) : every cell on its own line, label above the value in a lighter text */
	table.tableforfield,
	table.tableforfieldcreate,
	table.tableforfieldedit {
		width: 100% !important;
		table-layout: fixed;
	}
	/* Selectors carry "div.fiche table" so they outrank the 40px row height forced by global.inc.php below 570px (div.tabBar table.border tr td) */
	div.fiche table.tableforfield > tbody > tr,
	div.fiche table.tableforfieldcreate > tbody > tr,
	div.fiche table.tableforfieldedit > tbody > tr,
	div.fiche div.tableforfield div.tagtr {
		display: block;
		height: auto !important;
	}
	div.fiche table.tableforfield > tbody > tr > td,
	div.fiche table.tableforfieldcreate > tbody > tr > td,
	div.fiche table.tableforfieldedit > tbody > tr > td,
	div.fiche div.tableforfield div.tagtr > div.tagtd {
		display: block;
		box-sizing: border-box;
		width: auto !important;
		min-width: 0 !important;
		max-width: none !important;
		height: auto !important;
		padding-left: 4px;
		padding-right: 4px;
		white-space: normal;
		word-break: break-word;
		overflow-wrap: anywhere;
	}
	div.fiche table.tableforfield > tbody > tr > td:first-child,
	div.fiche table.tableforfieldcreate > tbody > tr > td:first-child,
	div.fiche table.tableforfieldedit > tbody > tr > td:first-child,
	div.fiche div.tableforfield div.tagtr > div.tagtd:first-of-type {
		padding-top: 8px;
		padding-bottom: 0;
		border-bottom: 0 !important;
		color: var(--oblyon-muted-text);
		font-size: .92em;
	}
	div.fiche table.tableforfield > tbody > tr > td:first-child:last-child,
	div.fiche table.tableforfieldcreate > tbody > tr > td:first-child:last-child,
	div.fiche table.tableforfieldedit > tbody > tr > td:first-child:last-child {
		color: inherit;
		font-size: inherit;
		padding-bottom: 8px;
	}
	div.fiche table.tableforfield > tbody > tr > td:nth-child(2),
	div.fiche table.tableforfieldcreate > tbody > tr > td:nth-child(2),
	div.fiche table.tableforfieldedit > tbody > tr > td:nth-child(2),
	div.fiche div.tableforfield div.tagtr > div.tagtd:nth-child(2) {
		padding-top: 2px;
		padding-bottom: 8px;
	}
	.titlefield,
	.titlefieldcreate,
	.titlefieldmiddle,
	.titlefieldmax45 {
		width: auto !important;
		min-width: 0 !important;
		max-width: none !important;
	}
	/* Action buttons : stacked, full width, 44px high, never sticky on a phone ; the "more actions" list opens over the bottom of the screen */
	div.tabsAction {
		display: flex;
		flex-direction: column;
		align-items: stretch;
		gap: 8px;
		position: static !important;
		margin: 12px 0 20px 0;
		text-align: center;
	}
	div.tabsAction > a,
	div.tabsAction > span,
	div.tabsAction > div.divButAction,
	div.tabsAction > div.dropdown,
	div.tabsAction > div.dropdown-holder {
		display: block;
		float: none;
		width: 100%;
		margin: 0 !important;
		box-sizing: border-box;
	}
	div.tabsAction > div.divButAction > a,
	div.tabsAction > div.divButAction > span,
	div.tabsAction > div.dropdown-holder > a.dropdown-toggle,
	div.tabsAction > a.butAction,
	div.tabsAction > a.butActionDelete,
	div.tabsAction > a.butActionRefused,
	div.tabsAction > span.butAction,
	div.tabsAction > span.butActionDelete,
	div.tabsAction > span.butActionRefused {
		display: block;
		width: 100%;
		box-sizing: border-box;
		min-height: var(--oblyon-touch-target);
		margin: 0 !important;
		padding: .7em 1em;
		line-height: 1.3;
		white-space: normal;
	}
	div.tabsAction .dropdown-holder .dropdown-content {
		position: fixed !important;
		top: auto !important;
		bottom: 8px !important;
		<?php print $left; ?>: 8px !important;
		<?php print $right; ?>: 8px !important;
		width: auto !important;
		max-height: 70vh;
		overflow-y: auto;
		transform: none !important;
		z-index: 120;
	}
	div.tabsAction .dropdown-holder.open .dropdown-content::before {
		display: none;
	}
	div.tabsAction .dropdown-content a.butAction,
	div.tabsAction .dropdown-content .butActionRefused {
		min-height: var(--oblyon-touch-target);
		align-items: center;
		white-space: normal;
	}

	/* ---------- Lists : horizontal scroll inside the frame with the first column pinned, folded filters, compact pagination ---------- */
	div.fiche > form > div.div-table-responsive,
	div.fiche > div.tabBar > form > div.div-table-responsive {
		min-height: 0;
	}
	.div-table-responsive,
	.div-table-responsive-no-min {
		overflow-x: auto !important;	/* global.inc.php unsets it on every screen (lists then widen the page) : on a phone the frame scrolls, not the page */
		-webkit-overflow-scrolling: touch;
		overscroll-behavior-x: contain;
	}
	/* Object lines : the description column (and the description editor of the add / edit line form) keeps a readable width
	   (global.inc.php shrinks .minwidth400imp to 150px below 767px, which left CKEditor 136px wide with its tools hidden) */
	table#tablelines td.linecoldescription {
		min-width: 320px !important;
	}
	table#tablelines td.linecoldescription .cke,
	table#tablelines td.linecoldescription textarea {
		width: 100% !important;
		max-width: 100% !important;
	}
	/* CKEditor tools back on phones : global.inc.php hides every button except "maximize" below 768px ; with the mobile
	   layout the editor has a readable width and the toolbar simply wraps on several rows */
	.cke_inner:not(.cke_maximized) .cke_button:not(.cke_button__maximize) {
		display: inline-block;
	}
	.cke_inner:not(.cke_maximized) .cke_combo {
		display: none;	/* the three combos (format, font, size) stay hidden : too wide for a phone, the buttons are enough */
	}
	.cke_inner:not(.cke_maximized) .cke_toolbar_separator {
		display: block;
	}
	.cke_top {
		white-space: normal;
	}
	/* Wide tables of the cards (object lines, module tables with 6 columns or more) : room for the columns, the frame scrolls */
	div.div-table-responsive-no-min > table#tablelines,
	div.div-table-responsive-no-min > table.noborder:has(> tbody > tr.liste_titre > td:nth-child(6)),
	div.div-table-responsive-no-min > table.noborder:has(> tbody > tr.liste_titre > th:nth-child(6)),
	div.div-table-responsive > table.noborder:has(> tbody > tr.liste_titre > td:nth-child(6)),
	div.div-table-responsive > table.noborder:has(> tbody > tr.liste_titre > th:nth-child(6)) {
		min-width: 640px;
	}
	/* List pages (table.liste) ; the documents block of the cards (table.liste.formdoc) keeps its natural layout */
	div.div-table-responsive table.liste:not(.formdoc) > tbody > tr > :first-child,
	div.div-table-responsive-no-min table.liste:not(.formdoc) > tbody > tr > :first-child {
		position: sticky;
		<?php print $left; ?>: 0;
		z-index: 2;
		background-color: var(--bgcolor);	/* opaque fallback (the page color) so the cells scrolling under stay hidden... */
		background-image: inherit;			/* ...and the stripe of the row (a gradient set on the row by global.inc.php) on top of it */
		max-width: 45vw;
		overflow: hidden;
		text-overflow: ellipsis;
		box-shadow: <?php print $oblyon_rtl ? '-1px' : '1px'; ?> 0 0 var(--oblyon-border);
	}
	div.div-table-responsive table.liste:not(.formdoc) > tbody > tr:hover > :first-child,
	div.div-table-responsive-no-min table.liste:not(.formdoc) > tbody > tr:hover > :first-child {
		background-color: inherit;	/* hovered rows carry a plain color on the row */
	}
	/* Cells on one line (the table grows and scrolls instead of squeezing every column), long texts cut with an ellipsis */
	div.div-table-responsive table.liste:not(.formdoc),
	div.div-table-responsive-no-min table.liste:not(.formdoc) {
		width: auto !important;
		min-width: 100%;
	}
	div.div-table-responsive table.liste:not(.formdoc) > tbody > tr.oddeven > td,
	div.div-table-responsive-no-min table.liste:not(.formdoc) > tbody > tr.oddeven > td {
		white-space: nowrap;
		max-width: 60vw;
		overflow: hidden;
		text-overflow: ellipsis;
	}
	div.div-table-responsive table.liste:not(.formdoc) > tbody > tr.liste_titre > :first-child,
	div.div-table-responsive table.liste:not(.formdoc) > tbody > tr.liste_titre_filter > :first-child,
	div.div-table-responsive table.liste:not(.formdoc) > tbody > tr.liste_total > :first-child,
	div.div-table-responsive-no-min table.liste:not(.formdoc) > tbody > tr.liste_titre > :first-child,
	div.div-table-responsive-no-min table.liste:not(.formdoc) > tbody > tr.liste_titre_filter > :first-child,
	div.div-table-responsive-no-min table.liste:not(.formdoc) > tbody > tr.liste_total > :first-child {
		background-color: var(--colorbtitle);
	}
	/* Filter row folded, unfolded by the button inserted above the table by js/oblyon.js (open when a filter is set) */
	table.liste > tbody > tr.liste_titre_filter {
		display: none;
	}
	table.liste.oblyon-mfilter-open > tbody > tr.liste_titre_filter {
		display: table-row;
	}
	.oblyon-mfilter-btn {
		display: inline-flex;
		align-items: center;
		gap: 6px;
		min-height: 36px;
		margin: 4px 0 6px 0;
		padding: 0 12px;
		border: 1px solid var(--oblyon-border-strong);
		border-radius: var(--oblyon-radius-pill);
		background-color: var(--colorbline);
		color: var(--colortext);
		font-family: var(--fontfamilydol);
		font-size: var(--fontsize);
		cursor: pointer;
		-webkit-tap-highlight-color: transparent;
	}
	.oblyon-mfilter-btn.is-active,
	.oblyon-mfilter-btn[aria-expanded="true"] {
		border-color: var(--maincolor);
		color: var(--maincolor);
	}
	.oblyon-mfilter-count {
		display: inline-block;
		min-width: 18px;
		padding: 0 6px;
		border-radius: var(--oblyon-radius-pill);
		background-color: var(--maincolor);
		color: #FFFFFF;
		font-size: .85em;
		line-height: 18px;
		text-align: center;
	}
	div.liste_titre_bydiv {
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		gap: 6px;
	}
	div.divsearchfieldfilter {
		white-space: normal;
	}
	/* Title bar of the list : pagination and tool buttons wrap under the title */
	table.table-fiche-title td.col-right {
		white-space: normal;
	}
	div.pagination ul {
		display: inline-flex;
		flex-wrap: wrap;
		justify-content: flex-end;
		align-items: center;
	}
	div.pagination li.pagination a,
	div.pagination li.pagination span {
		padding-left: 8px;
		padding-right: 8px;
	}
	/* Rows a little taller and checkboxes a little bigger for the finger */
	table.liste .oddeven td {
		padding-top: 8px;
		padding-bottom: 8px;
	}
	table.liste input[type=checkbox],
	.checkallactions input[type=checkbox] {
		width: 18px;
		height: 18px;
	}

	/* ---------- Forms : fields on the whole width, 16px text (no zoom on focus on iOS), 44px buttons ---------- */
	div.fiche input:not([type=checkbox]):not([type=radio]):not([type=file]):not([type=submit]):not([type=button]):not(.button),
	div.fiche select,
	div.fiche textarea {
		font-size: 16px;
	}
	div.fiche table.border td input.flat:not([type=checkbox]):not([type=radio]):not([type=file]):not(.datepicker):not(.width25):not(.width50):not(.width75):not(.maxwidth25):not(.maxwidth50):not(.maxwidth75):not(.pageplusone),
	div.fiche table.tableforfieldcreate td input.flat:not([type=checkbox]):not([type=radio]):not([type=file]):not(.datepicker):not(.width25):not(.width50):not(.width75):not(.maxwidth25):not(.maxwidth50):not(.maxwidth75),
	div.fiche table.tableforfieldedit td input.flat:not([type=checkbox]):not([type=radio]):not([type=file]):not(.datepicker):not(.width25):not(.width50):not(.width75):not(.maxwidth25):not(.maxwidth50):not(.maxwidth75),
	div.fiche table.tableforfield td input.flat:not([type=checkbox]):not([type=radio]):not([type=file]):not(.datepicker):not(.width25):not(.width50):not(.width75):not(.maxwidth25):not(.maxwidth50):not(.maxwidth75),
	div.fiche table.border td select.flat:not(.maxwidth25):not(.maxwidth50):not(.maxwidth75):not(.width25):not(.width50):not(.width75),
	div.fiche table.tableforfieldcreate td select.flat:not(.maxwidth25):not(.maxwidth50):not(.maxwidth75):not(.width25):not(.width50):not(.width75),
	div.fiche table.tableforfieldedit td select.flat:not(.maxwidth25):not(.maxwidth50):not(.maxwidth75):not(.width25):not(.width50):not(.width75),
	div.fiche table.tableforfield td select.flat:not(.maxwidth25):not(.maxwidth50):not(.maxwidth75):not(.width25):not(.width50):not(.width75),
	div.fiche table.border td textarea,
	div.fiche table.tableforfieldcreate td textarea,
	div.fiche table.tableforfieldedit td textarea,
	div.fiche table.tableforfield td textarea,
	div.fiche table.border td span.select2-container,
	div.fiche table.tableforfieldcreate td span.select2-container,
	div.fiche table.tableforfieldedit td span.select2-container,
	div.fiche table.tableforfield td span.select2-container,
	div.fiche div.tableforfield div.tagtd input.flat:not([type=checkbox]):not([type=radio]):not([type=file]):not(.datepicker),
	div.fiche div.tableforfield div.tagtd select.flat,
	div.fiche div.tableforfield div.tagtd textarea,
	div.fiche div.tableforfield div.tagtd span.select2-container {
		display: inline-block;
		box-sizing: border-box;
		width: 100% !important;
		min-width: 0 !important;
		max-width: 100% !important;
	}
	div.fiche table td input.datepicker {
		width: 45% !important;
		min-width: 0 !important;
		max-width: 160px !important;
	}
	div.fiche .cke {
		width: 100% !important;
		max-width: 100% !important;
	}
	/* Form buttons (Create / Cancel) side by side on the whole width */
	div.fiche form div.center:has(> .button),
	div.fiche form div.center:has(> input[type=submit]),
	div.fiche form div.center:has(> button) {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		gap: 8px;
	}
	div.fiche form div.center > input.button,
	div.fiche form div.center > input[type=submit],
	div.fiche form div.center > button,
	div.fiche form div.center > .button {
		flex: 1 1 40%;
		box-sizing: border-box;
		min-height: var(--oblyon-touch-target);
		margin: 0 !important;
	}
	div.fiche .button,
	div.fiche input.button,
	div.fiche input[type=submit] {
		min-height: 40px;
	}

	/* ---------- Dialogs (jQuery UI) : bottom sheet on the whole width, stacked buttons ; tooltip dialogs (.highlight) and select2 lists (the core gives them the ui-dialog class too, ajax.lib.php) untouched ---------- */
	.ui-dialog:not(.highlight):not(.select2-dropdown) {
		display: flex;
		flex-direction: column;
		box-sizing: border-box;
		position: fixed !important;
		top: auto !important;
		<?php print $left; ?>: 0 !important;
		<?php print $right; ?>: 0 !important;
		bottom: 0 !important;
		width: auto !important;
		max-width: 100vw !important;
		height: auto !important;
		max-height: calc(100vh - var(--oblyon-mobile-bar-h)) !important;	/* bottom sheet : as tall as its content, the screen at most */
		margin: 0 !important;
		padding: 0;
		border-radius: var(--oblyon-radius) var(--oblyon-radius) 0 0;
		z-index: 140 !important;
	}
	.ui-dialog:not(.highlight):not(.select2-dropdown) .ui-dialog-titlebar {
		flex: 0 0 auto;
		border-radius: var(--oblyon-radius) var(--oblyon-radius) 0 0;
	}
	.ui-dialog:not(.highlight):not(.select2-dropdown) .ui-dialog-content {
		flex: 1 1 auto;
		width: auto !important;
		height: auto !important;
		min-height: 0 !important;
		max-height: none !important;
		overflow: auto;
		-webkit-overflow-scrolling: touch;
	}
	.ui-dialog:not(.highlight):not(.select2-dropdown) .ui-dialog-content iframe {
		width: 100% !important;
		height: 100% !important;
	}
	.ui-dialog:not(.highlight):not(.select2-dropdown) .ui-dialog-buttonpane {
		flex: 0 0 auto;
		margin: 0;
		padding: 8px;
	}
	.ui-dialog:not(.highlight):not(.select2-dropdown) .ui-dialog-buttonpane .ui-dialog-buttonset {
		float: none;
		display: flex;
		flex-direction: column;
		gap: 8px;
	}
	.ui-dialog:not(.highlight):not(.select2-dropdown) .ui-dialog-buttonpane button {
		width: 100%;
		min-height: var(--oblyon-touch-target);
		margin: 0 !important;
	}
	.ui-widget-overlay {
		z-index: 135 !important;
	}
	#ui-datepicker-div {
		<?php print $left; ?>: 8px !important;
		<?php print $right; ?>: 8px !important;
		width: auto !important;
		max-width: calc(100vw - 16px);
	}
	.select2-container--open .select2-dropdown {
		max-width: calc(100vw - 16px);
	}
	.select2-results__option {
		min-height: 40px;
		box-sizing: border-box;
		padding-top: 10px;
		padding-bottom: 10px;
	}

	/* ---------- Notifications (jNotify) : full width under the bar ---------- */
	.jnotify-container {
		<?php print $left; ?>: 8px !important;
		<?php print $right; ?>: 8px !important;
		<?php if (getDolGlobalString('MAIN_JQUERY_JNOTIFY_BOTTOM')) { ?>
		bottom: 8px !important;
		<?php } else { ?>
		top: calc(var(--oblyon-mobile-bar-h) + 8px) !important;
		<?php } ?>
		width: auto !important;
		min-width: 0 !important;
		max-width: none !important;
		margin: 0 !important;
		padding: 0 !important;
		z-index: 145 !important;
	}

	/* ---------- Dashboard : tiles and widgets in one column ---------- */
	.box-flex-container {
		width: 100%;
		margin: 0;
	}
	.box-flex-item {
		flex: 1 1 100%;
		width: auto !important;
		min-width: 0 !important;
		max-width: 100% !important;
		margin-left: 0;
		margin-right: 0;
	}
	/* Tile = flex row : the icon column stretches to the height of the content (fixed 94px icon and 84px content margin of info-box.inc.php dropped) */
	.info-box {
		display: flex;
		align-items: stretch;
		min-height: 80px;
	}
	.info-box .info-box-icon {
		display: flex;
		align-items: center;
		justify-content: center;
		flex: 0 0 72px;
		float: none;
		width: 72px;
		height: auto;
		min-height: 80px;
		line-height: 1;
	}
	.info-box .info-box-content,
	.info-box-sm .info-box-content {
		flex: 1 1 auto;
		min-width: 0;
		height: auto;
		margin-left: 0 !important;
	}
	div.twocolumns > div.firstcolumn,
	div.twocolumns > div.secondcolumn {
		float: none !important;
		width: 100% !important;
	}
	div.box {
		overflow-x: auto;
		-webkit-overflow-scrolling: touch;
	}
	div.box table.boxtable {
		min-width: 0;
	}
	div.boxstats,
	div.boxstats130 {
		width: calc(50% - 12px);
		margin-left: 4px;
		margin-right: 4px;
		box-sizing: border-box;
	}

	/* ---------- Light visual polish : same gutters everywhere, aligned badges, touch feedback ---------- */
	div.fiche > div.tabBar,
	div.fiche > form > div.tabBar {
		margin-bottom: 12px;
	}
	div.fichecenter,
	div.fichecenterbis {
		margin-top: 0;
	}
	div.fichehalfleft > div.tabBar,
	div.fichehalfright > div.tabBar,
	div.fichehalfleft > table.table-fiche-title,
	div.fichehalfright > table.table-fiche-title {
		margin-top: 14px;
	}
	div.fiche > div.tabsAction + div.fichecenter {
		margin-top: 4px;
	}
	/* Badges and pills : one height, centered on the text of their line */
	.badge,
	span.badge-status {
		vertical-align: middle;
		line-height: 1.2;
	}
	table.liste td .badge,
	table.noborder td .badge {
		white-space: nowrap;
	}
	/* Titles of the card blocks (documents, linked objects, events) : a little air above, none inside */
	div.fiche .titre,
	div.fiche div.titre.inline-block {
		line-height: 1.2;
	}
	/* Touch feedback : a visible press on rows, buttons and drawer entries (no hover on a phone) */
	table.liste tr.oddeven:active > td,
	table.noborder tr.oddeven:active > td {
		background-color: var(--oblyon-neutral-bg);
	}
	.butAction:active,
	.butActionDelete:active,
	.button:active,
	input.button:active {
		filter: brightness(.9);
		transform: translateY(1px);
	}
	nav.main-nav .main-nav__item > div > a.main-nav__link:active,
	nav.main-nav .main-nav__list .oblyon-flyout a.oblyon-flyout__link:active,
	.oblyon-mnav-toggle:active,
	.oblyon-mfilter-btn:active,
	div.tabs a.tab:active {
		background-color: var(--bgnavtop_hover);
		transition: none;
	}
	.oblyon-mfilter-btn:active,
	div.tabs a.tab:active {
		background-color: var(--oblyon-neutral-bg);
	}
	/* Dashboard tiles a little tighter */
	.box-flex-item-with-margin {
		margin: 0 0 8px 0;
	}
	.info-box .info-box-title {
		font-size: .82em;
		letter-spacing: .04em;
	}
	.info-box .info-box-content {
		padding: 8px 10px;
	}

	/* ---------- Login page : one card on the whole width, logo above the fields, 44px controls ---------- */
	.login_center {
		display: block;
		padding: 16px 0 0 0 !important;
	}
	.login_vertical_align {
		padding: 0 var(--oblyon-mobile-gutter) 40px var(--oblyon-mobile-gutter);
	}
	.login_table_title,
	.login_table,
	.login_main_message,
	.login_main_home {
		width: auto !important;
		max-width: none !important;
		margin-left: 0 !important;
		margin-right: 0 !important;
	}
	.login_table {
		padding: 12px 8px;
	}
	div#login_left,
	div#login_right {
		display: block;
		box-sizing: border-box;
		width: auto !important;
		min-width: 0 !important;
		max-width: none !important;
		padding: 6px 4px;
	}
	.login_table .tagtable {
		display: block;
		width: 100%;
	}
	div#login_left img#img_logo {
		max-height: 90px;
		max-width: 70%;
	}
	.login_table .trinputlogin {
		display: block;
		margin: 8px 0;
	}
	.login_table .tdinputlogin {
		display: flex;
		align-items: center;
		gap: 8px;
		box-sizing: border-box;
		width: 100%;
		min-width: 0;
	}
	.login_table input#username,
	.login_table input#password,
	.login_table input#securitycode {
		flex: 1 1 auto;
		box-sizing: border-box;
		width: auto !important;
		min-width: 0;
		max-width: none !important;
		min-height: var(--oblyon-touch-target);
		margin: 0;
		font-size: 16px;
	}
	.login_table input.butActionLogin,
	.login_table input[type=submit] {
		display: block;
		box-sizing: border-box;
		width: 100%;
		min-height: var(--oblyon-touch-target);
		margin: 8px 0 0 0 !important;
	}
	div#login_right select#entity,
	.login_table select {
		width: 100%;
		box-sizing: border-box;
	}
}

/* ---------- Tablet and phone : one column for the two halves of a card, action buttons wrap ---------- */
@media only screen and (max-width: <?php echo $oblyon_bp_tablet; ?>px) {
	div.fichehalfleft,
	div.fichehalfright,
	div.fichethirdleft,
	div.fichetwothirdright {
		float: none !important;
		width: 100% !important;
	}
	div.fichehalfright,
	div.fichetwothirdright {
		margin-top: 10px;
	}
	div.tabsAction {
		display: flex;
		flex-wrap: wrap;
		justify-content: flex-end;
		gap: 8px;
	}
	div.tabsAction > a,
	div.tabsAction > span,
	div.tabsAction > div.divButAction,
	div.tabsAction > div.dropdown-holder {
		margin: 0 !important;
	}
	div.tabsAction > div.divButAction > a,
	div.tabsAction > div.divButAction > span,
	div.tabsAction > div.dropdown-holder > a.dropdown-toggle,
	div.tabsAction > a.butAction,
	div.tabsAction > a.butActionDelete,
	div.tabsAction > a.butActionRefused {
		margin: 0 !important;
	}
}
<?php } ?>
