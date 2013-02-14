
//*****************************************************************
//******************      VIEWS         ***************************
//********** (this is where the magic happens) ********************
//*****************************************************************		



	
	//**************************
	//Moderator Table View
	//**************************
	var PostListTable = Backbone.View.extend({
		el: '#app',
		pager: null,
		init: function() {
			var that = this;
			
			this.render();
		
			this.pager = new PostListPager();
			
			this.pager.on("pager:click",function(event){
				that.render();
			});
			
			this.pager.render();
			
			
		},
	
		template: null,
		render: function(){
		
			console.log("TABLE VIEW RENDER");
			
			var that = this;
		
			var $element = this.$el;


			
			this.template = _.template($("#post-list-table").html());
			$element.html(this.template);

		
			
			var postTableRows = new PostTableRows();			
			postTableRows.render({params: postListParams});
			
			
						
					
		}
	});
	
	//**************************
	//Moderator Table Rows
	//**************************	
	var PostTableRows = Backbone.View.extend({
		el: '#post-list-table-body',
		posts: null,
		render: function(options){
			
			var $element = this.$el;
			
			
			if (!this.posts)
				this.posts = new PostsClass();
					
			this.posts.fetch({
				success: function(posts){
				
		
				
					var template = _.template($("#post-list-rows").html(),{posts:posts.models});

					$element.html(template);
				},
				
				data: options.params
			});				
		},		
	});	
	
	
	//**************************
	// Pager
	//**************************
	
	var PostListPager = Backbone.View.extend({
		el: "#post-list-pager-div",
		render: function(options) {
		
	
		
			var $element = this.$el;

			var template = _.template($("#post-list-pager-template").html());
	
			$element.html(template);
		},
		events: {
			'click .prev-list':"prev",
			'click .next-list':"next"  
		},
		next: function(ev) {
			postListParams.skip += postListParams.per_page;
			this.trigger('pager:click');
			return false;
		},
		prev: function(ev) {
			postListParams.skip -= postListParams.per_page;
			this.trigger('pager:click');
			return false;
		}
	});
	
	
	
	//**************************
	//Moderator Edit Post View
	//**************************	
	var EditPostViewClass = Backbone.View.extend({
		el: '#app',
		post: null,
		render: function(options) {
			var $element = this.$el;
			var that = this;
			
			if (options.id) {
				that.post = new PostModel({id: options.id});
				that.post.fetch({
					success: function(post) {
						var template = _.template($("#new-post-template").html(),{post:post});
						$element.html(template);
						
						var attachments = new Attachments();
												
						attachments.init({post:post});
						//attachments.render({attachments:post.attributes.attachments});
						
						console.log(that.post);
					}
				});
				
			} else {
			
				//if (!that.post)
				that.post = new PostModel();
			
				var template = _.template($("#new-post-template").html(),{post:that.post});
				$element.html(template)
			}
			
			;
			
		},
		events: {
			'submit #new-post-form':"savePost",
			'change #image-upload':"filePickerUpload", 
		},
		filePickerUpload: function(ev){
		
			var that = this;
								
			console.log(ev);
			
			var fileInput = ev.currentTarget;
			
			if (!fileInput.value) {
			    console.log("Choose a png to store to S3");
			} else {
			
				filepicker.setKey('ANCtGPesfQI6nKja0ipqBz');
			
				
			
			    filepicker.store(fileInput, function(FPFile){
			            console.log("Store successful:", FPFile);
			            
			            var newAttachment = {};
			            newAttachment.img_url = FPFile.url;
			            newAttachment.post_type = "photo";
			            
			            
			            if (!that.post.attributes.attachments)
			            	that.post.attributes.attachments = [];
			            	
			            that.post.attributes.attachments.push(newAttachment);
			            
			            
			            var attachments = new Attachments();
												
						attachments.render({attachments:that.post.attributes.attachments});
			            
			            
			        }, function(FPError) {
			            console.log(FPError.toString());
			        }, function(progress) {
			            console.log("Loading: "+progress+"%");
			        }
			   );
			}
						
		},
		savePost: function(ev){
											
			var formDataObject = $(ev.currentTarget).formParams();

			var newPostData = $.extend(this.post.attributes,formDataObject,userIMO);	
			var postData = $(newPostData)[0];
					
		
			
			console.log(postData);
			
			this.post.save(postData,{
				success: function(post) {
					this.post = null;
					router.navigate("",{trigger:true});
				}
			});
			
			return false;
		}
		
		
	});

	//**************************
	// Edit Attachments
	//**************************
	
	var Attachments = Backbone.View.extend({
		el: "#attachments",
		post: null,
		init: function(options) {
			
			this.post = options.post;
			
			console.log(this.post);
			
			
			this.render({attachments: this.post.attributes.attachments});
		},
		render: function(options) {
			var $element = this.$el;

			var template = _.template($("#edit-post-attachments-template").html(),{attachments:options.attachments});
	
			$element.html("");
			
			_.each(options.attachments,function(attachment){
			
				var $template = $(template);
				
				$element.append($template);
			
				var newAttachment = new singleAttachment();
											
				newAttachment.setElement($template).render({attachment:attachment});
			});
			
			
		}

	});
	
	var singleAttachment = Backbone.View.extend({

		attachmentData: null,
		render: function(options) {
		
			var $element = this.$el;
			this.attachmentData = options.attachment;
			var that = this;

			var template = _.template($("#single-attachment-template").html(),{attachment:options.attachment});
			
			$template = $(template);
			
	
		$element.html($template);			
		},
		events: {
			'change .caption-field':"changeCaption"
		},
		changeCaption: function(ev) {
			this.attachmentData.body = ev.currentTarget.value;
			console.log(this.attachmentData);
			
			
		}
		
	});
