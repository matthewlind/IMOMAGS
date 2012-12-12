<?php

include 'mysql.php';
include 'email_creator.php';
include 'postmark.php';




//First query the database for the emails that need to be sent
$emailDataArray = getEmailData();

//For each user, grab the HTML and send the email.
foreach ($emailDataArray as $emailData) {
	
	$emailHTML = generateEmailHTML($emailData);
	
	$emailSubject = generateEmailSubject($emailData);
	echo "<h1>SUBJECT:$emailSubject</h1>";
	echo $emailHTML;
	//echo json_encode($emailData);
	
	if ($emailData['event_count'] > 1) {//Only send emails if there is more than one event to mention
		
		
		$postmark = new Postmark("2338c32a-e4b3-4a36-a6a6-6ff501f4f614","community@intermediaoutdoors.com");
		
		
	
/*
		$result = $postmark->to("baker.aaron@gmail.com")
			->subject($emailSubject)
			->html_message($emailHTML)
			->send();
*/
		
		if($result === true)
			echo "Message sent";
	}
	
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
	
		$event->time_ago_string = time_elapsed_string(strtotime($event->timestamp)) . " ago";
		
		
		
		
		//This organizes the data by user to make it easier to send emails about one user
		$emailDataArray[$event->post_user_id]['posts'][$event->spid]['events'][$event->id] = $event;
		$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_title'] = $event->post_title;
		$emailDataArray[$event->post_user_id]['display_name'] = $event->post_display_name;
		$emailDataArray[$event->post_user_id]['user_score'] = $event->user_score;
		$emailDataArray[$event->post_user_id]['posts'][$event->spid]['events'][$event->id] = $event;
		$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_score'] = $event->post_score;
		$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_img_url'] = "http://www.northamericanwhitetail.deva" . $event->post_img_url;
		$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_type'] = $event->post_type;
		$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_comment_count'] = $event->post_comment_count;
		$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_url'] = "http://www.northamericanwhitetail.com/plus/" . $event->post_type . "/" . $event->spid;
		$emailDataArray[$event->post_user_id]['event_count']++;
		
		if ($event->event_type == "comment") {
			$emailDataArray[$event->post_user_id]['total_comment_count']++;
			$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_new_comment_count']++;
		}
		if ($event->event_type == "share") {
			$emailDataArray[$event->post_user_id]['total_share_count']++;
			$emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_new_share_count']++;
		}	
		
		if ($emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_new_comment_count'] > $highestCommentCount) {
			$highestCommentCount = $emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_new_comment_count'];
			
			//The post with the most comments is selected as the event Featured in the subject
			$emailDataArray[$event->post_user_id]['featured_event'] = $event;
		}
		if ($emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_new_share_count'] > $highestShareCount) {
			$highestShareCount = $emailDataArray[$event->post_user_id]['posts'][$event->spid]['post_new_share_count'];
			
			//The post with the most comments is selected as the event Featured in the subject
			$emailDataArray[$event->post_user_id]['featured_shared_event'] = $event;
			$emailDataArray[$event->post_user_id]['featured_shared_event_count'] = $highestShareCount;
		}
		$emailDataArray[$event->post_user_id]['highest_comment_count'] = $highestCommentCount;
			
	
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

