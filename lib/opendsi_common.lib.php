<?php
/* Copyright (C) 2005-2013  Laurent Destailleur     <eldy@users.sourceforge.net>
 * Copyright (C) 2017       Open-DSI                <support@open-dsi.fr>
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
 *	\file       htdocs/module/lib/opendsi_common.lib.php
 * 	\ingroup	module
 *	\brief      Common functions opendsi for the module
 */

/**
 * Gives the changelog. First check ChangeLog-la_LA.md then ChangeLog.md
 *
 * @param	string	  $moduleName			    Name of module
 *
 * @return  string                              Content of ChangeLog
 */
function opendsi_common_getChangeLog($moduleName)
{
    global $langs;
    $langs->load("admin");

    include_once DOL_DOCUMENT_ROOT . '/core/lib/files.lib.php';
    include_once DOL_DOCUMENT_ROOT . '/core/lib/geturl.lib.php';

    $filefound = false;

    $modulePath = dol_buildpath('/'.strtolower($moduleName), 0);

    // Define path to file README.md.
    // First check README-la_LA.md then README.md
    $pathoffile = $modulePath . '/ChangeLog-' . $langs->defaultlang . '.md';
    if (dol_is_file($pathoffile)) {
        $filefound = true;
    }
    if (!$filefound) {
        $pathoffile = $modulePath . '/ChangeLog.md';
        if (dol_is_file($pathoffile)) {
            $filefound = true;
        }
    }

    $content = '';

    if ($filefound)     // Mostly for external modules
    {
        $moduleUrlPath = dol_buildpath('/'.strtolower($moduleName), 1);
        $content = file_get_contents($pathoffile);

        if ((float)DOL_VERSION >= 6.0) {
            @include_once DOL_DOCUMENT_ROOT . '/core/lib/parsemd.lib.php';
            $content = dolMd2Html($content, 'parsedown', array('doc/' => $moduleUrlPath . '/doc/'));
        } else {
            $content = opendsi_common_dolMd2Html('codenaf', $content, 'parsedown', array('doc/' => $moduleUrlPath . '/doc/'));
        }

    }

    return $content;
}

/**
 * Function to parse MD content into HTML
 *
 * @param	string	  $moduleName			Name of module
 * @param	string	  $content			    MD content
 * @param   string    $parser               'parsedown' or 'nl2br'
 * @param   string    $replaceimagepath     Replace path to image with another path. Exemple: ('doc/'=>'xxx/aaa/')
 *
 * @return	string                          Parsed content
 */
function opendsi_common_dolMd2Html($moduleName, $content, $parser='parsedown',$replaceimagepath=null)
{
    if (is_array($replaceimagepath)) {
        foreach ($replaceimagepath as $key => $val) {
            $keytoreplace = '](' . $key;
            $valafter = '](' . $val;
            $content = preg_replace('/' . preg_quote($keytoreplace, '/') . '/m', $valafter, $content);
        }
    }

    if ($parser == 'parsedown') {
        dol_include_once('/' . strtolower($moduleName) . '/includes/parsedown/Parsedown.php');
        $Parsedown = new Parsedown();
        $content = $Parsedown->text($content);
    } else {
        $content = nl2br($content);
    }

    return $content;
}
