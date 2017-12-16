<?php
$url = parse_url(getenv("mysql://b809e2f36f0522:01a9a1f5@us-cdbr-iron-east-05.cleardb.net/heroku_a0500905d74bead?reconnect=true"));

$server = 'us-cdbr-iron-east-05.cleardb.net';
$username = 'b809e2f36f0522';
$password = '01a9a1f5';
$db = 'heroku_a0500905d74bead';
$mysqli = new mysqli($server, $username, $password, $db);
if ($mysqli->connect_errno) {
 echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}
?>
