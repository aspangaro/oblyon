<?php
if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet');
?>
/* <style type="text/css" > */

<?php
 	require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';

	$cssdir		= DOL_DOCUMENT_ROOT.$path.'/theme/'.$theme.'/modules';
	$listcss	= dol_dir_list($cssdir, 'files', 0, '\.inc.php$', null, 'name', SORT_ASC, 1, 0, '', 0);
	foreach ($listcss as $css) {
		include dol_buildpath($path.'/theme/'.$theme.'/modules/'.$css['name'], 0);
	}
