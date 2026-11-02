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
 * \file		htdocs/theme/oblyon/modules/subtotal.inc.php
 * \ingroup		oblyon
 * \brief		Manage compatibility between the Oblyon theme and the SubTotal module >
 */
<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/modules/subtotal.inc.php
   Role      : CSS du module tiers subtotal sur les jetons du theme ; se garde lui-meme (isModEnabled)
   Inclus par : modules.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */


.subtitleLevel1 {
    background-color: <?php print getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR', '#adadcf'); ?> !important;
}

.subtitleLevel2 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR'), getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10)) : '#ddddff'); ?> !important;
}

.subtitleLevel3 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 2)) : '#eeeeff'); ?> !important;
}

.subtitleLevel4 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 3)) : '#eeeeff'); ?> !important;
}

.subtitleLevel5 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 4)) : '#eeeeff'); ?> !important;
}

.subtitleLevel6 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 5)) : '#eeeeff'); ?> !important;
}

.subtitleLevel7 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 6)) : '#eeeeff'); ?> !important;
}

.subtitleLevel8 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 7)) : '#eeeeff'); ?> !important;
}

.subtitleLevel9 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_TITLE_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 8)) : '#eeeeff'); ?> !important;
}

.subtotalLevel1 {
    background-color: <?php print getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR', '#adadcf'); ?> !important;
}

.subtotalLevel2 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 1)) : '#ddddff'); ?> !important;
}

.subtotalLevel3 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 2)) : '#eeeeff'); ?> !important;
}

.subtotalLevel4 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 3)) : '#eeeeff'); ?> !important;
}

.subtotalLevel5 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 4)) : '#eeeeff'); ?> !important;
}

.subtotalLevel6 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 5)) : '#eeeeff'); ?> !important;
}

.subtotalLevel7 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 6)) : '#eeeeff'); ?> !important;
}

.subtotalLevel8 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 7)) : '#eeeeff'); ?> !important;
}

.subtotalLevel9 {
    background-color: <?php print (getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR') ? colorLighten(getDolGlobalString('SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR'), (getDolGlobalInt('SUBTOTAL_TITLE_AND_SUBTOTAL_BRIGHTNESS_PERCENTAGE', 10) * 8)) : '#eeeeff'); ?> !important;
}