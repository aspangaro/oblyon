<?php
/************************************************
	* Copyright (C) 2015-2025  Alexandre Spangaro   <alexandre@inovea-conseil.com>
	* Copyright (C) 2023-2026  Sylvain Legrand		<contact@infras.fr>
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
	************************************************/

/************************************************
* 	\file		../oblyon/admin/colors.php
* 	\ingroup	oblyon
* 	\brief		Options Page < Oblyon Theme Configurator >
************************************************/

// Dolibarr environment *************************
require '../config.php';

// Libraries ************************************
require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';
dol_include_once('/oblyon/lib/oblyon.lib.php');
dol_include_once('/oblyon/lib/oblyon_presets.lib.php');	// InfraS add : presets JSON (3.6.0)

/**
 * @var Conf $conf
 * @var DoliDB $db
 * @var HookManager $hookmanager
 * @var Societe $mysoc
 * @var Translate $langs
 * @var User $user
 */

// Translations *********************************
$langs->loadLangs(array('admin', 'oblyon@oblyon', 'inovea@oblyon'));

// Access control *******************************
if (! $user->admin) accessforbidden();

// Reset cache **********************************
$_SESSION['dol_resetcache']	= dol_print_date(dol_now(), 'dayhourlog');

// InfraS add begin : presets JSON (3.6.0) : telecharger (GET + jeton), appliquer / mettre a jour / enregistrer sous / supprimer / importer (POST + jeton, puis redirection)
oblyon_colors_normalize_stored();	// InfraS add 3.7.0 : constantes encore en 'r,g,b' (pages "Interface utilisateur" du core) reecrites en '#RRGGBB'
oblyon_detect_current_preset();	// instance mise a jour par copie de fichiers : OBLYON_CURRENT_PRESET semee si la base correspond exactement a un preset
$presetaction	= GETPOST('action', 'aZ09');
$presetkey		= GETPOST('preset_key', 'alphanohtml');
if ($presetaction == 'download_preset' && oblyon_preset_key_is_valid($presetkey)) {
	$preset	= oblyon_get_preset($presetkey);
	if ($preset !== null) {
		header('Content-Type: application/json; charset=utf-8');
		header('Content-Disposition: attachment; filename="'.$presetkey.'.json"');
		header('Content-Length: '.filesize($preset['file']));
		readfile($preset['file']);
		exit;
	}
}
if (in_array($presetaction, array('apply_preset', 'save_preset', 'saveas_preset', 'delete_preset', 'import_preset')) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$presetsections	= array_values(array_intersect((array) GETPOST('preset_sections', 'array'), array_keys(oblyon_presets_sections())));
	$presetres		= 0;
	$presetmsg		= '';
	if ($presetaction == 'apply_preset') {
		$presetres	= oblyon_apply_preset($presetkey, $presetsections);
		$presetmsg	= 'OblyonPresetApplied';
	} elseif ($presetaction == 'save_preset') {
		$presetres	= oblyon_update_preset($presetkey, array(), GETPOST('preset_name', 'alphanohtml'), GETPOST('preset_desc', 'alphanohtml'));	// always the whole file (the screen has no section choice)
		$presetmsg	= 'OblyonPresetSaved';
	} elseif ($presetaction == 'saveas_preset') {
		$presetkey	= strtolower(preg_replace('/[^a-z0-9_-]/i', '-', $presetkey));
		$presetres	= oblyon_export_preset($presetkey, GETPOST('preset_name', 'alphanohtml'), GETPOST('preset_desc', 'alphanohtml'), $presetsections);
		$presetmsg	= 'OblyonPresetCreated';
	} elseif ($presetaction == 'delete_preset') {
		$presetres	= oblyon_delete_preset($presetkey);
		$presetmsg	= 'OblyonPresetDeleted';
	} elseif ($presetaction == 'import_preset') {
		if (! empty($_FILES['preset_file']['tmp_name']) && is_uploaded_file($_FILES['preset_file']['tmp_name'])) {
			if ($presetkey === '')	$presetkey	= preg_replace('/\.json$/i', '', $_FILES['preset_file']['name']);
			$presetkey	= strtolower(preg_replace('/[^a-z0-9_-]/i', '-', $presetkey));
			$presetres	= oblyon_import_preset($_FILES['preset_file']['tmp_name'], $presetkey, GETPOSTINT('preset_replace') ? true : false);
		} else {
			$presetres	= -5;
		}
		$presetmsg	= 'OblyonPresetImported';
	}
	if ($presetres > 0) {
		setEventMessages($langs->trans($presetmsg, $presetkey), null, 'mesgs');
	} else {
		$preseterrors	= array(-1 => 'OblyonPresetErrorWrite', -2 => 'OblyonPresetErrorKey', -3 => 'OblyonPresetErrorReserved', -4 => 'OblyonPresetErrorExists', -5 => 'OblyonPresetErrorFile');
		if ($presetaction == 'apply_preset' || $presetaction == 'delete_preset' || $presetaction == 'save_preset')	$preseterrors[-2]	= 'OblyonPresetErrorUnknown';
		if ($presetaction == 'apply_preset')	$preseterrors[-1]	= 'OblyonPresetErrorApply';	// -1 = SQL error, not a file error
		setEventMessages($langs->trans(isset($preseterrors[$presetres]) ? $preseterrors[$presetres] : 'Error'), null, 'errors');
	}
	header('Location: '.$_SERVER['PHP_SELF']);
	exit;
}
// InfraS add end

