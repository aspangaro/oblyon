<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/layout.inc.php
   Role      : Structure de page, barre du haut, menu lateral, main-nav, bloc de connexion
   Inclus par : global.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/* ============================================================================== */
/* Styles for dragging lines													  */
/* ============================================================================== */

.dragClass {
	color: #002255;
}
td.showDragHandle {
	cursor: move;
}
.tdlineupdown {
	white-space: nowrap;
	min-width: 10px;
}

/*------------------------------------*\
#Positioning Areas
\*------------------------------------*/

#id-container:before,
#id-container:after {
	content: ' ';
	display: table;
}

#id-container:after {
	clear: both;
}

#id-container {
	table-layout: fixed;
}
div.login_block_other {
	display: inline-block;
	vertical-align: middle;
	clear: <?php print $disableimages ? 'none' : 'both'; ?>;
	padding-top: 0;
	text-align: right;
	margin-right: 8px;
	max-width: 200px;
}

#id-right,
#id-left {
	display: table-cell;
	<?php if (getDolGlobalString('OBLYON_HIDE_LEFTMENU') || !empty($conf->dol_optimize_smallscreen)) { ?>
		float: left;
	<?php } else { ?>
		float: none;
	<?php } ?>
	vertical-align: top;
}

.side-nav {
	vertical-align: top;
<?php if (getDolGlobalString('OBLYON_STICKY_LEFTBAR')) { ?>
	position: fixed;
	z-index: 90;
	overflow-y: auto !important;
	overflow-x: hidden;
<?php } else { ?>
	display: table-cell;
	<?php if (getDolGlobalString('OBLYON_HIDE_LEFTMENU') || !empty($conf->dol_optimize_smallscreen)) { ?>
		float: left;
	<?php } else { ?>
		float: none;
	<?php } ?>
<?php } ?>
<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
	background-color: var(--bgnavtop);
<?php } else { ?>
	background-color: var(--bgnavleft);
<?php } ?>
}

#id-right {
<?php if (GETPOST("optioncss", "aZ09") == 'print') { ?>
	padding-top: 10px;
	<?php } elseif(getDolGlobalString('THEME_STICKY_TOPMENU')) { ?>
		<?php if (getDolGlobalString('OBLYON_PADDING_RIGHT_BOTTOM')) { ?>
			padding-bottom: 40px;
		<?php } ?>
		<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
			padding-top: 52px;
		<?php } else { ?>
			padding-top: 64px;
		<?php } ?>
	<?php } else { ?>
		padding-top: 10px;
	<?php } ?>
	width: 100%;
	<?php if (getDolGlobalString('OBLYON_STICKY_LEFTBAR')) { ?>
		<?php if (getDolGlobalString('OBLYON_REDUCE_LEFTMENU')) { ?>
			padding-left: 40px;
		<?php } else { ?>
			padding-left: 230px;
		<?php } ?>
		width: 100vw;
	<?php } ?>
}

#id-left {
	<?php if (!getDolGlobalString('OBLYON_HIDE_LEFTMENU') && empty($conf->dol_optimize_smallscreen)) { ?>
		<?php if (getDolGlobalString('THEME_STICKY_TOPMENU')) { ?>
			<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
				padding-top: 40px;
			<?php } else { ?>
				padding-top: 54px;
			<?php } ?>
		<?php } ?>
	<?php } ?>
	<?php if (!getDolGlobalString('OBLYON_FULLSIZE_TOPBAR')) { ?>
		<?php if(!getDolGlobalString('OBLYON_STICKY_LEFTBAR')) { ?>
			position: relative;
		<?php } else { ?>
			position: fixed;
		<?php } ?>
	<?php } ?>
	<?php if (!getDolGlobalString('OBLYON_HIDE_LEFTMENU') && empty($conf->dol_optimize_smallscreen) && (!getDolGlobalString('OBLYON_FULLSIZE_TOPBAR') || !getDolGlobalString('OBLYON_SHOW_COMPNAME'))) { ?>
		z-index: 92;
	<?php } else { ?>
		z-index: 90;
	<?php } ?>
}

#id-top {
	background-color: var(--bgnavtop);
	z-index: 91;
}

div.fiche {
	line-height: 1.45;	/* InfraS add : interlignage lisible dans le contenu (le reset global reste a 1 pour les barres) */
	margin-<?php print $left; ?>: <?php print (GETPOST('optioncss', 'aZ09') == 'print'?6:(empty($conf->dol_optimize_smallscreen)?'15':'6')); ?>px;
	margin-<?php print $right; ?>: <?php print (GETPOST('optioncss', 'aZ09') == 'print'?6:(empty($conf->dol_optimize_smallscreen)?'15':'6')); ?>px;
	<?php if (! empty($dol_hide_leftmenu)) print 'margin-bottom: 12px;'."\n"; ?>
	<?php if (! empty($dol_hide_leftmenu)) print 'margin-top: 12px;'."\n"; ?>
}
body.onlinepaymentbody div.fiche {	/* For online payment page */
	margin: 20px !important;
}
div.fiche>table:first-child {
	margin-bottom: 15px !important;
}
div.fiche>table.table-fiche-title {
	margin-bottom: 12px;
}
div.fichecenter {
	clear: both;	/* This is to have div fichecenter that are true rectangles */
	width: 100%;
}
div.fichecenterbis {
	margin-top: 8px;
}
div.fichethirdleft {
	<?php if ($conf->browser->layout != 'phone') {
		print "float: ".$left.";\n";
	} ?>
	<?php if ($conf->browser->layout != 'phone') {
		print "width: calc(50% - 14px);\n";
	} ?>
	<?php if ($conf->browser->layout == 'phone') {
		print "padding-bottom: 6px;\n";
	} ?>
}
div.fichetwothirdright {
<?php if ($conf->browser->layout != 'phone') {
	print "float: ".$right.";\n";
} ?>
<?php if ($conf->browser->layout != 'phone') {
	print "width: calc(50% - 14px);\n";
} ?>
<?php if ($conf->browser->layout == 'phone') {
	print "padding-bottom: 6px\n";
} ?>
}
div.fichehalfleft {
	<?php if ($conf->browser->layout != 'phone') {
		print "float: ".$left.";\n";
	} ?>
	<?php if ($conf->browser->layout != 'phone') {
		print "width: calc(50% - 14px);\n";
	} ?>
}
div.fichehalfright {
	<?php if ($conf->browser->layout != 'phone') {
		print "float: ".$right.";\n";
	} ?>
	<?php if ($conf->browser->layout != 'phone') {
		print "width: calc(50% - 14px);\n";
	} ?>
}
div.fichehalfright {
	<?php if ($conf->browser->layout == 'phone') {
		print "margin-top: 10px;\n";
	} ?>
}

/*div.firstcolumn div.box {
	padding-right: 10px;
}
div.secondcolumn div.box {
	padding-left: 10px;
}*/

