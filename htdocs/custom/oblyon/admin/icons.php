<?php
/* Copyright (C) 2015-2019  Open-DSI            <support@open-dsi.fr>
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
 * 	\file		admin/icons.php
 * 	\ingroup	oblyon
 * 	\brief		Icons Page < Oblyon Theme Configurator >
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
$langs->load("admin");
$langs->load("oblyon@oblyon");

// Access control
if (! $user->admin) accessforbidden();

/*
 * Actions
 */
$mesg="";
$action = GETPOST('action', 'alpha');

if ($action == 'seticon') {
	$value = GETPOST('value', 'int');
    if ($value == 1) {
        $mesg = "<font class='ok'>".$langs->trans("IconApplied"). ": " . $langs->trans("Icon1") ."</font>";
        dolibarr_set_const($db, "MAIN_FONTAWESOME_ICON_STYLE", 'fas','chaine',0,'',$conf->entity);
        $_SESSION['dol_resetcache']=dol_print_date(dol_now(),'dayhourlog');
    }
    if ($value == 2) {
        $mesg = "<font class='ok'>".$langs->trans("IconApplied"). ": " . $langs->trans("Icon2") ."</font>";
        dolibarr_set_const($db, "MAIN_FONTAWESOME_ICON_STYLE", 'far','chaine',0,'',$conf->entity);
        $_SESSION['dol_resetcache']=dol_print_date(dol_now(),'dayhourlog');
    }
    if ($value == 3) {
        $mesg = "<font class='ok'>".$langs->trans("IconApplied"). ": " . $langs->trans("Icon3") ."</font>";
        dolibarr_set_const($db, "MAIN_FONTAWESOME_ICON_STYLE", 'fal','chaine',0,'',$conf->entity);
        $_SESSION['dol_resetcache']=dol_print_date(dol_now(),'dayhourlog');
    }
    if ($value == 4) {
        $mesg = "<font class='ok'>".$langs->trans("Applied"). ": " . $langs->trans("Icon4") ."</font>";
        dolibarr_set_const($db, "MAIN_FONTAWESOME_ICON_STYLE", 'fat','chaine',0,'',$conf->entity);
        $_SESSION['dol_resetcache']=dol_print_date(dol_now(),'dayhourlog');
    }
    if ($value == 5) {
        $mesg = "<font class='ok'>".$langs->trans("IconApplied"). ": " . $langs->trans("Icon5") ."</font>";
        dolibarr_set_const($db, "MAIN_FONTAWESOME_ICON_STYLE", 'fad','chaine',0,'',$conf->entity);
        $_SESSION['dol_resetcache']=dol_print_date(dol_now(),'dayhourlog');
    }

}

/*
 * View
 */
llxHeader('', $langs->trans("OblyonIconsTitle"));

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">'	. $langs->trans("BackToModuleList") . '</a>';
print load_fiche_titre($langs->trans('OblyonIconsTitle'), $linkback);

// Configuration header
$head = oblyon_admin_prepare_head();

dol_fiche_head($head, 'icons', $langs->trans("Module113900Name"), 0, "opendsi@oblyon");

dol_htmloutput_mesg($mesg);

// Setup page goes here
print '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
print '<input type="hidden" name="token" value="' . $_SESSION['newtoken'] . '">';

print '<table class="noborder centpercent">';
print '<tr class="liste_titre">';
print '<td colspan="5">' . $langs->trans("IconsStyle") . '</td>';
print '</tr>';
print '<tr>';
print '<td align="center"><a title="'.$langs->trans("Icon1").'" href="' . $_SERVER['PHP_SELF'] . '?action=seticon&value=1">';
print img_picto($langs->trans("Icon1"), 'icon1.png@oblyon', "width='50%'");
print '<br>'.$langs->trans("Icon1").'</a></td>';
print '<td align="center"><a title="'.$langs->trans("Icon2").'" href="' . $_SERVER['PHP_SELF'] . '?action=seticon&value=2">';
print img_picto($langs->trans("Icon2"), 'icon2.png@oblyon', "width='50%'");
print '<br>'.$langs->trans("Icon2").'</a></td>';
print '<td align="center"><a title="'.$langs->trans("Icon3").'" href="' . $_SERVER['PHP_SELF'] . '?action=seticon&value=3">';
print img_picto($langs->trans("Icon3"), 'icon3.png@oblyon', "width='50%'");
print '<br>'.$langs->trans("Icon3").'</a></td>';
print '<td align="center"><a title="'.$langs->trans("Icon4").'" href="' . $_SERVER['PHP_SELF'] . '?action=seticon&value=4">';
print img_picto($langs->trans("Icon4"), 'icon4.png@oblyon', "width='50%'");
print '</a></td>';
print '<td align="center"><a title="'.$langs->trans("Icon5").'" href="' . $_SERVER['PHP_SELF'] . '?action=seticon&value=5">';
print img_picto($langs->trans("Icon5"), 'icon5.png@oblyon', "width='50%'");
print '<br>'.$langs->trans("Icon5").'</a></td>';
print '</tr>';
print '</table>';

print dol_get_fiche_end();

print '<br>';

// End of page
llxFooter();
$db->close();
