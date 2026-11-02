<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/tools.inc.php
   Role      : Outil de scan, objets masques, bordures et utilitaires
   Inclus par : global.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/* ============================================================================== */
/* Styles for scan tool														   */
/* ============================================================================== */

div.div-for-modal {
	/* display: none; */
	position:absolute;
	top:calc(50% - 200px);
	left:calc(50% - 250px);
	width:500px;  /* adjust as per your needs */
	height:400px;   /* adjust as per your needs */
	background: var(--colorOverlayBg);	/* InfraS change : jeton OBLYON_COLOR_OVERLAY_BCKGRD */
	border: 1px solid #bbb;
	box-shadow: 2px 2px 20px #ddd;
	z-index: 100;
}

#scantoolmessage {
	height: 3em;
	border: none;
	overflow-y: auto;
}

div.div-for-modal-topright {
	/* display: none; */
	position: fixed;
	top: 0;
	right: 0;
	width:50%;  /* adjust as per your needs */
	height:320px;   /* adjust as per your needs */
	background: var(--colorOverlayBg);	/* InfraS change : jeton OBLYON_COLOR_OVERLAY_BCKGRD */
	border: 1px solid #bbb;
	box-shadow: 2px 2px 20px #ddd;
	z-index: 1100;
}

<?php
// Add a nowrap on smartphone, so long list of field used for filter are overflowed with clip
if ($conf->browser->layout == 'phone') {
	?>
.divsearchfieldfilter {
	white-space: nowrap;
}
<?php } ?>
div.confirmmessage {
	padding-top: 6px;
}
ul.attendees {
	padding-top: 0;
	padding-bottom: 0;
	padding-left: 0;
	margin-top: 0;
	margin-bottom: 0;
}
ul.attendees li {
	list-style-type: none;
	padding-top:1px;
	padding-bottom:1px;
}
.googlerefreshcal {
	padding-top: 4px;
	padding-bottom: 4px;
}
.paddingtopbottom {
	padding-top: 10px;
	padding-bottom: 10px;
}
.checkallactions {
	margin-top: 2px;		/* left must be same than right to keep checkbox centered */
	margin-left: 2px;		/* left must be same than right to keep checkbox centered */
	vertical-align: middle;
}
select.flat.selectlimit {
	max-width: 62px;
}
.selectlimit, .marginrightonly {
	margin-right: 10px !important;
}
.marginleftonly {
	margin-<?php print $left; ?>: 10px !important;
}
.marginleftonlyshort {
	margin-<?php print $left; ?>: 4px !important;
}
.nomarginleft {
	margin-<?php print $left; ?>: 0px !important;
}
.margintoponly {
	margin-top: 10px !important;
}
.marginbottomonly {
	margin-bottom: 10px !important;
}
.marginbottomonlyshort {
	margin-bottom: 3px !important;
}
.nomargintop {
	margin-top: 0 !important;
}
.nomarginbottom {
	margin-bottom: 0 !important;
}
.selectlimit, .selectlimit:focus {
	border-left: none !important;
	border-top: none !important;
	border-right: none !important;
	outline: none;
}
.strikefordisabled {
	text-decoration: line-through;
}
.widthdate {
	width: 130px;
}
/* using a tdoverflowxxx make the min-width not working */
.tdnooverflowimp {
	text-overflow: unset;
}
.tdoverflow {
	max-width: 0;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.spanoverflow {
	overflow-x: clip;
	text-overflow: ellipsis;
}
.tdoverflowmax50 {			/* For tdoverflow, the max-midth become a minimum ! */
	max-width: 50px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowmax60 {			/* For tdoverflow, the max-midth become a minimum ! */
	max-width: 60px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowmax80 {			/* For tdoverflow, the max-midth become a minimum ! */
	max-width: 80px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowmax80imp {			/* For tdoverflow, the max-midth become a minimum ! */
	max-width: 80px !important;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowmax100 {
	max-width: 100px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowmax100imp {			/* For tdoverflow, the max-midth become a minimum ! */
	max-width: 100px !important;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowmax125 {			/* For tdoverflow, the max-midth become a minimum ! */
	max-width: 125px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowmax150 {			/* For tdoverflow, the max-midth become a minimum ! */
	max-width: 150px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowmax200 {			/* For tdoverflow, the max-midth become a minimum ! */
	max-width: 200px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowmax250 {			/* For tdoverflow, the max-midth become a minimum ! */
	max-width: 250px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowmax300 {
	max-width: 300px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowmax400 {			/* For tdoverflow, the max-midth become a minimum ! */
	max-width: 400px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowmax500 {			/* For tdoverflow, the max-midth become a minimum ! */
	max-width: 500px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowauto {
	max-width: 0;
	overflow: auto;
}
.divintdwithtwolinesmax {
	width: 75px;
	display: -webkit-box;
	-webkit-box-orient: vertical;
	-webkit-line-clamp: 2;
	overflow: hidden;
}
.twolinesmax {
	display: -webkit-box;
	-webkit-box-orient: vertical;
	-webkit-line-clamp: 2;
	overflow: hidden;
}
.tablelistofcalendars {
	margin-top: 25px !important;
}
.navselectiondate {
	width: 250px;
}

/* Styles for amount on card */
table.paymenttable td.amountpaymentcomplete, table.paymenttable td.amountremaintopay, table.paymenttable td.amountremaintopayback {
	padding-top: 0px;
	padding-bottom: 0px;
}
.amountpaymentcomplete {
	color: var(--amountpaymentcomplete);
	font-weight: bold;
	font-size: 1.2em;
}
.amountremaintopay {
	color: var(--amountremaintopaycolor);
	font-weight: bold;
	font-size: 1.2em;
}
.amountremaintopayback {
	font-weight: bold;
	font-size: 1.2em;
}
.amountpaymentneutral {
	font-weight: bold;
	font-size: 1.2em;
}
.onlinepaymentbody .amountpaymentcomplete {
	background-color: var(--amountpaymentcomplete);
	color: #fff;
	padding: 5px;
	border-radius: 5px;
}
.savingdocmask {
	margin-top: 6px;
	margin-bottom: 12px;
}
#builddoc_form ~ .showlinkedobjectblock {
	margin-top: 20px;
}

/* For the long description of module */
.moduledesclong p img,.moduledesclong p a img {
	max-width: 90% !important;
	height: auto !important;
}
.imgdoc {
	margin: 18px;
	border: 1px solid #ccc;
	box-shadow: 1px 1px 25px #aaa;
	max-width: calc(100% - 56px);
}
.fa-file-text-o, .fa-file-code-o, .fa-file-powerpoint-o, .fa-file-excel-o, .fa-file-word-o, .fa-file-o, .fa-file-image-o, .fa-file-video-o, .fa-file-audio-o, .fa-file-archive-o, .fa-file-pdf-o {
	color: var(--maincolor);
}
.fa-15 {
	font-size: 1.5em;
}
.fa-trash, .fa-crop, .fa-pencil {
	font-size: 1.4em;
}

/* DOL_XXX for future usage (when left menu has been removed). If we do not use datatable */
/*.table-responsive {
width: calc(100% - 330px);
margin-bottom: 15px;
overflow-y: hidden;
-ms-overflow-style: -ms-autohiding-scrollbar;
}*/

/* Style used for most tables */
.div-table-responsive, .div-table-responsive-no-min {
	overflow-x: auto;
	min-height: 0.01%;
}
.div-table-responsive {
	line-height: 155%;
}

div.fiche>form>div.div-table-responsive {
	min-height: 392px;
}
div.fiche>div.tabBar>form>div.div-table-responsive {
	min-height: 392px;
}

.flexcontainer {
<?php
	if (!empty($conf->browser->browsername) && in_array($conf->browser->browsername, array('chrome', 'firefox', 'safari'))) {
		print 'display: inline-flex;'."\n";
	}
?>
	flex-flow: row wrap;
	justify-content: flex-start;
}

.thumbstat {
	flex: 1 1 116px;
}
.thumbstat150 {
	flex: 1 1 150px;
}
.thumbstat, .thumbstat150 {
	flex-grow: 1;
	flex-shrink: 1;
	/* flex-basis: 140px; */
	min-width: 150px;
	justify-content: flex-start;
	align-self: flex-start;
}

select.selectarrowonleft {
	direction: rtl;
}
select.selectarrowonleft option {
	direction: ltr;
}

.img-skinthumb {
	width: 160px;
	height: 100px;
}

/* To avoid message boxes being too large because code not wrapping */
.longmessagecut pre {
	white-space: break-spaces;
}

/* ============================================================================== */
/* Styles to hide objects														  */
/* ============================================================================== */

.clearboth  { clear:both; }

.hideobject { display: none; }
.minwidth25  { min-width: 25px; }
.minwidth50  { min-width: 50px; }
.minwidth75  { min-width: 75px; }
/* rule for not too small screen only */
@media only screen and (min-width: <?php print (!empty($nbtopmenuentries) && !empty($fontsize) ? round($nbtopmenuentries * $fontsize * 3.4, 0) + 7 : 7); ?>px)
{
	.width20  { width: 20px; }
	.width25  { width: 25px; }
	.width50  { width: 50px; }
	.width75  { width: 75px; }
	.width100 { width: 100px; }
	.width200 { width: 200px; }
	.minwidth100 { min-width: 100px; }
	.minwidth150 { min-width: 150px; }
	.minwidth200 { min-width: 200px; }
	.minwidth250 { min-width: 250px; }
	.minwidth300 { min-width: 300px; }
	.minwidth400 { min-width: 400px; }
	.minwidth500 { min-width: 500px; }
	.minwidth50imp  { min-width: 50px !important; }
	.minwidth75imp  { min-width: 75px !important; }
	.minwidth100imp { min-width: 100px !important; }
	.minwidth200imp { min-width: 200px !important; }
	.minwidth250imp { min-width: 250px !important; }
	.minwidth300imp { min-width: 300px !important; }
	.minwidth400imp { min-width: 400px !important; }
	.minwidth500imp { min-width: 500px !important; }
}
.widthauto { width: auto; }
.width20  { width: 20px; }
.width25  { width: 25px; }
.width40  { width: 40px; }
.width50  { width: 50px; }
.width75  { width: 75px; }
.width100 { width: 100px; }
.width125 { width: 125px; }
.width150 { width: 150px; }
.width200 { width: 200px; }
.width250 { width: 250px; }
.width300 { width: 300px; }
.width400 { width: 400px; }
.width500 { width: 500px; }
.maxwidth25  { max-width: 25px; }
.maxwidth40  { max-width: 40px; }
.maxwidth50  { max-width: 50px; }
.maxwidth75  { max-width: 75px; }
.maxwidthdate  { max-width: 85px; }
.maxwidth100 { max-width: 100px; }
.maxwidth125 { max-width: 125px; }
.maxwidth150 { max-width: 150px; }
.maxwidth200 { max-width: 200px; }
.maxwidth250 { max-width: 250px; }
.maxwidth300 { max-width: 300px; }
.maxwidth400 { max-width: 400px; }
.maxwidth500 { max-width: 500px; }
.maxwidth750 { max-width: 750px; }
.maxwidth1000 { max-width: 1000px; }
.maxwidth50imp  { max-width: 50px !important; }
.maxwidth75imp  { max-width: 75px !important; }

.minwidth100onall { min-width: 100px !important; }
.minwidth200onall { min-width: 200px !important; }
.minwidth250onall { min-width: 250px !important; }

.minheight20 { min-height: 20px; }
.minheight30 { min-height: 30px; }
.minheight40 { min-height: 40px; }
.titlefieldcreate { width: 20%; }
.titlefield	   { /* width: 25%; */ min-width: 250px; width: 25%; }
.titlefieldmiddle { width: 45%; }
.titlefieldmax45 { max-width: 45%; }
.imgmaxwidth180 { max-width: 180px; }
.imgmaxheight50 { max-height: 50px; }

.width20p { width:20%; }
.width25p { width:25%; }
.width40p { width:40%; }
.width50p { width:50%; }
.width60p { width:60%; }
.width75p { width:75%; }
.width80p { width:80%; }
.width100p { width:100%; }

/* Force values for small screen 1400 */
@media only screen and (max-width: 1400px)
{
	.titlefieldcreate { width: 30% !important; }
	.minwidth50imp  { min-width: 50px !important; }
	.minwidth75imp  { min-width: 75px !important; }
	.minwidth100imp { min-width: 100px !important; }
	.minwidth125imp { min-width: 125px !important; }
	.minwidth150imp { min-width: 150px !important; }
	.minwidth200imp { min-width: 200px !important; }
	.minwidth250imp { min-width: 250px !important; }
	.minwidth300imp { min-width: 300px !important; }
	.minwidth400imp { min-width: 300px !important; }
	.minwidth500imp { min-width: 300px !important; }

	.linkedcol-element {
		min-width: unset;
	}
}

/* Force values for small screen 1000 */
@media only screen and (max-width: 1000px)
{
	.maxwidthonsmartphone { max-width: 100px; }
	.minwidth50imp  { min-width: 50px !important; }
	.minwidth75imp  { min-width: 75px !important; }
	.minwidth100imp { min-width: 100px !important; }
	.minwidth125imp { min-width: 125px !important; }
	.minwidth150imp { min-width: 110px !important; }
	.minwidth200imp { min-width: 110px !important; }
	.minwidth250imp { min-width: 115px !important; }
	.minwidth300imp { min-width: 120px !important; }
	.minwidth400imp { min-width: 150px !important; }
	.minwidth500imp { min-width: 250px !important; }
}

select.widthcentpercentminusx, span.widthcentpercentminusx:not(.select2-selection):not(.select2-dropdown), input.widthcentpercentminusx {
	width: calc(100% - 52px) !important;
	display: inline-block;
}
select.widthcentpercentminusxx, span.widthcentpercentminusxx:not(.select2-selection), input.widthcentpercentminusxx {
	width: calc(100% - 70px) !important;
	display: inline-block;
}

/* Force values for small screen 767 */
@media only screen and (max-width: 767px)
{
	div.refidno {
		font-size: <?php print is_numeric($fontsize) ? ($fontsize+3).'px' : $fontsize; ?> !important;
	}
	.divadvancedsearchfield {
		padding-left: 5px;
		padding-right: 5px;
	}

	div.divphotoref {
		padding-right: 10px !important;
	}

	.hideonsmartphone { display: none; }
	.hideonsmartphoneimp { display: none !important; }

	.margintoponsmartphone { margin-top: 6px; }

	span.pictotitle {
		margin-<?php print $left; ?>: 0 !important;
	}
	div.fiche>table.table-fiche-title {
		margin-top: 7px !important;
		margin-bottom: 15px !important;
	}

	select.minwidth100imp, select.minwidth100, select.minwidth200, select.minwidth200imp, select.minwidth300 {
		width: calc(100% - 40px) !important;
		min-width: 100px;
		display: inline-block;
	}
	select.widthcentpercentminusxx, span.widthcentpercentminusxx:not(.select2-selection), input.widthcentpercentminusxx {
		width: calc(100% - 70px) !important;
		display: inline-block;
	}

	input.maxwidthinputfileonsmartphone {
		width: 175px;
	}

	input.buttonpayment, button.buttonpayment, div.buttonpayment {
		min-width: 270px;
	}

	.smallonsmartphone {
		font-size: 0.8em;
	}

	.nopaddingtoponsmartphone {
		padding-top: 0 !important;
	}
	.nopaddingbottomonsmartphone {
		padding-bottom: 0 !important;
	}
}

/* Force values for small screen 570 */
@media only screen and (max-width: 570px)
{
	body {
		font-size: <?php print is_numeric($fontsize) ? ($fontsize+3).'px' : $fontsize; ?>;
	}
	div.refidno {
		font-size: <?php print is_numeric($fontsize) ? ($fontsize+3).'px' : $fontsize; ?> !important;
	}

	.divmainbodylarge { margin-left: 20px !important; margin-right: 20px !important; }

	.tdoverflowonsmartphone {
		max-width: 0;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	.tdoverflowmax100onsmartphone {			/* For tdoverflow, the max-midth become a minimum ! */
		max-width: 100px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	.tdoverflowmax150onsmartphone {			/* For tdoverflow, the max-midth become a minimum ! */
		max-width: 100px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	.border tbody tr, .border tbody tr td, div.tabBar table.border tr, div.tabBar table.border tr td, div.tabBar div.border .table-border-row, div.tabBar div.border .table-key-border-col, div.tabBar div.border .table-val-border-col {
		height: 40px !important;
	}

	div.tabs div.tab a.tab  {
		max-width: 200px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}

	.quatrevingtpercent, .inputsearch {
		width: 95%;
	}

	select {
		padding-top: 4px;
		padding-bottom: 5px;
	}

	.login_table .tdinputlogin {
		min-width: unset !important;
	}

	input, input[type=text], input[type=password], select, textarea	 {
		min-width: 20px;
	}
	.trinputlogin input[type=text] {
		max-width: 140px;
	}
	.vmenu .searchform input {
		max-width: 138px;	/* length of input text in the quick search box when using a smartphone and without dolidroid */
	}

	.noenlargeonsmartphone { width : 50px !important; display: inline !important; }
	.maxwidthonsmartphone, #search_newcompany.ui-autocomplete-input { max-width: 100px; }
	.maxwidth50onsmartphone { max-width: 40px; }
	.maxwidth75onsmartphone { max-width: 50px; }
	.maxwidth100onsmartphone { max-width: 70px; }
	.maxwidth125onsmartphone { max-width: 100px; }
	.maxwidth150onsmartphone { max-width: 120px; }
	.maxwidth150onsmartphoneimp { max-width: 120px !important; }
	.maxwidth200onsmartphone { max-width: 200px; }
	.maxwidth250onsmartphone { max-width: 250px; }
	.maxwidth300onsmartphone { max-width: 300px; }
	.maxwidth400onsmartphone { max-width: 400px; }
	.minwidth50imp  { min-width: 50px !important; }
	.minwidth75imp  { min-width: 75px !important; }
	.minwidth100imp { min-width: 100px !important; }
	.minwidth125imp { min-width: 125px !important; }
	.minwidth150imp { min-width: 110px !important; }
	.minwidth200imp { min-width: 110px !important; }
	.minwidth250imp { min-width: 115px !important; }
	.minwidth300imp { min-width: 120px !important; }
	.minwidth400imp { min-width: 150px !important; }
	.minwidth500imp { min-width: 250px !important; }
	.titlefield { width: auto; min-width: unset; }
	.titlefieldcreate { width: auto; }

	#tooltip {
		position: absolute;
		width: <?php print dol_size(300, 'width'); ?>px;
	}

	/* intput, input[type=text], */
	select {
		width: 98%;
		min-width: 40px;
	}

	div.divphotoref {
		padding-<?php print $right; ?>: 5px;
		padding-bottom: 5px;
	}
	img.photoref, div.photoref {
		border: none;
		-webkit-box-shadow: none;
		box-shadow: none;
		padding: 4px;
		height: 20px;
		width: 20px;
		object-fit: contain;
	}

	div.statusref {
		padding-right: 10px;
		max-width: 55%;
	}
	div.statusref img {
		padding-right: 3px !important;
	}
	div.statusrefbis {
		padding-right: 3px !important;
	}
	/* TODO
	div.statusref {
		padding-top: 0px !important;
		padding-left: 0px !important;
		border: none !important;
	   }
	*/

	input.buttonpayment {
		min-width: 300px;
	}
}
.linkobject { cursor: pointer; }
/*
table.tableforfield tr>td:first-of-type, div.tableforfield div.tagtr>div.tagtd:first-of-type {
	color: var(--colorfline);
}
*/
<?php if (GETPOST('optioncss', 'aZ09') == 'print') { ?>
.hideonprint { display: none !important; }
<?php } ?>
