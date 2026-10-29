<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/tables.inc.php
   Role      : Listes et tableaux : titres, lignes, totaux, colonnes
   Inclus par : global.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/* ============================================================================== */
/* Tables																		 */
/* ============================================================================== */
.allwidth {
	width: 100%;
}

#undertopmenu {
	background-repeat: repeat-x;
	margin-top: <?php print ($dol_hide_topmenu?'6':'0'); ?>px;
}

.paddingrightonly {
	border-collapse: collapse;
	border: 0;
	margin-left: 0;
	spacing-left: 0;
	padding-<?php print $left; ?>: 0;
	padding-<?php print $right; ?>: 4px;
}

.nocellnopadd {
	list-style-type: none;
	margin: 0 !important;
	padding: 0 !important;
}

.noborderspacing {
	border-spacing: 0;
}
tr.nocellnopadd td.nobordernopadding, tr.nocellnopadd td.nocellnopadd
{
	border: 0px;
}

.unsetcolor {
	color: unset !important;
}

.smallpaddingimp {
	padding: 4px !important;
	padding-left: 7px !important;
	padding-right: 7px !important;
}
input.button[name="upload"] {
	padding: 5px !important;
	font-size: 0.9em;
}
input.button.smallpaddingimp, input.buttonreset.smallpaddingimp {
	font-size: 0.8em;
}
input.buttonreset {
	margin-top: 3px;
	margin-bottom: 3px;
	padding: 8px 15px;
	text-decoration: underline;
	color: var(--colortextlink);
	background-color: transparent;
	cursor: pointer;
}
.nopaddingleft {
	padding-<?php print $left; ?>: 0px;
}
div.tabs.nopaddingleft {
	padding-<?php print $left; ?>: 0px;
}
.nopaddingright {
	padding-<?php print $right; ?>: 0px;
}
.nopaddingtopimp {
	padding-top: 0px !important;
}
.nopaddingbottomimp {
	padding-bottom: 0px !important;
}

.notopnoleft {
	border: 0;
	border-collapse: collapse;
	margin-bottom: 10px;
	padding-top: 0;
	padding-<?php print $left; ?>: 0;
	padding-<?php print $right; ?>: 16px;
	padding-bottom: 4px;
}

.notopnoleftnoright {
	border: 0;
	border-collapse: collapse;
	margin: 0;
	padding-top: 0;
	padding-left: 0;
	padding-right: 0;
	padding-bottom: 4px;
}

table.border {
	border: 1px solid #f2f2f2;
	border-collapse: collapse;
}

table.border td {
	border: 1px solid var(--colortopbordertitle1);
	border-collapse: collapse;
	padding: 5px 2px 5px 2px;
	vertical-align: middle;
}

table.border td img { margin: 0 .1em; }
/* tableaux "border" imprimes hors de la carte (apres dol_get_fiche_end() : rapprochement bancaire, traductions produit / categorie, prix, documents,
   statistiques...) : poses sur le fond de page, leurs cellules n'avaient que le quadrillage --colortopbordertitle1 (blanc quand le liseret des titres est blanc : cases grises
   separees de traits blancs) ; ils prennent l'habillage d'une carte (fond des lignes, cadre arrondi, filets horizontaux, remplissage de la densite).
   Les tableaux DANS la carte (.tabBar) ne changent pas */
table.border:not(.tabBar table) {
	background: var(--colorbline);
	border: 1px solid var(--oblyon-border);
	border-radius: var(--oblyon-radius);
	border-collapse: separate;
	border-spacing: 0;
	overflow: hidden;
}
table.border:not(.tabBar table) > tbody > tr > td {
	border: 0;
	border-bottom: 1px solid var(--oblyon-border);
	padding: var(--oblyon-cell-py) var(--oblyon-cell-px);
}
table.border:not(.tabBar table) > tbody > tr:last-child > td {
	border-bottom: 0;
}

td.border {
	border: 1px solid #000;
}

/* Main boxes */

table.noborder,
table.formdoc,
div.noborder {
	border: 1px solid var(--oblyon-border);	/* InfraS change */
	border-collapse: separate !important;
	border-spacing: 0;
	box-shadow: var(--oblyon-shadow-sm);	/* InfraS change */
	border-radius: var(--oblyon-radius);	/* InfraS add */
	margin: 0 0 2px 0;
	/*padding: 1px 2px 1px 2px;*/
	width: 100%;
}

