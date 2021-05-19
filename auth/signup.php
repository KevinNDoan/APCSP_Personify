<?php
$username = $_POST['username'];
$password = $_POST['password'];

if($username == null || $password == null){
    exit();
}

$password = password_hash($password, PASSWORD_DEFAULT);

// Check JSON file to see if username is taken
$json = file_get_contents('auth.json');
$json = json_decode($json);

for($i = 0;$i <= count($json->{'credentials'}) - 1;$i++){
    if($username == $json->{'credentials'}[$i]->{'username'}){
        header("Location: http://personify.us.to/signup?error=true");
        exit();
    }
}

$newCredentials = array(
    "username" => $username,
    "password" => $password
);

array_push($json->{'credentials'}, $newCredentials);
$updatedJson = json_encode($json);
file_put_contents('auth.json', $updatedJson);

header("Location: http://personify.us.to/signup_success");
exit();