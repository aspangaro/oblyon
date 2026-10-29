<?php
/* InfraS add (2026-09) : fichier ajouté par InfraS.
 * Sert css/oblyon.css à travers PHP : l'adresse ne se termine plus par « .css », donc Dolibarr
 * (main.inc.php) lui ajoute ses paramètres lang / theme / userid / version / revision, comme il le
 * fait déjà pour custom.css.php. Sans cela, l'adresse nue est gardée un mois par le cache public
 * d'Apache puis par Cloudflare, et un CSS modifié reste invisible quel que soit le rechargement
 * du navigateur (cartes de presets cassées sur l'onglet Couleurs après la 3.6.0, 2026-09-17).
 * - oblyon.css reste la seule source à modifier ; ce fichier ne fait que le renvoyer.
 * - Ne charge pas Dolibarr : répond aussi sur la page de connexion, où personne n'est identifié.
 * - Ne lit aucun paramètre.
 * Même mécanisme dans font.css.php.
 */
header('Content-Type: text/css; charset=utf-8');
header('Cache-Control: max-age=10800, public, must-revalidate');	// 3 h côté navigateur, comme custom.css.php
readfile(__DIR__.'/oblyon.css');
