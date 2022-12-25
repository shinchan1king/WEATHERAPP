<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.css" />
</head>

<body>
<?php
require('db.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_reporting(0);
    $username = $_POST["username"];
    $password = $_POST["password"];
    $query="Select * from users where username='$username' and password='$password'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)==1)
    {
        
		$_SESSION['username'] = $username;
        echo"<script>alert('you are logged in ');
        window.location.replace('index.php');</script>";

    }
    else{
        echo"<script>alert('you are not logged in ');</script>";
    }
    
//    db_print($conn);        
}
?>
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Weather App
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-offset-4 is-4">
                    <form method="POST" action="" >
                        <div class="">
                            <div class="control is-expanded">
                                <input class="input" name="username" type="text" placeholder="Enter Username">
                            </div>
                            </br>
                            <div class="control is-expanded">
                                <input class="input" name="password" type="password" placeholder="Enter Password">
                            </div>
                            <br>
                            <div style="margin:auto">
                            <div class="control">
                                <button class="button is-info">
                                    Login
                                </button>
                            </div>
                            <br>
                            <div class="control">
                                <a class="button is-info" href="register.php">
                                    Register
                                </a>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    
    <footer class="footer">
    </footer>
</body>

</html>
