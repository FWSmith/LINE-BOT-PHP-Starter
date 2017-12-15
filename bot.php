<?php
$access_token = 'BdAQ3QuQX+ssTW55tgg2sJD911e0SN6/MmuTkXhxf16RTG3wqTibikzS0e2Vx0vCC3JqMNLSsenThtxSlG9dh2t8h/7OArNWet9tjYqAI/NgPc7TgIQwzJdk4VgUFJpirHRJgqdfL8v4QwsEaGiaBwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			//Get Group ID
			$groupId = $event['source']['groupId'];
			//Get User ID
			$userId = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
                      
			// Build message to reply back
			if($text == 'สวัสดี'){
			  if($groupId != '' && $userId != ''){
		           $headers_gp = array('Authorization: Bearer ' . $access_token);
		           $url_gp = 'https://api.line.me/v2/bot/group/'.$groupId.'/member/'.$userId.'';
                           $ch_gp = curl_init($url_gp);
                           curl_setopt($ch_gp, CURLOPT_RETURNTRANSFER, true);
                           curl_setopt($ch_gp, CURLOPT_HTTPHEADER, $headers_gp);
                           curl_setopt($ch_gp, CURLOPT_FOLLOWLOCATION, 1);
                           $result_gp = curl_exec($ch_gp);
		           $result_decode = json_decode($result_gp);
                           curl_close($ch_gp);
		           $Name = $result_decode->displayName;
			  $messages = [
			    'type' => 'text',
			    'text' => 'สวัสดีครับ เจ้านาย '.$Name
			  ];  	  
			  }else{
			  $messages = [
			    'type' => 'text',
			    'text' => 'สวัสดีครับ เจ้านาย'
			  ];  
			  }
			  
			}else{
			  $messages = [
			  'type' => 'text',
			  'text' => 'ไม่รู้เรื่อง'
			  ];	
			}
			

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
?>
