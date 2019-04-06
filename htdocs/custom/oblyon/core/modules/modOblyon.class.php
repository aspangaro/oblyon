<?php
/**
 * Copyright (C) 2015-2016  Nicolas Rivera      <nrivera.pro@gmail.com>
 * Copyright (C) 2015-2018  Open-DSI            <support@open-dsi.fr>
 *
 * Copyright (C) 2003      Rodolphe Quiedeville <rodolphe@quiedeville.org>
 * Copyright (C) 2004-2012 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) 2005-2012 Regis Houssin        <regis.houssin@capnetworks.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *  \file       core/modules/modOblyon.class.php
 *  \ingroup    oblyon
 *  \brief      Description and activation file for module MyModule
 */

include_once DOL_DOCUMENT_ROOT .'/core/modules/DolibarrModules.class.php';


/**
 * Description and activation class for module MyModule
 */

class modOblyon extends DolibarrModules {

/**
 * Constructor. Define names, constants, directories, boxes, permissions
 *
 * @param  DoliDB  $db  Database handler
 */
function __construct($db) {
	global $langs,$conf;

	$this->db = $db;

	// Id for module (must be unique).
	// Use here a free id (See in Home -> System information -> Dolibarr for list of used modules id).
	$this->numero = 113900;
	
	// Key text used to identify module (for permissions, menus, etc...)
	$this->rights_class = 'oblyon';

	// Family can be 'crm','financial','hr','projects','products','ecm','technic','other'
	// It is used to group modules in module setup page
	$this->family = "other";

	// Module label (no space allowed), used if translation string 'ModuleXXXName' not found (where XXX is value of numeric property 'numero' of module)
	$this->name = preg_replace('/^mod/i','',get_class($this));

	// Module description, used if translation string 'ModuleXXXDesc' not found (where XXX is value of numeric property 'numero' of module)
	$this->description = "Thème Oblyon";

	// Possible values for version are: 'development', 'experimental', 'dolibarr' or version
	$this->version = '9.0.0';

	$this->editor_name = "ZenDSI";

	$this->editor_url = "https://shop.zendsi.com";

	// Key used in llx_const table to save module status enabled/disabled (where MYMODULE is value of property name of module in uppercase)
	$this->const_name = 'MAIN_MODULE_'.strtoupper($this->name);

	// Where to store the module in setup page (0=common,1=interface,2=others,3=very specific)
	$this->special = 1;

	// Name of image file used for this module.
	// If file is in theme/yourtheme/img directory under name object_pictovalue.png, use this->picto='pictovalue'
	// If file is in module/img directory under name object_pictovalue.png, use this->picto='pictovalue@module'
	$this->picto='oblyon@oblyon';

	// Defined all module parts (triggers, login, substitutions, menus, css, etc...)
	// for default path (eg: /oblyon/core/xxxxx) (0=disable, 1=enable)
	// for specific path of parts (eg: /oblyon/core/modules/barcode)
	// for specific css file (eg: /oblyon/css/oblyon.css.php)
	$this->module_parts = array(
		'menus' => 1, // Set this to 1 if module has its own menus handler directory (core/menus)
		// 'theme' => 0, // Set this to 1 if module has its own theme directory (core/theme)
		// 'css' => '/oblyon/css/oblyon.css.php', // Set this to relative path of css file if module has its own css file
		'js' => '/oblyon/js/pushy.js', // Set this to relative path of js file if module must load a js on all pages
	);


	// Config pages. Put here list of php page, stored into oblyon/admin directory, to use to setup module.
	$this->config_page_url = array("menus.php@oblyon");

	// Dependencies
	$this->depends = array();		// List of modules id that must be enabled if this module is enabled
	$this->requiredby = array();	// List of modules id to disable if this one is disabled
	$this->phpmin = array(5,0);					// Minimum version of PHP required by module
	$this->need_dolibarr_version = array(3,5);	// Minimum version of Dolibarr required by module
	$this->langfiles = array("oblyon@oblyon");

	// Constants
	$this->const = array ();
	$r = 0;

	$r ++;
	$this->const [$r] [0] = "MAIN_MENU_STANDARD_FORCED";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "oblyon_menu.php";
	$this->const [$r] [3] = 0;
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'current';
	$this->const [$r] [6] = 1;

	$r ++;
	$this->const [$r] [0] = "MAIN_MENUFRONT_STANDARD_FORCED";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "oblyon_menu.php";
	$this->const [$r] [3] = 0;
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'current';
	$this->const [$r] [6] = 1;

	$r ++;
	$this->const [$r] [0] = "MAIN_MENU_SMARTPHONE_FORCED";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "oblyon_menu.php";
	$this->const [$r] [3] = 0;
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'current';
	$this->const [$r] [6] = 1;

	$r ++;
	$this->const [$r] [0] = "MAIN_MENUFRONT_SMARTPHONE_FORCED";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "oblyon_menu.php";
	$this->const [$r] [3] = 0;
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'current';
	$this->const [$r] [6] = 1;

	$r ++;
	$this->const [$r] [0] = "OBLYON_COLOR_MAIN";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "#0083A2";
	$this->const [$r] [3] = 'Oblyon maincolor';
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'allentities';
	$this->const [$r] [6] = 0;

	$r ++;
	$this->const [$r] [0] = "OBLYON_COLOR_TOPMENU_BCKGRD";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "#333333";
	$this->const [$r] [3] = 'Oblyon background topmenu color';
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'allentities';
	$this->const [$r] [6] = 0;

	$r ++;
	$this->const [$r] [0] = "OBLYON_COLOR_TOPMENU_BCKGRD_HOVER";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "#444444";
	$this->const [$r] [3] = 'Oblyon background topmenu hover color';
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'allentities';
	$this->const [$r] [6] = 0;

	$r ++;
	$this->const [$r] [0] = "OBLYON_COLOR_TOPMENU_TXT";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "#F4F4F4";
	$this->const [$r] [3] = 'Oblyon topmenu text color';
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'allentities';
	$this->const [$r] [6] = 0;

	$r ++;
	$this->const [$r] [0] = "OBLYON_COLOR_LEFTMENU_BCKGRD";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "#333333";
	$this->const [$r] [3] = 'Oblyon background leftmenu color';
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'allentities';
	$this->const [$r] [6] = 0;

	$r ++;
	$this->const [$r] [0] = "OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "#444444";
	$this->const [$r] [3] = 'Oblyon background leftmenu hover color';
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'allentities';
	$this->const [$r] [6] = 0;

	$r ++;
	$this->const [$r] [0] = "OBLYON_COLOR_LEFTMENU_TXT";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "#F4F4F4";
	$this->const [$r] [3] = 'Oblyon foreground leftmenu color';
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'allentities';
	$this->const [$r] [6] = 0;

	$r ++;
	$this->const [$r] [0] = "OBLYON_EFFECT_LEFTMENU";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "slide";
	$this->const [$r] [3] = 'Oblyon leftmenu effect behavior';
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'allentities';
	$this->const [$r] [6] = 0;

	$r ++;
	$this->const [$r] [0] = "OBLYON_COLOR_BCKGRD";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "#F4F4F4";
	$this->const [$r] [3] = 'Oblyon background color';
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'allentities';
	$this->const [$r] [6] = 0;

	$r ++;
	$this->const [$r] [0] = "OBLYON_COLOR_LOGO_BCKGRD";
	$this->const [$r] [1] = "chaine";
	$this->const [$r] [2] = "#FFFFFF";
	$this->const [$r] [3] = 'Oblyon background logo color';
	$this->const [$r] [4] = 1;
	$this->const [$r] [5] = 'allentities';
	$this->const [$r] [6] = 0;


	// Dictionaries
	if (! isset($conf->oblyon->enabled)) {
		$conf->oblyon=new stdClass();
		$conf->oblyon->enabled=0;
	}
	$this->dictionnaries=array();
}

