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
 * \file		admin/about.php
 * \ingroup		oblyon
 * \brief		About Page < Oblyon Theme Configurator >
 */
	// Dolibarr environment *************************
	require '../config.php';

// Libraries
require_once DOL_DOCUMENT_ROOT . '/core/lib/admin.lib.php';
dol_include_once('/oblyon/core/modules/modOblyon.class.php');
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
$page_name = "ThemeOblyonAboutTitle";
llxHeader('', $langs->trans($page_name));

// Subheader
$linkback = '<a href = "'.DOL_URL_ROOT.'/admin/modules.php?restore_lastsearch_values=1">'.$langs->trans('BackToModuleList').'</a>';
print load_fiche_titre($langs->trans($page_name), $linkback);

// Configuration header
$head = oblyon_admin_prepare_head();

print dol_get_fiche_head($head, 'about', $langs->trans("Module113900Name"), 0, "opendsi@oblyon");

$modClass = new modOblyon($db);
$oblyonVersion = !empty($modClass->getVersion()) ? $modClass->getVersion() : 'NC';

$supportvalue = "/*****"."<br>";
$supportvalue.= " * Module : Oblyon"."<br>";
$supportvalue.= " * Module version : ".$oblyonVersion."<br>";
$supportvalue.= " * Dolibarr version : ".DOL_VERSION."<br>";
$supportvalue.= " * Dolibarr version installation initiale : ".$conf->global->MAIN_VERSION_LAST_INSTALL."<br>";
$supportvalue.= " *****/"."<br><br>";
$supportvalue.= "Description de votre problème :"."<br>";

// print '<div class="div-table-responsive-no-min">';
print '<table class="centpercent">';

//print '<tr class="liste_titre"><td colspan="2">' . $langs->trans("Authors") . '</td>';
//print '</tr>'."\n";

// Easya Solutions
print '<tr>';
print '<form id="ticket" method="POST" target="_blank" action="https://support.easya.solutions/create_ticket.php">';
print '<input name=message type="hidden" value="'.$supportvalue.'" />';
print '<input name=email type="hidden" value="'.$user->email.'" />';
print '<td class="titlefield center"><img alt="Easya Solutions" src="../img/opendsi_dolibarr_preferred_partner.png" /></td>'."\n";
print '<td class="left"><p>'.$langs->trans("OpenDsiAboutDesc1").' <button type="submit" >'.$langs->trans("OpenDsiAboutDesc2").'</button> '.$langs->trans("OpenDsiAboutDesc3").'</p></td>'."\n";
print '</tr>'."\n";

print '</table>'."\n";
// print '</div>';

print '<br>';
print '<br>';
print '<br>';

print '<div class="div-table-responsive-no-min">';
print '<table summary="edit" class="noborder centpercent editmode tableforfield">';

print '<tr class="liste_titre"><td colspan="2">' . $langs->trans("OldAuthors") . '</td>';
print '</tr>';

// Nicolas Rivera
print '<tr><td class="titlefield center"><img alt="Nicolas Rivera" src="../img/object_oblyon.png"></td>';
print '<td><b>Nicolas Rivera</b>&nbsp;-&nbsp;Développeur';
//print '<br>' . $langs->trans("Email") . ' : nrivera.pro@gmail.com<br>';
print '<br>&nbsp;';
print '</td></tr>';

// Mathieu BRUNOT / Monogramm
print '<tr>';
print '<td class="titlefield center"><img alt="Monogramm" width="100px" src="../img/monogramm.png" /></td>'."\n";
print '<td><b>Mathieu Brunot - Monogramm.io</b>&nbsp;-&nbsp;Développeur';
print '</tr>'."\n";

print '</table>'."\n";
print '</div>';

llxFooter();

$db->close();
