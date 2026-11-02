<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/cards.inc.php
   Role      : Fiches : pictos (include main_menu_fa_icons), page de connexion (include login), onglets, boutons (include btn)
   Inclus par : global.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/* ============================================================================== */
/* Fa-icons																	   */
/* ============================================================================== */
<?php include dol_buildpath($path.'/theme/'.$theme.'/main_menu_fa_icons.inc.php', 0); ?>

/*------------------------------------*\
#Top Menu (eldy style)
\*------------------------------------*/

/**
* Main Navigation
*/

<?php
if (! empty($conf->dol_optimize_smallscreen))
{
	$minwidthtmenu=0;
	$heightmenu=19;
}
else
{
	$minwidthtmenu=66;
	$heightmenu=52;
}
?>

.tmenudiv {
	<?php if (GETPOST("optioncss", "aZ09") == 'print') {	?>
		display: none;
	<?php } else { ?>
		color: #fcfcfc;
		display: block;
		font-size: 13px;
		font-weight: normal;
		margin: 0;
		padding: 0;
		position: relative;
		text-decoration: none;
		white-space: nowrap;
	<?php } ?>
}

#tmenu_tooltip ul.tmenu {
	list-style: none;
	margin: 0;
	padding: 0;
	text-align: center;
	z-index: 30;
}

.vmenu ul.tmenu {
	margin-bottom: 20px;
}

li.tmenu,
li.tmenusel {
	display: block;
	margin: 0;
	padding: 0;
	position: relative;
	transition: all .2s ease-in-out;
	-moz-transition: all .2s ease-in-out;
	-webkit-transition: all .2s ease-in-out;
}

#tmenu_tooltip li.tmenu,
#tmenu_tooltip li.tmenusel {
	display: block;
	float: var(--left);
	position: relative;
	<?php if (getDolGlobalString('OBLYON_HIDE_TOPICONS')) { ?>
		height: 54px;
		line-height: 54px;
	<?php } else { ?>
		height: 54px;
		min-width: var(--minwidthtmenu);
	<?php } ?>
}

li.tmenusel {
	background-color: var(--bgnavtop_sel);	/* InfraS change : jeton OBLYON_COLOR_TOPMENU_BCKGRD_SEL */
	color: var(--bgnavtop_txt_sel);	/* InfraS change : jeton OBLYON_COLOR_TOPMENU_TXT_SEL */
}

li.tmenu:hover {
	background-color: var(--bgnavtop_hover);
	color: var(--bgnavtop_txt_hover);	/* InfraS change : texte de survol = jeton du menu (OBLYON_COLOR_*MENU_TXT_HOVER), plus la couleur principale : le libelle disparaissait quand elle est proche du fond de survol */
}

#tmenu_tooltip li.tmenu {
	background-color: var(--bgnavtop);
}

#tmenu_tooltip li.tmenu:hover {
	background-color: var(--bgnavtop_hover);
}

/* Liens menu vertical */

div.tmenudisabled,
a.tmenudisabled {
	cursor: not-allowed;
	opacity: .6;
}

a.tmenu:link,
a.tmenu:visited,
a.tmenudisabled {
	display: block;
	font-weight: normal;
	/* padding: 0 5px; */
	text-decoration: none;
	white-space: nowrap;
}
a.tmenu:link,
a.tmenudisabled {
	color: var(--bgnavtop_txt) !important;
}

a.tmenu:active {
	color: var(--bgnavtop_txt_active) !important;
	margin: 0;
}

a.tmenu:hover {
	color: var(--bgnavtop_txt_hover) !important;
	margin: 0;
}

a.tmenuimage:hover + a.tmenu {
	color: var(--bgnavtop_txt_hover) !important;	/* InfraS change : texte de survol = jeton du menu (OBLYON_COLOR_*MENU_TXT_HOVER), plus la couleur principale : le libelle disparaissait quand elle est proche du fond de survol */
}

.tmenu li a,
.tmenu:visited li a,
.tmenu:hover li a {
	font-weight: normal;
}

a.tmenusel:hover,
a.tmenusel:active {
	color: var(--bgnavtop_txt_sel);	/* InfraS change : jeton OBLYON_COLOR_TOPMENU_TXT_SEL */
	font-weight: bold !important;
}

/* InfraS change begin : limite au lien principal de l'entree (li > div > a) ; la regle "li.tmenusel a" s'appliquait aussi aux liens des volets de sous-menus (texte blanc force sur fond clair) */
li.tmenusel > div > a,
li.tmenusel > div > a:hover,
li.tmenusel > div > a:active,
li.tmenusel > div > a:link {
	color: var(--bgnavtop_txt_sel) !important;	/* InfraS change : jeton OBLYON_COLOR_TOPMENU_TXT_SEL */
	font-weight: bold!important;
}
/* InfraS change end */

li.tmenuend {
	display: none;
}

div.tmenuleft {
	float: var(--left);
	height: <?php print $heightmenu+4; ?>px;
	margin-top: -4px;
}

div.tmenucenter {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		height: 40px;
		line-height: 40px;
	<?php } else { ?>
		height: <?php print $heightmenu+2; ?>px;
	<?php } ?>
	padding: 0;
	width: 100%;
}

