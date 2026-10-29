<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/public.inc.php
   Role      : Kanban, JMobile, POS, pages publiques, tickets, debugbar, copier-coller, cartes de visite, sondages, BookCal
   Inclus par : global.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/* ============================================================================== */
/* Kanban																		 */
/* ============================================================================== */

.info-box-label {
	max-width: 180px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}

/* ============================================================================== */
/*  JMobile - Android															 */
/* ============================================================================== */

.searchpage .tagtr .tagtd {
	padding-top: 2px;
}
.searchpage .searchform input {
	font-size: 1.15em;
}
.ui-body-c {
	background: #fff;
}

.ui-btn-inner {
	min-width: .4em;
	padding-left: 6px;
	padding-right: 6px;
	font-size: <?php print is_numeric($fontsize) ? $fontsize.'px' : $fontsize; ?>;
	/* white-space: normal; */		/* Warning, enable this break the truncate feature */
}
.ui-mobile fieldset {
	padding-bottom: 10px; margin-bottom: 4px;
}
.alilevel0 {
	font-weight: normal !important;
}

/* ============================================================================== */
/*  POS																		   */
/* ============================================================================== */

.menu_choix1 a {
	background: url('<?php print dol_buildpath($path.'/theme/'.$theme.'/img/menus/money.png', 1) ?>') top left no-repeat;
	background-position-y: 15px;
}

.menu_choix2 a {
	background: url('<?php print dol_buildpath($path.'/theme/'.$theme.'/img/menus/home.png', 1) ?>') top left no-repeat;
	background-position-y: 15px;
}
@media only screen and (max-width: 767px)
{
	.menu_choix1 a, .menu_choix2 a {
		background-position-y: 6px;
	}
}
.publicnewmemberform div.tabBarWithBottom {
	border: 1px solid #e8e8e8;
	padding: 30px;
	border-radius: 8px;
	background-color: var(--colorbackgrey);
	/*box-shadow: 2px 2px 10px #ddd;*/
}

.publicnewmemberform #tablesubscribe {
	color: var(--colortextbackvmenu);
}

@media only screen and (max-width: 768px)
{
	.publicnewmemberform div.tabBarWithBottom {
		padding: 10px;
	}
}

/* ============================================================================== */
/* Ticket module																  */
/* ============================================================================== */

#KWwithajax ul {
	padding-left: 20px;
}
@media only screen and (max-width: 768px)
{
	.ticketlargemargin {
		padding-left: 5px; padding-right: 5px;
		padding-top: 10px;
	}
	.ticketpublicarea {
		margin-left: 10px;
		margin-right: 10px;
	}
}

.cd-timeline-content {
	position: relative;
	margin-left: 60px;
	background: white;
	border-radius: 0.25em;
	padding: 1em;
	background-image: -o-linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
	background-image: -moz-linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
	background-image: -webkit-linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
	background-image: -ms-linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
	background-image: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
}
.cd-timeline-content .cd-date {
	font-size: 13px;
	font-size: 0.8125rem;
}
.cd-timeline-content .cd-date {
	display: inline-block;
}
.cd-timeline-content::before {
	content: '';
	position: absolute;
	top: 16px;
	right: 100%;
	height: 0;
	width: 0;
	border: 7px solid transparent;
	border-right: 7px solid white;
}

@media only screen and (min-width: 1170px) {
	.cd-timeline-content::before {
		top: 24px;
		left: 100%;
		border-color: transparent;
		border-left-color: white;
	}
	.cd-timeline-block:nth-child(even) .cd-timeline-content::before {
		top: 24px;
		left: auto;
		right: 100%;
		border-color: transparent;
		border-right-color: white;
	}

}
div.refid {
	font-weight: bold;
	color: var(--colortexttitlenotab);
	font-size: 160%;
}
div.refidno	{
	padding-top: 2px;
	font-weight: normal;
	color: var(--colorfline);
	font-size: var(--fontsize);
	line-height: 21px;
}
div.refidno form {
	display: inline-block;
}
div.pagination {
	float: right;
}
div.pagination a {
	font-weight: normal;
}
div.pagination ul
{
	list-style: none;
	display: inline-block;
	padding-left: 0px;
	padding-right: 0px;
	margin: 0;
}
div.pagination li {
	display: inline-block;
	padding-left: 0px;
	padding-right: 0px;
	padding-top: 6px;
	padding-bottom: 5px;
}
.pagination {
	display: inline-block;
	padding-left: 0;
	border-radius: var(--oblyon-radius-sm);	/* InfraS change */
}

div.pagination li.pagination a,
div.pagination li.pagination span {
	padding: 6px 12px;
	padding-top: 8px;
	line-height: 1.4;	/* InfraS change */
	color: var(--colortextlink);
	text-decoration: none;
	border-radius: var(--oblyon-radius-sm);	/* InfraS add */
	transition: background-color var(--oblyon-transition);	/* InfraS add */
}
div.pagination li.pagination span.inactive {
	cursor: default;
	color: var(--colortextlink);
}

