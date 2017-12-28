
/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#108199';

  config.toolbar = 'Full';
  config.contentsCss = ['../../../css/kc-metalwork/style.css'];
  config.fontSize_sizes = '12/12px;13/13px;16/16px;15/15px;18/18px;20/20px;22/22px;24/24px;36/36px;48/48px;';
  config.font_names = 'Arial;Arial Black;Comic Sans MS;Courier New;Tahoma;Times New Roman;Verdana;新細明體;細明體;標楷體;微軟正黑體';
  config.toolbar_Full =
  [
    ['Source','Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
    '/',
    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['Link','Unlink','Anchor'],
    ['Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
    '/',
    ['Styles','Format','Font','FontSize'],
    ['TextColor','BGColor'],
    ['Maximize', 'ShowBlocks','-','About']
  ];

  config.toolbar_Basic =
  [
    ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','About']
  ];

config.filebrowserBrowseUrl = '/js/admin/ckfinder/ckfinder.html';
config.filebrowserImageBrowseUrl = '/js/admin/ckfinder/ckfinder.html?Type=Images';
config.filebrowserFlashBrowseUrl = '/js/admin/ckfinder/ckfinder.html?Type=Flash';
config.filebrowserImageUploadUrl = '/js/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';//可上傳圖檔

// config.filebrowserUploadUrl = 'http://ccckaass.tk/lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'; //可上傳一般檔案
// config.filebrowserFlashUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';//可上傳Flash檔案

};