table.noborder[summary="list_of_modules"] tr.oddeven { line-height: 2.2em; }

table.noborder tr, div.noborder form {
	line-height: var(--oblyon-row-lh);	/* InfraS change */
}

/* boxes padding */
/* table titles main page */
table.noborder th { padding: var(--oblyon-cell-py) var(--oblyon-cell-px); }	/* InfraS change */

table.noborder th:first-child { padding-<?php print $left; ?>: 10px; }

table.noborder th:last-child { padding-<?php print $right; ?>: 10px; }

/* table content all pages */
table.noborder td, div.noborder form, div.noborder form div, table.tableforservicepart1 td, table.tableforservicepart2 td {
	padding: var(--oblyon-cell-py) var(--oblyon-cell-px);	/* InfraS change : densite unique */
	vertical-align: unset;
}

table.noborder td:first-child { padding-<?php print $left; ?>: 10px !important; }

table.noborder td:last-child, div.noborder form div:last-child { padding-<?php print $right; ?>: 10px; }

/* InfraS add begin : coins arrondis des tableaux (le fond des lignes de titre / total suit le rayon du cadre) */
table.noborder > thead > tr:first-child > th:first-child, table.noborder > thead > tr:first-child > td:first-child,
table.noborder > tbody:first-child > tr:first-child > th:first-child, table.noborder > tbody:first-child > tr:first-child > td:first-child,
table.noborder > tr:first-child > th:first-child, table.noborder > tr:first-child > td:first-child {
	border-top-<?php print $left; ?>-radius: calc(var(--oblyon-radius) - 1px);
}
table.noborder > thead > tr:first-child > th:last-child, table.noborder > thead > tr:first-child > td:last-child,
table.noborder > tbody:first-child > tr:first-child > th:last-child, table.noborder > tbody:first-child > tr:first-child > td:last-child,
table.noborder > tr:first-child > th:last-child, table.noborder > tr:first-child > td:last-child {
	border-top-<?php print $right; ?>-radius: calc(var(--oblyon-radius) - 1px);
}
table.noborder > tbody:last-child > tr:last-child > td:first-child, table.noborder > tbody:last-child > tr:last-child > th:first-child,
table.noborder > tr:last-child > td:first-child {
	border-bottom-<?php print $left; ?>-radius: calc(var(--oblyon-radius) - 1px);
}
table.noborder > tbody:last-child > tr:last-child > td:last-child, table.noborder > tbody:last-child > tr:last-child > th:last-child,
table.noborder > tr:last-child > td:last-child {
	border-bottom-<?php print $right; ?>-radius: calc(var(--oblyon-radius) - 1px);
}
/* InfraS add end */

/* titles others pages */
table.noborder .liste_titre td { padding: 3px; }

table.noborder .liste_titre td:first-child { padding-<?php print $left; ?>: 10px; }

table.noborder .liste_titre td:last-child { padding-<?php print $right; ?>: 10px; }

form#searchFormList div.liste_titre { padding: 3px 10px; }

.liste_titre_filter {
	background: var(--colorbtitle) !important;
}

table.liste .liste_titre th { padding: 5px; }

/* templates avec form au lieu de table */
div.noborder form div { padding: 3px; }

div.noborder form>div:first-child { padding-<?php print $left; ?>: 10px; }

div.noborder form div:last-child { padding-<?php print $right; ?>: 10px; }

table.nobordernopadding td img {
	margin-<?php print $left; ?>: .2em;
}

.flat+img {
	margin-<?php print $left; ?>: .4em;
}

table.nobordernopadding {
	border-collapse: collapse !important;
	border: 0;
}
table.nobordernopadding tr {
	border: 0 !important;
	padding: 0;
}

table.nobordernopadding tr td {
	border: 0 !important;
	padding: 0 3px 0 0;
	vertical-align: unset !important;
}
table.border tr td table.nobordernopadding tr td {
	padding-top: 0;
	padding-bottom: 0;
}
td.borderright {
	border: none;	/* to erase value for table.nobordernopadding td */
	border-right-width: 1px !important;
	border-right-color: #BBB !important;
	border-right-style: solid !important;
}

/* For lists */
table.liste {
	border: 1px solid var(--oblyon-border);	/* InfraS change */
	border-collapse: collapse;
	margin-bottom: 2px;
	margin-top: 2px;
	width: 100%;
}

