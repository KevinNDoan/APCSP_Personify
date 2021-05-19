<?php
$username = $_GET['sender'];
$message = $_GET['message'];
$timestamp = time();

//Check if the username or password are null
if($username == null || $message == null){
    exit();
}

$json = file_get_contents('messages.json');
$json = json_decode($json);

$newMessage = array(
    "username" => $username,
    "message" => $message,
    "timestamp" => $timestamp,
    "type" => "text"
);

array_push($json->{'messages'}, $newMessage);
$updatedJson = json_encode($json);
file_put_contents('messages.json', $updatedJson);
exit();