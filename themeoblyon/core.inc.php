<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/core.inc.php
   Role      : Styles par defaut : variables CSS :root, typographie, liens, champs, module website
   Inclus par : global.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/* ============================================================================== */
/* Default styles																 */
/* ============================================================================== */

:root {
	--fontawesomeFamily: "<?php print $fontawesomeFamily; ?>";
	--fontawesomeBrands: "<?php print $fontawesomeBrands; ?>";
	--fontawesomeWeight: <?php print getDolGlobalString('MAIN_FONTAWESOME_WEIGHT', '900'); ?>;
	--bgcolor: <?php print $bgcolor; ?>;
	--colorbackhmenu1: <?php print $colorbackhmenu1; ?>;	/* InfraS change 3.7.0 : hex */
	--colorbackvmenu1: <?php print $colorbackvmenu1; ?>;	/* InfraS change 3.7.0 : hex */
	--colorbacktitle1: <?php print $colorbacktitle1; ?>;	/* InfraS change 3.7.0 : hex */
	--colorbacktabcard1: <?php print $colorbacktabcard1; ?>;	/* InfraS change 3.7.0 : hex */
	--colorbacktabactive: <?php print $colorbacktabactive; ?>;	/* InfraS change 3.7.0 : hex */
	--colorbacklineimpair1: <?php print $colorbacklineimpair1; ?>;	/* InfraS change 3.7.0 : hex */
	--colorbacklineimpair2: <?php print $colorbacklineimpair2; ?>;	/* InfraS change 3.7.0 : hex */
	--colorbacklinepair1: <?php print $colorbacklinepair1; ?>;	/* InfraS change 3.7.0 : hex */
	--colorbacklinepair2: <?php print $colorbacklinepair2; ?>;	/* InfraS change 3.7.0 : hex */
	--colorbacklinepairhover: <?php print $colorbacklinepairhover; ?>;	/* InfraS change 3.7.0 : hex */
	--colorbacklinepairchecked: <?php print $colorbacklinepairchecked; ?>;	/* InfraS change 3.7.0 : hex */
	--colorbacklinebreak: <?php print $colorbacklinebreak; ?>;	/* InfraS change 3.7.0 : hex */
	--colorbackbody: <?php print $colorbackbody; ?>;	/* InfraS change 3.7.0 : hex */
	--colorbackmobilemenu: #f8f8f8;
	--colorbackgrey: #f0f0f0;
	--colorbline: <?php print $colorbline; ?>;
	--colorbline_hover: <?php print $colorbline_hover; ?>;
	--colorfline: <?php print $colorfline; ?>;
	--colorbtotal: <?php print $colorbtotal; ?>;
	--colorftotal: <?php print $colorftotal; ?>;
	--colorfline_hover: <?php print $colorfline_hover; ?>;
	--colorbtitle: <?php print $colorbtitle; ?>;
	--colorstitle: <?php print $colorstitle; ?>;
	--colortexttitlenotab: <?php print $colortexttitlenotab; ?>;	/* InfraS change 3.7.0 : hex */
	--colortexttitlenotab2: <?php print $colortexttitlenotab2; ?>;	/* InfraS change 3.7.0 : hex */
	--colortexttitle: <?php print $colortexttitle; ?>;	/* InfraS change 3.7.0 : hex */
	--colortexttitlelink: <?php print colorHexToRgb($colortexttitlelink, 0.9); ?>;	/* InfraS change 3.7.0 : hex -> rgba() */
	--colortext: <?php print $colortext; ?>;	/* InfraS change 3.7.0 : hex */
	--colortextlink: <?php print $colortextlink; ?>;	/* InfraS change 3.7.0 : hex */
	--colortextbackhmenu: #<?php print $colortextbackhmenu; ?>;
	--colorAutocompleteBg: <?php print $colorAutocompleteBg; ?>;
	--colorAutocompleteText: <?php print $colorAutocompleteText; ?>;
	--colorChipBg: <?php print $colorChipBg; ?>;
	--colorChipText: <?php print $colorChipText; ?>;
	--colorResultBg: <?php print $colorResultBg; ?>;
	--colorResultText: <?php print $colorResultText; ?>;
	--colortextbackvmenu: #<?php print $colortextbackvmenu; ?>;
	--colortopbordertitle1: <?php print $colortopbordertitle1; ?>;	/* InfraS change 3.7.0 : hex */
	--listetotal: #888888;
	--inputbackgroundcolor: <?php print $colorBckgrdInput; ?>;
	--color1BckgrdInfobox: <?php print $color1BckgrdInfobox; ?>;
	--color2BckgrdInfobox: <?php print $color2BckgrdInfobox; ?>;
	--colorBorderActionColumn: <?php print $colorBorderActionColumn; ?>;
	--inputbordercolor: rgba(0,0,0,.15);
	--tooltipbgcolor: <?php print $toolTipBgColor; ?>;
	--tooltipfontcolor : <?php print $toolTipFontColor; ?>;
	--oddevencolor: #202020;
	--bgnavleft: <?php print $bgnavleft; ?>;
	--bgnavleft_hover: <?php print $bgnavleft_hover; ?>;
	--bgnavtop: <?php print $bgnavtop; ?>;
	--bgnavtop_hover: <?php print $bgnavtop_hover; ?>;
	--bgnavtop_txt: <?php print $bgnavtop_txt; ?>;
	--bgnavtop_txt_hover: <?php print $bgnavtop_txt_hover; ?>;
	--bgnavtop_txt_active: <?php print $bgnavtop_txt_active; ?>;
	--colorboxstatsborder: <?php print $bgnavtop; ?>;
	--dolgraphbg: rgba(255,255,255,0);
	--fieldrequiredcolor: #400030;
	--fontfamilydol:<?php print $fontlisted; ?>;
	--fontsize:<?php print $fontsize; ?>px;
	--colortextbacktab: <?php print $colorTextTabActive; ?>;
	--colorboxiconbg: #eee;
	--refidnocolor:#444;
	--tableforfieldcolor:#666;
	/* InfraS change begin : couleurs par utilisateur (3.6.0) : oblyon_color_setting() */
	--amountremaintopaycolor:<?php print oblyon_color_setting('OBLYON_COLOR_AMOUNT_REMAIN', '#880000'); ?>;
	--amountpaymentcomplete:<?php print oblyon_color_setting('OBLYON_COLOR_AMOUNT_PAID', '#008800'); ?>;
	--colorunpaid: <?php print oblyon_color_setting('OBLYON_COLOR_AMOUNT_UNPAID', '#550000'); ?>;
	--colorstatussuccess: <?php print oblyon_color_setting('OBLYON_COLOR_STATUS_SUCCESS', '#00a65a'); ?>;
	--colorstatusinfo: <?php print oblyon_color_setting('OBLYON_COLOR_STATUS_INFO', '#00c0ef'); ?>;
	--colorstatuswarning: <?php print oblyon_color_setting('OBLYON_COLOR_STATUS_WARNING', '#f39c12'); ?>;
	--colorstatusdanger: <?php print oblyon_color_setting('OBLYON_COLOR_STATUS_DANGER', '#dd4b39'); ?>;
	--colorstatusprimary: <?php print oblyon_color_setting('OBLYON_COLOR_STATUS_PRIMARY', '#337ab7'); ?>;
	--colorprogressbar: <?php print oblyon_color_setting('OBLYON_COLOR_PROGRESSBAR', '#3c8dbc'); ?>;
	--colortimelineitem: <?php print oblyon_color_setting('OBLYON_COLOR_TIMELINEITEM', '#0073b7'); ?>;
	--colorweatherlevel0: <?php print oblyon_color_setting('OBLYON_COLOR_WEATHER_LEVEL0', '#cfbf00'); ?>;
	--colorweatherlevel1: <?php print oblyon_color_setting('OBLYON_COLOR_WEATHER_LEVEL1', '#bc9526'); ?>;
	--colorweatherlevel2: <?php print oblyon_color_setting('OBLYON_COLOR_WEATHER_LEVEL2', '#b16000'); ?>;
	--colorweatherlevel3: <?php print oblyon_color_setting('OBLYON_COLOR_WEATHER_LEVEL3', '#b04000'); ?>;
	--colorweatherlevel4: <?php print oblyon_color_setting('OBLYON_COLOR_WEATHER_LEVEL4', '#993013'); ?>;
	--colorinfoboxupdate: <?php print oblyon_color_setting('OBLYON_COLOR_INFOBOX_UPDATE', '#bc9525'); ?>;
	/* InfraS change end */
	--amountremaintopaybackcolor:none;
	--productlinestockod: #002200;
	--productlinestocktoolow: #884400;
	--infoboxmoduleenabledbgcolor : linear-gradient(0.4turn, #fff, #fff, #fff, #e4efe8);
	--invertratiofilter: <?php print $invertratiofilter; ?>;
	--colorfdatedefault: <?php print $colorfdatedefault; ?>;
	--colorfdateselected: <?php print $colorfdateselected; ?>;
	--bgnavleft_txt: <?php print $bgnavleft_txt; ?>;
	--bgnavleft_txt_active: <?php print $bgnavleft_txt_active; ?>;
	--bgnavleft_txt_hover: <?php print $bgnavleft_txt_hover; ?>;
	--prospectback: <?php print $prospectback; ?>;
	--customerback: <?php print $customerback; ?>;
	--vendorback: <?php print $vendorback; ?>;
	--userback: <?php print $userback; ?>;
	--colornature: <?php print $colornature; ?>;
	--member_companyback: <?php print $member_companyback; ?>;
	--member_individualback: <?php print $member_individualback; ?>;
	--colormember: <?php print $colormember; ?>;
	--maincolor: <?php print $maincolor; ?>;
	--colorErrorBg: <?php print $colorErrorBg; ?>;
	--colorErrorBorder: <?php print $colorErrorBorder; ?>;
	--colorErrorTxt: <?php print $colorErrorTxt; ?>;
	--colorInfoBg: <?php print $colorInfoBg; ?>;
	--colorInfoBorder: <?php print $colorInfoBorder; ?>;
	--colorInfoTxt: <?php print $colorInfoTxt; ?>;
	--colorWarningBg: <?php print $colorWarningBg; ?>;
	--colorWarningBorder: <?php print $colorWarningBorder; ?>;
	--colorWarningTxt: <?php print $colorWarningTxt; ?>;
	/* couleurs des notifications jNotify (groupe Messages), lues par style.css.php mais jamais imprimees jusqu'ici */
	--colorNotifInfoBg: <?php print $colorNotifInfoBg; ?>;
	--colorNotifInfoTxt: <?php print $colorNotifInfoTxt; ?>;
	--colorNotifWarningBg: <?php print $colorNotifWarningBg; ?>;
	--colorNotifWarningTxt: <?php print $colorNotifWarningTxt; ?>;
	--colorNotifErrorBg: <?php print $colorNotifErrorBg; ?>;
	--colorNotifErrorTxt: <?php print $colorNotifErrorTxt; ?>;
	--colorButtonAction1: <?php print $colorButtonAction1; ?>;
	--colorButtonAction2: <?php print $colorButtonAction2; ?>;
	--colorTextButtonAction: <?php print $colorTextButtonAction; ?>;
	--badgeDanger: <?php print $badgeDanger; ?>;
	--badgeDark: <?php print $badgeDark; ?>;
	--badgeInfo: <?php print $badgeInfo; ?>;
	--badgeLight: <?php print $badgeLight; ?>;
	--badgePrimary: <?php print $badgePrimary; ?>;
	--badgeSuccess: <?php print $badgeSuccess; ?>;
	--badgeWarning: <?php print $badgeWarning; ?>;
	--colorblind_deuteranopes_badgeWarning: <?php print $colorblind_deuteranopes_badgeWarning; ?>;
	--colorButtonDelete1: <?php print $colorButtonDelete1; ?>;
	--colorButtonDelete2: <?php print $colorButtonDelete2; ?>;
	--topMenuFontSize: <?php print $topMenuFontSize; ?>;
	--logo_background_color: <?php print $logo_background_color; ?>;
	--badgeSecondary: <?php print $badgeSecondary; ?>;
	--topmenu_hover: <?php print $topmenu_hover; ?>;
	/* InfraS add begin : jetons dedies 3.7.0 */
	--bgnavtop_sel: <?php print $bgnavtop_sel; ?>;
	--bgnavtop_txt_sel: <?php print $bgnavtop_txt_sel; ?>;
	--colorAmountText: <?php print $colorAmountText; ?>;
	--colorCalEventTxt: <?php print $colorCalEventTxt; ?>;
	--colorCalWeekendBg: <?php print $colorCalWeekendBg; ?>;
	--colorCalHolidayBg: <?php print $colorCalHolidayBg; ?>;
	--colorOverlayBg: <?php print $colorOverlayBg; ?>;
	--colorStockOk: <?php print $colorStockOk; ?>;
	--colorStockLow: <?php print $colorStockLow; ?>;
	--colorStockExit: <?php print $colorStockExit; ?>;
	--colorIconText: <?php print $colorIconText; ?>;
	--colorTimelineBg: <?php print $colorTimelineBg; ?>;
	--colorTimelinePrivateBg: <?php print $colorTimelinePrivateBg; ?>;
	/* InfraS add end */
	--textDanger: <?php print $textDanger; ?>;
	--textSuccess: <?php print $textSuccess; ?>;
	--textWarning: <?php print $textWarning; ?>;
	--colorblind_deuteranopes_textSuccess: <?php print $colorblind_deuteranopes_textSuccess; ?>;
	--colorblind_deuteranopes_textWarning: <?php print $colorblind_deuteranopes_textWarning; ?>;
	--fontlist: <?php print $fontlist; ?>;
	--fontmainmenu: <?php print $fontmainmenu; ?>;
	--fontmenubookmarks: <?php print $fontmenubookmarks; ?>;
	--fontmenuhelp: <?php print $fontmenuhelp; ?>;
	--fontmenusearch: <?php print $fontmenusearch; ?>;
	--borderwidth: <?php print $borderwidth; ?>px;
	--infras_radius: <?php print $infras_radius; ?>px;
	--fontsizesmaller: <?php print $fontsizesmaller; ?>px;
	--heightmenu: <?php print $heightmenu; ?>px;
	--minwidthtmenu: <?php print $minwidthtmenu; ?>px;
	--tblImageMaxHeight: <?php print $tblImageMaxHeight; ?>px;
	--colorshadowtitle: #<?php print $colorshadowtitle; ?>;
	--img_button: url(<?php print $img_button; ?>);
	--left: <?php print $left; ?>;
	--right: <?php print $right; ?>;
	/* InfraS add begin : jetons de design 3.4.1 (rayons, ombres, neutres derives du preset, focus, transition) */
	--oblyon-radius: var(--infras_radius);
	--oblyon-radius-sm: calc(var(--infras_radius) / 2);
	--oblyon-radius-pill: 999px;
	--oblyon-shadow-sm: 0 1px 2px rgba(0, 0, 0, .06), 0 1px 1px rgba(0, 0, 0, .04);
	--oblyon-shadow-md: 0 2px 8px rgba(0, 0, 0, .09), 0 1px 2px rgba(0, 0, 0, .06);
	--oblyon-shadow-lg: 0 8px 24px rgba(0, 0, 0, .14), 0 2px 6px rgba(0, 0, 0, .08);
	--oblyon-border: <?php print $oblyon_border; ?>;
	--oblyon-border-strong: <?php print $oblyon_border_strong; ?>;
	--oblyon-neutral-bg: <?php print $oblyon_neutral_bg; ?>;
	--oblyon-muted-text: <?php print $oblyon_muted_text; ?>;
	--oblyon-input-border: <?php print $oblyon_input_border; ?>;
	--oblyon-focus: var(--maincolor);
	--oblyon-transition: .15s ease-in-out;
	--login_bgcolor: <?php print $login_bgcolor; ?>;
	--login_txtcolor: <?php print $login_txtcolor; ?>;
	/* densite des listes, champs, boutons et fiches : option OBLYON_DENSITY (3.8.0), valeurs choisies dans style.css.php (compact = valeurs d'origine) */
	--oblyon-cell-py: <?php print $oblyon_density_tokens['cell_py']; ?>;
	--oblyon-cell-px: <?php print $oblyon_density_tokens['cell_px']; ?>;
	--oblyon-row-lh: <?php print $oblyon_density_tokens['row_lh']; ?>;
	--oblyon-head-h: <?php print $oblyon_density_tokens['head_h']; ?>;
	--oblyon-control-py: <?php print $oblyon_density_tokens['control_py']; ?>;
	--oblyon-btn-py: <?php print $oblyon_density_tokens['btn_py']; ?>;
	--oblyon-card-py: <?php print $oblyon_density_tokens['card_py']; ?>;
	/* teintes d'accent (3.8.0) : fond des lignes melange a la couleur principale (12 % / 20 %), texte lisible sur la couleur principale */
	--oblyon-accent-tint: <?php print $oblyon_accent_tint; ?>;
	--oblyon-accent-tint-strong: <?php print $oblyon_accent_tint_strong; ?>;
	--oblyon-on-accent: <?php print $oblyon_on_accent; ?>;
	/* onglets en pilules (OBLYON_TABS_STYLE = pills) : couleurs propres OBLYON_COLOR_TAB_PILL_*, derivees quand elles sont vides */
	--oblyon-tab-pill-bg: <?php print $oblyon_tab_pill_bg; ?>;
	--oblyon-tab-pill-txt: <?php print $oblyon_tab_pill_txt; ?>;
	--oblyon-tab-pill-bg-hover: <?php print $oblyon_tab_pill_bg_hover; ?>;
	--oblyon-tab-pill-border: <?php print $oblyon_tab_pill_border; ?>;
	/* onglets soulignes (OBLYON_TABS_STYLE = underline) : couleurs propres OBLYON_COLOR_TAB_UNDER_*, derivees quand elles sont vides */
	--oblyon-tab-under-band: <?php print $oblyon_tab_under_band; ?>;
	--oblyon-tab-under-txt: <?php print $oblyon_tab_under_txt; ?>;
	--oblyon-tab-under-line: <?php print $oblyon_tab_under_line; ?>;
	--oblyon-tab-under-border: <?php print $oblyon_tab_under_border; ?>;
	/* boutons (OBLYON_BUTTON_STYLE) : trois familles x fond, texte, bordure, fond et texte au survol, resolues selon le style par oblyon_button_effective_colors() (lib/oblyon_colors.lib.php) */
<?php foreach (array('action' => $oblyon_btn_action, 'delete' => $oblyon_btn_delete, 'form' => $oblyon_btn_form) as $oblyon_btn_family => $oblyon_btn_c) {
	foreach ($oblyon_btn_c as $oblyon_btn_role => $oblyon_btn_v) {
		print "\t--oblyon-btn-".$oblyon_btn_family.'-'.str_replace('_', '-', $oblyon_btn_role).': '.$oblyon_btn_v.";\n";
	}
} ?>
	/* en-tetes de liste en style plat (OBLYON_LIST_HEADER_STYLE = flat) : couleurs propres OBLYON_COLOR_LISTHEAD_FLAT_*, derivees quand elles sont vides */
	--oblyon-listhead-bg: <?php print $oblyon_listhead_bg; ?>;
	--oblyon-listhead-txt: <?php print $oblyon_listhead_txt; ?>;
	--oblyon-listhead-line: <?php print $oblyon_listhead_line; ?>;
	--oblyon-listhead-sel: <?php print $oblyon_listhead_sel; ?>;
	--oblyon-listhead-filter: <?php print $oblyon_listhead_filter; ?>;
	/* InfraS add end */
}

/*------------------------------------*\
#Eric Meyer's Reset CSS v2.0
\*------------------------------------*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font-family: var(--fontfamilydol);
/*	font: inherit;	*/
/*	vertical-align: middle;	*/
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}

