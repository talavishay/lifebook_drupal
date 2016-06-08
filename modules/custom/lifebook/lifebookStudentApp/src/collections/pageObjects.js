var pageObjects = {
	//~ mode: "client",
	model : require('../models/pageObjectStudent.js'),
	//~ state: {
		//~ pageSize: 3
	//~ },
};

module.exports = Backbone.Collection.extend(pageObjects);
//~ module.exports = App.PageableCollection.extend(pageObjects);
