<?php
if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>

/* <style type="text/css" > dont remove this line it's an ide hack */
/* ================================================================================================
   oblyon/themeoblyon/dropdown.inc.php
   Role      : Menus deroulants de la barre du haut : recherche, ajout rapide, favoris, connexion
   Inclus par : global.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */

/*
 * Dropdown
 */

.open>.dropdown-menu, .dropdown dd ul.open {
    display: block;
}

.dropdown-menu {
    position: absolute;
    /*top: 100%;*/
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 160px;
    margin: 2px 0 0;
    font-size: var(--fontsize);	/* InfraS change */
    text-align: left;
    list-style: none;
    background-color: var(--bgcolor);
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
	/* InfraS change begin : jetons de design */
	border: 1px solid var(--oblyon-border);
    border-radius: var(--oblyon-radius);
    box-shadow: var(--oblyon-shadow-lg);
	/* InfraS change end */
}

.dropdown-toggle{
    text-decoration: none !important;
}

    /* CSS to hide the arrow to show open/close */
    .dropdown-toggle::after {
        /* font part */
        font-family: var(--fontawesomeFamily);
        font-weight: var(--fontawesomeWeight);
        font-size: 0.7em;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        text-align:center;
        text-decoration:none;
        margin:  auto 3px;
        display: inline-block;
	/*content: "\f078";*/
        -webkit-transition: -webkit-transform .2s ease-in-out;
        -ms-transition: -ms-transform .2s ease-in-out;
         transition: transform .2s ease-in-out;
    }

    div#topmenu-global-search-dropdown .dropdown-toggle::after, div#topmenu-quickadd-dropdown .dropdown-toggle::after, div#topmenu-bookmark-dropdown .dropdown-toggle::after {
        content: unset !important;
    }

    .open>.dropdown-toggle::after {
        transform: rotate(180deg);
    }

/*
* MENU Dropdown
*/
.login_block.usedropdown .logout-btn{
    display: none;
}

.tmenu .open.dropdown, .login_block .open.dropdown, .tmenu .open.dropdown, .login_block .dropdown:hover{
    background: rgba(0, 0, 0, 0.1);
}
.tmenu .dropdown-menu, .login_block .dropdown-menu {
    position: absolute;
    right: 0;
    left: auto;
    line-height:1.3em;
}
.tmenu .dropdown-menu, .login_block  .dropdown-menu .user-body {
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 4px;
}
.user-body {
	color: var(--colortextlink);
}
.side-nav-vert .user-menu .dropdown-menu {
    padding: 1px 0 0 0;
    border-top-width: 0;
    width: 300px;
}
.side-nav-vert .user-menu .dropdown-menu {
    margin-top: 0;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

.side-nav-vert .user-menu .dropdown-menu > .user-header {
    min-height: 175px;
    padding: 10px;
    text-align: center;
    white-space: normal;
}

#topmenu-global-search-dropdown .dropdown-menu{
    width: 300px;
    max-width: 100%;
}

.dropdown-user-image {
    border-radius: 50%;
    vertical-align: middle;
    z-index: 5;
    height: 90px;
    width: 90px;
    border: 3px solid;
    border-color: transparent;
	border-color: var(--colorboxstatsborder);
    max-width: 100%;
    max-height :100%;
}

.dropdown-menu > .user-header{
<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
	background-color: var(--bgnavtop_hover);
<?php } else { ?>
	background-color: var(--bgnavleft_hover);
<?php } ?>
}

.dropdown-menu .dropdown-header{
    padding: 5px 10px 10px 10px;
}

.dropdown-menu > .user-footer {
<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
	background-color: var(--bgnavtop_hover);
<?php } else { ?>
	background-color: var(--bgnavleft_hover);
<?php } ?>
    padding: 10px;
}

.user-footer:after {
    clear: both;
}

.dropdown-menu > .bookmark-footer{
    padding: 10px;
}

.dropdown-menu > .user-body, .dropdown-body{
    padding: 15px;
	border-bottom: 1px solid var(--colorboxstatsborder);
	border-top: 1px solid var(--colorboxstatsborder);
    white-space: normal;
}

