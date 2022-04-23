<?php
    $alert = false;
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'components/_dbConnect.php';
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        //CHECK wheather user already exist or not
        $excsql = "SELECT * from user where username='$username';";
        $result = mysqli_query($conn, $excsql);
        $isExcRow = mysqli_num_rows($result);

        if($isExcRow > 0) {
            $alert = true;
        } else {
            $sql = "INSERT INTO `user` (`username`, `password`) VALUES ('$username', '$password');";
            $result = mysqli_query($conn, $sql);
        
            //if $result is true
            if($result) {
                $err = "";
                header("location: welcome.php");
            } else {
                $err = $result;
            }
        }
    }


echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="register_container">
            <div class="register_title">
                <h3>Register Page</h3>
            </div>
            <div class="register_form">
                <form action="/website/register.php" method="post">
                    <input type="text" name="username" placeholder="Email" class="username">
                    <input type="password" name="password" placeholder="Password" class="password">
                    <button type="submit">Sign Up</button>
                </form>
                <p>By signing up, you agree to our Terms , Data Policy and Cookies Policy .</p>';
                if($alert) {echo '<p style="color:red;">Username Already Exist</p>';};
            echo '</div>            
        </div>
        <div class="signup_link">
            <p>Have an account? <a href="/website/login.php">Log In</a></p>
        </div>
    </div>
</body>
</html>';

?>