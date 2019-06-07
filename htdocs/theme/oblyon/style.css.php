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


//require __DIR__ . '/theme_vars.inc.php';
if (defined('THEME_ONLY_CONSTANT')) return;


session_cache_limiter('public');

require_once __DIR__.'/../../main.inc.php'; // __DIR__ allow this script to be included in custom themes
require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';

// Load user to have $user->conf loaded (not done into main because of NOLOGIN constant defined)
if (empty($user->id) && ! empty($_SESSION['dol_login'])) $user->fetch('',$_SESSION['dol_login']);

// Define css type
header('Content-type: text/css');
// Important: Following code is to avoid page request by browser and PHP CPU at
// each Dolibarr page access.
if (empty($dolibarr_nocache)) header('Cache-Control: max-age=3600, public, must-revalidate');
else header('Cache-Control: no-cache');

// On the fly GZIP compression for all pages (if browser support it). Must set the bit 3 of constant to 1.
if (isset($conf->global->MAIN_OPTIMIZE_SPEED) && ($conf->global->MAIN_OPTIMIZE_SPEED & 0x04)) { ob_start("ob_gzhandler"); }

if (GETPOST('lang')) $langs->setDefaultLang(GETPOST('lang'));	// If language was forced on URL
if (GETPOST('theme')) $conf->theme=GETPOST('theme');	// If theme was forced on URL
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
$bgnavtop = $conf->global->OBLYON_COLOR_TOPMENU_BCKGRD; // default value: #333					//	for main navigation
$bgnavtop_txt = $conf->global->OBLYON_COLOR_TOPMENU_TXT; // default value: #f4f4f4				//	for main navigation
$bgnavtop_hover = $conf->global->OBLYON_COLOR_TOPMENU_BCKGRD_HOVER;	// default value: #444		//	for main navigation
$bgnavleft = $conf->global->OBLYON_COLOR_LEFTMENU_BCKGRD; // default value: #333				//	for left navigation
$bgnavleft_txt = $conf->global->OBLYON_COLOR_LEFTMENU_TXT; // default value: #f4f4f4			//	for left navigation
$bgnavleft_hover = $conf->global->OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER;	// default value: #444	//	for left navigation

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


$usecss3=true;
if ($conf->browser->name == 'ie' && round($conf->browser->version,2) < 10) $usecss3=false;
elseif ($conf->browser->name == 'iceweasel') $usecss3=false;
elseif ($conf->browser->name == 'epiphany')	$usecss3=false;

print 'colred='.$colred.' colgreen='.$colgreen.' colblue='.$colblue."\n";
print 'isred='.$isred.' isgreen='.$isgreen.' isblue='.$isblue."\n";
print 'colorbacklineimpair1='.$colorbacklineimpair1."\n";
print 'colorbacklineimpair2='.$colorbacklineimpair2."\n";
print 'colorbacklineimpairhover='.$colorbacklineimpairhover."\n";
print 'colorbacklinepair1='.$colorbacklinepair1."\n";
print 'colorbacklinepair2='.$colorbacklinepair2."\n";
print 'colorbacklinepairhover='.$colorbacklinepairhover."\n";
print 'usecss3='.$usecss3."\n";
print 'dol_hide_topmenu='.$dol_hide_topmenu."\n";
print 'dol_hide_leftmenu='.$dol_hide_leftmenu."\n";
print 'dol_optimize_smallscreen='.$dol_optimize_smallscreen."\n";
print 'dol_no_mouse_hover='.$dol_no_mouse_hover."\n";
print 'dol_use_jmobile='.$dol_use_jmobile."\n";
print '*/'."\n";

if (! empty($conf->dol_optimize_smallscreen)) $fontsize=11;
?>

/*------------------------------------*\
		#Eric Meyer's Reset CSS v2.0 
\*------------------------------------*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: middle;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}

/*------------------------------------*\
		#BASE 
\*------------------------------------*/

html {
	box-sizing: border-box;
}
*, *:before, *:after {
	box-sizing: inherit;
}

html, body {
	height: 100%; 
	font-size: 100%;
}

body {
	<?php print 'direction: '.$langs->trans("DIRECTION").";\n"; ?>
	<?php if (GETPOST("optioncss") == 'print') {	?>
	background-color: #fff !important;
	<?php } else { ?>
	background-color: <?php print $bgcolor; ?> !important;
	<?php } ?>
	color: <?php echo $colorfline; ?> !important;
	font-family: <?php print $fontlist; ?>, sans-serif;
	<?php if (empty($dol_use_jmobile) || 1==1) { ?>
	font-size: <?php print $fontsize; ?>px;
	<?php } ?>
	-webkit-font-smoothing: subpixel-antialiased;
	margin: 0;
}

/**
 * Headings
 */

h1, h2, h3, h4, h5, h6 {
	font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
	font-weight: normal;
	font-style: normal;
	color: <?php echo $colorfline; ?>;
	text-rendering: optimizeLegibility;
	margin-top: 0.2rem;
	margin-bottom: 0.5rem;
	line-height: 1.4; 
}

h1 { font-size: 2.125rem; }

h2 { font-size: 1.6875rem; }

h3 { font-size: 1.375rem; }

h4 { font-size: 1.125rem; }

h5 { font-size: 1.125rem; }

h6 { font-size: 1rem; }


form {
	padding:0px;
	margin:0px;
}
div.float
{
	float:<?php print $left; ?>;
}
div.floatright
{
	float:<?php print $right; ?>;
}

.inline-block
{
	display:inline-block;
}

/* th a, .thumbstat, a.tab { font-weight: bold !important; } */

th .button {
	-moz-box-shadow: none !important;
	-webkit-box-shadow: none !important;
	box-shadow: none !important;
	-moz-border-radius:0px !important;
	-webkit-border-radius:0px !important;
	border-radius:0px !important;
}
.maxwidthsearch {		/* Max width of column with the search picto */
	width: 54px;
}

.valigntop {
	vertical-align: top;
}
.valignmiddle {
	vertical-align: middle;
}
.valignbottom {
	vertical-align: bottom;
}
.valigntextbottom {
	vertical-align: text-bottom;
}
.centpercent {
	width: 100%;
}
.quatrevingtpercent, .inputsearch {
	width: 80%;
}
.soixantepercent {
	width: 60%;
}
.quatrevingtquinzepercent {
	width: 95%;
}
textarea.centpercent {
	width: 96%;
}
.center {
	text-align: center;
	margin: 0px auto;
}
.left {
	text-align: <?php print $left; ?>;
}
.right {
	text-align: <?php print $right; ?>;
}
.justify {
	text-align: justify;
}
.nowrap {
	white-space: <?php print ($dol_optimize_smallscreen?'normal':'nowrap'); ?>;
}
.liste_titre .nowrap {
	white-space: nowrap;
}
.nowraponall {	/* no wrap on all devices */
	white-space: nowrap;
}
.wrapimp {
	white-space: normal !important;
}
.wordwrap {
	word-wrap: break-word;
}
.wordbreak {
	word-break: break-all;
}
.bold {
	font-weight: bold !important;
}
.nobold {
	font-weight: normal !important;
}
.nounderline {
	text-decoration: none;
}
.paddingleft {
	padding-<?php print $left; ?>: 4px;
}
.paddingleft2 {
	padding-<?php print $left; ?>: 2px;
}
.paddingright {
	padding-<?php print $right; ?>: 4px;
}
.paddingright2 {
	padding-<?php print $right; ?>: 2px;
}
.cursordefault {
	cursor: default;
}
.cursorpointer {
	cursor: pointer;
}
.cursormove {
	cursor: move;
}
.cursornotallowed {
	cursor: not-allowed;
}

/*
.text-center, .center { text-align: center; }
.text-left, .left { text-align: <?php print $left; ?>; }
.text-right, .right { text-align: <?php print $right; ?>; }
.text-justify { text-align: justify; }
.text-nowrap, .nowrap { white-space: nowrap;}
*/

/**
 * Links
 */

a { 
	color: <?php echo $colorfline; ?>; /* @new */
	font-family: <?php print $fontlist; ?>; 
	font-weight: normal;
	text-decoration: none;	
}

a:hover {
	cursor: pointer; 
}

a:hover, a:focus { 
	color: <?php print $maincolor; ?>;
	text-decoration: underline; 
}

hr {
	border: 1px dashed #777;
	height: 0;
	margin-top: 10px;
	margin-bottom: 10px;
}

/**
 * Hide/display
 */

<?php if (! empty($dol_optimize_smallscreen)) { ?>
.hideonsmartphone { display: none; }

.noenlargeonsmartphone { 
	width: 50px !important; 
	display: inline !important; 
}
<?php } ?>

div.visible,
tr.visible {
	display: block;
}

div.hidden,
td.hidden {
	display: none;
}

.opacityhigh {
	opacity: 0.8;
}
.optiongrey, .opacitymedium {
	opacity: 0.5;
}
.opacitytransp {
	opacity: 0;
}

/* ============================================================================== */
/*	Module website 																  */
/* ============================================================================== */

.websitebar {
	border-bottom: 1px solid #888;
	background: #eee;
}
.websitebar .button, .websitebar .buttonDelete 
{
	padding: 2px 5px 3px 5px !important;
	margin: 2px 4px 2px 4px	!important;
		line-height: normal;
}
.websiteselection {
	display: inline-block;
	padding-left: 10px;
	vertical-align: middle; 
	line-height: 29px;
}
.websitetools {
	float: right;
	padding-top: 2px;
}
.websiteiframenoborder {
	border: 0px;
}

/**
 * RTL direction
 */
 
td[align="left"] {
	text-align: <?php print $left; ?>; 
}
td[align="right"] {
	text-align: <?php print $right; ?>; 
}

/**
 * Dragging lines 
 */

.dragClass {
	color: #002255;
}
td.showDragHandle {
	cursor: move;
}
.tdlineupdown {
	white-space: nowrap;
}


/**
 * Images Styles
 */ 
 
img { 
	border: 0;
	vertical-align: middle; 
}

img[src*=pdf]		{ vertical-align: sub !important; }
img[src*=globe]		{ vertical-align: sub !important; }
img[src*=star]		{ vertical-align: baseline; }
input[type=image]	{ vertical-align: middle; }
img[src*=stcomm]	{ vertical-align: text-top; }


/**
 * Graphs Styles
 */ 
 
.dolgraphtitlecssboxes + div, #stats {
	margin: 0 auto;
}

.pieLabelBackground {
	background-color: #333 !important;
	color: #f7f7f7;
	opacity: 1;
}

.jPicker .Icon { margin-<?php print $left; ?>: .5em; }

/**
 * Form Elements
 */

<?php if (empty($dol_use_jmobile)) { ?>

input:focus, textarea:focus, button:focus, select:focus {
	box-shadow: 0 0 2px #8091bf;
}

textarea, 
input[type=text], 
input[type=password], 
input[type=email], 
input[type=number], 
input[type=search],
input[type=tel], 
input[type=url], 
.titlewrap input, 
select {
	border-color: rgba(0,0,0, .24);
	box-shadow: inset 0 1px 2px rgba(0,0,0, .07);
	padding: 1px;
}

input, input.flat, textarea, textarea.flat, form.flat select, select, select.flat, .dataTables_length label select {
	background-color: #FDFDFD;
	color: #444;
}

textarea:focus, button:focus {
	/* v6 box-shadow: 0 0 4px #8091BF; */
	border: 1px solid #aaa !important;
}
input:focus, textarea:focus, button:focus, select:focus {
	border-bottom: 1px solid #666;
}
input.select2-input {
	border-bottom: none ! important;
}
.select2-choice {
	border: none;
	border-bottom: 1px solid #ccc !important;
}

textarea.cke_source:focus
{
	box-shadow: none;
}

.liste_titre input[name=month_date_when], .liste_titre input[name=monthvalid], .liste_titre input[name=search_ordermonth], .liste_titre input[name=search_deliverymonth],
.liste_titre input[name=search_smonth], .liste_titre input[name=search_month], .liste_titre input[name=search_emonth], .liste_titre input[name=smonth], .liste_titre input[name=month],
.liste_titre input[name=month_lim], .liste_titre input[name=month_start], .liste_titre input[name=month_end], .liste_titre input[name=month_create],
.liste_titre input[name=search_month_lim], .liste_titre input[name=search_month_start], .liste_titre input[name=search_month_end], .liste_titre input[name=search_month_create],
.liste_titre input[name=search_month_create], .liste_titre input[name=search_month_start], .liste_titre input[name=search_month_end],
.liste_titre input[name=day_date_when], .liste_titre input[name=dayvalid], .liste_titre input[name=search_orderday], .liste_titre input[name=search_deliveryday],
.liste_titre input[name=search_sday], .liste_titre input[name=search_day], .liste_titre input[name=search_eday], .liste_titre input[name=sday], .liste_titre input[name=day], .liste_titre select[name=day],
.liste_titre input[name=day_lim], .liste_titre input[name=day_start], .liste_titre input[name=day_end], .liste_titre input[name=day_create],
.liste_titre input[name=search_day_lim], .liste_titre input[name=search_day_start], .liste_titre input[name=search_day_end], .liste_titre input[name=search_day_create],
.liste_titre input[name=search_day_create], .liste_titre input[name=search_day_start], .liste_titre input[name=search_day_end],
.liste_titre input[name=search_day_date_when], .liste_titre input[name=search_month_date_when], .liste_titre input[name=search_year_date_when],
.liste_titre input[name=search_dtstartday], .liste_titre input[name=search_dtendday], .liste_titre input[name=search_dtstartmonth], .liste_titre input[name=search_dtendmonth]
{
	margin-right: 4px;
}
input, input.flat, textarea, textarea.flat, form.flat select, select, select.flat, .dataTables_length label select {
	font-size: <?php print $fontsize ?>px;
	font-family: <?php print $fontlist ?>;
	border: none;
	border-bottom: solid 1px rgba(0,0,0,.1);
	outline: none;
	margin: 0px 0px 0px 0px;
}

.liste_titre .flat, .liste_titre select.flat {
	margin: 2px;
	padding: 2px 4px;
}

input, textarea, select {
	border-color: rgba(0,0,0, .24);
	box-shadow: inset 0 1px 2px rgba(0,0,0, .07);
	margin:3px 10px 3px 0;
} 
<?php } ?> /* end if (empty($dol_use_jmobile)) */

select.flat, form.flat select {
	font-weight: normal;
	font-size: unset;
	height: 2em;
}

input:disabled, 
select:disabled {
	background-color: #ddd;
	cursor: not-allowed;
}

input.liste_titre {
	box-shadow: none !important;
}

.listactionlargetitle .liste_titre {
	line-height: 24px;
}

input.removedfile {
	border: 0 !important;
	padding: 0 !important;
}

input.buttongen {
	vertical-align: middle;
}
input.buttonpayment {
	min-width: 320px;
	margin-bottom: 15px;
	background-image: none;
	line-height: 24px;
	padding: 8px;
	background: none;
	padding-left: 30px;
	text-align: <?php echo $left; ?>;
	border: 2px solid #666666;
	white-space: normal;
}
input.buttonpaymentcb {
	background-image: url(<?php echo dol_buildpath($path.'/theme/common/credit_card.png',1) ?>);
	background-size: 26px;
	background-repeat: no-repeat;
	background-position: 5px 5px;
}
input.buttonpaymentcheque {
	background-image: url(<?php echo dol_buildpath($path.'/theme/common/cheque.png',1) ?>);
	background-repeat: no-repeat;
	background-position: 8px 7px;
}
input.buttonpaymentcb {
	background-image: url(<?php echo dol_buildpath($path.'/theme/common/credit_card.png',1) ?>);
	background-size: 24px;
	background-repeat: no-repeat;
	background-position: 5px 4px;
}
input.buttonpaymentcheque {
	background-image: url(<?php echo dol_buildpath($path.'/paypal/img/object_paypal.png',1) ?>);
	background-repeat: no-repeat;
	background-position: 5px 4px;
}
input.buttonpaymentpaypal {
	background-image: url(<?php echo dol_buildpath($path.'/paypal/img/object_paypal.png',1) ?>);
	background-repeat: no-repeat;
	background-position: 8px 7px;
}
input.buttonpaymentpaybox {
	background-image: url(<?php echo dol_buildpath($path.'/paybox/img/object_paybox.png',1) ?>);
	background-repeat: no-repeat;
	background-position: 8px 7px;
}
input.buttonpaymentstripe {
	background-image: url(<?php echo dol_buildpath($path.'/stripe/img/object_stripe.png',1) ?>);
	background-repeat: no-repeat;
	background-position: 8px 7px;
}
/* Used for timesheets */
span.timesheetalreadyrecorded input {
	border: none;
	border-bottom: solid 1px rgba(0,0,0,0.1);
	margin-right: 1px !important;
}
td.onholidaymorning, td.onholidayafternoon {
	background-color: #fdf6f2;
}
td.onholidayallday {
	background-color: #f4eede;
}
td.actionbuttons a {
	padding-left: 6px;
}
td.leftborder, td.hide0 {
	border-left: 1px solid #ccc;
}
td.leftborder, td.hide6 {
	border-right: 1px solid #ccc;
}
td.rightborder {
	border-right: 1px solid #ccc;
}
textarea:disabled {
	background-color: #ddd;
}

input[type=checkbox] { 
	background-color: transparent; 
	border: none; 
	box-shadow: none; 
	margin: 0 2px 0 8px;
	vertical-align: middle;
}

input[type=radio] { 
	background-color: transparent; 
	border: none; box-shadow: none; 
	vertical-align: middle;
}

input[type=image] { 
	background-color: transparent; 
	border: none; 
	box-shadow: none; 
}

input:-webkit-autofill {
	background-color: <?php echo empty($dol_use_jmobile)?'#fbffea':'#fff'; ?> !important;
	background-image: none !important;
	-webkit-box-shadow: 0 0 0 50px <?php echo empty($dol_use_jmobile)?'#fbffea':'#fff'; ?> inset;
}

::placeholder,
::-webkit-input-placeholder, 
::-moz-placeholder,
:-ms-input-placeholder,
input:-moz-placeholder { 
	color: #ccc; 
}

<?php if (! empty($dol_use_jmobile)) { ?>
	legend { margin-bottom: 8px; }
<?php } ?>


/**
 * Buttons
 */
 
.button, 
.button:link, 
.button:active, 
.button:visited {
	background-color: <?php print $maincolor; ?>;
	/* border: 1px solid #c0c0c0; */
	border-color: <?php print $maincolor; ?>;
	/* box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
	-webkit-box-shadow: inset 0 1px 0 rgba(235,235,235, .6); */
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	color: #eee;
	cursor: pointer;
	font-size: 14px;
	/* margin: .2em .5em; */
	margin: 2px 1px;
	padding: .5em 1em;
	<?php if ($usecss3) { ?>
		transition: all .3s ease-in-out;
		-moz-transition: all .3s ease-in-out;
		-webkit-transition: all .3s ease-in-out;
	<?php } ?>
}

.button:hover, .button:focus {
	background-color: <?php print $bgbutton_hover; ?>; 
	border-color: <?php print $maincolor; ?>;
	box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
	-webkit-box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
	color: #fff;
}

.button:disabled {
	background-color: #ddd;
	cursor: not-allowed;
}

table[summary] .button[name=viewcal] { 
	width: inherit!important; 
	min-width: 120px;
}

.liste_titre input[type=submit] {
	background-color: #444;
	border-color: #555;
	box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
	-webkit-box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
	color: #fff;
	padding: .4em .8em;
}

.liste_titre input[type=submit]:hover {
	background-color: #333;
	border-color: #444;
}

div.noborder .button { padding: .4em .8em; }

#blockvmenusearch .button {
	background-color: #444;
	border: 1px solid #c0c0c0;
	border-color: #555;
	box-shadow: inset 0 1px 0 rgba(150, 172, 180, .6);
	-webkit-box-shadow: inset 0 1px 0 rgba(150, 172, 180, .6);
	color: #fff;
	font-size: inherit;
	margin: 0em .5em;
	padding: 7px 8px;
}

#blockvmenusearch .button:hover {
	background-color: #333; 
	border-color: #444;
	box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
	-webkit-box-shadow: inset 0 1px 0 rgba(235,235,235, .6); 
	color: #fff;
}

