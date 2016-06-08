var v = {
	className	: "imageBrowser",
	template	: require('./template.html'),
	regions		: {
			"placeholder" : ".image",
			"action" : ".action"
	},
	initialize: function(url) {
		this.url = url;
	},
	onShow: function(url) {
		url = this.url ? this.url : url ;
		var _v = require('./image/view.js'),
			_m = require('./image/model.js'),
			image = new _v({
				model : new _m({url : url})
			});
		
		image.url = url;
		this.placeholder.show(image);
		
		var action = require('./action/view.js');
		this.action.show(new action);
    },
};
module.exports = App.Marionette.LayoutView.extend(v);
