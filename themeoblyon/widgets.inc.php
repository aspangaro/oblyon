<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/widgets.inc.php
   Role      : Composants : calendrier, agenda, autocompletion, edition en ligne, CKEditor, ACE, jNotify, blockUI, DataTables, Select2, multiselect
   Inclus par : global.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/* ============================================================================== */
/* Calendar date picker														   */
/* ============================================================================== */

.ui-datepicker-calendar .ui-state-default, .ui-datepicker-calendar .ui-widget-content .ui-state-default,
.ui-datepicker-calendar .ui-widget-header .ui-state-default, .ui-datepicker-calendar .ui-button,
html .ui-datepicker-calendar .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active
{
	border: unset;
}

div#ui-datepicker-div {
	width: 300px;
	box-shadow: 2px 5px 15px #aaa;
	border: unset;
	padding-left: 5px;
	padding-right: 5px;
	padding-top: 5px;
	z-index: 102 !important;	/* 102 is the minimum value because the formcofirm popup form is set to 101, so if we use the date picker on formcofirm... */
}
.ui-datepicker .ui-datepicker table {
	font-size: unset;
}
.ui-datepicker .ui-widget-header {
	border: unset;
	background: unset;
}

.ui-datepicker .ui-datepicker-header {
	background: var(--bgcolor) !important;
	border: none;
}

.ui-state-highlight, .ui-widget-content .ui-state-highlight
{
	color: var(--colorfdatedefault) !important;
	font-weight: bolder !important;
}

img.datecallink { padding-left: 2px !important; padding-right: 2px !important; }

select.ui-datepicker-year {
	margin-left: 2px !important;
}
.ui-datepicker-trigger {
	filter: invert(calc(var(--invertratiofilter) * 1%));
	vertical-align: middle;
	cursor: pointer;
	padding-left: 2px;
	padding-right: 2px;
}

.bodyline {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	border: 1px #E4ECEC outset;
	padding: 0px;
	margin-bottom: 5px;
}

