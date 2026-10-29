<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* ================================================================================================
   oblyon/themeoblyon/modules/mbicalls.inc.php
   Role      : CSS du module tiers mbicalls sur les jetons du theme ; se garde lui-meme (isModEnabled)
   Inclus par : modules.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/* InfraS add : fichier ajoute par InfraS (2026-09) */
/* <style type="text/css" > */

<?php if (isModEnabled('mbicalls')) { ?>
/* Module mbicalls : le panneau deroulant des appels (custom/mbicalls/style/style.css) a toutes ses couleurs en dur
   (lignes blanches, textes bleu nuit, pastilles gris clair). Ce fichier, charge apres la feuille du module, le remet
   sur les jetons du theme : il suit donc le preset courant (clair ou sombre) et les couleurs par utilisateur.
   Les couleurs semantiques des pastilles d'etat (vert decroche, rouge manque, violet transfert...) ne sont pas touchees. */

/* Lignes d'appel : fond, survol et textes des lignes du preset */
#topmenu-calls-dropdown .mbicalls-dropdown-table tr {
	background: var(--colorbline);
	box-shadow: var(--oblyon-shadow-sm);
}
#topmenu-calls-dropdown .mbicalls-dropdown-table tr:hover {
	background: var(--colorbline_hover);
	box-shadow: var(--oblyon-shadow-md);
}
#topmenu-calls-dropdown .mbicalls-dropdown-table td,
#topmenu-calls-dropdown .mbicalls-dropdown-table td:first-child {
	color: var(--colorfline);
}
#topmenu-calls-dropdown .mbicalls-dropdown-table td:first-child {
	color: var(--oblyon-muted-text);
}
#topmenu-calls-dropdown .mbicalls-dropdown-table a {
	color: var(--colortextlink) !important;
	font-size: inherit;	/* le theme met les liens du bloc de connexion a 13px (div.login_block_user a) : ici ils suivent la taille des lignes du panneau */
}
#topmenu-calls-dropdown .mbicalls-dropdown-table a.mbicalls-clicktodial {
	color: var(--colorfline) !important;
}
#topmenu-calls-dropdown .mbicalls-dropdown-table img {
	box-shadow: 0 0 0 1px var(--oblyon-border);
}
#topmenu-calls-dropdown .mbicalls-flow-row > td {
	background: var(--oblyon-neutral-bg) !important;
}
#topmenu-calls-dropdown .mbicalls-flow-step + .mbicalls-flow-step {
	border-top: 1px solid var(--oblyon-border);
}

/* Barre d'outils : selecteur, pastilles de filtre, segment Appels / SMS / Messagerie, compteur de file */
#topmenu-calls-dropdown .mbicalls-filter-select {
	background: var(--colorbline);
	border: 1px solid var(--oblyon-input-border);
	box-shadow: none;
	color: var(--colorfline);
}
#topmenu-calls-dropdown .mbicalls-filter-select:hover {
	border-color: var(--oblyon-border-strong);
}
#topmenu-calls-dropdown .mbicalls-filter-select:focus {
	border-color: var(--oblyon-focus);
	box-shadow: 0 0 0 2px var(--oblyon-neutral-bg);
}
#topmenu-calls-dropdown .mbicalls-state-pill {
	background: var(--oblyon-neutral-bg);
	border-color: var(--oblyon-border);
	color: var(--colorfline);
}
#topmenu-calls-dropdown .mbicalls-state-pill:hover {
	background: var(--colorbline_hover);
	border-color: var(--oblyon-border-strong);
}
#topmenu-calls-dropdown .mbicalls-state-pill.on {
	color: var(--colorTextButtonAction);	/* fond semantique par etat conserve (style.css du module) */
}
#topmenu-calls-dropdown .mbicalls-state-pill-count {
	background: var(--oblyon-border);
}
#topmenu-calls-dropdown .mbicalls-dd-seg {
	background: var(--oblyon-neutral-bg);
}
#topmenu-calls-dropdown .mbicalls-dd-seg-btn {
	color: var(--oblyon-muted-text);
}
#topmenu-calls-dropdown .mbicalls-dd-seg-btn.on {
	background: var(--colorbline);
	box-shadow: var(--oblyon-shadow-sm);
	color: var(--colorfline);
}
#topmenu-calls-dropdown .mbicalls-dropdown-title-icon,
#topmenu-calls-dropdown .mbicalls-queue-counter-value,
#topmenu-calls-dropdown .mbicalls-loadmore-plus,
#topmenu-calls-dropdown .mbicalls-vm-dd-play,
#topmenu-calls-dropdown .mbicalls-vm-dd-del,
#topmenu-calls-dropdown .mbicalls-sms-dd-icon {
	background: var(--colorButtonAction1);
	color: var(--colorTextButtonAction);
}
#topmenu-calls-dropdown .mbicalls-vm-dd-play:hover {
	background: var(--colorButtonAction2);
}
#topmenu-calls-dropdown .mbicalls-queue-counter {
	background: var(--oblyon-neutral-bg);
	border-color: var(--oblyon-border);
	color: var(--colorfline);
}
#topmenu-calls-dropdown .mbicalls-queue-counter-active {
	border-color: var(--colorButtonAction1);
}

