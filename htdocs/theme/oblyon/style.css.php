<?php
/**
 * Copyright (C) 2013-2016  Nicolas Rivera          <nrivera.pro@gmail.com>
 * Copyright (C) 2015-2019  Open-DSI                <support@open-dsi.fr>
 *
 * Copyright (C) 2004-2013  Laurent Destailleur     <eldy@users.sourceforge.net>
 * Copyright (C) 2006       Rodolphe Quiedeville    <rodolphe@quiedeville.org>
 * Copyright (C) 2007-2012  Regis Houssin           <regis.houssin@capnetworks.com>
 * Copyright (C) 2011       Philippe Grand          <philippe.grand@atoo-net.com>
 * Copyright (C) 2012       Juanjo Menent           <jmenent@2byte.es>
 *
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *  \file		htdocs/theme/oblyon/style.css.php
 *  \brief		File for CSS style sheet Oblyon
 */

//if (! defined('NOREQUIREUSER')) define('NOREQUIREUSER','1');	// Not disabled because need to load personalized language
//if (! defined('NOREQUIREDB'))   define('NOREQUIREDB','1');		// Not disabled to increase speed. Language code is found on url.
if (! defined('NOREQUIRESOC'))    define('NOREQUIRESOC','1');
//if (! defined('NOREQUIRETRAN')) define('NOREQUIRETRAN','1');	// Not disabled because need to do translations
if (! defined('NOCSRFCHECK'))     define('NOCSRFCHECK',1);
if (! defined('NOTOKENRENEWAL'))  define('NOTOKENRENEWAL',1);
if (! defined('NOLOGIN'))         define('NOLOGIN',1);	// File must be accessed by logon page so without login
if (! defined('NOREQUIREMENU'))   define('NOREQUIREMENU',1);
if (! defined('NOREQUIREHTML'))   define('NOREQUIREHTML',1);
if (! defined('NOREQUIREAJAX'))   define('NOREQUIREAJAX','1');

define('ISLOADEDBYSTEELSHEET', '1');


require __DIR__ . '/theme_vars.inc.php';
if (defined('THEME_ONLY_CONSTANT')) return;


session_cache_limiter('public');

require_once __DIR__.'/../../main.inc.php'; // __DIR__ allow this script to be included in custom themes
require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';

// Load user to have $user->conf loaded (not done into main because of NOLOGIN constant defined)
// and permission, so we can later calculate number of top menu ($nbtopmenuentries) according to user profile.
if (empty($user->id) && ! empty($_SESSION['dol_login']))
{
    $user->fetch('', $_SESSION['dol_login'], '', 1);
    $user->getrights();
}


// Define css type
top_httphead('text/css');
// Important: Following code is to avoid page request by browser and PHP CPU at
// each Dolibarr page access.
if (empty($dolibarr_nocache)) header('Cache-Control: max-age=10800, public, must-revalidate');
else header('Cache-Control: no-cache');

// On the fly GZIP compression for all pages (if browser support it). Must set the bit 3 of constant to 1.
if (isset($conf->global->MAIN_OPTIMIZE_SPEED) && ($conf->global->MAIN_OPTIMIZE_SPEED & 0x04)) { ob_start("ob_gzhandler"); }

if (GETPOST('theme', 'alpha')) $conf->theme=GETPOST('theme', 'alpha');  // If theme was forced on URL
if (GETPOST('lang', 'aZ09')) $langs->setDefaultLang(GETPOST('lang', 'aZ09'));	// If language was forced on URL

$langs->load("main",0,1);
$right=($langs->trans("DIRECTION")=='rtl'?'left':'right');
$left=($langs->trans("DIRECTION")=='rtl'?'right':'left');

$path='';			// This value may be used in future for external module to overwrite theme
$theme='oblyon';	// Value of theme
if (! empty($conf->global->MAIN_OVERWRITE_THEME_RES)) { $path='/'.$conf->global->MAIN_OVERWRITE_THEME_RES; $theme=$conf->global->MAIN_OVERWRITE_THEME_RES; }