/*------------------------------------*\
#BASE
\*------------------------------------*/

html {
	box-sizing: border-box;
}
*, *:before, *:after {
	box-sizing: inherit;
}

html, body {
	height: 100%;
	font-size: 100%;
	font-family: var(--fontfamilydol);
}

body {
<?php print 'direction: '.$langs->trans("DIRECTION").";\n"; ?>
<?php if (GETPOST("optioncss", "aZ09") == 'print') {	?>
	background-color: #fff !important;
<?php } else { ?>
	background-color: var(--bgcolor)!important;
<?php } ?>
	color: var(--colorfline) !important;
	font-family: var(--fontfamilydol)!important;
<?php if (empty($dol_use_jmobile) || 1==1) { ?>
	font-size: var(--fontsize);
<?php } ?>
	-webkit-font-smoothing: antialiased;	/* InfraS change */
	margin: 0;
}

/* Style used to protect html content in output to avoid attack by replacing full page with js content */
.sensiblehtmlcontent * {
	position: static !important;
}

.thumbstat { font-weight: bold !important; }

th a { font-weight: <?php print ($useboldtitle ? 'bold' : 'normal'); ?> !important; }
a.tab { font-weight: 500 !important; }

a:link, a:visited, a:hover, a:active, .classlink { color: var(--colortextlink); text-decoration: none;  }
a:hover { text-decoration: underline; color: var(--colortextlink); }
th.liste_titre a div div:hover, th.liste_titre_sel a div div:hover { text-decoration: underline; }
/*
tr.liste_titre th.liste_titre_sel:not(.maxwidthsearch), tr.liste_titre td.liste_titre_sel:not(.maxwidthsearch),
tr.liste_titre th.liste_titre:not(.maxwidthsearch), tr.liste_titre td.liste_titre:not(.maxwidthsearch) { opacity: 0.8; }
*/
/* th.liste_titre_sel a, th.liste_titre a, td.liste_titre_sel a, td.liste_titre a { color: #766; } */

