<?php
$access_token = 'BdAQ3QuQX+ssTW55tgg2sJD911e0SN6/MmuTkXhxf16RTG3wqTibikzS0e2Vx0vCC3JqMNLSsenThtxSlG9dh2t8h/7OArNWet9tjYqAI/NgPc7TgIQwzJdk4VgUFJpirHRJgqdfL8v4QwsEaGiaBwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v2/bot/profile/U72c641a79b2f1a785a7b362df99931ae';

$headers = array('Authorization: Bearer ' . $access_token);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
$result_decode = json_decode($result);
?>
<br>
<?php
var_dump($result_decode);
?>
<br>
<?php
echo $result_decode["displayName"];
?>
