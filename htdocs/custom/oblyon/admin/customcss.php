<?php
 /************************************************
 * Copyright (C) 2001-2005 Rodolphe Quiedeville <rodolphe@quiedeville.org>
 * Copyright (C) 2004-2015 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) 2005-2012 Regis Houssin        <regis.houssin@inodbox.com>
 * Copyright (C) 2015      Jean-François Ferry	<jfefe@aternatik.fr>
 * Copyright (C) 2022	   Paul Lepont          <paul@kawagency.fr>
 * Copyright (C) 2022	   Alexandre Spangaro   <support@open-dsi.fr>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 ************************************************/

/************************************************
 * 	\file		../oblyon/admin/customcss.php
 * 	\ingroup	oblyon
 * 	\brief		Custom CSS Page < Custom CSS Configurator >
 ************************************************/

// Dolibarr environment *************************
require '../config.php';

// Libraries ************************************
require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
require_once '../lib/oblyon.lib.php';

// Translations *********************************
$langs->loadLangs(array('admin', 'oblyon@oblyon'));

// Access control *******************************
if (!$user->admin) {
	accessforbidden();
}

// Actions **************************************
$action                         = GETPOST('action', 'aZ09');
$result							= '';
// Sauvegarde / Restauration
if ($action == 'bkupParams')	$result	= oblyon_bkup_module ('oblyon');
if ($action == 'restoreParams')	$result	= oblyon_restore_module ('oblyon');

if($action == 'update')         $result = dolibarr_set_const($db, "OBLYON_CUSTOM_CSS", GETPOST('custom_css'), 'chaine', 0, '', $conf->entity);

// Retour => message Ok ou Ko
if ($result == 1)			setEventMessages($langs->trans('SetupSaved'), null, 'mesgs');
if ($result == -1)			setEventMessages($langs->trans('Error'), null, 'errors');
$_SESSION['dol_resetcache']	= dol_print_date(dol_now(), 'dayhourlog');	// Reset cache

// View *****************************************
$page_name					= $langs->trans('OblyonCustomCSSTitle');
llxHeader('', $page_name);
$linkback					= '<a href = "'.DOL_URL_ROOT.'/admin/modules.php">'.$langs->trans('BackToModuleList').'</a>';
print load_fiche_titre($page_name, $linkback);

// Configuration header *************************
$head						= oblyon_admin_prepare_head();
print dol_get_fiche_head($head, 'customcss', $langs->trans('Module113900Name'), 0, 'opendsi@oblyon');

$form = new Form($db);
$formfile = new FormFile($db);

// setup page goes here *************************
print '<form action = "'.$_SERVER['PHP_SELF'].'" method = "POST" enctype = "multipart/form-data">';
print '<input type = "hidden" name = "token" value = "'.newToken().'" />';
// Sauvegarde / Restauration
oblyon_print_backup_restore();
clearstatcache();

print '
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js" integrity="sha512-xwrAU5yhWwdTvvmMNheFn9IyuDbl/Kyghz2J3wQRDR8tyNmT8ZIYOd0V3iPYY/g4XdNPy0n/g0NvqGu9f0fPJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css" integrity="sha512-uf06llspW44/LZpHzHT6qBOIVODjWtv4MxCricRxkzvopAlSWnTf6hpZTFxuuZcuNE9CBQhqE0Seu1CoRk84nQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/css/css.min.js" integrity="sha512-2gAMyrBfWPuTJDA2ZNIWVrBBe9eN6/hOjyvewDd0bsk2Zg06sUla/nPPlqQs75MQMvJ+S5AmfKmq9q3+W2qeKw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
';

print '<span class="opacitymedium">'.$langs->trans("DisplayDesc")."</span><br>\n";
print "<br>\n";

print '<div class="div-table-responsive-no-min">';
print '<table summary="blockdashboard" class="noborder centpercent editmode tableforfield">';


print '<tr class="oddeven width25p"><td>';
	print $form->textwithpicto($langs->trans("AddCustomCssSentence"), $texthelp, 1, 'help', '', 0, 2, 'tooltipmessageofday');
print '</td></tr>';

print '<tr class="oddeven width25p"><td>';
print '<div id="codeMirror"></div>';

print '</td></tr>' . "\n";

print '</table>';
print '</div>';

print '<div class="center">';
print '<input class="button button-save reposition" type="submit" name="submit" value="' . $langs->trans("Save") . '">';
print '</div>';

print '	<script type = "text/javascript">
				$(document).ready(function() {
					$(".action").keyup(function(event) {
						if (event.which === 13)	$("#action").click();
					});
                    var elem = document.getElementById("codeMirror")
		            var initialValue = `'.$conf->global->OBLYON_CUSTOM_CSS.'`;
		            if(initialValue) {
                        var textDefault = initialValue;
                    } else {
                        var textDefault = "#myCustomId{ \n	width : 100%; \n}"
                    }
                    var myCodeMirror = CodeMirror(elem, {
                      value: textDefault,
                      mode:  "css"
                    });
                    $(".button-save").on("click", function(){
                        event.preventDefault();
                        $.ajax({
                            url: "./customcss.php",
                            type: "POST",
                            data : { action : "update", token : "'.newToken().'", custom_css : myCodeMirror.getValue()}
                        })
                        .done(function(response){
                            if(response == 1){
                                location.reload()
                            }
                        })
		            })
				})';
print '</script>';        

print '</form>';
print '<br/>';
// End of page
llxFooter();
$db->close();
