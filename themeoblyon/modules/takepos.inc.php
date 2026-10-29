<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* InfraS add : fichier ajoute par InfraS (2026-10) */
/* ================================================================================================
   oblyon/themeoblyon/modules/takepos.inc.php
   Role      : Caisse TakePOS (3.9.0) : themes de la caisse (OBLYON_TAKEPOS_THEME), couleurs des categories
               (OBLYON_TAKEPOS_CATEGORY_COLORS) et correctif de la disposition mobile ; se garde lui-meme (isModEnabled)
   Inclus par : modules.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php / mobile.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   Portee    : classes posees sur <html> par ActionsOblyon::addHtmlHeader() sur les seules pages /takepos/ :
               oblyon-pos-styled (tous les themes sauf natif : habillage commun), oblyon-pos-<theme> (classic = Natif ameliore,
               counter = Comptoir, tablet = Tablette, scanner = Superette), oblyon-pos-layout (les trois dispositions),
               oblyon-pos-catcolors (couleurs des categories) ; posees par js/takepos.js : oblyon-pos-numpad-open (pave ouvert en panneau),
               oblyon-pos-show-products (Tablette : grille des produits affichee).
               Prefixees ainsi, les regles l'emportent sur takepos/css/pos.css.php, charge apres la feuille du theme ;
               !important seulement contre les styles en ligne de TakePOS et les 9 regles de takepos/css/colorful.css.
               Dispositions : la zone .container de TakePOS devient une grille, ses deux rangees (.row1 / .row2) passent en
               display: contents et chaque zone (.header, #poslines, .div2 pave, .div3 actions, .div4 categories, .div5 produits,
               barre de paiement et aide clavier creees par js/takepos.js) prend sa place nommee (grid-area)
   ================================================================================================ */

/* <style type="text/css" > */

<?php
if (isModEnabled('takepos')) {
	$oblyon_pos_theme	= getDolGlobalString('OBLYON_TAKEPOS_THEME', 'native');
	if (!in_array($oblyon_pos_theme, array('native', 'classic', 'counter', 'tablet', 'scanner'), true)) {
		$oblyon_pos_theme	= 'native';
	}
	$oblyon_pos_layout	= in_array($oblyon_pos_theme, array('counter', 'tablet', 'scanner'), true) ? $oblyon_pos_theme : '';
	$oblyon_pos_bp		= isset($oblyon_bp_phone) ? (int) $oblyon_bp_phone : 600;
	?>

/* Couleurs des categories (OBLYON_TAKEPOS_CATEGORY_COLORS) : js/takepos.js pose --oblyon-pos-cat (couleur de la categorie Dolibarr) et
   la classe .oblyon-pos-hascat sur les tuiles. Regles toujours presentes : c'est la classe html.oblyon-pos-catcolors, posee selon
   l'interrupteur, qui les active (l'interrupteur s'enregistre en ajax, sans changer la revision de la feuille) */
html.oblyon-pos-catcolors div.div4 div.wrapper.oblyon-pos-hascat,
html.oblyon-pos-catcolors div.div5 div.wrapper2.oblyon-pos-hascat[data-iscat="1"] {
	box-shadow: inset 0 0 0 3px var(--oblyon-pos-cat);
}
html.oblyon-pos-catcolors div.div4 div.wrapper.oblyon-pos-hascat div.description,
html.oblyon-pos-catcolors div.div5 div.wrapper2.oblyon-pos-hascat[data-iscat="1"] div.description {
	background: var(--oblyon-pos-cat);
	color: #fff;
	text-shadow: 0 1px 2px rgba(0, 0, 0, .45);
	padding-top: 4px;
	padding-bottom: 4px;
}
html.oblyon-pos-catcolors div.div4 div.wrapper.oblyon-pos-hascat div.description div.description_content,
html.oblyon-pos-catcolors div.div5 div.wrapper2.oblyon-pos-hascat[data-iscat="1"] div.description div.description_content {
	color: #fff;	/* le socle des themes met le libelle en couleur du texte */
}
html.oblyon-pos-catcolors div.div5 div.wrapper2.oblyon-pos-hascat:not([data-iscat="1"]) {
	box-shadow: inset 0 -5px 0 var(--oblyon-pos-cat), inset 0 0 0 1px var(--oblyon-border);
}

	<?php if (!empty($oblyon_mobile)) { ?>
/* Disposition mobile (mobile.inc.php) : sous <?php echo $oblyon_pos_bp; ?> px, le tableau des lignes des fiches garde 640 px de large et la
   description 320 px ; dans la caisse, le ticket doit tenir dans sa colonne (sinon il defile de travers). Actif quel que soit le theme */
@media only screen and (max-width: <?php echo $oblyon_pos_bp; ?>px) {
	body.bodytakepos div.div-table-responsive-no-min > table#tablelines {
		min-width: 0;
	}
	body.bodytakepos table#tablelines td.linecoldescription {
		min-width: 0 !important;
	}
}
	<?php } ?>

	<?php if ($oblyon_pos_theme != 'native') { ?>
/* ---- Habillage commun a tous les themes de caisse (Natif ameliore, Comptoir, Tablette, Superette) ----
   Clair, couleur principale du preset de l'instance. Gouttieres de la disposition d'origine : la bordure des tuiles et des boutons a la
   couleur du fond (--oblyon-pos-gap) ; les dispositions remplacent ces bordures par l'espacement de leur grille */
html.oblyon-pos-styled {
	--oblyon-pos-bg: var(--oblyon-neutral-bg);
	--oblyon-pos-card: var(--colorbacklineimpair2);
	--oblyon-pos-gap: 4px;
	--oblyon-pos-radius: calc(var(--oblyon-radius) + var(--oblyon-pos-gap));
}
html.oblyon-pos-styled body {
	background: var(--oblyon-pos-bg);
	color: var(--colortext);
}

/* En-tete */
html.oblyon-pos-styled .header,
html.oblyon-pos-styled .topnav {
	background: var(--colorbackhmenu1) !important;	/* colorful.css */
}
html.oblyon-pos-styled .topnav a,
html.oblyon-pos-styled div#moreinfo,
html.oblyon-pos-styled div#infowarehouse {
	color: var(--colortextbackhmenu);
}
html.oblyon-pos-styled .topnav-left a:hover:not(.nohover),
html.oblyon-pos-styled .topnav .login_block_other a:hover:not(.nohover) {
	background-color: rgba(255, 255, 255, .18);
	color: var(--colortextbackhmenu);
}
html.oblyon-pos-styled .topnav input[type="text"] {
	border: 0;
	border-radius: var(--oblyon-radius-pill);
	padding: 4px 14px;
}