.dropdown-menu > .bookmark-body, .dropdown-body{
    padding: 10px 0;
    overflow-y: auto;
    max-height: 60vh ; /* fallback for browsers without support for calc() */
    max-height: calc(90vh - 110px) ;
    white-space: normal;
}
#topmenu-bookmark-dropdown .dropdown-menu > .bookmark-body, #topmenu-bookmark-dropdown .dropdown-body{
    max-height: 60vh ; /* fallback for browsers without support for calc() */
    max-height: calc(90vh - 200px) ;
}

.dropdown-body::-webkit-scrollbar {
    width: 8px;
}
.dropdown-body::-webkit-scrollbar-thumb {
    -webkit-border-radius: 0;
    border-radius: 0;
<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
    background-color: var(--bgnavtop);
<?php } else { ?>
    background-color: var(--bgnavleft);
<?php } ?>
}
.dropdown-body::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    -webkit-border-radius: 0;
    border-radius: 0;
    background: #aaa;
}

#topmenu-login-dropdown, #topmenu-bookmark-dropdown, #topmenu-quickadd-dropdown, #topmenu-global-search-dropdown, #topmenu-tool-dropdown {
    padding: 0 5px 0 5px;
}
#topmenu-login-dropdown a:hover{
    text-decoration: none;
}

#topmenuloginmoreinfo-btn, #topmenulogincompanyinfo-btn {
    display: block;
    text-align: right;
    color:#666;
    cursor: pointer;
}

#topmenuloginmoreinfo, #topmenulogincompanyinfo {
    display: none;
    clear: both;
    font-size: 0.95em;
}

.button-top-menu-dropdown {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
	-moz-transition: all .3s ease-in-out;
	-webkit-transition: all .3s ease-in-out;
	transition: all .3s ease-in-out;
    user-select: none;
    background-image: none;
	border: none;
	border-radius: 0.30em;
}

	.user-footer .pull-left .button-top-menu-dropdown {
		background-color: var(--colorButtonAction1);
		color: #fff;
	}

	.user-footer .pull-left .button-top-menu-dropdown:hover, .user-footer .pull-left .button-top-menu-dropdown:focus {
		background-color: var(--colorButtonAction2);
		border-color: var(--colorButtonAction2);
		box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
		-webkit-box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
		color: #fff;
	}

	.user-footer .pull-right .button-top-menu-dropdown {
		background-color: var(--colorButtonDelete1);
		color: #fff;
	}

	.user-footer .pull-right .button-top-menu-dropdown:hover, .user-footer .pull-left .button-top-menu-dropdown:focus {
		background-color: var(--colorButtonDelete2);
		border-color: var(--colorButtonDelete2);
		box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
		-webkit-box-shadow: inset 0 1px 0 rgba(235,235,235, .6);
		color: #fff;
	}
