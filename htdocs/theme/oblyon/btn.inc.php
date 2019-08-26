<?php
if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */

/* ============================================================================== */
/* Boutons actions                                                                */
/* ============================================================================== */
div.divButAction {
    margin-bottom: 1.4em;
    vertical-align: top;
}
div.tabsAction > a.butAction, div.tabsAction > a.butActionRefused {
    margin-bottom: 1.4em !important;
}

span.butAction, span.butActionDelete {
    cursor: pointer;
}


.button, .butAction, .butActionDelete, .butActionRefused, .butActionNewRefused {
    border-color: rgba(0, 0, 0, 0.15) rgba(0, 0, 0, 0.15) rgba(0, 0, 0, 0.25);
    display: inline-block;
    padding: 0.4em <?php echo ($dol_optimize_smallscreen?'0.4':'0.7'); ?>em;
    margin: 0em <?php echo ($dol_optimize_smallscreen?'0.7':'0.9'); ?>em;
    line-height: 20px;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    color: #333333 !important;
    text-decoration: none !important;
    text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
    background-color: #f5f5f5;
    background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
    background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
    background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
    background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
    background-repeat: repeat-x;
    border-color: #e6e6e6 #e6e6e6 #bfbfbf;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
    border: 1px solid #bbbbbb;
    border-bottom-color: #a2a2a2;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.butActionNew, .butActionNewRefused, .butActionNew:link, .butActionNew:visited, .butActionNew:hover, .butActionNew:active {
    text-decoration: none;
    /* border-color: rgba(0, 0, 0, 0.15) rgba(0, 0, 0, 0.15) rgba(0, 0, 0, 0.25); */
    display: inline-block;
    padding: 0.2em <?php echo ($dol_optimize_smallscreen?'0.4':'0.7'); ?>em;
    margin: 0em <?php echo ($dol_optimize_smallscreen?'0.7':'0.9'); ?>em;
    line-height: 20px;
    /* text-align: center;  New button are on right of screen */
    vertical-align: middle;
    cursor: pointer;
    /* color: #ffffff !important; */
    /* text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); */
    -webkit-border-radius: 2px;
    border-radius: 2px;
    /* -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); */
    /* background-color: #006dcc;
    background-image: -moz-linear-gradient(top, #0088cc, #0044cc);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0044cc));
    background-image: -webkit-linear-gradient(top, #0088cc, #0044cc);
    background-image: -o-linear-gradient(top, #0088cc, #0044cc);
    background-image: linear-gradient(to bottom, #0088cc, #0044cc);
    background-repeat: repeat-x; */
}
a.butActionNew>span.fa-plus-circle { padding-left: 6px; font-size: 1.5em; }
a.butActionNewRefused>span.fa-plus-circle { padding-left: 6px; font-size: 1.5em; }

.button, .butAction {
    color: #ffffff !important;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    background-color: <?php print $colorButtonAction1; ?>;
    background-image: -moz-linear-gradient(top, <?php print $colorButtonAction1; ?>, <?php print $colorButtonAction2; ?>);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(<?php print $colorButtonAction1; ?>), to(<?php print $colorButtonAction2; ?>));
    background-image: -webkit-linear-gradient(top, <?php print $colorButtonAction1; ?>, <?php print $colorButtonAction2; ?>);
    background-image: -o-linear-gradient(top, <?php print $colorButtonAction1; ?>, <?php print $colorButtonAction2; ?>);
    background-image: linear-gradient(to bottom, <?php print $colorButtonAction1; ?>, <?php print $colorButtonAction2; ?>);
    background-repeat: repeat-x;
    border-color: <?php print $colorButtonAction2; ?> <?php print $colorButtonAction2; ?> <?php print $colorButtonAction1; ?>;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
}
.button:disabled, .butAction:disabled {
    color: #666 !important;
    text-shadow: none;
    border-color: #555;
    cursor: not-allowed;

    background-color: #f5f5f5;
    background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
    background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
    background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
    background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
    background-repeat: repeat-x
}