table.dp {
	width: 180px;
	background-color: var(--colorbline);
	/*border-top: solid 2px #f4f4f4;
	border-<?php print $left; ?>: solid 2px #f4f4f4;
	border-<?php print $right; ?>: solid 1px #222222;
	border-bottom: solid 1px #222222; */
	padding: 0px;
	border-spacing: 0px;
	border-collapse: collapse;
}
.dp td, .tpHour td, .tpMinute td{padding:2px; font-size:10px;}
	/* Barre titre */
	.dpHead,.tpHead,.tpHour td:Hover .tpHead{
	font-weight:bold;
	background-color: #888;
	color:white;
	font-size:11px;
	cursor:auto;
}
/* Barre navigation */
.dpButtons,.tpButtons {
	text-align:center;
	background-color: #888;
	color:#FFFFFF;
	font-weight:bold;
	cursor:pointer;
}
.dpButtons:Active,.tpButtons:Active{border: 1px outset black;}
.dpDayNames td,.dpExplanation {background-color:#D9DBE1; font-weight:bold; text-align:center; font-size:11px;}
.dpExplanation{ font-weight:normal; font-size:11px;}
.dpWeek td{text-align:center}

.dpToday,.dpReg,.dpSelected{
	cursor:pointer;
}
.dpToday{font-weight:bold; color:black; background-color:#f4f4f4;}
.dpReg:Hover,.dpToday:Hover{background-color:black;color:white}

/* Jour courant */
.dpSelected{background-color:#0B63A2;color:white;font-weight:bold; }

.tpHour{border-top:1px solid #f4f4f4; border-right:1px solid #f4f4f4;}
.tpHour td {border-left:1px solid #f4f4f4; border-bottom:1px solid #f4f4f4; cursor:pointer;}
.tpHour td:Hover {background-color:black;color:white;}

.tpMinute {margin-top:5px;}
.tpMinute td:Hover {background-color:black; color:white; }
.tpMinute td {background-color:#D9DBE1; text-align:center; cursor:pointer;}

/* Bouton X fermer */
.dpInvisibleButtons
{
	border-style:none;
	background-color:transparent;
	padding:0px;
	font-size: 0.85em;
	border-width:0px;
	vertical-align:middle;
	cursor: pointer;
}
.datenowlink
{
	color: var(--colortextlink);
}

/* ============================================================================== */
/*  Show/Hide																	 */
/* ============================================================================== */

div.visible {
	display: block;
}

div.hidden, div.hiddenforpopup, header.hidden, tr.hidden, td.hidden,
img.hidden, span.hidden, br.hidden, div.showifmore {
	display: none;
}
.unvisible {
	visibility: hidden;
}
tr.visible {
	display: block;
}

/* ============================================================================== */
/*  Module website																*/
/* ============================================================================== */

.previewnotyetavailable {
	opacity: 0.5;
}

.websiteformtoolbar {
	position: sticky;
	top: <?php print empty($dol_hide_topmenu) ? ($disableimages ? '32px' : '52px') : '0'; ?>;
	z-index: 1002;	/* Dolibarr menu is 1001, Website menu is 1002 */
}

.exampleapachesetup {
	overflow-y: auto;
	height: 100px;
	font-size: 0.8em;
	border: 1px solid #aaa;
}

span[phptag] {
	background: #ddd; border: 1px solid #ccc; border-radius: 4px;
}

.nobordertransp {
	border: 0px;
	background-color: transparent;
	background-image: none;
}
.bordertransp {
	background-color: transparent;
	background-image: none;
	border: none;
	font-weight: normal;
}
.websitebar .button.bordertransp, .websitebar .fa-plus-circle.btnTitle-icon {
	color: unset;
	text-decoration: unset !important;
	margin: 0px 4px 0px 4px  !important
}

/* ============================================================================== */
/*	Module website 																  */
/* ============================================================================== */

.websitebar {
	border-bottom: 1px solid #ccc;
	background: #e6e6e6;
	display: inline-block;
	z-index: 1000;
}
.centpercent.websitebar {
	width: calc(100% - 10px);
	padding: 5px 5px 5px 5px;
	font-size: 0.94em;
}
.websitebar .buttonDelete, .websitebar .button {
	text-shadow: none;
}
.websitebar .button, .websitebar .buttonDelete
{
	padding: 4px 5px 4px 5px !important;
	margin: 2px 4px 2px 4px  !important;
	/*	line-height: normal; */
	background: #f5f5f5 !important;
	border: 1px solid #ccc !important;
}
.websiteselection {
	/* display: inline-block; */
	padding-<?php print $right; ?>: 10px;
	vertical-align: middle;
	line-height: 2.2em;
}
.websiteselectionsection {
	font-size: 0.85em;
}
.websiteselection span {
	vertical-align: middle;
}
.websitetools {
	float: right;
}
.websiteinputurl {
	display: inline-block;
	vertical-align: middle;
	line-height: 26px;
}
.websiteiframenoborder {
	border: 0px;
}
span.websiteselection span.select2.select2-container.select2-container--default {
	margin: 0 0 0 4px;
}
span.websitebuttonsitepreview, a.websitebuttonsitepreview {
	vertical-align: middle;
}
span.websitebuttonsitepreview img, a.websitebuttonsitepreview img {
	width: 26px;
	display: inline-block;
}
span.websitebuttonsitepreviewdisabled img, a.websitebuttonsitepreviewdisabled img {
	opacity: 0.2;
}
.websitehelp {
	vertical-align: middle;
	float: right;
	padding-top: 8px;
}
.websiteselectionsection {
	border-left: 1px solid #bbb;
	border-right: 1px solid #bbb;
	margin-left: 0px;
	padding-left: 8px;
	margin-right: 5px;
}
.websitebar input#previewpageurl {
	line-height: 1em;
}

.websitebar input.bordertransp {
	line-height: normal !important;
}

#divbodywebsite section p {
	margin: unset;
}

/* ============================================================================== */
/*  Module agenda																 */
/* ============================================================================== */

.dayevent .tagtr:first-of-type {
	height: 24px;
}
.agendacell {
	height: 60px;
}
table.cal_month	{
	border-spacing: 0px;
}
table.cal_month td:first-child  {
	border-left: 0px;
}
table.cal_month td:last-child {
	border-right: 0px;
}
.cal_current_month {
	border-top: 0;
	border-left: solid 1px var(--colortopbordertitle1);
	border-right: 0;
	border-bottom: solid 1px var(--colortopbordertitle1);
}
.cal_current_month_peruserleft {
	border-top: 0;
	border-left: solid 2px #6C7C7B;
	border-right: 0;
	border-bottom: solid 1px var(--colortopbordertitle1);
}
.cal_current_month_oneday {
	border-right: solid 1px var(--colortopbordertitle1);
}
.cal_other_month {
	border-top: 0;
	border-left: solid 1px #C0C0C0;
	border-right: 0;
	border-bottom: solid 1px #C0C0C0;
}
.cal_other_month_peruserleft {
	border-top: 0;
	border-left: solid 2px #6C7C7B !important;
	border-right: 0;
}
.cal_current_month_right {
	border-right: solid 1px var(--colortopbordertitle1);
}
.cal_other_month_right {
	border-right: solid 1px #C0C0C0;
}
.cal_other_month {
	background: var(--colorbline);
	padding-<?php print $left; ?>: 2px;
	padding-<?php print $right; ?>: 1px;
	padding-top: 0px;
	padding-bottom: 0px;
}
.cal_past_month	{
	background: var(--colorbline);
	padding-<?php print $left; ?>: 2px;
	padding-<?php print $right; ?>: 1px;
	padding-top: 0px;
	padding-bottom: 0px;
}
.cal_current_month {
	background: var(--colorbacktitle1);
	border-left: solid 1px var(--colortopbordertitle1);
	padding-<?php print $left; ?>: 2px;
	padding-<?php print $right; ?>: 1px;
	padding-top: 0px;
	padding-bottom: 0px;
}
.cal_current_month_peruserleft {
	background: var(--colorbacktitle1);
	border-left: solid 2px #6C7C7B;
	padding-<?php print $left; ?>: 2px;
	padding-<?php print $right; ?>: 1px;
	padding-top: 0px;
	padding-bottom: 0px;
}
.cal_today {
	background: var(--inputbackgroundcolor);
	border-left: solid 1px var(--colortopbordertitle1);
	border-bottom: solid 1px var(--colortopbordertitle1);
	padding-<?php print $left; ?>: 2px;
	padding-<?php print $right; ?>: 1px;
	padding-top: 0px;
	padding-bottom: 0px;
}
.cal_today_peruser {
	background: var(--inputbackgroundcolor);
	border-right: solid 1px var(--colortopbordertitle1);
	border-bottom: solid 1px var(--colortopbordertitle1);
	padding-<?php print $left; ?>: 2px;
	padding-<?php print $right; ?>: 1px;
	padding-top: 0px;
	padding-bottom: 0px;
}
.cal_today_peruser_peruserleft {
	background: var(--inputbackgroundcolor);;
	border-left: solid 2px #6C7C7B;
	border-right: solid 1px var(--colortopbordertitle1);
	border-bottom: solid 1px var(--colortopbordertitle1);
	padding-<?php print $left; ?>: 2px;
	padding-<?php print $right; ?>: 1px;
	padding-top: 0px;
	padding-bottom: 0px;
}
.cal_peruser {
	padding: 0px;
}
.cal_impair {
	background: var(--colorbacklinepair2);
}
.cal_today_peruser_impair {
	background: var(--colorbacklinepair2);
}
.peruser_busy {
	background: var(--inputbackgroundcolor);
}
.peruser_notbusy {
	background: var(--inputbackgroundcolor);
	opacity: 0.5;
}
table.cal_event	{
	border: none;
	border-collapse: collapse;
	margin-bottom: 1px;
	-webkit-border-radius: 3px;
	border-radius: 3px; min-height: 20px;
	background: var(--maincolor) !important;
}
table.cal_event td {
	border: none;
	padding-<?php print $left; ?>: 2px;
	padding-<?php print $right; ?>: 2px;
	padding-top: 0px;
	padding-bottom: 0px;
}
table.cal_event td.cal_event {
	padding: 4px 4px !important;
}
table.cal_event td.cal_event_right {
	padding: 4px 4px !important;
}
.cal_event {
	font-size: 1em;
}
.cal_event a:link {
	color: var(--colorCalEventTxt);	/* InfraS change : jeton OBLYON_COLOR_CAL_EVENT_TXT */
	font-weight: normal !important;
}
.cal_event a:visited {
	color: var(--colorCalEventTxt);	/* InfraS change */
	font-weight: normal !important;
}
.cal_event a:active {
	color: var(--colorCalEventTxt);	/* InfraS change */
	font-weight: normal !important;
}
.cal_event_busy a:hover {
	color: var(--colorCalEventTxt);	/* InfraS change */
	font-weight: normal !important;
	color:rgba(255,255,255,.75);
}
.cal_peruserviewname {
	max-width: 140px; height: 22px;
}
<?php if ($oblyon_agenda_style == 'modern') { ?>
/* agenda natif "moderne" (OBLYON_AGENDA_STYLE = modern, 3.8.0), ecrit apres les regles d'origine (memes selecteurs + !important) ; vues mois, semaine, jour
   (toutes imprimees dans table.cal_month par comm/action/index.php). Grille : jours du mois sur le fond des lignes, jours hors mois sur le fond neutre avec numero attenue,
   filets --oblyon-border, cadre arrondi, aujourd'hui sur la teinte d'accent avec le numero dans une pastille de la couleur principale, "+" visible au survol de la case.
   En-tete des jours plat (texte attenue en petites capitales). Evenements : carte teintee de sa propre couleur (le core imprime la couleur du type / de l'utilisateur en
   liseret gauche inline et un fond gris inline : js/oblyon.js lit le liseret et pose --oblyon-ev-tint, repli fond neutre sans JS), texte des lignes, coins du theme, ombre au survol */
:root {
	--oblyon-agenda-modern: 1;	/* lu par js/oblyon.js (teinte des evenements) */
}
table.cal_month {
	border-collapse: separate;
	border-spacing: 0;
	border: 1px solid var(--oblyon-border);
	border-radius: var(--oblyon-radius);
	overflow: hidden;
	background: var(--colorbline);
}
table.cal_month tr.liste_titre td, table.cal_month tr.liste_titre th {
	background: var(--colorbline) !important;
	color: var(--oblyon-muted-text) !important;
	font-size: .78em;
	font-weight: 600;
	letter-spacing: .05em;
	text-transform: uppercase;
	border-bottom: 1px solid var(--oblyon-border);
	padding: 9px 4px;
}
table.cal_month td.weeknumber {
	color: var(--oblyon-muted-text);
	font-size: .75em;
	background: var(--oblyon-neutral-bg);
	border-right: 1px solid var(--oblyon-border);
	border-bottom: 1px solid var(--oblyon-border);
}
.cal_current_month, .cal_current_month_oneday, .cal_today, .cal_other_month, .cal_past_month {
	border: 0 !important;
	border-<?php print $right; ?>: 1px solid var(--oblyon-border) !important;
	border-bottom: 1px solid var(--oblyon-border) !important;
	padding: 4px 5px !important;
	vertical-align: top;
}
.cal_current_month, .cal_current_month_oneday {
	background: var(--colorbline) !important;
}
.cal_other_month, .cal_past_month {
	background: var(--oblyon-neutral-bg) !important;
}
.cal_today {
	background: var(--oblyon-accent-tint) !important;
}
table.cal_month td:last-child {
	border-<?php print $right; ?>: 0 !important;
}
.dayevent-aday {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	min-width: 24px;
	height: 24px;
	padding: 0 6px;
	border-radius: 12px;
	font-weight: 600;
	font-size: .85em;
	color: var(--colortext) !important;	/* le core imprime color: #666 en style inline */
	text-decoration: none !important;
}
.cal_other_month .dayevent-aday, .cal_past_month .dayevent-aday {
	color: var(--oblyon-muted-text) !important;
	font-weight: 500;
}
.cal_today .dayevent-aday {
	background: var(--maincolor);
	color: var(--oblyon-on-accent) !important;
}
.dayevent .tagtr:first-of-type {
	height: 28px;
}
.dayevent .cursoradd {
	opacity: 0;
	color: var(--oblyon-muted-text);
	transition: opacity var(--oblyon-transition);
}
td:hover .dayevent .cursoradd, .dayevent .cursoradd:focus {
	opacity: 1;
}
.agendacell {
	height: 72px;
}
.event {
	margin-bottom: 3px;
}
table.cal_event {
	background: var(--oblyon-ev-tint, var(--oblyon-neutral-bg)) !important;
	border-radius: var(--oblyon-radius-sm) !important;
	border-<?php print $left; ?>-width: 4px !important;
	transition: box-shadow var(--oblyon-transition);
}
table.cal_event:hover {
	box-shadow: var(--oblyon-shadow-md);
}
table.cal_event td.cal_event {
	padding: 3px 6px !important;
	color: var(--colortext);
	font-size: .85em;
	line-height: 1.35;
}
.cal_event a:link, .cal_event a:visited, .cal_event a:active, .cal_event_busy a:hover {
	color: var(--colortext) !important;
}
table.cal_event td.cal_event_right {
	padding: 3px 6px !important;
}
.cal_event_notbusy {
	opacity: .7;
}
<?php } ?>

.topmenuimage {
	background-size: 28px auto;
}

.paginationafterarrows > .button_search > .fa.fa-search{
	color: var(--colortext);
}

/* ============================================================================== */
/*  Ajax - Combo list for autocompletion										  */
/* ============================================================================== */

.ui-widget-content {
	border: solid 1px rgba(0,0,0,.3);
	background: var(--colorbackbody) !important;
	color: var(--colortext) !important;
}

.ui-widget-content a {
	color: var(--colortext) !important;
}

/*.ui-widget-header {
	background: var(--colorbacktitle1);
}*/

.ui-autocomplete-loading {
	color: #000;
	background: white url(<?php print dol_buildpath($path.'/theme/'.$theme.'/img/working.gif', 1) ?>) right center no-repeat;
}
.ui-autocomplete {
	position:absolute;
	width:auto;
	font-size: 1.0em;
	background-color: var(--inputbackgroundcolor);
	border:1px solid #888;
	margin:0px;
	/*		   padding:0px; This make combo crazy */
}
.ui-autocomplete ul {
	list-style-type:none;
	margin:0px;
	padding:0px;
}
.ui-autocomplete ul li.selected {
	background-color: var(--inputbackgroundcolor);
}
.ui-autocomplete ul li {
	list-style-type:none;
	display:block;
	margin:0;
	padding:2px;
	height:18px;
	cursor:pointer;
}

/* ============================================================================== */
/*  jQuery - jeditable for inline edit											*/
/* ============================================================================== */

.editkey_textarea, .editkey_ckeditor, .editkey_string, .editkey_email, .editkey_numeric, .editkey_select, .editkey_autocomplete {
	background: url(<?php print dol_buildpath($path.'/theme/'.$theme.'/img/edit.png', 1) ?>) right top no-repeat;
	cursor: pointer;
	margin-right: 3px;
	margin-top: 3px;
}

.editkey_datepicker {
	background: url(<?php print dol_buildpath($path.'/theme/'.$theme.'/img/calendar.png', 1) ?>) right center no-repeat;
	margin-right: 3px;
	cursor: pointer;
	margin-right: 3px;
	margin-top: 3px;
}

.editval_textarea.active:hover, .editval_ckeditor.active:hover, .editval_string.active:hover, .editval_email.active:hover, .editval_numeric.active:hover, .editval_select.active:hover, .editval_autocomplete.active:hover, .editval_datepicker.active:hover {
	background: var(--colorOverlayBg);	/* InfraS change : jeton OBLYON_COLOR_OVERLAY_BCKGRD */
	cursor: pointer;
}

.viewval_textarea.active:hover, .viewval_ckeditor.active:hover, .viewval_string.active:hover, .viewval_email.active:hover, .viewval_numeric.active:hover, .viewval_select.active:hover, .viewval_autocomplete.active:hover, .viewval_datepicker.active:hover {
	background: var(--colorOverlayBg);	/* InfraS change : jeton OBLYON_COLOR_OVERLAY_BCKGRD */
	cursor: pointer;
}

.viewval_hover {
	background: var(--colorOverlayBg);	/* InfraS change : jeton OBLYON_COLOR_OVERLAY_BCKGRD */
}

/*------------------------------------*\
#jQuery Modules
\*------------------------------------*/

/**
* Tooltips
*/

#tooltip {
	background-color: var(--tooltipbgcolor);	/* InfraS change : jeton 3.7.0 */
	color: var(--tooltipfontcolor);	/* InfraS change : jeton 3.7.0 */
	border-top: solid 1px #bbb;
	border-<?php print $left; ?>: solid 1px #bbb;
	border-<?php print $right; ?>: solid 1px #444;
	border-bottom: solid 1px #444;
	opacity: 1;
	padding: 2px;
	position: absolute;
	width: <?php print dol_size(450,'width'); ?>px;
	z-index: 97;
}

/* ============================================================================== */
/* Admin Menu																	 */
/* ============================================================================== */

/* CSS for treeview */
.treeview ul { background-color: transparent !important; margin-top: 0 !important; /* margin-bottom: 4px !important; padding-top: 2px !important; */ }
.treeview li { background-color: transparent !important; padding: 0 0 0 20px !important; min-height: 30px; }
.treeview .hitarea { width: 20px !important; margin-left: -20px !important; margin-top: 3px; }
.treeview li table { min-height: 30px; }
.treeview .hover { color: var(--colortextlink) !important; text-decoration: underline !important; }

/* ============================================================================== */
/*  Show Excel tabs															   */
/* ============================================================================== */

.table_data
{
	border-style:ridge;
	border:1px solid;
}
.tab_base
{
	background:#C5D0DD;
	font-weight:bold;
	border-style:ridge;
	border: 1px solid;
	cursor:pointer;
}
.table_sub_heading
{
	background:#CCCCCC;
	font-weight:bold;
	border-style:ridge;
	border: 1px solid;
}
.table_body
{
	background:#F0F0F0;
	font-weight:normal;
	font-family:sans-serif;
	border-style:ridge;
	border: 1px solid;
	border-spacing: 0px;
	border-collapse: collapse;
}
.tab_loaded
{
	background:#222222;
	color:white;
	font-weight:bold;
	border-style:groove;
	border: 1px solid;
	cursor:pointer;
}

/* ============================================================================== */
/*  CSS for color picker														  */
/* ============================================================================== */

div.jPicker table.jPicker {
	padding-bottom: 20px;
	padding-right: 20px;
	padding-left: 20px;
}
table.jPicker tr:first-of-type td {
	height: 2px !important;
	line-height: 2px;
}
.jPicker .Move {
	background: unset !important;
	border: unset !important;
}
.jPicker .Preview div span {
	border: unset !important;
	width: unset !important;
	height: 50% !important;
}
table.jPicker {
	border-radius: 5px;
	background-color: var(--colorbackbody) !important;
	box-shadow: 0px 0px 10px #ccc;
}
.jPicker .Grid {
	background-image: unset !important;
}
.jPicker .Grid span.QuickColor {
	border: unset !important;
}
.jPicker td.Radio {
	min-width: 34px;
}
.jPicker td.Text {
	white-space: nowrap;
}
.jPicker td.Text input {
	height: 1em !important;
}
.jPicker .Preview div {
	height: 36px !important;
}
.jPicker input[type="button"] {
	background: var(--colorButtonAction1);
	color: var(--colorTextButtonAction);
	border-radius: 4px;
	border-collapse: collapse;
	border: none;
}

A.color, A.color:active, A.color:visited {
	position : relative;
	display : block;
	text-decoration : none;
	width : 10px;
	height : 10px;
	line-height : 10px;
	margin : 0px;
	padding : 0px;
	border : 1px inset white;
}
A.color:hover {
	border : 1px outset white;
}
A.none, A.none:active, A.none:visited, A.none:hover {
	position : relative;
	display : block;
	text-decoration : none;
	width : 10px;
	height : 10px;
	line-height : 10px;
	margin : 0px;
	padding : 0px;
	cursor : default;
	border : 1px solid #b3c5cc;
}
.tblColor {
	display : none;
}
.tdColor {
	padding : 1px;
}
.tblContainer {
	background-color : #b3c5cc;
}
.tblGlobal {
	position : absolute;
	top : 0px;
	left : 0px;
	display : none;
	background-color : #b3c5cc;
	border : 2px outset;
}
.tdContainer {
	padding : 5px;
}
.tdDisplay {
	width : 50%;
	height : 20px;
	line-height : 20px;
	border : 1px outset white;
}
.tdDisplayTxt {
	width : 50%;
	height : 24px;
	line-height : 12px;
	font-family : var(--fontlist);
	font-size : 8pt;
	color : black;
	text-align : center;
}
.btnColor {
	width : 100%;
	font-family : var(--fontlist);
	font-size : 10pt;
	padding : 0px;
	margin : 0px;
}
.btnPalette {
	width : 100%;
	font-family : var(--fontlist);
	font-size : 8pt;
	padding : 0px;
	margin : 0px;
}
.colorselector {
	border: solid 1px #ddd !important;
}

/* Style to overwrites JQuery styles */
.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {
	/* border: 1px solid #888; */
	background: var(--colorbacktitle1);
	color: unset;
	font-weight: bold;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {
	background: var(--colorbackhmenu1);
	color: var(--colorfdateselected) !important;
	border: 1px solid var(--colorbackhmenu1);
}
/* Ligne surlignee du dropdown d'autocompletion jQuery UI (recherche produit "search-to-select", etc.) : couleurs dediees, sans impacter les autres etats .ui-state-active */
.ui-autocomplete.ui-widget-content .ui-state-active,
.ui-autocomplete .ui-menu-item-wrapper.ui-state-active,
.ui-autocomplete ul li.selected {
	background: var(--colorAutocompleteBg);
	color: var(--colorAutocompleteText) !important;
	border: 1px solid var(--colorAutocompleteBg);
}
.ui-menu {
	padding: 5px;
	/*
		border-bottom-left-radius: 6px;
		border-bottom-right-radius: 6px;
		*/
}
.ui-menu .ui-menu-item a {
	text-decoration:none;
	display:block;
	padding:.5em .6em;
	line-height:1.5;
	font-weight: normal;
	font-family:var(--fontlist);
	font-size:1em;
}
.ui-widget {
	font-family:var(--fontlist);
}
/* .ui-button { margin-left: -2px; <?php print(preg_match('/chrome/', $conf->browser->name) ? 'padding-top: 1px;' : ''); ?> } */
.ui-button { margin-left: -2px; }
.ui-button-icon-only .ui-button-text { height: 8px; }
.ui-button-icon-only .ui-button-text, .ui-button-icons-only .ui-button-text { padding: 2px 0px 6px 0px; }
.ui-button-text
{
	line-height: 1em !important;
}
.ui-autocomplete-input { margin: 0; padding: 4px; }

/* ============================================================================== */
/*  CKEditor																	  */
/* ============================================================================== */

body.cke_show_borders {
	margin: 5px !important;
}

.cke_dialog {
	border: 1px #bbb solid ! important;
}
/*.cke_editor table, .cke_editor tr, .cke_editor td
{
	border: 0px solid #FF0000 !important;
}
span.cke_skin_kama { padding: 0 !important; }*/
.cke_wrapper { padding: 4px !important; }
a.cke_dialog_ui_button
{
	font-family: var(--fontlist) !important;
	background-image: var(--img_button) !important;
	background-position: bottom !important;
	border: 1px solid #C0C0C0 !important;
	-webkit-border-radius:0px 5px 0px 5px !important;
	border-radius:0px 5px 0px 5px !important;
	-webkit-box-shadow: 3px 3px 4px #DDD !important;
	box-shadow: 3px 3px 4px #DDD !important;
}
.cke_dialog_ui_hbox_last
{
	vertical-align: bottom !important;
}
.cke_dialog_ui_hbox_first {
	vertical-align: middle !important;
}
.cke_combo_text {
	width: 40px !important;
}
/*
.cke_editable
{
	line-height: 1.4 !important;
	margin: 6px !important;
}
*/
a.cke_dialog_ui_button_ok span {
	text-shadow: none !important;
	color: #333 !important;
}
a.cke_button, a.cke_combo_button {
	height: 18px !important;
}
div.cke_notifications_area .cke_notification_warning {
	visibility: hidden;
}

/* CSS To hide the picto menu on smartphone, except when maximize */
/* InfraS change begin : regle retiree (3.5.0) : elle masquait tous les outils de CKEditor sous 768px, tablettes comprises ;
   la disposition mobile (mobile.inc.php) donne a l'editeur une largeur lisible et la barre d'outils se replie sur plusieurs lignes */
/*
@media only screen and (max-width: 768px)
{
	.cke_inner:not(.cke_maximized) .cke_toolbar_separator,
	.cke_inner:not(.cke_maximized) .cke_combo,
	.cke_inner:not(.cke_maximized) .cke_button:not(.cke_button__maximize) {
		display: none;
	}
}
*/
/* InfraS change end */

/* ============================================================================== */
/*  ACE editor																	*/
/* ============================================================================== */
.ace_editor {
	border: 1px solid #ddd;
	margin: 0;
}
.aceeditorstatusbar {
	margin: 0;
	padding: 0;
	padding-<?php print $left; ?>: 10px;
	left: 0;
	right: 0;
	bottom: 0;
	background-color: #ebebeb;
	height: 2.2em;
	line-height: 2.2em;
}
.ace_status-indicator {
	color: gray;
	position: relative;
	right: 0;
	border-left: 1px solid;
}
pre#editfilecontentaceeditorid {
	margin-top: 5px;
}

/* ============================================================================== */
/*  File upload																   */
/* ============================================================================== */

.template-upload {
	height: 72px !important;
}

/* ============================================================================== */
/*  Custom reports																*/
/* ============================================================================== */

.customreportsoutput, .customreportsoutputnotdata {
	padding-top: 20px;
}
.customreportsoutputnotdata {
	text-align: center;
}

/* ============================================================================== */
/*  Holiday																	   */
/* ============================================================================== */

/* ============================================================================== */
/*  Holiday																	   */
/* ============================================================================== */

#types .btn {
	cursor: pointer;
}

#types .btn-primary {
	font-weight: bold;
}

#types form {
	padding: 20px;
}

