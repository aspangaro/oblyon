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
	* 	\file		../oblyon/admin/dashboard.php
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

	// init variables *******************************
	$result							= empty($conf->global->THEME_AGRESSIVENESS_RATIO) ? dolibarr_set_const($db, 'THEME_AGRESSIVENESS_RATIO', -50, 'chaine', 0, 'Oblyon module', $conf->entity) : '';
	$listcolor						= array('OBLYON_INFOXBOX_BACKGROUND',               // #ffffff
                                            'OBLYON_INFOXBOX_WEATHER_COLOR',            // #bdbdbd
											'OBLYON_INFOXBOX_ACTION_COLOR',				// #b46080 AGENDA
											'OBLYON_INFOXBOX_PROJECT_COLOR',			// #6c6a98 PROJECT
											'OBLYON_INFOXBOX_CUSTOMER_PROPAL_COLOR',	// #99a17d CUSTOMER PROPOSAL
											'OBLYON_INFOXBOX_CUSTOMER_ORDER_COLOR',	 	// #99a17d CUSTOMER ORDER
											'OBLYON_INFOXBOX_CUSTOMER_INVOICE_COLOR',   // #99a17d CUSTOMER INVOICE
											'OBLYON_INFOXBOX_SUPPLIER_PROPAL_COLOR',	// #599caf SUPPLIER PROPOSAL
											'OBLYON_INFOXBOX_SUPPLIER_ORDER_COLOR',	 	// #599caf SUPPLIER ORDER
											'OBLYON_INFOXBOX_SUPPLIER_INVOICE_COLOR',   // #599caf SUPPLIER INVOICE
											'OBLYON_INFOXBOX_CONTRAT_COLOR',			// #469686 CONTRACT
											'OBLYON_INFOXBOX_BANK_COLOR',				// #c5903e BANK
											'OBLYON_INFOXBOX_ADHERENT_COLOR',			// #79633f MEMBERS
											'OBLYON_INFOXBOX_EXPENSEREPORT_COLOR',		// #79633f EXPENSES
											'OBLYON_INFOXBOX_HOLIDAY_COLOR',			// #755114 HOLIDAYS
											'OBLYON_INFOXBOX_TICKET_COLOR',             // #755114 TICKETS
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
		$list									= array ('Gen'	=> array('THEME_AGRESSIVENESS_RATIO'));
		$confkey								= $reg[1];
		$error									= 0;
		foreach ($list[$confkey] as $constname)	$result	= dolibarr_set_const($db, $constname, GETPOST($constname, 'alpha'),		'chaine', 0, 'Oblyon module', $conf->entity);
		foreach ($listcolor as $constname)		$result	= dolibarr_set_const($db, $constname, '#'.GETPOST($constname, 'alpha'),	'chaine', 0, 'Oblyon module', $conf->entity);
	}
	// Retour => message Ok ou Ko
	if ($result == 1)			setEventMessages($langs->trans('SetupSaved'), null, 'mesgs');
	if ($result == -1)			setEventMessages($langs->trans('Error'), null, 'errors');
	$_SESSION['dol_resetcache']	= dol_print_date(dol_now(), 'dayhourlog');	// Reset cache

	// View *****************************************
	$page_name					= $langs->trans('OblyonDashboardTitle');
	llxHeader('', $page_name, '', '', '', '', array('/oblyon/js/jscolor.js', '/oblyon/js/jquery.ui.touch-punch.min.js'), '');
	$linkback					= '<a href = "'.DOL_URL_ROOT.'/admin/modules.php">'.$langs->trans('BackToModuleList').'</a>';
	print load_fiche_titre($page_name, $linkback);

	// Configuration header *************************
	$head						= oblyon_admin_prepare_head();
	print dol_get_fiche_head($head, 'dashboard', $langs->trans('Module113900Name'), 0, 'opendsi@oblyon');

	// setup page goes here *************************
	print '	<script type = "text/javascript">
				$(document).ready(function() {
					$(".action").keyup(function(event) {
						if (event.which === 13)	$("#action").click();
					});
				});
			</script>
			<form action = "'.$_SERVER['PHP_SELF'].'" method = "POST" enctype = "multipart/form-data">
				<input type = "hidden" name = "token" value = "'.newToken().'" />';
	// Sauvegarde / Restauration
	oblyon_print_backup_restore();
	clearstatcache();
	print '		<div class = "div-table-responsive-no-min">
					<table summary = "edit" class = "noborder centpercent editmode tableforfield as-settings-colors">';
	$metas						= array('*', '156px', '300px');
	oblyon_print_colgroup($metas);
	// Infobox enable
	$metas						= array(array(3), 'OblyonDashboardDisableBlocks');
	oblyon_print_liste_titre($metas);
	$metas						= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'dashboard');
	oblyon_print_input('MAIN_DISABLE_GLOBAL_WORKBOARD',		'on_off', $langs->trans('DashboardDisableGlobal'),		'', $metas, 2, 1);	// Disable all workboard
	oblyon_print_input('MAIN_DISABLE_GLOBAL_BOXSTATS',		'on_off', $langs->trans('DisableGlobalBoxStats'),		'', $metas, 2, 1);	// Disable boxes stats widget
	$metas						= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'dashboard');
	oblyon_print_input('THEME_INFOBOX_COLOR_ON_BACKGROUND',	'on_off', $langs->trans('InfoboxColorOnBackground'),	'', $metas, 2, 1);	// On workboard invert background color with text color
	$easyaVersion = (float) !empty($conf->global->EASYA_VERSION) ? $conf->global->EASYA_VERSION : '';
    if ($easyaVersion >= 2022.5 || (float) DOL_VERSION >= 15.0) {
		if (empty($conf->global->MAIN_DISABLE_GLOBAL_WORKBOARD)) {
			$metas		= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'dashboard');
			oblyon_print_input('MAIN_DISABLE_METEO',				'on_off', $langs->trans('MAIN_DISABLE_METEO'),					'', $metas, 2, 1);	// weather block
			oblyon_print_input('MAIN_DISABLE_BLOCK_AGENDA',			'on_off', $langs->trans('DashboardDisableBlockAgenda'),			'', $metas, 2, 1);	// calendar block
			oblyon_print_input('MAIN_DISABLE_BLOCK_PROJECT',		'on_off', $langs->trans('DashboardDisableBlockProject'),		'', $metas, 2, 1);	// project block
			oblyon_print_input('MAIN_DISABLE_BLOCK_CUSTOMER',		'on_off', $langs->trans('DashboardDisableBlockCustomer'),		'', $metas, 2, 1);	// customers block
			oblyon_print_input('MAIN_DISABLE_BLOCK_SUPPLIER',		'on_off', $langs->trans('DashboardDisableBlockSupplier'),		'', $metas, 2, 1);	// suppliers block
			oblyon_print_input('MAIN_DISABLE_BLOCK_CONTRACT',		'on_off', $langs->trans('DashboardDisableBlockContract'),		'', $metas, 2, 1);	// contract block
			oblyon_print_input('MAIN_DISABLE_BLOCK_BANK',			'on_off', $langs->trans('DashboardDisableBlockBank'),			'', $metas, 2, 1);	// bank block
			oblyon_print_input('MAIN_DISABLE_BLOCK_ADHERENT',		'on_off', $langs->trans('DashboardDisableBlockAdherent'),		'', $metas, 2, 1);	// members block
			oblyon_print_input('MAIN_DISABLE_BLOCK_EXPENSEREPORT',	'on_off', $langs->trans('DashboardDisableBlockExpenseReport'),	'', $metas, 2, 1);	// expenses block
			oblyon_print_input('MAIN_DISABLE_BLOCK_HOLIDAY',		'on_off', $langs->trans('DashboardDisableBlockHoliday'),		'', $metas, 2, 1);	// holidays block
			oblyon_print_input('MAIN_DISABLE_BLOCK_TICKET',			'on_off', $langs->trans('DashboardDisableBlockTicket'),			'', $metas, 2, 1);	// tickets block
		}
	}
  // Set Intensity
	$metas		= array(array(3), 'ColorIntensity');
	oblyon_print_liste_titre($metas);
	$metas	= '	<div class = "range-sliders" id = "range-sliders">
					<span class = "bold">-100</span>
					<input type = "range" class = "range-slider flat soixantepercent action" id = "THEME_AGRESSIVENESS_RATIO" name = "THEME_AGRESSIVENESS_RATIO" min = "-100" max = "100" value = "'.$conf->global->THEME_AGRESSIVENESS_RATIO.'" />
					<input type = "number" class = "input-slider flat" id = "input-intensity" min = "-100" max = "100" value = "'.$conf->global->THEME_AGRESSIVENESS_RATIO.'" />
                    <span class = "bold">+100</span>
					<script src = "../js/range-slider.js"></script>
				</div>';
	oblyon_print_input('', 'range', $langs->trans('ColorIntensityDesc', $conf->global->THEME_AGRESSIVENESS_RATIO), '', $metas, 1, 2);
	// Colors
	$metas		= array(array(3), 'Colors');
	oblyon_print_liste_titre($metas);
	if (count($listcolor) > 0) {
		foreach ($listcolor as $key) {
			$metas	= array('type' => 'text', 'class' => 'flat quatrevingtpercent color action');
			oblyon_print_input($key, 'input', $langs->trans($key), '', $metas, 2, 1);
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