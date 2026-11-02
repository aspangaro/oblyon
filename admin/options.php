<?php
/************************************************
* Copyright (C) 2015-2025  Alexandre Spangaro   <alexandre@inovea-conseil.com>
* Copyright (C) 2022-2026  Sylvain Legrand      <contact@infras.fr>
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
* 	\file		../oblyon/admin/options.php
* 	\ingroup	oblyon
* 	\brief		Options Page < Oblyon Theme Configurator >
************************************************/

// Dolibarr environment *************************
require '../config.php';

// Libraries ************************************
require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';
dol_include_once('/oblyon/lib/oblyon.lib.php');
dol_include_once('/oblyon/backport/v21/core/lib/functions.lib.php');

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
if (! $user->admin)				accessforbidden();

// InfraS add begin : habillages (skins) de CKEditor installes sur l'instance - dossier selon la version de Dolibarr (24+ : public/includes, avant : includes),
// seuls les dossiers avec un editor.css comptent (skin.js n'existe pas pour l'habillage integre a ckeditor.js) ; l'option n'est proposee (et enregistree) que s'il y a le choix, avec le moteur CKEditor
$ckeditor_skins_dir				= DOL_DOCUMENT_ROOT.((float) DOL_VERSION >= 24.0 ? '/public' : '').'/includes/ckeditor/ckeditor/skins';
$ckeditor_skins					= array();
if (is_dir($ckeditor_skins_dir)) {
	foreach (dol_dir_list($ckeditor_skins_dir, 'directories', 0, '', null, 'name', SORT_ASC, 0, 1) as $ckeditor_skin_dir) {
		if (file_exists($ckeditor_skins_dir.'/'.$ckeditor_skin_dir['name'].'/editor.css'))	$ckeditor_skins[$ckeditor_skin_dir['name']]	= $ckeditor_skin_dir['name'];
	}
}
$ckeditor_skin_option			= (count($ckeditor_skins) > 1 && getDolGlobalString('FCKEDITOR_EDITORNAME', 'ckeditor') == 'ckeditor');
// InfraS add end

// Actions **************************************
$action							= GETPOST('action','alpha');
$result							= '';
// Sauvegarde / Restauration
if ($action == 'bkupParams')	$result	= oblyon_bkup_module ('oblyon');
if ($action == 'restoreParams')	$result	= oblyon_restore_module ('oblyon');
// On / Off management
if (preg_match('/set_(.*)/', $action, $reg)) {
	$confkey	= $reg[1];
	if (preg_match('/^(OBLYON_|THEME_|MAIN_|FIX_|DISABLE_)/', $confkey)) {
		$result		= dolibarr_set_const($db, $confkey, GETPOST('value', 'alphanohtml'), 'chaine', 0, 'Oblyon module', $conf->entity);
	}
}
	// Update buttons management
if (preg_match('/update_(.*)/', $action, $reg)) {
	$list									= array('Card'  => array('THEME_ELDY_FONT_SIZE1', 'OBLYON_IMAGE_HEIGHT_TABLE', 'THEME_FONT_FAMILY', 'MAIN_MAXTABS_IN_CARD', 'THEME_ELDY_BORDER_RADIUS', 'OBLYON_DENSITY', 'OBLYON_TABS_STYLE', 'OBLYON_BUTTON_STYLE', 'OBLYON_BADGE_STYLE', 'OBLYON_LIST_HEADER_STYLE', 'OBLYON_MOTION', 'OBLYON_AGENDA_STYLE'));	// options d'interface 3.8.0 (densite, style des onglets, des boutons, des badges, des en-tetes de liste, animations, agenda)
	if ($ckeditor_skin_option)				$list['Card'][]	= 'FCKEDITOR_SKIN';	// InfraS add : enregistre seulement quand le selecteur est affiche (sinon la constante serait videe)
	$confkey								= $reg[1];
	$error									= 0;
	foreach ($list[$confkey] as $constname)	$result	= dolibarr_set_const($db, $constname, GETPOST($constname, 'alpha'), 'chaine', 0, 'Oblyon module', $conf->entity);
	// "Affichage des statuts" (3.8.0) = un seul selecteur pour l'ancien interrupteur MAIN_STATUS_USES_IMAGES (icone) et le style de badge :
	// la valeur "icon" active les icones du core, toute autre valeur les desactive et choisit la forme du badge
	if ($result == 1 && GETPOSTISSET('OBLYON_BADGE_STYLE')) {
		$result	= dolibarr_set_const($db, 'MAIN_STATUS_USES_IMAGES', (GETPOST('OBLYON_BADGE_STYLE', 'alpha') == 'icon' ? '1' : '0'), 'chaine', 0, 'Oblyon module', $conf->entity);
	}
}
// migration (3.8.0) : l'ancien interrupteur "lignes de tableau plus espacees" (THEME_ELDY_USECOMOACTROW, G20) est remplace par la densite "confortable" (G3), puis supprime
if (getDolGlobalString('THEME_ELDY_USECOMOACTROW')) {
	if (getDolGlobalString('OBLYON_DENSITY', 'compact') == 'compact') {
		dolibarr_set_const($db, 'OBLYON_DENSITY', 'comfortable', 'chaine', 0, 'Oblyon module', $conf->entity);
	}
	dolibarr_del_const($db, 'THEME_ELDY_USECOMOACTROW', $conf->entity);
}
// Retour => message Ok ou Ko
if ($result == 1)			setEventMessages($langs->trans('SetupSaved'), null, 'mesgs');
if ($result == -1)			setEventMessages($langs->trans('Error'), null, 'errors');
$_SESSION['dol_resetcache']	= dol_print_date(dol_now(), 'dayhourlog');	// Reset cache

