<?php
	/*
	* Copyright (C) 2004-2017	Laurent Destailleur		<eldy@users.sourceforge.net>
	* Copyright (C) 2006		Rodolphe Quiedeville	<rodolphe@quiedeville.org>
	* Copyright (C) 2007-2017	Regis Houssin			<regis.houssin@inodbox.com>
	* Copyright (C) 2011		Philippe Grand			<philippe.grand@atoo-net.com>
	* Copyright (C) 2012		Juanjo Menent			<jmenent@2byte.es>
	* Copyright (C) 2018		Ferran Marcet			<fmarcet@2byte.es>
	* Copyright (C) 2022-2026  Sylvain Legrand      <contact@infras.fr>
	*
	* This program is free software; you can redistribute it and/or modify
	* it under the terms of the GNU General Public License as published by
	* the Free Software Foundation; either version 3 of the License, or
	* (at your option) any later version.
	*
	* This program is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FI8TNESS FOR A PARTICULAR PURPOSE.	See the
	* GNU General Public License for more details.
	*
	* You should have received a copy of the GNU General Public License
	* along with this program. If not, see <https://www.gnu.org/licenses/>.
	*/

	/**
	* \file		htdocs/theme/oblyon/theme_vars.inc.php
	* \brief		File to declare variables of CSS style sheet
	* \ingroup		core
	*
	*	To include file, do this:
	*	$var_file = DOL_DOCUMENT_ROOT.'/theme/'.$conf->theme.'/theme_vars.inc.php';
	*	if (is_readable($var_file)) include $var_file;
	*/
	dol_include_once('/oblyon/backport/v21/core/lib/functions.lib.php');

	global $conf, $theme_bordercolor, $theme_datacolor, $theme_bgcolor, $theme_bgcoloronglet;

	// Define fonts
	// InfraS change begin : police choisie (THEME_FONT_FAMILY) en tete, pile systeme moderne en repli ; sans reglage = pile systeme ; une valeur deja composee (virgule) est prise telle quelle
	$oblyon_font_stack	= 'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
	$oblyon_font_family	= trim(getDolGlobalString('THEME_FONT_FAMILY', ''));
	if ($oblyon_font_family === '' || strtolower($oblyon_font_family) == 'system-ui') {
		$fontlist	= $oblyon_font_stack;
	} elseif (strpos($oblyon_font_family, ',') !== false) {
		$fontlist	= $oblyon_font_family;
	} else {
		$fontlist	= '"'.$oblyon_font_family.'", '.$oblyon_font_stack;
	}
	$fontboxtitle		= $fontlist;
	$fontlisted			= $fontlist;
	/* Main menu */
	$fontmainmenu		= $fontlist;
	/* Secondary menu */
	$fontsecmenu		= $fontlist;
	$fontmenusearch		= $fontlist;
	$fontmenubookmarks	= $fontlist;
	$fontmenuhelp		= $fontlist;
	// InfraS change end
	$img_head			= '';
	$usegradient		= 0;
	$borderwidth		= 1;	// InfraS change : liseret haut des boites et titres de listes ramene de 3 a 1 px (design 3.4.1)
	// Font size and line height
	$fontsizebase		= getDolGlobalInt('THEME_ELDY_FONT_SIZE1', 14);
	$fontsize			= !empty($conf->dol_optimize_smallscreen) ? $fontsizebase - 2 : $fontsizebase;
	$fontsizesmaller	= empty($conf->dol_optimize_smallscreen) ? $fontsizebase - 3 : $fontsizebase;
	$topMenuFontSize	= '1em';
	$lineHeight			= '1.4em';
	$dropdownLineHeight	= '1.4em';
	$tblImageMaxHeight	= getDolGlobalInt('OBLYON_IMAGE_HEIGHT_TABLE', 32);
	// Theme Colors
	$theme_bordercolor	= array(235, 235, 224);
	$theme_datacolor	= array(array(137, 86, 161),
								array(60, 147, 183),
								array(250, 190, 80),
								array(80, 166, 90),
								array(190, 190, 100),
								array(91, 115, 247),
								array(140, 140, 220),
								array(190, 120, 120),
								array(115, 125, 150),
								array(100, 170, 20),
								array(150, 135, 125),
								array(85, 135, 150),
								array(150, 135, 80),
								array(150, 80, 150)
								);
	if (!defined('ISLOADEDBYSTEELSHEET')) {	// File is run after an include of a php page, not by the style sheet, if the constant is not defined.
		if (!empty(getDolGlobalString('MAIN_OPTIMIZEFORCOLORBLIND'))) { // user is loaded by dolgraph.class.php
			if (getDolGlobalString('MAIN_OPTIMIZEFORCOLORBLIND') == 'flashy') {
				$theme_datacolor	= array(array(157, 56, 191),
											array(0, 147, 183),
											array(250, 190, 30),
											array(221, 75, 57),
											array(0, 166, 90),
											array(140, 140, 220),
											array(190, 120, 120),
											array(190, 190, 100),
											array(115, 125, 150),
											array(100, 170, 20),
											array(150, 135, 125),
											array(85, 135, 150),
											array(150, 135, 80),
											array(150, 80, 150)
											);
			} else {
				$theme_datacolor	= array(array(248, 220, 1),	// for now we use the same configuration for all types of color blind
											array(9, 85, 187),
											array(42, 208, 255),
											array(0, 0, 0),
											array(169, 169, 169),
											array(253, 102, 136),
											array(120, 154, 190),
											array(146, 146, 55),
											array(0, 52, 251),
											array(196, 226, 161),
											array(222, 160, 41),
											array(85, 135, 150),
											array(150, 135, 80),
											array(150, 80, 150)
											);
			}
		}
	}
	$theme_bgcolor										= array(hexdec('F4'), hexdec('F4'), hexdec('F4'));
	$theme_bgcoloronglet								= array(hexdec('DE'), hexdec('E7'), hexdec('EC'));
	// Colors
	$colorbackhmenu1									= '38,60,92'; // topmenu
	$colorbackvmenu1									= '250,250,250'; // vmenu
	$colortopbordertitle1								= '215,215,215'; // top border of title
	$colorbacktitle1									= '233,234,237'; // title of tables,list
	$colorbacktabcard1									= '255,255,255'; // card
	$colorbacktabactive									= '234,234,234';
	$colorbacklineimpair1								= '255,255,255'; // line impair
	$colorbacklineimpair2								= '255,255,255'; // line impair
	$colorbacklinepair1									= '251,251,251'; // line pair
	$colorbacklinepair2									= '251,251,251'; // line pair
	$colorbacklinepairhover								= '230,237,244'; // line hover
	$colorbacklinepairchecked							= '230,237,244'; // line checked
	$colorbacklinebreak									= '248,247,244'; // line break
	$colorbackbody										= '255,255,255';
	$colortexttitlenotab								= '35,135,140'; // 150,90,121 140,80,10 or 10,140,80	#875a7b	green=0,123,140, violet: 0,50,120
	$colortexttitlenotab2								= '100,0,100'; // 150,90,121 140,80,10 or 10,140,80	#875a7b	green=0,123,140, violet: 0,50,120
	$colortexttitle										= '40,40,60';
	$colortexttitlelink									= '10, 20, 100';
	$colortext											= '0,0,0';
	$colortextlink										= '10, 20, 100';
	$toolTipBgColor										= 'rgba(255, 255, 255, 0.96)';
	$toolTipFontColor									= '#333';
	$colorBorderInfo									= '255, 170, 0';	// '135, 207, 210';
	$colorBackInfo										= '255, 170, 0';	// '239, 248, 252';
	$colorBorderWarning									= '242, 207, 135';
	$colorBackWarning									= '252, 248, 227';
	$colorBorderError									= '255, 0, 0';	// '242, 135, 135';
	$colorBackError										= '255, 0, 0';	// '239, 207, 207';
	// text color
	$textSuccess										= '#28a745';
	$colorblind_deuteranopes_textSuccess				= '#37de5d';
	$textWarning										= '#bc9526'; // See $badgeWarning
	$textDanger											= '#af4705'; // See $badgeDanger
	$colorblind_deuteranopes_textWarning				= $textWarning; // currently not tested with a color blind people so use default color
	// Badges colors
	$badgePrimary										= '#0083A2';
	$badgeSecondary										= '#64dd17';
	$badgeSuccess										= '#28a745';
	$badgeWarning										= '#ffc107'; // See $textDanger bc9526
	$badgeDanger										= '#9f4705'; // See $textDanger
	$badgeInfo											= '#00a8f3';
	$badgeDark											= '#343a40';
	$badgeLight											= '#f8f9fa';
	// badge color ajustement for color blind
	$colorblind_deuteranopes_badgeSuccess				= '#37de5d'; //! text color black
	$colorblind_deuteranopes_badgeSuccess_textColor7	= '#000';
	$colorblind_deuteranopes_badgeWarning				= '#e4e411';
	$colorblind_deuteranopes_badgeDanger				= $badgeDanger; // currently not tested with a color blind people so use default color
		/* Couleurs de statut : certains numéros de statut ont un sens variable selon l'objet ;
	*  les couleurs sont calées sur les images de statut du thème Oblyon.
	*  Noms parlants (valeurs inchangées) ; $badgeStatusN dérivés ensuite.
	*/
	$badgeStatusDraft									= '#cbd3d3';	// brouillon
	$badgeStatusValidated								= '#bc9526';	// validé
	$badgeStatusApproved								= '#9c9c26';	// approuvé
	$badgeStatusWaiting									= '#bca52b';	// en attente / à traiter
	$badgeStatusActive									= '#25a580';	// ouvert / actif / OK
	$badgeStatusClosed									= '#cad2d2';	// fermé / annulé
	$badgeStatusCanceled								= '#e7f0f0';	// clôturé / abandonné
	$badgeStatusError									= '#993013';	// erreur / refusé
	$badgeStatusDone									= '#15a540';	// terminé
	$badgeStatus0										= $badgeStatusDraft;
	$badgeStatus1										= $badgeStatusValidated;
	$badgeStatus1b										= $badgeStatusValidated;
	$badgeStatus2										= $badgeStatusApproved;
	$badgeStatus3										= $badgeStatusWaiting;
	$badgeStatus4										= $badgeStatusActive;
	$badgeStatus4b										= $badgeStatusActive;
	$badgeStatus5										= $badgeStatusClosed;
	$badgeStatus6										= $badgeStatusClosed;
	$badgeStatus7										= $badgeStatusActive;
	$badgeStatus8										= $badgeStatusError;
	$badgeStatus9										= $badgeStatusCanceled;
	$badgeStatus10										= $badgeStatusError;
	$badgeStatus11										= $badgeStatusDone;
	// status color ajustement for color blind
	$colorblind_deuteranopes_badgeStatus4				= $colorblind_deuteranopes_badgeStatus7				= $colorblind_deuteranopes_badgeSuccess; //! text color black
	$colorblind_deuteranopes_badgeStatus_textColor4		= $colorblind_deuteranopes_badgeStatus_textColor7	= '#000';
	$colorblind_deuteranopes_badgeStatus1				= $colorblind_deuteranopes_badgeWarning;
	$colorblind_deuteranopes_badgeStatus_textColor1		= '#000';

	// Oblyon - couleurs par défaut (centralisées ; surchargées par les constantes dans style.css.php)
	$bgnavtop											= '#333';
	$bgnavtop_txt										= '#F4F4F4';
	$bgnavtop_txt_active								= '#F4F4F4';
	$bgnavtop_txt_hover									= '#F4F4F4';
	$bgnavtop_hover										= '#444';
	$bgnavleft											= '#333';
	$bgnavleft_txt										= '#F4F4F4';
	$bgnavleft_txt_active								= '#F4F4F4';
	$bgnavleft_txt_hover								= '#F4F4F4';
	$bgnavleft_hover									= '#444';
	$colorButtonAction1									= '#0088cc';
	$colorButtonAction2									= '#0044cc';
	$colorTextButtonAction								= '#FFFFFF';
	$colorButtonDelete1									= '#cc8800';
	$colorButtonDelete2									= '#cc4400';
	$colorInfoBorder									= '#87cfd2';
	$colorInfoBg										= '#eff8fc';
	$colorInfoTxt										= '';
	$colorWarningBorder									= '#f2cf87';
	$colorWarningBg										= '#fcf8e3';
	$colorWarningTxt									= '';
	$colorErrorBorder									= '#e0796e';
	$colorErrorBg										= '#f07b6e';
	$colorErrorTxt										= '';
	$colorNotifInfoBg									= '#d9e5d1';
	$colorNotifInfoTxt									= '#446548';
	$colorNotifWarningBg								= '#fff7d1';
	$colorNotifWarningTxt								= '#a28918';
	$colorNotifErrorBg									= '#d79eac';
	$colorNotifErrorTxt									= '#a72947';
	$colorTextTabActive									= '#222222';
	$colorBckgrdInput									= '#DEDEDE';
	$color1BckgrdInfobox								= '#a2e0b8';
	$color2BckgrdInfobox								= '#E4EFE8';
	$colorBorderActionColumn							= '#BBBBBB';
	$logo_background_color								= '#FFFFFF';
	$bgcolor											= '#F4F4F4';
	$login_bgcolor										= '#F4F4F4';
	$colorbtitle										= '#E09430';
	$colorAutocompleteBg								= '#0D4185';	// fond de la ligne surlignee en autocompletion (select2)
	$colorAutocompleteText								= '#FFFFFF';	// texte de la ligne surlignee en autocompletion
	$colorChipBg										= '#E4E4E4';	// fond des options DEJA selectionnees dans la liste deroulante select2
	$colorChipText										= '#000000';	// texte des options DEJA selectionnees dans la liste deroulante
	$colorResultBg										= '#444444';	// fond des etiquettes selectionnees affichees dans le champ multiselect
	$colorResultText									= '#FFFFFF';	// texte des etiquettes selectionnees affichees dans le champ
	$colorstitle										= '#F4F4F4';
	$colorbline											= '#FFFFFF';
	$colorbline_hover									= '#F1F1F1';
	$colorbline_checked									= '#F1F1F1';
	$colorfline											= '#444444';
	$colorfline_hover									= '#222222';
	$colorbtotal										= '#FFFFFF';
	$colorftotal										= '#444444';
	$colorfdatedefault									= '#FF0000';
	$colorfdateselected									= '#FF0000';
	$prospectback										= '#A7C5B0';
	$customerback										= '#55955D';
	$vendorback											= '#599CAF';
	$userback											= '#79633F';
	$colornature										= '#FFFFFF';
	$member_companyback									= '#E4E4E4';
	$member_individualback								= '#E4E4E4';
	$colormember										= '#666666';