/* Ticket */
html.oblyon-pos-styled div#poslines {
	background: var(--oblyon-pos-card);
	border: var(--oblyon-pos-gap) solid var(--oblyon-pos-bg);
	border-radius: var(--oblyon-pos-radius);
	box-shadow: inset 0 0 0 1px var(--oblyon-border);
}
html.oblyon-pos-styled table.postablelines tr.liste_titre td {
	background: var(--oblyon-pos-card);
	border-bottom: 2px solid var(--oblyon-border);
	color: var(--oblyon-muted-text);
	font-weight: 600;
}
html.oblyon-pos-styled #linecolht-span-total {
	font-size: 1.9em !important;	/* style en ligne d'invoice.php (1.3em) */
	color: var(--colortext);
}
html.oblyon-pos-styled .posinvoiceline td {
	height: 48px !important;	/* pos.css.php : 40px !important */
	background-color: var(--oblyon-pos-card);
	border-bottom: 1px solid var(--oblyon-border);
	font-size: 1.05em;
}
html.oblyon-pos-styled tr.selected,
html.oblyon-pos-styled tr.selected td {
	background-color: var(--oblyon-accent-tint-strong) !important;	/* pos.css.php et colorful.css */
	color: var(--colortext) !important;	/* colorful.css */
}
html.oblyon-pos-styled tr.selected td:first-child {
	box-shadow: inset 4px 0 0 var(--colorbackhmenu1);
}
/* Edition rapide : selecteur de quantite [ - ] 1 [ + ] dans la colonne Qte (boutons ajoutes par le hook completeTakePosInvoiceLine,
   contexte takeposinvoice, puis places dans la colonne Qte par js/takepos.js) ; le - devient une corbeille rouge a une quantite de 1 */
html.oblyon-pos-styled td.oblyon-pos-qtycell {
	text-align: center !important;
	white-space: nowrap;
}
html.oblyon-pos-styled td.oblyon-pos-linectl {
	width: 1%;
	white-space: nowrap;	/* repli : boutons dans leur propre colonne si l'en-tete du ticket n'est pas reconnu */
}
html.oblyon-pos-styled span.oblyon-pos-stepper {
	display: inline-flex;
	align-items: center;
	gap: 2px;
	padding: 2px;
	border-radius: var(--oblyon-radius-pill);
	background: var(--oblyon-pos-bg);
	box-shadow: inset 0 0 0 1px var(--oblyon-border);
	vertical-align: middle;
}
html.oblyon-pos-styled span.oblyon-pos-qtyval {
	min-width: 2em;
	padding: 0 2px;
	text-align: center;
	font-size: 15px;
	font-weight: 700;
	color: var(--colortext);
}
html.oblyon-pos-styled button.oblyon-pos-qtybtn {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: 30px;
	height: 30px;
	margin: 0;
	padding: 0;
	border: 0;
	border-radius: 50%;
	background: var(--oblyon-pos-card);
	box-shadow: inset 0 0 0 1px var(--oblyon-border);
	color: var(--colortext);
	font-size: 12px;
	line-height: 1;
	cursor: pointer;
	transition: transform var(--oblyon-transition);
}
html.oblyon-pos-styled button.oblyon-pos-qtybtn.oblyon-pos-plus {
	background: var(--colorbackhmenu1);
	box-shadow: none;
	color: var(--oblyon-on-accent);
}
html.oblyon-pos-styled button.oblyon-pos-qtybtn.oblyon-pos-isdelete {
	background: var(--oblyon-btn-delete-bg);	/* couleurs du bouton Supprimer du preset, comme la corbeille du pave */
	box-shadow: none;
	color: var(--oblyon-btn-delete-txt);
}
html.oblyon-pos-styled button.oblyon-pos-qtybtn span.fa {
	color: inherit !important;	/* le theme colore toutes les icones corbeille */
}
html.oblyon-pos-styled button.oblyon-pos-qtybtn .fa-trash:before {
	font-size: 1em;	/* pos.css.php agrandit toutes les corbeilles de 50 % */
}
html.oblyon-pos-styled button.oblyon-pos-qtybtn:active {
	transform: scale(.88);
}

