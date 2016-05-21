var pageObjectStudent = {
	url		: function(){
		var format = '?_format=json';
			return isNaN(parseInt(this.id)) ? 
				'/entity/page_object' + format :
				'/lifebook/page_object/'+ this.id + format;
	},
	sync		: function(method, model, options)  {
		options.beforeSend = function (xhr) {
			xhr.setRequestHeader('Content-type'	,'application/json');
			xhr.setRequestHeader('Accept'		,'application/json');
			xhr.setRequestHeader('X-CSRF-Token'	,App.csrfToken);
		};
		if (method === 'update') options.type = 'PATCH';
	//~Substute toJSON method . adapt to Drupal nested value style..
		var toJSON = this.toJSON;
		this.toJSON = this._toExtendedJSON;
		var ret = Backbone.sync.apply(this, arguments);
		this.toJSON = toJSON;
		return ret;
	},
	_fromExtendedJSON: function(resp) {
		resp = _.mapObject(resp, function(val, key) {
			if(_.isArray(val)){
				if( val.length ){
					if(!_.isUndefined(val[0].value)){
						return val[0].value;
					}
					if(!_.isUndefined(val[0].target_id)){
						return val;
					}
				}else {
					return "";
				}
			};
		});
		return resp;
	},
	_toExtendedJSON: function() {
		//~ var attrs = App._.pick(this.attributes, 'data', 'meta');
		var attrs = _.omit(this.attributes, 'name' ,'url', 'changed', 'created','uuid', 'user_id', 'status', 'langcode', 'target_id', 'target_id', 'target_type' ,'target_uuid');
		_.each(attrs, function(value, key) {
			if(_.isArray(value)){
				attrs[key] = value ;
			} else {
				attrs[key] = [{value: value}];
			}
		});
		if(!this.isNew()){
			attrs.id = this.id;
		};
			
		attrs.name = this.attributes.name || "blabla";
		attrs.type = [{"target_id":"student"}];
		return attrs; 
	},
	parse : function(resp) {
		if(!_.isUndefined(resp)){
			if(typeof resp === "string"){
				resp = JSON.parse(resp);
			};
			if(!_.isUndefined(resp.id)){
				return this._fromExtendedJSON(resp);
			} else {
				var map = this.map,
					o = this.defaults;
					
				 _.each(resp, function(value, key){
					key = key.replace(/\n/, " ");
					var k = _.findKey(map, function(val){
						return key === val;
					});
					o[k] = value;
				});
				return o;
			};
		};
	},
	map : {
		class			: "כיתה",
		name			: "שם פרטי",
		"field_last_name"	: "שם משפחה",
		"field_passport_number" : "מספר תמונה",
	},
	defaults : {
		"field_passport_number"	: "",
		"field_page"			: "",
		"field_student_text"	: "",
	}
};
module.exports = Backbone.Model.extend(pageObjectStudent);
