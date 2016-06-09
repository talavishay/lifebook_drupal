var filesCollection = {
	idAttribute : "_id",
	model: App.models.files_draft,
	sync:App.BackbonePouch.sync({
		db: App.PouchDB('image_field_item_view_files'),
		fetch: 'query',
		options: {
			query: {
				include_docs: true,
				attachments : true,
				binary : true,
				fun : function(){
}
			}
		},
		//listen:true,
		changes: {
			include_docs: true,
			attachments : true,
			binary : true,
			filter: function(doc) {
				return doc._;
			}
		}
	}),
	parse		    : function(result){
		if(result.rows){  
			return result.rows ;
		} else {
			return result ;
		};
	},
	initialize	: function(){
		this.listenTo(App.filesCH, {
			"files:input:draft" : this.addDraft,
			"files:upload:remote" : this.filesUploadRemote,
			"files:input:remote" : this.addDrupal,
			//~ "files:input:local:saved" :this.addDrupal
		}, this);
		App.filesCH.reply({
			"files:output" : this.getSrcId
		}, this);
		_.bindAll(this,  "addDraft");
	},
	resolveByFid: function(fid){
		return new Promise(function(resolve, reject){
			var z = new App.models.file_remote_drupal({fid : fid}); 
			z.on("change:_file", function(D8file){
					resolve(z.get("_file"));
			});
			z.on("error", function(err){
					reject(err);
			});
		});
	},
	validateSrc	: function (src){
		//TODO: why not use blob-util/imgSrcToBlob  ??
		return new Promise(function(resolve, reject){
			var xhr = new XMLHttpRequest();
			xhr.open('GET', src);
			xhr.responseType = 'blob';
			xhr.onreadystatechange = function () {
				if (xhr.readyState !== 4) {
				  return;
				}
				if(xhr.status === 200){
					resolve(src);
				} else {
					reject(src);
				};
			};
			xhr.send();
		});
	},
	getSrcId	  : function (id){
		return this.get(id).refreshSrc();
	},
	addDrupal	  : function (D8model){
		this.add(D8model.get("_file"), { parse: false } );
	},
	addDraft	  : function (file){
		this.create(file, {
      parse: true,
      wait: true 
    });
	},
	filesUploadRemote	  : function (file){
    var file_draft = new App.models.file_draft(file, {parse: true});
    file_draft.drupalize()
      .then(function(drupalizedFileEntity){
         drupalizedFileEntity.file_draft = file_draft;
         App.Radio.trigger("filesCH","fileSaved",  drupalizedFileEntity);
         
    });
      
    //~ this.listenTo(_file,{
      //~ "change:fid" : function(_file){
        //~ _file.originatingView.model = _file;
        //~ _file.originatingView.render();
          //~ App.Radio.trigger("filesCH","fileSaved",  _file);
        //~ }
      //~ }
    //~ }, this);
	},
};
module.exports = App.Backbone.Collection.extend(filesCollection);
