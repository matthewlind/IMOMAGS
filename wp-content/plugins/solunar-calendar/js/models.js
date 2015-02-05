//*****************************************************************
//******************     DATA MODELS    ***************************
//*****************************************************************


	var PostModel = Backbone.Model.extend({
		urlRoot:"/community-api/posts"
	});

	var PostsClass = Backbone.Collection.extend({
		url:"/community-api/posts",
		model: PostModel,
	    params: {
	      skip: 0,
	      per_page: 100,
	      order_by: 'created',
	      sort: 'DESC'
	    }
	});

	var UserModel = Backbone.Model.extend({
		urlRoot:"/community-api/users"
	});

  var UsersCollection = Backbone.Collection.extend({
		url:"/community-api/users",
		model: UserModel,
	    params: {
	      skip: 0,
	      per_page: 100,
	      order_by: 'user_registered',
	      sort: 'DESC'
	    }
	});

	//Save the original page title so that we can use it later
	IMO_COMMUNITY_CONFIG.default_page_title = IMO_COMMUNITY_CONFIG.page_title;

	var Settings = Backbone.Model.extend({
        defaults: IMO_COMMUNITY_CONFIG
    });