#types label {
	display:inline-block;
	width:100px;
	margin-right: 20px;
	padding: 4px;
	text-align: right;
	vertical-align: top;
}

#types input.text, #types textarea {
	width: 400px;
}

#types textarea {
	height: 100px;
}

/* ============================================================================== */
/*  Comments																   	  */
/* ============================================================================== */

#comment div {
	box-sizing:border-box;
}
#comment .comment {
	border-radius:7px;
	margin-bottom:10px;
	overflow:hidden;
}
#comment .comment-table {
	display:table;
	height:100%;
}
#comment .comment-cell {
	display:table-cell;
}
#comment .comment-info {
	font-size:0.8em;
	border-right:1px solid #dedede;
	margin-right:10px;
	width:160px;
	text-align:center;
	background:rgba(255,255,255,0.5);
	vertical-align:middle;
	padding:10px 2px;
}
#comment .comment-info a {
	color:inherit;
}
#comment .comment-right {
	vertical-align:top;
}
#comment .comment-description {
	padding:10px;
	vertical-align:top;
}
#comment .comment-delete {
	width: 100px;
	text-align:center;
	vertical-align:middle;
}
#comment .comment-delete:hover {
	background:rgba(250,20,20,0.8);
}
#comment .comment-edit {
	width: 100px;
	text-align:center;
	vertical-align:middle;
}
#comment .comment-edit:hover {
	background:rgba(0,184,148,0.8);
}
#comment textarea {
	width: 100%;
}

