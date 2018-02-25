<?php
/* Copyright (C) 2015-2017	Alexandre Spangaro  <aspangaro@zendsi.com>
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
 * 	\file		admin/admin.php
 * 	\ingroup	oblyon
 * 	\brief		Color Page < Oblyon Theme Configurator >
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
$top_colors = array (
	'OBLYON_COLOR_TOPMENU_BCKGRD',
	'OBLYON_COLOR_TOPMENU_BCKGRD_HOVER',
	'OBLYON_COLOR_TOPMENU_TXT'
);

$left_colors = array (
	'OBLYON_COLOR_LEFTMENU_BCKGRD',
	'OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER',
	'OBLYON_COLOR_LEFTMENU_TXT'
);

$colors_options = array (
	'OBLYON_COLOR_MAIN',
	'OBLYON_COLOR_BCKGRD',
	'OBLYON_COLOR_LOGO_BCKGRD',
	'OBLYON_COLOR_LOGIN_BCKGRD',
	'OBLYON_COLOR_BLINE'
);


/*
 * Actions
 */
$mesg="";
$action = GETPOST('action', 'alpha');

// set colors
if ($action == 'update') {
	$error = 0;

	foreach ($top_colors as $constname) {
		$constvalue = GETPOST($constname, 'alpha');
		$constvalue = '#'.$constvalue;

		if (! dolibarr_set_const($db, $constname, $constvalue, 'chaine', 0, '', $conf->entity)) {
			$error ++;
		}
	}

	foreach ($left_colors as $constname) {
		$constvalue = GETPOST($constname, 'alpha');
		$constvalue = '#'.$constvalue;

		if (! dolibarr_set_const($db, $constname, $constvalue, 'chaine', 0, '', $conf->entity)) {
			$error ++;
		}
	}

	foreach ($colors_options as $constname) {
		$constvalue = GETPOST($constname, 'alpha');
		$constvalue = '#'.$constvalue;

		if (! dolibarr_set_const($db, $constname, $constvalue, 'chaine', 0, '', $conf->entity)) {
			$error ++;
		}
	}

	if (! $error) {
		setEventMessages($langs->trans("SetupSaved"), null, 'mesgs');
	} else {
		setEventMessages($langs->trans("Error"), null, 'errors');
	}

	$_SESSION['dol_resetcache']=dol_print_date(dol_now(),'dayhourlog');
}