/*
.main-nav__list .mainmenuaspan {
	<?php if (empty($conf->dol_optimize_smallscreen)) {
		if (getDolGlobalString('OBLYON_HIDE_LEFTICONS')) {	?>
			padding: 14px !important;
		<?php } else { ?>
			padding: 14px 0 !important;
		<?php }
	} else { ?>
		display: none;
	<?php } ?>
}
*/

/**
* Secondary Navigation
*/
div.blockvmenulogo
{
	border-bottom: 0 !important;
}
.menulogocontainer {
	margin: <?php print $disableimages?'0':'3'; ?>px;
	margin-left: 11px;
	margin-right: 9px;
	padding: 0;
	height: <?php print $disableimages?'20':'32'; ?>px;
	/* width: 100px; */
	max-width: 100px;
	vertical-align: middle;
}
.backgroundforcompanylogo {
	background-color: var(--logo_background_color);
	<?php if (getDolGlobalString('OBLYON_LOGO_PADDING') && getDolGlobalString('OBLYON_LOGO_PADDING') == "padding") { ?>
		padding: 0 5px 0 5px;
	<?php } else { ?>
		padding: 0;
	<?php } ?>
}
.menulogocontainer img.mycompany {
	object-fit: contain;
	width: inherit;
	height: inherit;
}
#mainmenutd_companylogo::after, #mainmenutd_menu::after {
	content: unset !important;
}
li#mainmenutd_companylogo .tmenucenter {
	width: unset;
	background-color: var(--logo_background_color);
}
li#mainmenutd_companylogo {
	min-width: unset !important;
}
<?php if ($disableimages) { ?>
	li#mainmenutd_home {
		min-width: unset !important;
	}
	li#mainmenutd_home .tmenucenter {
		width: unset;
	}
<?php } ?>

.blockvmenupairinvert {
	margin: 0;
	padding: 0;
	position: relative;
}

#tmenu_tooltipinvert div.menu_titre {
	float: var(--left);
}

#tmenu_tooltipinvert a.vmenu {
	color: var(--bgnavleft_txt);
	display: block;
	font-size: 13px;
	line-height: 40px;
	padding: 0 9px;
	transition: all .2s ease-in-out;
	-moz-transition: all .2s ease-in-out;
	-webkit-transition: all .2s ease-in-out;
}

#tmenu_tooltipinvert div.menu_titre:hover {
	background-color: var(--bgnavleft_hover);
}

#tmenu_tooltipinvert div.menu_titre:hover + div.menu_contenu {
	display: block;
}

#tmenu_tooltipinvert img {
	vertical-align: text-bottom;
}

/*------------------------------------*\
#Left Menu (eldy style)
\*------------------------------------*/

/**
* Secondary Navigation
*/

div.vmenu {
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		background-color: var(--bgnavtop);
	<?php } else { ?>
		background-color: var(--bgnavleft);
	<?php } ?>
	float: var(--left);
	margin-<?php print $right; ?>: 0;
	padding: 0;
	padding-bottom: 0;
	position: relative;
	z-index: 5;
	<?php if (empty($conf->dol_optimize_smallscreen)) { ?>
		<?php if (getDolGlobalString('OBLYON_REDUCE_LEFTMENU')) { ?>
			max-width: 40px;
		<?php } else { ?>
			min-width: 230px;
			max-width: 230px;
		<?php } ?>
		<?php if (getDolGlobalString('OBLYON_HIDE_LEFTMENU') || !empty($conf->dol_optimize_smallscreen)) { ?>
			width: 230px;
		<?php } else { ?>
			width: 100%;
		<?php } ?>
	<?php } ?>
	min-height: 100vh;
	-webkit-transition-property: max-width;
	-webkit-transition-duration: 0.2s;
	-webkit-transition-timing-function: linear;
	transition-property: max-width;
	transition-duration: 0.2s;
	transition-timing-function: linear;
}

<?php if (getDolGlobalString('OBLYON_REDUCE_LEFTMENU') && getDolGlobalString('OBLYON_EFFECT_REDUCE_LEFTMENU') && getDolGlobalString('OBLYON_EFFECT_REDUCE_LEFTMENU') == "hover") { ?>
	.vmenu:hover {
		max-width: 230px;
		<?php if (!getDolGlobalString('MAIN_MENU_INVERT')) { ?>
			min-width: 230px;
		<?php } ?>
		<?php if (getDolGlobalString('OBLYON_REDUCE_LEFTMENU') && getDolGlobalString('OBLYON_EFFECT_REDUCE_LEFTMENU') && getDolGlobalString('OBLYON_EFFECT_REDUCE_LEFTMENU') == "hover") { ?>
			min-width: 230px;
		<?php } ?>
		-webkit-transition-property: max-width;
		-webkit-transition-duration: 0.2s;
		-webkit-transition-timing-function: linear;
		transition-property: max-width;
		transition-duration: 0.2s;
		transition-timing-function: linear;
	}
<?php } ?>

