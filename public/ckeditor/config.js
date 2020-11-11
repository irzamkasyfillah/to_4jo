/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl= 'http://127.0.0.1:8000/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl= 'http://127.0.0.1:8000/ckfinder/ckfinder.html?Type=Images';
    config.filebrowserUploadUrl= 'http://127.0.0.1:8000/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl= 'http://127.0.0.1:8000/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserWindowWidth = '1000';
	config.filebrowserWindowHeight = '700';
};
