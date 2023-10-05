<?php
/**
 * Copyright (c) 2023 Eric Seigne		   <eric.seigne@cap-rel.fr>
 * Copyright (c) 2023 Alexandre Spangaro	<aspangaro@easya.solutions>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

$res																= 0;
if (! $res && file_exists("../main.inc.php"))		$res	= @include "../main.inc.php";
if (! $res && file_exists("../../main.inc.php"))	$res	= @include "../../main.inc.php";
if (! $res && file_exists("../../../main.inc.php"))	$res	= @include "../../../main.inc.php";
if (! $res)											die("Include of main fails");
require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';

// Define css type
top_httphead('text/css');
// Important: Following code is to avoid page request by browser and PHP CPU at each Dolibarr page access.
if (empty($dolibarr_nocache)) {
	header('Cache-Control: max-age=10800, public, must-revalidate');
} else {
	header('Cache-Control: no-cache');
}


print '/* Here, the content of the common custom CSS defined into Home - Setup - Display - CSS'."*/\n";
print getDolGlobalString('OBLYON_CUSTOM_CSS');
