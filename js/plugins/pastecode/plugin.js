/**
 * @license Licensed under the terms of any of the following licenses at your choice:
 * 
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *    (See Appendix A)
 * 
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *    (See Appendix B)
 * 
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *    (See Appendix C)
 * 
 */

/**
 * @fileOverview Paste as code plugin.
 */

(function() {
	// The pastecode command definition.
	var pasteCodeCmd = {
		// Snapshots are done manually by editable.insertXXX methods.
		canUndo: false,
		async: true,

		exec: function( editor ) {
			editor.getClipboardData({ title: editor.lang.pastecode.title }, function( data ) {
				// Do not use editor#paste, because it would start from beforePaste event.
				//data && editor.fire( 'paste', { type: 'html', dataValue: data.dataValue } );
				editor.insertHtml( data.dataValue );

				editor.fire( 'afterCommandExec', {
					name: 'pastecode',
					command: pasteCodeCmd,
					returnValue: !!data
				});
			});
		}
	};
	// Register the plugin.
	CKEDITOR.plugins.add( 'pastecode', {
		requires: 'clipboard',
		lang: 'fr,en', // %REMOVE_LINE_CORE%
		icons: 'pastecode', // %REMOVE_LINE_CORE%
		onLoad : function() {
			CKEDITOR.addCss('.pasted-code{background:#ccc;border: 1px solid #666;height:400px;max-width:100%;min-height:30px;position:relative;width:auto;}.pasted-code:before{background: white;border: 1px solid #666;content: "Pasted Code";height: 18px;left: 50%;margin-left: -50px;margin-top: -9px;opacity: 0.5;padding: 2px;position: absolute;text-align: center;top: 50%;width: 100px;}.mask-pasted{height:100%;position:absolute;width:100%;z-index:2;}');
		}, 
		init: function( editor ) {
			var commandName = 'pastecode';

			editor.addCommand( commandName, new CKEDITOR.dialogCommand( 'pastecode', {
				//allowedContent : required,
				//requiredContent : required
			} ) );

			editor.ui.addButton && editor.ui.addButton( 'PasteCode', {
				label: editor.lang.pastecode.button,
				command: commandName,
				toolbar: 'clipboard,40'
			});

			CKEDITOR.dialog.add( 'pastecode', function( editor )
			{
				var commonLang = editor.lang.common;
				return {
					title : editor.lang.pastecode.title,
					minWidth : 350,
					minHeight : 200,
					contents : [
						{
							id : 'general',
							label : editor.lang.pastecode.code,
							elements : [
								{
									type : 'textarea',
									id : 'contents',
									label : editor.lang.pastecode.code,
									//cols: 140,
									rows: 10,
									validate : CKEDITOR.dialog.validate.notEmpty( editor.lang.pastecode.notEmpty ),
									required : true
								},
								{
									type : 'hbox',
									widths : [ '50%', '50%' ],
									children :
									[
										{
											type : 'text',
											id : 'txtWidth',
											width : '60px',
											label : 'Width',
											'default' : '640',
											validate: function () {
												if (!this.getValue()) {
													alert('Width is required.');
													return false;
												}
												else if (parseInt(this.getValue()) < 100){
													alert('Minimum width is 100.');
													return false;
												}
											}
										},
										{
											type : 'text',
											id : 'txtHeight',
											width : '60px',
											label : 'Height',
											'default' : '360',
											validate: function () {
												if (!this.getValue()) {
													alert('Height is required.');
													return false;
												}
												else if (parseInt(this.getValue()) < 30){
													alert('Minimum Height is 30.');
													return false;
												}
											}
										}
									]
								}
							]
						}
					],
					onOk : function() {
						
						var data = this.getValueOf('general', 'contents');

						var width = this.getValueOf('general', 'txtWidth');
						var height = this.getValueOf('general', 'txtHeight');

						var styles = 'width:' + width + 'px; height:' + height + 'px';
						var content = '<div class="pasted-code" style="' + styles + '""><div class="mask-pasted" data-pasted="pastecode"></div>' + data + '</div>';
						var element = CKEDITOR.dom.element.createFromHtml(content);
						var instance = this.getParentEditor();
						instance.insertElement(element);

						var regex = /<script.*?<\/script>/g;
						while ((result = regex.exec(data)) !== null) {
							var src = /src\s*=\s*"(.+?)"/g.exec(result);
							CKEDITOR.scriptLoader.load(src[1]);
						}
					}
				};
			} );

			editor.on( 'paste', function( evt ) {
				// Do NOT overwrite if HTML format is explicitly requested.
				// This allows pastefromword dominates over pastecode.
				/*
				if ( evt.data.type != 'html' )
					evt.data.type = 'text';
				*/
			});

			editor.on( 'pasteState', function( evt ) {
				editor.getCommand( commandName ).setState( evt.data );
			});

		}
	});
})();
