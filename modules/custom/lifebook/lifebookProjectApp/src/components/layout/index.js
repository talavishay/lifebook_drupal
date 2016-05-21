var layout = {
    el : '.lifebookProjectApp',
    template:  false,
    regions: {
        state		:	'#state',
        importer	:	'#importer',
        backgrid	:	'#backgrid',
        paginator	:	'#paginator',
        dialogs		:	'#dialogs'
    },
	events : {
		"click #chaptersMaxPage" : "chaptersMaxPage"
	},
	chaptersMaxPage : function() {
		var v = App.projectChannel.request("getGridView", App.project.classes);
		App.projectChannel.trigger("dialog:backgrid" , v);
		
	},
    initialize: function() {
		
        this.listenTo(App.projectChannel,{
			'set:state' 		: (view)=> {this.state.show(new view)},
			'set:importer' 		: (view)=> {this.importer.show(new view)},
			'set:backgrid' 		: (view)=> {
				if(typeof view === "function"){
					this.backgrid.show(new view);
				} else {
					this.backgrid.show(view);
				}
			},
			'set:backgrid:paginator' 		: (view)=> {
				if(typeof view === "function"){
					this.paginator.show(new view);
				} else {
					this.paginator.show(view);
				}
			},
			'set:dialogs'		: (view)=> {this.dialogs.show(new view)}
		}, this);
    },
    onBeforeDestroy: function() {
        Radio.reset('layout');
    }
};
module.exports = App.Marionette.LayoutView.extend(layout);
