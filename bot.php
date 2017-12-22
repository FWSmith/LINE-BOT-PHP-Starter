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
			$groupId = $event['source']['groupId'];
			//Get User ID
			$userId = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];
                        
			// Build message to reply back

			
			if(strpos($text, 'สวัสดี') !== false || strpos($text, 'คนใช้') !== false){
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
			  
			}else if(strpos($text, 'ขอเบอร์') !== false || strpos($text, 'เบอร์') !== false || strpos($text, 'เบอ') !== false){
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
			    }else if(strpos($text, 'พูม') !== false || strpos($text, 'คามิน') !== false || strpos($text, 'ภูม') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของคนสวยคามิน คือ 0833151921"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'กาน') !== false || strpos($text, 'กาญจน์') !== false || strpos($text, 'กาญ') !== false || strpos($text, 'อ้วน') !== false || strpos($text, 'หมู') !== false || strpos($text, 'แกมไทย') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของแกมไทย คือ 0868692992"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'สอ') !== false || strpos($text, 'สรวิศ') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของสรวิศ คือ 0967241444"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'ณัฐพร') !== false || strpos($text, 'แช่มช้อย') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของณัฐพร คือ 0928253229"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'ต๋ง') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของต๋ง คือ 0893463490"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'ติ') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของติ คือ 0856674817"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'ทีน') !== false || strpos($text, '9น้ำ') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของทีน คือ 0833554411"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'ธิ') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของธิ คือ 0953454049"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'ณัฐพงศ์') !== false || strpos($text, 'นัทผอม') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของณัฐพงศ์ คือ 0871612152"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'เนย') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของเนย คือ 0923363361"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'บอย') !== false || strpos($text, 'เจริญ') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของบอย คือ 0923472344"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'เบส') !== false || strpos($text, 'เครี่ยง') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของเบส คือ 0955513934"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'เบีย') !== false || strpos($text, 'เบียร์') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของเบียร์ คือ 0970256798"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'ปราย') !== false || strpos($text, 'ปาย') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของปราย คือ 0922516654"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'ปาลิกา') !== false || strpos($text, 'นัทสูง') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของปาลิกา คือ 0889955523"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'แป้ง') !== false || strpos($text, 'ภัท') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของแป้ง คือ 0863627889"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'พลอย') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของพลอย คือ 0951525392"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'ปิ่น') !== false || strpos($text, 'เพชร') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของปิ่น คือ 0910189701"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'แพร') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของแพร คือ 0929165763"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'แพรวสุ') !== false || strpos($text, 'สุภิตา') !== false || strpos($text, 'สุ') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของสุภิตา คือ 0885429898"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'ฟิว') !== false || strpos($text, 'ปลาทู') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของพี่ปลาทูคนสวยรวยมากท่ายากมีน้อยแต่ร้อยควยป่วยการบ้านจิ๋มบานเท่าจานดาวเทียม คือ 0884564226"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'เมย์') !== false || strpos($text, 'เม') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของเมย์โกริ คือ 0861619592"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'แพรวสิ') !== false || strpos($text, 'สินี') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของสินี คือ 0870653107"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'กัน') !== false || strpos($text, 'กัญ') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของกัญจน์ คือ 0817427639"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'ตี๋') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของตี๋ คือ 0968986451"
				    ],
				    [
				       "type"=>"text", 
				       "text"=>"ยินดีให้บริการครับ"
				    ]
			    ];				    
			    }else if(strpos($text, 'บูม') !== false){
			    $messages = [
				    [
				       "type"=>"text", 
				       "text"=>"เบอร์ของบูม คือ 0649626624"
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
			}else{
			   
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
echo "OKๅ";
?>