<?php if (getDolGlobalString('OBLYON_REDUCE_LEFTMENU') && getDolGlobalString('OBLYON_EFFECT_REDUCE_LEFTMENU') && getDolGlobalString('OBLYON_EFFECT_REDUCE_LEFTMENU') == "hover") { ?>
	.vmenu.sec-nav__link:hover {
		min-width: unset !important;
	}
<?php } ?>

.vmenu {
	<?php if (GETPOST("optioncss", "aZ09") == 'print') { ?>
		display: none;
	<?php } ?>
}

.vmenu .blockvmenupair div.menu_titre,
.vmenu .blockvmenuimpair div.menu_titre {
	display: block;
}

.vmenu .blockvmenupair div.menu_titre a,
.vmenu .blockvmenuimpair div.menu_titre a {
	background-color: var(--bgnavleft_hover);
	color: #eee;
	display: block;
	padding: 8px;
	transition: all .2s ease-in-out;
	-moz-transition: all .2s ease-in-out;
	-webkit-transition: all .2s ease-in-out;
}

a.vmenu:link,
a.vmenu:visited,
a.vmenu:hover,
a.vmenu:active,
span.vmenu {
	font-size:var(--fontsize);
	font-weight: normal;
	text-align: var(--left);
	text-decoration: none;
}

.vmenu div.blockvmenupair div.menu_titre a:hover,
.vmenu div.blockvmenuimpair div.menu_titre a:hover {
	color: var(--bgnavleft_txt_hover);	/* InfraS change : texte de survol = jeton du menu (OBLYON_COLOR_*MENU_TXT_HOVER), plus la couleur principale : le libelle disparaissait quand elle est proche du fond de survol */
}

font.vmenudisabled	{
	color: #93a5aa;
	font-size:var(--fontsize);
	font-weight: bold;
	text-align: var(--left);
}

/* sub-items */

.vmenu div.blockvmenupair .menu_contenu,
.vmenu div.blockvmenuimpair .menu_contenu {
	padding: 4px;
}

.vmenu div.blockvmenupair .menu_contenu:first-child,
.vmenu div.blockvmenuimpair .menu_contenu:first-child {
margin-top: 10px;
}

.vmenu .blockvmenupair div.menu_contenu a,
.vmenu .blockvmenuimpair div.menu_contenu a {
color: #eee;
font-weight: normal;
margin: 1px 1px 1px 8px;
text-decoration: none;
}

a.vsmenu:link,
a.vsmenu:visited,
a.vsmenu:active {
font-weight: normal;
}

.vmenu .blockvmenupair div.menu_contenu a:hover,
.vmenu .blockvmenuimpair div.menu_contenu a:hover {
color: var(--bgnavleft_txt_hover);	/* InfraS change : texte de survol = jeton du menu (OBLYON_COLOR_*MENU_TXT_HOVER), plus la couleur principale : le libelle disparaissait quand elle est proche du fond de survol */
}

font.vsmenudisabled {
color: #93a5aa;
font-size:var(--fontsize);
font-weight: normal;
text-align: var(--left);
}

font.vsmenudisabledmargin {
margin: 1px 1px 1px 8px;
}

a.vsmenu img{
vertical-align: bottom;
}

.vmenu div.blockvmenupair,
.vmenu div.blockvmenuimpair {
background-color: var(--bgnavleft);
padding: 0;
text-align: var(--left);
}

div.blockvmenuimpair:first-child { padding: 0; }

.vmenu .menu_top {
margin-top: 2.5px;
}

.vmenu .menu_end {
margin-bottom: 5px;
}

td.barre {
background-color: #b3c5cc;
border-right: 1px solid #000;
border-bottom: 1px solid #000;
color: #000;
text-align: var(--left);
text-decoration: none;
}

td.barre_select {
background-color: #b3c5cc;
color: #000;
}

td.photo {
background-color: #f4f4f4;
border: 1px solid #b3c5cc;
color: #000;
}

.vmenusearchselectcombo {
width: 100%;
}

/**
* Main Navigation
*/

/*------------------------------------*\
#Eldy Navigation Icons
\*------------------------------------*/

<?php if (empty($conf->dol_optimize_smallscreen)) { ?>

	.mainmenu {
	background-position: center center;
	background-repeat: no-repeat;
	background-size: 24px;
	margin-<?php print $left; ?>: 0;
	<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		float: var(--left);
		height: 40px;
		margin-<?php print $right; ?>: 5px;
		width: 40px;
	<?php } else { ?>
		height: 36px;
		min-width: 40px;
	<?php }

	if (getDolGlobalString('OBLYON_HIDE_TOPICONS') && !getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		display: none;
	<?php } elseif (getDolGlobalString('OBLYON_HIDE_LEFTICONS') && getDolGlobalString('MAIN_MENU_INVERT')) { ?>
		display: none;
	<?php } else { ?>
		display: block;
	<?php } ?>
	}

	<?php
}	// End test if not phone
?>