div.pagination li.litext {
	padding-top: 8px;
}
div.pagination li.litext a {
	border: none;
	padding-right: 10px;
	padding-left: 4px;
	font-weight: bold;
}
div.pagination li.noborder a:focus,
div.pagination li.noborder a:hover {
	border: none;
	background-color: transparent;
}
div.pagination li:first-child a,
div.pagination li:first-child span {
	margin-left: 0;
}
div.pagination li a:hover,
div.pagination li span:hover,
div.pagination li a:focus,
div.pagination li span:focus {
	color: var(--colortextbacktab);
	background-color: var(--oblyon-neutral-bg);	/* InfraS change */
	border-color: var(--oblyon-border);	/* InfraS change */
}
div.pagination li .active a,
div.pagination li .active span,
div.pagination li .active a:hover,
div.pagination li .active span:hover,
div.pagination li .active a:focus,
div.pagination li .active span:focus {
	z-index: 2;
	color: #fff;
	cursor: default;
	background-color: var(--maincolor);
	border-color: var(--colorstatusprimary);
}
div.pagination .disabled span,
div.pagination .disabled span:hover,
div.pagination .disabled span:focus,
div.pagination .disabled a,
div.pagination .disabled a:hover,
div.pagination .disabled a:focus {
	color: var(--oblyon-muted-text);	/* InfraS change */
	cursor: not-allowed;
	background-color: transparent;	/* InfraS change */
	border-color: var(--oblyon-border);	/* InfraS change */
}
div.pagination li.pagination .active {
	text-decoration: underline;
	box-shadow: none;
}
.paginationafterarrows .nohover {
	box-shadow: none !important;
}
div.pagination li.paginationafterarrows {
	margin-left: 10px;
}
.paginationatbottom {
	margin-top: 9px;
}

/* Set the color for hover lines */
.oddeven:hover, .evenodd:hover, .impair:hover, .pair:hover
{
	background: var(--colorbline_hover) !important;		/* Must be background to be stronger than background of odd or even */
	color: var(--colorfline_hover) !important;
}
.tredited, .tredited td {
	background: var(--colorbline_hover) !important;   /* Must be background to be stronger than background of odd or even */
	color: var(--colorfline_hover) !important;
	border-bottom: 0 !important;
}
.treditedlinefordate {
	background: var(--colorbline_hover) !important;   /* Must be background to be stronger than background of odd or even */
	color: var(--colorfline_hover) !important;
	border-bottom: 0px;
}
<?php if ($colorbline_checked) { ?>
.highlight {
	background: var(--colorbacklinepairchecked) !important;
	color: var(--colorfline_hover) !important;
}
<?php } ?>

.nohover:hover {
	background: unset;
}
.nohoverborder:hover {
	border: unset;
	box-shadow: unset;
	-webkit-box-shadow: unset;
}
.oddeven, .evenodd, .impair, .nohover .impair:hover, tr.impair td.nohover, .tagtr.oddeven
{
	font-family: var(--fontfamilydol);
	margin-bottom: 1px;
	color: var(--colortext);
}
.impair, .nohover .impair:hover, tr.impair td.nohover
{
	background: #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair1)); ?>;
}
#GanttChartDIV {
	background-color: #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair1)); ?>;
}

.oddeven, .evenodd, .pair, .nohover .pair:hover, tr.pair td.nohover, .tagtr.oddeven {
	font-family: var(--fontfamilydol);
	margin-bottom: 1px;
	color: var(--colortext);
}
.pair, .nohover .pair:hover, tr.pair td.nohover {
	background-color: #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?>;
}

table.dataTable tr.oddeven {
	background-color: #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?> !important;
}

/* For no hover style */
td.oddeven, tr.nohover td, form.nohover, form.nohover:hover {
	/*
	background-color: #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair1)); ?> !important;
	background: #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair1)); ?> !important;
	*/
}
td.evenodd {
	background-color: #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?> !important;
	background: #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?> !important;
}
.trforbreak td {
	background-color: #<?php print colorArrayToHex(colorStringToArray($colorbacklinebreak)); ?> !important;
}
.trforbreak td, table.noborder tr.trforbreak td a:link {
	color: var(--colortext);	/* InfraS change */
}

table.dataTable td {
	padding: var(--oblyon-cell-py) var(--oblyon-cell-px) !important;	/* InfraS change */
}
tr.pair td, tr.impair td, form.impair div.tagtd, form.pair div.tagtd, div.impair div.tagtd, div.pair div.tagtd, div.liste_titre div.tagtd {
	padding: var(--oblyon-cell-py) var(--oblyon-cell-px);	/* InfraS change : densite unique (compacte) */
	border-bottom: 1px solid var(--oblyon-border);	/* InfraS change */
}
form.pair, form.impair {
	font-weight: normal;
}
form.tagtr:last-of-type div.tagtd, tr.pair:last-of-type td, tr.impair:last-of-type td {
	border-bottom: 0px !important;
}
tr.nobottom td {
	border-bottom: 0px !important;
}
div.tableforcontact form.tagtr:last-of-type div.tagtd {
	border-bottom: 1px solid var(--oblyon-border) !important;	/* InfraS change */
}
tr.pair td .nobordernopadding tr td, tr.impair td .nobordernopadding tr td {
	border-bottom: 0px !important;
}
table.nobottomiftotal tr.liste_total td {
	background-color: <?php print colorDarker($colorbtitle, 5); ?>;
	border-bottom: 0px !important;
}
table.nobottom, td.nobottom {
	border-bottom: 0px !important;
}
div.liste_titre .tagtd {
	vertical-align: middle;
}
div.liste_titre {
	min-height: 26px !important;	/* We cant use height because it's a div and it should be higher if content is more. but min-height does not work either for div */

	padding-top: 2px;
	padding-bottom: 2px;
}
div.liste_titre_bydiv {
	border-top-width: var(--borderwidth);
	border-top-color: var(--colortopbordertitle1);
	border-top-style: solid;

	border-collapse: collapse;
	display: table;
	padding: 2px 0px 2px 0;
	box-shadow: none;
	/*width: calc(100% - 1px);	1px more, i don't know why so i remove */
	width: calc(100%);
}
tr.liste_titre, tr.liste_titre_sel, form.liste_titre, form.liste_titre_sel, table.dataTable.tr, tagtr.liste_titre
{
	height: 26px !important;
}
div.colorback	/* for the form "assign user" on time spent view */
{
	background: var(--oblyon-neutral-bg);	/* InfraS change */
	padding: 10px;
	margin-top: 5px;
	border: 1px solid var(--oblyon-border);	/* InfraS change */
	border-radius: var(--oblyon-radius-sm);	/* InfraS add */
}
div.liste_titre_bydiv, .liste_titre div.tagtr, tr.liste_titre, tr.liste_titre_sel, .tagtr.liste_titre, .tagtr.liste_titre_sel, form.liste_titre, form.liste_titre_sel, table.dataTable thead tr
{
	/*background: var(--colorbacktitle1);*/
	/*font-weight: <?php print $useboldtitle ? 'bold' : 'normal'; ?>;*/
	font-weight: normal;

	color: var(--colortexttitle);
	font-family: var(--fontfamilydol);
	text-align: var(--left);
}
tr.liste_titre th, tr.liste_titre td, th.liste_titre
{
	border-bottom: 1px solid var(--colortopbordertitle1);
}
tr.liste_titre:first-child th, tr:first-child th.liste_titre {
	/*	border-bottom: 1px solid #ddd ! important; */
	border-bottom: unset;
}
tr.liste_titre th, th.liste_titre, tr.liste_titre td, td.liste_titre, form.liste_titre div
{
	font-family: var(--fontfamilydol);
	font-weight: <?php print $useboldtitle ? 'bold' : 'normal'; ?>;
	vertical-align: middle;
	height: var(--oblyon-head-h);	/* InfraS change */
}
tr.liste_titre th a, th.liste_titre a, tr.liste_titre td a, td.liste_titre a, form.liste_titre div a, div.liste_titre a {
	text-shadow: none !important;
}
tr.liste_titre_topborder td {
	border-top-width: var(--borderwidth);
	border-top-color: var(--colortopbordertitle1);
	border-top-style: solid;
}
.liste_titre td a {
	text-shadow: none !important;
	color: var(--colortexttitle);
}
.liste_titre td a.notasortlink {
	color: var(--colortextlink);
}
.liste_titre td a.notasortlink:hover {
	background: transparent;
}
tr.liste_titre:last-child th.liste_titre, tr.liste_titre:last-child th.liste_titre_sel, tr.liste_titre td.liste_titre, tr.liste_titre td.liste_titre_sel, form.liste_titre div.tagtd {				/* For last line of table headers only */
	/* border-bottom: 1px solid #ddd; */
	border-bottom: unset;
}

