<?php
session_start();
?>
<!doctype html>
<html>
    <head>
        <title>Home | Personify</title>
        <link rel="icon" type="image/jpg" href="https://personify.us.to/photos/logo.png"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css"> 
        <script src="https://kit.fontawesome.com/08088cc27f.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
        <nav class="nav-home row border-bottom">
            <div class="col-4 mt-3">
                <h5 class="ms-3">Hello, <?php echo $_SESSION['username']; ?></h5>
            </div>
            <div class="col-4">
                <div class="logo-container border">
                    <img src="https://personify.us.to/photos/logo.png" class="logo" alt="">
                </div>
            </div>
            <div class="col-4 text-end mt-2">
                <a class="btn btn-primary" onclick="signout();">Sign Out</a>
            </div>
        </nav>
        <br>
        <br>
        <div id="msg-area" class="msg-area mx-3 p-4">
            <!-- This is where the messages will go -->
        </div>
 
        <!-- Upload button -->        
        <div class="msg-input-container row border-top">
            <form class="col-3 row mx-1" action="backend/upload.php" method= "POST" enctype="multipart/form-data" style="height:50px;margin-top:-30px;"> 
                <input type="text" name="username" class="invisible" value="<?php echo $_SESSION['username']; ?>">
                <input type="file" name= "file" class="col">
                <button  type="submit" name="submit" class="btn bg-white text-muted border col-3">
                    <i class="fas fa-download fa-2x"></i>
                </button>
            </form> 
        <!-- Upload button End -->

        <!-- Message input  -->
            <input id="input" class="col form-control rounded-pill" type="text" placeholder="Type a message..." onkeydown="if(event.keyCode == 13){sendMessages('<?php echo $_SESSION['username']; ?>');}" maxlength="2000">
            <button class="col-1 btn btn-primary text-decoration-none text-white mt-1 text-center mx-4" style="width:65px;" onclick="sendMessages('<?php echo $_SESSION['username']; ?>');">Send</button>
        </div>
        <!-- Message input end  -->

        <script>
            var user = "<?php echo $_SESSION['username'];?>";
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://personify.us.to/apcreate.js"></script>
    </body>
</html>