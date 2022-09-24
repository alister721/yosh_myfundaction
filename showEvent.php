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
            <th>Event Title</th>
            <th>Event Description</th>
            <th>Event Date</th>
            <th>Event Location</th>
            <th>Pax</th>
        </tr>
        <?php
            require('db.php');
            require('auth_session.php');
            $sqlSelectEvent = "SELECT * FROM `event`";
            $runQuery = mysqli_query($con, $sqlSelectEvent);
            while($rowsTblPersonalDetails=$runQuery->fetch_assoc())
            {
                $imageURL = 'uploadedImageEvent/'.$rowsTblPersonalDetails["posterImage"];
        ?>
                <img src="<?php echo $imageURL; ?>" alt="" />
        <tr>
        
            <td><?php echo $rowsTblPersonalDetails['eventTitle'];?></td>
            <td><?php echo $rowsTblPersonalDetails['eventDescription'];?></td>
            <td><?php echo $rowsTblPersonalDetails['eventDate'];?></td>
            <td><?php echo $rowsTblPersonalDetails['eventLocation'];?></td>
            <td><?php echo $rowsTblPersonalDetails['numPerson'];?></td>
        </tr>
        <?php
            }
        ?>
    </table>
    
</body>
</html>
