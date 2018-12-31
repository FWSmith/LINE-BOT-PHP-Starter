<?php
 $accessToken = "mTOSBFPNNln49I6qmW55ctqvaHNfLGbKVQqfgbmQg1d0B5wEJFMbvW9ixkyuhX9aopgfZJBPdHap8BqPpPw4w1LFI+hMjlpj87VR/+aqK98XG7Bn8NMgayBGhTNC9vHeU25Me2+QvxM/dWV9eiBNdgdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
   $content = file_get_contents('php://input');
   $arrayJson = json_decode($content, true);
   $arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   //รับข้อความจากผู้ใช้
   $message = $arrayJson['events'][0]['message']['text'];
   //รับ id ของผู้ใช้
   $id = ["U72c641a79b2f1a785a7b362df99931ae"];
   #ตัวอย่าง Message Type "Text + Sticker"
   $arrayPostData['to'] = $id;
   $arrayPostData['messages'][0]['type'] = "text";
   $arrayPostData['messages'][0]['text'] = '[แจ้งเตือน] อัพเดทนักเรียน 1 คน';
   $arrayPostData['messages'][1]['type'] = "text";
   $arrayPostData['messages'][1]['text'] = '[ชื่อ] '.$_POST['student_name'];
   $arrayPostData['messages'][2]['type'] = "text";
   $arrayPostData['messages'][2]['text'] = '[วิชา] '.$_POST['student_subject'];
   $arrayPostData['messages'][3]['type'] = "text";
   $arrayPostData['messages'][3]['text'] = '[LINE ID] '.$_POST['student_line'];
   $arrayPostData['messages'][4]['type'] = "text";
   $arrayPostData['messages'][4]['text'] = '[TEL] '.$_POST['student_phone'];
   pushMsg($arrayHeader,$arrayPostData);
   if($message == "id"){
     $id = $arrayJson['events'][0]['source']['userId'];
     $arrayPostData['to'] = $id;
     $arrayPostData['messages'][0]['type'] = "text";
     $arrayPostData['messages'][0]['text'] = $id;
     pushMsg($arrayHeader,$arrayPostData);
   }
  
   function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/multicast";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
   exit;  
?>