.buttonajax {
	background-image: url(<?php echo $img_button; ?>);
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

form {
	padding: 0;
	margin: 0;
}

th .button {
	border-radius: 0 !important;
	-moz-border-radius: 0 !important;
	-webkit-border-radius: 0 !important;
	box-shadow: none !important;
	-moz-box-shadow: none !important;
	-webkit-box-shadow: none !important;
}

/**
 * Action Buttons
 */
 
div.divButAction { margin-bottom: 1.5em; }

a.butActionNew>span.fa-plus-circle { padding-left: 6px; font-size: 1.5em; }
a.butActionNewRefused>span.fa-plus-circle { padding-left: 6px; font-size: 1.5em; }

.butAction,
.butActionDelete,
.butActionRefused,
.butActionNewRefused {
	background-color: <?php echo $colorbline; ?>;
	color: <?php echo $colorfline; ?>;
	font-weight: 500;
	margin: 0 <?php echo ($dol_optimize_smallscreen?'.3':'.5'); ?>em;
	padding: .3em <?php echo ($dol_optimize_smallscreen?'.4':'.7'); ?>em;
	white-space: nowrap;
	<?php if ($usecss3) { ?>
		transition: all .3s ease-in-out;
		-moz-transition: all .3s ease-in-out;
		-webkit-transition: all .3s ease-in-out;
	<?php } ?>
}

.butAction:hover,
.butActionNew:hover,
.butActionDelete:hover,
.butActionRefused:hover {
	color: #f7f7f7;
	text-decoration: none;
}

 .butAction {
	border: 1px solid <?php print $maincolor; ?>;
	<?php if ($usecss3) { ?>
		-webkit-box-shadow: inset 0 1px 0 rgba(170, 200, 210, .6);
		box-shadow: inset 0 1px 0 rgba(170, 200, 210, .6);
	<?php } ?>	
}

.butAction:hover, .butAction:active {
	background-color: <?php print $maincolor; ?>;
	<?php if ($usecss3) { ?>
		-webkit-box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
		box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
	<?php } ?>	
}

.butActionDelete {
	border: 1px solid #f07b6e; 
	<?php if ($usecss3) { ?>
		-webkit-box-shadow: inset 0 1px 0 rgba(210, 170, 170, .6);
		box-shadow: inset 0 1px 0 rgba(210, 170, 170, .6);
	<?php } ?> 
}

.butActionDelete:hover, .butActionDelete:active {
	background-color: #f07b6e;
	<?php if ($usecss3) { ?>
		-webkit-box-shadow: inset 0 1px 0 rgba(210, 170, 170, .6);
		box-shadow: inset 0 1px 0 rgba(210, 170, 170, .6);
	<?php } ?> 
}

.butActionRefused {
	font-weight: normal !important;
	background-color: #ddd;
	border: 1px solid rgba(0,0,0, .12);
	-webkit-box-shadow: inset 0 1px 0 rgba(170, 170, 170, .6);
	box-shadow: inset 0 1px 0 rgba(170, 170, 170, .6);
	color: <?php echo $colorfline; ?>;
	opacity: .6;
}

.butActionRefused:hover, .butActionRefused:active {
	background-color: #666;
	cursor: not-allowed;
}

<?php if (! empty($conf->global->MAIN_BUTTON_HIDE_UNAUTHORIZED)) { ?>
	.butActionRefused { display: none; }
<?php } ?>

span.butAction, 
span.butActionDelete {
	cursor: pointer;
}


/**
 * State Ok, Warning, Error
 */

.ok	  { color: #114466; }
.warning { color: #f07b6e; }
.error   { color: #7e1515 !important; font-weight: bold; }

.bloc_success { 
	background-color: #33cc66;
	color: #fff;
	display: inline-block;
	margin-bottom: .5em;
	padding: 1em;
}

.bloc_warning { 
	background-color: #f07b6e;
	color: #fff;
	display: inline-block;
	margin-bottom: .5em;
	padding: 1em;
}

div.ok {
	color: #114466;
}

/* Warning message */
div.warning {
	border-<?php print $left; ?>: solid 5px #d8c59a;
	padding-top: 8px;
	padding-left: 10px;
	padding-right: 4px;
	padding-bottom: 8px;
	margin: 0.5em 0em 0.5em 0em;
	background: rgb(255, 218, 135);
}

/* Error message */
div.error {
	border-<?php print $left; ?>: solid 5px #e0796e;
	padding-top: 8px;
	padding-left: 10px;
	padding-right: 4px;
	padding-bottom: 8px;
	margin: 0.5em 0em 0.5em 0em;
	background: #f07b6e;
}

/* Info admin */
div.info {
	border-<?php print $left; ?>: solid 5px #e0796e;
	padding-top: 8px;
	padding-left: 10px;
	padding-right: 4px;
	padding-bottom: 8px;
	margin: 0.5em 0em 0.5em 0em;
	background: f07b6e;
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
.movable {
	cursor: move;
}
.borderrightlight
{
	border-right: 1px solid rgba(0,0,0, .24);
}
#formuserfile {
	margin-top: 4px;
}
#formuserfile_link {
	margin-left: 1px;
}
.listofinvoicetype {
	height: 28px;
	vertical-align: middle;
}
div.divsearchfield {
	float: <?php print $left; ?>;
	margin-<?php print $right; ?>: 12px;
	margin-<?php print $left; ?>: 2px;
	margin-top: 4px;
	margin-bottom: 4px;
	padding-left: 2px;
}
.divsearchfieldfilter {
	text-overflow: clip;
	overflow: auto;
	white-space: nowrap;
	padding-bottom: 5px;
	opacity: 0.6;
}
div.confirmmessage {
	padding-top: 6px;
}
div.myavailability {
	padding-top: 6px;
}
/* Style to move picto into left of button */
/*
.buttonactionview {
	padding-left: 15px;
}
.pictoactionview {
	padding-left: 10px;
	margin-right: -24px;
	z-index: 999999;
}
*/
.googlerefreshcal {
	padding-top: 4px;
	padding-bottom: 4px;
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
	margin-left: 10px !important;
}
.nomarginleft {
	margin-left: 0px !important;
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
.marginleftonly {
    margin-left: 5px !important;
}
/* using a tdoverflowxxx make the min-width not working */
.tdoverflow {
	max-width: 0;
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
.tdoverflowmax300 {
	max-width: 300px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
.tdoverflowauto {
	max-width: 0;
	overflow: auto;
}
.tablelistofcalendars {
	margin-top: 25px !important;
}
.amountalreadypaid {
}
.amountpaymentcomplete {
	color: #008800;
	font-weight: bold;
}
.amountremaintopay {
	color: #880000;
	font-weight: bold;
}
.amountremaintopayback {
	font-weight: bold;
}
.amountpaymentneutral {
	font-weight: bold;
	font-size: 1.4em;
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
	color: <?php print $maincolor; ?>;
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
	line-height: 120%;
}
/* Style used for full page tables with field selector and no content after table (priority before previous for such tables) */
div.fiche>form>div.div-table-responsive, div.fiche>form>div.div-table-responsive-no-min {
	overflow-x: auto;
}
div.fiche>form>div.div-table-responsive {
	min-height: 392px;
}

.flexcontainer {
	<?php if (in_array($conf->browser->browsername, array('chrome','firefox'))) echo 'display: inline-flex;' ?>
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

/* ============================================================================== */
/* Styles to hide objects														  */
/* ============================================================================== */

.clearboth  { clear:both; }
.hideobject { display: none; }
.minwidth50  { min-width: 50px; }
/* rule for not too small screen only */
@media only screen and (min-width: <?php echo round($nbtopmenuentries * $fontsize * 3.4, 0) + 7; ?>px)
{
	.width25  { width: 25px; }
	.width50  { width: 50px; }
	.width75  { width: 75px; }
	.width100 { width: 100px; }
	.width200 { width: 200px; }
	.minwidth100 { min-width: 100px; }
	.minwidth200 { min-width: 200px; }
	.minwidth300 { min-width: 300px; }
	.minwidth400 { min-width: 400px; }
	.minwidth500 { min-width: 500px; }
	.minwidth50imp  { min-width: 50px !important; }
	.minwidth75imp  { min-width: 75px !important; }
	.minwidth100imp { min-width: 100px !important; }
	.minwidth200imp { min-width: 200px !important; }
	.minwidth300imp { min-width: 300px !important; }
	.minwidth400imp { min-width: 400px !important; }
	.minwidth500imp { min-width: 500px !important; }
}
.widthauto { width: auto; }
.width25  { width: 25px; }
.width50  { width: 50px; }
.width75  { width: 75px; }
.width100 { width: 100px; }
.width200 { width: 200px; }
.maxwidth25  { max-width: 25px; }
.maxwidth50  { max-width: 50px; }
.maxwidth75  { max-width: 75px; }
.maxwidth100 { max-width: 100px; }
.maxwidth125 { max-width: 125px; }
.maxwidth150 { max-width: 150px; }
.maxwidth200 { max-width: 200px; }
.maxwidth300 { max-width: 300px; }
.maxwidth400 { max-width: 400px; }
.maxwidth500 { max-width: 500px; }
.maxwidth50imp  { max-width: 50px !important; }
.maxwidth75imp  { max-width: 75px !important; }
.minheight20 { min-height: 20px; }
.minheight40 { min-height: 40px; }
.titlefieldcreate { width: 20%; }
.titlefield	   { width: 25%; }
.titlefieldmiddle { width: 50%; }
.imgmaxwidth180 { max-width: 180px; }


/* Force values for small screen 1400 */
@media only screen and (max-width: 1400px)
{
	.titlefield { width: 30% !important; }
	.titlefieldcreate { width: 30% !important; }
	.minwidth50imp  { min-width: 50px !important; }
	.minwidth75imp  { min-width: 75px !important; }
	.minwidth100imp { min-width: 100px !important; }
	.minwidth200imp { min-width: 200px !important; }
	.minwidth300imp { min-width: 300px !important; }
	.minwidth400imp { min-width: 300px !important; }
	.minwidth500imp { min-width: 300px !important; }
}

/* Force values for small screen 1000 */
@media only screen and (max-width: 1000px)
{
	.maxwidthonsmartphone { max-width: 100px; }
	.minwidth50imp  { min-width: 50px !important; }
	.minwidth75imp  { min-width: 70px !important; }
	.minwidth100imp { min-width: 80px !important; }
	.minwidth200imp { min-width: 100px !important; }
	.minwidth300imp { min-width: 100px !important; }
	.minwidth400imp { min-width: 100px !important; }
	.minwidth500imp { min-width: 100px !important; }
}

/* Force values for small screen 767 */
@media only screen and (max-width: 767px)
{
	body {
		font-size: <?php print $fontsize+3; ?>px;
	}
}

/* Force values for small screen 570 */
@media only screen and (max-width: 570px)
{
	body {
		font-size: <?php print $fontsize+3; ?>px;
	}

	.divmainbodylarge { margin-left: 20px; margin-right: 20px; }

	.tdoverflowonsmartphone {
		max-width: 0;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	div.fiche {
		margin-top: <?php print ($dol_hide_topmenu?'12':'6'); ?>px !important;
	}
	div.titre {
		line-height: 2em;
	}
	.border tbody tr, .border tbody tr td, div.tabBar table.border tr {
		height: 40px !important;
	}

	.quatrevingtpercent, .inputsearch {
		width: 95%;
	}

	select {
		padding-top: 4px;
		padding-bottom: 5px;
	}

	input, input[type=text], input[type=password], select, textarea	 {
		min-width: 20px;
		min-height: 1.4em;
		line-height: 1.4em;
		font-size: <?php print $fontsize+3; ?>px;
		/* padding: .4em .1em; */
		/* border-bottom: 1px solid #BBB; */
		/* max-width: inherit; why this */
	 }

	.hideonsmartphone { display: none; }
	.noenlargeonsmartphone { width : 50px !important; display: inline !important; }
	.maxwidthonsmartphone, #search_newcompany.ui-autocomplete-input { max-width: 100px; }
	.maxwidth50onsmartphone { max-width: 40px; }
	.maxwidth75onsmartphone { max-width: 50px; }
	.maxwidth100onsmartphone { max-width: 70px; }
	.maxwidth150onsmartphone { max-width: 120px; }
	.maxwidth200onsmartphone { max-width: 200px; }
	.maxwidth300onsmartphone { max-width: 300px; }
	.maxwidth400onsmartphone { max-width: 400px; }
	.minwidth50imp  { min-width: 50px !important; }
	.minwidth75imp  { min-width: 60px !important; }
	.minwidth100imp { min-width: 60px !important; }
	.minwidth200imp { min-width: 60px !important; }
	.minwidth300imp { min-width: 60px !important; }
	.minwidth400imp { min-width: 60px !important; }
	.minwidth500imp { min-width: 60px !important; }
	.titlefield { width: auto; }
	.titlefieldcreate { width: auto; }

	#tooltip {
		position: absolute;
		width: <?php print dol_size(300,'width'); ?>px;
	}

	/* intput, input[type=text], */
	select {
		width: 98%;
		min-width: 40px;
	}

	div.divphotoref {
		padding-right: 5px;
		padding-bottom: 5px;
	}
	img.photoref, div.photoref {
		border: none;
		-moz-box-shadow: none;
		-webkit-box-shadow: none;
		box-shadow: none;
		padding: 4px;
		height: 20px;
		width: 20px;
		object-fit: contain;
	}

	div.statusref {
		padding-right: 10px;
	}

	div.statusref img {
		padding-right: 3px !important;
	}

	div.statusrefbis {
		padding-right: 3px !important;
	}

	input.buttonpayment {
		min-width: 300px;
	}
}
.linkobject { cursor: pointer; }
<?php if (GETPOST('optioncss','aZ09') == 'print') { ?>
.hideonprint { display: none; }
<?php } ?>


/* ============================================================================== */
/* Styles for dragging lines													  */
/* ============================================================================== */

.dragClass {
	color: #002255;
}
td.showDragHandle {
	cursor: move;
}
.tdlineupdown {
	white-space: nowrap;
	min-width: 10px;
}

/*------------------------------------*\
		#Positioning Areas
\*------------------------------------*/

#id-container:before,
#id-container:after {
	content: ' '; 
	display: table;
}

#id-container:after {
	clear: both;
}

#id-container {
	table-layout: fixed;
}

.login_block_getinfo {
	text-align: center;
}
.login_block_getinfo div.login_block_user {
	display: block;
}
.login_block_getinfo .atoplogin, .login_block_getinfo .atoplogin:hover {
	color: <?php echo $colorfline; ?> !important;
	font-weight: normal !important;
}

#id-right, 
#id-left,
.side-nav {
	display: table-cell;
	<?php if ($conf->global->OBLYON_HIDE_LEFTMENU || $conf->dol_optimize_smallscreen) { ?>
		float: left;
	<?php } else { ?>
		float: none;
	<?php } ?>
	vertical-align: top;
}

#id-right {
	<?php if (GETPOST("optioncss") == 'print') { ?>
		padding-top: 10px;
	<?php } else if ($conf->global->OBLYON_STICKY_TOPBAR) { ?>
		<?php if ($conf->global->MAIN_MENU_INVERT) { ?>
			padding-top: 52px;
		<?php } else { ?>
			padding-top: 64px;
		<?php } ?>
	<?php } else { ?>
		padding-top: 10px;
	<?php } ?>
	width: 100%;
}

#id-left {
	<?php if ( !$conf->global->OBLYON_HIDE_LEFTMENU && !$conf->dol_optimize_smallscreen ) { ?>
		<?php if ( $conf->global->OBLYON_STICKY_TOPBAR ) { ?>
			<?php if ( $conf->global->MAIN_MENU_INVERT ) { ?>
				padding-top: 40px;
			<?php } else { ?>
				padding-top: 54px;
			<?php } ?>
		<?php } ?>
	<?php } ?>
	<?php if ( !$conf->global->OBLYON_FULLSIZE_TOPBAR ) { ?>
		position: relative;
	<?php } ?>
	<?php if(!$conf->global->OBLYON_HIDE_LEFTMENU && !$conf->dol_optimize_smallscreen && (!$conf->global->OBLYON_FULLSIZE_TOPBAR || !$conf->global->OBLYON_SHOW_COMPNAME)) { ?>
		z-index: 92;
	<?php } else { ?>
		z-index: 90;
	<?php } ?>
}

/* coming feature -****
#id-left {
	<?php if ( $conf->global->OBLYON_HIDE_LEFTMENU || $conf->dol_optimize_smallscreen ) { ?>
		<?php if ( $conf->global->OBLYON_STICKY_TOPBAR ) { ?>
			<?php if ( $conf->global->MAIN_MENU_INVERT ) { ?>
				height: calc(100% - 40px);
			<?php } else { ?>
				height: calc(100% - 54px);
			<?php } ?>
		<?php } else { ?>
			height: 100%;
			top: 0;
		<?php } ?>
		
		overflow-x: hidden;
		overflow-y: auto;
		position: fixed;
	<?php } ?>
}*/

#id-top {
	background-color: <?php print $bgnavtop; ?>;
	z-index: 91;
}

div.fiche {
	margin-<?php print $left; ?>: <?php print (GETPOST("optioncss") == 'print'?6:($dol_hide_leftmenu?'6':'10')); ?>px;
	<?php if ( !$conf->global->OBLYON_HIDE_LEFTMENU && !$conf->dol_optimize_smallscreen ) { ?>
		margin-<?php print $right; ?>: <?php print (GETPOST("optioncss") == 'print'?8:(empty($conf->dol_optimize_smallscreen)?'12':'6')); ?>px;
	<?php } else { ?>
		margin-<?php print $right; ?>: <?php print (GETPOST("optioncss") == 'print'?6:((empty($conf->global->MAIN_MENU_USE_JQUERY_LAYOUT))?($dol_hide_topmenu?'4':'20'):'24')); ?>px;
	<?php } ?>
	<?php if (! empty($conf->dol_hide_leftmenu) && ! empty($conf->dol_hide_topmenu)) print 'margin-top: 4px;'; ?>
}

div.fichecenter {
	clear: both;	/* This is to have div fichecenter that are true rectangles */
	width: 100%;
}

div.fichecenterbis {
	margin-top: 8px;
}
div.fichethirdleft {
	<?php if ($conf->browser->layout != 'phone') { print "float: ".$left.";\n"; } ?>
	<?php if ($conf->browser->layout != 'phone') { print "width: 50%;\n"; } ?>
	<?php if ($conf->browser->layout == 'phone') { print "padding-bottom: 6px;\n"; } ?>
}
div.fichetwothirdright {
	<?php if ($conf->browser->layout != 'phone') { print "float: ".$right.";\n"; } ?>
	<?php if ($conf->browser->layout != 'phone') { print "width: 50%;\n"; } ?>
	<?php if ($conf->browser->layout == 'phone') { print "padding-bottom: 6px\n"; } ?>
}
div.fichehalfleft {
	<?php if ($conf->browser->layout != 'phone') { print "float: ".$left.";\n"; } ?>
	<?php if ($conf->browser->layout != 'phone') { print "width: 50%;\n"; } ?>
}
div.fichehalfright {
	<?php if ($conf->browser->layout != 'phone') { print "float: ".$right.";\n"; } ?>
	<?php if ($conf->browser->layout != 'phone') { print "width: 50%;\n"; } ?>
}
div.ficheaddleft {
	<?php if ($conf->browser->layout != 'phone') { print "padding-".$left.": 16px;\n"; }
	else print "margin-top: 10px;\n"; ?>
}
div.firstcolumn div.box {
	padding-right: 10px;
}
div.secondcolumn div.box {
	padding-left: 10px;
}

/* Force values for small screen */
@media only screen and (max-width: 900px)
{
	div.fiche {
		margin-<?php print $left; ?>: <?php print (GETPOST("optioncss") == 'print'?6:((empty($conf->global->MAIN_MENU_USE_JQUERY_LAYOUT))?($dol_hide_leftmenu?'6':'10'):'12')); ?>px;
		margin-<?php print $right; ?>: <?php print (GETPOST("optioncss") == 'print'?8:6); ?>px;
		<?php if (! empty($conf->dol_hide_leftmenu) && ! empty($conf->dol_hide_topmenu)) print 'margin-top: 4px;'; ?>
	}
	div.fichecenter {
		width: 100%;
		clear: both;	/* This is to have div fichecenter that are true rectangles */
	}
	div.fichecenterbis {
		margin-top: 8px;
	}
	div.fichethirdleft {
		float: none;
		width: auto;
		padding-bottom: 6px;
	}
	div.fichetwothirdright {
		float: none;
		width: auto;
		padding-bottom: 6px;
	}
	div.fichehalfleft {
		float: none;
		width: auto;
	}
	div.fichehalfright {
		float: none;
		width: auto;
	}
	div.ficheaddleft {
		<?php print "padding-".$left.": 0px;\n"; ?>
		margin-top: 10px;
	}
	div.firstcolumn div.box {
		padding-right: 0px;
	}
	div.secondcolumn div.box {
		padding-left: 0px;
	}
}

.containercenter {
	display : table;
	margin : 0px auto;
}

#pictotitle, .pictotitle {
	margin-<?php echo $right; ?>: 8px;
	margin-bottom: 4px;
}
.pictoobjectwidth {
	width: 14px;
}
.pictosubstatus {
	padding-left: 2px;
	padding-right: 2px;
}
.pictostatus {
	width: 15px;
	vertical-align: middle;
	margin-top: -3px
}
.pictowarning, .pictopreview {
	padding-<?php echo $left; ?>: 3px;
}
.pictowarning {
	vertical-align: text-bottom;
}
/*------------------------------------*\
		#Top Menu
\*------------------------------------*/

#tmenu_tooltipinvert .db-menu__society,
#tmenu_tooltip .db-menu__society { /* for v3.5 */
	display: inline-block;
	float: <?php print $left; ?>;
	margin: 0 10px;
	max-width: 210px;
	text-align: <?php print $left; ?>;
}

#tmenu_tooltipinvert .db-menu__society a,
#tmenu_tooltip .db-menu__society a { /* for v3.5 */
	color: #fff;
	display: inline;
	font-weight: 500;
	height: 40px;
	line-height: 40px;
	padding: 0 5px;
	text-decoration: none;
	overflow: hidden;
	text-overflow: ellipsis;
	<?php if ($usecss3) { ?>
		transition: all .4s ease-in-out;
		-moz-transition: all .4s ease-in-out;
		-webkit-transition: all .4s ease-in-out;
	<?php } ?>
}

#tmenu_tooltipinvert .db-menu__society a:hover,
#tmenu_tooltip .db-menu__society a:hover { /* for v3.5 */
	color: <?php print $maincolor; ?>;
}

/*
 * Main Navigation
 */

#tmenu_tooltip {
	<?php if (GETPOST("optioncss") == 'print') { ?>
		display: none;
	<?php } else { ?>
		display: block;
		overflow: auto;
		width: 100%;
		background-color: <?php print $bgnavtop; ?>;
		<?php if ( $usecss3 ) { ?>
			<?php if ( $conf->global->OBLYON_STICKY_TOPBAR ) { ?>
			box-shadow: 0 1px 2px rgba(0, 0, 0, .4) !important; 
			-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .4) !important;
			-webkit-animation: fade 500ms;
			<?php } ?>
		transition: max-height .2s ease-in-out;
		-moz-transition: max-height .2s ease-in-out;
		-webkit-transition: max-height .2s ease-in-out;
		<?php } ?>
		<?php if ( $conf->global->MAIN_MENU_INVERT ) { ?>
		max-height: 40px;
		<?php } else { ?>
		max-height: 54px;
		<?php } ?>
		margin: 0;
		padding-<?php print $right; ?>: 160px;
		z-index: 95;
		<?php if ( $conf->global->OBLYON_STICKY_TOPBAR ) { ?>
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
		<?php } else { ?>
			position: relative;
		<?php } ?>
	<?php } ?>
}

#tmenu_tooltip:hover {
	max-height: 540px;
}

.main-nav {
	<?php if (GETPOST("optioncss") == 'print') { ?>
		display: none;
	<?php } else { ?>
		/*background-color: rgb(<?php echo $colorback1; ?>);*/
		color: #fcfcfc;
		font-size: 13px;
		margin: 0;
		padding: 0;
		position: relative;
		text-decoration: none;
		white-space: nowrap;
	<?php } ?>
}

