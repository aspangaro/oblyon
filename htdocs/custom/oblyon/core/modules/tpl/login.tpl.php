<?php
/* Copyright (C) 2009-2015 Regis Houssin <regis.houssin@inodbox.com>
 * Copyright (C) 2011-2013 Laurent Destailleur <eldy@users.sourceforge.net>
 * Copyright (C) 2022 Progiseize <contact@progiseize.fr>
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
 */

// Need global variable $title to be defined by caller (like dol_loginfunction)
// Caller can also set 	$morelogincontent = array(['options']=>array('js'=>..., 'table'=>...);


// Protection to avoid direct call of template
if (empty($conf) || !is_object($conf)) { print "Error, template page can't be called as URL"; exit;}

if($conf->global->OBLYON_ACTIVE_LOGIN_PERSONALIZED):

	require_once DOL_DOCUMENT_ROOT.'/core/lib/functions2.lib.php';

	header('Cache-Control: Public, must-revalidate');
	header("Content-type: text/html; charset=".$conf->file->character_set_client);

	if (GETPOST('dol_hide_topmenu')) $conf->dol_hide_topmenu = 1;
	if (GETPOST('dol_hide_leftmenu')) $conf->dol_hide_leftmenu = 1;
	if (GETPOST('dol_optimize_smallscreen')) $conf->dol_optimize_smallscreen = 1;
	if (GETPOST('dol_no_mouse_hover')) $conf->dol_no_mouse_hover = 1;
	if (GETPOST('dol_use_jmobile')) $conf->dol_use_jmobile = 1;



	// If we force to use jmobile, then we reenable javascript
	if (!empty($conf->dol_use_jmobile)) $conf->use_javascript_ajax = 1;

	$php_self = dol_escape_htmltag($_SERVER['PHP_SELF']);
	$php_self .= dol_escape_htmltag($_SERVER["QUERY_STRING"]) ? '?'.dol_escape_htmltag($_SERVER["QUERY_STRING"]) : '';
	if (!preg_match('/mainmenu=/', $php_self)) $php_self .= (preg_match('/\?/', $php_self) ? '&' : '?').'mainmenu=home';

	// Javascript code on logon page only to detect user tz, dst_observed, dst_first, dst_second
	$arrayofjs = array(
		'/includes/jstz/jstz.min.js'.(empty($conf->dol_use_jmobile) ? '' : '?version='.urlencode(DOL_VERSION)),
		'/core/js/dst.js'.(empty($conf->dol_use_jmobile) ? '' : '?version='.urlencode(DOL_VERSION))
	);
	$titleofloginpage = $langs->trans('Login').' @ '.$titletruedolibarrversion; // $titletruedolibarrversion is defined by dol_loginfunction in security2.lib.php. We must keep the @, some tools use it to know it is login page and find true dolibarr version.

	$disablenofollow = 1;
	if (!preg_match('/'.constant('DOL_APPLICATION_TITLE').'/', $title)) $disablenofollow = 0;
	if (!empty($conf->global->MAIN_OPTIMIZEFORTEXTBROWSER)) $disablenofollow = 0;

	print top_htmlhead('', $titleofloginpage, 0, 0, $arrayofjs, $arrayofcss, 0, $disablenofollow);



	/***********************************************************************************************************************************/
	?>
	<style type="text/css">
	:root {

	  --shape-color: <?php echo $conf->global->LOGINPLUS_SHAPE_COLOR; ?>;
	  --shape-opacity: <?php echo $conf->global->LOGINPLUS_SHAPE_OPACITY / 100; ?>;
	  --bg-color: <?php echo $conf->global->LOGINPLUS_BG_COLOR; ?>;
	  --bg-imageopacity: <?php echo $conf->global->LOGINPLUS_BG_IMAGEOPACITY / 100; ?>;
	  --main-color: <?php echo $conf->global->LOGINPLUS_MAIN_COLOR; ?>;
	  --second-color: <?php echo $conf->global->LOGINPLUS_SECOND_COLOR; ?>;
	  --image-opacity: <?php echo $conf->global->LOGINPLUS_IMAGE_OPACITY / 100; ?>;
	  --image-color: <?php echo $conf->global->LOGINPLUS_IMAGE_COLOR; ?>;
	  --txt-titlecolor: <?php echo $conf->global->LOGINPLUS_TXT_TITLECOLOR; ?>;
	  --txt-contentcolor: <?php echo $conf->global->LOGINPLUS_TXT_CONTENTCOLOR; ?>;
	  --copyright-color: <?php echo $conf->global->LOGINPLUS_COPYRIGHT_COLOR; ?>;
	}

	</style>


	<!-- BEGIN PHP CUSTOM TEMPLATE loginplus! LOGIN.TPL.PHP -->
	<body id="loginplus" class="tpl-1" >
		<?php if(!empty($conf->global->LOGINPLUS_BG_IMAGEKEY)): ?>
			<div class="loginplus-bgimage" style="background-image: url('<?php echo $conf->file->dol_url_root['main']; ?>/document.php?hashp=<?php echo $conf->global->LOGINPLUS_BG_IMAGEKEY; ?>');background-position: center;"></div>
		<?php endif; ?>

		<div class="loginplus-wrapper <?php if(!empty($conf->global->LOGINPLUS_SHAPE_PATH)): echo $conf->global->LOGINPLUS_SHAPE_PATH; endif; ?>">
			<div class="loginplus-wrapperbox <?php if(!$conf->global->LOGINPLUS_TWOSIDES): echo 'ld-one-side';endif;?>">

				<div class="loginplus-wrapperbox-side image-side <?php if(!$conf->global->LOGINPLUS_TWOSIDES): echo 'ld-hide';endif;?>">
					<?php if(!empty($conf->global->LOGINPLUS_IMAGE_KEY)): ?>
						<div class="loginplus-img" style="background-image: url('<?php echo $conf->file->dol_url_root['main']; ?>/document.php?hashp=<?php echo $conf->global->LOGINPLUS_IMAGE_KEY; ?>');background-size: cover;background-position: center;"></div>
					<?php endif; ?>
						<div class="loginplus-txt">
							<?php if(!empty($conf->global->LOGINPLUS_TXT_TITLE)): echo '<h2>'.$conf->global->LOGINPLUS_TXT_TITLE.'</h2>'; endif; ?>
							<?php if(!empty($conf->global->LOGINPLUS_TXT_CONTENT)): echo '<p>'.$conf->global->LOGINPLUS_TXT_CONTENT.'</p>'; endif; ?>
						</div>
				</div>

				<div class="loginplus-wrapperbox-side content-side <?php if(!$conf->global->LOGINPLUS_TWOSIDES): echo 'ld-extend';endif;?>">
					<img alt="" src="<?php echo $urllogo; ?>" id="loginplus-imglogo" />

					<form id="login" name="login" method="post" action="<?php echo $php_self; ?>">
						<input type="hidden" name="token" value="<?php echo newToken(); ?>" />
						<input type="hidden" name="actionlogin" value="login">
						<input type="hidden" name="loginfunction" value="loginfunction" />

						<input type="hidden" name="tz" id="tz" value="" />
						<input type="hidden" name="tz_string" id="tz_string" value="" />

						<input type="hidden" name="dol_hide_topmenu" id="dol_hide_topmenu" value="<?php echo $dol_hide_topmenu; ?>" />
						<input type="hidden" name="dol_hide_leftmenu" id="dol_hide_leftmenu" value="<?php echo $dol_hide_leftmenu; ?>" />
						<input type="hidden" name="dol_optimize_smallscreen" id="dol_optimize_smallscreen" value="<?php echo $dol_optimize_smallscreen; ?>" />
						<input type="hidden" name="dol_no_mouse_hover" id="dol_no_mouse_hover" value="<?php echo $dol_no_mouse_hover; ?>" />
						<input type="hidden" name="dol_use_jmobile" id="dol_use_jmobile" value="<?php echo $dol_use_jmobile; ?>" />


						
						<div class="fields-group" id="login_line1">
							<div id="login_right">
							<div class="field-row tagtable"><b>TEST REMPLACEMENT PAGE LOGIN</b>
								<?php if($conf->global->LOGINPLUS_SHOW_FORMLABELS): ?><label for="username" class="hidden"><i class="fa fa-user"></i> <?php echo $langs->trans("Login"); ?></label><?php endif; ?>
								<input type="text" id="username" name="username" class="" value="<?php echo dol_escape_htmltag($login); ?>" tabindex="1" autofocus="autofocus" />
							</div>

							<div class="field-row tagtable">
								<?php if($conf->global->LOGINPLUS_SHOW_FORMLABELS): ?><label for="password" class="hidden"><i class="fa fa-key"></i> <?php echo $langs->trans("Password"); ?></label><?php endif; ?>
								<input id="password" placeholder="<?php echo $langs->trans("Password"); ?>" name="password" class="" type="password" value="<?php echo dol_escape_htmltag($password); ?>" tabindex="2" autocomplete="<?php echo empty($conf->global->MAIN_LOGIN_ENABLE_PASSWORD_AUTOCOMPLETE) ? 'off' : 'on'; ?>" />
							</div>
							</div>
						</div>
						<div class="fields-group" id="login_line2">

							<div class="field-row align-center">
								<input type="submit" class="button" value="&nbsp; <?php echo $langs->trans('Connection'); ?> &nbsp;" tabindex="5" />
							</div>
							<div class="field-row align-center center">
								
							</div>
						</div>

						<?php
						if (!empty($conf->global->MAIN_HTML_FOOTER)): print $conf->global->MAIN_HTML_FOOTER; endif;
						if (!empty($morelogincontent)): 
							if (is_array($morelogincontent)):
								foreach ($morelogincontent as $format => $option):
									if ($format == 'table'):
										echo '<!-- Option by hook -->';
										echo $option;
									endif;
								endforeach;
							else:
							echo '<!-- Option by hook -->';
							echo $morelogincontent;
							endif;
						endif; ?>

					</form>

					<?php // AFFICHAGE DES MESSAGES D'ERREURS
					if (!empty($_SESSION['dol_loginmesg'])): ?>
						<div class="loginplus-error-msg">
							<?php echo $_SESSION['dol_loginmesg']; ?>
						</div>
					<?php endif; ?>

					<div class="loginplus-helplinks align-center">	
						<?php if ($forgetpasslink): $url = DOL_URL_ROOT.'/user/passwordforgotten.php'.$moreparam;
							if (!empty($conf->global->MAIN_PASSWORD_FORGOTLINK)): $url = $conf->global->MAIN_PASSWORD_FORGOTLINK; endif;
							echo '<a class="alogin" href="'.dol_escape_htmltag($url).'">'.$langs->trans('PasswordForgotten').'</a>';
						endif; ?>
						<?php if ($forgetpasslink && $helpcenterlink): echo ' - '; endif; ?>
						<?php if ($helpcenterlink): $url = DOL_URL_ROOT.'/support/index.php'.$moreparam;
							if (!empty($conf->global->MAIN_HELPCENTER_LINKTOUSE)) $url = $conf->global->MAIN_HELPCENTER_LINKTOUSE;
							echo '<a class="alogin" href="'.dol_escape_htmltag($url).'" target="_blank">'.$langs->trans('NeedHelpCenter').'</a>';
						endif; ?>
					</div>

				</div>
			</div>

			<?php if($conf->global->LOGINPLUS_COPYRIGHT): 

				$copyright_text = $conf->global->LOGINPLUS_COPYRIGHT;
				if($conf->global->LOGINPLUS_COPYRIGHT_LINK):
					$copyright_link = '<a href="'.$conf->global->LOGINPLUS_COPYRIGHT_LINK.'" target="_blank">';
					$copyright_text = str_replace('[', $copyright_link, $copyright_text);
					$copyright_text = str_replace(']', '</a>', $copyright_text);
				endif; ?>

				<div id="loginplus-copyright"><?php echo $copyright_text; ?></div>
			<?php endif; ?>
		</div>

		<!-- <div class="dol-version"><?php echo dol_escape_htmltag($title); ?></div> -->

	</body>
	</html>
	<!-- END PHP TEMPLATE -->

<?php else: include_once(DOL_DOCUMENT_ROOT.'/core/tpl/login.tpl.php'); ?>
<?php endif; ?>