// init variables *******************************
// Liste des polices web standards
$font_options				= array ('system-ui'			=> $langs->trans('OblyonFontSystem'),	// InfraS add : pile de polices du systeme (rendu natif de l'OS)
									'Arial' 				=> 'Arial',
									'Arial Black' 			=> 'Arial Black',
									'Arial Narrow' 			=> 'Arial Narrow',
									'Calibri' 				=> 'Calibri',
									'Cambria' 				=> 'Cambria',
									'Candara' 				=> 'Candara',
									'Century Gothic' 		=> 'Century Gothic',
									'Comic Sans MS' 		=> 'Comic Sans MS',
									'Consolas' 				=> 'Consolas',
									'Courier New' 			=> 'Courier New',
									'Copperplate Gothic'	=> 'Copperplate Gothic',
									'Franklin Gothic'		=> 'Franklin Gothic',
									'Georgia' 				=> 'Georgia',
									'Gill Sans'				=> 'Gill Sans',
		    						'Helvetica' 			=> 'Helvetica',
									'Impact' 				=> 'Impact',
									'Lucida Console'		=> 'Lucida Console',
									'Lucida Sans'			=> 'Lucida Sans',
									'Microsoft Sans Serif'	=> 'Microsoft Sans Serif',
									'Open Sans' 			=> 'Open Sans',
									'Palatino Linotype' 	=> 'Palatino Linotype',
									'Sans-serif' 			=> 'Sans-serif',
									'Segoe UI'				=> 'Segoe UI',
									'Tahoma' 				=> 'Tahoma',
									'Times New Roman' 		=> 'Times New Roman',
		    						'Trebuchet MS' 			=> 'Trebuchet MS',
		    						'Verdana' 				=> 'Verdana',
									);
$currentFont				= getDolGlobalString('THEME_FONT_FAMILY', 'Arial');

// View *****************************************
$help_url = '';
$title = $langs->trans('OblyonOptionsTitle');

llxHeader('', $title, $help_url, '', 0, 0, '', '', 'mod-oblyon page-admin-options');

$linkback = '<a href = "'.DOL_URL_ROOT.'/admin/modules.php?restore_lastsearch_values=1">'.$langs->trans('BackToModuleList').'</a>';
print load_fiche_titre($title, $linkback, 'object_inovea.png@oblyon');

// Configuration header *************************
$head = oblyon_admin_prepare_head();

print dol_get_fiche_head($head, 'options', $title, -1);

// setup page goes here *************************
$easyaVersion = getDolGlobalFloat('EASYA_VERSION', 0);

$labs_picto = ' '.img_picto($langs->trans('WIP'), 'fa-flask', '', false, 0, 0, '', 'error ');

// accesskey is for Windows or Linux:  ALT + key for chrome, ALT + SHIFT + KEY for firefox
// accesskey is for Mac:               CTRL + key for all browsers
$stringforfirstkey = $langs->trans("KeyboardShortcut");
if ($conf->browser->os === 'macintosh') {
    $stringforfirstkey .= ' CTL +';
} else {
    if ($conf->browser->name == 'chrome') {
        $stringforfirstkey .= ' ALT +';
    } elseif ($conf->browser->name == 'firefox') {
        $stringforfirstkey .= ' ALT + SHIFT +';
    } else {
        $stringforfirstkey .= ' CTL +';
    }
}

