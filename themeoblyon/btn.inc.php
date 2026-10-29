<?php
if (!defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/btn.inc.php
   Role      : Boutons d'action, boutons de formulaire, paiement
   Inclus par : cards.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */


/* ===== Boutons form/submit + paiement - deplaces depuis global.inc.php ===== */

input[type=submit], input[type=submit]:hover {
	margin-left: 5px;
}

input.button:hover {
	-webkit-box-shadow: 0px 0px 6px 1px rgb(50 50 50 / 40%), 0px 0px 0px rgb(60 60 60 / 10%);
	box-shadow: 0px 0px 6px 1px rgb(50 50 50 / 40%), 0px 0px 0px rgb(60 60 60 / 10%);
}

input.button:focus {
	border-bottom: 0;
}

input.button.massactionconfirmed {
	margin: 4px;
}

input.buttongen {
	vertical-align: middle;
}

input.buttonpayment, button.buttonpayment, div.buttonpayment {
	min-width: 290px;
	margin-bottom: 15px;
	margin-top: 15px;
	height: 64px;
	background-image: none;
	line-height: 24px;
	padding: 8px;
	background: none;
	text-align: center;
	border: 0;
	background-color: #9999bb;
	white-space: normal;
	box-shadow: 1px 1px 4px #bbb;
	color: #fff;
	border-radius: 4px;
	cursor: pointer;
	max-width: 350px;
}

div.buttonpayment input:focus {
	color: #008;
}

.buttonpaymentsmall {
	font-size: 0.65em;
	padding-left: 5px;
	padding-right: 5px;
}

div.buttonpayment input {
	background-color: unset;
	color: #fff;
	border-bottom: unset;
	font-weight: bold;
	text-transform: uppercase;
	cursor: pointer;
}

input.buttonpaymentcb {
	background-image: url(<?php print dol_buildpath($path.'/theme/common/credit_card.png',1) ?>);
	background-size: 26px;
	background-repeat: no-repeat;
	background-position: 5px 5px;
}

input.buttonpaymentcheque {
	background-image: url(<?php print dol_buildpath($path.'/theme/common/cheque.png',1) ?>);
	background-repeat: no-repeat;
	background-position: 8px 7px;
}

input.buttonpaymentpaypal {
	background-image: url(<?php print dol_buildpath($path.'/paypal/img/object_paypal.png',1) ?>);
	background-repeat: no-repeat;
	background-position: 8px 7px;
}

input.buttonpaymentpaybox {
	background-image: url(<?php print dol_buildpath($path.'/paybox/img/object_paybox.png',1) ?>);
	background-repeat: no-repeat;
	background-position: 8px 7px;
}

input.buttonpaymentstripe {
	background-image: url(<?php print dol_buildpath($path.'/stripe/img/object_stripe.png',1) ?>);
	background-repeat: no-repeat;
	background-position: 8px 7px;
}

/* ===== Boutons generiques (.button/.buttonRefused/.buttonajax) - deplaces depuis global.inc.php ===== */

.button, .buttonDelete, input[name="sbmtConnexion"] {
	margin-bottom: 0;
	margin-top: 0;
	margin-left: 5px;
	margin-right: 5px;
	font-family: var(--fontfamilydol);
	display: inline-block;
	padding: 4px 14px;
	text-align: center;
	cursor: pointer;
	text-decoration: none !important;
	/* InfraS change begin : bloc structurel uniquement (les couleurs viennent des regles .button / .buttonDelete ci-dessous), rayon et ombre des jetons */
	border: none;
	border-radius: var(--oblyon-radius-sm);
	font-weight: 600;
	transition: background-color var(--oblyon-transition), box-shadow var(--oblyon-transition), color var(--oblyon-transition);
}
.button:hover, .buttonDelete:hover   {
	box-shadow: var(--oblyon-shadow-md);
}
/* InfraS change end */
.button:disabled, .buttonDelete:disabled, .button.disabled {
	opacity: 0.4;
	box-shadow: none;
	-webkit-box-shadow: none;
	cursor: auto;
}
.buttonRefused {
	pointer-events: none;
	cursor: default;
	opacity: 0.4;
	box-shadow: none;
	-webkit-box-shadow: none;
}

.button,
.button:link,
.button:active,
.button:visited {
	background-color: var(--colorButtonAction1);
	/* border: 1px solid #c0c0c0; */
	/* border-color: var(--colorButtonAction1); */
	/* box-shadow: inset 0 1px 0 rgba(235,235,235, .6); */
	/* -webkit-box-shadow: inset 0 1px 0 rgba(235,235,235, .6); */
	/* -webkit-border-radius: 0.30em; */
	/* -moz-border-radius: 0.30em; */
	border: none;
	/* InfraS change begin : rayon et transition des jetons, taille de police heritee */
	border-radius: var(--oblyon-radius-sm);
	color: var(--colorTextButtonAction);
	cursor: pointer;
	font-size: var(--fontsize);
	margin: .2em .5em;
	/* margin: 2px 1px; */
	padding: .5em 1em;
	transition: background-color var(--oblyon-transition), box-shadow var(--oblyon-transition), color var(--oblyon-transition);
}

.button:hover, .button:focus {
	background-color: var(--colorButtonAction2);
	border-color: var(--colorButtonAction2);
	box-shadow: var(--oblyon-shadow-md);
	color: var(--colorTextButtonAction);
}

.button:disabled {
	background-color: var(--oblyon-neutral-bg);
	color: var(--oblyon-muted-text);
	cursor: not-allowed;
}
/* InfraS change end */

.buttonajax {
	background-image: var(--img_button);
	background-position: bottom;
	border: 0;
	border-radius: 0 5px 0 5px;
	-moz-border-radius: 0 5px 0 5px;
	-webkit-border-radius: 0 5px 0 5px;
	box-shadow: 4px 4px 4px rgba(0,0,0, .24);
	-moz-box-shadow: 4px 4px 4px rgba(0,0,0, .24);
	-webkit-box-shadow: 4px 4px 4px rgba(0,0,0, .24);
	margin: 0em .5em;
	padding: .1em .7em;
}

/* ============================================================================== */
/* Buttons for actions                                                            */
/* ============================================================================== */

/*div.divButAction {
    margin-bottom: 1.4em;
}*/
div.tabsAction > a.butAction, div.tabsAction > a.butActionRefused, div.tabsAction > a.butActionDelete,
div.tabsAction > span.butAction, div.tabsAction > span.butActionRefused, div.tabsAction > span.butActionDelete,
div.tabsAction > div.divButAction > span.butAction,
div.tabsAction > div.divButAction > span.butActionDelete,
div.tabsAction > div.divButAction > span.butActionRefused,
div.tabsAction > div.divButAction > a.butAction,
div.tabsAction > div.divButAction > a.butActionDelete,
div.tabsAction > div.divButAction > a.butActionRefused {
    margin-bottom: 1.4em !important;
    margin-right: 0 !important;
}
div.tabsActionNoBottom > a.butAction, div.tabsActionNoBottom > a.butActionRefused {
    margin-bottom: 0 !important;
}

span.butAction, span.butActionDelete {
    cursor: pointer;
}
.paginationafterarrows .butAction {
    font-size: 0.9em;
}
.butAction, .cke_dialog_ui_button_ok {
    background: var(--colorButtonAction1) !important;
}
:not(.center) > .butActionRefused:last-child, :not(.center) > .butAction:last-child, :not(.center) > .butActionDelete:last-child {
    margin-<?php echo $right; ?>: 0px !important;
}
.butActionRefused, .butAction, .butAction:link, .butAction:visited, .butAction:hover, .butAction:active, .butActionDelete, .butActionDelete:link, .butActionDelete:visited, .butActionDelete:hover, .butActionDelete:active {
    text-decoration: none;
    /* text-transform: uppercase; */
    font-weight: bold;

    margin: 0em <?php echo ($dol_optimize_smallscreen ? '0.6' : '0.9'); ?>em !important;
    padding: var(--oblyon-btn-py) <?php echo ($dol_optimize_smallscreen ? '0.6' : '0.7'); ?>em;	/* densite (3.8.0) */
    font-family: var(--fontlist);
    display: inline-block;
    text-align: center;
    cursor: pointer;
    color: var(--colorTextButtonAction);
    background: var(--colorButtonAction1);
    border: 0px;

    border-radius: var(--oblyon-radius-sm) !important;	/* InfraS change : 4 proprietes remplacees par le jeton de rayon */
}

.butActionNew, .butActionNewRefused, .butActionNew:link, .butActionNew:visited, .butActionNew:hover, .butActionNew:active {
    text-decoration: none;
    /* text-transform: capitalize; */
    font-weight: normal;

    margin: 0em 0.3em 0 0.3em !important;
    padding: 0.2em <?php echo ($dol_optimize_smallscreen ? '0.4' : '0.7'); ?>em 0.3em;
    font-family: var(--fontlist);
    display: inline-block;
    /* text-align: center; New button are on right of screen */
    background: var(--colorButtonAction2);
    cursor: pointer;
}

.tableforfieldcreate a.butActionNew>span.fa-plus-circle, .tableforfieldcreate a.butActionNew>span.fa-plus-circle:hover,
.tableforfieldedit a.butActionNew>span.fa-plus-circle, .tableforfieldedit a.butActionNew>span.fa-plus-circle:hover,
span.butActionNew>span.fa-plus-circle, span.butActionNew>span.fa-plus-circle:hover,
a.butActionNewRefused>span.fa-plus-circle, a.butActionNewRefused>span.fa-plus-circle:hover,
span.butActionNewRefused>span.fa-plus-circle, span.butActionNewRefused>span.fa-plus-circle:hover,
a.butActionNew>span.fa-list-alt, a.butActionNew>span.fa-list-alt:hover,
span.butActionNew>span.fa-list-alt, span.butActionNew>span.fa-list-alt:hover,
a.butActionNewRefused>span.fa-list-alt, a.butActionNewRefused>span.fa-list-alt:hover,
span.butActionNewRefused>span.fa-list-alt, span.butActionNewRefused>span.fa-list-alt:hover
{
	font-size: 1em;
	padding-left: 0px;
}

a.butActionNew>span.fa, a.butActionNew>span.fa:hover,
span.butActionNew>span.fa, span.butActionNew>span.fa:hover,
a.butActionNewRefused>span.fa, a.butActionNewRefused>span.fa:hover,
span.butActionNewRefused>span.fa, span.butActionNewRefused>span.fa:hover
{
	padding-<?php echo $left; ?>: 6px;
	font-size: 1.5em;
	border: none;
	box-shadow: none; webkit-box-shadow: none;
}

/* InfraS change begin : ombres des jetons ; bouton ouvert = couleur de survol (plus d'assombrissement par ombre interne) */
.butAction:hover, .cke_dialog_ui_button_ok:hover {
	background: var(--colorButtonAction2) !important;
    box-shadow: var(--oblyon-shadow-md);
}
.dropdown-holder.open > .butAction {
    background: var(--colorButtonAction2) !important;
    box-shadow: var(--oblyon-shadow-md);
}
/* InfraS change end */
.butActionNew:hover   {
    text-decoration: underline;
    box-shadow: unset !important;
}

.butActionDelete, .butActionDelete:link, .butActionDelete:visited, .butActionDelete:hover, .butActionDelete:active, .buttonDelete, .cke_dialog_ui_button_cancel, .ui-button {
	background: var(--colorButtonDelete1) !important;
    color: #ffffff;
}

.butActionDelete:hover, .cke_dialog_ui_button_cancel:hover, .ui-button:hover, .ui-button:focus {
	background: var(--colorButtonDelete2) !important;
    box-shadow: var(--oblyon-shadow-md);	/* InfraS change */
}

.butActionRefused {
    text-decoration: none !important;
    /* text-transform: capitalize; */
    font-weight: bold !important;

    white-space: nowrap !important;
    cursor: not-allowed !important;
    margin: 0em <?php echo ($dol_optimize_smallscreen ? '0.6' : '0.9'); ?>em;
    padding: var(--oblyon-btn-py) <?php echo ($dol_optimize_smallscreen ? '0.6' : '0.7'); ?>em;	/* densite (3.8.0) */
    font-family: var(--fontlist) !important;
    display: inline-block;
    text-align: center;
    cursor: pointer;
    /* InfraS change begin : bouton refuse = plat, gris neutre du preset, sans ombre */
    color: var(--oblyon-muted-text) !important;
    background: var(--oblyon-neutral-bg);
    border: 1px solid var(--oblyon-border);
    border-radius: var(--oblyon-radius-sm);
    box-sizing: border-box;
    box-shadow: none;
    /* InfraS change end */
}

.butActionNewRefused, .butActionNewRefused:link, .butActionNewRefused:visited, .butActionNewRefused:hover, .butActionNewRefused:active {
    text-decoration: none !important;
    /* text-transform: capitalize; */
    font-weight: normal !important;

    white-space: nowrap !important;
    cursor: not-allowed !important;
    margin: 0em <?php echo ($dol_optimize_smallscreen ? '0.7' : '0.9'); ?>em;
    padding: 0.2em <?php echo ($dol_optimize_smallscreen ? '0.4' : '0.7'); ?>em;
    font-family: var(--fontlist) !important;
    display: inline-block;
    /* text-align: center;  New button are on right of screen */
    cursor: pointer;
    color: var(--oblyon-muted-text) !important;	/* InfraS change */
    padding-top: 0.2em;
    box-shadow: none !important;
}

/* ===== Fusion 2026-07 : proprietes structurelles portees depuis l'ancien bloc .butAction de global.inc.php ===== */
/* (couleurs/marges/paddings de l'ancien bloc etaient deja ecrasees par les regles btn ci-dessus ; on ne garde que le vivant) */
.butActionRefused, .butAction, .butAction:link, .butAction:visited, .butAction:hover, .butAction:active, .butActionDelete, .butActionDelete:link, .butActionDelete:visited, .butActionDelete:hover, .butActionDelete:active, .butActionNewRefused {
	white-space: nowrap;
	/* InfraS change begin : transition unique des jetons, plus de reflets teintes (bleute / rose) ni d'ombre sur les boutons refuses */
	transition: background-color var(--oblyon-transition), box-shadow var(--oblyon-transition), color var(--oblyon-transition);
}
.butAction, .butActionDelete {
	box-shadow: none;
}
.butAction:active, .butActionDelete:active {
	box-shadow: var(--oblyon-shadow-sm);
}
.butActionNew:hover {
	color: #f7f7f7;
}
.butActionRefused {
	opacity: .7;
}
.butActionRefused:hover, .butActionRefused:active {
	background-color: var(--oblyon-neutral-bg);
}

.butActionTransparent {
    color: var(--colortext) ! important;
    background-color: transparent ! important;
}
/* InfraS change end */

<?php $oblyon_btn_custom = false; foreach (oblyon_button_families('filled', true) as $oblyon_btn_f) { foreach (array('border', 'txt_hover') as $oblyon_btn_r) { if (getDolGlobalString($oblyon_btn_f['colors'][$oblyon_btn_r]) && getDolGlobalString($oblyon_btn_f['colors'][$oblyon_btn_r]) != '#') $oblyon_btn_custom = true; } } if ($oblyon_button_style != 'filled' || getDolGlobalInt('OBLYON_BUTTON_FORM_OWN_COLORS') || $oblyon_btn_custom || (getDolGlobalString('OBLYON_COLOR_BUTTON_DELETE_TXT') && getDolGlobalString('OBLYON_COLOR_BUTTON_DELETE_TXT') != '#')) { ?>
/* couleurs des boutons par famille (3.8.0) : action / suppression / formulaire, chacune avec fond, texte, bordure, fond et texte au survol
   (jetons --oblyon-btn-<famille>-<role>, resolus selon OBLYON_BUTTON_STYLE dans style.css.php : contour = fond transparent + cadre, doux = fond teinte, pleins = defauts d'origine).
   Bloc imprime seulement quand il change quelque chose (style autre que pleins, couleurs propres de formulaire, ou une bordure / un texte de survol / un texte de Supprimer renseigne) :
   en pleins sans reglage, les regles d'origine ci-dessus suffisent et la feuille reste identique. Ecrit apres les regles d'origine avec les memes selecteurs et !important.
   Exclus : les entrees des listes deroulantes d'actions (.dropdown-content, style plat propre dans dropdown.inc.php), les boutons refuses (neutres), les boutons de paiement */
.butAction, .butAction:link, .butAction:visited, .butAction:active, .cke_dialog_ui_button_ok {
	background: var(--oblyon-btn-action-bg) !important;
	color: var(--oblyon-btn-action-txt) !important;
	border: 1px solid var(--oblyon-btn-action-border) !important;
	box-sizing: border-box;
}
.butAction:hover, .cke_dialog_ui_button_ok:hover, .dropdown-holder.open > .butAction {
	background: var(--oblyon-btn-action-bg-hover) !important;
	color: var(--oblyon-btn-action-txt-hover) !important;
<?php if ($oblyon_button_style != 'filled') { ?>
	box-shadow: none;
<?php } ?>
}
.butActionDelete, .butActionDelete:link, .butActionDelete:visited, .butActionDelete:active, .buttonDelete {
	background: var(--oblyon-btn-delete-bg) !important;
	color: var(--oblyon-btn-delete-txt) !important;
	border: 1px solid var(--oblyon-btn-delete-border) !important;
	box-sizing: border-box;
}
.butActionDelete:hover, .buttonDelete:hover {
	background: var(--oblyon-btn-delete-bg-hover) !important;
	color: var(--oblyon-btn-delete-txt-hover) !important;
<?php if ($oblyon_button_style != 'filled') { ?>
	box-shadow: none;
<?php } ?>
}
/* boutons de formulaire (.button : Enregistrer, Annuler, Rechercher, Creer...) : memes couleurs que les boutons d'action, ou couleurs propres (OBLYON_BUTTON_FORM_OWN_COLORS) */
.button, .button:link, .button:active, .button:visited, input.button, button.button {
	background-color: var(--oblyon-btn-form-bg) !important;
	color: var(--oblyon-btn-form-txt) !important;
	border: 1px solid var(--oblyon-btn-form-border) !important;
	box-sizing: border-box;
}
.button:hover, .button:focus, input.button:hover, button.button:hover {
	background-color: var(--oblyon-btn-form-bg-hover) !important;
	border-color: var(--oblyon-btn-form-border) !important;
	color: var(--oblyon-btn-form-txt-hover) !important;
<?php if ($oblyon_button_style != 'filled') { ?>
	box-shadow: none;
<?php } ?>
}
.button:disabled, .button.disabled {
	background-color: var(--oblyon-neutral-bg) !important;
	color: var(--oblyon-muted-text) !important;
	border-color: var(--oblyon-border) !important;
}
.dropdown-content .butAction, .dropdown-content a.butAction, .dropdown-content .butActionDelete {
	background: none !important;
	border: 0 !important;
	color: var(--colortext) !important;
}
.buttonpayment, input.buttonpayment, button.buttonpayment, div.buttonpayment, input.buttonreset, .button.bordertransp, .buttonRefused {
	border: 0 !important;
}
input.buttonreset {
	background-color: transparent !important;
	color: var(--colortextlink) !important;
}
<?php } ?>

/*
TITLE BUTTON
 */

.btnTitle, a.btnTitle {
    display: inline-block;
    padding: 4px 12px 4px 12px;
    font-weight: 400;
    /* line-height: 1; */
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    box-shadow: none;
    text-decoration: none;
    position: relative;
    margin: 0 0 0 10px;
    min-width: 80px;
    text-align: center;
    border: none;
    font-size: 12px;
    font-weight: 300;
}

a.btnTitle.btnTitleSelected {
    border: 1px solid var(--oblyon-border-strong);	/* InfraS change */
    border-radius: var(--oblyon-radius-sm);	/* InfraS change */
}

.btnTitle > .btnTitle-label {
    color: var(--oblyon-muted-text);	/* InfraS change */
}

.btnTitle:hover, a.btnTitle:hover {
	border: 0px;
    border-radius: var(--oblyon-radius-sm);	/* InfraS change */
    position: relative;
    margin: 0 0 0 10px;
    text-align: center;
    color: #ffffff;
    background-color: var(--colorButtonAction1);
    font-size: 12px;
    text-decoration: none;
    box-shadow: none;
}

.btnTitle.refused, a.btnTitle.refused, .btnTitle.refused:hover, a.btnTitle.refused:hover {
    color: #ffffff;
    cursor: not-allowed;
    background-color: var(--colorButtonDelete1);
}

.btnTitle:hover .btnTitle-label{
    color: #ffffff;
}

.btnTitle.refused .btnTitle-label, .btnTitle.refused:hover .btnTitle-label{
    color: #8a8a8a;
}

.btnTitle>.fa,
.btnTitle>.fal,
.btnTitle>.far {
    font-size: 20px;
    display: block;
}

div.pagination li:first-child a.btnTitle{
    margin-left: 10px;
}

.imgforviewmode {
	color: var(--oblyon-muted-text);	/* InfraS change */
}

/* rule to reduce top menu - 2nd reduction: Reduce width of top menu icons again */
@media only screen and (max-width: <?php echo !getDolGlobalString('THEME_ELDY_WITDHOFFSET_FOR_REDUC2') ? round($nbtopmenuentries * 69, 0) + 130 : getDolGlobalString('THEME_ELDY_WITDHOFFSET_FOR_REDUC2'); ?>px)	/* reduction 2 */
{
	.btnTitle, a.btnTitle {
	    display: inline-block;
	    padding: 4px 4px 4px 4px;
		min-width: unset;
	}
}

/* rule to reduce top menu - 3rd reduction: The menu for user is on left */
@media only screen and (max-width: <?php echo !getDolGlobalString('THEME_ELDY_WITDHOFFSET_FOR_REDUC3') ? round($nbtopmenuentries * 47, 0) + 130 : getDolGlobalString('THEME_ELDY_WITDHOFFSET_FOR_REDUC3'); ?>px)	/* reduction 3 */
{
    .butAction, .butActionRefused, .butActionDelete {
        font-size: 0.9em;
    }
}

/* smartphone */
@media only screen and (max-width: 767px)
{
    .butAction, .butActionRefused, .butActionDelete {
        font-size: 0.85em;
    }
}

<?php if (getDolGlobalString('MAIN_BUTTON_HIDE_UNAUTHORIZED') && (!$user->admin)) { ?>
.butActionRefused, .butActionNewRefused, .btnTitle.refused {
    display: none !important;
}
<?php } ?>

/*
 * BTN LINK
 */

/* InfraS change begin : lien-bouton en pilule neutre du preset */
.btn-link{
	margin-right: 5px;
	border: 1px solid var(--oblyon-border);
	color: var(--colortext);
	padding: 5px 10px;
	border-radius: var(--oblyon-radius-pill);
	text-decoration: none !important;
	transition: background-color var(--oblyon-transition);
}

.btn-link:hover{
	background-color: var(--oblyon-neutral-bg);
	border: 1px solid var(--oblyon-border-strong);
}
/* InfraS change end */
