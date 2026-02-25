<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */

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