/* ============================================================================== */
/*  JSGantt																	   */
/* ============================================================================== */

div.scroll2 {
	width: <?php print isset($_SESSION['dol_screenwidth']) ? max((int) $_SESSION['dol_screenwidth'] - 830, 450) : '450'; ?>px !important;
}

div#GanttChartDIVglisthead, div#GanttChartDIVgcharthead {
	line-height: 2;
}

.gtaskname div, .gtaskname, .gstartdate div, .gstartdate, .genddate div, .genddate {
	font-size: unset !important;
}

div.gantt, .gtaskheading, .gmajorheading, .gminorheading, .gminorheadingwkend {
	font-size: unset !important;
	font-weight: normal !important;
	color: #000 !important;
}
div.gTaskInfo {
	background: #f0f0f0 !important;
}
.gtaskblue {
	background: rgb(108,152,185) !important;
}
.gtaskgreen {
	background: rgb(160,173,58) !important;
}
td.gtaskname {
	overflow: hidden;
	text-overflow: ellipsis;
}
td.gminorheadingwkend {
	color: #888 !important;
}
td.gminorheading {
	color: #666 !important;
}
.glistlbl, .glistgrid {
	width: 582px !important;
}
/*.gtaskname div, .gtaskname {
	min-width: 250px !important;
	max-width: 250px !important;
	width: 250px !important;
}*/
.gtaskname div, .gtaskname {
	min-width: 250px !important;
	max-width: 500px !important;
	width: unset !important;
}
.gpccomplete div, .gpccomplete {
	min-width: 40px !important;
	max-width: 40px !important;
	width: 40px !important;
}
td.gtaskheading.gstartdate, td.gtaskheading.genddate {
	white-space: break-spaces;
}
.gtasktableh tr:nth-child(2) td:nth-child(2), .gtasktableh tr:nth-child(2) td:nth-child(3), .gtasktableh tr:nth-child(2) td:nth-child(4), .gtasktableh tr:nth-child(2) td:nth-child(5), .gtasktableh tr:nth-child(2) td:nth-child(6), .gtasktableh tr:nth-child(2) td:nth-child(7) {
	color: transparent !important;
	border-left: none;
	border-right: none;
	border-top: none;
}

