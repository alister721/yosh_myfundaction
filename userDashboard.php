<?php
//This is a simple user dashboard page that allow logout and edit profile
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['email']; ?>!</p>
        <p>You are now in user dashboard page.</p>
        <p><a href="logout.php">Logout</a></p>
        <p><a href="editProfile.php">Edit Profile</a></p>
        <p><a href="showProfile.php">My Profile</a></p>
    </div>
</body>
</html>