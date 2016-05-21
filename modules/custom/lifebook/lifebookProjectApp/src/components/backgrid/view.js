var backgrid = {
	template	: false,
	classname	: "backgrid",
	initialize	: function(){
		this.listenTo(App.projectChannel,{
			"backgrid" : this._backgrid
		},this);
		
	},
};
module.exports = App.Marionette.ItemView.extend(backgrid);