// init variables *******************************
$listcolor	= array('top'		=> array('OBLYON_COLOR_TOPMENU_BCKGRD',
										'OBLYON_COLOR_TOPMENU_BCKGRD_HOVER',
										'OBLYON_COLOR_TOPMENU_TXT',
										'OBLYON_COLOR_TOPMENU_TXT_ACTIVE',
										'OBLYON_COLOR_TOPMENU_TXT_HOVER',
										'OBLYON_COLOR_TOPMENU_BCKGRD_SEL',	// InfraS add : entree selectionnee (3.7.0)
										'OBLYON_COLOR_TOPMENU_TXT_SEL'		// InfraS add
										),
					'left'		=> array('OBLYON_COLOR_LEFTMENU_BCKGRD',
										'OBLYON_COLOR_LEFTMENU_BCKGRD_HOVER',
										'OBLYON_COLOR_LEFTMENU_TXT',
										'OBLYON_COLOR_LEFTMENU_TXT_ACTIVE',
										'OBLYON_COLOR_LEFTMENU_TXT_HOVER',
										),
					'button'	=> oblyon_button_colors_all(),	// familles action / suppression / formulaire x fond, texte, bordure, survol (oblyon_button_families()) ; les styles Contour / Doux ont leur propre jeu FLAT_*
					'message'	=> array('OBLYON_COLOR_INFO_BORDER',
										'OBLYON_COLOR_INFO_BCKGRD',
										'OBLYON_COLOR_INFO_TEXT',
										'OBLYON_COLOR_WARNING_BORDER',
										'OBLYON_COLOR_WARNING_BCKGRD',
										'OBLYON_COLOR_WARNING_TEXT',
										'OBLYON_COLOR_ERROR_BORDER',
										'OBLYON_COLOR_ERROR_BCKGRD',
										'OBLYON_COLOR_ERROR_TEXT',
										'OBLYON_COLOR_NOTIF_INFO_BCKGRD',
										'OBLYON_COLOR_NOTIF_INFO_TEXT',
										'OBLYON_COLOR_NOTIF_WARNING_BCKGRD',
										'OBLYON_COLOR_NOTIF_WARNING_TEXT',
										'OBLYON_COLOR_NOTIF_ERROR_BCKGRD',
										'OBLYON_COLOR_NOTIF_ERROR_TEXT'
										),
					'options'	=> array('OblyonColorGrpBackgrounds'	=> array('OBLYON_COLOR_MAIN',
																				'OBLYON_COLOR_BCKGRD',
																				'OBLYON_COLOR_INPUT_BCKGRD',
																				'OBLYON_COLOR_INPUT_ADD_BCKGRD',
																				'OBLYON_COLOR_OVERLAY_BCKGRD',	// InfraS add : surfaces flottantes (3.7.0)
																				'OBLYON_COLOR_LOGO_BCKGRD',
																				'OBLYON_COLOR_LOGIN_BCKGRD'
																				),
										'OblyonColorGrpText'			=> array('THEME_ELDY_TEXT',
																				'THEME_ELDY_TEXTLINK',
																				'OBLYON_COLOR_ICON_TEXT'	// InfraS add : pictos secondaires (3.7.0)
																				),
										'OblyonColorGrpTitles'			=> array('OBLYON_COLOR_BTITLE',
																				'OBLYON_COLOR_STITLE',
																				'THEME_ELDY_TEXTTITLE',
																				'THEME_ELDY_TEXTTITLENOTAB',
																				'THEME_ELDY_TOPBORDER_TITLE1',
																				'THEME_ELDY_BACKTITLE1',
																				'OBLYON_COLOR_LISTHEAD_FLAT_BCKGRD',	// en-tetes de liste plats (3.8.0), affichees seulement quand OBLYON_LIST_HEADER_STYLE = flat (oblyon_tab_color_visible)
																				'OBLYON_COLOR_LISTHEAD_FLAT_TXT',
																				'OBLYON_COLOR_LISTHEAD_FLAT_LINE',
																				'OBLYON_COLOR_LISTHEAD_FLAT_SEL'
																				),
										'OblyonColorGrpTabs'			=> array('THEME_ELDY_BACKTABACTIVE',	// boites (rendu d'origine) ; chaque style d'onglets n'affiche que ses couleurs : oblyon_tab_color_visible() (3.8.0)
																				'THEME_ELDY_BACKTABCARD1',	// InfraS add : fond de l'onglet actif d'une fiche, jusqu'ici absent de l'onglet (restait blanc dans un preset sombre)
																				'OBLYON_COLOR_TEXTTABACTIVE',
																				'OBLYON_COLOR_TAB_PILL_BCKGRD',	// onglets en pilules (3.8.0)
																				'OBLYON_COLOR_TAB_PILL_TXT',
																				'OBLYON_COLOR_TAB_PILL_BORDER',
																				'OBLYON_COLOR_TAB_UNDER_BAND',	// onglets soulignes (3.8.0)
																				'OBLYON_COLOR_TAB_UNDER_TXT',
																				'OBLYON_COLOR_TAB_UNDER_LINE'
																				),
										'OblyonColorGrpLines'			=> array('OBLYON_COLOR_BLINE',
																				'OBLYON_COLOR_FLINE',
																				'THEME_ELDY_USE_HOVER',
																				'THEME_ELDY_USE_CHECKED',
																				'OBLYON_COLOR_FLINE_HOVER',
																				'THEME_ELDY_LINEIMPAIR1',
																				'THEME_ELDY_LINEIMPAIR2',
																				'THEME_ELDY_LINEPAIR1',
																				'THEME_ELDY_LINEPAIR2',
																				'THEME_ELDY_LINEBREAK'
																				),
										'OblyonColorGrpTotal'			=> array('OBLYON_COLOR_BTOTAL',
																				'OBLYON_COLOR_FTOTAL'
																				),
										'OblyonColorGrpDate'			=> array('OBLYON_COLOR_FDATE_DEFAULT',
																				'OBLYON_COLOR_FDATE_SELECTED'
																				),
										'OblyonColorGrpAgenda'			=> array('OBLYON_COLOR_CAL_EVENT_TXT',	// InfraS add begin : agenda / calendriers (3.7.0)
																				'OBLYON_COLOR_CAL_WEEKEND_BCKGRD',
																				'OBLYON_COLOR_CAL_HOLIDAY_BCKGRD'
																				),	// InfraS add end
										'OblyonColorGrpTimeline'		=> array('OBLYON_COLOR_TIMELINE_BCKGRD',	// InfraS add begin : fil de discussion des tickets (3.7.0)
																				'OBLYON_COLOR_TIMELINE_PRIVATE_BCKGRD'
																				),	// InfraS add end
										'OblyonColorGrpNatures'			=> array('THEME_ELDY_PROSPECTBACK',
																				'THEME_ELDY_CUSTOMERBACK',
																				'THEME_ELDY_VENDORBACK',
																				'THEME_ELDY_USERBACK',
																				'THEME_ELDY_COLORNATURE'
																				),
										'OblyonColorGrpMembers'			=> array('THEME_ELDY_MEMBER_COMPANYBACK',
																				'THEME_ELDY_MEMBER_INDIVIDUALBACK',
																				'THEME_ELDY_COLORMEMBER'
																				),
										'OblyonColorGrpDashboard'		=> array('OBLYON_COLOR_BOX_SHADOW',
																				'OBLYON_COLOR_INFOBOX_BCKGRD1',
																				'OBLYON_COLOR_INFOBOX_BCKGRD2',
																				'OBLYON_COLOR_BORDER_ACTIONCOLUMN'
																				),
										'OblyonColorGrpAmounts'			=> array('OBLYON_COLOR_AMOUNT_TEXT',	// InfraS add : texte des montants (3.7.0)
																				'OBLYON_COLOR_AMOUNT_REMAIN',
																				'OBLYON_COLOR_AMOUNT_PAID',
																				'OBLYON_COLOR_AMOUNT_UNPAID'
																				),
										'OblyonColorGrpStock'			=> array('OBLYON_COLOR_STOCK_OK',	// InfraS add begin : stock et mouvements (3.7.0)
																				'OBLYON_COLOR_STOCK_LOW',
																				'OBLYON_COLOR_STOCK_EXIT'
																				),
										'OblyonColorGrpBadges'			=> array('OBLYON_COLOR_BADGE_DRAFT',	// badges de statut : fond / bordure, texte calcule par contraste (3.7.0)
																				'OBLYON_COLOR_BADGE_VALIDATED',
																				'OBLYON_COLOR_BADGE_APPROVED',
																				'OBLYON_COLOR_BADGE_WAITING',
																				'OBLYON_COLOR_BADGE_ACTIVE',
																				'OBLYON_COLOR_BADGE_CLOSED',
																				'OBLYON_COLOR_BADGE_CANCELED',
																				'OBLYON_COLOR_BADGE_ERROR',
																				'OBLYON_COLOR_BADGE_DONE'
																				),	// InfraS add end
										'OblyonColorGrpStatus'			=> array('OBLYON_COLOR_STATUS_SUCCESS',
																				'OBLYON_COLOR_STATUS_INFO',
																				'OBLYON_COLOR_STATUS_WARNING',
																				'OBLYON_COLOR_STATUS_DANGER',
																				'OBLYON_COLOR_STATUS_PRIMARY',
																				'OBLYON_COLOR_PROGRESSBAR',
																				'OBLYON_COLOR_TIMELINEITEM'
																				),
										'OblyonColorGrpWeather'			=> array('OBLYON_COLOR_WEATHER_LEVEL0',
																				'OBLYON_COLOR_WEATHER_LEVEL1',
																				'OBLYON_COLOR_WEATHER_LEVEL2',
																				'OBLYON_COLOR_WEATHER_LEVEL3',
																				'OBLYON_COLOR_WEATHER_LEVEL4',
																				'OBLYON_COLOR_INFOBOX_UPDATE'
																				),
										'OblyonColorGrpAutocomplete'	=> array('OBLYON_COLOR_AUTOCOMPLETE_BCKGRD',
																				'OBLYON_COLOR_AUTOCOMPLETE_TEXT'
																				),
										'OblyonColorGrpMultiselect'		=> array('OBLYON_COLOR_CHIP_BCKGRD',
																				'OBLYON_COLOR_CHIP_TEXT',
																				'OBLYON_COLOR_RESULT_BCKGRD',
																				'OBLYON_COLOR_RESULT_TEXT'
																				),
										'OblyonColorGrpEldyOther'		=> array('THEME_ELDY_TOPMENU_BACK1',	// InfraS add begin : lues par le theme et deja proposees sur l'onglet utilisateur, mais absentes ici (3.7.0) ; valeurs invalides '0.0.0' impossibles a corriger depuis le module
																				'THEME_ELDY_VERMENU_BACK1',
																				'THEME_ELDY_BACKBODY',
																				'THEME_ELDY_TEXTTITLELINK'
																				),	// InfraS add end
										)
					);
