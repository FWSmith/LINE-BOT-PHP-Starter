<?php
$url = parse_url(getenv("mysql://b809e2f36f0522:01a9a1f5@us-cdbr-iron-east-05.cleardb.net/heroku_a0500905d74bead?reconnect=true"));

$server = 'us-cdbr-iron-east-05.cleardb.net';
$username = 'b809e2f36f0522';
$password = '01a9a1f5';
$db = 'heroku_a0500905d74bead';
$pdo = new PDO("mysql:host=$server;dbname=$db", $username, $password);
$Update = "UPDATE bot_status SET bot_status='false' WHERE idbot_status=1";
$Query = $pdo->prepare($Update);
$Query->execute();
$Select = "SELECT * FROM bot_status";
$Query_Bot = $pdo->prepare($Select);
$Query_Bot->execute();
$Fetch_Bot = $Query_Bot->fetch(PDO::FETCH_ASSOC);
echo $Fetch_Bot['bot_status'];
?>