print '/*'."\n";
print 'Oblyon theme for Dolibarr'."\n";

/*------------------------------------*\
		#Oblyon styles
\*------------------------------------*/

/** 
 * Define Colors
 *
 * Replace colors by changing the code. 
 * You can add hexadecimal, rgb() and rgba() notation: 
 * - hexa code:	 #fff
 * - rgb code: 		rgb(255,255,255)
 * - rgba code:		rgba(255,255,255, .8)
 */

$maincolor= $conf->global->OBLYON_COLOR_MAIN; // default value: #0083a2
$navlinkcolor= '#f4f4f4'; 	// default value: #eee
$topmenu_hover= $maincolor;	// default value: #
$bgnavtop = $conf->global->OBLYON_COLOR_TOPMENU_BCKGRD; // default value: #333					    //	for main navigation
$bgnavtop_txt = $conf->global->OBLYON_COLOR_TOPMENU_TXT; // default value: #f4f4f4				    //	for main navigation
$bgnavtop_txt_active = $conf->global->OBLYON_COLOR_TOPMENU_TXT_ACTIVE; // default value: #f4f4f4    //	for main navigation
$bgnavtop_txt_hover = $conf->global->OBLYON_COLOR_TOPMENU_TXT_HOVER; // default value: #f4f4f4      //	for main navigation
$bgnavtop_hover = $conf->global->OBLYON_COLOR_TOPMENU_BCKGRD_HOVER;	// default value: #444		    //	for main navigation
$bgnavleft = $conf->global->OBLYON_COLOR_LEFTMENU_BCKGRD; // default value: #333				    //	for left navigation
$bgnavleft_txt = $conf->global->OBLYON_COLOR_LEFTMENU_TXT; // default value: #f4f4f4			    //	for left navigation
$bgnavleft_txt_active = $conf->global->OBLYON_COLOR_LEFTMENU_TXT_ACTIVE; // default value: #f4f4f4	//	for left navigation
$bgnavleft_txt_hover = $conf->global->OBLYON_COLOR_LEFTMENU_TXT_HOVER; // default value: #f4f4f4	//	for left navigation
$bgnavleft_hover = $conf->global->OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER;	// default value: #444	    //	for left navigation

// For buttons
$colorButtonAction1 = $conf->global->OBLYON_COLOR_BUTTON_ACTION1;	// default value: #0088cc
$colorButtonAction2 = $conf->global->OBLYON_COLOR_BUTTON_ACTION2;	// default value: #0044cc
$colorButtonDelete1 = $conf->global->OBLYON_COLOR_BUTTON_DELETE1;	// default value: #cc8800
$colorButtonDelete2 = $conf->global->OBLYON_COLOR_BUTTON_DELETE2;	// default value: #cc4400

if ($conf->global->MAIN_MENU_INVERT)
{
	// TODO Switch colors?
	/*
	$bgnav = $bgnavleft;
	$bgnav_txt = $bgnavtop_txt;
	$bgnav_hover = $bgnavleft_hover;

	$bgnavleft = $bgnavtop;
	$bgnavleft_txt = $bgnavtop_txt;
	$bgnavleft_hover = $bgnavtop_hover;

	$bgnavtop = $bgnav;
	$bgnavtop_txt = $bgnav_txt;
	$bgnavtop_hover = $bgnav_hover;
	*/
}

$bgotherbox= '#f4f4f4';	 // default value: #E6E6E6		//	Other information boxes on home page

$bgbutton_hover= '#197489';	// default value: #197489
if (!empty($maincolor))
{
	$colorlength = strlen($maincolor);

	$matches = array();
	if ($colorlength == 4)
	{
		// Format #RGB
		preg_match('/([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})/', $maincolor, $matches);
	} elseif ($colorlength == 7)
	{
		// Format #RRGGBB
		preg_match('/([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})/', $maincolor, $matches);
	}

	if (!empty($matches))
	{
		$maincolor_variant = array();
		// 20% darker
		$variation = -50;
		for ($i=1; $i < sizeof($matches); $i++) { 
			$maincolor_variant[$i-1] = max(0 , min(hexdec($matches[$i]) + $variation, 255));
		}

		$bgbutton_hover = '#'.colorArrayToHex($maincolor_variant);
	}

}

