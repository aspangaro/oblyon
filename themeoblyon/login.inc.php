<?php
if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */

    /* Login */

    .bodylogin
    {
		background: var(--colorbtitle);
        display: table;
        position: absolute;
        height: 100%;
        width: 100%;
        font-size: 1em;
    }
    .login_center {
		margin-top: 30vw;
<?php if (!getDolGlobalString('MAIN_LOGIN_RIGHT')) { ?>
		display: table-cell;
		vertical-align: middle;
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
		color: var(--bgnavtop_txt) !important;
		padding-bottom: 10px;
    }
	.login_table_title a {
		margin: auto;
	}
    .login_table label {
        text-shadow: 1px 1px 1px #FFF;
    }
    .login_table {
		margin: <?php echo !getDolGlobalString('MAIN_LOGIN_RIGHT') ? '0px auto' : '0px calc((50vw - 600px) / 2) 0px auto'; ?>;

		padding: 4px;
		width: 600px;
		max-width: <?php echo !getDolGlobalString('MAIN_LOGIN_RIGHT') ? '600px' : '50vw'; ?>;
<?php if (getDolGlobalString('MAIN_LOGIN_RIGHT')) { ?>
		width: 600px;
<?php } ?>
		-webkit-box-shadow: 12px 12px 25px 1px rgba(0, 0, 0, 0.2), 0 2px 6px rgba(60,60,60,0.15);
		box-shadow: 12px 12px 25px 1px rgba(0, 0, 0, 0.2), 0 2px 6px rgba(60,60,60,0.15);
        <?php
            if (getDolGlobalString('MAIN_LOGIN_BACKGROUND')) {
				print '	background-color: var(--colorbtitle);';
            } else {
                print '	background-color: #FFFFFF;';
            }
        ?>
		border-radius: 4px;
        /*border-top:solid 1px rgba(180,180,180,.4);
        border-left:solid 1px rgba(180,180,180,.4);
        border-right:solid 1px rgba(180,180,180,.4);
        border-bottom:solid 1px rgba(180,180,180,.4);*/
    }
    .login_table input#username, .login_table input#password, .login_table input#securitycode {
        border: none;
        border-bottom: solid 1px rgba(180,180,180,.4);
        padding: 5px;
        margin-left: 10px;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .login_table input#username:focus, .login_table input#password:focus, .login_table input#securitycode:focus {
        outline: none !important;
    }
    .login_table .trinputlogin {
        font-size: 1.2em;
        margin: 8px;
    }
    .login_table .tdinputlogin {
        background-color: transparent;
        /* border: 2px solid #ccc; */
        min-width: 220px;
        border-radius: 2px;
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
        min-width: 245px;
        padding-top: 10px;
        padding-left: 16px;
        padding-right: 16px;
        text-align: center;
        vertical-align: middle;
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
		color: var(--colorftitle);
    }
    div.login_block {
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            background-color: var(--bgnavleft);
            height: 40px;
        <?php } else { ?>
            background-color: var(--bgnavtop);
            height: 54px;
        <?php } ?>
        /* padding-right: 10px; */
        <?php if (getDolGlobalString('OBLYON_STICKY_TOPBAR')) { ?>
            position: fixed !important;
        <?php } else { ?>
            position: absolute !important;
        <?php } ?>
        top: 0;
        <?php print $right; ?>: 0px;
        z-index: 100;
        <?php if (GETPOST("optioncss") == 'print') { ?>
            display: none;
        <?php } ?>
    }
    div.login_block a {
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            color: var(--bgnavleft_txt);
        <?php } else { ?>
            color: var(--bgnavtop_txt);
        <?php } ?>
        display: inline-block;
    }
    div.login_block span.aversion {
        <?php if(getDolGlobalString('OBLYON_DISABLE_VERSION')) { ?>
            display: none !important;
        <?php } else { ?>
            <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
                color: var(--bgnavleft_txt);
            <?php } else { ?>
                color: var(--bgnavtop_txt);
            <?php } ?>
            filter: contrast(0.7);
        <?php } ?>
    }
    div.login_block table {
        display: inline;
    }
    div.login {
        white-space:nowrap;
        font-weight: bold;
        float: right;
    }
    div.login a, div.login_block_user a {
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            color: var(--bgnavleft_txt);
        <?php } else { ?>
            color: var(--bgnavtop_txt);
        <?php } ?>
    }
    div.login a:hover {
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            color: var(--bgnavleft_txt);
        <?php } else { ?>
            color: var(--bgnavtop_txt);
        <?php } ?>
        text-decoration:underline;
    }
    div.login_block:after {
        /*content: '\f013';*/
        color: var(--bgnavtop_txt);
        font-family: var(--fontawesomeFamily) !important;
        font-size: 20px;
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            line-height: 40px;
        <?php } else { ?>
            line-height: 54px;
        <?php } ?>
    }
    div.login_block:hover:after {
        color: <?php print $maincolor; ?>;
    }
    div.login_block_tools {
        margin-<?php print $right ?>: 8px;
        display: inline-block;
        vertical-align: middle;
        line-height: <?php print $disableimages ? '25' : '40'; ?>px;
        height: <?php print $disableimages ? '25' : '40'; ?>px;
    }
    div.login_block_other {
        display: inline-block;
        vertical-align: middle;
        clear: <?php print $disableimages ? 'none' : 'both'; ?>;
        padding-top: 0;
        text-align: <?php print $right ?>;
        max-width: 200px;
    }
    div.login_block_user {
    	display: inline-block;
    	vertical-align: middle;
        /*clear: left;*/
        /*float: <?php print $left; ?>;*/
        margin-right: 0px;
    }
    div.login_block_user .login a,
    div.login_block_user a {
        display: table-cell;
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            font-size: 13px;
        <?php } ?>
        font-family: <?php print $fontmainmenu; ?>;
        font-weight: 500;
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            height: 40px;
        <?php } else { ?>
            height: 54px;
        <?php } ?>
        max-width: 300px;
        overflow: hidden;
        padding: 0 3px;
        text-overflow: ellipsis;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        vertical-align: middle;
    }
    div.login_block_user > .classfortooltip.login_block_elem2 {
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            height: 40px;
        <?php } else { ?>
            height: 54px;
        <?php } ?>
    }
    .login_block_other {
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            background: var(--bgnavleft);
        <?php } else { ?>
            background: var(--bgnavtop);
        <?php } ?>
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            display: none;
        <?php } ?>
        /* position: absolute; */
        right: 0;
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            top: 40px;
            height: 40px;
            line-height: 36px;
        <?php } else { ?>
            top: 54px;
            height: 54px;
            line-height: 50px;
        <?php } ?>
        padding-top: 0;
        text-align: right;
        margin-right: 3px;
    }
    .login_block:hover > .login_block_other {
        /* display: block; */
    }

    .login_block_user a img.loginphoto {
        display: none;
    }

    .login_block_elem a span.atoplogin, .login_block_elem span.atoplogin {
    	vertical-align: middle;
    }

    .login_block_elem {
        float: <?php print $left; ?>;
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            background-color: var(--bgnavleft);
            height: 40px;
        <?php } else { ?>
            background-color: var(--bgnavtop);
            height: 54px;
        <?php } ?>
        padding: 0;
    }
    .login_block_elem.classfortooltip {
        margin: 0;
    }
    .login_block_elem a,
    .login_block td.classfortooltip a {
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            color: var(--bgnavleft_txt);
            font-size: 16px;
            height: 40px;
            line-height: 36px;
        <?php } else { ?>
            color: var(--bgnavtop_txt);
            font-size: 18px;
            height: 54px;
            line-height: 50px;
        <?php } ?>
        display: block;
        font-family: var(--fontfamilydol);
        padding: 0 3px;
        text-decoration: none;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
    }
    .login_block_elem a:hover,
    .login_block td.classfortooltip a:hover {
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            color: var(--bgnavleft_txt_hover);
        <?php } else { ?>
            color: var(--bgnavtop_txt_hover);
        <?php } ?>
    }
    .atoplogin, .atoplogin:hover {
    <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
        color: var(--bgnavleft_txt) !important;
    <?php } else { ?>
        color: var(--bgnavtop_txt) !important;
    <?php } ?>
    }
    .login_block_getinfo {
        text-align: center;
    }
    .login_block_getinfo div.login_block_user {
        display: block;
    }
    .login_block_getinfo .atoplogin, .login_block_getinfo .atoplogin:hover {
    	color: #333 !important;
    	font-weight: normal !important;
    }
    .alogin, .alogin:hover {
    	font-weight: normal !important;
    	padding-top: 2px;
    }
    .alogin:hover, .atoplogin:hover {
    	text-decoration:underline !important;
    }
    span.fa.atoplogin, span.fa.atoplogin:hover {
    	font-size: 16px;
    	text-decoration: none !important;
    }
    .atoplogin #dropdown-icon-down, .atoplogin #dropdown-icon-up {
    	font-size: 0.7em;
    }
    .login_block_elem img.printer,
    .login_block_elem img.login,
    .login_block_elem img.help,
    .login_block td.classfortooltip img.printer,
    .login_block td.classfortooltip img.login,
    .login_block td.classfortooltip img.help {
        vertical-align: baseline;
    }
    img.login, img.printer, img.help, img.entity {
        /* padding: 0px 0px 0px 4px; */
        /* margin: 0px 0px 0px 8px; */
        text-decoration: none;
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            color: var(--bgnavleft_txt);
        <?php } else { ?>
            color: var(--bgnavtop_txt);
        <?php } ?>
        font-weight: bold;
    }
    .userimg.atoplogin img.userphoto, .userimgatoplogin img.userphoto {		/* size for user photo in login bar */
        width: <?php print $disableimages ? '26' : '32'; ?>px;
        height: <?php print $disableimages ? '26' : '32'; ?>px;
        border-radius: 50%;
        background-size: contain;
    	border: 1px solid;
    	border-color: rgba(255, 255, 255, 0.2);
    }
    img.userphoto {				/* size for user photo in lists */
        border-radius: 0.72em;
        width: 1.4em;
        height: 1.4em;
        background-size: contain;
        vertical-align: middle;
    }
    img.userphotosmall {		/* size for user photo in lists */
        border-radius: 0.6em;
        width: 1.2em;
        height: 1.2em;
        background-size: contain;
        vertical-align: middle;
    	background-color: #FFF;
    }
    img.userphoto[alt="Gravatar avatar"], img.photouserphoto.dropdown-user-image[alt="Gravatar avatar"] {
    	background: #fff;
    }
    form[name="addtime"] img.userphoto {
    	border: 1px solid #444;
    }
    .span-icon-user {
        background-image: url(<?php print dol_buildpath($path.'/theme/'.$theme.'/img/object_user.png',1); ?>);
        background-repeat: no-repeat;
    }
    .span-icon-password {
        background-image: url(<?php print dol_buildpath($path.'/theme/'.$theme.'/img/lock.png',1); ?>);
        background-repeat: no-repeat;
    }
    .login_block td.classfortooltip { height: 40px; }
    .login_block .classfortooltip:hover,
    .login_block .classfortooltip:focus {
        <?php if (getDolGlobalString('MAIN_MENU_INVERT')) { ?>
            background-color: var(--bgnavleft_hover);
        <?php } else { ?>
            background-color: var(--bgnavtop_hover);
        <?php } ?>
    }
    div.login_block table { display: inline; }
    /* db inf v3.5 */
    td div.login {
        white-space: nowrap;
        padding: 0;
        margin: 0;
        font-weight: bold;
        color: #f4f4f4;
    }
    .alogin {
        font-weight: normal !important;
        font-size: <?php print $fontsizesmaller; ?>px !important;
    }
    .alogin:hover {
        text-decoration: underline !important;
        color: <?php print $maincolor; ?> !important;
    }
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
