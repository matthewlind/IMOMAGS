<?php

include 'mysql.php';
include 'email_html_creator.php';
include 'postmark.php';

$sentCount = 0;

function generateAndSendEmails($testrun = TRUE) {



	//First query the database for the emails that need to be sent
	$emailDataArray = getEmailData();

	//For each user, grab the HTML and send the email.
	foreach ($emailDataArray as $postUserID => $emailData) {




		if ($emailData['email_comment_count'] > 1 || $emailData['email_share_count'] > 1 || ($emailData['email_comment_count'] == 1) && $emailData['email_share_count'] > 0 ) {//Only send emails if there is more than one event to mention

			$emailHTML = generateEmailHTML($emailData);

			$emailSubject = generateEmailSubject($emailData);


			//Get the FROM Address

			$fromAddress = "NAW Community <community@intermediaoutdoors.com>";

			if (strstr($emailData['domain'],"in-fisherman")) {
				$fromAddress = "Fishhead Photos <community@intermediaoutdoors.com>";
			}



			//print_r($emailData);

			$userEmail = $emailData['email'];



			//echo json_encode($emailData);


			//if user wants to get emails



			if (userEmailPrefs($postUserID)) {

				if ($testrun) {
					echo "<h1 style='background-color:red'>TO: $userEmail <br>SUBJECT:$emailSubject</h1>";
					echo $emailHTML;
				}

				$postmark = new Postmark("2338c32a-e4b3-4a36-a6a6-6ff501f4f614",$fromAddress);

				if (!$testrun) {

					$result = $postmark->to("aaron.baker@imoutdoors.com")
					->subject($emailSubject)
					->html_message($emailHTML)
					->send();

					if ($result) {//If it sent...

						//print_r(array($userEmail,"community@intermediaoutdoors.com",$emailSubject,$emailHTML,$emailData['domain']));

						//Log the results!
						$db = dbConnect();
						$sql = "INSERT into sent_emails (recipient,sender,subject,content,site) VALUES (?,?,?,?,?)";
						$stmt = $db->prepare($sql);
						$stmt->execute(array($userEmail,$fromAddress,$emailSubject,$emailHTML,$emailData['domain']));
						$db = "";

						//AND track the events as being sent
						foreach ($emailData['event_ids'] as $eventID) {

							$db = dbConnect();
							$sql = "UPDATE `events` SET `email_sent` = '1' WHERE `id` = ?;";
							$stmt = $db->prepare($sql);
							$stmt->execute(array($eventID));
							$db = "";
						}

						$sentCount++;

					}
				}
			}





		}


	}

	echo "sentcount: $sentCount";

}


function userEmailPrefs($user_id) {

	$prefs = false;

	$user_id = intval($user_id);

	$sql = "SELECT meta_value FROM imomags.wp_usermeta WHERE meta_key = 'send_community_updates' AND user_id = $user_id";


	$db = dbConnect();

	$stmt = $db->prepare($sql);

	$stmt->execute();


	$prefValue = $stmt->fetchColumn();


	$db = "";

	if ($prefValue == 1) {
		$prefs = true;
	}

	return $prefs;

}