print '	<script type = "text/javascript">
			$(document).ready(function() {
				$(".action").keyup(function(event) {
					if (event.which === 13)	$("#action").click();
				});
			});
		</script>

<form action = "'.dol_escape_htmltag($_SERVER['PHP_SELF']).'" method = "POST">
<input type="hidden" name="token" value="'.newToken().'" />
<input type="hidden" name="action" value="update">
<input type="hidden" name="page_y" value="">
<input type="hidden" name="dol_resetcache" value="1">';

// Sauvegarde / Restauration
oblyon_print_backup_restore();
clearstatcache();

print '<br>';

// Disclaimer
print '<table class="centpercent noborder">';
print '<tr>';
print '<td class="center">';
print '<h3>';
print img_picto('', 'warning') . ' ' . $langs->trans("ResetCacheDisclaimer");
print '</h3>';
print '</td>';
print '</tr>';
print '</table>';

print '<br>';

print '<div class = "div-table-responsive-no-min">';
/*
print '<table summary = "edit" class = "noborder centpercent editmode tableforfield">';
$metas = array('*', '156px', '300px');
oblyon_print_colgroup($metas);
*/

print '<table class="noborder centpercent">';
print '<tbody>';
print '<tr class="liste_titre">';
//print '<td width="20%">'.$langs->trans("Parameters").'</td>'."\n";
print '<td>'.$langs->trans("OptionsGeneral").'</td>'."\n";
print '<td width="10%" class="center"></td>'."\n";
print '<td width="20%" class="center">'.$langs->trans("Value").'</td>'."\n";
print "</tr>\n";

$countg = 1;

$metas = array('type' => 'number', 'class' => 'flat quatrevingtpercent right action', 'dir' => 'rtl', 'min' => '10', 'max' => '16');
oblyon_print_input('THEME_ELDY_FONT_SIZE1', 'input', 'G' . $countg . ' - ' . $langs->trans('OblyonFontSize') . ' (thème Eldy)', '', $metas, 2, 1);	// Font size
$countg++;

$form = new Form($db);
$metas = $form->selectarray('THEME_FONT_FAMILY', $font_options, $currentFont, 0, 0, 0, 'class = "fontsizeinherit nopadding cursorpointer"', 0, 0, 0, '', 'maxwidth200');
oblyon_print_input('THEME_FONT_FAMILY', 'select', 'G' . $countg . ' - ' . $langs->trans('OblyonFontFamily') . ' (thème Eldy)', '', $metas, 2, 1);
$countg++;

// densite de l'interface (3.8.0) : compact (rendu d'origine) / normal / comfortable, lue par themeoblyon/style.css.php
$density_options	= array('compact'		=> $langs->trans('OblyonDensityCompact'),
							'normal'		=> $langs->trans('OblyonDensityNormal'),
							'comfortable'	=> $langs->trans('OblyonDensityComfortable'));
$currentDensity		= getDolGlobalString('OBLYON_DENSITY', 'compact');
if (! isset($density_options[$currentDensity]))	$currentDensity	= 'compact';
$metas = $form->selectarray('OBLYON_DENSITY', $density_options, $currentDensity, 0, 0, 0, 'class = "fontsizeinherit nopadding cursorpointer"', 0, 0, 0, '', 'maxwidth200');
oblyon_print_input('OBLYON_DENSITY', 'select', 'G' . $countg . ' - ' . $langs->trans('OblyonDensity'), 'OblyonDensityHelp', $metas, 2, 1);	// aide en infobulle (4e parametre)
$countg++;

// style des onglets des fiches (3.8.0) : boxed (rendu d'origine) / underline / pills, lu par themeoblyon/style.css.php
$tabs_options	= array('boxed'		=> $langs->trans('OblyonTabsStyleBoxed'),
						'underline'	=> $langs->trans('OblyonTabsStyleUnderline'),
						'pills'		=> $langs->trans('OblyonTabsStylePills'));
