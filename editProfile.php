<!DOCTYPE html>
    <!-- This file allow user to edit their personal details after they login their account -->
<html>
<head>
    <meta charset="utf-8"/>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    require('db.php');
    session_start();
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['phoneNumber'])) {
        // removes backslashes and escapes special characters in a string
        $phoneNumber = stripslashes($_REQUEST['phoneNumber']);
        $phoneNumber = mysqli_real_escape_string($con, $phoneNumber);

        $ic    = stripslashes($_REQUEST['ic']);
        $ic    = mysqli_real_escape_string($con, $ic);

        $gender    = stripslashes($_REQUEST['gender']);
        $gender    = mysqli_real_escape_string($con, $gender);

        $birthDate = stripslashes($_REQUEST['birthDate']);
        $birthDate = mysqli_real_escape_string($con, $birthDate);

        $address = stripslashes($_REQUEST['address']);
        $address = mysqli_real_escape_string($con, $address);

        $postcode = stripslashes($_REQUEST['postcode']);
        $postcode = mysqli_real_escape_string($con, $postcode);

        $district = stripslashes($_REQUEST['district']);
        $district = mysqli_real_escape_string($con, $district);

        $state = stripslashes($_REQUEST['state']);
        $state = mysqli_real_escape_string($con, $state);

        $queryID= "SELECT `id` FROM `users` WHERE email='".$_SESSION['email']."'";
        $result   = mysqli_query($con, $queryID);
        $rowData = mysqli_fetch_array($result);

        $targetDir = "uploadedImageEdit/";
        $fileName = basename($_FILES["file"]["name"]);
        $newFileName = $rowData["id"].$fileName;
        $targetFilePath = $targetDir . $newFileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            $queryCheck = "SELECT `volunteerId` FROM `personaldetails` WHERE `volunteerId` in (SELECT `id` FROM users WHERE email='".$_SESSION['email']."')";
            $resultCheckDuplicate = mysqli_query($con, $queryCheck); 

            if( mysqli_num_rows($resultCheckDuplicate) > 0 ){
                $queryUpdate="UPDATE `personaldetails` SET `phoneNumber`='$phoneNumber',`ic`='$ic',`gender`='$gender',`birthDate`='$birthDate',`address`='$address',`postcode`='$postcode',`district`='$district',`state`='$state',`image`='$newFileName' WHERE volunteerId in (SELECT id from users where email='".$_SESSION['email']."')";
                if ( mysqli_query($con, $queryUpdate)){
                    echo "<div class='form'>
                        <h3>You are edited the profile successfully.</h3><br/>
                        <p class='link'>Click here to back to <a href='userDashboard.php'>Dashboard</a></p>
                        </div>";
                } else {
                    echo "<div class='form'>
                        <h3>Required fields are missing.</h3><br/>
                        <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                        </div>";
                }
            }
        
            else{ 
                $query    = "INSERT into `personaldetails`(`volunteerId`,`phoneNumber`, `ic`, `gender`, `birthDate`, `address`, `postcode`, `district`, `state`,`image`)
                            SELECT id,'$phoneNumber','$ic', '$gender','$birthDate','$address','$postcode','$district','$state','$newFileName' FROM users WHERE email='".$_SESSION['email']."'";
                          
                if ( mysqli_query($con, $query)){
                    echo "<div class='form'>
                        <h3>You are edited the profile successfully.</h3><br/>
                        <p class='link'>Click here to back to <a href='userDashboard.php'>Dashboard</a></p>
                        </div>";
                } else {
                    echo "<div class='form'>
                        <h3>Required fields are missing.</h3><br/>
                        <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                        </div>";
                }
            }
        }
        
    }else {
?>
    <form class="form" action="" method="post" enctype="multipart/form-data">
        <h1 class="login-title">Edit Profile</h1>
        <input type="text" class="login-input" name="phoneNumber" placeholder="PhoneNumber" required />
        <input type="text" class="login-input" name="ic" placeholder="IC" required />
        <input type="radio" name="gender" value="male" required> Male
        <input type="radio" name="gender" value="female"> Female
        <input type="date" class="login-input" name="birthDate" placeholder="BirthDate" required />
        <input type="text" class="login-input" name="address" placeholder="Address" required />
        <input type="text" class="login-input" name="postcode" placeholder="Postcode" required />
        <input type="text" class="login-input" name="district" placeholder="District" required>
        <input type="text" class="login-input" name="state" placeholder="State" required>
        <input type="file" name="file" accept="image/*">
        <input type="submit" value="Submit" name="myfile" class="login-button"/>
        <input type="radio" value="" name="myfile"/>
        <a href="userDashboard.php">
        <input type="button" value="Cancel" name="cancel" class="login-button"/>

        </form>
<?php
    }
?>
</body>

</html>