<?php
// Add here more div for other menu entries. moduletomainmenu=array('module name'=>'name of class for div')
$moduletomainmenu=array('user'=>'','syslog'=>'','societe'=>'companies','projet'=>'project','propale'=>'commercial','commande'=>'commercial','produit'=>'products','service'=>'products','stock'=>'products','don'=>'accountancy','tax'=>'accountancy','banque'=>'accountancy','facture'=>'accountancy','compta'=>'accountancy','accounting'=>'accountancy','adherent'=>'members','import'=>'tools','export'=>'tools','mailing'=>'tools','contrat'=>'commercial','ficheinter'=>'commercial','ticket'=>'ticket','deplacement'=>'commercial','fournisseur'=>'companies','ftp'=>'','externalsite'=>'','barcode'=>'','fckeditor'=>'','categorie'=>'','opensurvey' => '', 'bittorrent'=>'', 'cron'=>'', 'scanner'=>'', 'reports'=>'');
$mainmenuused='home';

foreach($conf->modules as $val) {
	$mainmenuused.=','.(isset($moduletomainmenu[$val])?$moduletomainmenu[$val]:$val);
}
//var_dump($mainmenuused);
$mainmenuusedarray=array_unique(explode(',',$mainmenuused));

$generic=1;
// Put here list of menu entries when the div.mainmenu.menuentry was previously defined
$divalreadydefined=array('home','companies','products','commercial','externalsite','accountancy','project','tools','members','agenda','ftp','holiday','hrm','bookmark','cashdesk','ecm','geoipmaxmind','gravatar','clicktodial','paypal','stripe','webservices','website','ticket','mrp');
// Put here list of menu entries we are sure we don't want
$divnotrequired=array('multicurrency','salaries','margin','opensurvey','paybox','expensereport','incoterm','prelevement','propal','workflow','notification','supplier_proposal','cron','product','productbatch','expedition');
foreach($mainmenuusedarray as $val)
{
	if (empty($val) || in_array($val,$divalreadydefined)) continue;
	if (in_array($val,$divnotrequired)) continue;
	//print "XXX".$val;

	// Search img file in module dir
	$found=0;
	$url='';
	foreach($conf->file->dol_document_root as $dirroot) {
		if (file_exists($dirroot."/".$val."/img/".$val.".png")) {
			$url=dol_buildpath('/'.$val.'/img/'.$val.'.png', 1);
			$found=1;
			break;
		}
	}

	if ( $found ) {
		print ".mainmenu.".$val.", .icon--".$val." {\n";

		print "  background: url(".$url.") no-repeat center;\n";
		print "  background-size: 22px;\n";
		print "}\n";
	} else {
		print "/* A mainmenu entry but img file ".$val.".png not found (check /".$val."/img/".$val.".png), so we use a generic one */\n";
		print ".mainmenu.".$val.":before, .icon--".$val.":before {\n";
		print "  content: '\\f152';\n";
		print "}\n";
	}
}
//End of part to add more div class css
?>

/*------------------------------------*\
#Login Page
\*------------------------------------*/
<?php
include dol_buildpath($path.'/theme/'.$theme.'/login.inc.php', 0);
?>

/*------------------------------------*\
#Main Panes
\*------------------------------------*/

/*
*	PANES and CONTENT-DIVs
*/

#mainContent,
#leftContent .ui-layout-pane {
overflow: auto;
padding: 0;
}

#mainContent,
#leftContent .ui-layout-center {
overflow: auto;	/* add scrolling to content-div */
padding: 0;
position: relative; /* contain floated or positioned elements */
}

#containerlayout .layout-with-no-border {
border: 0 !important;
border-width: 0 !important;
}

#containerlayout .layout-padding {
padding: 2px !important;
}

#containerlayout .ui-layout-pane { /* all 'panes' */
background-color: var(--colorOverlayBg);	/* InfraS change : jeton 3.7.0 */
border: 1px solid #bbb;
/* DO NOT add scrolling (or padding) to 'panes' that have a content-div,
otherwise you may get double-scrollbars - on the pane AND on the content-div
*/
padding: 0;
overflow: auto;
}

/* (scrolling) content-div inside pane allows for fixed header(s) and/or footer(s) */
#containerlayout .ui-layout-content {
overflow: auto; /* add scrolling to content-div */
padding: 10px;
position: relative; /* contain floated or positioned elements */
}

/**
* Toolbar ECM and Filemanager
*/

.largebutton {
background-repeat: repeat-x !important;
border: 1px solid rgba(0,0,0, .32) !important;
box-shadow: 4px 4px 4px rgba(0,0,0, .24);
-moz-box-shadow: 4px 4px 4px rgba(0,0,0, .24);
-webkit-box-shadow: 4px 4px 4px rgba(0,0,0, .24);
padding: 0 4px 0 4px !important;
margin-bottom: 1em;
}

a.toolbarbutton {
height: 30px;
margin-top: 0;
margin-left: 4px;
margin-right: 4px;
}

img.toolbarbutton {
height: 30px;
margin-top: 1px;
}

/**
* RESIZER-BARS
*/

.ui-layout-resizer { /* all 'resizer-bars' */
width: <?php print (empty($conf->dol_optimize_smallscreen)?'8':'24'); ?>px !important;
}