/* Pave numerique (ecran de caisse, paiement, remise) : chiffres sur fond de carte, modes Qte / Prix / Remise sur la teinte d'accent,
   mode arme (.clicked) en couleur principale, C neutre, corbeille aux couleurs du bouton Supprimer du preset */
html.oblyon-pos-styled button.calcbutton,
html.oblyon-pos-styled button.calcbutton2,
html.oblyon-pos-styled button.calcbutton3 {
	box-sizing: border-box;
	border: var(--oblyon-pos-gap) solid var(--oblyon-pos-bg);
	border-radius: var(--oblyon-pos-radius);
	box-shadow: inset 0 0 0 1px var(--oblyon-border);
	transition: transform var(--oblyon-transition), filter var(--oblyon-transition);
}
html.oblyon-pos-styled button.calcbutton:active,
html.oblyon-pos-styled button.calcbutton2:active,
html.oblyon-pos-styled button.calcbutton3:active,
html.oblyon-pos-styled button.actionbutton:active {
	transform: scale(.97);
	filter: brightness(.92);
}
html.oblyon-pos-styled button.calcbutton {
	background-color: var(--oblyon-pos-card) !important;	/* colorful.css */
	color: var(--colortext);
	font-size: 24px;
	font-weight: 600;
}
html.oblyon-pos-styled button.calcbutton.poscolorblue {
	background-color: var(--oblyon-pos-bg) !important;	/* colorful.css */
	color: var(--oblyon-muted-text);
}
html.oblyon-pos-styled button.calcbutton2 {
	background-color: var(--oblyon-accent-tint-strong) !important;	/* colorful.css */
	color: var(--colortext);
	font-size: 15px;
	font-weight: 700;
}
html.oblyon-pos-styled button.calcbutton2.clicked {
	background-color: var(--colorbackhmenu1) !important;
	color: var(--oblyon-on-accent);
	box-shadow: none;
}
html.oblyon-pos-styled button.calcbutton2.poscolordelete {
	background-color: var(--oblyon-btn-delete-bg) !important;	/* colorful.css */
	color: var(--oblyon-btn-delete-txt) !important;	/* colorful.css */
	box-shadow: none;
}
html.oblyon-pos-styled button.calcbutton2.poscolordelete .fa-trash {
	color: inherit !important;	/* colorful.css */
}

/* Boutons d'action : cartes, icone en couleur principale ; Reglement (CloseBill) en couleur principale pleine */
html.oblyon-pos-styled button.actionbutton {
	box-sizing: border-box;
	background: var(--oblyon-pos-card) !important;	/* colorful.css */
	color: var(--colortext);
	border: var(--oblyon-pos-gap) solid var(--oblyon-pos-bg);
	border-radius: var(--oblyon-pos-radius);
	box-shadow: inset 0 0 0 1px var(--oblyon-border);
	font-size: 13px;
	font-weight: 600;
	transition: transform var(--oblyon-transition), filter var(--oblyon-transition);
}
html.oblyon-pos-styled button.actionbutton span[class*="fa-"] {
	color: var(--colorbackhmenu1);
	font-size: 1.35em;
}
html.oblyon-pos-styled button.actionbutton[onclick^="CloseBill"] {
	background: var(--colorbackhmenu1) !important;	/* colorful.css */
	color: var(--oblyon-on-accent);
	box-shadow: none;
	font-size: 16px;
}
html.oblyon-pos-styled button.actionbutton[onclick^="CloseBill"] span[class*="fa-"] {
	color: inherit;
}

/* Tuiles categories et produits */
html.oblyon-pos-styled div.wrapper,
html.oblyon-pos-styled div.wrapper2 {
	background-color: var(--oblyon-pos-card);
	border: var(--oblyon-pos-gap) solid var(--oblyon-pos-bg);
	border-radius: var(--oblyon-pos-radius);
	box-shadow: inset 0 0 0 1px var(--oblyon-border);
	overflow: hidden;
}
html.oblyon-pos-styled div.wrapper.divempty,
html.oblyon-pos-styled div.wrapper2.divempty {
	background-color: transparent;
	box-shadow: none;
}
html.oblyon-pos-styled div.wrapper span.fa,
html.oblyon-pos-styled div.wrapper2.arrow span.fa {
	color: var(--colorbackhmenu1);
}
html.oblyon-pos-styled img.imgwrapper {
	object-fit: contain;
}
html.oblyon-pos-styled div.description {
	padding-top: 24px;
}
html.oblyon-pos-styled div.description_content,
html.oblyon-pos-styled div.description p.description_content {
	color: var(--colortext);
	font-size: 14px;
	font-weight: 600;
	line-height: 1.25;
}
html.oblyon-pos-styled .productprice {
	top: 6px;
	right: 6px;
	background: var(--colorbackhmenu1);
	color: var(--oblyon-on-accent);
	font-size: 13px;
	font-weight: 700;
	padding: 3px 9px;
	border-radius: var(--oblyon-radius-pill);
	box-shadow: var(--oblyon-shadow-sm);
	opacity: 1;
}

