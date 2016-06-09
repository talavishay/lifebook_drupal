var file = {
  drupalize : function(){
    this.file_remote_drupal = new App.models.file_remote_drupal;
    this.file_remote_drupal.file_draft = this;
    return this.file_remote_drupal._setFileOnRemote();
	},
	parse		: function(data){
    var out;
		if(data instanceof File){
			out = this._parseFile(data);
		};
		if(	data.doc ) {
			out = this._parsePouch(data.doc);
		};			
		if(	data.uuid ) {
			out = this._parseRemote(data);
		};
    
    return out;
	},
	_parsePouch	: function(doc){
		if(	doc._attachments && doc._attachments[doc.filename]) {
			doc.file 	= doc._attachments[doc.filename].data;
		}
		return doc;
	},
	_parseRemote	: function(data){
		return App._.extend({
				uuid	: data.uuid,
				_id		: data.uuid,
				fid		: data.fid,
		}, this._parseFile(data.file));
	},
	_parseFile	: function(file){
		return {
			file		: file,
			filename	: file.name,
			filesize	: file.size,
			filemime	: file.type,
			changed		: file.lastModified,
		};
	},
	//_hashFile	: function(file){
		//return App.objectHash({
			//name 			: file.name,
			//lastModified	: file.lastModified,
			//size			: file.size,
		//});
	//},
	//~ getSrcId	: function(data){
		//~ URL.revokeObjectURL(data.src);
		//~ var id = data.id || data._id;
		//~ if(data.fid){
			//~ id	=  id + "?fid=" + data.fid ;
		//~ };
		//~ var url = URL.createObjectURL(data.file);
		//~ return url + "#" + id;
	//~ },
	refreshSrc	: function(){
		URL.revokeObjectURL(this.get("src"));
		var id = this.id,
			src = URL.createObjectURL(this.get("file")),
			fid = this.get("fid");
		
		if(fid){
			id	=  this.id + "?fid=" + this.get("fid") ;
		};
		this.set({
			src	: src + "#" + id
		});
		return src + "#" + id;
	},
	
	defaults	: {
		file : null,
		filename : "null.null",
		src : "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE4LjEuMSwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTI1LjE1MyA1MjUuMTUzIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MjUuMTUzIDUyNS4xNTM7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxwYXRoIGQ9Ik0wLDI2Mi41NzZjMCw2NC41MDYsMjYuNTg2LDEyMi41NTcsNjguODE3LDE2NC41N0wwLDQ5NS45NjNoMTc1LjAwN1YzMjAuOTU2bC02NS4yOTQsNjUuMjk0DQoJCWMtMzEuNTk3LTMxLjc5NC01MS4zMzQtNzUuMjk0LTUxLjMzNC0xMjMuNjczYzAtNzYuMDgxLDQ4LjczLTE0MC45MzgsMTE2LjYyOC0xNjQuNzg4VjM2LjgwNEM3NC4zNzUsNjIuNjksMCwxNTMuNzYsMCwyNjIuNTc2eg0KCQkgTTIzMy4zODcsNDA4LjM5NGg1OC4zNzl2LTU4LjI0OGgtNTguMzc5VjQwOC4zOTR6IE01MjUuMTUzLDI5LjE5SDM1MC4xNDV2MTc1LjAwN2w2NS4yOTQtNjUuMjk0DQoJCWMzMS41OTcsMzEuNzk0LDUxLjMzNCw3NS4yOTQsNTEuMzM0LDEyMy42NzNjMCw3Ni4wODEtNDguNzMsMTQwLjkzOC0xMTYuNjI4LDE2NC43ODh2NjAuOTgzDQoJCWMxMDAuNjMyLTI1Ljg4NiwxNzUuMDA3LTExNi45NTYsMTc1LjAwNy0yMjUuNzcyYzAtNjQuNTA2LTI2LjU4Ni0xMjIuNTU3LTY4LjgxNy0xNjQuNTdMNTI1LjE1MywyOS4xOXogTTIzMy4zODcsMjkxLjc2Nmg1OC4zNzkNCgkJVjExNi43NTloLTU4LjM3OVYyOTEuNzY2eiIvPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPC9zdmc+DQo=" ,
	},
};


//~ var _pouch_attachments = App.BackbonePouch.attachments();

//~ _pouch_attachments.attach =  function(blob) {
	//~ var that = this,
		//~ _modelAttachments = {},
		//~ blob = blob || this.get("file"),
		//~ name = blob.name || this.get("filename");

	//~ _modelAttachments[name] = {
		//~ type: blob.type,
		//~ data: blob
  //~ };
  //~ var doc = App._.extend({
                  //~ _attachments: _modelAttachments,
                  //~ chapter : App.chapter.getId()
            //~ }, this.attributes);

	//~ return this.sync().db.put(doc)
    //~ .then(function _cb(response, err){
			//~ if (!err && response.rev) {
				//~ that.set(that.parse(response));
			//~ };
    //~ });
//~ };
//~ var _f =_.extend(file, _pouch_attachments),
    //~ imageModel = App.Backbone.Model.extend(_f);
//~ module.exports =  imageModel;
module.exports =  App.Backbone.Model.extend(file);
