<?php
if (! defined('ISLOADEDBYSTEELSHEET')) die('Must be call by steelsheet'); ?>
/* <style type="text/css" > */

.mega-menu {
    visibility: hidden;
    border-radius: 8px;
    opacity: 0;
    transition: visibility 0s, opacity 0.2s linear;
    position: absolute;
    top: 0;
    width: 200px;
    height: calc(-48px + 100vh);
    margin-left: 45px;
    background: <?php print $bgnavleft; ?>;
    border: 1px solid rgba(20, 26, 31, 0.08);
    box-shadow: rgba(20, 26, 31, 0.1) 0px 0px 0.1875rem, rgba(20, 26, 31, 0.15) 0px 0.25rem 1.25rem;
}

.mega-menu-container {
	margin-left: -7px;
	width: 200px;
}

.mega-menu .mega-menu-container {
    display: flex;
    padding-top: 5px;
    padding-left: 5px;
}

.mega-menu .item {
	flex-grow: 1;
    margin: 0 10px;
}
.mega-menu .item img {
    width: 100%;
}

.mega-menu .mega-menu_title {
    color: <?php print $bgnavleft_txt; ?>;
    font-weight: bold;
    font-size: 1.2em;
    margin-top: 5px;
    margin-bottom: 10px;
    display: block;
}

/* Mega menu level 1 */
.mega-menu .mega-menu_link {
    color: <?php print $bgnavleft_txt; ?>;
    line-height: 1.2em;
    font-weight: bold !important;
}

.mega-menu a.mega-menu_link {
    color: <?php print $bgnavleft_txt_active; ?>;
  	display: block;
  	padding-top: 5px;
}

.mega-menu a.mega-menu_link:hover {
	color: <?php print $bgnavleft_txt_hover; ?> !important;
    text-decoration: none;
}

.mega-menu_link_create {
    display: block;
    position: absolute;
    right: 10px;
    margin-top: -14px;
}

.mega-menu a.mega-menu_link_create:hover {
    color: <?php print $bgnavleft_txt_hover; ?> !important;
}

/* Mega menu level 2 */
.mega-menu .mega-menu_link_level2 {
    color: <?php print $bgnavleft_txt; ?>;
    line-height: 1.1em;
    font-size: 0.92em;
    font-weight: unset !important;
    padding: 3px 0px 0px 10px;
}
.mega-menu a.mega-menu_link_level2 {
    color: <?php print $bgnavleft_txt_active; ?>;
    display: block;
    font-weight: unset !important;
}

.mega-menu a.mega-menu_link_level2:hover {
    color: <?php print $bgnavleft_txt_hover; ?> !important;
    text-decoration: none;
    font-weight: unset !important;
}

/* Mega menu level 3 */
.mega-menu .mega-menu_link_level3 {
    color: <?php print $bgnavleft_txt; ?>;
    line-height: 1.1em;
    font-size: 0.92em;
    font-weight: unset !important;
    padding: 3px 0px 0px 20px;
}
.mega-menu a.mega-menu_link_level3 {
    color: <?php print $bgnavleft_txt_active; ?>;
    font-weight: unset !important;
    display: block;
}
.mega-menu a.mega-menu_link_level3:hover {
    color: <?php print $bgnavleft_txt_hover; ?> !important;
    font-weight: unset !important;
    text-decoration: none;
}

.mega-menu-dropdown { position: static; }

.mega-menu-dropdown:hover .mega-menu {
    visibility: visible;
    opacity: 1;
}