/* NOTE: It looks best when 'hover' and 'dragging' are set to the same color,
otherwise color shifts while dragging when bar can't keep up with mouse */
/*.ui-layout-resizer-open-hover ,*/ /* hover-color to 'resize' */
.ui-layout-resizer-dragging {	 /* resizer beging 'dragging' */
	background-color: #ddd;
	width: <?php print (empty($conf->dol_optimize_smallscreen)?'8':'24'); ?>px;
}

.ui-layout-resizer-dragging {	 /* CLONED resizer being dragged */
	border-left:	1px solid #bbb;
	border-right: 1px solid #bbb;
}

/* NOTE: Add a 'dragging-limit' color to provide visual feedback when resizer hits min/max size limits */
.ui-layout-resizer-dragging-limit { /* CLONED resizer at min or max size-limit */
	background-color: #e1a4a4; /* red */
}

.ui-layout-resizer-closed {
	background-color: #ddd;
}

.ui-layout-resizer-closed:hover {
	background-color: #edd;
}

.ui-layout-resizer-sliding {		/* resizer when pane is 'slid open' */
	filter:	alpha(opacity=10);
	opacity: .10; /* show only a slight shadow */
}

.ui-layout-resizer-sliding-hover {	/* sliding resizer - hover */
	filter:	alpha(opacity=100);
	opacity: 1; /* on-hover, show the resizer-bar normally */
}

/* sliding resizer - add 'outside-border' to resizer on-hover */
/* this sample illustrates how to target specific panes and states */
/*.ui-layout-resizer-north-sliding-hover	{ border-bottom-width:	1px; }
.ui-layout-resizer-south-sliding-hover	{ border-top-width:		 1px; }
.ui-layout-resizer-west-sliding-hover	 { border-right-width:	 1px; }
.ui-layout-resizer-east-sliding-hover	 { border-left-width:		1px; }
*/

/**
* TOGGLER-BUTTONS
*/

.ui-layout-toggler {
	<?php if (empty($conf->dol_optimize_smallscreen)) { ?>
		background-color: var(--oblyon-neutral-bg);	/* InfraS change : jeton 3.7.0 */
		border-top: 1px solid #aaa; /* match pane-border */
		border-right: 1px solid #aaa; /* match pane-border */
		border-bottom: 1px solid #aaa; /* match pane-border */
		top: 5px !important;
	<?php } else { ?>
		diplay: none;
	<?php } ?>
}

.ui-layout-toggler-open {
	height: 54px !important;
	width: <?php print (empty($conf->dol_optimize_smallscreen)?'7':'22'); ?>px !important;
	-moz-border-radius: 0 10px 10px 0;
	-webkit-border-radius: 0 10px 10px 0;
	border-radius: 0 10px 10px 0;
}

.ui-layout-toggler-closed {
	height: <?php print (empty($conf->dol_optimize_smallscreen)?'54':'2'); ?>px !important;
	width: <?php print (empty($conf->dol_optimize_smallscreen)?'7':'22'); ?>px !important;
	-moz-border-radius: 0 10px 10px 0;
	-webkit-border-radius: 0 10px 10px 0;
	border-radius: 0 10px 10px 0;
}

.ui-layout-toggler .content {	/* style the text we put INSIDE the togglers */
	color:					var(--oblyon-muted-text);	/* InfraS change : jeton 3.7.0 */
	font-size:var(--fontsize);
	font-weight:		bold;
	width:					100%;
	padding-bottom: .35ex; /* to 'vertically center' text inside text-span */
}

/* hide the toggler-button when the pane is 'slid open' */
.ui-layout-resizer-sliding	ui-layout-toggler {
	display: none;
}

.ui-layout-north {
	height: <?php print (empty($conf->dol_optimize_smallscreen)?'54':'21'); ?>px !important;
}

/**
* ECM
*/

#containerlayout .ecm-layout-pane { /* all 'panes' */
	background-color: var(--colorOverlayBg);	/* InfraS change : jeton 3.7.0 */
	border: 1px solid #bbb;
	/* DO NOT add scrolling (or padding) to 'panes' that have a content-div,
	otherwise you may get double-scrollbars - on the pane AND on the content-div
	*/
	overflow: auto;
	padding: 0;
}

/* (scrolling) content-div inside pane allows for fixed header(s) and/or footer(s) */
#containerlayout .ecm-layout-content {
	overflow: auto; /* add scrolling to content-div */
	padding: 10px;
	position: relative; /* contain floated or positioned elements */
}

.ecm-layout-toggler {
	background-color: var(--oblyon-neutral-bg);	/* InfraS change : jeton 3.7.0 */
	border-top: 1px solid #aaa; /* match pane-border */
	border-right: 1px solid #aaa; /* match pane-border */
	border-bottom: 1px solid #aaa; /* match pane-border */
}

.ecm-layout-toggler-open {
	border-radius: 0 10px 10px 0;
	-moz-border-radius: 0 10px 10px 0;
	-webkit-border-radius: 0 10px 10px 0;
	height: 48px !important;
	width: 6px !important;
}

.ecm-layout-toggler-closed {
	height: 48px !important;
	width: 6px !important;
}

