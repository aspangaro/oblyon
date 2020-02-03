<?php
/* Copyright (C) 2013-2015  Nicolas Rivera      <nrivera.pro@gmail.com>
 * Copyright (C) 2015-2019  Open-DSI            <support@open-dsi.fr> 
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
 *	\file		lib/oblyon.lib.php
 *	\ingroup	oblyon
 *	\brief		Manage Admin Pages
 */

function oblyon_admin_prepare_head()
{
    global $langs, $conf;

    $langs->load("oblyon@oblyon");

    $h = 0;
    $head = array();

    $head[$h][0] = dol_buildpath("/oblyon/admin/menus.php", 1);
    $head[$h][1] = $langs->trans("Menus");
    $head[$h][2] = 'menus';
    $h++;

    $head[$h][0] = dol_buildpath("/oblyon/admin/colors.php", 1);
    $head[$h][1] = $langs->trans("Colors");
    $head[$h][2] = 'colors';
    $h++;

    $head[$h][0] = dol_buildpath("/oblyon/admin/dashboard.php", 1);
    $head[$h][1] = $langs->trans("Dashboard");
    $head[$h][2] = 'dashboard';
    $h++;

    if($conf->global->OBLYON_MAIN_VERSION == "easya") {
        $head[$h][0] = dol_buildpath("/oblyon/admin/login.php", 1);
        $head[$h][1] = "Login";
        $head[$h][2] = 'login';
        $h++;
    }

    // Show more tabs from modules
    // Entries must be declared in modules descriptor with line
    //$this->tabs = array(
    //	'entity:+tabname:Title:@oblyon:/oblyon/mypage.php?id=__ID__'
    //); // to add new tab
    //$this->tabs = array(
    //	'entity:-tabname:Title:@oblyon:/oblyon/mypage.php?id=__ID__'
    //); // to remove a tab
    complete_head_from_modules($conf, $langs, $object, $head, $h, 'admin_oblyon');

    if($conf->global->OBLYON_MAIN_VERSION != "easya") {
        $head[$h][0] = dol_buildpath("/oblyon/admin/about.php", 1);
        $head[$h][1] = $langs->trans("About");
        $head[$h][2] = 'about';
        $h++;
    }

    return $head;
}