/* Force values for small screen */
@media only screen and (max-width: 1000px)
{
	div.fiche {
		margin-<?php print $left; ?>: <?php print (GETPOST('optioncss', 'aZ09') == 'print' ? 6 : ($dol_hide_leftmenu ? '6' : '20')); ?>px;
		margin-<?php print $right; ?>: <?php print (GETPOST('optioncss', 'aZ09') == 'print' ? 8 : 6); ?>px;
	}
	div.fichecenter {
		width: 100%;
		clear: both;	/* This is to have div fichecenter that are true rectangles */
	}
	div.fichecenterbis {
		margin-top: 8px;
	}
	div.fichethirdleft {
		float: none;
		width: auto;
		padding-bottom: 6px;
	}
	div.fichetwothirdright {
		float: none;
		width: auto;
		padding-bottom: 6px;
	}
	div.fichetwothirdright div.ficheaddleft {
		padding-left: 0;
	}
	div.fichehalfleft {
		float: none;
		width: auto;
	}
	div.fichehalfright {
		float: none;
		width: auto;
	}
	div.fichehalfright {
		margin-top: 10px;
	}
	div.firstcolumn div.box {
		padding-right: 0px;
	}
	div.secondcolumn div.box {
		padding-left: 0px;
	}
}

/* Force values on one colum for small screen */
@media only screen and (max-width: 1599px)
{
	div.fichehalfleft-lg {
		float: none;
		width: auto;
	}
	div.fichehalfright-lg {
		float: none;
		width: auto;
	}

	.fichehalfright-lg .fichehalfright {
		padding-left:0;
	}
}

/* For table into table into card */
div.fichehalfright tr.liste_titre:first-child td table.nobordernopadding td {
	padding: 0 0 0 0;
}
div.nopadding {
	padding: 0 !important;
}

.containercenter {
	display : table;
	margin : 0px auto;
}

#pictotitle, .pictotitle {
	margin-<?php print $right; ?>: 8px;
	margin-bottom: 4px;
}
.pictoobjectwidth {
	width: 14px;
}
.pictosubstatus {
	padding-left: 2px;
	padding-right: 2px;
}
.pictostatus {
	width: 15px;
	vertical-align: middle;
	margin-top: -3px
}
.pictowarning, .pictopreview {
	padding-<?php print $left; ?>: 3px;
}
.pictowarning {
	vertical-align: text-bottom;
}
.pictomodule {
	width: 14px;
}
.fiche .arearef img.pictoedit, .fiche .arearef span.pictoedit,
.fiche .fichecenter img.pictoedit, .fiche .fichecenter span.pictoedit,
.tagtdnote span.pictoedit {
	opacity: 0.4;
}
.pictofixedwidth {
	text-align: var(--left);
	width: 20px;
	padding-right: 0;
}
.colorthumb {
	padding-left: 1px !important;
	padding-right: 1px;
	padding-top: 1px;
	padding-bottom: 1px;
	width: 44px;
	text-align:center;
}
div.attacharea {
	padding-top: 18px;
	padding-bottom: 10px;
}
div.attachareaformuserfileecm {
	padding-top: 0;
	padding-bottom: 0;
}
div.arearef {
<?php if (getDolGlobalString('FIX_AREAREF_CARD')) { ?>
	position: sticky;
	z-index: 4;
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		<?php if (getDolGlobalString('FIX_STICKY_TABS_CARD') && getDolGlobalString('THEME_STICKY_TOPMENU')) { ?>
		top: 84px;
		<?php } elseif (getDolGlobalString('FIX_STICKY_TABS_CARD') || getDolGlobalString('THEME_STICKY_TOPMENU')) { ?>
		top: 42px;
		<?php } else { ?>
		top: 0px;
		<?php } ?>
	<?php } else { ?>
		<?php if (getDolGlobalString('FIX_STICKY_TABS_CARD') && getDolGlobalString('THEME_STICKY_TOPMENU')) { ?>
			top: 84px;
		<?php } elseif (getDolGlobalString('FIX_STICKY_TABS_CARD') || getDolGlobalString('THEME_STICKY_TOPMENU')) { ?>
			top: 42px;
		<?php } else { ?>
			top: 0px;
		<?php } ?>
	<?php } ?>
	background: inherit;
	padding-bottom: 20px;
	border-bottom: 1px solid var(--oblyon-border);	/* InfraS change */
	display: flow-root;	/* le bandeau collant englobe ses blocs flottants (statuts), qui ne debordent plus sur le contenu de la fiche */
<?php } else { ?>
	padding-bottom: 10px;
<?php } ?>
	padding-top: 2px;
	margin-bottom: 10px;
}
div.arearefnobottom {
	padding-top: 2px;
	padding-bottom: 4px;
}
div.heightref {
	min-height: 80px;
}
div.divphotoref {
	padding-<?php print $right; ?>: 20px;
}
div.paginationref {
	padding-bottom: 10px;
}
/* TODO
div.statusref {
   	padding: 10px;
   	border: 1px solid #bbb;
   	border-radius: 6px;
} */
div.statusref {
	float: right;
	text-align: right;	/* un statut plus court qu'une ligne ajoutee dessous par un module reste cale a droite */
	padding-left: 12px;
	margin-top: 8px;
	margin-bottom: 10px;
	clear: both;
}
div.statusref img {
   	vertical-align: text-bottom;
   	width: 18px;
}
div.statusrefbis {
	padding-left: 8px;
   	padding-right: 9px;
   	vertical-align: text-bottom;
}
<?php if (getDolGlobalString('FIX_AREAREF_CARD')) { ?>
/* bandeau collant, statut secondaire (ex. transfert en comptabilite) colle au statut principal pour ne pas agrandir le bandeau */
div.arearef div.statusrefbis {
	margin-top: 0;
	margin-bottom: 0;
}
<?php } ?>
img.photoref, div.photoref {
	border: 1px solid var(--oblyon-border);	/* InfraS change */
	box-shadow: var(--oblyon-shadow-sm);	/* InfraS change */
	border-radius: var(--oblyon-radius-sm);	/* InfraS add */
	padding: 4px;
	height: 80px;
	width: 80px;
	object-fit: contain;
}
img.fitcontain {
	object-fit: contain;
}
div.photoref {
	display:table-cell;
	vertical-align:middle;
	text-align:center;
}
img.photorefnoborder {
	padding: 2px;
	height: 48px;
	width: 48px;
	object-fit: contain;
	border: 1px solid #AAA;
	border-radius: 100px;
}
.underbanner {
	border-bottom: var(--borderwidth) solid var(--colortopbordertitle1);
	/* border-bottom: 2px solid var(--colorbackhmenu1); */
}
.trextrafieldseparator td {
	/* border-bottom: 2px solid var(--colorbackhmenu1) !important; */
	border-bottom: 2px dashed var(--colortopbordertitle1) !important;
}

.tdhrthin {
	margin: 0;
	padding-bottom: 0 !important;
}

/*------------------------------------*\
#Top Menu
\*------------------------------------*/

