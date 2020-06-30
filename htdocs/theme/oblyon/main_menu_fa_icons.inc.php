<?php if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */

.icon {
    /* use !important to prevent issues with browser extensions that change fonts */
    font-family: "Font Awesome 5 Free"; !important;
    font-weight: 900;
    font-style: normal;
    font-variant: normal;
    line-height: 1;
    speak: none;
    text-transform: none;

    /* Better Font Rendering =========== */
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}


.icon--home:before {
    content: '\f015';
}

.icon--ftp:before {
    content: '\f362';
}

.icon--contracts:before {
    content: '\f56c';
}

.icon--commercial:before {
    content: '\f0f2';
}

.icon--cat:before,
.icon--tags:before {
    content: '\f02c';
}

.icon--externalsite:before {
    content: '\f360';
}

.icon--websites:before, .icon--website:before {
    content: '\f542';
}

.icon--filemanager:before {
    content: '\f802';
}

.icon--members:before {
    content: '\f0c0';
}

.icon--subscriptions:before {
    content: '\f65c';
}

.icon--tools:before {
    content: '\f0ad';
}

.icon--geopipmaxmind:before {
    content: '\f601';
}

.icon--cashdesk:before,
.icon--cashcontrol:before,
.icon--shop:before,
.icon--orders:before,
.icon--orders_suppliers:before {
    content: '\f788';
}

.icon--margins:before {
    content: '\f643';
}

.icon--project:before,
.icon--projects:before {
    content: '\f0e8';
}
.icon--tasks:before {
    content: '\f828';
}

.icon--product:before,
.icon--products:before {
    content: '\f1b2';
}

.icon--companies:before,
.icon--thirdparties:before {
    content: '\f1ad';
}

.icon--billing:before {
    content: '\f51e';
}

.icon--accountancy:before,
.icon--accounting:before {
    content: '\f53d';
}

.icon--bank:before {
    content: '\f19c';
}

.icon--hrm:before,
.icon--holiday:before {
    content: '\f508';
}

.icon--service:before {
    content: '\f4c4';
}

.icon--withdraw:before,
.icon--ticket:before{
    content: '\f3ff';
}

.icon--agenda:before {
    content: '\f073';
}

.icon--ecm:before {
    content: '\f07c';
}

.icon--checks:before {
    content: '\f53c';
}

.icon--click2dial:before {
    content: '\f67d';
}

.icon--paypal:before {
    font-family: "Font Awesome 5 Brands";
    content: '\f1ed';
}

.icon--stripe:before {
    font-family: "Font Awesome 5 Brands";
    content: '\f42a';
}

.icon--google:before {
    font-family: "Font Awesome 5 Brands";
    content: '\f1a0';
}

.icon--webservices:before {
    content: '\f719';
}

.icon--contacts:before {
    content: '\f0c0';
}

.icon--sendings:before {
    content: '\f472';
}

.icon--ficheinter:before {
    content: '\f479';
}

.icon--tax:before {
    content: '\f295';
}

.icon--donations:before {
    content: '\f4b9';
}

.icon--ca:before {
    content: '\f53a';
}

.icon--mailing:before,
.icon--email_templates:before {
    content: '\f658';
}

.icon--export:before {
    content: '\f56e';
}

.icon--import:before,
.icon--transfer:before {
    content: '\f56f';
}

.icon--propals:before {
    content: '\f571';
}

.icon--suppliers_bills:before {
    content: '\f570';
}

.icon--customers_bills:before,
.icon--members_subscription:before{
    content: '\f507';
}

.icon--stock:before {
    content: '\f480';
}

.icon--tripsandexpenses:before,
.icon--expensereport:before {
    content: '\f63c';
}

.icon--opensurvey:before {
    content: '\f682';
}

.icon--asset:before {
    content: '\f467';
}

.icon--webhost:before {
    content: '\f233';
}

/* Secondary Nav */
.icon--setup:before {
    content: '\f7d9';
}

.icon--admintools:before,
.icon--accountancy_admin:before {
    content: '\f0ad';
}

.icon--modulesadmintools:before{
    content: '\f0ad';
}

.icon--users:before {
    content: '\f500';
}

.icon--email_templates:before {
    content: '\f674';
}

.icon--resource:before {
    content: '\f79c';
}

/* External modules */
.icon--cron:before {
    content: '\f017';
}

.icon--scanner:before {
    content: '\f8f3';
}

.icon--reports:before {
    content: '\f65a';
}

/* Generic modules */
.icon--generic:before {
    content: '\f07c';
}

/* Compatibility */
.mainmenu::before{
    /* font part */
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 26px;
	font-size: <?php echo $topMenuFontSize; ?>;
    -webkit-font-smoothing: antialiased;
    text-align:center;
	text-decoration:none;
	color: #<?php echo $colortextbackhmenu; ?>;
}


div.mainmenu.menu {
	background-image: none;
}

div.mainmenu.menu::before {
	content: "\f0c9";
}


div.mainmenu.home::before{
	content: "\f015";
}

div.mainmenu.billing::before {
    content: "\f51e";
}

div.mainmenu.accountancy::before {
    content: "\f53d";
}

div.mainmenu.agenda::before {
    content: "\f073";
}

div.mainmenu.bank::before {
    content: "\f19c";
}

div.mainmenu.takepos::before {
    content: "\f788";
}

div.mainmenu.companies::before {
    content: "\f1ad";
}

div.mainmenu.commercial::before {
    content: "\f0f2";
}

div.mainmenu.ecm::before {
    content: "\f07c";
}

div.mainmenu.externalsite::before {
    content: "\f360";
}

div.mainmenu.ftp::before {
    content: "\f362";
}

div.mainmenu.hrm::before {
    content: "\f508";
}

div.mainmenu.members::before {
    content: "\f0c0";
}

div.mainmenu.products::before {
    content: "\f1b2";
}

div.mainmenu.mrp::before {
    content: "\f1b3";
}

div.mainmenu.project::before {
    content: "\f0e8";
}

div.mainmenu.ticket::before {
    content: "\f3ff";
}

div.mainmenu.tools::before {
    content: "\f0ad";
}

div.mainmenu.website::before {
    content: "\f542";
}