$logo_background_color = $conf->global->OBLYON_COLOR_LOGO_BCKGRD; //default value : #ffffff
$bgcolor = $conf->global->OBLYON_COLOR_BCKGRD; // default value : #f4f4f4
$login_bgcolor = $conf->global->OBLYON_COLOR_LOGIN_BCKGRD; // default value : #f4f4f4

$colorbline = $conf->global->OBLYON_COLOR_BLINE; // default value : #FFFFFF
$colorfline = $conf->global->OBLYON_COLOR_FLINE; // default value : #444444
$colorfline_hover = $conf->global->OBLYON_COLOR_FLINE_HOVER; // default value : #222222

/**
 * Define Fonts
 */

$fontlist= '"Open Sans",Tahoma,Arial,Helvetica';		//initial: sans-serif
$fontboxtitle= 'Oswald,Verdana,Arial,Helvetica';
/* Main menu */
$fontmainmenu= '"Open Sans",Verdana,Arial,Helvetica';
/* Secondary menu */
$fontsecmenu= 'Verdana,Arial,Helvetica';
$fontmenusearch= '"Open Sans",Verdana,Arial,Helvetica';
$fontmenubookmarks= 'Verdana,Arial,Helvetica';
$fontmenuhelp= 'Verdana,Arial,Helvetica';

// Define other constants
$dol_hide_topmenu=$conf->dol_hide_topmenu;
$dol_hide_leftmenu=$conf->dol_hide_leftmenu;
$dol_optimize_smallscreen=$conf->dol_optimize_smallscreen;
$dol_no_mouse_hover=$conf->dol_no_mouse_hover;
$dol_use_jmobile=$conf->dol_use_jmobile;

$useboldtitle=(isset($conf->global->THEME_ELDY_USEBOLDTITLE)?$conf->global->THEME_ELDY_USEBOLDTITLE:1);
$borderwidth=2;

// Define reference colors
// Example: Light grey: $colred=235;$colgreen=235;$colblue=235;
// Example: Pink:		$colred=230;$colgreen=210;$colblue=230;
// Example: Green:		$colred=210;$colgreen=230;$colblue=210;
// Example: Ocean:		$colred=220;$colgreen=220;$colblue=240;
//$conf->global->THEME_ELDY_ENABLE_PERSONALIZED=0;
//$user->conf->THEME_ELDY_ENABLE_PERSONALIZED=0;
//var_dump($user->conf->THEME_ELDY_RGB);
$colred	=empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_RGB)?235:hexdec(substr($conf->global->THEME_ELDY_RGB,0,2))):(empty($user->conf->THEME_ELDY_RGB)?235:hexdec(substr($user->conf->THEME_ELDY_RGB,0,2)));
$colgreen=empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_RGB)?235:hexdec(substr($conf->global->THEME_ELDY_RGB,2,2))):(empty($user->conf->THEME_ELDY_RGB)?235:hexdec(substr($user->conf->THEME_ELDY_RGB,2,2)));
$colblue =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_RGB)?235:hexdec(substr($conf->global->THEME_ELDY_RGB,4,2))):(empty($user->conf->THEME_ELDY_RGB)?235:hexdec(substr($user->conf->THEME_ELDY_RGB,4,2)));

// Colors
$isred=max(0,(2*$colred-$colgreen-$colblue)/2);				// 0 - 255
$isgreen=max(0,(2*$colgreen-$colred-$colblue)/2);			// 0 - 255
$isblue=max(0,(2*$colblue-$colred-$colgreen)/2);			// 0 - 255

