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
	layoutChannel	: App.Radio.channel('layout'),
	studentChannel	: App.Radio.channel('studentChannel'),
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
	views : {
		imageBrowser : require('./components/imageBrowser'),
		dialogs : require('./components/dialogs'),
	}
	
});
var _app = require('./app.js'),
	app = new _app;

app.start();

