<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <?php 
        
        require ('db.php');

        if (isset($_GET['email']) && isset($_GET['reset_token'])) {

            date_default_timezone_set('Asia/kolkata');
            $date = date("Y-m-d");
            
            $email = $_GET['email'];    
            $reset_token = $_GET['reset_token'];

            $sql="SELECT * FROM users WHERE email = '$email' AND resetToken = '$reset_token' AND resetTokenExp = '$date'";
            $result = $con->query($sql);

            if ($result) {
                
                if ($result->num_rows == 1) {
                    echo '
                        <div class="container d-flex justify-content-center mt-5 pt-5">
                            <div class="card mt-5" style="width:500px">
                                <div class="card-header">
                                    <h1 class="text-center">Create New Password</h1>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="mt-2">
                                            <label for="Password">Password : </label>
                                            <input type="password" name="Password" class="form-control" placeholder="Create New Password">
                                            <input type="hidden" name="email" class="form-control" value='.$email.'>
                                        </div>
                                        <div class="mt-4 text-end">
                                            <input type="submit" name="update" value="Update" class="btn btn-primary">
                                            <a href="login.php" class="btn btn-danger">Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>';
                }else{
                    echo "
                        <script>
                            alert('invelid or Expired link');
                            window.location.href='login.php'
                        </script>";
                }
            }   
        
        }else{
            echo "
                <script>
                    alert('server down!!');
                    window.location.href='login.php'
                </script>";
        }
        
        if (isset($_POST['update'])) {
            $pass = $_POST['Password'];
            echo $pass;
            $email = $_POST['email'];
            echo $email;
            $salted=$email.$pass;

            $update = "UPDATE users SET password='".hash("sha256", $salted)."',resetToken='NULL',resetTokenExp=NULL WHERE email = '$email'";
            $result = mysqli_query($con, $update);
            if (($result)) {
                echo "
                    <script>
                        alert('New Password Created Successfully');
                        window.location.href='login.php'                
                        </script>"; 
            }else{
                echo "Error: ".$sql."<br>".$con->error;
                echo "
                    <script>
                    alert('Password not updated');
                    window.location.href='login.php'                     
                    </script>";
            }
        } 
    ?>
</body>
</html>