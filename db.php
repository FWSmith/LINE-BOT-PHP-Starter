<?php
$url = parse_url(getenv("mysql://b809e2f36f0522:01a9a1f5@us-cdbr-iron-east-05.cleardb.net/heroku_a0500905d74bead?reconnect=true"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);
$conn = new mysqli($server, $username, $password, $db);

?>