<?php
/************************************************
	* Copyright (C) 2026  Sylvain Legrand      <contact@infras.fr>
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
* 	\file		../oblyon/admin/takepos.php
* 	\ingroup	oblyon
* 	\brief		TakePOS Page < Oblyon Theme Configurator > (InfraS add : fichier ajoute par InfraS (2026-10), 3.9.0)
************************************************/

// Dolibarr environment *************************
require '../config.php';

// Libraries ************************************
require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
dol_include_once('/oblyon/backport/v21/core/lib/functions.lib.php');
dol_include_once('/oblyon/lib/oblyon.lib.php');

/**
 * @var Conf $conf
 * @var DoliDB $db
 * @var HookManager $hookmanager
 * @var Translate $langs
 * @var User $user
 */

// Translations *********************************
$langs->loadLangs(array('admin', 'oblyon@oblyon', 'inovea@oblyon'));

// Access control *******************************
if (! $user->admin)				accessforbidden();

// Actions **************************************
$action							= GETPOST('action', 'alpha');
$result							= '';
$takepos_themes					= array('native', 'classic', 'counter', 'tablet', 'scanner');	// themes de la caisse (3.9.0) ; la liste est aussi controlee par ActionsOblyon::takeposTheme() et par themeoblyon/modules/takepos.inc.php
// Sauvegarde / Restauration
if ($action == 'bkupParams')	$result	= oblyon_bkup_module('oblyon');
if ($action == 'restoreParams')	$result	= oblyon_restore_module('oblyon');
// On / Off management (repli sans JavaScript de ajax_constantonoff) : constantes de cet onglet seulement
if (preg_match('/set_(.*)/', $action, $reg)) {
	$confkey	= $reg[1];
	if (preg_match('/^OBLYON_TAKEPOS_/', $confkey)) {
		$result		= dolibarr_set_const($db, $confkey, GETPOST('value', 'alphanohtml'), 'chaine', 0, 'Oblyon module', $conf->entity);
	}
}
// Theme de la caisse : les regles du theme ne sont imprimees dans la feuille du theme que pour le theme choisi ; quand il change,
// la revision de la feuille (MAIN_IHM_PARAMS_REV) est incrementee pour que le cache de 3 heures du navigateur soit renouvele
if ($action == 'update_TakePOS') {
	$theme	= GETPOST('OBLYON_TAKEPOS_THEME', 'aZ09');
	if (!in_array($theme, $takepos_themes, true)) {
		$theme	= 'native';
	}
	$changed	= ($theme !== getDolGlobalString('OBLYON_TAKEPOS_THEME', 'native'));
	$result		= dolibarr_set_const($db, 'OBLYON_TAKEPOS_THEME', $theme, 'chaine', 0, 'Oblyon module', $conf->entity);
	if ($result > 0 && $changed) {
		dolibarr_set_const($db, 'MAIN_IHM_PARAMS_REV', getDolGlobalInt('MAIN_IHM_PARAMS_REV') + 1, 'chaine', 0, '', $conf->entity);
	}
	// remises rapides de la barre de paiement : au plus 4 pourcentages entre 0 et 100, sinon valeurs par defaut
	$discounts	= array();
	foreach (explode(',', GETPOST('OBLYON_TAKEPOS_QUICK_DISCOUNTS', 'alphanohtml')) as $value) {
		$value	= str_replace(' ', '', $value);
		if ($value !== '' && is_numeric($value) && (float) $value >= 0 && (float) $value <= 100 && count($discounts) < 4) {
			$discounts[]	= $value;
		}
	}
	if (empty($discounts)) {
		$discounts	= array('5', '10', '20');
	}
	if (dolibarr_set_const($db, 'OBLYON_TAKEPOS_QUICK_DISCOUNTS', implode(',', $discounts), 'chaine', 0, 'Oblyon module', $conf->entity) < 0) {
		$result	= -1;
	}
	// nouvelle vente automatique apres le paiement (dispositions Comptoir, Tablette, Superette) : 0 a 60 secondes, 0 = jamais
	$autonew	= max(0, min(60, (int) GETPOST('OBLYON_TAKEPOS_AUTO_NEW_SALE', 'int')));
	if (dolibarr_set_const($db, 'OBLYON_TAKEPOS_AUTO_NEW_SALE', (string) $autonew, 'chaine', 0, 'Oblyon module', $conf->entity) < 0) {
		$result	= -1;
	}
}
// Retour => message Ok ou Ko
if ($result == 1)			setEventMessages($langs->trans('SetupSaved'), null, 'mesgs');
if ($result == -1)			setEventMessages($langs->trans('Error'), null, 'errors');
$_SESSION['dol_resetcache']	= dol_print_date(dol_now(), 'dayhourlog');	// Reset cache

// View *****************************************
$page_name = $langs->trans('OblyonTakeposTitle');
$help_url = '';
llxHeader('', $page_name, $help_url, '', 0, 0, '', '', '', 'mod-oblyon page-admin_takepos');

$linkback = '<a href = "'.DOL_URL_ROOT.'/admin/modules.php?restore_lastsearch_values=1">'.$langs->trans('BackToModuleList').'</a>';
print load_fiche_titre($page_name, $linkback, 'object_inovea.png@oblyon');