// InfraS change : les presets de couleurs (ex-tableau $listtheme, 5 x 102 constantes) sont des fichiers JSON : presets/*.json du module et presets de l'instance (voir lib/oblyon_presets.lib.php)

// Actions **************************************
$action		= GETPOST('action','alpha');
$result		= '';

// Sauvegarde / Restauration
if ($action == 'bkupParams') {
	$result	= oblyon_bkup_module ('oblyon');
}
if ($action == 'restoreParams') {
	$result	= oblyon_restore_module ('oblyon');
}
// On / Off management
if (preg_match('/set_(.*)/', $action, $reg)) {
	$confkey	= $reg[1];
	if (preg_match('/^(OBLYON_|THEME_|MAIN_|FIX_|DISABLE_)/', $confkey)) {
		$result		= dolibarr_set_const($db, $confkey, GETPOST('value', 'alphanohtml'), 'chaine', 0, 'Oblyon module', $conf->entity);
	}
}
// Update buttons management
if (preg_match('/update_(.*)/', $action, $reg)) {
	$list		= array ('Gen'	=> array('THEME_INVERT_RATIO_FILTER'));
	$confkey	= $reg[1];
	$error		= 0;
	foreach ($list[$confkey] as $constname) {
		$result	= dolibarr_set_const($db, $constname, GETPOST($constname, 'alpha'),	'chaine', 0, 'Oblyon module', $conf->entity);
	}
	$btnauto	= oblyon_button_auto_values(new User($db));	// couleurs de boutons automatiques de l'INSTANCE (utilisateur sans id : jamais les couleurs personnelles de l'admin), calculees avant toute ecriture : une couleur postee identique a la valeur affichee reste automatique ('#')
	foreach ($listcolor as $list) {
		array_walk_recursive($list, function ($constname) use ($db, $conf, &$result, $btnauto) {
			if (! GETPOSTISSET($constname))	return;	// champ non affiche (ex. couleurs des pilules hors style "pills", bordure de la colonne d'actions) : valeur en base conservee au lieu d'etre remplacee par '#'
			$value	= '#'.GETPOST($constname, 'alpha');
			if (isset($btnauto[$constname]) && strtoupper($value) === $btnauto[$constname])	$value	= '#';	// non modifiee -> suit toujours le style et les couleurs de base
			$result	= dolibarr_set_const($db, $constname, $value,	'chaine', 0, 'Oblyon module', $conf->entity);
		});
	}
	// InfraS change : l'application d'un preset ne passe plus par ce bloc (action apply_preset, lib/oblyon_presets.lib.php)
}
// Retour => message Ok ou Ko
if ($result == 1) {
	setEventMessages($langs->trans('SetupSaved'), null, 'mesgs');
}
if ($result == -1) {
	setEventMessages($langs->trans('Error'), null, 'errors');
}

