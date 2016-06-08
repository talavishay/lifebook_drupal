var m = require('./model.js'),
v = {
	model : new m,
	tagName : "img",
	template: false,
	//~ model : require('./model'),
	
	modelEvents : {
		"change" : "_render"
	},
	_render: function() {
		this.render();
	},
	onShow: function(url) {
		url = this.url ? this.url : url ;
		this.model.set("url", url);
		
    },
    initialize: function(url) {
		this.model = new m(url);
	},
};
module.exports = App.Marionette.ItemView.extend(v);
