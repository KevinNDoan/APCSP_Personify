<?php
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $timestamp = time();

    $file = $_FILES['file'];
    $fileName = $_FILES ['file'] ['name'];
    $fileTmpName = $_FILES ['file'] ['tmp_name'];
    $fileSize = $_FILES ['file'] ['size'];
    $fileError = $_FILES ['file'] ['error'];
    $fileType = $_FILES ['file'] ['type'];
 
    
    $fileExt = explode('.', $fileName);
    $fileActualExt =  strtolower(end($fileExt));
    
    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)){
        if( $fileError=== 0){
            if ($fileSize < 10000000 ){
                $fileNameNew = uniqid('', true). ".".$fileActualExt;
                $fileDestination = '../uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                $json = file_get_contents('messages.json');
                $json = json_decode($json);

                $newMessage = array(
                    "username" => $username,
                    "message" => $fileDestination,
                    "timestamp" => $timestamp,
                    "type" => "image"
                );

                array_push($json->{'messages'}, $newMessage);
                $updatedJson = json_encode($json);
                file_put_contents('messages.json', $updatedJson);

                header("Location: https://personify.us.to/home?uploadsuccess");
                exit();
            } else {
                echo "The file is too big!";
                exit();
            }
        } else {
            echo "Error, please retry uploading your file!";
            exit();
        }
    } else {
        echo "Please upload the correct type of file!";
        exit();
    }
}