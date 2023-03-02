<?php
session_start() ;
if (isset($_SESSION['uname'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/mprof.css">
</head>
<body>

    <?php
    

        
        $conn = new mysqli ('localhost', 'root', '', 'rms') ;

        $qr = "select * from customer where cus_id = '".$_GET['id']."'" ;
        $res = $conn->query ($qr) ;

        $row = $res->fetch_assoc() ;
    ?>
    <div class="name">
        <h2> <?php echo $row["cus_name"] ?></h2>
    </div>
    <div class="myrpof" id="myprofile">
        <p class="phone">Phone number: <?php echo $row["phone_number"] ?></p>
        <p>Address: <?php echo $row["cus_address"] ?></p>

        <a href="update.php?id=<?php echo $_GET['id'] ?>">Update</a>
        <a href="userdashboard.php?id=<?php echo $_GET['id'] ;} else {header('location: index.html') ;}?>">Back</a>
        
        
    </div>

</body>
</html>