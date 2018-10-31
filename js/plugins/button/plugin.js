CKEDITOR.plugins.add( 'button', {
    icons: 'button',
    init: function( editor ) {
        //Plugin logic goes here.

        editor.addCommand( 'addButton', {
            exec: function( editor ) {
                var now = new Date();
                editor.insertHtml( 'The current date and time is: <em>' + now.toString() + '</em>' );
            }
        });

        editor.ui.addButton( 'Button', {
            label: 'ILWSButton',
            command: 'addButton',
            toolbar: 'insert, 0'
        });
    }
});