div.liste_titre {
	padding-left: 3px;
}
tr.liste_titre_sel th, th.liste_titre_sel, tr.liste_titre_sel td, td.liste_titre_sel, form.liste_titre_sel div
{
	font-family: var(--fontfamilydol);
	color: var(--colortexttitle) !important;
	font-weight: bold;
	background-color: <?php print colorDarker($colorbtitle, 5); ?>;
	/* Test
	text-decoration: underline;
	border-bottom: 8px solid var(--colortexttitle) !important;
	border-radius: 0.25rem;
	*/
}
input.liste_titre {
	background: transparent;
	border: 0px;
}
.listactionlargetitle .liste_titre {
	line-height: 24px;
}
.noborder tr.liste_total td, tr.liste_total td, form.liste_total div, .noborder tr.liste_total_wrap td, tr.liste_total_wrap td, form.liste_total_wrap div {
	color: var(--colortext);
	font-weight: bold;
}
.noborder tr.liste_total td, tr.liste_total td, form.liste_total div {
	white-space: nowrap;
}
.noborder tr.liste_total_wrap td, tr.liste_total_wrap td, form.liste_total_wrap div {
	white-space: normal;
}
form.liste_total div {
	border-top: 1px solid var(--oblyon-border);	/* InfraS change */
}
tr.liste_sub_total, tr.liste_sub_total td {
	border-bottom: 1px solid var(--oblyon-border-strong);	/* InfraS change */
}
/* to avoid too much border on contract card */
.tableforservicepart1 .impair, .tableforservicepart1 .pair, .tableforservicepart2 .impair, .tableforservicepart2 .pair {
	background: var(--colorbline);	/* InfraS change */
}
.tableforservicepart1 tbody tr td, .tableforservicepart2 tbody tr td {
	border-bottom: none;
}
table.tableforservicepart1:first-of-type tr:first-of-type td {
	border-top: 1px solid var(--oblyon-border-strong);	/* InfraS change */
}
table.tableforservicepart1 tr td {
	border-top: 0px;
}

.paymenttable, .margintable {
	/*border-top-width: var(--borderwidth) !important;
	border-top-color: <?php print $colortopbordertitle1 ?> !important;
	border-top-style: solid !important;*/
	border-top: none !important;
	margin: 0px 0px 0px 0px !important;
}
table.noborder.paymenttable {
	border-bottom: none !important;
}
.paymenttable tr td:first-child, .margintable tr td:first-child
{
	padding-left: 2px;
}
.paymenttable, .margintable tr td {
	height: 22px;
}

/* Disable-Enable shadows */
.noshadow {
	-webkit-box-shadow: 0px 0px 0px #DDD !important;
	box-shadow: 0px 0px 0px #DDD !important;
}
.shadow {
	-webkit-box-shadow: 2px 2px 5px #CCC !important;
	box-shadow: 2px 2px 5px #CCC !important;
}

div.tabBar .noborder {
	-webkit-box-shadow: 0px 0px 0px #DDD !important;
	box-shadow: 0px 0px 0px #DDD !important;
}

#tablelines tr.liste_titre td, .paymenttable tr.liste_titre td, .margintable tr.liste_titre td, .tableforservicepart1 tr.liste_titre td {
	border-bottom: 1px solid var(--colortopbordertitle1) !important;
}
#tablelines tr td {
	height: unset;
}

