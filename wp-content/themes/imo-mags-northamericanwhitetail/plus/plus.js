jQuery(document).ready(function($) {


var displayAtOnce = 6;
var currentDisplayStart = 0;
var displayMode = "tile"; //either "list" or "tile"

var bgcolors = new Array("#403b35","#c65517","#829b40");

var topicKey = new Object;
topicKey.gear = "Gear";
topicKey.trophy = "Trophy Bucks";
topicKey.lifestyle = "Lifestyle";
topicKey.general = "General Discussion";
topicKey.report = "Rut Reports";
topicKey.question = "Q&A";
topicKey.tip = "Tips & Tactics";


var stateKey = new Object;
stateKey.AR = "Arizona";
stateKey.AL = "Alabama";
stateKey.AK = "Alaska";
stateKey.AZ = "Arizona";
stateKey.AR = "Arkansas";
stateKey.CA = "California";
stateKey.CO = "Colorado";
stateKey.CT = "Connecticut";
stateKey.DE = "Delaware";
stateKey.DC = "District Of Columbia";
stateKey.FL = "Florida";
stateKey.GA = "Georgia";
stateKey.HI = "Hawaii";
stateKey.ID = "Idaho";
stateKey.IL = "Illinois";
stateKey.IN = "Indiana";
stateKey.IA = "Iowa";
stateKey.KS = "Kansas";
stateKey.KY = "Kentucky";
stateKey.LA = "Louisiana";
stateKey.ME = "Maine";
stateKey.MD = "Maryland";
stateKey.MA = "Massachusetts";
stateKey.MI = "Michigan";
stateKey.MN = "Minnesota";
stateKey.MS = "Mississippi";
stateKey.MO = "Missouri";
stateKey.MT = "Montana";
stateKey.NE = "Nebraska";
stateKey.NV = "Nevada";
stateKey.NH = "New Hampshire";
stateKey.NJ = "New Jersey";
stateKey.NM = "New Mexico";
stateKey.NY = "New York";
stateKey.NC = "North Carolina";
stateKey.ND = "North Dakota";
stateKey.OH = "Ohio";
stateKey.OK = "Oklahoma";
stateKey.OR = "Oregon";
stateKey.PA = "Pennsylvania";
stateKey.RI = "Rhode Island";
stateKey.SC = "South Carolina";
stateKey.SD = "South Dakota";
stateKey.TN = "Tennessee";
stateKey.TX = "Texas";
stateKey.UT = "Utah";
stateKey.VT = "Vermont";
stateKey.VA = "Virginia";
stateKey.WA = "Washington";
stateKey.WV = "West Virginia";
stateKey.WI = "Wisconsin";
stateKey.WY = "Wyoming";

//Check for new post sharing popup

if (window.location.hash == '#share') {

	$(".new-post-share-box").modal({
		opacity: 50, 
		overlayClose: true,
		autoPosition: true,
	});
}

$(".share-not-now").click(function(event){
	event.preventDefault();

	$.modal.close();
});


//Make sure we should run all of this stuff
if ($("#recon-activity").length > 0){

	//First get any extra term and display type
	var term = $("#recon-activity").attr("term");
	var displayMode = $("#recon-activity").attr("display");
	var widthMode = $("#recon-activity").attr("widthMode");
	var state = $("#recon-activity").attr("state");
	
	if (displayMode == "tile") { //then show some tiles
		displayRecon(term);

	} else { //then show the list
		displayReconList(term);
	}
}else{
	$("#no-activity").fadeIn();
	$("#more-community-button").hide();
}

//Display the user posts
if ($("#user-activity").length > 0){
	
	var userID = $("#user-activity").attr("user");
	
	displayUserPosts(userID);
}

//Setup flagging on single post view:
$(".single-flag-button").click(function(){

	$thisFlagButton = $(this);

	if (confirm("Are you sure you want to flag this post as inappropriate?")) { 
    	var spid = $thisFlagButton.attr("spid");
       	$.post("/slim//api/post/flag", { post_id: spid, etype: "flag", user_id: userIMO.user_id } );  	
    	//$reconBox.fadeOut();
    	$thisFlagButton.find('img').attr("src","/wp-content/themes/imo-mags-northamericanwhitetail/img/flag-button-red.png");
    }

});


//Add editor tools for single posts
$(".editor-functions").change(function(){


	
	var etype = $(this).val();

	
	var postData = userIMO;
	
	postData.post_id = $(this).attr("spid");
	postData.etype = etype;
	
	
	
	$.post("/slim/api/post/flagadmin", postData, function(data){
		
		if (data.error) {
			alert(data.error);
		}				
	});  

});



/* ON ICE
//**************************
//COMMUNITY PAGE ACTIONS
//************************** 
  
  //Show the community posts and hide the list and sidebar
	$('#rut.title a').click(function(){
		$(".community").fadeOut();
		$(".bonus-background").fadeOut();
		$(".super-header").fadeOut();
		$(".back-to-community").fadeIn();
		$("#recon-activity").attr("term","report");
		$("#recon-activity").attr("display","list");
		term = $(this).attr("term");
		displayMode = $(this).attr("display");

		displayAtOnce = 6;
		
		currentDisplayStart = 0;
		

		if (displayMode == "tile") { //then show some tiles
			displayRecon(term);
	
		} else { //then show the list
			displayReconList(term);
		}
		$("ul.post-type-select li.selected").removeClass("selected");
		$("ul.post-type-select li").hasClass("report-nav").addClass("selected");		

	});
	// Show the list and sidebar again and hide the back button
	$('.back-to-community').click(function(){
		$(".community").fadeIn();
		$(".bonus-background").fadeIn();
		$(".super-header").fadeIn();
		$(".back-to-community").fadeOut();
		
		$("#recon-activity").attr("term","all");
		$("#recon-activity").attr("display","tile");
		term = $(this).attr("term");
		displayMode = $(this).attr("display");

		displayAtOnce = 6;
		
		currentDisplayStart = 0;
		

		if (displayMode == "tile") { //then show some tiles
			displayRecon(term);
	
		} else { //then show the list
			displayReconList(term);
		}

	});
*/
//activate Recon Network Controls - tabs
$("ul.post-type-select li.change").click(function(){
	
	var postType = $(this).attr('title');
	
	currentDisplayStart = 0;
	if (postType == "report" || postType == "general" || postType == "tip" || postType == "lifestyle"){
		displayMode = "list";
	}else{
		displayMode = "tile";
	}
	
	
	if (displayMode == "tile") { //then show some tiles
		displayRecon(postType);

	} else { //then show the list
		displayReconList(postType);
		
	}

	$("ul.post-type-select li.selected").removeClass("selected");
	$(this).addClass("selected");	
});
// recent posts tab on user profile page
$("ul.post-type-select li.user-profile").click(function(){
	
	var userID = $(this).attr('user');
	var display = $(this).attr('display');
	
	currentDisplayStart = 0;
	if (display == "recent") { 
		displayUserPosts(userID);
	}else{ 
		displayUserComments(userID);
	}

	$("ul.post-type-select li.selected").removeClass("selected");
	$(this).addClass("selected");	
});



//activate Recon Network Controls - more button
$("#more-superposts-button").click(function(){
	
	var postType = $("ul.post-type-select li.selected").attr("title");
	currentDisplayStart += displayAtOnce;
	if (displayMode == "tile") { //then show some tiles
		postType = "all";
		displayRecon(postType);

	} else { //then show the list
		displayReconList(postType);
	}

});

//activate Recon Network Controls - more button for community pages
$("#more-community-button").click(function(){
	
	var postType = $(".page-community #recon-activity").attr("term");
	currentDisplayStart += displayAtOnce;
	
	displayReconList(postType);


});

	

//activate Recon Network Controls - Toggle Display Button
$("#toggle-display-button").click(function(){

	currentDisplayStart = 0;
	var postType = $("ul.post-type-select li.selected").attr("title");

	if (displayMode == "tile") { //then switch to list mode
		displayReconList(postType);
		displayMode = "list";
	} else { //then switch to tile mode
		displayRecon(postType);
		displayMode = "tile";
	}
	
});

//activate Recon Network Controls - Toggle List Button
$("#toggle-list").click(function(){

	currentDisplayStart = 0;
	$("#toggle-tile").removeClass("tile-on").addClass("tile-off");
	$("#toggle-list").removeClass("list-off").addClass("list-on");
	var postType = $("ul.post-type-select li.selected").attr("title");

		displayReconList(postType);
		displayMode = "list";
	
});

//activate Recon Network Controls - Toggle Tile Button
$("#toggle-tile").click(function(){

	currentDisplayStart = 0;
	$("#toggle-tile").removeClass("tile-off").addClass("tile-on");
	$("#toggle-list").removeClass("list-on").addClass("list-off");
	var postType = $("ul.post-type-select li.selected").attr("title");
	
		displayRecon(postType);
		displayMode = "tile";
	
	
});

//Hide popup elements on click
$(document).click(function() {
    $(".user-details-box").fadeOut(10);
});


//Display the recon!
function displayRecon(type) {
	//var photo = $("#recon-activity").attr("photo");
	//Hide posts before the AJAX Request
	$('#recon-activity').fadeOut(100);

	if (currentDisplayStart == 0) {
		$("#recon-activity").html("");
	}
	
	
	if ($("#recon-activity").attr("state") !== undefined){
		var dataURL = "/slim/api/superpost/state/" + state + "/type/" + type;  	
	}else{
		var dataURL = "/slim/api/superpost/photos/" + type;   	
	}
		
	dataURL += "/" + displayAtOnce;
	dataURL += "/" + currentDisplayStart;

    var getdata = $.getJSON(dataURL, function(data) {
    
    	if(data.length > 0){
	    	$("#no-activity").hide();
	    }else if(data.length > displayAtOnce){
	    	$("#more-community-button").show();
	    }
	    //console.log(data.length);
	    var count = 0;
	    $(data).each(function(index,post) {
	    	count++;
	    
	    	//console.log(post);
	    	
	    	var url = "/plus/" + post.post_type + "/" + post.id;
	        var link = $("<a href='" + url + "'>");

	        var randomnumber=Math.floor(Math.random()*3); //Get randomColor
	        
	        if (post.display_name)
	        	var firstName = post.display_name.split(" ")[0];
	        else {
		        var firstName = post.username;
		        post.display_name = post.username;
	        }
	        	
	        	
	        var nicePostType = "General Discussion";
	        if (topicKey[post.post_type]) {
		        nicePostType = topicKey[post.post_type];
	        } else {
		        nicePostType = post.post_type;
	        }
	    					
	    	//*********************START LACONIC $reconBox********************
	    	
				var reconBox = 	    	
				$.el.div({'class':'recon-box masonry-box masonry-brick','id':'recon-box-' + post.id},
					$.el.a({'class':'flag-button'},
						$.el.img({'src':'/wp-content/themes/imo-mags-northamericanwhitetail/img/flag-button-gray.png','class':'flag-image'})
					),					
					

					$.el.a({'href':url},
						$.el.div({'class':'recon-title-box cover-pic'},
							//$.el.span({'class':'recon-title-detail'},firstName + "'s " + nicePostType),
							//$.el.div({'class':'arrow_box'}),
							$.el.h3(post.title)
						)
					),
					$.el.a({'href':url},
						$.el.div({'class':'detector-box'})
					),
					$.el.div({'class':'recon-image-box','style':'background-color:' + bgcolors[randomnumber]},
						$.el.a({'href':url},
							$.el.img({'src':post.img_url,'class':'superpost-thumb'})
						)
					),
					$.el.div({'class':'under-box'},
						$.el.a({'href':'/profile/' + post.username},
							$.el.img({'src':'/avatar?uid=' + post.user_id,'class':'recon-gravatar'}),
							$.el.div({'class':'recon-author-info'},
								$.el.span({'class':'author-name'},post.display_name),
								" posted in ",
								$.el.span({'class':'author-action'},nicePostType)
								
							)
						),
						
						$.el.abbr({'class':'recon-date timeago','title':post.created}),
						$.el.a({'href':url},
							$.el.span({'class':'comment-count'}, post.comment_count + " Replies"),
							" • ",
							$.el.span({'class':'point-count'},post.score + " Points")
						)
					)		
				);
	

//console.log(reconBox);


			//*********************END LACONIC $reconBox********************
			//*********************ADD jQuery EVENTS to $reconBox********************
			var $reconBox = $(reconBox);
			
			

			//Add editor tools
			if (userIMO.perms == "editor") {		
				var $editorTools = $(
					$.el.select({'class':'editor-functions'},
						$.el.option("EDITOR OPTIONS"),
						$.el.option({'value':'unapprove'},"Unapprove"),
						$.el.option({'value':'teflon'},"Teflon")
					)
				);		
				
				$editorTools.change(function(){
					var etype = $editorTools.val();
					
					$reconBox = $(this).closest(".recon-box");
					
					var postData = userIMO;
					
					postData.post_id = $reconBox.data("post_id");
					postData.etype = etype;
					
					if (etype == "unapprove")
						$reconBox.find(".flag-image").attr("src","/wp-content/themes/imo-mags-northamericanwhitetail/img/flag-button-red.png");
					
					
					$.post("/slim/api/post/flagadmin", postData, function(data){
						
						if (data.error) {
							alert(data.error);
						}				
					});  
				});	
				$reconBox.find(".detector-box").prepend($editorTools);
				//End editor tools
				
				
			}
			
			
			
			//Add data so that we can flag later
			$reconBox.data("post_id",post.id);
			
			//If there is no picture, remove the <img>
			if (!post.img_url)
				$reconBox.find("img.superpost-thumb").remove();
			
			
			//Add hover effects
			$reconBox.find("div.detector-box").hover(function(){
	        	if (post.img_url) {
	        		$(this).parent().parent().find(".recon-title-box").stop().fadeToggle();
	        	}


	        });
	        
	        //Add Flag Reporting
	        //isset($params['post_id']) && isset($params['etype']) && isset($params['user_id']
	        $reconBox.find(".flag-button").click(function(){
		    	if (confirm("Are you sure you want to flag this post as inappropriate?")) { 
			    	$reconBox = $(this).closest(".recon-box");
			    	$.post("/slim//api/post/flag", { post_id: $reconBox.data("post_id"), etype: "flag", user_id: userIMO.user_id } );  	
			    	//$reconBox.fadeOut();
			    	$reconBox.find(".flag-image").attr("src","/wp-content/themes/imo-mags-northamericanwhitetail/img/flag-button-red.png");
			}
		        
	        });

			//gravatar.data('user_id',post.user_id);
			
			//Append the Laconic reconBox
	        $("#recon-activity").append($reconBox);

	        if ($(data).length == count) {
	        
	        	$('#recon-activity').fadeIn();
	        
	        	beforeImageLoaded();
	        		        
	            $("#recon-activity").imagesLoaded( function(){

	            	//afterImageLoaded();
	                
	            });
	        }
	        
	    });

	});

} //End function displayRecon()


//Display the User Posts!
function displayUserPosts(userID) {

	if (currentDisplayStart == 0) {
		$("#user-activity").html("");
	}
		
	
	var dataURL = "/slim/api/superpost/user/posts/" + userID;  	

    var getdata = $.getJSON(dataURL, function(data) {
    
	    //$(".animal-container").html("");
	    if(data.length < 1){
	    	$("#no-activity").show();
	    }else{
		    $("#no-activity").fadeOut();
	    }
	    var count = 0;
	    
	    $(data).each(function(index) {
	        count++;
	        
	        var url = "/plus/" + this.post_type + "/" + this.id;
	        var link = $("<a href='" + url + "'>");

	        var randomnumber=Math.floor(Math.random()*3); //Get randomColor
	        var reconBox = $("<div class='recon-box masonry-box' id='recon-box-" + this.id +  "'></div>");
	        var imageBox = $("<div class='recon-image-box'></div>").css("background-color",bgcolors[randomnumber]);;
	        var image = $("<img class='superpost-thumb'>").attr("src",this.img_url);
	        var titleBox = $("<div class='recon-title-box'></div>")
	        var detectorBox = $("<div class='detector-box'></div>")
	        var titleDetailBox = $("<span class='recon-title-detail'></span>").text(this.display_name + "'s " + this.post_type);
	        var title = $("<h3></h3>").text(this.title);
	        var underBox = $("<div class='under-box'></div>");
	        var gravatar = $("<img class='recon-gravatar'>").attr("src","/avatar?uid=" + this.user_id);
	        var authorInfo = $("<div class='recon-author-info'><span class='author-name'></span><span class='author-action'></span></div>");
	        authorInfo.find(".author-name").text(this.display_name);
	        authorInfo.find(".author-action").text(" posted in " + capitaliseFirstLetter(this.post_type));
	        var underTitle = $("<div class='under-title'></div>").html("<a href='" + url + "'>" + this.title + "</a>");
	        var date = $("<abbr class='recon-date timeago' title=''></abbr>").attr("title",this.created);
	        var imgUrl =  this.img_url;

	        //Userpopup stuff
	        var userDetailsBox = $("<div class='user-details-box' style='display:none'></div>");
			var nameBox = $("<div class='name-box'></div>").text(this.username);
			var statsBox = $("<div class='stats-box'></div>");
			userDetailsBox.append(nameBox);
			userDetailsBox.append(statsBox);

			//Store some user data so that we can retrieve it later on hover
	        gravatar.data('user_id',this.user_id);
	        gravatar.data('username',this.username);

	        //titleBox.append(titleDetailBox);
	        titleBox.append(title);





	        if (this.img_url) {
	   			
	   			link.append(image);
	        	imageBox.append(link);
	        	
	        
	        }

	        
	        underBox.append(userDetailsBox);
	        underBox.append(gravatar);
	        underBox.append(authorInfo);
	        if(this.post_type != "question"){
		        underBox.append(underTitle);
	        }
	        
	        underBox.append(date);

	        detectorBox.hover(function(){
	        	if (imgUrl) {
	        		$(this).parent().parent().find(".recon-title-box").stop().fadeToggle();
	        	}
	        	

	        });


	        if (this.post_type != "photo" && this.post_type != "video") {
	        	link = $("<a href='" + url + "'>");
	        	reconBox.append(link)
	        	link.append(titleBox);

	        	link = $("<a href='" + url + "'>");

	        	reconBox.append(link);
	        	link.append(detectorBox);
	        }

	        if (this.img_url != null && this.title != null) {
	        	titleBox.addClass("cover-pic");
	        }

	      	

	        reconBox.append(imageBox);
	        reconBox.append(underBox);
	        
	        //Add data so that we can flag later
			reconBox.data("post_id",this.id);
	        
	        //Add editor tools
			if (userIMO.perms == "editor") {		
				var $editorTools = $(
					$.el.select({'class':'editor-functions'},
						$.el.option("EDITOR OPTIONS"),
						$.el.option({'value':'unapprove'},"Unapprove"),
						$.el.option({'value':'teflon'},"Teflon")
					)
				);		
				
				$editorTools.change(function(){
					var etype = $editorTools.val();
					
					$reconBox = $(this).closest(".recon-box");
					
					var postData = userIMO;
					
					postData.post_id = $reconBox.data("post_id");
					postData.etype = etype;
					
					if (etype == "unapprove")
						$reconBox.find(".flag-image").attr("src","/wp-content/themes/imo-mags-northamericanwhitetail/img/flag-button-red.png");
					
					
					$.post("/slim/api/post/flagadmin", postData, function(data){
						
						if (data.error) {
							alert(data.error);
						}				
					});  
				});	
				
				reconBox.find(".detector-box").prepend($editorTools);
			}
			//End editor tools

	        $("#user-activity").append(reconBox);

	        if ($(data).length == count) {
	        
	            $("#user-activity").imagesLoaded( function(){

	            	afterImageLoaded();
	                
	            });
	        }
	    });

	});

} //End function displayUserPosts()

function beforeImageLoaded() {
	
	afterImageLoaded(false);
}


function afterImageLoaded(animated) {

	 if(typeof animated === 'undefined'){//If animated is not specified
		 var animated = true;
   	};
	//Add relative time
	jQuery("abbr.timeago").timeago();

	var masonryColumnWidth = 338;
	var masonryGutterWidth = 3;
	var masonryItemSelector = ".recon-box";

	if (displayMode == "list") {
		if (widthMode="short"){
			masonryColumnWidth = 636;
		}else{
			masonryColumnWidth = 1000;
		}
		masonryGutterWidth = 0;
		masonryItemSelector = ".recon-row";

	}
    //reset masonry
    if ($('#recon-activity').hasClass("masonry")) {
    	$('#recon-activity').masonry( 'option', { columnWidth: masonryColumnWidth, gutterWidth: masonryGutterWidth, itemSelector:masonryItemSelector } )
    	$('#recon-activity').masonry('reload');
    } else {
    	$('#recon-activity').masonry({
        	columnWidth: masonryColumnWidth,
        	gutterWidth: masonryGutterWidth,
            itemSelector: masonryItemSelector,
            isAnimated: animated,
    });
    	
    }
    //reset masonry for user profile
    if ($('#user-activity').hasClass("masonry")) {
    	$('#user-activity').masonry( 'option', { columnWidth: masonryColumnWidth, gutterWidth: masonryGutterWidth, itemSelector:masonryItemSelector } )
    	$('#user-activity').masonry('reload');
    } else {
    	$('#user-activity').masonry({
        	columnWidth: masonryColumnWidth,
        	gutterWidth: masonryGutterWidth,
            itemSelector: masonryItemSelector,
            isAnimated: animated,
    });
    	
    }


	//Show user info on avatar hover
	//not going to make launch
/*
	$("img.recon-gravatar").click(function(e){
		e.stopPropagation();
		
		var UnderBox = $(this).closest(".under-box");

		UnderBox.find(".user-details-box").toggle(300);
		UnderBox.find(".stats-box").html("");

		var user_id = $(this).data("user_id");
		var username = $(this).data("username");

		var dataURL = "/slim/api/superpost/user/counts/" + user_id;  	
	    var getdata = $.getJSON(dataURL, function(data) {
	    	
	    	var countData = new Array();

	    	$(data).each(function(){
	    		countData[this.post_type] = this.count;
	    	});


	    	types = new Array("photo","report","tip","video","comment","discussion","question","answer");

	    	$(types).each(function(){
	    		var type = this;

	    		var typeCount = countData[type];
	    		if (typeCount === undefined) {
	    			typeCount = 0;
	    		}

	    		var statBox = $("<div class='stat-box'></div>").text(typeCount + " " + type + "s");
	    		UnderBox.find(".stats-box").append(statBox);

	    	});
		
	    });

		//userDetailsBox.append(nameBox);


	});
*/

}




function displayReconList(type) {

	if (currentDisplayStart == 0) {
		$("#recon-activity").html("");
	}
		
	if ($("#recon-activity").attr("state") !== undefined){
		var dataURL = "/slim/api/superpost/state/" + state + "/type/" + type;  	
	}else{
		var dataURL = "/slim/api/superpost/type/" + type;  	
	}
	dataURL += "/" + displayAtOnce;
	dataURL += "/" + currentDisplayStart;



    var getdata = $.getJSON(dataURL, function(data) {
    	if(data.length > 0){
	    	$("#no-activity").hide();
	    }else if(data.length > displayAtOnce){
	    	$("#more-community-button").show();
	    }

	    //$(".animal-container").html("");
	    
	    var count = 0;
	    $(data).each(function(index) {
	        count++;
	        //console.log(data);
	        //usables: this.id, this.username, this.img_url, this.post_type,

	        var gravatar = $("<img class='recon-gravatar'>").attr("src","http://www.gravatar.com/avatar/" + this.gravatar_hash + ".jpg?s=50&d=identicon");
	        var authorInfo = $("<div class='recon-author-info'><span class='author-name'></span><span class='author-action'></span></div>");
	        authorInfo.find(".author-name").text(this.username);
	        authorInfo.find(".author-action").text(" posted in " + capitaliseFirstLetter(this.post_type));
	        var underBox = $("<div class='under-box'></div>");
	        var date = $("<abbr class='recon-date timeago' title=''></abbr>").attr("title",this.created);

	        var url = "/plus/" + this.post_type + "/" + this.id;

	        
	        var image = $("<a href='" + url + "'><img class='superpost-list-thumb' src='" + this.img_url + "'></a>")


	        //Userpopup stuff
	        var userDetailsBox = $("<div class='user-details-box' style='display:none'></div>");
			var nameBox = $("<div class='name-box'></div>").text(this.username);
			var statsBox = $("<div class='stats-box'></div>");

			var points = parseInt(this.comment_count) + parseInt(this.share_count);
			
			if (!this.display_name) {
				this.display_name = this.username;
			}
			if(this.post_type == "report"){
		    	niceState = stateKey[this.state];
		    	state_url = "<div class='state-type'><a href='/community/report/" + niceState.toLowerCase() + "'>" + niceState + "</a></div>"
		    
		    }else{
			    state_url = "";
		    }
			
			//underBox.append(date);	
			//var $avatar $("<img class='recon-gravatar'>").attr("src","avatar?uid=" + this.user_id);
			var category_type = " in <a href=/question/'>" + this.secondary_post_type + "</a>";
			var reconRow = $("\
				<div class='recon-row masonry-box'>\
					<ul>\
						<li>\
							<div class='row-info'>\
								" + state_url + "\
								<div class='row-title'><a href='" + url + "'>" + this.title + "</a></div>\
							</div>\
						</li>\
												<li class='user-avatar'><a href='/profile/" + this.username + "'><img src='/avatar?uid=" + this.user_id + "' alt='User Avatar' /></a> by <a href='/profile/" + this.username + "'>" + this.display_name + "</a></li>\
												<li class='count-field'><a href='" + url + "/#comments'>" + this.comment_count + " Replies</a></li>\
						<li class='count-field'><abbr class='timeago' title='" + this.created + "'>" + this.created + "</abbr></li>\
						<li class='count-field'>" + this.view_count + " Views</li>\
												<li class='count-field'>" + points + " Points</li>\
												</ul>\
						<div class='list-footer'>\
							<div class='list-answer'><a href='" + url + "'>Reply</a></div>\
							<div class='list-flag'><a href='#' class='list-flag-button'></a></div>\
						</div>\
				</div>");
				
				
			//Add Flag Reporting
	        //isset($params['post_id']) && isset($params['etype']) && isset($params['user_id']

	        reconRow.data("post_id",this.id);
	        reconRow.find(".list-flag-button").click(function(event){

	        	event.preventDefault();
		    	if (confirm("Are you sure you want to flag this post as inappropriate?")) { 
			    	reconRow = $(this).closest(".recon-row");
			    	$(this).css("background-image","url('/wp-content/themes/imo-mags-northamericanwhitetail/img/red-flag.png')");
			    	$.post("/slim//api/post/flag", { post_id: reconRow.data("post_id"), etype: "flag", user_id: userIMO.user_id } );  	


			    }

	        });
	        
	        
	        
	        //Add data so that we can flag later
			reconRow.data("post_id",this.id);
	        
	        //Add editor tools
			if (userIMO.perms == "editor") {		
				var $editorTools = $(
					$.el.select({'class':'editor-functions'},
						$.el.option("EDITOR OPTIONS"),
						$.el.option({'value':'unapprove'},"Unapprove"),
						$.el.option({'value':'teflon'},"Teflon")
					)
				);		
				
				$editorTools.change(function(){
					var etype = $editorTools.val();
					
					$reconRow = $(this).closest(".recon-row");
					
					var postData = userIMO;
					
					postData.post_id = $reconRow.data("post_id");
					postData.etype = etype;
					
					if (etype == "unapprove")
						$reconRow.find(".list-flag-button").css("background-image","url('/wp-content/themes/imo-mags-northamericanwhitetail/img/red-flag.png')");				
					
					$.post("/slim/api/post/flagadmin", postData, function(data){
						
						if (data.error) {
							alert(data.error);
						}				
					});  
				});	
				
				reconRow.prepend($editorTools);
			}
			//End editor tools
	        
	        
			
			$("#recon-activity").append(reconRow);

			userDetailsBox.append(nameBox);
			userDetailsBox.append(statsBox);


	        //Store some user data so that we can retrieve it later on hover
	        gravatar.data('user_id',this.user_id);
	        gravatar.data('username',this.username);

	 
	        if (this.img_url) {
	        	//imageBox.append(image);
	        	reconRow.find("ul").prepend($("<li class='row-image'>").append(image.width(90)));
	        	
	        } else {
	        	reconRow.find("div.row-info").addClass("no-image");
	        }



	        if ($(data).length == count) {
	            $("#recon-activity").imagesLoaded( function(){

	            	$(".recon-row:odd").addClass("odd");
	            	afterImageLoaded();
	                
	            });
	        }
	        
	    });

	});

} //End function displayReconList()


function displayUserComments(userID) {

	if (currentDisplayStart == 0) {
		$("#user-activity").html("");
	}
		

	var dataURL = "/slim/api/superpost/user/comments/" + userID;  	

    var getdata = $.getJSON(dataURL, function(data) {
    
	    //$(".animal-container").html("");
	    if(data.length < 1){
	    	$("#no-activity").show();
	    }else{
		    $("#no-activity").fadeOut();
	    }
	    var count = 0;
	    $(data).each(function(index) {
	        count++;

	        //usables: posts.id, comment_body, rent_type, date, shares, parent.post_type, parent_id
	        //console.log(data);
	        var gravatar = $("<img class='recon-gravatar'>").attr("src","http://www.gravatar.com/avatar/" + this.gravatar_hash + ".jpg?s=50&d=identicon");
	        var authorInfo = $("<div class='recon-author-info'><span class='author-name'></span><span class='author-action'></span></div>");
	        authorInfo.find(".author-name").text(this.username);
	        authorInfo.find(".author-action").text(" posted in " + capitaliseFirstLetter(this.rent_type));

	        var reply_date = $("<abbr class='recon-date timeago' title=''></abbr>").attr("title",this.date);

	        var image = $("<img class='superpost-list-thumb'>").attr("src",this.img_url);
	        var url = "/plus/" + this.rent_type + "/" + this.parent_id;


	        //Userpopup stuff
	        var userDetailsBox = $("<div class='user-details-box' style='display:none'></div>");
			var nameBox = $("<div class='name-box'></div>").text(this.username);
			var statsBox = $("<div class='stats-box'></div>");

			var points = parseInt(this.comment_count) + parseInt(this.shares);
			if (this.comment_body.length > 160){
				encoded = this.comment_body.substring(0, 160);
				encoded += "...";
			}else{
				encoded = this.comment_body;
			}
			
			var nicePostType = "General Discussion";
	        if (topicKey[this.rent_type]) {
		        nicePostType = topicKey[this.rent_type];
	        } else {
		        nicePostType = this.rent_type;
	        }

			
			var reconRow = $("\
				<div class='recon-row masonry-box'>\
					<ul>\
						<li>\
							<div class='row-info'>\
								<div class='row-title'><a href='" + url + "'>" + encoded + "</a></div>\
							</div>\
						</li>\
						<li class='first count-field'>Replied to <a href='/plus/" + this.rent_type + "/" + this.parent_id + "'>" + this.post_title + "</a> in <a href='/community/" + this.rent_type + "'>" + nicePostType + "</a></li>\
						<li class='count-field'><abbr class='timeago' title='" + this.date + "'></abbr></li>\
					</ul>\
				</div>");

			$("#user-activity").append(reconRow);

			userDetailsBox.append(nameBox);
			userDetailsBox.append(statsBox);


	        //Store some user data so that we can retrieve it later on hover
	        gravatar.data('user_id',this.user_id);
	        gravatar.data('username',this.username);

	 
	        if (this.img_url) {
	        	//imageBox.append(image);
	        	reconRow.find("ul").prepend($("<li class='row-image'>").append(image.width(90)));
	        	
	        } else {
	        	reconRow.find("div.row-info").addClass("no-image");
	        }

	        // Quick fix to make sure it gets displayed correctly on tab click
	        displayMode = "list";
	        if ($(data).length == count) {
	            $("#user-activity").imagesLoaded( function(){

	            	$(".recon-row:odd").addClass("odd");
	            	afterImageLoaded();
	            	//set back to tile for future tab click
	            	displayMode = "tile";
	                
	            });
	        }
	        
	    });

	});

} //End function displayUserComments()



function capitaliseFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}

// Questions display
$(document).ready(function(){
	var type = "question";
	showAtOnce = 10;
	var dataURL = "/slim/api/superpost/type/" + type +"/" + showAtOnce + "/0";  	
	var getdata = $.getJSON(dataURL, function(data) {
		
		var $questionTemplate;
				
		$.each(data, function(index, question) { 
			$questionTemplate = $("ul#slides-questions li").eq(index);
			var url = "/plus/question/" + question.id;
			var gravatar = $questionTemplate.find(".user-info img").attr("src","/avatar?uid=" + question.user_id);
			if(question.display_name){
				$questionTemplate.find(".user-info a.username").text(question.display_name); 
			}else{
				$questionTemplate.find(".user-info a.username").text(question.username); 
			}
			$questionTemplate.find(".user-info a.username").text(question.display_name); 
			$questionTemplate.find(".user-info a").attr("href","/profile/" + question.username);
			
			$questionTemplate.find("h4.quote a").text(question.title).attr("href",url);
			$questionTemplate.find(".answers-count a").attr("href",url + "/#comments");
			$questionTemplate.find("a.answers-link").attr("href",url);
			$questionTemplate.find(".count a").text(question.comment_count);
			$questionTemplate.find("span.count").text(question.comment_count);

		});	
		if (typeof $questionTemplate != "undefined") 				
			$questionTemplate.appendTo(".questions-feed").fadeIn();
	});

}); //End display questions
	
// Questions List Widget	
$(document).ready(function(){

	

	var type = "question";
	showAtOnce = 5;
	var dataURL = "/slim/api/superpost/type/" + type +"/" + showAtOnce + "/0";  	
	var getdata = $.getJSON(dataURL, function(data) {
		
		var $questionTemplate;
				
		$.each(data, function(index, question) { 
		//console.log(question);
			var url = "/plus/question/" + question.id;
			$questionTemplate = $("#questions-list-widget .loop ul").eq(index);
			$questionTemplate.find("a").attr("href",url);
			if (question.img_url) {
				$questionTemplate.find("li.img img").attr("src",question.img_url);
			}else{
				$questionTemplate.find("li.img img").hide();
			}
			$questionTemplate.find("li.title a").text(question.title);
			$questionTemplate.find("li.replies").text(question.comment_count + " Replies");
			
			
		});	
		
		if (typeof $questionTemplate != "undefined") 		
			$questionTemplate.appendTo("#questions-list-widget");
		$("#questions-list-widget").fadeIn();
	
	});
	
	

}); //End list questions


// Sidebar slider display
$(document).ready(function(){
	var type = "all";
	showAtOnce = 12;
	var dataURL = "/slim/api/superpost/views/" + type +"/" + showAtOnce + "/0";  	
	var getdata = $.getJSON(dataURL, function(data) {
		
		var $questionTemplate;
		
		$.each(data, function(index, all) { 
				$questionTemplate = $("ul#scroll-widget li").eq(index);
				$questionTemplate.find("a").attr("href","/plus/" + all.post_type + "/" + all.id);
				$questionTemplate.find("img").attr("src",all.img_url);
				$questionTemplate.find("span").text(all.view_count + " Views");
		});							
	$questionTemplate.appendTo("ul#scroll-widget.scroll").fadeIn();	
	});

}); //End 



// Sidebar grid display
$(document).ready(function(){
	var type = "all";
	showAtOnce = 9;
	var dataURL = "/slim/api/superpost/views/" + type +"/" + showAtOnce + "/0";  	
	var getdata = $.getJSON(dataURL, function(data) {

		var $questionTemplate;
		
		$.each(data, function(index, all) { 
			////console.log(index);
			////console.log(all);
				$questionTemplate = $("ul.thumbs-grid li").eq(index);
				$questionTemplate.find("a").attr("href","/plus/" + all.post_type + "/" + all.id);
				$questionTemplate.find("img").attr("src",all.img_url);
				$questionTemplate.find("span").text(all.view_count + " Views");
		
		});							
	$questionTemplate.appendTo("ul.thumbs-grid").fadeIn();	
	});

}); //End 

// join widget email slide down
$("#join .email-signup").click(function(){
	$("#join form.join-form").slideDown();
});



});//End doc Ready