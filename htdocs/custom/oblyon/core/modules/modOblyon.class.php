<?php
	/************************************************
	* Copyright (C) 2003       Rodolphe Quiedeville <rodolphe@quiedeville.org>
	* Copyright (C) 2004-2012  Laurent Destailleur  <eldy@users.sourceforge.net>
	* Copyright (C) 2005-2012  Regis Houssin        <regis.houssin@capnetworks.com>
	* Copyright (C) 2015-2022  Alexandre Spangaro   <support@open-dsi.fr>
	* Copyright (C) 2022       Sylvain Legrand      <contact@infras.fr>
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

			$langs->loadLangs(array('oblyon@oblyon', 'opendsi@oblyon'));
			$this->db				= $db;
			$this->numero			= 113900;									// Unique Id for module
			$this->name				= preg_replace('/^mod/i', '', get_class($this));	// Module label (no space allowed)
			$this->editor_name		= '<b>Open-DSI</b>';
			$this->editor_web		= 'https://www.open-dsi.fr';
			$this->editor_url		= "https://www.open-dsi.fr";
			$this->editor_email		= 'support@open-dsi.fr';
			$this->rights_class		= $this->name;								// Key text used to identify module (for permissions, menus, etc...)
			$family					= (!empty($conf->global->EASYA_VERSION) ? 'easya' : 'opendsi');
			$this->family			= $family;									// used to group modules in module setup page
			$this->module_position	= 10;
			$this->familyinfo		= array($family => array('position' => '001', 'label' => $langs->trans($family . "Family")));
			$this->module_position	= 1;
			$this->description		= $langs->trans('Module113900Desc');	// Module description
			$this->version			= '2.1.0';							// Version : 'development', 'experimental', 'dolibarr' or 'dolibarr_deprecated' or version
			$this->const_name		= 'MAIN_MODULE_'.strtoupper($this->name);	// llx_const table to save module status enabled/disabled
			$this->special			= 0;										// Where to store the module in setup page (0=common,1=interface,2=others,3=very specific)
			$this->picto			= 'opendsi_big@'.$this->name;				// Name of image file used for this module. If in theme => 'pictovalue' ; if in module => 'pictovalue@module' under name object_pictovalue.png
			$this->module_parts		= array('menus'	=> 1,
											'js'	=> array('js'	=> '/'.$this->name.'/js/pushy.js'),
											'css'	=> array('css'	=> '/'.$this->name.'/css/'.$this->name.'.css'),
											'tpl'	=> 1,
											'hooks' => array('data' => array('main'),'entity' => '0',),
											);
			$this->dirs				= array('/'.$this->name.'/sql');			// Data directories to create when module is enabled. Example: this->dirs = array("/mymodule/temp");
			$this->config_page_url	= array('menus.php@'.$this->name);			// List of php page, stored into mymodule/admin directory, to use to setup module.
			// Dependencies
			$this->hidden			= false;									// A condition to hide module
			$this->depends			= array();									// List of modules id that must be enabled if this module is enabled
			$this->requiredby		= array();									// List of modules id to disable if this one is disabled
			$this->conflictwith		= array();									// List of modules id this module is in conflict with
			$this->phpmin			= array(5, 6);								// Minimum version of PHP required by module
      		$this->need_dolibarr_version = array(14,0);							// Minimum version of Dolibarr required by module
			$this->langfiles		= array($this->name.'@'.$this->name);
			$this->const			= array();									// List of particular constants to add when module is enabled
			$this->tabs				= array();
			if (! isset($conf->oblyon->enabled)) {
				$conf->oblyon			= new stdClass();
				$conf->oblyon->enabled	= 0;
			}
			$this->dictionaries	= array();										// Dictionaries
			$this->boxes		= array();										// List of boxes
			$this->cronjobs		= array();										// List of cron jobs entries to add
			$this->rights		= array();										// Permission array used by this module
			$this->menu			= array();										// List of menus to add
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
			global $conf;
			$sql	= array();
			$this->_load_tables('/'.$this->name.'/sql/');
			oblyon_restore_module ($this->name);
			// delete old menu manager
			if (file_exists(dol_buildpath('/core/menus/standard/oblyon_menu.php')))	unlink(dol_buildpath('/core/menus/standard/oblyon_menu.php'));
			if (file_exists(dol_buildpath('/core/menus/standard/oblyon.lib.php')))		unlink(dol_buildpath('/core/menus/standard/oblyon.lib.php'));
			dolibarr_set_const($this->db,'MAIN_THEME','oblyon', 'chaine', 0, '', $conf->entity);
			dolibarr_set_const($this->db,'MAIN_MENU_INVERT', getDolGlobalInt('MAIN_MENU_INVERT_OBLYON_SAVE'), 'chaine', 0, '', $conf->entity);
			dolibarr_del_const($this->db,'MAIN_MENU_INVERT_OBLYON_SAVE', $conf->entity);
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
			global $conf;
			$sql	= array();
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

			return $this->_remove($sql, $options);
		}	// function remove($options = '')
	}
?>