input {
	font-size: unset;
}
select.vmenusearchselectcombo {
	background-color: unset;
}

table.liste th.wrapcolumntitle.liste_titre:not(.maxwidthsearch), table.liste td.wrapcolumntitle.liste_titre:not(.maxwidthsearch) {
	overflow: hidden;
	white-space: nowrap;
	max-width: 100px;
	text-overflow: ellipsis;
}
.liste_titre input[name=month_date_when], .liste_titre input[name=monthvalid], .liste_titre input[name=search_ordermonth], .liste_titre input[name=search_deliverymonth],
.liste_titre input[name=search_smonth], .liste_titre input[name=search_month], .liste_titre input[name=search_emonth], .liste_titre input[name=smonth], .liste_titre input[name=month], .liste_titre select[name=month],
.liste_titre input[name=month_lim], .liste_titre input[name=month_start], .liste_titre input[name=month_end], .liste_titre input[name=month_create],
.liste_titre input[name=search_month_lim], .liste_titre input[name=search_month_start], .liste_titre input[name=search_month_end], .liste_titre input[name=search_month_create],
.liste_titre input[name=search_month_update], .liste_titre input[name=search_month_start], .liste_titre input[name=search_month_end],
.liste_titre input[name=day_date_when], .liste_titre input[name=dayvalid], .liste_titre input[name=search_orderday], .liste_titre input[name=search_deliveryday],
.liste_titre input[name=search_sday], .liste_titre input[name=search_day], .liste_titre input[name=search_eday], .liste_titre input[name=sday], .liste_titre input[name=day], .liste_titre select[name=day],
.liste_titre input[name=day_lim], .liste_titre input[name=day_start], .liste_titre input[name=day_end], .liste_titre input[name=day_create],
.liste_titre input[name=search_day_lim], .liste_titre input[name=search_day_start], .liste_titre input[name=search_day_end], .liste_titre input[name=search_day_create],
.liste_titre input[name=search_day_create], .liste_titre input[name=search_day_start], .liste_titre input[name=search_day_end],
.liste_titre input[name=search_day_date_when], .liste_titre input[name=search_month_date_when], .liste_titre input[name=search_year_date_when],
.liste_titre input[name=search_dtstartday], .liste_titre input[name=search_dtendday], .liste_titre input[name=search_dtstartmonth], .liste_titre input[name=search_dtendmonth],
select#date_startday, select#date_startmonth, select#date_endday, select#date_endmonth, select#reday, select#remonth,
input[name=duration_value], input[name=durationhour]
{
	margin-right: 4px !important;
}
input[type=checkbox], input[type=radio] {
	margin: 0 3px 0 3px;
	accent-color: var(--maincolor);	/* InfraS add : cases et boutons radio dans la couleur principale */
}
input, input.flat, form.flat select, select, select.flat, .dataTables_length label select {
	border: none;
}
/* InfraS change begin : bordure fine complete sur tous les champs (plus marquee avec l'option THEME_SHOW_BORDER_ON_INPUT), rayon du theme, transition */
input, input.flat, textarea, textarea.flat, form.flat select, select, select.flat, .dataTables_length label select {
	background-color: var(--inputbackgroundcolor);
	color: var(--colortext);
	border-radius: var(--oblyon-radius-sm);
	font-family: var(--fontfamilydol);
	outline: none;
	margin: 0px 0px 0px 0px;
	border: solid 1px var(--oblyon-input-border);
	transition: border-color var(--oblyon-transition), box-shadow var(--oblyon-transition);
}
/* InfraS change end */