<?php if ($oblyon_user_block != 'default') { ?>
/* menu deroulant utilisateur redessine (OBLYON_USER_BLOCK = initials / photo, variable de style.css.php) : carte flottante sur les jetons
   du theme (fond flottant, bordure, rayon, ombre), en-tete centre sur la teinte d'accent avec la photo ou l'avatar cercle de la couleur principale, nom en 600 et
   dates de connexion attenuees, corps avec les deux liens "Afficher..." du core en lignes cliquables (fond neutre au survol), pied en flex avec les boutons Fiche /
   Deconnexion sur les jetons de boutons (--oblyon-btn-action-* / --oblyon-btn-delete-*, donc le style de boutons choisi). Le balisage du core (top_menu_user())
   n'est pas modifie ; les selecteurs portent #topmenu-login-dropdown pour passer devant les regles .side-nav-vert ci-dessus */
.login_block #topmenu-login-dropdown .dropdown-menu {
	width: 320px;
	max-width: calc(100vw - 16px);
	margin-top: 6px;
	padding: 0;
	overflow: hidden;
	background: var(--colorOverlayBg);
	color: var(--colortext);
	border: 1px solid var(--oblyon-border);
	border-radius: var(--oblyon-radius);
	box-shadow: var(--oblyon-shadow-lg);
	line-height: 1.45;
}
.login_block #topmenu-login-dropdown .dropdown-menu > .user-header {
	min-height: 0;
	padding: 20px 16px 14px;
	text-align: center;
	white-space: normal;
	background: var(--oblyon-accent-tint);
	border-bottom: 1px solid var(--oblyon-border);
}
.login_block #topmenu-login-dropdown .user-header img.dropdown-user-image,
.login_block #topmenu-login-dropdown .user-header .oblyon-avatar {
	width: 72px;
	height: 72px;
	border: 3px solid var(--colorOverlayBg);
	box-shadow: 0 0 0 2px var(--maincolor);
	background-color: var(--colorOverlayBg);
}
.login_block #topmenu-login-dropdown .user-header .oblyon-avatar {
	font-size: 24px;
	background-color: var(--maincolor);
}
.login_block #topmenu-login-dropdown .user-header p {
	margin: 10px 0 0;
	color: var(--colortext);
	font-size: 1.05em;
	font-weight: 600;
}
.login_block #topmenu-login-dropdown .user-header p small {
	font-size: .82em;
	font-weight: 400;
	color: var(--oblyon-muted-text);
}
.login_block #topmenu-login-dropdown .user-header p .fa-star {
	color: var(--maincolor);
}
.login_block #topmenu-login-dropdown .dropdown-menu > .user-body {
	padding: 8px 10px;
	border: 0;
	color: var(--colortext);
}
.login_block #topmenu-login-dropdown .user-body > br {
	display: none;	/* le core separe les deux liens par un saut de ligne : les lignes cliquables portent leur propre espacement */
}
.login_block #topmenu-login-dropdown #topmenuloginmoreinfo-btn,
.login_block #topmenu-login-dropdown #topmenulogincompanyinfo-btn {
	text-align: <?php print $left; ?>;
	padding: 8px 10px;
	border-radius: var(--oblyon-radius-sm);
	color: var(--colortext);
	font-weight: 500;
	transition: background-color var(--oblyon-transition), color var(--oblyon-transition);
}
.login_block #topmenu-login-dropdown #topmenuloginmoreinfo-btn:hover,
.login_block #topmenu-login-dropdown #topmenulogincompanyinfo-btn:hover {
	background: var(--oblyon-neutral-bg);
	color: var(--maincolor);
}
.login_block #topmenu-login-dropdown #topmenuloginmoreinfo-btn i,
.login_block #topmenu-login-dropdown #topmenulogincompanyinfo-btn i {
	width: 1em;
	margin-<?php print $right; ?>: 4px;
	text-align: center;
	color: var(--oblyon-muted-text);
}
.login_block #topmenu-login-dropdown #topmenuloginmoreinfo,
.login_block #topmenu-login-dropdown #topmenulogincompanyinfo {
	padding: 2px 10px 10px 24px;
	font-size: .92em;
	line-height: 1.6;
	color: var(--colortext);
}
.login_block #topmenu-login-dropdown #topmenuloginmoreinfo > br:first-child,
.login_block #topmenu-login-dropdown #topmenulogincompanyinfo > br:first-child {
	display: none;	/* le core ouvre chaque bloc d'informations par un saut de ligne : le padding du bloc suffit */
}
.login_block #topmenu-login-dropdown #topmenuloginmoreinfo b,
.login_block #topmenu-login-dropdown #topmenulogincompanyinfo b {
	font-weight: 600;
}
.login_block #topmenu-login-dropdown #topmenuloginmoreinfo u {
	text-decoration: none;
	font-weight: 600;
	color: var(--maincolor);
}
.login_block #topmenu-login-dropdown .dropdown-menu > .user-footer {
	display: flex;
	align-items: center;
	gap: 8px;
	padding: 12px 16px;
	background: var(--oblyon-neutral-bg);
	border-top: 1px solid var(--oblyon-border);
}
.login_block #topmenu-login-dropdown .user-footer .pull-left,
.login_block #topmenu-login-dropdown .user-footer .pull-right {
	float: none;
}
.login_block #topmenu-login-dropdown .user-footer .pull-right {
	margin-<?php print $left; ?>: auto;
}
.login_block #topmenu-login-dropdown .user-footer .clearboth {
	display: none;
}
.login_block #topmenu-login-dropdown .user-footer .button-top-menu-dropdown {
	padding: 7px 12px;
	font-size: var(--fontsize);
	font-weight: 500;
	line-height: 1.3;
	border: 1px solid transparent;
	border-radius: var(--oblyon-radius-sm);
	box-shadow: none;
	transition: background-color var(--oblyon-transition), color var(--oblyon-transition), border-color var(--oblyon-transition);
}
.login_block #topmenu-login-dropdown .user-footer .pull-left .button-top-menu-dropdown {
	background-color: var(--oblyon-btn-action-bg);
	color: var(--oblyon-btn-action-txt);
	border-color: var(--oblyon-btn-action-border);
}
.login_block #topmenu-login-dropdown .user-footer .pull-left .button-top-menu-dropdown:hover,
.login_block #topmenu-login-dropdown .user-footer .pull-left .button-top-menu-dropdown:focus {
	background-color: var(--oblyon-btn-action-bg-hover);
	color: var(--oblyon-btn-action-txt-hover);
	border-color: var(--oblyon-btn-action-bg-hover);
	box-shadow: none;
}
.login_block #topmenu-login-dropdown .user-footer .pull-right .button-top-menu-dropdown {
	background-color: var(--oblyon-btn-delete-bg);
	color: var(--oblyon-btn-delete-txt);
	border-color: var(--oblyon-btn-delete-border);
}
.login_block #topmenu-login-dropdown .user-footer .pull-right .button-top-menu-dropdown:hover,
.login_block #topmenu-login-dropdown .user-footer .pull-right .button-top-menu-dropdown:focus {
	background-color: var(--oblyon-btn-delete-bg-hover);
	color: var(--oblyon-btn-delete-txt-hover);
	border-color: var(--oblyon-btn-delete-bg-hover);
	box-shadow: none;
}
<?php } ?>

    .dropdown-menu a.top-menu-dropdown-link {
        color: var(--colorfline) !important;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        display: block;
        margin: 5px 0px;
    }
    .dropdown-item {
        display: block !important;
        box-sizing: border-box;
        width: 100%;
        padding: .25rem 1.5rem .25rem 1rem;
        clear: both;
        font-weight: 400;
        color: var(--colorfline) !important;
        text-align: inherit;
        background-color: transparent;
        border: 0;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
    }
    .dropdown-item::before {
        /* font part */
        font-family: var(--fontawesomeFamily);
        font-weight: var(--fontawesomeWeight);
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        text-align:center;
        text-decoration:none;
        margin-right: 5px;
        display: inline-block;
        content: "\f0da";
        color: rgba(0,0,0,0.3);
    }
    .dropdown-item.active, .dropdown-item:hover, .dropdown-item:focus, .dropdown-menu a.top-menu-dropdown-link:hover   {
        text-decoration: none;
<?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
    background-color: var(--bgnavtop);
    color: var(--bgnavtop_txt) !important;
<?php } else { ?>
    background-color: var(--bgnavleft);
    color: var(--bgnavleft_txt) !important;
<?php } ?>
    }
    /*
     * SEARCH
     */
    .dropdown-search-input {
        width: 100%;
        padding: 10px 35px 10px 20px;
        background-color: transparent;
        font-size: 14px;
        line-height: 16px;
        box-sizing: border-box;
        color: var(--colorfline);
        background-color: transparent;
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-size: 16px 16px;
        background-position: 95% center;
        border-radius: 50px;
        border: 1px solid #c4c4c2 !important;
        transition: all 250ms ease-in-out;
        backface-visibility: hidden;
        transform-style: preserve-3d;
    }
    .dropdown-search-input::placeholder {
        color: color(var(--colorfline) a(0.8));
        letter-spacing: 1.5px;
    }
    .hidden-search-result{
        display: none !important;
    }

    /*
     * QUICK ADD
     */
    #topmenu-quickadd-dropdown .dropdown-menu {
        width: 335px !important;
        color: var(--colortext);	/* InfraS change 3.7.0 : texte courant (etait #444 sur le fond de page du preset) */
    }

    .quickadd-header {
        color: var(--colortext) !important;	/* InfraS change 3.7.0 */
    }

    div.quickadd {
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        -webkit-flex-wrap: wrap;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-align-content: center;
        -ms-flex-line-pack: center;
        align-content: center;
        -webkit-align-items: flex-start;
        -ms-flex-align: start;
        align-items: flex-start;
    }

    div.quickadd a {
        color: var(--colortext);	/* InfraS change 3.7.0 */
		height: 60px;
		width: 110px;
    }

    div.quickadd a:hover, div.quickadd a:active {
        color: var(--bgnavtop_txt);
    }

    div.quickaddblock {
        width: 110px;
        display: block ruby;
    }

    div.quickaddblock:hover,
    div.quickaddblock:active,
    div.quickaddblock:focus {
        background: var(--maincolor);
    }

    /* for the dropdown on action buttons */
    .dropdown-holder { /* InfraS change: added missing leading dot, selector never matched .dropdown-holder */
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        z-index: 5; /* InfraS change: aligned with eldy so the menu stacks above surrounding page content */
        width: 300px;
        right:10px;	/* will be set with js */
        /* InfraS add begin: default anchor below the button, aligned with eldy */
        bottom: 0;
        transform: translateY(100%);
        /* InfraS add end */
        /* InfraS change begin : jetons de design (plus d'ombre decalee sans flou) */
        background: var(--colorbline);
        border: 1px solid var(--oblyon-border);
        text-align: var(--left);
        border-radius: var(--oblyon-radius);
        box-shadow: var(--oblyon-shadow-lg);
        /* InfraS change end */
    }

    .dropdown-content a {
        margin-right: auto !important;
        margin-left: auto !important;
    }
    .dropdown-content .butAction {
        background: none;
        color: var(--colortext) !important;
    }
    .dropdown-content a.butAction {
        display: flex;
        background-color: unset !important;
    }
    .dropdown-content .butAction:hover, .dropdown-content a.butAction:hover {
        box-shadow: none;
        text-decoration: none;
    <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            background-color: var(--bgnavtop_hover) !important;
            color: var(--bgnavtop_txt) !important;
    <?php } else { ?>
            background-color: var(--bgnavleft_hover) !important;
            color: var(--bgnavleft_txt) !important;
    <?php } ?>
    }
    .dropdown-content .butActionRefused {
        margin-left: 0;
        margin-right: 0;
        border: none;
    }

    .dropdown-holder.open .dropdown-content {
        display: block;
        background-color: var(--bgcolor) !important;
        color: var(--colortext) !important;
    }

    /* dropdown --up variant */
    .dropdown-holder.--up .dropdown-content {
        bottom: auto;
        top: 0;
        transform: translateY(-100%);
    }

    /* dropdown --left variant */
    .dropdown-holder.--left .dropdown-content {
        right: auto;
        left: 12px;
    }

    /** dropdown arrow used to clearly identify parent button of dropdown*/
    .dropdown-holder.open .dropdown-content::before {
        --triangleBorderSize : 5px;
        position: absolute;
        content: "";
        top: calc(var(--triangleBorderSize) * -1);
        right: 12px;
        width: 0px;
        height: 0px;
        border-style: solid;
        border-width: 0 var(--triangleBorderSize) var(--triangleBorderSize) var(--triangleBorderSize);
        border-color: transparent transparent var(--colorbline) transparent;	/* InfraS change : valeur #ffff invalide */
        transform: rotate(0deg);
    }

    /* dropdown --up arrow variant */
    .dropdown-holder.--up.open .dropdown-content::before {
        top: auto;
        bottom: calc(var(--triangleBorderSize) * -1);
        border-width: 0 var(--triangleBorderSize) var(--triangleBorderSize) var(--triangleBorderSize);
        transform: rotate(180deg);
    }

    /* dropdown --left arrow variant */
    .dropdown-holder.--left.open .dropdown-content::before {
        right: auto;
        left: 12px;
    }

    /*
     * Responsive
     */
    @media only screen and (max-width: 767px)
    {
        .dropdown-search-input {
            width: 100%;
        }

        .tmenu .dropdown-menu, .login_block .dropdown-menu, .topnav .dropdown-menu {
            margin-left: 5px;
            right: 0;
        }

        #topmenu-quickadd-dropdown .dropdown-menu {
            min-width: 220px;
            max-width: 235px;
        }
        #topmenu-bookmark-dropdown .dropdown-menu {
            min-width: 220px;
            max-width: 360px;
        }

        .side-nav-vert .user-menu .dropdown-menu, .topnav .user-menu .dropdown-menu {
            width: 300px;
        }
        .dropdown-menu {
            border: none;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

    }

    @media only screen and (max-width: 570px) {
        #topmenu-login-dropdown, #topmenu-bookmark-dropdown, #topmenu-quickadd-dropdown, #topmenu-global-search-dropdown, #topmenu-tool-dropdown {
            padding: 0 2px 0 2px;
        }
    }
