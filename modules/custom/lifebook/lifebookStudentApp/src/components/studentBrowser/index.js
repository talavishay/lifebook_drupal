var view = {
    template : false,
    //~ el : ".page_object",
    el : "#main",
    ui : {
        "last_name" : ".field--name-field-last-name .field__item",
        "name" : ".field--name-name .field__item",
        "text" : ".field--name-field-student-text .field__item",
    },
    modelEvents : {
      "change" : "_updateModel"
    },
    initialize : function(){
      var that = this;
      that.bindings = {};
      _.each(["field-last-name", "name", "field-student-text"], function(item){
          that.bindings['.field--name-' + item + ' .field__item'] = item.replace(/-/g, "_");
      })
      this.render();
      this.ui.last_name.attr("contenteditable", "true");
      this.ui.name.attr("contenteditable", "true");
      this.ui.text.attr("contenteditable", "true");
      this.stickit();
    },
    _updateModel : _.throttle(function(m, s){
        this.model.save({
          name : m.get("name")
        });
    }, 5000)
}
module.exports = App.Marionette.LayoutView.extend(view);
