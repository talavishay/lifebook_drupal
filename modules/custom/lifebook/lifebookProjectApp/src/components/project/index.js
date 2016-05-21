var project = {
	current					: new App.models.project,
	classes					: new App.collections.classes,
	pageObjectCollection	: new App.collections.pageObjects,
	classifyPageObjectsCollection	: new App.collections.pageObjects,

	error : [],
	initialize : function(project){
		_.extend(this, Backbone.Events);
		App.projectChannel.on({
			"import:done" : this.importDone
		}, this);
		//~ this.listenTo(this.pageObjectCollection,{
			//~ "update" : this.classifyPageObjects
		//~ }, this);
		var stateView =  require('./view.js');
		App.projectChannel.trigger('set:state',  stateView);
		
		this.pageObjectCollection.reset(project.students, {parse:true});
		this.classes.reset(project.classes, {parse:true});
		
		this.current.set("id", project.id);
		this.current.fetch();
		
		//~ this._backgrid();
		
	},
	_backgrid	: function(){
		var columns = [
		//~ {
		  //~ name: "id", // The key of the model attribute
		  //~ label: "ID", // The name to display in the header
		  //~ editable: false, // By default every cell in a column is editable, but *ID* shouldn't be
		  //~ // Defines a cell type, and ID is displayed as an integer without the ',' separating 1000s.
		  //~ cell: App.backgrid.IntegerCell.extend({
			//~ orderSeparator: ''
		  //~ })
		//~ },
		 {
		  name: "name",
		  label: "Name",
		  cell: "string" 
		}, {
		  name: "field_last_name",
		  label: "last name",
		  cell: "string" 
		}, {
		  name: "field_student_text",
		  label: "text",
		  cell: "string" 
		}, {
		  name: "field_passport_number",
		  label: "passport number",
		  cell: "string" 
		}];
		
		var b = new App.backgrid.Grid({
			columns : columns,
			collection : App.project.pageObjectCollection
		});
		this.setAutoSave();
		//~ var paginator = new App.backgrid.Extension.Paginator({
			//~ collection: App.project.pageObjectCollection
		//~ });

		App.projectChannel.trigger('set:backgrid',  b);
		//~ App.projectChannel.trigger('set:backgrid:paginator',  paginator);
		
		
	},
	setAutoSave : function(){
		App.project.pageObjectCollection.each(function(model){
			model.on("change", function (model, options) {
				if ((options && options.save === false) ) return;
				  model.save();
			});
		});
	},
	importDone : function(results){
		_.each(results.errors, function(err, index, list){
			alert("there was an error on line : " + err.row + '\n'
				+ 'error :'+ err.message + '\n'
				+ 'data:' + '\n'
				+ JSON.stringify(results.data[err.row]) + '\n' );
			results.data.pop(err.row);
		});
		_.each(results.data, function(row, index, list){
			existingStudent = App.project.pageObjectCollection
				.where({
					name			: row["שם\nפרטי"], 
					field_last_name	: row["שם\nמשפחה"]
				});
				
			if(!existingStudent.length){
				App.project.pageObjectCollection.add(row,{
					parse:true,
				});
			};
			//TODO: else existingStudent set & parse ?? 
		});
		
		
		App.project.classifyPageObjects()
			.then(this.addNewClasses)
			//~ .then(this.updateProject)
			.then(this.assignPageObjects)
			.then(function(res, err){
				 console.log(res);
				 console.log("done");
			});
	},
	classifyPageObjects : function(){
		return new Promise(function(resolve, reject){
			App.project.pageObjectCollection.each(function(model, key, list){
				if(model.isNew()){
					var _class = model.get("class"),
						existingClass = App.project.classes.findWhere({
							name : _class
						});
						
					if(	!existingClass 	 &&
						_class != "" 	 && 
						typeof _class !== "undefined" ){
							App.project.classes.add({"name" : _class});
					};
				}
			});
			resolve();
		});
	},
	addNewClasses : function(){
		//~ var doit = function(){	resolve();	},
		return new Promise(function(resolve, reject){
			function doit(projectClasses){
				App.project.current
					.save({
						"field_class" : projectClasses
						},{
							success : resolve
						});
				
			};
			var length = App.project.classes.filter(function(val){
					return val.isNew();
				}).length,
				_doit = _.after(length, doit),
				projectClasses = App.project.current.get("field_class"); 
				
			
			App.project.classes.each( function(model, key, list){
				if(model.isNew()){
					model.save({},{
						success : function(model){
							projectClasses.push({
								target_id : model.id,
								target_type : "chapters"
							});
							_doit(projectClasses);
						}
					});
				};
			});
			if(!length) resolve();
		});
	},
	//~ updateProject : function(){
		//~ return new Promise(function(resolve, reject){
			//~ var c = App.project.classes.map(	function(model){
				//~ return {	target_id : model.id,
							//~ target_type : "chapters"	}}
			//~ );
			//~ App.project.current.save({"field_class": c }, {
					//~ success : function(e){	resolve(e);	}
			//~ });
		//~ });
	//~ },
	assignPageObjects : function(){
		return new Promise(function(resolve, reject){
			App.project.pageObjectCollection.each(function(model){
				if(model.isNew()){
					var existingClass = App.project.classes.findWhere({
						name : model.get("class")
					})
					if(!_.isUndefined(existingClass)){
						model.unset("class");
						model.save("field_class", [{
									target_id : existingClass.id,
									target_type : "chapters"	}]);				
					} else {
							App.project.error.push(model);
					};
				};
			});
		});
	}
};
module.exports = project;
