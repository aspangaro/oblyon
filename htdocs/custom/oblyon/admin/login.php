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
 * 	\file		admin/login.php
 * 	\ingroup	oblyon
 * 	\brief		Login color Page < Oblyon Theme Configurator >
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

// Parameters OBLYON_*
$dashboard_colors = array (
    'OBLYON_COLOR_LOGIN_BCKGRD_RIGHT',
    'OBLYON_COLOR_LOGIN_BCKGRD_LEFT',
    'OBLYON_COLOR_LOGIN_TXT_RIGHT',
    'OBLYON_COLOR_LOGIN_TXT_LEFT',
    'OBLYON_COLOR_LOGIN_TXT_INPUT',
);


/*
 * Actions
 */
$mesg="";
$action = GETPOST('action', 'alpha');

// set colors
if ($action == 'update') {
	$error = 0;

	foreach ($dashboard_colors as $constname) {
		$constvalue = GETPOST($constname, 'alpha');
		$constvalue = '#'.$constvalue;

		if (! dolibarr_set_const($db, $constname, $constvalue, 'chaine', 0, '', $conf->entity)) {
			$error ++;
		}
	}

    $res = dolibarr_set_const($db, 'OBLYON_LOGIN_TXT1', GETPOST('OBLYON_LOGIN_TXT1'),'chaine',0,'',$conf->entity);
    $res = dolibarr_set_const($db, 'OBLYON_LOGIN_URL1', GETPOST('OBLYON_LOGIN_URL1'),'chaine',0,'',$conf->entity);
    $res = dolibarr_set_const($db, 'OBLYON_LOGIN_FAICON1', GETPOST('OBLYON_LOGIN_FAICON1'),'chaine',0,'',$conf->entity);

    $res = dolibarr_set_const($db, 'OBLYON_LOGIN_TXT2', GETPOST('OBLYON_LOGIN_TXT2'),'chaine',0,'',$conf->entity);
    $res = dolibarr_set_const($db, 'OBLYON_LOGIN_URL2', GETPOST('OBLYON_LOGIN_URL2'),'chaine',0,'',$conf->entity);
    $res = dolibarr_set_const($db, 'OBLYON_LOGIN_FAICON2', GETPOST('OBLYON_LOGIN_FAICON2'),'chaine',0,'',$conf->entity);

    $res = dolibarr_set_const($db, 'OBLYON_LOGIN_TXT3', GETPOST('OBLYON_LOGIN_TXT3'),'chaine',0,'',$conf->entity);
    $res = dolibarr_set_const($db, 'OBLYON_LOGIN_URL3', GETPOST('OBLYON_LOGIN_URL3'),'chaine',0,'',$conf->entity);
    $res = dolibarr_set_const($db, 'OBLYON_LOGIN_FAICON3', GETPOST('OBLYON_LOGIN_FAICON3'),'chaine',0,'',$conf->entity);

    $res = dolibarr_set_const($db, 'OBLYON_SOCIAL_TWITTER', GETPOST('OBLYON_SOCIAL_TWITTER'),'chaine',0,'',$conf->entity);
    $res = dolibarr_set_const($db, 'OBLYON_SOCIAL_FACEBOOK', GETPOST('OBLYON_SOCIAL_FACEBOOK'),'chaine',0,'',$conf->entity);
    $res = dolibarr_set_const($db, 'OBLYON_SOCIAL_LINKEDIN', GETPOST('OBLYON_SOCIAL_LINKEDIN'),'chaine',0,'',$conf->entity);
    $res = dolibarr_set_const($db, 'OBLYON_SOCIAL_INSTAGRAM', GETPOST('OBLYON_SOCIAL_INSTAGRAM'),'chaine',0,'',$conf->entity);
    $res = dolibarr_set_const($db, 'OBLYON_SOCIAL_YOUTUBE', GETPOST('OBLYON_SOCIAL_YOUTUBE'),'chaine',0,'',$conf->entity);
    $res = dolibarr_set_const($db, 'OBLYON_SOCIAL_GITHUB', GETPOST('OBLYON_SOCIAL_GITHUB'),'chaine',0,'',$conf->entity);

    if (! $res > 0) $error++;

	if (! $error) {
		setEventMessages($langs->trans("SetupSaved"), null, 'mesgs');
	} else {
		setEventMessages($langs->trans("Error"), null, 'errors');
	}

	$_SESSION['dol_resetcache']=dol_print_date(dol_now(),'dayhourlog');
}