table.liste .oddeven td { padding: var(--oblyon-cell-py) var(--oblyon-cell-px); }	/* InfraS change : densite unique */

table .liste_titre td { padding: 3px 6px; }	/* InfraS change */

table.liste td a img {
	vertical-align: middle;
	max-height: var(--tblImageMaxHeight);
}

.tagtable, .table-border { display: table; }
.tagtr, .table-border-row	{ display: table-row; }
.tagtd, .table-border-col, .table-key-border-col, .table-val-border-col { display: table-cell; }
.confirmquestions .tagtr .tagtd:not(:first-child)  { padding-left: 10px; }

tr.liste_titre,
tr.liste_titre_sel,
form.liste_titre,
form.liste_titre_sel {
	height: 20px !important;
}

div.liste_titre {
	padding: 6px;
	margin-bottom: 12px;
}

div.liste_titre,
tr.liste_titre,
tr.liste_titre_sel,
form.liste_titre,
form.liste_titre_sel {
	background-color: var(--colorbtitle);
	color: var(--colortexttitle);
	font-family: var(--fontfamilydol);
	font-size: 1em;
	font-weight: normal;
	line-height: 1em;
	text-align: var(--left);
	white-space: normal;
}

div.liste_titre a,
tr.liste_titre a,
tr.liste_titre th a,
tr.liste_titre_sel a,
th.liste_titre_sel a,
form.liste_titre a,
form.liste_titre_sel a {
	color: var(--colortexttitle) !important;
}

.liste_titre_sel { font-weight: bold!important; }

tr.liste_titre th,
th.liste_titre,
tr.liste_titre td,
td.liste_titre,
form.liste_titre div,
div.liste_titre {
	font-family: var(--fontfamilydol);
	font-weight: normal;
	/* border-bottom: 1px solid #FDFFFF;*/
	white-space: normal;
	padding-left: 5px;
}

table td.liste_titre a:link,
table td.liste_titre a:visited,
table td.liste_titre a:active { color: var(--colortexttitle); }	/* InfraS change */

table td.liste_titre a:hover { color: var(--maincolor); }

table.noborder tr td a:link,
table.noborder tr td a:visited,
table.noborder tr td a:active,
table.noborder tr th a:link,
table.noborder tr th a:visited,
table.noborder tr th a:active {
	color: var(--colorfline);
	font-family: var(--fontfamilydol);
}

table.noborder tr td a:hover { color: var(--colorfline_hover); }

table.noborder tr td a.button,
table.noborder tr td a.button:hover { color: var(--colorTextButtonAction); }	/* InfraS change */

.liste tr.liste_titre:nth-child(3) {
	background-color: var(--colorbtitle);
}

tr.liste_titre:nth-child(3) {
	background-color: var(--colorbtitle);
}

th.liste_titre>img,
th.liste_titre_sel>img {
	padding-<?php print $left; ?>: 5px;
}

input.liste_titre {
	margin: inherit;
	padding: 0;
}

tr.liste_total td {
<?php if (getDolGlobalString('THEME_ELDY_TOTAL_BACKGROUND_LIKE_HEAD', '1') != '0') { ?>
	background-color: var(--colorbtitle) !important;
	color: var(--colortexttitle) !important;
<?php } else { // B3 OFF : couleurs dédiées OBLYON_COLOR_BTOTAL / OBLYON_COLOR_FTOTAL ?>
	background-color: var(--colorbtotal) !important;
	color: var(--colorftotal) !important;
<?php } ?>
	font-weight: bold !important;
}

tr.liste_total,
form.liste_total {
	background-color: var(--colorbline);
}

tr.liste_total td,
form.liste_total div {
	height: 20px;
	border-top: 1px solid var(--oblyon-border-strong);	/* InfraS change */
	color: var(--maincolor);
	font-weight: normal;
	white-space: normal;
	padding: 0 5px 0 5px;
}

tr.liste_total td[align=right],
form.liste_total td[align=right] {
	color: var(--colortext);	/* InfraS change : vert #3c6 code en dur retire */
	font-weight: bold;
}

/* Disable shadows */
.noshadow,
div.tabBar .noborder {
	box-shadow: 0 0 0 rgba(0,0,0, .24) !important;
	-moz-box-shadow: 0 0 0 rgba(0,0,0, .24) !important;
	-webkit-box-shadow: 0 0 0 rgba(0,0,0, .24) !important;
}
div.tabBar div.border .table-border-row, div.tabBar div.border .table-key-border-col, div.tabBar .table-val-border-col {
	vertical-align: middle;
}
div .tdtop {
	vertical-align: top !important;
	padding-top: 5px !important;
	padding-bottom: 0px !important;
}