#tmenu_tooltipinvert .db-menu__society,
#tmenu_tooltip .db-menu__society { /* for v3.5 */
	display: inline-block;
	float: var(--left);
	/*margin: 0 10px;*/
	padding: 0 5px 0 5px;
	max-width: 210px;
	text-align: var(--left);

	-webkit-touch-callout: none; /* iOS Safari */
	-webkit-user-select: none; /* Safari */
	-khtml-user-select: none; /* Konqueror HTML */
	-moz-user-select: none; /* Firefox */
	-ms-user-select: none; /* Internet Explorer/Edge */
	user-select: none; /* Non-prefixed version, currently
								  supported by Chrome and Opera */
}

#tmenu_tooltipinvert .db-menu__society a,
#tmenu_tooltip .db-menu__society a { /* for v3.5 */
	color: #fff;
	display: inline;
	font-weight: 500;
	height: 40px;
	line-height: 40px;
	padding: 0 5px;
	text-decoration: none;
	overflow: hidden;
	text-overflow: ellipsis;
	transition: all .4s ease-in-out;
	-moz-transition: all .4s ease-in-out;
	-webkit-transition: all .4s ease-in-out;
}

#tmenu_tooltipinvert .db-menu__society a:hover,
#tmenu_tooltip .db-menu__society a:hover { /* for v3.5 */
	color: var(--bgnavtop_txt_hover);	/* InfraS change : texte de survol = jeton du menu (OBLYON_COLOR_*MENU_TXT_HOVER), plus la couleur principale : le libelle disparaissait quand elle est proche du fond de survol */
}

/*
* Main Navigation
*/

#tmenu_tooltip {
	<?php if (GETPOST("optioncss", "aZ09") == 'print') { ?>
		display: none;
	<?php } else { ?>
		display: block;
		overflow: auto;
		width: 100%;
		background-color: var(--bgnavtop);
		<?php if (!empty($usecss3)) { ?>
			<?php if (getDolGlobalString('THEME_STICKY_TOPMENU')) { ?>
				box-shadow: 0 1px 2px rgba(0, 0, 0, .4) !important;
				-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .4) !important;
				-webkit-animation: fade 500ms;
			<?php } ?>
			transition: max-height .2s ease-in-out;
			-moz-transition: max-height .2s ease-in-out;
			-webkit-transition: max-height .2s ease-in-out;
		<?php } ?>
		<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
			max-height: 40px;
		<?php } else { ?>
			max-height: 54px;
		<?php } ?>
		margin: 0;
		padding-<?php print $right; ?>: <?php echo ((float) $maxwidthloginblock + 15); ?>px;
		z-index: 95;
		<?php if (getDolGlobalString('THEME_STICKY_TOPMENU')) { ?>
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
		<?php } else { ?>
			position: relative;
		<?php } ?>
	<?php } ?>
}

#tmenu_tooltip:hover {
	max-height: 540px;
}

.main-nav {
	<?php if (GETPOST("optioncss", "aZ09") == 'print') { ?>
		display: none;
	<?php } else { ?>
		/*background-color: rgb(<?php print (!empty($colorback1) ? $colorback1 : 0); ?>);*/
		color: #fcfcfc;
		font-size: 13px;
		margin: 0;
		padding: 0;
		position: relative;
		text-decoration: none;
		white-space: nowrap;
	<?php } ?>
}

.main-nav__list {
	list-style: none;
	margin-bottom: 20px;
	padding: 0;
}

.main-nav__item {
	<?php if (!getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		float: var(--left);
		height: var(--heightmenu);
	<?php } ?>
	display: block;
	margin: 0;
	padding: 0;
	position: relative;
}

.main-nav__item {
	background-color: var(--bgnavtop);
}

.main-nav__item:hover {
	background-color: var(--bgnavtop_hover);
	color: var(--bgnavtop_txt);
}

.main-nav__item.is-sel > div > a {	/* InfraS change : lien principal seulement, pas les liens des volets */
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		background-color: var(--bgnavleft_hover);
		color: var(--bgnavleft_txt_active);
	<?php } else { ?>
	background-color: var(--bgnavtop_hover);
		color: var(--bgnavtop_txt_active);
		/*
		border-style: solid;
		border-width: 6px 10px 6px 0px;
		border-color: transparent var(--bgcolor) transparent transparent;
		*/
	<?php } ?>
}

#tmenu_tooltip .main-nav__list {
	margin: 0;
	padding: 0;
	text-align: center;
	z-index: 30;
}

#tmenu_tooltip .main-nav__item {
	display: block;
	float: var(--left);
	position: relative;
	<?php if (getDolGlobalString('OBLYON_HIDE_TOPICONS')) { ?>
		height: 54px;
		line-height: 54px;
	<?php } else { ?>
		height: 54px;
	<?php } ?>
}

.main-nav__item.tmenusel {
	background-color: var(--bgnavtop_sel);	/* InfraS change : jeton OBLYON_COLOR_TOPMENU_BCKGRD_SEL */
}

.main-nav__item.tmenusel .main-nav__link {
	font-weight: bold !important;
}

.main-nav__item.tmenusel:hover {
	color: var(--bgnavtop_txt_sel);	/* InfraS change : jeton OBLYON_COLOR_TOPMENU_TXT_SEL */
}

.main-nav__item.tmenusel .main-nav__link:hover {
	color: var(--bgnavtop_txt_sel);	/* InfraS change */
	font-weight: bold;
}

/*
.main-nav__item:hover a,
.main-nav__list:visited li a {
color: #eee;
display: block;
font-weight: normal;
height: 54px;
padding: 0 6px;
text-decoration: none;
transition: all .2s ease-in-out;
-moz-transition: all .2s ease-in-out;
-webkit-transition: all .2s ease-in-out;
}*/

#tmenu_tooltip .tmenu li:hover .main-nav__link,
.main-nav__item:hover .main-nav__link,
.main-nav__item .main-nav__link:focus {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		color: var(--bgnavleft_txt);
	<?php } else { ?>
		color: var(--bgnavtop_txt);
	<?php } ?>
}

.main-nav__link {
	color: var(--bgnavtop_txt) !important;
	display: block;
	font-family: var(--fontfamilydol);
	transition: all .2s ease-in-out;
	-moz-transition: all .2s ease-in-out;
	-webkit-transition: all .2s ease-in-out;
}

#tmenu_tooltip .main-nav__link {
	height: 54px;
	<?php if (getDolGlobalString('OBLYON_HIDE_TOPICONS')) { ?>
		font-weight: 500;
		line-height: 54px;
		padding: 0 8px;
	<?php } else { ?>
		padding: 0 6px;
	<?php } ?>
}

.main-nav__link.is-disabled {
	cursor: not-allowed;
	opacity: .6;
}
.main-nav__link.is-disabled:hover {
	color: #888;
}

.db-nav .main-nav__link {
	text-decoration: none;
}

/**
* Secondary Navigation
*/

