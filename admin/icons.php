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
* along with this program.  If not, see <https://www.gnu.org/licenses/>.
************************************************/

/**
 * 	\file		../oblyon/admin/icons.php
 * 	\ingroup	oblyon
 * 	\brief		Options Page < Oblyon Theme Configurator >
 */

require '../config.php';

// Libraries
require_once DOL_DOCUMENT_ROOT . '/core/lib/admin.lib.php';
require_once DOL_DOCUMENT_ROOT . '/core/lib/files.lib.php';
require_once '../lib/oblyon.lib.php';

/**
 * @var Conf $conf
 * @var DoliDB $db
 * @var HookManager $hookmanager
 * @var Societe $mysoc
 * @var Translate $langs
 * @var User $user
 */

// Translations
$langs->loadLangs(array('admin', 'oblyon@oblyon', 'inovea@oblyon'));

// Access control *******************************
if (! $user->admin)				accessforbidden();

// init variables
$style_weights = array(
    'fas' => '900',
    'far' => '400',
    'fal' => '300',
    'fat' => '100',
    'fad' => '900'
);

// Actions
$backtopage = GETPOST('backtopage', 'alpha');
$action = GETPOST('action','alpha');
$result	= '';

// Sauvegarde / Restauration
if ($action == 'bkupParams') {
    $result	= oblyon_bkup_module ('oblyon');
}
if ($action == 'restoreParams') {
    $result	= oblyon_restore_module ('oblyon');
}

if (GETPOST('select_fa', 'alpha')) {
    $selected_dir = GETPOST('selected_version', 'alpha');
    $selected_family = GETPOST('selected_family_' . $selected_dir, 'alpha');
    $selected_style = GETPOST('selected_style_' . $selected_dir, 'alpha');

    if ($selected_dir && $selected_family && $selected_style) {
        $full_dir_path = '/theme/common/' . $selected_dir;
        $weight = $style_weights[$selected_style] ?? '900';

        dolibarr_set_const($db, 'MAIN_FONTAWESOME_DIRECTORY', $full_dir_path, 'chaine', 0, '', $conf->entity);
        dolibarr_set_const($db, 'MAIN_FONTAWESOME_FAMILY', $selected_family, 'chaine', 0, '', $conf->entity);
        dolibarr_set_const($db, 'MAIN_FONTAWESOME_ICON_STYLE', $selected_style, 'chaine', 0, '', $conf->entity);
        dolibarr_set_const($db, 'MAIN_FONTAWESOME_WEIGHT', $weight, 'chaine', 0, '', $conf->entity);

        setEventMessages($langs->trans("FontAwesomeSuccessMessage", $selected_family, $selected_style, $weight, $full_dir_path), null, 'mesgs');
        $_SESSION['dol_resetcache']	= dol_print_date(dol_now(), 'dayhourlog');	// Reset cache
    }
}

/*
 * View
 */
$help_url = '';
$title = $langs->trans("OblyonSetupIcons");

llxHeader('', $title, $help_url, '', 0, 0, '', '', 'mod-oblyon page-admin-icons');

// Lecture des dossiers
$theme_dir = DOL_DOCUMENT_ROOT.'/theme/common/';
$fa_dirs = [];

if (is_dir($theme_dir)) {
    foreach (scandir($theme_dir) as $entry) {
        if (preg_match('/^fontawesome-(.+)$/', $entry) && is_dir($theme_dir . $entry)) {
            $version = 'Unknown';
            $family = 'Font Awesome 5 Free'; // par défaut
            $css_path = $theme_dir . $entry . '/css/all.css';
            if (file_exists($css_path)) {
                $css = file_get_contents($css_path);
                if (preg_match('/Font Awesome (Free|Pro) ([\d\.]+)/', $css, $ver_match)) {
                    $family = 'Font Awesome ' . intval($ver_match[2]) . ' ' . $ver_match[1];
                    $version = $ver_match[2];
                }
            }

            $fa_dirs[] = array(
                'dir' => $entry,
                'version' => $version,
                'family' => $family
            );
        }
    }
}