/* ============================================================================== */
/*  jFileTree																	 */
/* ============================================================================== */

.ecmfiletree {
	width: 99%;
	height: 99%;
	padding-left: 2px;
	font-weight: normal;
}

.fileview {
	width: 99%;
	height: 99%;
	background: #FFF;
	padding-left: 2px;
	padding-top: 4px;
	font-weight: normal;
}

div.filedirelem {
	position: relative;
	display: block;
	text-decoration: none;
}

ul.filedirelem {
	padding: 2px;
	margin: 0 5px 5px 5px;
}
ul.filedirelem li {
	list-style: none;
	padding: 2px;
	margin: 0 10px 20px 10px;
	width: 160px;
	height: 120px;
	text-align: center;
	display: block;
	float: var(--left);
	border: solid 1px #DDDDDD;
}

ul.ecmjqft {
	line-height: 32px;
	padding: 0px;
	margin: 0px;
	font-weight: normal;
}

ul.ecmjqft li {
	list-style: none;
	padding: 0px;
	padding-left: 20px;
	margin: 0px;
	white-space: nowrap;
	display: block;
}

ul.ecmjqft a {
	line-height: 24px;
	vertical-align: middle;
	color: unset;
	padding: 0px 0px;
	font-weight:normal;
	display: inline-block !important;
}
ul.ecmjqft > a {
	width: calc(100% - 100px);
	overflow: hidden;
	white-space: break-spaces;
	word-break: break-all;
}
ul.ecmjqft a:active {
	font-weight: bold !important;
}
ul.ecmjqft a:hover {
	text-decoration: underline;
}
div.ecmjqft {
	vertical-align: middle;
	display: inline-block !important;
	text-align: var(--right);
	float: var(--right);
	right:4px;
	clear: both;
	height: 16px;
}
#ecm-layout-north {
	min-height: 40px;
}
#ecm-layout-north div.attachareaformuserfileecm {
	padding-bottom: 0px;
}
div#ecm-layout-west {
	width: 380px;
	vertical-align: top;
}
div#ecm-layout-center {
	width: calc(100% - 405px);
	vertical-align: top;
	float: var(--right);
}

.ecmjqft LI.directory { font-weight:normal; background: url(<?php print dol_buildpath($path.'/theme/common/treemenu/folder2.png', 1); ?>) left top no-repeat; background-position-y: 8px; }
.ecmjqft LI.expanded { font-weight:normal; background: url(<?php print dol_buildpath($path.'/theme/common/treemenu/folder2-expanded.png', 1); ?>) left top no-repeat; background-position-y: 8px; }
.ecmjqft LI.wait { font-weight:normal; background: url(<?php print dol_buildpath('/theme/'.$theme.'/img/working.gif', 1); ?>) left top no-repeat; }

/* ============================================================================== */
/*  jNotify																	   */
/* ============================================================================== */

/* messages jNotify en cartes sous la barre du haut, a droite : fond et texte des couleurs "Messages et notifications"
   (OBLYON_COLOR_NOTIF_*, jusqu'ici lues mais jamais peintes), liseret et icone de la couleur du texte, croix discrete, glissement a l'apparition (option Animations) */
