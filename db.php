<?php
$url = parse_url(getenv("mysql://b809e2f36f0522:01a9a1f5@us-cdbr-iron-east-05.cleardb.net/heroku_a0500905d74bead?reconnect=true"));

$server = 'us-cdbr-iron-east-05.cleardb.net';
$username = 'b809e2f36f0522';
$password = '01a9a1f5';
$db = 'heroku_a0500905d74bead';
$pdo = new PDO("mysql:host=$server;dbname=$db", $username, $password);
$Select = "SELECT * FROM bot_status";
$Query = $pdo->prepare($Select);
$Query->execute();
$Fetch = $Query->fetch(PDO::FETCH_ASSOC);
echo $Fetch['idbot_status'];
?>