/* Pied du panneau : boutons ronds « plus » et « statistiques » */
#topmenu-calls-dropdown .mbicalls-loadmore-button,
#topmenu-calls-dropdown .mbicalls-dd-stats {
	background: var(--oblyon-neutral-bg);
	border-color: var(--oblyon-border);
	box-shadow: none;
	color: var(--colorfline) !important;
}
#topmenu-calls-dropdown .mbicalls-loadmore-button:hover,
#topmenu-calls-dropdown .mbicalls-loadmore-button:focus,
#topmenu-calls-dropdown .mbicalls-dd-stats:hover,
#topmenu-calls-dropdown .mbicalls-dd-stats:focus {
	background: var(--colorbline_hover);
	border-color: var(--oblyon-border-strong);
	box-shadow: var(--oblyon-shadow-sm);
	color: var(--colorfline) !important;
}

/* Panneaux Messagerie et SMS du meme menu */
#topmenu-calls-dropdown .mbicalls-vm-dd-row,
#topmenu-calls-dropdown .mbicalls-sms-dd-row {
	border-bottom-color: var(--oblyon-border);
}
#topmenu-calls-dropdown .mbicalls-vm-dd-who b,
#topmenu-calls-dropdown .mbicalls-sms-dd-who {
	color: var(--colorfline);
}
#topmenu-calls-dropdown .mbicalls-vm-dd-num,
#topmenu-calls-dropdown .mbicalls-vm-dd-excerpt,
#topmenu-calls-dropdown .mbicalls-vm-dd-when,
#topmenu-calls-dropdown .mbicalls-sms-dd-num,
#topmenu-calls-dropdown .mbicalls-sms-dd-when,
#topmenu-calls-dropdown .mbicalls-sms-dd-meta,
#topmenu-calls-dropdown .mbicalls-sms-dd-excerpt,
#topmenu-calls-dropdown .mbicalls-vm-dd-empty,
#topmenu-calls-dropdown .mbicalls-sms-dd-empty {
	color: var(--oblyon-muted-text);
}
#topmenu-calls-dropdown .mbicalls-vm-dd-excerpt:hover,
#topmenu-calls-dropdown .mbicalls-sms-dd-excerpt:hover {
	color: var(--colorfline);
}

/* Bandeau « appel en cours » du panneau et notice click-to-call */
#topmenu-calls-dropdown .mbicalls-clicktocall-notice-visible {
	background: var(--oblyon-neutral-bg);
	border-color: var(--oblyon-border);
	border-left-color: var(--colorButtonAction1);
	color: var(--colorfline);
}
#topmenu-calls-dropdown .mbicalls-clicktocall-notice-icon {
	background: var(--colorButtonAction1);
	color: var(--colorTextButtonAction);
}
<?php } ?>
