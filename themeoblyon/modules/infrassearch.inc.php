<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* ================================================================================================
   oblyon/themeoblyon/modules/infrassearch.inc.php
   Role      : CSS du module tiers infrassearch sur les jetons du theme ; se garde lui-meme (isModEnabled)
   Inclus par : modules.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/* InfraS add : fichier ajoute par InfraS (2026-09) - champ de recherche et fil d'Ariane du module infrassearch dans la barre du haut */
/* <style type="text/css" > */

<?php if (isModEnabled('infrassearch')) { ?>
/*
 * Le module dessine son champ "souligne" (fond transparent, trait #888 en bas, margin 0) dans un conteneur
 * a padding 4px haut / 0 bas (style en ligne). Depuis le socle 3.4.1 (bordure complete sur tous les champs),
 * le champ heritait d'un cadre clair prevu pour les fonds de page et descendait par rapport aux icones.
 * Ici : champ en pilule centre verticalement, lisible sur barre sombre comme claire ; icone du fil d'Ariane
 * sur la meme hauteur de ligne que les autres icones de la barre.
 */
<?php $oblyon_topbar_h = getDolGlobalString('MAIN_MENU_INVERT') ? '40' : '54'; ?>
/* Structure reelle (core 24) : la sortie du module est le PREMIER enfant de div.login_block, un <div class="inline-block nowrap">
   sans hauteur, aligne sur la ligne de base d'un bloc dont la hauteur de ligne est celle du corps (1) : ses deux conteneurs
   (fil d'Ariane, recherche) descendaient et depassaient sous la barre. Le bloc devient un flottant de la hauteur exacte de la barre,
   comme les icones du core (.login_block_elem), et ses conteneurs sont cales en haut de ce flottant. */
div.login_block > div.inline-block.nowrap {
	display: block;
	float: var(--left);
	height: <?php print $oblyon_topbar_h; ?>px;
	line-height: <?php print $oblyon_topbar_h; ?>px;
	margin: 0;
	padding: 0;
}
div.login_block > div.inline-block.nowrap .login_block_elem_name {
	display: inline-block;
	vertical-align: top;
	height: <?php print $oblyon_topbar_h; ?>px;
	line-height: <?php print $oblyon_topbar_h; ?>px;
	margin: 0;
	padding: 0;
}
div.login_block #topmenu-search,
div.login_block #topmenu-breadcrumb-dropdown {
	padding-top: 0 !important;
	padding-bottom: 0 !important;
	margin: 0;
	line-height: <?php print $oblyon_topbar_h; ?>px;
	height: <?php print $oblyon_topbar_h; ?>px;
	vertical-align: top;
}
/* Liste du fil d'Ariane : ouverte juste sous la barre, sur toute la hauteur necessaire */
div.login_block #topmenu-breadcrumb-dropdown-body {
	top: <?php print $oblyon_topbar_h; ?>px !important;
	line-height: normal;
	max-height: calc(100vh - <?php print $oblyon_topbar_h; ?>px - 16px);
	overflow-y: auto;
}
div.login_block #topmenu-search form {
	display: inline-block;
	width: 100%;	/* sans largeur, le formulaire en ligne se reduisait a la taille du champ (size=15) et les 90 % du champ etaient calcules sur cette largeur reduite */
	vertical-align: middle;
	line-height: normal;
	margin: 0;
}
div.login_block input#search_keyword.infrassearchbgtrans {
	box-sizing: border-box;
	height: 26px;
	margin: 0;
	padding: 3px 12px;
	line-height: 18px;
	vertical-align: middle;
	border: 1px solid rgba(128, 128, 128, .45) !important;
	border-radius: var(--oblyon-radius-pill);
	background-color: rgba(128, 128, 128, .12);
	box-shadow: none;
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
	color: var(--bgnavleft_txt);
	<?php } else { ?>
	color: var(--bgnavtop_txt);
	<?php } ?>
	transition: border-color var(--oblyon-transition), background-color var(--oblyon-transition);
}
div.login_block input#search_keyword.infrassearchbgtrans::placeholder {
	color: inherit;
	opacity: .65;
}
div.login_block input#search_keyword.infrassearchbgtrans:focus {
	border-color: var(--oblyon-focus) !important;
	background-color: rgba(128, 128, 128, .18);
	box-shadow: none;
	outline: none;
}
div.login_block input#search_keyword.infrassearchbgtrans.ui-autocomplete-loading {
	color: var(--colortext);
}
div.login_block #topmenu-breadcrumb-dropdown > a.dropdown-toggle {
	display: inline-block;
	height: <?php print $oblyon_topbar_h; ?>px;
	line-height: <?php print $oblyon_topbar_h; ?>px;
	vertical-align: top;
}

