jQuery(document).ready(function($) {

var bgcolors = new Array("#403b35","#c65517","#829b40");


//Make sure we should run all of this stuff
if ($("#recon-activity").length > 0){

	displayRecon("all");
}

//activate Recon Network Controls
$("ul.post-type-select li").click(function(){
	
	var postType = $(this).attr('title');

	displayRecon(postType);
	$("ul.post-type-select li.selected").removeClass("selected");
	$(this).addClass("selected");	
});


//Hide popup elements on click
$(document).click(function() {
    $(".user-details-box").fadeOut();
});


//Display the recon!
function displayRecon(type) {

	$("#recon-activity").html("");	

	var dataURL = "http://www.imomags.deva/slim/api/superpost/type/" + type;  	

    var getdata = $.getJSON(dataURL, function(data) {
    
	    //$(".animal-container").html("");
	    
	    var count = 0;
	    $(data).each(function(index) {
	        count++;

	        var randomnumber=Math.floor(Math.random()*3); //Get randomColor
	        var reconBox = $("<div class='recon-box masonry-box' id='recon-box-" + this.id +  "'></div>");
	        var imageBox = $("<div class='recon-image-box'></div>").css("background-color",bgcolors[randomnumber]);;
	        var image = $("<img class='superpost-thumb'>").attr("src",this.img_url);
	        var titleBox = $("<div class='recon-title-box'></div>")
	        var titleDetailBox = $("<span class='recon-title-detail'></span>").text(this.username + "'s " + this.post_type);
	        var title = $("<h3></h3>").text(this.title);
	        var underBox = $("<div class='under-box'></div>");
	        var gravatar = $("<img class='recon-gravatar'>").attr("src","http://www.gravatar.com/avatar/" + this.gravatar_hash + ".jpg?s=50&d=identicon");
	        var authorInfo = $("<div class='recon-author-info'><span class='author-name'></span><span class='author-action'></span></div>");
	        authorInfo.find(".author-name").text(this.username);
	        authorInfo.find(".author-action").text(" posted a " + capitaliseFirstLetter(this.post_type));
	        var underTitle = $("<div class='under-title'></div>").html(this.title);
	        var date = $("<abbr class='recon-date timeago' title=''></abbr>").attr("title",this.created);


	        //Userpopup stuff
	        var userDetailsBox = $("<div class='user-details-box' style='display:none'></div>");
			var nameBox = $("<div class='name-box'></div>").text(this.username);
			var statsBox = $("<div class='stats-box'></div>");
			userDetailsBox.append(nameBox);
			userDetailsBox.append(statsBox);


	        gravatar.data('user_id',this.user_id);
	        gravatar.data('username',this.username);

	        titleBox.append(titleDetailBox);
	        titleBox.append(title);
	        imageBox.append(image);
	        underBox.append(userDetailsBox);
	        underBox.append(gravatar);
	        underBox.append(authorInfo);
	        underBox.append(underTitle);
	        underBox.append(date);


	        if (this.post_type != "photo" && this.post_type != "video") {
	        	reconBox.append(titleBox);
	        }

	        if (this.img_url != null && this.post_type == 'report') {
	        	titleBox.addClass("cover-pic");
	        }
	        

	        reconBox.append(imageBox);
	        reconBox.append(underBox);

	        $("#recon-activity").append(reconBox);

	        if ($(data).length == count) {
	            $("#recon-activity").imagesLoaded( function(){

	            	afterImageLoaded()
	                
	            });
	        }
	        
	    });

	});

} //End function displayRecon()



function afterImageLoaded() {
	
	//Add relative time
	jQuery("abbr.timeago").timeago();

    //reset masonry
    if ($('#recon-activity').hasClass("masonry")) {
    	$('#recon-activity').masonry('reload');
    } else {
    	$('#recon-activity').masonry({
        	columnWidth: 338,
        	gutterWidth: 3,
            itemSelector: '.recon-box',
            isAnimated: true,
    	});
    }


	//Show user info on avatar hover
	$("img.recon-gravatar").click(function(e){
		e.stopPropagation();
		
		var UnderBox = $(this).closest(".under-box");

		UnderBox.find(".user-details-box").toggle(300);
		UnderBox.find(".stats-box").html("");

		var user_id = $(this).data("user_id");
		var username = $(this).data("username");

		var dataURL = "http://www.imomags.deva/slim/api/superpost/user/counts/" + user_id;  	
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

}





function capitaliseFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}


	


	


});//End doc Ready