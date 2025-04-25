<?php
/************************************************
* Copyright (C) 2015-2025  Alexandre Spangaro   <alexandre@inovea-conseil.com>
* Copyright (C) 2022-2025  Sylvain Legrand      <contact@infras.fr>
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
dol_include_once('/oblyon/lib/oblyon.lib.php');
dol_include_once('/oblyon/backport/v21/core/lib/functions.lib.php');

/**
 * @var Conf $conf
 * @var DoliDB $db
 * @var HookManager $hookmanager
 * @var Societe $mysoc
 * @var Translate $langs
 * @var User $user
 */

// Translations *********************************
$langs->loadLangs(array('admin', 'oblyon@oblyon', 'inovea@oblyon'));

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
	$list									= array('Gen'   => array('OBLYON_FONT_SIZE', 'OBLYON_IMAGE_HEIGHT_TABLE', 'OBLYON_FONT', 'OBLYON_FONT_FAMILY'),
                                                    'Card'  => array('MAIN_MAXTABS_IN_CARD'));
	$confkey								= $reg[1];
	$error									= 0;
	foreach ($list[$confkey] as $constname)	$result	= dolibarr_set_const($db, $constname, GETPOST($constname, 'alpha'), 'chaine', 0, 'Oblyon module', $conf->entity);
}
// Retour => message Ok ou Ko
if ($result == 1)			setEventMessages($langs->trans('SetupSaved'), null, 'mesgs');
if ($result == -1)			setEventMessages($langs->trans('Error'), null, 'errors');
$_SESSION['dol_resetcache']	= dol_print_date(dol_now(), 'dayhourlog');	// Reset cache

// init variables *******************************
// Liste des polices web standards
$font_options				= array ('Arial' 				=> 'Arial',
									'Arial Black' 			=> 'Arial Black',
									'Arial Narrow' 			=> 'Arial Narrow',
									'Calibri' 				=> 'Calibri',
									'Cambria' 				=> 'Cambria',
									'Candara' 				=> 'Candara',
									'Century Gothic' 		=> 'Century Gothic',
									'Comic Sans MS' 		=> 'Comic Sans MS',
									'Consolas' 				=> 'Consolas',
									'Courier New' 			=> 'Courier New',
									'Copperplate Gothic'	=> 'Copperplate Gothic',
									'Franklin Gothic'		=> 'Franklin Gothic',
									'Georgia' 				=> 'Georgia',
									'Gill Sans'				=> 'Gill Sans',
		    						'Helvetica' 			=> 'Helvetica',
									'Impact' 				=> 'Impact',
									'Lucida Console'		=> 'Lucida Console',
									'Lucida Sans'			=> 'Lucida Sans',
									'Microsoft Sans Serif'	=> 'Microsoft Sans Serif',
									'Open Sans' 			=> 'Open Sans',
									'Palatino Linotype' 	=> 'Palatino Linotype',
									'Sans-serif' 			=> 'Sans-serif',
									'Segoe UI'				=> 'Segoe UI',
									'Tahoma' 				=> 'Tahoma',
									'Times New Roman' 		=> 'Times New Roman',
		    						'Trebuchet MS' 			=> 'Trebuchet MS',
		    						'Verdana' 				=> 'Verdana',
									);
$currentFont				= getDolGlobalString('OBLYON_FONT_FAMILY', 'Arial');

// View *****************************************
$page_name = $langs->trans('OblyonOptionsTitle');
llxHeader('', $page_name);
$linkback = '<a href = "'.DOL_URL_ROOT.'/admin/modules.php?restore_lastsearch_values=1">'.$langs->trans('BackToModuleList').'</a>';
print load_fiche_titre($page_name, $linkback);

// Configuration header *************************
$head = oblyon_admin_prepare_head();
print dol_get_fiche_head($head, 'options', $langs->trans('Module432573Name'), 0, 'inovea@oblyon');

// setup page goes here *************************
$easyaVersion = getDolGlobalFloat('EASYA_VERSION', 0);