input {
	line-height: 1.3em;
	padding: var(--oblyon-control-py) 5px;	/* densite (3.8.0) */
}
.liste_titre input {
	padding: var(--oblyon-control-py) 5px;	/* densite (3.8.0) */
	font-family: var(--fontfamilydol);
}
select {
	padding-top: var(--oblyon-control-py);	/* densite (3.8.0) */
	padding-right: 4px;
	padding-bottom: var(--oblyon-control-py);	/* densite (3.8.0) */
	padding-left: 2px;
}
input, select {
	margin-left: 0px;
	margin-bottom: 1px;
	margin-top: 1px;
}

input:invalid, select:invalid {
	border-color: var(--colorstatusdanger);	/* InfraS change */
}

/**
* Headings
*/

h1, h2, h3, h4, h5, h6 {
	font-family: var(--fontfamilydol);
	font-weight: normal;
	font-style: normal;
	color: var(--colorfline);
	text-rendering: optimizeLegibility;
	margin-top: 0.2rem;
	margin-bottom: 0.5rem;
	line-height: 1.4;
}

/* InfraS change begin : echelle des titres liee a la taille de police du theme (--fontsize) */
h1 { font-size: calc(var(--fontsize) * 2); }

h2 { font-size: calc(var(--fontsize) * 1.6); }

h3 { font-size: calc(var(--fontsize) * 1.35); }

h4 { font-size: calc(var(--fontsize) * 1.15); }

h5 { font-size: calc(var(--fontsize) * 1.05); }

