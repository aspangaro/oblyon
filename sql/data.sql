--	/************************************************
--	* Copyright (C) 2015-2024	Alexandre Spangaro	<alexandre@inovea-conseil.com>
--	* Copyright (C) 2022-2026	Sylvain Legrand		<contact@infras.fr>
--	*
--	* This program is free software: you can redistribute it and/or modify
--	* it under the terms of the GNU General Public License as published by
--	* the Free Software Foundation, either version 3 of the License, or
--	* (at your option) any later version.
--	*
--	* This program is distributed in the hope that it will be useful,
--	* but WITHOUT ANY WARRANTY; without even the implied warranty of
--	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
--	* GNU General Public License for more details.
--	*
--	* You should have received a copy of the GNU General Public License
--	* along with this program.	If not, see <http://www.gnu.org/licenses/>.
--	************************************************/

--	/************************************************
--	* 	\file		../oblyon/sql/data.sql
--	* 	\ingroup	oblyon
--	* 	\brief		SQL data for module oblyon
--	************************************************/

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';

-- Constantes initiales du module (table llx_const) — « __ENTITY__ » remplacé par l'entité courante à l'exécution (run_sql)
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENU_STANDARD_FORCED',						'__ENTITY__', 'oblyon_menu.php',	'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENUFRONT_STANDARD_FORCED',					'__ENTITY__', 'oblyon_menu.php',	'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENU_SMARTPHONE_FORCED',						'__ENTITY__', 'oblyon_menu.php',	'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENUFRONT_SMARTPHONE_FORCED',				'__ENTITY__', 'oblyon_menu.php',	'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_ENABLE_PERSONALIZED',					'__ENTITY__', '1',					'chaine',	'0',	'Oblyon module');

-- ===== Menus : gestionnaire forcé + comportement (inversé, sticky, réduit, effets) =====
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MENU_INVERT',								'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
-- Menu supérieur (barre du haut)
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_FULLSIZE_TOPBAR',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_SHOW_LOGO',									'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_STICKY_TOPBAR',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_HIDE_TOPICONS',							'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
-- Menu gauche (barre latérale)
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_SHOW_COMPNAME',							'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_STICKY_LEFTBAR',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_HIDE_LEFTMENU',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_EFFECT_LEFTMENU',							'__ENTITY__', 'slide',				'chaine',	'0',	'Oblyon leftmenu effect behavior');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_HIDE_LEFTICONS',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_REDUCE_LEFTMENU',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_EFFECT_REDUCE_LEFTMENU',					'__ENTITY__', 'only',				'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_TOUCH_MENU',								'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
-- InfraS add : disposition mobile (3.5.0), active par defaut
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_MOBILE_LAYOUT',							'__ENTITY__', '1',					'chaine',	'0',	'Oblyon module');
-- InfraS add : preset de couleurs actif (3.6.0) : les valeurs par defaut ci-dessous sont celles du preset "blue" (presets/blue.json)
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_CURRENT_PRESET',							'__ENTITY__', 'blue',				'chaine',	'0',	'Oblyon module');