if ($action == 'settheme') {
    $value = GETPOST('value', 'int');

    // Login Dark
    if ($value == 2) {
        $_SESSION['dol_resetcache']=dol_print_date(dol_now(),'dayhourlog');
        $mesg = "<span class='ok'>".$langs->trans("ThemeLoginDarkApplied")."</span>";

        dolibarr_set_const($db, "OBLYON_COLOR_LOGIN_BCKGRD_RIGHT", '#2a2a2a','chaine',0,'',$conf->entity);
        dolibarr_set_const($db, "OBLYON_COLOR_LOGIN_BCKGRD_LEFT", '#d51123','chaine',0,'',$conf->entity);
        dolibarr_set_const($db, "OBLYON_COLOR_LOGIN_TXT_RIGHT", '#FFFFFF','chaine',0,'',$conf->entity);
        dolibarr_set_const($db, "OBLYON_COLOR_LOGIN_TXT_INPUT", '#FFFFFF','chaine',0,'',$conf->entity);
    }

    // Login Light
    if ($value == 1) {
        $_SESSION['dol_resetcache']=dol_print_date(dol_now(),'dayhourlog');
        $mesg = "<span class='ok'>".$langs->trans("ThemeLoginLightApplied")."</span>";


        dolibarr_set_const($db, "OBLYON_COLOR_LOGIN_BCKGRD_RIGHT", '#FFFFFF','chaine',0,'',$conf->entity);
        dolibarr_set_const($db, "OBLYON_COLOR_LOGIN_BCKGRD_LEFT", '#d51123','chaine',0,'',$conf->entity);
        dolibarr_set_const($db, "OBLYON_COLOR_LOGIN_TXT_RIGHT", '#444444','chaine',0,'',$conf->entity);
        dolibarr_set_const($db, "OBLYON_COLOR_LOGIN_TXT_INPUT", '#555555','chaine',0,'',$conf->entity);
    }

}

/*
 * View
 */
llxHeader('', $langs->trans("OblyonDashboardTitle"),'','','','', array('/oblyon/js/jscolor.js','/oblyon/js/jquery.ui.touch-punch.min.js'),'' );

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">'	. $langs->trans("BackToModuleList") . '</a>';
print load_fiche_titre($langs->trans('OblyonLoginTitle'), $linkback);

// Configuration header
$head = oblyon_admin_prepare_head();

dol_fiche_head($head, 'login', $langs->trans("Module113900Name"), 0, "oblyon@oblyon");

dol_htmloutput_mesg($mesg);

// Setup page goes here