.ecm-layout-toggler .content {	/* style the text we put INSIDE the togglers */
	color: var(--oblyon-muted-text);	/* InfraS change : jeton 3.7.0 */
	font-size:var(--fontsize);
	font-weight: bold;
	width: 100%;
	padding-bottom: .35ex; /* to 'vertically center' text inside text-span */
}

#ecm-layout-west-resizer {
	width: 6px !important;
}

.ecm-layout-resizer	{ /* all 'resizer-bars' */
	border: 1px solid #bbb;
	border-width: 0;
}

.ecm-in-layout-center {
	border-left: 1px !important;
	border-right: 0 !important;
	border-top: 0 !important;
}

.ecm-in-layout-south {
	border-left: 0 !important;
	border-right: 0 !important;
	border-bottom: 0 !important;
	padding: 4px 0 4px 4px !important;
}

/* ============================================================================== */
/* Tabs																		   */
/* ============================================================================== */
div.tabs {
	text-align: var(--left);
	margin-top: 15px;
	/* margin-left: 6px; */
	margin-bottom: -1px;
	padding-left: 3px;
	padding-right: 6px;
	clear: both;
	font-weight: normal;
	height: 100%;
}

div.tabsElem {
	margin-top: 1px;
	margin-left: 5px;
}	/* To avoid overlap of tabs when not browser */

div.tabsElem:hover,
div.tabsElem a.tab:hover {
	background-color: var(--bgnavleft_hover);
	color: var(--bgnavleft_txt_hover);
}

/* InfraS change begin : carte de fiche arrondie, ombre legere, plus d'air */
div.tabBar {
	background-color: var(--colorbline);
	border: 1px solid var(--oblyon-border);
	box-shadow: var(--oblyon-shadow-sm);
	border-radius: var(--oblyon-radius);
	color: var(--colorfline);
	margin-bottom: 14px;
	padding-top: var(--oblyon-card-py);	/* densite (3.8.0) */
	padding-left: <?php print ($dol_optimize_smallscreen?'6':'14'); ?>px;
	padding-right: <?php print ($dol_optimize_smallscreen?'6':'14'); ?>px;
	padding-bottom: var(--oblyon-card-py);	/* densite (3.8.0) */
	width: auto;
}
/* InfraS change end */

div.tabsAction {
	margin: 20px 0 30px 0;	/* InfraS change : valeur de l'ancienne definition dupliquee (supprimee plus bas) */
	padding: 0;
	text-align: var(--right);
	<?php if (getDolGlobalString('FIX_ABSOLUTE_BUTTONS_ACTION_CARD')) { ?>
		position: sticky;
		z-index: 4;
		bottom: 0;
		<?php if (GETPOST("optioncss", "aZ09") == 'print') {	?>
			background-color: #fff !important;
		<?php } else { ?>
			background-color: var(--bgcolor) !important;
		<?php } ?>
	<?php } ?>
}
<?php if (getDolGlobalString('FIX_ABSOLUTE_BUTTONS_ACTION_CARD') && GETPOST("optioncss", "aZ09") != 'print') { ?>
	/* Sticky action bar: raise z-index of dropdown above the bar (z-index 4) */
	/* The --up class is applied automatically by JS when the dropdown overflows the viewport */
	div.tabsAction .dropdown-holder {
		position: relative;
		z-index: 5;
	}
	div.tabsAction .dropdown-holder .dropdown-content {
		bottom: auto !important;
		top: 0 !important;
		transform: translateY(-100%) !important; /* InfraS add: pair with top:0 so the menu opens upward instead of overlapping content below */
		background-color: var(--bgcolor) !important;
	}
		/* Dropdown links match the theme */
	div.tabsAction .dropdown-content .butAction {
		color: var(--colortext) !important;
		background: none !important;
		border: none !important;
	}
	div.tabsAction .dropdown-content .butAction:hover {
		background-color: var(--colorButtonAction1) !important;
		color: var(--colorTextButtonAction) !important;
	}
<?php } ?>
div.tabactive,
div.tabactive a.tab {
	background-color: var(--colorbacktabactive);
	color: var(--colortextbacktab);
	height: 38px;
}

a.tab {
	color: var(--colorfline);
	font-weight: normal;
	border-radius: var(--oblyon-radius) var(--oblyon-radius) 0 0;
	transition: background-color var(--oblyon-transition), color var(--oblyon-transition);
}

a.tab:hover, a.tab:focus {
	background-color: var(--oblyon-neutral-bg);
	color: var(--maincolor);
}

table.notopnoleft td.liste_titre {
	border: 1px solid var(--oblyon-border) !important;
	box-shadow: var(--oblyon-shadow-sm);
	margin: 0 0 2px 0;
	padding: .8em .5em!important;
}
/* InfraS change end */

div.tabBar ul li {
	margin-<?php print $left; ?>: 30px !important;
}

/* Payment Screen : Pointer cursor in the autofill image */
.AutoFillAmount {
	cursor:pointer;
}

div.popuptabset {
	background-color: var(--colorbline);
	padding: 5px;
	border: 1px solid var(--oblyon-border);	/* InfraS change */
	border-radius: var(--oblyon-radius);	/* InfraS add */
	box-shadow: var(--oblyon-shadow-md);	/* InfraS add */
}