$colorbackhmenu1=($colred-3).','.($colgreen-3).','.($colblue-3);				 // topmenu
$colorbackhmenu2=($colred+5).','.($colgreen+5).','.($colblue+5);
$colorbackvmenu1=($colred+15).','.($colgreen+16).','.($colblue+17);			// vmenu
$colorbackvmenu1b=($colred+5).','.($colgreen+6).','.($colblue+7);				// vmenu (not menu)
$colorbackvmenu2=($colred-15).','.($colgreen-15).','.($colblue-15);
$colorbacktitle1=($colred-5).','.($colgreen-5).','.($colblue-5);		// title of array
$colorbacktitle2=($colred-15).','.($colgreen-15).','.($colblue-15);
$colorbacktabcard1=($colred+15).','.($colgreen+16).','.($colblue+17);	// card
$colorbacktabcard2=($colred-15).','.($colgreen-15).','.($colblue-15);
$colorbacktabactive=($colred-15).','.($colgreen-15).','.($colblue-15);
$colorbacklineimpair1=(244+round($isred/3)).','.(244+round($isgreen/3)).','.(244+round($isblue/3));		// line impair
$colorbacklineimpair2=(250+round($isred/3)).','.(250+round($isgreen/3)).','.(250+round($isblue/3));		// line impair
$colorbacklineimpairhover=(230+round(($isred+$isgreen+$isblue)/9)).','.(230+round(($isred+$isgreen+$isblue)/9)).','.(230+round(($isred+$isgreen+$isblue)/9));		// line impair
$colorbacklinepair1='248,248,248';		// line pair
$colorbacklinepair2='246,246,246';		// line pair
$colorbacklinepairhover=(230+round(($isred+$isgreen+$isblue)/9)).','.(230+round(($isred+$isgreen+$isblue)/9)).','.(230+round(($isred+$isgreen+$isblue)/9));
//$colorbackbody='#fff url(.$img_head.) 0 0 no-repeat;';
$colorbackbody='#fcfcfc';
$colortext='40,40,40';
$fontsize=!empty($conf->dol_optimize_smallscreen)?'12':'14';
$fontsizesmaller=empty($conf->dol_optimize_smallscreen)?'11':'14';

// Eldy colors
if (empty($conf->global->THEME_ELDY_ENABLE_PERSONALIZED)) {
	$conf->global->THEME_ELDY_TOPMENU_BACK1='140,160,185';		// topmenu
	$conf->global->THEME_ELDY_TOPMENU_BACK2='236,236,236';
	$conf->global->THEME_ELDY_VERMENU_BACK1='255,255,255';		// vmenu
	$conf->global->THEME_ELDY_VERMENU_BACK1b='230,232,232';	 // vmenu (not menu)
	$conf->global->THEME_ELDY_VERMENU_BACK2='240,240,240';
	$conf->global->THEME_ELDY_BACKTITLE1='140,160,185';			 // title of arrays
	$conf->global->THEME_ELDY_BACKTITLE2='230,230,230';
	$conf->global->THEME_ELDY_BACKTABCARD2='210,210,210';		 // card
	$conf->global->THEME_ELDY_BACKTABCARD1='234,234,234';
	$conf->global->THEME_ELDY_BACKTABACTIVE='234,234,234';
	//$conf->global->THEME_ELDY_BACKBODY='#fff url('.$img_head.') 0 0 no-repeat;';
	$conf->global->THEME_ELDY_BACKBODY='#fcfcfc;';
	$conf->global->THEME_ELDY_LINEIMPAIR1='242,242,242';
	$conf->global->THEME_ELDY_LINEIMPAIR2='248,248,248';
	$conf->global->THEME_ELDY_LINEIMPAIRHOVER='238,246,252';
	$conf->global->THEME_ELDY_LINEPAIR1='255,255,255';
	$conf->global->THEME_ELDY_LINEPAIR2='255,255,255';
	$conf->global->THEME_ELDY_LINEPAIRHOVER='238,246,252';
	$conf->global->THEME_ELDY_TEXT='50,50,130';
	if ($dol_use_jmobile) {
		$conf->global->THEME_ELDY_BACKTABCARD1='245,245,245';		// topmenu
		$conf->global->THEME_ELDY_BACKTABCARD2='245,245,245';
		$conf->global->THEME_ELDY_BACKTABACTIVE='245,245,245';
	}
}

