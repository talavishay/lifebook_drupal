var m = require('./model.js'),
v = {
	model : new m,
	template: require('./template.html'),
	regions:{
		upload		: "#upload",
		download	: "#download",
		"delete"	: "#delete",
		lock		: "#lock",
		preview		: "#preview",
	}
};
module.exports = App.Marionette.ItemView.extend(v);