#tmenu_tooltipinvert .pushy-btn,
#tmenu_tooltip .pushy-btn { /* for v3.5 */
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		font-size: 18px !important;
		height: 40px;
		line-height: 40px;
	<?php } else { ?>
		font-size: 18px !important;
		height: 54px;
		line-height: 54px;
	<?php } ?>
}

#tmenu_tooltipinvert {
<?php if (GETPOST("optioncss", "aZ09") == 'print') { ?>
	display: none;
<?php } else { ?>
	display: inline-table;
	overflow: auto;
	width: 100%;
	background-color: var(--bgnavleft);
	<?php if (!empty($usecss3)) { ?>
		<?php if (getDolGlobalString('THEME_STICKY_TOPMENU')) { ?>
			/*
			box-shadow: 0 1px 2px rgba(0, 0, 0, .4) !important;
			-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .4) !important;
			*/
			-webkit-animation: fade 500ms;
		<?php } ?>
		transition: max-height .2s ease-in-out;
		-moz-transition: max-height .2s ease-in-out;
		-webkit-transition: max-height .2s ease-in-out;
	<?php } ?>
	max-height: 40px;
	<?php print $left; ?>: 0;
	margin: 0;
	padding-<?php print $right; ?>: <?php echo ((float) $maxwidthloginblock + 15); ?>px;
	z-index: 95;
	<?php if (getDolGlobalString('THEME_STICKY_TOPMENU')) { ?>
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
	<?php } else { ?>
		position: relative;
	<?php } ?>
<?php } ?>
}

#tmenu_tooltipinvert:hover {
	max-height: 400px;
}

.sec-nav.is-inverted {
	display: inline-block;
	<?php if(!getDolGlobalString('OBLYON_FULLSIZE_TOPBAR') && !getDolGlobalString('OBLYON_SHOW_COMPNAME') && !getDolGlobalString('OBLYON_HIDE_LEFTMENU') && empty($conf->dol_optimize_smallscreen)) { ?>
		margin-<?php print $left; ?>: 10px;
	<?php } else { ?>
		margin-<?php print $left; ?>: 10px;
	<?php } ?>
	list-style: none;
}

.sec-nav.is-inverted .sec-nav__item.item-heading,
.sec-nav.is-inverted .sec-nav__item.is-disabled {
	background-color: var(--bgnavleft);
	float: var(--left);
	position: relative;
	padding: 0;
	z-index: 40;
}

.sec-nav.is-inverted .sec-nav__item.item-heading:hover {
	background-color: var(--bgnavleft_hover);
}

.sec-nav.is-inverted .sec-nav__link {
	font-size: 13px;
	white-space: nowrap;
}

.sec-nav.is-inverted .sec-nav__item.item-heading > .sec-nav__link,
.sec-nav.is-inverted .sec-nav__item.is-disabled > .sec-nav__link {
	display: block;
	line-height: 40px;
	<?php if (getDolGlobalString('OBLYON_HIDE_TOPICONS')) { ?>
		font-weight: 500;
	<?php } else { ?>
		font-weight: normal;
	<?php } ?>
	padding: 0 8px;
}

.sec-nav.is-inverted .sec-nav__item.is-disabled > .sec-nav__link {
	cursor: not-allowed;
}

li.item-heading:hover > .sec-nav__link {
	background-color: var(--bgnavleft_hover);
	color: var(--bgnavleft_txt_hover);
}

li.sec-nav__sub-item {
	color: var(--bgnavleft_txt);
	list-style: none;
}
li.sec-nav__sub-item:hover, li.sec-nav__sub-item sec-nav__link:hover {
	background-color: var(--bgnavleft_hover);
	color: var(--bgnavleft_txt_hover);
}
li.sec-nav__sub-item:focus, li.sec-nav__sub-item sec-nav__link:focus {
	background-color: var(--bgnavleft_hover);
	color: var(--bgnavleft_txt_active);
}

.caret {
	content: '';
	color: inherit;
	display: inline-block;
	height: 0;
	vertical-align: baseline;
	width: 0;
	padding-bottom: 2px;
}

.caret--top {
	border-top: 4px solid #eee;
	border-right: 4px solid transparent;
	border-left: 4px solid transparent;
}

.caret--left {
	border-top: 4px solid transparent;
	border-bottom: 4px solid transparent;
	border-left: 4px solid #eee;
	margin-right: .1em;
}

.caret--right {
	border-top: 4px solid transparent;
	border-bottom: 4px solid transparent;
	border-right: 4px solid #eee;
	margin-left: .1em;
}

.sec-nav.is-inverted li.item-heading:hover .caret--top {
	border-top-color: var(--bgnavleft_txt_hover);
}

.sec-nav__sub-list .item-level2:hover .caret--left {
	border-left-color: var(--bgnavleft_txt_hover);
}

.sec-nav__sub-list .item-level2:hover .caret--right {
	border-right-color: var(--bgnavleft_txt_hover);
}

.sec-nav__sub-list .item-level3:hover .caret--left {
	border-left-color: var(--bgnavleft_txt_hover);
}

.sec-nav__sub-list .item-level3:hover .caret--right {
	border-right-color: var(--bgnavleft_txt_hover);
}

/**
* Submenus
*/

.sec-nav.is-inverted .sec-nav__sub-list {
	background-color: var(--bgnavleft_hover);
	box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.055);
	display: none;
	list-style: none;
	opacity: 0;
	padding-top: 0;
	padding-bottom: 5px;
	padding-inline-start: 0;
	-webkit-transiton: opacity 0.2s;
	-moz-transition: opacity 0.2s;
	-ms-transition: opacity 0.2s;
	-o-transition: opacity 0.2s;
	-transition: opacity 0.2s;
}

.sec-nav.is-inverted .sec-nav__item:hover .sec-nav__sub-list {
	display: block;
	position: absolute;
	opacity: 1;
	visibility: visible;
}

.sec-nav.is-inverted .sec-nav__sub-item {
	float: none;
	padding: 0;
}
.sec-nav.is-inverted .sec-nav__sub-item:hover, .sec-nav.is-inverted .sec-nav__link:hover {
	background-color: var(--bgnavleft);
}

.sec-nav.is-inverted .sec-nav__sub-list .item-level1 .sec-nav__link {
	display: block;
	padding: 0.6em 1em;

}

.sec-nav.is-inverted .sec-nav__sub-list .item-level2 .sec-nav__link {
	display: block;
	padding: 0.5em 1.2em;
}

.sec-nav.is-inverted .sec-nav__sub-list .item-level3 .sec-nav__link {
	display: block;
	padding: 0.4em 1.4em;
}

.sec-nav.is-inverted .sec-nav__link.is-disabled {
	display: block;
	padding: 0.6em 1em;
}

/**
* Login Block
*/
div.login_block {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		background-color: var(--bgnavleft);
		height: 40px;
	<?php } else { ?>
		background-color: var(--bgnavtop);
		height: 54px;
	<?php } ?>
	/* padding-right: 10px; */
	<?php if (getDolGlobalString('THEME_STICKY_TOPMENU')) { ?>
		position: fixed !important;
	<?php } else { ?>
		position: absolute !important;
	<?php } ?>
	top: 0;
	<?php print $right; ?>: 0px;
	z-index: 100;
	<?php if (GETPOST("optioncss", "aZ09") == 'print') { ?>
		display: none;
	<?php } ?>
}

