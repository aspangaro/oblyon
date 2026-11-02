<?php
/* Copyright (C) 2022 Paul LEPONT           <paul@kawagency.fr>
/* Copyright (C) 2022 Alexandre Spangaro    <alexandre@inovea-conseil.com>
/* Copyright (C) 2022-2026  Sylvain Legrand      <contact@infras.fr>
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
 */

/**
 * Class ActionsOblyon
 */
class ActionsOblyon
{
	/**
	 * @var DoliDB Database handler.
	 */
	public $db;

	/**
	 * @var string Error code (or message)
	 */
	public $error = '';

	/**
	 * @var array Errors
	 */
	public $errors = array();


	/**
	 * @var array Hook results. Propagated to $hookmanager->resArray for later reuse
	 */
	public $results = array();

	/**
	 * @var string String displayed by executeHook() immediately after return
	 */
	public $resprints;

	/**
	 * Constructor
	 *
	 *  @param		DoliDB		$db      Database handler
	 */
	public function __construct($db)
	{
		$this->db = $db;
	}

	// couleurs par utilisateur (3.6.0) : l'onglet "Couleurs" declare par le descripteur est ajoute en fin de liste par
	// complete_head_from_modules() ; ce hook le deplace juste apres l'onglet core "Interface utilisateur" (guisetup) de la fiche utilisateur
	/**
	 * Overloading the completeTabsHead function : reorder the tabs of the user card
	 *
	 * @param	array		$parameters		Hook metadata (object, mode, head (by reference), filterorigmodule ; type only in Dolibarr >= 24)
	 * @param	object		$object			Current object
	 * @param	string		$action			Current action
	 * @param	HookManager	$hookmanager	Hook manager
	 * @return	int							0 = head modified in place, nothing to merge
	 */
	public function completeTabsHead($parameters, &$object, &$action, $hookmanager)
	{
		// 'type' is only given by Dolibarr >= 24 : the user card is recognised by its core "guisetup" tab and our own tab (both present only there)
		if (empty($parameters['mode']) || $parameters['mode'] != 'add' || empty($parameters['head']) || !is_array($parameters['head'])) {
			return 0;
		}
		$head	= $parameters['head'];
		$ours	= null;
		foreach ($head as $key => $tab) {
			if (isset($tab[2]) && $tab[2] == 'oblyoncolors') {
				$ours	= $tab;
				unset($head[$key]);
				break;
			}
		}
		if ($ours === null) {
			return 0;
		}
		$newhead	= array();
		$placed		= false;
		foreach ($head as $tab) {
			$newhead[]	= $tab;
			if (!$placed && isset($tab[2]) && $tab[2] == 'guisetup') {
				$newhead[]	= $ours;
				$placed		= true;
			}
		}
		if (!$placed) {
			$newhead[]	= $ours;	// no "Display setup" tab (should not happen) : keep it at the end
		}
		$parameters['head']	= $newhead;	// 'head' is passed by reference by complete_head_from_modules()
		return 0;
	}

