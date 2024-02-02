--	/************************************************
--	* Copyright (C) 2015-2022  Alexandre Spangaro   <support@open-dsi.fr>
--	* Copyright (C) 2022       Sylvain Legrand      <contact@infras.fr>
--	*
--	* This program is free software: you can redistribute it and/or modify
--	* it under the terms of the GNU General Public License as published by
--	* the Free Software Foundation, either version 3 of the License, or
--	* (at your option) any later version.
--	*
--	* This program is distributed in the hope that it will be useful,
--	* but WITHOUT ANY WARRANTY; without even the implied warranty of
--	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
--	* GNU General Public License for more details.
--	*
--	* You should have received a copy of the GNU General Public License
--	* along with this program.  If not, see <http://www.gnu.org/licenses/>.
--	************************************************/

--	/************************************************
--	* 	\file		../oblyon/sql/data.sql
--	* 	\ingroup	oblyon
--	* 	\brief		SQL data for module oblyon
--	************************************************/

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';

-- Data for table llx_const
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENU_STANDARD_FORCED',				'__ENTITY__', 'oblyon_menu.php',	'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENUFRONT_STANDARD_FORCED',			'__ENTITY__', 'oblyon_menu.php',	'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENU_SMARTPHONE_FORCED',				'__ENTITY__', 'oblyon_menu.php',	'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENUFRONT_SMARTPHONE_FORCED',		'__ENTITY__', 'oblyon_menu.php',	'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_ENABLE_PERSONALIZED',			'__ENTITY__', '1',					'chaine',	'0',	'Oblyon module');

-- Menus
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENU_INVERT',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
-- Menus - top
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_FULLSIZE_TOPBAR',					'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_SHOW_LOGO',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_STICKY_TOPBAR',					'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_HIDE_TOPICONS',					'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
-- Menus - left
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_SHOW_COMPNAME',					'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_STICKY_LEFTBAR',					'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_HIDE_LEFTMENU',					'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_EFFECT_LEFTMENU',					'__ENTITY__', 'slide',				'chaine',	'0',	'Oblyon leftmenu effect behavior');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_HIDE_LEFTICONS',					'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_REDUCE_LEFTMENU',					'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_EFFECT_REDUCE_LEFTMENU',			'__ENTITY__', 'only',				'chaine',	'0',	'Oblyon module');