// Configuration header *************************
$head = oblyon_admin_prepare_head();
print dol_get_fiche_head($head, 'takepos', $langs->trans('Module432573Name'), -1, "title_setup");

// setup page goes here *************************
if (!isModEnabled('takepos')) {
	print '<div class = "bloc_warning centpercent center">'.img_warning().' '.$langs->trans('OblyonTakeposModuleDisabled').'</div>';
	print dol_get_fiche_end();
	llxFooter();
	$db->close();
	exit;
}
// Alert
if (!defined('MAIN_MODULE_OBLYON') && $conf->theme != 'oblyon') {
	print '<div class = "bloc_warning centpercent center">'.img_warning().' '.$langs->trans('OblyonErrorMessage').'</div>';
} else {
	print '<div class = "bloc_success centpercent center">'.$langs->trans('OblyonSuccessMessage').'</div>';
}
print '<form action = "'.dol_escape_htmltag($_SERVER['PHP_SELF']).'" method = "POST">
				<input type="hidden" name="token" value="'.newToken().'" />
				<input type="hidden" name="action" value="update">
				<input type="hidden" name="page_y" value="">
				<input type="hidden" name="dol_resetcache" value="1">';

// Sauvegarde / Restauration
oblyon_print_backup_restore();
clearstatcache();
print '<div class = "div-table-responsive-no-min">';
print '<table summary = "edit" class = "noborder centpercent editmode tableforfield">';
$metas		= array('*', '156px', '300px');
oblyon_print_colgroup($metas);
$metas		= array(array(3), 'OblyonTakeposTitle');
oblyon_print_liste_titre($metas);
// Theme de la caisse ; avertissements : theme Colorful de TakePOS actif (ses 9 regles !important sont neutralisees par le theme choisi),
// module pas encore reactive depuis la 3.9.0 (contexte de hook takeposinvoice absent : pas de boutons -/+ sur les lignes du ticket)
$current	= getDolGlobalString('OBLYON_TAKEPOS_THEME', 'native');
$warning	= getDolGlobalInt('TAKEPOS_COLOR_THEME') == 1 && $current != 'native' ? '<br><span class = "warning">'.$langs->trans('OblyonTakeposColorfulWarning').'</span>' : '';
$hookctx	= isset($conf->modules_parts['hooks']['oblyon']) ? (array) $conf->modules_parts['hooks']['oblyon'] : array();
$warning	.= $current != 'native' && !in_array('takeposinvoice', $hookctx, true) ? '<br><span class = "warning">'.$langs->trans('OblyonTakeposReactivateWarning').'</span>' : '';
$formpos	= new Form($db);
$pos_themes	= array();
foreach ($takepos_themes as $key) {
	$pos_themes[$key]	= $langs->trans('OblyonTakeposTheme'.ucfirst($key));
}
$metas		= $formpos->selectarray('OBLYON_TAKEPOS_THEME', $pos_themes, $current, 0, 0, 0, 'class = "fontsizeinherit nopadding cursorpointer"', 0, 0, 0, '', 'maxwidth250');
oblyon_print_input('OBLYON_TAKEPOS_THEME', 'select', $langs->trans('OblyonTakeposTheme').$warning, 'OblyonTakeposThemeHelp', $metas, 2, 1);	// POS theme
// Remises rapides (enregistrees avec le theme)
$metas		= array('value' => dol_escape_htmltag(getDolGlobalString('OBLYON_TAKEPOS_QUICK_DISCOUNTS', '5,10,20')), 'class' => 'flat maxwidth150 center');
oblyon_print_input('OBLYON_TAKEPOS_QUICK_DISCOUNTS', 'input', $langs->trans('OblyonTakeposQuickDiscounts'), 'OblyonTakeposQuickDiscountsHelp', $metas, 2, 1);	// Quick discounts
// Nouvelle vente automatique apres le paiement (enregistree avec le theme)
$metas		= array('type' => 'number', 'min' => '0', 'max' => '60', 'value' => (string) getDolGlobalInt('OBLYON_TAKEPOS_AUTO_NEW_SALE', 5), 'class' => 'flat maxwidth75 center');
oblyon_print_input('OBLYON_TAKEPOS_AUTO_NEW_SALE', 'input', $langs->trans('OblyonTakeposAutoNewSale'), 'OblyonTakeposAutoNewSaleHelp', $metas, 2, 1);	// Automatic new sale
// Couleurs des categories (enregistre en ajax, rechargement de la page)
$metas		= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'takepos');
oblyon_print_input('OBLYON_TAKEPOS_CATEGORY_COLORS', 'on_off', $langs->trans('OblyonTakeposCategoryColors'), 'OblyonTakeposCategoryColorsHelp', $metas, 2, 1);	// Category colours
// Lien vers les autres reglages d'affichage du module TakePOS
print '<tr class = "oddeven"><td colspan = "3"><a href = "'.DOL_URL_ROOT.'/takepos/admin/appearance.php">'.img_picto('', 'setup', 'class = "pictofixedwidth"').$langs->trans('OblyonTakeposSetupLink').'</a></td></tr>';
print '				</table>
				</div>';
print dol_get_fiche_end();
oblyon_print_btn_action('TakePOS');
print '	</form>
		<br/>';

// End of page
llxFooter();
$db->close();
