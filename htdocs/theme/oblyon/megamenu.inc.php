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
    background: #fff;
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
    color: black;
    font-weight: bold;
    font-size: larger;
    margin-bottom: 10px;
    display: block;
}

    li.tmenusel a {
        color: unset !important;
    }

.mega-menu .mega-menu_link {
    color: black;
    line-height: 1.2em;
}

.mega-menu a.mega-menu_link {
	color: #000000 !important;
  	display: block;
  	padding: 5px;
}

.mega-menu-dropdown {position: static;}

.mega-menu-dropdown:hover .mega-menu {
    visibility: visible;
    opacity: 1;
}