$currentTabs	= getDolGlobalString('OBLYON_TABS_STYLE', 'boxed');
if (! isset($tabs_options[$currentTabs]))	$currentTabs	= 'boxed';
$metas = $form->selectarray('OBLYON_TABS_STYLE', $tabs_options, $currentTabs, 0, 0, 0, 'class = "fontsizeinherit nopadding cursorpointer"', 0, 0, 0, '', 'maxwidth200');
oblyon_print_input('OBLYON_TABS_STYLE', 'select', 'G' . $countg . ' - ' . $langs->trans('OblyonTabsStyle'), 'OblyonTabsStyleHelp', $metas, 2, 1);
$countg++;
if ($currentTabs == 'pills') {	// reglages propres aux pilules, affiches seulement quand ce style est choisi (les couleurs sont dans l'onglet Couleurs, groupe Onglets)
	$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('OBLYON_TAB_PILL_BORDER', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonTabPillBorder'), '', $metas, 2, 1);
	$countg++;
	$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('OBLYON_TAB_PILL_SHADOW', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonTabPillShadow'), '', $metas, 2, 1);
	$countg++;
}

// style des boutons (3.8.0) : filled (rendu d'origine) / outline / soft, applique aux boutons d'action, Supprimer et de formulaire ;
// les couleurs (fond, texte, bordure, survol) par famille sont dans l'onglet Couleurs, groupe Boutons, qui n'affiche que les roles utiles au style choisi
$button_options	= array('filled'	=> $langs->trans('OblyonButtonStyleFilled'),
						'outline'	=> $langs->trans('OblyonButtonStyleOutline'),
						'soft'		=> $langs->trans('OblyonButtonStyleSoft'));
$currentButton	= getDolGlobalString('OBLYON_BUTTON_STYLE', 'filled');
if (! isset($button_options[$currentButton]))	$currentButton	= 'filled';
$metas = $form->selectarray('OBLYON_BUTTON_STYLE', $button_options, $currentButton, 0, 0, 0, 'class = "fontsizeinherit nopadding cursorpointer"', 0, 0, 0, '', 'maxwidth200');
oblyon_print_input('OBLYON_BUTTON_STYLE', 'select', 'G' . $countg . ' - ' . $langs->trans('OblyonButtonStyle'), 'OblyonButtonStyleHelp', $metas, 2, 1);
$countg++;
$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('OBLYON_BUTTON_FORM_OWN_COLORS', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonButtonFormOwnColors'), 'OblyonButtonFormOwnColorsHelp', $metas, 2, 1);
$countg++;

// affichage des statuts (3.8.0) : un seul selecteur = icone du core (ex-interrupteur MAIN_STATUS_USES_IMAGES) ou badge pill (rendu d'origine) / outline / dot ;
// la valeur affichee vient de MAIN_STATUS_USES_IMAGES quand les icones sont actives, sinon de OBLYON_BADGE_STYLE (lue par themeoblyon/style.css.php ; couleurs : onglet Couleurs, groupe Badges de statut)
$badge_options	= array('icon'		=> $langs->trans('OblyonBadgeStyleIcon'),
						'pill'		=> $langs->trans('OblyonBadgeStylePill'),
						'outline'	=> $langs->trans('OblyonBadgeStyleOutline'),
						'dot'		=> $langs->trans('OblyonBadgeStyleDot'));
$currentBadge	= getDolGlobalString('MAIN_STATUS_USES_IMAGES') ? 'icon' : getDolGlobalString('OBLYON_BADGE_STYLE', 'pill');
if (! isset($badge_options[$currentBadge]))	$currentBadge	= 'pill';
$metas = $form->selectarray('OBLYON_BADGE_STYLE', $badge_options, $currentBadge, 0, 0, 0, 'class = "fontsizeinherit nopadding cursorpointer"', 0, 0, 0, '', 'maxwidth200');
oblyon_print_input('OBLYON_BADGE_STYLE', 'select', 'G' . $countg . ' - ' . $langs->trans('OblyonBadgeStyle'), 'OblyonBadgeStyleHelp', $metas, 2, 1);
$countg++;
$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('OBLYON_STATUS_PULSE', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonStatusPulse'), 'OblyonStatusPulseHelp', $metas, 2, 1);	// pulsation du statut de la fiche ouverte
$countg++;
// animations (3.8.0) : normal (le reglage du poste est toujours respecte) / reduced, appliquee par themeoblyon/motion.inc.php a toutes les transitions et animations du theme
$motion_options	= array('normal'	=> $langs->trans('OblyonMotionNormal'),
						'reduced'	=> $langs->trans('OblyonMotionReduced'));
$currentMotion	= getDolGlobalString('OBLYON_MOTION', 'normal');
if ($currentMotion == 'none')	$currentMotion	= 'reduced';
if (! isset($motion_options[$currentMotion]))	$currentMotion	= 'normal';
$metas = $form->selectarray('OBLYON_MOTION', $motion_options, $currentMotion, 0, 0, 0, 'class = "fontsizeinherit nopadding cursorpointer"', 0, 0, 0, '', 'maxwidth200');
oblyon_print_input('OBLYON_MOTION', 'select', 'G' . $countg . ' - ' . $langs->trans('OblyonMotion'), 'OblyonMotionHelp', $metas, 2, 1);
$countg++;
// centre de notifications (3.8.0) : cloche en haut a droite (hook printTopRightMenu), contenu gere par js/oblyon.js dans le navigateur
$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('OBLYON_NOTIFICATION_CENTER', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonNotifCenter'), 'OblyonNotifCenterHelp', $metas, 2, 1);
$countg++;
// agenda natif (3.8.0) : classic (rendu d'origine) / modern, lu par themeoblyon/style.css.php (widgets.inc.php + js/oblyon.js)
$agenda_options	= array('classic'	=> $langs->trans('OblyonAgendaStyleClassic'),
						'modern'	=> $langs->trans('OblyonAgendaStyleModern'));
$currentAgenda	= getDolGlobalString('OBLYON_AGENDA_STYLE', 'classic');
if (! isset($agenda_options[$currentAgenda]))	$currentAgenda	= 'classic';
$metas = $form->selectarray('OBLYON_AGENDA_STYLE', $agenda_options, $currentAgenda, 0, 0, 0, 'class = "fontsizeinherit nopadding cursorpointer"', 0, 0, 0, '', 'maxwidth200');
oblyon_print_input('OBLYON_AGENDA_STYLE', 'select', 'G' . $countg . ' - ' . $langs->trans('OblyonAgendaStyle'), 'OblyonAgendaStyleHelp', $metas, 2, 1);
$countg++;

$metas = array('type' => 'number', 'class' => 'flat quatrevingtpercent right action', 'dir' => 'rtl', 'min' => '24', 'max' => '128');
oblyon_print_input('OBLYON_IMAGE_HEIGHT_TABLE', 'input', 'G' . $countg . ' - ' . $langs->trans('OblyonImageHeightTable'), '', $metas, 2, 1);	// Max height for Image on table list
$countg++;

$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('OBLYON_DISABLE_VERSION', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonDisableVersion'), '', $metas, 2, 1);	// Disable version of Dolibarr
$countg++;

// l'interrupteur MAIN_STATUS_USES_IMAGES (statuts en icones) est fusionne dans le selecteur "Affichage des statuts" ci-dessus (3.8.0)

$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonMainUseQuickAddDropdown') . ' (' . $stringforfirstkey . ' a)', '', $metas, 2, 1);	// Quickadd dropdown menu
$countg++;

$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('MAIN_USE_TOP_MENU_SEARCH_DROPDOWN', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonMainUseSearchDropdown') . ' (' . $stringforfirstkey . ' s)', '', $metas, 2, 1);	// Search dropdown menu
$countg++;

if (isModEnabled('bookmark')) {
	$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('MAIN_USE_TOP_MENU_BOOKMARK_DROPDOWN', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonMainUseBookmarkDropdown'), '', $metas, 2, 1);    // Bookmark dropdown menu
    $countg++;
}

$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('OBLYON_PADDING_RIGHT_BOTTOM', 'on_off', 'G' . $countg . ' - ' . $langs->trans('OblyonPaddingRightBottom'), '', $metas, 2, 1);	// Add padding on bottom
$countg++;

$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 1, '', 'options');
oblyon_print_input('THEME_ADD_BACKGROUND_ON_INPUT', 'on_off', 'G' . $countg . ' - ' . $langs->trans('ThemeAddBackgroundOnInput') . ' (thème Eldy)', '', $metas, 2, 1);	// A7
$countg++;

$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 1, '', 'options');
oblyon_print_input('THEME_ELDY_USEBORDERONTABLE', 'on_off', 'G' . $countg . ' - ' . $langs->trans('ThemeUseBorderOnTable') . ' (thème Eldy)', '', $metas, 2, 1);	// B1
$countg++;

$metas = array('type' => 'number', 'class' => 'flat quatrevingtpercent right action', 'dir' => 'rtl', 'min' => '0', 'max' => '30');
oblyon_print_input('THEME_ELDY_BORDER_RADIUS', 'input', 'G' . $countg . ' - ' . $langs->trans('ThemeBorderRadius') . ' (thème Eldy)', '', $metas, 2, 1);	// B1
$countg++;

$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 1, '', 'options');
oblyon_print_input('THEME_ELDY_SHADOW_ON_SMALL_BOXES', 'on_off', 'G' . $countg . ' - ' . $langs->trans('ThemeShadowOnSmallBoxes') . ' (thème Eldy)', '', $metas, 2, 1);	// B2
$countg++;

$metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 1, '', 'options');
oblyon_print_input('THEME_ELDY_TOTAL_BACKGROUND_LIKE_HEAD', 'on_off', 'G' . $countg . ' - ' . $langs->trans('ThemeTotalBackgroundLikeHead') . ' (thème Eldy)', '', $metas, 2, 1);	// B3
$countg++;

// l'interrupteur THEME_ELDY_USECOMOACTROW (lignes de tableau plus espacees, B4) est remplace par la densite de l'interface (G3) et migre en tete de page (3.8.0)


/* Login
$metas	= array(array(3), 'OblyonLogin');
oblyon_print_liste_titre($metas);
$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('MAIN_LOGIN_RIGHT', 'on_off', $langs->trans('LoginRight'), '', $metas, 2, 1);	// Login box on the right
*/

print '</tbody>';
print '</table>';
print '<br>';

print '<table class="noborder centpercent">';
print '<tbody>';
print '<tr class="liste_titre">';
//print '<td width="20%">'.$langs->trans("Parameters").'</td>'."\n";
print '<td>'.$langs->trans("OptionsList").'</td>'."\n";
print '<td width="10%" class="center"></td>'."\n";
print '<td width="20%" class="center">'.$langs->trans("Value").'</td>'."\n";
print "</tr>\n";

$countl = 1;

// style des en-tetes de liste (3.8.0) : band (bande coloree, rendu d'origine) / flat, lu par themeoblyon/style.css.php (couleurs du style plat : onglet Couleurs, groupe Titres)
$listhead_options	= array('band'	=> $langs->trans('OblyonListHeaderStyleBand'),
							'flat'	=> $langs->trans('OblyonListHeaderStyleFlat'));
$currentListhead	= getDolGlobalString('OBLYON_LIST_HEADER_STYLE', 'band');
if (! isset($listhead_options[$currentListhead]))	$currentListhead	= 'band';
$metas = $form->selectarray('OBLYON_LIST_HEADER_STYLE', $listhead_options, $currentListhead, 0, 0, 0, 'class = "fontsizeinherit nopadding cursorpointer"', 0, 0, 0, '', 'maxwidth200');
oblyon_print_input('OBLYON_LIST_HEADER_STYLE', 'select', 'L' . $countl . ' - ' . $langs->trans('OblyonListHeaderStyle'), 'OblyonListHeaderStyleHelp', $metas, 2, 1);
$countl++;

if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 18.0) {
    // Select Column on left - MAIN_CHECKBOX_LEFT_COLUMN
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('MAIN_CHECKBOX_LEFT_COLUMN', 'on_off', 'L' . $countl . ' - ' . $langs->trans('SwitchColunmOnLeft'), '', $metas, 2, 1);
    $countleftcheckbox = $countl;
    $countl++;
}
if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 18.0) {
    // Sticky title, pagination and "Add" element in list - FIX_TITLE_IN_LIST
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_TITLE_IN_LIST', 'on_off', 'L' . $countl . ' - ' . $langs->trans('FixTitleInList') . $labs_picto, '', $metas, 2, 1);
    $countl++;
}
if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 19.0) {
    // Remove Kanban view in list - DISABLE_KANBAN_VIEW_IN_LIST
    // Migration ancienne constante -> nouvelle, puis suppression de l'ancienne
    if (getDolGlobalString('OBLYON_DISABLE_KANBAN_VIEW_IN_LIST')) {
        if (!getDolGlobalString('DISABLE_KANBAN_VIEW_IN_LIST')) {
            dolibarr_set_const($db, 'DISABLE_KANBAN_VIEW_IN_LIST', getDolGlobalString('OBLYON_DISABLE_KANBAN_VIEW_IN_LIST'), 'chaine', 0, 'Oblyon module', $conf->entity);
        }
        dolibarr_del_const($db, 'OBLYON_DISABLE_KANBAN_VIEW_IN_LIST', $conf->entity);
    }

    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('DISABLE_KANBAN_VIEW_IN_LIST', 'on_off', 'L' . $countl . ' - ' . $langs->trans('RemoveKanbanViewInList'), '', $metas, 2, 1);    // Remove button kanban view in list
    $countl++;
}
if ($easyaVersion >= "2022.5.2" || (float) DOL_VERSION >= 17.0) {
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_STICKY_HEADER_CARD', 'on_off', 'L' . $countl . ' - ' . $langs->trans('FixStickyTableHeadersColumns'), '', $metas, 2, 1);    // Sticky table headers columns
    $countl++;
}
if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 17.0) {
    // Old Compatibility
    if (getDolGlobalString('OBLYON_STICKY_COLUMN_FIRST')) {
        getDolGlobalString('FIX_STICKY_COLUMN_FIRST') == 1;
    }

    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_STICKY_COLUMN_FIRST', 'on_off', 'L' . $countl . ' - ' . $langs->trans('FixStickyFirstColumn'), '', $metas, 2, 1);    // Sticky table first column
    $countl++;
}
if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 17.0) {
    // Old Compatibility
    if (getDolGlobalString('OBLYON_STICKY_COLUMN_LAST')) {
        getDolGlobalString('FIX_STICKY_COLUMN_LAST') == 1;
    }

    $msgleftcheckbox = !empty($countleftcheckbox) ? ' (<i>'.$langs->trans("WarningActivationOption1Enabled", 'L'.$countleftcheckbox).'</i>)' : '';
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_STICKY_COLUMN_LAST', 'on_off', 'L' . $countl . ' - ' . $langs->trans('FixStickyLastColumn') . $msgleftcheckbox, '', $metas, 2, 1);    // Sticky table last column
    $countl++;
}
if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 16.0) {
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_STICKY_TOTAL_BAR', 'on_off', 'L' . $countl . ' - ' . $langs->trans('FixStickyTotalBar'), '', $metas, 2, 1);    // Sticky table last column
    $countl++;
}
if ($easyaVersion >= "2026.0.0" || (float) DOL_VERSION >= 20.0) {
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('MAIN_GRANDTOTAL_LIST_SHOW', 'on_off', 'L' . $countl . ' - ' . $langs->trans('ShowGrandTotalList'). ' (<i>'. $langs->trans("NotAvailableOnAllLists") . '</i>) ' . $labs_picto, '', $metas, 2, 1);    // Sticky table last column
    $countl++;
}
if (getDolGlobalString('MAIN_GRANDTOTAL_LIST_SHOW')) {
    if ($easyaVersion >= "2026.0.0" || (float)DOL_VERSION >= 20.0) {
        $metas = array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
        oblyon_print_input('FIX_STICKY_GRANDTOTAL_BAR', 'on_off', 'L' . $countl . ' - ' . $langs->trans('FixStickyGrandTotalBar') . $labs_picto, '', $metas, 2, 1);    // Sticky table last column
        $countl++;
    }
}
print '</tbody>';
print '</table>';
print '<br>';

