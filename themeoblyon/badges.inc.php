<?php
if (!defined('ISLOADEDBYSTEELSHEET')) {
	die('Must be call by steelsheet');
}
?>
/* ================================================================================================
   oblyon/themeoblyon/badges.inc.php
   Role      : Badges (base Bootstrap) et badges de statut : fond par famille OBLYON_COLOR_BADGE_*, texte calcule par contraste (oblyon_text_on)
   Inclus par : core.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/* Badge style is based on boostrap framework */

/* InfraS change begin : badges en pilule, graisse 600 */
.badge {
	display: inline-block;
	padding: .1em .5em;
	font-size: 80%;
	font-weight: 600 !important;
	line-height: 1;
	text-align: center;
	white-space: nowrap;
	vertical-align: baseline;
	border-radius: var(--oblyon-radius-pill);
/* InfraS change end */
	transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	border-width: 2px;
	border-style: solid;
	border-color: rgba(255,255,255,0);
	box-sizing: border-box;
}

.badge-status {
	font-size: 0.95em;
	padding: .19em .55em;			/* more than 0.19 generate a change into heigth of lines */	/* InfraS change : marge laterale de la pilule */
}
.tabBar .arearef .statusref .badge-status, .tabBar .arearefnobottom .statusref .badge-status {
	font-size: 0.95em;
	padding: .3em .6em;
}
/* Force values for small screen 767 */
@media only screen and (max-width: 767px)
{
	.tabBar .arearef .statusref .badge-status, .tabBar .arearefnobottom .statusref .badge-status {
		font-size: 0.95em;
		padding: .3em .2em;
	}
}

.badge-pill, .tabs .badge {
	padding-right: .5em;
	padding-left: .5em;
	border-radius: var(--oblyon-radius-pill);	/* InfraS change */
}

.badge-dot {
	padding: 0;
	border-radius: 50%;
	padding: 0.45em;
	vertical-align: text-top;
}

a.badge:focus, a.badge:hover {
	text-decoration: none;
}

.liste_titre .badge:not(.nochangebackground) {
	background-color: var(--badgeSecondary);
	color: #fff;
}

span.badgeneutral {
	padding: 2px 8px 2px 8px;
	/* InfraS change begin : neutres du preset */
	background-color: var(--oblyon-neutral-bg);
	color: var(--oblyon-muted-text);
	border: 1px solid var(--oblyon-border);
	border-radius: var(--oblyon-radius-pill);
	/* InfraS change end */
	white-space: nowrap;
}


/* PRIMARY */
.badge-primary{
	color: #fff !important;
	background-color: var(--badgePrimary);
}
a.badge-primary.focus, a.badge-primary:focus {
	outline: 0;
	box-shadow: 0 0 0 0.2rem <?php print colorHexToRgb($badgePrimary, 0.5); ?>;
}
a.badge-primary:focus, a.badge-primary:hover {
	color: #fff !important;
	background-color: <?php print colorDarker($badgePrimary, 10); ?>;
}

/* SECONDARY */
.badge-secondary, .tabs .badge {
	color: #fff !important;
	background-color: var(--badgeSecondary);
}
a.badge-secondary.focus, a.badge-secondary:focus {
	outline: 0;
	box-shadow: 0 0 0 0.2rem <?php print colorHexToRgb($badgeSecondary, 0.5); ?>;
}
a.badge-secondary:focus, a.badge-secondary:hover {
	color: #fff !important;
	background-color: <?php print colorDarker($badgeSecondary, 10); ?>;
}

/* SUCCESS */
.badge-success {
	color: #fff !important;
	background-color: var(--badgeSuccess);
}
a.badge-success.focus, a.badge-success:focus {
	outline: 0;
	box-shadow: 0 0 0 0.2rem <?php print colorHexToRgb($badgeSuccess, 0.5); ?>;
}
a.badge-success:focus, a.badge-success:hover {
	color: #fff !important;
	background-color: <?php print colorDarker($badgeSuccess, 10); ?>;
}