h6 { font-size: var(--fontsize); }
div.float
{
	float:var(--left);
}
div.floatright
{
	float:var(--right);
}
.block
{
	display:block;
}
.inline-block
{
	display:inline-block;
}
.inline-blockimp
{
	display:inline-block !important;
}
.largenumber {
	font-size: 1.4em;
}
button[name='button_search_x'] span.fa.fa-search {
	font-size: 1.3em;
}
button[name='button_removefilter_x'] span.fa.fa-remove {
	opacity: 0.5;
	font-size: 1.3em;
}
/* InfraS change begin : plus de suppression du focus ; anneau visible au clavier (:focus-visible) dans la couleur principale */
button:focus {
	outline: none;
}
button:focus-visible, a.tab:focus-visible, .button:focus-visible, .butAction:focus-visible, .butActionDelete:focus-visible {
	outline: 2px solid var(--oblyon-focus);
	outline-offset: 2px;
}
/* InfraS change end */
.fa-info-circle {
	padding-<?php print $left; ?>: 3px;
}
.line-height-large {
	line-height: 1.8em;
}
.maxwidthsearch {		/* Max width of column with the search picto */
	width: 54px;
}

.valigntop {
	vertical-align: top;
}
.valignmiddle {
	vertical-align: middle;
}
.valignbottom {
	vertical-align: bottom;
}
.valigntextbottom {
	vertical-align: text-bottom;
}
.centpercent {
	width: 100%;
}
.centpercentimp {
	width: 100% !important;
}
.centpercentwithout1imp {
	width: calc(100% - 1px) !important;
}
.centpercentwithoutmenu {
	width: calc(100% - 200px);
}
.quatrevingtpercent, .inputsearch {
	width: 80%;
}
.soixantepercent {
	width: 60%;
}
.quatrevingtquinzepercent {
	width: 95%;
}
.quatrevingtpercentminusx {
	width: calc(80% - 52px);
}
textarea.centpercent {
	width: 96%;
}
.small, small {
	font-size: 85%;
}
.large {
	font-size: 125%;
}
.double {
	font-size: 2em;
}

.h1 .small, .h1 small, .h2 .small, .h2 small, .h3 .small, .h3 small, h1 .small, h1 small, h2 .small, h2 small, h3 .small, h3 small {
	font-size: 65%;
}
.h1 .small, .h1 small, .h2 .small, .h2 small, .h3 .small, .h3 small, .h4 .small, .h4 small, .h5 .small, .h5 small, .h6 .small, .h6 small, h1 .small, h1 small, h2 .small, h2 small, h3 .small, h3 small, h4 .small, h4 small, h5 .small, h5 small, h6 .small, h6 small {
	font-weight: 400;
	line-height: 1;
	color: #777;
}

.flip {
	transform: scaleX(-1) translate(<?php print ($left == 'left' ? '' : '-'); ?>2px, 0);
}
.rotate90 {
	transform: rotate(90deg) translate(0, <?php print ($left == 'left' ? '' : '-'); ?>2px);
}

.center {
	text-align: center;
	margin: 0px auto;
}
.centerimp {
	text-align: center !important;
}
.alignstart {
	text-align: start;
}
.start {
	text-align: start;
}
.end {
	text-align: end;
}
.left {
	text-align: var(--left);
}
.right {
	text-align: var(--right);
}
.justify {
	text-align: justify;
}
.pull-left {
	float: left!important;
}
.pull-right {
	float: right!important;
}
.nowrap {
	white-space: <?php print ($dol_optimize_smallscreen?'normal':'nowrap'); ?>;
}
.liste_titre .nowrap {
	white-space: nowrap;
}
.nowraponall {	/* no wrap on all devices */
	white-space: nowrap;
}
.wrapimp {
	white-space: normal !important;
}
.wordwrap {
	word-wrap: break-word;
}
.wordbreakimp {
	word-break: break-word;
}
.wordbreak {
	word-break: break-all;
}
.bold {
	font-weight: bold !important;
}
.nobold {
	font-weight: normal !important;
}
.uppercase {
	text-transform: uppercase;
}
.nounderline {
	text-decoration: none;
}
.nounderlineimp {
	text-decoration: none !important;
}
.nopadding {
	padding: 0;
}
.nopaddingleft {
	padding-left: 0;
}
.nopaddingright {
	padding-right: 0;
}
.nopaddingleftimp {
	padding-left: 0 !important;
}
.nopaddingrightimp {
	padding-right: 0 !important;
}
.paddingleft {
	padding-<?php print $left; ?>: 4px;
}
.paddingleftimp {
	padding-<?php print $left; ?>: 4px !important;
}
.paddingleft2 {
	padding-<?php print $left; ?>: 2px;
}
.paddingleft2imp {
	padding-<?php print $left; ?>: 2px !important;
}
.paddingright {
	padding-<?php print $right; ?>: 4px;
}
.paddingrightimp {
	padding-<?php print $right; ?>: 4px !important;
}
.paddingright2 {
	padding-<?php print $right; ?>: 2px;
}
.paddingright2imp {
	padding-<?php print $right; ?>: 2px !important;
}
.paddingtop {
	padding-top: 4px;
}
.paddingtop2 {
	padding-top: 2px;
}
.paddingbottom {
	padding-bottom: 4px;
}
.paddingbottom2 {
	padding-bottom: 2px;
}
.marginleft2 {
	margin-<?php print $left; ?>: 2px;
}
.marginright2 {
	margin-<?php print $right; ?>: 2px;
}
.nomarginleft {
	margin-<?php print $left; ?>: unset;
}
.nomarginright {
	margin-<?php print $right; ?>: unset;
}
.nowidthimp {
	width: unset !important;
}
.cursordefault {
	cursor: default;
}
.cursorpointer {
	cursor: pointer;
}
.classfortooltiponclick .fa-question-circle {
	cursor: pointer;
}
.cursormove {
	cursor: move;
}
.cursornotallowed {
	cursor: not-allowed;
}
.cursorwait {
	cursor: wait;
}
.backgroundblank {
	background-color: #fff;
}
.nobackground, .nobackground tr {
	background: unset !important;
}
.checkboxattachfilelabel {
	font-size: 0.85em;
	opacity: 0.7;
}
.borderimp {
	border: 1px solid #888 !important;
}
.text-warning {
	color : var(--textWarning)
}
.longmessagecut {
	max-height: 250px;
	max-width: 100%;
	overflow-y: auto;
}
div.urllink {
	padding: 5px;
	margin-top: 5px;
	margin-bottom: 5px;
	/* border: 1px solid #ccc; */
	border-radius: 5px;
	/* width: fit-content; */
	background-color: #f0f0f8;
	opacity: 0.8;
}
div.urllink, div.urllink a {
	color: #339 !important;
}

i.fa-mars::before, i.fa-venus::before, i.fa-genderless::before, i.fa-transgender::before  {
	color: #888 !important;
	opacity: 0.4;
	padding-<?php print $left; ?>: 3px;
}
.stockmovemententry {
	color: var(--colorStockOk);	/* InfraS change : jeton 3.7.0 */
	transform: rotate(0.25turn);
	font-size: 1.2em;
}
.stockmovementexit {
	color: var(--colorStockExit);	/* InfraS change : jeton 3.7.0 */
	transform: rotate(0.3turn);
	font-size: 1.2em;
}
.stockmovement {
	font-size: 1.4em;
}