$labs_picto = ' '.img_picto($langs->trans('WIP'), 'fa-flask', '', false, 0, 0, '', 'error ');

// accesskey is for Windows or Linux:  ALT + key for chrome, ALT + SHIFT + KEY for firefox
// accesskey is for Mac:               CTRL + key for all browsers
$stringforfirstkey = $langs->trans("KeyboardShortcut");
if ($conf->browser->os === 'macintosh') {
    $stringforfirstkey .= ' CTL +';
} else {
    if ($conf->browser->name == 'chrome') {
        $stringforfirstkey .= ' ALT +';
    } elseif ($conf->browser->name == 'firefox') {
        $stringforfirstkey .= ' ALT + SHIFT +';
    } else {
        $stringforfirstkey .= ' CTL +';
    }
}

print '	<script type = "text/javascript">
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

print '<br>';

// Disclaimer
print '<table class="centpercent noborder">';
print '<tr>';
print '<td class="center">';
print '<h3>';
print img_picto('', 'warning') . ' ' . $langs->trans("ResetCacheDisclaimer");
print '</h3>';
print '</td>';
print '</tr>';
print '</table>';

print '<br>';

print '<div class = "div-table-responsive-no-min">';
/*
print '<table summary = "edit" class = "noborder centpercent editmode tableforfield">';
$metas = array('*', '156px', '300px');
oblyon_print_colgroup($metas);
*/

print '<table class="noborder centpercent">';
print '<tbody>';
print '<tr class="liste_titre">';
//print '<td width="20%">'.$langs->trans("Parameters").'</td>'."\n";
print '<td>'.$langs->trans("OptionsGeneral").'</td>'."\n";
print '<td width="10%" class="center"></td>'."\n";
print '<td width="20%" class="center">'.$langs->trans("Value").'</td>'."\n";
print "</tr>\n";

$countg = 1;

$metas = array('type' => 'number', 'class' => 'flat quatrevingtpercent right action', 'dir' => 'rtl', 'min' => '10', 'max' => '16');
oblyon_print_input('OBLYON_FONT_SIZE', 'input', 'G' . $countg . ' - ' . $langs->trans('OblyonFontSize'), '', $metas, 2, 1);	// Font size
$countg++;

$form = new Form($db);
$metas = $form->selectarray('OBLYON_FONT_FAMILY', $font_options, $currentFont, 0, 0, 0, 'class = "fontsizeinherit nopadding cursorpointer"', 0, 0, 0, '', 'maxwidth200');
oblyon_print_input('OBLYON_FONT_FAMILY', 'select', 'G' . $countg . ' - ' . $langs->trans('OblyonFontFamily'), '', $metas, 2, 1);
$countg++;

$metas = array('type' => 'number', 'class' => 'flat quatrevingtpercent right action', 'dir' => 'rtl', 'min' => '24', 'max' => '128');
oblyon_print_input('OBLYON_IMAGE_HEIGHT_TABLE', 'input', 'G' . $countg . ' - ' . $langs->trans('OblyonImageHeightTable'), '', $metas, 2, 1);	// Max height for Image on table list
$countg++;

