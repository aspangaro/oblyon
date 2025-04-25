<?php
/* Copyright (C) 2015       Nicolas Rivera      <nrivera.pro@gmail.com>
 * Copyright (C) 2015-2024  Alexandre Spangaro  <alexandre@inovea-conseil.com>
 * Copyright (C) 2023-2025  Sylvain Legrand		<contact@infras.fr>
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
dol_include_once('/oblyon/lib/inovea_common.lib.php');

/**
 * @var Conf $conf
 * @var DoliDB $db
 * @var HookManager $hookmanager
 * @var Societe $mysoc
 * @var Translate $langs
 * @var User $user
 */

// Langs
$langs->loadLangs(array('admin','oblyon@oblyon', 'inovea@oblyon', 'oldauthors@oblyon'));

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
$help_url = '';
llxHeader('', $langs->trans($page_name), $help_url, '', 0, 0, '', '', '', 'mod-oblyon page-admin_changelog');

// Subheader
$linkback = '<a href = "'.DOL_URL_ROOT.'/admin/modules.php?restore_lastsearch_values=1">'.$langs->trans('BackToModuleList').'</a>';
print load_fiche_titre($langs->trans($page_name), $linkback, 'object_inovea.png@oblyon');

// Configuration header
$head = oblyon_admin_prepare_head();

print dol_get_fiche_head($head, 'changelog', $langs->trans("Module432573Name"), -1, "info");

print '<div class="div-table-responsive-no-min">';
print '<table summary="edit" class="noborder centpercent editmode tableforfield">';

print '<h2>Licence</h2>';
print $langs->trans("LicenseMessage");

$changelog = inovea_common_getChangeLog('oblyon');

print '<div class="moduledesclong">'."\n";
print (!empty($changelog) ? $changelog : $langs->trans("NotAvailable"));
print '<div>'."\n";

llxFooter();

$db->close();
