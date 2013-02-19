
	//**************************
	//Single Post View
	//**************************
	var SinglePostViewClass = Backbone.View.extend({
		
		el: '#app',
		
		initialize: function(options) {
			
			
			
		},
		
		render: function(options) {
			var that = this;
			
			var post = new PostModel({id:options.id});
			
			this.$el.html("SINGLE POST VIEW EYAH");
			
			var postParams = {get_comments:1};
					
			post.fetch({
				success: function(postModel) {
					
					console.log(postModel);
					
				},
				data: postParams
			});
			
			
		}
		
	});
	
	//**************************
	//Main App View
	//**************************
	var CommunityViewClass = Backbone.View.extend({
		el: '#app',

		template: null,
		
		initialize: function() {
		
		

			this.listenTo(settings, 'change',function(){
				$(".community-title").text(settings.get("title"));
			});
		},
		
		render: function(){
		
			settings.set("title",IMO_COMMUNITY_CONFIG.page_title);
		
			var that = this;
		
			var postTileView = new PostTileViewClass();
			
			var posts = new PostsClass();
			
			
			//that.$el.empty();
			
			posts.fetch({
				success: function(returnedPosts){
				
				
					var postcount = 0;
				
					_.each(returnedPosts.models,function(post){
					
						

						var postRender = postTileView.render({post:post}).$el.html();
						that.$el.append(postRender);
						
					});
				
					
				}
			});
		
			
				
		}
	});
	
	var PostTileViewClass = Backbone.View.extend({

		tagName: "li",
		className: "tile-view",
	
		template: _.template( $("#post-tile-template").html() ),
		
		initialize: function() {

		},
		
		render: function(options){
		
		
			console.log(options.post);
		
			this.$el.html(this.template({post:options.post}));
			return this;
				
		}
	});
	
