<?php 
    session_start() ;
    
    if (isset($_SESSION['uname'])) {
        $conn=new mysqli("localhost","root","","rms");
        if(isset($_POST['update'])){
            $name=$_POST['name'];
            $phnumber=$_POST['phnumber'];
            $address=$_POST['address'];
            $pass=$_POST['pass'];
        
            $qury= "update customer set cus_name='".$name."',phone_number='".$phnumber."',cus_address='".$address."',cus_password='".$pass."' where cus_id = '".$_GET['id']."'";
            $fuck = $conn->query($qury) ;
    
            
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/ud.css">
</head>
<body>

    <div class="maincon">

        <div class="menu-items">
            <div class="img">

                <img src="./assets/logof.png" alt="">
            </div>
            <ul class="list">
                    <li><a href="#home">
                        <div class="home">Explore</div>
                    </a></li>
                    
                    <li><a href="myprof.php?id=<?php echo $_GET['id']?>">
                        <div class="Your Profile">Your Profile</div>
                    </a></li>
                    <li><a href="logout.php">
                        <div class="logout">Logout</div>
                    </a></li>
                </ul>
        </div>

    
        <div class="container" id="home">
            <div class="greetings">
        
                <?php

                    $qry = "select * from customer where cus_id= '".$_GET['id']."'" ;
                    $result = $conn->query($qry) ;

                    $row = $result->fetch_assoc();
                ?>
                <h2>Welcome, <span><?php echo $row["cus_name"] ?> </span></h2>
                <h3><span>Explore</span> and <span>Choose</span> your destination</h3>

            </div>

            <div class="con">

                <?php
    
                    $q = "select * from restaurant" ;
                    $res = $conn->query($q) ;
    
                    while ($row = $res->fetch_assoc()) { 
                        ?>
                        <div class="card">
                            <div class="img">
                                <img src="assets/<?php echo $row["image"] ?>" alt="">
                            </div>
                            <div class="desc">
                                <h3><?php echo $row["res_name"] ?> </h3>
                                <p><?php echo $row["descc"] ?></p>
                                <p class="t">Address: <?php echo $row["res_address"] ?></p>
                                <p class="t">Raring: <?php echo $row["rating"] ?></p>
                            </div>
                            <div class="btn">
                                <a href="restaurants.php?id=<?php echo $row["res_id"] ?>&_id=<?php echo $_GET['id'] ?>">Select</a>
                            </div>
                        </div>
                        
                    <?php
                    } } else {
                        header('location: index.html') ;
                    }
                    ?>
            </div>
    
        </div>
    </div>

    
    
</body>
</html>