<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */

#ScanInvoicesGlobal {
	<?php if($conf->global->OBLYON_STICKY_LEFTBAR) { ?>
		<?php if($conf->global->OBLYON_REDUCE_LEFTMENU) { ?>
			padding-left: 50px !important;
		<?php } else { ?>
			padding-left: 240px !important;
		<?php } ?>
	<?php } ?>
}

#ocr-server-card, #ScanInvoicesMydrop, #ScanInvoicesMydropLater {
	background-color: var(--inputbackgroundcolor) !important;
}