/* Liste du fil d'Ariane : en-tete, lignes regulieres, icone en colonne fixe, survol, separateurs */
<?php $langs->load('infrassearch@infrassearch'); ?>
div.login_block #topmenu-breadcrumb-dropdown-body {
	padding: 4px 0;
}
div.login_block #topmenu-breadcrumb-dropdown-body .dropdown-breadcrumb-list::before {
	content: "<?php print str_replace('"', '\"', $langs->transnoentities('InfraSSearchBreadcrumb')); ?>";
	display: block;
	padding: 2px 12px 4px 12px;
	font-size: .74em;
	font-weight: 600;
	letter-spacing: .06em;
	text-transform: uppercase;
	color: var(--oblyon-muted-text);
}
div.login_block .infrassearchdropdown-breadcrumb-item {
	display: flex !important;	/* une ligne par element : le lien de l'objet puis, a sa suite, ce qu'ajoutent les hooks getNomUrl (onepagebasket : " -" + lien du tableau de bord client) ; en bloc, chaque lien en flex passait sur sa propre ligne */
	align-items: center;
	white-space: nowrap;
	overflow: hidden;
	margin: 0;
	padding: 0;
	box-shadow: none;
	border-top: 1px solid <?php print colorHexToRgb($oblyon_border, 0.6); ?>;
	transition: background-color var(--oblyon-transition);
}
div.login_block .infrassearchdropdown-breadcrumb-item:hover {
	background-color: var(--colorbline_hover);	/* survol des lignes du preset : le fond signale le survol, le texte reste celui des lignes */
}
div.login_block .infrassearchdropdown-breadcrumb-item a {
	display: flex;
	flex: 0 0 auto;
	align-items: center;
	gap: 6px;
	min-width: 0;
	height: 26px;
	padding: 0 12px;
	color: var(--colortext) !important;
	font-size: calc(var(--fontsize) - 1px);
	text-decoration: none;
	white-space: nowrap;
	overflow: hidden;
}
div.login_block .infrassearchdropdown-breadcrumb-item a:first-of-type {
	flex: 1 1 auto;	/* le lien de l'objet occupe la ligne (zone cliquable, libelle long coupe) ; les ajouts des hooks restent visibles en fin de ligne */
}
div.login_block .infrassearchdropdown-breadcrumb-item:hover a {
	color: var(--colorfline) !important;	/* pas la couleur principale : sombre dans certains presets (infras-dark), le texte disparaissait */
}
div.login_block .infrassearchdropdown-breadcrumb-item a > span[class*="fa-"],
div.login_block .infrassearchdropdown-breadcrumb-item a > img {
	flex: 0 0 18px;
	width: 18px;
	font-size: .9em;
	margin: 0;
	padding: 0;
	text-align: center;
	opacity: .85;
}
div.login_block .infrassearchdropdown-breadcrumb-item.text-warning {
	display: block !important;	/* message d'erreur : texte sur plusieurs lignes */
	white-space: normal;
	padding: 8px 14px;
	border-top: 0;
}

<?php if (getDolGlobalInt('OBLYON_MOBILE_LAYOUT', 1) && GETPOST('optioncss', 'aZ09') != 'print') { ?>
/* Disposition mobile (mobile.inc.php) : barre unique de 48px ; le champ de recherche n'y a pas sa place, le fil d'Ariane reste */
@media only screen and (max-width: 600px) {
	div.login_block > div.inline-block.nowrap {
		display: inline-flex;
		align-items: center;
		float: none;
		height: var(--oblyon-mobile-bar-h);
		line-height: var(--oblyon-mobile-bar-h);
	}
	div.login_block > div.inline-block.nowrap .login_block_elem_name,
	div.login_block #topmenu-breadcrumb-dropdown,
	div.login_block #topmenu-breadcrumb-dropdown > a.dropdown-toggle {
		height: var(--oblyon-mobile-bar-h);
		line-height: var(--oblyon-mobile-bar-h);
	}
	div.login_block #topmenu-search {
		display: none !important;
	}
	div.login_block #topmenu-breadcrumb-dropdown-body {
		top: var(--oblyon-mobile-bar-h) !important;
		max-height: calc(100vh - var(--oblyon-mobile-bar-h) - 8px);
	}
}
<?php } ?>
<?php } ?>
