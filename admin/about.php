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
$help_url = '';
$page_name = "ThemeOblyonAboutTitle";

llxHeader('', $langs->trans($page_name), $help_url, '', 0, 0, '', '', '', 'mod-oblyon page-admin_support');

// Subheader
$linkback = '<a href = "'.DOL_URL_ROOT.'/admin/modules.php?restore_lastsearch_values=1">'.$langs->trans('BackToModuleList').'</a>';
print load_fiche_titre($langs->trans($page_name), $linkback, 'object_inovea.png@oblyon');

// Configuration header
$head = oblyon_admin_prepare_head();

print dol_get_fiche_head($head, 'about', $langs->trans("Module432573Name"), -1, "info");

$modClass = new modOblyon($db);
$oblyonVersion = !empty($modClass->getVersion()) ? $modClass->getVersion() : 'NC';

$supportvalue = "/*****"."<br>";
$supportvalue.= " * Module : Oblyon"."<br>";
$supportvalue.= " * Module version : ".$oblyonVersion."<br>";
$supportvalue.= " * Dolibarr version : ".DOL_VERSION."<br>";
$supportvalue.= " * Dolibarr version installation initiale : ".getDolGlobalString('MAIN_VERSION_LAST_INSTALL')."<br>";
$supportvalue.= " * Version PHP : ".PHP_VERSION."<br>";
$supportvalue.= " *****/"."<br><br>";
$supportvalue.= "Description de votre problème :"."<br>";

// print '<div class="div-table-responsive-no-min">';
print '<table class="centpercent">';

//print '<tr class="liste_titre"><td colspan="2">' . $langs->trans("Authors") . '</td>';
//print '</tr>'."\n";

// Inovea
print '<tr>';
print '<form id="ticket" method="POST" target="_blank" action="https://erp.inovea-conseil.com/public/ticket/create_ticket.php">';
print '<input name=message type="hidden" value="'.$supportvalue.'" />';
print '<input name=email type="hidden" value="'.$user->email.'" />';
print '<td class="titlefield center"><img alt="Inovea-conseil" src="../img/object_inovea.png" /></td>'."\n";
print '<td class="left"><p>'.$langs->trans("InoveaAboutDesc1").' <button type="submit" >'.$langs->trans("InoveaAboutDesc2").'</button> '.$langs->trans("InoveaAboutDesc3").'</p></td>'."\n";
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
print '<br>&nbsp;';
print '</tr>'."\n";

// Easya Solutions
print '<tr>';
print '<td class="titlefield center"><img alt="Easya Solutions" width="100px" src="../img/easya.png" /></td>'."\n";
print '<td><b>Easya Solutions</b>&nbsp;-&nbsp;Equipes des développeurs';
print '<br>&nbsp;';
print '</tr>'."\n";

print '</table>'."\n";
print '</div>';

llxFooter();

$db->close();
