<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/motion.inc.php
   Role      : Option "Animations" (OBLYON_MOTION, 3.8.0) : normal (le reglage "moins d'animations" du poste est toujours respecte) / reduced.
               Inclus en dernier par global.inc.php : ses regles l'emportent sur toutes les transitions et animations du theme
               (menus, volets, tiroir mobile, boutons, onglets, pulsation du statut, tuiles...).
   Inclus par : global.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : $oblyon_motion (style.css.php)
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */
:root {
	--oblyon-motion: <?php print ($oblyon_motion == 'normal' ? 1 : 0); ?>;	/* lu par js/oblyon.js : 1 = normales (sauf reglage du poste), 0 = reduites */
}
<?php
// Regles "reduites" : transitions ramenees a 50 ms (l'etat final s'affiche presque aussitot, sans saut brutal), animations coupees (une seule iteration instantanee : la pulsation
// du statut, le fondu des volets et des barres, le rebond des timelines...), defilement doux desactive. En "normal", ces memes regles s'appliquent seulement quand le poste
// demande moins d'animations (prefers-reduced-motion : Windows "Effets d'animation", macOS "Reduire les animations", Android / iOS).
$oblyon_motion_rules = function ($duration) {
	return ":root {\n\t--oblyon-transition: ".$duration." linear;\n}\n"
		."*, *::before, *::after {\n\tanimation-duration: .01ms !important;\n\tanimation-iteration-count: 1 !important;\n\ttransition-duration: ".$duration." !important;\n\tscroll-behavior: auto !important;\n}\n";
};
if ($oblyon_motion == 'reduced') {
	print $oblyon_motion_rules('.05s');
} else {
	print "@media (prefers-reduced-motion: reduce) {\n".$oblyon_motion_rules('.05s')."}\n";
}
?>