button.ui-button {
    padding-top: 5px;
}

.butActionDelete, .buttonDelete {
    color: #ffffff !important;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    background-color: <?php print $colorButtonDelete1; ?>;
    background-image: -moz-linear-gradient(top, <?php print $colorButtonDelete1; ?>, <?php print $colorButtonDelete2; ?>);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(<?php print $colorButtonDelete1; ?>), to(<?php print $colorButtonDelete2; ?>));
    background-image: -webkit-linear-gradient(top, <?php print $colorButtonDelete1; ?>, <?php print $colorButtonDelete2; ?>);
    background-image: -o-linear-gradient(top, <?php print $colorButtonDelete1; ?>, <?php print $colorButtonDelete2; ?>);
    background-image: linear-gradient(to bottom, <?php print $colorButtonDelete1; ?>, <?php print $colorButtonDelete2; ?>);
    background-repeat: repeat-x;
    border-color: <?php print $colorButtonDelete2; ?> <?php print $colorButtonDelete2; ?> <?php print $colorButtonDelete1; ?>;
    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
}
a.butAction:link, a.butAction:visited, a.butAction:hover, a.butAction:active {
    color: #FFFFFF;
}

.butActionRefused, .butActionNewRefused {
    color: #AAAAAA !important;
    cursor: not-allowed !important;
}

a.butAction:hover, a.butActionDelete:hover, a.butActionRefused:hover {
    text-decoration: none;
}
a.butActionNewRefused:hover {
    border-color: unset !important;
    border: 1px solid #bbbbbb;
}
a.butAction:hover, a.butActionNew:hover, a.butActionDelete:hover {
    opacity: 0.9;
}

.butActionTransparent {
    color: #222 ! important;
    background-color: transparent ! important;
}

<?php if (! empty($conf->global->MAIN_BUTTON_HIDE_UNAUTHORIZED)) { ?>
.butActionRefused, .butActionNewRefused {
    display: none;
}
<?php } ?>


/*
TITLE BUTTON
 */

.btnTitle, a.btnTitle {
    display: inline-block;
    padding: 6px 12px;
    font-size: 14px
    font-weight: 400;
    line-height: 1.4;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    box-shadow: none;
    text-decoration: none;
    position: relative;
    margin: 0 0 0 10px;
    min-width: 80px;
    text-align: center;
    color: rgb(<?php print $colortextlink; ?>);
    border: none;
    font-size: 12px;
    font-weight: 300;
    background-color: #fbfbfb;
}

.btnTitle > .btnTitle-icon{

}

.btnTitle > .btnTitle-label{
    color: #666666;
}

.btnTitle:hover, a.btnTitle:hover {
    border-radius: 3px;
    position: relative;
    margin: 0 0 0 10px;
    text-align: center;
    color: #ffffff;
    background-color: rgb(<?php print $colortextlink; ?>);
    font-size: 12px;
    text-decoration: none;
    box-shadow: none;
}

.btnTitle.refused, a.btnTitle.refused, .btnTitle.refused:hover, a.btnTitle.refused:hover {
        color: #8a8a8a;
        cursor: not-allowed;
        background-color: #fbfbfb;
        background: repeating-linear-gradient( 45deg, #ffffff, #f1f1f1 4px, #f1f1f1 4px, #f1f1f1 4px );
}

.btnTitle:hover .btnTitle-label{
    color: #ffffff;
}

.btnTitle.refused .btnTitle-label, .btnTitle.refused:hover .btnTitle-label{
    color: #8a8a8a;
}

.btnTitle>.fa {
    font-size: 20px;
    display: block;
}


<?php if (! empty($conf->global->MAIN_BUTTON_HIDE_UNAUTHORIZED) && (! $user->admin)) { ?>
.butActionRefused, .butActionNewRefused, .btnTitle.refused {
    display: none !important;
}
<?php }