-- ===== Couleurs : valeurs par défaut = preset « Oblyon Blue » =====
-- Couleurs : menu supérieur (fond, survol, texte)
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_BCKGRD',						'__ENTITY__', '#092D5C',			'chaine',	'0',	'Oblyon background topmenu color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_BCKGRD_HOVER',				'__ENTITY__', '#0D4185',			'chaine',	'0',	'Oblyon background topmenu hover color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_TXT',						'__ENTITY__', '#F4F4F4',			'chaine',	'0',	'Oblyon topmenu text color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_TXT_ACTIVE',					'__ENTITY__', '#',					'chaine',	'0',	'Oblyon text top menu active');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_TXT_HOVER',					'__ENTITY__', '#',					'chaine',	'0',	'Oblyon text top menu hover');
-- Couleurs : menu gauche (fond, survol, texte)
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LEFTMENU_BCKGRD',					'__ENTITY__', '#092D5C',			'chaine',	'0',	'Oblyon background leftmenu color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER',				'__ENTITY__', '#0D4185',			'chaine',	'0',	'Oblyon background leftmenu hover color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LEFTMENU_TXT',						'__ENTITY__', '#F4F4F4',			'chaine',	'0',	'Oblyon foreground leftmenu color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LEFTMENU_TXT_ACTIVE',				'__ENTITY__', '#F4F4F4',			'chaine',	'0',	'Oblyon foreground leftmenu hover color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LEFTMENU_TXT_HOVER',					'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon foreground leftmenu hover color');
-- Couleurs : boutons (action 1/2, suppression 1/2)
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_ACTION2',						'__ENTITY__', '#0044CC',			'chaine',	'0',	'Oblyon button action color 2');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE1',						'__ENTITY__', '#CC8800',			'chaine',	'0',	'Oblyon button delete color 1');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE2',						'__ENTITY__', '#CC4400',			'chaine',	'0',	'Oblyon button delete color 2');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_BORDER',					'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_TXT_HOVER',					'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE_TXT',				'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE_BORDER',				'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE_TXT_HOVER',			'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FORM_BCKGRD',				'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FORM_TXT',					'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FORM_BORDER',				'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FORM_BCKGRD_HOVER',			'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FORM_TXT_HOVER',			'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FLAT_BCKGRD',				'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FLAT_TXT',					'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FLAT_BORDER',				'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FLAT_BCKGRD_HOVER',			'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FLAT_TXT_HOVER',			'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE_FLAT_BCKGRD',		'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE_FLAT_TXT',			'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE_FLAT_BORDER',		'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE_FLAT_BCKGRD_HOVER',	'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_DELETE_FLAT_TXT_HOVER',		'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FORM_FLAT_BCKGRD',			'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FORM_FLAT_TXT',				'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FORM_FLAT_BORDER',			'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FORM_FLAT_BCKGRD_HOVER',	'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BUTTON_FORM_FLAT_TXT_HOVER',		'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Buttons (3.8.0), # = automatic');
-- Couleurs : messages (info / avertissement / erreur / notifications)
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_INFO_BORDER',						'__ENTITY__', '#87CFD2',			'chaine',	'0',	'Oblyon border info message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_INFO_BCKGRD',						'__ENTITY__', '#EFF8FC',			'chaine',	'0',	'Oblyon background info message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_INFO_TEXT',							'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon text info message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_WARNING_BORDER',						'__ENTITY__', '#F2CF87',			'chaine',	'0',	'Oblyon border warning message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_WARNING_BCKGRD',						'__ENTITY__', '#FCF8E3',			'chaine',	'0',	'Oblyon background warning message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_WARNING_TEXT',						'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon text warning message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_ERROR_BORDER',						'__ENTITY__', '#E0796E',			'chaine',	'0',	'Oblyon border error message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_ERROR_BCKGRD',						'__ENTITY__', '#F07B6E',			'chaine',	'0',	'Oblyon background error message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_ERROR_TEXT',							'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon text error message');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_NOTIF_INFO_BCKGRD',					'__ENTITY__', '#446548',			'chaine',	'0',	'Oblyon background info notification');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_NOTIF_INFO_TEXT',					'__ENTITY__', '#D9E5D1',			'chaine',	'0',	'Oblyon text info notification');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_NOTIF_WARNING_BCKGRD',				'__ENTITY__', '#A28918',			'chaine',	'0',	'Oblyon background warning notification');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_NOTIF_WARNING_TEXT',					'__ENTITY__', '#FFF7D1',			'chaine',	'0',	'Oblyon text warning notification');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_NOTIF_ERROR_BCKGRD',					'__ENTITY__', '#A72947',			'chaine',	'0',	'Oblyon background error notification');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_NOTIF_ERROR_TEXT',					'__ENTITY__', '#D79EAC',			'chaine',	'0',	'Oblyon text error notification');
-- Couleurs : général (fond, logo, login, titres, lignes, totaux, dates, onglets, input, infobox, bordures)
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_AUTOCOMPLETE_BCKGRD',				'__ENTITY__', '#0D4185',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_AUTOCOMPLETE_TEXT',					'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_CHIP_BCKGRD',						'__ENTITY__', '#E4E4E4',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_CHIP_TEXT',							'__ENTITY__', '#000000',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_RESULT_BCKGRD',						'__ENTITY__', '#444444',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_RESULT_TEXT',						'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_MAIN',								'__ENTITY__', '#E09430',			'chaine',	'0',	'Oblyon maincolor');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BCKGRD',								'__ENTITY__', '#F4F4F4',			'chaine',	'0',	'Oblyon background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LOGO_BCKGRD',						'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon background logo color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LOGIN_BCKGRD',						'__ENTITY__', '#F4F4F4',			'chaine',	'0',	'Oblyon background login color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BTITLE',								'__ENTITY__', '#E09430',			'chaine',	'0',	'Oblyon background title');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LISTHEAD_FLAT_BCKGRD',				'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Flat list headers (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LISTHEAD_FLAT_TXT',				'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Flat list headers (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LISTHEAD_FLAT_LINE',				'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Flat list headers (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_LISTHEAD_FLAT_SEL',				'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Flat list headers (3.8.0), # = automatic');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_FTITLE',								'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon text title');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_STITLE',								'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon text title');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BLINE',								'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon background line color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_FLINE',								'__ENTITY__', '#444444',			'chaine',	'0',	'Oblyon text line');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BTOTAL',								'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_FTOTAL',								'__ENTITY__', '#444444',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_FLINE_HOVER',						'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon text line color hover');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_FDATE_DEFAULT',						'__ENTITY__', '#FF0000',			'chaine',	'0',	'Oblyon text default date (today) color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_FDATE_SELECTED',						'__ENTITY__', '#FF0000',			'chaine',	'0',	'Oblyon date color selected in the date picker');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TEXTTABACTIVE',						'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon text tab active');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TAB_PILL_BCKGRD',					'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Pill tabs (3.8.0) : background of the active tab, # = tint of the main colour');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TAB_PILL_TXT',						'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Pill tabs (3.8.0) : text of the active tab, # = main colour');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TAB_PILL_BORDER',					'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Pill tabs (3.8.0) : border colour, # = neutral frame');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TAB_UNDER_BAND',					'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Underlined tabs (3.8.0) : band background, # = neutral background');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TAB_UNDER_TXT',						'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Underlined tabs (3.8.0) : text of the active tab, # = main colour');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TAB_UNDER_LINE',					'__ENTITY__', '#',					'chaine',	'0',	'Oblyon module - Underlined tabs (3.8.0) : underline, # = main colour');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_INPUT_BCKGRD',						'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon background imput color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_INPUT_ADD_BCKGRD',					'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BOX_SHADOW',							'__ENTITY__', '#f0f0f0',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_AMOUNT_REMAIN',						'__ENTITY__', '#880000',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_AMOUNT_PAID',						'__ENTITY__', '#008800',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_AMOUNT_UNPAID',						'__ENTITY__', '#550000',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_AMOUNT_TEXT',							'__ENTITY__', '#006666',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_CAL_EVENT_TXT',						'__ENTITY__', '#111111',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_CAL_WEEKEND_BCKGRD',					'__ENTITY__', '#EEEEEE',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_CAL_HOLIDAY_BCKGRD',					'__ENTITY__', '#F4EEDE',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_OVERLAY_BCKGRD',						'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_BCKGRD_SEL',					'__ENTITY__', '#0D4185',			'chaine',	'0',	'Oblyon background selected top menu entry');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TOPMENU_TXT_SEL',						'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon text selected top menu entry');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_STOCK_OK',								'__ENTITY__', '#002000',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_STOCK_LOW',								'__ENTITY__', '#884400',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_STOCK_EXIT',							'__ENTITY__', '#6B5A12',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_ICON_TEXT',								'__ENTITY__', '#555555',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TIMELINE_BCKGRD',						'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TIMELINE_PRIVATE_BCKGRD',				'__ENTITY__', '#FFFBE5',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BADGE_DRAFT',							'__ENTITY__', '#CBD3D3',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BADGE_VALIDATED',						'__ENTITY__', '#BC9526',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BADGE_APPROVED',						'__ENTITY__', '#9C9C26',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BADGE_WAITING',							'__ENTITY__', '#BCA52B',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BADGE_ACTIVE',							'__ENTITY__', '#25A580',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BADGE_CLOSED',							'__ENTITY__', '#CAD2D2',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BADGE_CANCELED',						'__ENTITY__', '#E7F0F0',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BADGE_ERROR',							'__ENTITY__', '#993013',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BADGE_DONE',							'__ENTITY__', '#15A540',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_STATUS_SUCCESS',						'__ENTITY__', '#00a65a',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_STATUS_INFO',						'__ENTITY__', '#00c0ef',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_STATUS_WARNING',						'__ENTITY__', '#f39c12',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_STATUS_DANGER',						'__ENTITY__', '#dd4b39',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_STATUS_PRIMARY',						'__ENTITY__', '#337ab7',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_PROGRESSBAR',						'__ENTITY__', '#3c8dbc',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_TIMELINEITEM',						'__ENTITY__', '#0073b7',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_WEATHER_LEVEL0',						'__ENTITY__', '#cfbf00',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_WEATHER_LEVEL1',						'__ENTITY__', '#bc9526',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_WEATHER_LEVEL2',						'__ENTITY__', '#b16000',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_WEATHER_LEVEL3',						'__ENTITY__', '#b04000',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_WEATHER_LEVEL4',						'__ENTITY__', '#993013',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_INFOBOX_UPDATE',						'__ENTITY__', '#bc9525',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_INFOBOX_BCKGRD1',					'__ENTITY__', '#444444',			'chaine',	'0',	'Oblyon Background color 1 of active kanban cards');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_INFOBOX_BCKGRD2',					'__ENTITY__', '#E4EFE8',			'chaine',	'0',	'Oblyon Background color 2 of active kanban cards');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_COLOR_BORDER_ACTIONCOLUMN',				'__ENTITY__', '#BBBBBB',			'chaine',	'0',	'Oblyon Border color of the "action" column of the tables');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_INVERT_RATIO_FILTER',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon Ratio for invert filter');
-- Couleurs : constantes standard Dolibarr/Eldy (THEME_ELDY_*) surchargées par Oblyon
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TOPBORDER_TITLE1',						'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_BACKTITLE1',							'__ENTITY__', '#E9EAED',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_BACKTABACTIVE',						'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_LINEPAIR1',							'__ENTITY__', '#FBFBFB',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_LINEPAIR2',							'__ENTITY__', '#FBFBFB',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_LINEIMPAIR1',							'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_LINEIMPAIR2',							'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_LINEBREAK',							'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TEXTTITLENOTAB',						'__ENTITY__', '#222222',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TEXTTITLE',							'__ENTITY__', '#28283C',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TOTAL_BACKGROUND_LIKE_HEAD',			'__ENTITY__', '1',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TEXT',									'__ENTITY__', '#000000',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TEXTLINK',								'__ENTITY__', '#1C1C1C',			'chaine',	'0',	'Oblyon module');

INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_BTNACTION',							'__ENTITY__', '#0088CC',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TEXTBTNACTION',						'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_USE_HOVER',							'__ENTITY__', '#F1F1F1',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_USE_CHECKED',							'__ENTITY__', '#F1F1F1',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_BACKBODY',								'__ENTITY__', '#F4F4F4',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_BACKTABCARD1',							'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TOPMENU_BACK1',						'__ENTITY__', '#092D5C',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_VERMENU_BACK1',						'__ENTITY__', '#092D5C',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_TEXTTITLELINK',						'__ENTITY__', '#1C1C1C',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_CUSTOMERBACK',							'__ENTITY__', '#55955D',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_VENDORBACK',							'__ENTITY__', '#599CAF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_USERBACK',								'__ENTITY__', '#79633F',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_PROSPECTBACK',							'__ENTITY__', '#A7C5B0',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_COLORMEMBER',							'__ENTITY__', '#666666',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_COLORNATURE',							'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_MEMBER_COMPANYBACK',					'__ENTITY__', '#E4E4E4',			'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_MEMBER_INDIVIDUALBACK',				'__ENTITY__', '#E4E4E4',			'chaine',	'0',	'Oblyon module');

-- ===== Tableau de bord : activation/désactivation des blocs et infobox =====
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_GLOBAL_WORKBOARD',					'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_GLOBAL_BOXSTATS',					'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_INFOBOX_COLOR_ON_BACKGROUND',				'__ENTITY__', '0',					'chaine',	'0',	'Oblyon dashboard invert color icon');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_METEO',								'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_AGENDA',						'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_PROJECT',						'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_CUSTOMER',						'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_SUPPLIER',						'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_CONTRACT',						'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_BANK',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_ADHERENT',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_EXPENSEREPORT',				'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_HOLIDAY',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_TICKET',						'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_BOM',							'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_SINGLE_WIDTH',					'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');

