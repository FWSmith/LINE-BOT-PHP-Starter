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
			$server = 'us-cdbr-iron-east-05.cleardb.net';
			$username = 'b809e2f36f0522';
			$password = '01a9a1f5';
			$db = 'heroku_a0500905d74bead';
			$pdo = new PDO("mysql:host=$server;dbname=$db", $username, $password);  
			$Select_Status = "SELECT * FROM bot_status";
			$Query_Status = $pdo->prepare($Select_Status);
			$Query_Status->execute();
			$Fetch_Status = $Query_Status->fetch(PDO::FETCH_ASSOC);
			
			if($Fetch_Status['bot_status'] == 'true'){

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
					}else if($text == 'Shutdown Jake'){
						$Update_Status = "UPDATE bot_status SET bot_status = 'false' WHERE idbot_status = 1";
						$Query_Update = $pdo->prepare($Update_Status);
						$Query_Update->execute();
						$messages = [
			           			[
			           				'type' => 'text',
			           				'text' => 'กำลังทำการปิดตัวเอง'
			           			],
			           			[
			           				'type' => 'text',
			           				'text' => 'Jake ไปละนะครับ ไว้เจอกันใหม่'
			           			]
			           	];
					}else if(strpos($text, 'train') !== false){
						$train = explode(":", $text);
						$Insert_train = "INSERT INTO bot_train (idbot_train, textbot_train, replybot_train, trainer) VALUES (:idbot_train, :textbot_train, :replybot_train, :trainer); ";
						$Query_Insert = $pdo->prepare($Insert_train);
						$Query_Insert->execute(Array(
							":idbot_train" => NULL,
							":textbot_train" => $train[1],
							":replybot_train" => $train[2],
							":trainer" => $userId
						));
						$messages = [
			           			[
			           				'type' => 'text',
			           				'text' => 'เรียนรู้คำนี้แล้วครับ'
			           			],
			           			[
			           				'type' => 'text',
			           				'text' => 'ขอบคุณที่สอนนะครับ'
			           			]
			           	];
					}else{
						$messages = [
			           			[
			           				'type' => 'text',
			           				'text' => 'ผมยังไม่เคยเรียนรู้คำนี้'
			           			],
			           			[
			           				'type' => 'text',
			           				'text' => 'คุณช่วยสอนหน่อยนะครับ'
			           			]
			           	];
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

			}else{
				if($text == 'Start Jake'){
					$Update_Status = "UPDATE bot_status SET bot_status = 'true' WHERE idbot_status = 1";
					$Query_Update = $pdo->prepare($Update_Status);
					$Query_Update->execute();
					$messages = [
	           			[
	           				'type' => 'text',
	           				'text' => 'กำลังเปิดระบบ...'
	           			],
	           			[
	           				'type' => 'text',
	           				'text' => 'Jake กลับมาแล้วครับ'
	        			]
			        ];
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
