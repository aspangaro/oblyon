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
	* 	\file		../oblyon/admin/options.php
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
	$langs->loadLangs(array('admin', 'oblyon@oblyon'));

	// Access control *******************************
	if (! $user->admin)				accessforbidden();

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
		$list									= array ('Gen'	=> array('OBLYON_FONT_SIZE', 'OBLYON_IMAGE_HEIGHT_TABLE'));
		$confkey								= $reg[1];
		$error									= 0;
		foreach ($list[$confkey] as $constname)	$result	= dolibarr_set_const($db, $constname, GETPOST($constname, 'alpha'), 'chaine', 0, 'Oblyon module', $conf->entity);
	}
	// Retour => message Ok ou Ko
	if ($result == 1)			setEventMessages($langs->trans('SetupSaved'), null, 'mesgs');
	if ($result == -1)			setEventMessages($langs->trans('Error'), null, 'errors');
	$_SESSION['dol_resetcache']	= dol_print_date(dol_now(), 'dayhourlog');	// Reset cache

	// init variables *******************************

	// View *****************************************
	$page_name					= $langs->trans('OblyonOptionsTitle');
	llxHeader('', $page_name);
	$linkback					= '<a href = "'.DOL_URL_ROOT.'/admin/modules.php">'.$langs->trans('BackToModuleList').'</a>';
	print load_fiche_titre($page_name, $linkback);

	// Configuration header *************************
	$head						= oblyon_admin_prepare_head();
	print dol_get_fiche_head($head, 'options', $langs->trans('Module113900Name'), 0, 'opendsi@oblyon');

	// setup page goes here *************************
	print '	<script type = "text/javascript">
				$(document).ready(function() {
					$(".action").keyup(function(event) {
						if (event.which === 13)	$("#action").click();
					});
				});
			</script>
			<form action = "'.$_SERVER['PHP_SELF'].'" method = "POST">
				<input type = "hidden" name = "token" value = "'.newToken().'" />';
	// Sauvegarde / Restauration
	oblyon_print_backup_restore();
	clearstatcache();
	print '		<div class = "div-table-responsive-no-min">
					<table summary = "edit" class = "noborder centpercent editmode tableforfield">';
	$metas						= array('*', '156px', '300px');
	oblyon_print_colgroup($metas);
	// General
	$metas						= array(array(3), 'General');
	oblyon_print_liste_titre($metas);
	$metas						= array('type' => 'number', 'class' => 'flat quatrevingtpercent right action', 'dir' => 'rtl', 'min' => '10', 'max' => '16');
	oblyon_print_input('OBLYON_FONT_SIZE',						'input', $langs->trans('OblyonFontSize'),					'', $metas, 2, 1);	// Font size
	$metas						= array('type' => 'number', 'class' => 'flat quatrevingtpercent right action', 'dir' => 'rtl', 'min' => '24', 'max' => '128');
	oblyon_print_input('OBLYON_IMAGE_HEIGHT_TABLE',				'input', $langs->trans('OblyonImageHeightTable'),			'', $metas, 2, 1);	// Max height for Image on table list
	$metas						= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('OBLYON_DISABLE_VERSION',					'on_off', $langs->trans('OblyonDisableVersion'),			'', $metas, 2, 1);	// Disable version of Dolibarr
	$metas						= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('MAIN_STATUS_USES_IMAGES',				'on_off', $langs->trans('MainStatusUseImages'),			'', $metas, 2, 1);	// Status use images
	oblyon_print_input('MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN',	'on_off', $langs->trans('OblyonMainUseQuickAddDropdown'),	'', $metas, 2, 1);	// Quickadd dropdown menu
	oblyon_print_input('MAIN_USE_TOP_MENU_BOOKMARK_DROPDOWN',	'on_off', $langs->trans('OblyonMainUseBookmarkDropdown'),	'', $metas, 2, 1);	// Bookmark dropdown menu
	oblyon_print_input('OBLYON_PADDING_RIGHT_BOTTOM',			'on_off', $langs->trans('OblyonPaddingRightBottom'),		'', $metas, 2, 1);	// Add padding on bottom
	// Login
	$metas						= array(array(3), 'OblyonLogin');
	oblyon_print_liste_titre($metas);
	$metas						= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('MAIN_LOGIN_RIGHT',						'on_off', $langs->trans('LoginRight'),						'', $metas, 2, 1);	// Login box on the right
	// Card
	$metas						= array(array(3), 'CardBehavior');
	oblyon_print_liste_titre($metas);
	$metas						= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('FIX_AREAREF_TABACTION',					'on_off', $langs->trans('FixAreaRefAndTabAction'),			'', $metas, 2, 1);	// Sticky area ref & tab action

	$easyaVersion = (float) !empty($conf->global->EASYA_VERSION) ? $conf->global->EASYA_VERSION : '';
	if ($easyaVersion >= "2022.5.2" || (float) DOL_VERSION >= 17.0) {
		oblyon_print_input('FIX_STICKY_HEADER_CARD', 			'on_off', $langs->trans('FixStickyTableHeadersColumns'), 	'', $metas, 2, 1);    // Sticky table headers columns
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
