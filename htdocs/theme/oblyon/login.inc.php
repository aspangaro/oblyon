<?php
if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */

/*------------------------------------*\
		#Login Page
\*------------------------------------*/
[ RESTYLE TAG ]*/

* {
    margin: 0px;
    padding: 0px;
    box-sizing: border-box;
}

body, html {
    height: 100%;
}

.p-b-10 { padding-bottom: 10px; }

[ login ]*/
.limiter {
    width: 100%;
    margin: 0 auto;
}

.container-login100 {
    width: 100%;
    min-height: 100vh;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-direction: row-reverse;
    /*flex-wrap: wrap;*/
    justify-content: center;
    /*align-items: center;*/
    background: #f2f2f2;
}

/*==================================================================
[ login wrap ]*/
.wrap-login100 {
    width: 100%;
    background: #2A2A2A;
    overflow: hidden;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
}

/*==================================================================
[ login more ]*/
.login100-more {
    width: 100%;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: 25% 15%;
    position: relative;
    z-index: 1;
}

.login100-more::before {
    content: "";
    display: block;
    position: absolute;
    z-index: -1;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
}



/*==================================================================
[ Form ]*/

.login100-form {
    width: 100%;
    min-height: 100vh;
    display: block;
    /*padding: 85px 80px 40px 80px;*/
}

.login100-form-title {
    width: 100%;
    display: block;
    font-size: 30px;
    color: #FFFFFF;
    line-height: 1.2;
    text-align: center;
}
/*==================================================================
[ Login_table ]*/
input#securitycode {
    margin-right: .5em;
}

#captcha_refresh_img {
    margin: .5em;
}

.login_table {
    margin: 5% auto 0;	/* Center */

    padding-left:6px;
    padding-right:6px;
    padding-top:16px;
    padding-bottom:12px;
}

.info_table {
    margin: 30% auto 0;	/* Center */

    padding-left:6px;
    padding-right:6px;
    padding-top:16px;
    padding-bottom:12px;
}

.login_table input#username, .login_table input#password, .login_table input#securitycode{
    border-width: 2px;
    border-style: solid;
    /* border-bottom: solid 1px rgba(180,180,180,.4); */
    padding: 5px;
    margin-left: 18px;
    margin-top: 5px;
    margin-bottom: 5px;
    border-radius: 5px;
}

#img_securitycode {
    border: 1px solid #ddd;
}

#img_logo {
    max-width: 200px;
    margin-top: 20%;
}

.login_table input#username:focus, .login_table input#password:focus, .login_table input#securitycode:focus {
    outline: none !important;
}
.login_table .trinputlogin {
    margin: 8px;
}
.login_table .tdinputlogin {
    background-color: #fff;
    border: 2px solid #ccc;
    min-width: 220px;
    border-radius: 2px;
}
.login_table .tdinputlogin .fa {
    padding-left: 10px;
    width: 14px;
}

.login_main_message {
    text-align: center;
    max-width: 570px;
    margin-bottom: 10px;
}
.login_main_message .error {
    border: 1px solid #caa;
    padding: 10px;
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

.login_main_home {
    background-color: #E74C3C;
    color: #000;
    line-height: 1.4em;
    font-size: 1.1em;
    margin: 0;
    padding: 12px 6px 6px 6px;
    border-color: #990000;
    border-style:solid;
    border-width:0px 0px 0px 5px;
}

/*------------------------------------------------------------------
[ Input ]*/

.wrap-input100 {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    width: 100%;
    height: 80px;
    position: relative;
    border: 1px solid #e6e6e6;
    border-radius: 10px;
    margin-bottom: 10px;
}

.label-input100 {
    font-size: 18px;
    color: #999999;
    line-height: 1.2;

    display: block;
    position: absolute;
    pointer-events: none;
    width: 100%;
    padding-left: 24px;
    left: 0;
    top: 30px;

    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}

.input100 {
    display: block;
    width: 100%;
    background: transparent;
    font-size: 18px;
    color: #555555;
    line-height: 1.2;
    padding: 0 26px;
}

input.input100 {
    height: 100%;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}

.login_table input#username, .login_table input#password, .login_table input#securitycode{
    border: 1px solid;
    padding: 5px;
    margin-left: 10px;
    margin-top: 5px;
}
.login_table input#username:focus, .login_table input#password:focus, .login_table input#securitycode:focus {
    outline: none !important;
}

/*==================================================================
[ Text ]*/
a.txt2 {
    font-size: 14px;
    line-height: 1.7;
    margin: 0px;
    transition: all 0.4s;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
}

a.txt3 {
    font-size: 11px;
    line-height: 1.4;
    margin: 0px;
    transition: all 0.4s;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
}

.title1 {
    font-size: 24px;
    font-weight: bold;
    line-height: 1.4;
}

.title2 {
    font-size: 22px;
    font-weight: bold;
    line-height: 1.4;
}

.txt1 {
    font-size: 13px;
    line-height: 1.4;
}

.txt2 {
    font-size: 13px;
    line-height: 1.4;
}

.txt3 {
    font-size: 11px;
    line-height: 1.4;
}

/*------------------------------------------------------------------
[ Button ]*/
.container-login100-form-btn {
    width: 50%;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.login100-form-btn {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    width: 100%;
    height: 50px;
    border-radius: 30px;
    border:none;

    font-size: 12px;
    line-height: 1.2;
    /* text-transform: uppercase; */
    letter-spacing: 1px;
    font-weight: bold;

    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}

.login100-form-btn:hover {
    cursor: pointer;
}

/*------------------------------------------------------------------
[ Color ]*/

<?php
    $login_background_color_right = $conf->global->OBLYON_COLOR_LOGIN_BCKGRD_RIGHT;
    $login_background_color_left = $conf->global->OBLYON_COLOR_LOGIN_BCKGRD_LEFT;
    $login_txt_color_right = $conf->global->OBLYON_COLOR_LOGIN_TXT_RIGHT;
    $login_txt_color_left = $conf->global->OBLYON_COLOR_LOGIN_TXT_LEFT;
    $login_txt_color_input = $conf->global->OBLYON_COLOR_LOGIN_TXT_INPUT;
?>

.wrap-login100 {
    background: <?php print $login_background_color_right ?>;
}

.login100-more {
    background: <?php print $login_background_color_left ?>;
}

.login_table input#username, .login_table input#password, .login_table input#securitycode{
    border-color: <?php print $login_txt_color_input ?>;
    color: <?php print $login_txt_color_input ?>;
    background-color: <?php print $login_background_color_right ?>;
}

.login_table input#username:focus, .login_table input#password:focus, .login_table input#securitycode:focus {
    border-color: #d51123;
}

.login100-form-btn {
    background: #d51123;
    color: #fff;
}

.login100-form-btn:hover {
    background: #292f3d;
}

a.txt2 {
    color: #4C8BFF;
}

a.txt3 {
    color: #4C8BFF;
}

.title1 {
    color: <?php print $login_txt_color_right ?>;
}

.title2 {
     color: #FFFFFF;
}

.txt1 {
    color: <?php print $login_txt_color_right ?>;
}

.txt2 {
    color: #4C8BFF;
}

.txt3 {
    color : <?php print $login_txt_color_right ?>;
}

.iconinfo {
    color: #FFFFFF;
    padding-left:10px;
}

.iconinfo:hover {
    color: #818181;
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