// Case of option availables only if THEME_ELDY_ENABLE_PERSONALIZED is on
$colorbackhmenu1     =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_TOPMENU_BACK1)?$colorbackhmenu1:$conf->global->THEME_ELDY_TOPMENU_BACK1)   :(empty($user->conf->THEME_ELDY_TOPMENU_BACK1)?$colorbackhmenu1:$user->conf->THEME_ELDY_TOPMENU_BACK1);
$colorbackvmenu1     =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_VERMENU_BACK1)?$colorbackvmenu1:$conf->global->THEME_ELDY_VERMENU_BACK1)   :(empty($user->conf->THEME_ELDY_VERMENU_BACK1)?$colorbackvmenu1:$user->conf->THEME_ELDY_VERMENU_BACK1);
$colortopbordertitle1=empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_TOPBORDER_TITLE1)?$colortopbordertitle1:$conf->global->THEME_ELDY_TOPBORDER_TITLE1)   :(empty($user->conf->THEME_ELDY_TOPBORDER_TITLE1)?$colortopbordertitle1:$user->conf->THEME_ELDY_TOPBORDER_TITLE1);
$colorbacktitle1     =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_BACKTITLE1)   ?$colorbacktitle1:$conf->global->THEME_ELDY_BACKTITLE1)      :(empty($user->conf->THEME_ELDY_BACKTITLE1)?$colorbacktitle1:$user->conf->THEME_ELDY_BACKTITLE1);
$colorbacktabcard1   =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_BACKTABCARD1) ?$colorbacktabcard1:$conf->global->THEME_ELDY_BACKTABCARD1)  :(empty($user->conf->THEME_ELDY_BACKTABCARD1)?$colorbacktabcard1:$user->conf->THEME_ELDY_BACKTABCARD1);
$colorbacktabactive  =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_BACKTABACTIVE)?$colorbacktabactive:$conf->global->THEME_ELDY_BACKTABACTIVE):(empty($user->conf->THEME_ELDY_BACKTABACTIVE)?$colorbacktabactive:$user->conf->THEME_ELDY_BACKTABACTIVE);
$colorbacklineimpair1=empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_LINEIMPAIR1)  ?$colorbacklineimpair1:$conf->global->THEME_ELDY_LINEIMPAIR1):(empty($user->conf->THEME_ELDY_LINEIMPAIR1)?$colorbacklineimpair1:$user->conf->THEME_ELDY_LINEIMPAIR1);
$colorbacklineimpair2=empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_LINEIMPAIR2)  ?$colorbacklineimpair2:$conf->global->THEME_ELDY_LINEIMPAIR2):(empty($user->conf->THEME_ELDY_LINEIMPAIR2)?$colorbacklineimpair2:$user->conf->THEME_ELDY_LINEIMPAIR2);
$colorbacklinepair1  =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_LINEPAIR1)    ?$colorbacklinepair1:$conf->global->THEME_ELDY_LINEPAIR1)    :(empty($user->conf->THEME_ELDY_LINEPAIR1)?$colorbacklinepair1:$user->conf->THEME_ELDY_LINEPAIR1);
$colorbacklinepair2  =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_LINEPAIR2)    ?$colorbacklinepair2:$conf->global->THEME_ELDY_LINEPAIR2)    :(empty($user->conf->THEME_ELDY_LINEPAIR2)?$colorbacklinepair2:$user->conf->THEME_ELDY_LINEPAIR2);
$colorbacklinebreak  =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_LINEBREAK)    ?$colorbacklinebreak:$conf->global->THEME_ELDY_LINEBREAK)    :(empty($user->conf->THEME_ELDY_LINEBREAK)?$colorbacklinebreak:$user->conf->THEME_ELDY_LINEBREAK);
$colorbackbody       =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_BACKBODY)     ?$colorbackbody:$conf->global->THEME_ELDY_BACKBODY)          :(empty($user->conf->THEME_ELDY_BACKBODY)?$colorbackbody:$user->conf->THEME_ELDY_BACKBODY);
$colortexttitlenotab =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_TEXTTITLENOTAB)?$colortexttitlenotab:$conf->global->THEME_ELDY_TEXTTITLENOTAB)             :(empty($user->conf->THEME_ELDY_TEXTTITLENOTAB)?$colortexttitlenotab:$user->conf->THEME_ELDY_TEXTTITLENOTAB);
$colortexttitle      =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_TEXTTITLE)    ?$colortext:$conf->global->THEME_ELDY_TEXTTITLE)             :(empty($user->conf->THEME_ELDY_TEXTTITLE)?$colortexttitle:$user->conf->THEME_ELDY_TEXTTITLE);
$colortext           =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_TEXT)         ?$colortext:$conf->global->THEME_ELDY_TEXT)                  :(empty($user->conf->THEME_ELDY_TEXT)?$colortext:$user->conf->THEME_ELDY_TEXT);
$colortextlink       =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_TEXTLINK)     ?$colortext:$conf->global->THEME_ELDY_TEXTLINK)              :(empty($user->conf->THEME_ELDY_TEXTLINK)?$colortextlink:$user->conf->THEME_ELDY_TEXTLINK);
$fontsize            =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_FONT_SIZE1)   ?$fontsize:$conf->global->THEME_ELDY_FONT_SIZE1)             :(empty($user->conf->THEME_ELDY_FONT_SIZE1)?$fontsize:$user->conf->THEME_ELDY_FONT_SIZE1);
$fontsizesmaller     =empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED)?(empty($conf->global->THEME_ELDY_FONT_SIZE2)   ?$fontsize:$conf->global->THEME_ELDY_FONT_SIZE2)             :(empty($user->conf->THEME_ELDY_FONT_SIZE2)?$fontsize:$user->conf->THEME_ELDY_FONT_SIZE2);

