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
            $status = "true";
			// Build message to reply back
			$server = 'us-cdbr-iron-east-05.cleardb.net';
			$username = 'b809e2f36f0522';
			$password = '01a9a1f5';
			$db = 'heroku_a0500905d74bead';
			$pdo = new PDO("mysql:host=$server;dbname=$db", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));  
			$Select_Status = "SELECT * FROM bot_speak WHERE bot_groupid = :groupId";
			$Query_Status = $pdo->prepare($Select_Status);
			$Query_Status->execute(Array(
				":groupId" => $groupId
			));
			$rowCount = $Query_Status->rowCount();
			if($rowCount >= 1){
				$Fetch_Status = $Query_Status->fetch(PDO::FETCH_ASSOC);
							if($Fetch_Status['bot_status'] == 'true'){
				$Select_Train = "SELECT * FROM bot_train WHERE textbot_train LIKE '%{$text}%' AND group_id = '$groupId'";
				$Query_Train = $pdo->prepare($Select_Train);
				$Query_Train->execute();
				$Fetch_Train = $Query_Train->fetch(PDO::FETCH_ASSOC);
				if($groupId != '' && $userId != ''){
					if(strpos($text, 'สวัสดี') !== false || strpos($text, 'โย่') !== false){
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
			           	}else if($Name == 'MΔÏ'){
			           		$Display_Name = "ใหม่";
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
					}else if($Fetch_Train){
						$messages = [
			           			[
			           				'type' => 'text',
			           				'text' => $Fetch_Train['replybot_brain']
			           			]
			           	];
					}else if(strpos($text, 'อุณหภูมิ') !== false){
						$temp_url = "https://query.yahooapis.com/v1/public/yql?format=json&q=select+%2A+from+weather.forecast+where+woeid%3D1225448";
					    $temp = curl_init();  
					    curl_setopt($temp,CURLOPT_URL,$temp_url);
					    curl_setopt($temp,CURLOPT_RETURNTRANSFER,true);							 
					    $output=curl_exec($temp);
					    curl_close($temp);
					    $temp_result = json_decode($output);
					    $Cel = ($temp_result->query->results->channel->item->condition->temp-32)*5/9;
					    $messages = [
					    	[
					    		'type' => 'text',
					    		'text' => 'ขณะนี้อุณหภูมิอยู่ที่ : '.(int)($Cel).' องศาเซลเซียส'
					    	]
					    ];
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
						       "text"=>"เบอร์ของพี่ปลาทูคนสวย คือ 0884564226"
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
					}else if($text == 'Shutdown Jake'){
						$Update_Status = "UPDATE bot_speak SET bot_status = 'false' WHERE bot_groupid = :group_id";
						$Query_Update = $pdo->prepare($Update_Status);
						$Query_Update->execute(Array(
							":group_id" => $groupId
						));
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
					}else if(strpos($text, "Jake เงียบ") !== false || strpos($text, "Jakeเงียบ") !== false || strpos($text, "Jake หุบ") !== false || strpos($text, "Jake หยุด") !== false || strpos($text, "หุบ") !== false){
						$Update_Status = "UPDATE bot_speak SET bot_status = 'false' WHERE bot_groupid = :group_id";
						$Query_Update = $pdo->prepare($Update_Status);
						$Query_Update->execute(Array(
							":group_id" => $groupId
						));
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
					}else if(strpos($text, 'train:') !== false){
						$train = explode(":", $text);
						$Insert_train = "INSERT INTO bot_train (idbot_train, textbot_train, replybot_train, trainer_id, group_id) VALUES (:idbot_train, :textbot_train, :replybot_train, :trainer_id, :group_id); ";
						$Query_Insert = $pdo->prepare($Insert_train);
						$Query_Insert->execute(Array(
							":idbot_brain" => NULL,
							":textbot_brain" => $train[1],
							":replybot_brain" => $train[2],
							":trainer_id" => $userId,
							":group_id" => $groupId
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
					}else if(strpos($text, 'delete') !== false){
						$delete_text = explode(":", $text);
						$Delete_train = "DELETE FROM `bot_train` WHERE `textbot_train` = :textbot_train AND `trainer_id` = :trainer_id AND `group_id` = :group_id";
						$Query_Delete = $pdo->prepare($Delete_train);
						$Query_Delete->execute(Array(
							":textbot_train" => $delete_text[1],
							":trainer_id" => $userId,
							":group_id" => $groupId
						));
						$messages = [
			           			[
			           				'type' => 'text',
			           				'text' => 'ลบการสอนแล้วครับ'
			           			]
			           	];
					}else if(strpos($text, "แนะนำตัว") !== false){
						$messages = [
			           			[
			           				'type' => 'text',
			           				'text' => 'สวัสดีครับผมชื่อ Jake'
			           			],
			           			[
			           				'type' => 'text',
			           				'text' => 'วิธีสอนให้ Jake พูด'
			           			],
			           			[
			           				'type' => 'text',
			           				'text' => 'train:คำพูดที่ส่ง:คำพูดที่ตอบ'
			           			]
			           	];
					}else if(strpos($text, "template") !== false){
						$messages = [
			           			[
								  "type"=> "template",
								  "altText"=> "this is a confirm template",
								  "template" => [
								      "type" => "confirm",
								      "text" => "Are you sure?",
								      "actions" => [
								          [
								            "type" => "message",
								            "label" => "Yes",
								            "text" => "yes"
								          ],
								          [
								            "type" => "message",
								            "label" => "No",
								            "text" => "no"
								          ]
								      ]
								  	]
								]
			           	];
					}else{
						$numbers = range(1, 12);
						shuffle($numbers);
						foreach ($numbers as $number) {
						    if($number == 1){
						    	$reply = "จริงหรอจ้ะ";
						    }else if($number == 2){
						    	$reply = "ใช่หรอ";
						    }else if($number == 3){
						    	$reply = "ไม่รู้";
						    }else if($number == 4){
						    	$reply = "อ๋อๆ";
						    }else if($number == 5){
						    	$reply = "โอเคๆ";
						    }else if($number == 6){
						    	$reply = "แล้วแต่เลย";
						    }else if($number == 7){
						    	$reply = "ไม่รู้ว้อย";
						    }else if($number == 8){
						    	$reply = "เจ้กรักทุกคนนะ";
						    }else if($number == 9){
						    	$reply = "เจ้ก คิดถึงฟินจัง ._.";
						    }else if($number == 10){
						    	$reply = "หิวว้อยยย";
						    }else if($number == 11){
						    	$reply = "ต้องการคนดูแล";
						    }else if($number == 12){
						    	$reply = "อิอิ";
						    }
						}
						$messages = [
			           			[
			           				'type' => 'text',
			           				'text' => $reply
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
					$Update_Status = "UPDATE bot_speak SET bot_status = 'true' WHERE bot_groupid = :group_id";
					$Query_Update = $pdo->prepare($Update_Status);
					$Query_Update->execute(Array(
						":group_id" => $groupId
					));
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
				}else if(strpos($text, "Jake พูด") !== false || strpos($text, "Jakeพูด") !== false){
					$Update_Status = "UPDATE bot_speak SET bot_status = 'true' WHERE bot_groupid = :group_id";
					$Query_Update = $pdo->prepare($Update_Status);
					$Query_Update->execute(Array(
						":group_id" => $groupId
					));
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
			}else{
				// $delete_status = "DELETE FROM `bot_speak` WHERE `bot_groupid` = :id";
				// $query_delete = $pdo->prepare($delete_status);
				// $query_delete->execute(Array(
				// 	":id" => $groupId
				// ));
				$Insert_Status = "INSERT INTO `bot_speak` (`idbot_speak`, `bot_status`, `bot_groupid`) VALUES (:ID, :bot_status, :bot_groupid);";
				$Query_Insert = $pdo->prepare($Insert_Status);
				$Query_Insert->execute(Array(
					":ID" => NULL,
					":bot_status" => $status,
					":bot_groupid" => $groupId
				));
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
echo "OK1";
?>