-- Tableau de bord : couleurs des infobox
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_AGRESSIVENESS_RATIO',						'__ENTITY__', '-50',				'chaine',	'0',	'Oblyon dashboard agressiveness ratio');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_BACKGROUND',						'__ENTITY__', '#FFFFFF',			'chaine',	'0',	'Oblyon infobox background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_WEATHER_COLOR',					'__ENTITY__', '#BDBDBD',			'chaine',	'0',	'Oblyon weather background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_ACTION_COLOR',					'__ENTITY__', '#AB4DA1',			'chaine',	'0',	'Oblyon action background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_PROJECT_COLOR',					'__ENTITY__', '#6C6A98',			'chaine',	'0',	'Oblyon project background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_CUSTOMER_PROPAL_COLOR',			'__ENTITY__', '#49CC29',			'chaine',	'0',	'Oblyon customer proposal background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_CUSTOMER_ORDER_COLOR',			'__ENTITY__', '#49CC29',			'chaine',	'0',	'Oblyon customer order background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_CUSTOMER_INVOICE_COLOR',			'__ENTITY__', '#49CC29',			'chaine',	'0',	'Oblyon customer invoice background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_SUPPLIER_PROPAL_COLOR',			'__ENTITY__', '#599CAF',			'chaine',	'0',	'Oblyon supplier proposal background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_SUPPLIER_ORDER_COLOR',			'__ENTITY__', '#599CAF',			'chaine',	'0',	'Oblyon supplier order background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_SUPPLIER_INVOICE_COLOR',			'__ENTITY__', '#599CAF',			'chaine',	'0',	'Oblyon supplier invoice background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_CONTRAT_COLOR',					'__ENTITY__', '#8C5545',			'chaine',	'0',	'Oblyon contract background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_BANK_COLOR',						'__ENTITY__', '#3333CC',			'chaine',	'0',	'Oblyon bank background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_ADHERENT_COLOR',					'__ENTITY__', '#79631C',			'chaine',	'0',	'Oblyon member background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_EXPENSEREPORT_COLOR',				'__ENTITY__', '#D1D12A',			'chaine',	'0',	'Oblyon expense report background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_HOLIDAY_COLOR',					'__ENTITY__', '#E0A01F',			'chaine',	'0',	'Oblyon Dashboard holiday background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_TICKET_COLOR',					'__ENTITY__', '#C93E28',			'chaine',	'0',	'Oblyon Dashboard ticket background color');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_INFOXBOX_MRP_COLOR',						'__ENTITY__', '#212529',			'chaine',	'0',	'Oblyon Dashboard mrp background color');

