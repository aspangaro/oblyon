<?php
/* InfraS add (2026-09) : fichier ajouté par InfraS.
 * Sert css/font.css à travers PHP, pour la même raison que oblyon.css.php (voir ce fichier) :
 * l'adresse reçoit les paramètres de Dolibarr et n'est plus figée un mois par le cache public
 * d'Apache puis par Cloudflare. font.css reste la seule source à modifier.
 * Ne charge pas Dolibarr, ne lit aucun paramètre.
 */
header('Content-Type: text/css; charset=utf-8');
header('Cache-Control: max-age=10800, public, must-revalidate');	// 3 h côté navigateur, comme custom.css.php
readfile(__DIR__.'/font.css');