$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('OBLYON_DISABLE_VERSION', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonDisableVersion'), '', $metas, 2, 1);	// Disable version of Dolibarr
$countg++;

$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('MAIN_STATUS_USES_IMAGES', 'on_off', 'G' . $countg . ' - ' . $langs->trans('MainStatusUseImages'), '', $metas, 2, 1);	// Status use images
$countg++;

$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonMainUseQuickAddDropdown') . ' (' . $stringforfirstkey . ' a)', '', $metas, 2, 1);	// Quickadd dropdown menu
$countg++;

$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('MAIN_USE_TOP_MENU_SEARCH_DROPDOWN', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonMainUseSearchDropdown') . ' (' . $stringforfirstkey . ' s)', '', $metas, 2, 1);	// Search dropdown menu
$countg++;

if (isModEnabled('bookmark')) {
	$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('MAIN_USE_TOP_MENU_BOOKMARK_DROPDOWN', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonMainUseBookmarkDropdown'), '', $metas, 2, 1);    // Bookmark dropdown menu
    $countg++;
}

$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('OBLYON_PADDING_RIGHT_BOTTOM', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonPaddingRightBottom'), '', $metas, 2, 1);	// Add padding on bottom
$countg++;

/* Login
$metas	= array(array(3), 'OblyonLogin');
oblyon_print_liste_titre($metas);
$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('MAIN_LOGIN_RIGHT', 'on_off', $langs->trans('LoginRight'), '', $metas, 2, 1);	// Login box on the right
*/

print '</tbody>';
print '</table>';
print '<br>';

oblyon_print_btn_action('Gen');

print '<br>';
print '<table class="noborder centpercent">';
print '<tbody>';
print '<tr class="liste_titre">';
//print '<td width="20%">'.$langs->trans("Parameters").'</td>'."\n";
print '<td>'.$langs->trans("OptionsList").'</td>'."\n";
print '<td width="10%" class="center"></td>'."\n";
print '<td width="20%" class="center">'.$langs->trans("Value").'</td>'."\n";
print "</tr>\n";

$countl = 1;

if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 18.0) {
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('MAIN_CHECKBOX_LEFT_COLUMN', 'on_off', 'L' . $countl . ' - ' . $langs->trans('SwitchColunmOnLeft'), '', $metas, 2, 1);    // Sticky table headers columns
    $countleftcheckbox = $countl;
    $countl++;
}
if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 18.0) {
    // Sticky title, pagination and "Add" element in list - FIX_TITLE_IN_LIST
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_TITLE_IN_LIST', 'on_off', 'L' . $countl . ' - ' . $langs->trans('FixTitleInList'), '', $metas, 2, 1);    // Sticky table headers columns
    $countleftcheckbox = $countl;
    $countl++;
}
if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 19.0) {
    // Old Compatibility
    if (getDolGlobalString('OBLYON_DISABLE_KANBAN_VIEW_IN_LIST')) {
        getDolGlobalString('DISABLE_KANBAN_VIEW_IN_LIST') == 1;
    }

    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('DISABLE_KANBAN_VIEW_IN_LIST', 'on_off', 'L' . $countl . ' - ' . $langs->trans('RemoveKanbanViewInList'), '', $metas, 2, 1);    // Remove button kanban view in list
    $countl++;
}
if ($easyaVersion >= "2022.5.2" || (float) DOL_VERSION >= 17.0) {
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_STICKY_HEADER_CARD', 'on_off', 'L' . $countl . ' - ' . $langs->trans('FixStickyTableHeadersColumns'), '', $metas, 2, 1);    // Sticky table headers columns
    $countl++;
}
if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 17.0) {
    // Old Compatibility
    if (getDolGlobalString('OBLYON_STICKY_COLUMN_FIRST')) {
        getDolGlobalString('FIX_STICKY_COLUMN_FIRST') == 1;
    }

    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_STICKY_COLUMN_FIRST', 'on_off', 'L' . $countl . ' - ' . $langs->trans('FixStickyFirstColumn'), '', $metas, 2, 1);    // Sticky table first column
    $countl++;
}
if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 17.0) {
    // Old Compatibility
    if (getDolGlobalString('OBLYON_STICKY_COLUMN_LAST')) {
        getDolGlobalString('FIX_STICKY_COLUMN_LAST') == 1;
    }

    $msgleftcheckbox = !empty($countleftcheckbox) ? ' (<i>'.$langs->trans("WarningActivationOption1Enabled", 'L'.$countleftcheckbox).'</i>)' : '';
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_STICKY_COLUMN_LAST', 'on_off', 'L' . $countl . ' - ' . $langs->trans('FixStickyLastColumn') . $msgleftcheckbox, '', $metas, 2, 1);    // Sticky table last column
    $countl++;
}
if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 16.0) {
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_STICKY_TOTAL_BAR', 'on_off', 'L' . $countl . ' - ' . $langs->trans('FixStickyTotalBar'), '', $metas, 2, 1);    // Sticky table last column
    $countl++;
}
if ($easyaVersion >= "2026.0.0" || (float) DOL_VERSION >= 20.0) {
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('MAIN_GRANDTOTAL_LIST_SHOW', 'on_off', 'L' . $countl . ' - ' . $langs->trans('ShowGrandTotalList'). ' (<i>'. $langs->trans("NotAvailableOnAllLists") . '</i>) ' . $labs_picto, '', $metas, 2, 1);    // Sticky table last column
    $countl++;
}
if (getDolGlobalString('MAIN_GRANDTOTAL_LIST_SHOW')) {
    if ($easyaVersion >= "2026.0.0" || (float)DOL_VERSION >= 20.0) {
        $metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
        oblyon_print_input('FIX_STICKY_GRANDTOTAL_BAR', 'on_off', 'L' . $countl . ' - ' . $langs->trans('FixStickyGrandTotalBar') . $labs_picto, '', $metas, 2, 1);    // Sticky table last column
        $countl++;
    }
}
print '</tbody>';
print '</table>';
print '<br>';

