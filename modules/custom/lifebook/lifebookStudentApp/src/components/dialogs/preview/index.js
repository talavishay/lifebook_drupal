var view = {
	//~ className : "help",
	template : require('./template.html'),
	//~ template : false,
  //~ tagName : "img",
  //~ attributes : function(options){
    //~ return {
      //~ src : this.options.src || options.src
    //~ }
  //~ },
};
module.exports = App.Marionette.ItemView.extend(view);
