window.App = {
	papaparse			: require('papaparse'),
	Marionette			: require('backbone.marionette'),
	Backbone			: window.Backbone,
	Radio 				: require('backbone.radio'),
	backgrid 			: require('backgrid'),
	PageableCollection	: require('backbone.paginator'),
	paginator			: require('backgrid-paginator'),
};
_.extend(App, {
	projectChannel	: App.Radio.channel('pageObjectsChannel'),
	models : {
		//~ user				: require('./models/project.js'),
		project				: require('./models/project.js'),
		pageObjectStudent	: require('./models/pageObjectStudent.js'),
		class				: require('./models/class.js'),
	},
	collections : {
		pageObjects	: require('./collections/pageObjects.js'),
		classes		: require('./collections/classes.js'),
	},
	
});
var _app = require('./app.js'),
	app = new _app;

app.start();