/* Prepare to remove class pair - impair */
.noborder > tbody > tr:nth-child(even):not(.liste_titre), .liste > tbody > tr:nth-child(even):not(.liste_titre),
div:not(.fichecenter):not(.fichehalfleft):not(.fichehalfright):not(.ficheaddleft) > .border > tbody > tr:nth-of-type(even):not(.liste_titre), .liste > tbody > tr:nth-of-type(even):not(.liste_titre),
div:not(.fichecenter):not(.fichehalfleft):not(.fichehalfright):not(.ficheaddleft) .oddeven.tagtr:nth-of-type(even):not(.liste_titre)
{
	background: linear-gradient(to bottom, #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair1)); ?> 85%, #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair2)); ?> 100%);
	background: -o-linear-gradient(to bottom, #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair1)); ?> 85%, #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair2)); ?> 100%);
	background: -moz-linear-gradient(to bottom, #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair1)); ?> 85%, #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair2)); ?> 100%);
	background: -webkit-linear-gradient(to bottom, #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair1)); ?> 85%, #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair2)); ?> 100%);
	background: -ms-linear-gradient(to bottom, #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair1)); ?> 85%, #<?php print colorArrayToHex(colorStringToArray($colorbacklineimpair2)); ?> 100%);
}
.noborder > tbody > tr:nth-child(even):not(:last-child) td:not(.liste_titre), .liste > tbody > tr:nth-child(even):not(:last-child) td:not(.liste_titre),
.noborder .oddeven.tagtr:nth-child(even):not(:last-child) .tagtd:not(.liste_titre)
{
	border-bottom: 1px solid var(--colortopbordertitle1);
}

.noborder > tbody > tr:nth-child(odd):not(.liste_titre), .liste > tbody > tr:nth-child(odd):not(.liste_titre),
div:not(.fichecenter):not(.fichehalfleft):not(.fichehalfright):not(.ficheaddleft) > .border > tbody > tr:nth-of-type(odd):not(.liste_titre), .liste > tbody > tr:nth-of-type(odd):not(.liste_titre),
div:not(.fichecenter):not(.fichehalfleft):not(.fichehalfright):not(.ficheaddleft) .oddeven.tagtr:nth-of-type(odd):not(.liste_titre)
{
	background: linear-gradient(to bottom, #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?> 85%, #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair2)); ?> 100%);
	background: -o-linear-gradient(to bottom, #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?> 85%, #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair2)); ?> 100%);
	background: -moz-linear-gradient(to bottom, #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?> 85%, #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair2)); ?> 100%);
	background: -webkit-linear-gradient(to bottom, #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?> 85%, #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair2)); ?> 100%);
	background: -ms-linear-gradient(to bottom, #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?> 85%, #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair2)); ?> 100%);
}
.noborder > tbody > tr:nth-child(odd):not(:last-child) td:not(.liste_titre), .liste > tbody > tr:nth-child(odd):not(:last-child) td:not(.liste_titre),
.noborder .oddeven.tagtr:nth-child(odd):not(:last-child) .tagtd:not(.liste_titre)
{
	border-bottom: 1px solid var(--colortopbordertitle1);
}

ul.noborder li:nth-child(even):not(.liste_titre) {
	background-color: #<?php print colorArrayToHex(colorStringToArray($colorbacklinepair2)); ?> !important;
}

/* ============================================================================== */
/*	Multiselect with checkbox													  */
/* ============================================================================== */

/* ============================================================================== */
/*  Native multiselect with checkbox											  */
/* ============================================================================== */

ul.ulselectedfields {
	z-index: 90;			/* To have the select box appears on first plan even when near buttons are decorated by jmobile */
}
dl.dropdown {
	margin:0px;
	padding:0px;
	margin-left: 2px;
	margin-right: 2px;
	vertical-align: text-bottom;
	display: inline-block;
}
.dropdown dd, .dropdown dt {
	margin:0px;
	padding:0px;
}
.dropdown ul {
	margin: -1px 0 0 0;
	text-align: left;
}
.dropdown dd {
	position:relative;
}
.dropdown dt a {
	display:block;
	overflow: hidden;
	border:0;
}
.dropdown dt a span, .multiSel span {
	cursor:pointer;
	display:inline-block;
	padding: 0 3px 2px 0;
}
.dropdown span.value {
	display:none;
}
.dropdown dd ul {
	background-color: var(--bgnavtop_hover);
	border: 1px solid var(--colorboxstatsborder);
	display:none;
	right:0px;						/* pop is align on right */
	padding: 2px 15px 2px 5px;
	position:absolute;
	top:2px;
	list-style:none;
	max-height: 264px;
	overflow: auto;
}
.dropdown dd ul.selectedfieldsleft {
	<?php print $right; ?>: auto;
}
.dropdown dd ul li {
	white-space: nowrap;
	font-weight: normal;
	padding: 2px;
}
.dropdown dd ul li:hover {
	background: var(--colorbacklinepairhover);
}
.dropdown dd ul li input[type="checkbox"] {
	margin-<?php print $right; ?>: 3px;
}
.dropdown dd ul li a, .dropdown dd ul li span {
	padding: 3px;
	display: block;
}
.dropdown dd ul li a:hover,
.dropdown dd ul li a:focus {
	background-color: var(--colorOverlayBg);	/* InfraS change : jeton OBLYON_COLOR_OVERLAY_BCKGRD */
}

img.loginphoto {
	border-radius: 2px;
	width: 16px;
	height: 16px;
}
.span-icon-user {
	background: url(<?php print dol_buildpath($path.'/theme/'.$theme.'/img/object_user.png',1); ?>) no-repeat scroll 7px 7px;
}
.span-icon-password {
	background-image: url(<?php print dol_buildpath($path.'/theme/'.$theme.'/img/lock.png',1); ?>);
	background-repeat: no-repeat;
}

/* ============================================================================== */
/* Compatibility Multicompany													  */
/* ============================================================================== */
#entity {
	width: 280px !important;
	padding-left: 10px;
}

.dropdown-mc-image {
	color: #ffffff ;
}

.atoplogin #mc-dropdown-icon {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
	color: var(--bgnavleft_txt);
	<?php } else { ?>
	color: var(--bgnavtop_txt);
	<?php } ?>
}

/* ============================================================================== */
/* Compatibility Infrassearch													  */
/* ============================================================================== */
input#sew_keyword {
	background-color: var(--inputbackgroundcolor) !important;
	width: 100% !important;
	line-height: 28px;
}

/* ============================================================================== */
/*  Markdown rendering															 */
/* ============================================================================== */

/* ============================================================================== */
/*  Markdown rendering															 */
/* ============================================================================== */

.imgmd {
	width: 90%;
}
.moduledesclong h1 {
	padding-top: 10px;
	padding-bottom: 20px;
}

/* ============================================================================== */
/*  JMobile - Android															 */
/* ============================================================================== */

.searchpage .tagtr .tagtd {
	padding-bottom: 3px;
}
.searchpage .tagtr .tagtd .button {
	background: unset;
	border: unset;
}

li.ui-li-divider .ui-link {
	color: #FFF !important;
}
.ui-btn {
	margin: 0 2px;
}
a.ui-link, a.ui-link:hover, .ui-btn:hover, span.ui-btn-text:hover, span.ui-btn-inner:hover {
	text-decoration: none !important;
}
.ui-body-c {
	background: #fff;
}

.ui-btn-inner {
	min-width: .4em;
	padding-left: 6px;
	padding-right: 6px;
	font-size: <?php print is_numeric($fontsize) ? $fontsize.'px' : $fontsize; ?>;
	/* white-space: normal; */		/* Warning, enable this break the truncate feature */
}
.ui-btn-icon-right .ui-btn-inner {
	padding-right: 30px;
}
.ui-btn-icon-left .ui-btn-inner {
	padding-left: 30px;
}
.ui-select .ui-btn-icon-right .ui-btn-inner {
	padding-right: 30px;
}
.ui-select .ui-btn-icon-left .ui-btn-inner {
	padding-left: 30px;
}
.ui-select .ui-btn-icon-right .ui-icon {
	right: 8px;
}
.ui-btn-icon-left > .ui-btn-inner > .ui-icon, .ui-btn-icon-right > .ui-btn-inner > .ui-icon {
	margin-top: -10px;
}
select {
	/* display: inline-block; */	/* We can't set this. This disable ability to make */
	overflow:hidden;
	white-space: nowrap;			/* Enabling this make behaviour strange when selecting the empty value if this empty value is '' instead of '&nbsp;' */
	text-overflow: ellipsis;
}
.fiche .ui-controlgroup {
	margin: 0px;
	padding-bottom: 0px;
}
div.ui-controlgroup-controls div.tabsElem
{
	margin-top: 2px;
}
div.ui-controlgroup-controls div.tabsElem a
{
	-webkit-box-shadow: 0 -3px 6px rgba(0,0,0,.2);
	box-shadow: 0 -3px 6px rgba(0,0,0,.2);
}
div.ui-controlgroup-controls div.tabsElem a#active {
	-webkit-box-shadow: 0 -3px 6px rgba(0,0,0,.3);
	box-shadow: 0 -3px 6px rgba(0,0,0,.3);
}

a.tab span.ui-btn-inner
{
	border: none;
	padding: 0;
}

.ui-link {
	color: var(--colortext);
}
.liste_titre .ui-link {
	color: var(--colortexttitle) !important;
}

a.ui-link {
	word-wrap: break-word;
}

/* force wrap possible onto field overflow does not works */
.formdoc .ui-btn-inner
{
	white-space: normal;
	overflow: hidden;
	text-overflow: clip; /* "hidden" : do not exists as a text-overflow value (https://developer.mozilla.org/fr/docs/Web/CSS/text-overflow) */
}

/* Warning: setting this may make screen not beeing refreshed after a combo selection */
/*.ui-body-c {
	background: #fff;
}*/

div.ui-radio, div.ui-checkbox
{
	display: inline-block;
	border-bottom: 0px !important;
}
.ui-checkbox input, .ui-radio input {
	height: auto;
	width: auto;
	margin: 4px;
	position: static;
}
div.ui-checkbox label+input, div.ui-radio label+input {
	position: absolute;
}
.ui-mobile fieldset
{
	padding-bottom: 10px; margin-bottom: 4px;
}

ul.ulmenu {
	border-radius: 0;
	-webkit-border-radius: 0;
}

.ui-field-contain label.ui-input-text {
	vertical-align: middle !important;
}
.ui-mobile fieldset {
	border-bottom: none !important;
}

/* Style for first level menu with jmobile */
.ui-li .ui-btn-inner a.ui-link-inherit, .ui-li-static.ui-li {
	padding: 1em 15px;
	display: block;
}
.ui-btn-up-c {
	font-weight: normal;
}
.ui-focus, .ui-btn:focus {
	-webkit-box-shadow: none;
	box-shadow: none;
}
.ui-bar-b {
	/*border: 1px solid #888;*/
	border: none;
	background: none;
	text-shadow: none;
	color: var(--colortexttitlenotab) !important;
}
.ui-bar-b, .lilevel0 {
	background-repeat: repeat-x;
	border: none;
	background: none;
	text-shadow: none;
	color: var(--colortexttitlenotab) !important;
}
.alilevel0 {
	font-weight: normal !important;
}

.ui-li.ui-last-child, .ui-li.ui-field-contain.ui-last-child {
	border-bottom-width: 0px !important;
}
.alilevel0 {
	color: var(--colorfline) !important;	/* InfraS change : hors bandeau de titre, texte et fond des lignes (lisible en preset sombre) */
	background: var(--colorbline);	/* InfraS change */
}
.ulmenu {
	box-shadow: none !important;
	border-bottom: 1px solid #ccc;
}
.ui-btn-icon-right {
	border-right: 1px solid #ccc !important;
}
.ui-body-c {
	border: 1px solid #ccc;
	text-shadow: none;
}
.ui-btn-up-c, .ui-btn-hover-c {
	/* border: 1px solid #ccc; */
	text-shadow: none;
}
.ui-body-c .ui-link, .ui-body-c .ui-link:visited, .ui-body-c .ui-link:hover {
	color: var(--colortextlink);
}
.ui-btn-up-c .vsmenudisabled {
	color: var(--colorshadowtitle) !important;
	text-shadow: none !important;
}
.alilevel1 {
	color: var(--colortexttitlenotab) !important;
}
.lilevel1 {
	border-top: 2px solid #444;
	background: #fff ! important;
}
.lilevel1 div div a {
	font-weight: bold !important;
}
.lilevel2
{
	padding-left: 22px;
	background: #fff ! important;
}
.lilevel3
{
	padding-left: 44px;
	background: #fff ! important;
}
.lilevel4
{
	padding-left: 66px;
	background: #fff ! important;
}
.lilevel5
{
	padding-left: 88px;
	background: #fff ! important;
}

/* ============================================================================== */
/*  POS																		   */
/* ============================================================================== */

.menu_choix1,.menu_choix2 {
	font-size: 1.4em;
	text-align: left;
	border: 1px solid #666;
	margin-right: 20px;
}
.menu_choix1 a, .menu_choix2 a {
	display: block;
	color: #fff;
	text-decoration: none;
	padding-top: 18px;
	padding-left: 10px;
	font-size: 14px;
	height: 38px;
}
.menu_choix1 a:hover,.menu_choix2 a:hover {
	color: #6d3f6d;
}
.menu li.menu_choix1 {
	padding-top: 6px;
	padding-right: 10px;
	padding-bottom: 2px;
}
.menu li.menu_choix2 {
	padding-top: 6px;
	padding-right: 10px;
	padding-bottom: 2px;
}
@media only screen and (max-width: 767px)
{
	.menu_choix1 a, .menu_choix2 a {
		background-size: 36px 36px;
		height: 30px;
		padding-left: 40px;
	}
	.menu li.menu_choix1, .menu li.menu_choix2 {
		padding-left: 4px;
		padding-right: 0;
	}
	.liste_articles {
		margin-right: 0 !important;
	}
}

/* ============================================================================== */
/*  Public																		*/
/* ============================================================================== */

/* The theme for public pages */
/* ============================================================================== */
/*  Public																		*/
/* ============================================================================== */

.public_body {
	margin: 20px;
}
.public_border {
	border: 1px solid #888;
}

/* ============================================================================== */
/* Ticket module																  */
/* ============================================================================== */

.ticketpublictable td {
	height: 28px;
}

.ticketpublicarea {
	width: 100%;
	margin-left: 0;
	margin-right: 0;
}
.ticketpublicarea > p {
		line-height: 3;
}
.ticketpublicarea .marginbottomonly
{
		margin-bottom: 10px !important;
}
.ticketform .bigrounded {
		white-space: normal;
		word-wrap: break-word;
}
.bigrounded > span {
	margin: 5px;
}
.ticketlargemargin {
	padding-left: 50px;
	padding-right: 50px;
	padding-top: 30px;
}
@media only screen and (max-width: 767px)
{
	.ticketlargemargin {
		padding-left: 5px; padding-right: 5px;
		padding-top: 10px;
	}
	.ticketpublicarea {
		margin-left: 10px;
		margin-right: 10px;
	}
}

#cd-timeline {
	position: relative;
	padding: 2em 0;
	margin-bottom: 2em;
}
#cd-timeline::before {
	/* this is the vertical line */
	content: '';
	position: absolute;
	top: 0;
	left: 18px;
	height: 100%;
	width: 4px;
	background: #d7e4ed;
}
@media only screen and (min-width: 1170px) {
	#cd-timeline {
		margin-bottom: 3em;
	}
	#cd-timeline::before {
		left: 50%;
		margin-left: -2px;
	}
}

.cd-timeline-block {
	position: relative;
	margin: 2em 0;
}
.cd-timeline-block:after {
	content: "";
	display: table;
	clear: both;
}
.cd-timeline-block:first-child {
	margin-top: 0;
}
.cd-timeline-block:last-child {
	margin-bottom: 0;
}
@media only screen and (min-width: 1170px) {
	.cd-timeline-block {
		margin: 4em 0;
	}
	.cd-timeline-block:first-child {
		margin-top: 0;
	}
	.cd-timeline-block:last-child {
		margin-bottom: 0;
	}
}

.cd-timeline-img {
	position: absolute;
	top: 0;
	left: 0;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	box-shadow: 0 0 0 4px white, inset 0 2px 0 rgba(0, 0, 0, 0.08), 0 3px 0 4px rgba(0, 0, 0, 0.05);
	background: #d7e4ed;
}
.cd-timeline-img img {
	display: block;
	width: 24px;
	height: 24px;
	position: relative;
	left: 50%;
	top: 50%;
	margin-left: -12px;
	margin-top: -12px;
}
.cd-timeline-img.cd-picture {
	background: #75ce66;
}
.cd-timeline-img.cd-movie {
	background: #c03b44;
}
.cd-timeline-img.cd-location {
	background: #f0ca45;
}
@media only screen and (min-width: 1170px) {
	.cd-timeline-img {
		width: 60px;
		height: 60px;
		left: 50%;
		margin-left: -30px;
		/* Force Hardware Acceleration in WebKit */
		-webkit-transform: translateZ(0);
		-webkit-backface-visibility: hidden;
	}
	.cssanimations .cd-timeline-img.is-hidden {
		visibility: hidden;
	}
	.cssanimations .cd-timeline-img.bounce-in {
		visibility: visible;
		-webkit-animation: cd-bounce-1 0.6s;
		-moz-animation: cd-bounce-1 0.6s;
		animation: cd-bounce-1 0.6s;
	}
}

@-webkit-keyframes cd-bounce-1 {
	0% {
		opacity: 0;
		-webkit-transform: scale(0.5);
	}

	60% {
		opacity: 1;
		-webkit-transform: scale(1.2);
	}

	100% {
		-webkit-transform: scale(1);
	}
}
@-moz-keyframes cd-bounce-1 {
	0% {
		opacity: 0;
		-moz-transform: scale(0.5);
	}

	60% {
		opacity: 1;
		-moz-transform: scale(1.2);
	}

	100% {
		-moz-transform: scale(1);
	}
}
@keyframes cd-bounce-1 {
	0% {
		opacity: 0;
		-webkit-transform: scale(0.5);
		-moz-transform: scale(0.5);
		-ms-transform: scale(0.5);
		-o-transform: scale(0.5);
		transform: scale(0.5);
	}

	60% {
		opacity: 1;
		-webkit-transform: scale(1.2);
		-moz-transform: scale(1.2);
		-ms-transform: scale(1.2);
		-o-transform: scale(1.2);
		transform: scale(1.2);
	}

	100% {
		-webkit-transform: scale(1);
		-moz-transform: scale(1);
		-ms-transform: scale(1);
		-o-transform: scale(1);
		transform: scale(1);
	}
}
.cd-timeline-content {
	position: relative;
	margin-left: 60px;
	background: <?php print (!empty($colorbline_hover) ? $colorbline_hover : 'white'); ?>;
	border-radius: 0.25em;
	padding: 1em;
	background-image: -o-linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
	background-image: -moz-linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
	background-image: -webkit-linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
	background-image: -ms-linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
	background-image: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
}
.cd-timeline-content:after {
	content: "";
	display: table;
	clear: both;
}
.cd-timeline-content h2 {
	color: #303e49;
}
.cd-timeline-content .cd-date {
	font-size: 13px;
	font-size: 0.8125rem;
}
.cd-timeline-content .cd-date {
	display: inline-block;
}
.cd-timeline-content p {
	margin: 1em 0;
	line-height: 1.6;
}

.cd-timeline-content .cd-date {
	float: left;
	padding: .2em 0;
	opacity: .7;
}
.cd-timeline-content::before {
	content: '';
	position: absolute;
	top: 16px;
	right: 100%;
	height: 0;
	width: 0;
	border: 7px solid transparent;
	border-right: 7px solid <?php print (!empty($colorbline_hover) ? $colorbline_hover : 'white'); ?>;
}
@media only screen and (min-width: 768px) {
	.cd-timeline-content h2 {
		font-size: 20px;
		font-size: 1.25rem;
	}
	.cd-timeline-content {
		font-size: 16px;
		font-size: 1rem;
	}
	.cd-timeline-content .cd-read-more, .cd-timeline-content .cd-date {
		font-size: 14px;
		font-size: 0.875rem;
	}
}
@media only screen and (min-width: 1170px) {
	.cd-timeline-content {
		margin-left: 0;
		padding: 1.6em;
		width: 43%;
	}
	.cd-timeline-content::before {
		top: 24px;
		left: 100%;
		border-color: transparent;
		border-left-color: <?php print (!empty($colorbline_hover) ? $colorbline_hover : 'white'); ?>;
	}
	.cd-timeline-content .cd-read-more {
		float: left;
	}
	.cd-timeline-content .cd-date {
		position: absolute;
		width: 55%;
		left: 115%;
		top: 6px;
		font-size: 16px;
		font-size: 1rem;
	}
	.cd-timeline-block:nth-child(even) .cd-timeline-content {
		float: right;
	}
	.cd-timeline-block:nth-child(even) .cd-timeline-content::before {
		top: 24px;
		left: auto;
		right: 100%;
		border-color: transparent;
		border-right-color: <?php print (!empty($colorbline_hover) ? $colorbline_hover : 'white'); ?>;
	}
	.cd-timeline-block:nth-child(even) .cd-timeline-content .cd-read-more {
		float: right;
	}
	.cd-timeline-block:nth-child(even) .cd-timeline-content .cd-date {
		left: auto;
		right: 115%;
		text-align: right;
	}

}

/* ============================================================================== */
/* CSS style for debugbar														 */
/* ============================================================================== */

div.phpdebugbar * {
	font-weight: unset;
}
span.phpdebugbar-tooltip.phpdebugbar-tooltip-extra-wide, span.phpdebugbar-tooltip.phpdebugbar-tooltip-wide {
	width: 250px !important;
}
.phpdebugbar-indicator span.phpdebugbar-tooltip {
	opacity: .95 !important;
}
a.phpdebugbar-tab.phpdebugbar-active {
	background-image: unset !important;
}
.phpdebugbar-fa-tags:before {
	content: "\f121";
	font-weight: 600 !important;
}
.phpdebugbar-fa-tasks:before {
	content: "\f550";
	font-weight: 600 !important;
}
.phpdebugbar-fa-tags, .phpdebugbar-fa-tasks, .phpdebugbar-indicator .fa {
	font-family: var(--fontawesomeFamily) !important;
	font-weight: var(--fontawesomeWeight);
}
div.phpdebugbar-widgets-messages li.phpdebugbar-widgets-list-item span.phpdebugbar-widgets-value.phpdebugbar-widgets-warning:before,
div.phpdebugbar-widgets-messages li.phpdebugbar-widgets-list-item span.phpdebugbar-widgets-value.phpdebugbar-widgets-error:before,
div.phpdebugbar-widgets-exceptions a.phpdebugbar-widgets-editor-link:before,
div.phpdebugbar-widgets-sqlqueries span.phpdebugbar-widgets-database:before,
div.phpdebugbar-widgets-sqlqueries span.phpdebugbar-widgets-duration:before,
div.phpdebugbar-widgets-sqlqueries span.phpdebugbar-widgets-memory:before,
div.phpdebugbar-widgets-sqlqueries span.phpdebugbar-widgets-row-count:before,
div.phpdebugbar-widgets-sqlqueries span.phpdebugbar-widgets-copy-clipboard:before,
div.phpdebugbar-widgets-sqlqueries span.phpdebugbar-widgets-stmt-id:before,
div.phpdebugbar-widgets-templates span.phpdebugbar-widgets-render-time:before,
div.phpdebugbar-widgets-templates span.phpdebugbar-widgets-memory:before,
div.phpdebugbar-widgets-templates span.phpdebugbar-widgets-param-count:before,
div.phpdebugbar-widgets-templates span.phpdebugbar-widgets-type:before,
div.phpdebugbar-widgets-templates a.phpdebugbar-widgets-editor-link:before
{
	font-family: var(--fontawesomeFamily) !important;
}

/* ============================================================================== */
/* CSS style used for jCrop													   */
/* ============================================================================== */

.jcrop-holder { background: unset !important; }

/* ============================================================================== */
/* CSS style used for jFlot													   */
/* ============================================================================== */

.dol-xaxis-vertical .flot-x-axis .flot-tick-label.tickLabel {
	text-orientation: sideways;
	font-weight: 400;
	writing-mode: vertical-rl;
	white-space: nowrap;
}

/* ============================================================================== */
/* For copy-paste feature														 */
/* ============================================================================== */

span.clipboardCPValueToPrint, div.clipboardCPValueToPrint  {
	display: inline-block;
}
span.clipboardCPValue.hidewithsize {
	width: 0 !important;
	display: inline-block;	/* this will be modify on the fly by the copy-paste js code in lib_foot.js.php to have copy feature working */
	color: transparent;
	white-space: nowrap;
	overflow-x: hidden;
	vertical-align: middle;
}
div.clipboardCPValue.hidewithsize {
	width: 0 !important;
	display: none;
	color: transparent;
	white-space: nowrap;
}

.clipboardCPShowOnHover .clipboardCPButton {
	display: none;
}

/* To make a div popup, we must use a position absolute inside a position relative */
.clipboardCPText {
	position: relative;
}
.clipboardCPTextDivInside {
	position: absolute;
	background: #f8f8fa;
	color: #888;
	border: 1px solid #E0E0E0;
	opacity: 1;
	z-index: 20;
	padding: 2px;
	padding-left: 5px;
	padding-right: 5px;
	top: -5px;
	left: 0px;
	border-radius: 5px;
	white-space: nowrap;
	font-size: 0.9em;
	box-shadow: 1px 1px 6px #ddd;
}

/* ============================================================================== */
/* CSS style used for hrm skill/rank (may be we can remove this)				  */
/* ============================================================================== */

.radio_js_bloc_number {
	display:inline-block;
	padding:5px 7px;
	min-width:20px;
	border-radius:3px;
	border:1px solid #ccc;
	background:#eee;
	color:#555;
	cursor:pointer;
	margin:2px;
	text-align:center;
}
.radio_js_bloc_number.selected {
	transition:0.2s ease background;
	background:#888;
	color:#fff;
	border-color:#555;
}

/* ============================================================================== */
/* Virtual business card														  */
/* ============================================================================== */

.virtualcard-div {
	overflow: hidden;
	vertical-align: top;
	/* background: #aaa; */
}

#virtualcard-iframe {
	border: 40px solid #aaa;
	vertical-align: top;
	width: 10%;
	min-width: 100px;
	border-radius: 10px;
	aspect-ratio: 0.6;
}
.nopointervent {
	pointer-events: none;
}
.scalepreview {
	/* transform: scale(0.5); */
	zoom: 0.20;
	/* filter: blur(4px); */
}

