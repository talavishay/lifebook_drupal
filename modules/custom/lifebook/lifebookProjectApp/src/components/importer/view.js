var pageObjectsView = {
	template	: require('./template.html'),
	events		: {
		"change input"	:	"_handleInput",
		
	},
	_handleInput : function(ev){
		App.papaparse.parse(ev.target.files[0], {
			header: true,
			complete: function(results) {
					App.projectChannel.trigger("import:done", results);
			}
		});
	}
	
};
module.exports = App.Marionette.CompositeView.extend(pageObjectsView);
