
<?php
    session_start() ;
    if ($_SESSION['uname']) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/update.css">
</head>
<body>
    <div class="container">
        <form action="userdashboard.php?id=<?php echo $_GET['id'] ?>" method="post">
            <input type="text" class="up-fi" name = "name" id="name" placeholder="Name">
            <input type="text" class="up-fi" name="phnumber" id = "phnumber" placeholder="Phone Number">
            <input type="text" class="up-fi" name="address" id  = "cusaddr" placeholder="Customer Address">
            <input type="password" class="up-fi" name="pass" id = "pass" placeholder="Password">
            <button type="submit" class = "up-bt" name = "update">Update</button>
        </form>
    </div> 
    
    
</body>
</html>

<?php
    } else {
        header('location: index.html') ;
    } 
?>