<!DOCTYPE html>
    <!-- This file allow user to edit their personal details after they login their account -->
<html>
<head>
    <meta charset="utf-8"/>
    <title>Edit Event</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    require('db.php');
    require ('vendor/autoload.php');
    include("auth_session.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function sendmail($email,$eventTitle){
        
        $mail = new PHPMailer(true);
    
        try {
            $mail->isSMTP();                            // Set mailer to use SMTP 
            $mail->Host = 'smtp.gmail.com';           // Specify main and backup SMTP servers 
            $mail->SMTPAuth = true;                     // Enable SMTP authentication 
            $mail->Username = '25DDT20F1115@PMJ.EDU.MY';       // SMTP username 
            $mail->Password = 'tt1234567890000';         // SMTP password 
            $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted 
            $mail->Port = 587;                          // TCP port to connect to 
                                          
    
            $mail->setFrom('25DDT20F1115@PMJ.EDU.MY','New Event from Yosh MyFundAction'); 
            $mail->addAddress($email); 
    
            $mail->isHTML(true);
            $mail->Subject = 'New Event, Check This Now';
            $mail->Body    = 'New Event:';
            $mail->Body    .= $eventTitle;
    
            $mail->send();
                return true;
        } catch (Exception $e) {
                return false;
        }
    }

    // When form submitted, insert values into the database.
    if (isset($_REQUEST['eventTitle'])) {
        // removes backslashes and escapes special characters in a string
        $eventTitle = stripslashes($_REQUEST['eventTitle']);
        $eventTitle = mysqli_real_escape_string($con, $eventTitle);

        $eventDescription    = stripslashes($_REQUEST['eventDescription']);
        $eventDescription    = mysqli_real_escape_string($con, $eventDescription);

        $eventDate    = stripslashes($_REQUEST['eventDate']);
        $eventDate    = mysqli_real_escape_string($con, $eventDate);

        $eventLocation    = stripslashes($_REQUEST['eventLocation']);
        $eventLocation    = mysqli_real_escape_string($con, $eventLocation);

        $eventCapacity    = stripslashes($_REQUEST['eventCapacity']);
        $eventCapacity    = mysqli_real_escape_string($con, $eventCapacity);

        $targetDir = "uploadedImageEvent/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            $query    = "INSERT into `event`(`eventTitle`,`eventDescription`, `posterImage`, `eventDate`, `eventLocation`, `numPerson`) VALUES ('$eventTitle','$eventDescription', '$fileName','$eventDate','$eventLocation','$eventCapacity')";                 
            if ( mysqli_query($con, $query)){
                $queryEmail= "SELECT * FROM `users`";
                $allEmail   = $con->query($queryEmail);
                while($row = $allEmail->fetch_assoc()){
                    sendMail($row["email"],$eventTitle);
                }
                echo "<div class='form'>
                <h3>You are edited an event successfully.</h3><br/>
                <p class='link'>Click here to back to <a href='adminDashboard.php'>Dashboard</a></p>
                </div>";
            }
            else{
                echo '<script type="text/javascript">';
                echo ' alert("No Event Edited or Added")';  //not showing an alert box.
                echo '</script>';
                header("Location: adminDashboard.php");
            }
        }
    }else {
?>
    <form class="form" action="" method="post" enctype="multipart/form-data">
        <h1 class="login-title">Edit Event</h1>
        <input type="text" class="login-input" name="eventTitle" placeholder="Enter Event Title..." required />
        <input type="text" class="login-input" name="eventDescription" placeholder="Enter Event Description..." required />
        <input type="text" class="login-input" name="eventDate" placeholder="Enter Event Date..." required />
        <input type="text" class="login-input" name="eventLocation" placeholder="Enter Event Location..." required />
        <input type="text" class="login-input" name="eventCapacity" placeholder="Enter Event Capacity..." required />
        <input type="file" name="file" accept="image/*">
        <input type="submit" value="Submit" name="myfile" class="login-button"/>
        <input type="radio" value="" name="myfile"/>
        <a href="adminDashboard.php">
        <input type="button" value="Cancel" name="cancel" class="login-button"/>

        </form>
<?php
    }
?>
</body>

</html>