$current_dir = $conf->global->MAIN_FONTAWESOME_DIRECTORY ?? '/theme/common/fontawesome-5';
$current_style = $conf->global->MAIN_FONTAWESOME_ICON_STYLE ?? 'fas';
$current_family = $conf->global->MAIN_FONTAWESOME_FAMILY ?? 'Font Awesome 5 Free';

// Subheader
$linkback = '<a href = "'.DOL_URL_ROOT.'/admin/modules.php?restore_lastsearch_values=1">'.$langs->trans('BackToModuleList').'</a>';
print load_fiche_titre($title, $linkback, 'object_inovea.png@oblyon');

$head = oblyon_admin_prepare_head();
print dol_get_fiche_head($head, 'icons', $title, -1);

print '<form action = "'.dol_escape_htmltag($_SERVER['PHP_SELF']).'" method = "POST">';
print '<input type="hidden" name="token" value="'.newToken().'" />';
print '<input type="hidden" name="select_fa" value="1">';
print '<input type="hidden" name="page_y" value="">';

// Sauvegarde / Restauration
oblyon_print_backup_restore();
clearstatcache();

print '</br>';
print $langs->trans("FontAwesomeSelectPack");
print '</br></br>';

print '<div class = "div-table-responsive-no-min">';
print '<table class="noborder centpercent">';
print '<tr class="liste_titre">';
print '<th>' . $langs->trans("FontAwesomeAction") . '</th>';
print '<th>' . $langs->trans("FontAwesomeFolder") . '</th>';
print '<th>' . $langs->trans("FontAwesomeVersion") . '</th>';
print '<th>' . $langs->trans("FontAwesomeLicence") . '</th>';
print '<th>' . $langs->trans("FontAwesomeAvailableStyles") . '</th>';
print '</tr>';

foreach ($fa_dirs as $fa) {
    $dir = $fa['dir'];
    $full_path = '/theme/common/' . $dir;
    $selected = ($full_path === $current_dir) ? 'checked' : '';
    $is_pro = (strpos($fa['family'], 'Pro') !== false);
    $styles = $is_pro ? ['fas', 'far', 'fal', 'fat', 'fad'] : ['fas'];

    print '<tr>';
    print '<td><input type="radio" name="selected_version" value="' . dol_escape_htmltag($dir) . '" ' . $selected . '></td>';
    print '<td>' . dol_escape_htmltag($dir) . '</td>';
    print '<td>' . dol_escape_htmltag($fa['version']) . '</td>';
    print '<td>';
    print '<input type="hidden" name="selected_family_' . $dir . '" value="' . dol_escape_htmltag($fa['family']) . '">';
    print dol_escape_htmltag($fa['family']);
    print '</td>';
    print '<td>';
    print '<select name="selected_style_' . $dir . '">';
    $style_labels = array(
        'fas' => 'Solid',
        'far' => 'Regular',
        'fal' => 'Light',
        'fat' => 'Thin',
        'fad' => 'Duotone'
    );

    foreach ($styles as $style) {
        $sel = ($style === $current_style && $selected) ? 'selected' : '';
        $label = $style_labels[$style] ?? $style;
        print '<option value="' . $style . '" ' . $sel . '>' . $label . '</option>';
    }
    print '</select>';
    print '</td>';
    print '</tr>';
}

print '</table>';
print '</div>';
print '</br>';
print '<div class="center"><input type="submit" class="button" value="' . $langs->trans("FontAwesomeSaveButton") . '"></div>';
print '</form>';

print '<br><br><div>'.$langs->trans("FontAwesomeDirectoryDownload").'</div><br>';

print '<img src="../img/example_FAdownload.png">';

// End of page
llxFooter();
$db->close();
