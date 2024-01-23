<?php
	/************************************************
	* Copyright (C) 2015-2022  Alexandre Spangaro   <support@open-dsi.fr>
	* Copyright (C) 2023	   Sylvain Legrand	  <contact@infras.fr>
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
	* 	\file		../oblyon/admin/colors.php
	* 	\ingroup	oblyon
	* 	\brief		Options Page < Oblyon Theme Configurator >
	************************************************/

	// Dolibarr environment *************************
	require '../config.php';

	// Libraries ************************************
	require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
	require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';
	require_once '../lib/oblyon.lib.php';

	// Translations *********************************
	$langs->loadLangs(array('admin', 'oblyon@oblyon', 'opendsi@oblyon'));

	// Access control *******************************
	if (! $user->admin)			accessforbidden();

	// Reset cache **********************************
	$_SESSION['dol_resetcache']	= dol_print_date(dol_now(), 'dayhourlog');

	// init variables *******************************
	$listcolor					= array('top'		=> array('OBLYON_COLOR_TOPMENU_BCKGRD',
															'OBLYON_COLOR_TOPMENU_BCKGRD_HOVER',
															'OBLYON_COLOR_TOPMENU_TXT',
															'OBLYON_COLOR_TOPMENU_TXT_ACTIVE',
															'OBLYON_COLOR_TOPMENU_TXT_HOVER'
															),
										'left'		=> array('OBLYON_COLOR_LEFTMENU_BCKGRD',
															'OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER',
															'OBLYON_COLOR_LEFTMENU_TXT',
															'OBLYON_COLOR_LEFTMENU_TXT_ACTIVE',
															'OBLYON_COLOR_LEFTMENU_TXT_HOVER',
															),
										'button'	=> array('OBLYON_COLOR_BUTTON_ACTION1',
															'OBLYON_COLOR_BUTTON_ACTION2',
															'OBLYON_COLOR_BUTTON_DELETE1',
															'OBLYON_COLOR_BUTTON_DELETE2'
															),
										'message'	=> array('OBLYON_COLOR_INFO_BORDER',
															'OBLYON_COLOR_INFO_BCKGRD',
															'OBLYON_COLOR_INFO_TEXT',
															'OBLYON_COLOR_WARNING_BORDER',
															'OBLYON_COLOR_WARNING_BCKGRD',
															'OBLYON_COLOR_WARNING_TEXT',
															'OBLYON_COLOR_ERROR_BORDER',
															'OBLYON_COLOR_ERROR_BCKGRD',
															'OBLYON_COLOR_ERROR_TEXT',
															'OBLYON_COLOR_NOTIF_INFO_BCKGRD',
															'OBLYON_COLOR_NOTIF_INFO_TEXT',
															'OBLYON_COLOR_NOTIF_WARNING_BCKGRD',
															'OBLYON_COLOR_NOTIF_WARNING_TEXT',
															'OBLYON_COLOR_NOTIF_ERROR_BCKGRD',
															'OBLYON_COLOR_NOTIF_ERROR_TEXT'
															),
										'options'	=> array('OBLYON_COLOR_MAIN',
															'OBLYON_COLOR_BCKGRD',
															'OBLYON_COLOR_LOGO_BCKGRD',
															'OBLYON_COLOR_LOGIN_BCKGRD',
															'OBLYON_COLOR_BTITLE',
															'OBLYON_COLOR_FTITLE',
															'OBLYON_COLOR_BLINE',
															'OBLYON_COLOR_BLINE_HOVER',
															'OBLYON_COLOR_FLINE',
															'OBLYON_COLOR_FLINE_HOVER',
															'OBLYON_COLOR_FDATE_DEFAULT',
															'OBLYON_COLOR_TEXTTABACTIVE',
															'OBLYON_COLOR_INPUT_BCKGRD'
															),
										'eldy'		=> array('THEME_ELDY_TOPBORDER_TITLE1',
															'THEME_ELDY_BACKTITLE1',
															'THEME_ELDY_BACKTABACTIVE',
															'THEME_ELDY_LINEIMPAIR1',
															'THEME_ELDY_LINEIMPAIR2',
															'THEME_ELDY_LINEPAIR1',
															'THEME_ELDY_LINEPAIR2',
															'THEME_ELDY_LINEBREAK',
															'THEME_ELDY_TEXTTITLENOTAB',
															'THEME_ELDY_TEXTTITLE',
															'THEME_ELDY_TEXT',
															'THEME_ELDY_TEXTLINK'
															)
										);
	$listtheme					= array('green'		=> array('OBLYON_INFOXBOX_BACKGROUND'			=> '#FFFFFF',
															'OBLYON_COLOR_TOPMENU_BCKGRD'			=> '#34495E',
															'OBLYON_COLOR_TOPMENU_BCKGRD_HOVER'		=> '#2C3E50',
															'OBLYON_COLOR_TOPMENU_TXT'				=> '#FFFFFF',
															'OBLYON_COLOR_TOPMENU_TXT_ACTIVE'		=> '#',
															'OBLYON_COLOR_TOPMENU_TXT_HOVER'		=> '#',
															'OBLYON_COLOR_LEFTMENU_BCKGRD'			=> '#2ECC71',
															'OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER'	=> '#29B564',
															'OBLYON_COLOR_LEFTMENU_TXT'				=> '#FFFFFF',
															'OBLYON_COLOR_LEFTMENU_TXT_ACTIVE'		=> '#',
															'OBLYON_COLOR_LEFTMENU_TXT_HOVER'		=> '#222222',
															'OBLYON_COLOR_BUTTON_ACTION1'			=> '#0088CC',
															'OBLYON_COLOR_BUTTON_ACTION2'			=> '#0044CC',
															'OBLYON_COLOR_BUTTON_DELETE1'			=> '#CC8800',
															'OBLYON_COLOR_BUTTON_DELETE2'			=> '#CC4400',
															'OBLYON_COLOR_INFO_BORDER'				=> '#87cfd2',
															'OBLYON_COLOR_INFO_BCKGRD'				=> '#eff8fc',
															'OBLYON_COLOR_INFO_TEXT'				=> '#222222',
															'OBLYON_COLOR_WARNING_BORDER'			=> '#f2cf87',
															'OBLYON_COLOR_WARNING_BCKGRD'			=> '#fcf8e3',
															'OBLYON_COLOR_WARNING_TEXT'				=> '#222222',
															'OBLYON_COLOR_ERROR_BORDER'				=> '#e0796e',
															'OBLYON_COLOR_ERROR_BCKGRD'				=> '#f07b6e',
															'OBLYON_COLOR_ERROR_TEXT'				=> '#222222',
															'OBLYON_COLOR_NOTIF_INFO_BCKGRD'		=> '#d9e5d1',
															'OBLYON_COLOR_NOTIF_INFO_TEXT'			=> '#446548',
															'OBLYON_COLOR_NOTIF_WARNING_BCKGRD'		=> '#fff7d1',
															'OBLYON_COLOR_NOTIF_WARNING_TEXT'		=> '#a28918',
															'OBLYON_COLOR_NOTIF_ERROR_BCKGRD'		=> '#d79eac',
															'OBLYON_COLOR_NOTIF_ERROR_TEXT'			=> '#a72947',
															'OBLYON_COLOR_MAIN'						=> '#0083A2',
															'OBLYON_COLOR_BCKGRD'					=> '#F5F5F5',
															'OBLYON_COLOR_LOGO_BCKGRD'				=> '#FFFFFF',
															'OBLYON_COLOR_LOGIN_BCKGRD'				=> '#F4F4F4',
															'OBLYON_COLOR_BTITLE'					=> '#0083A2',
															'OBLYON_COLOR_FTITLE'					=> '#222222',
															'OBLYON_COLOR_BLINE'					=> '#FFFFFF',
															'OBLYON_COLOR_BLINE_HOVER'				=> '#F1F1F1',
															'OBLYON_COLOR_FLINE'					=> '#444444',
															'OBLYON_COLOR_FLINE_HOVER'				=> '#222222',
															'OBLYON_COLOR_FDATE_DEFAULT'			=> '#FF0000',
															'OBLYON_COLOR_TEXTTABACTIVE'			=> '#222222',
															'OBLYON_COLOR_INPUT_BCKGRD'				=> '#FFFFFF',
															'THEME_INVERT_RATIO_FILTER'				=> '0',
															'THEME_ELDY_TOPBORDER_TITLE1'			=> '#FFFFFF',
															'THEME_ELDY_BACKTITLE1'					=> '#E9EAED',
															'THEME_ELDY_BACKTABACTIVE'				=> '#FFFFFF',
															'THEME_ELDY_LINEIMPAIR1'				=> '#FFFFFF',
															'THEME_ELDY_LINEIMPAIR2'				=> '#FFFFFF',
															'THEME_ELDY_LINEPAIR1'					=> '#FBFBFB',
															'THEME_ELDY_LINEPAIR2'					=> '#FBFBFB',
															'THEME_ELDY_LINEBREAK'					=> '#FFFFFF',
															'THEME_ELDY_TEXTTITLENOTAB'				=> '#222222',
															'THEME_ELDY_TEXTTITLE'					=> '#28283C',
															'THEME_ELDY_TEXT'						=> '#000000',
															'THEME_ELDY_TEXTLINK'					=> '#1C1C1C'
															),
										'dark'		=> array('OBLYON_INFOXBOX_BACKGROUND'			=> '#FFFFFF',
															'OBLYON_COLOR_TOPMENU_BCKGRD'			=> '#333333',
															'OBLYON_COLOR_TOPMENU_BCKGRD_HOVER'		=> '#0083A2',
															'OBLYON_COLOR_TOPMENU_TXT'				=> '#F4F4F4',
															'OBLYON_COLOR_TOPMENU_TXT_ACTIVE'		=> '#',
															'OBLYON_COLOR_TOPMENU_TXT_HOVER'		=> '#',
															'OBLYON_COLOR_LEFTMENU_BCKGRD'			=> '#333333',
															'OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER'	=> '#0083A2',
															'OBLYON_COLOR_LEFTMENU_TXT'				=> '#F4F4F4',
															'OBLYON_COLOR_LEFTMENU_TXT_ACTIVE'		=> '#',
															'OBLYON_COLOR_LEFTMENU_TXT_HOVER'		=> '#FFFFFF',
															'OBLYON_COLOR_BUTTON_ACTION1'			=> '#0083A2',
															'OBLYON_COLOR_BUTTON_ACTION2'			=> '#0063A2',
															'OBLYON_COLOR_BUTTON_DELETE1'			=> '#CC8800',
															'OBLYON_COLOR_BUTTON_DELETE2'			=> '#CC4400',
															'OBLYON_COLOR_INFO_BORDER'				=> '#87cfd2',
															'OBLYON_COLOR_INFO_BCKGRD'				=> '#eff8fc',
															'OBLYON_COLOR_INFO_TEXT'				=> '#222222',
															'OBLYON_COLOR_WARNING_BORDER'			=> '#f2cf87',
															'OBLYON_COLOR_WARNING_BCKGRD'			=> '#fcf8e3',
															'OBLYON_COLOR_WARNING_TEXT'				=> '#222222',
															'OBLYON_COLOR_ERROR_BORDER'				=> '#e0796e',
															'OBLYON_COLOR_ERROR_BCKGRD'				=> '#f07b6e',
															'OBLYON_COLOR_ERROR_TEXT'				=> '#222222',
															'OBLYON_COLOR_NOTIF_INFO_BCKGRD'		=> '#d9e5d1',
															'OBLYON_COLOR_NOTIF_INFO_TEXT'			=> '#446548',
															'OBLYON_COLOR_NOTIF_WARNING_BCKGRD'		=> '#fff7d1',
															'OBLYON_COLOR_NOTIF_WARNING_TEXT'		=> '#a28918',
															'OBLYON_COLOR_NOTIF_ERROR_BCKGRD'		=> '#d79eac',
															'OBLYON_COLOR_NOTIF_ERROR_TEXT'			=> '#a72947',
															'OBLYON_COLOR_MAIN'						=> '#0083A2',
															'OBLYON_COLOR_BCKGRD'					=> '#F4F4F4',
															'OBLYON_COLOR_LOGO_BCKGRD'				=> '#FFFFFF',
															'OBLYON_COLOR_LOGIN_BCKGRD'				=> '#F4F4F4',
															'OBLYON_COLOR_BTITLE'					=> '#0083A2',
															'OBLYON_COLOR_FTITLE'					=> '#222222',
															'OBLYON_COLOR_BLINE'					=> '#FFFFFF',
															'OBLYON_COLOR_BLINE_HOVER'				=> '#F1F1F1',
															'OBLYON_COLOR_FLINE'					=> '#444444',
															'OBLYON_COLOR_FLINE_HOVER'				=> '#222222',
															'OBLYON_COLOR_FDATE_DEFAULT'			=> '#FF0000',
															'OBLYON_COLOR_TEXTTABACTIVE'			=> '#222222',
															'OBLYON_COLOR_INPUT_BCKGRD'				=> '#FFFFFF',
															'THEME_INVERT_RATIO_FILTER'				=> '80',
															'THEME_ELDY_TOPBORDER_TITLE1'			=> '#FFFFFF',
															'THEME_ELDY_BACKTITLE1'					=> '#E9EAED',
															'THEME_ELDY_BACKTABACTIVE'				=> '#FFFFFF',
															'THEME_ELDY_LINEIMPAIR1'				=> '#FFFFFF',
															'THEME_ELDY_LINEIMPAIR2'				=> '#FFFFFF',
															'THEME_ELDY_LINEPAIR1'					=> '#FBFBFB',
															'THEME_ELDY_LINEPAIR2'					=> '#FBFBFB',
															'THEME_ELDY_LINEBREAK'					=> '#FFFFFF',
															'THEME_ELDY_TEXTTITLENOTAB'				=> '#222222',
															'THEME_ELDY_TEXTTITLE'					=> '#28283C',
															'THEME_ELDY_TEXT'						=> '#000000',
															'THEME_ELDY_TEXTLINK'					=> '#1C1C1C'
															),
										'blue'		=> array('OBLYON_INFOXBOX_BACKGROUND'			=> '#FFFFFF',
															'OBLYON_COLOR_TOPMENU_BCKGRD'			=> '#092D5C',
															'OBLYON_COLOR_TOPMENU_BCKGRD_HOVER'		=> '#0D4185',
															'OBLYON_COLOR_TOPMENU_TXT'				=> '#F4F4F4',
															'OBLYON_COLOR_TOPMENU_TXT_ACTIVE'		=> '#',
															'OBLYON_COLOR_TOPMENU_TXT_HOVER'		=> '#',
															'OBLYON_COLOR_LEFTMENU_BCKGRD'			=> '#092D5C',
															'OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER'	=> '#0D4185',
															'OBLYON_COLOR_LEFTMENU_TXT'				=> '#F4F4F4',
															'OBLYON_COLOR_LEFTMENU_TXT_ACTIVE'		=> '#F4F4F4',
															'OBLYON_COLOR_LEFTMENU_TXT_HOVER'		=> '#FFFFFF',
															'OBLYON_COLOR_BUTTON_ACTION1'			=> '#0088CC',
															'OBLYON_COLOR_BUTTON_ACTION2'			=> '#0044CC',
															'OBLYON_COLOR_BUTTON_DELETE1'			=> '#CC8800',
															'OBLYON_COLOR_BUTTON_DELETE2'			=> '#CC4400',
															'OBLYON_COLOR_INFO_BORDER'				=> '#87CFD2',
															'OBLYON_COLOR_INFO_BCKGRD'				=> '#EFF8FC',
															'OBLYON_COLOR_INFO_TEXT'				=> '#222222',
															'OBLYON_COLOR_WARNING_BORDER'			=> '#F2CF87',
															'OBLYON_COLOR_WARNING_BCKGRD'			=> '#FCF8E3',
															'OBLYON_COLOR_WARNING_TEXT'				=> '#222222',
															'OBLYON_COLOR_ERROR_BORDER'				=> '#E0796E',
															'OBLYON_COLOR_ERROR_BCKGRD'				=> '#F07B6E',
															'OBLYON_COLOR_ERROR_TEXT'				=> '#222222',
															'OBLYON_COLOR_NOTIF_INFO_BCKGRD'		=> '#446548',
															'OBLYON_COLOR_NOTIF_INFO_TEXT'			=> '#D9E5D1',
															'OBLYON_COLOR_NOTIF_WARNING_BCKGRD'		=> '#A28918',
															'OBLYON_COLOR_NOTIF_WARNING_TEXT'		=> '#FFF7D1',
															'OBLYON_COLOR_NOTIF_ERROR_BCKGRD'		=> '#A72947',
															'OBLYON_COLOR_NOTIF_ERROR_TEXT'			=> '#D79EAC',
															'OBLYON_COLOR_MAIN'						=> '#E09430',
															'OBLYON_COLOR_BCKGRD'					=> '#F4F4F4',
															'OBLYON_COLOR_LOGO_BCKGRD'				=> '#FFFFFF',
															'OBLYON_COLOR_LOGIN_BCKGRD'				=> '#F4F4F4',
															'OBLYON_COLOR_BTITLE'					=> '#E09430',
															'OBLYON_COLOR_FTITLE'					=> '#222222',
															'OBLYON_COLOR_BLINE'					=> '#FFFFFF',
															'OBLYON_COLOR_BLINE_HOVER'				=> '#F1F1F1',
															'OBLYON_COLOR_FLINE'					=> '#444444',
															'OBLYON_COLOR_FLINE_HOVER'				=> '#222222',
															'OBLYON_COLOR_FDATE_DEFAULT'			=> '#FF0000',
															'OBLYON_COLOR_TEXTTABACTIVE'			=> '#222222',
															'OBLYON_COLOR_INPUT_BCKGRD'				=> '#FFFFFF',
															'THEME_INVERT_RATIO_FILTER'				=> '0',
															'THEME_ELDY_TOPBORDER_TITLE1'			=> '#FFFFFF',
															'THEME_ELDY_BACKTITLE1'					=> '#E9EAED',
															'THEME_ELDY_BACKTABACTIVE'				=> '#FFFFFF',
															'THEME_ELDY_LINEIMPAIR1'				=> '#FFFFFF',
															'THEME_ELDY_LINEIMPAIR2'				=> '#FFFFFF',
															'THEME_ELDY_LINEPAIR1'					=> '#FBFBFB',
															'THEME_ELDY_LINEPAIR2'					=> '#FBFBFB',
															'THEME_ELDY_LINEBREAK'					=> '#FFFFFF',
															'THEME_ELDY_TEXTTITLENOTAB'				=> '#222222',
															'THEME_ELDY_TEXTTITLE'					=> '#28283C',
															'THEME_ELDY_TEXT'						=> '#000000',
															'THEME_ELDY_TEXTLINK'					=> '#1C1C1C'
															),
										'night'		=> array('OBLYON_INFOXBOX_BACKGROUND'			=> '#444444',
															'OBLYON_COLOR_TOPMENU_BCKGRD'			=> '#222222',
															'OBLYON_COLOR_TOPMENU_BCKGRD_HOVER'		=> '#333333',
															'OBLYON_COLOR_TOPMENU_TXT'				=> '#F4F4F4',
															'OBLYON_COLOR_TOPMENU_TXT_ACTIVE'		=> '#',
															'OBLYON_COLOR_TOPMENU_TXT_HOVER'		=> '#',
															'OBLYON_COLOR_LEFTMENU_BCKGRD'			=> '#2C2C2C',
															'OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER'	=> '#222222',
															'OBLYON_COLOR_LEFTMENU_TXT'				=> '#F4F4F4',
															'OBLYON_COLOR_LEFTMENU_TXT_ACTIVE'		=> '#',
															'OBLYON_COLOR_LEFTMENU_TXT_HOVER'		=> '#FFFFFF',
															'OBLYON_COLOR_BUTTON_ACTION1'			=> '#0088CC',
															'OBLYON_COLOR_BUTTON_ACTION2'			=> '#0044CC',
															'OBLYON_COLOR_BUTTON_DELETE1'			=> '#CC8800',
															'OBLYON_COLOR_BUTTON_DELETE2'			=> '#CC4400',
															'OBLYON_COLOR_INFO_BORDER'				=> '#87cfd2',
															'OBLYON_COLOR_INFO_BCKGRD'				=> '#eff8fc',
															'OBLYON_COLOR_INFO_TEXT'				=> '#222222',
															'OBLYON_COLOR_WARNING_BORDER'			=> '#f2cf87',
															'OBLYON_COLOR_WARNING_BCKGRD'			=> '#fcf8e3',
															'OBLYON_COLOR_WARNING_TEXT'				=> '#222222',
															'OBLYON_COLOR_ERROR_BORDER'				=> '#e0796e',
															'OBLYON_COLOR_ERROR_BCKGRD'				=> '#f07b6e',
															'OBLYON_COLOR_ERROR_TEXT'				=> '#222222',
															'OBLYON_COLOR_NOTIF_INFO_BCKGRD'		=> '#d9e5d1',
															'OBLYON_COLOR_NOTIF_INFO_TEXT'			=> '#446548',
															'OBLYON_COLOR_NOTIF_WARNING_BCKGRD'		=> '#fff7d1',
															'OBLYON_COLOR_NOTIF_WARNING_TEXT'		=> '#a28918',
															'OBLYON_COLOR_NOTIF_ERROR_BCKGRD'		=> '#d79eac',
															'OBLYON_COLOR_NOTIF_ERROR_TEXT'			=> '#a72947',
															'OBLYON_COLOR_MAIN'						=> '#E09430',
															'OBLYON_COLOR_BCKGRD'					=> '#444444',
															'OBLYON_COLOR_LOGO_BCKGRD'				=> '#FFFFFF',
															'OBLYON_COLOR_LOGIN_BCKGRD'				=> '#333333',
															'OBLYON_COLOR_BTITLE'					=> '#E09430',
															'OBLYON_COLOR_FTITLE'					=> '#F4F4F4',
															'OBLYON_COLOR_BLINE'					=> '#444444',
															'OBLYON_COLOR_BLINE_HOVER'				=> '#F1F1F1',
															'OBLYON_COLOR_FLINE'					=> '#ECECEC',
															'OBLYON_COLOR_FLINE_HOVER'				=> '#FCFCFC',
															'OBLYON_COLOR_FDATE_DEFAULT'			=> '#FF0000',
															'OBLYON_COLOR_TEXTTABACTIVE'			=> '#222222',
															'OBLYON_COLOR_INPUT_BCKGRD'				=> '#DEDEDE',
															'THEME_INVERT_RATIO_FILTER'				=> '0',
															'THEME_ELDY_TOPBORDER_TITLE1'			=> '#FFFFFF',
															'THEME_ELDY_BACKTITLE1'					=> '#E9EAED',
															'THEME_ELDY_BACKTABACTIVE'				=> '#444444',
															'THEME_ELDY_LINEIMPAIR1'				=> '#FFFFFF',
															'THEME_ELDY_LINEIMPAIR2'				=> '#FFFFFF',
															'THEME_ELDY_LINEPAIR1'					=> '#FBFBFB',
															'THEME_ELDY_LINEPAIR2'					=> '#FBFBFB',
															'THEME_ELDY_LINEBREAK'					=> '#FFFFFF',
															'THEME_ELDY_TEXTTITLENOTAB'				=> '#FFFFFF',
															'THEME_ELDY_TEXTTITLE'					=> '#28283C',
															'THEME_ELDY_TEXT'						=> '#000000',
															'THEME_ELDY_TEXTLINK'					=> '#1C1C1C'
															),
										'light'		=> array('OBLYON_INFOXBOX_BACKGROUND'			=> '#FFFFFF',
															'OBLYON_COLOR_TOPMENU_BCKGRD'			=> '#FFFFFF',
															'OBLYON_COLOR_TOPMENU_BCKGRD_HOVER'		=> '#D51123',
															'OBLYON_COLOR_TOPMENU_TXT'				=> '#444444',
															'OBLYON_COLOR_TOPMENU_TXT_ACTIVE'		=> '#FFFFFF',
															'OBLYON_COLOR_TOPMENU_TXT_HOVER'		=> '#FFFFFF',
															'OBLYON_COLOR_LEFTMENU_BCKGRD'			=> '#FFFFFF',
															'OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER'	=> '#D51123',
															'OBLYON_COLOR_LEFTMENU_TXT'				=> '#444444',
															'OBLYON_COLOR_LEFTMENU_TXT_ACTIVE'		=> '#FFFFFF',
															'OBLYON_COLOR_LEFTMENU_TXT_HOVER'		=> '#FFFFFF',
															'OBLYON_COLOR_BUTTON_ACTION1'			=> '#0083A2',
															'OBLYON_COLOR_BUTTON_ACTION2'			=> '#0063A2',
															'OBLYON_COLOR_BUTTON_DELETE1'			=> '#CC8800',
															'OBLYON_COLOR_BUTTON_DELETE2'			=> '#CC4400',
															'OBLYON_COLOR_INFO_BORDER'				=> '#87cfd2',
															'OBLYON_COLOR_INFO_BCKGRD'				=> '#eff8fc',
															'OBLYON_COLOR_INFO_TEXT'				=> '#222222',
															'OBLYON_COLOR_WARNING_BORDER'			=> '#f2cf87',
															'OBLYON_COLOR_WARNING_BCKGRD'			=> '#fcf8e3',
															'OBLYON_COLOR_WARNING_TEXT'				=> '#222222',
															'OBLYON_COLOR_ERROR_BORDER'				=> '#e0796e',
															'OBLYON_COLOR_ERROR_BCKGRD'				=> '#f07b6e',
															'OBLYON_COLOR_ERROR_TEXT'				=> '#222222',
															'OBLYON_COLOR_NOTIF_INFO_BCKGRD'		=> '#d9e5d1',
															'OBLYON_COLOR_NOTIF_INFO_TEXT'			=> '#446548',
															'OBLYON_COLOR_NOTIF_WARNING_BCKGRD'		=> '#fff7d1',
															'OBLYON_COLOR_NOTIF_WARNING_TEXT'		=> '#a28918',
															'OBLYON_COLOR_NOTIF_ERROR_BCKGRD'		=> '#d79eac',
															'OBLYON_COLOR_NOTIF_ERROR_TEXT'			=> '#a72947',
															'OBLYON_COLOR_MAIN'						=> '#D51123',
															'OBLYON_COLOR_BCKGRD'					=> '#FFFFFF',
															'OBLYON_COLOR_LOGO_BCKGRD'				=> '#FFFFFF',
															'OBLYON_COLOR_LOGIN_BCKGRD'				=> '#FFFFFF',
															'OBLYON_COLOR_BTITLE'					=> '#D51123',
															'OBLYON_COLOR_FTITLE'					=> '#222222',
															'OBLYON_COLOR_BLINE'					=> '#FFFFFF',
															'OBLYON_COLOR_BLINE_HOVER'				=> '#F1F1F1',
															'OBLYON_COLOR_FLINE'					=> '#444444',
															'OBLYON_COLOR_FLINE_HOVER'				=> '#D51123',
															'OBLYON_COLOR_FDATE_DEFAULT'			=> '#FF0000',
															'OBLYON_COLOR_TEXTTABACTIVE'			=> '#222222',
															'OBLYON_COLOR_INPUT_BCKGRD'				=> '#F4F4F4',
															'THEME_INVERT_RATIO_FILTER'				=> '0',
															'THEME_ELDY_TOPBORDER_TITLE1'			=> '#FFFFFF',
															'THEME_ELDY_BACKTITLE1'					=> '#E9EAED',
															'THEME_ELDY_BACKTABACTIVE'				=> '#FFFFFF',
															'THEME_ELDY_LINEIMPAIR1'				=> '#FFFFFF',
															'THEME_ELDY_LINEIMPAIR2'				=> '#FFFFFF',
															'THEME_ELDY_LINEPAIR1'					=> '#FBFBFB',
															'THEME_ELDY_LINEPAIR2'					=> '#FBFBFB',
															'THEME_ELDY_LINEBREAK'					=> '#FFFFFF',
															'THEME_ELDY_TEXTTITLENOTAB'				=> '#222222',
															'THEME_ELDY_TEXTTITLE'					=> '#28283C',
															'THEME_ELDY_TEXT'						=> '#000000',
															'THEME_ELDY_TEXTLINK'					=> '#1C1C1C'
														)
										);

	// Actions **************************************
	$action							= GETPOST('action','alpha');
	$result							= '';
	// Sauvegarde / Restauration
	if ($action == 'bkupParams')	$result	= oblyon_bkup_module ('oblyon');
	if ($action == 'restoreParams')	$result	= oblyon_restore_module ('oblyon');
	// On / Off management
	if (preg_match('/set_(.*)/', $action, $reg)) {
		$confkey	= $reg[1];
		$result		= dolibarr_set_const($db, $confkey, GETPOST('value'), 'chaine', 0, 'Oblyon module', $conf->entity);
	}
	// Update buttons management
	if (preg_match('/update_(.*)/', $action, $reg)) {
		$list		= array ('Gen'	=> array('THEME_INVERT_RATIO_FILTER'));
		$confkey	= $reg[1];
		$error		= 0;
		foreach ($list[$confkey] as $constname)	$result	= dolibarr_set_const($db, $constname, GETPOST($constname, 'alpha'),	'chaine', 0, 'Oblyon module', $conf->entity);
		foreach ($listcolor as $list)
			foreach ($list as $constname)	$result	= dolibarr_set_const($db, $constname, '#'.GETPOST($constname, 'alpha'),	'chaine', 0, 'Oblyon module', $conf->entity);
		if ($confkey == 'theme') {
			$res	= 1;
			foreach ($listtheme[GETPOST('value', 'alpha')] as $constname => $constvalue) {
				$result	= dolibarr_set_const($db, $constname, $constvalue,	'chaine', 0, 'Oblyon module', $conf->entity);
				$res	= $res * $result;
			}
			$result	= $res > 0 ? 2 : -1;
		}
	}
	// Retour => message Ok ou Ko
	if ($result == 2)	setEventMessages($langs->trans('ThemeApplied').' : '.$langs->trans('Oblyon'.GETPOST('value', 'alpha')), null, 'mesgs');
	if ($result == 1)	setEventMessages($langs->trans('SetupSaved'), null, 'mesgs');
	if ($result == -1)	setEventMessages($langs->trans('Error'), null, 'errors');

	// View *****************************************
	$page_name			= $langs->trans('OblyonColorsTitle');
	llxHeader('', $page_name, '', '', '', '', array('/oblyon/js/jscolor.js', '/oblyon/js/jquery.ui.touch-punch.min.js'), '');
	$linkback			= '<a href = "'.DOL_URL_ROOT.'/admin/modules.php">'.$langs->trans('BackToModuleList').'</a>';
	print load_fiche_titre($page_name, $linkback);

	// Configuration header *************************
	$head				= oblyon_admin_prepare_head();
	print dol_get_fiche_head($head, 'colors', $langs->trans('Module113900Name'), 0, 'opendsi@oblyon');

	// setup page goes here *************************
	print '	<script type = "text/javascript">
				$(document).ready(function() {
					$(".action").keyup(function(event) {
						if (event.which === 13)	$("#action").click();
					});
				});
			</script>
			<form action = "'.$_SERVER['PHP_SELF'].'" method = "POST" enctype = "multipart/form-data">
				<input type="hidden" name="token" value="'.newToken().'" />
				<input type="hidden" name="action" value="update">
				<input type="hidden" name="page_y" value="">
				<input type="hidden" name="dol_resetcache" value="1">';
	// Sauvegarde / Restauration
	oblyon_print_backup_restore();
	clearstatcache();
	print '		<div class = "div-table-responsive-no-min">
					<table summary = "edit" class = "noborder centpercent editmode tableforfield as-settings-colors">';
	$larg									= !empty($listtheme) && count($listtheme) > 0 ? 100 / count($listtheme) : 100;
	$metas									= array();
	for ($i = 0; $i < count($listtheme); $i++)	$metas[]	= $larg.'%';
	oblyon_print_colgroup($metas);
	// Infobox enable
	$metas									= array(array(count($listtheme)), 'Themes');
	oblyon_print_liste_titre($metas);
	print '				<tr>';
	foreach ($listtheme as $name => $values)
		print '				<td class = "center">
								<a title = "'.$langs->trans('Oblyon'.$name).'" href = "'.$_SERVER['PHP_SELF'].'?action=update_theme&token='.newToken().'&value='.$name.'">'.img_picto($langs->trans('Oblyon'.$name), 'oblyon'.$name.'.png@oblyon', 'width = "50%"').'
									<br/>'.$langs->trans('Oblyon'.$name).'
								</a>
							</td>';
	print '				</tr>';
	// Colors
	// Top menu
	$metas		= array(array(5), 'TopMenu');
	oblyon_print_liste_titre($metas);
	if (count($listcolor['top'])) {
		foreach ($listcolor['top'] as $key) {
			$metas	= array('type' => 'text', 'class' => 'flat quatrevingtpercent color action');
			oblyon_print_input($key, 'input', $langs->trans($key), '', $metas, 4, 1);
		}
	}
	// Left menu
	$metas		= array(array(5), 'LeftMenu');
	oblyon_print_liste_titre($metas);
	if (count($listcolor['left'])) {
		foreach ($listcolor['left'] as $key) {
			$metas	= array('type' => 'text', 'class' => 'flat quatrevingtpercent color action');
			oblyon_print_input($key, 'input', $langs->trans($key), '', $metas, 4, 1);
		}
	}
	// button
	$metas		= array(array(5), 'Buttons');
	oblyon_print_liste_titre($metas);
	if (count($listcolor['button'])) {
		foreach ($listcolor['button'] as $key) {
			$metas	= array('type' => 'text', 'class' => 'flat quatrevingtpercent color action');
			oblyon_print_input($key, 'input', $langs->trans($key), '', $metas, 4, 1);
		}
	}
	// message
	$metas		= array(array(5), 'Messages');
	oblyon_print_liste_titre($metas);
	if (count($listcolor['message'])) {
		foreach ($listcolor['message'] as $key) {
			$metas	= array('type' => 'text', 'class' => 'flat quatrevingtpercent color action');
			oblyon_print_input($key, 'input', $langs->trans($key), '', $metas, 4, 1);
		}
	}
	// Others
	$metas		= array(array(5), 'Others');
	oblyon_print_liste_titre($metas);
	if (count($listcolor['options'])) {
		foreach ($listcolor['options'] as $key) {
			$metas	= array('type' => 'text', 'class' => 'flat quatrevingtpercent color action');
			oblyon_print_input($key, 'input', $langs->trans($key), '', $metas, 4, 1);
		}
	}
	$metas	= '	<div class = "range-sliders" id = "range-sliders">
					<span class = "bold">0</span>
					<input type = "range" class = "range-slider flat soixantepercent action" id = "THEME_INVERT_RATIO_FILTER" name = "THEME_INVERT_RATIO_FILTER" min = "0" max = "100" value = "'.$conf->global->THEME_INVERT_RATIO_FILTER.'" />
					<input type = "number" class = "input-slider flat" id = "input-invert_ratio" style = "width: 35px;" min = "0" max = "100" value = "'.$conf->global->THEME_INVERT_RATIO_FILTER.'" />
					<span class = "bold">+100</span>
					<script src = "../js/range-slider.js"></script>
				</div>';
	oblyon_print_input('', 'range', $langs->trans('InvertRatioDesc', $conf->global->THEME_INVERT_RATIO_FILTER), '', $metas, 4, 1);

	// Eldy
	$metas		= array(array(5), 'Eldy');
	oblyon_print_liste_titre($metas);
	if (count($listcolor['eldy'])) {
		foreach ($listcolor['eldy'] as $key) {
			$metas	= array('type' => 'text', 'class' => 'flat quatrevingtpercent color action');
			oblyon_print_input($key, 'input', $langs->trans($key), '', $metas, 4, 1);
		}
	}
	print '			</table>
				</div>';
	print dol_get_fiche_end();
	oblyon_print_btn_action('Gen');
	print '	</form>
			<br/>';
	// End of page
	llxFooter();
	$db->close();
?>