/* Fenetre de paiement (pay.php) : total sur la couleur principale, autres montants sur fond de carte (texte force en blanc par TakePOS) */
html.oblyon-pos-styled div.paymentbordline {
	background-color: var(--oblyon-pos-card);
	color: var(--colortext);
	border-radius: var(--oblyon-radius);
	box-shadow: inset 0 0 0 1px var(--oblyon-border);
}
html.oblyon-pos-styled div.paymentbordline .colorwhite {
	color: inherit;
}
html.oblyon-pos-styled div.paymentbordline.paymentbordlinetotal {
	background-color: var(--colorbackhmenu1);
	color: var(--oblyon-on-accent);
	box-shadow: none;
}
	<?php } ?>

	<?php if ($oblyon_pos_layout) { ?>
/* ---- Dispositions (Comptoir, Tablette, Superette) : socle commun ---- */
html.oblyon-pos-layout body.bodytakepos {
	height: 100%;
	overflow: hidden;	/* ecran de caisse seulement (body.bodytakepos) : jamais <html>, qui bloquerait le defilement d'une autre page */
}
html.oblyon-pos-layout body.bodytakepos div.container {
	display: grid;
	height: 100vh;
	box-sizing: border-box;
	padding: 0 12px 12px;
	gap: 12px;
	overflow: hidden;
}
html.oblyon-pos-layout body.bodytakepos div.row1,
html.oblyon-pos-layout body.bodytakepos div.row1withhead,
html.oblyon-pos-layout body.bodytakepos div.row2,
html.oblyon-pos-layout body.bodytakepos div.row2withhead {
	display: contents;
}
html.oblyon-pos-layout body.bodytakepos div.header {
	grid-area: header;
	width: auto;
	height: 56px;
	margin: 0 -12px;
}
html.oblyon-pos-layout body.bodytakepos div.div1,
html.oblyon-pos-layout body.bodytakepos div.div2,
html.oblyon-pos-layout body.bodytakepos div.div3,
html.oblyon-pos-layout body.bodytakepos div.div4,
html.oblyon-pos-layout body.bodytakepos div.div5 {
	float: none;
	width: auto;
	height: auto;
	min-width: 0;
	min-height: 0;
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}
html.oblyon-pos-layout body.bodytakepos div.div2 {
	grid-area: numpad;
}
html.oblyon-pos-layout body.bodytakepos div.div3 {
	grid-area: tools;
}
html.oblyon-pos-layout body.bodytakepos div.div4 {
	grid-area: cats;
}
html.oblyon-pos-layout body.bodytakepos div.div5 {
	grid-area: prods;
}
html.oblyon-pos-layout body.bodytakepos div.catwatermark {
	display: none !important;	/* style en ligne pose par TakePOS (show) */
}

/* Ticket : carte pleine hauteur, en-tete collant ; le total passe dans la barre de paiement */
html.oblyon-pos-layout body.bodytakepos div#poslines {
	grid-area: ticket;
	overflow-y: auto;
	border: 0;
	border-radius: var(--oblyon-radius);
	box-shadow: var(--oblyon-shadow-sm), inset 0 0 0 1px var(--oblyon-border);
}
html.oblyon-pos-layout body.bodytakepos div#poslines table.postablelines tr.liste_titre td {
	position: sticky;
	top: 0;
	z-index: 1;
}
html.oblyon-pos-layout body.bodytakepos div#poslines tr.liste_titre td.linecolht,
html.oblyon-pos-layout body.bodytakepos div#poslines tr.liste_titre td.linecolht * {
	color: transparent !important;	/* total affiche dans la barre de paiement (texte lu par js/takepos.js) */
}
html.oblyon-pos-layout body.bodytakepos div#poslines tr.liste_titre td {
	border-bottom: 1px solid var(--oblyon-border) !important;	/* meme filet sous toutes les cellules de l'en-tete, colonne du total comprise */
}
html.oblyon-pos-layout body.bodytakepos div#poslines .posinvoiceline td {
	height: 52px !important;	/* pos.css.php : 40px !important */
	font-size: 15px;
}

/* Boutons d'action : barre compacte (icone + libelle), 4 par rangee */
html.oblyon-pos-layout body.bodytakepos div.div3 {
	display: flex;
	flex-wrap: wrap;
	align-content: flex-start;
	gap: 6px;
}
html.oblyon-pos-layout body.bodytakepos div.div3 button.actionbutton {
	flex: 1 1 calc(25% - 6px);
	width: auto;
	height: 46px;
	min-height: 46px;
	margin: 0;
	padding: 0 6px;
	border: 0;
	border-radius: var(--oblyon-radius);
	display: inline-flex;
	align-items: center;
	justify-content: center;
	gap: 6px;
	font-size: 12px;
	line-height: 1.15;
}
html.oblyon-pos-layout body.bodytakepos div.div3 button.actionbutton span[class*="fa-"] {
	font-size: 1.2em;
}

