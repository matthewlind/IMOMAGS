//*****************************************************************
//******************       ROUTER       ***************************
//*****************************************************************	
	var AppRouter = Backbone.Router.extend({
		routes: {
		
			'!mod':'mod',
			'!new':"editPost",
			'!edit/:id':"editPost",		
		
			'':'redirect',
			'!':'home',
			'!page:page':'homePaged',
			
			'!:post_type':'home',
			'!:post_type/:id':'home'
			


		}
	});
	
	var router = new AppRouter();
	
	var postList = new PostListTable();
	var editPostView = new EditPostViewClass();
	
	var communityView = new CommunityViewClass();
	
	
	router.on('route:redirect',function(){
		router.navigate("!", {trigger: true});
	});
	
	router.on('route:mod',function() {
		postList.init();
	});
	
	router.on('route:editPost',function(id) {
		editPostView.render({id:id});
	});
	
	router.on('route:home',function(post_type,id,page){
		//SHOW POSTLIST VIEW
		
		communityView.render();
		
		console.log("HOME ROUTE WITH ID and SLUG and PAGE",post_type,id,page);
	});

	router.on('route:homePaged',function(page){
		//SHOW POSTLIST VIEW
		
		console.log("HOME ROUTE WITH PAGE",page);
	});

	

	Backbone.history.start();