div.login_block a {
	color: var(--bgnavtop_txt);
	display: inline-block;
}
div.login_block span.aversion {
	<?php if(getDolGlobalString('OBLYON_DISABLE_VERSION')) { ?>
		display: none !important;
	<?php } else { ?>
		<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
			color: var(--bgnavleft_txt);
		<?php } else { ?>
			color: var(--bgnavtop_txt);
		<?php } ?>
		filter: contrast(0.7);
	<?php } ?>
}
div.login {
	white-space:nowrap;
	font-weight: bold;
	float: right;
}
div.login a {
	color: var(--bgnavtop_txt);
}

div.login_block:after {
	/*content: '\f013';*/
	color: var(--bgnavtop_txt);
	font-family: var(--fontawesomeFamily) !important;
	font-size: 20px;
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		line-height: 40px;
	<?php } else { ?>
		line-height: 54px;
	<?php } ?>
}

div.login_block:hover:after {
	color: var(--bgnavtop_txt_hover);	/* InfraS change : texte de survol = jeton du menu (OBLYON_COLOR_*MENU_TXT_HOVER), plus la couleur principale : le libelle disparaissait quand elle est proche du fond de survol */
}
div.login_block_tools {
	margin-<?php print $right ?>: 8px;
	display: inline-block;
	vertical-align: middle;
	line-height: <?php print $disableimages ? '25' : '40'; ?>px;
	height: <?php print $disableimages ? '25' : '40'; ?>px;
}
div.login_block_other {
	display: inline-block;
	vertical-align: middle;
	clear: <?php print $disableimages ? 'none' : 'both'; ?>;
	padding-top: 0;
	text-align: var(--right);
	max-width: 200px;
}
div.login_block_user {
	display: inline-block;
	vertical-align: middle;
	/*clear: left;*/
	/*float: var(--left);*/
	margin-right: 0px;
}

div.login_block_user .login a,
div.login_block_user a {
	display: table-cell;
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		font-size: 13px;
	<?php } ?>
	font-family: var(--fontmainmenu);
	font-weight: 500;
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		height: 40px;
	<?php } else { ?>
		height: 54px;
	<?php } ?>
	max-width: 300px;
	overflow: hidden;
	padding: 0 3px;
	text-overflow: ellipsis;
	transition: all .2s ease-in-out;
	-moz-transition: all .2s ease-in-out;
	-webkit-transition: all .2s ease-in-out;
	vertical-align: middle;
}

div.login_block_user > .classfortooltip.login_block_elem2 {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		height: 40px;
	<?php } else { ?>
		height: 54px;
	<?php } ?>
}

div.login_block_other {
	display: inline-block;
	clear: <?php print $disableimages ? 'none' : 'both'; ?>;
}

.login_block_other {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		background: var(--bgnavleft);
	<?php } else { ?>
		background: var(--bgnavtop);
	<?php } ?>
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		display: none;
	<?php } ?>
	/* position: absolute; */
	right: 0;
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		top: 40px;
		height: 40px;
		line-height: 36px;
	<?php } else { ?>
		top: 54px;
		height: 54px;
		line-height: 50px;
	<?php } ?>
	padding-top: 0;
	text-align: right;
	margin-right: 3px;
}

.login_block_elem {
	float: var(--left);
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		background-color: var(--bgnavleft);
		height: 40px;
	<?php } else { ?>
		background-color: var(--bgnavtop);
		height: 54px;
	<?php } ?>
	padding: 0;
}

.login_block_elem a,
.login_block td.classfortooltip a {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		color: var(--bgnavleft_txt);
		font-size: 16px;
		height: 40px;
		line-height: 36px;
	<?php } else { ?>
		color: var(--bgnavtop_txt);
		font-size: 18px;
		height: 54px;
		line-height: 50px;
	<?php } ?>
	display: block;
	font-family: var(--fontfamilydol);
	padding: 0 3px;
	text-decoration: none;
	transition: all .2s ease-in-out;
	-moz-transition: all .2s ease-in-out;
	-webkit-transition: all .2s ease-in-out;
}

.login_block_elem a:hover,
.login_block td.classfortooltip a:hover {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		color: var(--bgnavleft_txt_hover);
	<?php } else { ?>
		color: var(--bgnavtop_txt_hover);
	<?php } ?>
}

.atoplogin, .atoplogin:hover {
<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
	color: var(--bgnavleft_txt) !important;
<?php } else { ?>
	color: var(--bgnavtop_txt) !important;
<?php } ?>
}
.alogin, .alogin:hover {
	font-weight: normal !important;
	padding-top: 2px;
}
.alogin:hover, .atoplogin:hover {
	text-decoration:underline !important;
}
span.fa.atoplogin, span.fa.atoplogin:hover {
	font-size: 16px;
	text-decoration: none !important;
}
.atoplogin #dropdown-icon-down, .atoplogin #dropdown-icon-up {
	font-size: 0.7em;
}

img.login, img.printer, img.help, img.entity {
	/* padding: 0px 0px 0px 4px; */
	/* margin: 0px 0px 0px 8px; */
	text-decoration: none;
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		color: var(--bgnavleft_txt);
	<?php } else { ?>
		color: var(--bgnavtop_txt);
	<?php } ?>
	font-weight: bold;

}

.userimg.atoplogin img.userphoto, .userimgatoplogin img.userphoto {		/* size for user photo in login bar */
	width: <?php print $disableimages ? '26' : '32'; ?>px;
	height: <?php print $disableimages ? '26' : '32'; ?>px;
	border-radius: 50%;
	background-size: contain;
	border: 1px solid;
	border-color: rgba(255, 255, 255, 0.2);
}
<?php if ($oblyon_user_block != 'default') { ?>
/* avatar aux initiales (OBLYON_USER_BLOCK = initials, ou photo sans photo renseignee) : span imprime par js/oblyon.js a la place de l'image
   du bloc utilisateur ; meme taille que la photo de la barre, cercle de la couleur principale entoure d'un anneau du texte de la barre (reste visible quand
   la barre est de la couleur principale) ; le menu deroulant le redimensionne (dropdown.inc.php) */
.oblyon-avatar {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: <?php print $disableimages ? '26' : '32'; ?>px;
	height: <?php print $disableimages ? '26' : '32'; ?>px;
	box-sizing: border-box;
	border-radius: 50%;
	box-shadow: 0 0 0 1px <?php print getDolGlobalString('MAIN_MENU_INVERT') ? 'var(--bgnavleft_txt)' : 'var(--bgnavtop_txt)'; ?>;
	background-color: var(--maincolor);
	color: var(--oblyon-on-accent);
	font-size: 12px;
	font-weight: 600;
	letter-spacing: .03em;
	line-height: 1;
	text-transform: uppercase;
	vertical-align: middle;
	user-select: none;
}
<?php } ?>
img.userphoto {				/* size for user photo in lists */
	border-radius: 0.72em;
	width: 1.4em;
	height: 1.4em;
	background-size: contain;
	vertical-align: middle;
}