/* DANGER */
.badge-danger {
	color: #fff !important;
	background-color: var(--badgeDanger);
}
a.badge-danger.focus, a.badge-danger:focus {
	outline: 0;
	box-shadow: 0 0 0 0.2rem <?php print colorHexToRgb($badgeDanger, 0.5); ?>;
}
a.badge-danger:focus, a.badge-danger:hover {
	color: #fff !important;
	background-color: <?php print colorDarker($badgeDanger, 10); ?>;
}

/* WARNING */
.badge-warning {
    color: #212529 !important;
    background-color: var(--badgeWarning);
}
a.badge-warning.focus, a.badge-warning:focus {
	outline: 0;
	box-shadow: 0 0 0 0.2rem <?php print colorHexToRgb($badgeWarning, 0.5); ?>;
}
a.badge-warning:focus, a.badge-warning:hover {
	color: #212529 !important;
	background-color: <?php print colorDarker($badgeWarning, 10); ?>;
}

/* WARNING colorblind */
body[class*="colorblind-"] .badge-warning {
	  background-color: var(--colorblind_deuteranopes_badgeWarning);
  }
body[class*="colorblind-"] a.badge-warning.focus,body[class^="colorblind-"] a.badge-warning:focus {
	box-shadow: 0 0 0 0.2rem <?php print colorHexToRgb($colorblind_deuteranopes_badgeWarning, 0.5); ?>;
}
body[class*="colorblind-"] a.badge-warning:focus, a.badge-warning:hover {
	background-color: <?php print colorDarker($colorblind_deuteranopes_badgeWarning, 10); ?>;
}

/* INFO */
.badge-info {
	color: #fff !important;
	background-color: var(--badgeInfo);
}
a.badge-info.focus, a.badge-info:focus {
	outline: 0;
	box-shadow: 0 0 0 0.2rem <?php print colorHexToRgb($badgeInfo, 0.5); ?>;
}
a.badge-info:focus, a.badge-info:hover {
	color: #fff !important;
	background-color: <?php print colorDarker($badgeInfo, 10); ?>;
}

/* LIGHT */
.badge-light {
	color: #212529 !important;
	background-color: var(--badgeLight);
}
a.badge-light.focus, a.badge-light:focus {
	outline: 0;
	box-shadow: 0 0 0 0.2rem <?php print colorHexToRgb($badgeLight, 0.5); ?>;
}
a.badge-light:focus, a.badge-light:hover {
	color: #212529 !important;
	background-color: <?php print colorDarker($badgeLight, 10); ?>;
}

/* DARK */
.badge-dark {
	color: #fff !important;
	background-color: var(--badgeDark);
}
a.badge-dark.focus, a.badge-dark:focus {
	outline: 0;
	box-shadow: 0 0 0 0.2rem <?php print colorHexToRgb($badgeDark, 0.5); ?>;
}
a.badge-dark:focus, a.badge-dark:hover {
	color: #fff !important;
	background-color: <?php print colorDarker($badgeDark, 10); ?>;
}


@media only screen and (max-width: 570px)
{
	span.badge.badge-status {
		overflow: hidden;
		max-width: 130px;
		text-overflow: ellipsis;
	}
}


/* STATUS BADGES */
<?php
for ($i = 0; $i <= 10; $i++) {
	/* Default Status */
	_createStatusBadgeCss($i, '', "STATUS".$i);

	// create status for accessibility
	_createStatusBadgeCss($i, 'colorblind_deuteranopes_', "COLORBLIND STATUS".$i, 'body[class*="colorblind-"] ');
}

_createStatusBadgeCss('1b', '', "STATUS1b");
_createStatusBadgeCss('4b', '', "STATUS4b");


/**
 * Create status badge
 *
 * @param string $statusName name of status
 * @param string $statusVarNamePrefix a prefix for var ${$statusVarNamePrefix.'badgeStatus'.$statusName}
 * @param string $commentLabel a comment label
 * @param string $cssPrefix a css prefix
 * @return void
 */
