//*****************************************************************
//******************     DATA MODELS    ***************************
//*****************************************************************	
	var PostModel = Backbone.Model.extend({
		urlRoot:"/posts"
	}); 
	
	var PostsClass = Backbone.Collection.extend({
		url:"/posts",
		model: PostModel
	});