<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */

.subtitleLevel1 {
    background-color: <?php print (!empty($conf->global->SUBTOTAL_TITLE_BACKGROUNDCOLOR) ? $conf->global->SUBTOTAL_TITLE_BACKGROUNDCOLOR : '#adadcf'); ?> !important;
}

.subtitleLevel2 {
    background-color: <?php print (!empty($conf->global->SUBTOTAL_TITLE_BACKGROUNDCOLOR) ? colorDarker($conf->global->SUBTOTAL_TITLE_BACKGROUNDCOLOR, 20) : '#ddddff'); ?> !important;
}

.subtitleLevel3to9 {
    background-color: <?php print (!empty($conf->global->SUBTOTAL_TITLE_BACKGROUNDCOLOR) ? colorDarker($conf->global->SUBTOTAL_TITLE_BACKGROUNDCOLOR, 40) : '#eeeeff'); ?> !important;
}

.subtotalLevel1 {
    background-color: <?php print (!empty($conf->global->SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR) ? $conf->global->SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR : '#adadcf'); ?> !important;
}

.subtotalLevel2 {
    background-color: <?php print (!empty($conf->global->SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR) ? colorDarker($conf->global->SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR, 20) : '#ddddff'); ?> !important;
}

.subtotalLevel3to9 {
    background-color: <?php print (!empty($conf->global->SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR) ? colorDarker($conf->global->SUBTOTAL_SUBTOTAL_BACKGROUNDCOLOR, 40) : '#eeeeff'); ?> !important;
}