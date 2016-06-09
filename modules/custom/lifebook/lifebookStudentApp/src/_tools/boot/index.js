window.App = {
	Marionette		: require('backbone.marionette'),
	Backbone			: window.Backbone,
	Radio 				: require('backbone.radio'),
	filesize			: require('filesize'),
	fileSaver			: require('file-saver'),
	blobUtil			: require('blob-util'),
  nprogress     : require('nprogress'),
};
require('backbone.stickit');
require('./progress.js');