.jnotify-container {
	position: fixed !important;
	top: <?php print (getDolGlobalString('THEME_STICKY_TOPMENU') ? (getDolGlobalString('MAIN_MENU_INVERT') ? 40 : 54) : 0) + 8; ?>px !important;
	<?php print $right; ?>: 12px !important;
	<?php print $left; ?>: auto !important;
<?php if (getDolGlobalString('MAIN_JQUERY_JNOTIFY_BOTTOM')) { ?>
	top: auto !important;
	bottom: 12px !important;
<?php } ?>
	width: 380px !important;
	min-width: 0;
	max-width: calc(100vw - 24px);
	max-height: none;
	overflow: visible;
	padding: 0 !important;
	text-align: start;
	word-wrap: break-word;
	z-index: 100000;
}
@keyframes oblyon-toast-in {
	from { opacity: 0; transform: translateX(16px); }
	to { opacity: 1; transform: none; }
}
.jnotify-container .jnotify-notification {
	margin: 0 0 8px 0 !important;
	animation: oblyon-toast-in .2s ease-out;
}
.jnotify-container .jnotify-notification .jnotify-background {
	opacity: 1 !important;
	background-color: var(--colorNotifInfoBg) !important;
	border: 1px solid var(--oblyon-border);
	border-<?php print $left; ?>: 4px solid var(--colorNotifInfoTxt);
	border-radius: var(--oblyon-radius) !important;
	box-shadow: var(--oblyon-shadow-lg) !important;
}
.jnotify-container .jnotify-notification .jnotify-message {
	position: relative;
	z-index: 2;
	padding: 12px 38px 12px 44px !important;
	font-weight: normal;
	text-align: start;
	word-break: break-word;
	line-height: 1.4;
	color: var(--colorNotifInfoTxt) !important;
}
.jnotify-container .jnotify-notification .jnotify-message::before {
	content: "\f058";	/* check-circle */
	font-family: var(--fontawesomeFamily);
	font-weight: var(--fontawesomeWeight);
	position: absolute;
	<?php print $left; ?>: 14px;
	top: 50%;
	transform: translateY(-50%);
	font-size: 18px;
}
.jnotify-container .jnotify-notification-warning .jnotify-background {
	background-color: var(--colorNotifWarningBg) !important;
	border-<?php print $left; ?>-color: var(--colorNotifWarningTxt);
}
.jnotify-container .jnotify-notification-warning .jnotify-message {
	color: var(--colorNotifWarningTxt) !important;
}
.jnotify-container .jnotify-notification-warning .jnotify-message::before {
	content: "\f071";	/* exclamation-triangle */
}
.jnotify-container .jnotify-notification-error .jnotify-background {
	background-color: var(--colorNotifErrorBg) !important;
	border-<?php print $left; ?>-color: var(--colorNotifErrorTxt);
}
.jnotify-container .jnotify-notification-error .jnotify-message {
	color: var(--colorNotifErrorTxt) !important;
}
.jnotify-container .jnotify-notification-error .jnotify-message::before {
	content: "\f057";	/* times-circle */
}
.jnotify-container .jnotify-notification a.jnotify-close, .jnotify-container .jnotify-close {
	position: absolute;
	top: 6px !important;
	<?php print $right; ?>: 10px;
	z-index: 3;
	font-size: 1.4em !important;
	line-height: 1;
	color: var(--oblyon-muted-text) !important;
	text-decoration: none !important;
	opacity: .7;
}
.jnotify-container .jnotify-close:hover {
	opacity: 1;
}

/* jnotify for the login page */
.bodylogin .jnotify-container {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	z-index: 100000;
	max-width: unset;
	padding-left: unset !important;
	padding-right: unset !important;
	padding-top: unset !important;
}
.bodylogin .jnotify-container .jnotify-notification {
	margin: unset !important;
}
.bodylogin .jnotify-container .jnotify-notification .jnotify-background {
	border-radius: unset !important;
}
.bodylogin .jnotify-container .jnotify-notification .jnotify-message {
	text-align: center;
	font-size: 1.1em;
	font-weight: bold;
}

/* ============================================================================== */
/*  blockUI																	  */
/* ============================================================================== */

/*div.growlUI { background: url(check48.png) no-repeat 10px 10px }*/
div.dolEventValid h1, div.dolEventValid h2 {
	color: #567b1b;
	background-color: #e3f0db;
	padding: 5px 5px 5px 5px;
	text-align: left;
}
div.dolEventError h1, div.dolEventError h2 {
	color: #a72947;
	background-color: #d79eac;
	padding: 5px 5px 5px 5px;
	text-align: left;
}

/* ============================================================================== */
/*  Datatable																	 */
/* ============================================================================== */

table.dataTable tr.odd td.sorting_1, table.dataTable tr.even td.sorting_1 {
	background: none !important;
}
.sorting_asc  { background: url('<?php print dol_buildpath('/theme/'.$theme.'/img/sort_asc.png', 1); ?>') no-repeat center right !important; }
.sorting_desc { background: url('<?php print dol_buildpath('/theme/'.$theme.'/img/sort_desc.png', 1); ?>') no-repeat center right !important; }
.sorting_asc_disabled  { background: url('<?php print dol_buildpath('/theme/'.$theme.'/img/sort_asc_disabled.png', 1); ?>') no-repeat center right !important; }
.sorting_desc_disabled { background: url('<?php print dol_buildpath('/theme/'.$theme.'/img/sort_desc_disabled.png', 1); ?>') no-repeat center right !important; }
.dataTables_paginate {
	margin-top: 8px;
}
.paginate_button_disabled {
	opacity: 1 !important;
	color: #888 !important;
	cursor: default !important;
}
.paginate_disabled_previous:hover, .paginate_enabled_previous:hover, .paginate_disabled_next:hover, .paginate_enabled_next:hover
{
	font-weight: normal;
}
.paginate_enabled_previous:hover, .paginate_enabled_next:hover
{
	text-decoration: underline !important;
}
.paginate_active
{
	text-decoration: underline !important;
}
.paginate_button
{
	font-weight: normal !important;
	text-decoration: none !important;
}
.paging_full_numbers {
	height: inherit !important;
}
.paging_full_numbers a.paginate_active:hover, .paging_full_numbers a.paginate_button:hover {
	background-color: var(--colorbackbody) !important;
}
.paging_full_numbers, .paging_full_numbers a.paginate_active, .paging_full_numbers a.paginate_button {
	background-color: var(--colorbackbody) !important;
	border-radius: inherit !important;
}
.paging_full_numbers a.paginate_button_disabled:hover, .paging_full_numbers a.disabled:hover {
	background-color: var(--colorbackbody) !important;
}
.paginate_button, .paginate_active {
	border: 1px solid #ddd !important;
	padding: 6px 12px !important;
	margin-left: -1px !important;
	line-height: 1.42857143 !important;
	margin: 0 0 !important;
}

/* For jquery plugin combobox */
/* Disable this. It breaks wrapping of boxes
.ui-corner-all { white-space: nowrap; } */

.ui-state-disabled, .ui-widget-content .ui-state-disabled, .ui-widget-header .ui-state-disabled, .paginate_button_disabled {
	opacity: .35;
	background-image: none;
}

div.dataTables_length {
	float: right !important;
	padding-left: 8px;
}
div.dataTables_length select {
	background: var(--inputbackgroundcolor);	/* InfraS change : jeton 3.7.0 */
}
.dataTables_wrapper .dataTables_paginate {
	padding-top: 0px !important;
}

/* confirmation box */

.ui-state-default,
.ui-widget-header .ui-state-default,
.ui-widget-content .ui-state-default {
	background-color: unset !important;
	color: var(--colortext);
}

.ui-widget-header {
background-color: var(--colorbtitle) !important;	/* InfraS change : jeton 3.7.0 */
color: var(--colortexttitle);	/* InfraS change : jeton 3.7.0 */
}

.ui-dialog .ui-dialog-content { padding-top: 1em!important }

.ui-corner-all,
.ui-corner-bottom,
.ui-corner-right,
.ui-corner-br {
border-bottom-right-radius: 0!important;
-moz-border-radius-bottomright: 0!important;
-webkit-border-bottom-right-radius: 0!important;
-khtml-border-bottom-right-radius: 0!important;
}

.ui-corner-all,
.ui-corner-bottom,
.ui-corner-left,
.ui-corner-bl {
border-bottom-left-radius: 0!important;
-moz-border-radius-bottomleft: 0!important;
-webkit-border-bottom-left-radius: 0!important;
-khtml-border-bottom-left-radius: 0!important;
}

.ui-corner-all,
.ui-corner-top,
.ui-corner-right,
.ui-corner-tr {
border-top-right-radius: 0!important;
-moz-border-radius-topright: 0!important;
-webkit-border-top-right-radius: 0!important;
-khtml-border-top-right-radius: 0!important;
}

.ui-corner-all,
.ui-corner-top,
.ui-corner-left,
.ui-corner-tl{
border-bottom-top-radius: 0!important;
-moz-border-radius-topleft: 0!important;
-webkit-border-top-left-radius: 0!important;
-khtml-border-top-left-radius: 0!important;
}

/* ============================================================================== */
/*  Select2																	   */
/* ============================================================================== */

span.select2-selection--single.flat[aria-disabled="true"] span.select2-selection__rendered {
	opacity: 0.5;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
	background-color: var(--colorAutocompleteBg);
	color: var(--colorAutocompleteText);
}
.select2-container--default .select2-results__option--highlighted[aria-selected] span {
	color: var(--colorAutocompleteText) !important;
}