/* Barre de paiement (creee par js/takepos.js) : remises en un appui, pave, total, bouton Reglement de TakePOS */
html.oblyon-pos-layout body.bodytakepos div.oblyon-pos-paybar {
	grid-area: paybar;
	display: flex;
	flex-direction: column;
	gap: 10px;
	padding: 12px;
	background: var(--oblyon-pos-card);
	border-radius: var(--oblyon-radius);
	box-shadow: var(--oblyon-shadow-sm), inset 0 0 0 1px var(--oblyon-border);
}
html.oblyon-pos-layout body.bodytakepos div.oblyon-pos-quick {
	display: flex;
	gap: 6px;
}
html.oblyon-pos-layout body.bodytakepos div.oblyon-pos-quick button {
	flex: 1 1 0;
	height: 44px;
	border: 0;
	border-radius: var(--oblyon-radius-pill);
	background: var(--oblyon-accent-tint-strong);
	color: var(--colortext);
	font-size: 15px;
	font-weight: 700;
	cursor: pointer;
	transition: transform var(--oblyon-transition);
}
html.oblyon-pos-layout body.bodytakepos div.oblyon-pos-quick button:active {
	transform: scale(.95);
}
html.oblyon-pos-layout.oblyon-pos-numpad-open body.bodytakepos button.oblyon-pos-numpadbtn {
	background: var(--colorbackhmenu1);
	color: var(--oblyon-on-accent);
}
html.oblyon-pos-layout body.bodytakepos div.oblyon-pos-total {
	display: flex;
	align-items: baseline;
	justify-content: space-between;
	color: var(--oblyon-muted-text);
	font-size: 15px;
	font-weight: 600;
}
html.oblyon-pos-layout body.bodytakepos span.oblyon-pos-total-value {
	color: var(--colortext);
	font-size: 32px;
	font-weight: 800;
}
html.oblyon-pos-layout body.bodytakepos div.oblyon-pos-paybar button.oblyon-pos-pay {
	width: 100%;
	height: 64px;
	margin: 0;
	padding: 0 20px;
	border: 0;
	border-radius: var(--oblyon-radius);
	display: flex;
	align-items: center;
	gap: 12px;
	font-size: 20px;
	font-weight: 800;
}
html.oblyon-pos-layout body.bodytakepos button.oblyon-pos-pay div.trunc {
	overflow: visible;
}
html.oblyon-pos-layout body.bodytakepos span.oblyon-pos-pay-amount {
	margin-left: auto;
}

/* Apres le paiement (js/takepos.js) : barre « Vente terminee » en tete de la barre de paiement, boutons d'impression du ticket paye recopies,
   bouton Nouvelle vente avec compte a rebours ; pendant cet etat, remises et bouton Reglement sont masques. Apres la nouvelle vente, seuls
   les boutons de reimpression restent, jusqu'au premier article */
html.oblyon-pos-done.oblyon-pos-layout body.bodytakepos div.oblyon-pos-paybar button.oblyon-pos-pay,
html.oblyon-pos-done.oblyon-pos-layout body.bodytakepos div.oblyon-pos-quick {
	display: none;
}
html.oblyon-pos-layout body.bodytakepos div.oblyon-pos-donebar {
	display: flex;
	flex-direction: column;
	gap: 8px;
}
html.oblyon-pos-layout body.bodytakepos div.oblyon-pos-done-title {
	color: var(--colortext);
	font-size: 16px;
	font-weight: 700;
}
html.oblyon-pos-layout body.bodytakepos div.oblyon-pos-done-title span.fa {
	color: var(--colorbackhmenu1);
}
html.oblyon-pos-layout:not(.oblyon-pos-done) body.bodytakepos div.oblyon-pos-done-title {
	display: none;
}
html.oblyon-pos-layout body.bodytakepos div.oblyon-pos-reprint {
	display: flex;
	flex-wrap: wrap;
	gap: 6px;
}
html.oblyon-pos-layout body.bodytakepos div.oblyon-pos-reprint:empty {
	display: none;
}
html.oblyon-pos-layout body.bodytakepos button.oblyon-pos-reprintbtn {
	flex: 1 1 auto;
	height: 40px;
	padding: 0 14px;
	border: 0;
	border-radius: var(--oblyon-radius-pill);
	background: var(--oblyon-accent-tint-strong);
	color: var(--colortext);
	font-size: 14px;
	font-weight: 600;
	cursor: pointer;
}
html.oblyon-pos-layout body.bodytakepos button.oblyon-pos-newsale {
	width: 100%;
	height: 64px;
	border: 0;
	border-radius: var(--oblyon-radius);
	background: var(--colorbackhmenu1);
	color: var(--oblyon-on-accent);
	font-size: 20px;
	font-weight: 800;
	cursor: pointer;
}

/* Pave numerique des dispositions : grille 4 x 4, boutons sans bordure-gouttiere */
html.oblyon-pos-layout body.bodytakepos div.div2 button.calcbutton,
html.oblyon-pos-layout body.bodytakepos div.div2 button.calcbutton2 {
	width: auto;
	height: auto;
	margin: 0;
	border: 0;
	border-radius: var(--oblyon-radius);
}

