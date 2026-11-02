<?php
	/************************************************
	* Copyright (C) 2015-2024	Alexandre Spangaro	<alexandre@inovea-conseil.com>
	* Copyright (C) 2022-2026	Sylvain Legrand		<contact@infras.fr>
	*
	* This program is free software: you can redistribute it and/or modify
	* it under the terms of the GNU General Public License as published by
	* the Free Software Foundation, either version 3 of the License, or
	* (at your option) any later version.
	*
	* This program is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* GNU General Public License for more details.
	*
	* You should have received a copy of the GNU General Public License
	* along with this program.  If not, see <https://www.gnu.org/licenses/>.
	************************************************/

	/************************************************
	* 	\file		./theme/oblyon/style.css.php
	* 	\brief		CSS for Oblyon theme
	************************************************/

	if (! defined('NOREQUIRESOC')) {
		define('NOREQUIRESOC', '1');
	}
	if (! defined('NOCSRFCHECK')) {
		define('NOCSRFCHECK', 1);
	}
	if (! defined('NOTOKENRENEWAL')) {
		define('NOTOKENRENEWAL', 1);
	}
	if (! defined('NOLOGIN')) {
		define('NOLOGIN', 1);		 // File must be accessed by logon page so without login
	}
	if (! defined('NOREQUIREHTML')) {
		define('NOREQUIREHTML', 1);
	}
	if (! defined('NOREQUIREAJAX')) {
		define('NOREQUIREAJAX', '1');
	}
	define('ISLOADEDBYSTEELSHEET', '1');
	session_cache_limiter('public');
	require_once __DIR__.'/../../main.inc.php'; // __DIR__ allow this script to be included in custom themes
	// InfraS add begin : disposition mobile (3.5.0) : la largeur d'ecran decide (mobile.inc.php), jamais l'agent utilisateur : l'indicateur
	// "petit ecran" du core (base sur le navigateur) ne pilote plus les 30 branches de global.inc.php, qui produisent la feuille bureau
	if (getDolGlobalInt('OBLYON_MOBILE_LAYOUT', 1) && GETPOST('optioncss', 'aZ09') != 'print') {
		$conf->dol_optimize_smallscreen	= 0;
		$conf->browser->layout			= 'classic';	// idem pour les 12 branches "layout == phone" (colonnes des fiches) : gerees par largeur dans mobile.inc.php
	}
	// InfraS add end
	require __DIR__.'/theme_vars.inc.php';
	if (defined('THEME_ONLY_CONSTANT'))	return;
	require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';
	require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';
	require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
	require_once DOL_DOCUMENT_ROOT.'/user/class/user.class.php';
	dol_include_once('/oblyon/backport/v21/core/lib/functions.lib.php');
	dol_include_once('/oblyon/lib/oblyon_colors.lib.php');	// InfraS add : couleurs par utilisateur (3.6.0) : oblyon_color_setting() lit la conf utilisateur chargee plus bas

	/************************************************
	*	Select text color from background values
	*
	*	@param	string		$bgcolor			RGB value for background color
	* 	@return	string							'FFFFFF' or '000000' for white or black
	************************************************/
	function txt_color(&$bgcolor)
	{
		global $conf;

		$tmppart	= explode(',', $bgcolor);
		$tmpvalr	= (! empty($tmppart[0]) ? $tmppart[0] : 0) * 0.3;
		$tmpvalg	= (! empty($tmppart[1]) ? $tmppart[1] : 0) * 0.59;
		$tmpvalb	= (! empty($tmppart[2]) ? $tmppart[2] : 0) * 0.11;
		$tmpval		= $tmpvalr + $tmpvalg + $tmpvalb;
		$txtcolor	= $tmpval <= 128 ? 'FFFFFF' : '000000';
		return $txtcolor;
	}

	/**
	*	txt_color() pour une couleur '#RRGGBB' (ou 'r,g,b') : 'FFFFFF' ou '000000' (InfraS add 3.7.0 : format unique hex)
	*
	*	@param		string	$hex		Couleur
	*	@return		string
	**/
	function oblyon_txt_color_hex($hex)
	{
		$rgb	= join(',', colorStringToArray($hex));
		return txt_color($rgb);
	}

	// Load user to have $user->conf loaded (not done into main because of NOLOGIN constant defined) and permission, so we can later calculate number of top menu ($nbtopmenuentries) according to user profile.
	if (empty($user->id) && ! empty($_SESSION['dol_login'])) {
		$user = new User($db);
		$user->fetch(0, $_SESSION['dol_login'], '', 1);
		$user->getrights();
		// Reload menu now we have the good user (and we need the good menu to have ->showmenu('topnb') correct.
		$menumanager	= new MenuManager($db, empty($user->socid) ? 0 : 1);
		$menumanager->loadMenu();
	}
	// Define css type
	top_httphead('text/css');
	// Important: Following code is to avoid page request by browser and PHP CPU at each Dolibarr page access.
	if (empty($dolibarr_nocache)) {
		header('Cache-Control: max-age=10800, public, must-revalidate');
	} else {
		header('Cache-Control: no-cache');
	}
	if (GETPOST('theme', 'aZ09')) {
		$conf->theme=GETPOST('theme', 'alpha'); // If theme was forced on URL
	}
	if (GETPOST('lang', 'aZ09')) {
		$langs->setDefaultLang(GETPOST('lang', 'aZ09'));	// If language was forced on URL
	}
	if (GETPOST('THEME_DARKMODEENABLED', 'int')) {
		$conf->global->THEME_DARKMODEENABLED	= GETPOST('THEME_DARKMODEENABLED', 'int');  // If darkmode was forced on URL
	}
	// Define fontawesome family
	$path		= dol_buildpath('/theme/common/', 0);
	$listdir	= dol_dir_list($path, 'directories', 0, '^fontawesome-', null, 'name', SORT_ASC, 0, 0, '', 0);
	$listFamily	= array();
	foreach ($listdir as $dir) {
		if (empty($dir['name']))	continue;
		if (preg_match('/^fontawesome-([0-9])$/', $dir['name'], $reg)) {
			$version	= $reg[1];
			$lines		= file(dol_buildpath('/theme/common/'.$dir['name'].'/scss', 0).'/_variables.scss');	// Fetch variables scss file in variable
			foreach($lines as $line) {
				// Discard any black line or anything without :
				if (strpos($line, ':') !== false && preg_match('/\$fa-style-family/', $line, $reg)) {
					$t						= explode('"', $line);
					$listFamily[$version]	= $t[1];
					break;
				}
			}
		}
	}
	$fontawesomeFamily	= count($listFamily) > 1 ? $listFamily[max(array_keys($listFamily))] : (!empty($listFamily) ? reset($listFamily) : 'Font Awesome 5 Free');
	$fontawesomeFamily	= getDolGlobalString('MAIN_FONTAWESOME_FAMILY', $fontawesomeFamily);
	// Vérifie que la famille font awesome est bien enegistré
	if (!getDolGlobalString('MAIN_FONTAWESOME_FAMILY', '')) {
		dolibarr_set_const($db, 'MAIN_FONTAWESOME_FAMILY', $fontawesomeFamily, 'chaine', 0, 'module Oblyon', 0);
	}
	$fontawesomeBrands	= explode(' ', $fontawesomeFamily);
	$fontawesomeBrands	= $fontawesomeBrands[0].' '.$fontawesomeBrands[1].' '.$fontawesomeBrands[2].' Brands';
	$langs->load('main', 0, 1);
	$right				= ($langs->trans('DIRECTION') == 'rtl' ? 'left' : 'right');
	$left				= ($langs->trans('DIRECTION') == 'rtl' ? 'right' : 'left');
	$path				= '';		// This value may be used in future for external module to overwrite theme
	$theme				= 'oblyon';	// Value of theme
	if (!empty(getDolGlobalString('MAIN_OVERWRITE_THEME_RES'))) {
		$path	= '/'.getDolGlobalString('MAIN_OVERWRITE_THEME_RES');
		$theme	= getDolGlobalString('MAIN_OVERWRITE_THEME_RES');
	}
	// Define image path files and other constants
	$img_button					= dol_buildpath($path.'/theme/'.$theme.'/img/button_bg.png', 1);
	$dol_hide_topmenu			= $conf->dol_hide_topmenu;
	$dol_hide_leftmenu			= $conf->dol_hide_leftmenu;
	$dol_optimize_smallscreen	= $conf->dol_optimize_smallscreen;
	$dol_no_mouse_hover			= $conf->dol_no_mouse_hover;
	// dolibarr_set_const($db, 'THEME_ELDY_ENABLE_PERSONALIZED', 1, 'chaine', 0, 'OblyonTheme', $conf->entity);	// InfraS change : retire (3.6.0) : DELETE + INSERT a chaque feuille pour rien, les tests lisent la conf utilisateur, jamais cette globale
	$useboldtitle				= getDolGlobalInt('THEME_ELDY_USEBOLDTITLE', 0);

	// ===================== Couleurs Oblyon (défauts dans theme_vars, surcharge par constantes OBLYON_COLOR_*) =====================
	// InfraS change begin : couleurs par utilisateur (3.6.0) : getDolGlobalString() -> oblyon_color_setting() (valeur personnelle si OBLYON_USER_COLORS, sinon instance)
	$maincolor					= oblyon_color_setting('OBLYON_COLOR_MAIN');								// default value: #0083a2
	$navlinkcolor				= '#f4f4f4';															// default value: #eee
	$topmenu_hover				= $maincolor;															// default value: #
	$bgnavtop					= oblyon_color_setting('OBLYON_COLOR_TOPMENU_BCKGRD', $bgnavtop);			// default value: #333		//	for main navigation
	$bgnavtop_txt				= oblyon_color_setting('OBLYON_COLOR_TOPMENU_TXT', $bgnavtop_txt);			// default value: #f4f4f4	//	for main navigation
	$bgnavtop_txt_active		= oblyon_color_setting('OBLYON_COLOR_TOPMENU_TXT_ACTIVE', $bgnavtop_txt_active);		// default value: #f4f4f4	//	for main navigation
	$bgnavtop_txt_hover			= oblyon_color_setting('OBLYON_COLOR_TOPMENU_TXT_HOVER', $bgnavtop_txt_hover);		// default value: #f4f4f4	//	for main navigation
	$bgnavtop_hover				= oblyon_color_setting('OBLYON_COLOR_TOPMENU_BCKGRD_HOVER', $bgnavtop_hover);		// default value: #444		//	for main navigation
	$bgnavleft					= oblyon_color_setting('OBLYON_COLOR_LEFTMENU_BCKGRD', $bgnavleft);			// default value: #333		//	for left navigation
	$bgnavleft_txt				= oblyon_color_setting('OBLYON_COLOR_LEFTMENU_TXT', $bgnavleft_txt);			// default value: #f4f4f4	//	for left navigation
	$bgnavleft_txt_active		= oblyon_color_setting('OBLYON_COLOR_LEFTMENU_TXT_ACTIVE', $bgnavleft_txt_active);	// default value: #f4f4f4	//	for left navigation
	$bgnavleft_txt_hover		= oblyon_color_setting('OBLYON_COLOR_LEFTMENU_TXT_HOVER', $bgnavleft_txt_hover);		// default value: #f4f4f4	//	for left navigation
	$bgnavleft_hover			= oblyon_color_setting('OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER', $bgnavleft_hover);		// default value: #444		//	for left navigation
	$colorButtonAction1			= oblyon_color_setting('THEME_ELDY_BTNACTION', $colorButtonAction1);			// default value: #0088cc
	$colorButtonAction2			= oblyon_color_setting('OBLYON_COLOR_BUTTON_ACTION2', $colorButtonAction2);			// default value: #0044cc
	$colorTextButtonAction		= oblyon_color_setting('THEME_ELDY_TEXTBTNACTION', $colorTextButtonAction);
	$colorButtonDelete1			= oblyon_color_setting('OBLYON_COLOR_BUTTON_DELETE1', $colorButtonDelete1);			// default value: #cc8800
	$colorButtonDelete2			= oblyon_color_setting('OBLYON_COLOR_BUTTON_DELETE2', $colorButtonDelete2);			// default value: #cc4400
	$colorInfoBorder			= oblyon_color_setting('OBLYON_COLOR_INFO_BORDER', $colorInfoBorder);			// default value: #87cfd2
	$colorInfoBg				= oblyon_color_setting('OBLYON_COLOR_INFO_BCKGRD', $colorInfoBg);			// default value: #eff8fc
	$colorInfoTxt				= oblyon_color_setting('OBLYON_COLOR_INFO_TEXT', $colorInfoTxt);						// default value: #
	$colorWarningBorder			= oblyon_color_setting('OBLYON_COLOR_WARNING_BORDER', $colorWarningBorder);			// default value: #f2cf87
	$colorWarningBg				= oblyon_color_setting('OBLYON_COLOR_WARNING_BCKGRD', $colorWarningBg);			// default value: #fcf8e3
	$colorWarningTxt			= oblyon_color_setting('OBLYON_COLOR_WARNING_TEXT', $colorWarningTxt);					// default value: #
	$colorErrorBorder			= oblyon_color_setting('OBLYON_COLOR_ERROR_BORDER', $colorErrorBorder);			// default value: #e0796e
	$colorErrorBg				= oblyon_color_setting('OBLYON_COLOR_ERROR_BCKGRD', $colorErrorBg);			// default value: #f07b6e
	$colorErrorTxt				= oblyon_color_setting('OBLYON_COLOR_ERROR_TEXT', $colorErrorTxt);					// default value: #
	$colorNotifInfoBg			= oblyon_color_setting('OBLYON_COLOR_NOTIF_INFO_BCKGRD', $colorNotifInfoBg);		// default value: #d9e5d1
	$colorNotifInfoTxt			= oblyon_color_setting('OBLYON_COLOR_NOTIF_INFO_TEXT', $colorNotifInfoTxt);		// default value: #446548
	$colorNotifWarningBg		= oblyon_color_setting('OBLYON_COLOR_NOTIF_WARNING_BCKGRD', $colorNotifWarningBg);	// default value: #fff7d1
	$colorNotifWarningTxt		= oblyon_color_setting('OBLYON_COLOR_NOTIF_WARNING_TEXT', $colorNotifWarningTxt);		// default value: #a28918
	$colorNotifErrorBg			= oblyon_color_setting('OBLYON_COLOR_NOTIF_ERROR_BCKGRD', $colorNotifErrorBg);		// default value: #d79eac
	$colorNotifErrorTxt			= oblyon_color_setting('OBLYON_COLOR_NOTIF_ERROR_TEXT', $colorNotifErrorTxt);		// default value: #a72947
	$colorTextTabActive			= oblyon_color_setting('OBLYON_COLOR_TEXTTABACTIVE', $colorTextTabActive);			// default value: #222222
	$colorBckgrdInput			= oblyon_color_setting('OBLYON_COLOR_INPUT_BCKGRD', $colorBckgrdInput);			// default value: #DEDEDE
	$color1BckgrdInfobox		= oblyon_color_setting('OBLYON_COLOR_INFOBOX_BCKGRD1', $color1BckgrdInfobox);		// default value: #a2e0b8
	$color2BckgrdInfobox		= oblyon_color_setting('OBLYON_COLOR_INFOBOX_BCKGRD2', $color2BckgrdInfobox);		// default value: #E4EFE8
	$colorBorderActionColumn	= oblyon_color_setting('OBLYON_COLOR_BORDER_ACTIONCOLUMN', $colorBorderActionColumn);	// default value: #BBBBBB
	$bgotherbox					= '#f4f4f4';															// default value: #E6E6E6	//	Other information boxes on home page
	$bgbutton_hover				= '#197489';															// default value: #197489
	if (!empty($maincolor)) {
		$colorlength	= strlen($maincolor);
		$matches		= array();
		if ($colorlength == 4) {
			preg_match('/([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})/', $maincolor, $matches);	// Format #RGB
		} elseif ($colorlength == 7) {
			preg_match('/([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})/', $maincolor, $matches);	// Format #RRGGBB
		}
		if (!empty($matches)) {
			$maincolor_variant	= array();
			$variation			= -50;	// 20% darker
			for ($i=1; $i < sizeof($matches); $i++) {
				$maincolor_variant[$i-1]	= max(0 , min(hexdec($matches[$i]) + $variation, 255));
			}
			$bgbutton_hover = '#'.colorArrayToHex($maincolor_variant);
		}
	}
	$logo_background_color		= oblyon_color_setting('OBLYON_COLOR_LOGO_BCKGRD', $logo_background_color);	// default value : #FFFFFF
	$bgcolor					= oblyon_color_setting('OBLYON_COLOR_BCKGRD', $bgcolor);			// default value : #F4F4F4
	$login_bgcolor				= oblyon_color_setting('OBLYON_COLOR_LOGIN_BCKGRD', $login_bgcolor);	// default value : #F4F4F4
	$colorbtitle				= oblyon_color_setting('OBLYON_COLOR_BTITLE', $colorbtitle);			// default value : #E09430
	$colorstitle				= oblyon_color_setting('OBLYON_COLOR_STITLE', $colorstitle);			// default value : #F4F4F4
	$colorbline					= oblyon_color_setting('OBLYON_COLOR_BLINE', $colorbline);			// default value : #FFFFFF
	$colorbline_hover			= oblyon_color_setting('THEME_ELDY_USE_HOVER', $colorbline_hover);
	$colorbline_checked			= oblyon_color_setting('THEME_ELDY_USE_CHECKED', $colorbline_checked);
	$colorfline					= oblyon_color_setting('OBLYON_COLOR_FLINE', $colorfline);			// default value : #444444
	$colorfline_hover			= oblyon_color_setting('OBLYON_COLOR_FLINE_HOVER', $colorfline_hover);	// default value : #222222
	$colorbtotal				= oblyon_color_setting('OBLYON_COLOR_BTOTAL', $colorbtotal);
	$colorftotal				= oblyon_color_setting('OBLYON_COLOR_FTOTAL', $colorftotal);
	$colorfdatedefault			= oblyon_color_setting('OBLYON_COLOR_FDATE_DEFAULT', $colorfdatedefault);	// default value : #FF0000
	$colorfdateselected			= oblyon_color_setting('OBLYON_COLOR_FDATE_SELECTED', $colorfdateselected);	// default value : #FF0000
	$invertratiofilter			= getDolGlobalString('THEME_INVERT_RATIO_FILTER', 0);			// default value : 0
	$prospectback				= oblyon_color_setting('THEME_ELDY_PROSPECTBACK', $prospectback);	// default value : #A7C5B0
	$customerback				= oblyon_color_setting('THEME_ELDY_CUSTOMERBACK', $customerback);	// default value : #55955D
	$vendorback					= oblyon_color_setting('THEME_ELDY_VENDORBACK', $vendorback);	// default value : #599CAF
	$userback					= oblyon_color_setting('THEME_ELDY_USERBACK', $userback);	// default value : #79633F
	$colornature				= oblyon_color_setting('THEME_ELDY_COLORNATURE', $colornature);	// default value : #FFFFFF
	$member_companyback			= oblyon_color_setting('THEME_ELDY_MEMBER_COMPANYBACK', $member_companyback);	// default value : #E4E4E4
	$member_individualback		= oblyon_color_setting('THEME_ELDY_MEMBER_INDIVIDUALBACK', $member_individualback);	// default value : #E4E4E4
	$colormember				= oblyon_color_setting('THEME_ELDY_COLORMEMBER', $colormember);	// default value : #666666
	$colorAutocompleteBg		= oblyon_color_setting('OBLYON_COLOR_AUTOCOMPLETE_BCKGRD', $colorAutocompleteBg);
	$colorAutocompleteText		= oblyon_color_setting('OBLYON_COLOR_AUTOCOMPLETE_TEXT', $colorAutocompleteText);
	$colorChipBg				= oblyon_color_setting('OBLYON_COLOR_CHIP_BCKGRD', $colorChipBg);
	$colorChipText				= oblyon_color_setting('OBLYON_COLOR_CHIP_TEXT', $colorChipText);
	$colorResultBg				= oblyon_color_setting('OBLYON_COLOR_RESULT_BCKGRD', $colorResultBg);
	$colorResultText			= oblyon_color_setting('OBLYON_COLOR_RESULT_TEXT', $colorResultText);
	// InfraS add begin : jetons dedies 3.7.0 (montants, agenda / calendriers, surfaces flottantes, entree de menu selectionnee) ; valeur '' ou '#' = defaut
	$colorAmountText			= oblyon_color_setting_hex('OBLYON_COLOR_AMOUNT_TEXT', '#006666');						// texte des montants (span.amount)
	$colorCalEventTxt			= oblyon_color_setting_hex('OBLYON_COLOR_CAL_EVENT_TXT', '#111111');					// texte des evenements de l'agenda (fond = couleur principale)
	$colorCalWeekendBg			= oblyon_color_setting_hex('OBLYON_COLOR_CAL_WEEKEND_BCKGRD', '#EEEEEE');				// fond des week-ends (saisie des temps, calendriers)
	$colorCalHolidayBg			= oblyon_color_setting_hex('OBLYON_COLOR_CAL_HOLIDAY_BCKGRD', '#F4EEDE');				// fond des jours de conges
	$colorOverlayBg				= oblyon_color_setting_hex('OBLYON_COLOR_OVERLAY_BCKGRD', '#FFFFFF');					// fond des surfaces flottantes (barre de filtre, modales, survol du selecteur de colonnes, edition en ligne)
	$bgnavtop_sel				= oblyon_color_setting_hex('OBLYON_COLOR_TOPMENU_BCKGRD_SEL', (oblyon_color_is_valid($bgnavtop_hover) && $bgnavtop_hover != '#' ? $bgnavtop_hover : $maincolor));	// fond de l'entree selectionnee du menu principal
	$bgnavtop_txt_sel			= oblyon_color_setting_hex('OBLYON_COLOR_TOPMENU_TXT_SEL', '#FFFFFF');					// texte de l'entree selectionnee du menu principal
	$colorStockOk				= oblyon_color_setting_hex('OBLYON_COLOR_STOCK_OK', '#002000');							// stock suffisant, entree de stock
	$colorStockLow				= oblyon_color_setting_hex('OBLYON_COLOR_STOCK_LOW', '#884400');						// stock trop bas
	$colorStockExit				= oblyon_color_setting_hex('OBLYON_COLOR_STOCK_EXIT', '#6B5A12');						// sortie de stock
	$colorIconText				= oblyon_color_setting_hex('OBLYON_COLOR_ICON_TEXT', '#555555');						// pictos secondaires (telephone, mail, lien, corbeille, lecture)
	$colorTimelineBg			= oblyon_color_setting_hex('OBLYON_COLOR_TIMELINE_BCKGRD', '#FFFFFF');					// fond des messages du fil de discussion (tickets)
	$colorTimelinePrivateBg		= oblyon_color_setting_hex('OBLYON_COLOR_TIMELINE_PRIVATE_BCKGRD', '#FFFBE5');			// fond des messages prives du fil
	// Badges de statut : fond / bordure par famille (defauts de theme_vars.inc.php), texte calcule par contraste dans badges.inc.php ; les $badgeStatusN sont rederives
	$badgeStatusDraft			= oblyon_color_setting_hex('OBLYON_COLOR_BADGE_DRAFT', $badgeStatusDraft);
	$badgeStatusValidated		= oblyon_color_setting_hex('OBLYON_COLOR_BADGE_VALIDATED', $badgeStatusValidated);
	$badgeStatusApproved		= oblyon_color_setting_hex('OBLYON_COLOR_BADGE_APPROVED', $badgeStatusApproved);
	$badgeStatusWaiting			= oblyon_color_setting_hex('OBLYON_COLOR_BADGE_WAITING', $badgeStatusWaiting);
	$badgeStatusActive			= oblyon_color_setting_hex('OBLYON_COLOR_BADGE_ACTIVE', $badgeStatusActive);
	$badgeStatusClosed			= oblyon_color_setting_hex('OBLYON_COLOR_BADGE_CLOSED', $badgeStatusClosed);
	$badgeStatusCanceled		= oblyon_color_setting_hex('OBLYON_COLOR_BADGE_CANCELED', $badgeStatusCanceled);
	$badgeStatusError			= oblyon_color_setting_hex('OBLYON_COLOR_BADGE_ERROR', $badgeStatusError);
	$badgeStatusDone			= oblyon_color_setting_hex('OBLYON_COLOR_BADGE_DONE', $badgeStatusDone);
	$badgeStatus0				= $badgeStatusDraft;
	$badgeStatus1				= $badgeStatus1b	= $badgeStatusValidated;
	$badgeStatus2				= $badgeStatusApproved;
	$badgeStatus3				= $badgeStatusWaiting;
	$badgeStatus4				= $badgeStatus4b	= $badgeStatus7	= $badgeStatusActive;
	$badgeStatus5				= $badgeStatus6		= $badgeStatusClosed;
	$badgeStatus8				= $badgeStatus10	= $badgeStatusError;
	$badgeStatus9				= $badgeStatusCanceled;
	$badgeStatus11				= $badgeStatusDone;
	// InfraS add end

	// ===================== Couleurs Eldy (défauts theme_vars + personnalisation utilisateur) =====================
	$colorbackhmenu1			= oblyon_color_setting('THEME_ELDY_TOPMENU_BACK1', $colorbackhmenu1);
	$colorbackvmenu1			= oblyon_color_setting('THEME_ELDY_VERMENU_BACK1', $colorbackvmenu1);
	$colortopbordertitle1		= oblyon_color_setting('THEME_ELDY_TOPBORDER_TITLE1', $colortopbordertitle1);
	$colorbacktitle1			= oblyon_color_setting('THEME_ELDY_BACKTITLE1', $colorbacktitle1);
	$colorbacktabcard1			= oblyon_color_setting('THEME_ELDY_BACKTABCARD1', $colorbacktabcard1);
	$colorbacktabactive			= oblyon_color_setting('THEME_ELDY_BACKTABACTIVE', $colorbacktabactive);
	$colorbacklineimpair1		= oblyon_color_setting('THEME_ELDY_LINEIMPAIR1', $colorbacklineimpair1);
	$colorbacklineimpair2		= oblyon_color_setting('THEME_ELDY_LINEIMPAIR2', $colorbacklineimpair2);
	$colorbacklinepair1			= oblyon_color_setting('THEME_ELDY_LINEPAIR1', $colorbacklinepair1);
	$colorbacklinepair2			= oblyon_color_setting('THEME_ELDY_LINEPAIR2', $colorbacklinepair2);
	$colorbacklinebreak			= oblyon_color_setting('THEME_ELDY_LINEBREAK', $colorbacklinebreak);
	$colorbackbody				= oblyon_color_setting('THEME_ELDY_BACKBODY', $colorbackbody);
	$colortexttitlenotab		= oblyon_color_setting('THEME_ELDY_TEXTTITLENOTAB', $colortexttitlenotab);
	$colortexttitle				= oblyon_color_setting('THEME_ELDY_TEXTTITLE', $colortexttitle);
	$colortexttitlelink			= oblyon_color_setting('THEME_ELDY_TEXTTITLELINK', $colortexttitlelink);
	$colortext					= oblyon_color_setting('THEME_ELDY_TEXT', $colortext);
	$colortextlink				= oblyon_color_setting('THEME_ELDY_TEXTLINK', $colortextlink);
	// InfraS change end

	// ===================== Normalisation + couleurs calculées (contrastes) =====================
	// InfraS change begin : format unique '#RRGGBB' (3.7.0). oblyon_color_setting() a deja converti les valeurs 'r,g,b' (pages "Interface utilisateur" du core) ; les defauts 'r,g,b'
	// de theme_vars.inc.php et toute valeur restante passent par oblyon_color_to_hex() (repli #585858 = celui de colorStringToArray() pour une valeur illisible, ex. '0.0.0').
	// Les variables CSS sont imprimees telles quelles dans global.inc.php (plus de rgb()) ; txt_color() garde son entree 'r,g,b' via oblyon_txt_color_hex()
	$oblyon_color_fallback		= '#585858';
	$colorbacklinepairhover		= oblyon_color_to_hex($colorbline_hover);
	$colorbacklinepairchecked	= oblyon_color_to_hex($colorbline_checked);
	$colorbackhmenu1			= oblyon_color_to_hex($colorbackhmenu1, $oblyon_color_fallback);
	$colortopckeditor			= ltrim($colorbackhmenu1, '#');
	setcookie('colortopckeditor', $colortopckeditor, time() + (86400 * 30), "/"); // 86400 = 1 day
	// Set text color to black or white
	$colortextbackhmenu			= oblyon_txt_color_hex($colorbackhmenu1);
	$colorbackvmenu1			= oblyon_color_to_hex($colorbackvmenu1, $oblyon_color_fallback);
	$colortextbackvmenu			= oblyon_txt_color_hex($colorbackvmenu1);
	$colorbacktitle1			= oblyon_color_to_hex($colorbacktitle1, $oblyon_color_fallback);
	$autocolorshadow			= oblyon_txt_color_hex($colorbacktitle1);	// $colorshadowtitle : contraste sur le fond des filtres (comportement d'origine, inchangé)
	$colorshadowtitle			= ($autocolorshadow == 'FFFFFF') ? '888888' : 'FFFFFF';
	if (in_array(oblyon_color_setting('THEME_ELDY_TEXTTITLE'), array('', '#'), true)) {	// meme test (ni instance ni utilisateur) via la fonction commune ; InfraS change 3.8.0 : '#' (champ laisse vide dans l'onglet Couleurs, enregistre '#') = contraste automatique aussi
		// contraste auto calculé sur le VRAI fond des titres = $colorbtitle (OBLYON_COLOR_BTITLE), pas sur le fond des filtres
		$autocolortexttitle	= oblyon_txt_color_hex($colorbtitle);
		$colortexttitle		= '#'.(($autocolortexttitle == '000000') ? '101010' : $autocolortexttitle);
	}
	$colorbacktabcard1	= oblyon_color_to_hex($colorbacktabcard1, $oblyon_color_fallback);
	$colortextbacktab	= oblyon_txt_color_hex($colorbacktabcard1);
	if ($colortextbacktab == '000000') {
		$colortextbacktab	= '111111';
	}
	// Toutes les autres couleurs Eldy : hex ; une valeur vide ou illisible donne le gris de repli, comme colorStringToArray() le faisait (comportement inchange)
	foreach (array('colortopbordertitle1', 'colorbacktabactive', 'colorbacklineimpair1', 'colorbacklineimpair2', 'colorbacklinepair1', 'colorbacklinepair2', 'colorbackbody', 'colorbacklinebreak',
					'colortexttitlelink', 'colortexttitlenotab', 'colortexttitlenotab2', 'colortexttitle', 'colortext', 'colortextlink') as $tmpname) {
		$$tmpname	= oblyon_color_to_hex($$tmpname, $oblyon_color_fallback);
	}
	// InfraS change end
	// ===================== Métriques du menu haut =====================
	$nbtopmenuentries		= $menumanager->showmenu('topnb');
	if ($conf->browser->layout == 'phone') {
		$nbtopmenuentries	= max($nbtopmenuentries, 10);
	}
	$minwidthtmenu		= 66;	/* minimum width for one top menu entry */
	$heightmenu			= 50;	/* height of top menu, part with image */
	$heightmenu2		= 49;	/* height of top menu, part with login  */
	$disableimages		= 0;
	$maxwidthloginblock	= 180;
	if (getDolGlobalString('THEME_TOPMENU_DISABLE_IMAGE')) {
		$disableimages		= 1;
		$maxwidthloginblock	= $maxwidthloginblock + 50;
		$minwidthtmenu		= 0;
	}
	if (getDolGlobalString('MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN')) {
		$maxwidthloginblock = $maxwidthloginblock + 55;
	}
	if (getDolGlobalString('MAIN_USE_TOP_MENU_SEARCH_DROPDOWN')) {
		$maxwidthloginblock	= $maxwidthloginblock + 55;
	}
	if (isModEnabled('bookmark')) {
		$maxwidthloginblock	= $maxwidthloginblock + 55;
	}
	if (isModEnabled('multicompany')) {
		$maxwidthloginblock	= $maxwidthloginblock + 55;
	}

	// Rayon des arrondis (variable CSS --infras_radius, utilisee des le bloc :root de global.inc.php)
	$infras_radius	= getDolGlobalInt('THEME_ELDY_BORDER_RADIUS', 6);
	if ($infras_radius <= 0)	$infras_radius	= 6;	// valeur nulle => rayon visible par defaut

	// densite de l'interface (3.8.0, option OBLYON_DENSITY) : une seule commande pour la hauteur des cellules et des lignes,
	// des en-tetes de liste, des champs, des boutons d'action et les marges des fiches ; les valeurs "compact" sont celles de la 3.4.1 (rendu inchange par defaut)
	$oblyon_density_values	= array(
		'compact'		=> array('cell_py' => '5px',	'cell_px' => '8px',		'row_lh' => '1.5em',	'head_h' => '34px',	'control_py' => '5px',	'btn_py' => '0.6em',	'card_py' => '12px'),
		'normal'		=> array('cell_py' => '7px',	'cell_px' => '10px',	'row_lh' => '1.6em',	'head_h' => '38px',	'control_py' => '7px',	'btn_py' => '0.7em',	'card_py' => '16px'),
		'comfortable'	=> array('cell_py' => '10px',	'cell_px' => '12px',	'row_lh' => '1.75em',	'head_h' => '44px',	'control_py' => '9px',	'btn_py' => '0.85em',	'card_py' => '20px'),
	);
	$oblyon_density			= getDolGlobalString('OBLYON_DENSITY', 'compact');
	if (! isset($oblyon_density_values[$oblyon_density]))	$oblyon_density	= 'compact';	// valeur inconnue => densite d'origine
	$oblyon_density_tokens	= $oblyon_density_values[$oblyon_density];

	// InfraS add begin : jetons de design 3.4.1 - couleurs neutres derivees du preset (melange fond des lignes / texte des lignes), bordure des champs selon l'option
	// (oblyon_mix_colors() vit dans lib/oblyon_colors.lib.php depuis 3.8.0 : partagee avec les onglets Couleurs)
	$oblyon_border			= oblyon_mix_colors($colorbline, $colorfline, 0.14);	// separateurs, cadres discrets
	$oblyon_border_strong	= oblyon_mix_colors($colorbline, $colorfline, 0.30);	// cadres marques (champs avec option bordure, fieldset)
	$oblyon_neutral_bg		= oblyon_mix_colors($colorbline, $colorfline, 0.05);	// fonds discrets (sections, champs desactives)
	$oblyon_muted_text		= oblyon_mix_colors($colorfline, $colorbline, 0.40);	// textes secondaires (placeholders, aides)
	$oblyon_input_border	= getDolGlobalString('THEME_SHOW_BORDER_ON_INPUT') ? $oblyon_border_strong : $oblyon_border;
	// Page de connexion : fond = OBLYON_COLOR_LOGIN_BCKGRD (constante existante, jusqu'ici non branchee), texte du titre choisi selon la clarte de ce fond
	$login_txtcolor			= (oblyon_txt_color_hex($login_bgcolor) == 'FFFFFF') ? '#FFFFFF' : $colorfline;	// InfraS change 3.7.0 : entree hex
	// InfraS add end

	// styles d'interface 3.8.0 - teintes d'accent partagees par les onglets, boutons, badges et avatar, puis le style choisi pour chaque composant
	$oblyon_accent_tint			= oblyon_mix_colors($colorbline, $maincolor, 0.12);	// fond teinte leger (onglet pilule actif, bouton "doux")
	$oblyon_accent_tint_strong	= oblyon_mix_colors($colorbline, $maincolor, 0.20);	// survol du fond teinte
	$oblyon_on_accent			= oblyon_text_on($maincolor);						// texte lisible (sombre ou blanc) sur la couleur principale
	$oblyon_tabs_style			= getDolGlobalString('OBLYON_TABS_STYLE', 'boxed');	// onglets des fiches : boxed (rendu d'origine) / underline / pills
	if (! in_array($oblyon_tabs_style, array('boxed', 'underline', 'pills')))	$oblyon_tabs_style	= 'boxed';
	// Pilules : couleurs propres (fond, texte, bordure), chacune "derivee" quand elle est vide ou '#' (teinte d'accent, couleur principale, cadre neutre)
	$oblyon_tab_pill_bg			= oblyon_color_setting_hex('OBLYON_COLOR_TAB_PILL_BCKGRD', $oblyon_accent_tint);
	$oblyon_tab_pill_txt		= oblyon_color_setting_hex('OBLYON_COLOR_TAB_PILL_TXT', $maincolor);
	$oblyon_tab_pill_border		= oblyon_color_setting_hex('OBLYON_COLOR_TAB_PILL_BORDER', $oblyon_border);
	$oblyon_tab_pill_bg_hover	= oblyon_mix_colors($oblyon_tab_pill_bg, $oblyon_tab_pill_txt, 0.10);	// survol de la pilule active : fond legerement tire vers son texte
	// Soulignes : couleurs propres (fond de la bande, texte de l'onglet actif, trait), derivees quand elles sont vides ou '#' (fond neutre, couleur principale, couleur principale)
	$oblyon_tab_under_band		= oblyon_color_setting_hex('OBLYON_COLOR_TAB_UNDER_BAND', $oblyon_neutral_bg);
	$oblyon_tab_under_txt		= oblyon_color_setting_hex('OBLYON_COLOR_TAB_UNDER_TXT', $maincolor);
	$oblyon_tab_under_line		= oblyon_color_setting_hex('OBLYON_COLOR_TAB_UNDER_LINE', $maincolor);
	$oblyon_tab_under_border	= oblyon_mix_colors($oblyon_tab_under_band, $colorfline, 0.12);	// filet sous la bande : bande tiree vers le texte des lignes
	// Boutons (lot 3) : style filled (rendu d'origine) / outline / soft, applique aux boutons d'action, au bouton Supprimer et (sauf couleurs propres) aux boutons de formulaire.
	// Chaque famille a cinq couleurs (fond, texte, bordure, fond au survol, texte au survol, cf. oblyon_button_families()) ; une couleur vide ou '#' est derivee selon le style :
	//   filled  : fond et texte obligatoires (defauts du theme), bordure = aucune, survol = fond de survol / texte
	//   outline : fond = transparent, bordure = texte, survol = teinte du texte a 12 % / texte
	//   soft    : fond = teinte du texte a 12 %, bordure = aucune, survol = teinte a 22 % / texte
	$oblyon_button_style		= getDolGlobalString('OBLYON_BUTTON_STYLE', 'filled');
	if (! in_array($oblyon_button_style, array('filled', 'outline', 'soft')))	$oblyon_button_style	= 'filled';
	// Couleurs effectives par famille et role (lib/oblyon_colors.lib.php, partagee avec les onglets Couleurs qui affichent ces valeurs) : 'css' = valeur peinte ('transparent' possible)
	$oblyon_btn_effective	= oblyon_button_effective_colors($oblyon_button_style);
	$oblyon_btn_css			= function ($roles) { $c = array(); foreach ($roles as $role => $v) $c[$role] = $v['css']; return $c; };
	$oblyon_btn_action	= $oblyon_btn_css($oblyon_btn_effective['action']);
	$oblyon_btn_delete	= $oblyon_btn_css($oblyon_btn_effective['delete']);
	$oblyon_btn_form	= getDolGlobalInt('OBLYON_BUTTON_FORM_OWN_COLORS') ? $oblyon_btn_css($oblyon_btn_effective['form']) : $oblyon_btn_action;	// boutons de formulaire = boutons d'action, sauf couleurs propres
	// Badges de statut (lot 4) : pill (rendu d'origine) / outline (fond des lignes, cadre et texte de la couleur du statut) / dot (point colore devant le libelle, texte des lignes) ;
	// les couleurs restent celles du groupe "Badges de statut" (OBLYON_COLOR_BADGE_*), lues par badges.inc.php (_createStatusBadgeCss)
	$oblyon_badge_style			= getDolGlobalString('OBLYON_BADGE_STYLE', 'pill');
	if (! in_array($oblyon_badge_style, array('pill', 'outline', 'dot')))	$oblyon_badge_style	= 'pill';
	$oblyon_status_pulse		= getDolGlobalInt('OBLYON_STATUS_PULSE');	// pulsation douce du statut dans le bandeau de la fiche ouverte (badges.inc.php)
	// En-tetes de liste (lot 5) : band (bande coloree, rendu d'origine) / flat (en-tete sur le fond des lignes, texte attenue en capitales, filet, colonne triee en couleur principale) ;
	// couleurs propres du style plat (groupe Titres, visibles en style plat), derivees quand elles sont vides
	$oblyon_listhead_style		= getDolGlobalString('OBLYON_LIST_HEADER_STYLE', 'band');
	if (! in_array($oblyon_listhead_style, array('band', 'flat')))	$oblyon_listhead_style	= 'band';
	$oblyon_listhead_bg			= oblyon_color_setting_hex('OBLYON_COLOR_LISTHEAD_FLAT_BCKGRD', $colorbline);
	$oblyon_listhead_txt		= oblyon_color_setting_hex('OBLYON_COLOR_LISTHEAD_FLAT_TXT', oblyon_mix_colors($colorfline, $colorbline, 0.25));
	$oblyon_listhead_line		= oblyon_color_setting_hex('OBLYON_COLOR_LISTHEAD_FLAT_LINE', $oblyon_border);
	$oblyon_listhead_sel		= oblyon_color_setting_hex('OBLYON_COLOR_LISTHEAD_FLAT_SEL', $maincolor);
	$oblyon_listhead_filter		= oblyon_mix_colors($oblyon_listhead_bg, $colorfline, 0.04);	// ligne de filtres : fond de l'en-tete a peine teinte
	// Animations (lot 6) : normal (defaut ; le reglage "moins d'animations" du poste est toujours respecte) / reduced, appliquee par motion.inc.php (inclus en dernier)
	$oblyon_motion				= getDolGlobalString('OBLYON_MOTION', 'normal');
	if ($oblyon_motion == 'none')	$oblyon_motion	= 'reduced';	// anciennes valeurs d'une premiere version : none -> reduced, system -> normal
	if ($oblyon_motion != 'reduced')	$oblyon_motion	= 'normal';
	// Bloc utilisateur (lot 8) : default (rendu d'origine) / initials (cercle aux initiales) / photo (photo si renseignee, sinon initiales) ; les deux nouvelles valeurs
	// activent aussi le menu deroulant utilisateur redessine (dropdown.inc.php) ; l'avatar est dessine par layout.inc.php, les images remplacees par js/oblyon.js
	$oblyon_user_block			= getDolGlobalString('OBLYON_USER_BLOCK', 'default');
	if (!in_array($oblyon_user_block, array('initials', 'photo')))	$oblyon_user_block	= 'default';
	// Agenda natif (lot 10) : classic (rendu d'origine) / modern (grille sur le fond des lignes, aujourd'hui en teinte d'accent, cartes d'evenements teintees de leur couleur) ; widgets.inc.php + js/oblyon.js
	$oblyon_agenda_style		= getDolGlobalString('OBLYON_AGENDA_STYLE', 'classic');
	if ($oblyon_agenda_style != 'modern')	$oblyon_agenda_style	= 'classic';

	require __DIR__.'/global.inc.php';

	if (is_object($db))	$db->close();