print '<table class="noborder centpercent">';
print '<tbody>';
print '<tr class="liste_titre">';
//print '<td width="20%">'.$langs->trans("Parameters").'</td>'."\n";
print '<td>'.$langs->trans("OptionsCard").'</td>'."\n";
print '<td width="10%" class="center"></td>'."\n";
print '<td width="20%" class="center">'.$langs->trans("Value").'</td>'."\n";
print "</tr>\n";

$countc = 1;

if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 17.0) {
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_STICKY_TABS_CARD', 'on_off', 'C' . $countc . ' - ' . $langs->trans('FixStickyTabsCard'), '', $metas, 2, 1);    // Sticky table headers columns
    $countc++;
}

if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 17.0) {
    // Old Compatibility
    if (getDolGlobalString('FIX_AREAREF_TABACTION')) {
        getDolGlobalString('FIX_AREAREF_CARD') == 1;
    }

    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_AREAREF_CARD', 'on_off', 'C' . $countc . ' - ' . $langs->trans('FixAreaRefCard'), '', $metas, 2, 1);    // Sticky table headers columns
    $countc++;
}

if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 17.0) {
    $txt = getDolGlobalString('FIX_AREAREF_CARD') && getDolGlobalString('FIX_STICKY_TABS_CARD') ? ' '.$langs->trans('LimitTabLineToOne') : '';
    $metas = array('type' => 'number', 'class' => 'flat quatrevingtpercent right action', 'dir' => 'rtl', 'min' => '8', 'max' => '50');
    oblyon_print_input('MAIN_MAXTABS_IN_CARD', 'input', 'C' . $countc . ' - ' . $langs->trans('MainMaxTabsInCard').$txt, '', $metas, 2, 1);	// Max tabs in card
    $countc++;
}

