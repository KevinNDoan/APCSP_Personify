<!doctype html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css"> 
    </head>
    <body>
    <img src="photos/4070409.jpg" style="width:100vw; height:100vh;" >
        <form class="auth-form" action="auth/signup.php" method="POST">
            <div class="p-3 shadow-sm bg-white rounded">
                <h1>Sign Up</h1>
                <br>
                <input class="form-control rounded-pill" name="username" placeholder="Username" type="text" required>
                <br>
                <input class="form-control rounded-pill" name="password" placeholder="Password" type="password" required>
                <br>
                <?php 
                    if(!empty($_GET['error'])){
                        echo "<p class='text-danger'>This user has already been taken.</p>";
                    }
                ?>
                <button class="btn btn-primary mb-4" type="submit">Sign up</button>
                <br>
                <a class="text-decoration-none" href="http://personify.us.to/">Have an account? Click here to log in!</a>
            </div>
        </form>
    </body>
</html>