-- ===== Options : général (police, taille, images tableaux, version, statuts, dropdowns menu haut) =====
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_FONT_FAMILY',								'__ENTITY__', 'Arial',				'chaine',	'0',	'Oblyon module') ON DUPLICATE KEY UPDATE value = 'Arial';
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_FONT_SIZE',								'__ENTITY__', '14',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_IMAGE_HEIGHT_TABLE',						'__ENTITY__', '24',					'chaine',	'0',	'Oblyon max height for image on tables');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_DISABLE_VERSION',							'__ENTITY__', '1',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_STATUS_USES_IMAGES',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN',				'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_USE_TOP_MENU_BOOKMARK_DROPDOWN',				'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_PADDING_RIGHT_BOTTOM',						'__ENTITY__', '1',					'chaine',	'0',	'Oblyon module');

-- Options : page de connexion
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_LOGIN_RIGHT',								'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');

-- Options : comportement des fiches (bannière de référence fixe au scroll)
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FIX_AREAREF_TABACTION',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');

-- Options : listes (colonne de sélection, en-tête de tableau collant)
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_CHECKBOX_LEFT_COLUMN',						'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FIX_STICKY_HEADER_CARD',							'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module');

-- Options : éditeur CKEditor / sécurité HTML
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FCKEDITOR_ALLOW_ANY_CONTENT',						'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module - Allow to enter any content. However, this will totally disable content filtering which is one of the most important CKEditor features. You can use this to keep all your tags and attributes in the html content');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FCKEDITOR_ENABLE_SCAYT_AUTOSTARTUP',				'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module - Allow to activate the SpellCheckAsYouType (SCAYT) plugins of CKEditor i.e an automatic spell checking');
-- InfraS add : habillage de CKEditor (3.5.0) ; la ligne deja posee par un autre module (ex. dolinfras) est conservee
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FCKEDITOR_SKIN',								'__ENTITY__', 'moono-lisa',			'chaine',	'0',	'Oblyon module - Skin of the CKEditor WYSIWYG editor');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_SECURITY_ALLOW_UNSECURED_LABELS_WITH_HTML',	'__ENTITY__', '0',					'yesno',	'0',	'Oblyon module - Allow HTML tags into products label');

