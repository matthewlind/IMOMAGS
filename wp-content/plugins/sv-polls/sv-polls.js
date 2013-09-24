jQuery(document).ready(function() {


	var domain = "www.sportsmenvote.com";

	//if we are not on .com, use dev domain instead
	if (document.domain.indexOf(".deva") != -1) {
		domain = "www.sportsmenvote.deva";
	}
	if (document.domain.indexOf(".fox") != -1) {
		domain = "www.sportsmenvote.fox";
	}
	if (document.domain.indexOf(".salah") != -1) {
		domain = "www.sportsmenvote.salah";
	}




	$(".sv-poll-container").each(function(index,pollContainer){

		var $pollContainer = $(pollContainer);
		var pollPostID = $pollContainer.attr("poll-post-id");

		var pollPostURL = "http://" + domain + "/wp-content/plugins/imo-wp-polls-ajax/imo-wp-polls-ajax.php?ajax_pollpost=" + pollPostID;

		//Get Poll Data & diplay poll
		$.getJSON(pollPostURL, function(pollData){


			var pollPostData = pollData.poll_post;
			var questionData = pollData.poll_question;
			var answersData = pollData.poll_answers;

			//Show the question
			$pollContainer.find("h1.poll-question").text(questionData.pollq_question);
			$pollContainer.find(".poll-comment-count").text(pollPostData.comment_count);

			$pollContainer.find(".poll-link").attr("href",'http://www.sportsmenvote.com/polls?pollID=' + questionData.pollq_id);

			//Sharing

			var sharingContainerID = $pollContainer.find(".sharing-links").attr("id");
			var sharingContainerSelector = "#" + sharingContainerID;

			var addThisToolboxContainer = document.getElementById(sharingContainerID);


			addThisToolboxContainer.innerHTML += '<a class="addthis_button_facebook_like"></a>';
			addThisToolboxContainer.innerHTML += '<a class="addthis_button_tweet"></a>';

			addthis.toolbox(sharingContainerSelector,{}, {url: 'http://www.sportsmenvote.com/polls?pollID=' + questionData.pollq_id, title: questionData.pollq_question});

			//addthis.toolbox(sharingContainerSelector, {}, {url: 'http://www.sportsmenvote.com/polls?pollID=' + questionData.pollq_id, title: questionData.pollq_question});



			//var $sharingButtons = $("<div addthis:url='http://www.sportsmenvote.com/polls?pollID=" + questionData.pollq_id + "' addthis:title='" + questionData.pollq_question + "' class='addthis_toolbox addthis_default_style '><a class='addthis_button_facebook_like'fb:like:layout='button_count'></a></div>");

			//$pollContainer.find(".sharing-links").append($sharingButtons);



			//$pollContainer.find(".sharing-links").append("<script type='text/javascript' src='http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4de0e5f24e016c81'></script>");

			// var addThisScript   = document.createElement("script");
			// addThisScript.type  = "text/javascript";
			// addThisScript.src   = "http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4de0e5f24e016c81";
			//document.body.appendChild(addThisScript);



			//Show the answers
			$.each(answersData, function(index,answerData){



				var $answerListClone = $("<li class='clone-answer' style='display:none'><input type='radio' name='answer' value='male' id='radio1'><label for='radio1' class='radio-label'>No. Those people are paranoid and silly. Just Silly.</label></li>");
				$answerListClone.attr("id","answer" + answerData.polla_aid);
				$answerListClone.find("input").attr("value",answerData.polla_aid);
				$answerListClone.find("input").attr("id","ans" + answerData.polla_aid);
				$answerListClone.find("label").text(answerData.polla_answers);
				$answerListClone.find("label").attr("for","ans" + answerData.polla_aid);




				$answerListClone.show();



				var pollAnswersContainer = $pollContainer.find(".poll-answers");



				pollAnswersContainer.append($answerListClone);


			});

			//Handle form submission
			var $pollForm = $pollContainer.find("form");




			$pollForm.submit(function(ev){
				ev.preventDefault();


				//set the height of the container so that the animation is less jarring
				var pollListHeight = $pollContainer.find(".poll-answers-container").height();
				$pollContainer.find(".poll-answers-container").css("min-height",pollListHeight + "px");

				var submitPostURL = "http://" + domain + "/wp-content/plugins/imo-wp-polls-ajax/imo-wp-polls-ajax.php";

				var selectedAnswerID = $(pollContainer).find("input[type='radio']:checked").val();

				var submissionData = {
					ajax_vote: true,
					poll_id: questionData.pollq_id,
					poll_answer_id: selectedAnswerID

				};

				$(pollContainer).find("ul.poll-answers").fadeOut(function(){
					$(pollContainer).find("ul.poll-answers").html("");
				});


				$(pollContainer).find("input.poll-vote-button").fadeOut();
				$(pollContainer).find("ul.poll-answers").removeClass("unanswered");


				$(pollContainer).find(".poll-sponsor").css("display","block").css("margin-top","10px").appendTo($(pollContainer).find(".poll-stats"));

				$.post(submitPostURL, submissionData, function(pollData){


					$(pollContainer).find("ul.poll-answers").addClass("answered");

					$.each(pollData.poll_answers, function(index,answerData){


						var $answerListClone = $("<li><div class='percent-bar-container'><span class='percent-bar'></span></div><div class='answer'><span class='percent'>23</span><span class='bar'>% - </span><span class='answer-text'>Cheesecake is neither cheese nor cake: Discuss.</span></div></li>");
						$answerListClone.find(".answer-text").text(answerData.polla_answers);
						$answerListClone.find(".percent").text(answerData.percent);

						$answerListClone.find(".percent-bar").css("width",answerData.percent + "%");

						$(pollContainer).find("ul.poll-answers").append($answerListClone);




					});


					$(pollContainer).find(".poll-stats").slideDown();




					$(pollContainer).find(".poll-total-votes").text(pollData.poll_question.pollq_totalvotes);

					$(pollContainer).find("ul.poll-answers").fadeIn();




				});




			});




		});










	});







});