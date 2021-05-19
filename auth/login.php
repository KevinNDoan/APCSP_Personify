<?php
$username = $_POST['username'];
$password = $_POST['password'];

// Check JSON file to see if username is taken
$json = file_get_contents('auth.json');
$json = json_decode($json);

for($i = 0;$i <= count($json->{'credentials'});$i++){
    if($username == $json->{'credentials'}[$i]->{'username'}){
        if(password_verify($password, $json->{'credentials'}[$i]->{'password'})){
            // Start a session
            session_start();

            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;

            header("Location: http://personify.us.to/home");
            exit();
        } else {
            header("Location: http://personify.us.to?error=true");
            exit();
        }
    }
}

header("Location: http://personify.us.to?error=true");
exit();