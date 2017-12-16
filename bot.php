<?php
$access_token = 'BdAQ3QuQX+ssTW55tgg2sJD911e0SN6/MmuTkXhxf16RTG3wqTibikzS0e2Vx0vCC3JqMNLSsenThtxSlG9dh2t8h/7OArNWet9tjYqAI/NgPc7TgIQwzJdk4VgUFJpirHRJgqdfL8v4QwsEaGiaBwdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
		 	$text = $event['message']['text'];				
			//Get Group ID
			if($event['source']['groupId'] != ''){
			$groupId = $event['source']['groupId'];				
			}
			//Get User ID
			$userId = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
                        
			// Build message to reply back

			
			if(strpos($text, 'สวัสดี') !== false || strpos($text, 'คนใช้') !== false){
				$messages = [
			    	[
			    	'type' => 'text',
			    	'text' => 'สวัสดีครับ'
				]
			     ];   
			}
		      

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages][0],
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
