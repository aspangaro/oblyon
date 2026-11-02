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
 * \file		htdocs/theme/oblyon/modules/scaninvoices.inc.php
 * \ingroup		oblyon
 * \brief		Manage compatibility between the Oblyon theme and the ScanInvoices module >
 */
<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/modules/scaninvoices.inc.php
   Role      : CSS du module tiers scaninvoices sur les jetons du theme ; se garde lui-meme (isModEnabled)
   Inclus par : modules.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */


#ScanInvoicesGlobal {
	<?php if (getDolGlobalString('OBLYON_STICKY_LEFTBAR')) { ?>
		<?php if (getDolGlobalString('OBLYON_REDUCE_LEFTMENU')) { ?>
			padding-left: 50px !important;
		<?php } else { ?>
			padding-left: 240px !important;
		<?php } ?>
	<?php } ?>
}

#ocr-server-card, #ScanInvoicesMydrop, #ScanInvoicesMydropLater {
	background-color: var(--inputbackgroundcolor) !important;
}