div.popuptab {
	padding-top: 5px;
	padding-bottom: 5px;
	padding-left: 5px;
	padding-right: 5px;
}

/* ============================================================================== */
/* Buttons for actions															*/
/* ============================================================================== */

/* InfraS change begin : definition dupliquee de div.tabsAction supprimee (fusionnee plus haut) ; titre d'onglets sans text-shadow, couleur secondaire du preset */
div.tabsActionNoBottom {
	margin-bottom: 0px;
}
div.tabsAction > a {
	margin-bottom: 16px !important;
}

a.tabTitle {
	color: var(--oblyon-muted-text) !important;
	font-family: var(--fontfamilydol);
	font-weight: normal !important;
	padding: 4px 6px 2px 0px;
	margin-<?php print $right; ?>: 10px;
	text-decoration: none;
	white-space: nowrap;
}
/* InfraS change end */
.tabTitleText {
	display: none;
}
.imgTabTitle {
	max-height: 14px;
}
div.tabs div.tabsElem:first-of-type a.tab {
	margin-left: 0px !important;
}

a.tabunactive {
	color: var(--colortextlink) !important;
}
a.tab:link, a.tab:visited, a.tab:hover, a.tab#active {
	font-family: var(--fontfamilydol);
	padding: 12px 14px 13px;
	text-decoration: none;
	white-space: nowrap;

	background-image: none !important;
}

