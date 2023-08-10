<?php
/* Copyright (C) 2004-2017	Laurent Destailleur		<eldy@users.sourceforge.net>
 * Copyright (C) 2006		Rodolphe Quiedeville	<rodolphe@quiedeville.org>
 * Copyright (C) 2007-2017	Regis Houssin			<regis.houssin@inodbox.com>
 * Copyright (C) 2011		Philippe Grand			<philippe.grand@atoo-net.com>
 * Copyright (C) 2012		Juanjo Menent			<jmenent@2byte.es>
 * Copyright (C) 2018	   Ferran Marcet		   <fmarcet@2byte.es>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FI8TNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */
/**
 *		\file	   htdocs/theme/oblyon/manifest.json.php
 *		\brief	  File for The Web App
 */
//if (! defined('NOREQUIREUSER')) define('NOREQUIREUSER','1');	// Not disabled because need to load personalized language
//if (! defined('NOREQUIREDB'))   define('NOREQUIREDB','1');	// Not disabled to increase speed. Language code is found on url.
if (! defined('NOREQUIRESOC'))	define('NOREQUIRESOC', '1');
//if (! defined('NOREQUIRETRAN')) define('NOREQUIRETRAN','1');	// Not disabled because need to do translations
if (! defined('NOCSRFCHECK'))	 define('NOCSRFCHECK', 1);
if (! defined('NOTOKENRENEWAL'))  define('NOTOKENRENEWAL', 1);
if (! defined('NOLOGIN'))		 define('NOLOGIN', 1);		  // File must be accessed by logon page so without login
//if (! defined('NOREQUIREMENU'))   define('NOREQUIREMENU',1);  // We need top menu content
if (! defined('NOREQUIREHTML'))   define('NOREQUIREHTML', 1);
if (! defined('NOREQUIREAJAX'))   define('NOREQUIREAJAX', '1');

require_once __DIR__.'/../../main.inc.php';

$appli=constant('DOL_APPLICATION_TITLE');
if (!empty($conf->global->MAIN_APPLICATION_TITLE)) $appli=$conf->global->MAIN_APPLICATION_TITLE;
?>
{
	"name": "<?php echo $appli; ?>",
	"icons": [
		{
			"src": "<?php echo dol_buildpath('/theme/common/dolibarr_logo_256x256.png', 2); ?>",
			"sizes": "256x256",
			"type": "image/png"
		}
	],
	"theme_color": "#333",
	"background_color": "#ffffff",
	"display": "standalone"
}