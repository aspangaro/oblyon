<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/notifcenter.inc.php
   Role      : Centre de notifications (OBLYON_NOTIFICATION_CENTER, 3.8.0) : cloche de la barre du haut (hook printTopRightMenu, class/actions_oblyon.class.php),
               pastille des non lus, panneau deroulant (liste, tout marquer lu, effacer) ; contenu gere par js/oblyon.js (localStorage)
   Inclus par : global.inc.php (apres dropdown.inc.php) | Garde : ISLOADEDBYSTEELSHEET + option | Variables PHP : portee de style.css.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */
<?php if (getDolGlobalInt('OBLYON_NOTIFICATION_CENTER')) {
	// Couleurs de la barre qui porte le bloc de connexion : en menus inverses, div.login_block prend les couleurs "menu gauche" (layout.inc.php)
	$oblyon_notif_txt	= getDolGlobalString('MAIN_MENU_INVERT') ? 'var(--bgnavleft_txt)' : 'var(--bgnavtop_txt)';
	$oblyon_notif_hover	= getDolGlobalString('MAIN_MENU_INVERT') ? 'var(--bgnavleft_hover)' : 'var(--bgnavtop_hover)';
?>
.oblyon-notif {
	position: relative;
	display: inline-block;
	vertical-align: middle;
}
.oblyon-notif-btn, .oblyon-notif-btn:link, .oblyon-notif-btn:visited {
	/* taille, hauteur et interligne herites de ".login_block_elem a" (layout.inc.php) : meme rendu que la loupe, l'etoile, l'imprimante */
	position: relative;
	padding: 0 6px !important;
	text-decoration: none !important;
}
.oblyon-notif-count {
	position: absolute;
	top: <?php print getDolGlobalString('MAIN_MENU_INVERT') ? '4px' : '10px'; ?>;
	<?php print $right; ?>: -2px;
	min-width: 16px;
	height: 16px;
	padding: 0 4px;
	border-radius: var(--oblyon-radius-pill);
	background: var(--colorstatusdanger);
	color: #FFFFFF;
	font-size: 10px;
	line-height: 16px;
	font-weight: 600;
	text-align: center;
	box-sizing: border-box;
	pointer-events: none;
}
.oblyon-notif-count[hidden], .oblyon-notif-panel[hidden], .oblyon-notif-empty[hidden] {
	display: none !important;
}
.oblyon-notif-panel {
	position: absolute;
	top: 100%;
	<?php print $right; ?>: 0;
	margin-top: 6px;
	width: 360px;
	max-width: calc(100vw - 16px);
	max-height: 70vh;
	overflow-y: auto;
	background: var(--colorOverlayBg);
	color: var(--colortext);
	border: 1px solid var(--oblyon-border);
	border-radius: var(--oblyon-radius);
	box-shadow: var(--oblyon-shadow-lg);
	z-index: 1000;
	text-align: <?php print $left; ?>;
	font-size: var(--fontsize);
	font-weight: normal;
	line-height: 1.4;
}
.oblyon-notif-head {
	display: flex;
	align-items: center;
	justify-content: space-between;
	gap: 8px;
	padding: 10px 12px;
	border-bottom: 1px solid var(--oblyon-border);
	background: var(--oblyon-neutral-bg);
	border-radius: var(--oblyon-radius) var(--oblyon-radius) 0 0;
	position: sticky;
	top: 0;
}
.oblyon-notif-title {
	font-weight: 600;
}
.oblyon-notif-actions a {
	color: var(--oblyon-muted-text) !important;
	font-size: .9em;
	text-decoration: none !important;
	margin-<?php print $left; ?>: 10px;
}
.oblyon-notif-actions a:hover {
	color: var(--maincolor) !important;
}
.oblyon-notif-list {
	list-style: none;
	margin: 0;
	padding: 0;
}
.oblyon-notif-item {
	display: flex;
	align-items: flex-start;
	gap: 8px;
	padding: 9px 8px 9px 14px;
	border-bottom: 1px solid var(--oblyon-border);
	border-<?php print $left; ?>: 3px solid var(--colorstatusinfo);
	cursor: pointer;
	transition: background-color var(--oblyon-transition);
}
.oblyon-notif-body {
	flex: 1 1 auto;
	min-width: 0;
	display: flex;
	flex-direction: column;
	gap: 2px;
}
.oblyon-notif-del, .oblyon-notif-del:link, .oblyon-notif-del:visited {
	flex: 0 0 auto;
	width: 24px;
	height: 24px;
	line-height: 22px;
	text-align: center;
	border-radius: 50%;
	font-size: 18px;
	color: var(--oblyon-muted-text) !important;
	text-decoration: none !important;
	transition: background-color var(--oblyon-transition), color var(--oblyon-transition);
}
.oblyon-notif-del:hover {
	background: var(--oblyon-neutral-bg);
	color: var(--colorstatusdanger) !important;
}
.oblyon-notif-item:last-child {
	border-bottom: 0;
}
.oblyon-notif-item:hover {
	background: var(--oblyon-neutral-bg);
}
.oblyon-notif-item.oblyon-notif-warning {
	border-<?php print $left; ?>-color: var(--colorstatuswarning);
}
.oblyon-notif-item.oblyon-notif-error {
	border-<?php print $left; ?>-color: var(--colorstatusdanger);
}
.oblyon-notif-item.is-unread {
	background: var(--oblyon-accent-tint);
}
.oblyon-notif-item.is-unread .oblyon-notif-msg {
	font-weight: 600;
}
.oblyon-notif-msg {
	white-space: normal;
	word-break: break-word;
}
.oblyon-notif-time {
	font-size: .85em;
	color: var(--oblyon-muted-text);
}
.oblyon-notif-empty {
	margin: 0;
	padding: 18px 12px;
	text-align: center;
	color: var(--oblyon-muted-text);
}
@media (max-width: <?php print getDolGlobalInt('OBLYON_MOBILE_LAYOUT', 1) ? '600' : '0'; ?>px) {
	/* disposition mobile : panneau pleine largeur sous la barre de 48 px */
	.oblyon-notif {
		position: static;
	}
	.oblyon-notif-panel {
		position: fixed;
		top: var(--oblyon-mobile-bar-h, 48px);
		left: 0;
		right: 0;
		width: auto;
		max-width: none;
		max-height: calc(100vh - var(--oblyon-mobile-bar-h, 48px));
		margin-top: 0;
		border-radius: 0;
		border-left: 0;
		border-right: 0;
	}
}
<?php } ?>
