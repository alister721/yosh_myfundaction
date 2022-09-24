<?php
//This is a simple admin dashboard page that allow logout and edit profile
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
        <p>You are now in admin dashboard page.</p>
        <p><a href="logout.php">Logout</a></p>
        <p><a href="editEvent.php">Edit Event</a></p>
        <p><a href="showEvent.php">Display Event</a></p>
    </div>
</body>
</html>