img.userphotosmall {		/* size for user photo in lists */
	border-radius: 0.6em;
	width: 1.2em;
	height: 1.2em;
	background-size: contain;
	vertical-align: middle;
	background-color: var(--colorbline);	/* InfraS change 3.7.0 : jeton (valeur de l'ancienne copie de login.inc.php) */
}
img.userphoto[alt="Gravatar avatar"], img.photouserphoto.dropdown-user-image[alt="Gravatar avatar"] {
	background: var(--colorbline);	/* InfraS change 3.7.0 : jeton */
}
form[name="addtime"] img.userphoto {
	border: 1px solid var(--oblyon-border-strong);	/* InfraS change 3.7.0 : jeton */
}
/* InfraS add begin 3.7.0 : regles de la barre du haut rapatriees de login.inc.php (copie perimee retiree) */
.login_block_user a img.loginphoto {
	display: none;
}
.login_block_elem a span.atoplogin, .login_block_elem span.atoplogin {
	vertical-align: middle;
}
.login_block_elem.classfortooltip {
	margin: 0;
}
.login_block_getinfo {
	text-align: center;
}
.login_block_getinfo div.login_block_user {
	display: block;
}
.login_block_getinfo .atoplogin, .login_block_getinfo .atoplogin:hover {
	color: var(--colortext) !important;	/* InfraS change */
	font-weight: normal !important;
}
.login_block_elem img.printer,
.login_block_elem img.login,
.login_block_elem img.help,
.login_block td.classfortooltip img.printer,
.login_block td.classfortooltip img.login,
.login_block td.classfortooltip img.help {
	vertical-align: baseline;
}
.login_block td.classfortooltip { height: 40px; }
/* InfraS add end */

.span-icon-user {
	background-image: url(<?php print dol_buildpath($path.'/theme/'.$theme.'/img/object_user.png',1); ?>);
	background-repeat: no-repeat;
}

.span-icon-password {
	background-image: url(<?php print dol_buildpath($path.'/theme/'.$theme.'/img/lock.png',1); ?>);
	background-repeat: no-repeat;
}

.login_block .classfortooltip:hover,
.login_block .classfortooltip:focus {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		background-color: var(--bgnavleft_hover);
	<?php } else { ?>
		background-color: var(--bgnavtop_hover);
	<?php } ?>
}

div.login_block table { display: inline; }

/* db inf v3.5 */
td div.login {
	white-space: nowrap;
	padding: 0;
	margin: 0;
	font-weight: bold;
	color: #f4f4f4;
}

div.login a,
div.login_block_user a {
	color: var(--bgnavtop_txt);	/* InfraS change 3.7.0 : jeton (etait #f4f4f4) */
	font-size: 13px;
}

div.login a:hover {
	color: var(--bgnavtop_txt_hover);	/* InfraS change : texte de survol = jeton du menu (OBLYON_COLOR_*MENU_TXT_HOVER), plus la couleur principale */
	text-decoration: inherit;
}

.alogin {
	font-weight: normal !important;
	font-size: var(--fontsizesmaller) !important;
}

.alogin:hover {
	text-decoration: underline !important;
	color: var(--bgnavtop_txt_hover) !important;	/* InfraS change : texte de survol = jeton du menu (OBLYON_COLOR_*MENU_TXT_HOVER), plus la couleur principale : le libelle disparaissait quand elle est proche du fond de survol */
}

/*------------------------------------*\
#Left Menu
\*------------------------------------*/

/**
* Company Name
*/

.db-menu__society {
	margin: 0;
	padding: 0;
}

.db-menu__society h1 {
	color: #fff;
	font-size: 1.5em;
	font-weight: bold;
	margin: 0;
	overflow: hidden;
	text-overflow: ellipsis;
}

.vmenu .db-menu__society {
	padding: 10px 0;
}

/**
* Logo Block
*/

.db-menu__logo {
	background-color: var(--logo_background_color);
	<?php if (getDolGlobalString('OBLYON_LOGO_PADDING') && getDolGlobalString('OBLYON_LOGO_PADDING') == "padding") { ?>
		padding: 10px;
		max-height: 180px;
	<?php } else { ?>
		padding: 0;
		max-height: 200px;
	<?php } ?>
}

.db-menu__logo__link {
	display: block;
	<?php if(oblyon_color_setting('OBLYON_COLOR_LOGO_BCKGRD')) { // InfraS change ?>
		background: var(--logo_background_color);
	<?php } else { ?>
		background: #FFF;
	<?php } ?>
	margin: 0;
}

.db-menu__logo__img {
	<?php if (getDolGlobalString('OBLYON_LOGO_PADDING') && getDolGlobalString('OBLYON_LOGO_PADDING') == "padding") { ?>
		max-height: 140px;
	<?php } else { ?>
		max-height: 120px;
	<?php } ?>
	<?php if (getDolGlobalString('OBLYON_LOGO_SIZE')) { ?>
		height: 80px;
	<?php } else { ?>
		height: auto;
	<?php }	?>
	max-width: 100%;
	width: auto;
}

/**
* Secondary Navigation
*/

.sec-nav__list {
	list-style: none;
	margin: 0;
	padding: 0;
}

.sec-nav__item {
	display: block;
}

.vmenu .sec-nav__item.item-heading > .sec-nav__link {
	background-color: var(--bgnavleft_hover);
	font-weight: bold;
	display: block;
	line-height: 1em;
	padding: 10px;
	<?php if (getDolGlobalString('OBLYON_HIDE_LEFTICONS')) { ?>
		font-weight: 500;
	<?php } ?>
}

.sec-nav { color: var(--bgnavleft); }

.sec-nav .sec-nav__link {
	color: var(--bgnavleft_txt);
	font-size: var(--fontsize);
	font-family: var(--fontfamilydol);
	font-weight: normal;
	text-align: var(--left);
	text-decoration: none;
	transition: all .2s ease-in-out;
	-moz-transition: all .2s ease-in-out;
	-webkit-transition: all .2s ease-in-out;
}

.sec-nav .sec-nav__link:hover {
	background-color: var(--bgnavleft_hover);
	color: var(--bgnavleft_txt_hover);
}
.sec-nav .sec-nav__link:focus {
	background-color: var(--bgnavleft_hover);
	color: var(--bgnavleft_txt_active);
}

.vmenu .sec-nav__item.item-heading {
	margin-bottom: 15px;
}

.sec-nav__sub-list {
	background-color: var(--bgnavleft);
	padding-top: 5px;
	/* padding-inline-start: 1.5em; */
}

.sec-nav__sub-list .item-level1 {
	padding: 0.3em 0.8em 0.3em 0;
}

