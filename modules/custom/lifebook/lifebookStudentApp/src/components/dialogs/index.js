'use strict';
var dialogs = {
      preview : require("./preview/index.js"),
    },
  dialog = {
    el : "#_dialog_popup",
    className : 'dialogs',
    template: require('./template.html'),
    _show : function(){		this.$el.slideDown()	},
    _hide : function(){ 	this.$el.hide()	},
    regions	:	{
        "toolContent" : "#toolContent",
    },
    events  : {
      "click .closeDialog" : "_hide"
    },
    childEvents: { 
      render: "_show",
    },
    initialize 	:	function(options){
      this._hide();
      this.listenTo(App.Radio.channel('dialog'), {
        "dialog"		:function(data){
          this.$el.find(".title").hide();
          this.toolContent.show(new dialogs.preview({
            model : new App.Backbone.Model(data)
          }));
          window.scrollTo(0,0);  
        },
        "dialog:close"		:this._hide,
      }, this );
    },
};
module.exports = App.Marionette.LayoutView.extend(dialog) ;
