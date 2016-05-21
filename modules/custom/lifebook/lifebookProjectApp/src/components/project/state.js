var state = {
	initialize : function(){
		Backbone.Model.prototype.initialize.apply(this, arguments);
		this.listenTo(App.project.pageObjectCollection, {
			"all"	:	this._studentsStates
		}, this);
		this.listenTo(App.project.classes, {
			"all"	:	this._classesStates
		}, this);
	},
	_studentsStates : function(s){
		this.set({
			"students"	: App.project.pageObjectCollection.length,
			"textless"	: App.project.pageObjectCollection.where({"field_student_text" : ""}).length,
			"passportless"	: App.project.pageObjectCollection
								.where({
									"field_passport_number" : "",
									"field_passport" : ""
								}).length,
			"pageless"	: App.project.pageObjectCollection.where({"field_page" : ""}).length,
		});
	},
	_classesStates : function(){
		this.set({
			"classes"	: App.project.classes.length,
		});
	},
	defaults : {
		classes 	: 0,
		students	: 0,
		textless	: 0,
		pageless	: 0,
		passportless: 0,
		field_due_date_design : '1/1/1976',
		supply_date		: '1/1/1976',
	}
};
module.exports = Backbone.Model.extend(state);
