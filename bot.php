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
			if(strpos($event['message']['text'], 'คนใช้') !== false){
				if(strpos($event['message']['text'], 'พุด') !== false){
					$status == true;
				}	
			}
			if($status == false){
			   $text = '';
			}else{
			   $text = $event['message']['text'];				
			}
			//Get Group ID
			$groupId = $event['source']['groupId'];
			//Get User ID
			$userId = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
                        
			// Build message to reply back


			if(strpos($text, 'สวัสดี') !== false){
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
		           if (strpos($Name, 'FÖRT') !== false) {
		             $Display_Name = 'โฟร์ท';
			     $messages = [
			    	[
				    'type' => 'text',
			    	    'text' => 'สวัสดีครับ เจ้านาย'.$Display_Name
				],
				[
				    'type' => 'text',
				    'text' => 'มีอะไรให้รับใช้ครับ'
				]
			    ];  	 
		           }else if(strpos($Name, 'KAN') !== false){
			     $Display_Name = 'กัน';
			     $messages = [
				     [
			    		'type' => 'text',
			    		'text' => 'สวัสดีครับ พี่'.$Display_Name.' มีอะไรให้รับใช้ครับ'
				     ]
			     ];     
			   }else{
			     $messages = [
			    	[
			    	'type' => 'text',
			    	'text' => 'สวัสดีครับ พี่'.$Name.' มีอะไรให้รับใช้ครับ'
				]
			     ];     
			   }
			   
			  }else{
			  $messages = [
			    [
				 'type' => 'text',
			         'text' => 'สวัสดีครับ เจ้านาย'
			    ]
			  ];  
			  }
			  
			}else if(strpos($text, 'ขอเบอร์') !== false || strpos($text, 'เบอร์') !== false){
			    if(strpos($text, 'โฟร์ท') !== false || strpos($text, 'โฟท') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของคุณโฟร์ท คือ 0955305914"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];
			    }else{
		            $messages = [
				    "type"=>"text", 
				    "text"=>"ยังไม่มีเบอร์ครับ จุ้บๆ"
			    ];
			    }
			}else if(strpos($text, 'คนใช้')!== false){
			     if(strpos($text, 'เงียบ')!== false){
				 $status = false;
				 $messages = [
					 [
			                    'type' => 'text',
			                    'text' => $status
				         ]
			         ];  
			     }
				
			}else{
			    $messages = [
				[
			    	'type' => 'text',
			    	'text' => 'คำพูดนี้ยังไม่ได้เรียนรู้ครับ'
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