.sec-nav__sub-list .item-level2 {
	padding: 0.2em 1em 0.3em 0;
}

.sec-nav__sub-list .item-level3 {
	padding: 0.2em 1em 0.3em 0;
}

.sec-nav__sub-item.is-disabled {
	opacity: .6;
	padding: 0.3em 0.8em 0.3em 0;
}

.sec-nav .sec-nav__link.is-disabled {
	cursor: not-allowed;
}

/**
* Main Navigation
*/

.main-nav.is-inverted .main-nav__link {
line-height: 35px;
<?php if (getDolGlobalString('OBLYON_HIDE_LEFTICONS')) { ?>
	padding-<?php print $left; ?>: 10px;
	font-weight: 500;
<?php } ?>
overflow: hidden;
text-overflow: ellipsis;
}

.main-nav.is-inverted {
font-size: 14px;
}

/**
* Society Name Block
*/
.blockvmenusocietyname {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		background-color: var(--bgnavtop_hover);
	<?php } else { ?>
		background-color: var(--bgnavleft_hover);
	<?php } ?>
	padding: 10px 0 10px 0;
}

.blockvmenusocietyname span {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		color: var(--bgnavtop_txt);
	<?php } else { ?>
		color: var(--bgnavleft_txt);
	<?php } ?>
	padding: 5px 10px 5px 10px;
	overflow: hidden;
	text-overflow: ellipsis;
	font-weight: bold;
}

/**
* Search Block
*/

.blockvmenusearch {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		background-color: var(--bgnavtop);
		border-bottom: 1px solid var(--bgnavtop_hover);
	<?php } else { ?>
		background-color: var(--bgnavleft);
		border-bottom: 1px solid var(--bgnavleft_hover);
	<?php } ?>
	box-shadow: 0 0 1px rgba(0,0,0, .04);
	-webkit-box-shadow: 0 0 1px rgba(0,0,0, .04);
	clear: both;
	padding: 10px;
	text-decoration: none;
}

.blockvmenusearch .menu_titre {
	margin: 8px 0 1px 0;
}

.blockvmenusearch a:link,
.blockvmenusearch a:visited,
.blockvmenusearch a:active {
	color: #eee;
	font-family: var(--fontmenusearch);
	font-size:var(--fontsize);
	text-align: var(--left);
}

.blockvmenusearch a:hover { color: var(--bgnavleft_txt_hover); }	/* InfraS change : texte de survol = jeton du menu (OBLYON_COLOR_*MENU_TXT_HOVER), plus la couleur principale : le libelle disparaissait quand elle est proche du fond de survol */

/**
* Bookmarks Block
*/

.blockvmenubookmarks {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		background-color: var(--bgnavtop);
		border-bottom: 1px solid var(--bgnavtop_hover);
	<?php } else { ?>
		background-color: var(--bgnavleft);
		border-bottom: 1px solid var(--bgnavleft_hover);
	<?php } ?>
	box-shadow: 0 0 1px rgba(0,0,0, .04);
	-webkit-box-shadow: 0 0 1px rgba(0,0,0, .04);
	clear: both;
	padding: 5px 10px 5px 10px;
	text-decoration: none;
}

.blockvmenubookmarks .menu_titre {
	margin: 8px 0 1px 0;
	text-align: var(--left);
}

.blockvmenubookmarks .menu_titre a { font-size: 13px; }

.blockvmenubookmarks .menu_titre img:hover {
	background-image: url(img/object_bookmark_full.png);
}

.blockvmenubookmarks .menu_contenu {
	max-width: 230px;
	overflow: hidden;
	padding: 2px 6px;
	text-overflow: ellipsis;
}

.blockvmenubookmarks a:link,
.blockvmenubookmarks a:visited,
.blockvmenubookmarks a:active{
	color: var(--colorfline);
	font-family: var(--fontmenubookmarks);
	font-size:var(--fontsize);
}

.blockvmenubookmarks a.vmenu:link,
.blockvmenubookmarks a.vmenu:visited { color: var(--colorfline); }

.blockvmenubookmarks a.vmenu:hover,
.blockvmenubookmarks a.vsmenu:hover { color: var(--bgnavleft_txt_hover); }	/* InfraS change : texte de survol = jeton du menu (OBLYON_COLOR_*MENU_TXT_HOVER), plus la couleur principale : le libelle disparaissait quand elle est proche du fond de survol */

/**
* Help Block
*/

.blockvmenuhelp {
	<?php if (empty($conf->dol_optimize_smallscreen) || getDolGlobalString('OBLYON_REDUCE_LEFTMENU')) { ?>
		<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
			background-color: var(--bgnavtop);
		<?php } else { ?>
			background-color: var(--bgnavleft);
		<?php } ?>
		color: var(--maincolor);
		font-family: var(--fontmenuhelp);
		margin: 0;
		text-align: center;
	<?php } else { ?>
		display: none;
	<?php } ?>
}

.blockvmenuhelp a {
	font-family: var(--fontmenuhelp);
	font-size: var(--fontsize);
	display: inline-block;
}

.blockvmenuhelp a.help:link,
.blockvmenuhelp a.help:visited,
.blockvmenuhelp a.help:active {
	color: var(--bgnavleft_txt);
	font-size: var(--fontsizesmaller);
	font-weight: normal;
	text-align: var(--left);
	text-decoration: none;
}

.blockvmenuhelp a:hover {
	color: var(--bgnavleft_txt_hover) !important;	/* InfraS change : texte de survol = jeton du menu (OBLYON_COLOR_*MENU_TXT_HOVER), plus la couleur principale : le libelle disparaissait quand elle est proche du fond de survol */
}

.blockvmenuhelp a[href*="http://www.dolibarr."] {
	padding: 15px 0 5px;
	font-size: 15px;
}

.blockvmenuhelp a.help img {
	vertical-align: top;
}

.blockvmenuhelp:last-child {
	padding: 10px 0 10px 0;
}
.helppresentcircle {
	/*
	color: var(--colorbackhmenu1);
	filter: invert(0.8);
	*/
	color: var(--badgeSecondary);
	margin-<?php print $left ?>: -7px;
	display: inline-block;
	margin-top: -10px;
	font-size: x-small;
	vertical-align: super;
	opacity: 0.95;
}

/*------------------------------------*\
#Pushy Left Menu
\*------------------------------------*/

