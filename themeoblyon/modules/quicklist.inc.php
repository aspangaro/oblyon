<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */

<?php if (getDolGlobalString('FIX_AREAREF_TABACTION')) { ?>
.quicklist-dropdown-content {
    z-index: 2 !important;
}
<?php } ?>

<?php if (getDolGlobalString('FIX_STICKY_COLUMN_LAST')) { ?>
    #id-right > .fiche > form[action*="list.php"] div.div-table-responsive > table > tbody > * > :last-of-type,
    #id-right > .fiche > .tabBar > form[action*="list.php"] div.div-table-responsive > table > tbody > * > :last-of-type {
        position: sticky;
        right: 0;
        z-index: 2;
        background-color: var(--colorbacktitle1);
        border-left: 1px solid #bbbbbb;
    }

    <?php if (isModEnabled('quicklist') && !getDolGlobalString('MAIN_CHECKBOX_LEFT_COLUMN')) { ?>
        .quicklist-dropdown-content {
            right: 50px !important;
        }
    <?php } ?>

    <?php if (isModEnabled('quicklist') && getDolGlobalString('MAIN_CHECKBOX_LEFT_COLUMN')) { ?>
        .quicklist-dropdown-content {
            right: -300px !important;
    }
    <?php } ?>
<?php } ?>
