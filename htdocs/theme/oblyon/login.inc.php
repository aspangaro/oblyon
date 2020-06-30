<?php
if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */

    /* Login */

    .bodylogin
    {
        background: #f0f0f0;
        display: table;
        position: absolute;
        height: 100%;
        width: 100%;
        font-size: 1em;
    }
    .login_center {
        display: table-cell;
        vertical-align: middle;
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
        max-width: 530px;
        color: #eee !important;
        padding-bottom: 20px;
        text-shadow: 1px 1px #444;
    }
    .login_table label {
        text-shadow: 1px 1px 1px #FFF;
    }
    .login_table {
        margin: 0px auto;  /* Center */
        padding-left:6px;
        padding-right:6px;
        padding-top:16px;
        padding-bottom:12px;
        max-width: 560px;
    <?php
    if (! empty($conf->global->MAIN_LOGIN_BACKGROUND)) {
        print '	background-color: rgba(255, 255, 255, 0.9);';
    } else {
        print '	background-color: #FFFFFF;';
    }
    ?>

        -webkit-box-shadow: 0 2px 23px 2px rgba(0, 0, 0, 0.2), 0 2px 6px rgba(60,60,60,0.15);
        box-shadow: 0 2px 23px 2px rgba(0, 0, 0, 0.2), 0 2px 6px rgba(60,60,60,0.15);

        border-radius: 5px;
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
        min-width: 60px;
    }
    #img_securitycode {
        border: 1px solid #DDDDDD;
    }
    #img_logo, .img_logo {
        max-width: 170px;
        max-height: 90px;
    }

    div.backgroundsemitransparent {
        background:rgba(255,255,255,0.6);
        padding-left: 10px;
        padding-right: 10px;
    }
    div.login_block {
        position: absolute;
        text-align: <?php print $right; ?>;
    <?php print $right; ?>: 0;
        top: <?php print $disableimages?'4px':'0'; ?>;
        line-height: 10px;
    <?php // echo (empty($disableimages) && $maxwidthloginblock)?'max-width: '.$maxwidthloginblock.'px;':''; ?>
    <?php if (GETPOST('optioncss', 'aZ09') == 'print') { ?>
        display: none;
    <?php } ?>
    }
    div.login_block a {
        color: #<?php echo $colortextbackhmenu; ?>;
        display: inline-block;
    }
    div.login_block span.aversion {
    <?php if ( $conf->global->MAIN_MENU_INVERT ) { ?>
        color: <?php echo $bgnavleft_txt; ?>;
    <?php } else { ?>
        color: <?php echo $bgnavtop_txt; ?>;
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
    div.login a {
        color: #<?php echo $colortextbackvmenu; ?>;
    }
    div.login a:hover {
        color: #<?php echo $colortextbackvmenu; ?>;
        text-decoration:underline;
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