/*
 *  Boxes
 */

.box {
	<?php if (!getDolGlobalString('FIX_STICKY_HEADER_CARD')) { ?>
		overflow-x: auto;
	<?php } ?>
	min-height: 40px;
	padding-right: 0px;
	padding-left: 0px;
	/*padding-bottom: 25px;*/
	padding-bottom: 10px;
}
.ficheaddleft div.boxstats, .ficheaddright div.boxstats {
	border: none;
}
.boxstats, .boxstats130 {
	display: inline-block;
	margin-left: 8px;
	margin-right: 8px;
	margin-top: 5px;
	margin-bottom: 5px;
	text-align: center;
	<?php if(oblyon_color_setting('OBLYON_INFOXBOX_BACKGROUND')) { // InfraS change ?>
		background: <?php print oblyon_color_setting('OBLYON_INFOXBOX_BACKGROUND'); ?> !important;	/* InfraS change */
	<?php } else { ?>
	background: var(--colorbline);	/* InfraS change */
	<?php } ?>
	/* InfraS change begin : carte plate (plus de barre laterale de 6 px) : cadre neutre, filet d'accent en haut, rayon et ombre des jetons */
	border: 1px solid var(--oblyon-border);
	border-top: 3px solid var(--colorboxstatsborder);
	border-radius: var(--oblyon-radius);
	box-shadow: var(--oblyon-shadow-sm);
	transition: box-shadow var(--oblyon-transition);
	/* InfraS change end */
}
.boxstats:hover, .boxstats130:hover {
	box-shadow: var(--oblyon-shadow-md);	/* InfraS add */
}
.boxstats, .boxstats130, .boxstatscontent {
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}
.boxstats {
	height: 59px;
	/* padding: 3px; */
}
.boxstats {
	padding-left: 3px;
	padding-right: 3px;
	padding-top: 2px;
	padding-bottom: 2px;
	width: 118px;
}
.tabBar .fichehalfright .boxstats {
	padding-top: 8px;
	padding-bottom: 4px;
}
.boxstatscontent {
	padding: 3px;
}
.boxstatsempty {
	width: 121px;
	padding-left: 3px;
	padding-right: 3px;
	margin-left: 8px;
	margin-right: 8px;
}
.boxstats150empty {
	width: 158px;
	padding-left: 3px;
	padding-right: 3px;
	margin-left: 8px;
	margin-right: 8px;
}

@media only screen and (max-width: 767px)
{
	.boxstats, .boxstats130 {
		margin: 3px;
		border: 1px solid var(--oblyon-border);	/* InfraS change */
		box-shadow: none;
		background: var(--oblyon-neutral-bg);	/* InfraS change */
	}
	.thumbstat {
		flex: 1 1 110px;
	}
	.thumbstat150 {
		flex: 1 1 110px;
	}
	.dashboardlineindicator {
		float: left;
		padding-left: 5px;
	}
	.boxstats130 {
		width: 148px;
	}
	.boxstats {
		width: 100px;
	}
}
.boxstats:hover {
	box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.20);
}
span.boxstatstext {
	opacity: 0.7;
	line-height: 18px;
	color: var(--colortextlink);
}
span.boxstatstext img, a.dashboardlineindicatorlate img {
	border: 0;
}
a img {
	border: 0;
}
.boxstatsindicator.thumbstat150 {	/* If we remove this, box position is ko on ipad */
	display: inline-flex;
}
span.boxstatsindicator {
	font-size: 130%;
	font-weight: normal;
	line-height: 29px;
}
span.dashboardlineindicator, span.dashboardlineindicatorlate {
	font-size: 130%;
	font-weight: normal;
}
a.dashboardlineindicatorlate:hover {
	text-decoration: none;
}
.dashboardlineindicatorlate img {
	width: 16px;
}
span.dashboardlineok {
	color: var(--amountpaymentcomplete);
}
span.dashboardlineko {
	color: #FFF;
	/*color: #8c4446 ! important;
	padding-left: 1px;*/

	font-size: 80%;
}
.dashboardlinelatecoin {
	float: right;
	position: relative;
	text-align: right;
	top: -27px;
	right: 2px;
	padding: 0px 5px 0px 5px;
	border-radius: .25em;

	background-color: #9f4705;
}
.imglatecoin {
	padding: 1px 3px 1px 1px;
	margin-left: 4px;
	margin-right: 2px;
	background-color: #8c4446;
	color: #FFFFFF ! important;
	border-radius: .25em;
	display: inline-block;
	vertical-align: middle;
}
.boxtable {
	margin-bottom: 8px !important;
	border-bottom-width: 1px;

	border-top: var(--borderwidth) solid var(--colortopbordertitle1);
	/* border-top: 2px solid var(--colorbackhmenu1) !important; */
}
table.noborder.boxtable tr td {
	height: unset;
}
.boxtablenotop {
	border-top-width: 0 !important;
}
.boxtablenobottom {
	border-bottom-width: 0 !important;
}
.boxtable .fichehalfright, .boxtable .fichehalfleft {
	min-width: 275px;	/* increasing this, make chart on box not side by side on laptops */
}
.tdboxstats {
	text-align: center;
}
.boxworkingboard .tdboxstats {
	padding-left: 1px !important;
	padding-right: 1px !important;
}
a.valignmiddle.dashboardlineindicator {
	line-height: 30px;
}