span.select2.select2-container.select2-container--default {
	text-align: initial;
	<?php if (!getDolGlobalString('THEME_SHOW_BORDER_ON_INPUT')) { ?>
	border-left: none;
	border-top: none;
	border-right: none;
	<?php } ?>
}
span.select2.select2-container.select2-container--default {
	<?php if (!getDolGlobalString('THEME_SHOW_BORDER_ON_INPUT')) { ?>
	/*border-bottom: solid 1px var(--inputbordercolor);*/
	<?php } ?>
}

input.select2-input {
	border-bottom: none ! important;
}
.select2-choice {
	border: none;
	border-bottom: solid 1px var(--inputbordercolor) !important;	/* required to avoid to lose bottom line when focus is lost on select2. */
}
.select2-results .select2-highlighted.optionblue {
	color: #FFF !important;
}
.select2-container .select2-selection--multiple {
	min-height: 28px !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
	border: none;
}
/* au focus, le bas de la liste garde la couleur et le rayon des trois autres cotes (il passait en gris tres clair, coins carres) */
.select2-container--focus span.select2-selection.select2-selection--single {
	border-bottom: 1px solid var(--oblyon-focus) !important;
}

.blockvmenusearch .select2-container--default .select2-selection--single,
.blockvmenubookmarks .select2-container--default .select2-selection--single
{
	background-color: var(--colorbackvmenu1);
}
.select2-container--default .select2-selection--single {
	background-color: var(--inputbackgroundcolor);
}
#blockvmenusearch .select2-container--default .select2-selection--single .select2-selection__placeholder {
	color: var(--colortextbackvmenu);
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
	color: var(--colortext);
	/* background-color: var(--inputbackgroundcolor); */
}
.select2-default {
	color: var(--oblyon-muted-text) !important;	/* InfraS change */
}
.select2-choice, .select2-container .select2-choice {
	border-bottom: solid 1px var(--oblyon-input-border);	/* InfraS change */
}
.select2-container .select2-choice > .select2-chosen {
	margin-right: 23px;
}
.select2-container .select2-choice .select2-arrow {
	border-radius: 0;
	background: transparent;
}
.select2-container-multi .select2-choices {
	background-image: none;
}
.select2-container .select2-choice {
	color: #000;
	border-radius: 0;
}
.selectoptiondisabledwhite {
	background: #FFFFFF !important;
}
.select2-arrow {
	border: none;
	border-left: none !important;
	background: none !important;
}
.select2-choice
{
	border-top: none !important;
	border-left: none !important;
	border-right: none !important;
}
.select2-drop.select2-drop-above {
	box-shadow: none !important;
}
.select2-container--open .select2-dropdown--above {
	border-bottom: solid 1px var(--inputbordercolor);
}
.select2-drop.select2-drop-above.select2-drop-active {
	border-top: 1px solid #ccc;
	border-bottom: solid 1px var(--inputbordercolor);
}
/* InfraS change begin : listes deroulantes select2 alignees sur les champs (bordure fine complete, rayon du theme, focus couleur principale) */
.select2-container--default .select2-selection--single
{
	transition: border-color var(--oblyon-transition);
}
.select2-container--default.select2-container--focus .select2-selection--single,
.select2-container--default.select2-container--open .select2-selection--single {
	border-color: var(--oblyon-focus);
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
	border-color: var(--oblyon-focus);
}
.select2-container--default .select2-selection--multiple {
	border: solid 1px var(--oblyon-input-border);
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
	background-color: var(--colorResultBg);
	color: var(--colorResultText);
	margin-top: 4px !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
	color: var(--colorResultText);
}
/* InfraS change begin : bloc duplique (voir plus haut) aligne sur la meme regle */
.select2-container--default .select2-selection--single
 {
	 outline: none;
	 border: solid 1px var(--oblyon-input-border);
	 box-shadow: none !important;
	 border-radius: var(--oblyon-radius-sm);
 }
/* InfraS change end */
.select2-container--focus .select2-container--default .select2-selection--single {
	border-bottom-left-radius: 0;
	border-bottom-right-radius: 0;
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
	border-top: none;
	border-left: none;
	border-right: none;
	border-bottom-left-radius: 0;
	border-bottom-right-radius: 0;
}
.select2-container--default .select2-selection--multiple {
	border-bottom: solid 1px var(--inputbordercolor);
	border-top: none;
	border-left: none;
	border-right: none;
	border-radius: 3px;
	background: var(--inputbackgroundcolor);
	line-height: normal;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered {
	line-height: 1.4em;
}
.select2-selection--multiple input.select2-search__field {
	border-bottom: none !important;
}

.select2-search__field
{
	outline: none;
	border-top: none !important;
	border-left: none !important;
	border-right: none !important;
	border-bottom: solid 1px var(--inputbordercolor) !important;
	-webkit-box-shadow: none !important;
	box-shadow: none !important;
	border-radius: 0 !important;
	/* color: black; */
}
.select2-container-active .select2-choice, .select2-container-active .select2-choices
{
	outline: none;
	border-top: none;
	border-left: none;
	border-bottom: none;
	-webkit-box-shadow: none !important;
	box-shadow: none !important;
	background-color: var(--colorbackvmenu1);
}
.select2-dropdown {
	border: 1px solid var(--colorboxstatsborder);
	background-color: var(--colorbacklineimpair1) !important;
}
.select2-dropdown-open {
	background-color: var(--colorbacklineimpair1) !important;
}
.select2-dropdown-open .select2-choice, .select2-dropdown-open .select2-choices
{
	outline: none;
	border-top: none;
	border-left: none;
	border-bottom: none;
	-webkit-box-shadow: none !important;
	box-shadow: none !important;
	background-color: var(--colorbacklineimpair1) !important;
}
.select2-disabled
{
	color: #888;
}
.select2-drop.select2-drop-above.select2-drop-active, .select2-drop {
	border-radius: 0;
}
.select2-drop.select2-drop-above {
	border-radius:  0;
}
.select2-dropdown-open.select2-drop-above .select2-choice, .select2-dropdown-open.select2-drop-above .select2-choices {
	background-image: none;
	border-radius: 0 !important;
}
div.select2-drop-above
{
	background: var(--colorbackvmenu1);
	-webkit-box-shadow: none !important;
	box-shadow: none !important;
}
.select2-drop-active
{
	border: 1px solid #ccc;
	padding-top: 4px;
}
.select2-search input {
	border: none;
}
a span.select2-chosen
{
	font-weight: normal !important;
}
.select2-container .select2-choice {
	background-image: none;
	/* line-height: 24px; */
}
.select2-results .select2-no-results, .select2-results .select2-searching, .select2-results .select2-ajax-error, .select2-results .select2-selection-limit
{
	background: var(--colorbackvmenu1);
}
.select2-results {
	max-height:	400px;
}
.select2-results__option {
	word-break: break-word;
	text-align: var(--left);
}
.select2-container.select2-container-disabled .select2-choice, .select2-container-multi.select2-container-disabled .select2-choices {
	background-color: var(--colorbackvmenu1);
	background-image: none;
	border: none;
	cursor: default;
}
.select2-container-disabled .select2-choice .select2-arrow b {
	opacity: 0.4;
}
.select2-container-multi .select2-choices .select2-search-choice {
	margin-bottom: 3px;
}
.select2-dropdown-open.select2-drop-above .select2-choice, .select2-dropdown-open.select2-drop-above .select2-choices, .select2-container-multi .select2-choices,
.select2-container-multi.select2-container-active .select2-choices
{
	border-bottom: 1px solid #ccc;
	border-right: none;
	border-top: none;
	border-left: none;

}
.select2-container--default .select2-results>.select2-results__options{
	max-height: 400px;
}
.select2-container--default .select2-results__option[aria-selected=true] {
	background-color: var(--colorChipBg);
	color: var(--colorChipText);
}

/* Special case for the select2 add widget */
#addbox .select2-container .select2-choice > .select2-chosen, #actionbookmark .select2-container .select2-choice > .select2-chosen {
	text-align: var(--left);
	opacity: 0.4;
}
.select2-container--default .select2-selection--single .select2-selection__placeholder {
	color: unset;
	opacity: 0.4;
}
span#select2-boxbookmark-container, span#select2-boxcombo-container {
	text-align: var(--left);
	opacity: 0.4;
}
.select2-container .select2-selection--single .select2-selection__rendered {
	padding-left: 6px;
}
/* Style used before the select2 js is executed on boxcombo */
#boxbookmark.boxcombo, #boxcombo.boxcombo {
	text-align: left;
	opacity: 0.4;
	border-bottom: solid 1px rgba(0,0,0,.4) !important;
	height: 26px;
	line-height: 24px;
	padding: 0 0 2px 0;
	vertical-align: top;
}

