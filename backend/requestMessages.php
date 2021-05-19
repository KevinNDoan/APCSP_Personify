<?php
session_write_close();
set_time_limit(0);

while(true){
    clearstatcache();
    $timestamp = $_GET['timestamp'];
    $source = "messages.json";
    $last_poll = isset($timestamp) ? $timestamp : null;
    
    //Grab last timestamp
    $json = file_get_contents('messages.json');
    $json = json_decode($json);

    $last_change = json_encode(end($json->{'messages'})->{'timestamp'});

    if ($last_poll == null || $last_change > $last_poll) {
        echo "New message";
        exit();
    }
    usleep(50000);
    continue;
}