tr.box_titre {
	height: 26px;

	/* TO MATCH BOOTSTRAP */
	/*background: #ddd;
	color: #000 !important;*/

	/* TO MATCH ELDY */
	background: var(--colorbtitle);
	color: var(--colortexttitle);
	font-family: var(--fontfamilydol), sans-serif;
	font-weight: <?php print $useboldtitle?'bold':'normal'; ?>;
	border-bottom: 1px solid var(--oblyon-border);	/* InfraS change */
	white-space: nowrap;
}

tr.box_titre td.boxclose {
	width: 90px;
}
img.boxhandle, img.boxclose {
	padding-left: 5px;
}

.formboxfilter {
	vertical-align: middle;
	margin-bottom: 6px;
}
.formboxfilter input[type=image]
{
	top: 5px;
	position: relative;
}
.boxfilter {
	margin-bottom: 2px;
	margin-right: 1px;
}
.prod_entry_mode_free, .prod_entry_mode_predef {
	height: 26px !important;
	vertical-align: middle;
}

.modulebuilderbox {
	border: 1px solid #888;
	padding: 16px;
}

/*
*  External web site
*/

.framecontent {
	width: 100%;
	height: 100%;
}

.framecontent iframe {
	width: 100%;
	height: 100%;
}

/*
*  Other
*/
.opened-dash-board-wrap {
	margin-bottom: 25px;
}

div.boximport {
	min-height: unset;
}

.product_line_stock_ok { color: var(--colorStockOk); }	/* InfraS change : jeton 3.7.0 */
.product_line_stock_too_low { color: var(--colorStockLow); }	/* InfraS change : jeton 3.7.0 */

.fieldrequired { color: var(--colorfline); font-weight: bold; }

.widthpictotitle { width: 40px; font-size: 1.5em; text-align: var(--left); }

.dolgraphtitle { margin-top: 6px; margin-bottom: 4px; }
.legendColorBox, .legendLabel { border: none !important; }
div.dolgraph div.legend, div.dolgraph div.legend div { background-color: rgba(255,255,255,0) !important; }
div.dolgraph div.legend table tbody tr { height: auto; }
td.legendColorBox { padding: 2px 2px 2px 0 !important; }
td.legendLabel { padding: 2px 2px 2px 0 !important; }

label.radioprivate {
	white-space: nowrap;
}

.photo {
	border: 0px;
}
.photowithmargin {
	margin-bottom: 2px;
	margin-top: 2px;
}
.photowithborder {
border: 1px solid #f0f0f0;
}
.photointoolitp {
	margin-top: 8px;
	float: left;
	/*text-align: center; */
}
.photodelete {
	margin-top: 6px !important;
}

.nographyet
{
	content:url(<?php print dol_buildpath($path.'/theme/'.$theme.'/img/nographyet.svg',1) ?>);
	display: inline-block;
	opacity: 0.1;
	background-repeat: no-repeat;
}
.nographyettext
{
	opacity: 0.5;
}

table.notopnoleftnoright div.titre {
	font-size: 13px;
	text-transform: uppercase;
}

