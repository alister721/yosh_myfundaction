<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center mt-5 pt-5">
        <div class="card mt-5" style="width:500px">
            <div class="card-header">
                <h1 class="text-center">Forgot Password</h1>
            </div>
            <div class="card-body">
                <form action="forgotPassword.php" method="post">
                    <div class="mt-4">
                        <label for="email">Email : </label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="mt-4 text-end">
                        <input type="submit" name="send-link" class="btn btn-primary">
                        <a href="index.php" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php

require('db.php');
require ('vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendmail($email,$reset_token){
        
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                            // Set mailer to use SMTP 
        $mail->Host = 'smtp.gmail.com';           // Specify main and backup SMTP servers 
        $mail->SMTPAuth = true;                     // Enable SMTP authentication 
        $mail->Username = '25DDT20F1115@PMJ.EDU.MY';       // SMTP username 
        $mail->Password = 'tt1234567890000';         // SMTP password 
        $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted 
        $mail->Port = 587;                          // TCP port to connect to 
                                      

        $mail->setFrom('25DDT20F1115@PMJ.EDU.MY','Forgot Password Reset Link'); 
        $mail->addAddress($email); 

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset link form MyFundAction';
        $mail->Body    = "We got a request form you to reset Password! <br>Click the link below: <br>
        <a href='http://localhost/yosh_myfundaction/updatePassword.php?email=$email&reset_token=$reset_token'>Reset Password</a>";

        $mail->send();
            return true;
    } catch (Exception $e) {
            return false;
    }
}

if (isset($_POST['send-link'])) {
    
    $email = $_POST['email'];

    $sql="SELECT * FROM users WHERE email = '$email'";
    $result = $con->query($sql);

    if ($result) {
        
        if ($row = $result->fetch_assoc()) {
            
            $reset_token=bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/kolkata');
            $date = date("Y-m-d");

            $sql = "UPDATE users SET resetToken ='$reset_token', resetTokenExp = '$date' WHERE email = '$email'";

            if (($con->query($sql)===TRUE) && sendmail($email,$reset_token )===TRUE) {
                    echo "
                        <script>
                            alert('Password reset link send to mail.');
                            window.location.href='login.php'    
                        </script>"; 
                }else{
                    echo "
                        <script>
                            alert('Something got Wrong');
                            window.location.href='forgotPassword.php'
                        </script>";
                }

        }else{
            echo "
                <script>
                    alert('Email Address Not Found');
                    window.location.href='forgotPassword.php'
                </script>";
        }   
        
    }else{
        echo "
            <script>
                alert('Server Down');
                window.location.href='forgotPassword.php'
            </script>";
    }
}

?>