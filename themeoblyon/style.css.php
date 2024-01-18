<?php
	/************************************************
	* Copyright (C) 2015-2022  Alexandre Spangaro <support@open-dsi.fr>
	* Copyright (C) 2022       Sylvain Legrand    <contact@infras.fr>
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
	* 	\file		../theme/oblyon/style.css.php
	* 	\brief		CSS for Oblyon theme
	************************************************/

	if (! defined('NOREQUIRESOC'))		define('NOREQUIRESOC', '1');
	if (! defined('NOCSRFCHECK'))		define('NOCSRFCHECK', 1);
	if (! defined('NOTOKENRENEWAL'))	define('NOTOKENRENEWAL', 1);
	if (! defined('NOLOGIN'))			define('NOLOGIN', 1);          // File must be accessed by logon page so without login
	if (! defined('NOREQUIREHTML'))		define('NOREQUIREHTML', 1);
	if (! defined('NOREQUIREAJAX'))		define('NOREQUIREAJAX', '1');
	define('ISLOADEDBYSTEELSHEET', '1');
	session_cache_limiter('public');
	require_once __DIR__.'/../../main.inc.php'; // __DIR__ allow this script to be included in custom themes
	require __DIR__.'/theme_vars.inc.php';
	if (defined('THEME_ONLY_CONSTANT'))	return;
	require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';
	require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';

	/************************************************
	*	Select text color from background values
	*
	*	@param	string		$bgcolor     		RGB value for background color
	* 	@return	string							'FFFFFF' or '000000' for white or black
	************************************************/
	function txt_color(&$bgcolor)
	{
		global $conf;

		$tmppart			= explode(',', $bgcolor);
		$tmpvalr			= (! empty($tmppart[0]) ? $tmppart[0] : 0) * 0.3;
		$tmpvalg			= (! empty($tmppart[1]) ? $tmppart[1] : 0) * 0.59;
		$tmpvalb			= (! empty($tmppart[2]) ? $tmppart[2] : 0) * 0.11;
		$tmpval				= $tmpvalr + $tmpvalg + $tmpvalb;
		if ($tmpval <= 128)	$txtcolor	= 'FFFFFF';
		else				$txtcolor	= '000000';
		return $txtcolor;
	}	// function _txt_color(&$bgcolor)

	// Load user to have $user->conf loaded (not done into main because of NOLOGIN constant defined) and permission, so we can later calculate number of top menu ($nbtopmenuentries) according to user profile.
	if (empty($user->id) && ! empty($_SESSION['dol_login'])) {
		$user->fetch('', $_SESSION['dol_login'], '', 1);
		$user->getrights();
		// Reload menu now we have the good user (and we need the good menu to have ->showmenu('topnb') correct.
		$menumanager	= new MenuManager($db, empty($user->socid) ? 0 : 1);
		$menumanager->loadMenu();
	}	// if (empty($user->id) && ! empty($_SESSION['dol_login']))
	// Define css type
	top_httphead('text/css');
	// Important: Following code is to avoid page request by browser and PHP CPU at each Dolibarr page access.
	if (empty($dolibarr_nocache))					header('Cache-Control: max-age=10800, public, must-revalidate');
	else											header('Cache-Control: no-cache');
	if (GETPOST('theme', 'aZ09')) {
        $conf->theme=GETPOST('theme', 'alpha'); // If theme was forced on URL
	}
	if (GETPOST('lang', 'aZ09')) {
        $langs->setDefaultLang(GETPOST('lang', 'aZ09'));    // If language was forced on URL
	}
	if (GETPOST('THEME_DARKMODEENABLED', 'int')) {
        $conf->global->THEME_DARKMODEENABLED	= GETPOST('THEME_DARKMODEENABLED', 'int');  // If darkmode was forced on URL
	}
	$langs->load("main", 0, 1);
	$right											= ($langs->trans("DIRECTION") == 'rtl' ? 'left' : 'right');
	$left											= ($langs->trans("DIRECTION") == 'rtl' ? 'right' : 'left');
	$path											= '';    	// This value may be used in future for external module to overwrite theme
	$theme											= 'oblyon';	// Value of theme
	if (!empty($conf->global->MAIN_OVERWRITE_THEME_RES)) {
		$path	= '/'.$conf->global->MAIN_OVERWRITE_THEME_RES;
		$theme	= $conf->global->MAIN_OVERWRITE_THEME_RES;
	}
	// Define image path files and other constants
	$img_button					= dol_buildpath($path.'/theme/'.$theme.'/img/button_bg.png', 1);
	$dol_hide_topmenu			= $conf->dol_hide_topmenu;
	$dol_hide_leftmenu			= $conf->dol_hide_leftmenu;
	$dol_optimize_smallscreen	= $conf->dol_optimize_smallscreen;
	$dol_no_mouse_hover			= $conf->dol_no_mouse_hover;
	dolibarr_set_const($db, 'THEME_ELDY_ENABLE_PERSONALIZED', 1, 'chaine', 0, 'OblyonTheme', $conf->entity);
	$useboldtitle				= (isset($conf->global->THEME_ELDY_USEBOLDTITLE) ? $conf->global->THEME_ELDY_USEBOLDTITLE : 0);
	// Oblyon
	$maincolor					= $conf->global->OBLYON_COLOR_MAIN;						// default value: #0083a2
	$navlinkcolor				= '#f4f4f4';											// default value: #eee
	$topmenu_hover				= $maincolor;											// default value: #
	$bgnavtop					= $conf->global->OBLYON_COLOR_TOPMENU_BCKGRD;			// default value: #333		//	for main navigation
	$bgnavtop_txt				= $conf->global->OBLYON_COLOR_TOPMENU_TXT;				// default value: #f4f4f4	//	for main navigation
	$bgnavtop_txt_active		= $conf->global->OBLYON_COLOR_TOPMENU_TXT_ACTIVE;		// default value: #f4f4f4	//	for main navigation
	$bgnavtop_txt_hover			= $conf->global->OBLYON_COLOR_TOPMENU_TXT_HOVER;		// default value: #f4f4f4	//	for main navigation
	$bgnavtop_hover				= $conf->global->OBLYON_COLOR_TOPMENU_BCKGRD_HOVER;		// default value: #444		//	for main navigation
	$bgnavleft					= $conf->global->OBLYON_COLOR_LEFTMENU_BCKGRD;			// default value: #333		//	for left navigation
	$bgnavleft_txt				= $conf->global->OBLYON_COLOR_LEFTMENU_TXT;				// default value: #f4f4f4	//	for left navigation
	$bgnavleft_txt_active		= $conf->global->OBLYON_COLOR_LEFTMENU_TXT_ACTIVE;		// default value: #f4f4f4	//	for left navigation
	$bgnavleft_txt_hover		= $conf->global->OBLYON_COLOR_LEFTMENU_TXT_HOVER;		// default value: #f4f4f4	//	for left navigation
	$bgnavleft_hover			= $conf->global->OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER;	// default value: #444	    //	for left navigation
	$colorButtonAction1			= $conf->global->OBLYON_COLOR_BUTTON_ACTION1;			// default value: #0088cc
	$colorButtonAction2			= $conf->global->OBLYON_COLOR_BUTTON_ACTION2;			// default value: #0044cc
	$colorButtonDelete1			= $conf->global->OBLYON_COLOR_BUTTON_DELETE1;			// default value: #cc8800
	$colorButtonDelete2			= $conf->global->OBLYON_COLOR_BUTTON_DELETE2;			// default value: #cc4400
	$colorInfoBorder			= $conf->global->OBLYON_COLOR_INFO_BORDER;				// default value: #87cfd2
	$colorInfoBg				= $conf->global->OBLYON_COLOR_INFO_BCKGRD;				// default value: #eff8fc
	$colorInfoTxt				= $conf->global->OBLYON_COLOR_INFO_TEXT;				// default value: #
	$colorWarningBorder			= $conf->global->OBLYON_COLOR_WARNING_BORDER;			// default value: #f2cf87
	$colorWarningBg				= $conf->global->OBLYON_COLOR_WARNING_BCKGRD;			// default value: #fcf8e3
	$colorWarningTxt			= $conf->global->OBLYON_COLOR_WARNING_TEXT;				// default value: #
	$colorErrorBorder			= $conf->global->OBLYON_COLOR_ERROR_BORDER;				// default value: #e0796e
	$colorErrorBg				= $conf->global->OBLYON_COLOR_ERROR_BCKGRD;				// default value: #f07b6e
	$colorErrorTxt				= $conf->global->OBLYON_COLOR_ERROR_TEXT;				// default value: #
	$colorNotifInfoBg			= $conf->global->OBLYON_COLOR_NOTIF_INFO_BCKGRD;		// default value: #d9e5d1
	$colorNotifInfoTxt			= $conf->global->OBLYON_COLOR_NOTIF_INFO_TEXT;			// default value: #446548
	$colorNotifWarningBg		= $conf->global->OBLYON_COLOR_NOTIF_WARNING_BCKGRD;		// default value: #fff7d1
	$colorNotifWarningTxt		= $conf->global->OBLYON_COLOR_NOTIF_WARNING_TEXT;		// default value: #a28918
	$colorNotifErrorBg			= $conf->global->OBLYON_COLOR_NOTIF_ERROR_BCKGRD;		// default value: #d79eac
	$colorNotifErrorTxt			= $conf->global->OBLYON_COLOR_NOTIF_ERROR_TEXT;			// default value: #a72947
	$colorTextTabActive			= $conf->global->OBLYON_COLOR_TEXTTABACTIVE;			// default value: #222222
	$colorBckgrdInput			= $conf->global->OBLYON_COLOR_INPUT_BCKGRD;				// default value: #DEDEDE
	$bgotherbox					= '#f4f4f4';											// default value: #E6E6E6	//	Other information boxes on home page
	$bgbutton_hover				= '#197489';											// default value: #197489
	if (!empty($maincolor)) {
		$colorlength	= strlen($maincolor);
		$matches		= array();
		if ($colorlength == 4)		preg_match('/([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})/', $maincolor, $matches);	// Format #RGB
		elseif ($colorlength == 7)	preg_match('/([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})/', $maincolor, $matches);	// Format #RRGGBB
		if (!empty($matches)) {
			$maincolor_variant						= array();
			$variation								= -50;	// 20% darker
			for ($i=1; $i < sizeof($matches); $i++)	$maincolor_variant[$i-1]	= max(0 , min(hexdec($matches[$i]) + $variation, 255));
			$bgbutton_hover = '#'.colorArrayToHex($maincolor_variant);
		}	// if (!empty($matches))
	}	// if (!empty($maincolor))
	$logo_background_color				= $conf->global->OBLYON_COLOR_LOGO_BCKGRD;		// default value : #ffffff
	$bgcolor							= $conf->global->OBLYON_COLOR_BCKGRD;			// default value : #f4f4f4
	$login_bgcolor						= $conf->global->OBLYON_COLOR_LOGIN_BCKGRD;		// default value : #f4f4f4
	$colorbtitle						= $conf->global->OBLYON_COLOR_BTITLE;			// default value : #E09430
	$colorftitle						= $conf->global->OBLYON_COLOR_FTITLE;			// default value : #F4F4F4
	$colorbline							= $conf->global->OBLYON_COLOR_BLINE;			// default value : #FFFFFF
	$colorbline_hover					= $conf->global->OBLYON_COLOR_BLINE_HOVER;		// default value : #F1F1F1
	$colorfline							= $conf->global->OBLYON_COLOR_FLINE;			// default value : #444444
	$colorfline_hover					= $conf->global->OBLYON_COLOR_FLINE_HOVER;		// default value : #222222
	$colorfdatedefault					= $conf->global->OBLYON_COLOR_FDATE_DEFAULT;	// default value : #FF0000
	$invertratiofilter					= $conf->global->THEME_INVERT_RATIO_FILTER;		// default value : 0

	$colorbackhmenu1					= $conf->global->THEME_ELDY_TOPMENU_BACK1;
	$colorbackvmenu1					= $conf->global->THEME_ELDY_VERMENU_BACK1;
	$colortopbordertitle1				= $conf->global->THEME_ELDY_TOPBORDER_TITLE1;
	$colorbacktitle1					= $conf->global->THEME_ELDY_BACKTITLE1;
	$colorbacktabcard1					= $conf->global->THEME_ELDY_BACKTABCARD1;
	$colorbacktabactive                 = empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED) ? (empty($conf->global->THEME_ELDY_BACKTABACTIVE) ? $colorbacktabactive : $conf->global->THEME_ELDY_BACKTABACTIVE) : (empty($user->conf->THEME_ELDY_BACKTABACTIVE) ? $colorbacktabactive : $user->conf->THEME_ELDY_BACKTABACTIVE);
	$colorbacklineimpair1				= $conf->global->THEME_ELDY_LINEIMPAIR1;
	$colorbacklineimpair2				= $conf->global->THEME_ELDY_LINEIMPAIR2;
	$colorbacklinepair1					= $conf->global->THEME_ELDY_LINEPAIR1;
	$colorbacklinepair2					= $conf->global->THEME_ELDY_LINEPAIR2;
	$colorbacklinebreak					= $conf->global->THEME_ELDY_LINEBREAK;
	$colorbackbody						= $conf->global->THEME_ELDY_BACKBODY;
	$colortexttitlenotab				= $conf->global->THEME_ELDY_TEXTTITLENOTAB;
	$colortexttitle						= $conf->global->THEME_ELDY_TEXTTITLE;
	$colortexttitlelink					= $conf->global->THEME_ELDY_TEXTTITLELINK;
	$colortext							= $conf->global->THEME_ELDY_TEXT;
	$colortextlink						= $conf->global->THEME_ELDY_TEXTLINK;
	// Hover color
	$colorbacklinepairhover				= colorStringToArray($colorbline_hover);
	$colorbacklinepairchecked			= colorStringToArray($colorbline_hover);
	$colortopckeditor					= colorArrayToHex(colorStringToArray($colorbackhmenu1));
	setcookie('colortopckeditor', $colortopckeditor, time() + (86400 * 30), "/"); // 86400 = 1 day
	// Set text color to black or white
	$colorbackhmenu1					= join(',', colorStringToArray($colorbackhmenu1));    // Normalize value to 'x,y,z'
	$colortextbackhmenu					= txt_color($colorbackhmenu1);
	$colorbackvmenu1					= join(',', colorStringToArray($colorbackvmenu1));    // Normalize value to 'x,y,z'
	$colortextbackvmenu					= txt_color($colorbackvmenu1);
	$colorbacktitle1					= join(',', colorStringToArray($colorbacktitle1));    // Normalize value to 'x,y,z'
	$colortexttitle						= txt_color($colorbacktitle1);
	if ($colortexttitle == 'FFFFFF')	$colorshadowtitle	= '888888';
	else if ($colortexttitle == '000000') {
		$colortexttitle='101010';
		$colorshadowtitle='FFFFFF';
	}	// else if ($colortexttitle == '000000')
	$colorbacktabcard1						= join(',', colorStringToArray($colorbacktabcard1));    // Normalize value to 'x,y,z'
	$colortextbacktab						= txt_color($colorbacktabcard1);
	if ($colortextbacktab == '000000')		$colortextbacktab	= '111111';
	// Format color value to match expected format (may be 'FFFFFF' or '255,255,255')
	$colorbackhmenu1						= join(',', colorStringToArray($colorbackhmenu1));
	$colorbackvmenu1						= join(',', colorStringToArray($colorbackvmenu1));
	$colortopbordertitle1					= join(',', colorStringToArray($colortopbordertitle1));
	$colorbacktitle1						= join(',', colorStringToArray($colorbacktitle1));
	$colorbacktabcard1						= join(',', colorStringToArray($colorbacktabcard1));
	$colorbacktabactive						= join(',', colorStringToArray($colorbacktabactive));
	$colorbacklineimpair1					= join(',', colorStringToArray($colorbacklineimpair1));
	$colorbacklineimpair2					= join(',', colorStringToArray($colorbacklineimpair2));
	$colorbacklinepair1						= join(',', colorStringToArray($colorbacklinepair1));
	$colorbacklinepair2						= join(',', colorStringToArray($colorbacklinepair2));
	if ($colorbacklinepairhover != '')		$colorbacklinepairhover		= join(',', colorStringToArray($colorbacklinepairhover));
	if ($colorbacklinepairchecked != '')	$colorbacklinepairchecked	= join(',', colorStringToArray($colorbacklinepairchecked));
	$colorbackbody							= join(',', colorStringToArray($colorbackbody));
	$colortexttitlenotab					= join(',', colorStringToArray($colortexttitlenotab));
	$colortexttitle							= join(',', colorStringToArray($colortexttitle));
	$colortext								= join(',', colorStringToArray($colortext));
	$colortextlink							= join(',', colorStringToArray($colortextlink));
	if ($colorBorderInfo != '')				$colorBorderInfo			= join(',', colorStringToArray($colorBorderInfo));
	if ($colorBackInfo != '')				$colorBackInfo				= join(',', colorStringToArray($colorBackInfo));
	if ($colorBorderWarning != '')			$colorBorderWarning			= join(',', colorStringToArray($colorBorderWarning));
	if ($colorBackWarning != '')			$colorBackWarning			= join(',', colorStringToArray($colorBackWarning));
	if ($colorBorderError != '')			$colorBorderError			= join(',', colorStringToArray($colorBorderError));
	if ($colorBackError != '')				$colorBackError				= join(',', colorStringToArray($colorBackError));
	if ($conf->browser->layout == 'phone')	$nbtopmenuentries			= max($nbtopmenuentries, 10);
	$minwidthtmenu							= 66;	/* minimum width for one top menu entry */
	$heightmenu								= 50;	/* height of top menu, part with image */
	$heightmenu2							= 49;	/* height of top menu, part with login  */
	$disableimages							= 0;
	$maxwidthloginblock						= 180;
	if (!empty($conf->global->THEME_TOPMENU_DISABLE_IMAGE)) {
		$disableimages		= 1;
		$maxwidthloginblock	= $maxwidthloginblock + 50;
		$minwidthtmenu		= 0;
	}	// if (!empty($conf->global->THEME_TOPMENU_DISABLE_IMAGE))
	if (!empty($conf->global->MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN))	$maxwidthloginblock = $maxwidthloginblock + 55;
	if (!empty($conf->global->MAIN_USE_TOP_MENU_SEARCH_DROPDOWN))	$maxwidthloginblock	= $maxwidthloginblock + 55;
	if (!empty($conf->bookmark->enabled))							$maxwidthloginblock	= $maxwidthloginblock + 55;
	print '/*'."\n";
	print 'colorbacklineimpair1						= '.$colorbacklineimpair1."\n";
	print 'colorbacklineimpair2						= '.$colorbacklineimpair2."\n";
	print 'colorbacklinepair1						= '.$colorbacklinepair1."\n";
	print 'colorbacklinepair2						= '.$colorbacklinepair2."\n";
	print '$colortexttitlenotab						= '.$colortexttitlenotab."\n";
	print '$colortext								= '.$colortext."\n";
	print '$colortextlink							= '.$colortextlink."\n";
	print 'dol_hide_topmenu							= '.$dol_hide_topmenu."\n";
	print 'dol_hide_leftmenu						= '.$dol_hide_leftmenu."\n";
	print 'dol_optimize_smallscreen					= '.$dol_optimize_smallscreen."\n";
	print 'dol_no_mouse_hover						= '.$dol_no_mouse_hover."\n";
	print 'dol_screenwidth							= '.$_SESSION['dol_screenwidth']."\n";
	print 'dol_screenheight							= '.$_SESSION['dol_screenheight']."\n";
	print 'nbtopmenuentries							= '.$nbtopmenuentries."\n";
	print 'topMenuFontSize							= '.$topMenuFontSize."\n";
	print 'toolTipBgColor							= '.$toolTipBgColor."\n";
	print 'toolTipFontColor							= '.$toolTipFontColor."\n";
	print 'conf->global->THEME_AGRESSIVENESS_RATIO	= '.$conf->global->THEME_AGRESSIVENESS_RATIO." (must be between 0 and 1)\n";
	print '*/'."\n";
	require __DIR__.'/global.inc.php';
	if (is_object($db))	$db->close();
?>