print '<script type="text/javascript">';
print 'r(function(){';
print '	var els = document.getElementsByTagName("link");';
print '	var els_length = els.length;';
print '	for (var i = 0, l = els_length; i < l; i++) {';
print '    var el = els[i];';
print '	   if (el.href.search("style.min.css") >= 0) {';
print '        el.href += "?" + Math.floor(Math.random() * 100);';
print '    }';
print '	}';
print '});';
print 'function r(f){/in/.test(document.readyState)?setTimeout("r("+f+")",9):f()}';
// Colorpicker
print '
$(document).ready(function() {
	var root_font_size = parseInt($("html").css("font-size").split("px")[0]),
	def_dhfs = 1.7 * root_font_size,
	def_shfs = 1.6 * root_font_size,
	def_dvmfs = 1.2 * root_font_size,
	def_svmfs = 1.2 * root_font_size,

	act_rem_dhfs = "' . $act_rem_dhfs . '",
	act_dhfs = parseFloat(act_rem_dhfs.split("rem")[0]) * root_font_size,
	act_px_dhfs = ( act_dhfs.toString() ) + "px",

	act_rem_shfs = "' . $act_rem_shfs . '",
	act_shfs = parseFloat(act_rem_shfs.split("rem")[0]) * root_font_size,
	act_px_shfs = ( act_shfs.toString() ) + "px";

	act_rem_dvmfs = "' . $act_rem_dvmfs . '",
	act_dvmfs = parseFloat(act_rem_dvmfs.split("rem")[0]) * root_font_size,
	act_px_dvmfs = ( act_dvmfs.toString() ) + "px",

	act_rem_svmfs = "' . $act_rem_svmfs . '",
	act_svmfs = parseFloat(act_rem_svmfs.split("rem")[0]) * root_font_size,
	act_px_svmfs = ( act_svmfs.toString() ) + "px";

	$("#dhfs-slider").slider({
		animate: "fast",
		min: -8,
		max: 8,
		step:1
	});
	$("#dhfs-disp-val").html(act_px_dhfs);
	$("#dhfs-stor-val").val(act_rem_dhfs);
	$("#dhfs-slider").slider("value",act_dhfs - def_dhfs);
	$("#dhfs-slider").on("slide",function(event, ui) {
		var dhfs_sel_value = $("#dhfs-slider").slider("value"),
			new_dhfs = def_dhfs + dhfs_sel_value,
			rem_dhfs = (new_dhfs / root_font_size).toString() + "rem";
		$("#dhfs-disp-val").html(new_dhfs.toString() + "px");
		$("#dhfs-stor-val").val(rem_dhfs);
		$("#tmenu_tooltip").css("font-size",rem_dhfs);
		$(".login_block").css("font-size",rem_dhfs);
	});

	$("#shfs-slider").slider({
		animate: "fast",
		min: -8,
		max: 8,
		step:1
	});
	$("#shfs-disp-val").html(act_px_shfs);
	$("#shfs-stor-val").val(act_rem_shfs);
	$("#shfs-slider").slider("value",act_shfs - def_shfs);
	$("#shfs-slider").on("slide",function(event, ui) {
		var shfs_sel_value = $("#shfs-slider").slider("value");
		var new_shfs = def_shfs + shfs_sel_value;
		var rem_shfs = (new_shfs / root_font_size).toString() + "rem";
		$("#shfs-disp-val").html(new_shfs.toString() + "px");
		$("#shfs-stor-val").val(rem_shfs);
	});

	$("#dvmfs-slider").slider({
		animate: "fast",
		min: -8,
		max: 8,
		step:1
	});
	$("#dvmfs-disp-val").html(act_px_dvmfs);
	$("#dvmfs-stor-val").val(act_rem_dvmfs);
	$("#dvmfs-slider").slider("value",act_dvmfs - def_dvmfs);
	$("#dvmfs-slider").on("slide",function(event, ui) {
		var dvmfs_sel_value = $("#dvmfs-slider").slider("value"),
			new_dvmfs = def_dvmfs + dvmfs_sel_value,
			rem_dvmfs = (new_dvmfs / root_font_size).toString() + "rem";
		$("#dvmfs-disp-val").html(new_dvmfs.toString() + "px");
		$("#dvmfs-stor-val").val(rem_dvmfs);
		$("#id-left").css("font-size",rem_dvmfs);
	});

	$("#svmfs-slider").slider({
		animate: "fast",
		min: -8,
		max: 8,
		step:1
	});
	$("#svmfs-disp-val").html(act_px_svmfs);
	$("#svmfs-stor-val").val(act_rem_svmfs);
	$("#svmfs-slider").slider("value",act_svmfs - def_svmfs);
	$("#svmfs-slider").on("slide",function(event, ui) {
		var svmfs_sel_value = $("#svmfs-slider").slider("value");
		var new_svmfs = def_svmfs + svmfs_sel_value;
		var rem_svmfs = (new_svmfs / root_font_size).toString() + "rem";
		$("#svmfs-disp-val").html(new_svmfs.toString() + "px");
		$("#svmfs-stor-val").val(rem_svmfs);
	});
});
';

