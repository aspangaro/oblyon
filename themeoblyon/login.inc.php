<?php
if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/login.inc.php
   Role      : Page de connexion (.bodylogin, .login_table) ; les regles de la barre du haut sont dans layout.inc.php
   Inclus par : cards.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */


    /* Login */

    .bodylogin
    {
		background: var(--login_bgcolor);	/* InfraS change : couleur "fond de la page de connexion" (OBLYON_COLOR_LOGIN_BCKGRD), jusqu'ici sans effet */
        display: table;
        position: absolute;
        height: 100%;
        width: 100%;
        font-size: 1em;
    }
    .login_center {
<?php if (!getDolGlobalString('MAIN_LOGIN_RIGHT')) { ?>
		/* InfraS change : plus de margin-top 30vw, la carte est centree verticalement par la cellule */
		display: table-cell;
		vertical-align: middle;
<?php } else { ?>
		/* InfraS change : meme position que l'ancien margin-top 30vw (carte sous le milieu) mais calculee sur la hauteur de l'ecran (30vw = 55vh en 16:9),
		   plafonnee pour laisser 420px a la carte : plus jamais hors ecran sur une fenetre basse */
		padding-top: min(55vh, calc(100vh - 420px));
<?php } ?>
    }
    .login_vertical_align {
        padding: 10px;
        padding-bottom: 80px;
    }
    form#login {
        padding-bottom: 30px;
        font-size: 14px;
        vertical-align: middle;
    }
    .login_table_title {
		pointer-events: none;
		cursor: default;
<?php if (getDolGlobalString('MAIN_LOGIN_RIGHT')) { ?>
		margin: 0px calc((50vw - 530px) / 2) 0px auto;
		width: 530px;
<?php } ?>
		max-width: <?php echo !getDolGlobalString('MAIN_LOGIN_RIGHT') ? '530px' : 'calc(50vw - 70px)'; ?>;
		color: var(--login_txtcolor) !important;	/* InfraS change : couleur du titre choisie selon la clarte du fond de la page */
		padding-bottom: 10px;
    }
	.login_table_title a {
		margin: auto;
	}
    .login_table label {
        text-shadow: none;	/* InfraS change */
    }
    /* InfraS change begin : carte de connexion sur les jetons (ombre douce, rayon du theme, fond des lignes) */
    .login_table {
		margin: <?php echo !getDolGlobalString('MAIN_LOGIN_RIGHT') ? '0px auto' : '0px calc((50vw - 600px) / 2) 0px auto'; ?>;

		padding: 12px;
		width: 600px;
		max-width: <?php echo !getDolGlobalString('MAIN_LOGIN_RIGHT') ? '600px' : '50vw'; ?>;
<?php if (getDolGlobalString('MAIN_LOGIN_RIGHT')) { ?>
		width: 600px;
<?php } ?>
		box-shadow: var(--oblyon-shadow-lg);
        <?php
            if (getDolGlobalString('MAIN_LOGIN_BACKGROUND')) {
				print '	background-color: var(--colorbtitle);';
            } else {
                print '	background-color: var(--colorbline);';
            }
        ?>
		border-radius: var(--oblyon-radius);
		border: 1px solid var(--oblyon-border);
    }
    .login_table input#username, .login_table input#password, .login_table input#securitycode {
        border: 1px solid var(--oblyon-input-border);
        border-radius: var(--oblyon-radius-sm);
        padding: 8px 10px;
        margin-left: 10px;
        margin-top: 5px;
        margin-bottom: 5px;
        transition: border-color var(--oblyon-transition), box-shadow var(--oblyon-transition);
    }
    .login_table input#username:focus, .login_table input#password:focus, .login_table input#securitycode:focus {
        outline: none;
        border-color: var(--oblyon-focus);
        box-shadow: 0 0 0 2px <?php print colorHexToRgb($maincolor, 0.18); ?>;
    }
    .login_table input#username:focus-visible, .login_table input#password:focus-visible, .login_table input#securitycode:focus-visible {
        outline: 2px solid var(--oblyon-focus);
        outline-offset: 1px;
    }
    /* InfraS change end */
    .login_table .trinputlogin {
        font-size: 1.2em;
        margin: 8px;
    }
    .login_table .tdinputlogin {
        background-color: transparent;
        /* border: 2px solid #ccc; */
        min-width: 220px;
        border-radius: var(--oblyon-radius-sm);	/* InfraS change */
    }
    .login_table .tdinputlogin .fa {
        padding-left: 10px;
        width: 14px;
    }
    .login_table .tdinputlogin input#username, .login_table .tdinputlogin input#password {
        font-size: 1em;
    }
    .login_table .tdinputlogin input#securitycode {
        font-size: 1em;
    }
    .login_main_home {
        word-break: break-word;
    }
    .login_main_message {
        text-align: center;
        max-width: 570px;
        margin-bottom: 22px;
    }
    .login_main_message .error {
        /* border: 1px solid #caa; */
        padding: 10px;
    }
    div#login_left, div#login_right {
        display: inline-block;
        padding-top: 10px;
        text-align: center;
    }
    div#login_right select#entity {
        margin-top: 10px;
    }
    table.login_table tr td table.none tr td {
        padding: 2px;
    }
    table.login_table_securitycode {
        border-spacing: 0px;
    }
    table.login_table_securitycode tr td {
        padding-left: 0px;
        padding-right: 4px;
    }
    #securitycode {
        width: 120px;
		vertical-align: middle;
   }
    #img_securitycode {
		vertical-align: middle;
    }
    #img_logo, .img_logo {
        max-width: 170px;
        max-height: 90px;
    }

    div.backgroundsemitransparent {
		background: var(--colorbtitle);
        padding-left: 10px;
        padding-right: 10px;
		color: var(--colortexttitle);
    }
/* InfraS change 3.7.0 : la copie de la section "bloc de connexion / barre du haut" (250 lignes, doublon perime de global.inc.php qui gagnait la cascade) est retiree ; les 8 regles sans equivalent sont deplacees dans global.inc.php */
/*------------------------------------------------------------------
[ Responsive ]*/

@media (max-width: 900px) {
    .login100-form {
        width: 100%;
    }

    .login100-more {
        display: none;
    }

    #img_logo {
        margin-top: 10%;
    }
}

@media (max-width: 576px) {
    .login100-form {
        padding-left: 15px;
        padding-right: 15px;
        padding-top: 10px;
    }

    .login100-more {
        display: none;
    }
}
