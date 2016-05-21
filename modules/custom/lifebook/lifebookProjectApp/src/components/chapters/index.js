App.projectChannel.reply({
	"getGridView" : function(col){
		var columns = [{
			  name: "id", // The key of the model attribute
			  label: "ID", // The name to display in the header
			  editable: false, 
			  cell: App.backgrid.IntegerCell.extend({
				orderSeparator: ''
			  })
			},{
			  name	: "name",
			  label	: "Name",
			  cell	: "string" 
			},{
			  name	: "field_max_pages",
			  label	: "max pages",
			  cell	: "string" 
			}];
		//init autosave behaviour
		col.each(function(model){
			model.on("change", function (model, options) {
				if ((options && options.save === false) ) return;
				  model.save();
			});
		});
		return new App.backgrid.Grid({
			columns : columns,
			collection : col
		});
	}
});