/* ============================================================================== */
/* Drag & drop card feature													   */
/* ============================================================================== */
.cssDragDropArea {
	position: relative;
}
.highlightDragDropArea {
	border: 2px #000 dashed !important;
	background-color: #bbbbbb !important;
}
.highlightDragDropArea * :not(.dragDropAreaMessage *) {
	opacity:0.7;
	filter: blur(3px) grayscale(100%);
}
.dragDropAreaMessage {
	position: absolute;
	left:50%;
	top:50%;
	transform: translate(-50%, -50%);
	text-align:center;
	font-size: 2em;
}

/* ============================================================================== */
/* CSS style used for color jPicker											   */
/* ============================================================================== */

table.jPicker {
	border: 1px solid #bbb !important;
}

/* ============================================================================== */
/* CSS style used for survey													  */
/* ============================================================================== */

.opensurveydescription * {
	width: 100%;
}
.survey_borders {
	margin-left: 100px;
	margin-right: 100px;
	text-align: start;
}
.survey_intro {
	background-color: #f0f0f0;
	padding: 15px;
	border-radius: 8px;
}
.survey_borders .resultats .nom {
	text-align: var(--left)
}
.survey_borders .resultats .sujet, .survey_borders .resultats .jour {
	min-width: 100px;
}

/* ============================================================================== */
/* CSS style used for BookCal													 */
/* ============================================================================== */

.center.bookingtab {
	margin-left: 20px;
}
#bookinghoursection {
	width: 145px;
	height: 320px;
	overflow-y: auto;
	overflow-x: hidden;
	text-align: left;
}
.bookcalform {
	border: 1px solid #000;
	padding: 15px;
	border-radius: 5px;
	margin-bottom: 15px;
}
