<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>IC</th>
            <th>Gender</th>
            <th>Birth Date</th>
            <th>Address</th>
            <th>Postcode</th>
            <th>District</th>
            <th>State</th>
        </tr>
        <?php
            require('db.php');
            require('auth_session.php');
            $sqlSelectTblDetails = "SELECT * FROM `personaldetails` WHERE `volunteerId` in (SELECT `id` FROM users WHERE email='".$_SESSION['email']."')";
            $runQuery = mysqli_query($con, $sqlSelectTblDetails);
            $sqlSelectTblUsers = "SELECT * FROM `users` WHERE email='".$_SESSION['email']."'";
            $runQuery2 = mysqli_query($con, $sqlSelectTblUsers);

            while($rowsTblPersonalDetails=$runQuery->fetch_assoc())
            {
                $imageURL = 'uploadedImageEdit/'.$rowsTblPersonalDetails["image"];
        ?>
                <img src="<?php echo $imageURL; ?>" alt="" />
        <?php
                while($rowsTblUsers=$runQuery2->fetch_assoc()){
        ?>
        <tr>
        
            <td><?php echo $rowsTblUsers['firstname'];?></td>
            <td><?php echo $rowsTblUsers['lastname'];?></td>
            <td><?php echo $rowsTblUsers['email'];?></td>
            <td><?php echo $rowsTblPersonalDetails['phoneNumber'];?></td>
            <td><?php echo $rowsTblPersonalDetails['ic'];?></td>
            <td><?php echo $rowsTblPersonalDetails['gender'];?></td>
            <td><?php echo $rowsTblPersonalDetails['birthDate'];?></td>
            <td><?php echo $rowsTblPersonalDetails['address'];?></td>
            <td><?php echo $rowsTblPersonalDetails['postcode'];?></td>
            <td><?php echo $rowsTblPersonalDetails['district'];?></td>
            <td><?php echo $rowsTblPersonalDetails['state'];?></td>
        </tr>
        <?php
                }
            }
        ?>
    </table>
    
</body>
</html>
