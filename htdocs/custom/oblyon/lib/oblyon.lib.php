<?php
	/************************************************
	* Copyright (C) 2015-2022  Alexandre Spangaro   <support@open-dsi.fr>
	* Copyright (C) 2022       Sylvain Legrand      <contact@infras.fr>
	*
	* This program is free software: you can redistribute it and/or modify
	* it under the terms of the GNU General Public License as published by
	* the Free Software Foundation, either version 3 of the License, or
	* (at your option) any later version.
	*
	* This program is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* GNU General Public License for more details.
	*
	* You should have received a copy of the GNU General Public License
	* along with this program.  If not, see <http://www.gnu.org/licenses/>.
	************************************************/

	/************************************************
	* 	\file		../oblyon/lib/oblyon.lib.php
	* 	\ingroup	oblyon
	* 	\brief		Manage Admin Pages
	************************************************/

	// Libraries ************************************
	require_once DOL_DOCUMENT_ROOT.'/core/class/html.form.class.php';
	require_once DOL_DOCUMENT_ROOT.'/core/class/html.formactions.class.php';
	require_once DOL_DOCUMENT_ROOT.'/core/class/html.formcompany.class.php';
	require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';
	require_once DOL_DOCUMENT_ROOT.'/core/class/html.formother.class.php';

	function oblyon_admin_prepare_head()
	{
		global $langs, $conf;

		$langs->load("oblyon@oblyon");

		$h = 0;
		$head = array();

		$head[$h][0] = dol_buildpath("/oblyon/admin/menus.php", 1);
		$head[$h][1] = $langs->trans("Menus");
		$head[$h][2] = 'menus';
		$h++;

		if(!empty($conf->global->EASYA_VERSION)) {
            if ((float)$conf->global->EASYA_VERSION >= 2022.5) {
                $head[$h][0] = dol_buildpath("/oblyon/admin/icons.php", 1);
                $head[$h][1] = $langs->trans("Icons");
                $head[$h][2] = 'icons';
                $h++;
            }
        }

		$head[$h][0] = dol_buildpath("/oblyon/admin/colors.php", 1);
		$head[$h][1] = $langs->trans("Colors");
		$head[$h][2] = 'colors';
		$h++;

		$head[$h][0] = dol_buildpath("/oblyon/admin/dashboard.php", 1);
		$head[$h][1] = $langs->trans("Dashboard");
		$head[$h][2] = 'dashboard';
		$h++;

		$head[$h][0] = dol_buildpath("/oblyon/admin/login.php", 1);
		$head[$h][1] = $langs->trans("LoginPage");
		$head[$h][2] = 'login';
		$h++;

		$head[$h][0] = dol_buildpath("/oblyon/admin/options.php", 1);
		$head[$h][1] = $langs->trans("Options");
		$head[$h][2] = 'options';
		$h++;

        $head[$h][0] = dol_buildpath("/oblyon/admin/customcss.php", 1);
        $head[$h][1] = $langs->trans("CustomCSS");
        $head[$h][2] = 'customcss';
        $h++;

		// Show more tabs from modules
		// Entries must be declared in modules descriptor with line
		//$this->tabs = array(
		//	'entity:+tabname:Title:@oblyon:/oblyon/mypage.php?id=__ID__'
		//); // to add new tab
		//$this->tabs = array(
		//	'entity:-tabname:Title:@oblyon:/oblyon/mypage.php?id=__ID__'
		//); // to remove a tab
		complete_head_from_modules($conf, $langs, null, $head, $h, 'admin_oblyon');

        complete_head_from_modules($conf, $langs, null, $head, $h, 'admin_oblyon', 'remove');

		if(empty($conf->global->EASYA_VERSION)) {
			$head[$h][0] = dol_buildpath("/oblyon/admin/about.php", 1);
			$head[$h][1] = $langs->trans("About");
			$head[$h][2] = 'about';
			$h++;
		}

		return $head;
	}

	/************************************************
	*	Sauvegarde les paramètres du module
	*
	*	@param		string		$appliname	module name
	*	@return		string		1 = Ok or -1 = Ko or or 0 and error message
	************************************************/
	function oblyon_bkup_module ($appliname)
	{
		global $db, $conf, $langs, $errormsg;

		// Set to UTF-8
		if (is_a($db, 'DoliDBMysqli'))	$db->db->set_charset('utf8');
		else {
			$db->query('SET NAMES utf8');
			$db->query('SET CHARACTER SET utf8');
		}
		// Control dir and file
		$path		= DOL_DATA_ROOT.'/'.(empty($conf->global->MAIN_MODULE_MULTICOMPANY) || $conf->entity == 1 ? '' : $conf->entity.'/').$appliname.'/sql';
		$bkpfile	= $path.'/update.'.$conf->entity;
		if (! file_exists($path)) {
			if (dol_mkdir($path) < 0) {
				$errormsg	= $langs->transnoentities('ErrorCanNotCreateDir', $path);
				return 0;
			}
		}
		if (file_exists($path)) {
			$handle	= fopen($bkpfile, 'w+');
			if (fwrite($handle, '') === FALSE) {
				$langs->load('errors');
				$errormsg	= $langs->trans('ErrorFailedToWriteInDir');
				return -1;
			}
			// Print headers and global mysql config vars
			$sqlhead	= '-- '.$db::LABEL.' dump via php with Dolibarr '.DOL_VERSION.'
--
-- Host: '.$db->db->host_info.'    Database: '.$db->database_name.'
-- ------------------------------------------------------
-- Server version			'.$db->db->server_info.'
-- Dolibarr version			'.DOL_VERSION.'

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = \'NO_AUTO_VALUE_ON_ZERO\';
';
			fwrite($handle, $sqlhead);
			$sql_const		= 'SELECT name, entity, value, type, visible, note';
			$sql_const		.= ' FROM '.MAIN_DB_PREFIX.'const';
			$sql_const		.= ' WHERE (name LIKE "FIX\_AREAREF\_TABACTION" OR name LIKE "MAIN\_DISABLE\_BLOCK\_%" OR name LIKE "MAIN\_DISABLE\_GLOBAL\_%" OR name LIKE "MAIN\_DISABLE\_METEO" OR';
			$sql_const		.= ' name LIKE "MAIN\_FONTAWESOME\_%" OR name LIKE "MAIN\_LOGIN\_RIGHT" OR name LIKE "MAIN\_MENU\_INVERT" OR name LIKE "MAIN\_SHOW\_LOGO" OR';
			$sql_const		.= ' name LIKE "MAIN\_STATUS\_USES\_IMAGES" OR name LIKE "MAIN\_USE\_TOP\_MENU\_%" OR name LIKE "OBLYON\_%" OR name LIKE "THEME\_%")';
			$sql_const		.= ' AND entity = "'.$conf->entity.'"';
			$sql_const		.= ' ORDER BY name';
			$listeCols		= array ('name', 'entity', 'value', 'type', 'visible', 'note');
			$duplicate		= array ('2', 'value', 'name');
			fwrite($handle, oblyon_bkup_table ('const', $sql_const, $listeCols, $duplicate));
			// Enabling back the keys/index checking
			$sqlfooter		= '
SET FOREIGN_KEY_CHECKS = 1;

-- Dump completed on '.date('Y-m-d G-i-s').'
';
			fwrite($handle, $sqlfooter);
			fclose($handle);
			if (file_exists($bkpfile))	$moved	= dol_copy($bkpfile, DOL_DATA_ROOT.($conf->entity != 1 ? '/'.$conf->entity : '').'/admin/'.$appliname.'_update'.date('Y-m-d-G-i-s').'.'.$conf->entity);
			return 1;
		}
	}

	/************************************************
	*	Recherche d'un fichier contenant un code langue dans son nom à partir d'une liste
	*
	*	@param	string	$table		table name to backup
	*	@param	string	$sql		sql query to prepare data  for backup
	*	@param	array	$listeCols	list of columns to backup on the table
	*	@param	array	$duplicate	values for 'ON DUPLICATE KEY UPDATE'
	*									[0] = column to update
	*									[1] = column name to update
	*									[2] = key value for conflict control (only postgreSQL)
	*	@param	boolean	$truncate	truncate the table before restore
	*	@param	string	$add		sql data to add on the beginning of the query
	*	@return	string				sql query to restore the datas
	************************************************/
	function oblyon_bkup_table ($table, $sql, $listeCols, $duplicate = array (), $truncate = 0, $add = '')
	{
		global $db, $conf, $langs, $errormsg;

		$sqlnewtable	= '';
		$result_sql		= $sql ? $db->query($sql) : '';
		dol_syslog('oblyon.Lib::oblyon_bkup_table sql = '.$sql);
		if ($result_sql) {
			$truncate		= $truncate ? 'TRUNCATE TABLE '.MAIN_DB_PREFIX.$table.';
' : '';
			$sqlnewtable	= '
-- Dumping data for table '.MAIN_DB_PREFIX.$table.'
'.$truncate.$add;
			while($row	= $db->fetch_row($result_sql)) {
				// For each row of data we print a line of INSERT
				$colsInsert						= '';
				foreach ($listeCols as $col)	$colsInsert	.= $col.', ';
				$sqlnewtable					.= 'INSERT INTO '.MAIN_DB_PREFIX.$table.' ('.substr($colsInsert, 0, -2).') VALUES (';
				$columns						= count($row);
				$duplicateValue					= '';
				for($j = 0; $j < $columns; $j++) {
					// Processing each column of the row to ensure that we correctly save the value (eg: add quotes for string - in fact we add quotes for everything, it's easier)
					if ($row[$j] == null && !is_string($row[$j]))	$row[$j]	= 'NULL';	// IMPORTANT: if the field is NULL we set it NULL
					elseif(is_string($row[$j]) && $row[$j] == '')	$row[$j]	= '\'\'';	// if it's an empty string, we set it as an empty string
					else {
						$row[$j]	= addslashes($row[$j]);
						$row[$j]	= preg_replace('#\n#', '\\n', $row[$j]);
						$row[$j]	= '\''.$row[$j].'\'';
					}
					if ($j == 1)	$row[$j]	= '\'__ENTITY__\'';
					if (!empty($duplicate)) {
						$onDuplicate	= $db->type == 'pgsql' ? ' ON CONFLICT ('.$duplicate[2].') DO UPDATE SET ' : ' ON DUPLICATE KEY UPDATE ';
						$duplicateValue .= $j == $duplicate[0] ? $onDuplicate.$duplicate[1].' = '.$row[$j] : '';
					}
				}
				$sqlnewtable	.= implode(', ', $row).')'.$duplicateValue.';
';
			}
		}
		return $sqlnewtable;
	}

	/************************************************
	*	Restaure les paramètres du module
	*
	*	@param		string		$appliname	module name
	*	@return		string		1 = Ok or -1 = Ko
	************************************************/
	function oblyon_restore_module ($appliname)
	{
		global $conf;

		$pathsql	= DOL_DATA_ROOT.'/'.(empty($conf->global->MAIN_MODULE_MULTICOMPANY) || $conf->entity == 1 ? '' : $conf->entity.'/').$appliname.'/sql';
		$handle		= @opendir($pathsql);
		if (is_resource($handle)) {
			$filesql						= $pathsql.'/'.'update.'.$conf->entity;
			$moved							= dol_copy($filesql, $filesql.'.sql');
			if (is_file($filesql.'.sql'))	$result	= run_sql($filesql.'.sql', (empty($conf->global->MAIN_DISPLAY_SQL_INSTALL_LOG) ? 1 : 0), $conf->entity, 1);
			$delete							= dol_delete_file($filesql.'.sql');
			dol_syslog('oblyon.Lib::oblyon_restore_module appliname = '.$appliname.' filesql = '.$filesql.' moved = '.$moved.' result = '.$result.' delete = '.$delete);
			if ($result > 0)				return 1;
		}
		return -1;
	}
	/************************************************
	*	Print HTML backup / restore section
	*
	*	@return		void
	************************************************/
	function oblyon_print_backup_restore()
	{
		global $conf, $langs;

		print '	<table class="centpercent noborder">';
		$metas	= array('*', '90px', '156px', '120px');
		oblyon_print_colgroup($metas);
		print '		<tr>
						<td colspan="2" class="center" style = "font-size: 14px;">
							<a href = "'.DOL_URL_ROOT.'/document.php?modulepart=oblyon&file=sql/update.'.$conf->entity.'">'.$langs->trans('OblyonParamAction1').' <b><span color = "#D51123">'.$langs->trans('Module113900Name').'</span></b> <span size = "2">'.$langs->trans('OblyonParamAction2').'</span></a>
						</td>
						<td class="center"><button class = "butActionBackup" type = "submit" value = "bkupParams" name = "action">'.$langs->trans('OblyonParamBkup').'</button></td>
						<td class="center"><button class = "butActionBackup" type = "submit" value = "restoreParams" name = "action">'.$langs->trans('OblyonParamRestore').'</button></td>
					</tr>
					<tr><td colspan = "4" class="center" style = "padding: 0;"><hr></td></tr>
					<tr><td colspan = "4" style="line-height: 1px;">&nbsp;</td></tr>
				</table>';
	}

	/************************************************
	*	Print HTML colgroup for admin page
	*
	*	@param		array		$metas	list of col value
	*	@return		void
	************************************************/
	function oblyon_print_colgroup($metas = array())
	{
		print '	<tr>';
		foreach ($metas as $values)	print '<td class = "paramsFinal" style = "padding: 0px; height: 1px;'.($values == '*' ? '' : ' width: '.$values.';').'">&nbsp;</td>';
		print '	</tr>';
	}

	/************************************************
	*	Print HTML title for admin page
	*
	*	@param		array		$metas	list of col value
	*	@return		void
	************************************************/
	function oblyon_print_liste_titre($metas = array())
	{
		global $langs;

		print '	<tr class = "liste_titre">';
		for ($i = 1 ; $i < count($metas) ; $i++)
			print '	<td colspan = "'.$metas[0][$i - 1].'" class = "left">'.$langs->trans($metas[$i]).'</td>';
		print '	</tr>';
	}

	/************************************************
	*	Print HTML action button for admin page
	*
	*	@param		string		$action		action name (with prefix => 'update_')
	*	@return		void
	************************************************/
	function oblyon_print_btn_action($action)
	{
		global $langs;

		print '	<div class = "center">
					<button class = "button button-save reposition" type = "submit" value = "update_'.$action.'" id = "action" name = "action">'.$langs->trans('Save').'</button>
				</div>';
	}

	/************************************************
	*	Print HTML HR line
	*
    *	@param		int			$cs1		first colspan
	*	@return		void
	************************************************/
	function oblyon_print_hr($cs1 = 3)
	{
		print '	<tr><td colspan = "'.$cs1.'"><hr class = "paramsHR"></td></tr>';
	}

	/************************************************
	*	Print HTML final line
	*
    *	@param		int			$cs1		first colspan
	*	@return		void
	************************************************/
	function oblyon_print_final($cs1 = 3)
	{
		print '	<tr><td colspan = "'.$cs1.'" class = "paramsFinal">&nbsp;</td></tr>';
	}

	/************************************************
	*	Print HTML action button for admin page
	*
	*	@param		string		$confkey	action name (with prefix => 'update_')
	*	@param		string		$tag		input type (on/off button, input, textarea, color select, select, range, select_types_paiements, selectTypeContact)
	*	@param		string		$desc		Description of action
	*	@param		string		$help		Help description => active tooltip
	*	@param		array		$metas		list of HTML parameters and values (example : 'type'=>'text' and/or 'class'=>'flat center', etc...)
	*	@param		int			$cs1		first colspan
	*	@param		int			$cs2		second colspan
	*	@param		string		$begin		if input element string to be added before or empty td to begin the line
	*	@param		string		$end		if input element string to be added after or empty td to finish the line
	*	@return		void
	************************************************/
	function oblyon_print_input($confkey, $tag = 'on_off', $desc = '', $help = '', $metas = array(), $cs1 = '2', $cs2 = '1', $begin = '', $end = '')
	{
		global $langs, $conf, $db;

		$form			= new Form($db);
		$formother		= new FormOther($db);
		$formcompany	= new FormCompany($db);
		$formactions	= new FormActions($db);
		print '	<tr class = "oddeven">';
		if ($tag != 'textarea') {
			print '	<td colspan = "'.$cs1.'">';
			if (!empty($help))	print $form->textwithtooltip(($desc ? $desc : $langs->trans($confkey)), $langs->trans($help), 2, 1, img_help(1, ''));
			else				print $desc ? $desc : $langs->trans($confkey);
			print '	</td>
					<td colspan = "'.$cs2.'" class = "center">';
		}
		else {
			print '	<td colspan = "'.($cs1 + $cs2).'" class = "center">';
			if (!empty($desc))	print $desc.'<br/>';
		}
		print  (!empty($begin) && !preg_match('/<td(.*)/', $begin, $reg) ? $begin : '');
		if ($tag == 'on_off') {
			print ajax_constantonoff($confkey, $metas[0], $metas[1], $metas[2], $metas[3], $metas[4], $metas[5], $metas[6], $metas[7], $metas[8], $metas[9]);
		}
		if ($tag == 'on_off2')
			print '		<a href = "'.$_SERVER['PHP_SELF'].'?action=set_'.$confkey.'&token='.newToken().'&value='.(strpos($conf->global->$confkey, $metas) !== false ? '0' : '1').'">
							'.(strpos($conf->global->$confkey, $metas) !== false ? img_picto($langs->trans('Activated'), 'switch_on') : img_picto($langs->trans('Disabled'), 'switch_off')).'
						</a>';
		elseif ($tag == 'input') {
            $constantKey                        = !empty($conf->global->$confkey) ? $conf->global->$confkey : 0;
			$defaultMetas						= array('type' => 'text', 'class' => 'flat quatrevingtpercent', 'style' => 'padding: 0; font-size: inherit;', 'name' => $confkey, 'id' => $confkey, 'value' => $constantKey);
			$metas								= array_merge ($defaultMetas, $metas);
			$metascompil						= '';
			foreach ($metas as $key => $value)	$metascompil	.= ' '.$key.($key == 'enabled' || $key == 'disabled' ? '' : ' = "'.$value.'"');
			print '	<'.$tag.' '.$metascompil.'>'.(!preg_match('/<td(.*)/', $end, $reg) ? $end : '');
		}
		elseif ($tag == 'textarea') {
			if (empty($conf->global->PDF_ALLOW_HTML_FOR_FREE_TEXT))	print '<textarea name = "'.$confkey.'" class = "flat" cols = "120">'.$conf->global->$confkey.'</textarea>';
			else {
				$doleditor	= new DolEditor($confkey, $conf->global->$confkey, '', 80, 'dolibarr_notes');
				print $doleditor->Create();
			}
		}
		elseif ($tag == 'color')						print $formother->selectColor($metas, $confkey);
		elseif ($tag == 'select' || $tag == 'range')	print $metas;
		elseif ($tag == 'select_types_paiements')		$form->select_types_paiements($conf->global->$confkey, $confkey, $metas[0], $metas[1], $metas[2], $metas[3], $metas[4]);
		elseif ($tag == 'selectTypeContact')			print $formcompany->selectTypeContact($metas[0], $metas[1], $confkey, $metas[2], $metas[3], $metas[4], $metas[5]);
		elseif ($tag == 'select_type_actions')			$formactions->select_type_actions($conf->global->$confkey, $confkey, $metas[0], $metas[1], $metas[2]);
		if (!preg_match('/<td(.*)/', $end, $reg))	print $end;
		print '		</td>';
		if (preg_match('/<td(.*)/', $end, $reg))	print $end;
		print '	</tr>';
	}
?>