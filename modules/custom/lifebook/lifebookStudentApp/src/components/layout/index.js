var layout = {
    el : '.lifebookStudentApp',
    template:  false,
    regions: {
        personal : '.field_personal_picture',
        passport : '.field_passport',
    },
	events : {
		"click #chaptersMaxPage" : "chaptersMaxPage"
	},
	initialize: function() {
       this.listenTo(App.layoutChannel, {
			'dialog:imageBrowser'	: ()=> {
				var personalUrl = this.personal.$el.find('[data-url]').attr('data-url'),
					passportUrl = this.passport.$el.find('[data-url]').attr('data-url');
				
				var im = new App.views.imageBrowser();
				im.url = personalUrl;
				this.personal.show(im);
				
				this.passport.show(new App.views.imageBrowser(passportUrl));
			}
		}, this);
    },
    onBeforeDestroy: function() {
        Radio.reset('studentChannel');
    }
};
module.exports = App.Marionette.LayoutView.extend(layout);
