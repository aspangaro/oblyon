<?php
 /************************************************
 * Copyright (C) 2001-2005 Rodolphe Quiedeville <rodolphe@quiedeville.org>
 * Copyright (C) 2004-2015 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) 2005-2012 Regis Houssin        <regis.houssin@inodbox.com>
 * Copyright (C) 2015      Jean-François Ferry	<jfefe@aternatik.fr>
 * Copyright (C) 2022	   Paul Lepont          <paul@kawagency.fr>
 * Copyright (C) 2022-2023 Alexandre Spangaro   <aspangaro@open-dsi.fr>
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
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 ************************************************/

/************************************************
 * 	\file		../oblyon/admin/customcss.php
 * 	\ingroup	oblyon
 * 	\brief		Custom CSS Page < Custom CSS Configurator >
 ************************************************/

// Dolibarr environment *************************
require '../config.php';

// Libraries ************************************
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/doleditor.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
require_once '../lib/oblyon.lib.php';

// Translations *********************************
$langs->loadLangs(array('admin', 'oblyon@oblyon', 'opendsi@oblyon'));

// Access control *******************************
if (!$user->admin) {
	accessforbidden();
}

// Actions **************************************
$action                         = GETPOST('action', 'aZ09');
$result							= '';

// Sauvegarde / Restauration
if ($action == 'bkupParams')	$result	= oblyon_bkup_module ('oblyon');
if ($action == 'restoreParams')	$result	= oblyon_restore_module ('oblyon');

if($action == 'update')         $result = dolibarr_set_const($db, "OBLYON_CUSTOM_CSS", GETPOST('OBLYON_CUSTOM_CSS', 'restricthtml'), 'chaine', 0, '', $conf->entity);

// Retour => message Ok ou Ko
if ($result == 1)			setEventMessages($langs->trans('SetupSaved'), null, 'mesgs');
if ($result == -1)			setEventMessages($langs->trans('Error'), null, 'errors');
$_SESSION['dol_resetcache']	= dol_print_date(dol_now(), 'dayhourlog');	// Reset cache

// View *****************************************
$page_name					= $langs->trans('OblyonCustomCSSTitle');

llxHeader('', $page_name, '', '', 0, 0,
    array(
        '/includes/ace/src/ace.js',
        '/includes/ace/src/ext-statusbar.js',
        '/includes/ace/src/ext-language_tools.js',
    ), array());
$linkback					= '<a href = "'.DOL_URL_ROOT.'/admin/modules.php">'.$langs->trans('BackToModuleList').'</a>';
print load_fiche_titre($page_name, $linkback);

// Configuration header *************************
$head						= oblyon_admin_prepare_head();
print dol_get_fiche_head($head, 'customcss', $langs->trans('Module113900Name'), 0, 'opendsi@oblyon');

$form = new Form($db);
$formfile = new FormFile($db);

// setup page goes here *************************
print '<form enctype="multipart/form-data" method="POST" action="'.$_SERVER["PHP_SELF"].'">';
print '<input type="hidden" name="token" value="'.newToken().'">';
print '<input type="hidden" name="action" value="update">';
print '<input type="hidden" name="page_y" value="">';
print '<input type="hidden" name="dol_resetcache" value="1">';

// Sauvegarde / Restauration
oblyon_print_backup_restore();
clearstatcache();

print '<span class="opacitymedium">'.$langs->trans("DisplayDesc")."</span><br>\n";
print "<br>\n";

//print $form->textwithpicto($langs->trans("AddCustomCssSentence"), "", 1, 'help', '', 0, 2, 'tooltipmessageofday');

print '<div class="div-table-responsive-no-min">';
print '<table summary="edit" class="noborder centpercent editmode tableforfield">';

print '<tr class="liste_titre">';
print '<td colspan="2">';

$customcssValue = getDolGlobalString('OBLYON_CUSTOM_CSS');

$doleditor = new DolEditor('OBLYON_CUSTOM_CSS', $customcssValue, '', '80%', 'Basic', 'In', true, false, 'ace',10,'90%');
$doleditor->Create(0,'',true,'css','css');
print '</td></tr>'."\n";

print '</table>'."\n";
print '</div>';

print '<div class="center">';
print '<input class="button button-save reposition buttonforacesave" type="submit" name="submit" value="' . $langs->trans("Save") . '">';
print '</div>';

print '</form>';
print '<br/>';
// End of page
llxFooter();
$db->close();
