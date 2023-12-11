<?php
	/************************************************
	* Copyright (C) 2015-2023  Alexandre Spangaro   <support@open-dsi.fr>
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
	* along with this program.  If not, see <https://www.gnu.org/licenses/>.
	************************************************/

	/************************************************
	* 	\file		../oblyon/admin/icons.php
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
	if (! $user->admin)				accessforbidden();

	// init variables *******************************
	$list							= array ('fas'	=> '900', 'far'	=> '400', 'fal'	=> '300', 'fat'	=> '100', 'fad'	=> '900');

	// Actions **************************************
	$action							= GETPOST('action','alpha');
	$result							= '';
	// Sauvegarde / Restauration
	if ($action == 'bkupParams')	$result	= oblyon_bkup_module ('oblyon');
	if ($action == 'restoreParams')	$result	= oblyon_restore_module ('oblyon');
	// links management
	if (preg_match('/set_(.*)/', $action, $reg)) {
		$confkey	= $reg[1];
		$result		= dolibarr_set_const($db, 'MAIN_FONTAWESOME_ICON_STYLE', $confkey, 'chaine', 0, 'Oblyon module', $conf->entity);
		$result		= dolibarr_set_const($db, 'MAIN_FONTAWESOME_WEIGHT', $list[$confkey], 'chaine', 0, 'Oblyon module', $conf->entity);
	}
	// Retour => message Ok ou Ko
	if ($result == 1)						setEventMessages($langs->trans('IconApplied').' : '.$langs->trans('Icon'.$confkey), null, 'mesgs');
	if ($result == -1)						setEventMessages($langs->trans('Error'), null, 'errors');
	$_SESSION['dol_resetcache']				= dol_print_date(dol_now(), 'dayhourlog');	// Reset cache

	// View *****************************************
	$page_name								= $langs->trans('OblyonIconsTitle');
	llxHeader('', $page_name);
	$linkback								= '<a href = "'.DOL_URL_ROOT.'/admin/modules.php">'.$langs->trans('BackToModuleList').'</a>';
	print load_fiche_titre($page_name, $linkback);

	// Configuration header *************************
	$head									= oblyon_admin_prepare_head();
	print dol_get_fiche_head($head, 'icons', $langs->trans('Module113900Name'), 0, 'opendsi@oblyon');

	// setup page goes here *************************
	print '	<form action = "'.$_SERVER['PHP_SELF'].'" method = "POST">
				<input type = "hidden" name = "token" value = "'.newToken().'" />';
	// Sauvegarde / Restauration
	oblyon_print_backup_restore();
	clearstatcache();
	print '		<div class = "div-table-responsive-no-min">
					<table summary = "edit" class = "noborder centpercent editmode tableforfield">';
	$larg									= !empty($list) && count($list) > 0 ? 100 / count($list) : 100;
	$metas									= array();
	for ($i = 0; $i < count($list); $i++)	$metas[]	= $larg.'%';
	oblyon_print_colgroup($metas);
	$metas									= array(array(count($list)), 'IconsStyle');
	oblyon_print_liste_titre($metas);
	print '				<tr>';
	foreach ($list as $name => $weight)
		print '				<td class = "center">
								<a title = "'.$langs->trans('Icon'.$name).'" href = "'.$_SERVER['PHP_SELF'].'?token='.newToken().'&action=set_'.$name.'">'.img_picto($langs->trans('Icon'.$name), 'icon'.$name.'.png@oblyon', 'width = "50%"').'
									<br/>'.$langs->trans('Icon'.$name).'
								</a>
							</td>';
	print '				</tr>
					</table>
				</div>';
	print dol_get_fiche_end();
	print '	</form>
			<br/>';
	// End of page
	llxFooter();
	$db->close();
?>