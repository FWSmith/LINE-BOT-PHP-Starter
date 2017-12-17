<?php
$access_token = 'GvQnNcHr8Qye1EOmu9p9SeoZAH/viJBraCaHSvM/r7FDyogBFBhaN2GUVt9s3biA3o1ZTmUCT6vpXnYUMLQGj1Q2D0wKaAccXKeh3hADBpMeKgOE15oY83FjejqWbAax2KMP7EpVAS1AMZp0E5f1HgdB04t89/1O/w1cDnyilFU=';
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
			$groupId = $event['source']['groupId'];
			//Get User ID
			$userId = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
                        
			// Build message to reply back

			if($groupId != '' && $userId != ''){
				if(strpos($text, 'สวัสดี') !== false || strpos($text, 'โย่') !== false || strpos($text, 'เห้') !== false){
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
		           	if($userId == 'U72c641a79b2f1a785a7b362df99931ae'){
		           		$Display_Name = "โฟร์ท";
		           		$messages = [
		           			[
		           				'type' => 'text',
		           				'text' => 'สวัสดีครับ'.$Display_Name
		           			],
		           			[
		           				'type' => 'text',
		           				'text' => 'มีอะไรให้รับใช้ครับ'
		           			]
		           		];
		           	}
				}
			}else{
				if(strpos($text, 'สวัสดี') !== false || strpos($text, 'โย่') !== false || strpos($text, 'เห้') !== false){
					if($userId == 'U72c641a79b2f1a785a7b362df99931ae'){
		           		$Display_Name = "โฟร์ท";
		           		$messages = [
		           			[
		           				'type' => 'text',
		           				'text' => 'สวัสดีครับ'.$Display_Name
		           			],
		           			[
		           				'type' => 'text',
		           				'text' => 'มีอะไรให้รับใช้ครับ'
		           			]
		           		];
		           	}else{
		           		$messages = [
		           			[
		           				'type' => 'text',
		           				'text' => 'สวัสดีครับ'
		           			],
		           			[
		           				'type' => 'text',
		           				'text' => 'มีอะไรให้รับใช้ครับ'
		           			]
		           		];
		           	}
				}
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