.main-nav__list {
	list-style: none;
	margin-bottom: 20px;
	padding: 0;
}

.main-nav__item {
	<?php if (empty($conf->global->MAIN_MENU_INVERT)) { ?>
		float: <?php print $left; ?>;
		height: <?php print $heightmenu; ?>px;
	<?php } ?>
	display: block;
	margin: 0;
	padding: 0;
	position: relative;
}

.main-nav__item { 
	background-color: <?php print $bgnavtop; ?>; 
}

.main-nav__item:hover {
	background-color: <?php print $bgnavtop_hover; ?>;
	color: <?php print $bgnavtop_txt; ?>;
}

.main-nav__item.is-sel {
	background-color: <?php print $bgnavtop_hover; ?>;
	color: <?php print $bgnavtop_txt; ?>;
}


#tmenu_tooltip .main-nav__list {
	margin: 0;
	padding: 0; 
	text-align: center;
	z-index: 30;
}

#tmenu_tooltip .main-nav__item {
	display: block;
	float: <?php print $left; ?>;
	position: relative;
	<?php if ( $conf->global->OBLYON_HIDE_TOPICONS ) { ?>
		height: 54px;
		line-height: 54px;
	<?php } else { ?>
		height: 54px;
	<?php } ?>
}

.main-nav__item.tmenusel {
	background-color: <?php print $bgnavtop_hover; ?>;
}

.main-nav__item.tmenusel .main-nav__link {
	font-weight: bold !important;
}

.main-nav__item.tmenusel:hover {
	color: #fff;
}

.main-nav__item.tmenusel .main-nav__link:hover {
	color: #fff;
	font-weight: bold;
}



/*
.main-nav__item:hover a,
.main-nav__list:visited li a {
	color: #eee;
	display: block;
	font-weight: normal;
	height: 54px;
	padding: 0 6px;
	text-decoration: none;
	transition: all .2s ease-in-out;
	-moz-transition: all .2s ease-in-out;
	-webkit-transition: all .2s ease-in-out;
}*/

#tmenu_tooltip .tmenu li:hover .main-nav__link,
.main-nav__item:hover .main-nav__link,
.main-nav__item .main-nav__link:focus {
	color: <?php print $topmenu_hover; ?>;
}

.main-nav__link {
	color: <?php print $navlinkcolor; ?>;
	display: block;
	font-family: <?php print $fontmainmenu; ?>;
	<?php if ($usecss3) { ?>
		transition: all .2s ease-in-out;
		-moz-transition: all .2s ease-in-out;
		-webkit-transition: all .2s ease-in-out;
	<?php } ?>
}

#tmenu_tooltip .main-nav__link {
	height: 54px;
	<?php if ( $conf->global->OBLYON_HIDE_TOPICONS ) { ?>
		font-weight: 500;
		line-height: 54px;
		padding: 0 8px;
	<?php } else { ?>
		padding: 0 6px;
	<?php } ?>
}
 
.main-nav__link.is-disabled {
	cursor: not-allowed;
	opacity: .6;
}
.main-nav__link.is-disabled:hover {
	color: #888;
}

.db-nav .main-nav__link {
	text-decoration: none;
}

/**
 * Secondary Navigation
 */
 
#tmenu_tooltipinvert .pushy-btn,
#tmenu_tooltip .pushy-btn { /* for v3.5 */
	<?php if ($conf->global->MAIN_MENU_INVERT) { ?>
		font-size: 40px !important;
		height: 40px;
		line-height: 40px;
	<?php } else { ?>
		font-size: 54px !important;
		height: 54px;
		line-height: 54px;
	<?php } ?>
}

#tmenu_tooltipinvert {
	<?php if (GETPOST("optioncss") == 'print') { ?>
	display: none;
	<?php } else { ?>
	display: inline-table;
	overflow: auto;
	width: 100%;
	background-color: <?php print $bgnavleft; ?>;
	<?php if ( $usecss3 ) { ?>
		<?php if ( $conf->global->OBLYON_STICKY_TOPBAR ) { ?>
		box-shadow: 0 1px 2px rgba(0, 0, 0, .4) !important; 
		-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .4) !important;
		-webkit-animation: fade 500ms;
		<?php } ?>
	transition: max-height .2s ease-in-out;
	-moz-transition: max-height .2s ease-in-out;
	-webkit-transition: max-height .2s ease-in-out;
	<?php } ?>
	max-height: 40px;
	<?php print $left; ?>: 0;
	margin: 0;
	padding-<?php print $right; ?>: 160px;
	z-index: 95;
	<?php if ($conf->global->OBLYON_STICKY_TOPBAR) { ?>
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
	<?php } else { ?>
		position: relative;
	<?php } ?>
	<?php } ?>
}

#tmenu_tooltipinvert:hover {
	max-height: 400px;
}

.sec-nav.is-inverted {
	display: inline-block;
	<?php if( !$conf->global->OBLYON_FULLSIZE_TOPBAR && !$conf->global->OBLYON_SHOW_COMPNAME && !$conf->global->OBLYON_HIDE_LEFTMENU && !$conf->dol_optimize_smallscreen ) { ?>
		margin-<?php print $left; ?>: 200px;
	<?php } else { ?>
		margin-<?php print $left; ?>: 10px;
	<?php } ?>
}

.sec-nav.is-inverted .sec-nav__item.item-heading,
.sec-nav.is-inverted .sec-nav__item.is-disabled {
	background-color: <?php print $bgnavleft; ?>;
	float: <?php print $left; ?>;
	position: relative; 
	padding: 0;
	z-index: 40;
}

.sec-nav.is-inverted .sec-nav__item.item-heading:hover {
	background-color: <?php print $bgnavleft_hover; ?>;
}

.sec-nav.is-inverted .sec-nav__link {
	font-size: 13px;
	white-space: nowrap;
}

.sec-nav.is-inverted .sec-nav__link:hover,
.sec-nav.is-inverted .sec-nav__link:focus {
	color: <?php print $maincolor; ?>;
}

.sec-nav.is-inverted .sec-nav__item.item-heading > .sec-nav__link,
.sec-nav.is-inverted .sec-nav__item.is-disabled > .sec-nav__link {
	display: block;
	line-height: 40px;
	<?php if ( $conf->global->OBLYON_HIDE_TOPICONS || $conf->global->OBLYON_ELDY_ICONS || $conf->global->OBLYON_ELDY_OLD_ICONS ) { ?>
	font-weight: 500;
	<?php } else { ?>
	font-weight: normal;
	<?php } ?>
	padding: 0 8px;	
}

.sec-nav.is-inverted .sec-nav__item.is-disabled > .sec-nav__link {
	cursor: not-allowed;
}

li.item-heading:hover > .sec-nav__link {
	background-color: <?php print $bgnavleft_hover; ?>;
	color: <?php print $bgnavleft_txt; ?>;
}

li.sec-nav__sub-item {
	color: <?php print $bgnavleft_txt; ?>;
}

.caret {
	content: '';
	color: inherit;
	display: inline-block;
	height: 0;
	vertical-align: baseline;
	width: 0;
	padding-bottom: 2px;
}

.caret--top {
	border-top: 4px solid #eee;
	border-right: 4px solid transparent;
	border-left: 4px solid transparent;
}

.caret--left {
	border-top: 4px solid transparent;
	border-bottom: 4px solid transparent;
	border-left: 4px solid #eee;
	margin-right: .1em;
}

.caret--right {
	border-top: 4px solid transparent;
	border-bottom: 4px solid transparent;
	border-right: 4px solid #eee;
	margin-left: .1em;
}

.sec-nav.is-inverted li.item-heading:hover .caret--top {
	border-top-color: <?php print $maincolor; ?>;
}
 
.sec-nav__sub-list .item-level2:hover .caret--left {
	border-left-color: <?php print $maincolor; ?>;
}

.sec-nav__sub-list .item-level2:hover .caret--right {
	border-right-color: <?php print $maincolor; ?>;
}


/**
 * Submenus
 */

.sec-nav.is-inverted .sec-nav__sub-list { 
	background-color: <?php print $bgnavleft; ?>;
	box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.055);
	display: none;
	opacity: 0;
	padding-top: 0;
	padding-bottom: 5px;
	padding-inline-start: 0;
	-webkit-transiton: opacity 0.2s;
	-moz-transition: opacity 0.2s;
	-ms-transition: opacity 0.2s;
	-o-transition: opacity 0.2s;
	-transition: opacity 0.2s;
}

.sec-nav.is-inverted .sec-nav__item:hover .sec-nav__sub-list { 
	display: block;
	position: absolute;
	opacity: 1;
	visibility: visible;
}

.sec-nav.is-inverted .sec-nav__sub-item {
	float: none;
	padding: 0;
}

.sec-nav.is-inverted .sec-nav__sub-list .item-level1 .sec-nav__link {
	display: block;
	padding: 0.6em 1em;
	
}

.sec-nav.is-inverted .sec-nav__sub-list .item-level2 .sec-nav__link {
	display: block;
	padding: 0.5em 1.2em;
}

.sec-nav.is-inverted .sec-nav__link.is-disabled {
	display: block;
	padding: 0.6em 1em;
}


/**
 * Login Block
 */
div.login_block {
	<?php if ($conf->global->MAIN_MENU_INVERT) { ?>
	    background-color: <?php print $bgnavleft; ?>;
	    height: 40px;
	<?php } else { ?>
	    background-color: <?php print $bgnavtop; ?>;
	    height: 54px;
	<?php } ?>
	    padding-right: 20px;
	<?php if ( $conf->global->OBLYON_STICKY_TOPBAR ) { ?>
		position: fixed;
	<?php } else { ?>
		position: absolute;
	<?php } ?>
	top: 0;
	<?php print $right; ?>: 0px;
	z-index: 100;
	<?php if (GETPOST("optioncss") == 'print') { ?>
		display: none;
	<?php } ?>
}

div.login_block:after {
	content: '\e614';
	color: <?php print $bgnavtop_txt; ?>;
	font-family: 'oblyon-icons' !important;
	font-size: 20px;
	<?php if ($conf->global->MAIN_MENU_INVERT) { ?>
		line-height: 40px;
	<?php } else { ?>
		line-height: 55px;
	<?php } ?>
}

div.login_block:hover:after {
	color: <?php print $maincolor; ?>;
}

div.login_block_user{
	clear: left;
	float: <?php print $left; ?>;
	margin-right: 15px;
}

div.login_block_user .login a,
div.login_block_user a {
	display: table-cell;
	<?php if ( $conf->global->MAIN_MENU_INVERT ) { ?>
		font-size: 13px;
	<?php } ?>
	font-family: <?php print $fontmainmenu; ?>;
	font-weight: 500;
	<?php if ($conf->global->MAIN_MENU_INVERT) { ?>
		height: 40px;
	<?php } else { ?>
		height: 54px;
	<?php } ?>
	max-width: 150px;
	overflow: hidden;
	padding: 0 10px;
	text-overflow: ellipsis;
	<?php if ($usecss3) { ?>
		transition: all .2s ease-in-out;
		-moz-transition: all .2s ease-in-out;
		-webkit-transition: all .2s ease-in-out;
	<?php } ?>
	vertical-align: middle;
}

div.login_block_user > .classfortooltip.login_block_elem2 {
	<?php if ($conf->global->MAIN_MENU_INVERT) { ?>
		height: 40px;
	<?php } else { ?>
		height: 54px;
	<?php } ?>
}

.login_block_other {
	<?php if ($conf->global->MAIN_MENU_INVERT) { ?>
	background: <?php print $bgnavleft; ?>;
	<?php } else { ?>
	background: <?php print $bgnavtop; ?>;
	<?php } ?>
	display: none;
	position: absolute;
	right: 0;
	<?php if ($conf->global->MAIN_MENU_INVERT) { ?>
		top: 40px;
	<?php } else { ?>
		top: 54px;
	<?php } ?>
	height: 42px;
	line-height: 40px;
	margin-right: 10px;
	<?php if ( empty($conf->dol_optimize_smallscreen) ) { ?>
		min-width: 120px;
	<?php } else { ?>
		min-width: 80px;
	<?php } ?>
	
	<?php if ( $usecss3) { ?>
	box-shadow: -2px 2px 2px 0px rgba(0, 0, 0, .4);
	-webkit-box-shadow: -2px 2px 2px 0px rgba(0, 0, 0, .4);
	border-radius: 0 0 5px 5px;
	<?php } ?>
}

.login_block_other .inline-block {
	width: 40px;
	
	<?php if ( $usecss3) { ?>
	border-radius: 0 0 5px 5px;
	<?php } ?>
}

.login_block:hover > .login_block_other {
	display: block;
}

.login_block_user a img.loginphoto {
	display: none;
}

.login_block_elem {
	float: <?php print $left; ?>;
	<?php if ($conf->global->MAIN_MENU_INVERT) { ?>
	background-color: <?php print $bgnavleft; ?>;
	<?php } else { ?>
	background-color: <?php print $bgnavtop; ?>;
	<?php } ?>
	padding: 0;
	height: 40px;
}

.login_block_elem.classfortooltip {
	margin: 0;
}

.login_block_elem a,
.login_block td.classfortooltip a {
	<?php if ($conf->global->MAIN_MENU_INVERT) { ?>
	color: <?php print $bgnavleft_txt; ?>;
	<?php } else { ?>
	color: <?php print $bgnavtop_txt; ?>;
	<?php } ?>
	display: block;
	font-family: <?php print $fontmainmenu; ?>;
	height: 40px;
	line-height: 40px;
	padding: 0 10px;
	text-decoration: none;
	<?php if ($usecss3) { ?>
		transition: all .2s ease-in-out;
		-moz-transition: all .2s ease-in-out;
		-webkit-transition: all .2s ease-in-out;
	<?php } ?>
	<?php if ($conf->global->MAIN_MENU_INVERT) { ?>
		font-size: 16px;
	<?php } else { ?> 
		font-size: 18px;
	<?php } ?>
}

.login_block_elem a:hover,
.login_block td.classfortooltip a:hover {
	color: <?php echo $topmenu_hover; ?>;
}

/*
.login_block_user .login_block_elem a.atoplogin:before { 
	<?php if ($conf->global->OBLYON_ELDY_ICONS || $conf->global->OBLYON_ELDY_OLD_ICONS) { ?>
		content: '';
	<?php } else { ?>
		content: "\e900";
	<?php } ?>
	font-family: 'oblyon-icons';
	margin-right: 2px;
	speak: none;
	vertical-align: middle;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}

.login_block_other a.help:before { 
	<?php if ($conf->global->OBLYON_ELDY_ICONS || $conf->global->OBLYON_ELDY_OLD_ICONS) { ?>
		content: '';
	<?php } else { ?>
		content: '\e901';
	<?php } ?>
	font-family: 'oblyon-icons';
	speak: none;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}

.login_block_elem a[href*=logout]:before,
.login_block td.classfortooltip a[href*=logout]:before { 
	<?php if ($conf->global->OBLYON_ELDY_ICONS || $conf->global->OBLYON_ELDY_OLD_ICONS) { ?>
		content: '';
	<?php } else { ?>
		content: '\e641b';
	<?php } ?>
	font-family: 'oblyon-icons';
	speak: none;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}

.login_block_elem a[href*="optioncss=print"]:before,
.login_block td.classfortooltip a[href*="optioncss=print"]:before {
	<?php if ($conf->global->OBLYON_ELDY_ICONS || $conf->global->OBLYON_ELDY_OLD_ICONS) { ?>
		content: '';
	<?php } else { ?>
		content: '\e640';
	<?php } ?>
	font-family: 'oblyon-icons';
	speak: none;
}
*/
.atoplogin #dropdown-icon-down, .atoplogin #dropdown-icon-up {
    font-size: 0.7em;
}

.login_block_elem img.printer,
.login_block_elem img.login,
.login_block_elem img.help,
.login_block td.classfortooltip img.printer,
.login_block td.classfortooltip img.login,
.login_block td.classfortooltip img.help { 
	<?php if (!$conf->global->OBLYON_ELDY_ICONS && !$conf->global->OBLYON_ELDY_OLD_ICONS) { ?>
		display: none;
	<?php } ?>
	vertical-align: baseline;
}

img.login, img.printer, img.help, img.entity {
	/* padding: 0px 0px 0px 4px; */
	/* margin: 0px 0px 0px 8px; */
	text-decoration: none;
	color: white;
	font-weight: bold;

}

.userimgatoplogin img.userphoto, .userimgatoplogin img.userphoto {		/* size for user photo in login bar */
	border-radius: 8px;
	width: 16px;
	height: 16px;
	background-size: contain;
	vertical-align: text-bottom;
	background-color: #FFF;
}
img.userphoto {				/* size for user photo in lists */
	border-radius: 9px;
	width: 18px;
	height: 18px;
	background-size: contain;
	vertical-align: middle;
}

img.userphotosmall {		/* size for user photo in lists */
	border-radius: 6px;
	width: 12px;
	height: 12px;
	background-size: contain;
	vertical-align: middle;
}

.span-icon-user {
	background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/object_user.png',1); ?>);
	background-repeat: no-repeat;
}

.span-icon-password {
	background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/lock.png',1); ?>);
	background-repeat: no-repeat;
}

/*
.span-icon-user input, .span-icon-password input {
	margin-right: 30px;
}
*/

.login_block td.classfortooltip { height: 40px; }

.login_block .classfortooltip:hover, 
.login_block .classfortooltip:focus {
	<?php if ($conf->global->MAIN_MENU_INVERT) { ?>
	background-color: <?php print $bgnavleft_hover; ?>;
	<?php } else { ?>
	background-color: <?php print $bgnavtop_hover; ?>;
	<?php } ?>
}

div.login_block table { display: inline; }

/* db inf v3.5 */
td div.login {
	white-space: nowrap;
	padding: 0;
	margin: 0;
	font-weight: bold;
	color: #f4f4f4;
}

div.login a,
div.login_block_user a {
	color: #f4f4f4;
	font-size: 13px;
}

div.login a:hover {
	color: <?php print $maincolor; ?>;
	text-decoration: inherit;
}

.alogin {
	font-weight: normal !important;
	font-size: <?php echo $fontsizesmaller; ?>px !important;
}

.alogin:hover {
	text-decoration: underline !important;
	color: <?php print $maincolor; ?> !important;
}


/*------------------------------------*\
		#Left Menu
\*------------------------------------*/

/**
 * Company Name
 */

.db-menu__society {
	margin: 0; 
	padding: 0;
}

.db-menu__society h1 {
	color: #fff;
	font-size: 1.5em;
	font-weight: bold;
	margin: 0;
	overflow: hidden;
	text-overflow: ellipsis;
}

.vmenu .db-menu__society {
	padding: 10px 0;
}


/**
 * Logo Block
 */
 
.db-menu__logo {
	background-color: <?php print $logo_background_color ?>;
	<?php if ($conf->global->OBLYON_LOGO_PADDING == "padding") { ?>
		padding: 10px;
	max-height: 180px;
	<?php } else { ?>
		padding: 0;
	max-height: 200px;
	<?php } ?>
}

.db-menu__logo__link {
		display: block;
		<?php if(! empty($conf->global->OBLYON_COLOR_LOGO_BCKGRD)) { ?>
		background: <?php print $logo_background_color; ?>;
	<?php } else { ?>
		background: #FFF;
		<?php } ?>
		margin: 0;
}

.db-menu__logo__img { 
	<?php if ($conf->global->OBLYON_LOGO_PADDING == "padding") { ?>
		max-height: 140px;
	<?php } else { ?>
		max-height: 120px;
	<?php } ?>
	<?php if ($conf->global->OBLYON_LOGO_SIZE ) { ?>
		height: 80px;
	<?php } else { ?>
		height: auto;
	<?php }	?>
	max-width: 100%;
	width: auto;
}


/**
 * Secondary Navigation
 */
 
.sec-nav__list {
	list-style: none;
	margin: 0;
	padding: 0;
}
 
.sec-nav__item {
	 display: block;
}

.vmenu .sec-nav__item.item-heading > .sec-nav__link {
	background-color: <?php print $bgnavleft_hover; ?>;
	font-weight: bold;
	display: block;
	line-height: 1em;
	padding: 10px;
	<?php if ( $conf->global->OBLYON_HIDE_LEFTICONS || $conf->global->OBLYON_ELDY_ICONS || $conf->global->OBLYON_ELDY_OLD_ICONS ) { ?>
		font-weight: 500;
	<?php } ?>
}

.sec-nav { color: <?php print $bgnavleft; ?>; }

.sec-nav .sec-nav__link { 
	color: <?php print $bgnavleft_txt; ?>;
	font-size: <?php print $fontsize; ?>px; 
	font-family: <?php print $fontsecmenu; ?>;
	font-weight: normal;
	text-align: <?php print $left; ?>; 
	text-decoration: none;
	<?php if ($usecss3) { ?>
		transition: all .2s ease-in-out;
		-moz-transition: all .2s ease-in-out;
		-webkit-transition: all .2s ease-in-out;
	<?php } ?>
}

.sec-nav .sec-nav__link:hover,
.sec-nav .sec-nav__link:focus {
	color: <?php print $maincolor; ?>;
}
 
.vmenu .sec-nav__item.item-heading { 
	margin-bottom: 15px;
}

.sec-nav__sub-list { 
	background-color: <?php print $bgnavleft; ?>;
	padding-top: 5px;
	padding-inline-start: 1.5em;
}

.sec-nav__sub-list .item-level1 {
	padding: 0.3em 0.8em;
}

.sec-nav__sub-list .item-level2 {
	padding: 0.2em 1em;
}

.sec-nav__sub-item.is-disabled {
	opacity: .6;
	padding: 0.3em 0.8em;
}

.sec-nav .sec-nav__link.is-disabled {
	cursor: not-allowed;
}

 
 /**
 * Main Navigation
 */
 
.main-nav.is-inverted .main-nav__link {
	line-height: 40px;
	<?php if ( $conf->global->OBLYON_HIDE_LEFTICONS ) { ?>
		padding-<?php print $left; ?>: 10px;
		font-weight: 500;
	<?php } ?>
    overflow: hidden;
    text-overflow: ellipsis;
}

.main-nav.is-inverted { 
	font-size: 14px;
}


/**
 * Search Block
 */

