<?php
	/************************************************
	* Copyright (C) 2003       Rodolphe Quiedeville <rodolphe@quiedeville.org>
	* Copyright (C) 2004-2012  Laurent Destailleur  <eldy@users.sourceforge.net>
	* Copyright (C) 2005-2012  Regis Houssin        <regis.houssin@capnetworks.com>
	* Copyright (C) 2015-2024  Alexandre Spangaro   <alexandre@inovea-conseil.com>
	* Copyright (C) 2022-2025  Sylvain Legrand      <contact@infras.fr>
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
	* along with this program.  If not, see <http://www.gnu.org/licenses/>.
	************************************************/

	/************************************************
	* 	\file		../oblyon/core/modules/modOblyon.class.php
	* 	\ingroup	oblyon
	* 	\brief		Description and activation file for module oblyon
	************************************************/

	// Libraries ************************************
	include_once DOL_DOCUMENT_ROOT.'/core/modules/DolibarrModules.class.php';
	dol_include_once('/oblyon/lib/oblyon.lib.php');
	dol_include_once('/oblyon/backport/v21/core/lib/functions.lib.php');

	// Description and activation class *************
	class modoblyon extends DolibarrModules
	{
		/************************************************
		 * Constructor. Define names, constants, directories, boxes, permissions
		 * @param DoliDB $db Database handler
		************************************************/
		function __construct($db)
		{
			global $langs, $conf;

			$langs->loadLangs(array('oblyon@oblyon', 'inovea@oblyon'));

			$easyaVersion					= getDolGlobalFloat('EASYA_VERSION', 0);
			$this->db						= $db;
			$this->numero					= 432573;																				// Unique Id for module
			$this->name						= preg_replace('/^mod/i', '', get_class($this));	// Module label (no space allowed)
			$this->editor_name				= '<b>Inovea Conseil</b>';
			$this->editor_web				= 'https://www.inovea-conseil.com';
			$this->editor_url				= "https://www.inovea-conseil.com";
			$this->editor_email				= 'support@inovea-conseil.com';
			$this->url_last_version 		= 'https://raw.githubusercontent.com/aspangaro/oblyon/14.0/htdocs/custom/oblyon/VERSION';
			$this->rights_class				= $this->name;																			// Key text used to identify module (for permissions, menus, etc...)
			$this->family					= 'Inovea Conseil';																		// used to group modules in module setup page
			$this->module_position			= 10;
			$this->module_position			= 1;
			$this->description				= $langs->trans('Module432573Desc');												// Module description
			$this->version					= file_get_contents(__DIR__.'/../../VERSION');								// Version : 'development', 'experimental', 'dolibarr' or 'dolibarr_deprecated' or version
			$this->const_name				= 'MAIN_MODULE_'.strtoupper($this->name);										// llx_const table to save module status enabled/disabled
			$this->special					= 0;																					// Where to store the module in setup page (0=common,1=interface,2=others,3=very specific)
			$this->picto					= 'inovea@'.$this->name;																// Name of image file used for this module. If in theme => 'pictovalue' ; if in module => 'pictovalue@module' under name object_pictovalue.png
			$this->module_parts				= array('menus'	=> 1,
													'js'	=> array('js'	=> '/'.$this->name.'/js/pushy.js'),
													'css'	=> array('css'	=> ('/'.$this->name.'/css/'.$this->name.'.css'), ('/theme/'.$this->name.'/custom.css.php')),
													'tpl'	=> 0,
													'hooks' => array('data' => array('main'), 'entity' => '0')
													);
			$this->dirs						= array('/'.$this->name.'/sql');														// Data directories to create when module is enabled. Example: this->dirs = array("/mymodule/temp");
			$this->config_page_url			= array('menus.php@'.$this->name);														// List of php page, stored into mymodule/admin directory, to use to setup module.
			// Dependencies
			$this->hidden					= false;																				// A condition to hide module
			$this->depends					= array();																				// List of modules id that must be enabled if this module is enabled
			$this->requiredby				= array();																				// List of modules id to disable if this one is disabled
			$this->conflictwith				= array("modQuickUX");																	// List of modules id this module is in conflict with
			$this->phpmin					= array(7,1);																			// Minimum version of PHP required by module
      		$this->need_dolibarr_version	= array(14,0);																			// Minimum version of Dolibarr required by module
			if ($easyaVersion >= '2024') {
				$easya_info = json_decode(file_get_contents(__DIR__ . '/../../.easya_info.json'));
				$this->phpmin = explode('.', $easya_info->php_min_version);										// Minimum version of PHP required by module
				$this->need_dolibarr_version = explode('.', $easya_info->dlb_min_version);						// Minimum version of Dolibarr required by module
			}
			$this->langfiles				= array($this->name.'@'.$this->name);
			$this->const					= array();																				// List of particular constants to add when module is enabled

			// WIP - Remove classic Dolibarr tabs to avoid a theme change problem (Only available > 15.0.x)

    		if ($easyaVersion >= '2022.5.2' || (float) DOL_VERSION >= 16.0) {
				$this->tabs = array(
					//'ihm_admin:-template',
					//'ihm_admin:-dashboard',
					//'ihm_admin:-login',
					//'ihm_admin:+template_oblyon:Colors:oblyon@oblyon::/oblyon/admin/colors.php',
				);
			}
			if (!isModEnabled('oblyon')) {
				$conf->oblyon			= new stdClass();
				$conf->oblyon->enabled	= 0;
			}
			$this->dictionaries	= array();	// Dictionaries
			$this->boxes		= array();	// List of boxes
			$this->cronjobs		= array();	// List of cron jobs entries to add
			$this->rights		= array();	// Permission array used by this module
			$this->menu			= array();	// List of menus to add
		}

		/************************************************
		 *		Function called when module is enabled.
		 *		The init function add constants, boxes, permissions and menus (defined in constructor) into Dolibarr database.
		 *		It also creates data directories
		 *      @param		string		$options		Options when enabling module ('', 'noboxes')
		 *      @return		int							1 if OK, 0 if KO
		************************************************/
		function init($options = '')
		{
			global $langs, $conf;
			$sql		= array();
			$this->_load_tables('/'.$this->name.'/sql/');
			oblyon_restore_module($this->name);
			// Copy dir oblyon/themeoblyon to theme/oblyon
			$srcDir		= dol_buildpath('/oblyon/themeoblyon');
			$destDir	= DOL_DOCUMENT_ROOT.'/theme/oblyon';
			if (dol_is_dir($destDir)) {
				$result	= dol_delete_dir_recursive($destDir);
				if ($result < 0) {
					setEventMessage($langs->trans('OblyonDeleteThemeError'), 'errors');
					return 0;
				}
			}
			$result	= dolCopyDir($srcDir, $destDir, 0, 1);
			if ($result < 0) {
				setEventMessage($langs->trans('OblyonCopyThemeError'), 'errors');
				return 0;
			}
			// Get highest font awesome directory
			$path				= dol_buildpath('/theme/common/', 0);
			$listdir			= dol_dir_list($path, 'directories', 0, '^fontawesome-', null, 'name', SORT_ASC, 0, 0, '', 0);
			$listFontawesome	= array();
			foreach ($listdir as $dir) {
				if (empty($dir['name']))	continue;
				if (preg_match('/^fontawesome-([0-9])$/', $dir['name'], $reg)) {
					$listFontawesome[$reg[1]]	= $dir['name'];
				}
			}
			$fontawesome_directory	= count($listFontawesome) > 1 ? $listFontawesome[max(array_keys($listFontawesome))] : (!empty($listFontawesome) ? reset($listFontawesome) : 'fontawesome-5');
			dolibarr_set_const($this->db, 'MAIN_FONTAWESOME_DIRECTORY', '/theme/common/'.$fontawesome_directory, 'chaine', 0, 'module Oblyon', 0);
			// delete old menu manager
			if (file_exists(dol_buildpath('/core/menus/standard/oblyon_menu.php')))	unlink(dol_buildpath('/core/menus/standard/oblyon_menu.php'));
			if (file_exists(dol_buildpath('/core/menus/standard/oblyon.lib.php')))	unlink(dol_buildpath('/core/menus/standard/oblyon.lib.php'));
			dolibarr_set_const($this->db,'MAIN_THEME','oblyon', 'chaine', 0, '', $conf->entity);
			dolibarr_set_const($this->db,'MAIN_MENU_INVERT', getDolGlobalInt('MAIN_MENU_INVERT_OBLYON_SAVE'), 'chaine', 0, '', $conf->entity);
			dolibarr_del_const($this->db,'MAIN_MENU_INVERT_OBLYON_SAVE', $conf->entity);

			// Désactivé en menu inversé car provoque un chargement html dans la page style.css et empêche le chargement des variables css
			dolibarr_del_const($this->db,'OBLYON_SHOW_COMPNAME', $conf->entity);
			return $this->_init($sql, $options);
		}

 		/************************************************
		 * Function called when module is disabled.
		 * Remove from database constants, boxes and permissions from Dolibarr database.
		 * Data directories are not deleted
		 * @param		string		$options		Options when enabling module ('', 'noboxes')
		 * @return		int							1 if OK, 0 if KO
		************************************************/
		function remove($options = '')
		{
			global $conf, $langs;
			$sql		= array();
			oblyon_bkup_module ($this->name);

			dolibarr_set_const($this->db,'MAIN_THEME','eldy', 'chaine', 0, '', $conf->entity);
			dolibarr_set_const($this->db,'MAIN_MENU_INVERT_OBLYON_SAVE', getDolGlobalInt('MAIN_MENU_INVERT'), 'chaine', 0, '', $conf->entity);
			dolibarr_set_const($this->db,'MAIN_MENU_INVERT', 0, 'chaine', 0, '', $conf->entity);

			dolibarr_del_const($this->db,'MAIN_MENU_STANDARD_FORCED', $conf->entity);
			dolibarr_del_const($this->db,'MAIN_MENUFRONT_STANDARD_FORCED', $conf->entity);
			dolibarr_del_const($this->db,'MAIN_MENU_SMARTPHONE_FORCED', $conf->entity);
			dolibarr_del_const($this->db,'MAIN_MENUFRONT_SMARTPHONE_FORCED', $conf->entity);

			dolibarr_del_const($this->db,'THEME_ELDY_BACKTABCARD1', $conf->entity);
			dolibarr_del_const($this->db,'THEME_ELDY_BACKTABACTIVE', $conf->entity);
			dolibarr_del_const($this->db,'THEME_ELDY_TOPBORDER_TITLE1', $conf->entity);
			dolibarr_del_const($this->db,'THEME_ELDY_LINEIMPAIR1', $conf->entity);
			dolibarr_del_const($this->db,'THEME_ELDY_LINEIMPAIR2', $conf->entity);
			dolibarr_del_const($this->db,'THEME_ELDY_LINEPAIR1', $conf->entity);
			dolibarr_del_const($this->db,'THEME_ELDY_LINEPAIR2', $conf->entity);
			dolibarr_del_const($this->db,'THEME_ELDY_LINEBREAK', $conf->entity);
			dolibarr_del_const($this->db,'THEME_ELDY_TEXTTITLENOTAB', $conf->entity);
			dolibarr_del_const($this->db,'THEME_ELDY_TEXT', $conf->entity);
			dolibarr_del_const($this->db,'THEME_ELDY_TEXTLINK', $conf->entity);
			dolibarr_del_const($this->db,'THEME_ELDY_ENABLE_PERSONALIZED', $conf->entity);

			dolibarr_del_const($this->db,'MAIN_FONTAWESOME_ICON_STYLE', $conf->entity);
			dolibarr_del_const($this->db,'MAIN_FONTAWESOME_WEIGHT', $conf->entity);

			$destDir	= DOL_DOCUMENT_ROOT.'/theme/oblyon';
			if (dol_is_dir($destDir)) {
				$result = dol_delete_dir_recursive($destDir);
				if ($result < 0) {
					setEventMessage($langs->trans('ThemeOblyonErrorDelete'), 'errors');
					return 0;
				}
			}
			return $this->_remove($sql, $options);
		}
	}