/* InfraS change begin : onglet actif signale par un liseret d'accent en haut, coins superieurs arrondis, bordures neutres du preset */
.tabactive, a.tab#active {
	color: var(--colortextbacktab) !important;
	background: var(--colorbacktabcard1) !important;
	margin: 0 0.2em 0 0.2em !important;
	text-decoration: none;

	border: 1px solid var(--oblyon-border);
	border-bottom: none;
	border-radius: var(--oblyon-radius) var(--oblyon-radius) 0 0;
	box-shadow: inset 0 3px 0 var(--maincolor);
	font-weight: 600 !important;
}
.tabunactive, a.tab#unactive {
	border: 1px solid var(--oblyon-border);
	border-bottom: 0px !important;
	border-radius: var(--oblyon-radius) var(--oblyon-radius) 0 0;
	height: 38px;
}
<?php if ($oblyon_tabs_style == 'underline') { ?>
/* style des onglets "soulignes" (OBLYON_TABS_STYLE = underline, 3.8.0) : bande neutre a coins superieurs arrondis, fermee par un filet ;
   onglets inactifs en texte attenue, survol en texte des lignes sur fond des lignes, actif en couleur principale sur fond des lignes avec un soulignement de 3 px
   qui recouvre le filet. Le core enveloppe chaque lien dans div.tab.tabactive / div.tab.tabunactive : le soulignement est porte par cette boite seulement (le lien n'en a pas).
   La rangee devient une boite flexible : sa hauteur est reelle (height: 100% d'origine ne calcule rien) et sa marge basse ecarte la carte */
div.tabs {
	display: flex;
	flex-wrap: wrap;
	align-items: flex-end;
	height: auto;
	margin-bottom: 12px;
	padding: 4px 6px 0;
	background: var(--oblyon-tab-under-band);	/* OBLYON_COLOR_TAB_UNDER_BAND (fond neutre par defaut) */
	border-radius: var(--oblyon-radius) var(--oblyon-radius) 0 0;
	border-bottom: 1px solid var(--oblyon-tab-under-border);	/* avec l'option "bandeau des onglets fixe", fixes.inc.php reprend ce fond, ce filet et l'espace avant la carte (sa regle est prioritaire) */
}
div.tabs > div.tabsElem.floatright {
	order: 99;	/* le core imprime la zone de droite en premier et la flotte a droite ; dans une boite flexible le flottement n'agit plus : renvoyee en fin de rangee */
	margin-<?php print $left; ?>: auto;	/* et poussee au bout de la rangee */
	align-self: center;
}
div.tabsElem {
	margin-top: 0;
	margin-left: 0;
}
div.tabs > div.tabsElem > div.tab, .tabactive, a.tab#active, .tabunactive, a.tab#unactive {
	background: transparent !important;
	border: 0 !important;
	border-radius: var(--oblyon-radius-sm) var(--oblyon-radius-sm) 0 0;
	box-shadow: none;
	margin: 0 !important;
	height: auto;
}
div.tabs > div.tabsElem > div.tab {
	border-bottom: 3px solid transparent !important;	/* reserve la place du soulignement : les onglets ne bougent pas quand l'actif change */
	margin-bottom: -1px !important;	/* le soulignement de l'actif recouvre le filet de la bande */
	transition: background-color var(--oblyon-transition), border-color var(--oblyon-transition);
}
div.tabs > div.tabsElem > div.tab.tabactive {
	background: var(--colorbline) !important;
	border-bottom-color: var(--oblyon-tab-under-line) !important;	/* OBLYON_COLOR_TAB_UNDER_LINE (couleur principale par defaut) */
}
div.tabs > div.tabsElem > div.tab:hover {
	background: var(--colorbline) !important;
}
a.tab, div.tabactive a.tab {
	background: transparent !important;
	color: var(--oblyon-muted-text);
	font-weight: 500 !important;
	height: auto;
}
div.tabactive a.tab, a.tab#active {
	color: var(--oblyon-tab-under-txt) !important;	/* OBLYON_COLOR_TAB_UNDER_TXT (couleur principale par defaut) */
	font-weight: 600 !important;
}
a.tab:link, a.tab:visited, a.tab:hover, a.tab#active {
	padding: 9px 14px 8px;
}
a.tab:hover, a.tab:focus, div.tabsElem:hover, div.tabsElem a.tab:hover {
	background-color: transparent !important;	/* le fond de survol est sur la boite div.tab, pas sur le lien */
	color: var(--colorfline) !important;
}
div.tabactive a.tab:hover, a.tab#active:hover {
	color: var(--oblyon-tab-under-txt) !important;
}
<?php } elseif ($oblyon_tabs_style == 'pills') { ?>
/*  style des onglets "pilules" (OBLYON_TABS_STYLE = pills, 3.8.0) : pilules arrondies, l'active sur un fond teinte de la couleur principale.
   Rangee en boite flexible (hauteur reelle, voir le style "soulignes") avec un espace de 6 px entre pilules et 12 px avant la carte */
div.tabs {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	gap: 6px;
	height: auto;
	margin-bottom: 12px;
	padding-left: 0;
}
div.tabs > div.tabsElem.floatright {
	order: 99;	/* zone de droite imprimee en premier par le core : renvoyee en fin de rangee (voir le style "soulignes") */
	margin-<?php print $left; ?>: auto;	/* avec l'option "bandeau des onglets fixe", fixes.inc.php retire le filet et garde l'espace avant la carte */
}
div.tabsElem {
	margin-top: 0;
	margin-left: 0;
}
div.tabs > div.tabsElem > div.tab, .tabactive, a.tab#active, .tabunactive, a.tab#unactive {
	background: transparent !important;
	border: 0 !important;
	border-radius: var(--oblyon-radius-pill) !important;
	box-shadow: none;
	margin: 0 !important;
	height: auto;
}
a.tab, div.tabactive a.tab {
	background: transparent !important;
	color: var(--colorfline);
	border-radius: var(--oblyon-radius-pill);
	height: auto;
}
div.tab.tabactive, a.tab#active, div.tabactive a.tab {
	background: var(--oblyon-tab-pill-bg) !important;
	color: var(--oblyon-tab-pill-txt) !important;
	font-weight: 600 !important;
}
a.tab:link, a.tab:visited, a.tab:hover, a.tab#active {
	padding: 7px 14px;
}
a.tab:hover, a.tab:focus, div.tabsElem:hover, div.tabsElem a.tab:hover {
	background-color: var(--oblyon-neutral-bg) !important;
	color: var(--oblyon-tab-pill-txt) !important;
}
div.tabactive a.tab:hover, div.tabactive:hover {
	background-color: var(--oblyon-tab-pill-bg-hover) !important;
}
<?php if (getDolGlobalInt('OBLYON_TAB_PILL_BORDER')) { ?>
/* option "bordure des pilules" : cadre de 1 px sur chaque pilule (couleur OBLYON_COLOR_TAB_PILL_BORDER, cadre neutre par defaut) */
div.tabs > div.tabsElem > div.tab {
	border: 1px solid var(--oblyon-tab-pill-border) !important;
}
<?php } ?>
<?php if (getDolGlobalInt('OBLYON_TAB_PILL_SHADOW')) { ?>
/* option "ombre des pilules" : ombre legere, plus marquee au survol (jetons d'ombre du theme) */
div.tabs > div.tabsElem > div.tab {
	box-shadow: var(--oblyon-shadow-sm);
}
div.tabs > div.tabsElem > div.tab:hover {
	box-shadow: var(--oblyon-shadow-md);
}
<?php } ?>
<?php } ?>
a.tabimage {
	color: var(--colorfline);
	font-family: var(--fontfamilydol);
	text-decoration: none;
	white-space: nowrap;
}

td.tab {
	background-color: var(--colorbline);
	border: 1px solid var(--oblyon-border) !important;
	box-shadow: var(--oblyon-shadow-sm);
	border-radius: var(--oblyon-radius-sm) var(--oblyon-radius-sm) 0 0;
	margin: 5px;
	padding: 0 .5em;
}

span.tabspan {
	background: var(--oblyon-neutral-bg);
	color: var(--colorfline);
	font-family: var(--fontfamilydol);
	padding: 0px 6px;
	margin: 0em 0.2em;
	text-decoration: none;
	white-space: nowrap;
	border-radius: var(--oblyon-radius-sm) var(--oblyon-radius-sm) 0 0;
	border: 1px solid var(--oblyon-border);
	border-bottom: none;
}
/* InfraS change end */

/* ============================================================================== */
/* Buttons for actions															*/
/* ============================================================================== */
<?php include dol_buildpath($path.'/theme/'.$theme.'/btn.inc.php', 0); ?>
