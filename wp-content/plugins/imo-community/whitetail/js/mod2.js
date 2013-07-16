
//*****************************************************************
//******************      VIEWS         ***************************
//*****************************************************************
	var deleteCell = Backgrid.BooleanCell.extend({
					editor: _.template("<a href='' class='btn'>Delete</a>"),
					events: {
					    "click": "deleteRow",
					    },
					deleteRow: function(ev) {

						ev.preventDefault();

						if (confirm("Really?")) {
							this.model.destroy({
								data: JSON.stringify(userIMO),
								wait: true,
								error: function() {
									alert("Delete failed! Try reloading the page to get a new permissions token.")
								}

							});

						}


					}
				});

	//**************************
	//User Table View
	//**************************

	var UserListTable = Backbone.View.extend({
		el: '#app',
		pager: null,
		initialize: function() {
			var that = this;

		  var columns = [{
		    name: "ID", // The key of the model attribute
		    label: "ID", // The name to display in the header
		    editable: false, // By default every cell in a column is editable, but *ID* shouldn't be
		    // Defines a cell type, and ID is displayed as an integer without the ',' separating 1000s.
		    cell: "string"

		  }, {
		    name: "user_login",
		    label: "Username",
		    editable: false,
		    // The cell type can be a reference of a Backgrid.Cell subclass, any Backgrid.Cell subclass instances like *id* above, or a string
		    cell: "string" // This is converted to "StringCell" and a corresponding class in the Backgrid package namespace is looked up,

		  }, {
		    name: "display_name",
		    label: "Display Name",
		    editable: false,
		    cell: "string"
		  }, {
		    name: "score_today",
		    label: "ScoreToday",
		    editable: false,
		    cell: "integer"
		  }, {
		    name: "score_week",
		    label: "ScoreWeek",
		    editable: false,
		    cell: "integer",
		    className: "thin-column"
		  }, {
		    name: "score_month",
		    label: "ScoreMonth",
		    editable: false,
		    cell: "integer"
		  }, {
		    name: "score",
		    label: "Score",
		    editable: false,
		    cell: "integer"
		  }, {
		    name: "comment_count",
		    label: "CommentCount",
		    editable: false,
		    cell: "integer"
		  }, {
		    name: "post_count",
		    label: "PostCount",
		    editable: false,
		    cell: "integer"
		  }/*,
		  {
		    name: "user_registered",
		    label: "Created",
		    cell: "datetime",
		  }*/
		  ];


	      this.users = new UsersCollection();

	      this.grid = new Backgrid.Grid({
	        columns: columns,
	        collection: this.users
	      });






	      //Monitor the datamodel for changes so that it can be re-rendered

	      this.users.on("change",function(){
	        that.render();
	      });



		},
		template: null,
		render: function(){

		  var that = this;
		  //Monitor the Toolbar for changes so that the datamodel can be updated
	      var toolbar = $("#user-toolbar").html();

	      this.$toolbar = $(toolbar);

	      this.$toolbar.on("change",function(ev){
	        that.users.params.order_by = $(this).find('#order_by').val();
	        that.users.trigger("change");
	        console.log(that.users.params);
	      });

	      $("#app-header").html(this.$toolbar);

	      this.$el.html(this.grid.render().$el);
	      this.users.fetch({data:this.users.params});

		}
	});


	//**************************
	//Moderator Table View
	//**************************
	var PostListTable = Backbone.View.extend({
		el: '#app',
		pager: null,
		initialize: function() {
			var that = this;

			var columns = [{
				name: "id", // The key of the model attribute
				label: "ID", // The name to display in the header
				editable: false, // By default every cell in a column is editable, but *ID* shouldn't be
				// Defines a cell type, and ID is displayed as an integer without the ',' separating 1000s.
				cell: "string"

			}, {
				name: "title",
				label: "Title",
				editable: false,
				sortable:true,
				formatter:
					_.extend({}, Backgrid.CellFormatter.prototype, {
				    	fromRaw: function (rawValue) {
				    		console.log(that);
				     		return rawValue + "";
				      }
				    }),
				// The cell type can be a reference of a Backgrid.Cell subclass, any Backgrid.Cell subclass instances like *id* above, or a string
				cell: "string" // This is converted to "StringCell" and a corresponding class in the Backgrid package namespace is looked up,

			}, {
				name: "created",
				label: "Created",
				editable: false,
				cell: "date",
			}, {
				name: "delete",
				label: "Delete",
				cell: deleteCell,

			}
			];

			this.posts = new PostsClass();

			//Monitor the datamodel for changes so that it can be re-rendered
			this.posts.on("change",function(){
				that.render();

				console.log(that.posts);
			});

			this.grid = new Backgrid.Grid({
				columns: columns,
				collection: this.posts
			});




/*
			this.listenTo(this.posts,"change",function(post){
				console.log(post);
				post.save();
			});
*/


			jQuery("#app-header").html("");

		},
		template: null,
		render: function(){

		  var that = this;

		  //Monitor the Toolbar for changes so that the datamodel can be updated
	      var toolbar = jQuery("#post-toolbar").html();

	      this.$toolbar = jQuery(toolbar);

	      this.$toolbar.find("option[value='" + that.posts.params.order_by + "']").attr("selected","selected");

	      this.$toolbar.on("change",function(ev){
	        that.posts.params.order_by = $(this).find('#order_by').val();
	        that.posts.trigger("change");

	        that.grid.removeColumn(that.grid.columns.where({ added: true }));
	        that.grid.removeColumn(that.grid.columns.where({ name: "delete" }));

	        that.grid.insertColumn([{
				name: that.posts.params.order_by,
				label: that.posts.params.order_by,
			    editable: false,
			    cell: "string",
			    added:true
			}]);

			that.grid.insertColumn([{
				name: "delete",
				label: "Delete",
				cell: deleteCell,
			}]);


	      });

	      jQuery("#app-header").html(this.$toolbar);

	      this.$el.html(this.grid.render().$el);
	      this.posts.fetch({data:this.posts.params});


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