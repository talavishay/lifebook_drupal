var app = {
	onBeforeStart : function(){
      //adapt to list view 
      if(!this.options.uuid){
        this.options = _.first(_.values(this.options));
      };
        
      this.model =  new App.models.pageObjectStudent(this.options, { parse : true });

      this.view = new App.views.studentBrowser(); 
      this.view.model = this.model;
      this.view.$el = jQuery('[data-uuid=' + this.model.get("uuid") +']' );
      //~ this.view.render();
      this.view.render();
      this.view._stickit();
      this.view.model.on("change", this.view.model._updateName);
      //adapt to list view 
      
	},
};
module.exports = App.Marionette.Application.extend(app)

