<?php
/* Copyright (C) 2015       Nicolas Rivera      <nrivera.pro@gmail.com>
 * Copyright (C) 2015-2023  Open-DSI            <support@open-dsi.fr>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * \file		admin/changelog.php
 * \ingroup		oblyon
 * \brief		Changelog Page < Oblyon Theme Configurator >
 */
	// Dolibarr environment *************************
	require '../config.php';

// Libraries
require_once DOL_DOCUMENT_ROOT . '/core/lib/admin.lib.php';
dol_include_once('/oblyon/lib/oblyon.lib.php');
dol_include_once('/oblyon/lib/opendsi_common.lib.php');

// Langs
$langs->loadLangs(array('oblyon@oblyon', 'opendsi@oblyon', 'monogramm@oblyon'));

// Access control
if (! $user->admin)
  accessforbidden();

// Parameters
$action = GETPOST('action', 'alpha');

/*
 * Actions
 */

/*
 * View
 */
$page_name = "ThemeOblyonChangelogTitle";
llxHeader('', $langs->trans($page_name));

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">' . $langs->trans("BackToModuleList") . '</a>';
print load_fiche_titre($langs->trans($page_name), $linkback);

// Configuration header
$head = oblyon_admin_prepare_head();

print dol_get_fiche_head($head, 'changelog', $langs->trans("Module113900Name"), 0, "opendsi@oblyon");

print '<div class="div-table-responsive-no-min">';
print '<table summary="edit" class="noborder centpercent editmode tableforfield">';

print '<h2>Licence</h2>';
print $langs->trans("LicenseMessage");
print '<h2>Bugs / comments</h2>';
print $langs->trans("AboutMessage");

$changelog = opendsi_common_getChangeLog('oblyon');

print '<div class="moduledesclong">'."\n";
print (!empty($changelog) ? $changelog : $langs->trans("NotAvailable"));
print '<div>'."\n";

llxFooter();

$db->close();