// View *****************************************
$page_name	= $langs->trans('OblyonColorsTitle');
llxHeader('', $page_name, '', '', 0, 0, array('/oblyon/js/jscolor.js', '/oblyon/js/jquery.ui.touch-punch.min.js'), '', 'mod-oblyon page-admin-colors');
$linkback	= '<a href = "'.DOL_URL_ROOT.'/admin/modules.php?restore_lastsearch_values=1">'.$langs->trans('BackToModuleList').'</a>';
print load_fiche_titre($page_name, $linkback, 'object_inovea.png@oblyon');

// Configuration header *************************
$head		= oblyon_admin_prepare_head();
print dol_get_fiche_head($head, 'colors', $page_name, -1);

// setup page goes here *************************
print '	<script type = "text/javascript">
				$(document).ready(function() {
					$(".action").keyup(function(event) {
						if (event.which === 13)	$("#action").click();
					});
				});
			</script>';

// InfraS add begin : presets (cartes, enregistrer sous, importer) : formulaires propres, donc avant le formulaire des couleurs
print oblyon_print_preset_cards();
print oblyon_print_preset_forms();
// InfraS add end
// (3.8.0 : le rapport de contraste texte / fond affiche ici depuis la 3.7.0 est retire, mecanisme juge trop lourd pour son usage)

