var app = {
	onBeforeStart : function(){
      this.view = new App.views.studentBrowser({
        model : new App.models
               .pageObjectStudent(this.options, { parse : true })
      }); 
      this.view.model.on("change",console.log.bind(console));
      if(!App.student) App.student = this.view.model;
	},
};
module.exports = App.Marionette.Application.extend(app)

