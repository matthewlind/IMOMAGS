//*****************************************************************
//****************    UTILITY FUNCIONS    *************************
//*****************************************************************

	//Set the base url for the AJAX requests
	$.ajaxPrefilter( function( options, originalOptions, jqXHR ) {
		options.url = 'http://www.northamericanwhitetail.deva/community-api' + options.url;
		
		if (options.type == "GET" || originalOptions.type == "GET") {
			options.data = $.param($.extend(originalOptions.data, userIMO));
		}
	
	});
	
	
	//By default jQuery doesn't allow us to convert our forms into Javascript Objects, someone wrote this snippet on Stack Overflow. 
	//Call it via $(form).serializeObject() and get a object returned.
	$.fn.serializeObject = function() {
	  var o = {};
	  var a = this.serializeArray();
	  $.each(a, function() {
	      if (o[this.name] !== undefined) {
	          if (!o[this.name].push) {
	              o[this.name] = [o[this.name]];
	          }
	          o[this.name].push(this.value || '');
	      } else {
	          o[this.name] = this.value || '';
	      }
	  });
	  return o;
	};
	
//*****************************************************************
//******************     DATA MODELS    ***************************
//*****************************************************************
	var PostsClass = Backbone.Collection.extend({
		url:"/posts"
	});
	
	var PostModel = Backbone.Model.extend({
		urlRoot:"/posts"
	}); 
//*****************************************************************
//******************      VIEWS         ***************************
//********** (this is where the magic happens) ********************
//*****************************************************************		
	var PostListClass = Backbone.View.extend({
		el: '#app',
		render: function(){
			var posts = new PostsClass();
			var $element = this.$el;
			
			posts.fetch({
				success: function(posts){
					var template = _.template($("#post-list-template").html(),{posts:posts.models});
					$element.html(template);
				}
			});
			
		}
	});
	
	var EditPostViewClass = Backbone.View.extend({
		el: '#app',
		render: function(options) {
			var $element = this.$el;
			
			if (options.id) {
				var post = new PostModel({id: options.id});
				post.fetch({
					success: function(post) {
						var template = _.template($("#new-post-template").html(),{post:post});
						$element.html(template);
					}
				});
				
			} else {
				var template = _.template($("#new-post-template").html(),{post:null});
				$element.html(template)
			}
			
			;
			
		},
		events: {
			'submit #new-post-form':"savePost" 
		},
		savePost: function(ev){
										
			var formDataObject = $(ev.currentTarget).formParams();
			
			var newPostData = $.extend(formDataObject,userIMO);
					
			postDataSerialized = $(newPostData)[0];
					
			var newPost = new PostModel();
			newPost.save(postDataSerialized,{
				success: function(post) {
					router.navigate("",{trigger:true});
				}
			});
			
			return false;
		}
		
		
	});
//*****************************************************************
//******************       ROUTER       ***************************
//*****************************************************************	
	var AppRouter = Backbone.Router.extend({
		routes: {
			'':'home',
			'!new':"editPost",
			'!edit/:id':"editPost"
		}
	});
	
	var router = new AppRouter();
	
	var postList = new PostListClass();
	var editPostView = new EditPostViewClass();
	
	router.on('route:home',function() {
		postList.render();
	});
	
	router.on('route:editPost',function(id) {
		editPostView.render({id:id});
	});
	
	Backbone.history.start();