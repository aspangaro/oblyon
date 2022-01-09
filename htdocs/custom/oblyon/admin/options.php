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

/*
 * Actions
 */
$mesg="";
$action = GETPOST('action', 'alpha');

// set bloc
if ($action == 'set') {
	$value = GETPOST ( 'value', 'int' );
	$name = GETPOST ( 'name', 'text' );

	if ($value == 1) {
		$res = dolibarr_set_const($db, $name, $value, 'yesno', 0, '', $conf->entity);
		if (! $res > 0) $error ++;
	} else {
		$res = dolibarr_set_const($db, $name, $value, 'yesno', 0, '', $conf->entity);
		if (! $res > 0) $error ++;
	}

	if ($error) {
		setEventMessage ( 'Error', 'errors' );
	} else {
		setEventMessage ( $langs->trans ( 'Save' ), 'mesgs' );
	}
}

/*
 * View
 */
llxHeader('', $langs->trans("OblyonOptionsTitle"),'','','','', '','' );

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">'	. $langs->trans("BackToModuleList") . '</a>';
print load_fiche_titre($langs->trans('OblyonOptionsTitle'), $linkback);

// Configuration header
$head = oblyon_admin_prepare_head();

dol_fiche_head($head, 'options', $langs->trans("Module113900Name"), 0, "oblyon@oblyon");

dol_htmloutput_mesg($mesg);

// Setup page goes here
print '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
print '<input type="hidden" name="token" value="'.newToken().'">';
print '<input type="hidden" name="action" value="update">';

print '<table class="noborder">';

// Parameters
print '<tr class="liste_titre">';
print '<td colspan="2">' . $langs->trans('Parameters') . '</td>';
print '</tr>' . "\n";

print '<tr class="oddeven"><td>' . $langs->trans('MainStatusUseImages') . '</td><td>';
print ajax_constantonoff("MAIN_STATUS_USES_IMAGES", array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
print '</td>';
print '</tr>';

print '<tr class="oddeven"><td>' . $langs->trans('OblyonMainUseQuickAddDropdown') . '</td><td>';
print ajax_constantonoff("MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN", array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
print '</td>';
print '</tr>';

print '</table>'."\n";

dol_fiche_end();

print '<div class="center">';
print '<input type="submit" class="button" value="' . dol_escape_htmltag($langs->trans('Modify')) . '" name="button">';
print '</div>';

print '</form>';
print '<br>';

// End of page
llxFooter();
$db->close();
