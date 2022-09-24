<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<?php
    //This file register user and write into the database
    require('db.php');

    // When form submitted, insert values into the database.
    if (isset($_REQUEST['firstname'])) {
        // removes backslashes
        $firstname = stripslashes($_REQUEST['firstname']);
        //escapes special characters in a string
        $firstname = mysqli_real_escape_string($con, $firstname);
        $lastname    = stripslashes($_REQUEST['lastname']);
        $lastname    = mysqli_real_escape_string($con, $lastname);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $salted = $email.$password;
        $sql = "SELECT email FROM users WHERE email='$email'" ;
        $resultCheckEmail = mysqli_query($con, $sql); 
        if( mysqli_num_rows($resultCheckEmail) > 0 ){
            header("Refresh:1");
            echo '<script type="text/javascript">';
            echo ' alert("There is already a user with that email!")';  //not showing an alert box.
            echo '</script>';
            
        }else{
            $query    = "INSERT into `users` (firstname, lastname, email, password)
                        VALUES ('$firstname','$lastname', '$email','" . hash("sha256", $salted) . "')";
            $result   = mysqli_query($con, $query);
            
            if ($result) {
                echo "<div class='form'>
                    <h3>You are registered successfully.</h3><br/>
                    <p class='link'>Click here to <a href='login.php'>Login</a></p>
                    <p class='link'>Click here to <a href='registration.php'>Register</a></p>
                    </div>";
            } else {
                echo "<div class='form'>
                    <h3>Required fields are missing.</h3><br/>
                    <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                    </div>";
            }
        }
    } else {
?>
    <form class="form" action="registration.php" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="firstname" placeholder="Firstname" required />
        <input type="text" class="login-input" name="lastname" placeholder="Lastname" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress" required>
        <input type="password" class="login-input" name="password" placeholder="Password"minlength="8" required>
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>