function _createStatusBadgeCss($statusName, $statusVarNamePrefix = '', $commentLabel = '', $cssPrefix = '')
{
	global ${$statusVarNamePrefix.'badgeStatus'.$statusName}, ${$statusVarNamePrefix.'badgeStatus_textColor'.$statusName};

	if (!empty(${$statusVarNamePrefix.'badgeStatus'.$statusName})) {
		print "\n/* ".strtoupper($commentLabel)." */\n";

		$thisBadgeBackgroundColor = $thisBadgeBorderColor = ${$statusVarNamePrefix.'badgeStatus'.$statusName};

		$TBadgeBorderOnly = array('0', '1b', '3', '4b', '5', '7', '10');
		// InfraS change begin : couleurs de texte / fond des badges "bordure seule" prises sur le preset (texte et fond des lignes, texte secondaire)
		$thisBadgeTextColor = oblyon_text_on(${$statusVarNamePrefix.'badgeStatus'.$statusName});	// InfraS change 3.7.0 : sombre ou blanc selon le meilleur contraste WCAG sur le fond du badge (etait blanc ou texte des lignes selon la clarte)

		if (!empty(${$statusVarNamePrefix.'badgeStatus_textColor'.$statusName})) {
			$thisBadgeTextColor = ${$statusVarNamePrefix.'badgeStatus_textColor'.$statusName};
		}

		if (in_array((string) $statusName, $TBadgeBorderOnly)) {
			$thisBadgeTextColor = 'var(--colorfline)';
			$thisBadgeBackgroundColor = 'var(--colorbline)';
		}

		if (in_array((string) $statusName, array('0', '5'))) {	// InfraS change 3.7.0 : texte attenue pour les badges "bordure seule" brouillon / ferme seulement ; 6 et 9 sont des badges pleins, leur texte suit le contraste de leur fond
			$thisBadgeTextColor = 'var(--oblyon-muted-text)';
		}
		// InfraS change end

		// badge-statusX
		print $cssPrefix.".badge-status".$statusName." {\n";
		print "        color: ".$thisBadgeTextColor." !important;\n";
		if (in_array((string) $statusName, $TBadgeBorderOnly)) {
			print "        border-color: ".$thisBadgeBorderColor." !important;\n";
		}
		if ($thisBadgeBackgroundColor != '') {
			print "        background-color: ".$thisBadgeBackgroundColor." !important;\n";
		}
		print "}\n";

		print $cssPrefix.".font-status".$statusName." {\n";
		if ($thisBadgeBorderColor != '') {	// InfraS change 3.7.0 : couleur du statut (bordure) et non le fond : pour les badges "bordure seule" le fond est celui des lignes, le texte etait invisible
			print "        color: ".$thisBadgeBorderColor." !important;\n";
		}
		print "}\n";

		print $cssPrefix.".badge-status".$statusName.".focus, ".$cssPrefix.".badge-status".$statusName.":focus {\n";
		print "    outline: 0;\n";
		print "    box-shadow: 0 0 0 0.2rem ".colorHexToRgb($thisBadgeBorderColor, 0.5)." !important;\n";	// InfraS change : la couleur de fond peut etre une variable CSS, l'anneau utilise la couleur de bordure (hex)
		print "}\n";

		// badge-statusX:focus
		print $cssPrefix.".badge-status".$statusName.":focus, ".$cssPrefix.".badge-status".$statusName.":hover {\n";
		print "    color: ".$thisBadgeTextColor." !important;\n";
		//print "    background-color: " . colorDarker($thisBadgeBackgroundColor, 10) . ";\n";
		if (in_array((string) $statusName, $TBadgeBorderOnly)) {
			print "        border-color: ".colorDarker($thisBadgeBorderColor, 10)." !important;\n";
		}
		print "}\n";

		// style des badges de statut (OBLYON_BADGE_STYLE, 3.8.0), ecrit apres les regles d'origine du statut (memes selecteurs + !important) :
		// outline = fond des lignes, cadre 1 px et texte de la couleur du statut (les statuts "bordure seule" d'origine gardent leur texte) ; dot = ni fond ni cadre,
		// texte des lignes (graisse 500) precede d'un disque de 8 px (10 px dans le bandeau de fiche) de la couleur du statut, dessine par ::before
		global $oblyon_badge_style;
		if ($oblyon_badge_style == 'outline') {
			print $cssPrefix.".badge-status".$statusName.", ".$cssPrefix.".badge-status".$statusName.":focus, ".$cssPrefix.".badge-status".$statusName.":hover {\n";
			print "    background-color: var(--colorbline) !important;\n";
			print "    border: 1px solid ".$thisBadgeBorderColor." !important;\n";
			print "    color: ".(in_array((string) $statusName, array('0', '5')) ? 'var(--oblyon-muted-text)' : $thisBadgeBorderColor)." !important;\n";
			print "}\n";
		} elseif ($oblyon_badge_style == 'dot') {
			print $cssPrefix.".badge-status".$statusName.", ".$cssPrefix.".badge-status".$statusName.":focus, ".$cssPrefix.".badge-status".$statusName.":hover {\n";
			print "    background-color: transparent !important;\n";
			print "    border-color: transparent !important;\n";
			print "    color: ".(in_array((string) $statusName, array('0', '5')) ? 'var(--oblyon-muted-text)' : 'var(--colorfline)')." !important;\n";
			print "}\n";
			print $cssPrefix.".badge-status".$statusName."::before {\n";
			print "    background-color: ".$thisBadgeBorderColor.";\n";
			print "}\n";
		}
	}
}
?>
<?php if ($oblyon_badge_style == 'outline') { ?>
/* badges de statut "contour" (OBLYON_BADGE_STYLE = outline, 3.8.0) : structure commune (les couleurs sont par statut ci-dessus) */
.badge-status {
	font-weight: 600 !important;
	box-sizing: border-box;
}
<?php } elseif ($oblyon_badge_style == 'dot') { ?>
/* badges de statut "point + texte" (OBLYON_BADGE_STYLE = dot, 3.8.0) : structure commune, disque de 8 px aligne sur le texte, 10 px dans le bandeau de fiche */
.badge-status {
	position: relative;
	padding-left: 1.1em !important;
	padding-right: .2em !important;
	font-weight: 500 !important;
	border-width: 0;
	box-shadow: none !important;
	white-space: nowrap;
}
.badge-status::before {
	content: "";
	position: absolute;
	left: 0;
	top: 50%;
	width: 8px;
	height: 8px;
	margin-top: -4px;
	border-radius: 50%;
}
.tabBar .arearef .statusref .badge-status, .tabBar .arearefnobottom .statusref .badge-status {
	padding-left: 1.2em !important;
}
.tabBar .arearef .statusref .badge-status::before, .tabBar .arearefnobottom .statusref .badge-status::before {
	width: 10px;
	height: 10px;
	margin-top: -5px;
}
<?php } ?>
<?php if ($oblyon_status_pulse) { ?>
/* pulsation du statut de la fiche ouverte (OBLYON_STATUS_PULSE, 3.8.0) : le statut du bandeau de reference (div.statusref) va et vient entre
   pleine opacite et 55 % en 2,4 s, meme couleur, sans changement de taille ; en pause au survol (lecture) ; jamais dans les listes ; coupee quand le poste demande
   moins d'animations. Style "point + texte" : seul le disque pulse, le libelle reste stable ; statuts en icones : la pastille image pulse */
@keyframes oblyon-status-pulse {
	0%, 100% { opacity: 1; }
	50% { opacity: .55; }
}
<?php if ($oblyon_badge_style == 'dot') { ?>
.tabBar .arearef .statusref .badge-status::before, .tabBar .arearefnobottom .statusref .badge-status::before,
<?php } else { ?>
.tabBar .arearef .statusref .badge-status, .tabBar .arearefnobottom .statusref .badge-status,
<?php } ?>
.tabBar .arearef .statusref > img, .tabBar .arearefnobottom .statusref > img {
	animation: oblyon-status-pulse 2.4s ease-in-out infinite;
}
.tabBar .arearef .statusref:hover .badge-status, .tabBar .arearefnobottom .statusref:hover .badge-status,
.tabBar .arearef .statusref:hover .badge-status::before, .tabBar .arearefnobottom .statusref:hover .badge-status::before,
.tabBar .arearef .statusref:hover > img, .tabBar .arearefnobottom .statusref:hover > img {
	animation-play-state: paused;
	opacity: 1;
}
/* pas de coupure prefers-reduced-motion ici : l'option "Animations" (OBLYON_MOTION, lot 6) decide pour tout le theme, avec un reglage visible ;
   une coupure silencieuse par le seul reglage du poste faisait croire que l'option ne fonctionnait pas */
<?php } ?>