body[class*="colorblind-"] .text-warning{
	color : var(--colorblind_deuteranopes_textWarning)
}
.text-success {
	color : var(--textSuccess)
}
body[class*="colorblind-"] .text-success{
	color : var(--colorblind_deuteranopes_textSuccess)
}
.text-danger {
	color : var(--textDanger)
}

.editfielda span.fa-pencil-alt, .editfielda span.fa-trash {
	color: var(--colortextlink) !important;
}
.editfielda span.fa-pencil-alt:hover, .editfielda span.fa-trash:hover {
	color: var(--colortext) !important;	/* InfraS change : couleur du texte courant (le texte du bandeau de titre peut etre blanc) */
}
a.editfielda.nohover *:hover:before {
	color: #ccc !important;
}

.fawidth30 {
	width: 20px;
}
.floatnone {
	float: none !important;
}

span.fa.fa-plus-circle.paddingleft {
	padding-right: 4px;
	padding-top: 3px;
	padding-bottom: 2px;
}

.size15x { font-size: 1.5em !important; }
.fa-toggle-on, .fa-toggle-off, .size2x { font-size: 2em; }
.websiteselectionsection .fa-toggle-on, .websiteselectionsection .fa-toggle-off,
.asetresetmodule .fa-toggle-on, .asetresetmodule .fa-toggle-off,
.tdwebsitesearchresult .fa-toggle-on, .tdwebsitesearchresult .fa-toggle-off
{
	font-size: 1.5em; vertical-align: text-bottom;
}

.divoverflow {
	overflow: hidden;
	white-space: nowrap;
	vertical-align: middle;
	text-overflow: ellipsis;
}

/* Themes for badges */
<?php include dol_buildpath($path.'/theme/'.$theme.'/badges.inc.php', 0); ?>

/**
* Links
*/

a {
	color: var(--colorfline); /* @new */
	font-family: var(--fontfamilydol);
	font-weight: normal;
	text-decoration: none;
}

a:hover {
	cursor: pointer;
}

a:hover, a:focus {
	color: var(--colortextlink);
	text-decoration: underline;
}

a.commonlink
/* ,a.reposition */
{
	/* color: var(--colorfline) !important; */
	color: #f4f4f4 !important;
	text-decoration: none;
}

hr {
	height: 0;
	margin-top: 10px;
	margin-bottom: 10px;
}

/**
* Hide/display
*/

<?php if (! empty($dol_optimize_smallscreen)) { ?>
	.hideonsmartphone { display: none; }

	.noenlargeonsmartphone {
		width: 50px !important;
		display: inline !important;
	}
<?php } ?>

div.visible,
tr.visible {
	display: block;
}

div.hidden,
td.hidden {
	display: none;
}

input.liste_titre {
	box-shadow: none !important;
}	/* InfraS add */
input[name=price], input[name=weight], input[name=volume], input[name=surface], input[name=sizeheight], input[name=net_measure], select[name=incoterm_id] { margin-right: 6px; }

div#moretabsList, div#moretabsListaction {
	z-index: 5;
}

hr {
	border: 0;
	border-top: 1px solid var(--colorbacklinebreak);
}
.tabBar hr {
	margin-top: 20px;
	margin-bottom: 17px;
}

.button_search, .button_removefilter {
	border: unset;
	background-color: unset;
	line-height: 2;
}
.button_search:hover, .button_removefilter:hover {
	cursor: pointer;
}
td button.liste_titre span {
	color: var(--colortexttitle);
}
.websitebar .button, .websitebar .buttonDelete
{
	line-height: normal;
}
.websiteselection {
	display: inline-block;
	padding-left: 10px;
	vertical-align: middle;
	line-height: 29px;
}
.websitetools {
	padding-top: 2px;
}

/**
* RTL direction
*/

td[align="left"] {
	text-align: var(--left);
}
td[align="right"] {
	text-align: var(--right);
}

/**
* Dragging lines
*/

.dragClass {
	color: #002255;
}

/**
* Images Styles
*/

img {
	border: 0;
	vertical-align: middle;
}

img[src*=pdf]		{ vertical-align: sub !important; }
img[src*=globe]		{ vertical-align: sub !important; }
img[src*=star]		{ vertical-align: baseline; }
input[type=image]	{ vertical-align: middle; }
img[src*=stcomm]	{ vertical-align: text-top; }

/**
* Graphs Styles
*/

.dolgraphtitlecssboxes + div, #stats {
	margin: 0 auto;
}

.pieLabelBackground {
	background-color: #333 !important;
	color: #f7f7f7;
	opacity: 1;
}

.jPicker .Icon {
	vertical-align: middle;
	margin-<?php print $left; ?>: .5em;
}

/**
* Form Elements
*/

<?php if (empty($dol_use_jmobile)) { ?>

	/* InfraS change begin : focus dans la couleur principale (bordure + anneau au clavier), plus d'ombre creusee ni de bleu-gris code en dur */
	input:focus, textarea:focus, select:focus {
		border-color: var(--oblyon-focus);
		box-shadow: 0 0 0 2px <?php print colorHexToRgb($maincolor, 0.18); ?>;
	}
	input:focus-visible, textarea:focus-visible, select:focus-visible {
		outline: 2px solid var(--oblyon-focus);
		outline-offset: 1px;
	}

	textarea,
	input[type=text],
	input[type=password],
	input[type=email],
	input[type=number],
	input[type=search],
	input[type=tel],
	input[type=url],
	.titlewrap input,
	select {
		border-color: var(--oblyon-input-border);
		box-shadow: none;
	}

	textarea:focus {
		border: 1px solid var(--oblyon-focus) !important;
	}
	.select2-choice {
		border: none;
		border-bottom:  solid 1px rgba(0,0,0,.2) !important;	/* required to avoid to lose bottom line when focus is lost on select2. */
	}

	.cke_top {
		background: var(--colorbacktitle1) !important;
	}
	.cke_dialog_ui_vbox_child {
		color: var(--tooltipfontcolor) !important;
	}
	.cke_reset_all textarea, .cke_reset_all input[type="text"], .cke_reset_all input[type="password"] {
		color: var(--tooltipfontcolor) !important;
	}
	textarea.cke_source	{
		box-shadow: none;
		background-color:var(--inputbackgroundcolor) !important;
		color: var(--colortext) !important;
	}
	textarea.cke_source:focus
	{
		box-shadow: none;
	}

	select.cke_dialog_ui_input_select {
		color: var(--tooltipfontcolor) !important;
	}
	.liste_titre .flat, .liste_titre select.flat {
		margin: 2px;
		/* padding: 2px 4px; */
	}

	input, textarea, select {
		border-color: var(--oblyon-input-border);	/* InfraS change */
		box-shadow: none;	/* InfraS change */
		margin:3px 10px 3px 0;
	}
<?php } ?> /* end if (empty($dol_use_jmobile)) */