if ($action == 'settheme') {
	$value = GETPOST('value', 'int');

	// Theme Oblyon Blue
	if ($value == 2) {
		$_SESSION['dol_resetcache']=dol_print_date(dol_now(),'dayhourlog');
		$mesg = "<font class='ok'>".$langs->trans("ThemeOblyonBlueApplied")."</font>";

		dolibarr_set_const($db, "OBLYON_COLOR_MAIN", '#0083a2','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_TOPMENU_BCKGRD", '#333','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_TOPMENU_TXT", '#f4f4f4','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_TOPMENU_BCKGRD_HOVER", '#444','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_LEFTMENU_BCKGRD", '#333','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_LEFTMENU_TXT", '#f4f4f4','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER", '#444','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_BCKGRD", '#f4f4f4','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_LOGO_BCKGRD", '#ffffff','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_LOGIN_BCKGRD", '#0083a2','chaine',0,'',$conf->entity);
	}

	// Theme Oblyon Green
	if ($value == 1) {
		$_SESSION['dol_resetcache']=dol_print_date(dol_now(),'dayhourlog');
		$mesg = "<font class='ok'>".$langs->trans("ThemeOblyonGreenApplied")."</font>";

		dolibarr_set_const($db, "OBLYON_COLOR_MAIN", '#0083a2','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_TOPMENU_BCKGRD", '#34495E','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_TOPMENU_BCKGRD_HOVER", '#2C3E50','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_TOPMENU_TXT", '#ffffff','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_LEFTMENU_BCKGRD", '#2ECC71','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_LEFTMENU_TXT", '#ffffff','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER", '#29B564','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_BCKGRD", '#F5F5F5','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_LOGO_BCKGRD", '#ffffff','chaine',0,'',$conf->entity);
		dolibarr_set_const($db, "OBLYON_COLOR_LOGIN_BCKGRD", '#0083a2','chaine',0,'',$conf->entity);
	}
	
}

/*
 * View
 */
llxHeader('', $langs->trans("OblyonColorsTitle"),'','','','', array('/oblyon/js/jscolor.js','/oblyon/js/jquery.ui.touch-punch.min.js'),'' );

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">'	. $langs->trans("BackToModuleList") . '</a>';
print_fiche_titre($langs->trans('OblyonColorsTitle'), $linkback);

// Configuration header
$head = oblyon_admin_prepare_head();

dol_fiche_head($head, 'colors', $langs->trans("Module113900Name"), 0, "oblyon@oblyon");

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
	// slider
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
		sizes_calc();
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
	sizes_calc();
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
	sizes_calc();
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

print '<table class="noborder centpercent">';
print '<tr class="liste_titre">';
print '<td colspan="5">' . $langs->trans("Themes") . '</td>';
print '</tr>';
print '<tr>';
print '<td align="center"><a title="'.$langs->trans("OblyonGreen").'" href="' . $_SERVER['PHP_SELF'] . '?action=settheme&value=1">';
print img_picto($langs->trans("Oblyon Green"), 'oblyon_green.png@oblyon', "width='50%'");
print '</a></td>';
print '<td align="center"><a title="'.$langs->trans("oblyonBlue").'" href="' . $_SERVER['PHP_SELF'] . '?action=settheme&value=2">';
print img_picto($langs->trans("Oblyon Blue"), 'oblyon_blue.png@oblyon', "width='50%'");
print '</a></td>';
print '</tr>';
print '</table>';


// Colors
print '<table class="noborder as-settings-colors">';
print '<tr class="liste_titre">';
print '<td colspan="2">' . $langs->trans('TopMenu') . '</td>';
print '</tr>'."\n";

// Set colors
$num = count($top_colors);
if ($num)
{
	foreach ($top_colors as $key) {
		$var = ! $var;

		print '<tr ' . $bc[$var] . ' class="value">';

		// Param
		$label = $langs->trans($key);
		print '<td width="50%">' . $label . '</td>';

		// Value
		print '<td>';
		print '<input type="text" class="color" id="' . $conf->global->$key . '" name="' . $key . '" value="' . $conf->global->$key . '">';
		print '</td></tr>';
	}
}

print '<tr class="liste_titre">';
print '<td colspan="2">' . $langs->trans('LeftMenu') . '</td>';
print '</tr>'."\n";

// Set colors
$num = count($left_colors);
if ($num)
{
	foreach ($left_colors as $key) {
		$var = ! $var;

		print '<tr ' . $bc[$var] . ' class="value">';

		// Param
		$label = $langs->trans($key);
		print '<td width="50%">' . $label . '</td>';

		// Value
		print '<td>';
		print '<input type="text" class="color" id="' . $conf->global->$key . '" name="' . $key . '" value="' . $conf->global->$key . '">';
		print '</td></tr>';
	}
}

print '<tr class="liste_titre">';
print '<td colspan="2">' . $langs->trans('Others') . '</td>';
print '</tr>'."\n";

// Set colors
$num = count($colors_options);
if ($num)
{
	foreach ($colors_options as $key) {
		$var = ! $var;

		print '<tr ' . $bc[$var] . ' class="value">';

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

// Set default colors

print '
<br>

<br>
'."\n";


dol_fiche_end();

print '<div class="center"><input type="submit" class="button" value="' . dol_escape_htmltag($langs->trans('Modify')) . '" name="button">';
print '</form>';

print '</div>';

llxFooter();
$db->close();
