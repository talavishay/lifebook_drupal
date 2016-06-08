var app = {
	onStart : function(){
		jQuery.get('/rest/session/token').done(function f(csrfToken){
			App.csrfToken = 	csrfToken;
		});
		var layout = require('./components/layout');
		this.layout = new layout;//~ view.el : "body" ..
		this.layout.render();
		
		this._setupLayoutRegions();
		
	},
	_setupLayoutRegions		: function(options){
		App.layoutChannel.trigger('dialog:imageBrowser')				
		
	},
	_initProject : function( ){
		//~ App.project = require('./components/project');
		//~ App.project.initialize(drupalSettings.lifebookProjectApp);
	},
};
module.exports = App.Marionette.Application.extend(app)