print '<table class="noborder centpercent">';
print '<tbody>';
print '<tr class="liste_titre">';
//print '<td width="20%">'.$langs->trans("Parameters").'</td>'."\n";
print '<td>'.$langs->trans("OptionsCard").'</td>'."\n";
print '<td width="10%" class="center"></td>'."\n";
print '<td width="20%" class="center">'.$langs->trans("Value").'</td>'."\n";
print "</tr>\n";

$countc = 1;

if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 17.0) {
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_STICKY_TABS_CARD', 'on_off', 'C' . $countc . ' - ' . $langs->trans('FixStickyTabsCard'), '', $metas, 2, 1);    // Sticky table headers columns
    $countc++;
}

if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 17.0) {
    // Old Compatibility
    if (getDolGlobalString('FIX_AREAREF_TABACTION')) {
        getDolGlobalString('FIX_AREAREF_CARD') == 1;
    }

    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_AREAREF_CARD', 'on_off', 'C' . $countc . ' - ' . $langs->trans('FixAreaRefCard'), '', $metas, 2, 1);    // Sticky table headers columns
    $countc++;
}

if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 17.0) {
    $txt = getDolGlobalString('FIX_AREAREF_CARD') && getDolGlobalString('FIX_STICKY_TABS_CARD') ? ' '.$langs->trans('LimitTabLineToOne') : '';
    $metas = array('type' => 'number', 'class' => 'flat quatrevingtpercent right action', 'dir' => 'rtl', 'min' => '8', 'max' => '50');
    oblyon_print_input('MAIN_MAXTABS_IN_CARD', 'input', 'C' . $countc . ' - ' . $langs->trans('MainMaxTabsInCard').$txt, '', $metas, 2, 1);	// Max tabs in card
    $countc++;
}

if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 14.0) {
    // Old Compatibility
    if (getDolGlobalString('FIX_AREAREF_TABACTION')) {
        getDolGlobalString('FIX_ABSOLUTE_BUTTONS_ACTION_CARD') == 1;
    }

    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_ABSOLUTE_BUTTONS_ACTION_CARD', 'on_off', 'C' . $countc . ' - ' . $langs->trans('FixAbsoluteButtonsActionCard'), '', $metas, 2, 1);    // Sticky table headers columns
    $countc++;
}

if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 18.0) {
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('MAIN_VIEW_LINE_NUMBER', 'on_off', 'C' . $countc . ' - ' . $langs->trans('ShowLineNumberCard'), '', $metas, 2, 1);    // Sticky table headers columns
    $countc++;
}

print '</tbody>';
print '</table>';
print '<br>';

oblyon_print_btn_action('Card');

print '<br>';
print '</div>';

print dol_get_fiche_end();

print '</form>';

llxFooter();
$db->close();
