var view = {
    template : false,
    ui : {
        "last_name" : ".field--name-field-last-name .field__item",
        "name" : ".field--name-name .field__item",
        "text" : ".field--name-field-student-text .field__item",
    },
    modelEvents : {
      "change" : "_updateModel"
    },
    _stickit : function(){
      this.bindings = {};

      if(this.$el.prop("tagName") !== "TR"){
          this.ui.last_name.attr("contenteditable", "true");
          this.ui.name.attr("contenteditable", "true");
          this.ui.text.attr("contenteditable", "true");
      
        _.each(["field-last-name", "name", "field-student-text"], function(item){
            this.bindings['.field--name-' + item + ' .field__item'] = item.replace(/-/g, "_");
        }, this);
        
      } else {
        this.$el.find('td:visible:nth-child(1)')
          .attr({
             "contenteditable": "true",
             "class" : "name"
        });
        this.$el.parent().find('td:visible:nth-child(2)')
          .attr({
             "contenteditable": "true",
             "class" : "field-last-name"
        });
      
        this.bindings['.name'] = 'name';
        this.bindings['.field-last-name'] = 'field_last_name';
        
      };
      this.stickit();
    },
}
module.exports = App.Marionette.LayoutView.extend(view);