section.setupsection {
	padding: 20px;
	/* background-color: var(--colorbacktitle1); */
	background-color: var(--oblyon-neutral-bg);	/* InfraS change */
	border-radius: var(--oblyon-radius);	/* InfraS change */
}

.field-error-icon { color: #ea1212 !important; }

select.flat, form.flat select {
	font-weight: normal;
	font-size: unset;
	height: calc(1.3em + 2 * var(--oblyon-control-py) + 2px);	/* densite (3.8.0) : meme hauteur que les champs (interligne + 2 x remplissage + bordures), etait 2em */
}

input:disabled,
select:disabled {
	background-color: var(--inputbackgroundcolor);
	cursor: not-allowed;
}

input.liste_titre {
	box-shadow: none !important;
}
input.removedassigned  {
	padding: 2px !important;
	vertical-align: text-bottom;
	margin-bottom: -3px;
}
input.smallpadd {	/* Used for timesheet input */
	padding-left: 0px !important;
	padding-right: 0px !important;
}
input.short {
	width: 40px;
}
.nofocusvisible:focus-visible {
	outline: none;
}

.logopublicpayment #dolpaymentlogo {
	max-height: 80px;
	max-width: 300px;
	image-rendering: -webkit-optimize-contrast;		/* better rendering on public page header */
}

a.butStatus {
	padding-left: 5px;
	padding-right: 5px;
	background-color: transparent;
	color: var(--colortext) !important;
	border: 2px solid var(--colorButtonAction1) !important;
	margin: 0 0.45em !important;
}

span.userimg.notfirst, div.userimg.notfirst {
	margin-left: -5px;
}
div.userimg.notfirst {
	display: block-inline;
}
/* Used for timesheets */
span.timesheetalreadyrecorded input {
	border: none;
	border-bottom: solid 1px rgba(0,0,0,0.4);
	margin-right: 1px !important;
	min-width: 40px;
}
td.onholidaymorning, td.onholidayafternoon {
	background-color: var(--colorCalHolidayBg);	/* InfraS change : jeton OBLYON_COLOR_CAL_HOLIDAY_BCKGRD */
}
td.onholidayallday {
	background-color: var(--colorCalHolidayBg);	/* InfraS change : jeton OBLYON_COLOR_CAL_HOLIDAY_BCKGRD */
}
td.onholidayallday:not(.weekend) input {
	background-color: var(--inputbackgroundcolor);	/* InfraS change : jeton (fond des champs) */
}
td.weekend {	/* must be after td.onholidayallday */
	background-color: var(--colorCalWeekendBg);	/* InfraS change : jeton OBLYON_COLOR_CAL_WEEKEND_BCKGRD */
}
/*
td.leftborder, td.hide0 {
	border-left: 1px solid #ccc;
}
td.leftborder, td.hide6 {
	border-right: 1px solid #ccc;
}
*/
td.rightborder {
	border-right: 1px solid #ccc;
}

td.amount, span.amount, div.amount, b.amount {
	color: var(--colorAmountText);	/* InfraS change : jeton OBLYON_COLOR_AMOUNT_TEXT */
}
td.actionbuttons a {
	padding-left: 6px;
}
select.flat, form.flat select, .pageplusone {
	font-weight: normal;
	font-size: unset;
}
input.pageplusone {
	padding-bottom: 4px;
	padding-top: 4px;
	margin-right: 4px;
}
.paginationlastpage a {
	padding-left: 8px;
}

.saturatemedium {
	filter: saturate(0.8);
}
.optionblue {
	color: var(--colortextlink);
}
.optiongrey, .opacitymedium {
	opacity: 0.4;
}
.opacitymediumbycolor {
	color: rgba(0, 0, 0, 0.4);
}
.opacitylow {
	opacity: 0.6;
}
.opacityhigh {
	opacity: 0.24;
}
.opacitytransp {
	opacity: 0;
}
.colorwhite {
	color: #fff;
}
.colorgrey {
	color: #888 !important;
}
.fontsizeunset {
	font-size: unset !important;
}
.vmirror {
	transform: scale(1, -1);
}
.hmirror {
	transform: scale(-1, 1);
}

select:invalid, select.--error {
	color: gray;
}
select:invalid {
	color: gray;
}
input:disabled, textarea:disabled, select[disabled='disabled']
{
	background: var(--inputbackgroundcolor);
}

input.liste_titre {
	box-shadow: none !important;
}
input.removedfile {
	padding: 0px !important;
	border: 0px !important;
	vertical-align: text-bottom;
}
textarea:disabled {
	background: var(--oblyon-neutral-bg);	/* InfraS change */
}
input[type=file ]	{ background-color: transparent; border-top: none; border-left: none; border-right: none; box-shadow: none; }
input[type=checkbox] { background-color: transparent; border: none; box-shadow: none; }
input[type=radio]	{ background-color: transparent; border: none; box-shadow: none; }
input[type=image]	{ background-color: transparent; border: none; box-shadow: none; }
input:-webkit-autofill {
	background-color: var(--inputbackgroundcolor) !important;
	background-image:none !important;
	-webkit-box-shadow: 0 0 0 50px var(--inputbackgroundcolor) inset;	/* InfraS change */
	color: var(--colortext) !important;
}
::-webkit-input-placeholder { color: var(--oblyon-muted-text); }	/* InfraS change */
input:-moz-placeholder { color: var(--oblyon-muted-text); }	/* InfraS change */
::placeholder { color: var(--oblyon-muted-text); opacity: 1; }	/* InfraS add */
input[name=price], input[name=weight], input[name=volume], input[name=surface], input[name=sizeheight], select[name=incoterm_id] { margin-right: 6px; }
input[name=surface] { margin-right: 4px; }
fieldset { border: 1px solid var(--oblyon-border-strong) !important; border-radius: var(--oblyon-radius); }	/* InfraS change */
.legendforfieldsetstep { padding-bottom: 10px; }
input#onlinepaymenturl, input#directdownloadlink {
	opacity: 0.7;
}

<?php if (! empty($dol_use_jmobile)) { ?>
	legend { margin-bottom: 8px; }
<?php } ?>

/**
* Buttons
*/

table[summary] .button[name=viewcal] {
	width: inherit!important;
	min-width: 120px;
}

.liste_titre input[type=submit] {
	background-color: #444;
	border-color: #555;
	box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
	-webkit-box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
	color: #fff;
	padding: .4em .8em;
}

.liste_titre input[type=submit]:hover {
	background-color: #333;
	border-color: #444;
}

div.noborder .button { padding: .4em .8em; }