-- Color - use Oblyon Green by default
-- Color - top
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_BCKGRD',				'__ENTITY__', '#34495E',			'chaine',	'0',	'Oblyon background topmenu color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_BCKGRD_HOVER',		'__ENTITY__', '#2C3E50',			'chaine',	'0',	'Oblyon background topmenu hover color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_TXT',				'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon topmenu text color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_TXT_ACTIVE',			'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon text top menu active');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_TXT_HOVER',			'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon text top menu hover');
-- Color - left
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LEFTMENU_BCKGRD',			'__ENTITY__', '#2ECC71',			'chaine',	'0',	'Oblyon background leftmenu color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER',		'__ENTITY__', '#29B564',			'chaine',	'0',	'Oblyon background leftmenu hover color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LEFTMENU_TXT',				'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon foreground leftmenu color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LEFTMENU_TXT_ACTIVE',		'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon foreground leftmenu hover color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LEFTMENU_TXT_HOVER',			'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon foreground leftmenu hover color');
-- Color - button
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_ACTION1',				'__ENTITY__', '#0088CC',			'chaine',	'0',	'Oblyon button action color 1');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_ACTION2',				'__ENTITY__', '#0044CC',			'chaine',	'0',	'Oblyon button action color 2');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE1',				'__ENTITY__', '#CC8800',			'chaine',	'0',	'Oblyon button delete color 1');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE2',				'__ENTITY__', '#CC4400',			'chaine',	'0',	'Oblyon button delete color 2');
-- Color - message
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_INFO_BORDER',				'__ENTITY__', '#87CFD2',			'chaine',	'0',	'Oblyon border info message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_INFO_BCKGRD',				'__ENTITY__', '#EFF8FC',			'chaine',	'0',	'Oblyon background info message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_INFO_TEXT',					'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon text info message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_WARNING_BORDER',				'__ENTITY__', '#F2CF87',			'chaine',	'0',	'Oblyon border warning message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_WARNING_BCKGRD',				'__ENTITY__', '#FCF8E3',			'chaine',	'0',	'Oblyon background warning message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_WARNING_TEXT',				'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon text warning message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_ERROR_BORDER',				'__ENTITY__', '#E0796E',			'chaine',	'0',	'Oblyon border error message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_ERROR_BCKGRD',				'__ENTITY__', '#F07B6E',			'chaine',	'0',	'Oblyon background error message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_ERROR_TEXT',					'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon text error message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_NOTIF_INFO_BCKGRD',			'__ENTITY__', '#D9E5D1',			'chaine',	'0',	'Oblyon background info notification');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_NOTIF_INFO_TEXT',			'__ENTITY__', '#446548',			'chaine',	'0',	'Oblyon text info notification');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_NOTIF_WARNING_BCKGRD',		'__ENTITY__', '#FFF7D1',			'chaine',	'0',	'Oblyon background warning notification');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_NOTIF_WARNING_TEXT',			'__ENTITY__', '#A28918',			'chaine',	'0',	'Oblyon text warning notification');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_NOTIF_ERROR_BCKGRD',			'__ENTITY__', '#D79EAC',			'chaine',	'0',	'Oblyon background error notification');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_NOTIF_ERROR_TEXT',			'__ENTITY__', '#A72947',			'chaine',	'0',	'Oblyon text error notification');
-- Color - options
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_MAIN',						'__ENTITY__', '#0083A2',			'chaine',	'0',	'Oblyon maincolor');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BCKGRD',						'__ENTITY__', '#F4F4F4',			'chaine',	'0',	'Oblyon background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LOGO_BCKGRD',				'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon background logo color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LOGIN_BCKGRD',				'__ENTITY__', '#F4F4F4',			'chaine',	'0',	'Oblyon background login color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BTITLE',						'__ENTITY__', '#0083A2',			'chaine',	'0',	'Oblyon background title');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_FTITLE',						'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon text title');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BLINE',						'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon background line color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BLINE_HOVER',				'__ENTITY__', '#E0E0E0',			'chaine',	'0',	'Oblyon background line color hover');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_FLINE',						'__ENTITY__', '#444444',			'chaine',	'0',	'Oblyon text line');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_FLINE_HOVER',				'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon text line color hover');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_FDATE_DEFAULT',				'__ENTITY__', '#FF0000',			'chaine',	'0',	'Oblyon text default date (today) color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TEXTTABACTIVE',				'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon text tab active');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_INPUT_BCKGRD',				'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon background imput color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_INVERT_RATIO_FILTER',				'__ENTITY__', '0',					'chaine',	'0',	'Oblyon Ratio for invert filter');
-- Color - Default Eldy values
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TOPBORDER_TITLE1',				'__ENTITY__', '#D4D4D4',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_BACKTITLE1',					'__ENTITY__', '#2ECC71',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_BACKTABACTIVE',				'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_LINEPAIR1',					'__ENTITY__', '#FDFDFD',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_LINEPAIR2',					'__ENTITY__', '#FDFDFD',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_LINEIMPAIR1',					'__ENTITY__', '#F0F0F0',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_LINEIMPAIR2',					'__ENTITY__', '#F0F0F0',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_LINEBREAK',					'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TEXTTITLENOTAB',				'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TEXTTITLE',					'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TEXT',							'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TEXTLINK',						'__ENTITY__', '#000000',			'chaine',	'0',	'Oblyon module');

