//*****************************************************************
//******************     DATA MODELS    ***************************
//*****************************************************************	
	var PostModel = Backbone.Model.extend({
		urlRoot:"/community-api/posts"
	}); 
	
	var PostsClass = Backbone.Collection.extend({
		url:"/community-api/posts",
		model: PostModel
	});