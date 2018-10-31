/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

( function() {
	// Map 'true' and 'false' values to match W3C's specifications
	// http://www.w3.org/TR/REC-html40/present/frames.html#h-16.5
	var checkboxValues = {
		target: { 'true': 'yes', 'false': 'no' },
		frameborder: { 'true': '1', 'false': '0' }
	};

	function loadValue( buttonNode ) {
		var isCheckbox = this instanceof CKEDITOR.ui.dialog.checkbox;
		if ( buttonNode.hasAttribute( this.id ) ) {
			var value = buttonNode.getAttribute( this.id );
			if ( isCheckbox )
				this.setValue( checkboxValues[ this.id ][ 'true' ] == value.toLowerCase() );
			else
				this.setValue( value );
		}
	}

	function commitValue( buttonNode ) {
		var isRemove = this.getValue() === '',
			isCheckbox = this instanceof CKEDITOR.ui.dialog.checkbox,
			value = this.getValue();
		if ( isRemove )
			buttonNode.removeAttribute( this.att || this.id );
		else if ( isCheckbox )
			buttonNode.setAttribute( this.id, checkboxValues[ this.id ][ value ] );
		else
			buttonNode.setAttribute( this.att || this.id, value );
	}

	CKEDITOR.dialog.add( 'button', function( editor ) {
		return {
			title:          'Test Button Dialog',
			resizable:      CKEDITOR.DIALOG_RESIZE_BOTH,
			minWidth:       500,
			minHeight:      400,
			contents: [
				{
					id:         'buttoninfo',
					label:      'Button Info',
					title:      'Button Info',
					accessKey:  'Q',
					elements: [
						{
							id:             'label',
							label:          'Button Text',
							type:           'text'
						},
						{
							id:             'url',
							label:          'Link (url)',
							type:           'text'
						},
						{
							id: 'class',
							label:  'Button Style Class',
							type: 'select',
							items: [ [ 'ilws-white' ], [ 'ilws-gray' ], [ 'ilws-brightGreen' ], [ 'ilws-ill' ],[ 'ilws-ies' ], [ 'ilws-ima' ], [ 'ilws-imf' ],[ 'ilws-illColor' ], [ 'ilws-iesColor' ], [ 'ilws-imaColor' ],[ 'ilws-imfColor' ], [ 'ilws-whiteBorder' ], ],
   							 'default': 'liws-white',
						},
						{
							id:             'target',
							label:          'Open Link in New Tab',
							type:           'checkbox'
						},
					]
				}
			]
		};
	} );


} )();
