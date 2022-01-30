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
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENU_STANDARD_FORCED',			'__ENTITY__', 'oblyon_menu.php',	'chaine', '0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENUFRONT_STANDARD_FORCED',		'__ENTITY__', 'oblyon_menu.php',	'chaine', '0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENU_SMARTPHONE_FORCED',			'__ENTITY__', 'oblyon_menu.php',	'chaine', '0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENUFRONT_SMARTPHONE_FORCED',	'__ENTITY__', 'oblyon_menu.php',	'chaine', '0',	'Oblyon module');

-- Color - use Oblyon blue by default
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_MAIN',					'__ENTITY__', '#E09430',			'chaine', '0',	'Oblyon maincolor');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_BCKGRD',			'__ENTITY__', '#092D5C',			'chaine', '0',	'Oblyon background topmenu color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_BCKGRD_HOVER',	'__ENTITY__', '#0D4185',			'chaine', '0',	'Oblyon background topmenu hover color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_TXT',			'__ENTITY__', '#F4F4F4',			'chaine', '0',	'Oblyon topmenu text color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LEFTMENU_BCKGRD',		'__ENTITY__', '#092D5C',			'chaine', '0',	'Oblyon background leftmenu color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER',	'__ENTITY__', '#0D4185',			'chaine', '0',	'Oblyon background leftmenu hover color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LEFTMENU_TXT',			'__ENTITY__', '#F4F4F4',			'chaine', '0',	'Oblyon foreground leftmenu color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_EFFECT_LEFTMENU',				'__ENTITY__', 'slide',				'chaine', '0',	'Oblyon leftmenu effect behavior');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BCKGRD',					'__ENTITY__', '#F4F4F4',			'chaine', '0',	'Oblyon background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LOGO_BCKGRD',			'__ENTITY__', '#FFFFFF',			'chaine', '0',	'Oblyon background logo color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LOGIN_BCKGRD',			'__ENTITY__', '#F4F4F4',			'chaine', '0',	'Oblyon background login color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BLINE',					'__ENTITY__', '#FCFCFC',			'chaine', '0',	'Oblyon background line color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BLINE_HOVER',			'__ENTITY__', '#F1F1F1',			'chaine', '0',	'Oblyon background line color hover');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_FLINE',					'__ENTITY__', '#444444',			'chaine', '0',	'Oblyon text line color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_FLINE_HOVER',			'__ENTITY__', '#222222',			'chaine', '0',	'Oblyon text line color hover');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_ACTION1',			'__ENTITY__', '#0088cc',			'chaine', '0',	'Oblyon button action color 1');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_ACTION2',			'__ENTITY__', '#0044cc',			'chaine', '0',	'Oblyon button action color 2');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE1',			'__ENTITY__', '#cc8800',			'chaine', '0',	'Oblyon button delete color 1');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE2',			'__ENTITY__', '#cc4400',			'chaine', '0',	'Oblyon button delete color 2');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_WEATHER_COLOR',		'__ENTITY__', '#bdbdbd',			'chaine', '0',	'Oblyon weather background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_ACTION_COLOR',		'__ENTITY__', '#ab4da1',			'chaine', '0',	'Oblyon action background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_PROJECT_COLOR',		'__ENTITY__', '#6c6a98',			'chaine', '0',	'Oblyon project background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_CUSTOMER_PROPAL_COLOR',   '__ENTITY__', '#49cc29',			'chaine', '0',	'Oblyon customer proposal background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_CUSTOMER_ORDER_COLOR',    '__ENTITY__', '#49cc29',			'chaine', '0',	'Oblyon customer order background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_CUSTOMER_INVOICE_COLOR',  '__ENTITY__', '#49cc29',			'chaine', '0',	'Oblyon customer invoice background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_SUPPLIER_PROPAL_COLOR',   '__ENTITY__', '#599caf',			'chaine', '0',	'Oblyon supplier proposal background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_SUPPLIER_ORDER_COLOR',    '__ENTITY__', '#599caf',			'chaine', '0',	'Oblyon supplier order background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_SUPPLIER_INVOICE_COLOR',  '__ENTITY__', '#599caf',			'chaine', '0',	'Oblyon supplier invoice background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_CONTRAT_COLOR',		'__ENTITY__', '#8c5545',			'chaine', '0',	'Oblyon contract background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_BANK_COLOR',			'__ENTITY__', '#3333cc',			'chaine', '0',	'Oblyon bank background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_ADHERENT_COLOR',		'__ENTITY__', '#79631c',			'chaine', '0',	'Oblyon member background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_EXPENSEREPORT_COLOR',	'__ENTITY__', '#d1d12a',			'chaine', '0',	'Oblyon expense report background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_HOLIDAY_COLOR',		'__ENTITY__', '#e0a01f',			'chaine', '0',	'Oblyon Dashboard holiday background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_TICKET_COLOR',		'__ENTITY__', '#c93e28',			'chaine', '0',	'Oblyon Dashboard ticket background color');

SET FOREIGN_KEY_CHECKS = 1;