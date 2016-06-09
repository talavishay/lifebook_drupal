jQuery.get('/rest/session/token')
	.done(function f(csrfToken){
	App.csrfToken = 	csrfToken;
});
//~ require('../../components/user');
//~ App.user.fetch();
