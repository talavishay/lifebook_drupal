var _model = {
	parse		: function(resp, options) {
		return this._fromExtendedJSON(resp);
	},
	_fromExtendedJSON: function(resp) {
		var id = this.idAttribute;
		if (!_.isNull(resp) && !_.isUndefined(resp) ) {
			_.each(resp, function(value, key) {
				if( _.isString(key) && _.isArray(value) && typeof value[0] != "undefined"){
					if(typeof value[0].value != "undefined"){
						resp[key == 'nid' ? id : key] = value[0].value;
					}
					if(typeof value[0].target_id != "undefined"){
						resp[key == 'nid' ? id : key] = value[0].target_id;
					}
				}
			});
		}
		return resp;
	},
	_toExtendedJSON: function() {
		var attrs = _.omit(this.attributes, 
    'changed', 'user_id');
		_.each(attrs, function(value, key) {
			attrs[key] = [{ 'value': value }];
		});
		attrs.id = this.id;
		return attrs; 
	},
	sync		: function(method, model, options)  {
		var format = '?_format=json',
        id = model.id,
        _url =  model.isNew()           ? 
				'/entity/'+this._type + format  :
				'/'+this._root+'/'+this._type 
              + '/'+ id + format;
    //~ change update method (PUT).. adapt to Drupal..    
    if (method === 'update') options.type = 'PATCH';
		options.url = _url;
    options.beforeSend = function (xhr) {
			xhr.setRequestHeader('Content-type',  'application/json');
			xhr.setRequestHeader('Accept',        'application/json');
      if (method !== 'read'){
        //~ add CSRF token .. adapt to Drupal..    
        xhr.setRequestHeader('X-CSRF-Token', App.csrfToken);
      };  
		};
//~Substute toJSON method . adapt to Drupal? nested value style..
		var toJSON = this.toJSON;
		this.toJSON = this._toExtendedJSON;
		var ret = App.Backbone.sync.apply(this, arguments);
		this.toJSON = toJSON;
		return ret;
	},
};
module.exports = App.Backbone.Model.extend(_model);