.blockvmenusearch {
	<?php if ( $conf->global->MAIN_MENU_INVERT ) { ?>
	background-color: <?php print $bgnavtop; ?>;
	border-bottom: 1px solid <?php print $bgnavtop_hover; ?>;
	<?php } else { ?>
	background-color: <?php print $bgnavleft; ?>;
	border-bottom: 1px solid <?php print $bgnavleft_hover; ?>;
	<?php } ?>
	box-shadow: 0 0 1px rgba(0,0,0, .04);
	-webkit-box-shadow: 0 0 1px rgba(0,0,0, .04);
	clear: both;
	padding: 10px;
	text-decoration: none;
}

.blockvmenusearch .menu_titre {
	margin: 8px 0 1px 0;
}

.blockvmenusearch a:link, 
.blockvmenusearch a:visited, 
.blockvmenusearch a:active {
	color: #eee;
	font-family: <?php print $fontmenusearch; ?>;
	font-size:<?php print $fontsize; ?>px;
	text-align: <?php print $left; ?>;
}

.blockvmenusearch a:hover { color: <?php print $maincolor; ?>; }


/**
 * Bookmarks Block
 */

 .blockvmenubookmarks {
	<?php if ( $conf->global->MAIN_MENU_INVERT ) { ?>
	background-color: <?php print $bgnavtop; ?>;
	border-bottom: 1px solid <?php print $bgnavtop_hover; ?>;
	<?php } else { ?>
	background-color: <?php print $bgnavleft; ?>;
	border-bottom: 1px solid <?php print $bgnavleft_hover; ?>;
	<?php } ?>
	box-shadow: 0 0 1px rgba(0,0,0, .04);
	-webkit-box-shadow: 0 0 1px rgba(0,0,0, .04);
	clear: both;
	padding: 10px;
	text-decoration: none;
}

.blockvmenubookmarks .menu_titre {
	margin: 8px 0 1px 0;
	text-align: <?php print $left; ?>; 
}

.blockvmenubookmarks .menu_titre a { font-size: 13px; }

.blockvmenubookmarks .menu_titre img:hover {
	background-image: url(img/object_bookmark_full.png);
}

.blockvmenubookmarks .menu_contenu {
	max-width: 116px;
	overflow: hidden;
	padding: 2px 6px;
	text-overflow: ellipsis;
}

.blockvmenubookmarks a:link, 
.blockvmenubookmarks a:visited, 
.blockvmenubookmarks a:active{
	color: <?php echo $colorfline; ?>;
	font-family: <?php print $fontmenubookmarks; ?>;
	font-size:<?php print $fontsize; ?>px;
}

.blockvmenubookmarks a.vmenu:link, 
.blockvmenubookmarks a.vmenu:visited { color: <?php echo $colorfline; ?>; }

.blockvmenubookmarks a.vmenu:hover,
.blockvmenubookmarks a.vsmenu:hover { color: <?php print $maincolor; ?>; }


/**
 * Help Block
 */

.blockvmenuhelp {
<?php if (empty($conf->dol_optimize_smallscreen)) { ?>
	background-color: <?php print $bgcolor ?>;
	color: <?php print $maincolor ?>;
	font-family: <?php print $fontmenuhelp; ?>;
	margin: 0;
	text-align: center;
<?php } else { ?>
	display: none;
<?php } ?>
}

.blockvmenuhelp a {
	font-family: <?php print $fontmenuhelp; ?>;
	font-size: <?php print $fontsize; ?>px;
	display: inline-block;
}

.blockvmenuhelp a.help:link, 
.blockvmenuhelp a.help:visited, 
.blockvmenuhelp a.help:active { 
	color: <?php echo $colorfline; ?>; 
	font-size: <?php print $fontsizesmaller; ?>px; 
	font-weight: normal; 
	text-align: <?php print $left; ?>;
	text-decoration: none;
}

.blockvmenuhelp a:hover {
	color: <?php print $maincolor; ?> !important;
}

.blockvmenuhelp a[href*="http://www.dolibarr."] {
	padding: 15px 0 5px;
	font-size: 15px;
}

.blockvmenuhelp a.help img {
	vertical-align: top;
}

.blockvmenuhelp:last-child {	
	padding: 10px 0 10px 0;
}

/*------------------------------------*\
		#Pushy Left Menu
\*------------------------------------*/

#id-left {
	<?php if ( $conf->global->OBLYON_HIDE_LEFTMENU || $conf->dol_optimize_smallscreen ) { ?>
		position: absolute;
		<?php if ( empty($conf->global->OBLYON_STICKY_TOPBAR) && $conf->global->OBLYON_EFFECT_LEFTMENU == "push" ) { ?>
			top: 0;
		<?php } else { ?>
			<?php if ( $conf->global->MAIN_MENU_INVERT ) { ?>
				top: 40px;
			<?php } else { ?>
				top: 54px;
			<?php } ?>
		<?php } ?>

		background-color: <?php print $bgnavleft; ?>;
		<?php if ( $usecss3) { ?>
			box-shadow: 0 1px 2px rgba(0, 0, 0, .4); 
			-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .4);
		<?php } ?>
		max-width: 265px;
		overflow: hidden;
		-webkit-overflow-scrolling: touch;
		<?php if ( $conf->global->OBLYON_EFFECT_LEFTMENU == "push" && $usecss3 ) { ?>
			<?php print $left; ?>: 0;
			
			-webkit-transform: translate3d(-265px,0,0);
			-moz-transform: translate3d(-265px,0,0);
			-ms-transform: translate3d(-265px,0,0);
			-o-transform: translate3d(-265px,0,0);
			transform: translate3d(-265px,0,0);
		<?php } else { ?>
			<?php print $left; ?>: -270px;
		<?php } ?>
	<?php } ?>
}

<?php if ( $conf->global->OBLYON_HIDE_LEFTMENU || $conf->dol_optimize_smallscreen ) { ?>
#id-left, #id-container, .push {
	<?php if ( $conf->global->OBLYON_EFFECT_LEFTMENU == "push" ) { ?>
		-webkit-transition: -webkit-transform .3s cubic-bezier(.16, .68, .43, .99);
		-moz-transition: -moz-transform .3s cubic-bezier(.16, .68, .43, .99);
		-o-transition: -o-transform .3s cubic-bezier(.16, .68, .43, .99);
		transition: transform .3s cubic-bezier(.16, .68, .43, .99);
	<?php } else { ?>
		-webkit-transition: all 0.3s ease;
		-moz-transition: all 0.3s ease;
		transition: all 0.3s ease;
	<?php } ?>
}

.container-push {
	<?php if ( $conf->global->OBLYON_EFFECT_LEFTMENU == "push" ) { ?>
		-webkit-transform: translate3d(265px,0,0);
		-moz-transform: translate3d(265px,0,0);
		-ms-transform: translate3d(265px,0,0);
		-o-transform: translate3d(265px,0,0);
		transform: translate3d(265px,0,0);
	<?php } ?>
}

/** 
 * Coming Feature: OVERLAY when LEFTMENU hidden
 */
/*.pushy-active .site-overlay {
	display: block;
	position: fixed;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	z-index: 99;
	background-color: rgba(0,0,0,0.5);
	-webkit-animation: fade 500ms;
	-moz-animation: fade 500ms;
	-ms-animation: fade 500ms;
	-o-animation: fade 500ms;
	animation: fade 500ms;
}*/

.pushy-active {
	-webkit-animation: fade 500ms;
	-moz-animation: fade 500ms;
	-ms-animation: fade 500ms;
	-o-animation: fade 500ms;
	animation: fade 500ms;
	overflow-x: hidden;
	overflow-y: auto;
	height: 100%;
}

.pushy-open {
	<?php if ( $conf->global->OBLYON_EFFECT_LEFTMENU == "push" ) { ?>
		-webkit-transform: translate3d(0,0,0);
		-moz-transform: translate3d(0,0,0);
		-ms-transform: translate3d(0,0,0);
		-o-transform: translate3d(0,0,0);
		transform: translate3d(0,0,0);
	<?php } else { ?>
		<?php print $left; ?>: 0 !important;
	<?php } ?>
}

/** 
 * Coming Feature: OVERLAY when LEFTMENU hidden
 */
/*
<?php if ( $conf->global->OBLYON_OVERLAY_LEFTMENU ) { ?>
#id-right::after {
	background: rgba(0,0,0,0.3);
		 display: none;
	opacity: 0; 
	position: fixed;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
	z-index: 1;
	width: 100%;
	height: 100%;
	-webkit-transform: translate3d(100%,0,0);
	transform: translate3d(100%,0,0);
	-webkit-transition: opacity 0.3s, -webkit-transform 0s 0.3s;
	transition: opacity 0.3s, transform 0s 0.3s;
}

.pushy-active #id-right::after {
	opacity: 1;
	display: block;
	-webkit-transition: opacity 0.3s;
	transition: opacity 0.3s;
	-webkit-transform: translate3d(0,0,0);
	transform: translate3d(0,0,0);
}
<?php } ?>
*/


.pushy-btn {
	background-color: <?php print $bgnavtop; ?>;
	color: <?php print $bgnavtop_txt; ?>;
	color: #eee;
	display: inline-block;
	float: <?php print $left; ?>;
	font-size: 24px;
	height: 54px;
	line-height: 54px;
	padding: 0 10px;
	cursor: pointer;
}

.pushy-btn:hover {
	background-color: <?php print $bgnavtop_hover; ?>;
	color: <?php print $maincolor; ?>;
}

.pushy-active .pushy-btn {
	background-color: <?php print $bgnavtop_hover; ?>;
	color: <?php print $maincolor; ?>;
}

<?php } ?> /* end HIDE_LEFTMENU */


/*------------------------------------*\
		#Oblyon Main and Sec Nav Icons
\*------------------------------------*/

.main-nav .icon {
	<?php if ( $conf->global->OBLYON_HIDE_TOPICONS && !$conf->global->MAIN_MENU_INVERT ) { ?>
		display: none;
	<?php } else { ?>
		display: block;
	<?php } ?>
	float: none;
	height: 34px;
	line-height: 36px;
	min-width: 40px;
	position: relative;
}

.main-nav.is-inverted .icon {
	<?php if ($conf->global->OBLYON_HIDE_LEFTICONS) { ?>
		display: none;
	<?php } ?>
	float: <?php print $left; ?>;
	height: 40px;
	line-height: 40px;
	margin: 0;
	position: relative;
	text-align: center;
	width: 40px;
}

.main-nav .icon {
	font-size: 20px;
}

.sec-nav .icon {
	<?php if ( !$conf->global->MAIN_MENU_INVERT && $conf->global->OBLYON_HIDE_LEFTICONS || $conf->global->OBLYON_ELDY_ICONS || $conf->global->OBLYON_ELDY_OLD_ICONS ) { ?>
	 
		display: none;
	<?php } ?>
	float: <?php print $left; ?>;
	margin-<?php print $right; ?>: 5px;
}

.sec-nav.is-inverted .icon {
	<?php if ( $conf->global->OBLYON_HIDE_TOPICONS || $conf->global->OBLYON_ELDY_ICONS || $conf->global->OBLYON_ELDY_OLD_ICONS ) { ?>
		display: none;
	<?php } ?>
	height: 40px;
	line-height: 40px;
}

.sec-nav .icon {
	font-size: 14px;
}


.mainmenu.accounting { 
	background: none !important;
}


@font-face {
	font-family: 'oblyon-icons';
		src: url('fonts/oblyon-icons.eot?vej59r');
		src: url('fonts/oblyon-icons.eot?vej59r#iefix') format('embedded-opentype'),
		url('fonts/oblyon-icons.ttf?vej59r') format('truetype'),
		url('fonts/oblyon-icons.woff?vej59r') format('woff'),
		url('fonts/oblyon-icons.svg?vej59r#oblyon-icons') format('svg');
		font-weight: normal;
		font-style: normal;
}

.icon {
	/* use !important to prevent issues with browser extensions that change fonts */
	font-family: 'oblyon-icons' !important;
	font-style: normal;
	font-variant: normal;
	font-weight: normal;
	line-height: 1;
	speak: none;
	text-transform: none;

	/* Better Font Rendering =========== */
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}


.icon--home:before {
	content: '\e602';
}

.icon--ftp:before {
	content: '\e603';
}

.icon--contracts:before {
	content: '\e604';
}

.icon--commercial:before {
	content: '\e606';
}

.icon--cat:before,
.icon--tags:before {
	content: '\e607';
}

.icon--externalsite:before {
	content: '\e608';
}

.icon--websites:before, .icon--website:before {
	content: '\e608';
}

.icon--filemanager:before {
	content: '\e609';
}

.icon--members:before {
	content: '\e60a';
}

.icon--subscriptions:before {
	content: '\e60b';
}

.icon--tools:before {
	content: '\e60b';
}

.icon--geopipmaxmind:before {
	content: '\e60c';
}

.icon--gravatar:before {
	content: '\e601';
}

.icon--cashdesk:before,
.icon--shop:before,
.icon--orders:before,
.icon--orders_suppliers:before {
	content: '\e60d';
}

.icon--margins:before {
	content: '\e60e';
}
.icon--project:before,
.icon--projects:before {
	content: '\e60f';
}
.icon--tasks:before {
	content: '\e62d';
}

.icon--product:before,
.icon--products:before {
	content: '\e610';
}

.icon--companies:before,
.icon--thirdparties:before {
	content: '\e611';
}

.icon--billing:before {
	content: '\e625';
}

.icon--accountancy:before,
.icon--accounting:before {
	content: '\e612';
}

.icon--bank:before {
	content: '\e613';
}

.icon--hrm:before,
.icon--holiday:before {
	content: '\e616';
}

.icon--service:before {
	content: '\e617';
}

.icon--withdraw:before {
	content: '\e618';
}

.icon--agenda:before {
	content: '\e619';
}

.icon--ecm:before {
	content: '\e61a';
}

.icon--checks:before {
	content: '\e61b';
}

.icon--click2dial:before {
	content: '\e61d';
}

.icon--paypal:before {
	content: '\e61e';
}

.icon--stripe:before {
	content: '\e61b'; /* TO DO : Add icon Stripe in oblyon-icons.eot */
}

.icon--google:before {
	content: '\e61f';
}

.icon--webservices:before {
	content: '\e620';
}

.icon--contacts:before {
	content: '\e622';
}

.icon--sendings:before {
	content: '\e623';
}

.icon--ficheinter:before {
	content: '\e624';
}

.icon--tax:before {
	content: '\e625';
}

.icon--donations:before {
	content: '\e626';
}

.icon--ca:before {
	content: '\e627';
}

.icon--mailing:before,
.icon--email_templates:before {
	content: '\e628';
}

.icon--export:before {
	content: '\e629';
}

.icon--import:before,
.icon--accountancy_transfer:before {
	content: '\e62a';
}

.icon--propals:before {
	content: '\e62c';
}

.icon--suppliers_bills:before {
	content: '\e62e';
}

.icon--customers_bills:before {
	content: '\e630';
}

.icon--stock:before {
	content: '\e631';
}

.icon--tripsandexpenses:before, 
.icon--expensereport:before {
	content: '\e632';
}

.icon--opensurvey:before {
	content: '\e62d';
}

/* Login Icons */
/*
.icon--printer:before {
	content: '\e640';
}

.icon--log-out:before {
	content: '\e641b';
}

.icon--exit:before {
	content: '\e641';
}

.icon--loginphoto:before {
	content: "\e900";
}
.icon--help:before {
	content: "\e901";
}
*/

/* Secondary Nav */
.icon--setup:before,
.icon--accountancy_admin:before {
	content: '\e615';
}

.icon--admintools:before {
	content: '\e614';
}

.icon--modulesadmintools:before {
	content: '\e621';
}

.icon--users:before {
	content: '\e600';
}

/* External modules */
.icon--cron:before {
	content: '\e62f';
}

.icon--scanner:before {
	content: '\e61c';
}

.icon--bittorrent:before {
	content: '\e62b';
}

.icon--reports:before {
	content: '\e605';
}

.icon--email_templates:before {
    content: '\e628';
}

/* Generic modules */
.icon--generic:before {
	content: '\e902';
}

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
	<?php if (GETPOST("optioncss") == 'print') {	?>
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
	<?php if ($usecss3) { ?>
		transition: all .2s ease-in-out;
		-moz-transition: all .2s ease-in-out;
		-webkit-transition: all .2s ease-in-out;
	<?php } ?>
}

#tmenu_tooltip li.tmenu, 
#tmenu_tooltip li.tmenusel {
	display: block;
	float: <?php print $left; ?>;
	position: relative;
	<?php if ( $conf->global->OBLYON_HIDE_TOPICONS ) { ?>
		height: 54px;
		line-height: 54px;
	<?php } else { ?>
		height: 54px;
		min-width: <?php print $minwidthtmenu; ?>px;
	<?php } ?>
}

li.tmenusel {
	background-color: <?php print $maincolor; ?>;
	color: #fff;
}

li.tmenu:hover {
	background-color: <?php print $bgnavtop_hover; ?>;
	color: <?php print $topmenu_hover; ?>;
}

#tmenu_tooltip li.tmenu {
	background-color: <?php print $bgnavtop; ?>;
}

#tmenu_tooltip li.tmenu:hover {
	background-color: <?php print $bgnavtop_hover; ?>;
}


/* Liens menu vertical */

div.tmenudisabled,
a.tmenudisabled {
	cursor: not-allowed;
	opacity: .6;
}

a.tmenu:link, 
a.tmenu:visited, 
a.tmenu:active,
a.tmenudisabled {
	color: #eee;
	display: block;
	font-weight: normal;
	padding: 0 5px;
	text-decoration: none;
	white-space: nowrap; 
}

a.tmenu:hover, a.tmenu:active {
	color: <?php print $maincolor; ?> !important;
	margin: 0;
}

a.tmenuimage:hover + a.tmenu {
	color: <?php print $maincolor; ?> !important;
}

.tmenu li a, 
.tmenu:visited li a, 
.tmenu:hover li a {
	font-weight: normal;
}

a.tmenusel:hover, 
a.tmenusel:active {
	color: #fff;
	font-weight: bold !important;
}

li.tmenusel a,
li.tmenusel a:hover,
li.tmenusel a:active,
li.tmenusel a:link {
	color: #fff!important;
	font-weight: bold!important;
}

li.tmenuend {
	display: none;
}

div.tmenuleft {
	float: <?php print $left; ?>;
	height: <?php print $heightmenu+4; ?>px;
	margin-top: -4px;
}

div.tmenucenter {
	<?php if ( $conf->global->MAIN_MENU_INVERT ) { ?>
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
	if ( $conf->global->OBLYON_HIDE_LEFTICONS ) {	?>
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

.blockvmenupairinvert {
	margin: 0;
	padding: 0;
	position: relative;
}

#tmenu_tooltipinvert div.menu_titre {
	float: <?php print $left; ?>;
}

#tmenu_tooltipinvert a.vmenu {
	color: #eee;
	display: block;
	font-size: 13px;
	line-height: 40px;
	padding: 0 9px;
	<?php if ($usecss3) { ?>
		transition: all .2s ease-in-out;
		-moz-transition: all .2s ease-in-out;
		-webkit-transition: all .2s ease-in-out;
	<?php } ?>
}

#tmenu_tooltipinvert div.menu_contenu {
	display: none; /* @bug improve display lev 1 and 2 */
}

#tmenu_tooltipinvert div.menu_titre:hover {
	background-color: <?php print $bgnavleft_hover; ?>;
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
 * Logo Block
 */
 
#menu_contenu_logo {
	background-color: #eee; /* add option */
	<?php if ($conf->global->OBLYON_LOGO_PADDING == "padding") { ?>
		padding: 10px;
	<?php } else { ?>
		padding: 0;
	<?php } ?>
}

#menu_contenu_logo a {
	display: block;
	margin: 0 !important;
}


/**
 * Secondary Navigation
 */

div.vmenu {
	<?php if ( $conf->global->MAIN_MENU_INVERT ) { ?>
	background-color: <?php print $bgnavtop; ?>;
	<?php } else { ?>
	background-color: <?php print $bgnavleft; ?>;
	<?php } ?>
	float: <?php print $left; ?>;
	margin-<?php print $right; ?>: 0;
	padding: 0;
	padding-bottom: 0;
	position: relative;
	z-index: 5;
	<?php if (empty($conf->dol_optimize_smallscreen)) { ?>
		min-width: 200px;
		max-width: 260px;
		<?php if ( $conf->global->OBLYON_HIDE_LEFTMENU || $conf->dol_optimize_smallscreen ) { ?>
			width: 260px;
		<?php } else { ?>
			width: 100%;
		<?php } ?>
	<?php } ?>	
}

.vmenu {
	<?php if (GETPOST("optioncss") == 'print') { ?>
		display: none;
	<?php } ?>
}
	
.vmenu .blockvmenupair div.menu_titre, 
.vmenu .blockvmenuimpair div.menu_titre {
	display: block;
}

.vmenu .blockvmenupair div.menu_titre a, 
.vmenu .blockvmenuimpair div.menu_titre a {
	background-color: <?php print $bgnavleft_hover; ?>;
	color: #eee;
	display: block;
	padding: 8px;
	<?php if ($usecss3) { ?>
		transition: all .2s ease-in-out;
		-moz-transition: all .2s ease-in-out;
		-webkit-transition: all .2s ease-in-out;
	<?php } ?>
}

a.vmenu:link,
a.vmenu:visited,
a.vmenu:hover,
a.vmenu:active,
span.vmenu {
	font-size:<?php print $fontsize; ?>px; 
	font-weight: normal; 
	text-align: <?php print $left; ?>; 
	text-decoration: none;
}

.vmenu div.blockvmenupair div.menu_titre a:hover, 
.vmenu div.blockvmenuimpair div.menu_titre a:hover {
	color: <?php print $maincolor; ?>;
}

font.vmenudisabled	{ 
	color: #93a5aa;
	font-size:<?php print $fontsize; ?>px; 
	font-weight: bold; 
	text-align: <?php print $left; ?>; 
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
	color: <?php print $maincolor; ?>;
}

font.vsmenudisabled { 
	color: #93a5aa; 
	font-size:<?php print $fontsize; ?>px; 
	font-weight: normal;
	text-align: <?php print $left; ?>; 
}

