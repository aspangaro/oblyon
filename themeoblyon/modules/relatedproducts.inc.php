/* Copyright (C) 2023-2026  Sylvain Legrand		<contact@infras.fr>
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
 * \file		htdocs/theme/oblyon/modules/relatedproducts.inc.php
 * \ingroup		oblyon
 * \brief		Manage compatibility between the Oblyon theme and the RelatedProducts module >
 */
<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/modules/relatedproducts.inc.php
   Role      : CSS du module tiers relatedproducts sur les jetons du theme ; se garde lui-meme (isModEnabled)
   Inclus par : modules.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */


<?php if (isModEnabled('relatedproducts') && getDolGlobalString('FIX_STICKY_HEADER_CARD')) { ?>
/* Popup « produits associés » (dialogue jQuery UI) : neutraliser l'en-tête sticky
   qui recouvre les premières lignes du tableau (le décalage top 40/54px est calibré
   pour le menu fixe de la page principale, pas pour un dialogue défilant) */
#addrelatedproducts tr.liste_titre th {
    position: static !important;
    top: unset !important;
}
<?php } ?>
