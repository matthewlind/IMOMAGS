jQuery(document).ready(function () {
	//jQuery(".open-menu").click(function(){
		//jQuery(".snap-drawer-left").show();
	//});

	//*******************************************************
	//****************** UPLOAD COMMUNITY IMAGES **********************
	//*******************************************************
	jQuery(".common-image-upload").change(function(ev){//After the user selects a file

		var fileInput = ev.currentTarget;

		if (!fileInput.value) {
			//If they don't select anything... Do nothing
		    //console.log("Choose an Image to upload.");
		} else {

			jQuery('#progressBar').fadeIn();

			filepicker.setKey('ANCtGPesfQI6nKja0ipqBz');

			jQuery('#loadingModal').modal();

		    filepicker.store(fileInput, function(FPFile){//Begin the upload

		            var img_url = FPFile.url;

		            var n = img_url.lastIndexOf('/');
					var FPID = img_url.substring(n + 1);


					//alert(FPID);

					jQuery('#loadingModal').append("<img src='" + img_url + "' width=1 height=1>");

					document.location = "/photos/new#" + FPID;
					//alert(FPID);



		        }, function(FPError) {
		            //console.log(FPError.toString());
		        }, function(progress) {
		        	//upload progress
		            //console.log("Loading: "+progress+"%");//PROGRESS INDICATOR!!!!!

		            //progress bar
		            jQuery('#progressBar div').css("width",progress*3 + "px");
		            jQuery('#progressBar span').text(""+progress+"%");

		        }
		   );

		}
	});

});