font.vsmenudisabledmargin { 
	margin: 1px 1px 1px 8px; 
}

a.vsmenu img{
	vertical-align: bottom;
}



.vmenu div.blockvmenupair, 
.vmenu div.blockvmenuimpair {
	background-color: <?php print $bgnavleft; ?>;
	padding: 0;
	text-align: <?php print $left; ?>;
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
	text-align: <?php print $left; ?>;
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
	width: 172px;
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
	<?php if ( $conf->global->MAIN_MENU_INVERT ) { ?>
		float: <?php print $left; ?>;
		height: 40px;
		margin-<?php print $right; ?>: 5px;
		width: 40px;
	<?php } else { ?> 
		height: 36px;
		min-width: 40px;
	<?php } 

	if ( $conf->global->OBLYON_HIDE_TOPICONS && !$conf->global->MAIN_MENU_INVERT) { ?>
		display: none;
	<?php } else if ( $conf->global->OBLYON_HIDE_LEFTICONS && $conf->global->MAIN_MENU_INVERT) { ?>	 
		display: none;
	<?php } else { ?>
		display: block;
	<?php } ?>
}

<?php
}	// End test if not phone
?>

<?php if ( $conf->global->OBLYON_ELDY_ICONS ) { ?>
	.mainmenu.home{
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/home.png',1); ?>);
	}

	.mainmenu.accountancy {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/money.png',1); ?>);
	}

	.mainmenu.agenda {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/agenda.png',1); ?>);
	}

	.mainmenu.bank {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/bank.png',1); ?>);
	}

	.mainmenu.bookmark {
	}

	.mainmenu.cashdesk {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/pointofsale.png',1); ?>);
	}

	.mainmenu.click2dial {
	}

	.mainmenu.companies {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/company.png',1); ?>);
	}

	.mainmenu.commercial {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/commercial.png',1); ?>);
	}

	.mainmenu.billing {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/money.png',1); ?>);
	}

	.mainmenu.ecm {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/ecm.png',1); ?>);
	}

	.mainmenu.externalsite {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/externalsite.png',1); ?>);
	}

	.mainmenu.ftp {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/tools.png',1); ?>);
	}

	.mainmenu.websites {
	background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/externalsite.png',1) ?>);
	}

	.mainmenu.gravatar {
	}

	.mainmenu.geopipmaxmind {
	}

	.mainmenu.hrm {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/holiday.png',1); ?>);
	}

	.mainmenu.members {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/members.png',1); ?>);
	}

	.mainmenu.paypal {
	}

	.mainmenu.products {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/products.png',1); ?>);
		<?php if ( !$conf->global->MAIN_MENU_INVERT ) { ?>
			margin-<?php print $left; ?>: 10px;
		<?php } ?>

	}

	.mainmenu.project {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/project.png',1); ?>);
	}

	.mainmenu.tools {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/tools.png',1); ?>);
	}

	.mainmenu.shop {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/shop.png',1); ?>);
	}

	.mainmenu.webservices {
	}

	.mainmenu.google {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/menus/globe.png',1); ?>);
	}
<?php } else { ?>
	.mainmenu.home{
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/home.png',1); ?>);
	}

	.mainmenu.accountancy {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/money.png',1); ?>);
	}

	.mainmenu.agenda {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/agenda.png',1); ?>);
	}

	.mainmenu.bank {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/bank.png',1); ?>);
	}

	.mainmenu.bookmark {
	}

	.mainmenu.cashdesk {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/pointofsale.png',1); ?>);
	}

	.mainmenu.click2dial {
	}

	.mainmenu.companies {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/company.png',1); ?>);
	}

	.mainmenu.commercial {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/commercial.png',1); ?>);
	}

	.mainmenu.billing {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/money.png',1); ?>);
	}

	.mainmenu.ecm {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/ecm.png',1); ?>);
	}

	.mainmenu.externalsite {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/externalsite.png',1); ?>);
	}

	.mainmenu.ftp {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/tools.png',1); ?>);
	}

	.mainmenu.gravatar {
	}

	.mainmenu.geopipmaxmind {
	}

	.mainmenu.hrm {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/holiday.png',1); ?>);
	}

	.mainmenu.members {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/members.png',1); ?>);
	}

	.mainmenu.paypal {
	}

	.mainmenu.products {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/products.png',1); ?>);
		<?php if ( !$conf->global->MAIN_MENU_INVERT ) { ?>	 
			margin-<?php print $left; ?>: 10px;
		<?php } ?>

	}

	.mainmenu.project {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/project.png',1); ?>);
	}

	.mainmenu.tools {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/tools.png',1); ?>);
	}

	.mainmenu.shop {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/shop.png',1); ?>);
	}

	.mainmenu.webservices {
	}

	.mainmenu.google {
		background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/globe.png',1); ?>);
	}
<?php } ?>

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
$divalreadydefined=array('home','companies','products','commercial','externalsite','accountancy','project','tools','members','agenda','ftp','holiday','hrm','bookmark','cashdesk','ecm','geoipmaxmind','gravatar','clicktodial','paypal','stripe','webservices','website');
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

	if ( $found || $conf->global->OBLYON_ELDY_ICONS || $conf->global->OBLYON_ELDY_OLD_ICONS ) {
		print ".mainmenu.".$val.", .icon--".$val." {\n";

		if ( $conf->global->OBLYON_ELDY_ICONS ) {
			$url=dol_buildpath($path.'/theme/'.$theme.'/img/menus/generic'.$generic.'.png',1);
			if ($generic < 4) $generic++;
		} else if ( $conf->global->OBLYON_ELDY_OLD_ICONS ) {
			$url=dol_buildpath($path.'/theme/'.$theme.'/img/old-menus/generic'.$generic.'.png',1);
			if ($generic < 4) $generic++;
		}

		print "  background: url(".$url.") no-repeat center;\n";
		print "  background-size: 22px;\n";
		print "}\n";
	} else {
		print "/* A mainmenu entry but img file ".$val.".png not found (check /".$val."/img/".$val.".png), so we use a generic one */\n";
		print ".mainmenu.".$val.":before, .icon--".$val.":before {\n";
		print "  content: '\\e902';\n";
		print "}\n";
	}
}
//End of part to add more div class css
?>



/*------------------------------------*\
		#Login Page
\*------------------------------------*/

body.bodylogin {
	<?php if (GETPOST("optioncss") == 'print') {	?>
	background-color: #fff;
	<?php } else { ?>
	background-color: <?php print $login_bgcolor; ?>;
	<?php } ?>
	display: table;
	position: absolute;
	height: 100%;
	width: 100%;
	font-size: 1em;
}

body.bodylogin .login_center {
	display: table-cell;
	vertical-align: middle;
	background: none !important;
}

body.bodylogin .login_vertical_align {
	padding: 10px;
	padding-bottom: 80px;
}

body.bodylogin form#login {
	padding-bottom: 30px;
	font-size: 13px;
	margin-top: <?php echo $dol_optimize_smallscreen?'30':'60'; ?>px;
	margin-bottom: 30px;
	vertical-align: middle;
}

body.bodylogin .login_table_title {
	color: <?php print $maincolor; ?>;
	max-width: 540px;
	padding-bottom: 20px;
	/* text-shadow: 1px 1px 1px #FFF; */
}

body.bodylogin .login_table label {
	margin: 0 .5em;
	text-shadow: 1px 1px 1px #FFF;
}

body.bodylogin .login_table .trinputlogin {
	font-size: 1.2em;
    margin: 8px;
}

body.bodylogin .login_table .tdinputlogin .fa {
    padding-left: 10px;
    width: 1em;
}

body.bodylogin .login_table input#username,
body.bodylogin .login_table input#password,
body.bodylogin .login_table input#securitycode {
	border: none;
	border-bottom: solid 1px rgba(180,180,180,.4);
	-webkit-box-shadow: none;
	box-shadow: none;
	padding: 5px;
	margin-left: 18px;
	margin-top: 5px;
	margin-bottom: 5px;
	font-size: 1em;
}

body.bodylogin .login_table input#username:focus,
body.bodylogin .login_table input#password:focus,
body.bodylogin .login_table input#securitycode:focus {
	outline: none !important;
	/* box-shadow: none;
	-webkit-box-shadow: 0 0 0 50px #FFF inset;
	box-shadow: 0 0 0 50px #FFF inset;*/
}

body.bodylogin input#securitycode {
	margin-right: .5em;
}

body.bodylogin #captcha_refresh_img {
	margin: .5em;
}

body.bodylogin .login_table {
	margin: 0px auto;	/* Center */
	padding-left:6px;
	padding-right:6px;
	padding-top:16px;
	padding-bottom:12px;
	max-width: 540px;

	background-color: <?php echo $colorbline; ?>;

	-webkit-box-shadow: 0 4px 23px 5px rgba(0, 0, 0, 0.2), 0 2px 6px rgba(60,60,60,0.15);
	box-shadow: 0 4px 23px 5px rgba(0, 0, 0, 0.2), 0 2px 6px rgba(60,60,60,0.15);

	border-radius: 4px;
	border: 1px solid rgba(0,0,0, .16);
}

body.bodylogin .login_main_message {
	text-align: center;
	max-width: 570px;
	margin-bottom: 10px;
}

body.bodylogin .login_main_message .error {
	border: 1px solid #caa;
	padding: 10px;
}

body.bodylogin div#login_left, 
body.bodylogin div#login_right {
	display: inline-block;
	min-width: 250px;
	padding-top: 10px;
	padding-left: 16px;
	padding-right: 16px;
	text-align: center;
	vertical-align: middle;
}

body.bodylogin div#login_right select#entity {
    margin-top: 10px;
}

body.bodylogin table.login_table tr td table.none tr td {
	padding: 2px;
}

body.bodylogin table.login_table_securitycode {
	border-spacing: 0px;
	margin-left: 1em;
}

body.bodylogin table.login_table_securitycode tr td {
	padding-left: 0px;
	padding-right: 4px;
}

body.bodylogin #securitycode {
	min-width: 80px;
}

body.bodylogin #img_securitycode {
	border: 1px solid rgba(0,0,0, .24);
}

body.bodylogin #img_logo,
body.bodylogin .img_logo {
	max-width: 200px;
	max-height: 100px;
}


/* Login message >v3.7 */
.login_main_home {
	background-color: <?php print $maincolor; ?>;
	color: #f4f4f4;
	line-height: 1.4em;
	font-size: 1.1em;
	max-width: 540px !important;
	margin: 0 10px;
	padding: 12px 6px;
	border: <?php print $maincolor; ?> 1px solid;
	-webkit-box-shadow: 0 1px 0 rgba(235,235,235, .6);
	box-shadow: 0 1px 0 rgba(235,235,235, .6);
}

.login_main_message {
	max-width: 540px !important;
}



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
	background-color: #fff;
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
	width: <?php echo (empty($conf->dol_optimize_smallscreen)?'8':'24'); ?>px !important;
}

.ui-layout-resizer-hover {	 /* affects both open and closed states */
}

/* NOTE: It looks best when 'hover' and 'dragging' are set to the same color,
	otherwise color shifts while dragging when bar can't keep up with mouse */
/*.ui-layout-resizer-open-hover ,*/ /* hover-color to 'resize' */
.ui-layout-resizer-dragging {	 /* resizer beging 'dragging' */
	background-color: #ddd;
	width: <?php echo (empty($conf->dol_optimize_smallscreen)?'8':'24'); ?>px;
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
		background-color: #ddd;
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
	width: <?php echo (empty($conf->dol_optimize_smallscreen)?'7':'22'); ?>px !important;
		-moz-border-radius: 0 10px 10px 0;
	-webkit-border-radius: 0 10px 10px 0;
	border-radius: 0 10px 10px 0;
}

.ui-layout-toggler-closed {
	height: <?php echo (empty($conf->dol_optimize_smallscreen)?'54':'2'); ?>px !important;
	width: <?php echo (empty($conf->dol_optimize_smallscreen)?'7':'22'); ?>px !important;
		-moz-border-radius: 0 10px 10px 0;
	-webkit-border-radius: 0 10px 10px 0;
	border-radius: 0 10px 10px 0;
}

.ui-layout-toggler .content {	/* style the text we put INSIDE the togglers */
		color:					#666;
		font-size:<?php print $fontsize; ?>px;
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
	background-color: #fff;
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
	background-color: #ccc;
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
	color: #666;
	font-size:<?php print $fontsize; ?>px;
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

.ecm-layout-resizer-closed {
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


/*------------------------------------*\
		#Tabs 
\*------------------------------------*/

div.tabs {
	clear: both;
	font-weight: normal;
	height: 100%;
	margin: 15px 0 -4px 6px;
	padding: 0 6px 3px 0;
	text-align: <?php print $left; ?>;
}

div.tabBar {
	background-color: <?php echo $colorbline; ?>;
	border: 1px solid rgba(0,0,0, .16);
	box-shadow: 0 1px 1px rgba(0,0,0, .04);
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0, .04);
	color: <?php echo $colorfline; ?>;
	margin-bottom: 10px;
	padding-top: 8px;
	padding-left: <?php echo ($dol_optimize_smallscreen?'4':'8'); ?>px;
	padding-right: <?php echo ($dol_optimize_smallscreen?'4':'8'); ?>px;
	padding-bottom: 8px;
	width: auto;
}

div.tabsAction {
	margin: 20px 0 10px 0;
	padding: 0;
	text-align: <?php print $right; ?>;
}

a.tabTitle {
	color: #666;
	font-weight: normal;
	margin: 0 10px; 
	padding: 4px 6px;
	text-decoration: none;
	white-space: nowrap;
}

a.tab:link, 
a.tab:visited, 
a.tab:hover,
a.tab#active {
	background-color: rgba(0,0,0, .04);
	margin: 0 .3em;
	padding: 10px 12px 10px;
	border: 1px solid rgba(0,0,0, .16);
	border-bottom: none;
	text-decoration: none;
	white-space: nowrap;
	<?php if ($usecss3) { ?>
		box-shadow: 0 0 1px rgba(0,0,0, .04);
		-webkit-box-shadow: 0 0 1px rgba(0,0,0, .04);
		transition: all .3s ease-in-out;
		-moz-transition: all .3s ease-in-out;
		-webkit-transition: all .3s ease-in-out;
	<?php } ?> 
}

a.tab#active, 
a.tab.tabactive {
	background-color: <?php echo $colorbline; ?>;
	box-shadow: 0 -1px 0 rgba(0,0,0, .04);
	-webkit-box-shadow: 0 -1px 0 rgba(0,0,0, .04);
	font-weight: 500;
	position: relative;
}

a.tab.tabactive:hover {
	background-color: <?php echo $colorbline; ?>;
	border: 1px solid rgba(0,0,0, .16);
	border-bottom: none;
	box-shadow: 0 -1px 0 rgba(0,0,0, .04);
	-webkit-box-shadow: 0 -1px 0 rgba(0,0,0, .04);
	color: <?php print $maincolor; ?>;
}

a.tab {
	color: <?php echo $colorfline; ?>;
	font-weight: normal;
}

a.tab:hover, a.tab:focus {
	background-color: rgba(0,0,0, .16);
	color: <?php print $maincolor; ?>;
}

a.tabimage {
	color: #434956;
	text-decoration: none;
	white-space: nowrap;
}

td.tab {
	background-color: <?php echo $colorbline; ?>;
	border: 1px solid rgba(0,0,0, .16) !important;
	box-shadow: 0 1px 1px rgba(0,0,0, .04);
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0, .04);
	margin: 5px;
	padding: 0 .5em;
}

table.notopnoleft td.liste_titre {
	border: 1px solid rgba(0,0,0, .16) !important;
	box-shadow: 0 1px 1px rgba(0,0,0, .04);
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0, .04);
	margin: 0 0 2px 0;
	padding: .8em .5em!important;
}

span.tabspan {
	background-color: #dee7ec;
	color: #434956;
	margin: 0 .2em;
	padding: 0 6px;
	text-decoration: none;
	white-space: nowrap;
}

div.tabBar ul li {
	margin-<?php print $left; ?>: 30px !important;
}

div.popuptabset {
	background-color: <?php echo $colorbline; ?>;
	padding: 5px;
	border: 1px solid #e5e5e5;
}

div.popuptab {
	margin: .3em;
}

@media only screen and (max-width: 570px)
{
	
}


/*------------------------------------*\
		#Tables 
\*------------------------------------*/

.allwidth {
	width: 100%;
}

#undertopmenu {
	background-repeat: repeat-x;
	margin-top: <?php echo ($dol_hide_topmenu?'6':'0'); ?>px;
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
	border: 1px solid #9cacbb;
	border-collapse: collapse;
}

table.border td {
	border: 1px solid #9cacbb;
	border-collapse: collapse;
	padding: 3px 5px;
	vertical-align: middle;
}

table.border td img { margin: 0 .1em; }

td.border {
	border: 1px solid #000;
}

/* Main boxes */

table.noborder, 
table.formdoc, 
div.noborder {
	border: 1px solid rgba(0,0,0, .16);
	border-collapse: separate !important;
	border-spacing: 0;
	box-shadow: 0 1px 1px rgba(0,0,0, .08);
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0, .08);
	margin: 0 0 2px 0;
	/*padding: 1px 2px 1px 2px;*/
	width: 100%;
}

table.noborder[summary="list_of_modules"] tr.oddeven { line-height: 2.2em; }

table.noborder tr, div.noborder form {
	line-height: 1.8em;
}

/* boxes padding */
/* table titles main page */
table.noborder th { padding: 3px; }

table.noborder th:first-child { padding-<?php print $left; ?>: 10px; }

table.noborder th:last-child { padding-<?php print $right; ?>: 10px; }

/* table content all pages */
table.noborder td, div.noborder form, div.noborder form div, table.tableforservicepart1 td, table.tableforservicepart2 td {
 	padding: 4px 6px 4px 6px;			/* t r b l */
 }

table.noborder td:first-child { padding-<?php print $left; ?>: 10px !important; }

table.noborder td:last-child, div.noborder form div:last-child { padding-<?php print $right; ?>: 10px; }

/* titles others pages */
table.noborder .liste_titre td { padding: 3px; }

table.noborder .liste_titre td:first-child { padding-<?php print $left; ?>: 10px; }

table.noborder .liste_titre td:last-child { padding-<?php print $right; ?>: 10px; }

form#searchFormList div.liste_titre { padding: 3px 10px; }

.liste_titre_filter {
	background: <?php print $maincolor; ?> !important;
}

/* table liste -bank- e-mailing */
table.liste .liste_titre td, table.liste .liste_total td { 
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

table.nobordernopadding td {
	border: 0 !important;
	padding: 0;
	vertical-align: middle;
}


/* For lists */
table.liste {
	border: 1px solid rgba(0,0,0, .42);
	border-collapse: collapse;
	margin-bottom: 2px;
	margin-top: 2px;
	width: 100%;
}

table.liste .oddeven td { padding: 5px 10px; }

table .liste_titre td { padding: 2px; }



table.liste td a img {
	vertical-align: middle;
}


.tagtable, .table-border { display: table; }
.tagtr, .table-border-row	{ display: table-row; }
.tagtd, .table-border-col, .table-key-border-col, .table-val-border-col { display: table-cell; }



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
	background-color: <?php print $maincolor; ?>;
	color: #f4f4f4;
	font-family: <?php print $fontboxtitle; ?>;
	font-size: 1em;
	font-weight: normal;
	line-height: 1em;
	text-align: <?php echo $left; ?>;
	white-space: normal;
}

div.liste_titre a, 
tr.liste_titre a, 
tr.liste_titre_sel a, 
form.liste_titre a, 
form.liste_titre_sel a {
	color: #ffffff;
}

div.liste_titre_bydiv {
	border-top-width: <?php echo $borderwidth ?>px;
	border-top-color: rgb(<?php echo $colortopbordertitle1 ?>);
	border-top-style: solid;
	border-collapse: collapse;
	display: table;
	padding: 2px 0px 2px 0;
	box-shadow: none;
	width: calc(100% - 1px);	/* 1px more, i don't know why */
}

.liste_titre_sel { font-weight: bold!important; }

tr.liste_titre th, 
th.liste_titre, 
tr.liste_titre td, 
td.liste_titre, 
form.liste_titre div, 
div.liste_titre {
	font-family: <?php print $fontboxtitle; ?>;
	font-weight: normal;
	/* border-bottom: 1px solid #FDFFFF;*/
	white-space: normal;
	padding-left: 5px;
}