/* Grille des produits (Comptoir, Tablette) : tuiles carte, image, libelle sur deux lignes, prix en pastille */
html.oblyon-pos-counter body.bodytakepos div.div5,
html.oblyon-pos-tablet body.bodytakepos div.div5 {
	display: grid;
	grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
	grid-auto-rows: 178px;
	gap: 10px;
	align-content: start;
	overflow-y: auto;
	padding: 2px;
	font-size: 14px;
}
html.oblyon-pos-layout body.bodytakepos div.div5 div.wrapper2 {
	float: none;
	width: auto;
	height: auto;
	margin: 0;
	padding: 10px 8px 0;
	border: 0;
	border-radius: var(--oblyon-radius);
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: flex-start;
	cursor: pointer;
}
html.oblyon-pos-layout body.bodytakepos div.div5 div.wrapper2.divempty {
	display: none;
}
html.oblyon-pos-layout body.bodytakepos div.div5 div.wrapper2 img.imgwrapper {
	flex: 0 0 auto;
	width: 100%;
	height: 96px;
	object-fit: contain;
}
html.oblyon-pos-layout body.bodytakepos div.div5 div.wrapper2 div.description {
	left: 0;
	right: 0;
	bottom: 0;
	width: auto;
	padding: 0 8px 10px;
	background: none;
}
html.oblyon-pos-layout body.bodytakepos div.div5 div.wrapper2 div.description_content {
	font-size: 13.5px;
	-webkit-line-clamp: 2;
}
html.oblyon-pos-layout body.bodytakepos div.div5 div.wrapper2.arrow span.fa,
html.oblyon-pos-layout body.bodytakepos div.div4 div.wrapper span.fa {
	font-size: 24px !important;	/* style en ligne de TakePOS (5em) */
	margin: auto;
}
html.oblyon-pos-layout body.bodytakepos div.div5 .productprice {
	top: 8px;
	right: 8px;
}

/* Categories en onglets defilants (Comptoir, Superette) : pastille image + libelle, onglet actif cerne de la couleur principale */
html.oblyon-pos-counter body.bodytakepos div.div4,
html.oblyon-pos-scanner body.bodytakepos div.div4 {
	display: flex;
	gap: 8px;
	overflow-x: auto;
	overflow-y: hidden;
	padding: 2px;
	font-size: 15px;
	scrollbar-width: thin;
}
html.oblyon-pos-counter body.bodytakepos div.div4 div.wrapper,
html.oblyon-pos-scanner body.bodytakepos div.div4 div.wrapper {
	flex: 0 0 auto;
	float: none;
	width: auto;
	min-width: 120px;
	height: 56px;
	margin: 0;
	padding: 0 18px 0 6px;
	border: 0;
	border-radius: var(--oblyon-radius-pill);
	display: flex;
	align-items: center;
	justify-content: flex-start;
	gap: 10px;
	cursor: pointer;
}
html.oblyon-pos-counter body.bodytakepos div.div4 div.wrapper.divempty,
html.oblyon-pos-scanner body.bodytakepos div.div4 div.wrapper.divempty {
	display: none;
}
html.oblyon-pos-counter body.bodytakepos div.div4 div.wrapper:has(> span.fa),
html.oblyon-pos-scanner body.bodytakepos div.div4 div.wrapper:has(> span.fa) {
	min-width: 56px;
	padding: 0;
	justify-content: center;
}
html.oblyon-pos-counter body.bodytakepos div.div4 div.wrapper img.imgwrapper,
html.oblyon-pos-scanner body.bodytakepos div.div4 div.wrapper img.imgwrapper {
	flex: 0 0 auto;
	width: 44px;
	height: 44px;
	border-radius: 50%;
	object-fit: cover;
}
html.oblyon-pos-counter body.bodytakepos div.div4 div.wrapper div.description,
html.oblyon-pos-scanner body.bodytakepos div.div4 div.wrapper div.description {
	position: static;
	width: auto;
	padding: 0;
	background: none;
	text-align: left;
	white-space: nowrap;
}
html.oblyon-pos-counter body.bodytakepos div.div4 div.wrapper div.description_content,
html.oblyon-pos-scanner body.bodytakepos div.div4 div.wrapper div.description_content {
	font-size: 15px;
	font-weight: 700;
	-webkit-line-clamp: 1;
}
html.oblyon-pos-counter body.bodytakepos div.div4 div.wrapper.oblyon-pos-activecat,
html.oblyon-pos-scanner body.bodytakepos div.div4 div.wrapper.oblyon-pos-activecat {
	box-shadow: inset 0 0 0 3px var(--colorbackhmenu1);
}
html.oblyon-pos-catcolors.oblyon-pos-counter body.bodytakepos div.div4 div.wrapper.oblyon-pos-hascat,
html.oblyon-pos-catcolors.oblyon-pos-scanner body.bodytakepos div.div4 div.wrapper.oblyon-pos-hascat {
	background: var(--oblyon-pos-cat);
	box-shadow: none;
}
html.oblyon-pos-catcolors.oblyon-pos-counter body.bodytakepos div.div4 div.wrapper.oblyon-pos-hascat div.description,
html.oblyon-pos-catcolors.oblyon-pos-scanner body.bodytakepos div.div4 div.wrapper.oblyon-pos-hascat div.description {
	padding: 0;
	background: none;
}
html.oblyon-pos-catcolors.oblyon-pos-counter body.bodytakepos div.div4 div.wrapper.oblyon-pos-hascat div.description_content,
html.oblyon-pos-catcolors.oblyon-pos-scanner body.bodytakepos div.div4 div.wrapper.oblyon-pos-hascat div.description_content {
	color: #fff;
	text-shadow: 0 1px 2px rgba(0, 0, 0, .35);
}
html.oblyon-pos-catcolors.oblyon-pos-counter body.bodytakepos div.div4 div.wrapper.oblyon-pos-hascat.oblyon-pos-activecat,
html.oblyon-pos-catcolors.oblyon-pos-scanner body.bodytakepos div.div4 div.wrapper.oblyon-pos-hascat.oblyon-pos-activecat {
	box-shadow: 0 0 0 3px var(--oblyon-pos-bg), 0 0 0 5px var(--oblyon-pos-cat);
}

