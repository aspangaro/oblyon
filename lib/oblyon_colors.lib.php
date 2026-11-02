<?php
	/************************************************
	* Copyright (C) 2026   Sylvain Legrand   <contact@infras.fr>   InfraS - <https://www.infras.fr>
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
	* 	\file		../oblyon/lib/oblyon_colors.lib.php
	* 	\ingroup	oblyon
	* 	\brief		Colours per user (3.6.0) : one reading point for the theme, list of the colour constants, helpers of the user tab
	*
	*	Storage : llx_user_param (dol_set_user_param) with the flag OBLYON_USER_COLORS = 1 and one row per colour constant
	*	(full snapshot of the instance colours at the time the user ticks the box, then edited by him). The theme reads every
	*	colour through oblyon_color_setting() : the personal value when the flag is set and the value looks like a colour,
	*	else the instance value (llx_const). Pages without a user (login, password) always get the instance values.
	************************************************/

	/**
	*	Are the personal colours of a user active ? (flag OBLYON_USER_COLORS, or the historical THEME_ELDY_ENABLE_PERSONALIZED user param)
	*
	*	@param		User|null	$tmpuser	User (null = current user)
	*	@return		bool
	**/
	function oblyon_user_colors_enabled($tmpuser = null)
	{
		if (empty($tmpuser)) {
			global $user;
			$tmpuser	= $user;
		}
		if (empty($tmpuser) || empty($tmpuser->id) || empty($tmpuser->conf))	return false;	// no user loaded (NOLOGIN pages) : instance colours
		return (getDolUserInt('OBLYON_USER_COLORS', 0, $tmpuser) > 0 || getDolUserString('THEME_ELDY_ENABLE_PERSONALIZED', '', $tmpuser) !== '');
	}

	/**
	*	Constants the theme normalizes with colorStringToArray() (style.css.php) : they also accept the 'r,g,b' form
	*	(written by the core user/param_ihm.php for THEME_ELDY_TOPMENU_BACK1 / THEME_ELDY_BACKTITLE1). Every other constant is printed as is in the CSS.
	*
	*	@return		array		Constant names
	**/
	function oblyon_colors_rgb_allowed()
	{
		return array('THEME_ELDY_TOPMENU_BACK1', 'THEME_ELDY_VERMENU_BACK1', 'THEME_ELDY_TOPBORDER_TITLE1', 'THEME_ELDY_BACKTITLE1', 'THEME_ELDY_BACKTABCARD1', 'THEME_ELDY_BACKTABACTIVE',
					'THEME_ELDY_LINEIMPAIR1', 'THEME_ELDY_LINEIMPAIR2', 'THEME_ELDY_LINEPAIR1', 'THEME_ELDY_LINEPAIR2', 'THEME_ELDY_LINEBREAK', 'THEME_ELDY_BACKBODY',
					'THEME_ELDY_TEXTTITLENOTAB', 'THEME_ELDY_TEXTTITLE', 'THEME_ELDY_TEXTTITLELINK', 'THEME_ELDY_TEXT', 'THEME_ELDY_TEXTLINK', 'THEME_ELDY_USE_HOVER', 'THEME_ELDY_USE_CHECKED',
					'OBLYON_COLOR_LOGIN_BCKGRD');
	}

	/**
	*	Is a value a colour the theme can use for this constant ? '#RRGGBB' (6 digits : the core colorStringToArray() does not read 3 digits), '#' alone
	*	(inherit convention of the menu texts), or 'r,g,b' (0-255) for the constants the theme normalizes (oblyon_colors_rgb_allowed()).
	*	The core also writes THEME_ELDY_USE_HOVER / THEME_ELDY_USE_CHECKED = 0 / 1 in llx_user_param : those are not colours for Oblyon and are ignored.
	*
	*	@param		string	$value		Value
	*	@param		string	$name		Constant name ('' = unknown : only the '#' forms are accepted)
	*	@return		bool
	**/
	function oblyon_color_is_valid($value, $name = '')
	{
		if (preg_match('/^#([0-9a-f]{6})?$/i', $value))	return true;
		if ($name !== '' && in_array($name, oblyon_colors_rgb_allowed()) && preg_match('/^(\d{1,3}),(\d{1,3}),(\d{1,3})$/', $value, $reg)) {
			return ((int) $reg[1] <= 255 && (int) $reg[2] <= 255 && (int) $reg[3] <= 255);
		}
		return false;
	}

	/**
	*	Single storage format (3.7.0) : '#RRGGBB'. An 'r,g,b' value (written by the core "Display setup" pages for 14 THEME_ELDY_* constants, or an old default of theme_vars.inc.php)
	*	is converted ; a 6-digit hex is kept (upper case) ; anything else is returned as is, or replaced by $fallback when given (e.g. '0.0.0')
	*
	*	@param		string	$value		Value
	*	@param		string	$fallback	Value returned when $value is neither '#RRGGBB' nor 'r,g,b' ('' = return $value unchanged)
	*	@return		string
	**/
	function oblyon_color_to_hex($value, $fallback = '')
	{
		$value	= trim((string) $value);
		if (preg_match('/^#[0-9a-f]{6}$/i', $value))	return strtoupper($value);
		if (preg_match('/^(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})$/', $value, $reg) && (int) $reg[1] <= 255 && (int) $reg[2] <= 255 && (int) $reg[3] <= 255) {
			return sprintf('#%02X%02X%02X', (int) $reg[1], (int) $reg[2], (int) $reg[3]);
		}
		return ($fallback !== '' ? $fallback : $value);
	}

	/**
	*	Rewrite the stored colours that are still 'r,g,b' as '#RRGGBB' (3.7.0) : the instance constants (llx_const, $tmpuser = null) or the personal colours of a user (llx_user_param).
	*	Idempotent, one write per converted value, CSS revision bumped when something changed. Called when the Colors tabs open.
	*
	*	@param		User|null	$tmpuser	User whose personal colours are normalized, null = instance constants
	*	@return		int					Number of converted values
	**/
	function oblyon_colors_normalize_stored($tmpuser = null)
	{
		global $db, $conf;

		require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
		$count	= 0;
		foreach (oblyon_user_colors_keys() as $name) {
			if ($tmpuser === null) {
				$value	= getDolGlobalString($name);
			} else {
				if (empty($tmpuser->conf) || ! isset($tmpuser->conf->$name))	continue;
				$value	= (string) $tmpuser->conf->$name;
			}
			if (! preg_match('/^\d{1,3}\s*,\s*\d{1,3}\s*,\s*\d{1,3}$/', $value))	continue;
			$hex	= oblyon_color_to_hex($value);
			if ($hex === $value)	continue;
			if ($tmpuser === null) {
				if (dolibarr_set_const($db, $name, $hex, 'chaine', 0, 'Oblyon module', $conf->entity) > 0)	$count++;
			} else {
				if (dol_set_user_param($db, $conf, $tmpuser, array($name => $hex)) > 0)	$count++;
			}
		}
		if ($count)	dolibarr_set_const($db, 'MAIN_IHM_PARAMS_REV', getDolGlobalInt('MAIN_IHM_PARAMS_REV') + 1, 'chaine', 0, '', $conf->entity);
		return $count;
	}

	/**
	*	Colour setting : the personal value of the user when his personal colours are on and the value looks like a colour, else the instance value ; 'r,g,b' converted to '#RRGGBB' (3.7.0)
	*
	*	@param		string		$name		Constant name
	*	@param		string		$default	Default when neither the user nor the instance defines it
	*	@param		User|null	$tmpuser	User (null = current user)
	*	@return		string
	**/
	function oblyon_color_setting($name, $default = '', $tmpuser = null)
	{
		if (empty($tmpuser)) {
			global $user;
			$tmpuser	= $user;
		}
		if (oblyon_user_colors_enabled($tmpuser) && isset($tmpuser->conf->$name)) {
			$value	= (string) $tmpuser->conf->$name;
			if (oblyon_color_is_valid($value, $name))	return oblyon_color_to_hex($value);
		}
		return oblyon_color_to_hex(getDolGlobalString($name, $default));
	}

	/**
	*	Colour setting that must be a real colour : the value (user then instance) when it is '#RRGGBB', else the default.
	*	'' and '#' (inherit convention) fall back to the default : for the tokens painted as plain CSS colours (3.7.0)
	*
	*	@param		string		$name		Constant name
	*	@param		string		$default	Default '#RRGGBB'
	*	@param		User|null	$tmpuser	User (null = current user)
	*	@return		string
	**/
	function oblyon_color_setting_hex($name, $default, $tmpuser = null)
	{
		$value	= oblyon_color_setting($name, '', $tmpuser);
		return (preg_match('/^#[0-9a-f]{6}$/i', $value) ? $value : $default);
	}

	/**
	*	Mix two colours : $ratio = 0 gives $hex1, 1 gives $hex2 (design tokens of the theme, tints of the buttons ; moved here from style.css.php in 3.8.0
	*	so that the Colors tabs can show the derived button colours)
	*
	*	@param		string	$hex1		Colour 1 (#RRGGBB or r,g,b)
	*	@param		string	$hex2		Colour 2
	*	@param		float	$ratio		Weight of colour 2 (0..1)
	*	@return		string				#RRGGBB
	**/
	function oblyon_mix_colors($hex1, $hex2, $ratio)
	{
		if (! function_exists('colorStringToArray'))	require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';
		$a		= colorStringToArray($hex1);
		$b		= colorStringToArray($hex2);
		$out	= array();
		for ($i = 0; $i < 3; $i++) {
			$out[]	= max(0, min(255, (int) round($a[$i] + ($b[$i] - $a[$i]) * $ratio)));
		}
		return '#'.colorArrayToHex($out);
	}

	/**
	*	Text colour to paint on a background : the one of two candidates with the best WCAG contrast (3.7.0 : status badges, whose text was white or the row text whatever the background)
	*
	*	@param		string	$background		Background '#RRGGBB'
	*	@param		string	$dark			Dark candidate
	*	@param		string	$light			Light candidate
	*	@return		string					$dark or $light ($light when the background is not a colour)
	**/
	function oblyon_text_on($background, $dark = '#1C1C1C', $light = '#FFFFFF')
	{
		$lum	= function ($hex) {
			$hex	= ltrim($hex, '#');
			if (! preg_match('/^[0-9a-f]{6}$/i', $hex))	return null;
			$out	= array();
			foreach (str_split($hex, 2) as $part) {
				$c		= hexdec($part) / 255;
				$out[]	= ($c <= 0.03928) ? $c / 12.92 : pow(($c + 0.055) / 1.055, 2.4);
			}
			return 0.2126 * $out[0] + 0.7152 * $out[1] + 0.0722 * $out[2];
		};
		$lb	= $lum($background);
		if ($lb === null)	return $light;
		$ratio	= function ($l1, $l2) { return (max($l1, $l2) + 0.05) / (min($l1, $l2) + 0.05); };
		return ($ratio($lum($dark), $lb) >= $ratio($lum($light), $lb)) ? $dark : $light;
	}

	/**
	*	Colour constants offered on the user tab, grouped like the Colors tab of the module (admin/colors.php) then the dashboard tiles.
	*	Group key = lang key. The top / left menu groups are swapped when the menus are inverted (same as admin/colors.php).
	*
	*	@return		array		group lang key => array of constant names
	**/
	/**
	*	Is a colour of the Tabs group offered for the current tab style (3.8.0) ? Boxed : the three historical colours ; pills : OBLYON_COLOR_TAB_PILL_* ;
	*	underline : OBLYON_COLOR_TAB_UNDER_*. Any other constant is always offered.
	*
	*	@param		string	$name		Constant name
	*	@return		bool
	**/
	function oblyon_tab_color_visible($name)
	{
		$style	= getDolGlobalString('OBLYON_TABS_STYLE', 'boxed');
		if (strpos($name, 'OBLYON_COLOR_TAB_PILL_') === 0)	return ($style == 'pills');
		if (strpos($name, 'OBLYON_COLOR_TAB_UNDER_') === 0)	return ($style == 'underline');
		if (in_array($name, array('THEME_ELDY_BACKTABACTIVE', 'THEME_ELDY_BACKTABCARD1', 'OBLYON_COLOR_TEXTTABACTIVE')))	return ($style == 'boxed');
		if (strpos($name, 'OBLYON_COLOR_LISTHEAD_FLAT_') === 0)	return (getDolGlobalString('OBLYON_LIST_HEADER_STYLE', 'band') == 'flat');	// 3.8.0 : en-tetes de liste plats (groupe Titres)
		return true;
	}

	/**
	*	Button families of the Colors tabs (3.8.0) : for each family, the five colours the theme paints (background, text, border, hover background, hover text),
	*	in display order, for a button style. The filled style uses the historical constants (THEME_ELDY_BTNACTION = background, OBLYON_COLOR_BUTTON_ACTION2 = hover
	*	background...) ; the outline and soft styles ("flat") share their own set (OBLYON_COLOR_BUTTON_[DELETE_|FORM_]FLAT_*, empty = derived from the filled button colour),
	*	because the filled text (white) and background would give an invisible flat button. Form buttons (.button : Save, Cancel...) follow the action buttons
	*	unless OBLYON_BUTTON_FORM_OWN_COLORS is set.
	*
	*	@param		string	$style		filled / outline / soft ('' = current OBLYON_BUTTON_STYLE)
	*	@param		bool	$all		True = the form family too, whatever OBLYON_BUTTON_FORM_OWN_COLORS
	*	@return		array		family key => array('label' => lang key, 'colors' => array(role => constant))
	**/
	function oblyon_button_families($style = '', $all = false)
	{
		if ($style === '')	$style	= getDolGlobalString('OBLYON_BUTTON_STYLE', 'filled');
		$flat		= ($style == 'outline' || $style == 'soft');
		$roles		= array('bg' => 'BCKGRD', 'txt' => 'TXT', 'border' => 'BORDER', 'bg_hover' => 'BCKGRD_HOVER', 'txt_hover' => 'TXT_HOVER');
		$families	= array();
		foreach (array('action' => 'OblyonBtnFamilyAction', 'delete' => 'OblyonBtnFamilyDelete', 'form' => 'OblyonBtnFamilyForm') as $key => $label) {
			if ($key == 'form' && ! $all && ! getDolGlobalInt('OBLYON_BUTTON_FORM_OWN_COLORS'))	continue;
			$prefix	= 'OBLYON_COLOR_BUTTON_'.($key == 'action' ? '' : strtoupper($key).'_').($flat ? 'FLAT_' : '');
			$colors	= array();
			foreach ($roles as $role => $suffix)	$colors[$role]	= $prefix.$suffix;
			if (! $flat) {	// filled : historical constants
				if ($key == 'action') {
					$colors['bg']			= 'THEME_ELDY_BTNACTION';
					$colors['txt']			= 'THEME_ELDY_TEXTBTNACTION';
					$colors['bg_hover']		= 'OBLYON_COLOR_BUTTON_ACTION2';
				} elseif ($key == 'delete') {
					$colors['bg']			= 'OBLYON_COLOR_BUTTON_DELETE1';
					$colors['bg_hover']		= 'OBLYON_COLOR_BUTTON_DELETE2';
				}
			}
			$families[$key]	= array('label' => $label, 'colors' => $colors);
		}
		return $families;
	}

	/**
	*	Effective colours of the button families for a style (3.8.0) : the stored colour when it is '#RRGGBB', else the derived one
	*	(filled : theme defaults ; outline : transparent background, border = text, hover = light tint of the text ; soft : tinted background, stronger on hover).
	*	Shared by style.css.php (CSS tokens) and by the two Colors tabs, which show these real values in the pickers instead of an empty "automatic" field.
	*	'css' = value painted by the theme ('transparent' possible for the background and the border) ; 'hex' = the same as a real colour for the pickers
	*	(transparent background = page background, transparent border = the button background) ; 'auto' = derived (nothing stored)
	*
	*	@param		string		$style		filled / outline / soft ('' = current style)
	*	@param		User|null	$tmpuser	User (null = current user) : personal colours when enabled
	*	@return		array					family => role => array('css' => string, 'hex' => string, 'auto' => bool)
	**/
	function oblyon_button_effective_colors($style = '', $tmpuser = null)
	{
		if ($style === '')	$style	= getDolGlobalString('OBLYON_BUTTON_STYLE', 'filled');
		if (! in_array($style, array('filled', 'outline', 'soft')))	$style	= 'filled';
		$rowbg		= oblyon_color_setting_hex('OBLYON_COLOR_BLINE', '#FFFFFF', $tmpuser);
		$pagebg		= oblyon_color_setting_hex('THEME_ELDY_BACKBODY', '#FFFFFF', $tmpuser);
		$action		= array('bg' => oblyon_color_setting_hex('THEME_ELDY_BTNACTION', '#0088CC', $tmpuser), 'txt' => oblyon_color_setting_hex('THEME_ELDY_TEXTBTNACTION', '#FFFFFF', $tmpuser),
							'bg_hover' => oblyon_color_setting_hex('OBLYON_COLOR_BUTTON_ACTION2', '#0044CC', $tmpuser));	// theme_vars.inc.php defaults
		$delete		= array('bg' => oblyon_color_setting_hex('OBLYON_COLOR_BUTTON_DELETE1', '#CC8800', $tmpuser), 'txt' => $action['txt'],
							'bg_hover' => oblyon_color_setting_hex('OBLYON_COLOR_BUTTON_DELETE2', '#CC4400', $tmpuser));
		$defaults	= array('action' => $action, 'delete' => $delete, 'form' => $action);
		$out		= array();
		foreach (oblyon_button_families($style, true) as $key => $family) {
			$d		= $defaults[$key];
			$c		= array();
			$auto	= array();
			foreach ($family['colors'] as $role => $name) {
				$c[$role]		= oblyon_color_setting_hex($name, '', $tmpuser);
				$auto[$role]	= ($c[$role] === '');
			}
			if ($c['txt'] === '')	$c['txt']	= ($style == 'filled') ? $d['txt'] : $d['bg'];	// outline / soft : the text takes the button colour (background of the filled style)
			if ($style == 'outline') {
				if ($c['bg'] === '')		$c['bg']		= 'transparent';
				if ($c['border'] === '')	$c['border']	= $c['txt'];
				if ($c['bg_hover'] === '')	$c['bg_hover']	= oblyon_mix_colors($rowbg, $c['txt'], 0.12);
			} elseif ($style == 'soft') {
				if ($c['bg'] === '')		$c['bg']		= oblyon_mix_colors($rowbg, $c['txt'], 0.12);
				if ($c['border'] === '')	$c['border']	= 'transparent';
				if ($c['bg_hover'] === '')	$c['bg_hover']	= oblyon_mix_colors($rowbg, $c['txt'], 0.22);
			} else {
				if ($c['bg'] === '')		$c['bg']		= $d['bg'];
				if ($c['border'] === '')	$c['border']	= 'transparent';
				if ($c['bg_hover'] === '')	$c['bg_hover']	= $d['bg_hover'];
			}
			if ($c['txt_hover'] === '')	$c['txt_hover']	= $c['txt'];
			$out[$key]	= array();
			foreach ($c as $role => $css) {
				$hex	= $css;
				if ($css === 'transparent')	$hex	= ($role == 'bg' ? $pagebg : ($c['bg'] === 'transparent' ? $pagebg : $c['bg']));
				$out[$key][$role]	= array('css' => $css, 'hex' => strtoupper($hex), 'auto' => $auto[$role]);
			}
		}
		return $out;
	}

	/**
	*	Button colour constants whose stored value is automatic ('' or '#'), with the real colour the pickers show for them (3.8.0).
	*	The Colors tabs keep such a constant automatic when the posted colour equals this value (the user did not touch it)
	*
	*	@param		User|null	$tmpuser	User (null = current user)
	*	@return		array					constant name => '#RRGGBB'
	**/
	function oblyon_button_auto_values($tmpuser = null)
	{
		$auto		= array();
		$families	= oblyon_button_families('', true);
		foreach (oblyon_button_effective_colors('', $tmpuser) as $key => $roles) {
			foreach ($roles as $role => $c) {
				if ($c['auto'])	$auto[$families[$key]['colors'][$role]]	= $c['hex'];
			}
		}
		return $auto;
	}

	/**
	*	Constants of the Buttons group for the current button style, in display order
	*
	*	@return		array		Constant names
	**/
	function oblyon_button_colors_list()
	{
		$list	= array();
		foreach (oblyon_button_families() as $family)	$list	= array_merge($list, array_values($family['colors']));
		return $list;
	}

	/**
	*	Every button colour constant, whatever the style and the form option (presets, contrast, backup) : 30 constants
	*
	*	@return		array		Constant names
	**/
	function oblyon_button_colors_all()
	{
		$list	= array();
		foreach (array('filled', 'outline') as $style) {
			foreach (oblyon_button_families($style, true) as $family)	$list	= array_merge($list, array_values($family['colors']));
		}
		return array_values(array_unique($list));
	}

	function oblyon_user_colors_list()
	{
		$top	= array('OBLYON_COLOR_TOPMENU_BCKGRD', 'OBLYON_COLOR_TOPMENU_BCKGRD_HOVER', 'OBLYON_COLOR_TOPMENU_TXT', 'OBLYON_COLOR_TOPMENU_TXT_ACTIVE', 'OBLYON_COLOR_TOPMENU_TXT_HOVER',
						'OBLYON_COLOR_TOPMENU_BCKGRD_SEL', 'OBLYON_COLOR_TOPMENU_TXT_SEL');	// 3.7.0 : entree selectionnee
		$left	= array('OBLYON_COLOR_LEFTMENU_BCKGRD', 'OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER', 'OBLYON_COLOR_LEFTMENU_TXT', 'OBLYON_COLOR_LEFTMENU_TXT_ACTIVE', 'OBLYON_COLOR_LEFTMENU_TXT_HOVER');
		$list	= array();
		if (!getDolGlobalString('MAIN_MENU_INVERT')) {
			$list['TopMenu']	= $top;
			$list['LeftMenu']	= $left;
		} else {
			$list['LeftMenu']	= $top;
			$list['TopMenu']	= $left;
		}
		$list['Buttons']						= oblyon_button_colors_list();	// 3.8.0 : familles (action, suppression, formulaire) x roles utiles au style de boutons choisi
		$list['OblyonColorGrpMessages']			= array('OBLYON_COLOR_INFO_BORDER', 'OBLYON_COLOR_INFO_BCKGRD', 'OBLYON_COLOR_INFO_TEXT', 'OBLYON_COLOR_WARNING_BORDER', 'OBLYON_COLOR_WARNING_BCKGRD', 'OBLYON_COLOR_WARNING_TEXT',
														'OBLYON_COLOR_ERROR_BORDER', 'OBLYON_COLOR_ERROR_BCKGRD', 'OBLYON_COLOR_ERROR_TEXT', 'OBLYON_COLOR_NOTIF_INFO_BCKGRD', 'OBLYON_COLOR_NOTIF_INFO_TEXT',
														'OBLYON_COLOR_NOTIF_WARNING_BCKGRD', 'OBLYON_COLOR_NOTIF_WARNING_TEXT', 'OBLYON_COLOR_NOTIF_ERROR_BCKGRD', 'OBLYON_COLOR_NOTIF_ERROR_TEXT');
		$list['OblyonColorGrpBackgrounds']		= array('OBLYON_COLOR_MAIN', 'OBLYON_COLOR_BCKGRD', 'OBLYON_COLOR_INPUT_BCKGRD', 'OBLYON_COLOR_INPUT_ADD_BCKGRD', 'OBLYON_COLOR_OVERLAY_BCKGRD', 'OBLYON_COLOR_LOGO_BCKGRD', 'OBLYON_COLOR_LOGIN_BCKGRD');
		$list['OblyonColorGrpText']				= array('THEME_ELDY_TEXT', 'THEME_ELDY_TEXTLINK', 'OBLYON_COLOR_ICON_TEXT');
		$list['OblyonColorGrpTitles']			= array_values(array_filter(array('OBLYON_COLOR_BTITLE', 'OBLYON_COLOR_STITLE', 'THEME_ELDY_TEXTTITLE', 'THEME_ELDY_TEXTTITLENOTAB', 'THEME_ELDY_TOPBORDER_TITLE1', 'THEME_ELDY_BACKTITLE1',
														'OBLYON_COLOR_LISTHEAD_FLAT_BCKGRD', 'OBLYON_COLOR_LISTHEAD_FLAT_TXT', 'OBLYON_COLOR_LISTHEAD_FLAT_LINE', 'OBLYON_COLOR_LISTHEAD_FLAT_SEL'), 'oblyon_tab_color_visible'));	// 3.8.0 : couleurs des en-tetes plats seulement dans ce style
		$list['OblyonColorGrpTabs']				= array_values(array_filter(array('THEME_ELDY_BACKTABACTIVE', 'THEME_ELDY_BACKTABCARD1', 'OBLYON_COLOR_TEXTTABACTIVE',
														'OBLYON_COLOR_TAB_PILL_BCKGRD', 'OBLYON_COLOR_TAB_PILL_TXT', 'OBLYON_COLOR_TAB_PILL_BORDER',
														'OBLYON_COLOR_TAB_UNDER_BAND', 'OBLYON_COLOR_TAB_UNDER_TXT', 'OBLYON_COLOR_TAB_UNDER_LINE'), 'oblyon_tab_color_visible'));	// 3.8.0 : seulement les couleurs du style d'onglets choisi
		$list['OblyonColorGrpLines']			= array('OBLYON_COLOR_BLINE', 'OBLYON_COLOR_FLINE', 'THEME_ELDY_USE_HOVER', 'THEME_ELDY_USE_CHECKED', 'OBLYON_COLOR_FLINE_HOVER',
														'THEME_ELDY_LINEIMPAIR1', 'THEME_ELDY_LINEIMPAIR2', 'THEME_ELDY_LINEPAIR1', 'THEME_ELDY_LINEPAIR2', 'THEME_ELDY_LINEBREAK');
		$list['OblyonColorGrpTotal']			= array('OBLYON_COLOR_BTOTAL', 'OBLYON_COLOR_FTOTAL');
		$list['OblyonColorGrpDate']				= array('OBLYON_COLOR_FDATE_DEFAULT', 'OBLYON_COLOR_FDATE_SELECTED');
		$list['OblyonColorGrpAgenda']			= array('OBLYON_COLOR_CAL_EVENT_TXT', 'OBLYON_COLOR_CAL_WEEKEND_BCKGRD', 'OBLYON_COLOR_CAL_HOLIDAY_BCKGRD');	// 3.7.0
		$list['OblyonColorGrpTimeline']			= array('OBLYON_COLOR_TIMELINE_BCKGRD', 'OBLYON_COLOR_TIMELINE_PRIVATE_BCKGRD');	// 3.7.0
		$list['OblyonColorGrpNatures']			= array('THEME_ELDY_PROSPECTBACK', 'THEME_ELDY_CUSTOMERBACK', 'THEME_ELDY_VENDORBACK', 'THEME_ELDY_USERBACK', 'THEME_ELDY_COLORNATURE');
		$list['OblyonColorGrpMembers']			= array('THEME_ELDY_MEMBER_COMPANYBACK', 'THEME_ELDY_MEMBER_INDIVIDUALBACK', 'THEME_ELDY_COLORMEMBER');
		$list['OblyonColorGrpDashboard']		= array('OBLYON_COLOR_BOX_SHADOW', 'OBLYON_COLOR_INFOBOX_BCKGRD1', 'OBLYON_COLOR_INFOBOX_BCKGRD2', 'OBLYON_COLOR_BORDER_ACTIONCOLUMN');
		$list['OblyonColorGrpAmounts']			= array('OBLYON_COLOR_AMOUNT_TEXT', 'OBLYON_COLOR_AMOUNT_REMAIN', 'OBLYON_COLOR_AMOUNT_PAID', 'OBLYON_COLOR_AMOUNT_UNPAID');
		$list['OblyonColorGrpStock']			= array('OBLYON_COLOR_STOCK_OK', 'OBLYON_COLOR_STOCK_LOW', 'OBLYON_COLOR_STOCK_EXIT');	// 3.7.0
		$list['OblyonColorGrpBadges']			= array('OBLYON_COLOR_BADGE_DRAFT', 'OBLYON_COLOR_BADGE_VALIDATED', 'OBLYON_COLOR_BADGE_APPROVED', 'OBLYON_COLOR_BADGE_WAITING', 'OBLYON_COLOR_BADGE_ACTIVE',
														'OBLYON_COLOR_BADGE_CLOSED', 'OBLYON_COLOR_BADGE_CANCELED', 'OBLYON_COLOR_BADGE_ERROR', 'OBLYON_COLOR_BADGE_DONE');	// 3.7.0 : text colour automatic (oblyon_text_on)
		$list['OblyonColorGrpStatus']			= array('OBLYON_COLOR_STATUS_SUCCESS', 'OBLYON_COLOR_STATUS_INFO', 'OBLYON_COLOR_STATUS_WARNING', 'OBLYON_COLOR_STATUS_DANGER', 'OBLYON_COLOR_STATUS_PRIMARY', 'OBLYON_COLOR_PROGRESSBAR', 'OBLYON_COLOR_TIMELINEITEM');
		$list['OblyonColorGrpWeather']			= array('OBLYON_COLOR_WEATHER_LEVEL0', 'OBLYON_COLOR_WEATHER_LEVEL1', 'OBLYON_COLOR_WEATHER_LEVEL2', 'OBLYON_COLOR_WEATHER_LEVEL3', 'OBLYON_COLOR_WEATHER_LEVEL4', 'OBLYON_COLOR_INFOBOX_UPDATE');
		$list['OblyonColorGrpAutocomplete']		= array('OBLYON_COLOR_AUTOCOMPLETE_BCKGRD', 'OBLYON_COLOR_AUTOCOMPLETE_TEXT');
		$list['OblyonColorGrpMultiselect']		= array('OBLYON_COLOR_CHIP_BCKGRD', 'OBLYON_COLOR_CHIP_TEXT', 'OBLYON_COLOR_RESULT_BCKGRD', 'OBLYON_COLOR_RESULT_TEXT');
		$list['OblyonColorGrpInfobox']			= array('OBLYON_INFOXBOX_BACKGROUND', 'OBLYON_INFOXBOX_WEATHER_COLOR', 'OBLYON_INFOXBOX_ACTION_COLOR', 'OBLYON_INFOXBOX_PROJECT_COLOR',
														'OBLYON_INFOXBOX_CUSTOMER_PROPAL_COLOR', 'OBLYON_INFOXBOX_CUSTOMER_ORDER_COLOR', 'OBLYON_INFOXBOX_CUSTOMER_INVOICE_COLOR',
														'OBLYON_INFOXBOX_SUPPLIER_PROPAL_COLOR', 'OBLYON_INFOXBOX_SUPPLIER_ORDER_COLOR', 'OBLYON_INFOXBOX_SUPPLIER_INVOICE_COLOR',
														'OBLYON_INFOXBOX_CONTRAT_COLOR', 'OBLYON_INFOXBOX_BANK_COLOR', 'OBLYON_INFOXBOX_ADHERENT_COLOR', 'OBLYON_INFOXBOX_EXPENSEREPORT_COLOR',
														'OBLYON_INFOXBOX_HOLIDAY_COLOR', 'OBLYON_INFOXBOX_TICKET_COLOR', 'OBLYON_INFOXBOX_MRP_COLOR');
		$list['OblyonColorGrpEldyOther']		= array('THEME_ELDY_TOPMENU_BACK1', 'THEME_ELDY_VERMENU_BACK1', 'THEME_ELDY_BACKBODY', 'THEME_ELDY_TEXTTITLELINK');
		return $list;
	}

	/**
	*	Flat list of the colour constants of the user tab (keys of the personal snapshot)
	*
	*	@return		array		Constant names
	**/
	function oblyon_user_colors_keys()
	{
		$keys	= array();
		foreach (oblyon_user_colors_list() as $group => $names)	$keys	= array_merge($keys, $names);
		return $keys;
	}

	/**
	*	Label of a colour constant on the user tab : the lang key is the constant name ; top / left labels are swapped when the menus are inverted (as admin/colors.php)
	*
	*	@param		string	$name		Constant name
	*	@return		string				Translated label
	**/
	function oblyon_user_color_label($name)
	{
		global $langs;

		$transkey	= $name;
		if (getDolGlobalString('MAIN_MENU_INVERT')) {
			if (strpos($name, 'OBLYON_COLOR_TOPMENU_') === 0)		$transkey	= str_replace('TOP', 'LEFT', $name);
			elseif (strpos($name, 'OBLYON_COLOR_LEFTMENU_') === 0)	$transkey	= str_replace('LEFT', 'TOP', $name);
		}
		// 3.8.0 : couleurs de boutons : "<famille> : <role>", memes libelles que l'onglet Couleurs du module (les champs montrent la couleur reelle, plus de mention "automatique")
		foreach (oblyon_button_families() as $family) {
			$role	= array_search($name, $family['colors'], true);
			if ($role !== false) {
				return $langs->trans($family['label']).' : '.$langs->trans('OblyonBtnRole'.ucfirst(str_replace('_', '', ucwords($role, '_'))));
			}
		}
		return $langs->trans($transkey);
	}

	/**
	*	Small colour swatch + value for the read mode of the user tab
	*
	*	@param		string	$value		Colour ('#RRGGBB', '#', '' ...)
	*	@param		string	$name		Constant name (for the 'r,g,b' tolerance)
	*	@return		string				HTML
	**/
	function oblyon_color_swatch($value, $name = '')
	{
		$value	= (string) $value;
		if ($value === '' || $value === '#')	return '<span class="opacitymedium">-</span>';
		if (!oblyon_color_is_valid($value, $name))	return dol_escape_htmltag($value);
		$css	= (strpos($value, ',') !== false ? 'rgb('.$value.')' : $value);
		return '<span class="oblyon-color-swatch" style="background:'.dol_escape_htmltag($css).'"></span> <span class="opacitymedium">'.dol_escape_htmltag(strtoupper($value)).'</span>';
	}
	// User presets (personal colour presets of the "Colors" tab of the user card) ******************
	/**
	*	Directory of the personal presets of a user : DOL_DATA_ROOT/[entity/]oblyon/userpresets/<id> (created on the first write)
	*
	*	@param		int		$userid		User id
	*	@return		string				Directory (may not exist yet)
	**/
	function oblyon_user_presets_dir($userid)
	{
		global $conf;
		$root	= (!empty($conf->oblyon->dir_output) ? $conf->oblyon->dir_output : DOL_DATA_ROOT.'/oblyon');
		return $root.'/userpresets/'.((int) $userid);
	}
	/**
	*	Personal presets of a user (files of his directory), key => preset (oblyon_load_preset_file, source 'user')
	*
	*	@param		int		$userid		User id
	*	@return		array
	**/
	function oblyon_get_user_presets($userid)
	{
		$dir	= oblyon_user_presets_dir($userid);
		$out	= array();
		if (! is_dir($dir))	return $out;
		foreach (dol_dir_list($dir, 'files', 0, '\.json$', null, 'name', SORT_ASC, 0, 1) as $file) {
			$preset	= oblyon_load_preset_file($file['fullname'], 'user');
			if ($preset !== null)	$out[$preset['key']]	= $preset;
		}
		return $out;
	}
	/**
	*	Presets offered on the Colors tab of a user : module presets with scope '' (the five shipped ones) then scope 'user' (accessibility),
	*	then the personal presets of the user. Instance presets of the Colors tab of the module are not offered here.
	*
	*	@param		int		$userid		User id
	*	@return		array				key => preset
	**/
	function oblyon_get_presets_for_user($userid)
	{
		$out	= array();
		foreach (array('', 'user') as $scope) {
			foreach (oblyon_get_presets() as $key => $preset) {
				if ($preset['source'] == 'module' && $preset['scope'] === $scope)	$out[$key]	= $preset;
			}
		}
		foreach (oblyon_get_user_presets($userid) as $key => $preset)	$out[$key]	= $preset;
		return $out;
	}
	/**
	*	Colours of a preset limited to the constants of the user tab (sections colors and dashboard, valid colour shapes only)
	*
	*	@param		array	$preset		Preset
	*	@return		array				constant => colour
	**/
	function oblyon_preset_user_colors($preset)
	{
		$out	= array();
		foreach (oblyon_user_colors_keys() as $key) {
			foreach (array('colors', 'dashboard') as $section) {
				if (isset($preset['sections'][$section][$key])) {
					$value	= (string) $preset['sections'][$section][$key];
					if (oblyon_color_is_valid($value, $key))	$out[$key]	= $value;
					break;
				}
			}
		}
		return $out;
	}
	/**
	*	Colours currently shown to a user on his tab : personal values when his personal colours are on and valid, else the instance values
	*
	*	@param		User	$object		User (conf loaded)
	*	@return		array				constant => colour ('' possible)
	**/
	function oblyon_user_current_colors($object)
	{
		$enabled	= oblyon_user_colors_enabled($object);
		$out		= array();
		foreach (oblyon_user_colors_keys() as $key) {
			$personal	= ($enabled && isset($object->conf->$key) ? (string) $object->conf->$key : '');
			$out[$key]	= ($personal !== '' && oblyon_color_is_valid($personal, $key) ? $personal : getDolGlobalString($key));
		}
		return $out;
	}
	/**
	*	Apply a preset to the personal colours of a user : full snapshot (preset colour when it has one, else the instance value),
	*	flag OBLYON_USER_COLORS = 1, CSS revision bumped so the browser fetches the new stylesheet
	*
	*	@param		array	$preset		Preset
	*	@param		User	$object		User
	*	@return		int					1 = OK, -1 = KO
	**/
	function oblyon_apply_preset_to_user($preset, $object)
	{
		global $db, $conf;
		$colors		= oblyon_preset_user_colors($preset);
		$tabparam	= array();
		foreach (oblyon_user_colors_keys() as $key)	$tabparam[$key]	= (isset($colors[$key]) ? $colors[$key] : getDolGlobalString($key));
		$tabparam['OBLYON_USER_COLORS']	= 1;
		$res	= dol_set_user_param($db, $conf, $object, $tabparam);	// 4 arguments : signature of Dolibarr 22 LTS
		if ($res <= 0)	return -1;
		dolibarr_set_const($db, 'MAIN_IHM_PARAMS_REV', getDolGlobalInt('MAIN_IHM_PARAMS_REV') + 1, 'chaine', 0, '', $conf->entity);
		return 1;
	}
	/**
	*	Save the colours currently shown to a user as one of his personal presets (sections colors + dashboard, colours only)
	*
	*	@param		User	$object			User
	*	@param		string	$key			Preset key (validated here)
	*	@param		string	$name			Displayed name
	*	@param		string	$description	Description
	*	@return		int						1 = OK, -1 = write error, -2 = invalid key, -3 = key of a module preset, -4 = already exists
	**/
	function oblyon_save_user_preset($object, $key, $name, $description = '')
	{
		if (! oblyon_preset_key_is_valid($key))	return -2;
		$module	= oblyon_get_preset($key);
		if ($module !== null && $module['source'] == 'module')	return -3;
		$dir	= oblyon_user_presets_dir($object->id);
		$file	= $dir.'/'.$key.'.json';
		if (file_exists($file))	return -4;
		$data	= array('name' => (string) $name, 'description' => (string) $description, 'author' => (string) $object->login, 'version' => '1', 'colors' => array(), 'dashboard' => array());
		foreach (oblyon_user_current_colors($object) as $name_ => $value) {
			if ($value === '')	continue;
			$section	= oblyon_presets_section_of($name_);
			if ($section == 'colors' || $section == 'dashboard')	$data[$section][$name_]	= $value;
		}
		ksort($data['colors']);
		ksort($data['dashboard']);
		if (! is_dir($dir) && dol_mkdir($dir) < 0)	return -1;
		if (! is_writable($dir))	return -1;
		$json	= json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		if ($json === false || @file_put_contents($file.'.tmp', $json."\n") === false || ! @rename($file.'.tmp', $file)) {	// atomic write
			@unlink($file.'.tmp');
			return -1;
		}
		dolChmod($file);
		return 1;
	}
	/**
	*	Delete a personal preset of a user
	*
	*	@param		User	$object		User
	*	@param		string	$key		Preset key
	*	@return		int					1 = OK, -1 = KO, -2 = unknown
	**/
	function oblyon_delete_user_preset($object, $key)
	{
		if (! oblyon_preset_key_is_valid($key))	return -2;
		$file	= oblyon_user_presets_dir($object->id).'/'.$key.'.json';
		if (! file_exists($file))	return -2;
		return (@unlink($file) ? 1 : -1);
	}
	/**
	*	HTML of the preset cards of the user tab (module presets, accessibility preset, personal presets) and of the folded "save as preset" form
	*
	*	@param		User	$object		User of the card
	*	@param		bool	$canedit	Buttons shown
	*	@return		string				HTML
	**/
	function oblyon_print_user_preset_cards($object, $canedit)
	{
		global $langs, $db;
		require_once DOL_DOCUMENT_ROOT.'/core/class/html.form.class.php';
		$form	= new Form($db);
		$self	= dol_escape_htmltag($_SERVER['PHP_SELF']);
		$id		= (int) $object->id;
		$out	= '<div class="oblyon-presets oblyon-user-presets"><div class="oblyon-presets__title">'.$langs->trans('OblyonUserPresets').'</div>';
		$out	.= '<div class="opacitymedium small oblyon-presets__help">'.$langs->trans('OblyonUserPresetsHelp').'</div>';
		$out	.= '<div class="oblyon-presets__grid">';
		$mine	= 0;
		foreach (oblyon_get_presets_for_user($id) as $key => $preset) {
			$source		= ($preset['source'] == 'user' ? 'user' : 'module');
			if ($source == 'user')	$mine++;
			$out	.= '<form method="POST" action="'.$self.'" class="oblyon-preset">';
			$out	.= '<input type="hidden" name="token" value="'.newToken().'"><input type="hidden" name="id" value="'.$id.'"><input type="hidden" name="preset_key" value="'.dol_escape_htmltag($key).'"><input type="hidden" name="preset_source" value="'.$source.'">';
			$out	.= oblyon_preset_card_preview($preset, $key, $source);
			$tooltip	= ($preset['description'] !== '' ? oblyon_preset_text($preset['description']) : '');
			$out	.= '<div class="oblyon-preset__head"><div class="oblyon-preset__name" title="'.dol_escape_htmltag($tooltip, 0, 1).'">'.oblyon_preset_text($preset['name'] !== '' ? $preset['name'] : $key);
			if ($preset['scope'] === 'user')	$out	.= ' <span class="badge badge-status4 badge-status" title="'.dol_escape_htmltag($langs->trans('OblyonUserPresetAccessible')).'">'.$langs->trans('OblyonUserPresetAccessibleShort').'</span>';
			if ($source == 'user')			$out	.= ' <span class="badge badge-status0 badge-status">'.$langs->trans('OblyonUserPresetsMineShort').'</span>';
			$out	.= '</div><div class="oblyon-preset__icons"></div></div>';	// 3.8.0 : plus d'icone de contraste (mecanisme retire)
			$out	.= '<div class="oblyon-preset__actions">';
			if ($canedit)	$out	.= '<button type="submit" name="action" value="apply_user_preset" class="butAction small oblyon-preset__apply">'.$langs->trans('OblyonUserPresetApply').'</button>';
			if ($source == 'user') {
				$out	.= '<div class="oblyon-preset__row-btn">';
				$out	.= '<a class="butAction small" href="'.$self.'?id='.$id.'&action=download_user_preset&preset_key='.urlencode($key).'&token='.newToken().'" title="'.dol_escape_htmltag($langs->trans('OblyonPresetDownload')).'"><span class="fa fa-download"></span></a>';	// InfraS change : icone seule, le libelle Download debordait du bouton (l'infobulle title porte deja le libelle complet)
				if ($canedit)	$out	.= '<button type="submit" name="action" value="delete_user_preset" class="butActionDelete small" onclick="return confirm(\''.dol_escape_js($langs->trans('OblyonPresetDeleteConfirm', $key)).'\');"><span class="fa fa-trash paddingright"></span>'.$langs->trans('OblyonPresetDelete').'</button>';
				$out	.= '</div>';
			}
			$out	.= '</div></form>';
		}
		$out	.= '</div>';
		if (! $mine)	$out	.= '<div class="opacitymedium small oblyon-presets__help">'.$langs->trans('OblyonUserPresetsEmpty').'</div>';
		// Save the current colours as a personal preset (folded, like the forms of the module tab)
		if ($canedit) {
			$modulekeys	= array();
			foreach (oblyon_get_presets() as $key => $preset)	if ($preset['source'] == 'module')	$modulekeys[]	= $key;
			$out	.= '<div class="oblyon-presets oblyon-presets--forms"><details class="oblyon-presets__form"><summary class="oblyon-presets__title">'.$langs->trans('OblyonUserPresetSaveTitle').'</summary>';
			$out	.= '<form method="POST" action="'.$self.'"><input type="hidden" name="token" value="'.newToken().'"><input type="hidden" name="id" value="'.$id.'"><input type="hidden" name="action" value="save_user_preset">';
			$out	.= '<div class="opacitymedium small">'.$langs->trans('OblyonUserPresetSaveHelp').'</div>';
			$out	.= '<div class="oblyon-presets__fields">';
			$out	.= '<label class="oblyon-presets__field"><span>'.$langs->trans('OblyonPresetKey').$form->textwithpicto('', $langs->trans('OblyonPresetKeyHelp', implode(', ', $modulekeys)), 1, 'help', '', 0, 2).'</span><input type="text" name="preset_key" class="flat" maxlength="40" pattern="[a-z0-9][a-z0-9_-]{1,39}" placeholder="mes-couleurs" required></label>';
			$out	.= '<label class="oblyon-presets__field oblyon-presets__field--wide"><span>'.$langs->trans('OblyonPresetName').'</span><input type="text" name="preset_name" class="flat" maxlength="80" required></label>';
			$out	.= '<label class="oblyon-presets__field oblyon-presets__field--full"><span>'.$langs->trans('OblyonPresetDesc').'</span><input type="text" name="preset_desc" class="flat" maxlength="255"></label></div>';
			$out	.= '<button type="submit" class="butAction small">'.$langs->trans('OblyonPresetSaveAs').'</button></form></details></div>';
		}
		$out	.= '</div>';
		return $out;
	}
