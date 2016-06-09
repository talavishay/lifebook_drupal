App.nprogress.configure({ showSpinner: false });
App.nprogress._onprogress = function(e)  {
  e.lengthComputable ?
    App.nprogress.set((Math.floor((e.loaded/e.total) * 100)) / 100):
    App.nprogress.inc();
};

jQuery(document).on("ajaxStart", function(){
  App.nprogress.start();
}).bind("ajaxSend", function(){
  App.nprogress.start();
}).bind("ajaxStop", function(){
  App.nprogress.done();
}).bind("ajaxComplete", function(){
  App.nprogress.done();
});