	// zone haut-droite (3.8.0), deux options imprimees dans div.login_block_other juste avant le bloc utilisateur du core :
	// - OBLYON_USER_BLOCK (initials / photo) : marqueur cache (mode, initiales, photo renseignee ou non) lu par js/oblyon.js, qui remplace dans le navigateur les deux
	//   images du bloc utilisateur (barre et en-tete du menu deroulant) par un cercle aux initiales ; le menu deroulant redessine est du CSS pur (dropdown.inc.php)
	// - OBLYON_NOTIFICATION_CENTER : cloche ; le contenu (messages jNotify interceptes, compteur, liste, marquage lu) est entierement gere par js/oblyon.js dans le
	//   navigateur (localStorage par utilisateur) : aucune table, aucun appel serveur. Les libelles passent au JS par des attributs data-lbl-* (aucun texte en dur dans le script)
	/**
	 * Overloading the printTopRightMenu function : print the user block marker and the notification bell
	 *
	 * @param	array		$parameters		Hook metadata (context, etc...)
	 * @param	object		$object			Current object
	 * @param	string		$action			Current action
	 * @param	HookManager	$hookmanager	Hook manager
	 * @return	int							0 = output added to the top right area
	 */
	public function printTopRightMenu($parameters, &$object, &$action, $hookmanager)
	{
		global $conf, $langs, $user;

		if (empty($user->id) || empty($conf->use_javascript_ajax) || GETPOST('optioncss', 'aZ09') == 'print') {
			return 0;
		}
		$out		= '';
		$userblock	= getDolGlobalString('OBLYON_USER_BLOCK', 'default');
		if ($userblock == 'initials' || $userblock == 'photo') {
			$initials	= dol_substr(trim((string) $user->firstname), 0, 1).dol_substr(trim((string) $user->lastname), 0, 1);	// prenom + nom, sinon les deux premieres lettres de l'identifiant
			if (dol_strlen($initials) < 2) {
				$initials	= dol_substr(trim((string) $user->login), 0, 2);
			}
			$out	.= '<span class="oblyon-userblock" hidden data-mode="'.$userblock.'" data-initials="'.dol_escape_htmltag(dol_strtoupper($initials)).'" data-hasphoto="'.(empty($user->photo) ? '0' : '1').'"></span>';
		}
		if (getDolGlobalInt('OBLYON_NOTIFICATION_CENTER')) {
			$langs->load('oblyon@oblyon');
			$labels	= array('title' => 'OblyonNotifTitle', 'empty' => 'OblyonNotifEmpty', 'markread' => 'OblyonNotifMarkRead', 'clear' => 'OblyonNotifClear',
							'delete' => 'OblyonNotifDelete', 'now' => 'OblyonNotifNow', 'min' => 'OblyonNotifMin', 'hour' => 'OblyonNotifHour', 'day' => 'OblyonNotifDay');
			$out	.= '<div class="login_block_elem oblyon-notif" data-userid="'.((int) $user->id).'"';
			foreach ($labels as $key => $transkey) {
				$out	.= ' data-lbl-'.$key.'="'.dol_escape_htmltag($langs->transnoentitiesnoconv($transkey, '%s')).'"';	// '%s' passe en argument : trans() fait un sprintf, le %s des libelles relatifs est conserve pour le JS
			}
			$out	.= '>';
			$out	.= '<a href="#" class="oblyon-notif-btn" role="button" aria-haspopup="true" aria-expanded="false" title="'.dol_escape_htmltag($langs->transnoentitiesnoconv('OblyonNotifTitle')).'">';
			$out	.= '<span class="fa fa-bell" aria-hidden="true"></span><span class="oblyon-notif-count" hidden></span></a>';
			$out	.= '<div class="oblyon-notif-panel" hidden>';
			$out	.= '<div class="oblyon-notif-head"><span class="oblyon-notif-title">'.$langs->trans('OblyonNotifTitle').'</span>';
			$out	.= '<span class="oblyon-notif-actions"><a href="#" class="oblyon-notif-readall">'.$langs->trans('OblyonNotifMarkRead').'</a><a href="#" class="oblyon-notif-clear">'.$langs->trans('OblyonNotifClear').'</a></span></div>';
			$out	.= '<ul class="oblyon-notif-list"></ul><p class="oblyon-notif-empty">'.$langs->trans('OblyonNotifEmpty').'</p></div></div>';
		}
		if ($out === '') {
			return 0;
		}
		$this->resprints	= $out;
		return 0;
	}
	// InfraS add begin
	// caisse TakePOS (3.9.0) ------------------------------------------------------------------------------------------------------------
	// Themes de la caisse (OBLYON_TAKEPOS_THEME) : native (rien ne change), classic (« Natif ameliore » : habillage de la disposition d'origine),
	// counter / tablet / scanner (dispositions Comptoir / Tablette / Superette : grille CSS de themeoblyon/modules/takepos.inc.php + js/takepos.js).
	// Tous les themes sauf natif ajoutent l'edition rapide des lignes (colonne -/+ du ticket, remises en un appui, raccourcis clavier).
	// Couleurs des categories (OBLYON_TAKEPOS_CATEGORY_COLORS) : independantes du theme
	/**
	 * TakePOS theme in use (an unknown value is handled as native)
	 *
	 * @return	string	native | classic | counter | tablet | scanner
	 */
	public static function takeposTheme()
	{
		$theme	= getDolGlobalString('OBLYON_TAKEPOS_THEME', 'native');
		return in_array($theme, array('native', 'classic', 'counter', 'tablet', 'scanner'), true) ? $theme : 'native';
	}
	/**
	 * Quick discounts of the TakePOS themes (OBLYON_TAKEPOS_QUICK_DISCOUNTS, '5,10,20' by default)
	 *
	 * @return	array	Percentages (at most 4 values between 0 and 100)
	 */
	public static function takeposDiscounts()
	{
		$list	= array();
		foreach (explode(',', getDolGlobalString('OBLYON_TAKEPOS_QUICK_DISCOUNTS', '5,10,20')) as $value) {
			$value	= trim($value);
			if (is_numeric($value) && (float) $value >= 0 && (float) $value <= 100 && count($list) < 4) {
				$list[]	= ((float) $value == (int) $value) ? (int) $value : (float) $value;
			}
		}
		return $list;
	}
	// addHtmlHeader est appele en fin de <head> de toutes les pages (contexte main) ; il rend la main tout de suite hors des pages de caisse.
	// Pages de caisse = liste fermee (ecran de caisse, paiement, remise, saisie libre, fractionnement) : jamais les reglages takepos/admin/ (la disposition
	// bloquait le defilement de la page), ni l'impression du ticket (receipt.php), ni les pages publiques (takepos/public/).
	// Sur ces pages, il pose sur <html> les classes lues par themeoblyon/modules/takepos.inc.php :
	// oblyon-pos, oblyon-pos-styled + oblyon-pos-<theme> (theme autre que natif), oblyon-pos-layout (Comptoir, Tablette, Superette), oblyon-pos-catcolors.
	// <html> plutot que <body> : seul l'ecran de caisse a une classe de body (bodytakepos), les fenetres de paiement et de remise n'en ont pas.
	// Sur l'ecran de caisse (index.php) : reglages du script (theme, remises, jeton, libelles traduits : aucun texte en dur dans le script) puis js/takepos.js
	// (adresse versionnee par la date du fichier : le serveur met les .js en cache 30 jours)
	/**
	 * Overloading the addHtmlHeader function : TakePOS theme classes, settings and script
	 *
	 * @param	array		$parameters		Hook metadata (context, etc...)
	 * @param	object		$object			Current object
	 * @param	string		$action			Current action
	 * @param	HookManager	$hookmanager	Hook manager
	 * @return	int							0 = output added to the <head>
	 */
	public function addHtmlHeader($parameters, &$object, &$action, $hookmanager)
	{
		global $langs;
		$self	= isset($_SERVER['PHP_SELF']) ? (string) $_SERVER['PHP_SELF'] : '';
		if (!preg_match('#/takepos/(index|pay|reduction|freezone|split)\.php$#', $self) || !isModEnabled('takepos')) {
			return 0;
		}
		$theme		= self::takeposTheme();
		$catcolors	= getDolGlobalInt('OBLYON_TAKEPOS_CATEGORY_COLORS');
		if ($theme == 'native' && empty($catcolors)) {
			return 0;
		}
		$layout		= in_array($theme, array('counter', 'tablet', 'scanner'), true) ? $theme : '';
		$classes	= array('oblyon-pos');
		if ($theme != 'native') {
			$classes[]	= 'oblyon-pos-styled';
			$classes[]	= 'oblyon-pos-'.$theme;
		}
		if ($layout) {
			$classes[]	= 'oblyon-pos-layout';
		}
		if ($catcolors) {
			$classes[]	= 'oblyon-pos-catcolors';
		}
		$out	= '<script>document.documentElement.className += " '.implode(' ', $classes).'";</script>'."\n";
		if (basename($self) == 'index.php') {
			$langs->loadLangs(array('oblyon@oblyon', 'cashdesk', 'bills'));
			$keys	= array('total' => 'TotalTTCShort', 'qty' => 'Qty', 'price' => 'Price', 'discount' => 'LineDiscountShort', 'pay' => 'Payment', 'del' => 'Delete',
							'numpad' => 'OblyonTakeposNumpad', 'close' => 'OblyonTakeposClose', 'back' => 'OblyonTakeposBack', 'keys' => 'OblyonTakeposKeys',
							'lines' => 'OblyonTakeposKeyLines', 'step' => 'OblyonTakeposKeyStep', 'numberHint' => 'OblyonTakeposKeyNumberHint',
							'saleDone' => 'OblyonTakeposSaleDone', 'newSale' => 'OblyonTakeposNewSale');
			$labels	= array();
			foreach ($keys as $code => $transkey) {
				$labels[$code]	= $langs->transnoentitiesnoconv($transkey);
			}
			$autonew	= max(0, min(60, getDolGlobalInt('OBLYON_TAKEPOS_AUTO_NEW_SALE', 5)));	// secondes avant la nouvelle vente automatique apres un paiement, 0 = jamais
			$config		= array('theme' => $theme, 'layout' => $layout, 'catcolors' => (int) $catcolors, 'discounts' => self::takeposDiscounts(), 'autoNewSale' => $autonew, 'token' => newToken(), 'labels' => $labels);
			$file	= dol_buildpath('/oblyon/js/takepos.js', 0);
			$out	.= '<script>window.oblyonPos = '.json_encode($config, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT).';</script>'."\n";
			$out	.= '<script src="'.dol_buildpath('/oblyon/js/takepos.js', 1).'?v='.((int) @filemtime($file)).'" defer></script>'."\n";
		}
		$this->resprints	= $out;
		return 0;
	}
	// colonne -/+ du ticket (contexte takeposinvoice, invoice.php charge en ajax) : en-tete vide et, par ligne, la quantite (data-qty, lue par js/takepos.js)
	// avec les boutons -1 / +1 ; a une quantite de 1 ou moins, le bouton - devient une corbeille (la ligne est supprimee par TakePOS)
	/**
	 * Overloading the completeTakePosInvoiceHeader function : header cell of the quick quantity column
	 *
	 * @param	array		$parameters		Hook metadata (context, etc...)
	 * @param	object		$object			Current invoice
	 * @param	string		$action			Current action
	 * @param	HookManager	$hookmanager	Hook manager
	 * @return	int							0 = cell added to the header row
	 */
	public function completeTakePosInvoiceHeader($parameters, &$object, &$action, $hookmanager)
	{
		if (!isModEnabled('takepos') || self::takeposTheme() == 'native' || !is_object($object) || (int) $object->status !== 0) {
			return 0;	// ticket valide (paye, historique) : pas de selecteur, la facture n'est plus modifiable
		}
		$this->resprints	= '<td class="oblyon-pos-linectl"></td>';
		return 0;
	}
	/**
	 * Overloading the completeTakePosInvoiceLine function : -/+ buttons of a ticket line
	 *
	 * @param	array		$parameters		Hook metadata (line = invoice line)
	 * @param	object		$object			Current invoice
	 * @param	string		$action			Current action
	 * @param	HookManager	$hookmanager	Hook manager
	 * @return	int							0 = cell added to the line
	 */
	public function completeTakePosInvoiceLine($parameters, &$object, &$action, $hookmanager)
	{
		global $langs;
		if (!isModEnabled('takepos') || self::takeposTheme() == 'native' || empty($parameters['line']) || !is_object($parameters['line'])
			|| !is_object($object) || (int) $object->status !== 0) {
			return 0;	// ticket valide (paye, historique) : pas de selecteur
		}
		$langs->load('oblyon@oblyon');
		$qty	= (float) $parameters['line']->qty;
		$minus	= $qty <= 1 ? array('fa-trash', 'OblyonTakeposQtyDelete') : array('fa-minus', 'OblyonTakeposQtyMinus');
		$out	= '<td class="oblyon-pos-linectl nowraponall" data-qty="'.dol_escape_htmltag(rtrim(rtrim(number_format($qty, 3, '.', ''), '0'), '.')).'">';
		$out	.= '<button type="button" class="oblyon-pos-qtybtn oblyon-pos-minus'.($qty <= 1 ? ' oblyon-pos-isdelete' : '').'" data-step="-1" title="'.dol_escape_htmltag($langs->transnoentitiesnoconv($minus[1])).'"><span class="fa '.$minus[0].'"></span></button>';
		$out	.= '<button type="button" class="oblyon-pos-qtybtn oblyon-pos-plus" data-step="1" title="'.dol_escape_htmltag($langs->transnoentitiesnoconv('OblyonTakeposQtyPlus')).'"><span class="fa fa-plus"></span></button>';
		$out	.= '</td>';
		$this->resprints	= $out;
		return 0;
	}
	// InfraS add end
}