print '<form action = "'.dol_escape_htmltag($_SERVER['PHP_SELF']).'" method = "POST" enctype = "multipart/form-data">
				<input type="hidden" name="token" value="'.newToken().'" />
				<input type="hidden" name="action" value="update">
				<input type="hidden" name="page_y" value="">
				<input type="hidden" name="dol_resetcache" value="1">';

	// Sauvegarde / Restauration
	oblyon_print_backup_restore();
	clearstatcache();
	print '		<div class = "div-table-responsive-no-min">
					<table summary = "edit" class = "noborder centpercent editmode tableforfield as-settings-colors">';
	oblyon_print_colgroup(array('20%', '20%', '20%', '20%', '20%'));	// InfraS change : la ligne des vignettes de presets est remplacee par les cartes au-dessus du formulaire
	// Colors
	// Top menu
	$metas		= array(array(5), (!getDolGlobalString('MAIN_MENU_INVERT', '') ? 'TopMenu' : 'LeftMenu'));
	oblyon_print_liste_titre($metas);
	if (count($listcolor['top'])) {
		foreach ($listcolor['top'] as $key) {
			$transkey	= !getDolGlobalString('MAIN_MENU_INVERT', '') ? $key : str_replace('TOP', 'LEFT', $key);
			$metas	= array('type' => 'text', 'class' => 'flat quatrevingtpercent color action');
			oblyon_print_input($key, 'input', $langs->trans($transkey), '', $metas, 4, 1);
		}
	}
	// Left menu
	$metas		= array(array(5), (!getDolGlobalString('MAIN_MENU_INVERT', '') ? 'LeftMenu' : 'TopMenu'));
	oblyon_print_liste_titre($metas);
	if (count($listcolor['left'])) {
		foreach ($listcolor['left'] as $key) {
			$transkey	= !getDolGlobalString('MAIN_MENU_INVERT', '') ? $key : str_replace('LEFT', 'TOP', $key);
			$metas	= array('type' => 'text', 'class' => 'flat quatrevingtpercent color action');
			oblyon_print_input($key, 'input', $langs->trans($transkey), '', $metas, 4, 1);
		}
	}
	// button
	// une sous-section par famille (boutons d'action, bouton Supprimer, boutons de formulaire si couleurs propres), les cinq roles
	// (les styles Contour / Doux ont leur propre jeu de constantes, cf. oblyon_button_families()) ; chaque champ montre la couleur reellement appliquee
	// (oblyon_button_effective_colors()) : une couleur non modifiee reste automatique a l'enregistrement (cf. action update_), aide en infobulle sur le titre de chaque famille
	$metas		= array(array(5), 'Buttons');
	oblyon_print_liste_titre($metas);
	$formbtn	= new Form($db);
	$btnhelp	= $langs->trans('OblyonBtnGroupHelp', $langs->transnoentities('OblyonButtonStyle'.ucfirst(getDolGlobalString('OBLYON_BUTTON_STYLE', 'filled'))));
	$btncolors	= oblyon_button_effective_colors('', new User($db));	// couleurs de l'instance (utilisateur sans id), pas celles, personnelles, de l'admin connecte
	foreach (oblyon_button_families() as $familykey => $family) {
		print '<tr class="oddeven"><td colspan="5"><strong>'.$formbtn->textwithtooltip($langs->trans($family['label']), $btnhelp, 2, 1, img_help(1, '')).'</strong></td></tr>';
		foreach ($family['colors'] as $role => $key) {
			$metas	= array('type' => 'text', 'class' => 'flat quatrevingtpercent color action', 'value' => $btncolors[$familykey][$role]['hex']);
			oblyon_print_input($key, 'input', '&nbsp;&nbsp;&nbsp;'.$langs->trans('OblyonBtnRole'.ucfirst(str_replace('_', '', ucwords($role, '_')))), '', $metas, 4, 1);
		}
	}
	// message
	$metas		= array(array(5), 'Messages');
	oblyon_print_liste_titre($metas);
	if (count($listcolor['message'])) {
		foreach ($listcolor['message'] as $key) {
			$metas	= array('type' => 'text', 'class' => 'flat quatrevingtpercent color action');
			oblyon_print_input($key, 'input', $langs->trans($key), '', $metas, 4, 1);
		}
	}
	// Others - une section distincte par groupe (facilite la lecture / la recherche)
	foreach ($listcolor['options'] as $grouplabel => $groupkeys) {
		$metas		= array(array(5), $grouplabel);
		oblyon_print_liste_titre($metas);
		foreach ($groupkeys as $key) {
			if ($key == 'OBLYON_COLOR_BORDER_ACTIONCOLUMN' && !getDolGlobalString('FIX_STICKY_COLUMN_FIRST') && !getDolGlobalString('FIX_STICKY_COLUMN_LAST')) {
				continue;
			}
			if (! oblyon_tab_color_visible($key)) {	// groupe Onglets : seulement les couleurs du style d'onglets choisi (3.8.0)
				continue;
			}
			$metas	= array('type' => 'text', 'class' => 'flat quatrevingtpercent color action');
			oblyon_print_input($key, 'input', $langs->trans($key), '', $metas, 4, 1);
		}
	}
	$metas	= '	<div class = "range-sliders" id = "range-sliders">
					<span class = "bold">0</span>
					<input type = "range" class = "range-slider flat soixantepercent action" id = "THEME_INVERT_RATIO_FILTER" name = "THEME_INVERT_RATIO_FILTER" min = "0" max = "100" value = "'.getDolGlobalString('THEME_INVERT_RATIO_FILTER').'" />
					<input type = "number" class = "input-slider flat" id = "input-invert_ratio" style = "width: 35px;" min = "0" max = "100" value = "'.getDolGlobalString('THEME_INVERT_RATIO_FILTER').'" />
					<span class = "bold">+100</span>
					<script src = "../js/range-slider.js"></script>
				</div>';
	oblyon_print_input('', 'range', $langs->trans('InvertRatioDesc', getDolGlobalString('THEME_INVERT_RATIO_FILTER')), '', $metas, 4, 1);

	print '			</table>
				</div>';
	print dol_get_fiche_end();
	oblyon_print_btn_action('Gen');
	print '	</form>
			<br/>';
	// End of page
	llxFooter();
	$db->close();