print '</script>'."\n";

print '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
print '<input type="hidden" name="token" value="' . $_SESSION['newtoken'] . '">';
print '<input type="hidden" name="action" value="update">';

// Template login
print '<table class="noborder centpercent">';
print '<tr class="liste_titre">';
print '<td colspan="2">' . $langs->trans("Themes") . '</td>';
print '</tr>';
print '<tr>';
print '<td align="center"><a title="'.$langs->trans("OblyonLight").'" href="' . $_SERVER['PHP_SELF'] . '?action=settheme&value=1">';
print img_picto($langs->trans("Login light"), 'login_light.png@oblyon', "width='50%'");
print '</a></td>';
print '<td align="center"><a title="'.$langs->trans("OblyonDark").'" href="' . $_SERVER['PHP_SELF'] . '?action=settheme&value=2">';
print img_picto($langs->trans("Login Dark"), 'login_dark.png@oblyon', "width='50%'");
print '</a></td>';
print '</tr>';
print '</table>';

// Colors
print '<table class="noborder as-settings-colors">';

// Colors
print '<tr class="liste_titre">';
print '<td colspan="2">' . $langs->trans('Colors') . '</td>';
print '</tr>'."\n";

// Set colors
$num = count($dashboard_colors);
if ($num)
{
	foreach ($dashboard_colors as $key) {
		print '<tr class="value oddeven">';

		// Param
		$label = $langs->trans($key);
		print '<td width="50%">' . $label . '</td>';

		// Value
		print '<td>';
		print '<input type="text" class="color" id="' . $conf->global->$key . '" name="' . $key . '" value="' . $conf->global->$key . '">';
		print '</td></tr>';
	}
}

print '</table>'."\n";

// Links
print '<table class="noborder centpercent">';
print '<tr class="liste_titre">';
print '<td colspan="2">' . $langs->trans("OblyonLoginLinks") . '</td>';
print '</tr>';

print '<tr class="oddeven">';
print '<td>' . $langs->trans('OBLYON_LOGIN_TXT1') . '<br>';
print $langs->trans('OBLYON_LOGIN_URL1') . '<br>';
print $langs->trans('OBLYON_LOGIN_FAICON1');
print '<td>';
print '<input type="text" class="minwidth400" id="OBLYON_LOGIN_TXT1" name="OBLYON_LOGIN_TXT1" value="' . $conf->global->OBLYON_LOGIN_TXT1 . '"><br />';
print '<input type="text" class="minwidth400" id="OBLYON_LOGIN_URL1" name="OBLYON_LOGIN_URL1" value="' . $conf->global->OBLYON_LOGIN_URL1 . '"><br />';
print '<input type="text" class="minwidth400" id="OBLYON_LOGIN_FAICON1" name="OBLYON_LOGIN_FAICON1" value="' . $conf->global->OBLYON_LOGIN_FAICON1 . '">';
print "</td>\n";
print '</tr>';

print '<tr class="oddeven">';
print '<td>' . $langs->trans('OBLYON_LOGIN_TXT2') . '<br>';
print $langs->trans('OBLYON_LOGIN_URL2') . '<br>';
print $langs->trans('OBLYON_LOGIN_FAICON2');
print '<td>';
print '<input type="text" class="minwidth400" id="OBLYON_LOGIN_TXT2" name="OBLYON_LOGIN_TXT2" value="' . $conf->global->OBLYON_LOGIN_TXT2 . '"><br />';
print '<input type="text" class="minwidth400" id="OBLYON_LOGIN_URL2" name="OBLYON_LOGIN_URL2" value="' . $conf->global->OBLYON_LOGIN_URL2 . '"><br />';
print '<input type="text" class="minwidth400" id="OBLYON_LOGIN_FAICON2" name="OBLYON_LOGIN_FAICON2" value="' . $conf->global->OBLYON_LOGIN_FAICON2 . '">';
print "</td>\n";
print '</tr>';

