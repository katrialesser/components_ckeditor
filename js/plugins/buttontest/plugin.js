/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

( function() {
	CKEDITOR.plugins.add( 'button', {
		requires: 'dialog,fakeobjects',
		// jscs:disable maximumLineLength
		lang: 'af,ar,bg,bn,bs,ca,cs,cy,da,de,de-ch,el,en,en-au,en-ca,en-gb,eo,es,et,eu,fa,fi,fo,fr,fr-ca,gl,gu,he,hi,hr,hu,id,is,it,ja,ka,km,ko,ku,lt,lv,mk,mn,ms,nb,nl,no,pl,pt,pt-br,ro,ru,si,sk,sl,sq,sr,sr-latn,sv,th,tr,tt,ug,uk,vi,zh,zh-cn', // %REMOVE_LINE_CORE%
		// jscs:enable maximumLineLength
		icons: 'button', // %REMOVE_LINE_CORE%
		hidpi: true, // %REMOVE_LINE_CORE%
		onLoad: function() {
			CKEDITOR.addCss( 'img.cke_button' +
				'{' +
					'background-image: url(' + CKEDITOR.getUrl( this.path + 'images/placeholder.png' ) + ');' +
					'background-position: center center;' +
					'background-repeat: no-repeat;' +
					'border: 1px solid #a9a9a9;' +
					'width: 80px;' +
					'height: 80px;' +
				'}'
				);
		},
		init: function( editor ) {
			var pluginName = 'button',
				lang = editor.lang.button,
				allowed = 'button[label,target,url]';

			if ( editor.plugins.dialogadvtab )
				allowed += ';button' + editor.plugins.dialogadvtab.allowedContent( { id: 1, classes: 1, styles: 1 } );

			CKEDITOR.dialog.add( pluginName, this.path + 'dialogs/button.js' );
			editor.addCommand( pluginName, new CKEDITOR.dialogCommand( pluginName, {
				allowedContent: allowed,
				requiredContent: 'button'
			} ) );

			editor.ui.addButton && editor.ui.addButton( 'button', {
				label: lang.toolbar,
				command: pluginName,
				toolbar: 'insert,80'
			} );

			// editor.on( 'doubleclick', function( evt ) {
			// 	var element = evt.data.element;
			// 	if ( element.is( 'img' ) && element.data( 'cke-real-element-type' ) == 'button' )
			// 		evt.data.dialog = 'button';
			// } );
            //
			// if ( editor.addMenuItems ) {
			// 	editor.addMenuItems( {
			// 		button: {
			// 			label: lang.title,
			// 			command: 'button',
			// 			group: 'image'
			// 		}
			// 	} );
			// }

			// If the "contextmenu" plugin is loaded, register the listeners.
			if ( editor.contextMenu ) {
				editor.contextMenu.addListener( function( element ) {
					if ( element && element.is( 'img' ) && element.data( 'cke-real-element-type' ) == 'button' )
						return { button: CKEDITOR.TRISTATE_OFF };
				} );
			}
		},
		afterInit: function( editor ) {
			var dataProcessor = editor.dataProcessor,
				dataFilter = dataProcessor && dataProcessor.dataFilter;

			if ( dataFilter ) {
				//Diseable image that replace button on the content manage
				/*
				dataFilter.addRules( {
					elements: {
						button: function( element ) {
							return editor.createFakeParserElement( element, 'cke_button', 'button', true );
						}
					}
				} );
				*/
			}
		}
	} );
} )();