-- Dashboard - infobox
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_GLOBAL_WORKBOARD',			'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_GLOBAL_BOXSTATS',			'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_INFOBOX_COLOR_ON_BACKGROUND',	   	'__ENTITY__', '0',			        'chaine',	'0',	'Oblyon dashboard invert color icon');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_METEO',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_AGENDA',				'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_PROJECT',				'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_CUSTOMER',				'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_SUPPLIER',				'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_CONTRACT',				'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_BANK',					'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_ADHERENT',				'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_EXPENSEREPORT',		'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_HOLIDAY',				'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_TICKET',				'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
-- Dashboard - color
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_AGRESSIVENESS_RATIO',		    	'__ENTITY__', '-50',		        'chaine',	'0',	'Oblyon dashboard agressiveness ratio');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_BACKGROUND',		    	'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon infobox background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_WEATHER_COLOR',			'__ENTITY__', '#BDBDBD',			'chaine',	'0',	'Oblyon weather background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_ACTION_COLOR',			'__ENTITY__', '#AB4DA1',			'chaine',	'0',	'Oblyon action background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_PROJECT_COLOR',			'__ENTITY__', '#6C6A98',			'chaine',	'0',	'Oblyon project background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_CUSTOMER_PROPAL_COLOR',   '__ENTITY__', '#49CC29',			'chaine',	'0',	'Oblyon customer proposal background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_CUSTOMER_ORDER_COLOR',    '__ENTITY__', '#49CC29',			'chaine',	'0',	'Oblyon customer order background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_CUSTOMER_INVOICE_COLOR',  '__ENTITY__', '#49CC29',			'chaine',	'0',	'Oblyon customer invoice background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_SUPPLIER_PROPAL_COLOR',   '__ENTITY__', '#599CAF',			'chaine',	'0',	'Oblyon supplier proposal background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_SUPPLIER_ORDER_COLOR',    '__ENTITY__', '#599CAF',			'chaine',	'0',	'Oblyon supplier order background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_SUPPLIER_INVOICE_COLOR',  '__ENTITY__', '#599CAF',			'chaine',	'0',	'Oblyon supplier invoice background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_CONTRAT_COLOR',			'__ENTITY__', '#8C5545',			'chaine',	'0',	'Oblyon contract background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_BANK_COLOR',				'__ENTITY__', '#3333CC',			'chaine',	'0',	'Oblyon bank background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_ADHERENT_COLOR',			'__ENTITY__', '#79631C',			'chaine',	'0',	'Oblyon member background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_EXPENSEREPORT_COLOR',		'__ENTITY__', '#D1D12A',			'chaine',	'0',	'Oblyon expense report background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_HOLIDAY_COLOR',			'__ENTITY__', '#E0A01F',			'chaine',	'0',	'Oblyon Dashboard holiday background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_TICKET_COLOR',			'__ENTITY__', '#C93E28',			'chaine',	'0',	'Oblyon Dashboard ticket background color');

-- Options - general
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_FONT_SIZE',						'__ENTITY__', '14',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_IMAGE_HEIGHT_TABLE',		    	'__ENTITY__', '24',					'chaine',	'0',	'Oblyon max height for image on tables');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_DISABLE_VERSION',					'__ENTITY__', '1',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_STATUS_USES_IMAGES',					'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN',		'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_USE_TOP_MENU_BOOKMARK_DROPDOWN',		'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_PADDING_RIGHT_BOTTOM',				'__ENTITY__', '1',					'chaine',	'0',	'Oblyon module');

--Options - page de connexion
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_LOGIN_RIGHT',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');

-- Options - comportement des fiches
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FIX_AREAREF_TABACTION',					'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');

-- Options - liste
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_CHECKBOX_LEFT_COLUMN',				'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FIX_STICKY_HEADER_CARD',					'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');

-- Custom CSS
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_CUSTOM_CSS',						'__ENTITY__', '',					'yesno',	'0',	'Oblyon module');

SET FOREIGN_KEY_CHECKS = 1;