table td.liste_titre a:link, 
table td.liste_titre a:visited, 
table td.liste_titre a:active { color: #eee; }

table td.liste_titre a:hover { color: <?php print $maincolor; ?>; }

table.noborder tr td a:link, 
table.noborder tr td a:visited, 
table.noborder tr td a:active,
table.noborder tr th a:link, 
table.noborder tr th a:visited, 
table.noborder tr th a:active { 
	color: <?php echo $colorfline; ?>;
	font-family: <?php echo $fontboxtitle; ?>;
}

table.noborder tr td a:hover { color: <?php echo $colorfline_hover; ?>; }

table.noborder tr td a.button,
table.noborder tr td a.button:hover { color: #fff; }

tr.liste_titre td, 
tr.liste_titre th { text-align: <?php print $left; ?>; }

tr.liste_titre td[align=right], 
tr.liste_titre th[align=right] { text-align: <?php print $right; ?>; }

tr.liste_titre td[align=left], 
tr.liste_titre th[align=left] { text-align: <?php print $left; ?>; }

tr.liste_titre td[align=center], 
tr.liste_titre th[align=center] { text-align: center; }

table.noborder td[align=right], 
table.noborder th[align=right] { text-align: <?php print $right; ?>; }

table.noborder td[align=left], 
table.noborder th[align=left] { text-align: <?php print $left; ?>; }

table.noborder td[align=center], 
table.noborder th[align=center] { text-align: center; }

table.noborder td, 
table.noborder th { text-align: <?php print $left; ?>; }

table.noborder td[valign=top], 
table.noborder td[valign=center], 
table.noborder td[valign=bottom] { vertical-align: middle; }

table.noborder tr[valign=top], 
table.noborder tr[valign=center], 
table.noborder tr[valign=bottom] { vertical-align: middle; } 

table.valid td[valign=top], 
table.valid td[valign=center], 
table.valid td[valign=bottom] { vertical-align: middle; } 

table.valid tr[valign=top], 
table.valid tr[valign=center], 
table.valid tr[valign=bottom] { vertical-align: middle; } 

/*style main boxes */
div.fichethirdleft table.noborder td[align=right], 
div.fichethirdleft table.noborder th[align=right] { text-align: <?php print $right; ?>; }

div.fichethirdleft table.noborder td[align=left], 
div.fichethirdleft table.noborder th[align=left] { text-align: <?php print $left; ?>; }

div.fichethirdleft table.noborder td[align=center], 
div.fichethirdleft table.noborder th[align=center] { text-align: center; }

div.fichethirdleft table.noborder td, 
div.fichethirdleft table.noborder th { text-align: <?php print $left; ?>; }

div.fichetwothirdright table.noborder td[align=right], 
div.fichetwothirdright table.noborder th[align=right] { text-align: <?php print $right; ?>; }

div.fichetwothirdright table.noborder td[align=left], 
div.fichetwothirdright table.noborder th[align=left] { text-align: <?php print $left; ?>; }

div.fichetwothirdright table.noborder td[align=center], 
div.fichetwothirdright table.noborder th[align=center] { text-align: center; }

div.fichetwothirdright table.noborder td, 
div.fichetwothirdright table.noborder th { text-align: <?php print $left; ?>; }


.liste tr.liste_titre:nth-child(3) { 
	background-color: #333;
}

tr.liste_titre:nth-child(3) { 
	background-color: #333;
}

tr.liste_titre_sel th, 
th.liste_titre_sel, 
tr.liste_titre_sel td, 
td.liste_titre_sel, 
form.liste_titre_sel div {
	background-color: #333;
	color: #f7f7f7;
	font-weight: normal;
	text-decoration: none;
	white-space: normal;
}

th.liste_titre>img, 
th.liste_titre_sel>img { 
	padding-<?php print $left; ?>: 5px; 
}

input.liste_titre {
	background: transparent;
	border: 0;
	margin: inherit;
	padding: 0;
}

tr.liste_total, 
form.liste_total {
	background-color: <?php echo $colorbline; ?>;
}

tr.liste_total td, 
form.liste_total div {
	height: 20px;
	border-top: 1px solid rgba(0,0,0, .42);
	color: <?php echo $maincolor; ?>;
	font-weight: normal;
	white-space: normal;
	padding: 0 5px 0 5px;
}

tr.liste_total td[align=right], 
form.liste_total td[align=right] { 
	color: #3c6; 
	font-weight: bold; 
}

/* Disable shadows */
.noshadow,
div.tabBar .noborder {
	box-shadow: 0 0 0 rgba(0,0,0, .24) !important;
	-moz-box-shadow: 0 0 0 rgba(0,0,0, .24) !important;
	-webkit-box-shadow: 0 0 0 rgba(0,0,0, .24) !important;
}
div .tdtop {
	vertical-align: top !important;
	padding-top: 5px !important;
	padding-bottom: 0px !important;
}

#tablelines tr.liste_titre td, .paymenttable tr.liste_titre td, .margintable tr.liste_titre td, .tableforservicepart1 tr.liste_titre td {
	border-bottom: 1px solid #AAA !important;
}
#tablelines tr td {
	height: unset;
}

/*------------------------------------*\
		#Boxes 
\*------------------------------------*/

.box {
	overflow-x: auto;
	min-height: 40px;
}
/*.ficheaddleft div.boxstats, .ficheaddright div.boxstats {
	border: none;
}
*/
.boxstatsborder {
	border: 1px solid #CCC !important;
}
.boxstats, .boxstats130 {
	display: inline-block;
	margin: 8px;
	border: 1px solid #CCC;
	text-align: center;
	border-radius: 2px;
	background: #eee;
}
.boxstats, .boxstats130, .boxstatscontent {
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}
.boxstats {
	padding: 3px;
	width: 100px;
	min-height: 40px;
}
.boxstats130 {
	width: 135px;
	min-height: 48px;
	padding: 3px
}
@media only screen and (max-width: 767px)
{
	.boxstats, .boxstats130 {
		margin: 3px;
		border: 1px solid rgba(0,0,0, .24);
		box-shadow: none;
		background: #ddd;
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
.boxstats:hover, .boxstats:focus {
	box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.20);
}
span.boxstatstext {
	line-height: 18px;
	color: #000;
}
.boxstatsindicator.thumbstat150 {	/* If we remove this, box position is ko on ipad */
	display: inline-flex;
}
span.boxstatsindicator {
	font-size: 110%;
	font-weight: normal;
	font-color: rgb(<?php print $colortextlink; ?>);
}
span.dashboardlineindicator, span.dashboardlineindicatorlate {
	font-size: 120%;
	font-weight: normal;
}
.dashboardlineindicatorlate img {
	width: 16px;
}
span.dashboardlineok {
	color: #008800;
}
span.dashboardlineko {
	color: #FFF;
	font-size: 80%;
}
.dashboardlinelatecoin {
	float: right;
	position: relative;
	text-align: right;
	top: -24px;
	padding: 1px 6px 1px 6px;
	background-color: #8c4446;
	color: #FFFFFF ! important;
	border-radius: .25em;
}
.boxtable {
	margin-bottom: 8px !important;
	border-bottom-width: 1px;
}
.boxtablenobottom {
	border-bottom-width: 0 !important;
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


.box {
	padding-right: 0px;
	padding-left: 0px;
	padding-bottom: 12px;
}

tr.box_titre {
	height: 26px !important;
	color: #fff !important; */
	background-repeat: repeat-x;
	color: rgb(<?php echo $colortexttitle; ?>);
	font-family: <?php print $fontlist ?>, sans-serif;
	font-weight: <?php echo $useboldtitle?'bold':'normal'; ?>;
	border-bottom: 1px solid #FDFFFF;
	white-space: nowrap;
}

tr.box_titre td.boxclose {
	width: 60px;
}
img.boxhandle, img.boxclose {
	padding-left: 5px;
}

.noborderbottom {
	border-bottom: none !important;
	box-shadow: 0 1px 1px rgba(0,0,0, .32) !important;
	-moz-box-shadow: 0 1px 1px rgba(0,0,0, .32) !important;
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0, .32) !important;
}

div.colorback
{
	background: rgb(<?php echo $colorbacktitle; ?>);
	padding: 10px;
	margin-top: 5px;
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

/*------------------------------------*\
		#Other 
\*------------------------------------*/

.classfortooltip {
	margin-left: 1em;
}

div.boximport {
	min-height: unset;
}

.product_line_stock_ok { color: #33cc66; }
.product_line_stock_too_low { color: #f07b6e; }

.fieldrequired { color: <?php echo $colorfline; ?>; font-weight: bold; }

.widthpictotitle { width: 40px; text-align: <?php echo $left; ?>; }

.dolgraphtitle { margin-top: 6px; margin-bottom: 4px; }
.dolgraphtitlecssboxes { margin: 0px; }
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

.logo_setup
{
	content:url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/logo_setup.svg',1) ?>);	/* content is used to best fit the container */
	display: inline-block;
}
.nographyet
{
	content:url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/nographyet.svg',1) ?>);
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
	color: <?php print $maincolor; ?>;
	font-weight: bold;
}

#dolpaymenttable { min-width: 320px; font-size: 16px; }	/* Width must have min to make stripe input area visible */

#tablepublicpayment { 
	border: 1px solid #ccc !important; 
	width: 100%; 
}

#tablepublicpayment .CTableRow1	{ background-color: #f0f0f0 !important; }

#tablepublicpayment tr.liste_total { border-bottom: 1px solid #ccc !important; }

#tablepublicpayment tr.liste_total td { border-top: none; }

#divsubscribe { width: 700px; }

#tablesubscribe { width: 100%; }

div.table-border {
	border: 1px solid #9cacbb;
	border-collapse: collapse;
	display: table;
	width: 100%;
}

div.table-border-row {
	display: table-row;
}

div.table-key-border-col {
	border: 1px solid #9cacbb;
	border-collapse: collapse;
	display: table-cell;
	padding: 1px 2px 1px 1px;
	vertical-align: top;
	width: 25%;
}

div.table-val-border-col {
	border: 1px solid #9cacbb;
	border-collapse: collapse;
	display: table-cell;
	padding: 1px 2px 1px 1px;
	width: auto;
}


/* Liens Payes/Non payes */
a.normal:link,
a.normal:visited, 
a.normal:active, 
a.normal:hover, 
a.normal:focus {
	font-weight: normal; 
}

a.impayee:link, 
a.impayee:visited,
a.impayee:active, 
a.impayee:hover, 
a.impayee:focus {
	color: #500; 
	font-weight: bold; 
}


/*------------------------------------*\
		#Form confirmation 
\*------------------------------------*/

/**
 * When Ajax JQuery is used
 */

.ui-dialog-titlebar {
}

.ui-dialog-content {
	font-size: <?php print $fontsize; ?>px !important;
}


/**
 * When HTML is used
 */
 
table.valid {
	background-color: #f07b6e;
	border: 1px solid #e0796e;
	box-shadow: 0 1px 1px rgba(0,0,0, .04);
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0, .04);
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
.mytooltip {
	width: <?php print dol_size(450,'width'); ?>px;
	border-top: solid 1px #BBBBBB;
	border-<?php print $left; ?>: solid 1px #BBBBBB;
	border-<?php print $right; ?>: solid 1px #444444;
	border-bottom: solid 1px #444444;
	padding: 5px 20px;
	border-radius: 0;
	box-shadow: 0 0 4px grey;
	margin: 2px;
	font-stretch: condensed;
}

/*------------------------------------*\
		#Calc Module 
\*------------------------------------*/

#imageCalc {
 
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

.breadCrumb ul li {
	
}


/*------------------------------------*\
		#Calendar Module 
\*------------------------------------*/

.ui-datepicker-calendar .ui-state-default, .ui-datepicker-calendar .ui-widget-content .ui-state-default,
.ui-datepicker-calendar .ui-widget-header .ui-state-default, .ui-datepicker-calendar .ui-button,
html .ui-datepicker-calendar .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active
{
	border: unset;
}

img.datecallink { padding-right: 2px !important; }

.ui-datepicker-trigger {
	cursor: pointer;
	vertical-align: middle;
}

.bodyline {
	border: 1px #E4ECEC solid;
	margin-bottom: 5px;
	padding: 0;
}

table.dp {
	background-color: <?php echo $colorbline; ?>;
	border-collapse: collapse;
	border-spacing: 0;
	box-shadow: 0 1px 1px rgba(0,0,0, .04);
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0, .04);
	padding: 0;
	width: 190px;
}

.dp td, 
.tpHour td, 
.tpMinute td { 
	font-size: 10px;
	padding: 3px;
}

#dpExp {
	background-color: <?php print $maincolor; ?>;
	color: #eee;
	font-size:<?php print $fontsize; ?>px;
	padding: 5px 0;
	text-transform: capitalize;
}

/* Barre titre */
.dpHead,
.tpHead,
.tpHour td:hover .tpHead {
	background-color: #333;
	color: #f7f7f7;
	cursor: auto;
	font-size: 11px;
	font-weight: bold;
	padding: 5px 0 7px 7px !important;
	text-transform: capitalize;
}

/* Close link */
#DPCancel {
	color: #f7f7f7;
	margin-left: 6px;
}

#DPCancel:hover {
	color: <?php print $maincolor; ?>;
}

/* Barre navigation */
.dpButtons, .tpButtons {
	background-color: #617389;
	color: #fff;
	cursor: pointer;
	font-weight: bold;
	text-align: center;
}

.dpButtons:Active,
.tpButtons:Active {
	border: 1px outset black;
}

.dpDayNames td,
.dpExplanation {
	background-color: #d9dbe1; 
	font-size: 11px;
	font-weight: bold; 
	text-align: center; 
}

.dpExplanation {
	font-size: 11px;
	font-weight: normal; 
}

.dpWeek td{text-align: center}

.dpToday,
.dpReg,
.dpSelected{
	cursor: pointer;
}

.dpToday{
	background-color: #ddd;
	color: black;
	font-weight: bold; 
}

.dpReg:hover,
.dpToday:hover{
	background-color: #333;
	color: #f7f7f7;
}

/* Jour courant */
.dpSelected{
	background-color: #0B63A2;
	color: white;
	font-weight: bold; 
}

.tpHour{
	border-top: 1px solid rgba(0,0,0, .24);
	border-right: 1px solid rgba(0,0,0, .24);
}

.tpHour td {
	border-left: 1px solid rgba(0,0,0, .24); 
	border-bottom: 1px solid rgba(0,0,0, .24); 
	cursor: pointer;
}

.tpHour td:hover {
	background-color: black;
	color: white;
}

.tpMinute {
	margin-top: 5px;
}

.tpMinute td:hover {
	background-color: black; 
	color: white;
}

.tpMinute td {
	background-color: #D9DBE1; 
	cursor: pointer;
	text-align: center; 
}

/* Bouton X fermer */
.dpInvisibleButtons {
	background-color: transparent;
	border-style: none;
	border-width: 0;
	color: <?php print $maincolor; ?>;
	cursor: pointer;
	font-size: 9px;
	padding: 0;
	vertical-align: middle;
}

/*------------------------------------*\
		#Website Module 
\*------------------------------------*/
.phptag {
	background: #ddd; border: 1px solid #ccc; border-radius: 4px;
}

.nobordertransp {
	border: 0px;
	background-color: transparent;
	background-image: none;
	color: #000 !important;
	text-shadow: none;
}
.websitebar {
	border-bottom: 1px solid #ccc;
	background: #eee;
}
.websitebar .button, .websitebar .buttonDelete
{
	padding: 2px 4px 2px 4px !important;
	margin: 2px 4px 2px 4px  !important;
	line-height: normal;
}
.websiteselection {
	display: inline-block;
	padding-left: 10px;
	vertical-align: middle;
}
.websitetools {
	float: right;
}
.websiteselection, .websitetools {
	margin-top: 3px;
	padding-top: 3px;
	padding-bottom: 3px;
}

.websiteinputurl {
	display: inline-block;
	vertical-align: top;
}
.websiteiframenoborder {
	border: 0px;
}
span.websitebuttonsitepreview img, a.websitebuttonsitepreview img {
	width: 26px;
	display: inline-block;
}
span.websitebuttonsitepreviewdisabled img, a.websitebuttonsitepreviewdisabled img {
	opacity: 0.2;
}
.websiteiframenoborder {
	border: 0px;
}
.websitehelp {
	vertical-align: middle;
	float: right;
	padding-top: 8px;
}

/*------------------------------------*\
		#Agenda Module 
\*------------------------------------*/

.dayevent .tagtr:first-of-type {
	height: 24px;
}
.agendacell { height: 60px; }

