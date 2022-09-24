<!DOCTYPE html>
    <!--  This file login user and check whether the user is an admin or not -->
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<?php

    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['email'])) {
        $email = stripslashes($_REQUEST['email']);    // removes backslashes
        $email = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $salted = $email.$password;
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE email='$email'
                     AND password='" . hash("sha256", $salted) . "'";
        $result = mysqli_query($con, $query); 
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['email'] = $email;
            $sql_admin = "SELECT adminStatus FROM `users` WHERE `email` = '$email'";
            $result_role = mysqli_query($con, $sql_admin);
            $adminStatus = mysqli_fetch_assoc($result_role);
            if($result_role ==1 ){
                if ($adminStatus['adminStatus'] == 1){
                    header("Location: adminDashboard.php");
                }else{
                    header("Location: userDashboard.php");
                }
            }
        }
        else {
        echo "<div class='form'>
                <h3>Incorrect Username/password.</h3><br/>
                <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                </div>";
        }
    }

    else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="email" placeholder="Email" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <div class="text-end">
            <a href="forgotPassword.php" class='btn m-1 text-primary' style="background:transparent;">Forgot Password ?</a>
        </div>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="registration.php">New Registration</a></p>
  </form>
<?php
    }
?>
</body>
</html>