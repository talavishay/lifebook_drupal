require('./_tools/boot');
require('./models');
require('./_tools/boot/user.js');
App = _.extend(App, {
	views : {
    studentBrowser: require('./components/studentBrowser'),
    dialogs     : require('./components/dialogs'),
	},
});

App._student_app = require('./app.js');
//~ //#####################################################################
Drupal.behaviors.lifebookStudentApp = {
  attach: function (context, settings) {
    var _students = settings.lifebookStudentApp;
    window._lifebookStudentApps = _.map( _students, function(_student){
        var student_app = new App._student_app(_student);
        student_app.start();
        return student_app;
    });

    //initiate all students on page..
    //~ students = _.map(_students, function(student){  
      //~ return new App.models.pageObjectStudent(student)
    //~ });
    App.Radio.on('studentChannel', "replace", function(imageFielItemView){
        //TODO: implement seek students and update them only instead of counting on single student entity on page ...
        //~ if(students[0].get("uuid")[0].value !== imageFielItemView._parentEntity){
        if(App.student.get("uuid") !== imageFielItemView._parentEntity){
          alert("imageFielItemView Err : entity uuid != field entityParent uuid");
          return;
        }
        //~ students[0].save(imageFielItemView.model.get("fieldName"),[{
        App.student.save(imageFielItemView.model.get("fieldName"),[{
            target_type   : "file",
            target_id     : imageFielItemView.model.get("fid"),
            target_uuid   : imageFielItemView.model.get("uuid")
        }],       { success : (d)=>{ 
                      alert("student updated ");
                      imageFielItemView.render();
        }});
    });
    App.Radio.on('studentChannel', "delete", function( imageFielItemView){
        students[0].save(imageFielItemView.model.get("fieldName"), [],{ 
          success: (d)=>{
            alert("student updated ");
            imageFielItemView.render();
          }});
    });
  }
};

      //~ App.Radio.on('studentChannel', "delete", function( imageFielItemView){

//~ //#####################################################################
//~ jQuery("#lifebookStudentApp").prepend(jQuery('<div id="_dialog_popup"/>'));
//~ App.dialog = new App.views.dialogs;
//~ App.dialog.render();

