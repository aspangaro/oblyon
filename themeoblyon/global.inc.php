<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */

/* InfraS change begin 3.7.0 : global.inc.php (11 000 lignes) est decoupe en huit fichiers thematiques inclus ici dans l'ordre d'origine ; la cascade est inchangee. Les inclusions historiques (dropdown, touchmenu, flyoutmenu, info-box, progress, timeline, mobile, modules) et la queue conditionnelle suivent. */
<?php include dol_buildpath($path.'/theme/'.$theme.'/core.inc.php', 0); ?>	/* InfraS change 3.7.0 : styles par defaut */
<?php include dol_buildpath($path.'/theme/'.$theme.'/tools.inc.php', 0); ?>	/* InfraS change 3.7.0 : outil de scan */
<?php include dol_buildpath($path.'/theme/'.$theme.'/layout.inc.php', 0); ?>	/* InfraS change 3.7.0 : structure de page */
<?php include dol_buildpath($path.'/theme/'.$theme.'/cards.inc.php', 0); ?>	/* InfraS change 3.7.0 : pictos (include main_menu_fa_icons) */
<?php include dol_buildpath($path.'/theme/'.$theme.'/tables.inc.php', 0); ?>	/* InfraS change 3.7.0 : listes */
<?php include dol_buildpath($path.'/theme/'.$theme.'/widgets.inc.php', 0); ?>	/* InfraS change 3.7.0 : calendrier */
<?php include dol_buildpath($path.'/theme/'.$theme.'/public.inc.php', 0); ?>	/* InfraS change 3.7.0 : kanban */
<?php include dol_buildpath($path.'/theme/'.$theme.'/fixes.inc.php', 0); ?>	/* InfraS change 3.7.0 : options globales */
/* InfraS change end */
<?php
include dol_buildpath($path.'/theme/'.$theme.'/dropdown.inc.php', 0);
include dol_buildpath($path.'/theme/'.$theme.'/notifcenter.inc.php', 0);	// centre de notifications (3.8.0)
include dol_buildpath($path.'/theme/'.$theme.'/touchmenu.inc.php', 0);
include dol_buildpath($path.'/theme/'.$theme.'/flyoutmenu.inc.php', 0);	// InfraS add : sous-menus en volets (effet "flyout" du menu reduit)
include dol_buildpath($path.'/theme/'.$theme.'/info-box.inc.php', 0);
include dol_buildpath($path.'/theme/'.$theme.'/progress.inc.php', 0);
include dol_buildpath($path.'/theme/'.$theme.'/timeline.inc.php', 0);
include dol_buildpath($path.'/theme/'.$theme.'/mobile.inc.php', 0);	// InfraS add : disposition mobile (3.5.0), avant les CSS des modules pour qu'ils gardent le dernier mot

// Compatibility module
include dol_buildpath($path.'/theme/'.$theme.'/modules.inc.php', 0);
include dol_buildpath($path.'/theme/'.$theme.'/motion.inc.php', 0);	// option Animations (3.8.0), en dernier pour l'emporter sur toutes les transitions / animations

// Add custom CSS if defined
print getDolGlobalString('THEME_CUSTOM_CSS');

?>

	/* Remove text selection - Intuitive table selection */
	.row-with-select[data-is-last-changed] * {
		-webkit-touch-callout: none; /* iOS Safari */
		-webkit-user-select: none; /* Safari */
		-khtml-user-select: none; /* Konqueror HTML */
		-moz-user-select: none; /* Old versions of Firefox */
		-ms-user-select: none; /* Internet Explorer/Edge */
		user-select: none; /* Non-prefixed version, currently supported by Chrome, Edge, Opera and Firefox */
	}

	div.extra_inline_chkbxlst, div.extra_inline_checkbox {
		min-width:150px;
	}

	/* Must be at end */
	div.flot-text .flot-tick-label .tickLabel, .fa-color-unset {
		color: unset;
	}

/* ============================================================================== */
/* ============================================================================== */
<?php if (getDolGlobalString('THEME_ADD_BACKGROUND_ON_INPUT')) { // A7 : fond coloré sur les champs (style eldy) ?>
input.flat, textarea.flat, select.flat, div.tabBar input, div.tabBar select, div.tabBar textarea {
	background-color: <?php print oblyon_color_setting('OBLYON_COLOR_INPUT_ADD_BCKGRD', '#f8f8fa'); ?> !important;	/* InfraS change */
}
<?php } ?>
<?php if (getDolGlobalString('THEME_SATURATE_RATIO')) { // A8 : saturation des icônes du tableau de bord ?>
.info-box-icon {
	filter: saturate(<?php print getDolGlobalString('THEME_SATURATE_RATIO'); ?>);
}
<?php } ?>
<?php if (getDolGlobalString('THEME_ELDY_USEBORDERONTABLE')) { ?>
.box {
	border-radius: var(--infras_radius);
}
table.liste {
	border-collapse: separate !important;
	border-spacing: 0 !important;
	border-radius: var(--infras_radius);
}
table.liste tr:first-child > td:first-child, table.liste tr:first-child > th:first-child, table.liste thead tr:first-child > th:first-child {
	border-top-left-radius: var(--infras_radius);
}
table.liste tr:first-child > td:last-child, table.liste tr:first-child > th:last-child, table.liste thead tr:first-child > th:last-child {
	border-top-right-radius: var(--infras_radius);
}
table.liste tr:last-child > td:first-child, table.liste tr:last-child > th:first-child {
	border-bottom-left-radius: var(--infras_radius);
}
table.liste tr:last-child > td:last-child, table.liste tr:last-child > th:last-child {
	border-bottom-right-radius: var(--infras_radius);
}
<?php } ?>
<?php if (getDolGlobalString('THEME_ELDY_SHADOW_ON_SMALL_BOXES')) { // B2 : ombres petites boîtes ?>
.firstcolumn table.noborder, .secondcolumn table.noborder {
	box-shadow: 5px 5px 5px <?php print oblyon_color_setting('OBLYON_COLOR_BOX_SHADOW', '#f0f0f0'); ?>;	/* InfraS change */
}
<?php } ?>
<?php if (getDolGlobalString('THEME_ELDY_USECOMOACTROW')) { // B4 : lignes de tableau plus hautes ; option retiree de l'onglet Options (remplacee par la densite OBLYON_DENSITY, migration a l'ouverture de la page et a l'activation), regle conservee pour une instance pas encore migree ?>
.div-table-responsive, .div-table-responsive-no-min {
	line-height: 300%;
}
<?php } ?>