/* To emulate select 2 style */
.select2-container-multi-dolibarr .select2-choices-dolibarr .select2-search-choice-dolibarr {
	padding: 3px 5px 3px 5px;
	margin: 0 0 2px 3px;
	position: relative;
	line-height: 13px;
	color: #333;
	cursor: default;
	border: 1px solid #aaaaaa;
	border-radius: 3px;
	-webkit-box-shadow: 0 0 2px #fff inset, 0 1px 0 rgba(0, 0, 0, 0.05);
	box-shadow: 0 0 2px #fff inset, 0 1px 0 rgba(0, 0, 0, 0.05);
	background-clip: padding-box;
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	background-color: #e4e4e4;
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), color-stop(100%, #eee));
	background-image: -webkit-linear-gradient(to top,  #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
	background-image: -moz-linear-gradient(to top,  #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
	background-image: linear-gradient(to bottom, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
}
.select2-container-multi-dolibarr .select2-choices-dolibarr .select2-search-choice-dolibarr a {
	font-weight: normal;
}
.select2-container-multi-dolibarr .select2-choices-dolibarr li {
	float: left;
	list-style: none;
}
.select2-container-multi-dolibarr .select2-choices-dolibarr {
	height: auto !important;
	height: 1%;
	margin: 0;
	padding: 0 5px 0 0;
	position: relative;
	cursor: text;
	overflow: hidden;
}
.select2-results__option {
	padding: 8px;
}
span.select2-dropdown--below {
	margin-top: -1px;
	min-width: 100px;
}
span.select2-dropdown--above {
	margin-bottom: -1px;
	min-width: 100px;
}

.parentonrightofpage {
	direction: rtl;
}

select.multiselectononeline {
	padding: 0;
	vertical-align: middle;
	min-height: unset;
	height: 2.2em !important;
	opacity: 0;
	/* width: 1px !important; */
}

@media only screen and (min-width: 768px)
{
	/* CSS to have the dropdown boxes larger that the input search area */
	.select2-container.select2-container--open:not(.graphtype, .limit, .combolargeelem):not(.yesno) .select2-dropdown.ui-dialog {
		min-width: 230px !important;
	}
	.select2-container.select2-container--open:not(.graphtype, .limit, .combolargeelem):not(.yesno) .select2-dropdown--below:not(.onrightofpage),
	.select2-container.select2-container--open:not(.graphtype, .limit, .combolargeelem):not(.yesno) .select2-dropdown--above:not(.onrightofpage) {
		min-width: 230px !important;
	}
	.onrightofpage span.select2-dropdown.ui-dialog.select2-dropdown--below,
	.onrightofpage span.select2-dropdown.ui-dialog.select2-dropdown--above {
		min-width: 140px !important;
	}
	.combolargeelem.select2-container.select2-container--open .select2-dropdown.ui-dialog {
		min-width: 320px !important;
	}

	.select2-container--open .select2-dropdown--below {
		border-top: 1px solid var(--inputbordercolor);
		/* border-top: 1px solid #aaaaaa; */
	}
}

/* must be after the other .select2-container.select2-container--open .select2-dropdown.ui-dialog */
.limit.select2-container.select2-container--open .select2-dropdown.ui-dialog {
	min-width: 100px !important;
}

/* ============================================================================== */
/*  For categories																*/
/* ============================================================================== */

.noborderoncategories {
	border: none !important;
	border-radius: 5px !important;
	box-shadow: none;
	-webkit-box-shadow: none !important;
	box-shadow: none !important;
}
span.noborderoncategories a, li.noborderoncategories a {
	line-height: normal;
}
span.noborderoncategories {
	padding: 3px 5px 3px 5px;
}
.categtextwhite, .treeview .categtextwhite.hover {
color: #fff !important;
}
.categtextblack {
color: #000 !important;
}

/* ============================================================================== */
/*  External lib multiselect with checkbox										*/
/* ============================================================================== */

.multi-select-menu {
	z-index: 10;
}

.multi-select-container {
	display: inline-block;
	position: relative;
}

.multi-select-menu {
	position: absolute;
	left: 0;
	top: 0.8em;
	float: left;
	min-width: 100%;
	background: var(--inputbackgroundcolor);
	margin: 1em 0;
	padding: 0.4em 0;
	border: 1px solid #aaa;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
	display: none;
}

div.multi-select-menu[role="menu"] {
	min-width: 220px !important;
}

.multi-select-menu input {
	margin-right: 0.3em;
	vertical-align: 0.1em;
}

.multi-select-button {
	display: inline-block;
	max-width: 20em;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
	vertical-align: middle;
	background-color: var(--inputbackgroundcolor);
	cursor: default;

	border: none;
	border-bottom: solid 1px var(--inputbordercolor);
	padding: 5px;
	padding-left: 2px;
	height: 17px;
}
.multi-select-button:focus {
	outline: none;
	border-bottom: 1px solid #666;
	border-bottom-left-radius: 0;
	border-bottom-right-radius: 0;
}

.multi-select-button:after {
	content: "";
	display: inline-block;
	width: 0;
	height: 0;
	border-style: solid;
	border-width: 0.5em 0.23em 0em 0.23em;
	border-color: #444 transparent transparent transparent;
	margin-left: 0.4em;
}

.multi-select-container--open .multi-select-menu { display: block; }

.multi-select-container--open .multi-select-button:after {
	border-width: 0 0.4em 0.4em 0.4em;
	border-color: transparent transparent #999 transparent;
}

.multi-select-menuitem {
	clear: both;
	float: left;
	padding-left: 5px
}
label.multi-select-menuitem {
	line-height: 24px;
	text-align: start;
}

#linktoobjectname {
	width:400px;
}
.maxwidthsearch .dropdown dt a span, .multiSel span {
	padding: 3px 3px 2px 3px;
}
.dropdown dd ul {
	background-color: var(--inputbackgroundcolor);
	box-shadow: 1px 1px 10px #aaa;
	display:none;
<?php print $right; ?>:0px;						/* pop is align on right */
	padding: 0 0 0 0;
	position:absolute;
	top:2px;
	list-style:none;
	max-height: 264px;
	overflow: auto;
	border-radius: 4px;
	z-index: 1;
}
.dropdown dd ul.selectedfieldsleft {
<?php print $right; ?>: auto;
}
.dropdown dd ul li {
	/* color: var(--colortext); */
	color: var(--colortext);
}
.dropdown dd ul li input[type="checkbox"] {
	margin-<?php print $right; ?>: 3px;
}
.dropdown dd ul li span {
	color: var(--oblyon-muted-text);	/* InfraS change : jeton 3.7.0 */
}
/*.dropdown dd ul li a:hover {
	background-color: var(--inputbackgroundcolor);
}*/
dd.dropdowndd ul li {
	text-overflow: ellipsis;
	overflow: hidden;
	white-space: nowrap;
}