#blockvmenusearch .button {
	background-color: #444;
	border: 1px solid #c0c0c0;
	border-color: #555;
	box-shadow: inset 0 1px 0 rgba(150, 172, 180, .6);
	-webkit-box-shadow: inset 0 1px 0 rgba(150, 172, 180, .6);
	color: #fff;
	font-size: inherit;
	margin: 0em .5em;
	padding: 7px 8px;
}

#blockvmenusearch .button:hover {
	background-color: #333;
	border-color: #444;
	box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
	-webkit-box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
	color: #fff;
}

form {
	padding: 0;
	margin: 0;
}

th .button {
	border-radius: 0 !important;
	-moz-border-radius: 0 !important;
	-webkit-border-radius: 0 !important;
	box-shadow: none !important;
	-moz-box-shadow: none !important;
	-webkit-box-shadow: none !important;
}

/**
* Action Buttons
*/

div.divButAction { margin-bottom: 1.5em; }

a.butActionNew>span.fa-plus-circle { padding-left: 6px; font-size: 1.5em; }
a.butActionNewRefused>span.fa-plus-circle { padding-left: 6px; font-size: 1.5em; }

/**
* State Ok, Warning, Error
*/
/* InfraS change begin : couleurs semantiques centralisees (theme_vars) au lieu de valeurs en dur ; blocs de message en cartes arrondies avec ombre legere */
.ok	  { color: var(--colortextlink); }
.warning { color: var(--textWarning) !important; }
.error   { color: var(--textDanger) !important; font-weight: bold; }
.green   { color: var(--textSuccess) !important; }

.bloc_success {
	background-color: var(--colorstatussuccess);
	color: #fff;
	display: inline-block;
	margin-bottom: .5em;
	padding: 1em;
	border-radius: var(--oblyon-radius);
}

.bloc_warning {
	background-color: var(--colorstatusdanger);
	color: #fff;
	display: inline-block;
	margin-bottom: .5em;
	padding: 1em;
	border-radius: var(--oblyon-radius);
}

div.ok {
	color: var(--colortextlink);
}

/* Warning message */
div.warning {
	border-<?php print $left; ?>: solid 4px var(--colorWarningBorder);
	padding: 10px 14px;
	margin: 0.6em 0em 0.6em 0em;
	background: var(--colorWarningBg);
	color: var(--colorWarningTxt) !important;
	border-radius: var(--oblyon-radius-sm);
	box-shadow: var(--oblyon-shadow-sm);
}

/* Error message */
div.error {
	border-<?php print $left; ?>: solid 4px var(--colorErrorBorder) !important;
	text-align: var(--left) !important;
	padding: 10px 14px;
	margin: 0.6em 0em 0.6em 0em;
	background: var(--colorErrorBg);
	color: var(--colorErrorTxt) !important;
	font-size: unset !important;
	border-radius: var(--oblyon-radius-sm);
	box-shadow: var(--oblyon-shadow-sm);
}

/* Info admin */
div.info {
	border-<?php print $left; ?>: solid 4px var(--colorInfoBorder);
	padding: 10px 14px;
	margin: 0.6em 0em 0.6em 0em;
	background: var(--colorInfoBg);
	color: var(--colorInfoTxt) !important;
	border-radius: var(--oblyon-radius-sm);
	box-shadow: var(--oblyon-shadow-sm);
}

/*
*  Other
*/
.movable {
	cursor: move;
}
.borderrightlight
{
	border-right: 1px solid #DDD;
}
#formuserfile {
	margin-top: 4px;
}
#formuserfile_link {
	margin-left: 1px;
}
.listofinvoicetype {
	min-height: 1.8em;
	vertical-align: middle;
	padding-top: 7px;
	padding-bottom: 1px;
	display: flex;
	align-items: center;
	flex-wrap: wrap;
}
#credit_note_options {
	margin-<?php print $left; ?>: 30px;
	width: 100%;
}
.divsocialnetwork:not(:first-child) {
	padding-left: 20px;
}
div.divsearchfield {
	/*float: var(--left);*/
	display: inline-block;
	margin-<?php print $right; ?>: 12px;
	margin-<?php print $left; ?>: 2px;
	margin-top: 4px;
	margin-bottom: 4px;
	padding-left: 2px;
}
.divfilteralone {
	background-color: rgba(0, 0, 0, 0.08);
	border-radius: 5px;
	padding-left: 5px;
}
.divsearchfieldfilter {
	text-overflow: clip;
	overflow: auto;
	padding-bottom: 5px;
	opacity: 0.6;
	font-size: small;
}
.divadvancedsearchfield:first-child {
	margin-top: 3px;
}
.divadvancedsearchfield {
	float: left;
	padding-left: 15px;
	padding-right: 15px;
	padding-bottom: 2px;
	padding-top: 2px;
}
.search_component_params {
	/*display: flex; */
	-webkit-flex-flow: row wrap;
	flex-flow: row wrap;
	background: var(--colorOverlayBg);	/* InfraS change : jeton OBLYON_COLOR_OVERLAY_BCKGRD */
	padding-top: 3px;
	padding-bottom: 3px;
	padding-<?php print $left; ?>: 0;
	padding-<?php print $right; ?>: 0;
	border-bottom: solid 1px var(--inputbordercolor);
	height: 24px;
	border-radius: 3px;
}
.search_component_searchtext {
	padding-top: 2px;
}
.search_component_params_text, .search_component_params_text:focus {
	border-bottom: none;
	width: auto;
	margin: 0 !important;
	padding: 3px;
}
.tagsearch {
	padding: 2px;
	padding-right: 4px;
	padding-bottom: 3px;
	background: var(--oblyon-neutral-bg);	/* InfraS change : jeton 3.7.0 */
	border-radius: 4px;
}
.tagsearchdelete {
	color: var(--oblyon-muted-text);	/* InfraS change : jeton 3.7.0 */
	cursor: pointer;
	display: inline-block;
	font-weight: bold;
	margin-right: 2px;
	padding-left: 4px;
}

.caretleftaxis {
	margin-left: -13px;
	margin-top: -1px;
	position: absolute;
}
.caretdownaxis {
	margin-left: -12px;
	margin-top: 0;
	position: absolute;
}

.a-filter, .a-mesure {
	border-radius: 50px;
	background: var(--colorbacktabactive);
	color: var(--colortexttitlenotab);
	padding: 8px 10px 8px 6px;
}
.a-filter:before {
	content: "\f0b0";
}
.a-mesure:before {
	content: "\f080";
}
.a-filter:before, .a-mesure:before {
	font-family: "Font Awesome 5 Free";
	font-weight: 600;
	padding-right: 5px;
	padding-left: 5px;
}
.a-filter-disabled, .a-mesure-disabled {
	border-radius: 50px;
	background: var(--colorbacktitle1);
	padding: 8px;
	opacity: 0.6;
}
