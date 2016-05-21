'use strict';
var dialogs = {
	//~ chapters 	: require("../chapters"),
};
module.exports =  App.Marionette.LayoutView.extend({
	tagName	: 'span',
	className : 'dialogs',
	template: require('./template.html'),
	regions	:	{
			"nav" : "#nav",
			"toolContent" : "#toolContent",
	},
	events  : {
		"click .closeDialog" : () => {
			App.projectChannel.trigger("dialog:close");
		}
	},
	childEvents: {
		render: "_show",
	},
	_show : function(){
		this.$el.show();
	},
	_hide : function(){
		this.$el.hide();
	},
	onShow 	:	function(){
		this.$el.hide();
	},
	initialize 	:	function(options){

		this.listenTo(App.projectChannel, {
			//~ "all"			:(eventname)=>{
				//~ var _split = eventname.split(':'),
					//~ dialog = (_split.length === 2 && _split[0]  === "dialog") ? true : false ,
					//~ dialogName = _split[1];
				//~ if( dialog ) {
					//~ this.$el.find("#title").text(dialogName);
					//~ this.toolContent.show(new dialogs[dialogName] );
				//~ }
			//~ },
			"dialog:show"		:()=>{
				this._show()},
			"dialog:close"		:()=>{
				this._hide()},
			"dialog:backgrid"	:(view)=>{
				this.toolContent.show( view );
				this._show();
			},
			
			
		}, this );
	},
});