	/**
	 * Function called when module is enabled.
	 * The init function add constants, boxes, permissions and menus (defined in constructor) into Dolibarr database.
	 * It also creates data directories
	 *
	 * @param   string	$options  Options when enabling module ('', 'noboxes')
	 * @return  int  1 if OK, 0 if KO
	 */
	function init($options='') {
		$sql = array();

		$result=$this->load_tables();

		// delete old menu manager
		if (file_exists(dol_buildpath('/core/menus/standard/oblyon_menu.php'))) unlink(dol_buildpath('/core/menus/standard/oblyon_menu.php'));
		if (file_exists(dol_buildpath('/core/menus/standard/oblyon.lib.php'))) unlink(dol_buildpath('/core/menus/standard/oblyon.lib.php'));

		dolibarr_set_const($this->db,'MAIN_THEME','oblyon');

		return $this->_init($sql, $options);
	}

	/**
	 * Function called when module is disabled.
	 * Remove from database constants, boxes and permissions from Dolibarr database.
	 * Data directories are not deleted
	 *
	 * @param  string	$options  Options when enabling module ('', 'noboxes')
	 * @return  int  1 if OK, 0 if KO
	 */
	function remove($options='') {
		$sql = array();

		dolibarr_set_const($this->db,'MAIN_THEME','eldy');
		dolibarr_set_const($this->db,'MAIN_MENU_INVERT',0);
		
		dolibarr_del_const($this->db,'MAIN_MENU_STANDARD_FORCED');
		dolibarr_del_const($this->db,'MAIN_MENUFRONT_STANDARD_FORCED');
		dolibarr_del_const($this->db,'MAIN_MENU_SMARTPHONE_FORCED');
		dolibarr_del_const($this->db,'MAIN_MENUFRONT_SMARTPHONE_FORCED');
			
		return $this->_remove($sql, $options);
	}


	/**
	 * Create tables, keys and data required by module
	 * Files llx_table1.sql, llx_table1.key.sql llx_data.sql with create table, create keys
	 * and create data commands must be stored in directory /oblyon/sql/
	 * This function is called by this->init
	 *
	 * @return  int  <=0 if KO, >0 if OK
	 */
	function load_tables() {
		return $this->_load_tables('/oblyon/sql/');
	}
}

?>
