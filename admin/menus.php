<?php
	/************************************************
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
	* 	\file		../oblyon/admin/menus.php
	* 	\ingroup	oblyon
	* 	\brief		Options Page < Oblyon Theme Configurator >
	************************************************/

	// Dolibarr environment *************************
	require '../config.php';

	// Libraries ************************************
	require_once(DOL_DOCUMENT_ROOT.'/core/class/html.formadmin.class.php');
	require_once(DOL_DOCUMENT_ROOT.'/core/class/html.formother.class.php');
	require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
	require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';
	require_once '../lib/oblyon.lib.php';

	// Translations *********************************
	$langs->loadLangs(array('admin', 'oblyon@oblyon', 'opendsi@oblyon'));

	// Access control *******************************
	if (! $user->admin)				accessforbidden();

	// Actions **************************************
	$action							= GETPOST('action','alpha');
	$result							= '';
	$formother						= new FormOther($db);
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
		$list									= array ('Gen' => array('OBLYON_EFFECT_LEFTMENU', 'OBLYON_EFFECT_REDUCE_LEFTMENU'));
		$confkey								= $reg[1];
		$error									= 0;
		foreach ($list[$confkey] as $constname)	$result	= dolibarr_set_const($db, $constname, GETPOST($constname, 'alpha'), 'chaine', 0, 'Oblyon module', $conf->entity);
	}
	// Retour => message Ok ou Ko
	if ($result == 1)			setEventMessages($langs->trans('SetupSaved'), null, 'mesgs');
	if ($result == -1)			setEventMessages($langs->trans('Error'), null, 'errors');
	$_SESSION['dol_resetcache']	= dol_print_date(dol_now(), 'dayhourlog');	// Reset cache

	// init variables *******************************
	$result						= !empty($conf->global->MAIN_MENU_INVERT) && (!empty($conf->global->OBLYON_SHOW_COMPNAME) || !empty($conf->global->OBLYON_HIDE_LEFTMENU)) ? dolibarr_set_const($db, 'OBLYON_FULLSIZE_TOPBAR', 1, 'chaine', 0, 'Oblyon module', $conf->entity) : '';
	$result						= !empty($conf->global->OBLYON_HIDE_LEFTMENU) && empty($conf->global->OBLYON_EFFECT_LEFTMENU) ? dolibarr_set_const($db, 'OBLYON_EFFECT_LEFTMENU', 'slide', 'chaine', 0, 'Oblyon module', $conf->entity) : '';
	$result						= !empty($conf->global->MAIN_MENU_INVERT) && !empty($conf->global->OBLYON_REDUCE_LEFTMENU) ? dolibarr_set_const($db, 'OBLYON_HIDE_LEFTICONS', 0, 'chaine', 0, 'Oblyon module', $conf->entity) : '';
	$result						= !empty($conf->global->OBLYON_REDUCE_LEFTMENU) && empty($conf->global->OBLYON_EFFECT_REDUCE_LEFTMENU) ? dolibarr_set_const($db, 'OBLYON_EFFECT_REDUCE_LEFTMENU', 'hover', 'chaine', 0, 'Oblyon module', $conf->entity) : '';

	// View *****************************************
	$page_name					= $langs->trans('OblyonMenusTitle');
	llxHeader('', $page_name);
	$linkback					= '<a href = "'.DOL_URL_ROOT.'/admin/modules.php">'.$langs->trans('BackToModuleList').'</a>';
	print load_fiche_titre($page_name, $linkback);

	// Configuration header *************************
	$head						= oblyon_admin_prepare_head();
	print dol_get_fiche_head($head, 'menus', $langs->trans('Module113900Name'), 0, 'opendsi@oblyon');

	// setup page goes here *************************
	// Alert
	if (!defined('MAIN_MODULE_OBLYON') && $conf->theme != 'oblyon')
	  print '	<div class = "bloc_warning centpercent center">'.img_warning().' '.$langs->trans('OblyonErrorMessage').'</div>';
	else
	  print '	<div class = "bloc_success centpercent center">'.$langs->trans('OblyonSuccessMessage').'</div>';
	print '		<script type = "text/javascript">
					$(document).ready(function() {
						$(".action").keyup(function(event) {
							if (event.which === 13)	$("#action").click();
						});
					});
				</script>
				<form action = "'.$_SERVER['PHP_SELF'].'" method = "POST">
				<input type="hidden" name="token" value="'.newToken().'" />
				<input type="hidden" name="action" value="update">
				<input type="hidden" name="page_y" value="">
				<input type="hidden" name="dol_resetcache" value="1">';
	// Sauvegarde / Restauration
	oblyon_print_backup_restore();
	clearstatcache();
	print '			<div class = "div-table-responsive-no-min">
						<table summary = "edit" class = "noborder centpercent editmode tableforfield">';
	$metas						= array('*', '156px', '300px');
	oblyon_print_colgroup($metas);
	$metas						= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'menus');
	oblyon_print_input('MAIN_MENU_INVERT', 'on_off', $langs->trans('InvertMenus'), '', $metas, 2, 1);	// Invert menu
	// Top menu
	oblyon_print_final();
	$metas						= array(array(3), 'TopMenu');
	oblyon_print_liste_titre($metas);
	// Option only if invert menu is on
	if (!empty($conf->global->MAIN_MENU_INVERT)) {
		$metas		= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'menus');
		$warning	= empty($conf->global->OBLYON_FULLSIZE_TOPBAR) ? '<br><span class = "warning">'.$langs->trans('FullsizeTopBarWarning').'</span>' : '';
		oblyon_print_input('OBLYON_FULLSIZE_TOPBAR', 'on_off', $langs->trans('FullsizeTopBar').$warning, '', $metas, 2, 1);	// Fullsize top bar
	}
	$metas		= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'menus');
	oblyon_print_input('MAIN_SHOW_LOGO', 'on_off', $langs->trans('OblyonEnableShowLogo'), '', $metas, 2, 1);	// Show Company Logo
	$warning	= !empty($conf->global->OBLYON_STICKY_TOPBAR) ? '<br><span class = "warning">'.$langs->trans('StickyTopBarWarning').'</span>'.(!empty($conf->global->MAIN_MENU_INVERT) ? '<br><span class = "warning">'.$langs->trans('StickyTopBarInvertedWarning').'</span>' : '') : '';
	$metas		= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'menus');
	oblyon_print_input('OBLYON_STICKY_TOPBAR', 'on_off', $langs->trans('StickyTopBar').$warning, '', $metas, 2, 1);	// Sticky top bar
	$metas		= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'menus');
	oblyon_print_input('OBLYON_HIDE_TOPICONS', 'on_off', $langs->trans('HideTopIcons'), '', $metas, 2, 1);	// Hide top icons
	// Left menu
	$metas		= array(array(3), 'LeftMenu');
	oblyon_print_liste_titre($metas);
	$metas		= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'menus');
	oblyon_print_input('OBLYON_SHOW_COMPNAME', 'on_off', $langs->trans('ShowCompanyName'), '', $metas, 2, 1);	// Show Company name
	$warning	= !empty($conf->global->OBLYON_STICKY_LEFTBAR) ? '<br><span class = "warning">'.$langs->trans('StickyLeftBarWarning').'</span>'.(!empty($conf->global->MAIN_MENU_INVERT) ? '<br><span class = "warning">'.$langs->trans('StickyLeftBarInvertedWarning').'</span>' : '') : '';
	$metas		= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'menus');
	oblyon_print_input('OBLYON_STICKY_LEFTBAR', 'on_off', $langs->trans('StickyLeftBar').$warning,	'', $metas, 2, 1);	// Sticky left bar
	$metas		= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'menus');
	oblyon_print_input('OBLYON_HIDE_LEFTMENU', 'on_off', $langs->trans('HideLeftMenu'), '', $metas, 2, 1);	// Hide left menu
	// Effect open leftmenu
	if (getDolGlobalInt('OBLYON_HIDE_LEFTMENU')) {
		print '				<tr class = "oddeven">
								<td colspan = "2">'.$langs->trans('OpenEffect').'</td>
								<td class = "center">
									<input type = "radio" value = "slide" id = "slide" class = "flat action" name = "OBLYON_EFFECT_LEFTMENU" '.($conf->global->OBLYON_EFFECT_LEFTMENU == "slide" ? ' checked = "checked"' : '').'">&nbsp;<label for = "slide">'.$langs->trans('EffectLeftMenuSlide').'</label>
									<br/>
									<input type = "radio" value = "push" id = "push" class = "flat action" name = "OBLYON_EFFECT_LEFTMENU" '.($conf->global->OBLYON_EFFECT_LEFTMENU == "push" ? ' checked = "checked"' : '').'">&nbsp;<label for = "push">'.$langs->trans('EffectLeftMenuPush').'</label>
								</td>
							</tr>';
	}
	$metas		= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'menus');
	oblyon_print_input('OBLYON_HIDE_LEFTICONS', 'on_off', $langs->trans('HideLeftIcons'), '', $metas, 2, 1);	// Hide left icons
	if (!empty($conf->global->MAIN_MENU_INVERT)) {
		$metas		= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'menus');
		$warning	= !empty($conf->global->OBLYON_REDUCE_LEFTMENU) ? '<br><span class = "warning">'.$langs->trans('MicroMenuLeftBarHideLeftIconsWarning').'</span><br><span class = "warning">'.$langs->trans('MicroMenuLeftBarCompanyNameWarning').'</span>' : '';
		oblyon_print_input('OBLYON_REDUCE_LEFTMENU', 'on_off', $langs->trans('ReduceLeftMenu').$warning, '', $metas, 2, 1);	// Micro left menu
		// Effect hover leftmenu
		if (!empty($conf->global->OBLYON_REDUCE_LEFTMENU)) {
			print '			<tr class = "oddeven">
								<td colspan = "2">'.$langs->trans('OpenEffect').'</td>
								<td class = "center">
									<input type = "radio" value = "hover" id = "hover" class = "flat action" name = "OBLYON_EFFECT_REDUCE_LEFTMENU" '.($conf->global->OBLYON_EFFECT_REDUCE_LEFTMENU == "hover" ? ' checked = "checked"' : '').'">&nbsp;<label for = "slide">'.$langs->trans('EffectMicroMenuHover').'</label>
									<br/>
									<input type = "radio" value = "only" id = "only" class = "flat action" name = "OBLYON_EFFECT_REDUCE_LEFTMENU" '.($conf->global->OBLYON_EFFECT_REDUCE_LEFTMENU == "only" ? ' checked = "checked"' : '').'">&nbsp;<label for = "push">'.$langs->trans('EffectMicroMenuOnly').'</label>
								</td>
							</tr>';
		}
	}
	print '				</table>
					</div>';
	print dol_get_fiche_end();
	oblyon_print_btn_action('Gen');
	print '	</form>
			<br/>';
	// End of page
	llxFooter();
	$db->close();
?>