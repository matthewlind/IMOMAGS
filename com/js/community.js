	
	//**************************
	//Main App View
	//**************************
	var CommunityViewClass = Backbone.View.extend({
		el: '#app',

		template: null,
		
		initialize: function() {

		},
		
		render: function(){
		
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
	