if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 14.0) {
    // Old Compatibility
    if (getDolGlobalString('FIX_AREAREF_TABACTION')) {
        getDolGlobalString('FIX_ABSOLUTE_BUTTONS_ACTION_CARD') == 1;
    }

    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('FIX_ABSOLUTE_BUTTONS_ACTION_CARD', 'on_off', 'C' . $countc . ' - ' . $langs->trans('FixAbsoluteButtonsActionCard'), '', $metas, 2, 1);    // Sticky table headers columns
    $countc++;
}

if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 18.0) {
    $metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
    oblyon_print_input('MAIN_VIEW_LINE_NUMBER', 'on_off', 'C' . $countc . ' - ' . $langs->trans('ShowLineNumberCard'), '', $metas, 2, 1);    // Sticky table headers columns
    $countc++;
}

print '</tbody>';
print '</table>';
print '<br>';


print '<table class="noborder centpercent">';
print '<tbody>';
print '<tr class="liste_titre">';
print '<td>'.$langs->trans("OptionsCKEditor").'</td>'."\n";
print '<td width="10%" class="center"></td>'."\n";
print '<td width="20%" class="center">'.$langs->trans("Value").'</td>'."\n";
print "</tr>\n";

$countk = 1;

$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('FCKEDITOR_ALLOW_ANY_CONTENT', 'on_off', 'K' . $countk . ' - ' . $langs->trans('FckeditorAllowAnyContent'), '', $metas, 2, 1);    // Allow to enter any content. However, this will totally disable content filtering which is one of the most important CKEditor features. You can use this to keep all your tags and attributes in the html content
$countk++;