#id-left {
<?php if (getDolGlobalString('OBLYON_HIDE_LEFTMENU') || !empty($conf->dol_optimize_smallscreen)) { ?>
	position: <?php print ($conf->dol_optimize_smallscreen) ? 'fixed;' : 'absolute;'?>
	<?php if (!getDolGlobalString('THEME_STICKY_TOPMENU') && getDolGlobalString('OBLYON_EFFECT_LEFTMENU') && getDolGlobalString('OBLYON_EFFECT_LEFTMENU') == "push" ) { ?>
		top: 0;
	<?php } else { ?>
		<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
			top: 40px;
		<?php } else { ?>
			top: 54px;
		<?php } ?>
	<?php } ?>

	background-color: var(--bgnavleft);
	<?php if (!empty($usecss3)) { ?>
		box-shadow: 0 1px 2px rgba(0, 0, 0, .4);
		-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .4);
	<?php } ?>
	max-width: 265px;
	overflow: hidden;
	-webkit-overflow-scrolling: touch;
	<?php if (getDolGlobalString('OBLYON_EFFECT_LEFTMENU') && getDolGlobalString('OBLYON_EFFECT_LEFTMENU') == "push" && !empty($usecss3)) { ?>
		<?php print $left; ?>: 0;

		-webkit-transform: translate3d(-265px,0,0);
		-moz-transform: translate3d(-265px,0,0);
		-ms-transform: translate3d(-265px,0,0);
		-o-transform: translate3d(-265px,0,0);
		transform: translate3d(-265px,0,0);
	<?php } else { ?>
		<?php print $left; ?>: -270px;
	<?php } ?>
<?php } ?>
}

@media all and (orientation:landscape) {
	@media only screen and (max-height: 500px) {
		#id-left {
			max-height: 300px;
			overflow-y: auto;
		}
		#id-left::-webkit-scrollbar {
			display: none;
		}
	}
}

<?php if (getDolGlobalString('OBLYON_HIDE_LEFTMENU') || !empty($conf->dol_optimize_smallscreen)) { ?>
	#id-left, #id-container, .push {
	<?php if (getDolGlobalString('OBLYON_EFFECT_LEFTMENU') && getDolGlobalString('OBLYON_EFFECT_LEFTMENU') == "push") { ?>
		-webkit-transition: -webkit-transform .3s cubic-bezier(.16, .68, .43, .99);
		-moz-transition: -moz-transform .3s cubic-bezier(.16, .68, .43, .99);
		-o-transition: -o-transform .3s cubic-bezier(.16, .68, .43, .99);
		transition: transform .3s cubic-bezier(.16, .68, .43, .99);
	<?php } else { ?>
		-webkit-transition: all 0.3s ease;
		-moz-transition: all 0.3s ease;
		transition: all 0.3s ease;
	<?php } ?>
	}

	.container-push {
	<?php if (getDolGlobalString('OBLYON_EFFECT_LEFTMENU') && getDolGlobalString('OBLYON_EFFECT_LEFTMENU') == "push") { ?>
		-webkit-transform: translate3d(265px,0,0);
		-moz-transform: translate3d(265px,0,0);
		-ms-transform: translate3d(265px,0,0);
		-o-transform: translate3d(265px,0,0);
		transform: translate3d(265px,0,0);
	<?php } ?>
	}

	/**
	* Coming Feature: OVERLAY when LEFTMENU hidden
	*/
	/*.pushy-active .site-overlay {
	display: block;
	position: fixed;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	z-index: 99;
	background-color: rgba(0,0,0,0.5);
	-webkit-animation: fade 500ms;
	-moz-animation: fade 500ms;
	-ms-animation: fade 500ms;
	-o-animation: fade 500ms;
	animation: fade 500ms;
	}*/

	.pushy-active {
	-webkit-animation: fade 500ms;
	-moz-animation: fade 500ms;
	-ms-animation: fade 500ms;
	-o-animation: fade 500ms;
	animation: fade 500ms;
	overflow-x: hidden;
	overflow-y: auto;
	height: 100%;
	}

	.pushy-open {
	<?php if (getDolGlobalString('OBLYON_EFFECT_LEFTMENU') && getDolGlobalString('OBLYON_EFFECT_LEFTMENU') == "push" ) { ?>
		-webkit-transform: translate3d(0,0,0);
		-moz-transform: translate3d(0,0,0);
		-ms-transform: translate3d(0,0,0);
		-o-transform: translate3d(0,0,0);
		transform: translate3d(0,0,0);
	<?php } else { ?>
		<?php print $left; ?>: 0 !important;
	<?php } ?>
	}

	/**
	* Coming Feature: OVERLAY when LEFTMENU hidden
	*/
	/*
	<?php if (getDolGlobalString('OBLYON_OVERLAY_LEFTMENU')) { ?>
		#id-right::after {
		background: rgba(0,0,0,0.3);
		display: none;
		opacity: 0;
		position: fixed;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		z-index: 1;
		width: 100%;
		height: 100%;
		-webkit-transform: translate3d(100%,0,0);
		transform: translate3d(100%,0,0);
		-webkit-transition: opacity 0.3s, -webkit-transform 0s 0.3s;
		transition: opacity 0.3s, transform 0s 0.3s;
		}

		.pushy-active #id-right::after {
		opacity: 1;
		display: block;
		-webkit-transition: opacity 0.3s;
		transition: opacity 0.3s;
		-webkit-transform: translate3d(0,0,0);
		transform: translate3d(0,0,0);
		}
	<?php } ?>
	*/

	.pushy-btn {
		background-color: var(--bgnavtop);
		color: var(--bgnavtop_txt);
		display: inline-block;
		float: var(--left);
		font-size: 24px;
		height: 54px;
		line-height: 54px;
		padding: 0 10px;
		cursor: pointer;
	}

	.pushy-btn:hover {
		background-color: var(--bgnavtop_hover);
		color: var(--bgnavtop_txt_hover);
	}

	.pushy-active .pushy-btn {
		background-color: var(--bgnavtop_hover);
		color: var(--bgnavtop_txt_active);
	}

<?php } ?> /* end HIDE_LEFTMENU */

/*------------------------------------*\
	#Oblyon Main and Sec Nav Icons
\*------------------------------------*/

.main-nav .icon {
<?php if (getDolGlobalString('OBLYON_HIDE_TOPICONS') && !getDolGlobalString('MAIN_MENU_INVERT')) { ?>
	display: none;
<?php } else { ?>
	display: block;
<?php } ?>
	float: none;
	height: 34px;
	line-height: 36px;
	min-width: 40px;
	position: relative;
}

.main-nav.is-inverted .icon {
<?php if (getDolGlobalString('OBLYON_HIDE_LEFTICONS')) { ?>
	display: none;
<?php } ?>
	float: var(--left);
	height: 35px;
	line-height: 35px;
	margin: 0;
	position: relative;
	text-align: center;
	width: 40px;
}

.main-nav .icon {
	font-size: 18px;
}

.sec-nav .icon {
<?php if (!getDolGlobalString('MAIN_MENU_INVERT') && getDolGlobalString('OBLYON_HIDE_LEFTICONS')) { ?>
	display: none;
<?php } ?>
	float: var(--left);
	margin-<?php print $right; ?>: 5px;
}

.sec-nav.is-inverted .icon {
<?php if (getDolGlobalString('OBLYON_HIDE_TOPICONS')) { ?>
	display: none;
<?php } ?>
	height: 40px;
	line-height: 40px;
}

.sec-nav .icon {
	font-size: 14px;
}

.mainmenu.accounting {
	background: none !important;
}
