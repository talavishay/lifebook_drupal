	var file = require('./d8model.js');
	file.prototype.idAttribute  = 'fid';
	file.prototype.parse	= function(resp, options) {
		return this._fromExtendedJSON(resp);
	};
	file.prototype.initialize 	= function(options) {
    _.bindAll(this, "_attachBlobToModel", "_attachFileToModel", "_getFileFromRemote");
    this._type = 'file';
    this._root = 'entity';
		//~ this.on({	"change" : this.}, this);
		if(this.id) this.fetch();
  };
	file.prototype._getFileFromRemote = function() {
		var uri = '/lifebook/images/'+this.id;
    //TODO: cache ?
    request = new XMLHttpRequest();
		request.responseType = 'blob';
		request.open("GET", uri, true);
		request.onprogress = console.log.bind(console);
		//~ request.onload =  this._attachBlobToModel;
		request.onload =  this._attachFileToModel;
		request.send(null);
	};
	file.prototype._attachBlobToModel = function(e) {
		this._attachFileToModel(this._blobToFile( e.target.response || e ));
	},
	file.prototype._attachFileToModel = function(file) {
    file = file instanceof Blob       ?
              this._blobToFile(file)  : file ;
    var _f =_.extend({  _id : this.id,
                        file: File     }, this.attributes);
    this._file_draft = new App.models.file_draft;
    this._file_draft.set( _f, { parse:true } );
    this._file_draft.refreshSrc();
	};
	file.prototype._blobToFile = function(blob) {
    var mimi = this.get("type") || "png",
        name = "image/" + this.get("filename");
    
    return new File( [ blob || this.get("file") ], name, {type: mime} );
	},
	file.prototype._parsePOSTresponse = function(ev){
    this.model.set(this.model._fromExtendedJSON(JSON.parse(ev.target.response)));
    //~ this.model.set(this.model._fromExtendedJSON(ev.target.response));
    this.resolve(this.model);
  };
	file.prototype._setFileOnRemote = function() {
    var model = this;
		return new Promise(function(resolve, reject){
      App.nprogress.start();
      var xhr = new XMLHttpRequest();
      xhr.onerror     = reject;
      xhr.onstart     = App.nprogress.start;
      xhr.onprogress  = xhr.onsend      = App.nprogress._onprogress;
      xhr.onstop      = xhr.oncomplete  = App.nprogress.done;
			xhr.onload      = _.bind(model._parsePOSTresponse, {
        model : model,
        resolve : resolve
      });
      
      xhr.open('POST', '/lifebook/uploads/'+model.get("fid"), true);
			xhr.send(model.file_draft.get("file"));
    });
	};
module.exports = file;