$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('FCKEDITOR_ENABLE_SCAYT_AUTOSTARTUP', 'on_off', 'K' . $countk . ' - ' . $langs->trans('FckeditorEnableScaytAutostartup'), '', $metas, 2, 1);    // Allow to activate the SpellCheckAsYouType (SCAYT) plugins of CKEditor i.e an automatic spell checking
$countk++;

$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
oblyon_print_input('MAIN_SECURITY_ALLOW_UNSECURED_LABELS_WITH_HTML', 'on_off', 'K' . $countk . ' - ' . $langs->trans('MainSecurityAllowUnsecuredLabelsWithHtml').  ' (<i>'. $langs->trans("NotRecommended") . '</i>)', '', $metas, 2, 1);    // Allow HTML tags into products label
$countk++;

// InfraS add begin : habillage de CKEditor, seulement s'il y a le choix (voir $ckeditor_skins en tete de page)
if ($ckeditor_skin_option) {
	$currentSkin	= getDolGlobalString('FCKEDITOR_SKIN', 'moono-lisa');
	$warning		= !isset($ckeditor_skins[$currentSkin]) ? '<br><span class="warning">'.$langs->trans('FckeditorSkinMissing', $currentSkin).'</span>' : '';
	$metas			= $form->selectarray('FCKEDITOR_SKIN', $ckeditor_skins, $currentSkin, 0, 0, 0, 'class = "fontsizeinherit nopadding cursorpointer"', 0, 0, 0, '', 'maxwidth200');
	oblyon_print_input('FCKEDITOR_SKIN', 'select', 'K' . $countk . ' - ' . $langs->trans('FckeditorSkin') . $warning, 'FckeditorSkinHelp', $metas, 2, 1);	// CKEditor skin ; aide en infobulle, l'avertissement (habillage absent) reste visible
	$countk++;
}
// InfraS add end

print '</tbody>';
print '</table>';
print '<br>';

oblyon_print_btn_action('Card');

print '<br>';
print '</div>';

print dol_get_fiche_end();

print '</form>';

llxFooter();
$db->close();
