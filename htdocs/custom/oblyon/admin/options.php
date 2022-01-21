<?php
/* Copyright (C) 2015-2022  Open-DSI			<support@open-dsi.fr>
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
 */

/**
 * 	\file		admin/options.php
 * 	\ingroup	oblyon
 * 	\brief		Options Page < Oblyon Theme Configurator >
 */

// Dolibarr environment
$res = @include("../../main.inc.php"); // From htdocs directory
if (! $res) {
  $res = @include("../../../main.inc.php"); // From "custom" directory
}

// Libraries
require_once DOL_DOCUMENT_ROOT . '/core/lib/admin.lib.php';
require_once '../lib/oblyon.lib.php';

// Translations
$langs->loadLangs(array("admin","oblyon@oblyon"));

// Access control
if (! $user->admin) accessforbidden();

// Reset cache
$_SESSION['dol_resetcache']=dol_print_date(dol_now(),'dayhourlog');

/*
 * Actions
 */
$mesg="";
$action = GETPOST('action', 'alpha');

// set bloc
if ($action == 'update') {
    $res = dolibarr_set_const($db, 'OBLYON_FONT_SIZE', GETPOST('OBLYON_FONT_SIZE','alphanothml'),'chaine',0,'', $conf->entity);

    if (! $res > 0) $error++;

    if ($error) {
        setEventMessage ( 'Error', 'errors' );
    } else {
        setEventMessage ( $langs->trans ( 'Save' ), 'mesgs' );
    }
}

/*
 * View
 */
llxHeader('', $langs->trans("OblyonOptionsTitle"));

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">'	. $langs->trans("BackToModuleList") . '</a>';
print load_fiche_titre($langs->trans('OblyonOptionsTitle'), $linkback);

// Configuration header
$head = oblyon_admin_prepare_head();

print dol_get_fiche_head($head, 'options', $langs->trans("Module113900Name"), 0, "opendsi@oblyon");

dol_htmloutput_mesg($mesg);

// Setup page goes here
print '<form action="'.$_SERVER["PHP_SELF"].'" method="POST">';
print '<input type="hidden" name="token" value="'.newToken().'" />';
print '<input type="hidden" name="action" value="update">';
print '<input type="hidden" name="page_y" value="">';

clearstatcache();

print '<div class="div-table-responsive-no-min">';
print '<table summary="edit" class="noborder centpercent editmode tableforfield">';

// General
print '<tr class="liste_titre">';
print '<td colspan="2">' . $langs->trans('General') . '</td>';
print '</tr>' . "\n";

// Font size
print '<tr class="oddeven">';
print '<td>'.$langs->trans('OblyonFontSize').'</td>';
print '<td><input type="number" class="minwidth400" id="OBLYON_FONT_SIZE" name="OBLYON_FONT_SIZE" dir="rtl" min="10" max="16" value="'.(!empty($conf->global->OBLYON_FONT_SIZE) ? $conf->global->OBLYON_FONT_SIZE : '14').'"></td>';
print '</tr>';

// Status use images
print '<tr class="oddeven"><td>' . $langs->trans('OblyonDisableVersion') . '</td><td>';
print ajax_constantonoff("OBLYON_DISABLE_VERSION", array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
print '</td>';
print '</tr>';

// Status use images
print '<tr class="oddeven"><td>' . $langs->trans('MainStatusUseImages') . '</td><td>';
print ajax_constantonoff("MAIN_STATUS_USES_IMAGES", array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
print '</td>';
print '</tr>';

// Quickadd dropdown menu
print '<tr class="oddeven"><td>' . $langs->trans('OblyonMainUseQuickAddDropdown') . '</td><td>';
print ajax_constantonoff("MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN", array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
print '</td>';
print '</tr>';

// Login
print '<tr class="liste_titre"><td colspan="2">'.$langs->trans('OblyonLoginTitle').'</td></tr>';

// Login box on the right
print '<tr class="oddeven"><td>' . $langs->trans('LoginRight') . '</td><td>';
print ajax_constantonoff("MAIN_LOGIN_RIGHT", array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
print '</td>';
print '</tr>';

// Card
print '<tr class="liste_titre"><td colspan="2">'.$langs->trans('CardBehavior').'</td></tr>';
// Area ref and tab action fixed
print '<tr class="oddeven"><td>' . $langs->trans('FixAreaRefAndTabAction') . '</td><td>';
print ajax_constantonoff("FIX_AREAREF_TABACTION", array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
print '</td>';
print '</tr>';

print '</table>'."\n";
print '</div>';

print dol_get_fiche_end();

print '<div class="center">';
print '<input class="button button-save reposition" type="submit" name="submit" value="'.$langs->trans("Save").'">';
print '</div>';

print '</form>';
print '<br>';

// End of page
llxFooter();
$db->close();