// Hover color
$colorbacklinepairhover=((! isset($conf->global->THEME_ELDY_USE_HOVER) || (string) $conf->global->THEME_ELDY_USE_HOVER === '0')?'':($conf->global->THEME_ELDY_USE_HOVER === '1'?'edf4fb':$conf->global->THEME_ELDY_USE_HOVER));
if (! empty($user->conf->THEME_ELDY_ENABLE_PERSONALIZED))
{
	$colorbacklinepairhover=((! isset($user->conf->THEME_ELDY_USE_HOVER) || $user->conf->THEME_ELDY_USE_HOVER === '0')?'':($user->conf->THEME_ELDY_USE_HOVER === '1'?'edf4fb':$user->conf->THEME_ELDY_USE_HOVER));
}

// Set text color to black or white
$tmppart=explode(',',$colorbackhmenu1);
$tmpval=
	(! empty($tmppart[0]) ? $tmppart[0] : 0)
	+ (! empty($tmppart[1]) ? $tmppart[1] : 0)
	+ (! empty($tmppart[2]) ? $tmppart[2] : 0);
if ($tmpval <= 360) $colortextbackhmenu='FFF';
else $colortextbackhmenu = '444';
print 'colortextbackhmenu='.$colortextbackhmenu."\n";

$tmppart=explode(',',$colorbackvmenu1);
$tmpval=
	(! empty($tmppart[0]) ? $tmppart[0] : 0)
	+ (! empty($tmppart[1]) ? $tmppart[1] : 0)
	+ (! empty($tmppart[2]) ? $tmppart[2] : 0);
