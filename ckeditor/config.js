/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

    config.toolbar_ex =
    	[
    	   { name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
    	    { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'BidiLtr', 'BidiRtl' ] },
    	    { name: 'links', items: [ 'Link', 'Unlink' ] },
    	    '/',
    	    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    	    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    	    { name: 'tools', items: [ 'UIColor', 'Maximize', 'ShowBlocks' ] },
    	    { name: 'editing',     groups: [ 'find', 'selection' ], items: [ 'Find', 'Replace', 'SelectAll' ] },
    	    { name: 'insert', items: [  'Table', 'Smiley', 'SpecialChar' ] }
    	];
    config.toolbar="ex";
};