print '<tr class="oddeven">';
print '<td>' . $langs->trans('OBLYON_LOGIN_TXT3') . '<br>';
print $langs->trans('OBLYON_LOGIN_URL3') . '<br>';
print $langs->trans('OBLYON_LOGIN_FAICON3');
print '<td>';
print '<input type="text" class="minwidth400" id="OBLYON_LOGIN_TXT3" name="OBLYON_LOGIN_TXT3" value="' . $conf->global->OBLYON_LOGIN_TXT3 . '"><br />';
print '<input type="text" class="minwidth400" id="OBLYON_LOGIN_URL3" name="OBLYON_LOGIN_URL3" value="' . $conf->global->OBLYON_LOGIN_URL3 . '"><br />';
print '<input type="text" class="minwidth400" id="OBLYON_LOGIN_FAICON3" name="OBLYON_LOGIN_FAICON3" value="' . $conf->global->OBLYON_LOGIN_FAICON3 . '">';
print "</td>\n";
print '</tr>';

// Social Network
print '<table class="noborder centpercent">';
print '<tr class="liste_titre">';
print '<td colspan="2">' . $langs->trans("OblyonSocialNetwork") . '</td>';
print '</tr>';

print '<tr class="oddeven">';
print '<td>' . $langs->trans('OBLYON_SOCIAL_TWITTER') . '</td>';
print '<td>';
print '<input type="text" class="minwidth500" id="OBLYON_SOCIAL_TWITTER" name="OBLYON_SOCIAL_TWITTER" value="' . $conf->global->OBLYON_SOCIAL_TWITTER . '">';
print "</td>\n";
print '</tr>';

print '<tr>';
print '<td>' . $langs->trans('OBLYON_SOCIAL_FACEBOOK') . '</td>';
print '<td>';
print '<input type="text" class="minwidth500" id="OBLYON_SOCIAL_FACEBOOK" name="OBLYON_SOCIAL_FACEBOOK" value="' . $conf->global->OBLYON_SOCIAL_FACEBOOK . '">';
print "</td>\n";
print '</tr>';

print '<tr>';
print '<td>' . $langs->trans('OBLYON_SOCIAL_LINKEDIN') . '</td>';
print '<td>';
print '<input type="text" class="minwidth500" id="OBLYON_SOCIAL_LINKEDIN" name="OBLYON_SOCIAL_LINKEDIN" value="' . $conf->global->OBLYON_SOCIAL_LINKEDIN . '">';
print "</td>\n";
print '</tr>';

print '<tr>';
print '<td>' . $langs->trans('OBLYON_SOCIAL_INSTAGRAM') . '</td>';
print '<td>';
print '<input type="text" class="minwidth500" id="OBLYON_SOCIAL_INSTAGRAM" name="OBLYON_SOCIAL_INSTAGRAM" value="' . $conf->global->OBLYON_SOCIAL_INSTAGRAM . '">';
print "</td>\n";
print '</tr>';

print '<tr>';
print '<td>' . $langs->trans('OBLYON_SOCIAL_YOUTUBE') . '</td>';
print '<td>';
print '<input type="text" class="minwidth500" id="OBLYON_SOCIAL_YOUTUBE" name="OBLYON_SOCIAL_YOUTUBE" value="' . $conf->global->OBLYON_SOCIAL_YOUTUBE . '">';
print "</td>\n";
print '</tr>';

print '<tr>';
print '<td>' . $langs->trans('OBLYON_SOCIAL_GITHUB') . '</td>';
print '<td>';
print '<input type="text" class="minwidth500" id="OBLYON_SOCIAL_GITHUB" name="OBLYON_SOCIAL_GITHUB" value="' . $conf->global->OBLYON_SOCIAL_GITHUB . '">';
print "</td>\n";
print '</tr>';

print '</table>';

dol_fiche_end();

print '<div class="center">';
print '<input type="submit" class="button" value="' . dol_escape_htmltag($langs->trans('Modify')) . '" name="button">';
print '</div>';

print '</form>';
print '<br>';

// End of page
llxFooter();
$db->close();