if ($tmpval <= 360) { $colortextbackvmenu = $bgnavleft_txt; }
else { $colortextbackvmenu = $bgnavleft_txt; }
print 'colortextbackvmenu='.$colortextbackvmenu."\n";

$tmppart=explode(',',$colorbacktitle1);
$tmpval=
	(! empty($tmppart[0]) ? $tmppart[0] : 0)
	+ (! empty($tmppart[1]) ? $tmppart[1] : 0)
	+ (! empty($tmppart[2]) ? $tmppart[2] : 0);
if ($tmpval <= 360) { $colortexttitle='FFF'; $colorshadowtitle='000'; }
else { $colortexttitle='444'; $colorshadowtitle='FFF'; }
print 'colortexttitle='.$colortexttitle."\n";
print 'colorshadowtitle='.$colorshadowtitle."\n";

$tmppart=explode(',',$colorbacktabcard1);
$tmpval=
	(! empty($tmppart[0]) ? $tmppart[0] : 0)
	+ (! empty($tmppart[1]) ? $tmppart[1] : 0)
	+ (! empty($tmppart[2]) ? $tmppart[2] : 0);
if ($tmpval <= 340) { $colortextbacktab='FFF'; }
else { $colortextbacktab='444'; }
print 'colortextbacktab='.$colortextbacktab."\n";


if(!empty($conf->global->MAIN_USE_TOP_MENU_SEARCH_DROPDOWN)){ $maxwidthloginblock = $maxwidthloginblock + 55; }
if(!empty($conf->global->MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN)) { $maxwidthloginblock = $maxwidthloginblock + 55; }
if(! empty($conf->bookmark->enabled) && !empty($conf->global->MAIN_USE_TOP_MENU_BOOKMARK_DROPDOWN)) { $maxwidthloginblock = $maxwidthloginblock + 55; }


print '/*'."\n";
print 'colorbackbody='.$colorbackbody."\n";
print 'colorbackvmenu1='.$colorbackvmenu1."\n";
print 'colorbackhmenu1='.$colorbackhmenu1."\n";
print 'colorbacktitle1='.$colorbacktitle1."\n";
print 'colorbacklineimpair1='.$colorbacklineimpair1."\n";
print 'colorbacklineimpair2='.$colorbacklineimpair2."\n";
print 'colorbacklinepair1='.$colorbacklinepair1."\n";
print 'colorbacklinepair2='.$colorbacklinepair2."\n";
print 'colorbacklinepairhover='.$colorbacklinepairhover."\n";
print 'colorbacklinepairchecked='.$colorbacklinepairchecked."\n";
print '$colortexttitlenotab='.$colortexttitlenotab."\n";
print '$colortexttitle='.$colortexttitle."\n";
print '$colortext='.$colortext."\n";
print '$colortextlink='.$colortextlink."\n";
print '$colortextbackhmenu='.$colortextbackhmenu."\n";
print '$colortextbackvmenu='.$colortextbackvmenu."\n";
print 'dol_hide_topmenu='.$dol_hide_topmenu."\n";
print 'dol_hide_leftmenu='.$dol_hide_leftmenu."\n";
print 'dol_optimize_smallscreen='.$dol_optimize_smallscreen."\n";
print 'dol_no_mouse_hover='.$dol_no_mouse_hover."\n";
print 'dol_screenwidth='.$_SESSION['dol_screenwidth']."\n";
print 'dol_screenheight='.$_SESSION['dol_screenheight']."\n";
print 'fontsize='.$fontsize."\n";
print 'nbtopmenuentries='.$nbtopmenuentries."\n";
print 'fontsizesmaller='.$fontsizesmaller;
print 'topMenuFontSize='.$topMenuFontSize."\n";
print 'toolTipBgColor='.$toolTipBgColor."\n";
print 'toolTipFontColor='.$toolTipFontColor."\n";
print '*/'."\n";

if (! empty($conf->dol_optimize_smallscreen)) $fontsize=11;

require __DIR__ . '/global.inc.php';

if (is_object($db)) $db->close();


