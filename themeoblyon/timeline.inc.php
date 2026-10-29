<?php
/*!
    Source :
 *   AdminLTE v2.4.8
 *   Author: Almsaeed Studio
 *	 Website: Almsaeed Studio <https://adminlte.io>
 *   License: Open source - MIT
 *           Please visit http://opensource.org/licenses/MIT for more information
 */

if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */
/* ================================================================================================
   oblyon/themeoblyon/timeline.inc.php
   Role      : Fil de discussion des tickets (base AdminLTE) : jetons OBLYON_COLOR_TIMELINE_*
   Inclus par : global.inc.php | Garde : ISLOADEDBYSTEELSHEET | Variables PHP : portee de style.css.php / theme_vars.inc.php
   Regle     : une regle, un endroit (pas de copie d'un selecteur present dans un autre fichier ; verifier avec dev/csscompare.php)
   ================================================================================================ */



/*
* Component: Timeline
* -------------------
*/
.timeline {
    position: relative;
    margin: 0 0 30px 0;
    padding: 0;
}
.timeline:before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    width: 4px;
    background: var(--oblyon-border-strong);	/* InfraS change 3.7.0 : jeton */
    left: 31px;
    margin: 0;
    border-radius: 2px;
}
.timeline > li {
    position: relative;
    margin-right: 0;
    margin-bottom: 15px;
    list-style: none;
}
.timeline > li:before,
.timeline > li:after {
    content: " ";
    display: table;
}
.timeline > li:after {
    clear: both;
}
.timeline > li > .timeline-item {
    -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    box-shadow:  0 1px 3px rgba(0, 0, 0, 0.1);
    border:1px solid var(--oblyon-border);	/* InfraS change 3.7.0 : jeton */
    border-radius: 3px;
    margin-top: 0;
    background: var(--colorTimelineBg);	/* InfraS change 3.7.0 : jeton */
    color: var(--colortext);	/* InfraS change 3.7.0 : jeton */
    margin-left: 60px;
    margin-right: 0px;
    padding: 0;
    position: relative;
}

.timeline > li.timeline-code-ticket_msg_private  > .timeline-item {
		background: var(--colorTimelinePrivateBg);	/* InfraS change 3.7.0 : jeton */
        border-color: var(--oblyon-border-strong);	/* InfraS change 3.7.0 : jeton */
}


.timeline > li > .timeline-item > .time{
    color: var(--oblyon-muted-text);	/* InfraS change 3.7.0 : jeton */
    float: right;
    padding: 10px;
    font-size: 12px;
}


.timeline > li > .timeline-item > .timeline-header-action{
    color: var(--oblyon-muted-text);	/* InfraS change 3.7.0 : jeton */
    float: right;
    padding: 7px;
    font-size: 12px;
}


a.timeline-btn:link,
a.timeline-btn:visited,
a.timeline-btn:hover,
a.timeline-btn:active
{
    display: inline-block;
    margin-bottom: 0;
    font-weight: 400;
    border-radius: 0;
    box-shadow: none;
    padding: 1px 5px;
    font-size: 12px;
    line-height: 1.5;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    touch-action: manipulation;
    cursor: pointer;
    user-select: none;
    background-image: none;
    text-decoration: none;
    background-color: var(--oblyon-neutral-bg);	/* InfraS change 3.7.0 : jeton */
    color: var(--colortext);	/* InfraS change 3.7.0 : jeton */
    border: 1px solid var(--oblyon-border);	/* InfraS change 3.7.0 : jeton */
}

a.timeline-btn:hover
{
    background-color: var(--colorbline_hover);	/* InfraS change 3.7.0 : jeton */
    color: var(--colortext);	/* InfraS change 3.7.0 : jeton */
    border-color: var(--oblyon-border-strong);	/* InfraS change 3.7.0 : jeton */
}


.timeline > li > .timeline-item > .timeline-header {
    margin: 0;
    color: var(--colortext);	/* InfraS change 3.7.0 : jeton */
    border-bottom: 1px solid var(--oblyon-border);	/* InfraS change 3.7.0 : jeton */
    padding: 10px;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.1;
}
.timeline > li.timeline-code-ticket_msg_private  > .timeline-item > .timeline-header {
    border-color: var(--oblyon-border-strong);	/* InfraS change 3.7.0 : jeton */
}

.timeline > li > .timeline-item > .timeline-header > a {
    font-weight: 600;
}
.timeline > li > .timeline-item > .timeline-body,
.timeline > li > .timeline-item > .timeline-footer {
    padding: 10px;
}
.timeline > li > .fa,
.timeline > li > .glyphicon,
.timeline > li > .ion {
    width: 30px;
    height: 30px;
    font-size: 15px;
    line-height: 30px;
    position: absolute;
    color: var(--oblyon-muted-text);	/* InfraS change 3.7.0 : jeton */
    background: var(--oblyon-neutral-bg);	/* InfraS change 3.7.0 : jeton */
    border-radius: 50%;
    text-align: center;
    left: 18px;
    top: 0;
}
.timeline > .time-label > span {
    font-weight: 600;
    padding: 5px;
    display: inline-block;
    background-color: var(--colorTimelineBg);	/* InfraS change 3.7.0 : jeton */
    border-radius: 4px;
}
.timeline-inverse > li > .timeline-item {
    background: var(--oblyon-neutral-bg);	/* InfraS change 3.7.0 : jeton */
    border: 1px solid var(--oblyon-border);	/* InfraS change 3.7.0 : jeton */
    -webkit-box-shadow: none;
    box-shadow: none;
}
.timeline-inverse > li > .timeline-item > .timeline-header {
    border-bottom-color: var(--oblyon-border);	/* InfraS change 3.7.0 : jeton */
}

.timeline-icon-todo,
.timeline-icon-in-progress,
.timeline-icon-done{
    color: #fff !important;
}

.timeline-icon-not-applicble{
    color: #000;
    background-color: #f7f7f7;
}

.timeline-icon-todo{
    background-color: var(--colorstatusdanger) !important;
}

.timeline-icon-in-progress{
    background-color: var(--colorstatusinfo) !important;
}
.timeline-icon-done{
    background-color: var(--colorstatussuccess) !important;
}


.timeline-badge-date{
    background-color: var(--colortimelineitem) !important;
    color: #fff !important;
}