/* Pave en panneau (Comptoir, Superette) : masque, ouvert par le bouton calculatrice, Alt+N, ou en touchant une ligne (Comptoir) */
html.oblyon-pos-counter body.bodytakepos div.div2,
html.oblyon-pos-scanner body.bodytakepos div.div2 {
	display: none;
}
html.oblyon-pos-counter.oblyon-pos-numpad-open body.bodytakepos div.div2,
html.oblyon-pos-scanner.oblyon-pos-numpad-open body.bodytakepos div.div2 {
	display: grid;
	position: fixed;
	z-index: 60;
	right: calc(var(--oblyon-pos-side) + 24px);
	bottom: 12px;
	width: 360px;
	height: 380px;
	padding: 46px 10px 10px;
	box-sizing: border-box;
	grid-template-columns: repeat(4, 1fr);
	grid-auto-rows: 1fr;
	gap: 6px;
	background: var(--oblyon-pos-card);
	border-radius: var(--oblyon-radius);
	box-shadow: var(--oblyon-shadow-lg), inset 0 0 0 1px var(--oblyon-border);
}
html.oblyon-pos-layout body.bodytakepos button.oblyon-pos-padclose {
	position: absolute;
	top: 8px;
	right: 8px;
	width: 32px;
	height: 32px;
	border: 0;
	border-radius: 50%;
	background: var(--oblyon-pos-bg);
	color: var(--oblyon-muted-text);
	font-size: 15px;
	cursor: pointer;
}

		<?php if ($oblyon_pos_layout == 'counter') { ?>
/* ---- Comptoir : categories en onglets, grande grille de produits, ticket a droite avec actions et barre de paiement ---- */
html.oblyon-pos-counter {
	--oblyon-pos-side: clamp(330px, 30vw, 440px);
}
html.oblyon-pos-counter body.bodytakepos div.container {
	grid-template-columns: minmax(0, 1fr) var(--oblyon-pos-side);
	grid-template-rows: auto auto minmax(0, 1fr) auto auto;
	grid-template-areas: "header header" "cats ticket" "prods ticket" "prods tools" "prods paybar";
}
		<?php } elseif ($oblyon_pos_layout == 'tablet') { ?>
/* ---- Tablette : grille des categories puis grille des produits (bouton de retour), ticket, pave toujours visible et paiement a droite ---- */
html.oblyon-pos-tablet {
	--oblyon-pos-side: clamp(340px, 36vw, 480px);
}
html.oblyon-pos-tablet body.bodytakepos div.container {
	grid-template-columns: minmax(0, 1fr) var(--oblyon-pos-side);
	grid-template-rows: auto auto minmax(0, 1fr) auto auto;
	grid-template-areas: "header header" "cats tools" "cats ticket" "cats numpad" "cats paybar";
}
html.oblyon-pos-tablet body.bodytakepos div.div4,
html.oblyon-pos-tablet body.bodytakepos div.div5 {
	grid-area: cats;
}
html.oblyon-pos-tablet body.bodytakepos div.div4 {
	display: grid;
	grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
	grid-auto-rows: 168px;
	gap: 12px;
	align-content: start;
	overflow-y: auto;
	padding: 2px;
	font-size: 16px;
}
html.oblyon-pos-tablet body.bodytakepos div.div4 div.wrapper {
	float: none;
	width: auto;
	height: auto;
	margin: 0;
	border: 0;
	border-radius: var(--oblyon-radius);
	cursor: pointer;
}
html.oblyon-pos-tablet body.bodytakepos div.div4 div.wrapper.divempty {
	display: none;
}
html.oblyon-pos-tablet body.bodytakepos div.div4 div.wrapper img.imgwrapper {
	width: 100%;
	height: 100%;
	object-fit: cover;
}
html.oblyon-pos-tablet body.bodytakepos div.div4 div.wrapper div.description_content {
	font-size: 16px;
	font-weight: 700;
}
html.oblyon-pos-tablet body.bodytakepos div.div5 {
	display: none;
	grid-template-rows: 48px;	/* premiere rangee = barre de retour, les suivantes = tuiles (grid-auto-rows) */
}
html.oblyon-pos-tablet.oblyon-pos-show-products body.bodytakepos div.div5 {
	display: grid;
}
html.oblyon-pos-tablet.oblyon-pos-show-products body.bodytakepos div.div4 {
	display: none;
}
html.oblyon-pos-tablet body.bodytakepos div.oblyon-pos-back {
	grid-column: 1 / -1;
	display: flex;
	align-items: center;
	gap: 14px;
	font-size: 18px;
	font-weight: 700;
	color: var(--colortext);
}
html.oblyon-pos-tablet body.bodytakepos div.oblyon-pos-back button {
	height: 44px;
	padding: 0 18px;
	border: 0;
	border-radius: var(--oblyon-radius-pill);
	background: var(--oblyon-accent-tint-strong);
	color: var(--colortext);
	font-size: 15px;
	font-weight: 700;
	cursor: pointer;
}
html.oblyon-pos-tablet body.bodytakepos div.div2 {
	display: grid;
	grid-template-columns: repeat(4, 1fr);
	grid-auto-rows: 50px;
	gap: 6px;
}
		<?php } else { ?>
/* ---- Superette : grand champ de scan, ticket en tableau large, paiement et aide clavier a droite, categories et produits en bandeau ---- */
html.oblyon-pos-scanner {
	--oblyon-pos-side: 330px;
}
html.oblyon-pos-scanner body.bodytakepos div.container {
	grid-template-columns: minmax(0, 1fr) var(--oblyon-pos-side);
	grid-template-rows: auto auto auto minmax(0, 1fr) auto 132px;
	grid-template-areas: "header header" "ticket paybar" "ticket tools" "ticket keys" "cats cats" "prods prods";
}
html.oblyon-pos-scanner body.bodytakepos .topnav input[type="text"] {
	width: 38vw;
	max-width: 560px;
	height: 40px;
	font-size: 20px;
}
html.oblyon-pos-scanner body.bodytakepos div#poslines .posinvoiceline td {
	height: 46px !important;	/* pos.css.php : 40px !important */
	font-size: 16px;
}
html.oblyon-pos-scanner body.bodytakepos div.div3 button.actionbutton {
	flex-basis: calc(50% - 6px);
	height: 40px;
	min-height: 40px;
}
html.oblyon-pos-scanner body.bodytakepos div.div5 {
	display: flex;
	gap: 8px;
	overflow-x: auto;
	overflow-y: hidden;
	padding: 2px;
	font-size: 13px;
	scrollbar-width: thin;
}
html.oblyon-pos-scanner body.bodytakepos div.div5 div.wrapper2 {
	flex: 0 0 150px;
	padding-top: 8px;
}
html.oblyon-pos-scanner body.bodytakepos div.div5 div.wrapper2 img.imgwrapper {
	height: 58px;
}
html.oblyon-pos-scanner body.bodytakepos div.oblyon-pos-keys {
	grid-area: keys;
	overflow-y: auto;
	padding: 12px;
	background: var(--oblyon-pos-card);
	border-radius: var(--oblyon-radius);
	box-shadow: inset 0 0 0 1px var(--oblyon-border);
	font-size: 13px;
}
html.oblyon-pos-scanner body.bodytakepos div.oblyon-pos-keys-title {
	margin-bottom: 8px;
	color: var(--oblyon-muted-text);
	font-weight: 700;
}
html.oblyon-pos-scanner body.bodytakepos div.oblyon-pos-key {
	display: flex;
	align-items: center;
	gap: 10px;
	padding: 3px 0;
}
html.oblyon-pos-scanner body.bodytakepos div.oblyon-pos-key kbd {
	flex: 0 0 76px;
	padding: 2px 6px;
	border-radius: var(--oblyon-radius-sm);
	background: var(--oblyon-pos-bg);
	box-shadow: inset 0 -2px 0 var(--oblyon-border);
	font-family: inherit;
	font-size: 12px;
	font-weight: 700;
	text-align: center;
}
html.oblyon-pos-scanner body.bodytakepos div.oblyon-pos-keys-hint {
	margin-top: 8px;
	color: var(--oblyon-muted-text);
	font-size: 12px;
}
		<?php } ?>

/* Ecrans etroits (tablette en portrait, petit ordinateur) : une seule colonne, ticket sous les produits ; pave en panneau pleine largeur */
@media only screen and (max-width: 900px) {
	html.oblyon-pos-layout body.bodytakepos div.container {
		grid-template-columns: minmax(0, 1fr);
		grid-template-rows: auto auto minmax(0, 1fr) minmax(0, 30vh) auto auto;
		grid-template-areas: "header" "cats" "prods" "ticket" "tools" "paybar";
	}
	html.oblyon-pos-tablet body.bodytakepos div.div4,
	html.oblyon-pos-tablet body.bodytakepos div.div5 {
		grid-area: prods;
	}
	html.oblyon-pos-tablet body.bodytakepos div.div2,
	html.oblyon-pos-scanner body.bodytakepos div.oblyon-pos-keys {
		display: none;
	}
	html.oblyon-pos-layout.oblyon-pos-numpad-open body.bodytakepos div.div2 {
		right: 12px;
		left: 12px;
		width: auto;
	}
}
	<?php } ?>
<?php } ?>