table.cal_month    { border-spacing: 0px; }
table.cal_month td:first-child  { border-left: 0px; }
table.cal_month td:last-child   { border-right: 0px; }
.cal_current_month { border-top: 0; border-left: solid 1px #E0E0E0; border-right: 0; border-bottom: solid 1px #E0E0E0; }
.cal_current_month_peruserleft { border-top: 0; border-left: solid 2px #6C7C7B; border-right: 0; border-bottom: solid 1px #E0E0E0; }
.cal_current_month_oneday { border-right: solid 1px #E0E0E0; }
.cal_other_month   { border-top: 0; border-left: solid 1px #C0C0C0; border-right: 0; border-bottom: solid 1px #C0C0C0; }
.cal_other_month_peruserleft { border-top: 0; border-left: solid 2px #6C7C7B !important; border-right: 0; }
.cal_current_month_right { border-right: solid 1px #E0E0E0; }
.cal_other_month_right   { border-right: solid 1px #C0C0C0; }
.cal_other_month   { /* opacity: 0.6; */ background: #EAEAEA; padding-<?php print $left; ?>: 2px; padding-<?php print $right; ?>: 1px; padding-top: 0px; padding-bottom: 0px; }
.cal_past_month    { /* opacity: 0.6; */ background: #EEEEEE; padding-<?php print $left; ?>: 2px; padding-<?php print $right; ?>: 1px; padding-top: 0px; padding-bottom: 0px; }
.cal_current_month { background: #FFFFFF; border-left: solid 1px #E0E0E0; padding-<?php print $left; ?>: 2px; padding-<?php print $right; ?>: 1px; padding-top: 0px; padding-bottom: 0px; }
.cal_current_month_peruserleft { background: #FFFFFF; border-left: solid 2px #6C7C7B; padding-<?php print $left; ?>: 2px; padding-<?php print $right; ?>: 1px; padding-top: 0px; padding-bottom: 0px; }
.cal_today         { background: #FDFDF0; border-left: solid 1px #E0E0E0; border-bottom: solid 1px #E0E0E0; padding-<?php print $left; ?>: 2px; padding-<?php print $right; ?>: 1px; padding-top: 0px; padding-bottom: 0px; }
.cal_today_peruser { background: #FDFDF0; border-right: solid 1px #E0E0E0; border-bottom: solid 1px #E0E0E0; padding-<?php print $left; ?>: 2px; padding-<?php print $right; ?>: 1px; padding-top: 0px; padding-bottom: 0px; }
.cal_today_peruser_peruserleft { background: #FDFDF0; border-left: solid 2px #6C7C7B; border-right: solid 1px #E0E0E0; border-bottom: solid 1px #E0E0E0; padding-<?php print $left; ?>: 2px; padding-<?php print $right; ?>: 1px; padding-top: 0px; padding-bottom: 0px; }
.cal_past          { }
.cal_peruser       { padding: 0px; }
.cal_impair        { background: #F8F8F8; }
.cal_today_peruser_impair { background: #F8F8F0; }
.peruser_busy      { background: #CC8888; }
.peruser_notbusy   { background: #EEDDDD; opacity: 0.5; }
table.cal_event    { border: none; border-collapse: collapse; margin-bottom: 1px; -webkit-border-radius: 3px; border-radius: 3px; min-height: 20px;	}
table.cal_event td { border: none; padding-<?php print $left; ?>: 2px; padding-<?php print $right; ?>: 2px; padding-top: 0px; padding-bottom: 0px; }
table.cal_event td.cal_event { padding: 4px 4px !important; }
table.cal_event td.cal_event_right { padding: 4px 4px !important; }
.cal_event              { font-size: 1em; }
.cal_event a:link       { color: #111111; font-weight: normal !important; }
.cal_event a:visited    { color: #111111; font-weight: normal !important; }
.cal_event a:active     { color: #111111; font-weight: normal !important; }
.cal_event_busy a:hover,
.cal_event_busy a:focus { color: #111111; font-weight: normal !important; color:rgba(255,255,255,.75); }
.cal_event_busy      { }
.cal_peruserviewname { max-width: 140px; height: 22px; }

.topmenuimage {
	background-size: 28px auto;
}

/*------------------------------------*\
		#Holiday Module 
\*------------------------------------*/

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
	 display: inline-block;
	 width: 100px;
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


/*------------------------------------*\
		#cashdesk module 
\*------------------------------------*/

.conteneur {
	background-color: <?php echo $colorbline; ?> !important;
	box-shadow: 0 1px 1px rgba(0,0,0, .04);
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0, .04);
}

.conteneur_img_gauche {
	background: none!important;
}

.conteneur_img_droite {
	background: none!important;
}

 
.entete {
	background: none!important;
	height: 0!important;
}

 
.menu_principal {
	background-color: <?php print $bgnavtop; ?> !important;
	background-image: none !important;
	margin: 0 0 20px !important;
	width: 100% !important;
	height: 90px !important;
}

.menu_principal .logopos {
	padding-top: 5px !important;
	max-height: 80px !important;
}

.menu_principal .menu {
	padding: 15px 0!important;
}

.menu_principal .menu li {
	line-height: 1.5em;
	margin: 0 10px;
}

.menu_principal .menu_choix1,
.menu_principal .menu_choix2 {
	padding: 0;
	font-size: 1.3em!important;
	width: initial!important;
}

.menu_principal .menu_choix1 a,
.menu_principal .menu_choix2 a {
	border: 1px solid #eee;
	border-radius: 5px;
	margin: 5px;
	padding: 14px 5px 14px 54px;
	height: 38px;
	width: initial!important;
}

.menu_principal .menu_choix1 a:hover,
.menu_principal .menu_choix1 a:focus,
.menu_principal .menu_choix2 a:hover,
.menu_principal .menu_choix2 a:focus {
	background-color: <?php echo $bgbutton_hover;?>;
}

.menu_principal .menu_choix1 a {
    background: url("<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/cashdesk/new.png',1); ?>") top left no-repeat;
}

.menu_principal .menu_choix2 a {
    background: url("<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/cashdesk/gescom.png',1); ?>") top left no-repeat;
}

.menu_principal .menu_choix1 a span,
.menu_principal .menu_choix2 a span{
	color: #eee;
	display: inline-block;
	padding: 13px 0;
}

.menu_principal .menu_choix1 a:hover span,
.menu_principal .menu_choix1 a:focus span,
.menu_principal .menu_choix2 a:hover span,
.menu_principal .menu_choix2 a:focus span {
	color: #fcfcfc !important;
}

.menu_principal .menu_choix0 {
	color: #eee !important;
	float: right !important;
	font-style: normal !important;
	font-size: 13px !important;
	margin-right: 20px !important;
	text-align: left !important;
	min-width: 235px !important;
	max-width: 50% !important;
}

.menu_principal .menu_choix0 a {
	color: <?php echo $colorfline; ?>;
	font-weight: bold!important;
}

.menu_principal .menu_choix0 a:hover,
.menu_principal .menu_choix0 a:focus {
	color: <?php echo $colorfline_hover; ?>;
	text-decoration: underline;
}

.menu_principal .menu_choix0 a img {
	vertical-align: sub;
}

.liste_articles {
	border: none!important;
	width: 245px !important;
}

.liste_articles_bas {
	background-color: #333;		
	border: 1px solid rgba(0,0,0, .24) !important;
	color: #eee;
	padding-bottom: 15px;
}

p.titre {
	background-color: <?php print $maincolor; ?>;
	border-bottom: none !important;
	color: #f4f4f4 !important;
	padding: 8px;
}

.liste_articles .cadre_article {
	border-bottom: 1px solid #eee !important;
	width: 200px !important;
}

.liste_articles .cadre_article p {
	color: #eee !important;
}

.liste_articles .cadre_article p a {
	color: #eee !important;
}

.cadre_article p a:hover,
.cadre_article p a:focus {
		text-decoration: underline;
}

.cadre_prix_total {
	background-color: #f6f6f6;
	border: 1px solid rgba(0,0,0, .24) !important;
	color: #33cc66 !important;
	margin-left: 23px !important;
	margin-right: 23px !important;
}

.bouton_login input {
	background-color: <?php print $maincolor; ?>!important;
	background-image: none !important;
	border: 1px solid #c0c0c0 !important;
	box-shadow: inset 0 1px 0 rgba(170, 200, 210, .6);
	-webkit-box-shadow: inset 0 1px 0 rgba(170, 200, 210, .6);	
	color: #eee;
	cursor: pointer;
	font-weight: bold;
	padding: 1em;
	text-decoration: none;
	white-space: nowrap;
}

.bouton_login input:hover,
.bouton_login input:focus,
.bouton_login input:active {
	background-color: $bgbutton_hover !important;
	padding: 1em;
}

.principal {
	margin: 0 20px !important;
}

.titre1 {
	color: #f07b6e!important;
	font-size: 1.3em!important;
}

.cadre_facturation {
	border: 2px solid rgba(0,0,0, .32) !important;
	background-color: <?php echo $colorbline; ?>;
	color: <?php echo $colorfline; ?>;
	padding: 1em;
}

.cadre_facturation table {
    width: 100%;
	margin: 0.5em 0;
}

.cadre_facturation table tr td {
    padding: 0.5em;
}

.cadre_facturation .label1 {
	color: <?php echo $colorfline; ?>;
}

.select_tva select {
	width: 70px !important;
}

.texte1_off, .texte2_off {
	cursor: not-allowed;
}


/* Force values for small screen 767 */
@media only screen and (max-width: 767px)
{
	.menu_principal .menu {
		padding: 8px 0 !important;
	}

	.menu_principal .menu li.menu_choix1,
	.menu_principal .menu li.menu_choix2 {
		padding: 15px 0 5px 0;
		margin: 0 5px;
	}

	.menu_principal .menu_choix1 a,
	.menu_principal .menu_choix2 a {
		background-size: 36px 36px;
		height: 30px;
		padding: 8px 38px 8px 0;
	}

	.menu_principal .menu_choix1 a span.hideonsmartphone,
	.menu_principal .menu_choix2 a span.hideonsmartphone {
		display: none;
	}
	.liste_articles {
		margin-right: 0 !important;
	}

	.menu_principal .menu_choix0 {
		max-width: 66% !important;
	}

	.menu_principal .menu_choix0 select {
		width: auto;
	}

	/* Do not force width for cashdesk */
	.cadre_facturation .maxwidthonsmartphone {
		max-width: fit-content;
	}
}


/* 
 * Buttons
 */
 
.bouton_ajout_article {
	background-color: <?php echo $colorbline; ?> !important;
	background-image: none!important;
	border: 1px solid <?php print $maincolor; ?>!important;
	color: <?php print $maincolor; ?>;
	box-shadow: inset 0 1px 0 rgba(170, 200, 210, .6);
	-webkit-box-shadow: inset 0 1px 0 rgba(170, 200, 210, .6);
	cursor: pointer;
	display: block;
	font-weight: bold!important;
	margin: 15px auto 0 !important;
	text-decoration: none;
	text-transform: uppercase;
	width: initial !important;
	white-space: nowrap;
}

.bouton_ajout_article:hover, 
.bouton_ajout_article:active, 
.bouton_ajout_article:focus {
	background-color: <?php print $maincolor; ?>!important;
	background-image: none!important;
	border-color: <?php print $maincolor; ?>;
	color: #f7f7f7;
	-webkit-box-shadow: none;
	box-shadow: none;
}

.bouton_mode_reglement,
.bouton_validation {
	background-color: #f8f8f8!important;
	background-image: none!important;
	border: 1px solid #c0c0c0!important;
	-webkit-box-shadow: inset 0 1px 0 rgba(170, 200, 210, .6);
	box-shadow: inset 0 1px 0 rgba(170, 200, 210, .6);
	color: #434956;
	cursor: pointer;
	font-weight: bold;
	text-decoration: none;
	white-space: nowrap;
}

.bouton_mode_reglement:hover,
.bouton_mode_reglement:active, 
.bouton_mode_reglement:focus,
.bouton_validation:hover,
.bouton_validation:active, 
.bouton_validation:focus {
	background-image: none!important;
	border: 1px solid <?php print $maincolor; ?>!important;
	color: <?php print $maincolor; ?>;
	-webkit-box-shadow: inset 0 5px 0 <?php print $maincolor; ?>88;
	box-shadow: inset 0 5px 0 <?php print $maincolor; ?>88;
}

.bouton_mode_reglement_disabled {
	background-color: #ddd!important;
	border: 1px solid #aaa !important;
	box-shadow: inset 0 1px 0 rgba(170, 170, 170, .6);
	-webkit-box-shadow: inset 0 1px 0 rgba(170, 170, 170, .6);
	color: #777!important;
	cursor: not-allowed;
	font-weight: normal!important;
	text-decoration: none !important;
	white-space: nowrap !important;
}

.pied { 
	background: none!important; 
	height: 0!important;
}

/*------------------------------------*\
		#jQuery Modules
\*------------------------------------*/

/**
 * Tooltips
 */
 
#tooltip {
	background-color: #fffff0;
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


/**
 * Ajax - Liste deroulante de l'autocompletion
 */

.ui-widget-content { border: solid 1px rgba(0,0,0,.3); background: #fff !important; }

.ui-autocomplete-loading { 
	background: white url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/working.gif',1); ?>) right center no-repeat; 
}

.ui-autocomplete {
	background-color: white;
	border: 1px solid #888;
	font-size: 1.0em;
	margin: 0;
	padding: 0;
	position: absolute;	
	width: auto;
}

.ui-autocomplete ul {
	list-style-type: none;
	margin: 0;
	padding: 0;
}

.ui-autocomplete ul li.selected { background-color: #d3e5ec;}

.ui-autocomplete ul li {
	cursor: pointer;
	display: block;
	height: 18px; 
	list-style-type: none;
	margin: 0;
	padding: 2px;
}

/**
 * Gantt
 */

td.gtaskname {
	overflow: hidden;
	text-overflow: ellipsis;
}

/**
 * jQuery - jeditable
 */

.editkey_textarea, 
.editkey_ckeditor, 
.editkey_string, 
.editkey_email, 
.editkey_numeric, 
.editkey_select, 
.editkey_autocomplete {
	background: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/edit.png',1); ?>) right top no-repeat;
	cursor: pointer;
}

.editkey_datepicker {
	background: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/calendar.png',1); ?>) right center no-repeat;
	cursor: pointer;
}

.editval_textarea.active:hover, 
.editval_ckeditor.active:hover, 
.editval_string.active:hover, 
.editval_email.active:hover, 
.editval_numeric.active:hover, 
.editval_select.active:hover, 
.editval_autocomplete.active:hover, 
.editval_datepicker.active:hover {
	background-color: white;
	cursor: pointer;
}

.viewval_textarea.active:hover, 
.viewval_ckeditor.active:hover, 
.viewval_string.active:hover, 
.viewval_email.active:hover, 
.viewval_numeric.active:hover, 
.viewval_select.active:hover, 
.viewval_autocomplete.active:hover, 
.viewval_datepicker.active:hover {
	background-color: white;
	cursor: pointer;
}

.viewval_hover {
	background-color: white;
}


/**
 * Treeview - Admin Menu
 */

.treeview ul { 
	background-color: transparent !important; 
	margin-top: 0; 
}

.treeview li { 
	background-color: transparent !important; 
	min-height: 20px; 
	padding: 0 0 0 16px !important; 
}

.treeview .hover { 
	color: black !important; 
}


/**
 * Excel tabs
 */
 
.table_data {
	border-style: ridge;
	border: 1px solid;
}

.tab_base {
	background-color: #c5d0dd;
	border: 1px solid;
	border-style: ridge;
	cursor: pointer;
	font-weight: bold;
}

.table_sub_heading {
	background-color: #ccc;
	border: 1px solid;
	border-style: ridge;
	font-weight: bold;
}

.table_body {
	background-color: #f0f0f0;
	border: 1px solid;
	border-collapse: collapse;
	border-spacing: 0;
	border-style: ridge;
	font-family: sans-serif;
	font-weight: normal;
}

.tab_loaded {
	background-color: #222;
	border: 1px solid;
	border-style: groove;
	color: white;
	cursor: pointer;
	font-weight: bold;
}


/**
 * Color picker
 */

A.color, 
A.color:active, 
A.color:visited {
	border: 1px inset white;
	display: block;
	height: 10px;
	line-height: 10px;
	margin: 0;
	padding: 0;
	position: relative;
	text-decoration: none;
	width: 10px;
}

A.color:hover,
A.color:focus {
	border: 1px outset white;
}

A.none, 
A.none:active, 
A.none:visited, 
A.none:hover, 
A.none:focus {
	border: 1px solid #b3c5cc;
	cursor: default;
	display: block;
	height: 10px;
	line-height: 10px;
	margin: 0;
	padding: 0;
	position: relative;
	text-decoration: none;
	width: 10px;
}

.tblColor {
	display: none;
}

.tdColor {
	padding: 1px;
}

.tblContainer {
	background-color: #b3c5cc;
}

.tblGlobal {
	background-color: #b3c5cc;
	border: 2px outset;
	display: none;
	left: 0;	
	position: absolute;
	top: 0;
}

.tdContainer {
	padding: 5px;
}

.tdDisplay {
	border: 1px outset white;
	height: 20px;
	line-height: 20px;
	width: 50%;
}

.tdDisplayTxt {
	color: black;
	font-size: 8pt;
	height: 24px;
	line-height: 12px;
	text-align: center;
	width: 50%;
}

.btnColor {
	font-size: 10pt;
	margin: 0;
	padding: 0;
	width: 100%;
}

.btnPalette {
	font-size: 8pt;
	margin: 0;
	padding: 0;
	width: 100%;
}


/**
 * Overwriting JQuery styles 
 */

.ui-menu .ui-menu-item a {
	display: block;
	font-family: <?php echo $fontlist; ?>;
	font-size: 1em;
	font-weight: normal;
	line-height: 1.5;
	padding: .2em .4em;
	text-decoration: none;
	zoom: 1;
}

.ui-widget {
	font-family: <?php echo $fontlist; ?>;
	font-size: <?php echo $fontsize; ?>px;
}

.ui-button { 
	margin-left: -2px; 
	padding-top: 1px; 
}

.ui-button-icon-only .ui-button-text { 
	height: 8px; 
}

.ui-button-icon-only .ui-button-text,
.ui-button-icons-only .ui-button-text { 
	padding: 2px 0 6px 0; 
}

.ui-button-text {
	line-height: 1em !important;
}

.ui-autocomplete-input { 
	margin: 0; 
	padding: 1px; 
}


/* confirmation box */
.ui-widget-content {
	background-color: #f7f7f7!important;
}

.ui-state-default, 
.ui-widget-header .ui-state-default,
.ui-widget-content .ui-state-default {
	background-color: #e6e6e6!important;
}

.ui-widget-header {
	background-color: #ccc!important;
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



/**
 * CKEditor
 */

span.cke_skin_kama {
	border-radius: 0!important;
	-moz-border-radius: 0!important;
	-webkit-border-radius: 0!important;
	padding: 0 !important;
}

.cke_skin_kama .cke_wrapper {
	border-radius: 0!important;
	-moz-border-radius: 0!important;
	-webkit-border-radius: 0!important;
}

.cke_wrapper.cke_ltr { background-color: #444!important; }

.cke_skin_kama a.cke_toolbox_collapser, 
.cke_skin_kama a:hover.cke_toolbox_collapser, 
.cke_skin_kama a:focus.cke_toolbox_collapser {
	background-color: #eee!important;
	border: none!important;
}

.cke_skin_kama .cke_toolgroup, 
.cke_skin_kama .cke_rcombo a, 
.cke_skin_kama .cke_rcombo a:active, 
.cke_skin_kama .cke_rcombo a:hover, 
.cke_skin_kama .cke_rcombo a:focus {
	background-color: #eee!important;
	background-image: none!important;
	background-repeat: no-repeat!important;
	background-position: initial!important;
	border-radius: 0!important;
	-moz-border-radius: 0!important;
	-webkit-border-radius: 0!important;
}

.cke_skin_kama a.cke_toolbox_collapser_min, 
.cke_skin_kama a:hover.cke_toolbox_collapser_min, 
.cke_skin_kama a:focus.cke_toolbox_collapser_min {	
}

.cke_editor table, 
.cke_editor tr, 
.cke_editor td {
		border: 0!important;
}

.cke_wrapper { padding: 4px !important; }

.cke_skin_kama .cke_contents iframe { 
	border-style: solid;
	border-width: 1px;
	color: #777;
	line-height: 1em;
	outline: 0;
}

a.cke_dialog_ui_button {
	background-image: url(<?php echo $img_button; ?>) !important;
	background-position: bottom !important;
	font-family: <?php print $fontlist; ?> !important;
	margin: 0em .5em !important;
	padding: .1em .7em !important;
}

.cke_dialog_ui_hbox_last {
	vertical-align: bottom !important;
}



/**
 * File upload
 */

.template-upload {
	height: 72px !important;
}


/**
 * JSGantt
 */

div.scroll2 {
	width: <?php print isset($_SESSION['dol_screenwidth'])?max($_SESSION['dol_screenwidth']-830,450):'450'; ?>px !important;
}

.gtaskname div, .gtaskname {
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

.gtaskname div, .gtaskname {
	min-width: 250px !important;
	max-width: 250px !important;
	width: 250px !important;
}

.gpccomplete div, .gpccomplete {
	min-width: 40px !important;
	max-width: 40px !important;
	width: 40px !important;
}

/**
 * jFileTree
 */

.ecmfiletree {
	background-color: <?php print $colorbacklineimpair1; ?>;
	color: <?php print $colorfline; ?>;
	font-weight: normal;
	height: 99%;
	padding-left: 2px;
	width: 99%;
}

.fileview {
	background-color: <?php print $colorbacklineimpair1; ?>;
	color: <?php print $colorfline; ?>;
	font-weight: normal;
	height: 99%;
	padding-left: 2px;
	padding-top: 4px;
	width: 99%;
}

div.filedirelem {
	display: block;
	position: relative;
	text-decoration: none;
}

ul.filedirelem {
	margin: 0 5px 5px 5px;
	padding: 2px;
}

ul.filedirelem li {
	border: solid 1px rgba(0,0,0, .24);
	display: block;
	float: <?php print $left; ?>;
	height: 120px;
	list-style: none;
	margin: 0 10px 20px 10px;
	padding: 2px;
	text-align: center;
	width: 160px;
}

ui-layout-north {
}

ul.ecmjqft,
div.tabBar ul.ecmjqft {
	font-weight: normal;
	line-height: 16px;
	margin: 0;
	padding: 0;
}

ul.ecmjqft li,
div.tabBar ul.ecmjqft li {
	display: block;
	list-style: none;
	margin: 5px 0;
	padding: 0;
	padding-left: 20px;
	padding-right: 120px;
	position: relative;
	white-space: nowrap;
}

ul.ecmjqft a,
div.tabBar ul.ecmjqft a {
	color: <?php echo $colorfline; ?>;
	display: inline-block !important;
	font-weight:normal;
	line-height: 20px;	
	padding: 0;
	vertical-align: middle;
}

ul.ecmjqft a:active,
div.tabBar ul.ecmjqft a:active {
	font-weight: bold !important;
}

ul.ecmjqft a:hover,
ul.ecmjqft a:focus,
div.tabBar ul.ecmjqft a:hover,
div.tabBar ul.ecmjqft a:focus {
	text-decoration: underline;
}

ul.ecmjqft div.ecmjqft {
	display: inline-block !important;
	position:absolute;
	right:4px;
	text-align: right;
	vertical-align: middle;
}

/* Core Styles */
.ecmjqft LI.directory { font-weight:normal; background: url(<?php echo dol_buildpath($path.'/theme/common/treemenu/folder2.png',1); ?>) left top no-repeat; }
.ecmjqft LI.expanded { font-weight:normal; background: url(<?php echo dol_buildpath($path.'/theme/common/treemenu/folder2-expanded.png',1); ?>) left top no-repeat; }
.ecmjqft LI.wait { font-weight:normal; background: url(<?php echo dol_buildpath('/theme/'.$theme.'/img/working.gif',1); ?>) left top no-repeat; }


/**
 * jNotify
 */

.jnotify-container {
	border-radius: initial !important;
	min-width: <?php echo $dol_optimize_smallscreen?'180':'200'; ?>px;
	margin-<?php print $left; ?>: 0 !important;
	margin-<?php print $right; ?>: 14px !important;
	position: absolute !important;
	text-align: center;
	<?php if ($conf->global->MAIN_MENU_INVERT) { ?>
		top: 55px !important;
	<?php } else { ?>
		top: 70px !important;
	<?php } ?>
	width: auto;
	<?php if (! empty($conf->global->MAIN_JQUERY_JNOTIFY_BOTTOM)) { ?>
		top: auto !important;
		bottom: 4px !important;
	<?php } ?>
	z-index: 100 !important;
}

.jnotify-container .jnotify-notification {
	margin: 0 !important;
}

.jnotify-container .jnotify-notification a.jnotify-close { 
	color: #eee !important;
	top: 14px !important; 
} 
 
.jnotify-container .jnotify-notification a.jnotify-close:hover,
.jnotify-container .jnotify-notification a.jnotify-close:focus { 
	color: #fff !important;
} 

div.jnotify-background {
	border-radius: initial !important;
	box-shadow: 0 1px 1px rgba(0,0,0, .04);
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0, .04);
	opacity: 1 !important;
}

.jnotify-container .jnotify-notification .jnotify-background {
	background-color: #33cc66 !important;
	border: 1px solid #29a352 !important;
}

.jnotify-container .jnotify-notification-error .jnotify-background {
	background-color: #f07b6e !important;
	border: 1px solid #e0796e !important;
}

.jnotify-container .jnotify-notification .jnotify-message {
	color: #f4f4f4 !important;
	font-weight: 500 !important;
	padding: 12px;
}


#tiptip_holder.tip_left #tiptip_arrow_inner { 
	border-left-color: rgba(85, 85, 85, .94)!important;
	border-left-color: #555!important; 
}

#tiptip_holder.tip_right #tiptip_arrow_inner { 
	border-right-color: rgba(85, 85, 85, .94)!important; 
	border-right-color: #555!important; 
}

#tiptip_holder.tip_top #tiptip_arrow_inner { 
	border-top-color: rgba(85, 85, 85, .94)!important; 
	border-top-color: #555!important; 
}

#tiptip_holder.tip_bottom #tiptip_arrow_inner { 
	border-bottom-color: rgba(85, 85, 85, .94)!important; 
	border-bottom-color: #555!important; 
}

#tiptip_holder.tip_left #tiptip_arrow_inner		{ margin-<?php print $left; ?>: -6px !important; }
#tiptip_holder.tip_right #tiptip_arrow_inner	{ margin-<?php print $right; ?>: -6px !important; }
#tiptip_holder.tip_bottom #tiptip_arrow_inner	{ margin-top: -6px !important; }
#tiptip_holder.tip_top #tiptip_arrow_inner		{ margin-bottom: -6px !important; }

#tiptip_content {
	background-color: rgb(247, 247, 247)!important;
	background-color: rgba(247, 247, 247, .94)!important;
	border: 1px solid rgba(255,255,255, .25);
	border-radius: inherit!important;
	-webkit-border-radius: inherit!important;
	-moz-border-radius: inherit!important;
	box-shadow: 0 0 2px #555!important;
	-webkit-box-shadow: 0 0 2px #555!important;
	-moz-box-shadow: 0 0 2px rgba(85, 85, 85, .94)!important;
	color: <?php echo $colorfline_hover; ?> !important;
	font-size: 12px;
	line-height: 1.3em;
	padding: .7em 1.2em!important;
	vertical-align: bottom;
}

/**
 * blockUI
 */

/* div.growlUI { 
	background: url(check48.png) no-repeat 10px 10px; 
} */

div.dolEventValid h1, 
div.dolEventValid h2 {
	background-color: #33cc66;
	color: #eee;
	padding: 5px 5px 5px 5px;
	text-align: left;
}

div.dolEventError h1, 
div.dolEventError h2 {
	background-color: #f07b6e;
	color: #eee;
	padding: 5px 5px 5px 5px;
	text-align: left;
}

/**
 * Maps	
 */

.divmap, 
#google-visualization-geomap-embed-0, 
#google-visualization-geomap-embed-1, 
#google-visualization-geomap-embed-2 {
	box-shadow: 0 0 10px #aaa;
	-moz-box-shadow: 0 0 10px #aaa;
	-webkit-box-shadow: 0 0 10px #aaa;
}

/**
 * Datatable
 */

table.dataTable tr.odd td.sorting_1, table.dataTable tr.even td.sorting_1 {
	background: none !important;
}
.sorting_asc	{ background: url('<?php echo dol_buildpath('/theme/'.$theme.'/img/sort_asc.png',1); ?>') no-repeat center right !important; }
.sorting_desc { background: url('<?php echo dol_buildpath('/theme/'.$theme.'/img/sort_desc.png',1); ?>') no-repeat center right !important; }
.sorting_asc_disabled	{ background: url('<?php echo dol_buildpath('/theme/'.$theme.'/img/sort_asc_disabled.png',1); ?>') no-repeat center right !important; }
.sorting_desc_disabled { background: url('<?php echo dol_buildpath('/theme/'.$theme.'/img/sort_desc_disabled.png',1); ?>') no-repeat center right !important; }
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
.paging_full_numbers a.paginate_active:hover, .paging_full_numbers a.paginate_button:hover,
.paging_full_numbers a.paginate_active:focus, .paging_full_numbers a.paginate_button:focus {
	background-color: #DDD !important;
}
.paging_full_numbers, .paging_full_numbers a.paginate_active, .paging_full_numbers a.paginate_button {
	background-color: #FFF !important;
	border-radius: inherit !important;
}
.paging_full_numbers a.paginate_button_disabled:hover,
.paging_full_numbers a.paginate_button_disabled:focus {
	background-color: #FFF !important;
}
.paginate_button, .paginate_active {
	border: 1px solid rgba(0,0,0, .24) !important;
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
	filter: Alpha(Opacity=35);
	background-image: none;
}

div.dataTables_length {
	float: right !important;
	padding-left: 8px;
}
div.dataTables_length select {
	background: #fff;
}

.dataTables_wrapper .dataTables_paginate {
	padding-top: 0px !important;
}

/**
 * Select2
 */
.select2-container .select2-choice {
	color: #000;
}
 
.selectoptiondisabledwhite {
	background: #fff !important;
}

.select2-choice,
.select2-drop.select2-drop-above.select2-drop-active,
.select2-container-active .select2-choice,
.select2-container-active .select2-choices,
.select2-dropdown-open.select2-drop-above .select2-choice,
.select2-dropdown-open.select2-drop-above .select2-choices,
.select2-container-multi.select2-container-active .select2-choices
{
	border: 1px solid #aaa;
}
.select2-disabled
{
	color: #888;
}
.select2-drop-active
{
	border: 1px solid #aaa;
	border-top: none;
}
a span.select2-chosen
{
	font-weight: normal !important;
}
.select2-container .select2-choice {
	background-image: none;
	height: 24px;
	line-height: 24px;
}
.select2-choices .select2-search-choice {
	border: 1px solid #aaa !important;
}
.select2-results .select2-no-results, .select2-results .select2-searching, .select2-results .select2-ajax-error, .select2-results .select2-selection-limit
{
	background: #fff;
}
.select2-container-multi.select2-container-disabled .select2-choices {
	background-color: #fff;
	background-image: none;
	border: none;
	cursor: default;
}
.select2-container-multi .select2-choices .select2-search-choice {
	margin-bottom: 3px;
}
/* To emulate select 2 style */
.select2-container-multi-dolibarr .select2-choices-dolibarr .select2-search-choice-dolibarr {
	padding: 2px 5px 1px 5px;
	margin: 0 0 2px 3px;
	position: relative;
	line-height: 13px;
	color: #444;
	cursor: default;
	border: 1px solid #aaa;
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
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#eeeeee', endColorstr='#f4f4f4', GradientType=0);
	background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), color-stop(100%, #eee));
	background-image: -webkit-linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
	background-image: -moz-linear-gradient(top, #f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eee 100%);
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

.select2-dropdown,
.select2-container--default .select2-selection--single .select2-selection__rendered,
.select2-container--default .select2-selection--single .select2-selection__placeholder {
	color: #444;
}

.select2-container--default .select2-results__option[aria-selected=true] {
	color: #222;
}

/**
 * JMobile
 */

li.ui-li-divider .ui-link {
	color: #fff !important;
}

.ui-btn {
	margin: .1em 2px;
}

a.ui-link, 
a.ui-link:hover, 
a.ui-link:focus, 
.ui-btn:hover, 
span.ui-btn-text:hover, 
span.ui-btn-inner:hover {
	text-decoration: none !important;
}

.ui-btn-inner {
	min-width: .4em;
	padding-left: 10px;
	padding-right: 10px;
	<?php if (empty($dol_use_jmobile) || 1==1) { ?>
	font-size: <?php print $fontsize; ?>px;
	<?php } ?>
	/* white-space: normal; */		/* Warning, enable this break the truncate feature */
}

.ui-btn-icon-right .ui-btn-inner	{ padding-right: 34px; }
.ui-btn-icon-left .ui-btn-inner		{ padding-left: 34px; }

.ui-select .ui-btn-icon-right .ui-btn-inner { padding-right: 38px; }
.ui-select .ui-btn-icon-left .ui-btn-inner	{ padding-left: 38px; }

.fiche .ui-controlgroup {
	margin: 0;
	padding-bottom: 0;
}

div.ui-controlgroup-controls div.tabsElem {
	margin-top: 2px;
}

div.ui-controlgroup-controls div.tabsElem a {
	box-shadow: 0 -3px 6px rgba(0,0,0, .2);
	-moz-box-shadow: 0 -3px 6px rgba(0,0,0, .2);
	-webkit-box-shadow: 0 -3px 6px rgba(0,0,0, .2);
}

div.ui-controlgroup-controls div.tabsElem a#active {
	box-shadow: 0 -3px 6px rgba(0,0,0, .3);
	-moz-box-shadow: 0 -3px 6px rgba(0,0,0, .3);
	-webkit-box-shadow: 0 -3px 6px rgba(0,0,0, .3);
}

a.tab span.ui-btn-inner {
	border: none;
	padding: 0;
}

.ui-body-c {
	border: 1px solid #ccc;
	text-shadow: none;
}

.ui-link {
	color: rgb(<?php print $colortext; ?>) !important;
}

a.ui-link {
	word-wrap: break-word;
}

/* force wrap possible onto field overflow does not works */
.formdoc .ui-btn-inner {
	overflow: hidden;
	text-overflow: hidden;
	white-space: normal;
}

/* Warning: setting this may make screen not beeing refreshed after a combo selection */
.ui-body-c {
	background-color: #fff;
}

div.ui-radio, 
div.ui-checkbox {
	border-bottom: 0 !important;
	display: inline-block;
}

.ui-checkbox input, 
.ui-radio input {
	height: auto;
	margin: 4px;
	position: static;
	width: auto;
}
div.ui-checkbox label+input, 
div.ui-radio label+input {
	position: absolute;
}

.ui-mobile fieldset {
	border-bottom: 1px solid #aaa !important;
	margin-bottom: 4px; 
	padding-bottom: 10px; 
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

/**
 * Public
 */
/* The theme for public pages */
.public_body {
	margin: 20px;
}
.public_border {
	border: 1px solid #888;
}

::-webkit-scrollbar {
	width: 12px;
}
::-webkit-scrollbar-button {
	background: #aaa
}
::-webkit-scrollbar-track-piece {
	background: #fff
}
::-webkit-scrollbar-thumb {
	background: #ddd
}​

/**
 * Ticket module
 */
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
	background: white;
	border-radius: 0.25em;
	padding: 1em;
	background-image: -o-linear-gradient(bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
	background-image: -moz-linear-gradient(bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
	background-image: -webkit-linear-gradient(bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
	background-image: -ms-linear-gradient(bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
	background-image: linear-gradient(bottom, rgba(0,0,0,0.1) 0%, rgba(230,230,230,0.4) 100%);
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
	border-right: 7px solid white;
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
		border-left-color: white;
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
		border-right-color: white;
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

/* Pagination */
div.refidpadding {
	padding-top: 3px;
}
div.refid {
	font-weight: bold;
	color: rgb(<?php print $colortexttitlenotab; ?>);
	font-size: 160%;
}
div.refidno	{
	padding-top: 2px;
	font-weight: normal;
	color: <?php echo $colorfline; ?>;
	font-size: <?php print $fontsize ?>px;
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
	border-radius: 4px;
}

div.pagination li.pagination a,
div.pagination li.pagination span {
	padding: 6px 12px;
	padding-top: 8px;
	line-height: 1.42857143;
	color: #000;
	text-decoration: none;
}
div.pagination li.pagination span.inactive {
	cursor: default;
	color: #ccc;
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
	border-top-left-radius: 4px;
	border-bottom-left-radius: 4px;
}
div.pagination li:last-child a,
div.pagination li:last-child span {
	border-top-right-radius: 4px;
	border-bottom-right-radius: 4px;
}
div.pagination li a:hover,
div.pagination li span:hover,
div.pagination li a:focus,
div.pagination li span:focus {
	color: #000;
	background-color: #eee;
	border-color: rgba(0,0,0, .24);
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
	background-color: <?php $colorbackhmenu1 ?>;
	border-color: #337ab7;
}
div.pagination .disabled span,
div.pagination .disabled span:hover,
div.pagination .disabled span:focus,
div.pagination .disabled a,
div.pagination .disabled a:hover,
div.pagination .disabled a:focus {
	color: #777;
	cursor: not-allowed;
	background-color: #fff;
	border-color: rgba(0,0,0, .24);
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

/* Prepare to remove class pair - impair
.noborder > tbody > tr:nth-child(even) td {
	background: linear-gradient(bottom, rgb(<?php echo $colorbacklineimpair1; ?>) 85%, rgb(<?php echo $colorbacklineimpair2; ?>) 100%);
	background: -o-linear-gradient(bottom, rgb(<?php echo $colorbacklineimpair1; ?>) 85%, rgb(<?php echo $colorbacklineimpair2; ?>) 100%);
	background: -moz-linear-gradient(bottom, rgb(<?php echo $colorbacklineimpair1; ?>) 85%, rgb(<?php echo $colorbacklineimpair2; ?>) 100%);
	background: -webkit-linear-gradient(bottom, rgb(<?php echo $colorbacklineimpair1; ?>) 85%, rgb(<?php echo $colorbacklineimpair2; ?>) 100%);
	background: -ms-linear-gradient(bottom, rgb(<?php echo $colorbacklineimpair1; ?>) 85%, rgb(<?php echo $colorbacklineimpair2; ?>) 100%);
	font-family: <?php print $fontlist ?>;
	border: 0px;
	margin-bottom: 1px;
	color: <?php echo $colorfline; ?>;
	min-height: 18px;
}

.noborder > tbody > tr:nth-child(odd) td {
	background: linear-gradient(bottom, rgb(<?php echo $colorbacklinepair1; ?>) 85%, rgb(<?php echo $colorbacklinepair2; ?>) 100%);
	background: -o-linear-gradient(bottom, rgb(<?php echo $colorbacklinepair1; ?>) 85%, rgb(<?php echo $colorbacklinepair2; ?>) 100%);
	background: -moz-linear-gradient(bottom, rgb(<?php echo $colorbacklinepair1; ?>) 85%, rgb(<?php echo $colorbacklinepair2; ?>) 100%);
	background: -webkit-linear-gradient(bottom, rgb(<?php echo $colorbacklinepair1; ?>) 85%, rgb(<?php echo $colorbacklinepair2; ?>) 100%);
	background: -ms-linear-gradient(bottom, rgb(<?php echo $colorbacklinepair1; ?>) 85%, rgb(<?php echo $colorbacklinepair2; ?>) 100%);
	font-family: <?php print $fontlist ?>;
	border: 0px;
	margin-bottom: 1px;
	color: <?php echo $colorfline; ?>;
}
*/

ul.noborder li:nth-child(odd):not(.liste_titre) {
	background-color: rgb(<?php echo $colorbacklinepair2; ?>) !important;
	background-color: rgb(<?php echo $colorbacklinepair2; ?>) !important;
	background-color: rgb(<?php echo $colorbacklinepair2; ?>) !important;
	background-color: rgb(<?php echo $colorbacklinepair2; ?>) !important;
	background-color: rgb(<?php echo $colorbacklinepair2; ?>) !important;
}

/* Prepare to remove class pair - impair */

.noborder > tbody > tr:nth-child(even):not(.liste_titre), .liste > tbody > tr:nth-child(even):not(.liste_titre) {
	background: #<?php echo colorArrayToHex(colorStringToArray($colorbacklineimpair1)); ?>;
}
.noborder > tbody > tr:nth-child(even):not(:last-child) td:not(.liste_titre), .liste > tbody > tr:nth-child(even):not(:last-child) td:not(.liste_titre) {
	border-bottom: 1px solid rgba(0,0,0, .24);
}

.noborder > tbody > tr:nth-child(odd):not(.liste_titre), .liste > tbody > tr:nth-child(odd):not(.liste_titre) {
	background: #<?php echo colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?>;
}
.noborder > tbody > tr:nth-child(odd):not(:last-child) td:not(.liste_titre), .liste > tbody > tr:nth-child(odd):not(:last-child) td:not(.liste_titre) {
	border-bottom: 1px solid rgba(0,0,0, .24);
}

ul.noborder li:nth-child(even):not(.liste_titre) {
	background-color: #<?php echo colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?>;
}

.oddeven:hover, .evenodd:hover
{
<?php if ($colorbacklinepairhover) { ?>
	background: rgb(<?php echo $colorbacklinepairhover; ?>) !important;
<?php } ?>
}

.oddeven, .evenodd
{
	font-family: <?php print $fontlist ?>;
	border: 0px;
	margin-bottom: 1px;
	color: <?php echo $colorfline; ?>;
}

#GanttChartDIV {
	background: #<?php echo colorArrayToHex(colorStringToArray($colorbacklineimpair1)); ?>;
}

table.dataTable tr.oddeven {
	background-color: #<?php echo colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?> !important;
}

/* For no hover style */
td.oddeven, tr.nohover td, form.nohover, form.nohover:hover {
	background-color: #<?php echo colorArrayToHex(colorStringToArray($colorbacklineimpair1)); ?> !important;
	background: #<?php echo colorArrayToHex(colorStringToArray($colorbacklineimpair1)); ?> !important;
}
td.evenodd {
	background-color: #<?php echo colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?> !important;
	background: #<?php echo colorArrayToHex(colorStringToArray($colorbacklinepair1)); ?> !important;
}
.trforbreak td {
	background-color: #<?php echo colorArrayToHex(colorStringToArray($colorbacklinebreak)); ?> !important;
}
.trforbreak td, table.noborder tr.trforbreak td a:link {
	color: #fff;
}

table.dataTable td {
	padding: 5px 2px 5px 3px !important;
}

div.arearef {
	/*border-bottom: 1px solid #bbb;*/
	padding-top: 2px;
	padding-bottom: 5px;
	/*padding-right: 3px;
	padding-left: 2px;*/
	margin-bottom: 10px;
}
div.heightref {
	min-height: 80px; 
}
div.divphotoref {
	padding-right: 20px;
}
div.statusref {
	float: right;
	padding-right: 12px;
	margin-top: 8px;
	margin-bottom: 10px;
	clear: both;
}
div.statusref img {
	padding-left: 8px;
	padding-right: 9px;
	vertical-align: text-bottom;
	width: 32px;
}
div.statusrefbis {
	padding-left: 8px;
	padding-right: 9px;
	vertical-align: text-bottom;
}
img.photoref, div.photoref {
	border: 1px solid rgba(0,0,0, .22);
	-webkit-box-shadow: 3px 3px 4px rgba(0,0,0, .24);
	box-shadow: 3px 3px 4px rgba(0,0,0, .24);
	padding: 4px;
	height: 80px;
	width: 80px;
	object-fit: contain;
}
img.fitcontain {
	object-fit: contain;
}
div.photoref {
	display:table-cell;
	vertical-align:middle;
	text-align:center;
}
img.photorefnoborder {
	padding: 2px;
	height: 48px;
	width: 48px;
	object-fit: contain;
	border: 1px solid #AAA;
	border-radius: 100px;
}
.underrefbanner {
}
.underbanner {
	border-bottom: 2px solid #888;
}
.tdhrthin {
	margin: 0;
	padding-bottom: 0 !important;
}
.badge {
	display: inline-block;
	min-width: 10px;
	padding: 2px 5px;
	font-size: 10px;
	font-weight: 700;
	line-height: 0.9em;
	color: #fff;
	text-align: center;
	white-space: nowrap;
	vertical-align: baseline;
	background-color: #777;
	border-radius: 10px;
}

/* ============================================================================== */
/*	Multiselect with checkbox													  */
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
	color: <?php echo $colorfline; ?>;
	background-color: #FFF;
	border: 1px solid #888;
	display:none;
	right:0px;						/* pop is align on right */
	padding: 2px 15px 2px 5px;
	position:absolute;
	top:2px;
	list-style:none;
	max-height: 264px;
	overflow: auto;
}
.dropdown dd ul li {
	white-space: nowrap;
	font-weight: normal;
	padding: 2px;
	color: #000;
}
.dropdown dd ul li input[type="checkbox"] {
	margin-right: 3px;
}
.dropdown dd ul li a, .dropdown dd ul li span {
	padding: 3px;
	display: block;
}
.dropdown dd ul li span {
	color: #888;
}
.dropdown dd ul li a:hover,
.dropdown dd ul li a:focus {
	background-color:#fff;
}

img.loginphoto {
	border-radius: 2px;
	width: 16px;
	height: 16px;
}
.span-icon-user {
	background: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/object_user.png',1); ?>) no-repeat scroll 7px 7px;
}
.span-icon-password {
	background-image: url(<?php echo dol_buildpath($path.'/theme/'.$theme.'/img/lock.png',1); ?>);
	background-repeat: no-repeat;
}

/* ============================================================================== */
/* Compatibility Multicompany													  */
/* ============================================================================== */
#entity {
	width: 188px !important;
}

/* ============================================================================== */
/* CSS style used for small screen												  */
/* ============================================================================== */

.imgopensurveywizard
{
	padding: 0 4px 0 4px;
}


/* rule to reduce inverted top menu */
@media only screen and (max-width: 1200px)
{
	#tmenu_tooltipinvert .sec-nav__item {
		max-width: 160px;
	}
	#tmenu_tooltipinvert .sec-nav__item .icon {
		font-size: 20px;
		padding: 0 5px;
	}
	.sec-nav__link {
		overflow: hidden;
		text-overflow: ellipsis;
	}
}

/* rule to reduce inverted top menu */
@media only screen and (max-width: 1024px)
{
	#tmenu_tooltipinvert .sec-nav__item {
		max-width: 140px;
	}
	#tmenu_tooltipinvert .sec-nav__item .icon {
		font-size: 24px;
		padding: 0 5px;
	}
	.sec-nav__sub-item {
		overflow-wrap: break-word;
	}

	div.vmenu {
		min-width: 170px;
		max-width: 100%;
	}

	.vmenusearchselectcombo {
		min-width: 150px;
		max-width: 100%;
	}
	.sec-nav.is-inverted {
		<?php if( $conf->global->OBLYON_SHOW_COMPNAME || $conf->global->OBLYON_FULLSIZE_TOPBAR || $conf->dol_optimize_smallscreen ) { ?>
			margin-<?php print $left; ?>: 10px;
		<?php } else { ?>
			margin-<?php print $left; ?>: 170px;
		<?php } ?>
	}
}

/* rule to reduce inverted top menu */
@media only screen and (max-width: 905px)
{
	#tmenu_tooltipinvert .sec-nav__item {
		max-width: 120px;
	}
}

/* rule to reduce top menu */
@media only screen and (max-width: 767px)
{
	#tmenu_tooltip .main-nav__item {
		max-width: 66px;
	}
	.main-nav__link {
		overflow: hidden;
		text-overflow: ellipsis;
	}

	#tmenu_tooltipinvert .sec-nav__item {
		max-width: 100px;
	}
	#tmenu_tooltipinvert .sec-nav__item .icon {
		font-size: 28px;
		padding: 0 10px;
	}

	div.vmenu {
		min-width: 130px;
	}

	.vmenusearchselectcombo {
		min-width: 110px;
	}
	.sec-nav.is-inverted {
		<?php if( $conf->global->OBLYON_SHOW_COMPNAME || $conf->global->OBLYON_FULLSIZE_TOPBAR || $conf->dol_optimize_smallscreen ) { ?>
			margin-<?php print $left; ?>: 5px;
		<?php } else { ?>
			margin-<?php print $left; ?>: 130px;
		<?php } ?>
	}
}

/* nboftopmenuentries = <?php echo $nbtopmenuentries ?>, fontsize=<?php echo $fontsize ?> */
/* rule to reduce top menu - 1st reduction */
@media only screen and (max-width: <?php echo round($nbtopmenuentries * $fontsize * 6.7, 0) + 8; ?>px)
{
	div.tmenucenter {
		max-width: <?php echo round($fontsize * 4); ?>px;	/* size of viewport */
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		color: #<?php echo $colortextbackhmenu; ?>;
	}
	.mainmenuaspan {
		font-size: 12px;
	}
	.topmenuimage {
		background-size: 26px auto;
		margin-top: 0px;
	}
	li.tmenu, li.tmenusel {
		min-width: 32px;
	}
	div.mainmenu {
		min-width: auto;
	}
	div.tmenuleft {
		display: none;
	}
}

/* rule to reduce top menu - 2nd reduction */
@media only screen and (max-width: <?php echo round($nbtopmenuentries * $fontsize * 4.5, 0) + 8; ?>px)
{
	div.tmenucenter {
		max-width: <?php echo round($fontsize * 2); ?>px;	/* size of viewport */
		text-overflow: clip;
	}
	.mainmenuaspan {
		font-size: 10px;
		padding-left: 0;
		padding-right: 0;
	}
	.topmenuimage {
		background-size: 20px auto;
		margin-top: 2px;
	}
}

/* rule to reduce top menu - 3rd reduction */
@media only screen and (max-width: 570px)
{
	/* Reduce login top right info */
	.usertext.atoplogin {
		display: none;
	}
	div#tmenu_tooltip, #tmenu_tooltipinvert {
	<?php if (GETPOST("optioncss") == 'print') {	?>
		display:none;
	<?php } else { ?>
		padding-<?php echo $right; ?>: 92px;
	<?php } ?>
	}
	div.login_block {
		top: 0px;
		max-width: 96px;
	}
	div.login_block_other {
		min-width: 40px;
		margin-right: 6px;
		height: auto;
	}
	div.login_block_other .inline-block {
		display: block;
		width: auto;
	}
	li.tmenu, li.tmenusel {
		min-width: 30px;
	}

	div.tmenucenter {
		text-overflow: clip;
	}
	.topmenuimage {
		background-size: 20px auto;
		margin-top: 2px !important;
	}
	div.mainmenu {
		min-width: 20px;
	}

	#tooltip {
		position: absolute;
		width: <?php print dol_size(300,'width'); ?>px;
	}

	select {
		width: 98%;
		min-width: 0 !important;
	}
	div.divphotoref {
		padding-right: 5px;
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

	.titlefield {
		width: auto !important;		/* We want to ignor the 30%, try to use more if you can */
	}
	.tableforfield>tr>td:first-child {
		max-width: 100px;			/* but no more than 100px */
	}
}

<?php
include dol_buildpath($path.'/theme/'.$theme.'/dropdown.inc.php', 0);
?>

/* end zlib compression */
<?php if(extension_loaded('zlib')){ob_end_flush();}?>


<?php
if (is_object($db)) $db->close();
?>