-- ===== Réglages complémentaires (exhaustivité : FIX_*, options listes/fiches, FontAwesome, comportements THEME_*) — ordre alphabétique =====
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('DISABLE_KANBAN_VIEW_IN_LIST',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FIX_ABSOLUTE_BUTTONS_ACTION_CARD',				'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FIX_AREAREF_CARD',								'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FIX_STICKY_COLUMN_FIRST',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FIX_STICKY_COLUMN_LAST',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FIX_STICKY_GRANDTOTAL_BAR',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FIX_STICKY_TABS_CARD',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FIX_STICKY_TOTAL_BAR',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('FIX_TITLE_IN_LIST',								'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_DISABLE_BLOCK_MRP',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_GRANDTOTAL_LIST_SHOW',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MAXTABS_IN_CARD',							'__ENTITY__', '',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_MOTD',										'__ENTITY__', '',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_USE_TOP_MENU_SEARCH_DROPDOWN',				'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('MAIN_VIEW_LINE_NUMBER',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_AGENDA_STYLE',								'__ENTITY__', 'classic',			'chaine',	'0',	'Oblyon module - Style of the native agenda (3.8.0) : classic / modern');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_BADGE_STYLE',								'__ENTITY__', 'pill',				'chaine',	'0',	'Oblyon module - Style of the status badges (3.8.0) : pill / outline / dot');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_BUTTON_FORM_OWN_COLORS',					'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module - Own colours for the form buttons (3.8.0)');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_BUTTON_STYLE',								'__ENTITY__', 'filled',				'chaine',	'0',	'Oblyon module - Style of the action buttons (3.8.0) : filled / outline / soft');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_DENSITY',									'__ENTITY__', 'compact',			'chaine',	'0',	'Oblyon module - Interface density (3.8.0) : compact / normal / comfortable');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_DISABLE_KANBAN_VIEW_IN_LIST',				'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_ENABLE_MENU_BANK_RECONCILIATE',			'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_LOGO_PADDING',								'__ENTITY__', '',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_LOGO_SIZE',								'__ENTITY__', '',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_OVERLAY_LEFTMENU',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_STICKY_COLUMN_FIRST',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_STICKY_COLUMN_LAST',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_TABS_STYLE',								'__ENTITY__', 'boxed',				'chaine',	'0',	'Oblyon module - Style of the card tabs (3.8.0) : boxed / underline / pills');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_LIST_HEADER_STYLE',						'__ENTITY__', 'band',				'chaine',	'0',	'Oblyon module - Style of the list headers (3.8.0) : band / flat');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_MOTION',									'__ENTITY__', 'normal',				'chaine',	'0',	'Oblyon module - Animations (3.8.0) : normal / reduced');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_NOTIFICATION_CENTER',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module - Notification center bell (3.8.0)');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_STATUS_PULSE',								'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module - Pulse of the status of the open card (3.8.0)');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_TAB_PILL_BORDER',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module - Pill tabs (3.8.0) : 1px border');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_TAB_PILL_SHADOW',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module - Pill tabs (3.8.0) : drop shadow');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_TAKEPOS_AUTO_NEW_SALE',						'__ENTITY__', '5',					'chaine',	'0',	'Oblyon module - TakePOS seconds before the automatic new sale after a payment, 0 = never (3.9.0)');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_TAKEPOS_CATEGORY_COLORS',					'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module - TakePOS category colours on the tiles (3.9.0)');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_TAKEPOS_QUICK_DISCOUNTS',					'__ENTITY__', '5,10,20',			'chaine',	'0',	'Oblyon module - TakePOS quick discounts of the payment bar (3.9.0)');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_TAKEPOS_THEME',							'__ENTITY__', 'native',				'chaine',	'0',	'Oblyon module - TakePOS theme (3.9.0) : native / classic / counter / tablet / scanner');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_USER_BLOCK',								'__ENTITY__', 'default',			'chaine',	'0',	'Oblyon module - User block of the top bar (3.8.0) : default / initials / photo');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ADD_BACKGROUND_ON_INPUT',					'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_CUSTOM_CSS',								'__ENTITY__', '',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_BORDER_RADIUS',						'__ENTITY__', '6',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_FONT_SIZE1',							'__ENTITY__', '14',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_SHADOW_ON_SMALL_BOXES',				'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_USEBOLDTITLE',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_USEBORDERONTABLE',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_WITDHOFFSET_FOR_REDUC2',				'__ENTITY__', '',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_ELDY_WITDHOFFSET_FOR_REDUC3',				'__ENTITY__', '',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_FONT_FAMILY',								'__ENTITY__', 'Arial',				'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_MENU_COLORLOGO',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_SATURATE_RATIO',							'__ENTITY__', '1',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_SHOW_BORDER_ON_INPUT',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_STICKY_TOPMENU',							'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('THEME_TOPMENU_DISABLE_IMAGE',						'__ENTITY__', '0',					'chaine',	'0',	'Oblyon module');

-- CSS personnalisé (constante OBLYON_CUSTOM_CSS, saisi par l'utilisateur)
INSERT INTO llx_const (name, entity, value, type, visible, note) VALUES ('OBLYON_CUSTOM_CSS',								'__ENTITY__', '',					'yesno',	'0',	'Oblyon module');

SET FOREIGN_KEY_CHECKS = 1;