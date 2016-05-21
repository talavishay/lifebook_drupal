var state = require('./state'),
view = {
	model	: new state,
	template: require('./template.html'),
	modelEvents : {
		"change" : "render"
	}
	//~ initialize : function(){
		//~ this.listen
	//~ }
};
module.exports = App.Marionette.ItemView.extend(view);
