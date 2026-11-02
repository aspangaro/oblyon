<?php
if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet');
?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/modules.inc.php
   Role      : Chargeur des CSS de modules tiers : inclut chaque modules/*.inc.php (ordre alphabetique)
   Inclus par : global.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */


<?php
 	require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';

	$cssdir		= DOL_DOCUMENT_ROOT.$path.'/theme/'.$theme.'/modules';
	$listcss	= dol_dir_list($cssdir, 'files', 0, '\.inc.php$', null, 'name', SORT_ASC, 1, 0, '', 0);
	foreach ($listcss as $css) {
		include dol_buildpath($path.'/theme/'.$theme.'/modules/'.$css['name'], 0);
	}
