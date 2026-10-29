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
	* 	\file		../oblyon/lib/oblyon_presets.lib.php
	* 	\ingroup	oblyon
	* 	\brief		Presets (JSON files) of the Oblyon settings : load, apply, export, update, delete, import, cards (contrast check removed in 3.8.0)
	*
	*	A preset is a JSON file :
	*		{ "name": "...", "description": "...", "author": "...", "version": "1",
	*		  "colors": { "OBLYON_COLOR_MAIN": "#0083A2", ... }, "typography": { ... }, "menus": { ... },
	*		  "general": { ... }, "lists_cards": { ... }, "dashboard": { ... }, "custom_css": "..." }
	*	Sections are optional ; every section carries its own white list of constants (oblyon_presets_sections()),
	*	unknown keys are ignored. Conventions of the theme are kept as they are : '#' = inherit (menu texts),
	*	'' = remove the constant (dolibarr_set_const).
	*	Module presets live in <module>/presets/*.json (read only), instance presets in
	*	DOL_DATA_ROOT/[<entity>/]oblyon/presets/*.json (an instance preset wins over a module preset of the same key).
	************************************************/

	// Libraries ************************************
	require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
	require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';
	require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';
	dol_include_once('/oblyon/lib/oblyon_colors.lib.php');	// oblyon_color_to_hex() (3.7.0)

	// Sections *************************************

	/**
	*	Sections of a preset : constant names (exact) and patterns (prefix, ending with *) allowed in each one
	*
	*	@return		array		section => array('names' => array(...), 'patterns' => array('PREFIX_*', ...), 'scalar' => bool)
	**/
	function oblyon_presets_sections()
	{
		return array(
			'colors'		=> array(
				'names'		=> array('THEME_ELDY_TOPBORDER_TITLE1', 'THEME_ELDY_BACKTITLE1', 'THEME_ELDY_BACKTABACTIVE', 'THEME_ELDY_LINEPAIR1', 'THEME_ELDY_LINEPAIR2',
									'THEME_ELDY_LINEIMPAIR1', 'THEME_ELDY_LINEIMPAIR2', 'THEME_ELDY_LINEBREAK', 'THEME_ELDY_TEXTTITLENOTAB', 'THEME_ELDY_TEXTTITLE',
									'THEME_ELDY_TEXT', 'THEME_ELDY_TEXTLINK', 'THEME_ELDY_BTNACTION', 'THEME_ELDY_TEXTBTNACTION', 'THEME_ELDY_USE_HOVER', 'THEME_ELDY_USE_CHECKED',
									'THEME_ELDY_BACKBODY', 'THEME_ELDY_BACKTABCARD1', 'THEME_ELDY_TOPMENU_BACK1', 'THEME_ELDY_VERMENU_BACK1', 'THEME_ELDY_TEXTTITLELINK',
									'THEME_ELDY_CUSTOMERBACK', 'THEME_ELDY_VENDORBACK', 'THEME_ELDY_USERBACK', 'THEME_ELDY_PROSPECTBACK', 'THEME_ELDY_COLORMEMBER',
									'THEME_ELDY_COLORNATURE', 'THEME_ELDY_MEMBER_COMPANYBACK', 'THEME_ELDY_MEMBER_INDIVIDUALBACK', 'THEME_INVERT_RATIO_FILTER', 'THEME_SATURATE_RATIO'),
				'patterns'	=> array('OBLYON_COLOR_*'),
				'scalar'	=> false),
			'typography'	=> array(
				'names'		=> array('THEME_FONT_FAMILY', 'THEME_ELDY_FONT_SIZE1', 'THEME_ELDY_BORDER_RADIUS', 'THEME_SHOW_BORDER_ON_INPUT', 'THEME_ADD_BACKGROUND_ON_INPUT',
									'THEME_ELDY_USEBORDERONTABLE', 'THEME_ELDY_SHADOW_ON_SMALL_BOXES', 'THEME_ELDY_TOTAL_BACKGROUND_LIKE_HEAD',
									'THEME_ELDY_USEBOLDTITLE', 'OBLYON_IMAGE_HEIGHT_TABLE', 'OBLYON_DENSITY', 'OBLYON_TABS_STYLE', 'OBLYON_TAB_PILL_BORDER', 'OBLYON_TAB_PILL_SHADOW',
									'OBLYON_BUTTON_STYLE', 'OBLYON_BUTTON_FORM_OWN_COLORS', 'OBLYON_BADGE_STYLE', 'OBLYON_STATUS_PULSE', 'OBLYON_AGENDA_STYLE',	// options d'interface 3.8.0 (densite, style des onglets, bordure / ombre des pilules, style des boutons, agenda) // InfraS change
									'OBLYON_TAKEPOS_THEME', 'OBLYON_TAKEPOS_CATEGORY_COLORS', 'OBLYON_TAKEPOS_QUICK_DISCOUNTS', 'OBLYON_TAKEPOS_AUTO_NEW_SALE'),	// caisse TakePOS 3.9.0 (theme, couleurs des categories, remises rapides, nouvelle vente automatique) // InfraS add
				'patterns'	=> array(),
				'scalar'	=> false),
			'menus'			=> array(
				'names'		=> array('MAIN_MENU_INVERT', 'OBLYON_FULLSIZE_TOPBAR', 'MAIN_SHOW_LOGO', 'THEME_STICKY_TOPMENU', 'OBLYON_HIDE_TOPICONS', 'THEME_MENU_COLORLOGO',
									'OBLYON_SHOW_COMPNAME', 'OBLYON_STICKY_LEFTBAR', 'OBLYON_HIDE_LEFTMENU', 'OBLYON_EFFECT_LEFTMENU', 'OBLYON_HIDE_LEFTICONS',
									'OBLYON_REDUCE_LEFTMENU', 'OBLYON_EFFECT_REDUCE_LEFTMENU', 'OBLYON_TOUCH_MENU', 'OBLYON_MOBILE_LAYOUT', 'OBLYON_LOGO_PADDING', 'OBLYON_LOGO_SIZE',
									'OBLYON_USER_BLOCK'),	// bloc utilisateur (3.8.0)
				'patterns'	=> array(),
				'scalar'	=> false),
			'general'		=> array(
				'names'		=> array('OBLYON_DISABLE_VERSION', 'MAIN_STATUS_USES_IMAGES', 'MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN', 'MAIN_USE_TOP_MENU_SEARCH_DROPDOWN',
									'MAIN_USE_TOP_MENU_BOOKMARK_DROPDOWN', 'OBLYON_PADDING_RIGHT_BOTTOM', 'MAIN_LOGIN_RIGHT', 'OBLYON_MOTION', 'OBLYON_NOTIFICATION_CENTER'),	// animations (3.8.0)
				'patterns'	=> array(),
				'scalar'	=> false),
			'lists_cards'	=> array(
				'names'		=> array('MAIN_CHECKBOX_LEFT_COLUMN', 'FIX_TITLE_IN_LIST', 'DISABLE_KANBAN_VIEW_IN_LIST', 'FIX_STICKY_HEADER_CARD', 'FIX_STICKY_COLUMN_FIRST',
									'FIX_STICKY_COLUMN_LAST', 'FIX_STICKY_TOTAL_BAR', 'MAIN_GRANDTOTAL_LIST_SHOW', 'FIX_STICKY_GRANDTOTAL_BAR', 'FIX_STICKY_TABS_CARD',
									'FIX_AREAREF_CARD', 'MAIN_MAXTABS_IN_CARD', 'FIX_ABSOLUTE_BUTTONS_ACTION_CARD', 'MAIN_VIEW_LINE_NUMBER', 'OBLYON_LIST_HEADER_STYLE'),	// style des en-tetes de liste (3.8.0)
				'patterns'	=> array(),
				'scalar'	=> false),
			'dashboard'		=> array(
				'names'		=> array('MAIN_DISABLE_GLOBAL_WORKBOARD', 'MAIN_DISABLE_GLOBAL_BOXSTATS', 'MAIN_DISABLE_METEO', 'THEME_INFOBOX_COLOR_ON_BACKGROUND',
									'OBLYON_INFOXBOX_SINGLE_WIDTH', 'THEME_AGRESSIVENESS_RATIO'),
				'patterns'	=> array('MAIN_DISABLE_BLOCK_*', 'OBLYON_INFOXBOX_*'),
				'scalar'	=> false),
			'custom_css'	=> array(
				'names'		=> array('OBLYON_CUSTOM_CSS'),
				'patterns'	=> array(),
				'scalar'	=> true),
		);
	}

	/**
	*	Section a constant belongs to
	*
	*	@param		string	$name		Constant name
	*	@return		string				Section key, '' if the constant is not handled by presets
	**/
	function oblyon_presets_section_of($name)
	{
		foreach (oblyon_presets_sections() as $section => $def) {
			if (in_array($name, $def['names']))	return $section;
			foreach ($def['patterns'] as $pattern) {
				if (strpos($name, substr($pattern, 0, -1)) === 0)	return $section;
			}
		}
		return '';
	}

	// Files ****************************************

	/**
	*	Directories holding the preset files
	*
	*	@return		array		array('module' => dir, 'instance' => dir) ; the instance dir may not exist yet
	**/
	function oblyon_presets_dirs()
	{
		global $conf;

		return array(
			'module'	=> dol_buildpath('/oblyon/presets', 0),
			'instance'	=> DOL_DATA_ROOT.'/'.(!isModEnabled('multicompany') || $conf->entity == 1 ? '' : $conf->entity.'/').'oblyon/presets',
		);
	}

	/**
	*	Is a preset key valid ? (file name without extension)
	*
	*	@param		string	$key		Key
	*	@return		bool
	**/
	function oblyon_preset_key_is_valid($key)
	{
		return (bool) preg_match('/^[a-z0-9][a-z0-9_-]{1,39}\z/', $key);	// \z : no trailing newline accepted
	}

	/**
	*	Path of the file of a preset
	*
	*	@param		string	$key		Key
	*	@param		string	$source		'module' or 'instance'
	*	@return		string				Path (the file may not exist)
	**/
	function oblyon_preset_file_path($key, $source = 'instance')
	{
		$dirs	= oblyon_presets_dirs();
		return $dirs[$source == 'module' ? 'module' : 'instance'].'/'.$key.'.json';
	}

	/**
	*	Typed validation of a preset value (import / normalization) : a value ends up in the generated CSS and in the admin forms,
	*	so only the shapes the theme understands are accepted. Colours : '#RRGGBB', '#RGB', '#' (inherit), 'r,g,b' ; numbers ; on/off ;
	*	free text (font family, effects...) without HTML markup, quotes, backslash or control characters. custom_css : no '<'.
	*
	*	@param		string	$section	Section key
	*	@param		string	$name		Constant name
	*	@param		string	$value		Value (trimmed)
	*	@return		bool
	**/
	function oblyon_preset_value_is_valid($section, $name, $value)
	{
		if ($value === '')	return true;	// '' = remove the constant
		if ($section == 'custom_css')	return (strpos($value, '<') === false && ! preg_match('/[\x00-\x08\x0B\x0C\x0E-\x1F]/', $value));
		if (preg_match('/^-?\d+(\.\d+)?$/', $value))	return true;	// ratios, sizes, on / off
		if (preg_match('/(RATIO|_SIZE|HEIGHT|WIDTH|MAXTABS|RADIUS|PADDING|LIMIT)/', $name))	return false;	// numeric settings : nothing else
		$iscolor	= (preg_match('/^(OBLYON_COLOR_|OBLYON_INFOXBOX_)/', $name) || preg_match('/^THEME_ELDY_(.*BACK|.*TEXT|BTNACTION|TEXTBTNACTION|USE_HOVER|USE_CHECKED|LINE|COLOR|MEMBER|TOPBORDER)/', $name));
		if ($iscolor)	return (bool) (preg_match('/^#([0-9A-F]{3}|[0-9A-F]{6})?$/i', $value) || preg_match('/^\d{1,3},\d{1,3},\d{1,3}$/', $value));
		return ! (preg_match('/[<>"\'\\\\]/', $value) || preg_match('/[[:cntrl:]]/', $value));	// free text : no markup, quote, backslash or control character
	}

	/**
	*	Read and normalize a preset file : sections filtered by their white lists, meta data cleaned.
	*	Returns null (and logs why) when the file is unreadable, invalid or empty.
	*
	*	@param		string	$file		Path of the JSON file
	*	@param		string	$source		'module' or 'instance'
	*	@return		array|null			array('key', 'name', 'description', 'author', 'version', 'source', 'file', 'sections' => array(section => values))
	**/
	function oblyon_load_preset_file($file, $source)
	{
		$key	= preg_replace('/\.json$/', '', basename($file));
		if (! oblyon_preset_key_is_valid($key)) {
			dol_syslog('oblyon_load_preset_file: invalid key '.$key.' ('.$file.')', LOG_WARNING);
			return null;
		}
		$content	= @file_get_contents($file, false, null, 0, 262144);	// 256 Ko max
		if ($content === false || $content === '') {
			dol_syslog('oblyon_load_preset_file: unreadable file '.$file, LOG_WARNING);
			return null;
		}
		$data	= json_decode($content, true);
		if (json_last_error() !== JSON_ERROR_NONE || ! is_array($data)) {
			dol_syslog('oblyon_load_preset_file: invalid JSON in '.$file.' : '.json_last_error_msg(), LOG_WARNING);
			return null;
		}
		$normalized	= oblyon_normalize_preset_data($data);
		if (empty($normalized['sections'])) {
			dol_syslog('oblyon_load_preset_file: no usable section in '.$file, LOG_WARNING);
			return null;
		}
		$normalized['key']		= $key;
		$normalized['source']	= $source;
		$normalized['file']		= $file;
		$normalized['mtime']	= (int) @filemtime($file);
		return $normalized;
	}

	/**
	*	Normalize decoded preset data : keeps meta data as strings and, for every known section, the values whose constant is in the white list
	*
	*	@param		array	$data		Decoded JSON
	*	@return		array				array('name', 'description', 'author', 'version', 'sections')
	**/
	function oblyon_normalize_preset_data($data)
	{
		$out	= array('name' => '', 'description' => '', 'author' => '', 'version' => '1', 'scope' => '', 'sections' => array()); // infras add: meta scope ('' = partout, 'user' = onglet utilisateur seulement)
		foreach (array('name', 'description', 'author', 'version', 'scope') as $meta) {
			if (isset($data[$meta]) && is_scalar($data[$meta]))	$out[$meta]	= trim((string) $data[$meta]);
		}
		if ($out['scope'] !== 'user') { // Infras add : seule valeur connue est 'user'
			$out['scope']	= '';
		}
		foreach (oblyon_presets_sections() as $section => $def) {
			if (! isset($data[$section]))	continue;
			if ($def['scalar']) {
				if (is_scalar($data[$section]) && (string) $data[$section] !== '' && oblyon_preset_value_is_valid($section, $def['names'][0], (string) $data[$section])) {
					$out['sections'][$section]	= array($def['names'][0] => (string) $data[$section]);
				}
				continue;
			}
			if (! is_array($data[$section]))	continue;
			$values	= array();
			foreach ($data[$section] as $name => $value) {
				$name	= strtoupper(trim((string) $name));
				if (! preg_match('/^[A-Z0-9_]{3,80}$/', $name) || oblyon_presets_section_of($name) != $section || ! is_scalar($value))	continue;
				$value	= trim((string) $value);
				if (preg_match('/^#[0-9a-f]{3,8}$/i', $value))	$value	= strtoupper($value);	// hex colors in a single case
				$value	= oblyon_color_to_hex($value);	// 3.7.0 : 'r,g,b' (accepted on input) stored as '#RRGGBB'
				if (strlen($value) > 255 || ! oblyon_preset_value_is_valid($section, $name, $value))	continue;	// values are printed in the CSS and in the admin forms : typed validation
				$values[$name]	= $value;
			}
			if (count($values))	$out['sections'][$section]	= $values;
		}
		return $out;
	}

	/**
	*	All the presets : module presets then instance presets (an instance preset replaces a module preset of the same key)
	*
	*	@return		array		key => preset (see oblyon_load_preset_file)
	**/
	function oblyon_get_presets()
	{
		static $cache	= null;

		if (! empty($GLOBALS['oblyon_presets_cache_reset'])) {	// a write happened (see oblyon_get_presets_reset)
			$cache	= null;
			unset($GLOBALS['oblyon_presets_cache_reset']);
		}
		if ($cache !== null)	return $cache;
		$presets	= array();
		foreach (oblyon_presets_dirs() as $source => $dir) {
			if (! is_dir($dir))	continue;
			foreach (dol_dir_list($dir, 'files', 0, '\.json$', null, 'name', SORT_ASC, 0, 1) as $file) {
				$preset	= oblyon_load_preset_file($file['fullname'], $source);
				if ($preset !== null)	$presets[$preset['key']]	= $preset;
			}
		}
		$cache	= $presets;
		return $presets;
	}

	/**
	*	One preset
	*
	*	@param		string	$key		Key
	*	@return		array|null
	**/
	function oblyon_get_preset($key)
	{
		$presets	= oblyon_get_presets();
		return isset($presets[$key]) ? $presets[$key] : null;
	}

	/**
	*	Forget the cache of oblyon_get_presets() after a write (the static of that function is read again on next call)
	*
	*	@return		void
	**/
	function oblyon_get_presets_reset()
	{
		$GLOBALS['oblyon_presets_cache_reset']	= true;
	}

	// Current values *******************************

	/**
	*	Current values (database, current entity) of the constants of the given sections.
	*	Only the constants really present in the database are returned ('' = absent, see the '' convention).
	*
	*	@param		array	$sections	Section keys (empty = all)
	*	@return		array				section => array(name => value)
	**/
	function oblyon_presets_current_values($sections = array())
	{
		global $db, $conf;

		$defs	= oblyon_presets_sections();
		if (empty($sections))	$sections	= array_keys($defs);
		$where	= array();
		foreach ($sections as $section) {
			if (! isset($defs[$section]))	continue;
			if (count($defs[$section]['names']))	$where[]	= "name IN ('".implode("','", array_map(array($db, 'escape'), $defs[$section]['names']))."')";
			foreach ($defs[$section]['patterns'] as $pattern)	$where[]	= "name LIKE '".$db->escape(str_replace(array('_', '*'), array('\_', '%'), $pattern))."'";
		}
		$values	= array();
		if (empty($where))	return $values;
		$sql	= "SELECT name, value FROM ".MAIN_DB_PREFIX."const WHERE entity IN (0, ".((int) $conf->entity).") AND (".implode(' OR ', $where).") ORDER BY entity ASC";	// entity value read last = wins
		$resql	= $db->query($sql);
		if (! $resql) {
			dol_syslog('oblyon_presets_current_values: '.$db->lasterror(), LOG_ERR);
			return $values;
		}
		while ($obj = $db->fetch_object($resql)) {
			$section	= oblyon_presets_section_of($obj->name);
			if ($section === '' || ! in_array($section, $sections))	continue;
			$value	= (string) $obj->value;
			if (preg_match('/^#[0-9a-f]{3,8}$/i', $value))	$value	= strtoupper($value);
			$value	= oblyon_color_to_hex($value);	// 3.7.0 : a stored 'r,g,b' compares equal to the hex of the preset
			$values[$section][$obj->name]	= $value;
		}
		return $values;
	}

	/**
	*	Does the database differ from the preset, on the sections the preset contains ?
	*	A constant absent from the database counts as '' (the removal convention).
	*
	*	@param		array	$preset		Preset (oblyon_get_preset)
	*	@return		array				Section keys that differ (empty array = identical)
	**/
	function oblyon_preset_modified_sections($preset)
	{
		$current	= oblyon_presets_current_values(array_keys($preset['sections']));
		$modified	= array();
		foreach ($preset['sections'] as $section => $values) {
			foreach ($values as $name => $value) {
				$dbvalue	= isset($current[$section][$name]) ? $current[$section][$name] : '';
				if ($dbvalue !== $value) {
					$modified[]	= $section;
					break;
				}
			}
		}
		return $modified;
	}

	/**
	*	Seed OBLYON_CURRENT_PRESET when it is missing (instance updated by file copy, before 3.6.0) :
	*	the first preset whose sections all match the database becomes the current one. Nothing written otherwise.
	*
	*	@return		string		Detected key ('' if none matches or the constant already exists)
	**/
	function oblyon_detect_current_preset()
	{
		global $conf, $db;

		if (getDolGlobalString('OBLYON_CURRENT_PRESET') !== '')	return '';
		if (! empty($_SESSION['oblyon_current_preset_checked']))	return '';	// one detection per session : no repeated queries on every display when nothing matches
		$_SESSION['oblyon_current_preset_checked']	= 1;
		foreach (oblyon_get_presets() as $key => $preset) {
			if (count(oblyon_preset_modified_sections($preset)) == 0) {
				dolibarr_set_const($db, 'OBLYON_CURRENT_PRESET', $key, 'chaine', 0, 'Oblyon module', $conf->entity);
				return $key;
			}
		}
		return '';
	}

	// Apply ****************************************

	/**
	*	Rules the Menus tab enforces after any change (same as admin/menus.php) : kept coherent after a preset is applied
	*
	*	@return		int		1 = OK, -1 = KO
	**/
	function oblyon_apply_menu_rules()
	{
		global $db, $conf;

		$result	= 1;
		if (getDolGlobalString('MAIN_MENU_INVERT') && getDolGlobalString('OBLYON_HIDE_LEFTMENU'))					$result	= min($result, dolibarr_set_const($db, 'OBLYON_FULLSIZE_TOPBAR', 1, 'chaine', 0, 'Oblyon module', $conf->entity));
		if (getDolGlobalString('OBLYON_HIDE_LEFTMENU') && !getDolGlobalString('OBLYON_EFFECT_LEFTMENU'))			$result	= min($result, dolibarr_set_const($db, 'OBLYON_EFFECT_LEFTMENU', 'slide', 'chaine', 0, 'Oblyon module', $conf->entity));
		if (getDolGlobalString('MAIN_MENU_INVERT') && getDolGlobalString('OBLYON_REDUCE_LEFTMENU'))					$result	= min($result, dolibarr_set_const($db, 'OBLYON_HIDE_LEFTICONS', 0, 'chaine', 0, 'Oblyon module', $conf->entity));
		if (getDolGlobalString('OBLYON_REDUCE_LEFTMENU') && !getDolGlobalString('OBLYON_EFFECT_REDUCE_LEFTMENU'))	$result	= min($result, dolibarr_set_const($db, 'OBLYON_EFFECT_REDUCE_LEFTMENU', 'hover', 'chaine', 0, 'Oblyon module', $conf->entity));
		return $result < 0 ? -1 : 1;
	}

	/**
	*	Apply a preset : writes the constants of the chosen sections in one transaction, stores the current preset key, refreshes the CSS revision
	*
	*	@param		string	$key		Preset key
	*	@param		array	$sections	Sections to apply (empty = every section of the preset)
	*	@return		int					1 = OK, -1 = KO (nothing written), -2 = unknown preset
	**/
	function oblyon_apply_preset($key, $sections = array())
	{
		global $db, $conf;

		$preset	= oblyon_get_preset($key);
		if ($preset === null)	return -2;
		if (empty($sections))	$sections	= array_keys($preset['sections']);
		$error	= 0;
		$db->begin();
		foreach ($sections as $section) {
			if (! isset($preset['sections'][$section]))	continue;
			foreach ($preset['sections'][$section] as $name => $value) {
				if (dolibarr_set_const($db, $name, $value, 'chaine', 0, 'Oblyon preset '.$key, $conf->entity) < 0) {
					dol_syslog('oblyon_apply_preset: '.$name.' : '.$db->lasterror(), LOG_ERR);
					$error++;
					break 2;
				}
			}
		}
		if (! $error && in_array('menus', $sections) && isset($preset['sections']['menus']) && oblyon_apply_menu_rules() < 0)	$error++;
		if (! $error && dolibarr_set_const($db, 'OBLYON_CURRENT_PRESET', $key, 'chaine', 0, 'Oblyon module', $conf->entity) < 0)	$error++;
		if (! $error && dolibarr_set_const($db, 'MAIN_IHM_PARAMS_REV', getDolGlobalInt('MAIN_IHM_PARAMS_REV') + 1, 'chaine', 0, '', $conf->entity) < 0)	$error++;
		if ($error) {
			$db->rollback();
			return -1;
		}
		$db->commit();
		return 1;
	}

	// Write ****************************************

	/**
	*	Build the preset data to write from the current values of the database
	*
	*	@param		string	$name			Name shown on the card
	*	@param		string	$description	Description
	*	@param		array	$sections		Sections to include (empty = all)
	*	@param		string	$author			Author (default : company name)
	*	@return		array					Data ready for json_encode ('' if a section has no value)
	**/
	function oblyon_build_preset_data($name, $description, $sections = array(), $author = '')
	{
		global $mysoc;

		$data	= array('name' => (string) $name, 'description' => (string) $description, 'author' => ($author !== '' ? $author : (is_object($mysoc) && ! empty($mysoc->name) ? $mysoc->name : '')), 'version' => '1');
		$defs	= oblyon_presets_sections();
		foreach (oblyon_presets_current_values($sections) as $section => $values) {
			if ($defs[$section]['scalar']) {
				$data[$section]	= reset($values);
			} else {
				ksort($values);
				$data[$section]	= $values;
			}
		}
		return $data;
	}

	/**
	*	Write a preset file in the instance directory (created if needed)
	*
	*	@param		string	$key		Key (validated)
	*	@param		array	$data		Data (oblyon_build_preset_data or a normalized upload)
	*	@return		int					1 = OK, -1 = KO
	**/
	function oblyon_write_preset_file($key, $data)
	{
		$dirs	= oblyon_presets_dirs();
		if (! is_dir($dirs['instance']) && dol_mkdir($dirs['instance']) < 0) {
			dol_syslog('oblyon_write_preset_file: cannot create '.$dirs['instance'], LOG_ERR);
			return -1;
		}
		if (! is_writable($dirs['instance'])) {
			dol_syslog('oblyon_write_preset_file: directory not writable '.$dirs['instance'], LOG_ERR);
			return -1;
		}
		$json	= json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		$file	= $dirs['instance'].'/'.$key.'.json';
		// atomic write : a concurrent read never sees a truncated file
		if ($json === false || @file_put_contents($file.'.tmp', $json."\n") === false || ! @rename($file.'.tmp', $file)) {
			@unlink($file.'.tmp');
			dol_syslog('oblyon_write_preset_file: cannot write '.$key.'.json', LOG_ERR);
			return -1;
		}
		dolChmod($file);
		oblyon_get_presets_reset();
		return 1;
	}

	/**
	*	Export the current settings as a new instance preset ("save as")
	*
	*	@param		string	$key			Key of the new preset
	*	@param		string	$name			Name
	*	@param		string	$description	Description
	*	@param		array	$sections		Sections to include (empty = all)
	*	@param		bool	$makecurrent	Store the key as the current preset
	*	@return		int						1 = OK, -1 = write error, -2 = invalid key, -3 = key of a module preset, -4 = instance preset already exists
	**/
	function oblyon_export_preset($key, $name, $description, $sections = array(), $makecurrent = true)
	{
		global $db, $conf;

		if (! oblyon_preset_key_is_valid($key))	return -2;
		if (file_exists(oblyon_preset_file_path($key, 'module')))	return -3;
		if (file_exists(oblyon_preset_file_path($key, 'instance')))	return -4;
		$data	= oblyon_build_preset_data($name, $description, $sections);
		if (oblyon_write_preset_file($key, $data) < 0)	return -1;
		if ($makecurrent)	dolibarr_set_const($db, 'OBLYON_CURRENT_PRESET', $key, 'chaine', 0, 'Oblyon module', $conf->entity);
		return 1;
	}

	/**
	*	Update an instance preset with the current settings ("save") ; module presets are read only
	*
	*	@param		string	$key			Key of an existing instance preset
	*	@param		array	$sections		Sections to write (empty = every section, like an export : the file is rebuilt from the current settings)
	*	@param		string	$name			New name ('' = unchanged)
	*	@param		string	$description	New description ('' = unchanged)
	*	@return		int						1 = OK, -1 = write error, -2 = unknown or module preset
	**/
	function oblyon_update_preset($key, $sections = array(), $name = '', $description = '')
	{
		$preset	= oblyon_get_preset($key);
		if ($preset === null || $preset['source'] != 'instance')	return -2;
		$data	= oblyon_build_preset_data(($name !== '' ? $name : $preset['name']), ($description !== '' ? $description : $preset['description']), $sections, $preset['author']);
		if (! empty($sections)) {	// partial update : the sections not rebuilt keep their current content instead of being dropped
			$defs	= oblyon_presets_sections();
			foreach ($preset['sections'] as $section => $values) {
				if (! isset($data[$section]) && isset($defs[$section]))	$data[$section]	= ($defs[$section]['scalar'] ? reset($values) : $values);
			}
		}
		$data['version']	= (string) ((int) $preset['version'] + 1);
		return oblyon_write_preset_file($key, $data);
	}

	/**
	*	Delete an instance preset ; module presets are read only
	*
	*	@param		string	$key		Key
	*	@return		int					1 = OK, -1 = KO, -2 = unknown or module preset
	**/
	function oblyon_delete_preset($key)
	{
		global $db, $conf;

		$preset	= oblyon_get_preset($key);
		if ($preset === null || $preset['source'] != 'instance')	return -2;
		if (! @unlink($preset['file']))	return -1;
		if (getDolGlobalString('OBLYON_CURRENT_PRESET') == $key)	dolibarr_del_const($db, 'OBLYON_CURRENT_PRESET', $conf->entity);
		oblyon_get_presets_reset();
		return 1;
	}

	/**
	*	Import an uploaded JSON file as an instance preset
	*
	*	@param		string	$tmpfile	Uploaded file (already on disk)
	*	@param		string	$key		Key to store it under
	*	@param		bool	$replace	Replace an existing instance preset of the same key
	*	@return		int					1 = OK, -1 = write error, -2 = invalid key, -3 = key of a module preset, -4 = exists and no replace, -5 = invalid file
	**/
	function oblyon_import_preset($tmpfile, $key, $replace = false)
	{
		if (! oblyon_preset_key_is_valid($key))	return -2;
		if (file_exists(oblyon_preset_file_path($key, 'module')))	return -3;
		if (file_exists(oblyon_preset_file_path($key, 'instance')) && ! $replace)	return -4;
		if (! is_readable($tmpfile) || filesize($tmpfile) > 262144)	return -5;
		$data	= json_decode((string) file_get_contents($tmpfile), true);
		if (json_last_error() !== JSON_ERROR_NONE || ! is_array($data))	return -5;
		$normalized	= oblyon_normalize_preset_data($data);
		if (empty($normalized['sections']))	return -5;
		$out	= array('name' => ($normalized['name'] !== '' ? $normalized['name'] : $key), 'description' => $normalized['description'], 'author' => $normalized['author'], 'version' => ($normalized['version'] !== '' ? $normalized['version'] : '1'));
		$defs	= oblyon_presets_sections();
		foreach ($normalized['sections'] as $section => $values)	$out[$section]	= $defs[$section]['scalar'] ? reset($values) : $values;
		return oblyon_write_preset_file($key, $out);
	}

	// (3.8.0 : the contrast report (oblyon_color_luminance, oblyon_contrast_ratio, oblyon_check_preset_contrast, oblyon_contrast_issue_text, 3.6.0 / 3.7.0) is removed :
	// too heavy for its use ; oblyon_text_on() of lib/oblyon_colors.lib.php has its own luminance computation and stays)

	// Display **************************************

	/**
	*	Translated label of a section
	*
	*	@param		string	$section	Section key
	*	@return		string
	**/
	function oblyon_presets_section_label($section)
	{
		global $langs;

		$keys	= array('colors' => 'OblyonPresetSectionColors', 'typography' => 'OblyonPresetSectionTypography', 'menus' => 'OblyonPresetSectionMenus', 'general' => 'OblyonPresetSectionGeneral',
						'lists_cards' => 'OblyonPresetSectionListsCards', 'dashboard' => 'OblyonPresetSectionDashboard', 'custom_css' => 'OblyonPresetSectionCustomCss');
		return isset($keys[$section]) ? $langs->trans($keys[$section]) : $section;
	}

	/**
	*	Name or description of a preset, translated when it is a language key (module presets), raw otherwise (instance presets)
	*
	*	@param		string	$text		Name or description stored in the file
	*	@return		string				HTML escaped
	**/
	function oblyon_preset_text($text)
	{
		global $langs;

		if ($text === '')	return '';
		$trans	= $langs->trans($text);
		return dol_escape_htmltag($trans != $text ? $trans : $text);
	}

	/**
	*	Color used by the preview of a card : the preset's, else the current setting, else grey ('#' = inherit counts as missing)
	*
	*	@param		array	$preset		Preset
	*	@param		string	$name		Constant name
	*	@return		string				'#RRGGBB'
	**/
	function oblyon_preset_color($preset, $name)
	{
		$value	= isset($preset['sections']['colors'][$name]) ? $preset['sections']['colors'][$name] : getDolGlobalString($name);
		if (preg_match('/^#([0-9A-F])([0-9A-F])([0-9A-F])$/i', $value, $reg))	$value	= '#'.$reg[1].$reg[1].$reg[2].$reg[2].$reg[3].$reg[3];	// #RGB -> #RRGGBB
		return preg_match('/^#[0-9A-F]{6}$/i', $value) ? $value : '#CCCCCC';
	}

	/**
	 *	Preview block of preset card: screenshot img/oblyon<key>.png of the module when it exists (the five shipped presets), else a drawing from the colors.
	 *
	 *	@param 			array	$preset		Preset (oblyon_get_perset)
	 *	@param			string	$key		Preset key
	 *	@param			string	$source		Source of the preset ('module' or 'instance' or 'user')
	 *	@return			string				HTML of the preview block
	 **/
	function oblyon_preset_card_preview($preset, $key, $source) {
		global $langs;
		$shot		= ($source == 'module' && file_exists(dol_buildpath('/oblyon/img/oblyon'.$key.'.png', 0)));
		$out	= '<div class="oblyon-preset__preview'.($shot ? ' oblyon-preset__preview--img' : '').'" style="background:'.oblyon_preset_color($preset, 'OBLYON_COLOR_BCKGRD').'" title="'.($shot ? dol_escape_htmltag(oblyon_preset_text($preset['name'] !== '' ? $preset['name'] : $key)) : $langs->trans('OblyonPresetPreview')).'">';
		if ($shot) {
			$out	.= '<img src="'.dol_buildpath('/oblyon/img/oblyon'.$key.'.png', 1).'" alt="">';
		} else {
			$out	.= '<div class="oblyon-preset__top" style="background:'.oblyon_preset_color($preset, 'OBLYON_COLOR_TOPMENU_BCKGRD').'"><i style="background:'.oblyon_preset_color($preset, 'OBLYON_COLOR_MAIN').'"></i></div>';
			$out	.= '<div class="oblyon-preset__left" style="background:'.oblyon_preset_color($preset, 'OBLYON_COLOR_LEFTMENU_BCKGRD').'"></div>';
			$out	.= '<div class="oblyon-preset__page"><div class="oblyon-preset__band" style="background:'.oblyon_preset_color($preset, 'OBLYON_COLOR_BTITLE').'"><i style="background:'.oblyon_preset_color($preset, 'THEME_ELDY_TEXTTITLE').'"></i></div>';
			$out	.= '<div class="oblyon-preset__row" style="background:'.oblyon_preset_color($preset, 'OBLYON_COLOR_BLINE').'"><i style="background:'.oblyon_preset_color($preset, 'OBLYON_COLOR_FLINE').'"></i></div>';
			$out	.= '<div class="oblyon-preset__row" style="background:'.oblyon_preset_color($preset, 'OBLYON_COLOR_BLINE').'"><i style="background:'.oblyon_preset_color($preset, 'THEME_ELDY_TEXTLINK').'"></i></div>';
			$out	.= '<div class="oblyon-preset__btn" style="background:'.oblyon_preset_color($preset, 'THEME_ELDY_BTNACTION').'"></div></div>';
		}
		$out	.= '</div>';
		return $out;
	}
	/**
	*	HTML of the preset cards (module presets, then instance presets) with their action buttons (POST forms).
	*	A preset is applied, updated and saved as a whole : the section choice only exists in the library (CLI, other callers).
	*
	*	@return		string		HTML
	**/
	function oblyon_print_preset_cards()
	{
		global $langs, $conf;

		$langs->load('oblyon@oblyon');
		$presets	= oblyon_get_presets();
		$current	= getDolGlobalString('OBLYON_CURRENT_PRESET');
		$self		= dol_escape_htmltag($_SERVER['PHP_SELF']);
		$out		= '';
		foreach (array('module' => 'OblyonPresetsModule', 'instance' => 'OblyonPresetsInstance') as $source => $titlekey) {
			$group	= array();
			foreach ($presets as $key => $preset)	{
				if ($preset['source'] == $source && $preset['scope'] !== 'user') {
					$group[$key]	= $preset;
				}
			}
			if (! count($group) && $source == 'module')	continue;
			$out	.= '<div class="oblyon-presets"><div class="oblyon-presets__title">'.$langs->trans($titlekey).($source == 'instance' ? ' <span class="opacitymedium small">('.dol_escape_htmltag(oblyon_presets_dirs()['instance']).')</span>' : '').'</div>';
			$out	.= '<div class="opacitymedium small oblyon-presets__help">'.$langs->trans(count($group) ? 'OblyonPresetsHelp' : 'OblyonPresetsInstanceEmpty').'</div>';
			$out	.= '<div class="oblyon-presets__grid">';
			foreach ($group as $key => $preset) {
				$iscurrent	= ($current === $key);
				$modified	= $iscurrent ? oblyon_preset_modified_sections($preset) : array();
				$out	.= '<form method="POST" action="'.$self.'" class="oblyon-preset'.($iscurrent ? ' is-current' : '').($modified ? ' is-modified' : '').'">';
				$out	.= '<input type="hidden" name="token" value="'.newToken().'"><input type="hidden" name="preset_key" value="'.dol_escape_htmltag($key).'">';
				$out	.= oblyon_preset_card_preview($preset, $key, $source);	// InfraS change : apercu partage avec l'onglet utilisateur
				// Head : name (description as tooltip) + badges (3.8.0 : the contrast warning icon is gone with the contrast mechanism)
				$sections	= implode(', ', array_map('oblyon_presets_section_label', array_keys($preset['sections'])));
				$tooltip	= ($preset['description'] !== '' ? oblyon_preset_text($preset['description'])."\n" : '').$langs->trans('OblyonPresetSections').' : '.$sections;
				$out	.= '<div class="oblyon-preset__head"><div class="oblyon-preset__name" title="'.dol_escape_htmltag($tooltip, 0, 1).'">'.oblyon_preset_text($preset['name'] !== '' ? $preset['name'] : $key);
				if ($iscurrent)	$out	.= ' <span class="badge badge-status4 badge-status" title="'.dol_escape_htmltag($langs->trans('OblyonPresetCurrent')).'">'.$langs->trans('OblyonPresetCurrent').'</span>';
				if ($modified)	$out	.= ' <span class="badge badge-status1 badge-status" title="'.dol_escape_htmltag($langs->trans('OblyonPresetModifiedHelp', implode(', ', array_map('oblyon_presets_section_label', $modified)))).'">'.$langs->trans('OblyonPresetModified').'</span>';
				$out	.= '</div>';
				$out	.= '</div>';
				// Actions : a preset is always applied / updated as a whole (no section choice) ; stacked full-width buttons
				$out	.= '<div class="oblyon-preset__actions">';
				$out	.= '<button type="submit" name="action" value="apply_preset" class="butAction small oblyon-preset__apply">'.$langs->trans($modified ? 'OblyonPresetRevert' : 'OblyonPresetApply').'</button>';
				if ($preset['source'] == 'instance' && $modified)	$out	.= '<button type="submit" name="action" value="save_preset" class="butAction small oblyon-preset__apply">'.$langs->trans('OblyonPresetSave').'</button>';
				$out	.= '<div class="oblyon-preset__row-btn">';
				$out	.= '<a class="butAction small" href="'.$self.'?action=download_preset&preset_key='.urlencode($key).'&token='.newToken().'" title="'.dol_escape_htmltag($langs->trans('OblyonPresetDownload')).'"><span class="fa fa-download"></span></a>';	// InfraS change : icone seule, le libelle Download debordait du bouton (l'infobulle title porte deja le libelle complet)
				if ($preset['source'] == 'instance')	$out	.= '<button type="submit" name="action" value="delete_preset" class="butActionDelete small" title="'.dol_escape_htmltag($langs->trans('OblyonPresetDelete')).'" onclick="return confirm(\''.dol_escape_js($langs->trans('OblyonPresetDeleteConfirm', $key)).'\');"><span class="fa fa-trash paddingright"></span>'.$langs->trans('OblyonPresetDelete').'</button>';
				$out	.= '</div></div></form>';
			}
			$out	.= '</div></div>';
		}
		return $out;
	}

	/**
	*	HTML of the "save as" and "import" forms (POST) shown under the cards
	*
	*	@return		string		HTML
	**/
	function oblyon_print_preset_forms()
	{
		global $langs, $db;

		require_once DOL_DOCUMENT_ROOT.'/core/class/html.form.class.php';
		$form		= new Form($db);
		$langs->load('oblyon@oblyon');
		$self		= dol_escape_htmltag($_SERVER['PHP_SELF']);
		$modulekeys	= array();
		foreach (oblyon_get_presets() as $key => $preset)	if ($preset['source'] == 'module')	$modulekeys[]	= $key;
		$keyhelp	= $form->textwithpicto('', $langs->trans('OblyonPresetKeyHelp', implode(', ', $modulekeys)), 1, 'help', '', 0, 2);
		$out	= '<div class="oblyon-presets oblyon-presets--forms">';
		// Save as
		// Both forms are folded (<details>, no JS) : only the title shows until it is clicked
		$out	.= '<details class="oblyon-presets__form"><summary class="oblyon-presets__title">'.$langs->trans('OblyonPresetSaveAsTitle').'</summary>';
		$out	.= '<form method="POST" action="'.$self.'"><input type="hidden" name="token" value="'.newToken().'"><input type="hidden" name="action" value="saveas_preset">';
		$out	.= '<div class="opacitymedium small">'.$langs->trans('OblyonPresetSaveAsHelp').'</div>';
		$out	.= '<div class="oblyon-presets__fields">';
		$out	.= '<label class="oblyon-presets__field"><span>'.$langs->trans('OblyonPresetKey').$keyhelp.'</span><input type="text" name="preset_key" class="flat" maxlength="40" pattern="[a-z0-9][a-z0-9_-]{1,39}" placeholder="mon-entreprise" required></label>';
		$out	.= '<label class="oblyon-presets__field oblyon-presets__field--wide"><span>'.$langs->trans('OblyonPresetName').'</span><input type="text" name="preset_name" class="flat" maxlength="80" required></label>';
		$out	.= '<label class="oblyon-presets__field oblyon-presets__field--full"><span>'.$langs->trans('OblyonPresetDesc').'</span><input type="text" name="preset_desc" class="flat" maxlength="255"></label></div>';
		$out	.= '<button type="submit" class="butAction small">'.$langs->trans('OblyonPresetSaveAs').'</button></form></details>';
		// Import
		$out	.= '<details class="oblyon-presets__form"><summary class="oblyon-presets__title">'.$langs->trans('OblyonPresetImport').'</summary>';
		$out	.= '<form method="POST" action="'.$self.'" enctype="multipart/form-data"><input type="hidden" name="token" value="'.newToken().'"><input type="hidden" name="action" value="import_preset">';
		$out	.= '<div class="opacitymedium small">'.$langs->trans('OblyonPresetImportHelp').'</div>';
		$out	.= '<div class="oblyon-presets__fields">';
		$out	.= '<label class="oblyon-presets__field oblyon-presets__field--wide"><span>'.$langs->trans('File').'</span><input type="file" name="preset_file" accept=".json,application/json" required></label>';
		$out	.= '<label class="oblyon-presets__field"><span>'.$langs->trans('OblyonPresetKeyOptional').$form->textwithpicto('', $langs->trans('OblyonPresetKeyOptionalHelp'), 1, 'help', '', 0, 2).'</span><input type="text" name="preset_key" class="flat" maxlength="40" pattern="[a-z0-9][a-z0-9_-]{1,39}"></label></div>';
		$out	.= '<div class="oblyon-preset__sections"><label><input type="checkbox" name="preset_replace" value="1"> '.$langs->trans('OblyonPresetImportReplace').'</label></div>';
		$out	.= '<button type="submit" class="butAction small">'.$langs->trans('OblyonPresetImportButton').'</button></form></details>';
		$out	.= '</div>';
		return $out;
	}