//This function queries the database for all the unsent events and then groups them together by user
//The data for each user will be aggregated into one email
function getEmailData() {
	try {

	$db = dbConnect();


	$sql = "SELECT * FROM unsent_events";

	$stmt = $db->prepare($sql);
	$stmt->execute(array($post_type));

	$events = $stmt->fetchAll(PDO::FETCH_OBJ);

	$emailDataArray = array();

	$highestCommentCount = 0;
	$highestShareCount = 0;

	foreach ($events as $event) {

		//We don't want to notify users about events that they caused
		if ($event->uid != $event->post_user_id) {

			$event->time_ago_string = time_elapsed_string(strtotime($event->timestamp)) . " ago";

			if ($event->domain == "www.northamericanwhitetail.com") {
				$emailDataArray[$event->post_user_id]['logo_url'] = "http://media.imoutdoors.com/northamericanwhitetail/community/logo4.png";
				$emailDataArray[$event->post_user_id]['community_name'] = "North American Whitetail Community";
			}

			if ($event->domain == "www.in-fisherman.com") {
				$emailDataArray[$event->post_user_id]['logo_url'] = "http://media.imoutdoors.com/in-fisherman/community/in-fish-email-banner.png";
				$emailDataArray[$event->post_user_id]['community_name'] = "Fishhead Photos";
			}

			$event->profile_url = "http://" . $event->domain . "/profile/" . $event->event_username;


			//This organizes the data by user to make it easier to send emails about one user
			$emailDataArray[$event->post_user_id]['posts'][$event->spid]['events'][$event->id] = $event;
			$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_title'] = $event->post_title;
			$emailDataArray[$event->post_user_id]['display_name'] = $event->post_display_name;
			$emailDataArray[$event->post_user_id]['user_score'] = $event->user_score;
			$emailDataArray[$event->post_user_id]['posts'][$event->spid]['events'][$event->id] = $event;
			$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_score'] = $event->post_score;

			$emailDataArray[$event->post_user_id]['domain'] = $event->domain;

			$emailDataArray[$event->post_user_id]['email'] = $event->email;
			$emailDataArray[$event->post_user_id]['event_ids'][] = $event->id;


			if (!empty($event->post_img_url)) {//if there is an image

				if ($event->domain == "www.northamericanwhitetail.com") {
					$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_img_url'] = "http://www.northamericanwhitetail.com" . $event->post_img_url;
				} else {
					$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_img_url'] = $event->post_img_url . "/convert?w=150&h=150&fit=crop";
				}

			}


			$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_type'] = $event->post_type;
			$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_comment_count'] = $event->post_comment_count;


			if ($event->domain == "www.northamericanwhitetail.com") {
				$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_url'] = "http://www.northamericanwhitetail.com/plus/" . $event->post_type . "/" . $event->spid;
			} else {
				$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_url'] = "http://" . $event->domain . "/photos/" . $event->spid;
			}


			$emailDataArray[$event->post_user_id]['event_count']++;

			if ($event->event_type == "comment") {
				$emailDataArray[$event->post_user_id]['total_comment_count']++;
				$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_new_comment_count']++;
				$emailDataArray[$event->post_user_id]['email_comment_count']++;
			}
			if ($event->event_type == "share") {
				$emailDataArray[$event->post_user_id]['total_share_count']++;
				$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_new_share_count']++;
				$emailDataArray[$event->post_user_id]['email_share_count']++;
			}

			if ($emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_new_comment_count'] >= $emailDataArray[$event->post_user_id]['highest_comment_count']) {
				$emailDataArray[$event->post_user_id]['highest_comment_count'] = $emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_new_comment_count'];

				//The post with the most comments is selected as the event Featured in the subject
				$emailDataArray[$event->post_user_id]['featured_event'] = $event;
				$emailDataArray[$event->post_user_id]['featured_event_comment_count'] = $emailDataArray[$event->post_user_id]['highest_comment_count'];
			}
			//if ($emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_new_share_count'] > $highestShareCount) {
				$highestShareCount = $emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_new_share_count'];

				//The post with the most comments is selected as the event Featured in the subject
				$emailDataArray[$event->post_user_id]['featured_shared_event'] = $event;
				$emailDataArray[$event->post_user_id]['featured_shared_event_count'] = $highestShareCount;
			//}

		} else {//If event was created by the user, mark it as sent

		}

	}//End foreach

	$db = "";





	return $emailDataArray;


	} catch(PDOException $e) {
		echo $e->getMessage();
	}
}


function time_elapsed_string($ptime) {
    $etime = time() - $ptime;

    if ($etime < 1) {
        return '0 seconds';
    }

    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
                );

    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's' : '');
        }
    }
}

