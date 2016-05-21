var app = {
	onStart : function(){
		jQuery.get('/rest/session/token').done(function f(csrfToken){
			App.csrfToken = 	csrfToken;
		});
		var layout = require('./components/layout');
		this.layout = new layout;//~ view.el : "body" ..
		this.layout.render();
		this._setupLayoutRegions();
		
		this.projectId = parseInt(drupalSettings.lifebookProjectApp.id);
		
		if(_.isNumber( this.projectId)){
			this._initProject();
		};
		
		
		require('./components/chapters');
	},
	_setupLayoutRegions		: function(options){
		App.projectChannel.trigger('set:importer', require('./components/importer'));
		App.projectChannel.trigger('set:backgrid', require('./components/backgrid'));
		App.projectChannel.trigger('set:dialogs', require('./components/dialogs'));
	},
	_initProject : function( ){
		App.project = require('./components/project');
		App.project.initialize(drupalSettings.lifebookProjectApp);
	},
};
module.exports = App.Marionette.Application.extend(app)

