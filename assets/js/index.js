var page = ( function( document, $ ) {

	var app = {

		/**
		 * is_ready() method - Executes the method received when the document is ready.
		 *
		 * @since {VERSION}
		 *
		 * @param {function} callback Function to be executed when the document is ready.
		 */
		is_ready: function( callback ) {
			$(document).ready( function() { 
				callback();
			});
		},

		/**
		 * setEvents() method - Set events to be executed
		 *
		 * @since {VERSION}
		 */
		 setEvents: function() {
			// your code
		}

	};
	
	return app;

})( document, jQuery );

page.is_ready( page.setEvents );
