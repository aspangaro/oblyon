<?php
	/************************************************
	* Copyright (C) 2003       Rodolphe Quiedeville <rodolphe@quiedeville.org>
	* Copyright (C) 2004-2012  Laurent Destailleur  <eldy@users.sourceforge.net>
	* Copyright (C) 2005-2012  Regis Houssin        <regis.houssin@capnetworks.com>
	* Copyright (C) 2015-2024  Alexandre Spangaro   <alexandre@inovea-conseil.com>
	* Copyright (C) 2022-2026  Sylvain Legrand      <contact@infras.fr>
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
	dol_include_once('/oblyon/backport/v21/core/lib/functions.lib.php');
	dol_include_once('/oblyon/lib/oblyon.lib.php');

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
			$isDolinfras					= isModEnabled('dolinfras');
			$family							= $isDolinfras ? getDolGlobalString('DOLINFRAS_FAMILY') : 'Inovea Conseil';
			$this->family					= $family;																		// used to group modules in module setup page
			$this->familyinfo				= array($family => array('position' => '001', 'label' => $langs->trans($family)));
			$this->module_position			= 100016;
			$this->description				= $langs->trans('Module432573Desc');												// Module description
			$this->version					= file_get_contents(__DIR__.'/../../VERSION');								// Version : 'development', 'experimental', 'dolibarr' or 'dolibarr_deprecated' or version
			$this->const_name				= 'MAIN_MODULE_'.strtoupper($this->name);										// llx_const table to save module status enabled/disabled
			$this->special					= 0;																					// Where to store the module in setup page (0=common,1=interface,2=others,3=very specific)
			$this->picto					= 'inovea@'.$this->name;																// Name of image file used for this module. If in theme => 'pictovalue' ; if in module => 'pictovalue@module' under name object_pictovalue.png
			$this->module_parts				= array('menus'	=> 1,
													'js'	=> array('/'.$this->name.'/js/pushy.js', '/'.$this->name.'/js/oblyon.js'),
													'css'	=> array('css'	=> ('/'.$this->name.'/css/'.$this->name.'.css'), ('/theme/'.$this->name.'/custom.css.php'), ('/'.$this->name.'/css/font.css')),
													'tpl'	=> 0,
													'hooks' => array('data' => array('main'), 'entity' => '0')
													);
			$this->dirs						= array('/'.$this->name.'/sql');														// Data directories to create when module is enabled. Example: this->dirs = array("/mymodule/temp");
			$this->config_page_url			= array('options.php@'.$this->name);														// List of php page, stored into mymodule/admin directory, to use to setup module.
			// Dependencies
			$this->hidden					= false;																				// A condition to hide module
			$this->depends					= array();																				// List of modules id that must be enabled if this module is enabled
			$this->requiredby				= array();																				// List of modules id to disable if this one is disabled
			$this->conflictwith				= array("modQuickUX");																	// List of modules id this module is in conflict with
			$this->phpmin					= array(7,1);																			// Minimum version of PHP required by module
      		$this->need_dolibarr_version	= array(18,0);																			// Minimum version of Dolibarr required by module
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
			// InfraS change begin : controle/deploiement du theme htdocs/theme/oblyon AVANT toute ecriture en base (voir deployTheme()) ; plus aucune suppression du theme
			if ($this->deployTheme() < 0) {
						return 0;
			}
			// InfraS change end
			$this->_load_tables('/'.$this->name.'/sql/');
			oblyon_restore_module($this->name);
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

			// Migration constante kanban : ancienne OBLYON_DISABLE_KANBAN_VIEW_IN_LIST -> DISABLE_KANBAN_VIEW_IN_LIST, puis suppression
			if (getDolGlobalString('OBLYON_DISABLE_KANBAN_VIEW_IN_LIST')) {
				if (!getDolGlobalString('DISABLE_KANBAN_VIEW_IN_LIST')) {
					dolibarr_set_const($this->db, 'DISABLE_KANBAN_VIEW_IN_LIST', getDolGlobalString('OBLYON_DISABLE_KANBAN_VIEW_IN_LIST'), 'chaine', 0, 'Oblyon module', $conf->entity);
				}
				dolibarr_del_const($this->db, 'OBLYON_DISABLE_KANBAN_VIEW_IN_LIST', $conf->entity);
			}
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

			dolibarr_del_const($this->db,'MAIN_FONTAWESOME_DIRECTORY', -1);
			dolibarr_del_const($this->db,'MAIN_FONTAWESOME_FAMILY', -1);
			dolibarr_del_const($this->db,'MAIN_FONTAWESOME_ICON_STYLE', -1);
			dolibarr_del_const($this->db,'MAIN_FONTAWESOME_WEIGHT', -1);
			// InfraS change : le theme htdocs/theme/oblyon n'est plus supprime a la desactivation (livre avec l'instance, PHP n'a pas forcement le droit d'ecrire dans htdocs/theme) ; MAIN_THEME est deja remis a eldy ci-dessus
			return $this->_remove($sql, $options);
		}
		// InfraS add begin
		/************************************************
		 *	Check or deploy the theme directory htdocs/theme/oblyon from the module source custom/oblyon/themeoblyon.
		 *	Dolibarr core hard-codes DOL_DOCUMENT_ROOT.'/theme/<theme>/' paths (theme_vars.inc.php, img/, ckeditor/...),
		 *	so the theme must physically exist there. The directory is never deleted :
		 *	- present and identical to the source	=> nothing to do
		 *	- missing or outdated, and writable		=> copied over (files overwritten, nothing deleted)
		 *	- outdated but not writable				=> warning, activation goes on with the current theme
		 *	- missing and not writable				=> error ($this->error set), activation must be aborted
		 *	@return		int		1 = theme up to date, 2 = theme copied, 0 = present but not updated (warning), -1 = missing or source not found (error)
		************************************************/
		private function deployTheme()
		{
			global $langs;
			require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';
			$srcDir		= dol_buildpath('/oblyon/themeoblyon', 0);
				$destDir	= DOL_DOCUMENT_ROOT.'/theme/oblyon';
			if (! dol_is_dir($srcDir)) {
				$this->error	= $langs->trans('OblyonThemeSourceMissing', $srcDir);
				dol_syslog(get_class($this).'::deployTheme '.$this->error, LOG_ERR);
				return -1;
			}
			$destExists	= dol_is_dir($destDir);
			if ($destExists && $this->themeIsUpToDate($srcDir, $destDir)) {
				return 1;
			}
			$canWrite	= $destExists ? is_writable($destDir) : is_writable(dirname($destDir));
			if ($canWrite) {
				dolCopyDir($srcDir, $destDir, 0, 1);	// overwrite existing files, never delete anything first
				if ($this->themeIsUpToDate($srcDir, $destDir)) {
					dol_syslog(get_class($this).'::deployTheme theme copied from '.$srcDir.' to '.$destDir);
					return 2;
				}
			}
				if (dol_is_dir($destDir)) {
				dol_syslog(get_class($this).'::deployTheme theme present in '.$destDir.' but could not be updated from '.$srcDir, LOG_WARNING);
				setEventMessages($langs->trans('OblyonThemeNotUpdated', $destDir, $srcDir, $srcDir, $destDir), null, 'warnings');
						return 0;
			}
			$this->error	= $langs->trans('OblyonThemeMissingNotWritable', $destDir, $srcDir, $destDir);
			dol_syslog(get_class($this).'::deployTheme '.$this->error, LOG_ERR);
			return -1;
		}
		/************************************************
		 *	Compare recursively the theme source with the deployed directory (size + md5 of every source file).
		 *	Extra files in the deployed directory (ex: instance specific modules/*.inc.php) are ignored.
		 *	@param		string	$srcDir		Module theme source directory
		 *	@param		string	$destDir	Deployed theme directory
		 *	@return		bool				True if every source file exists in destination with the same content
		************************************************/
		private function themeIsUpToDate($srcDir, $destDir)
		{
			$iterator	= new RecursiveIteratorIterator(new RecursiveDirectoryIterator($srcDir, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST);
			foreach ($iterator as $item) {
				$target	= $destDir.substr($item->getPathname(), strlen($srcDir));
				if ($item->isDir()) {
					if (! is_dir($target)) {
						return false;
					}
					continue;
				}
				if (! is_file($target) || filesize($target) != $item->getSize() || md5_file($target) !== md5_file($item->getPathname())) {
					return false;
				}
			}
			return true;
		}
		// InfraS add end
	}
