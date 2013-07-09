
	//**************************
	//Single Post View
	//**************************
	var SinglePostViewClass = Backbone.View.extend({

		el: '#app',

		initialize: function(options) {



		},


		template: _.template( jQuery("#single-post-view").html() ),

		render: function(options) {
			var that = this;

			var post = new PostModel({id:options.id});

			this.$el.html("SINGLE POST VIEW EYAH");

			var postParams = {get_comments:1};

			post.fetch({
				success: function(postModel) {

					that.$el.html(that.template({post:postModel}));

					settings.set("page_title",postModel.get("title"));

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

			jQuery(".community-title").text(settings.get("page_title"));

			this.listenTo(settings, 'change:page_title',function(){
				jQuery(".community-title").text(settings.get("page_title"));
			});
		},

		render: function(options){


			var postView = new PostTileViewClass();

			//If there is a post_type, change the title.
			if (options.params.post_type) {
				settings.set("page_title",settings.get("post_types")[options.params.post_type].display_name);

				if (settings.get("post_types")[options.params.post_type].post_display_style == "list")
					var postView = new PostListViewClass();

			} else {
				settings.set("page_title",settings.get("default_page_title"));
			}


			var that = this;



			var posts = new PostsClass();


			//that.$el.empty();

			posts.fetch({
				success: function(returnedPosts){


					var postcount = 0;

					that.$el.html("");

					_.each(returnedPosts.models,function(post){

						var postRender = postView.render({post:post}).$el.html();
						that.$el.append(postRender);

					});


				},
				data: options.params
			});



		}
	});

	var PostTileViewClass = Backbone.View.extend({

		tagName: "li",
		className: "tile-view",

		template: _.template( jQuery("#post-tile-template").html() ),

		initialize: function() {

		},

		render: function(options){


			console.log(options.post);

			this.$el.html(this.template({post:options.post}));
			return this;

		}
	});

	var PostListViewClass = Backbone.View.extend({

		tagName: "li",
		className: "list-view",

		template: _.template( jQuery("#post-list-template").html() ),

		initialize: function() {

		},

		render: function(options){


			console.log(options.post);

			this.$el.html(this.template({post:options.post}));
			return this;

		}
	});