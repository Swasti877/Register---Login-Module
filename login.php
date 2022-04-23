<?php 
    $alert = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        include 'components/_dbConnect.php';
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * from user where username='$username' AND password='$password';";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num == 1) {
            $alert= false;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            //redirect
            header("location: welcome.php");
        } else {
            $alert=true;
        }
    }


echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="login_container">
            <div class="login_title">
                <h3>login Page</h3>
            </div>
            <div class="login_form">
                <form action="/website/login.php" method="post">
                    <input type="text" name="username" placeholder="Username, or email" class="username">
                    <input type="password" name="password" placeholder="Password" class="password">
                    <button type="submit">Log In</button>
                </form>
            </div>
            
        </div>
        <div class="signup_link">
            <p>Don\'t have an account? <a href="/website/register.php">Sign up</a></p>';
            if($alert){echo '<p style="color:red;">Username or Password Incorrect</p>';};
        echo '</div>
    </div>
</body>
</html>';

?>