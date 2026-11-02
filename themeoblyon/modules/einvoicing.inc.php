<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* ================================================================================================
   oblyon/themeoblyon/modules/einvoicing.inc.php
   Role      : CSS du module tiers einvoicing dans le bandeau des fiches ; se garde lui-meme (isModEnabled)
   Inclus par : modules.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/* <style type="text/css" > */

<?php if (isModEnabled('einvoicing')) { ?>
/* Module einvoicing : le badge "Facture electronique : <etat>" est ajoute en JavaScript sous le statut du bandeau
   (div.einv-banner-badge dans div.statusref). Il etait colle au statut : on l'en detache de 6px. */
.arearef .statusref .einv-banner-badge, .arearefnobottom .statusref .einv-banner-badge {
	margin-top: 6px;
}
<?php } ?>
