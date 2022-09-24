
<?php
// user will not able to enter dashboard page when there is no email exists(no login)
    session_start();
    if(!isset($_SESSION["email"])) {
        header("Location: login.php");
        exit();
    }
?>