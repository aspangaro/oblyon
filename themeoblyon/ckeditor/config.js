/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here.
	// http://docs.cksource.com/CKEditor_3.x/Developers_Guide
	// http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html
	config.enterMode = CKEDITOR.ENTER_BR;
	config.resize_enabled = false;
	//config.resize_maxHeight = 3000;
	//config.resize_maxWidth = 3000;
	//config.height = '300px';
	//config.resize_dir = 'vertical';	// horizontal, vertical, both
	config.removePlugins = 'elementspath,save'; // config.removePlugins = 'elementspath,save,font';
	//config.extraPlugins = 'docprops,scayt,showprotected';
	config.removeDialogTabs = 'flash:advanced';	// config.removeDialogTabs = 'flash:advanced;image:Link';
	config.protectedSource.push( /<\?[\s\S]*?\?>/g );   // Prevent PHP Code to be formatted
	//config.menu_groups = 'clipboard,table,anchor,link,image';	// for context menu 'clipboard,form,tablecell,tablecellproperties,tablerow,tablecolumn,table,anchor,link,image,flash,checkbox,radio,textfield,hiddenfield,imagebutton,button,select,textarea' 
	//config.language = 'de';
	//config.defaultLanguage = 'en';
	//config.contentsLanguage = 'fr';
	config.language = 'fr';
	config.defaultLanguage = 'fr';
	config.contentsLanguage = 'fr';
	config.fullPage = false;	// Not a full html page string, just part of it
	config.dialog_backgroundCoverColor = 'rgb(255, 254, 253)';
	//config.contentsCss = '/css/mysitestyles.css';
	config.image_previewText=' ';	// Must no be empty
	//config.autoParagraph = false;
	//config.removeFormatTags = 'b,big,code,del,dfn,em,font,i,ins,kbd';		// See also rules on this.dataProcessor.writer.setRules
	//config.forcePasteAsPlainText = true;
	config.font_names = 'Century Gothic/Century Gothic, Futura PT, sans-serif;' + 'Cambria/Cambria, Times, serif;' + config.font_names;
	config.font_defaultLabel = 'Century Gothic';
	config.scayt_autoStartup = true;
	config.scayt_sLang = 'fr_FR';
	
	config.toolbar_Full =
	[
	    ['Templates','NewPage'],
	    ['Save'],
	    ['Source','Maximize','Preview'],
	    ['PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],		// 'Cut','Copy','Paste','-', are useless, can be done with right click, even on smarpthone
	    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	    ['CreateDiv','ShowBlocks'],
	    ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
	    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
	    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
	    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	    ['BidiLtr', 'BidiRtl'],
	    ['Link','Unlink','Anchor'],
	    ['Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
	    ['Styles','Format','Font','FontSize'],
	    ['TextColor','BGColor']
	];

	// Used for mailing fields
	config.toolbar_dolibarr_mailings = 
	[
	 	['Source','Maximize','Preview'],
	 	['SpellChecker', 'Scayt'],		// 'Cut','Copy','Paste','-', are useless, can be done with right click, even on smarpthone
	 	['Undo','Redo','-','Find','Replace'],
	    ['Format','Font','FontSize'],
	 	['Bold','Italic','Underline','Strike','Subscript','Superscript','-','TextColor','RemoveFormat'],
	 	['NumberedList','BulletedList','Outdent','Indent','CreateDiv'],
	 	['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	 	['Link','Unlink','Anchor','Image','Table','HorizontalRule','SpecialChar']
	 ];
	
	// Used for notes fields
	config.toolbar_dolibarr_notes =
	[
	 	['Source','Maximize'],
	 	['SpellChecker', 'Scayt'],		// 'Cut','Copy','Paste','-', are useless, can be done with right click, even on smarpthone
	 	['Undo','Redo','-','Find','Replace'],
	    ['Format','Font','FontSize'],
	 	['Bold','Italic','Underline','Strike','Subscript','Superscript','-','TextColor','RemoveFormat'],
	 	['NumberedList','BulletedList','Outdent','Indent'],
	 	['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	    ['Link','Unlink','Image','Table','HorizontalRule','SpecialChar']
	];
	
	// Used for details lines
	config.toolbar_dolibarr_details =
	[
	 	['Source','Maximize'],
	 	['SpellChecker', 'Scayt'],		// 'Cut','Copy','Paste','-', are useless, can be done with right click, even on smarpthone
	    ['Format','Font','FontSize'],
	    ['Bold','Italic','Underline','Strike','-','TextColor','RemoveFormat'],		// ,'Subscript','Superscript' useless
	 	['NumberedList','BulletedList','Outdent','Indent'],
	 	['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	    ['Link','Unlink','SpecialChar']
	];
	
	// Used for mailing fields
	config.toolbar_dolibarr_readonly =
	[
	 	['Source','Maximize'],
	 	['Find']
	];	
};
