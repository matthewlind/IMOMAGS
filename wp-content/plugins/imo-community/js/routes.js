//*****************************************************************
//******************       ROUTER       ***************************
//*****************************************************************

	var settings = new Settings();

	var post_types = Object.keys(settings.get("post_types"));

	var routes = {
			'!mod':'mod',
      '!mod/users':"userList",
			'!new':"editPost",
			'!edit/:id':"editPost",

			'':'redirect',
			'!':'home',
			'!page:page':'homePaged',

			'!:post_type':'home',
			'!:post_type/:id':'single'
		};




	var AppRouter = Backbone.Router.extend({
		routes: routes
	});

	var router = new AppRouter();

	var userList = new UserListTable();

	var postList = new PostListTable();
	var editPostView = new EditPostViewClass();

	var communityView = new CommunityViewClass();

	var singlePostView = new SinglePostViewClass();



	router.on('route:redirect',function(){
		router.navigate("!", {trigger: true});
	});

	router.on('route:mod',function() {
		//history.pushState(null,null,"http://www.northamericanwhitetail.deva/beta-community/mod");
		postList.render();
	});

  router.on('route:userList',function() {
		userList.render();
	});

	router.on('route:editPost',function(id) {
		editPostView.render({id:id});
	});

	router.on('route:home',function(post_type,id,page){
		//SHOW POSTLIST VIEW


		if (jQuery.inArray(post_type,post_types) == -1)
			post_type = undefined;

		communityView.render({ params : { post_type:post_type, id:id, page:page }});

		console.log("HOME ROUTE WITH ID and SLUG and PAGE",post_type,id,page);
	});

	router.on('route:homePaged',function(page){
		//SHOW POSTLIST VIEW

		console.log("HOME ROUTE WITH PAGE",page);
	});

	router.on('route:single',function(post_type,id){
		//SHOW POSTLIST VIEW

		singlePostView.render({id:id,post_type:post_type});

	});



	Backbone.history.start();