div.titre {
	color: var(--colorstitle);
	font-weight: 600;	/* InfraS change */
	font-size: 1.25em;	/* InfraS change : titre de page un peu plus grand */
	text-decoration: none;
	padding-top: 6px;
	padding-bottom: 6px;
}

table.table-fiche-title .col-title div.titre{
	line-height: 40px;
}
table.table-fiche-title {
	margin-bottom: 5px;
}

/*div.backgreypublicpayment { background-color: #f0f0f0; padding: 20px; border-bottom: 1px solid #ddd; }	*/
.backgreypublicpayment a { color: #222 !important; }
.poweredbypublicpayment {
	float: right;
	top: 8px;
	right: 8px;
	position: absolute;
	font-size: 0.8em;
	color: #222;
	opacity: 0.3;
}

#dolpaymenttable { min-width: 320px; font-size: 16px; }	/* Width must have min to make stripe input area visible */
#tablepublicpayment { border: 1px solid #CCCCCC !important; width: 100%; padding: 20px; }
/* #tablepublicpayment .CTableRow1  { background-color: #F0F0F0 !important; }	*/
#tablepublicpayment tr.liste_total { border-bottom: 1px solid #CCCCCC !important; }
#tablepublicpayment tr.liste_total td { border-top: none; }

.titlepublicpayment {
	font-size: 24px;
}

td.CTableRow1 {
	padding: 4px 1px 4px 4px; /* t r b l */
}

td.CTableRow2 {
	padding: 4px 4px 4px 12px; /* t r b l */
}

div#login_left, div#login_right {
	min-width: 150px !important;
	max-width: 200px !important;
	padding-left: 5px !important;
	padding-right: 5px !important;
	vertical-align: middle;
}
div.login_block {
	height: 40px !important;
}

.divmainbodylarge { margin-left: 40px; margin-right: 40px; }
#divsubscribe { max-width: 900px; }
#tablesubscribe { width: 100%; }

div#card-element {
	border: 1px solid #ccc;
}
div#card-errors {
	color: #fa755a;
	text-align: center;
	padding-top: 3px;
	max-width: 320px;
}

/*
*   Liens Payes/Non payes
*/

a.normal:link { font-weight: normal }
a.normal:visited { font-weight: normal }
a.normal:active { font-weight: normal }
a.normal:hover { font-weight: normal }

a.impayee:link { font-weight: bold; color: var(--colorunpaid); }
a.impayee:visited { font-weight: bold; color: var(--colorunpaid); }
a.impayee:active { font-weight: bold; color: var(--colorunpaid); }
a.impayee:hover { font-weight: bold; color: var(--colorunpaid); }

.ui-dialog-content {
font-size: var(--fontsize) !important;
}

/**
* When HTML is used
*/

table.valid {
	background-color: var(--colorErrorBg);	/* InfraS change */
	border: 1px solid var(--colorErrorBorder);	/* InfraS change */
	box-shadow: var(--oblyon-shadow-sm);	/* InfraS change */
	border-radius: var(--oblyon-radius-sm);	/* InfraS add */
	margin: .5em 0em;
	padding: 1.2em 1.5em;
}

table.valid img { vertical-align: sub; }

.validtitre { font-weight: bold; }

/*------------------------------------*\
#Tooltips
\*------------------------------------*/
/* For tooltip using dialog */
.ui-dialog.highlight.ui-widget.ui-widget-content.ui-front {
	z-index: 97;
}
div.ui-tooltip {
	max-width: <?php print dol_size(600,'width'); ?>px !important;
}
/* InfraS change begin : infobulle plate (plus de biseau 3D), couleurs du theme, rayon et ombre des jetons */
.mytooltip {
	width: <?php print dol_size(450,'width'); ?>px;
	border: solid 1px var(--oblyon-border-strong);
	background: var(--tooltipbgcolor);
	color: var(--tooltipfontcolor);
	padding: 8px 16px;
	border-radius: var(--oblyon-radius-sm);
	box-shadow: var(--oblyon-shadow-md);
	margin: 2px;
}

.login_block_elem img.calculator-trigger,
.login_block_other img.calculator-trigger {
	display: block;
	margin: 0 !important;
	padding: 12px !important;
}

.calculator-popup {
	top: 56px !important;
	width: 260px !important;
}

/*------------------------------------*\
#BreadCrumb Module
\*------------------------------------*/

.breadCrumb {
	border: none !important;
	margin-bottom: 10px;
	/* margin-left: 20px;
	margin-right: 15px;*/
}
